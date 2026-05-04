<?php

namespace App\Filament\Tester\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class MisiSaya extends Page
{
    use WithFileUploads;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected string $view = 'filament.tester.pages.misi-saya';

    protected static ?string $navigationLabel = 'Misi Saya';

    protected static ?string $title = 'Misi Saya';

    protected static string | \UnitEnum | null $navigationGroup = 'Menu';

    protected static ?int $navigationSort = 2;

    // ─── State Livewire ───────────────────────────────────────────
    public bool $showSubmitForm = false;
    public ?int $selectedMissionId = null;
    public $screenshot = null;

    // ─── Navigation Badge ─────────────────────────────────────────
    public static function getNavigationBadge(): ?string
    {
        if (!Auth::check()) return null;

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
        $misiAnggotas = MisiAnggota::where('id_user', $userId)
            ->whereIn('status', ['accepted', 'progress'])
            ->with('misi')
            ->get();

        $data = [];
        foreach ($misiAnggotas as $ma) {
            $m = $ma->misi;
            if (!$m) continue;

            $diff = $m->created_at->diffInDays(now());
            $hari = min((int) $diff + 1, 14);
            $persen = round(($hari / 14) * 100);

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

            $data[$m->id] = [
                'id'         => $m->id,
                'name'       => $m->nama_aplikasi,
                'type'       => $m->id % 2 === 0 ? 'Functional Testing' : 'UX Research',
                'day'        => $hari,
                'total_days' => 14,
                'status'     => 'Aktif',
                'points'     => $m->point,
                'color'      => $color,
                'initials'   => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                'progress'   => $persen,
                'today_status' => $todayStatus,
                'days_history' => $daysHistory,
            ];
        }

        return $data;
    }

    // ─── Actions ──────────────────────────────────────────────────
    public function openSubmitForm(int $missionId): void
    {
        $this->selectedMissionId = $missionId;
        $this->showSubmitForm    = true;
        $this->screenshot        = null;
        $this->resetValidation();
    }

    public function backToList(): void
    {
        $this->showSubmitForm    = false;
        $this->selectedMissionId = null;
        $this->screenshot        = null;
        $this->resetValidation();
    }

    public function submitTask(): void
    {
        $this->validate([
            'screenshot' => ['required', 'image', 'max:10240'],
        ], [
            'screenshot.required' => 'Screenshot wajib diunggah.',
            'screenshot.image'    => 'File harus berupa gambar (jpg, png, dll).',
            'screenshot.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        $misi = Misi::find($this->selectedMissionId);
        if (!$misi) {
            Notification::make()
                ->title('Error')
                ->body('Misi tidak ditemukan.')
                ->danger()
                ->send();
            return;
        }

        $diff = $misi->created_at->diffInDays(now());
        $hari = min($diff + 1, 14);

        // Cek apakah sudah submit hari ini
        $existingSub = MisiSub::where('id_misi', $this->selectedMissionId)
            ->where('id_user', Auth::id())
            ->where('hari_ke', $hari)
            ->first();
            
        if ($existingSub) {
            Notification::make()
                ->title('Gagal')
                ->body('Anda sudah mensubmit tugas untuk hari ini.')
                ->danger()
                ->send();
            return;
        }

        // Simpan file
        $path = $this->screenshot->store('task-screenshots', 'public');

        // Buat record
        MisiSub::create([
            'id_misi' => $this->selectedMissionId,
            'id_user' => Auth::id(),
            'hari_ke' => $hari,
            'image'   => $path,
            'desc'    => 'Daily Task Submission',
            'status'  => 'pending',
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
        if (! $this->selectedMissionId) {
            return null;
        }

        return $this->getMissionsData()[$this->selectedMissionId] ?? null;
    }
}