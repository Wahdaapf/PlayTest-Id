<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MisiAnggota extends Model
{
    protected $table = 'misi_anggota';

    protected $fillable = [
        'id_misi',
        'id_user',
        'status',
    ];

    public function misi(): BelongsTo
    {
        return $this->belongsTo(Misi::class, 'id_misi');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function userBalance(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(
            UserBalance::class,
            User::class,
            'id',        // FK on users
            'id_user',   // FK on user_balance
            'id_user',   // local key on misi_anggota
            'id'         // local key on users
        );
    }
}
