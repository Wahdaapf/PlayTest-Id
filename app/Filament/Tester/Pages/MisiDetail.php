<?php

namespace App\Filament\Tester\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class MisiDetail extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = null;

    protected string $view = 'filament.tester.pages.misi-detail';

    protected static ?string $title = 'Detail Misi';

    // Sembunyikan dari sidebar navigation
    protected static bool $shouldRegisterNavigation = false;

    // Query param: misi_id
    public ?int $misi_id = null;

    public function mount(): void
    {
        $this->misi_id = (int) request()->query('misi_id');
    }

    public function getMisi(): ?Misi
    {
        if (!$this->misi_id) return null;
        return Misi::with(['paket'])->find($this->misi_id);
    }

    public function getAlreadyJoined(): bool
    {
        if (!$this->misi_id) return false;
        return MisiAnggota::where('id_user', Auth::id())
            ->where('id_misi', $this->misi_id)
            ->exists();
    }

    public function getMisiAnggota(): ?MisiAnggota
    {
        if (!$this->misi_id) return null;
        return MisiAnggota::where('id_user', Auth::id())
            ->where('id_misi', $this->misi_id)
            ->first();
    }

    public function takeMission(): void
    {
        $misi = $this->getMisi();
        if (!$misi) return;

        if ($this->getAlreadyJoined()) {
            Notification::make()
                ->title('Peringatan')
                ->warning()
                ->body('Anda sudah bergabung dengan misi ini.')
                ->send();
            return;
        }

        $maxCapacity = config('missions.max_capacity', 20);
        if ($misi->kapasitas >= $maxCapacity || $misi->status === 'closed') {
            Notification::make()
                ->title('Misi Penuh')
                ->danger()
                ->body('Kapasitas misi ini sudah penuh.')
                ->send();
            return;
        }

        // Tentukan status pendaftaran
        if ($misi->paket && $misi->paket->trusted_badge) {
            $status = 'pending';
        } else {
            $status = 'accepted';
        }

        MisiAnggota::create([
            'id_misi' => $misi->id,
            'id_user' => Auth::id(),
            'status'  => $status,
        ]);

        $misi->increment('kapasitas');

        if ($misi->kapasitas >= $maxCapacity) {
            $misi->update(['status' => 'closed']);
        }

        if ($status === 'pending') {
            Notification::make()
                ->title('Pendaftaran Berhasil Dikirim! ⏳')
                ->success()
                ->body('Pendaftaran Anda sedang menunggu persetujuan developer.')
                ->send();
        } else {
            Notification::make()
                ->title('Berhasil Bergabung! 🎉')
                ->success()
                ->body('Anda telah diterima di misi ini. Tunggu developer memulai misi.')
                ->send();
        }
    }

    public function getViewData(): array
    {
        $misi        = $this->getMisi();
        $alreadyJoined = $this->getAlreadyJoined();
        $misiAnggota = $this->getMisiAnggota();

        return [
            'misi'         => $misi,
            'alreadyJoined' => $alreadyJoined,
            'misiAnggota'  => $misiAnggota,
        ];
    }
}
