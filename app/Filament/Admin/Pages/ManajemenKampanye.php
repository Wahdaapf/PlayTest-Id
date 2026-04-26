<?php  
  
namespace App\Filament\Admin\Pages;  
  
use Filament\Pages\Page;  
  
class ManajemenKampanye extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';  
    protected static ?string $navigationLabel = 'Kampanye';  
    protected static ?string $title = 'Manajemen Kampanye';  
    protected static ?int $navigationSort = 3;  
    protected string $view = 'filament.admin.pages.manajemen-kampanye';  
  
    public function approveKampanye($id)
    {
        $misi = \App\Models\Misi::find($id);
        if ($misi) {
            $misi->update(['status' => 'open']);
        }
    }

    public function rejectKampanye($id)
    {
        $misi = \App\Models\Misi::find($id);
        if ($misi) {
            $misi->update(['status' => 'rejected']);
        }
    }

    public function pauseKampanye($id)
    {
        // Misal pause kembalikan ke Pending atau ubah ke status lain
        $misi = \App\Models\Misi::find($id);
        if ($misi) {
            $misi->update(['status' => 'Pending']); 
        }
    }

    public function getViewData(): array  
    {  
        $misis = \App\Models\Misi::with(['user', 'paket'])
            ->withCount('misiAnggotas')
            ->latest()
            ->get();

        $statusMap = [
            'open'      => 'Aktif',
            'Pending'   => 'Ditinjau',
            'Completed' => 'Selesai',
            'rejected'  => 'Ditolak',
        ];

        $colors = [
            ['#1e3a8a', '#3b82f6'], // Blue
            ['#ea580c', '#fb923c'], // Orange
            ['#059669', '#10b981'], // Green
            ['#7c3aed', '#a78bfa'], // Purple
            ['#be123c', '#fb7185'], // Rose
        ];

        return [  
            'statTotal'    => \App\Models\Misi::count(),  
            'statAktif'    => \App\Models\Misi::where('status', 'open')->count(),  
            'statSelesai'  => \App\Models\Misi::where('status', 'Completed')->count(),  
            'statDitinjau' => \App\Models\Misi::where('status', 'Pending')->count(),  
            'statDitolak'  => \App\Models\Misi::where('status', 'rejected')->count(),  
            'kampanyeList' => $misis->map(function($misi, $idx) use ($statusMap, $colors) {
                $statusUI = $statusMap[$misi->status] ?? $misi->status;
                $grad = $colors[$idx % count($colors)];
                
                // Timeline logic (14 days)
                $createdAt = $misi->created_at;
                $hariKe = $createdAt ? (int) $createdAt->diffInDays(now()) : 0;
                $hariKe = min(max($hariKe, 0), 14);

                return [  
                    'id'        => $misi->id,
                    'nama'      => $misi->nama_aplikasi,  
                    'developer' => $misi->user->name ?? 'Unknown',  
                    'status'    => $statusUI,  
                    'tester'    => $misi->misi_anggotas_count,  
                    'maxTester' => $misi->kapasitas ?? 20,  
                    'hariKe'    => ($statusUI === 'Selesai') ? 14 : (($statusUI === 'Ditinjau') ? 0 : $hariKe),  
                    'maxHari'   => 14,  
                    'mulai'     => $misi->created_at ? $misi->created_at->format('d M Y') : '-',  
                    'selesai'   => $misi->created_at ? $misi->created_at->addDays(14)->format('d M Y') : '-',  
                    'paket'     => $misi->paket->nama_paket ?? 'Starter',  
                    'ikonHuruf' => strtoupper(substr($misi->nama_aplikasi, 0, 1)),  
                    'ikonGrad'  => "linear-gradient(135deg, {$grad[0]} 0%, {$grad[1]} 100%)",  
                ];
            })->toArray(),  
        ];  
    }  
}