<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class KelolaTester extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = MisiResource::class;

    protected string $view = 'filament.developer.resources.misis.pages.kelola-tester';

    public Misi $record;

    public function mount(Misi $record): void
    {
        $this->record = $record;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(MisiAnggota::query()->where('id_misi', $this->record->id))
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Tester')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'accepted' => 'info',
                        'progress' => 'warning',
                        'submitted' => 'primary',
                        'selesai' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Bergabung Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                // You can add action to view submission etc here later
            ]);
    }
}
