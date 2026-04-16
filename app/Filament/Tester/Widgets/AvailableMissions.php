<?php

namespace App\Filament\Tester\Widgets;

use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Filament\Tester\Pages\MisiDetail;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class AvailableMissions extends BaseWidget
{
    protected static ?string $heading = 'Available Apps to Test';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Misi::query()
                    ->where('status', 'open')
                    // Filter out missions the user has already joined
                    ->whereDoesntHave('misiAnggotas', function ($query) {
                        $query->where('id_user', Auth::id());
                    })
            )
            ->columns([
                TextColumn::make('nama_aplikasi')
                    ->label('Application Name')
                    ->searchable()
                    ->description(fn (Misi $record): string => 'Reward: ' . $record->point . ' pts'),
                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->formatStateUsing(fn ($state) => $state . '/20'),
                TextColumn::make('instruksi')
                    ->label('Instructions')
                    ->limit(50),
            ])
            ->actions([
                Action::make('view')
                    ->label('Ambil Misi')
                    ->icon('heroicon-o-plus-circle')
                    ->color('primary')
                    ->url(fn (Misi $record): string => MisiDetail::getUrl(['misi_id' => $record->id])),
            ])
            ->recordAction('view');
    }
}
