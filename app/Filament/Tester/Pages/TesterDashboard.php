<?php  
  
namespace App\Filament\Tester\Pages;  
  
use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use App\Models\UserBalance;
use Filament\Notifications\Notification;
use Filament\Pages\Page;  
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TesterDashboard extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon  = 'heroicon-o-home';  
    protected static ?string $navigationLabel = 'Home';  
    protected static ?string $title           = 'Tester Dashboard';  
    protected static string | \UnitEnum | null $navigationGroup = 'Menu';
    protected static ?int    $navigationSort  = 1;  
    protected string  $view            = 'filament.tester.pages.tester-dashboard';  
  
    public function applyMisi($misiId)
    {
        $misi = Misi::with('paket')->find($misiId);
        if (!$misi) return;

        // Cek apakah sudah bergabung
        if (MisiAnggota::where('id_user', Auth::id())->where('id_misi', $misiId)->exists()) {
            Notification::make()
                ->title('Peringatan')
                ->warning()
                ->body('Anda sudah bergabung dengan misi ini.')
                ->send();
            return;
        }

        // Status always accepted when applying
        $status = 'accepted';

        MisiAnggota::create([
            'id_misi' => $misiId,
            'id_user' => Auth::id(),
            'status'  => $status,
        ]);

        // Increment kapasitas (jumlah tester saat ini)
        $misi->increment('kapasitas');

        // Jika kapasitas mencapai batas maksimal, tutup misi
        $maxCapacity = config('missions.max_capacity', 20);
        if ($misi->kapasitas >= $maxCapacity) {
            $misi->update(['status' => 'closed']);
        }

        Notification::make()
            ->title('Berhasil!')
            ->success()
            ->body('Anda telah berhasil bergabung dengan misi ini.')
            ->send();
    }
  
    public function getViewData(): array  
    {  
        $user = Auth::user();
        
        // ── 0. Cek Absensi Misi Kemarin (H-1) ──────────────────
        $this->checkMissedSubmissions($user->id);

        $balance = UserBalance::where('id_user', $user->id)->first();
        
        // ── 1. Statistik Dasar ──────────────────────────────────
        $totalPoin   = $balance->point ?? 0;
        $misiSelesai = MisiAnggota::where('id_user', $user->id)->where('status', 'selesai')->count();
        $misiAktif   = MisiAnggota::where('id_user', $user->id)->whereIn('status', ['accepted', 'progress'])->count();
        
        // Poin Pending: Poin dari misi yang sedang dikerjakan atau menunggu verifikasi
        $poinPending = MisiAnggota::where('id_user', $user->id)
            ->whereIn('status', ['accepted', 'progress', 'submitted'])
            ->with('misi')
            ->get()
            ->sum(fn($ma) => $ma->misi->point ?? 0);

        // ── 2. Misi Aktif Saya ──────────────────────────────────
        $misiAktifList = MisiAnggota::where('id_user', $user->id)
            ->whereIn('status', ['accepted', 'progress'])
            ->with('misi')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($ma) use ($user) {
                $m = $ma->misi;
                
                // Hitung hari secara dinamis berdasarkan jadwal di misi_sub
                $currentSub = MisiSub::where('id_misi', $m->id)
                    ->where('id_user', $user->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->first();
                
                $hari = $currentSub ? $currentSub->hari_ke : 1;
                $persen = round(($hari / 14) * 100);

                // Warna & Gradasi berdasarkan ID agar variatif tapi tetap konsisten
                $gradients = [
                    ['icon' => 'linear-gradient(135deg,#f59e0b,#ef4444)', 'bar' => 'linear-gradient(90deg,#0ea5e9,#2563eb)'],
                    ['icon' => 'linear-gradient(135deg,#8b5cf6,#6366f1)', 'bar' => 'linear-gradient(90deg,#8b5cf6,#6366f1)'],
                    ['icon' => 'linear-gradient(135deg,#10b981,#0ea5e9)', 'bar' => 'linear-gradient(90deg,#10b981,#0ea5e9)'],
                ];
                $gId = $m->id % count($gradients);

                return [
                    'id'       => $m->id,
                    'logo'     => $m->logo,
                    'inisial'  => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                    'gradient' => $gradients[$gId]['icon'],
                    'nama'     => $m->nama_aplikasi,
                    'tipe'     => $m->id % 2 === 0 ? 'Functional Testing' : 'UX Research',
                    'hari'     => $hari,
                    'maxHari'  => 14,
                    'persen'   => $persen,
                    'warnaPersen' => '#2563eb',
                    'gradientBar' => $gradients[$gId]['bar'],
                    'reward'   => $m->point,
                    'status'   => 'Aktif',
                    'rawStatus' => $ma->status,
                    'aksi'     => $hari > 10 ? 'laporkan' : 'submit',
                ];
            })->toArray();

        // ── 3. Aplikasi Tersedia (Available Apps) ───────────────
        $joinedMisiIds = MisiAnggota::where('id_user', $user->id)->pluck('id_misi');
        
        $aplikasiList = Misi::where('status', 'open')
            ->whereNotIn('id', $joinedMisiIds)
            ->withCount('misiAnggotas')
            ->where(function($q) {
                // Tampilkan misi yang kapasitasnya (jumlah tester yang sudah gabung) 
                // masih di bawah batas maksimal (default 20).
                $maxCapacity = config('missions.max_capacity', 20);
                $q->where('kapasitas', '<', $maxCapacity);
            })
            ->with(['paket'])
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($m) {
                // Mapping kategori visual
                $categories = [
                    ['bg' => '#eff6ff', 'color' => '#2563eb', 'label' => 'Functional Testing'],
                    ['bg' => '#f5f3ff', 'color' => '#7c3aed', 'label' => 'UX Research'],
                    ['bg' => '#ecfdf5', 'color' => '#059669', 'label' => 'Bug Reporting'],
                ];
                $cat = $categories[$m->id % count($categories)];

                $gradients = [
                    'linear-gradient(135deg,#f59e0b,#f97316)',
                    'linear-gradient(135deg,#6366f1,#8b5cf6)',
                    'linear-gradient(135deg,#0ea5e9,#10b981)',
                    'linear-gradient(135deg,#ef4444,#f97316)',
                ];

                return [
                    'id'        => $m->id,
                    'logo'      => $m->logo,
                    'inisial'   => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                    'gradient'  => $gradients[$m->id % count($gradients)],
                    'nama'      => $m->nama_aplikasi,
                    'tipe'      => $cat['label'],
                    'tipeBg'    => $cat['bg'],
                    'tipeColor' => $cat['color'],
                    'deskripsi' => $m->instruksi ? substr(strip_tags($m->instruksi), 0, 60) . '...' : 'Uji aplikasi ' . $m->nama_aplikasi . ' dan berikan feedback terbaik.',
                    'durasi'    => '14 hari',
                    'testerCur' => $m->kapasitas,
                    'testerMax' => config('missions.max_capacity', 20),
                    'reward'    => $m->point,
                    'isTrusted' => $m->paket->trusted_badge ?? false,
                ];
            })->toArray();

        return [
            // ── Profil Tester ──────────────────────────────────  
            'namaTester'    => $user->name,  
            'inisialTester' => strtoupper(substr($user->name, 0, 2)),  
            'tierTester'    => $balance->badge ?? 'Novice Tester',  
            'userBadgeCount' => $balance->badge ?? 0,  
  
            // ── Poin & Statistik ───────────────────────────────  
            'totalPoin'    => $totalPoin,  
            'poinPending'  => $poinPending,  
            'misiSelesai'  => $misiSelesai,  
            'rating'       => '4.8', // Static placeholder for now
            'misiAktif'    => $misiAktif,  
            'streakHari'   => 14, // Static placeholder for now
  
            'misiAktifList' => $misiAktifList,  
            'aplikasiList'  => $aplikasiList,  
        ];  
    }

    /**
     * Mengecek apakah tester melewatkan submit misi kemarin.
     * Jika tidak ada submission (notdone), status di misi_anggota diubah jadi failed.
     */
    protected function checkMissedSubmissions($userId)
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $today     = Carbon::today()->toDateString();

        // Ambil misi yang sedang diikuti user (status accepted)
        $activeMissions = MisiAnggota::where('id_user', $userId)
            ->where('status', 'accepted')
            ->with('misi')
            ->get();

        foreach ($activeMissions as $ma) {
            $misi = $ma->misi;
            if (!$misi) continue;

            // Hanya cek jika user sudah join sebelum hari ini
            $joinDate = $ma->created_at->toDateString();
            if ($joinDate >= $today) {
                continue;
            }

            // Ambil hari_ke hari ini dari jadwal misi_sub
            $currentSub = MisiSub::where('id_user', $userId)
                ->where('id_misi', $ma->id_misi)
                ->whereDate('created_at', $today)
                ->first();

            if (!$currentSub) {
                continue;
            }

            $hariToday = $currentSub->hari_ke;
            $hariYesterday = $hariToday - 1;

            // Jika hari ini adalah Hari ke-2 atau lebih, cek hari sebelumnya
            if ($hariYesterday >= 1 && $hariYesterday <= 14) {
                // Cek apakah ada submission untuk hari tersebut (hari kemarin)
                $sub = MisiSub::where('id_user', $userId)
                    ->where('id_misi', $ma->id_misi)
                    ->where('hari_ke', $hariYesterday)
                    ->first();

                // Jika tidak ada atau statusnya masih 'notdone', maka status user di misi tersebut diubah jadi failed
                if (!$sub || $sub->status === 'notdone') {
                    $ma->update(['status' => 'failed']);
                    
                    // Kurangi kapasitas misi karena 1 tester gagal/keluar
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