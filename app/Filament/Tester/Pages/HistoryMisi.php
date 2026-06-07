<?php

namespace App\Filament\Tester\Pages;

use App\Models\MisiAnggota;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class HistoryMisi extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clock';

    protected string $view = 'filament.tester.pages.history-misi';

    protected static ?string $navigationLabel = 'History Misi';

    protected static ?string $title = 'History Misi';

    protected static string | \UnitEnum | null $navigationGroup = 'Menu';

    protected static ?int $navigationSort = 3;

    public function getViewData(): array
    {
        $userId = Auth::id();

        $records = MisiAnggota::where('id_user', $userId)
            ->with('misi')
            ->orderBy('created_at', 'desc')
            ->get();

        $history = $records->map(function ($ma) {
            $misi = $ma->misi;
            if (!$misi) return null;

            $statusConfig = match ($ma->status) {
                'selesai'   => ['label' => 'Selesai',    'color' => '#10b981', 'bg' => '#ecfdf5', 'icon' => '✅'],
                'progress'  => ['label' => 'Berlangsung','color' => '#f59e0b', 'bg' => '#fffbeb', 'icon' => '🔄'],
                'accepted'  => ['label' => 'Diterima',   'color' => '#3b82f6', 'bg' => '#eff6ff', 'icon' => '👍'],
                'failed'    => ['label' => 'Gagal',       'color' => '#ef4444', 'bg' => '#fef2f2', 'icon' => '❌'],
                'submitted' => ['label' => 'Menunggu',   'color' => '#8b5cf6', 'bg' => '#f5f3ff', 'icon' => '⏳'],
                'rejected'  => ['label' => 'Ditolak',    'color' => '#64748b', 'bg' => '#f8fafc', 'icon' => '🚫'],
                'pending'   => ['label' => 'Pending',    'color' => '#f59e0b', 'bg' => '#fffbeb', 'icon' => '⏳'],
                default     => ['label' => ucfirst($ma->status), 'color' => '#64748b', 'bg' => '#f8fafc', 'icon' => '•'],
            };

            $gradients = [
                'linear-gradient(135deg,#f59e0b,#ef4444)',
                'linear-gradient(135deg,#8b5cf6,#6366f1)',
                'linear-gradient(135deg,#10b981,#0ea5e9)',
                'linear-gradient(135deg,#ef4444,#f97316)',
            ];

            return [
                'id'            => $ma->id,
                'misi_id'       => $misi->id,
                'nama'          => $misi->nama_aplikasi,
                'inisial'       => strtoupper(substr($misi->nama_aplikasi, 0, 2)),
                'logo'          => $misi->logo,
                'gradient'      => $gradients[$misi->id % count($gradients)],
                'point'         => $misi->point,
                'status'        => $ma->status,
                'statusLabel'   => $statusConfig['label'],
                'statusColor'   => $statusConfig['color'],
                'statusBg'      => $statusConfig['bg'],
                'statusIcon'    => $statusConfig['icon'],
                'joinedAt'      => $ma->created_at?->format('d M Y'),
                'tipe'          => $misi->id % 2 === 0 ? 'Functional Testing' : 'UX Research',
            ];
        })->filter()->values()->toArray();

        $total    = count($history);
        $selesai  = collect($history)->where('status', 'selesai')->count();
        $gagal    = collect($history)->where('status', 'failed')->count();
        $aktif    = collect($history)->whereIn('status', ['accepted', 'progress'])->count();

        return compact('history', 'total', 'selesai', 'gagal', 'aktif');
    }
}
