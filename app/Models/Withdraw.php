<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdraw extends Model
{
    protected $table = 'withdraw';

    protected $fillable = [
        'id_user',
        'id_admin',
        'point',
        'rupiah',
        'metode',
        'nomor_akun',
        'image',
        'status',
        'catatan',
    ];

    /**
     * Konversi rate: 1 point = Rp 71.43 (approx)
     * 150 point = Rp 10.000
     * 
     * Denominasi yang tersedia:
     * - 150 pts  = Rp 10.000
     * - 375 pts  = Rp 25.000
     * - 750 pts  = Rp 50.000
     * - 1500 pts = Rp 100.000
     * 
     * Minimum withdrawal: 150 point
     */
    public const RATE_PER_POINT = 66.67; // Rp per point (10000 / 150)
    public const MIN_POINT = 150;

    /**
     * Denominasi withdrawal yang tersedia
     */
    public const DENOMINATIONS = [
        ['point' => 150,  'rupiah' => 10000],
        ['point' => 225,  'rupiah' => 15000],
        ['point' => 375,  'rupiah' => 25000],
        ['point' => 750,  'rupiah' => 50000],
        ['point' => 1125, 'rupiah' => 75000],
        ['point' => 1500, 'rupiah' => 100000],
        ['point' => 2250, 'rupiah' => 150000],
        ['point' => 3000, 'rupiah' => 200000],
    ];

    /**
     * Metode pembayaran yang tersedia
     */
    public const METHODS = [
        'gopay'     => 'GoPay',
        'dana'      => 'DANA',
        'shopeepay' => 'ShopeePay',
        'ovo'       => 'OVO',
        'bca'       => 'BCA',
        'mandiri'   => 'Mandiri',
        'bni'       => 'BNI',
        'bri'       => 'BRI',
        'bsi'       => 'BSI',
    ];

    /**
     * Konversi point ke rupiah
     */
    public static function pointToRupiah(int $point): int
    {
        return (int) round($point * self::RATE_PER_POINT);
    }

    /**
     * Konversi rupiah ke point
     */
    public static function rupiahToPoint(int $rupiah): int
    {
        return (int) ceil($rupiah / self::RATE_PER_POINT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
