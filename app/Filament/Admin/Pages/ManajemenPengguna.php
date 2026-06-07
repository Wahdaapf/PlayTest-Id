<?php  
  
namespace App\Filament\Admin\Pages;  
  
use Filament\Pages\Page;  
  
class ManajemenPengguna extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon  = 'heroicon-o-users';  
    protected static ?int    $navigationSort  = 2;  

    public static function getNavigationLabel(): string
    {
        return __('Pengguna');
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return __('Manajemen Pengguna');
    }
    protected string $view = 'filament.admin.pages.manajemen-pengguna';  
  
    public function getViewData(): array  
    {  
        $users = \App\Models\User::where('role', '!=', \App\Enums\UserRole::admin)
            ->withCount(['userBalance']) // Contoh jika butuh data lain
            ->latest()
            ->get();

        // Get count of campaigns (misi) for each user
        $misiCounts = \App\Models\Misi::groupBy('id_user')
            ->selectRaw('id_user, count(*) as count')
            ->pluck('count', 'id_user');

        $colors = ['#2563eb', '#f59e0b', '#8b5cf6', '#10b981', '#ef4444', '#0ea5e9', '#7c3aed'];

        return [  
            // ── Stat Cards ────────────────────────────────────────  
            'statTotal'     => \App\Models\User::where('role', '!=', \App\Enums\UserRole::admin)->count(),  
            'statDeveloper' => \App\Models\User::where('role', \App\Enums\UserRole::developer)->count(),  
            'statTester'    => \App\Models\User::where('role', \App\Enums\UserRole::tester)->count(),  
            'statPending'   => \App\Models\User::where('role', '!=', \App\Enums\UserRole::admin)->whereNull('email_verified_at')->count(),  
  
            // ── Daftar Pengguna ───────────────────────────────────  
            'penggunaList' => $users->map(function($user, $idx) use ($misiCounts, $colors) {
                $names = explode(' ', $user->name);
                $inisial = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                
                return [  
                    'inisial'      => $inisial,  
                    'avatarColor'  => $colors[$idx % count($colors)],  
                    'nama'         => $user->name,  
                    'email'        => $user->email,  
                    'role'         => __(ucfirst($user->role->value)),  
                    'raw_role'     => $user->role->value,
                    'tanggal'      => $user->created_at->format('d M Y'),  
                    'status'       => $user->email_verified_at ? __('Aktif') : __('Menunggu'),  
                    'raw_status'   => $user->email_verified_at ? 'aktif' : 'pending',
                    'kampanye'     => $misiCounts[$user->id] ?? 0,  
                    'phone'        => '-',  
                    'kota'         => '-',  
                ];
            })->toArray(),  
        ];  
    }  
}  
