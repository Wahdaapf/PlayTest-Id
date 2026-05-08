<?php

namespace App\Filament\Developer\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        // ── 0. Cek Absensi Seluruh Tester Kemarin (H-1) ────────
        $this->checkTestersProgress($misi);

        $misiAnggotas = MisiAnggota::where('id_misi', $misi->id)
            ->where('status', '!=', 'rejected')
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

    /**
     * Mengecek apakah ada tester yang melewatkan submit misi kemarin.
     */
    protected function checkTestersProgress(Misi $misi)
    {
        $today     = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        // Ambil semua anggota yang masih aktif (accepted)
        $misiAnggotas = MisiAnggota::where('id_misi', $misi->id)
            ->where('status', 'accepted')
            ->get();

        foreach ($misiAnggotas as $ma) {
            // Hanya cek jika tester sudah join sebelum hari ini
            $joinDate = $ma->created_at->toDateString();
            if ($joinDate >= $today) {
                continue;
            }

            // Hitung hari_ke saat user ini bergabung
            $diffJoin = Carbon::parse($misi->created_at)->startOfDay()->diffInDays(Carbon::parse($ma->created_at)->startOfDay());
            $hariJoin = (int) $diffJoin + 1;

            // Hitung hari_ke untuk kemarin (H-1)
            $diffYesterday = Carbon::parse($misi->created_at)->startOfDay()->diffInDays(Carbon::yesterday()->startOfDay());
            $hariYesterday = (int) $diffYesterday + 1;

            // Jika hari kemarin masuk dalam masa aktif tester dan dalam rentang 14 hari kampanye
            if ($hariYesterday >= $hariJoin && $hariYesterday <= 14) {
                // Cek apakah ada submission untuk hari tersebut
                $sub = MisiSub::where('id_user', $ma->id_user)
                    ->where('id_misi', $misi->id)
                    ->where('hari_ke', $hariYesterday)
                    ->first();

                // Jika tidak ada atau statusnya masih 'notdone', maka status tester di misi tersebut diubah jadi failed
                if (!$sub || $sub->status === 'notdone') {
                    $ma->update(['status' => 'failed']);
                    
                    // Kurangi kapasitas misi (tester berkurang)
                    $misi->decrement('kapasitas');
                    
                    // Jika misi sebelumnya closed karena penuh, buka kembali
                    if ($misi->status === 'closed') {
                        $misi->update(['status' => 'open']);
                    }
                }
            }
        }
    }
}
