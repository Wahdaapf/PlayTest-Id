<?php

namespace App\Filament\Tester\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class MisiDetail extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.tester.pages.misi-detail';

    protected static bool $shouldRegisterNavigation = false;

    public ?Misi $misi = null;

    public function mount()
    {
        $misiId = request()->query('misi_id');
        $this->misi = Misi::findOrFail($misiId);
    }

    public function takeMission()
    {
        // Double check if user already joined
        $alreadyJoined = MisiAnggota::where('id_misi', $this->misi->id)
            ->where('id_user', Auth::id())
            ->exists();

        if ($alreadyJoined) {
            Notification::make()
                ->title('Already Joined')
                ->warning()
                ->send();
            return;
        }

        // Increment kapasitas
        $this->misi->increment('kapasitas');

        // Create anggota record
        MisiAnggota::create([
            'id_misi' => $this->misi->id,
            'id_user' => Auth::id(),
            'status' => 'reviewing',
        ]);

        Notification::make()
            ->title('Mission Taken Successfully')
            ->success()
            ->send();

        return redirect()->to('/tester');
    }
}
