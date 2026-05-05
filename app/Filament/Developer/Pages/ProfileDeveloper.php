<?php

namespace App\Filament\Developer\Pages;

use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileDeveloper extends Page implements HasForms
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationLabel = 'Profil Saya';
    protected static ?string $title           = 'Profil Developer';
    protected static ?int    $navigationSort  = 99;
    protected string $view = 'filament.developer.pages.profile-developer';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'name'  => $user->name,
            'email' => $user->email,
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Informasi Akun')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Ubah Password')
                    ->description('Kosongkan jika tidak ingin mengubah password.')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->revealable(),
                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->minLength(8),
                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
                            ->same('new_password'),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        if (!empty($data['new_password'])) {
            if (empty($data['current_password']) || !Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Password saat ini tidak cocok.')
                    ->danger()
                    ->send();
                return;
            }
        }

        $user->name  = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }
        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui!')
            ->success()
            ->send();

        $this->data['current_password'] = null;
        $this->data['new_password'] = null;
        $this->data['new_password_confirmation'] = null;
    }

    public function getStats(): array
    {
        $user = Auth::user();
        $misiCount   = \App\Models\Misi::where('id_user', $user->id)->count();
        $misiSelesai = \App\Models\Misi::where('id_user', $user->id)->where('status', 'selesai')->count();
        $pembayaran  = \App\Models\Pembayaran::where('id_user', $user->id)->latest()->first();

        return [
            'total_misi'   => $misiCount,
            'misi_selesai' => $misiSelesai,
            'paket'        => $pembayaran?->paket?->name ?? 'Belum Berlangganan',
            'member_since' => $user->created_at->format('M Y'),
        ];
    }
}
