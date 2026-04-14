<?php

namespace App\Filament\Admin\Resources\Pembayarans\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('paket.desc')
                    ->label('Packet')
                    ->searchable()
                    ->sortable()
                    ->default('-'),
                TextColumn::make('misi.nama_aplikasi')
                    ->label('Application')
                    ->searchable()
                    ->sortable()
                    ->default('-'),
                ImageColumn::make('image')
                    ->label('Transfer Receipt'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('accept')
                    ->label('Accept')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'success']);
                        if ($record->misi) {
                            $record->misi->update(['status' => 'active']);
                        }
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'failed']);
                        if ($record->misi) {
                            $record->misi->update(['status' => 'failed']);
                        }
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
