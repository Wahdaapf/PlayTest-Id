<?php

namespace App\Filament\Admin\Pages;

use App\Models\Withdraw;
use App\Models\UserBalance;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ManajemenWithdraw extends Page
{
    use WithFileUploads;

    public static function getNavigationLabel(): string
    {
        return __('Penarikan Tester');
    }

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        return __('Penarikan Tester');
    }

    protected static ?string $navigationLabel = 'Penarikan Tester';
    protected static ?string $title = 'Penarikan Tester';
    protected static ?string $slug = 'manajemen-withdraw';
    protected string $view = 'filament.admin.pages.manajemen-withdraw';

    // Image upload for approval proof (removed, now using Xendit)
    public $buktiTransfer = null;
    public ?string $previewUrl = null;
    public ?int $pendingApproveId = null;
    public ?int $pendingRejectId = null;
    public string $rejectCatatan = '';

    public function cancelAction(): void
    {
        $this->pendingApproveId = null;
        $this->pendingRejectId = null;
        $this->buktiTransfer = null;
        $this->previewUrl = null;
        $this->rejectCatatan = '';
    }

    /**
     * Synchronize payout status from Xendit
     */
    public function syncWithdrawStatus(int $id): void
    {
        $withdraw = Withdraw::find($id);
        if (!$withdraw || !$withdraw->xendit_payout_id) {
            Notification::make()
                ->title(__('Gagal'))
                ->danger()
                ->body(__('Transaksi tidak memiliki Xendit Payout ID.'))
                ->send();
            return;
        }

        try {
            $xenditService = app(\App\Services\XenditService::class);
            $payout = $xenditService->getPayout($withdraw->xendit_payout_id);
            $status = strtoupper($payout['status']);

            if ($status === 'COMPLETED' || $status === 'SUCCEEDED') {
                $withdraw->update([
                    'status' => 'success',
                    'id_admin' => Auth::id(),
                    'catatan' => 'Penarikan berhasil melalui Xendit Payout.',
                ]);
                Notification::make()
                    ->title(__('Penarikan Berhasil'))
                    ->success()
                    ->body(__('Transaksi #') . $id . __(' selesai diproses via Xendit.'))
                    ->send();
            } elseif ($status === 'FAILED' || $status === 'REJECTED') {
                \Illuminate\Support\Facades\DB::transaction(function () use ($withdraw, $payout) {
                    $balance = UserBalance::where('id_user', $withdraw->id_user)->first();
                    if ($balance) {
                        $balance->increment('point', $withdraw->point);
                    }
                    $withdraw->update([
                        'status' => 'rejected',
                        'id_admin' => Auth::id(),
                        'catatan' => 'Penarikan Xendit gagal: ' . ($payout['failure_code'] ?? 'Alasan tidak diketahui'),
                    ]);
                });

                Notification::make()
                    ->title(__('Penarikan Gagal'))
                    ->danger()
                    ->body(__('Transaksi #') . $id . __(' gagal/ditolak. Poin dikembalikan kepada tester.'))
                    ->send();
            } else {
                Notification::make()
                    ->title(__('Sedang Diproses'))
                    ->info()
                    ->body(__('Transaksi ini masih diproses oleh Xendit. Status: ') . $status)
                    ->send();
            }

            $this->dispatch('data-updated');
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('Gagal sinkronisasi'))
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
    }


    public function exportCsv()
    {
        $withdrawals = Withdraw::with(['user', 'admin'])->orderBy('created_at', 'desc')->get();
        $csvFileName = 'laporan-withdraw-' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID Penarikan', 'Tanggal', 'Nama Tester', 'Poin Ditukar', 'Rupiah', 'Metode', 'No Akun', 'Status', 'Admin']);

        foreach ($withdrawals as $w) {
            fputcsv($handle, [
                $w->id,
                $w->created_at->format('Y-m-d H:i'),
                $w->user->name ?? '-',
                $w->point,
                $w->point * 10,
                $w->metode,
                $w->nomor_akun,
                $w->status,
                $w->admin->name ?? '-'
            ]);
        }

        fclose($handle);
        return response()->stream(function() {}, 200, $headers);
    }

    protected function getViewData(): array
    {
        $withdrawals = Withdraw::with(['user', 'admin'])
            ->orderByRaw("FIELD(status, 'pending', 'success', 'rejected')")
            ->orderBy('created_at', 'desc')
            ->get();

        $list = [];
        $totalPending = 0;
        $totalSuccess = 0;
        $totalRejected = 0;
        $totalRupiahSuccess = 0;
        $rupiahBulanIni = 0;
        $rupiahBulanLalu = 0;
        $pendingMingguIni = 0;
        $rejectedMingguIni = 0;

        // Metode breakdown
        $metodeCount = [];

        foreach ($withdrawals as $w) {
            $userName = $w->user ? $w->user->name : 'Unknown';
            $inisial = strtoupper(substr(str_replace(' ', '', $userName), 0, 2));
            $avatarColors = ['from-blue-500 to-cyan-400', 'from-emerald-500 to-teal-400', 'from-violet-500 to-purple-400', 'from-orange-500 to-amber-400', 'from-pink-500 to-rose-400'];
            $avatarColor = $avatarColors[crc32($userName) % count($avatarColors)];

            $metodeLabel = Withdraw::METHODS[$w->metode] ?? $w->metode;
            $metodeCount[$metodeLabel] = ($metodeCount[$metodeLabel] ?? 0) + 1;

            if ($w->status === 'pending') {
                $totalPending++;
                if ($w->created_at && $w->created_at >= now()->startOfWeek()) {
                    $pendingMingguIni++;
                }
            } elseif ($w->status === 'success') {
                $totalSuccess++;
                $totalRupiahSuccess += $w->rupiah;
                if ($w->created_at && $w->created_at->format('Y-m') === now()->format('Y-m')) {
                    $rupiahBulanIni += $w->rupiah;
                } elseif ($w->created_at && $w->created_at->format('Y-m') === now()->subMonth()->format('Y-m')) {
                    $rupiahBulanLalu += $w->rupiah;
                }
            }
            elseif ($w->status === 'rejected') {
                $totalRejected++;
                if ($w->created_at && $w->created_at >= now()->startOfWeek()) {
                    $rejectedMingguIni++;
                }
            }

            $dateObj = $w->created_at ?: now();

            $catatanText = $w->catatan;
            if ($catatanText) {
                if (str_contains($catatanText, 'Withdrawal completed via Xendit Payout.') || str_contains($catatanText, 'Penarikan berhasil melalui Xendit Payout.')) {
                    $catatanText = __('Penarikan berhasil melalui Xendit Payout.');
                } elseif (str_contains($catatanText, 'Xendit payout failed:') || str_contains($catatanText, 'Penarikan Xendit gagal:')) {
                    $reason = trim(explode(':', $catatanText, 2)[1] ?? '');
                    if ($reason === 'Unknown Reason' || $reason === 'Alasan tidak diketahui') {
                        $reason = __('Alasan tidak diketahui');
                    }
                    $catatanText = __('Penarikan Xendit gagal:') . ' ' . $reason;
                } elseif (str_contains($catatanText, 'Disbursement initiated via Xendit.') || str_contains($catatanText, 'Pencairan dimulai melalui Xendit.')) {
                    $catatanText = __('Pencairan dimulai melalui Xendit.');
                }
            }

            $list[] = [
                'id'               => $w->id,
                'withdrawId'       => 'WD-' . $dateObj->format('Y') . '-' . str_pad($w->id, 4, '0', STR_PAD_LEFT),
                'namaUser'         => $userName,
                'inisial'          => $inisial,
                'avatarColor'      => $avatarColor,
                'point'            => $w->point,
                'rupiah'           => $w->rupiah,
                'rupiahF'          => 'Rp ' . number_format($w->rupiah, 0, ',', '.'),
                'metode'           => $metodeLabel,
                'metodeKey'        => $w->metode,
                'nomorAkun'        => $w->nomor_akun,
                'xendit_payout_id' => $w->xendit_payout_id,
                'status'           => $w->status,
                'catatan'          => $catatanText,
                'tanggal'          => $dateObj->format('d M Y'),
                'waktu'            => $dateObj->format('H:i'),
                'adminNama'        => $w->admin ? $w->admin->name : '-',
                'image'            => $w->image ? asset('storage/' . $w->image) : null,
                'updatedAt'        => $w->updated_at ? $w->updated_at->format('d M Y H:i') : '-',
            ];
        }

        // ── Chart bulanan (6 bulan terakhir) ──
        $chartBulan = [];
        $chartNilai = [];
        $bulanIndo = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $chartBulan[] = $bulanIndo[(int) $date->format('n') - 1];

            $sum = $withdrawals->filter(function ($w) use ($date) {
                return $w->status === 'success' && $w->created_at && $w->created_at->format('Y-m') === $date->format('Y-m');
            })->sum('rupiah');
            $chartNilai[] = $sum > 0 ? $sum : 0;
        }

        // ── Metode breakdown (top metode) ──
        $totalTrx = count($withdrawals);
        $metodeBreakdown = [];
        arsort($metodeCount);
        foreach (array_slice($metodeCount, 0, 5, true) as $label => $count) {
            $metodeBreakdown[] = [
                'label' => $label,
                'count' => $count,
                'pct'   => $totalTrx > 0 ? round($count / $totalTrx * 100) : 0,
            ];
        }

        // Kalkulasi growth
        $growthRupiah = $rupiahBulanLalu > 0
            ? round((($rupiahBulanIni - $rupiahBulanLalu) / $rupiahBulanLalu) * 100)
            : ($rupiahBulanIni > 0 ? 100 : 0);
        $growthPrefix = $growthRupiah >= 0 ? '+' : '';

        return [
            'withdrawList' => $list,
            'totalPending' => $totalPending,
            'pendingMingguIni' => '+' . $pendingMingguIni,
            'totalSuccess' => $totalSuccess,
            'totalRejected' => $totalRejected,
            'rejectedMingguIni' => '+' . $rejectedMingguIni,
            'totalRupiahSuccess' => 'Rp ' . number_format($totalRupiahSuccess, 0, ',', '.'),
            'rupiahBulanIni' => 'Rp ' . number_format($rupiahBulanIni, 0, ',', '.'),
            'growthRupiah' => $growthPrefix . $growthRupiah . '%',
            'chartBulan' => $chartBulan,
            'chartNilai' => $chartNilai,
            'metodeBreakdown' => collect($metodeCount)->map(function($count, $label) use ($totalSuccess, $totalPending, $totalRejected) {
                $total = $totalSuccess + $totalPending + $totalRejected;
                return [
                    'label' => $label,
                    'pct' => $total > 0 ? round(($count / $total) * 100) : 0
                ];
            })->sortByDesc('pct')->take(4)->values()->toArray(),
        ];
    }
}