<?php

namespace App\Filament\Developer\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class PantauProgress extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Pantau Progress';
    protected static ?string $title = 'Pantau Progress Tester';
    protected static ?string $slug = 'pantau-progress';
    protected static bool $shouldRegisterNavigation = false; 

    protected string $view = 'filament.developer.pages.pantau-progress';

    public ?int $selectedMisiId = null;

    protected function getViewData(): array
    {
        $userId = Auth::id();
        
        // Ambil semua misi (sementara agar cocok dengan tabel Manajemen Kampanye yang belum difilter per-user)
        $misiList = Misi::all();
        $misiIds = $misiList->pluck('id');

        $query = MisiAnggota::whereIn('id_misi', $misiIds)
            ->with(['misi', 'user'])
            ->latest();

        if ($this->selectedMisiId) {
            $query->where('id_misi', $this->selectedMisiId);
        }

        $misiAnggotas = $query->get();

        $misiSubs = MisiSub::whereIn('id_misi', $misiIds)->get()->groupBy(function($item) {
            return $item->id_misi . '-' . $item->id_user;
        });

        $kampanyeList = [];

        foreach ($misiAnggotas as $ma) {
            $m = $ma->misi;
            $u = $ma->user;
            if (!$m || !$u) continue;

            $subs = $misiSubs->get($m->id . '-' . $u->id, collect());
            
            $days = [];
            for ($h = 1; $h <= 14; $h++) {
                $sub = $subs->firstWhere('hari_ke', $h);
                if ($sub) {
                    $days[$h] = $sub->status;
                } else {
                    $days[$h] = 'notdone';
                }
            }

            $hariAktif = 1;
            $today = now()->format('Y-m-d');
            foreach ($subs as $sub) {
                if ($sub->created_at && $sub->created_at->format('Y-m-d') === $today) {
                    $hariAktif = $sub->hari_ke;
                    break;
                }
            }

            if ($hariAktif === 1) {
                $diff = $m->created_at->diffInDays(now());
                $hariAktif = min($diff + 1, 14);
            }

            $colors = ['blue', 'amber', 'purple', 'green'];
            $warna = $colors[$m->id % count($colors)];

            $kampanyeList[] = [
                'id' => $ma->id,
                'misi_nama' => $m->nama_aplikasi,
                'tester_nama' => $u->name,
                'inisial' => strtoupper(substr($m->nama_aplikasi, 0, 1) . substr($u->name, 0, 1)),
                'warna' => $warna,
                'status' => $ma->status,
                'hariAktif' => $hariAktif,
                'days' => $days,
            ];
        }

        return [
            'kampanyeList' => $kampanyeList,
            'misiDropdown' => $misiList->pluck('nama_aplikasi', 'id')->toArray(),
        ];
    }
}
