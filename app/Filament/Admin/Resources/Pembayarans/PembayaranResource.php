<?php

namespace App\Filament\Admin\Resources\Pembayarans;

use App\Filament\Admin\Resources\Pembayarans\Pages\ListPembayarans;
use App\Filament\Admin\Resources\Pembayarans\Schemas\PembayaranForm;
use App\Filament\Admin\Resources\Pembayarans\Tables\PembayaransTable;
use App\Models\Pembayaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Banknotes;

    protected static ?string $recordTitleAttribute = 'user.name';

    protected static ?string $navigationLabel = 'Payments';

    protected static ?string $modelLabel = 'Payments';

    protected static ?string $pluralModelLabel = 'Payments';

    protected static ?string $slug = 'payments';

    public static function form(Schema $schema): Schema
    {
        return PembayaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PembayaransTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPembayarans::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
