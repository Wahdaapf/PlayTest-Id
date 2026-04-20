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
}
