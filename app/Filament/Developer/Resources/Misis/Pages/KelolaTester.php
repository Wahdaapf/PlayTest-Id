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
            ->query(MisiAnggota::query()->where('id_misi', $this->record->id)->where('status', '!=', 'rejected'))
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
                \Filament\Actions\Action::make('accept')
                    ->label('Terima')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (MisiAnggota $record) => in_array($record->status, ['pending', 'reviewing']))
                    ->action(function (MisiAnggota $record) {
                        $record->update(['status' => 'accepted']);
                        \Filament\Notifications\Notification::make()
                            ->title('Tester Diterima')
                            ->success()
                            ->send();
                    }),

                \Filament\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (MisiAnggota $record) => in_array($record->status, ['pending', 'reviewing']))
                    ->action(function (MisiAnggota $record) {
                        $record->update(['status' => 'rejected']);
                        
                        // Kembalikan kapasitas misi dan pastikan statusnya open
                        if ($record->misi) {
                            $record->misi->decrement('kapasitas');
                            $record->misi->update(['status' => 'open']);
                        }

                        \Filament\Notifications\Notification::make()
                            ->title('Tester Ditolak')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
