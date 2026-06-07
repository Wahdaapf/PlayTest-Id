<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    // ── Guard: hanya admin ───────────────────────────────────────────────────
    private function ensureAdmin()
    {
        if (! Auth::check() || Auth::user()->role !== UserRole::admin) {
            abort(403, 'Akses ditolak.');
        }
    }

    // ── Helper: tulis CSV ke Response ────────────────────────────────────────
    private function csvResponse(string $filename, array $headers, array $rows): Response
    {
        $bom     = "\xEF\xBB\xBF"; // UTF-8 BOM agar Excel terbaca benar
        $handle  = fopen('php://temp', 'r+');
        fputcsv($handle, $headers);
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = $bom . stream_get_contents($handle);
        fclose($handle);

        return response($content, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  1. EXPORT PENGGUNA  (.csv)
    // ══════════════════════════════════════════════════════════════════════════
    public function exportPengguna(): Response
    {
        $this->ensureAdmin();

        $users = User::where('role', '!=', UserRole::admin)
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = ['ID', 'Nama', 'Email', 'Role', 'Tanggal Daftar'];
        $rows    = $users->map(fn($u) => [
            $u->id,
            $u->name,
            $u->email,
            ucfirst($u->role->value ?? $u->role),
            $u->created_at->format('d/m/Y H:i'),
        ])->toArray();

        $filename = 'pengguna_' . now()->format('Ymd_His') . '.csv';

        return $this->csvResponse($filename, $headers, $rows);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  2. EXPORT KAMPANYE  (.csv)
    // ══════════════════════════════════════════════════════════════════════════
    public function exportKampanye(): Response
    {
        $this->ensureAdmin();

        $misis = Misi::with('user')->orderBy('created_at', 'desc')->get();

        $headers = ['ID', 'Nama Aplikasi', 'Developer', 'Status', 'Kapasitas', 'Jumlah Tester', 'Tanggal Dibuat'];
        $rows    = $misis->map(function ($m) {
            $testerCount = MisiAnggota::where('id_misi', $m->id)->count();
            return [
                $m->id,
                $m->nama_aplikasi,
                $m->user->name ?? 'Unknown',
                ucfirst($m->status),
                $m->kapasitas ?? '-',
                $testerCount,
                $m->created_at->format('d/m/Y H:i'),
            ];
        })->toArray();

        $filename = 'kampanye_' . now()->format('Ymd_His') . '.csv';

        return $this->csvResponse($filename, $headers, $rows);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  3. EXPORT PENDAPATAN  (.csv)
    // ══════════════════════════════════════════════════════════════════════════
    public function exportPendapatan(): Response
    {
        $this->ensureAdmin();

        $pembayarans = Pembayaran::with(['user', 'paket'])
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = ['ID', 'Nama Pengguna', 'Email', 'Paket', 'Harga (Rp)', 'Fee (Rp)', 'Total (Rp)', 'Status', 'Tanggal'];
        $rows    = $pembayarans->map(fn($p) => [
            $p->id,
            $p->user->name ?? 'Unknown',
            $p->user->email ?? '-',
            $p->paket->name ?? '-',
            $p->paket->price ?? 0,
            $p->paket->fee ?? 0,
            ($p->paket->price ?? 0) + ($p->paket->fee ?? 0),
            ucfirst($p->status),
            $p->created_at->format('d/m/Y H:i'),
        ])->toArray();

        $filename = 'pendapatan_' . now()->format('Ymd_His') . '.csv';

        return $this->csvResponse($filename, $headers, $rows);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  3b. EXPORT WITHDRAW  (.csv)
    // ══════════════════════════════════════════════════════════════════════════
    public function exportWithdraw(): Response
    {
        $this->ensureAdmin();

        $withdrawals = Withdraw::with(['user', 'admin'])->orderBy('created_at', 'desc')->get();

        $headers = ['ID Withdraw', 'Tanggal', 'Nama Tester', 'Point Ditukar', 'Rupiah', 'Metode', 'No Akun', 'Status', 'Admin'];
        $rows    = $withdrawals->map(fn($w) => [
            $w->id,
            $w->created_at->format('d/m/Y H:i'),
            $w->user->name ?? '-',
            $w->point,
            $w->rupiah ?? ($w->point * 10),
            $w->metode,
            $w->nomor_akun,
            ucfirst($w->status),
            $w->admin->name ?? '-',
        ])->toArray();

        $filename = 'withdraw_' . now()->format('Ymd_His') . '.csv';

        return $this->csvResponse($filename, $headers, $rows);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  4. EXPORT LAPORAN PDF  (HTML-to-PDF sederhana, dicetak via browser)
    // ══════════════════════════════════════════════════════════════════════════
    public function exportPdf(): Response
    {
        $this->ensureAdmin();

        // ── Kumpulkan data ringkasan ─────────────────────────────────────────
        $statDeveloper = User::where('role', UserRole::developer)->count();
        $statTester    = User::where('role', UserRole::tester)->count();
        $statAktif     = Misi::whereIn('status', ['open', 'progress'])->count();
        $statSelesai   = Misi::where('status', 'selesai')->count();
        $statPending   = Pembayaran::where('status', 'pending')->count();

        $totalRevenue = Pembayaran::whereIn('status', ['accepted', 'success'])
            ->with('paket')->get()
            ->sum(fn($p) => ($p->paket->price ?? 0) + ($p->paket->fee ?? 0));

        // Pendaftaran bulan ini
        $devBulanIni    = User::where('role', UserRole::developer)->whereMonth('created_at', Carbon::now()->month)->count();
        $testerBulanIni = User::where('role', UserRole::tester)->whereMonth('created_at', Carbon::now()->month)->count();

        // Pengguna terbaru
        $users = User::where('role', '!=', UserRole::admin)->latest()->take(20)->get();

        // Kampanye terbaru
        $kampanye = Misi::with('user')->latest()->take(10)->get();

        // Pendapatan terbaru
        $pembayarans = Pembayaran::with(['user', 'paket'])
            ->whereIn('status', ['accepted', 'success'])
            ->latest()->take(10)->get();

        $html = view('filament.admin.exports.laporan-pdf', compact(
            'statDeveloper', 'statTester', 'statAktif', 'statSelesai',
            'statPending', 'totalRevenue', 'devBulanIni', 'testerBulanIni',
            'users', 'kampanye', 'pembayarans'
        ))->render();

        return response($html, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
        ]);
    }
}
