-- ============================================================
-- PlayTest ID — Demo Data untuk Hosting
-- Disesuaikan dengan database: playtest_playtest_id
-- Jalankan di phpMyAdmin → tab SQL
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================
-- BAGIAN A — MIGRATION (jalankan SEKALI, struktur baru)
-- ============================================================

-- A1. Tambah catatan_tester & alasan_tolak ke misi_sub
ALTER TABLE `misi_sub`
  ADD COLUMN IF NOT EXISTS `catatan_tester` TEXT NULL AFTER `desc`,
  ADD COLUMN IF NOT EXISTS `alasan_tolak`   TEXT NULL AFTER `catatan_tester`;

-- A2. Tambah kolom ai_report ke tabel paket
ALTER TABLE `paket`
  ADD COLUMN IF NOT EXISTS `ai_report` TINYINT(1) NOT NULL DEFAULT 0 AFTER `trusted_badge`;

-- A3. Buat tabel ai_reports (jika belum ada)
CREATE TABLE IF NOT EXISTS `ai_reports` (
  `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_misi`        BIGINT UNSIGNED NOT NULL,
  `hari_ke`        INT NULL DEFAULT NULL,
  `result`         LONGTEXT NOT NULL,
  `feedback_count` INT NOT NULL DEFAULT 0,
  `created_at`     TIMESTAMP NULL DEFAULT NULL,
  `updated_at`     TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `ai_reports_id_misi_foreign`
    FOREIGN KEY (`id_misi`) REFERENCES `misi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A4. Aktifkan ai_report untuk Paket Premium (id=5, yang punya trusted_badge=1)
UPDATE `paket` SET `ai_report` = 1 WHERE `id` = 5;

-- A5. Catat migration agar php artisan migrate tidak error
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
  ('2026_06_09_000001_add_catatan_tester_to_misi_sub', 99),
  ('2026_06_09_000002_create_ai_reports_table',        99),
  ('2026_06_09_000003_add_ai_report_to_paket',         99);

-- ============================================================
-- BAGIAN B — TESTER DEMO
-- Menggunakan:
--   developer = id 18 (rakaesal@gmail.com / 29_Rakagali Resda)
--   paket     = id 5  (Paket Premium, ai_report=1)
--   tester 1  = id 22 (baru)
--   tester 2  = id 23 (baru)
--   tester 3  = id 24 (baru)
--   misi      = id 41 (baru, lanjut dari AUTO_INCREMENT=41)
--   misi_anggota id = 22,23,24 (lanjut dari AUTO_INCREMENT=22)
--   misi_sub id = 197-238 (lanjut dari AUTO_INCREMENT=197)
-- Password tester: password123
-- ============================================================

-- B1. Tambah 3 user tester demo
INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(22, 'Tester Demo 1', 'testerdemo1@playtest.id', NULL, NOW(), '$2y$12$Toh8APoZWTf5iUtf5ehRbeQWyVbywVwh7.ZwioMSSGPiLUnktFbTy', 'tester', NULL, NOW(), NOW()),
(23, 'Tester Demo 2', 'testerdemo2@playtest.id', NULL, NOW(), '$2y$12$JAxsoi/fUIXrYu9bKsLsa.EKdpOnSOctsI0N58hzuNSEk7hiHg7qi', 'tester', NULL, NOW(), NOW()),
(24, 'Tester Demo 3', 'testerdemo3@playtest.id', NULL, NOW(), '$2y$12$5v2M9BnlEw1.1rIu5r3f6O.73Y8.M0TO8FeYYrcdiWbIo0h9eRaE2', 'tester', NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- B2. User balance untuk tester baru
INSERT INTO `user_balance` (`id_user`, `point`, `badge`, `created_at`, `updated_at`) VALUES
(22, 0, 2, NOW(), NOW()),
(23, 0, 1, NOW(), NOW()),
(24, 0, 3, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- B3. Misi demo (developer = id 18, paket Premium = id 5)
INSERT INTO `misi` (`id`, `id_user`, `id_paket`, `nama_aplikasi`, `logo`, `link_aplikasi`, `instruksi`, `status`, `point`, `kapasitas`, `created_at`, `updated_at`) VALUES
(41, 18, 5,
 'EduKid - Belajar Seru',
 NULL,
 'https://play.google.com/store/apps/details?id=com.edukid.app',
 'Install aplikasi, buka semua menu, coba fitur kuis dan cerita interaktif, screenshot halaman utama setelah digunakan minimal 5 menit.',
 'running',
 15000,
 3,
 NOW(),
 NOW()
)
ON DUPLICATE KEY UPDATE `status` = 'running', `updated_at` = NOW();

-- B4. Misi anggota (3 tester bergabung)
INSERT INTO `misi_anggota` (`id`, `id_misi`, `id_user`, `status`, `created_at`, `updated_at`) VALUES
(22, 41, 22, 'progress', NOW(), NOW()),
(23, 41, 23, 'progress', NOW(), NOW()),
(24, 41, 24, 'progress', NOW(), NOW())
ON DUPLICATE KEY UPDATE `status` = 'progress', `updated_at` = NOW();

-- B5. Misi Sub — 42 record: 3 tester × 14 hari
--     Hari 1-12 = done, Hari 13-14 = pending (butuh validasi)
INSERT INTO `misi_sub` (`id`, `id_misi`, `id_user`, `hari_ke`, `image`, `desc`, `catatan_tester`, `alasan_tolak`, `status`, `created_at`, `updated_at`) VALUES

-- === TESTER DEMO 1 (id_user=22) ===
(197, 41, 22, 1,  NULL, 'Daily Task Submission', 'Aplikasi berhasil diinstall dan dibuka. Tampilan awal cukup menarik untuk anak-anak.',                              NULL, 'done',    NOW(), NOW()),
(198, 41, 22, 2,  NULL, 'Daily Task Submission', 'Fitur cerita interaktif berjalan lancar. Animasi karakter lucu dan responsif.',                                      NULL, 'done',    NOW(), NOW()),
(199, 41, 22, 3,  NULL, 'Daily Task Submission', 'Fitur kuis berjalan baik. Suara feedback benar/salah menyenangkan untuk anak.',                                      NULL, 'done',    NOW(), NOW()),
(200, 41, 22, 4,  NULL, 'Daily Task Submission', 'Fitur progress anak bisa dilihat orang tua. Sangat berguna untuk monitoring.',                                       NULL, 'done',    NOW(), NOW()),
(201, 41, 22, 5,  NULL, 'Daily Task Submission', 'Tidak ada crash hari ini. Semua fitur berjalan normal dan stabil.',                                                  NULL, 'done',    NOW(), NOW()),
(202, 41, 22, 6,  NULL, 'Daily Task Submission', 'Fitur daily challenge menarik, anak saya antusias membuka aplikasi tiap hari.',                                      NULL, 'done',    NOW(), NOW()),
(203, 41, 22, 7,  NULL, 'Daily Task Submission', 'Loading konten cerita lambat saat koneksi 4G biasa, perlu optimasi lebih lanjut.',                                   NULL, 'done',    NOW(), NOW()),
(204, 41, 22, 8,  NULL, 'Daily Task Submission', 'Fitur audio narasi cerita jernih dan jelas. Pengucapan kata-kata sudah benar.',                                      NULL, 'done',    NOW(), NOW()),
(205, 41, 22, 9,  NULL, 'Daily Task Submission', 'Performa lebih baik dari hari sebelumnya setelah restart HP. Sangat stabil.',                                        NULL, 'done',    NOW(), NOW()),
(206, 41, 22, 10, NULL, 'Daily Task Submission', 'Fitur leaderboard antar anak memotivasi kompetisi positif di antara pengguna.',                                      NULL, 'done',    NOW(), NOW()),
(207, 41, 22, 11, NULL, 'Daily Task Submission', 'Mulai terbiasa dengan alur aplikasi. Pengalaman belajar cukup menyenangkan.',                                        NULL, 'done',    NOW(), NOW()),
(208, 41, 22, 12, NULL, 'Daily Task Submission', 'Aplikasi stabil, tidak ada crash hari ini. Semua konten bisa diakses dengan baik.',                                  NULL, 'done',    NOW(), NOW()),
(209, 41, 22, 13, NULL, 'Daily Task Submission', 'Fitur cerita sudah sangat lengkap. Konten edukatif berkualitas tinggi untuk anak.',                                  NULL, 'pending', NOW(), NOW()),
(210, 41, 22, 14, NULL, 'Daily Task Submission', 'Pengalaman 14 hari testing menyenangkan. Aplikasi sangat layak untuk anak-anak.',                                    NULL, 'pending', NOW(), NOW()),

-- === TESTER DEMO 2 (id_user=23) ===
(211, 41, 23, 1,  NULL, 'Daily Task Submission', 'Install lancar. Loading splash screen agak lama sekitar 4 detik, perlu dipercepat.',                                 NULL, 'done',    NOW(), NOW()),
(212, 41, 23, 2,  NULL, 'Daily Task Submission', 'Bug: tombol Next di halaman cerita kadang tidak merespons saat ditekan pertama kali, harus ditekan dua kali.',       NULL, 'done',    NOW(), NOW()),
(213, 41, 23, 3,  NULL, 'Daily Task Submission', 'Kuis level 3 crash ketika soal nomor 7 dijawab. Harus restart aplikasi untuk melanjutkan.',                          NULL, 'done',    NOW(), NOW()),
(214, 41, 23, 4,  NULL, 'Daily Task Submission', 'Tombol kembali di halaman kuis tidak berfungsi, harus pakai tombol back dari HP.',                                   NULL, 'done',    NOW(), NOW()),
(215, 41, 23, 5,  NULL, 'Daily Task Submission', 'Iklan muncul di tengah-tengah sesi belajar, sangat mengganggu pengalaman anak.',                                     NULL, 'done',    NOW(), NOW()),
(216, 41, 23, 6,  NULL, 'Daily Task Submission', 'Aplikasi memakan RAM cukup besar, HP mid-range jadi panas setelah 15 menit pemakaian.',                              NULL, 'done',    NOW(), NOW()),
(217, 41, 23, 7,  NULL, 'Daily Task Submission', 'Bug kritis: setelah ganti profil anak, progress belajar kembali ke nol. Sangat mengecewakan!',                       NULL, 'done',    NOW(), NOW()),
(218, 41, 23, 8,  NULL, 'Daily Task Submission', 'Tidak ada mode offline, semua konten butuh internet aktif. Kurang praktis untuk daerah sinyal lemah.',               NULL, 'done',    NOW(), NOW()),
(219, 41, 23, 9,  NULL, 'Daily Task Submission', 'Notifikasi pengingat belajar harian tidak muncul padahal sudah diaktifkan di pengaturan.',                           NULL, 'done',    NOW(), NOW()),
(220, 41, 23, 10, NULL, 'Daily Task Submission', 'Crash lagi di level kuis yang sama (level 3 soal 7). Bug ini konsisten dan belum diperbaiki.',                       NULL, 'done',    NOW(), NOW()),
(221, 41, 23, 11, NULL, 'Daily Task Submission', 'Tidak ada pilihan bahasa daerah, padahal target pengguna adalah anak-anak Indonesia.',                               NULL, 'done',    NOW(), NOW()),
(222, 41, 23, 12, NULL, 'Daily Task Submission', 'Ukuran file update terlalu besar (150MB), sangat boros kuota internet pengguna.',                                    NULL, 'done',    NOW(), NOW()),
(223, 41, 23, 13, NULL, 'Daily Task Submission', 'Tombol logout tersembunyi di menu, susah ditemukan. Perlu dipindah ke tempat yang lebih jelas.',                     NULL, 'pending', NOW(), NOW()),
(224, 41, 23, 14, NULL, 'Daily Task Submission', 'Saran utama: segera perbaiki bug crash di kuis level 3 dan tambahkan mode offline.',                                 NULL, 'pending', NOW(), NOW()),

-- === TESTER DEMO 3 (id_user=24) ===
(225, 41, 24, 1,  NULL, 'Daily Task Submission', 'Berhasil masuk ke halaman utama. Warna-warna cerah sangat bagus dan cocok untuk anak.',                              NULL, 'done',    NOW(), NOW()),
(226, 41, 24, 2,  NULL, 'Daily Task Submission', 'Menu navigasi bawah mudah dipahami dan dioperasikan oleh anak-anak.',                                                NULL, 'done',    NOW(), NOW()),
(227, 41, 24, 3,  NULL, 'Daily Task Submission', 'Font huruf terlalu kecil untuk anak usia 4-5 tahun, cukup susah dibaca mandiri.',                                    NULL, 'done',    NOW(), NOW()),
(228, 41, 24, 4,  NULL, 'Daily Task Submission', 'Gambar ilustrasi cerita sangat bagus, detail, dan menarik perhatian anak.',                                          NULL, 'done',    NOW(), NOW()),
(229, 41, 24, 5,  NULL, 'Daily Task Submission', 'Fitur reward bintang efektif memotivasi anak untuk terus belajar setiap hari.',                                      NULL, 'done',    NOW(), NOW()),
(230, 41, 24, 6,  NULL, 'Daily Task Submission', 'Kategori materi kurang lengkap, saat ini hanya ada matematika dan bahasa saja.',                                     NULL, 'done',    NOW(), NOW()),
(231, 41, 24, 7,  NULL, 'Daily Task Submission', 'UI secara keseluruhan konsisten dan enak dilihat. Tidak membingungkan pengguna baru.',                               NULL, 'done',    NOW(), NOW()),
(232, 41, 24, 8,  NULL, 'Daily Task Submission', 'Tombol-tombol terlalu kecil untuk jari anak balita, sering terjadi salah pencet.',                                   NULL, 'done',    NOW(), NOW()),
(233, 41, 24, 9,  NULL, 'Daily Task Submission', 'Desain karakter maskot sangat menggemaskan, anak saya sangat menyukainya.',                                          NULL, 'done',    NOW(), NOW()),
(234, 41, 24, 10, NULL, 'Daily Task Submission', 'Warna background agak terlalu gelap untuk mode malam, mata anak cepat lelah.',                                       NULL, 'done',    NOW(), NOW()),
(235, 41, 24, 11, NULL, 'Daily Task Submission', 'Fitur sharing hasil belajar ke media sosial orang tua sangat bagus untuk apresiasi anak.',                           NULL, 'done',    NOW(), NOW()),
(236, 41, 24, 12, NULL, 'Daily Task Submission', 'Animasi transisi antar halaman smooth dan tidak patah-patah sama sekali.',                                           NULL, 'done',    NOW(), NOW()),
(237, 41, 24, 13, NULL, 'Daily Task Submission', 'Aplikasi sudah jauh lebih baik dari awal testing. Perkembangan sangat positif.',                                     NULL, 'pending', NOW(), NOW()),
(238, 41, 24, 14, NULL, 'Daily Task Submission', 'Secara keseluruhan aplikasi sangat bagus, tinggal perlu polish di beberapa bagian kecil.',                           NULL, 'pending', NOW(), NOW())

ON DUPLICATE KEY UPDATE
  `status`         = VALUES(`status`),
  `catatan_tester` = VALUES(`catatan_tester`),
  `updated_at`     = NOW();

-- B6. Pembayaran untuk misi ini (developer id=18 beli paket Premium id=5)
INSERT INTO `pembayaran` (`id_user`, `id_admin`, `id_paket`, `id_misi`, `image`, `status`, `reference`, `payment_url`, `created_at`, `updated_at`) VALUES
(18, NULL, 5, 41, NULL, 'accepted', 'DEMO-EDUKID-2026', NULL, NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- SELESAI
-- Login developer : rakaesal@gmail.com (Google OAuth) atau
--                   developer1@gmail.com (password normal)
-- Login tester 1  : testerdemo1@playtest.id  | password: (hash bcrypt)
-- Login tester 2  : testerdemo2@playtest.id
-- Login tester 3  : testerdemo3@playtest.id
--
-- Pantau Progress → pilih "EduKid - Belajar Seru"
-- 6 submission pending (hari 13 & 14 tiap tester) siap divalidasi
-- AI Report tersedia (Paket Premium id=5 sudah ai_report=1)
-- ============================================================
