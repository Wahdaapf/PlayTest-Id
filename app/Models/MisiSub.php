<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MisiSub extends Model
{
    protected $table = 'misi_sub';

    protected $fillable = [
        'id_misi',
        'id_user',
        'hari_ke',
        'image',
        'desc',
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
