<?php

namespace App\Filament\Developer\Resources\Misis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_aplikasi')
                    ->label('Nama Aplikasi')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('paket.nama')     // sesuaikan dengan field nama di model Paket
                    ->label('Paket')
                    ->badge()
                    ->color('primary')
                    ->default('-'),

                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->formatStateUsing(fn ($state) => $state . '/' . config('missions.max_capacity', 20))
                    ->suffix(' tester')
                    ->sortable(),

                TextColumn::make('point')
                    ->label('Point')
                    ->suffix(' pt')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}