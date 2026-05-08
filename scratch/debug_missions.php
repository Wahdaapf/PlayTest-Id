<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use Carbon\Carbon;

$userId = 4;
$user = App\Models\User::find($userId);
if (!$user) {
    echo "User $userId not found\n";
    exit;
}

echo "Checking missions for User ID: $userId ($user->name)\n";

$misiAnggotas = MisiAnggota::where('id_user', $userId)->get();

foreach ($misiAnggotas as $ma) {
    $misi = $ma->misi;
    echo "Mission: " . ($misi->nama_aplikasi ?? 'Unknown') . " (ID: $ma->id_misi)\n";
    echo "  Status Anggota: $ma->status\n";
    echo "  Join Date: $ma->created_at\n";
    echo "  Mission Created: " . ($misi->created_at ?? 'N/A') . "\n";
    
    $today = Carbon::today()->toDateString();
    $yesterday = Carbon::yesterday()->toDateString();
    
    $diffJoin = Carbon::parse($misi->created_at)->startOfDay()->diffInDays(Carbon::parse($ma->created_at)->startOfDay());
    $hariJoin = (int) $diffJoin + 1;
    
    $diffYesterday = Carbon::parse($misi->created_at)->startOfDay()->diffInDays(Carbon::yesterday()->startOfDay());
    $hariYesterday = (int) $diffYesterday + 1;
    
    echo "  hariJoin: $hariJoin, hariYesterday: $hariYesterday\n";
    
    if ($hariYesterday >= $hariJoin && $hariYesterday <= 14) {
        $sub = MisiSub::where('id_user', $userId)
            ->where('id_misi', $ma->id_misi)
            ->where('hari_ke', $hariYesterday)
            ->first();
        
        if (!$sub) {
            echo "  Result: FAIL (No sub for hari_ke $hariYesterday)\n";
        } else {
            echo "  Sub status for hari_ke $hariYesterday: $sub->status\n";
            if ($sub->status === 'notdone') {
                echo "  Result: FAIL (Status is notdone)\n";
            } else {
                echo "  Result: OK\n";
            }
        }
    } else {
        echo "  Result: SKIPPED check (Yesterday was before join or out of range)\n";
    }
}
