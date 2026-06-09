<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiReport extends Model
{
    protected $table = 'ai_reports';

    protected $fillable = [
        'id_misi',
        'hari_ke',
        'result',
        'feedback_count',
    ];

    public function misi(): BelongsTo
    {
        return $this->belongsTo(Misi::class, 'id_misi');
    }
}
