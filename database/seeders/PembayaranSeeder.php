<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Paket;
use App\Models\Misi;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'developer@example.com')->first();
        if (!$user) {
            $user = User::first();
        }

        $admin = User::where('role', 'admin')->first();
        $paket = Paket::first();
        $misi = Misi::where('nama_aplikasi', 'Fitness Tracker Pro')->first() ?? Misi::first();

        // 1. Success Payment (Paket)
        Pembayaran::create([
            'image' => 'pembayaran/dummy.png',
            'status' => 'success',
            'id_user' => $user->id,
            'id_admin' => $admin?->id,
            'id_paket' => $paket?->id,
        ]);

        // 2. Pending Payment (Misi)
        Pembayaran::create([
            'image' => 'pembayaran/dummy.png',
            'status' => 'pending',
            'id_user' => $user->id,
            'id_paket' => $paket?->id,
            'id_misi' => $misi?->id,
        ]);

        // 3. Failed Payment (Paket)
        Pembayaran::create([
            'image' => 'pembayaran/dummy.png',
            'status' => 'failed',
            'id_user' => $user->id,
            'id_paket' => $paket?->id,
        ]);

        // 4. Another Pending
        Pembayaran::create([
            'image' => 'pembayaran/dummy.png',
            'status' => 'pending',
            'id_user' => $user->id,
            'id_paket' => $paket?->id,
        ]);
    }
}
