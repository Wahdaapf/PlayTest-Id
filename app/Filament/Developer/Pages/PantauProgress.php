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
    public ?array $selectedSubData = null;

    public function openValidationModal($subId, $testerNama, $hariKe)
    {
        $sub = MisiSub::find($subId);
        if ($sub) {
            $this->selectedSubData = [
                'id' => $sub->id,
                // Gunakan relative path agar tidak terkendala APP_URL di .env saat artisan serve
                'image' => '/storage/' . $sub->image,
                'tester_nama' => $testerNama,
                'hari_ke' => $hariKe,
                'status' => $sub->status,
                'desc' => $sub->desc,
            ];
        }
    }

    public function closeValidationModal()
    {
        $this->selectedSubData = null;
    }

    public function acceptSubmission()
    {
        if ($this->selectedSubData) {
            $sub = MisiSub::find($this->selectedSubData['id']);
            if ($sub) {
                $sub->update(['status' => 'done']);
            }
            $this->closeValidationModal();
        }
    }

    public function rejectSubmission()
    {
        if ($this->selectedSubData) {
            $sub = MisiSub::find($this->selectedSubData['id']);
            if ($sub) {
                $sub->update(['status' => 'rejected']);
            }
            $this->closeValidationModal();
        }
    }

    public function acceptDirect($subId)
    {
        $sub = MisiSub::find($subId);
        if ($sub) {
            $sub->update(['status' => 'done']);
        }
    }

    public function rejectDirect($subId)
    {
        $sub = MisiSub::find($subId);
        if ($sub) {
            $sub->update(['status' => 'rejected']);
        }
    }

    public function acceptAllPending()
    {
        if ($this->selectedMisiId) {
            MisiSub::where('id_misi', $this->selectedMisiId)
                ->where('status', 'pending')
                ->update(['status' => 'done']);
        }
    }

    public function rejectAllPending()
    {
        if ($this->selectedMisiId) {
            MisiSub::where('id_misi', $this->selectedMisiId)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        }
    }

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

        $semuaSubs = MisiSub::where('id_misi', $misi->id)->where('status', '!=', 'notdone')->latest()->get();

        $kampanyeList = [];

        foreach ($misiAnggotas as $ma) {
            $u = $ma->user;
            if (!$u) continue;

            $subs = $semuaSubs->where('id_user', $u->id);
            
            $days = [];
            for ($h = 1; $h <= 14; $h++) {
                $sub = $subs->firstWhere('hari_ke', $h);
                if ($sub) {
                    $days[$h] = [
                        'status' => $sub->status,
                        'sub_id' => $sub->id,
                    ];
                } else {
                    $days[$h] = ['status' => 'notdone'];
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
                $hariAktif = min((int) $diff + 1, 14);
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

        // Ambil semua submission yang butuh validasi (pending)
        $pendingSubmissions = MisiSub::where('id_misi', $misi->id)
            ->where('status', 'pending')
            ->with('user')
            ->latest()
            ->get()
            ->map(function ($sub) {
                return [
                    'id' => $sub->id,
                    'tester_nama' => $sub->user->name ?? 'Unknown',
                    'hari_ke' => $sub->hari_ke,
                    'image' => '/storage/' . $sub->image,
                    'waktu' => $sub->created_at ? $sub->created_at->diffForHumans() : '',
                ];
            })->toArray();

        return [
            'isDetail' => true,
            'misiDetail' => $misi,
            'kampanyeList' => $kampanyeList,
            'pendingSubmissions' => $pendingSubmissions,
        ];
    }
}
