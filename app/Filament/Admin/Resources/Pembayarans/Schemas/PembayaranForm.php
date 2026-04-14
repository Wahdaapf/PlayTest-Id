<?php

namespace App\Filament\Admin\Resources\Pembayarans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('paket_id')
                    ->relationship('paket', 'desc')
                    ->placeholder('-'),
                Select::make('misi_id')
                    ->relationship('misi', 'nama_aplikasi')
                    ->placeholder('-'),
                FileUpload::make('image')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed' => 'Failed',
                    ])
                    ->required(),
            ]);
    }
}
