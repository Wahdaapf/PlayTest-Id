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
                    ->color(fn(string $state): string => match ($state) {
                        'waiting' => 'gray',
                        'accepted' => 'success',
                        'rejected' => 'danger',
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
            ->actions([
                Action::make('accept')
                    ->label('Accepted')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'accepted',
                            'id_admin' => auth()->id(),
                        ]);
                        if ($record->misi) {
                            $record->misi->update(['status' => 'open']);
                        }
                    })
                    ->visible(fn($record) => $record->status === 'waiting'),
                Action::make('reject')
                    ->label('Rejected')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'rejected',
                            'id_admin' => auth()->id(),
                        ]);
                        if ($record->misi) {
                            $record->misi->update(['status' => 'rejected']);
                        }
                    })
                    ->visible(fn($record) => $record->status === 'waiting'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
