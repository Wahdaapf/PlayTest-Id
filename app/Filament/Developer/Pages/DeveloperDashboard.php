<?php

namespace App\Filament\Developer\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Pages\Dashboard;

class DeveloperDashboard extends Dashboard
{
    protected static ?string $title = 'Overview';

    protected static ?string $slug = 'dashboard';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home';

    public function getHeading(): string
    {
        return '';
    }

    protected function getViewData(): array
    {
        $userId = auth()->id();

        // Count Active (In Progress or Pending)
        $activeCount = Misi::where('id_user', $userId)
            ->whereIn('status', ['In Progress', 'Pending', 'running'])
            ->count();

        // Count Completed
        $completedCount = Misi::where('id_user', $userId)
            ->where('status', 'Completed')
            ->count();

        // Count Total Testers (Anggota) for all missions of this user
        $testersCount = MisiAnggota::whereIn('id_misi', function ($query) use ($userId) {
            $query->select('id')->from('misi')->where('id_user', $userId);
        })->count();

        // Recent Missions with count of members
        $recentMisis = Misi::where('id_user', $userId)
            ->withCount('misiAnggotas')
            ->with('paket')
            ->latest()
            ->take(5)
            ->get();

        return [
            'activeCount' => $activeCount,
            'completedCount' => $completedCount,
            'testersCount' => $testersCount,
            'recentMisis' => $recentMisis,
        ];
    }

    protected string $view = 'filament.developer.pages.developer-dashboard';
}
