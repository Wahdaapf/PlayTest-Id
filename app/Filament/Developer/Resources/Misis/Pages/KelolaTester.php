<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;

class KelolaTester extends Page
{
    protected static string $resource = MisiResource::class;

    protected string $view = 'filament.developer.resources.misis.pages.kelola-tester';

    public Misi $record;

    public function mount(Misi $record): void
    {
        $this->record = $record;
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return new \Illuminate\Support\HtmlString('
            <a href="'. MisiResource::getUrl('index') .'" class="text-base font-bold text-slate-500 hover:text-slate-800 flex items-center gap-2 w-fit transition-colors mt-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                '.__('Kembali').'
            </a>
        ');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getViewData(): array
    {
        $testers = MisiAnggota::where('id_misi', $this->record->id)
            ->where('status', '!=', 'rejected')
            ->with('user')
            ->get();

        $colors = ['#2563eb', '#f59e0b', '#8b5cf6', '#10b981', '#ef4444', '#0ea5e9', '#7c3aed'];

        $testerList = $testers->map(function($tester, $idx) use ($colors) {
            $user = $tester->user;
            $names = explode(' ', $user->name ?? 'Unknown User');
            $inisial = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
            
            // Calculate Badge Tier
            $balance = \App\Models\UserBalance::where('id_user', $user->id)->first();
            $badgeCount = $balance->badge ?? 0;
            
            if ($badgeCount <= 5) {
                $tierName = 'Beginner';
                $tierIcon = '🔵';
                $tierColor = 'rgb(59, 130, 246)'; // blue
            } elseif ($badgeCount <= 50) {
                $tierName = 'Intermediate';
                $tierIcon = '🟡';
                $tierColor = 'rgb(217, 119, 6)'; // orange
            } else {
                $tierName = 'Master';
                $tierIcon = '🟣';
                $tierColor = 'rgb(124, 58, 237)'; // purple
            }

            $statusMap = [
                'accepted' => __('Diterima'),
                'progress' => __('Berlangsung'),
                'submitted'=> __('Menunggu'),
                'selesai'  => __('Selesai'),
                'failed'   => __('Gagal'),
                'rejected' => __('Ditolak'),
                'pending'  => __('Menunggu'),
                'reviewing'=> __('Menunggu'),
            ];

            $rawStatus = strtolower($tester->status);

            return [
                'id_misi_anggota' => $tester->id,
                'nama' => $user->name ?? 'Unknown User',
                'email' => $user->email,
                'inisial' => $inisial,
                'avatarColor' => $colors[$idx % count($colors)],
                'raw_status' => $rawStatus,
                'status' => $statusMap[$rawStatus] ?? ucfirst($rawStatus),
                'tanggal' => $tester->created_at->format('d M Y H:i'),
                'badgeTier' => $tierName,
                'badgeIcon' => $tierIcon,
                'badgeColor'=> $tierColor,
            ];
        })->toArray();

        return [
            'statTotal'    => MisiAnggota::where('id_misi', $this->record->id)->count(),
            'statDiterima' => MisiAnggota::where('id_misi', $this->record->id)
                ->whereIn('status', ['accepted', 'progress', 'selesai'])
                ->count(),
            'statMenunggu' => MisiAnggota::where('id_misi', $this->record->id)
                ->whereIn('status', ['pending', 'reviewing', 'submitted'])
                ->count(),
            'statDitolak'  => MisiAnggota::where('id_misi', $this->record->id)
                ->whereIn('status', ['rejected', 'failed'])
                ->count(),
            'testerList'   => $testerList,
        ];
    }

    public function terimaTester($id)
    {
        $record = MisiAnggota::find($id);
        if ($record && in_array($record->status, ['pending', 'reviewing'])) {
            $record->update(['status' => 'accepted']);
            Notification::make()->title(__('Tester Diterima'))->success()->send();
        }
    }

    public function tolakTester($id)
    {
        $record = MisiAnggota::find($id);
        if ($record && in_array($record->status, ['pending', 'reviewing'])) {
            $record->update(['status' => 'rejected']);
            
            if ($record->misi) {
                $record->misi->decrement('kapasitas');
                $record->misi->update(['status' => 'open']);
            }

            $user = $record->user;
            $misi = $record->misi;
            if ($user && $user->email && $misi) {
                try {
                    Mail::to($user->email)->send(new ContactMail(
                        __('Pendaftaran Pengujian Ditolak — PlayTest ID'),
                        __('Pendaftaran Ditolak'),
                        __("Halo :name,\n\nMohon maaf, pendaftaran Anda untuk mengikuti pengujian aplikasi \":aplikasi\" belum diterima oleh developer saat ini.", ['name' => $user->name, 'aplikasi' => $misi->nama_aplikasi]),
                        __('Cari Misi Lain'),
                        url('/tester')
                    ));
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email pendaftaran ditolak ke ' . $user->email . ': ' . $e->getMessage());
                }
            }

            Notification::make()->title(__('Tester Ditolak'))->success()->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('get_emails')
                ->label(__('Ambil List Email Tester'))
                ->icon('heroicon-o-clipboard-document-list')
                ->color('primary')
                ->modalHeading(__('Daftar Email Tester'))
                ->modalDescription(__('Salin daftar email di bawah ini untuk mengundang tester secara massal ke sistem distribusi aplikasi Anda (seperti Google Play Console atau TestFlight).'))
                ->modalWidth('xl')
                ->form([
                    \Filament\Forms\Components\Placeholder::make('emails_view')
                        ->hiddenLabel()
                        ->content(function () {
                            $emails = \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                                ->whereIn('status', ['accepted', 'progress', 'submitted', 'selesai'])
                                ->with('user')
                                ->get()
                                ->pluck('user.email')
                                ->filter()
                                ->unique();
                                
                            $text = $emails->isEmpty() ? __('Belum ada tester aktif yang berpartisipasi.') : $emails->implode(', ');
                            
                            return new \Illuminate\Support\HtmlString('
                                <div class="relative bg-slate-50 border border-slate-200 rounded-xl p-4 mt-2 overflow-hidden group">
                                    <textarea readonly id="testerEmailList" class="w-full bg-transparent border-none p-0 text-sm font-mono text-slate-700 resize-none focus:ring-0 m-0" rows="8">'.htmlspecialchars($text).'</textarea>
                                    
                                    <button type="button" onclick="navigator.clipboard.writeText(document.getElementById(\'testerEmailList\').value); const t = this.querySelector(\'.tooltip-text\'); t.classList.remove(\'opacity-0\'); setTimeout(() => t.classList.add(\'opacity-0\'), 2000);" 
                                            class="absolute top-3 right-3 flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-500 hover:bg-slate-100 hover:text-blue-600 transition-all shadow-sm focus:outline-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        <span class="tooltip-text absolute -top-8 bg-slate-800 text-white text-xs font-semibold px-2 py-1 rounded opacity-0 transition-opacity whitespace-nowrap pointer-events-none">'.__('Tersalin!').'</span>
                                    </button>
                                </div>
                            ');
                        }),
                ])
                ->modalSubmitAction(false)
                ->modalCancelActionLabel(__('Tutup Modal')),

            \Filament\Actions\Action::make('input_link')
                ->label(__('Input Link Aplikasi'))
                ->icon('heroicon-o-link')
                ->color('success')
                ->visible(fn () => in_array($this->record->status, ['open', 'closed']))
                ->form([
                    \Filament\Forms\Components\TextInput::make('link_aplikasi')
                        ->label(__('Link Aplikasi (Misal: Google Play URL)'))
                        ->required()
                        ->url()
                        ->default($this->record->link_aplikasi),
                ])
                ->action(function (array $data) {
                    if ($this->record->paket && $this->record->paket->trusted_badge) {
                        \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                            ->whereIn('status', ['pending', 'reviewing'])
                            ->update(['status' => 'accepted']);
                    }

                    $acceptedTesters = \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                        ->where('status', 'accepted')
                        ->with('user')
                        ->get();

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

                    $this->record->update([
                        'link_aplikasi' => $data['link_aplikasi'],
                        'status' => 'running',
                    ]);

                    \App\Models\MisiAnggota::where('id_misi', $this->record->id)
                        ->where('status', 'accepted')
                        ->update(['status' => 'progress']);

                    foreach ($acceptedTesters as $tester) {
                        if ($tester->user && $tester->user->email) {
                            try {
                                Mail::to($tester->user->email)->send(new ContactMail(
                                    __('Pengujian Aplikasi Dimulai — PlayTest ID'),
                                    __('Misi Pengujian Dimulai!'),
                                    __("Halo :name,\n\nMisi pengujian untuk aplikasi \":aplikasi\" telah resmi dimulai oleh developer.\nSilakan mulai mengunduh aplikasi dan selesaikan tugas harian Anda selama 14 hari kedepan.", ['name' => $tester->user->name, 'aplikasi' => $this->record->nama_aplikasi]),
                                    __('Lihat Misi Saya'),
                                    url('/tester/misi-saya')
                                ));
                            } catch (\Exception $e) {
                                Log::error('Gagal mengirim email misi dimulai ke ' . $tester->user->email . ': ' . $e->getMessage());
                            }
                        }
                    }

                    Notification::make()
                        ->title(__('Misi Berhasil Dimulai'))
                        ->body(__('Status misi telah diubah menjadi running dan sub-misi tester telah dibuat.'))
                        ->success()
                        ->send();
                }),
        ];
    }
}
