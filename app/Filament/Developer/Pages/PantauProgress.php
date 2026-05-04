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

        if (!$this->selectedMisiId) {
            $misiList = Misi::where('id_user', $userId)->where('status', 'running')->latest()->get();
            return [
                'isDetail' => false,
                'misiList' => $misiList,
            ];
        }

        $misi = Misi::where('id_user', $userId)->find($this->selectedMisiId);
        
        if (!$misi) {
            $this->selectedMisiId = null;
            return $this->getViewData();
        }

        $misiAnggotas = MisiAnggota::where('id_misi', $misi->id)
            ->with(['user'])
            ->latest()
            ->get();

        $misiSubs = MisiSub::where('id_misi', $misi->id)->get()->groupBy('id_user');

        $kampanyeList = [];

        foreach ($misiAnggotas as $ma) {
            $u = $ma->user;
            if (!$u) continue;

            $subs = $misiSubs->get($u->id, collect());
            
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
                $diff = $misi->created_at->diffInDays(now());
                $hariAktif = min($diff + 1, 14);
            }

            $colors = ['blue', 'amber', 'purple', 'green'];
            $warna = $colors[$misi->id % count($colors)];

            $kampanyeList[] = [
                'id' => $ma->id,
                'misi_nama' => $misi->nama_aplikasi,
                'tester_nama' => $u->name,
                'inisial' => strtoupper(substr($misi->nama_aplikasi, 0, 1) . substr($u->name, 0, 1)),
                'warna' => $warna,
                'status' => $ma->status,
                'hariAktif' => $hariAktif,
                'days' => $days,
            ];
        }

        return [
            'isDetail' => true,
            'misiDetail' => $misi,
            'kampanyeList' => $kampanyeList,
        ];
    }
}
