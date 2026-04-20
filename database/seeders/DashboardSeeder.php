<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;
use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\User;

class DashboardSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure a few Packages exist
        $p1 = Paket::updateOrCreate(['id' => 1], [
            'name' => 'Basic Playtest',
            'price' => 250000,
            'fee' => 5000,
            'desc' => '20 Testers, Low Price, Standard Quality',
            'most_popular' => false,
            'point' => 100,
        ]);

        $p2 = Paket::updateOrCreate(['id' => 2], [
            'name' => 'Premium Playtest',
            'price' => 650000,
            'fee' => 20000,
            'desc' => '50 Trusted Testers, Warranty',
            'most_popular' => true,
            'point' => 250,
        ]);

        // 2. Get the developer user
        $dev = User::where('email', 'developer@example.com')->first();
        if (!$dev) return;

        // 3. Create Sample Missions
        $m1 = Misi::create([
            'id_user' => $dev->id,
            'id_paket' => $p1->id,
            'nama_aplikasi' => 'Fitness Tracker Pro',
            'link_aplikasi' => 'https://play.google.com/store/apps/details?id=com.fitness.pro',
            'instruksi' => 'Test the workout logging feature.',
            'status' => 'In Progress',
            'point' => 100,
        ]);

        $m2 = Misi::create([
            'id_user' => $dev->id,
            'id_paket' => $p1->id,
            'nama_aplikasi' => 'Eco Saver App',
            'link_aplikasi' => 'https://play.google.com/store/apps/details?id=com.eco.saver',
            'instruksi' => 'Test the carbon footprint calculator.',
            'status' => 'Pending',
            'point' => 100,
        ]);

        $m3 = Misi::create([
            'id_user' => $dev->id,
            'id_paket' => $p2->id,
            'nama_aplikasi' => 'Recipe Master',
            'link_aplikasi' => 'https://play.google.com/store/apps/details?id=com.recipe.master',
            'instruksi' => 'Test the meal planner.',
            'status' => 'Completed',
            'point' => 250,
        ]);

        // 4. Create some Testers (using existing users or creating dummy ones)
        // For simplicity, let's just create 3 dummy testers
        for ($i = 1; $i <= 3; $i++) {
            $tester = User::create([
                'name' => "Tester $i",
                'email' => "tester$i@example.com",
                'password' => bcrypt('password'),
                'role' => 'tester',
            ]);

            // Add them to some missions
            MisiAnggota::create(['id_misi' => $m1->id, 'id_user' => $tester->id, 'status' => 'joined']);
            MisiAnggota::create(['id_misi' => $m3->id, 'id_user' => $tester->id, 'status' => 'completed']);
        }
    }
}
