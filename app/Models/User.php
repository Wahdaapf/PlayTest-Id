<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;
use App\Notifications\ResetPasswordNotification;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
        // Admin Master Access
        if ($this->role === UserRole::admin) {
            return true;
        }

        return match ($panel->getId()) {
            'developer' => $this->role === UserRole::developer,
            'tester'    => $this->role === UserRole::tester,
            default     => false,
        };
    }

    public function isAdmin()
    {
        return $this->role === UserRole::admin;
    }

    public function isDev()
    {
        return $this->role === UserRole::developer;
    }

    public function isTester()
    {
        return $this->role === UserRole::tester;
    }

    public function userBalance(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserBalance::class, 'id_user');
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
