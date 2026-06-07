<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdmin extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int    $navigationSort  = 99;

    public static function getNavigationLabel(): string
    {
        return __('Profil Saya');
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return __('Profil Admin');
    }
    protected string $view = 'filament.admin.pages.profile-admin';

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
                Section::make(__('Informasi Akun'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Nama Lengkap'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make(__('Ubah Kata Sandi'))
                    ->description(__('Kosongkan jika tidak ingin mengubah kata sandi.'))
                    ->schema([
                        TextInput::make('current_password')
                            ->label(__('Kata Sandi Saat Ini'))
                            ->password()
                            ->revealable(),
                        TextInput::make('new_password')
                            ->label(__('Kata Sandi Baru'))
                            ->password()
                            ->revealable()
                            ->minLength(8),
                        TextInput::make('new_password_confirmation')
                            ->label(__('Konfirmasi Kata Sandi Baru'))
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
                    ->title(__('Kata sandi saat ini tidak cocok.'))
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
            ->title(__('Profil berhasil diperbarui!'))
            ->success()
            ->send();

        $this->data['current_password'] = null;
        $this->data['new_password'] = null;
        $this->data['new_password_confirmation'] = null;
    }
}
