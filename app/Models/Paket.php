<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paket extends Model
{
    protected $table = 'paket';

    protected $fillable = [
        'name',
        'price',
        'fee',
        'desc',
        'most_popular',
        'point',
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'fee'          => 'decimal:2',
        'most_popular' => 'boolean',
    ];

    public function misis(): HasMany
    {
        return $this->hasMany(Misi::class, 'id_paket');
    }

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_paket');
    }
}
