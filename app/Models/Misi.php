<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Misi extends Model
{
    protected $table = 'misi';

    protected $fillable = [
        'id_user',
        'id_paket',
        'nama_aplikasi',
        'link_aplikasi',
        'instruksi',
        'status',
        'point',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function misiSubs(): HasMany
    {
        return $this->hasMany(MisiSub::class, 'id_misi');
    }

    public function misiAnggotas(): HasMany
    {
        return $this->hasMany(MisiAnggota::class, 'id_misi');
    }

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_misi');
    }
}
