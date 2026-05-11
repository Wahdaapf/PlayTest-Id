<?php

namespace App\Filament\Developer\Resources\Misis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('logo_view')
                    ->label('Logo')
                    ->html()
                    ->getStateUsing(function ($record) {
                        if ($record->logo) {
                            return '<img src="/storage/' . $record->logo . '" alt="Logo" class="w-9 h-9 rounded-xl object-cover" style="width:36px;height:36px;border-radius:10px;object-fit:cover;">';
                        }
                        
                        $inisial = strtoupper(substr($record->nama_aplikasi, 0, 2));
                        $colors = ['blue', 'amber', 'purple', 'green'];
                        $warna = $colors[$record->id % count($colors)];
                        
                        $bg = match($warna) {
                            'blue' => '#eff6ff',
                            'amber' => '#fffbeb',
                            'purple' => '#faf5ff',
                            default => '#f0fdf4',
                        };
                        $text = match($warna) {
                            'blue' => '#2563eb',
                            'amber' => '#d97706',
                            'purple' => '#7e22ce',
                            default => '#16a34a',
                        };
                        
                        return '<div style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;background:'.$bg.';color:'.$text.';">' . $inisial . '</div>';
                    }),

                TextColumn::make('nama_aplikasi')
                    ->label('Nama Aplikasi')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('paket.name')
                    ->label('Paket')
                    ->badge()
                    ->color('primary')
                    ->default('-'),

                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->formatStateUsing(fn ($state) => $state . '/' . config('missions.max_capacity', 20))
                    ->suffix(' tester')
                    ->sortable(),

                TextColumn::make('point')
                    ->label('Point')
                    ->suffix(' pt')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([])
            ->recordActions([
                \Filament\Actions\Action::make('mulai_misi')
                    ->label('Mulai Misi')
                    ->icon('heroicon-o-play')
                    ->color('success')
                    ->button()
                    ->requiresConfirmation()
                    ->modalHeading('Mulai Misi')
                    ->modalDescription('Apakah Anda yakin ingin memulai misi ini? Sistem akan membuatkan sub-misi secara otomatis untuk para tester.')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('link_aplikasi')
                            ->label('Link Aplikasi / Test')
                            ->placeholder('https://...')
                            ->url()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->visible(fn (\App\Models\Misi $record): bool => $record->status === 'closed')
                    ->action(function (\App\Models\Misi $record, array $data) {
                        // 1. Jika paket trusted badge = true, ubah semua tester pending/reviewing menjadi accepted
                        if ($record->paket && $record->paket->trusted_badge) {
                            \App\Models\MisiAnggota::where('id_misi', $record->id)
                                ->whereIn('status', ['pending', 'reviewing'])
                                ->update(['status' => 'accepted']);
                        }

                        // 2. Ambil semua tester yang sudah accepted
                        $acceptedTesters = \App\Models\MisiAnggota::where('id_misi', $record->id)
                            ->where('status', 'accepted')
                            ->get();

                        // 3. Buat 14 sub misi untuk setiap tester yang accepted
                        $now = \Carbon\Carbon::now();
                        $subMisis = [];
                        foreach ($acceptedTesters as $tester) {
                            for ($i = 1; $i <= 14; $i++) {
                                $subMisis[] = [
                                    'id_misi' => $record->id,
                                    'id_user' => $tester->id_user,
                                    'hari_ke' => $i,
                                    'status'  => 'notdone',
                                    'created_at' => $now->copy()->addDays($i - 1),
                                    'updated_at' => $now->copy()->addDays($i - 1),
                                ];
                            }
                        }

                        if (!empty($subMisis)) {
                            \App\Models\MisiSub::insert($subMisis);
                        }

                        // 4. Ubah status misi menjadi running & simpan link
                        $record->update([
                            'status' => 'running',
                            'link_aplikasi' => $data['link_aplikasi'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Misi Berhasil Dimulai')
                            ->body('Status misi telah diubah menjadi running dan sub-misi tester telah dibuat.')
                            ->success()
                            ->send();
                    }),

                \Filament\Actions\Action::make('kelola_tester')
                    ->label('Kelola Tester')
                    ->icon('heroicon-o-users')
                    ->color('info')
                    ->button()
                    ->visible(fn (\App\Models\Misi $record): bool => 
                        in_array($record->status, ['open', 'closed'])
                    )
                    ->url(fn (\App\Models\Misi $record): string => \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('kelola-tester', ['record' => $record])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}