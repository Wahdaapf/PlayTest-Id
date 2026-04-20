<?php

namespace App\Filament\Admin\Pages;  
  
use App\Models\User;
use App\Models\Misi;
use App\Models\Pembayaran;
use App\Enums\UserRole;
use Filament\Pages\Page;  
use Illuminate\Support\Carbon;

class AdminDashboard extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon  = 'heroicon-o-squares-2x2';  
    protected static ?string $navigationLabel = 'Dashboard';  
    protected static ?string $title           = 'Dashboard Overview';  
    protected static ?int    $navigationSort  = 1;  
    protected string  $view            = 'filament.admin.pages.admin-dashboard';  
  
    public function getViewData(): array  
    {  
        // ── 1. Statistik Dasar ──────────────────────────────────
        $statDeveloper = User::where('role', UserRole::developer)->count();
        $statTester    = User::where('role', UserRole::tester)->count();
        $statAktif     = Misi::whereIn('status', ['open', 'progress'])->count();
        $statSelesai   = Misi::where('status', 'selesai')->count();
        
        // Pendapatan: Total price paket dari pembayaran yang diterima
        $totalRevenue = Pembayaran::where('status', 'accepted')
            ->with('paket')
            ->get()
            ->sum(fn($p) => $p->paket->price ?? 0);
            
        $statPendapatan = number_format($totalRevenue / 1000000, 1, ',', '.') . ' Jt';
        $statPending    = Pembayaran::where('status', 'waiting')->count();

        // ── 2. Data Chart (7 Hari Terakhir) ─────────────────────
        $chartHari = [];
        $chartDev = [];
        $chartTester = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartHari[] = $date->isoFormat('ddd');
            
            $chartDev[] = User::where('role', UserRole::developer)
                ->whereDate('created_at', $date)
                ->count();
                
            $chartTester[] = User::where('role', UserRole::tester)
                ->whereDate('created_at', $date)
                ->count();
        }

        // ── 3. Pendaftaran Terbaru (Recent Users) ─────────────
        $pendaftaranList = User::latest()->take(8)->get()->map(function ($u) {
            $roleLabel = match($u->role) {
                UserRole::developer => 'Developer',
                UserRole::tester    => 'Tester',
                UserRole::admin     => 'Admin',
            };

            return [
                'inisial' => strtoupper(substr($u->name, 0, 2)),
                'nama'    => $u->name,
                'email'   => $u->email,
                'role'    => $roleLabel,
                'tanggal' => $u->created_at->format('d M Y'),
                'status'  => 'Aktif', // Asumsi default aktif jika terdaftar
            ];
        })->toArray();

        // ── 4. Kampanye Terbaru ───────────────────────────────
        $kampanyeList = Misi::with('user')->latest()->take(4)->get()->map(function ($m) {
            $testerCount = $m->misiAnggotas()->count();
            $maxTester = $m->kapasitas ?: 20;
            
            $diff = $m->created_at->diffInDays(now());
            $hariAktif = min($diff + 1, 14);

            $statusLabel = match($m->status) {
                'pending' => 'Ditinjau',
                'selesai' => 'Selesai',
                default   => 'Aktif',
            };

            return [
                'nama'      => $m->nama_aplikasi,
                'developer' => $m->user->name ?? 'Unknown',
                'tester'    => $testerCount,
                'max'       => $maxTester,
                'hari'      => $m->status === 'selesai' ? 14 : $hariAktif,
                'maxHari'   => 14,
                'status'    => $statusLabel,
            ];
        })->toArray();

        return [
            'statDeveloper'   => number_format($statDeveloper, 0, ',', '.'),
            'statTester'      => number_format($statTester, 0, ',', '.'),
            'statAktif'       => $statAktif,
            'statSelesai'     => $statSelesai,
            'statPendapatan'  => $statPendapatan,
            'statPending'     => $statPending,
            'chartHari'       => $chartHari,
            'chartDev'        => $chartDev,
            'chartTester'     => $chartTester,
            'pendaftaranList' => $pendaftaranList,
            'kampanyeList'    => $kampanyeList,
        ];
    }  
}  