<?php

namespace App\Filament\Admin\Resources\Pakets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;

class PaketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('fee')
                    ->label('Fee')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('point')
                    ->label('Point')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('most_popular')
                    ->label('Most Popular')
                    ->boolean(),

                ToggleColumn::make('aktif')
                    ->label('Active')
                    ->sortable(),

                ToggleColumn::make('trusted_badge')
                    ->label('Trusted Badge')
                    ->sortable(),

                TextColumn::make('desc')
                    ->label('Description')
                    ->html()
                    ->limit(50)
                    ->markdown(),



                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
