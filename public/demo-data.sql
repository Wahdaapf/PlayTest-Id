-- ============================================================
-- PlayTest ID — Demo Data untuk Hosting
-- Jalankan di phpMyAdmin → tab SQL
-- Sesuaikan id jika bentrok dengan data yang sudah ada
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- 1. USERS  (developer + 3 tester)
--    Password semua: password123
-- ------------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1,  'Raka',     'developer@example.com', '$2y$12$hiPD7INUKHtc4WsfOZm24ORMOz/ecFsDsstNkqrUOcNxMPWZclf6y', 'developer', NOW(), '2026-04-13 06:58:30', NOW()),
(3,  'Tester 1', 'tester1@example.com',   '$2y$12$Toh8APoZWTf5iUtf5ehRbeQWyVbywVwh7.ZwioMSSGPiLUnktFbTy', 'tester',    NOW(), '2026-04-13 07:40:59', NOW()),
(4,  'Tester 2', 'tester2@example.com',   '$2y$12$JAxsoi/fUIXrYu9bKsLsa.EKdpOnSOctsI0N58hzuNSEk7hiHg7qi', 'tester',    NOW(), '2026-04-13 07:40:59', NOW()),
(5,  'Tester 3', 'tester3@example.com',   '$2y$12$5v2M9BnlEw1.1rIu5r3f6O.73Y8.M0TO8FeYYrcdiWbIo0h9eRaE2', 'tester',    NOW(), '2026-04-13 07:41:00', NOW())
ON DUPLICATE KEY UPDATE
  `name`     = VALUES(`name`),
  `email`    = VALUES(`email`),
  `password` = VALUES(`password`),
  `role`     = VALUES(`role`),
  `updated_at` = NOW();

