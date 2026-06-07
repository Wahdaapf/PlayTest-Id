<?php

namespace App\Filament\Admin\Resources\Pakets\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class PaketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1 - Information
                Section::make(__('Informasi'))
                    ->description(__('Atur detail informasi untuk paket ini'))
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make("name")
                            ->label(__('Nama Paket'))
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make("desc")
                            ->label(__('Deskripsi'))
                            ->required()
                            ->columnSpanFull(),
                    ]),

                // Section 2 - Pricing & Points
                Section::make(__('Harga & Hadiah'))
                    ->description(__('Atur harga dan hadiah poin untuk paket ini'))
                    ->icon('heroicon-o-currency-dollar')
                    ->columnSpanFull()
                    ->schema([
                        Group::make([
                            TextInput::make("price")
                                ->label(__('Harga'))
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->maxValue(9999999999999.99)
                                ->step(0.01),
                            TextInput::make("fee")
                                ->label(__('Biaya Layanan'))
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->maxValue(9999999999999.99)
                                ->step(0.01),
                            TextInput::make("point")
                                ->label(__('Hadiah Poin'))
                                ->placeholder("0")
                                ->required()
                                ->numeric()
                                ->integer()
                                ->default(0)
                                ->minValue(0),
                        ])->columns(3),
                    ]),

                // Section 3 - Status & Badges
                Section::make(__('Status & Lencana'))
                    ->description(__('Kelola status dan visibilitas untuk paket ini'))
                    ->icon('heroicon-o-cog')
                    ->columnSpanFull()
                    ->schema([
                        Group::make([
                            Toggle::make("aktif")
                                ->label(__('Status Aktif'))
                                ->required()
                                ->default(true),
                            Toggle::make("most_popular")
                                ->label(__('Paling Populer'))
                                ->required()
                                ->default(false),
                            Toggle::make("trusted_badge")
                                ->label(__('Lencana Terpercaya'))
                                ->required()
                                ->default(false),
                        ])->columns(3),
                    ]),
            ]);
    }
}
