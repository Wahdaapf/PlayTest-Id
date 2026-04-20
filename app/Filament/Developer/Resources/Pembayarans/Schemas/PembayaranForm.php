<?php

namespace App\Filament\Developer\Resources\Pembayarans\Schemas;

use App\Models\Misi;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        $misiId = request()->query('id_misi');
        $misi = Misi::find($misiId);

        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->required()
                    ->directory('pembayaran'),

                Hidden::make('id_misi')
                    ->default($misiId),

                Hidden::make('id_user')
                    ->default(auth()->id()),

                Hidden::make('id_paket')
                    ->default($misi?->id_paket),

                Hidden::make('status')
                    ->default('waiting'),
            ]);
    }
}
