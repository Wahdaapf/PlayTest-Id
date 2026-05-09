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
                $this->checkAndFinishMission($sub->id_misi, $sub->id_user);
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
            $this->checkAndFinishMission($sub->id_misi, $sub->id_user);
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
            $subs = MisiSub::where('id_misi', $this->selectedMisiId)
                ->where('status', 'pending')
                ->get();

            foreach ($subs as $sub) {
                $sub->update(['status' => 'done']);
                $this->checkAndFinishMission($sub->id_misi, $sub->id_user);
            }
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
                $currentSub = MisiSub::where('id_misi', $misi->id)
                    ->where('id_user', $ma->id_user)
                    ->whereDate('created_at', now()->toDateString())
                    ->first();
                $hariAktif = $currentSub ? $currentSub->hari_ke : 1;
            }

            $colors = ['blue', 'amber', 'purple', 'green'];
            $warna = $colors[$misi->id % count($colors)];

            $kampanyeList[] = [
                'id' => $ma->id,
                'misi_nama' => $misi->nama_aplikasi,
                'tester_nama' => $u->name,
                'logo' => $misi->logo,
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

        // Hitung hari_ke untuk hari ini
        $currentSubToday = MisiSub::where('id_misi', $misi->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if ($currentSubToday) {
            $hariToday = $currentSubToday->hari_ke;
        } else {
            // Jika hari ini tidak ada di jadwal, kita cek apakah sudah melewati jadwal hari ke-14
            $lastSub = MisiSub::where('id_misi', $misi->id)->where('hari_ke', 14)->first();
            if ($lastSub && now()->isAfter($lastSub->created_at)) {
                $hariToday = 15; // Menandakan sudah lewat masa 14 hari
            } else {
                $hariToday = 1;
            }
        }

        // Cek apakah sudah ada minimal 1 tester yang menyelesaikan seluruh 14 hari (status done)
        $hasOneCompletedUser = MisiSub::where('id_misi', $misi->id)
            ->where('status', 'done')
            ->select('id_user')
            ->groupBy('id_user')
            ->havingRaw('COUNT(*) >= 14')
            ->exists();

        return [
            'isDetail' => true,
            'misiDetail' => $misi,
            'kampanyeList' => $kampanyeList,
            'pendingSubmissions' => $pendingSubmissions,
            'hariToday' => $hariToday,
            'hasOneCompletedUser' => $hasOneCompletedUser,
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

            // Ambil hari_ke hari ini dari jadwal misi_sub
            $currentSub = MisiSub::where('id_user', $ma->id_user)
                ->where('id_misi', $misi->id)
                ->whereDate('created_at', $today)
                ->first();

            if (!$currentSub) {
                continue;
            }

            $hariToday = $currentSub->hari_ke;
            $hariYesterday = $hariToday - 1;

            // Jika hari kemarin masuk dalam rentang 14 hari kampanye
            if ($hariYesterday >= 1 && $hariYesterday <= 14) {
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

    /**
     * Cek apakah tester sudah menyelesaikan seluruh 14 hari tugas.
     * Jika ya, cairkan poin dan ubah status menjadi selesai.
     */
    protected function checkAndFinishMission($misiId, $userId)
    {
        $ma = MisiAnggota::where('id_misi', $misiId)
            ->where('id_user', $userId)
            ->first();

        // Hanya proses jika status masih aktif (accepted/progress)
        if (!$ma || !in_array($ma->status, ['accepted', 'progress'])) {
            return;
        }

        // Hitung jumlah tugas yang sudah 'done'
        $doneCount = MisiSub::where('id_misi', $misiId)
            ->where('id_user', $userId)
            ->where('status', 'done')
            ->count();

        if ($doneCount >= 14) {
            // 1. Update status anggota menjadi selesai
            $ma->update(['status' => 'selesai']);

            // 2. Cairkan poin ke balance user
            $misi = Misi::find($misiId);
            if ($misi && $misi->point > 0) {
                $balance = \App\Models\UserBalance::firstOrCreate(
                    ['id_user' => $userId],
                    ['point' => 0]
                );
                $balance->increment('point', $misi->point);
            }

            // 3. (Opsional) Kirim notifikasi ke tester bisa ditambahkan di sini
        }
    }

    public function finishMission()
    {
        if (!$this->selectedMisiId) return;

        $misi = Misi::find($this->selectedMisiId);
        if (!$misi) return;

        // 1. Ambil semua tester yang masih aktif (accepted/progress)
        $testers = MisiAnggota::where('id_misi', $misi->id)
            ->whereIn('status', ['accepted', 'progress'])
            ->get();

        foreach ($testers as $ma) {
            // 2. Jadikan semua sisa pending menjadi done (jika ada)
            MisiSub::where('id_misi', $misi->id)
                ->where('id_user', $ma->id_user)
                ->where('status', 'pending')
                ->update(['status' => 'done']);

            // 3. Update status anggota menjadi selesai
            $ma->update(['status' => 'selesai']);

            // 4. Cairkan poin & Tambah badge
            if ($misi->point > 0) {
                // Pastikan record balance ada, jika belum ada buat baru
                \App\Models\UserBalance::updateOrInsert(
                    ['id_user' => $ma->id_user],
                    ['updated_at' => now()]
                );
                
                // Tambah point & badge secara direct ke database
                \DB::table('user_balance')->where('id_user', $ma->id_user)->increment('point', $misi->point);
                \DB::table('user_balance')->where('id_user', $ma->id_user)->increment('badge', 1);
            }
        }

        // 5. Update status misi menjadi selesai
        $misi->update(['status' => 'selesai']);

        $this->selectedMisiId = null;

        \Filament\Notifications\Notification::make()
            ->title('Misi Berhasil Diselesaikan!')
            ->success()
            ->body('Seluruh tester aktif telah menerima poin dan badge.')
            ->send();
    }
}
