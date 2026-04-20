<?php

namespace App\Filament\Developer\Resources\Misis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('paket.desc')
                    ->label('Paket')
                    ->sortable(),
                TextColumn::make('nama_aplikasi')
                    ->searchable(),
                TextColumn::make('link_aplikasi')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'waiting' => 'warning',
                        'open' => 'success',
                        'rejected' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->formatStateUsing(fn ($state) => $state . '/20'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
