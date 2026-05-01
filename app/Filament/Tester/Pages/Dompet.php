<?php

namespace App\Filament\Tester\Pages;

use App\Models\UserBalance;
use App\Models\Withdraw;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dompet extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Dompet';
    protected static ?string $title = 'Dompet';
    protected static ?string $slug = 'dompet';
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.tester.pages.dompet';

    // Form state
    public string $selectedMethod = 'gopay';
    public ?int $selectedDenom = null;
    public string $nomorAkun = '';

    // Invoice detail modal
    public ?array $invoiceDetail = null;

    public function selectMethod(string $method): void
    {
        $this->selectedMethod = $method;
    }

    public function selectDenom(?int $index): void
    {
        $this->selectedDenom = $index;
    }

    /**
     * Show invoice detail for a specific withdrawal
     */
    public function showInvoice(int $id): void
    {
        $user = Auth::user();
        $w = Withdraw::with('admin')->where('id', $id)->where('id_user', $user->id)->first();

        if (!$w) {
            Notification::make()
                ->title('Tidak Ditemukan')
                ->danger()
                ->body('Data withdrawal tidak ditemukan.')
                ->send();
            return;
        }

        $this->invoiceDetail = [
            'id'         => $w->id,
            'point'      => $w->point,
            'rupiah'     => $w->rupiah,
            'rupiahF'    => 'Rp ' . number_format($w->rupiah, 0, ',', '.'),
            'metode'     => Withdraw::METHODS[$w->metode] ?? $w->metode,
            'metodeKey'  => $w->metode,
            'nomorAkun'  => $w->nomor_akun,
            'status'     => $w->status,
            'catatan'    => $w->catatan,
            'tanggal'    => $w->created_at->format('d M Y'),
            'waktu'      => $w->created_at->format('H:i'),
            'adminNama'  => $w->admin ? $w->admin->name : '-',
            'image'      => $w->image ? asset('storage/' . $w->image) : null,
            'updatedAt'  => $w->updated_at->format('d M Y H:i'),
        ];

        $this->dispatch('open-invoice-modal');
    }

    public function closeInvoice(): void
    {
        $this->invoiceDetail = null;
    }

    public function submitWithdraw(): void
    {
        $user = Auth::user();
        $balance = UserBalance::where('id_user', $user->id)->first();
        $currentPoints = $balance->point ?? 0;

        // Tentukan point & rupiah dari pilihan user
        $point = 0;
        $rupiah = 0;

        if ($this->selectedDenom !== null) {
            $denoms = Withdraw::DENOMINATIONS;
            if (isset($denoms[$this->selectedDenom])) {
                $point = $denoms[$this->selectedDenom]['point'];
                $rupiah = $denoms[$this->selectedDenom]['rupiah'];
            }
        }

        // Validasi minimum
        if ($point < Withdraw::MIN_POINT) {
            Notification::make()
                ->title('Gagal')
                ->danger()
                ->body('Minimum withdrawal adalah ' . Withdraw::MIN_POINT . ' point (Rp ' . number_format(Withdraw::pointToRupiah(Withdraw::MIN_POINT), 0, ',', '.') . ').')
                ->send();
            return;
        }

        // Validasi nomor akun
        if (empty(trim($this->nomorAkun))) {
            Notification::make()
                ->title('Gagal')
                ->danger()
                ->body('Nomor akun / nomor telepon wajib diisi.')
                ->send();
            return;
        }

        // Validasi saldo cukup
        if ($currentPoints < $point) {
            Notification::make()
                ->title('Saldo Tidak Cukup')
                ->danger()
                ->body('Point Anda tidak mencukupi. Point saat ini: ' . $currentPoints . ', dibutuhkan: ' . $point . '.')
                ->send();
            return;
        }

        // Validasi metode
        if (!array_key_exists($this->selectedMethod, Withdraw::METHODS)) {
            Notification::make()
                ->title('Gagal')
                ->danger()
                ->body('Metode pembayaran tidak valid.')
                ->send();
            return;
        }

        // Cek apakah ada withdraw pending
        $pendingExists = Withdraw::where('id_user', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingExists) {
            Notification::make()
                ->title('Peringatan')
                ->warning()
                ->body('Anda masih memiliki pengajuan withdrawal yang sedang diproses. Harap tunggu hingga selesai.')
                ->send();
            return;
        }

        // Kurangi point user
        $balance->decrement('point', $point);

        // Buat record withdraw
        Withdraw::create([
            'id_user'    => $user->id,
            'point'      => $point,
            'rupiah'     => $rupiah,
            'metode'     => $this->selectedMethod,
            'nomor_akun' => trim($this->nomorAkun),
            'status'     => 'pending',
        ]);

        // Reset form
        $this->selectedDenom = null;
        $this->nomorAkun = '';

        Notification::make()
            ->title('Berhasil!')
            ->success()
            ->body('Pengajuan withdrawal sebesar Rp ' . number_format($rupiah, 0, ',', '.') . ' (' . $point . ' pts) sedang diproses. Maksimal 24 jam.')
            ->send();
    }

    public function getViewData(): array
    {
        $user = Auth::user();
        $balance = UserBalance::where('id_user', $user->id)->first();
        $currentPoints = $balance->point ?? 0;

        // Format denominasi untuk view
        $denominations = collect(Withdraw::DENOMINATIONS)->map(function ($d) {
            return [
                'point'      => $d['point'],
                'rupiah'     => $d['rupiah'],
                'rupiahF'    => 'Rp ' . number_format($d['rupiah'], 0, ',', '.'),
                'pointLabel' => number_format($d['point']) . ' Pts',
            ];
        })->toArray();

        // Riwayat withdraw
        $riwayat = Withdraw::where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($w) {
                return [
                    'id'        => $w->id,
                    'point'     => $w->point,
                    'rupiah'    => $w->rupiah,
                    'rupiahF'   => 'Rp ' . number_format($w->rupiah, 0, ',', '.'),
                    'metode'    => Withdraw::METHODS[$w->metode] ?? $w->metode,
                    'nomorAkun' => $w->nomor_akun,
                    'status'    => $w->status,
                    'tanggal'   => $w->created_at->format('d M Y'),
                    'waktu'     => $w->created_at->format('H:i'),
                    'catatan'   => $w->catatan,
                    'image'     => $w->image ? asset('storage/' . $w->image) : null,
                ];
            })->toArray();

        // Estimasi rupiah dari total point
        $estimasiRupiah = Withdraw::pointToRupiah($currentPoints);

        return [
            'namaTester'    => $user->name,
            'totalPoin'     => $currentPoints,
            'estimasiRupiah' => 'Rp ' . number_format($estimasiRupiah, 0, ',', '.'),
            'denominations' => $denominations,
            'methods'       => Withdraw::METHODS,
            'minPoint'      => Withdraw::MIN_POINT,
            'ratePerPoint'  => Withdraw::RATE_PER_POINT,
            'riwayat'       => $riwayat,
        ];
    }
}
