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

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('get_emails')
                ->label('Ambil List Email Tester')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('primary')
                ->form([
                    \Filament\Forms\Components\Textarea::make('emails')
                        ->label('Daftar Email Tester (Copy & Paste)')
                        ->rows(5)
                        ->extraAttributes(['readonly' => true])
                        ->default(function () {
                            return \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                                ->whereIn('status', ['accepted', 'progress', 'submitted', 'selesai'])
                                ->with('user')
                                ->get()
                                ->pluck('user.email')
                                ->implode(', ');
                        }),
                ])
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup'),

            \Filament\Actions\Action::make('input_link')
                ->label('Input Link Aplikasi')
                ->icon('heroicon-o-link')
                ->color('success')
                ->hidden(fn () => in_array($this->record->status, ['open', 'closed']))
                ->form([
                    \Filament\Forms\Components\TextInput::make('link_aplikasi')
                        ->label('Link Aplikasi (Misal: Google Play URL)')
                        ->required()
                        ->url()
                        ->default($this->record->link_aplikasi),
                ])
                ->action(function (array $data) {
                    // 1. Jika paket trusted badge = true, ubah semua tester pending/reviewing menjadi accepted
                    if ($this->record->paket && $this->record->paket->trusted_badge) {
                        \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                            ->whereIn('status', ['pending', 'reviewing'])
                            ->update(['status' => 'accepted']);
                    }

                    // 2. Ambil semua tester yang sudah accepted
                    $acceptedTesters = \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                        ->where('status', 'accepted')
                        ->with('user')
                        ->get();

                    // 3. Buat 14 sub misi untuk setiap tester yang accepted
                    $now = \Carbon\Carbon::now();
                    $subMisis = [];
                    foreach ($acceptedTesters as $tester) {
                        for ($i = 1; $i <= 14; $i++) {
                            $subMisis[] = [
                                'id_misi' => $this->record->id,
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
                    $this->record->update([
                        'link_aplikasi' => $data['link_aplikasi'],
                        'status' => 'running',
                    ]);

                    \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                        ->where('status', 'accepted')
                        ->update(['status' => 'progress']);

                    // Kirim email notifikasi ke tester bahwa misi dimulai
                    foreach ($acceptedTesters as $tester) {
                        if ($tester->user && $tester->user->email) {
                            try {
                                \Illuminate\Support\Facades\Mail::to($tester->user->email)->send(new \App\Mail\ContactMail(
                                    'Pengujian Aplikasi Dimulai — PlayTest ID',
                                    'Misi Pengujian Dimulai!',
                                    "Halo {$tester->user->name},\n\nMisi pengujian untuk aplikasi \"" . $this->record->nama_aplikasi . "\" telah resmi dimulai oleh developer.\nSilakan mulai mengunduh aplikasi dan selesaikan tugas harian Anda selama 14 hari kedepan.",
                                    'Lihat Misi Saya',
                                    url('/tester/misi-saya')
                                ));
                            } catch (\Exception $e) {
                                \Illuminate\Support\Facades\Log::error('Gagal mengirim email misi dimulai ke ' . $tester->user->email . ': ' . $e->getMessage());
                            }
                        }
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Misi Berhasil Dimulai')
                        ->body('Status misi telah diubah menjadi running dan sub-misi tester telah dibuat.')
                        ->success()
                        ->send();
                }),
        ];
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
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'accepted' => 'Diterima',
                        'progress' => 'Berlangsung',
                        'submitted' => 'Menunggu',
                        'selesai' => 'Selesai',
                        'failed' => 'Gagal',
                        'rejected' => 'Ditolak',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'accepted' => 'info',
                        'progress' => 'warning',
                        'submitted' => 'primary',
                        'selesai' => 'success',
                        'failed' => 'danger',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                \Filament\Tables\Columns\ViewColumn::make('badge')
                    ->label('Badge')
                    ->view('filament.developer.resources.misis.columns.badge-column'),

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

                        // Kirim email notifikasi bahwa pendaftaran ditolak
                        $user = $record->user;
                        $misi = $record->misi;
                        if ($user && $user->email && $misi) {
                            try {
                                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ContactMail(
                                    'Pendaftaran Pengujian Ditolak — PlayTest ID',
                                    'Pendaftaran Ditolak',
                                    "Halo {$user->name},\n\nMohon maaf, pendaftaran Anda untuk mengikuti pengujian aplikasi \"" . $misi->nama_aplikasi . "\" belum diterima oleh developer saat ini.",
                                    'Cari Misi Lain',
                                    url('/tester')
                                ));
                            } catch (\Exception $e) {
                                \Illuminate\Support\Facades\Log::error('Gagal mengirim email pendaftaran ditolak ke ' . $user->email . ': ' . $e->getMessage());
                            }
                        }

                        \Filament\Notifications\Notification::make()
                            ->title('Tester Ditolak')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
