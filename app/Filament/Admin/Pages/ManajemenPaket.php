<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class ManajemenPaket extends Page
{
    protected static ?string $navigationLabel = 'Manajemen Paket';
    protected static ?string $title = 'Manajemen Paket';
    protected static ?string $slug = 'manajemen-paket';
    protected string $view = 'filament.admin.pages.manajemen-paket';

    public function savePaket($id, $harga, $point, $descText, $aktif)
    {
        $paket = \App\Models\Paket::find($id);
        if ($paket) {
            if ($harga)
                $paket->price = $harga;
            if ($point)
                $paket->point = $point;
            $paket->desc = $descText;
            $paket->aktif = (bool) $aktif;
            $paket->save();
        }
    }

    protected function getViewData(): array
    {
        $pakets = \App\Models\Paket::withCount([
            'pembayarans' => function ($q) {
                $q->where('status', 'success');
            }
        ])->get();

        $paketList = [];
        $totalPendapatan = 0;
        $totalAktif = 0;

        foreach ($pakets as $index => $p) {
            $warnaData = [
                ['primary' => '#64748b', 'grad' => 'from-slate-500 to-slate-400', 'bg' => '#f8fafc', 'border' => '#e2e8f0'],
                ['primary' => '#2563eb', 'grad' => 'from-blue-600 to-blue-400', 'bg' => '#eff6ff', 'border' => '#bfdbfe'],
                ['primary' => '#7c3aed', 'grad' => 'from-violet-600 to-purple-400', 'bg' => '#fdf4ff', 'border' => '#e9d5ff'],
            ];
            $w = $warnaData[$index % 3];

            $subscriberCount = $p->pembayarans_count;
            $pendapatan = $p->price * $subscriberCount;
            $totalPendapatan += $pendapatan;
            $totalAktif++;

            $fitur = explode("\n", $p->desc);
            $fitur = array_filter(array_map('trim', $fitur));

            $paketList[] = [
                'db_id' => $p->id,
                'id' => 'PKT-' . str_pad($p->id, 3, '0', STR_PAD_LEFT),
                'nama' => $p->name,
                'slug' => strtolower(str_replace(' ', '-', $p->name)),
                'harga' => (float) $p->price,
                'hargaF' => 'Rp ' . number_format($p->price, 0, ',', '.'),
                'deskripsi' => 'Paket ' . $p->name . ' untuk pengujian aplikasi.',
                'rawDesc' => $p->desc,
                'badge' => $p->most_popular ? 'Terpopuler' : ($index == 2 ? 'Premium' : ''),
                'warnaPrimary' => $w['primary'],
                'warnaGrad' => $w['grad'],
                'warnaBg' => $w['bg'],
                'warnaBorder' => $w['border'],
                'maxTester' => $p->point ?: 10,
                'durasiHari' => 14,
                'maxRevisi' => $p->most_popular ? 3 : ($index == 2 ? 99 : 1),
                'laporan' => $p->most_popular ? 'Detail + Analitik' : ($index == 2 ? 'Lengkap + Export' : 'Dasar'),
                'prioritasReview' => $p->most_popular ? 'Prioritas' : ($index == 2 ? 'Sangat Prioritas' : 'Normal'),
                'support' => $p->most_popular ? 'Email & Chat' : ($index == 2 ? 'Dedicated' : 'Email'),
                'status' => $p->aktif ? 'Active' : 'Non Active',
                'is_aktif' => $p->aktif,
                'totalSubscriber' => $subscriberCount,
                'pendapatanTotal' => 'Rp ' . number_format($pendapatan, 0, ',', '.'),
                'fitur' => count($fitur) > 0 ? $fitur : ['Hingga ' . ($p->point ?: 10) . ' Tester', 'Laporan dasar'],
                'bukan' => []
            ];
        }

        $subs = \App\Models\Pembayaran::with(['user', 'paket', 'misi'])->latest()->get();
        $subscriberList = [];
        $totalSubs = 0;

        foreach ($subs as $s) {
            if (!$s->user || !$s->paket)
                continue;

            $nama = $s->user->name ?? 'User Unknown';
            $inisial = strtoupper(substr($nama, 0, 2));

            // Generate consistent color based on name
            $colors = [
                'from-blue-500 to-cyan-400',
                'from-emerald-500 to-teal-400',
                'from-violet-500 to-purple-400',
                'from-orange-500 to-amber-400',
                'from-rose-500 to-pink-400',
                'from-sky-500 to-cyan-400'
            ];
            $color = $colors[crc32($nama) % count($colors)];

            $statusStr = 'Aktif';
            if ($s->status === 'pending')
                $statusStr = 'Review';
            else if ($s->status === 'failed' || $s->status === 'refund')
                $statusStr = 'Selesai';

            if ($s->status === 'success')
                $totalSubs++;

            $subscriberList[] = [
                'nama' => $nama,
                'inisial' => $inisial,
                'avatarColor' => $color,
                'paket' => $s->paket->name,
                'kampanye' => $s->misi ? $s->misi->name : 'N/A',
                'status' => $statusStr,
                'tanggal' => $s->created_at->format('j M Y'),
            ];
        }

        return [
            'statTotalPaket' => count($pakets),
            'statPaketAktif' => $pakets->where('aktif', true)->count(),
            'statTotalSubscriber' => $totalSubs,
            'statPendapatan' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'),
            'paketList' => $paketList,
            'subscriberList' => $subscriberList,
        ];
    }
}