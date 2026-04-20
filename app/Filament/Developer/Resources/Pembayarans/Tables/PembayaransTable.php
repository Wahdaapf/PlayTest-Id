<?php

namespace App\Filament\Developer\Resources\Pembayarans\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Bukti'),
                TextColumn::make('misi.nama_aplikasi')
                    ->label('Misi'),
                TextColumn::make('paket.desc')
                    ->label('Paket'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting' => 'gray',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}
