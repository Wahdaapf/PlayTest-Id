<?php

namespace App\Filament\Developer\Resources\Misis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Set;
use App\Models\Paket;
use Filament\Schemas\Schema;

class MisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('id_user')
                    ->default(fn() => auth()->id())
                    ->required(),
                Select::make('id_paket')
                    ->relationship('paket', 'desc')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn(Set $set, $state) => $set('point', Paket::find($state)?->point ?? 0)),
                TextInput::make('nama_aplikasi')
                    ->required(),
                TextInput::make('link_aplikasi'),
                Textarea::make('instruksi')
                    ->columnSpanFull(),
                Hidden::make('point')
                    ->default(0),
            ]);
    }
}
