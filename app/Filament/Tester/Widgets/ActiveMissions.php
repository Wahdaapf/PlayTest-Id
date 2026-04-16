<?php

namespace App\Filament\Tester\Widgets;

use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ActiveMissions extends BaseWidget
{
    protected static ?string $heading = 'My Active Missions';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Misi::query()
                    ->whereHas('misiAnggotas', function ($query) {
                        $query->where('id_user', Auth::id());
                    })
            )
            ->columns([
                TextColumn::make('nama_aplikasi')
                    ->label('Application')
                    ->weight('bold'),
                TextColumn::make('misiAnggotas')
                    ->label('My Status')
                    ->formatStateUsing(function (Misi $record) {
                        $anggota = $record->misiAnggotas()->where('id_user', Auth::id())->first();
                        return ucfirst($anggota?->status ?? 'Unknown');
                    })
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'pending' => 'gray',
                        'reviewing' => 'info',
                        'active' => 'warning',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->actions([
                Action::make('view_details')
                    ->label('Submit Task')
                    ->button()
                    ->url(fn (Misi $record) => '#'), // Placeholder for now
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ]);
    }
}
