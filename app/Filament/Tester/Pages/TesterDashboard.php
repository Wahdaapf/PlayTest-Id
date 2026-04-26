<?php  
  
namespace App\Filament\Tester\Pages;  
  
use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\UserBalance;
use Filament\Notifications\Notification;
use Filament\Pages\Page;  
use Illuminate\Support\Facades\Auth;

class TesterDashboard extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon  = 'heroicon-o-home';  
    protected static ?string $navigationLabel = 'Home';  
    protected static ?string $title           = 'Tester Dashboard';  
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

        // Tentukan status berdasarkan trusted_badge paket
        $status = ($misi->paket && $misi->paket->trusted_badge) ? 'pending' : 'accepted';

        MisiAnggota::create([
            'id_misi' => $misiId,
            'id_user' => Auth::id(),
            'status'  => $status,
        ]);

        // Increment kapasitas (jumlah tester saat ini)
        $misi->increment('kapasitas');

        // Jika kapasitas mencapai 20, tutup misi
        if ($misi->kapasitas >= 20) {
            $misi->update(['status' => 'closed']);
        }

        Notification::make()
            ->title('Berhasil!')
            ->success()
            ->body($status === 'pending' ? 'Permintaan bergabung sedang ditinjau.' : 'Anda telah berhasil bergabung dengan misi ini.')
            ->send();
    }
  
    public function getViewData(): array  
    {  
        $user = Auth::user();
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
            ->map(function ($ma) {
                $m = $ma->misi;
                
                // Hitung hari (asumsi 14 hari kampanye)
                $diff = $m->created_at->diffInDays(now());
                $hari = min($diff + 1, 14);
                $persen = round(($hari / 14) * 100);

                // Warna & Gradasi berdasarkan ID agar variatif tapi tetap konsisten
                $gradients = [
                    ['icon' => 'linear-gradient(135deg,#f59e0b,#ef4444)', 'bar' => 'linear-gradient(90deg,#0ea5e9,#2563eb)'],
                    ['icon' => 'linear-gradient(135deg,#8b5cf6,#6366f1)', 'bar' => 'linear-gradient(90deg,#8b5cf6,#6366f1)'],
                    ['icon' => 'linear-gradient(135deg,#10b981,#0ea5e9)', 'bar' => 'linear-gradient(90deg,#10b981,#0ea5e9)'],
                ];
                $gId = $m->id % count($gradients);

                return [
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
                // Sesuai permintaan: kapasitas belum > 20 (artinya maksimal 20)
                // Dan juga belum penuh (jumlah anggota < kapasitas)
                $q->where('kapasitas', '<=', 20)
                  ->where(function($sq) {
                      $sq->where(function($ssq) {
                          $ssq->where('kapasitas', '>', 0)
                              ->whereRaw('kapasitas > (select count(*) from misi_anggota where misi_anggota.id_misi = misi.id)');
                      })
                      ->orWhere(function($ssq) {
                          $ssq->where('kapasitas', 0)
                              ->whereRaw('20 > (select count(*) from misi_anggota where misi_anggota.id_misi = misi.id)');
                      });
                  });
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
                    'inisial'   => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                    'gradient'  => $gradients[$m->id % count($gradients)],
                    'nama'      => $m->nama_aplikasi,
                    'tipe'      => $cat['label'],
                    'tipeBg'    => $cat['bg'],
                    'tipeColor' => $cat['color'],
                    'deskripsi' => $m->instruksi ? substr($m->instruksi, 0, 60) . '...' : 'Uji aplikasi ' . $m->nama_aplikasi . ' dan berikan feedback terbaik.',
                    'durasi'    => '14 hari',
                    'testerCur' => $m->misi_anggotas_count,
                    'testerMax' => $m->kapasitas ?: 20,
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
}  