-- ------------------------------------------------------------
-- 2. USER BALANCE  (saldo & badge awal)
-- ------------------------------------------------------------
INSERT INTO `user_balance` (`id_user`, `point`, `badge`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 0,  0, 0, NOW(), NOW()),
(3, 0,  2, 0, NOW(), NOW()),
(4, 0,  1, 0, NOW(), NOW()),
(5, 0,  3, 0, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- ------------------------------------------------------------
-- 3. MISI  (id=14, paket Pro id=3, developer id=1)
-- ------------------------------------------------------------
INSERT INTO `misi` (`id`, `id_user`, `id_paket`, `nama_aplikasi`, `logo`, `link_aplikasi`, `instruksi`, `status`, `point`, `kapasitas`, `created_at`, `updated_at`) VALUES
(14, 1, 3,
 'EduKid - Belajar Seru',
 NULL,
 'https://play.google.com/store/apps/details?id=com.edukid.app',
 'Install aplikasi, buka semua menu, coba fitur kuis dan cerita interaktif, screenshot halaman utama setelah digunakan minimal 5 menit.',
 'running',
 15000,
 3,
 '2026-06-09 08:32:02',
 NOW()
)
ON DUPLICATE KEY UPDATE
  `status`    = 'running',
  `updated_at` = NOW();

-- ------------------------------------------------------------
-- 4. MISI ANGGOTA  (3 tester bergabung)
-- ------------------------------------------------------------
INSERT INTO `misi_anggota` (`id`, `id_misi`, `id_user`, `status`, `created_at`, `updated_at`) VALUES
(18, 14, 3, 'progress', '2026-06-09 08:32:02', NOW()),
(19, 14, 4, 'progress', '2026-06-09 08:32:02', NOW()),
(20, 14, 5, 'progress', '2026-06-09 08:32:02', NOW())
ON DUPLICATE KEY UPDATE
  `status`     = 'progress',
  `updated_at` = NOW();

-- ------------------------------------------------------------
-- 5. MISI SUB  (42 record: 3 tester × 14 hari)
--    Hari 1-12 = done, Hari 13-14 = pending (perlu validasi)
-- ------------------------------------------------------------
INSERT INTO `misi_sub` (`id`, `id_misi`, `id_user`, `hari_ke`, `image`, `desc`, `catatan_tester`, `alasan_tolak`, `status`, `created_at`, `updated_at`) VALUES

-- === TESTER 1 (id_user=3) ===
(80,  14, 3, 1,  NULL, 'Daily Task Submission', 'Aplikasi berhasil diinstall dan dibuka. Tampilan awal cukup menarik untuk anak-anak.',                         NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(81,  14, 3, 2,  NULL, 'Daily Task Submission', 'Fitur cerita interaktif berjalan lancar. Animasi karakter lucu.',                                               NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(82,  14, 3, 3,  NULL, 'Daily Task Submission', 'Fitur kuis berjalan baik. Suara feedback benar/salah menyenangkan.',                                            NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(83,  14, 3, 4,  NULL, 'Daily Task Submission', 'Fitur progress anak bisa dilihat orang tua. Sangat berguna.',                                                   NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(84,  14, 3, 5,  NULL, 'Daily Task Submission', 'Tidak ada crash hari ini. Semua fitur berjalan normal.',                                                        NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(85,  14, 3, 6,  NULL, 'Daily Task Submission', 'Fitur daily challenge menarik, anak saya antusias membuka tiap hari.',                                          NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(86,  14, 3, 7,  NULL, 'Daily Task Submission', 'Loading konten cerita lambat saat koneksi 4G biasa, perlu optimasi.',                                           NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(87,  14, 3, 8,  NULL, 'Daily Task Submission', 'Fitur audio narasi cerita jernih dan jelas. Pengucapan kata-kata benar.',                                       NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(88,  14, 3, 9,  NULL, 'Daily Task Submission', 'Performa lebih baik dari hari sebelumnya setelah restart HP. Stabil.',                                          NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(89,  14, 3, 10, NULL, 'Daily Task Submission', 'Fitur leaderboard antar anak memotivasi kompetisi positif.',                                                    NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(90,  14, 3, 11, NULL, 'Daily Task Submission', 'Mulai terbiasa dengan alur aplikasi. Pengalaman belajar cukup menyenangkan.',                                   NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(91,  14, 3, 12, NULL, 'Daily Task Submission', 'Aplikasi stabil, tidak ada crash hari ini. Semua konten bisa diakses.',                                         NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(92,  14, 3, 13, NULL, 'Daily Task Submission', 'Fitur cerita sudah sangat lengkap. Konten edukatif berkualitas.',                                               NULL, 'pending', '2026-06-09 08:32:02', NOW()),
(93,  14, 3, 14, NULL, 'Daily Task Submission', 'Pengalaman 14 hari testing menyenangkan. Aplikasi layak untuk anak-anak.',                                      NULL, 'pending', '2026-06-09 08:32:02', NOW()),

-- === TESTER 2 (id_user=4) ===
(94,  14, 4, 1,  NULL, 'Daily Task Submission', 'Install lancar. Loading splash screen agak lama sekitar 4 detik.',                                              NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(95,  14, 4, 2,  NULL, 'Daily Task Submission', 'Ada bug: tombol Next di halaman cerita kadang tidak merespons saat ditekan pertama kali, harus ditekan dua kali.', NULL, 'done', '2026-06-09 08:32:02', NOW()),
(96,  14, 4, 3,  NULL, 'Daily Task Submission', 'Kuis level 3 crash ketika soal nomor 7 dijawab. Harus restart aplikasi.',                                       NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(97,  14, 4, 4,  NULL, 'Daily Task Submission', 'Tombol kembali di halaman kuis tidak berfungsi, harus pakai tombol back HP.',                                   NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(98,  14, 4, 5,  NULL, 'Daily Task Submission', 'Iklan muncul di tengah-tengah sesi belajar, sangat mengganggu pengalaman anak.',                                NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(99,  14, 4, 6,  NULL, 'Daily Task Submission', 'Aplikasi memakan RAM cukup besar, HP mid-range jadi panas setelah 15 menit.',                                   NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(100, 14, 4, 7,  NULL, 'Daily Task Submission', 'Bug: setelah ganti profil anak, progress kembali ke nol. Sangat mengecewakan!',                                 NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(101, 14, 4, 8,  NULL, 'Daily Task Submission', 'Tidak ada mode offline, semua konten butuh internet. Kurang praktis.',                                          NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(102, 14, 4, 9,  NULL, 'Daily Task Submission', 'Notifikasi pengingat belajar harian tidak muncul padahal sudah diaktifkan.',                                    NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(103, 14, 4, 10, NULL, 'Daily Task Submission', 'Crash lagi di level kuis yang sama (level 3 soal 7). Bug belum diperbaiki.',                                    NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(104, 14, 4, 11, NULL, 'Daily Task Submission', 'Tidak ada pilihan bahasa daerah, padahal target pengguna Indonesia. Sayang.',                                   NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(105, 14, 4, 12, NULL, 'Daily Task Submission', 'Ukuran file update terlalu besar (150MB), boros kuota internet.',                                               NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(106, 14, 4, 13, NULL, 'Daily Task Submission', 'Tombol logout tersembunyi, susah ditemukan. Perlu dipindah ke tempat lebih jelas.',                             NULL, 'pending', '2026-06-09 08:32:02', NOW()),
(107, 14, 4, 14, NULL, 'Daily Task Submission', 'Saran utama: perbaiki bug crash di kuis level 3 dan tambahkan mode offline.',                                   NULL, 'pending', '2026-06-09 08:32:02', NOW()),

-- === TESTER 3 (id_user=5) ===
(108, 14, 5, 1,  NULL, 'Daily Task Submission', 'Berhasil masuk ke halaman utama. Warna-warna cerah bagus untuk anak.',                                          NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(109, 14, 5, 2,  NULL, 'Daily Task Submission', 'Menu navigasi bawah mudah dipahami anak-anak.',                                                                 NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(110, 14, 5, 3,  NULL, 'Daily Task Submission', 'Font huruf terlalu kecil untuk anak usia 4-5 tahun, susah dibaca.',                                             NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(111, 14, 5, 4,  NULL, 'Daily Task Submission', 'Gambar ilustrasi cerita sangat bagus dan detail.',                                                              NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(112, 14, 5, 5,  NULL, 'Daily Task Submission', 'Fitur reward bintang memotivasi anak untuk terus belajar.',                                                     NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(113, 14, 5, 6,  NULL, 'Daily Task Submission', 'Kategori materi kurang lengkap, hanya ada matematika dan bahasa.',                                              NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(114, 14, 5, 7,  NULL, 'Daily Task Submission', 'UI secara keseluruhan konsisten dan enak dilihat.',                                                             NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(115, 14, 5, 8,  NULL, 'Daily Task Submission', 'Tombol-tombol terlalu kecil untuk jari anak balita, sering salah pencet.',                                      NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(116, 14, 5, 9,  NULL, 'Daily Task Submission', 'Desain karakter maskot sangat menggemaskan, anak saya suka sekali.',                                            NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(117, 14, 5, 10, NULL, 'Daily Task Submission', 'Warna background agak terlalu gelap untuk mode malam, mata anak lelah.',                                        NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(118, 14, 5, 11, NULL, 'Daily Task Submission', 'Fitur sharing hasil belajar ke sosmed orang tua bagus untuk apresiasi anak.',                                   NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(119, 14, 5, 12, NULL, 'Daily Task Submission', 'Animasi transisi antar halaman smooth dan tidak patah-patah.',                                                  NULL, 'done',    '2026-06-09 08:32:02', NOW()),
(120, 14, 5, 13, NULL, 'Daily Task Submission', 'Aplikasi sudah jauh lebih baik dari awal testing. Perkembangan positif.',                                       NULL, 'pending', '2026-06-09 08:32:02', NOW()),
(121, 14, 5, 14, NULL, 'Daily Task Submission', 'Secara keseluruhan aplikasi bagus, tinggal perlu polish di beberapa bagian kecil.',                             NULL, 'pending', '2026-06-09 08:32:02', NOW())

ON DUPLICATE KEY UPDATE
  `status`         = VALUES(`status`),
  `catatan_tester` = VALUES(`catatan_tester`),
  `updated_at`     = NOW();

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- SELESAI — Total: 4 users, 1 misi, 3 misi_anggota, 42 misi_sub
-- Login developer : developer@example.com / password = hash bcrypt
-- Login tester 1  : tester1@example.com
-- Login tester 2  : tester2@example.com
-- Login tester 3  : tester3@example.com
-- ============================================================
