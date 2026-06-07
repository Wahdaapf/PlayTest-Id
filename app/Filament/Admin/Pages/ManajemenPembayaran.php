<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class ManajemenPembayaran extends Page
{
    public static function getNavigationLabel(): string
    {
        return __('Pembayaran Developer');
    }

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        return __('Transaksi Developer');
    }

    protected static ?string $slug = 'manajemen-pembayaran';
    protected string $view = 'filament.admin.pages.manajemen-pembayaran';

    protected function getViewData(): array
    {
        $pembayarans = \App\Models\Pembayaran::with(['user', 'paket', 'misi'])->orderBy('created_at', 'desc')->get();

        $transaksiList = [];
        $totalPendapatan = 0;
        $pendapatanBulanIni = 0;
        $pendapatanBulanLalu = 0;
        $statBerhasil = 0;
        $statPending = 0;
        $statGagal = 0;

        $berhasilBulanIni = 0;
        $pendingMingguIni = 0;

        foreach ($pembayarans as $p) {
            $userNama = $p->user ? $p->user->name : 'Unknown User';
            $inisial = substr(str_replace(' ', '', $userNama), 0, 2);
            $avatarColors = ['from-blue-500 to-cyan-400', 'from-emerald-500 to-teal-400', 'from-violet-500 to-purple-400', 'from-orange-500 to-amber-400', 'from-pink-500 to-rose-400'];
            $avatarColor = $avatarColors[crc32($userNama) % count($avatarColors)];

            $paketNama = $p->paket ? $p->paket->name : 'Unknown';
            $jumlah = $p->paket ? ($p->paket->price + ($p->paket->fee ?? 0)) : 0;

            // Map status dari Duitku callback
            $statusUI = __('Menunggu Bayar');
            if ($p->status === 'accepted' || $p->status === 'success') {
                $statusUI = __('Berhasil');
                $statBerhasil++;
                $totalPendapatan += $jumlah;
                if ($p->created_at && $p->created_at->format('Y-m') === now()->format('Y-m')) {
                    $pendapatanBulanIni += $jumlah;
                }
                if ($p->created_at && $p->created_at->format('Y-m') === now()->subMonth()->format('Y-m')) {
                    $pendapatanBulanLalu += $jumlah;
                }
                if ($p->created_at && $p->created_at->format('Y-m') === now()->format('Y-m')) {
                    $berhasilBulanIni++;
                }
            } elseif ($p->status === 'pending') {
                $statusUI = __('Menunggu Bayar');
                $statPending++;
                if ($p->created_at && $p->created_at >= now()->startOfWeek()) {
                    $pendingMingguIni++;
                }
            } elseif ($p->status === 'rejected' || $p->status === 'failed') {
                $statusUI = __('Gagal');
                $statGagal++;
            }

            $dateObj = $p->created_at ? $p->created_at : now();

            $transaksiList[] = [
                'db_id' => $p->id,
                'id' => 'TRX-' . $dateObj->format('Y') . '-' . str_pad($p->id, 4, '0', STR_PAD_LEFT),
                'invoice' => 'INV/' . $dateObj->format('Y/m') . '/' . str_pad($p->id, 4, '0', STR_PAD_LEFT),
                'namaUser' => $userNama,
                'inisial' => strtoupper($inisial),
                'avatarColor' => $avatarColor,
                'kampanye' => $p->misi ? $p->misi->app_name : ($p->paket ? $p->paket->desc : 'Unknown'),
                'paket' => $paketNama,
                'jumlah' => $jumlah,
                'reference' => $p->reference ?? '-',
                'paymentUrl' => $p->payment_url ?? null,
                'gateway' => 'Duitku',
                'status' => $statusUI,
                'tanggal' => $dateObj->format('d M Y'),
                'waktu' => $dateObj->format('H:i'),
            ];
        }

        // Growth calculation (real)
        $growthPendapatan = $pendapatanBulanLalu > 0
            ? round((($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100)
            : ($pendapatanBulanIni > 0 ? 100 : 0);
        $growthPrefix = $growthPendapatan >= 0 ? '+' : '';

        // Chart bulanan (6 bulan terakhir)  
        $chartBulan = [];
        $chartNilai = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $bulanIndo = [__('Jan'), __('Feb'), __('Mar'), __('Apr'), __('Mei'), __('Jun'), __('Jul'), __('Agu'), __('Sep'), __('Okt'), __('Nov'), __('Des')];
            $chartBulan[] = $bulanIndo[(int) $date->format('n') - 1];

            $sum = collect($pembayarans)->filter(function ($p) use ($date) {
                return in_array($p->status, ['accepted', 'success']) && $p->created_at && $p->created_at->format('Y-m') === $date->format('Y-m');
            })->sum(function ($p) {
                return $p->paket ? ($p->paket->price + ($p->paket->fee ?? 0)) : 0;
            });
            $chartNilai[] = $sum > 0 ? $sum : 0;
        }

        return [
            /* ── Ringkasan Keuangan ── */
            'statTotalPendapatan' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'),
            'statBulanIni' => 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.'),
            'statBerhasil' => $statBerhasil,
            'statBerhasilBulanIni' => '+' . $berhasilBulanIni,
            'statPending' => $statPending,
            'statPendingMingguIni' => '+' . $pendingMingguIni,
            'statGagal' => $statGagal,
            'growthPendapatan' => $growthPrefix . $growthPendapatan . '%',

            /* ── Data chart bulanan (6 bulan) ── */
            'chartBulan' => $chartBulan,
            'chartNilai' => $chartNilai,

            /* ── Daftar Transaksi ── */
            'transaksiList' => $transaksiList,
        ];
    }
}