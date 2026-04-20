<?php

namespace App\Filament\Developer\Resources\Misis;

use App\Filament\Developer\Resources\Misis\Pages\CreateMisi;
use App\Filament\Developer\Resources\Misis\Pages\ListMisis;
use App\Filament\Developer\Resources\Misis\Schemas\MisiForm;
use App\Filament\Developer\Resources\Misis\Tables\MisisTable;
use App\Models\Misi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MisiResource extends Resource
{
    protected static ?string $model = Misi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_aplikasi';

    public static function form(Schema $schema): Schema
    {
        return MisiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MisisTable::configure($table);
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
            'index' => ListMisis::route('/'),
            'create' => CreateMisi::route('/create'),
        ];
    }
}
