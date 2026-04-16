<?php

namespace App\Filament\Tester\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();
        $balance = $user->userBalance?->point ?? 0;

        return [
            Stat::make('Current Points', $balance . ' pts')
                ->description('Total points you have earned')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
