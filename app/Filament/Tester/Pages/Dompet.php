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

    // Reactive riwayat list (public agar Alpine bisa entangle)
    public array $riwayat = [];

    public function mount(): void
    {
        $this->loadRiwayat();
    }

    /**
     * Load / refresh riwayat withdraw untuk user yang sedang login
     */
    public function loadRiwayat(): void
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $this->riwayat = Withdraw::where('id_user', $user->id)
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
            })
            ->toArray();
    }

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
            'id'               => $w->id,
            'point'            => $w->point,
            'rupiah'           => $w->rupiah,
            'rupiahF'          => 'Rp ' . number_format($w->rupiah, 0, ',', '.'),
            'metode'           => Withdraw::METHODS[$w->metode] ?? $w->metode,
            'metodeKey'        => $w->metode,
            'nomorAkun'        => $w->nomor_akun,
            'xendit_payout_id' => $w->xendit_payout_id,
            'status'           => $w->status,
            'catatan'          => $w->catatan,
            'tanggal'          => $w->created_at->format('d M Y'),
            'waktu'            => $w->created_at->format('H:i'),
            'adminNama'        => $w->admin ? $w->admin->name : '-',
            'image'            => $w->image ? asset('storage/' . $w->image) : null,
            'updatedAt'        => $w->updated_at->format('d M Y H:i'),
        ];

        $this->dispatch('open-invoice-modal');
    }

    public function closeInvoice(): void
    {
        $this->invoiceDetail = null;
    }

    /**
     * Synchronize the status of a pending withdrawal with Xendit
     */
    public function syncStatus(int $id): void
    {
        $user = Auth::user();
        $withdraw = Withdraw::where('id', $id)->where('id_user', $user->id)->first();

        if (!$withdraw || !$withdraw->xendit_payout_id) {
            Notification::make()
                ->title('Gagal')
                ->danger()
                ->body('Data transaksi tidak valid atau tidak memiliki Xendit Payout ID.')
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
                    'catatan' => 'Withdrawal completed via Xendit.',
                ]);
                Notification::make()
                    ->title('Berhasil!')
                    ->success()
                    ->body('Withdrawal Anda sebesar Rp ' . number_format($withdraw->rupiah, 0, ',', '.') . ' telah sukses dikirim.')
                    ->send();
            } elseif ($status === 'FAILED' || $status === 'REJECTED') {
                \Illuminate\Support\Facades\DB::transaction(function () use ($withdraw, $payout) {
                    $balance = UserBalance::where('id_user', $withdraw->id_user)->first();
                    if ($balance) {
                        $balance->increment('point', $withdraw->point);
                    }
                    $withdraw->update([
                        'status' => 'rejected',
                        'catatan' => 'Xendit payout failed: ' . ($payout['failure_code'] ?? 'Unknown Reason'),
                    ]);
                });

                Notification::make()
                    ->title('Pencairan Gagal')
                    ->danger()
                    ->body('Transaksi gagal. Point sebesar ' . $withdraw->point . ' telah dikembalikan ke saldo Anda.')
                    ->send();
            } else {
                Notification::make()
                    ->title('Sedang Diproses')
                    ->info()
                    ->body('Transaksi masih diproses oleh Xendit (Status: ' . $status . '). Silakan cek kembali nanti.')
                    ->send();
            }

            // Refresh modal data + list riwayat
            $this->loadRiwayat();
            $this->showInvoice($withdraw->id);
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal Sinkronisasi')
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
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

        // Gunakan DB Transaction untuk menjamin konsistensi data
        try {
            $withdraw = \Illuminate\Support\Facades\DB::transaction(function () use ($user, $balance, $point, $rupiah) {
                // Kurangi point user
                $balance->decrement('point', $point);

                // Buat record withdraw
                return Withdraw::create([
                    'id_user'    => $user->id,
                    'point'      => $point,
                    'rupiah'     => $rupiah,
                    'metode'     => $this->selectedMethod,
                    'nomor_akun' => trim($this->nomorAkun),
                    'status'     => 'pending',
                ]);
            });

            // Call Xendit to perform disbursement/payout
            $xenditService = app(\App\Services\XenditService::class);
            $payout = $xenditService->createPayout([
                'reference_id' => 'WD-' . date('Ymd') . '-' . $withdraw->id,
                'channel_code' => 'ID_' . strtoupper($this->selectedMethod),
                'account_number' => trim($this->nomorAkun),
                'account_holder_name' => $user->name,
                'amount' => $rupiah,
                'description' => 'Penarikan Saldo PlayTest ID - ' . $user->name,
            ]);

            // Update database dengan response dari Xendit
            $xenditStatus = strtoupper($payout['status']);
            $finalStatus = 'pending';
            $catatan = 'Disbursement initiated via Xendit.';

            if ($xenditStatus === 'COMPLETED' || $xenditStatus === 'SUCCEEDED') {
                $finalStatus = 'success';
                $catatan = 'Withdrawal completed via Xendit.';
            } elseif ($xenditStatus === 'FAILED' || $xenditStatus === 'REJECTED') {
                $finalStatus = 'rejected';
                $catatan = 'Xendit payout failed: ' . ($payout['failure_code'] ?? 'Unknown Reason');

                // Refund points
                \Illuminate\Support\Facades\DB::transaction(function () use ($balance, $point) {
                    $balance->increment('point', $point);
                });

                throw new \Exception('Xendit Payout failed directly: ' . ($payout['failure_code'] ?? 'Unknown'));
            }

            $withdraw->update([
                'xendit_payout_id' => $payout['id'] ?? $payout['payout_id'] ?? null,
                'status'           => $finalStatus,
                'catatan'          => $catatan,
            ]);

            // Reset form
            $this->selectedDenom = null;
            $this->nomorAkun = '';

            if ($finalStatus === 'success') {
                Notification::make()
                    ->title('Berhasil!')
                    ->success()
                    ->body('Pengajuan withdrawal sebesar Rp ' . number_format($rupiah, 0, ',', '.') . ' telah berhasil dicairkan!')
                    ->send();
            } else {
                Notification::make()
                    ->title('Pengajuan Dibuat')
                    ->success()
                    ->body('Pengajuan withdrawal sebesar Rp ' . number_format($rupiah, 0, ',', '.') . ' (' . $point . ' pts) sedang diproses.')
                    ->send();
            }

            // Refresh riwayat agar data baru langsung muncul tanpa reload halaman
            $this->loadRiwayat();

        } catch (\Exception $e) {
            // Jika transaksi gagal di tahap apa pun setelah record dibuat, refund points & tolak
            if (isset($withdraw)) {
                \Illuminate\Support\Facades\DB::transaction(function () use ($balance, $withdraw, $point, $e) {
                    // Cek apakah poin sudah didecrement, jika iya kembalikan
                    // (Tapi karena $withdraw dibuat di dalam DB transaction, jika error terjadi SEBELUM commit,
                    // data tidak tersimpan. Namun jika error terjadi setelah commit [saat hit API], maka kita kembalikan poin di sini)
                    $balance->increment('point', $point);
                    $withdraw->update([
                        'status' => 'rejected',
                        'catatan' => 'Gagal memproses via Xendit: ' . $e->getMessage()
                    ]);
                });
            }

            Notification::make()
                ->title('Gagal Melakukan Penarikan')
                ->danger()
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->send();

            // Refresh riwayat so the failed withdrawal immediately shows up as rejected
            $this->loadRiwayat();
        }
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

        // Riwayat dikelola sebagai public property ($this->riwayat) agar reaktif di Alpine

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
        ];
    }
}
