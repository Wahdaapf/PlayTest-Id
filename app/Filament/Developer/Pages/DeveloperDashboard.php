<?php  
  
namespace App\Filament\Developer\Pages;  
  
use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Pages\Page;  
use Illuminate\Support\Facades\Auth;
  
class DeveloperDashboard extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon  = 'heroicon-o-squares-2x2';  
    protected static ?string $navigationLabel = 'Overview';  
    protected static string | \UnitEnum | null $navigationGroup = 'MAIN';  
    protected static ?int    $navigationSort  = 1;  
    protected static ?string $slug            = '/';  
    protected static ?string $title           = 'Developer Dashboard';  
  
    public function getHeading(): string  
    {  
        return '';  
    }  
  
    protected string  $view            = 'filament.developer.pages.developer-dashboard';  
  
    public function getViewData(): array  
    {  
        $userId = Auth::id();
        
        // ── 1. Statistik Dasar ──────────────────────────────────
        $misiList = Misi::where('id_user', $userId)->get();
        $misiIds = $misiList->pluck('id');

        $statAktif   = $misiList->whereIn('status', ['open', 'progress'])->count();
        $statSelesai = $misiList->where('status', 'selesai')->count();
        $statTester  = MisiAnggota::whereIn('id_misi', $misiIds)->count();

        // ── 2. Mapping aplikasiList (Recent Applications) ─────
        $warnaSiklus = ['blue', 'amber', 'purple', 'green'];
        
        $aplikasiList = $misiList->sortByDesc('created_at')->take(5)->map(function ($m, $index) use ($warnaSiklus) {
            $testerCount = $m->misiAnggotas()->count();
            $maxTester = $m->kapasitas ?: 20;
            $persen = $maxTester > 0 ? round(($testerCount / $maxTester) * 100) : 0;
            
            // Mapping status internal ke label UI
            $statusUI = match($m->status) {
                'pending' => ['status' => 'pending', 'label' => 'PENDING', 'warna' => 'amber'],
                'rejected' => ['status' => 'pending', 'label' => 'REJECTED', 'warna' => 'red'],
                'selesai' => ['status' => 'selesai', 'label' => 'COMPLETED', 'warna' => 'purple'],
                default    => ['status' => 'progress', 'label' => 'IN PROGRESS', 'warna' => 'blue'],
            };

            return [
                'inisial' => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                'nama'    => $m->nama_aplikasi,
                'versi'   => 'v1.0.0', // Default karena kolom versi tdk ada di DB
                'status'  => $statusUI['status'],
                'label'   => $statusUI['label'],
                'tester'  => "$testerCount / $maxTester",
                'persen'  => $persen,
                'tanggal' => $m->created_at->format('d M Y'),
                'warna'   => $statusUI['warna'],
            ];
        })->toArray();

        // ── 3. Mapping kampanyeList (14-Day Progress Tracker) ──
        $kampanyeList = $misiList->whereIn('status', ['open', 'progress', 'selesai'])->take(3)->map(function ($m) {
            // Hitung hari aktif (asumsi 14 hari)
            $diff = $m->created_at->diffInDays(now());
            $hariAktif = min($diff + 1, 14); 

            $statusUI = match($m->status) {
                'selesai' => ['status' => 'selesai', 'warna' => 'purple'],
                default    => ['status' => 'progress', 'warna' => 'blue'],
            };

            return [
                'inisial'   => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                'nama'      => $m->nama_aplikasi,
                'versi'     => 'v1.0.0',
                'hariAktif' => $m->status === 'selesai' ? 14 : $hariAktif,
                'totalHari' => 14,
                'status'    => $statusUI['status'],
                'warna'     => $statusUI['warna'],
            ];
        })->toArray();

        // ── 4. Penghitungan Persentase Stat Cards ────────────
        $maxMisi = 3; // Asumsi slot maksimal developer (bisa diambil dari paket nanti)
        $statAktifPercent = $maxMisi > 0 ? round(($statAktif / $maxMisi) * 100) : 0;
        $statSelesaiPercent = $misiList->count() > 0 ? round(($statSelesai / $misiList->count()) * 100) : 0;
        
        $totalKapasitas = $misiList->whereIn('status', ['open', 'progress'])->sum('kapasitas') ?: 20;
        $statTesterPercent = $totalKapasitas > 0 ? round(($statTester / $totalKapasitas) * 100) : 0;

        return [
            'statAktif'    => $statAktif,
            'statAktifPercent' => $statAktifPercent,
            'statAktifNote'    => "$statAktif dari $maxMisi slot aktif terpakai",
            
            'statSelesai'  => $statSelesai,
            'statSelesaiPercent' => $statSelesaiPercent,
            'statSelesaiNote'    => "$statSelesai dari " . $misiList->count() . " kampanye selesai",
            
            'statTester'   => $statTester,
            'statTesterPercent' => $statTesterPercent,
            'statTesterNote'    => "$statTester dari $totalKapasitas slot tester terisi",

            'aplikasiList' => $aplikasiList,
            'kampanyeList' => $kampanyeList,
        ];
    }  
}  