<?php

namespace App\Filament\Developer\Resources\Pembayarans\Widgets;

use App\Filament\Developer\Resources\Pembayarans\PembayaranResource;
use App\Models\Misi;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingMisiWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Misi Menunggu Pembayaran';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Misi::query()
                    ->where('id_user', auth()->id())
                    ->where('status', 'pending')
                    ->whereDoesntHave('pembayarans')
            )
            ->columns([
                TextColumn::make('nama_aplikasi')
                    ->label('Nama Aplikasi'),
                TextColumn::make('paket.desc')
                    ->label('Paket'),
                TextColumn::make('created_at')
                    ->label('Tanggal Order')
                    ->dateTime(),
            ])
            ->actions([
                Action::make('pay')
                    ->label('Bayar Sekarang')
                    ->color('success')
                    ->icon('heroicon-o-credit-card')
                    ->url(fn (Misi $record): string => PembayaranResource::getUrl('create', ['id_misi' => $record->id])),
            ]);
    }
}
