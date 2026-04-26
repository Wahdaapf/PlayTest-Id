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
                Section::make("Information")
                    ->description("Set information details for this package")
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make("name")
                            ->label("Package Name")
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make("desc")
                            ->label("Description")
                            ->required()
                            ->columnSpanFull(),
                    ]),

                // Section 2 - Pricing & Points
                Section::make("Pricing & Rewards")
                    ->description("Set the pricing and point rewards for this package")
                    ->icon('heroicon-o-currency-dollar')
                    ->columnSpanFull()
                    ->schema([
                        Group::make([
                            TextInput::make("price")
                                ->label("Price")
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->maxValue(9999999999999.99)
                                ->step(0.01),
                            TextInput::make("fee")
                                ->label("Fee")
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->maxValue(9999999999999.99)
                                ->step(0.01),
                            TextInput::make("point")
                                ->label("Point Reward")
                                ->placeholder("0")
                                ->required()
                                ->numeric()
                                ->integer()
                                ->default(0)
                                ->minValue(0),
                        ])->columns(3),
                    ]),

                // Section 3 - Status & Badges
                Section::make("Status & Badges")
                    ->description("Manage the status and visibility of this package")
                    ->icon('heroicon-o-cog')
                    ->columnSpanFull()
                    ->schema([
                        Group::make([
                            Toggle::make("aktif")
                                ->label("Active Status")
                                ->required()
                                ->default(true),
                            Toggle::make("most_popular")
                                ->label("Most Popular")
                                ->required()
                                ->default(false),
                            Toggle::make("trusted_badge")
                                ->label("Trusted Badge")
                                ->required()
                                ->default(false),
                        ])->columns(3),
                    ]),
            ]);
    }
}
