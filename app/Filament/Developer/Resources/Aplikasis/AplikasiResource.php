<?php

namespace App\Filament\Developer\Resources\Aplikasis;

use App\Filament\Developer\Resources\Aplikasis\Pages\CreateAplikasi;
use App\Filament\Developer\Resources\Aplikasis\Pages\EditAplikasi;
use App\Filament\Developer\Resources\Aplikasis\Pages\ListAplikasis;
use App\Filament\Developer\Resources\Aplikasis\Schemas\AplikasiForm;
use App\Filament\Developer\Resources\Aplikasis\Tables\AplikasisTable;
use App\Models\Misi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AplikasiResource extends Resource
{
    protected static ?string $model = Misi::class;

    protected static ?string $recordTitleAttribute = 'nama_aplikasi';

    protected static ?string $navigationLabel = 'New Test Case';

    protected static ?string $modelLabel = 'New Test Case';

    protected static ?string $pluralModelLabel = 'New Test Cases';

    protected static ?string $slug = 'new-test-case';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PlusCircle;

    public static function form(Schema $schema): Schema
    {
        return AplikasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AplikasisTable::configure($table);
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
            'index' => ListAplikasis::route('/'),
            'create' => CreateAplikasi::route('/create'),
            'edit' => EditAplikasi::route('/{record}/edit'),
        ];
    }
}
