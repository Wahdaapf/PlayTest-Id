<?php

namespace App\Filament\Developer\Resources\Pembayarans;

use App\Filament\Developer\Resources\Pembayarans\Pages\CreatePembayaran;
use App\Filament\Developer\Resources\Pembayarans\Pages\ListPembayarans;
use App\Filament\Developer\Resources\Pembayarans\Schemas\PembayaranForm;
use App\Filament\Developer\Resources\Pembayarans\Tables\PembayaransTable;
use App\Models\Pembayaran;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static \BackedEnum|string|null $navigationIcon = \Filament\Support\Icons\Heroicon::CreditCard;

    public static function form(Schema $schema): Schema
    {
        return PembayaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PembayaransTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPembayarans::route('/'),
            'create' => CreatePembayaran::route('/create'),
        ];
    }
}
