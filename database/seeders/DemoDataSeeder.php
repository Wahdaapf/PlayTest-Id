<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        // B1. Tambah 3 user tester demo
        \Illuminate\Support\Facades\DB::table('users')->upsert([
            [
                'id' => 22,
                'name' => 'Tester Demo 1',
                'email' => 'testerdemo1@playtest.id',
                'google_id' => null,
                'email_verified_at' => $now,
                'password' => '$2y$12$Toh8APoZWTf5iUtf5ehRbeQWyVbywVwh7.ZwioMSSGPiLUnktFbTy',
                'role' => 'tester',
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 23,
                'name' => 'Tester Demo 2',
                'email' => 'testerdemo2@playtest.id',
                'google_id' => null,
                'email_verified_at' => $now,
                'password' => '$2y$12$JAxsoi/fUIXrYu9bKsLsa.EKdpOnSOctsI0N58hzuNSEk7hiHg7qi',
                'role' => 'tester',
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 24,
                'name' => 'Tester Demo 3',
                'email' => 'testerdemo3@playtest.id',
                'google_id' => null,
                'email_verified_at' => $now,
                'password' => '$2y$12$5v2M9BnlEw1.1rIu5r3f6O.73Y8.M0TO8FeYYrcdiWbIo0h9eRaE2',
                'role' => 'tester',
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ], ['id'], ['updated_at']);

        // B2. User balance untuk tester baru
        \Illuminate\Support\Facades\DB::table('user_balance')->upsert([
            ['id_user' => 22, 'point' => 0, 'badge' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id_user' => 23, 'point' => 0, 'badge' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id_user' => 24, 'point' => 0, 'badge' => 3, 'created_at' => $now, 'updated_at' => $now],
        ], ['id_user'], ['updated_at']);

        // B3. Misi demo (developer = id 18, paket Premium = id 5)
        \Illuminate\Support\Facades\DB::table('misi')->upsert([
            [
                'id' => 41,
                'id_user' => 18,
                'id_paket' => 5,
                'nama_aplikasi' => 'EduKid - Belajar Seru',
                'logo' => null,
                'link_aplikasi' => 'https://play.google.com/store/apps/details?id=com.edukid.app',
                'instruksi' => 'Install aplikasi, buka semua menu, coba fitur kuis dan cerita interaktif, screenshot halaman utama setelah digunakan minimal 5 menit.',
                'status' => 'running',
                'point' => 15000,
                'kapasitas' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ], ['id'], ['status', 'updated_at']);

        // B4. Misi anggota (3 tester bergabung)
        \Illuminate\Support\Facades\DB::table('misi_anggota')->upsert([
            ['id' => 22, 'id_misi' => 41, 'id_user' => 22, 'status' => 'progress', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 23, 'id_misi' => 41, 'id_user' => 23, 'status' => 'progress', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 24, 'id_misi' => 41, 'id_user' => 24, 'status' => 'progress', 'created_at' => $now, 'updated_at' => $now],
        ], ['id'], ['status', 'updated_at']);

        // B5. Misi Sub
        \Illuminate\Support\Facades\DB::table('misi_sub')->upsert([
            // TESTER DEMO 1 (id_user=22)
            ['id' => 197, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 1, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Aplikasi berhasil diinstall dan dibuka. Tampilan awal cukup menarik untuk anak-anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 198, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 2, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur cerita interaktif berjalan lancar. Animasi karakter lucu dan responsif.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 199, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 3, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur kuis berjalan baik. Suara feedback benar/salah menyenangkan untuk anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 200, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 4, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur progress anak bisa dilihat orang tua. Sangat berguna untuk monitoring.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 201, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 5, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Tidak ada crash hari ini. Semua fitur berjalan normal dan stabil.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 202, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 6, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur daily challenge menarik, anak saya antusias membuka aplikasi tiap hari.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 203, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 7, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Loading konten cerita lambat saat koneksi 4G biasa, perlu optimasi lebih lanjut.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 204, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 8, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur audio narasi cerita jernih dan jelas. Pengucapan kata-kata sudah benar.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 205, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 9, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Performa lebih baik dari hari sebelumnya setelah restart HP. Sangat stabil.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 206, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 10, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur leaderboard antar anak memotivasi kompetisi positif di antara pengguna.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 207, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 11, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Mulai terbiasa dengan alur aplikasi. Pengalaman belajar cukup menyenangkan.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 208, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 12, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Aplikasi stabil, tidak ada crash hari ini. Semua konten bisa diakses dengan baik.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 209, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 13, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur cerita sudah sangat lengkap. Konten edukatif berkualitas tinggi untuk anak.', 'alasan_tolak' => null, 'status' => 'pending', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 210, 'id_misi' => 41, 'id_user' => 22, 'hari_ke' => 14, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Pengalaman 14 hari testing menyenangkan. Aplikasi sangat layak untuk anak-anak.', 'alasan_tolak' => null, 'status' => 'pending', 'created_at' => $now, 'updated_at' => $now],

            // TESTER DEMO 2 (id_user=23)
            ['id' => 211, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 1, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Install lancar. Loading splash screen agak lama sekitar 4 detik, perlu dipercepat.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 212, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 2, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Bug: tombol Next di halaman cerita kadang tidak merespons saat ditekan pertama kali, harus ditekan dua kali.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 213, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 3, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Kuis level 3 crash ketika soal nomor 7 dijawab. Harus restart aplikasi untuk melanjutkan.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 214, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 4, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Tombol kembali di halaman kuis tidak berfungsi, harus pakai tombol back dari HP.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 215, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 5, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Iklan muncul di tengah-tengah sesi belajar, sangat mengganggu pengalaman anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 216, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 6, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Aplikasi memakan RAM cukup besar, HP mid-range jadi panas setelah 15 menit pemakaian.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 217, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 7, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Bug kritis: setelah ganti profil anak, progress belajar kembali ke nol. Sangat mengecewakan!', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 218, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 8, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Tidak ada mode offline, semua konten butuh internet aktif. Kurang praktis untuk daerah sinyal lemah.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 219, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 9, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Notifikasi pengingat belajar harian tidak muncul padahal sudah diaktifkan di pengaturan.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 220, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 10, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Crash lagi di level kuis yang sama (level 3 soal 7). Bug ini konsisten dan belum diperbaiki.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 221, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 11, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Tidak ada pilihan bahasa daerah, padahal target pengguna adalah anak-anak Indonesia.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 222, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 12, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Ukuran file update terlalu besar (150MB), sangat boros kuota internet pengguna.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 223, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 13, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Tombol logout tersembunyi di menu, susah ditemukan. Perlu dipindah ke tempat yang lebih jelas.', 'alasan_tolak' => null, 'status' => 'pending', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 224, 'id_misi' => 41, 'id_user' => 23, 'hari_ke' => 14, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Saran utama: segera perbaiki bug crash di kuis level 3 dan tambahkan mode offline.', 'alasan_tolak' => null, 'status' => 'pending', 'created_at' => $now, 'updated_at' => $now],

            // TESTER DEMO 3 (id_user=24)
            ['id' => 225, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 1, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Berhasil masuk ke halaman utama. Warna-warna cerah sangat bagus dan cocok untuk anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 226, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 2, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Menu navigasi bawah mudah dipahami dan dioperasikan oleh anak-anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 227, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 3, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Font huruf terlalu kecil untuk anak usia 4-5 tahun, cukup susah dibaca mandiri.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 228, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 4, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Gambar ilustrasi cerita sangat bagus, detail, dan menarik perhatian anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 229, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 5, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur reward bintang efektif memotivasi anak untuk terus belajar setiap hari.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 230, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 6, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Kategori materi kurang lengkap, saat ini hanya ada matematika dan bahasa saja.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 231, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 7, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'UI secara keseluruhan konsisten dan enak dilihat. Tidak membingungkan pengguna baru.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 232, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 8, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Tombol-tombol terlalu kecil untuk jari anak balita, sering terjadi salah pencet.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 233, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 9, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Desain karakter maskot sangat menggemaskan, anak saya sangat menyukainya.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 234, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 10, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Warna background agak terlalu gelap untuk mode malam, mata anak cepat lelah.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 235, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 11, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Fitur sharing hasil belajar ke media sosial orang tua sangat bagus untuk apresiasi anak.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 236, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 12, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Animasi transisi antar halaman smooth dan tidak patah-patah sama sekali.', 'alasan_tolak' => null, 'status' => 'done', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 237, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 13, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Aplikasi sudah jauh lebih baik dari awal testing. Perkembangan sangat positif.', 'alasan_tolak' => null, 'status' => 'pending', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 238, 'id_misi' => 41, 'id_user' => 24, 'hari_ke' => 14, 'image' => null, 'desc' => 'Daily Task Submission', 'catatan_tester' => 'Secara keseluruhan aplikasi sangat bagus, tinggal perlu polish di beberapa bagian kecil.', 'alasan_tolak' => null, 'status' => 'pending', 'created_at' => $now, 'updated_at' => $now],
        ], ['id'], ['status', 'catatan_tester', 'updated_at']);

        // B6. Pembayaran untuk misi ini
        \Illuminate\Support\Facades\DB::table('pembayaran')->updateOrInsert(
            ['id_user' => 18, 'id_misi' => 41],
            [
                'id_paket' => 5,
                'status' => 'accepted',
                'reference' => 'DEMO-EDUKID-2026',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}
