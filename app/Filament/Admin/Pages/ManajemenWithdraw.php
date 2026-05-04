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

    protected static ?string $navigationLabel = 'Withdraw Tester';
    protected static ?string $title = 'Transaksi Tester';
    protected static ?string $slug = 'manajemen-withdraw';
    protected string $view = 'filament.admin.pages.manajemen-withdraw';

    // Image upload for approval proof
    public $buktiTransfer = null;
    public ?string $previewUrl = null;
    public ?int $pendingApproveId = null;
    public ?int $pendingRejectId = null;
    public string $rejectCatatan = '';

    public function updatedBuktiTransfer(): void
    {
        if ($this->buktiTransfer) {
            $this->previewUrl = $this->buktiTransfer->temporaryUrl();
        }
    }

    public function confirmApprove(int $id): void
    {
        $this->pendingApproveId = $id;
        $this->pendingRejectId = null;
        $this->buktiTransfer = null;
        $this->dispatch('open-approve-modal');
    }

    public function confirmReject(int $id): void
    {
        $this->pendingRejectId = $id;
        $this->pendingApproveId = null;
        $this->rejectCatatan = '';
        $this->dispatch('open-reject-modal');
    }

    public function cancelAction(): void
    {
        $this->pendingApproveId = null;
        $this->pendingRejectId = null;
        $this->buktiTransfer = null;
        $this->previewUrl = null;
        $this->rejectCatatan = '';
    }

    public function approveWithdraw(): void
    {
        $id = $this->pendingApproveId;
        if (!$id) return;

        $withdraw = Withdraw::find($id);
        if (!$withdraw || $withdraw->status !== 'pending') {
            Notification::make()
                ->title('Error')
                ->danger()
                ->body('Withdrawal tidak ditemukan atau sudah diproses.')
                ->send();
            $this->cancelAction();
            return;
        }

        // Validate image upload
        if (!$this->buktiTransfer) {
            Notification::make()
                ->title('Bukti Transfer Wajib')
                ->danger()
                ->body('Harap upload bukti transfer sebelum menyetujui withdrawal.')
                ->send();
            return;
        }

        // Store the image
        $imagePath = $this->buktiTransfer->store('withdraw-proofs', 'public');

        $withdraw->update([
            'status'   => 'success',
            'id_admin' => Auth::id(),
            'image'    => $imagePath,
        ]);

        Notification::make()
            ->title('Withdrawal Disetujui')
            ->success()
            ->body('Withdrawal #' . $id . ' sebesar Rp ' . number_format($withdraw->rupiah, 0, ',', '.') . ' telah dikonfirmasi.')
            ->send();

        $this->cancelAction();
        $this->dispatch('data-updated');
    }

    public function rejectWithdraw(): void
    {
        $id = $this->pendingRejectId;
        if (!$id) return;

        $withdraw = Withdraw::find($id);
        if (!$withdraw || $withdraw->status !== 'pending') {
            Notification::make()
                ->title('Error')
                ->danger()
                ->body('Withdrawal tidak ditemukan atau sudah diproses.')
                ->send();
            $this->cancelAction();
            return;
        }

        // Kembalikan point ke user
        $balance = UserBalance::where('id_user', $withdraw->id_user)->first();
        if ($balance) {
            $balance->increment('point', $withdraw->point);
        }

        $withdraw->update([
            'status'   => 'rejected',
            'id_admin' => Auth::id(),
            'catatan'  => !empty($this->rejectCatatan) ? $this->rejectCatatan : 'Ditolak oleh admin.',
        ]);

        Notification::make()
            ->title('Withdrawal Ditolak')
            ->warning()
            ->body('Withdrawal #' . $id . ' ditolak. Point telah dikembalikan ke user.')
            ->send();

        $this->cancelAction();
        $this->dispatch('data-updated');
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
        fputcsv($handle, ['ID Withdraw', 'Tanggal', 'Nama Tester', 'Point Ditukar', 'Rupiah', 'Metode', 'No Akun', 'Status', 'Admin']);

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

        // Metode breakdown
        $metodeCount = [];

        foreach ($withdrawals as $w) {
            $userName = $w->user ? $w->user->name : 'Unknown';
            $inisial = strtoupper(substr(str_replace(' ', '', $userName), 0, 2));
            $avatarColors = ['from-blue-500 to-cyan-400', 'from-emerald-500 to-teal-400', 'from-violet-500 to-purple-400', 'from-orange-500 to-amber-400', 'from-pink-500 to-rose-400'];
            $avatarColor = $avatarColors[crc32($userName) % count($avatarColors)];

            $metodeLabel = Withdraw::METHODS[$w->metode] ?? $w->metode;
            $metodeCount[$metodeLabel] = ($metodeCount[$metodeLabel] ?? 0) + 1;

            if ($w->status === 'pending') $totalPending++;
            elseif ($w->status === 'success') {
                $totalSuccess++;
                $totalRupiahSuccess += $w->rupiah;
                if ($w->created_at && $w->created_at->format('Y-m') === now()->format('Y-m')) {
                    $rupiahBulanIni += $w->rupiah;
                }
            }
            elseif ($w->status === 'rejected') $totalRejected++;

            $dateObj = $w->created_at ?: now();

            $list[] = [
                'id'          => $w->id,
                'withdrawId'  => 'WD-' . $dateObj->format('Y') . '-' . str_pad($w->id, 4, '0', STR_PAD_LEFT),
                'namaUser'    => $userName,
                'inisial'     => $inisial,
                'avatarColor' => $avatarColor,
                'point'       => $w->point,
                'rupiah'      => $w->rupiah,
                'rupiahF'     => 'Rp ' . number_format($w->rupiah, 0, ',', '.'),
                'metode'      => $metodeLabel,
                'metodeKey'   => $w->metode,
                'nomorAkun'   => $w->nomor_akun,
                'status'      => $w->status,
                'catatan'     => $w->catatan,
                'tanggal'     => $dateObj->format('d M Y'),
                'waktu'       => $dateObj->format('H:i'),
                'adminNama'   => $w->admin ? $w->admin->name : '-',
                'image'       => $w->image ? asset('storage/' . $w->image) : null,
                'updatedAt'   => $w->updated_at ? $w->updated_at->format('d M Y H:i') : '-',
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
        if (max($chartNilai) == 0) {
            $chartNilai = [0, 0, 0, 0, 0, 1];
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

        return [
            'withdrawList'       => $list,
            'totalPending'       => $totalPending,
            'totalSuccess'       => $totalSuccess,
            'totalRejected'      => $totalRejected,
            'totalRupiahSuccess' => 'Rp ' . number_format($totalRupiahSuccess, 0, ',', '.'),
            'rupiahBulanIni'     => 'Rp ' . number_format($rupiahBulanIni, 0, ',', '.'),

            /* chart */
            'chartBulan'         => $chartBulan,
            'chartNilai'         => $chartNilai,

            /* ringkasan & metode */
            'metodeBreakdown'    => $metodeBreakdown,
        ];
    }
}
