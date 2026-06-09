<?php

namespace App\Filament\Tester\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use Carbon\Carbon;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class MisiSaya extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected string $view = 'filament.tester.pages.misi-saya';
    public static function getNavigationLabel(): string
    {
        return __('Misi Saya');
    }

    public function getTitle(): string
    {
        return __('Misi Saya');
    }

    protected static string|\UnitEnum|null $navigationGroup = 'Menu';

    protected static ?int $navigationSort = 2;

    // ─── State Livewire ───────────────────────────────────────────
    public bool $showSubmitForm = false;
    public ?int $selectedMissionId = null;
    public ?array $data = [];

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                FileUpload::make('screenshot')
                    ->label('')
                    ->image()
                    ->required()
                    ->maxSize(10240)
                    ->disk('public')
                    ->directory('task-screenshots')
                    ->imageEditor()
                    ->helperText(__('Upload screenshot bukti task di sini (maks. 10MB)')),

                Textarea::make('catatan_tester')
                    ->label(__('Catatan / Feedback (Opsional)'))
                    ->placeholder(__('Tuliskan bug yang ditemukan, saran UI/UX, atau pengalaman menggunakan aplikasi...'))
                    ->rows(4)
                    ->maxLength(1000)
                    ->helperText(__('Catatan ini akan membantu developer meningkatkan kualitas aplikasinya.')),
            ])
            ->statePath('data');
    }

    // ─── Navigation Badge ─────────────────────────────────────────
    public static function getNavigationBadge(): ?string
    {
        if (!Auth::check())
            return null;

        $count = MisiAnggota::where('id_user', Auth::id())
            ->whereIn('status', ['accepted', 'progress'])
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    // ─── Data Misi (Live dari DB) ──────────────────
    public function getMissionsData(): array
    {
        $userId = Auth::id();

        // ── 0. Cek Absensi Misi Kemarin (H-1) ──────────────────
        $this->checkMissedSubmissions($userId);

        $misiAnggotas = MisiAnggota::where('id_user', $userId)
            ->whereIn('status', ['accepted', 'progress', 'failed'])
            ->with('misi')
            ->get();

        $data = [];
        foreach ($misiAnggotas as $ma) {
            $m = $ma->misi;
            if (!$m)
                continue;

            // Hanya ambil record yang sudah benar-benar disubmit (bukan 'notdone')
            $lastSub = MisiSub::where('id_misi', $m->id)
                ->where('id_user', $userId)
                ->whereIn('status', ['pending', 'done', 'rejected'])
                ->orderBy('hari_ke', 'desc')
                ->first();

            if ($lastSub) {
                if ($lastSub->created_at && $lastSub->created_at->format('Y-m-d') === now()->toDateString()) {
                    $hari = $lastSub->hari_ke;
                } else {
                    $hari = min($lastSub->hari_ke + 1, 14); // cap agar tidak melebihi 14
                }
            } else {
                $hari = 1;
            }
            $persen = min(round(($hari / 14) * 100), 100); // cap persentase maksimal 100%

            $colors = ['#10b981', '#8b5cf6', '#3b82f6', '#f59e0b'];
            $color = $colors[$m->id % count($colors)];

            $subs = MisiSub::where('id_misi', $m->id)
                ->where('id_user', $userId)
                ->where('status', '!=', 'notdone')
                ->latest()
                ->get();

            // Cek status submit hari ini
            $todaySub = $subs->where('hari_ke', $hari)->first();
            $todayStatus = $todaySub ? $todaySub->status : 'none';

            // Generate history 14 days
            $daysHistory = [];
            for ($h = 1; $h <= 14; $h++) {
                $sub = $subs->firstWhere('hari_ke', $h);
                if ($sub) {
                    $daysHistory[$h] = $sub->status; // 'done', 'pending', 'rejected'
                } else {
                    $daysHistory[$h] = 'notdone';
                }
            }

            $statusLabel = 'Aktif';
            if ($ma->status === 'failed')
                $statusLabel = 'Gagal';
            elseif ($ma->status === 'selesai')
                $statusLabel = 'Selesai';

            $data[$m->id] = [
                'id' => $m->id,
                'name' => $m->nama_aplikasi,
                'type' => $m->id % 2 === 0 ? 'Functional Testing' : 'UX Research',
                'day' => $hari,
                'total_days' => 14,
                'status' => $statusLabel,
                'points' => $m->point,
                'color' => $color,
                'initials' => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                'progress' => $persen,
                'today_status' => $todayStatus,
                'days_history' => $daysHistory,
                'link_aplikasi' => $m->link_aplikasi,
                'logo' => $m->logo,
                'ma_status' => $ma->status,
            ];
        }

        return $data;
    }

    // ─── Actions ──────────────────────────────────────────────────
    public function openSubmitForm(int $missionId): void
    {
        $this->selectedMissionId = $missionId;
        $this->showSubmitForm = true;
        $this->form->fill();
    }

    public function backToList(): void
    {
        $this->showSubmitForm = false;
        $this->selectedMissionId = null;
        $this->form->fill();
    }

    public function submitTask(): void
    {
        $data = $this->form->getState();

        $misi = Misi::find($this->selectedMissionId);
        if (!$misi) {
            Notification::make()
                ->title('Error')
                ->body('Misi tidak ditemukan.')
                ->danger()
                ->send();
            return;
        }

        // Cari record jadwal untuk hari ini
        $currentSub = MisiSub::where('id_misi', $this->selectedMissionId)
            ->where('id_user', Auth::id())
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if (!$currentSub) {
            // Hitung hari_ke (cari nilai max hari_ke sebelumnya yang sudah disubmit, lalu tambah 1)
            $lastSub = MisiSub::where('id_misi', $this->selectedMissionId)
                ->where('id_user', Auth::id())
                ->whereIn('status', ['pending', 'done', 'rejected'])
                ->orderBy('hari_ke', 'desc')
                ->first();

            $hariKe = $lastSub ? $lastSub->hari_ke + 1 : 1;

            if ($hariKe > 14) {
                Notification::make()
                    ->title('Selesai')
                    ->body('Anda sudah menyelesaikan 14 hari tugas untuk misi ini.')
                    ->warning()
                    ->send();
                return;
            }

            // Buat record MisiSub baru untuk hari ini
            $currentSub = MisiSub::create([
                'id_misi' => $this->selectedMissionId,
                'id_user' => Auth::id(),
                'hari_ke' => $hariKe,
                'status' => 'notdone', // will be updated below
            ]);
        }

        // Cek apakah sudah submit (status selain 'notdone' dan 'rejected' dianggap sudah submit)
        if (in_array($currentSub->status, ['pending', 'done'])) {
            Notification::make()
                ->title('Gagal')
                ->body('Anda sudah mensubmit tugas untuk hari ini.')
                ->danger()
                ->send();
            return;
        }

        // File sudah otomatis terupload di disk public/task-screenshots oleh Filament
        $path = $data['screenshot'];

        // Update record
        $currentSub->update([
            'image'          => $path,
            'desc'           => 'Daily Task Submission',
            'catatan_tester' => $data['catatan_tester'] ?? null,
            'alasan_tolak'   => null,
            'status'         => 'pending',
        ]);

        Notification::make()
            ->title('Task berhasil disubmit! 🎉')
            ->body('Screenshot kamu sedang dalam proses review.')
            ->success()
            ->send();

        $this->backToList();
    }

    public function getSelectedMission(): ?array
    {
        if (!$this->selectedMissionId) {
            return null;
        }

        return $this->getMissionsData()[$this->selectedMissionId] ?? null;
    }
    public function getStats(): array
    {
        $userId = Auth::id();

        $misiSelesai = MisiAnggota::where('id_user', $userId)->where('status', 'selesai')->count();
        $misiAktif = MisiAnggota::where('id_user', $userId)->whereIn('status', ['accepted', 'progress'])->count();

        $poinPending = MisiAnggota::where('id_user', $userId)
            ->whereIn('status', ['accepted', 'progress', 'submitted'])
            ->with('misi')
            ->get()
            ->sum(fn($ma) => $ma->misi->point ?? 0);

        return [
            'selesai' => $misiSelesai,
            'aktif' => $misiAktif,
            'pending' => $poinPending,
        ];
    }

    protected function checkMissedSubmissions($userId)
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $today = Carbon::today()->toDateString();

        $activeMissions = MisiAnggota::where('id_user', $userId)
            ->where('status', 'accepted')
            ->with('misi')
            ->get();

        foreach ($activeMissions as $ma) {
            $misi = $ma->misi;
            if (!$misi)
                continue;

            $joinDate = $ma->created_at->toDateString();
            if ($joinDate >= $today)
                continue;

            // Cek apakah ada submission kemarin
            $subYesterday = MisiSub::where('id_user', $userId)
                ->where('id_misi', $ma->id_misi)
                ->whereDate('created_at', $yesterday)
                ->first();

            if (!$subYesterday) {
                // Hitung total submit sebelum hari ini
                $totalSub = MisiSub::where('id_user', $userId)
                    ->where('id_misi', $ma->id_misi)
                    ->whereDate('created_at', '<', $today)
                    ->count();

                if ($totalSub < 14) {
                    $ma->update(['status' => 'failed']);

                    // Kirim email notifikasi bahwa tester gagal karena absen submit tugas
                    $user = Auth::user();
                    if ($user && $user->email) {
                        try {
                            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ContactMail(
                                'Pengujian Aplikasi Gagal — PlayTest ID',
                                'Misi Pengujian Gagal',
                                "Halo {$user->name},\n\nAnda terdeteksi tidak mengirimkan laporan tugas harian pada hari kemarin untuk pengujian aplikasi \"" . $misi->nama_aplikasi . "\".\nSesuai aturan, Anda dinyatakan gagal menyelesaikan pengujian ini.",
                                'Lihat Riwayat Misi',
                                url('/tester/misi-saya')
                            ));
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal mengirim email tester gagal ke ' . $user->email . ': ' . $e->getMessage());
                        }
                    }

                    $misi->decrement('kapasitas');
                    if ($misi->status === 'closed') {
                        $misi->update(['status' => 'open']);
                    }
                }
            }
        }
    }
}
