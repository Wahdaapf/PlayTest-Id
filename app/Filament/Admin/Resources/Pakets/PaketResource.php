<?php

namespace App\Filament\Admin\Resources\Pakets;

use App\Filament\Admin\Resources\Pakets\Pages\CreatePaket;
use App\Filament\Admin\Resources\Pakets\Pages\EditPaket;
use App\Filament\Admin\Resources\Pakets\Pages\ListPakets;
use App\Filament\Admin\Resources\Pakets\Schemas\PaketForm;
use App\Filament\Admin\Resources\Pakets\Tables\PaketsTable;
use App\Models\Paket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cube;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Packets';

    protected static ?string $modelLabel = 'Packet';

    protected static ?string $pluralModelLabel = 'Packets';

    protected static ?string $slug = 'packets';

    public static function form(Schema $schema): Schema
    {
        return PaketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaketsTable::configure($table);
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
            'index' => ListPakets::route('/'),
            'create' => CreatePaket::route('/create'),
            'edit' => EditPaket::route('/{record}/edit'),
        ];
    }
}
