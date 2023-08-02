-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 12:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pressit`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_user`
--

CREATE TABLE `address_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `telp` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address_user`
--

INSERT INTO `address_user` (`id`, `telp`, `address`, `created_at`, `updated_at`, `users_id`) VALUES
(1, '085349111065', 'JL.KH.Wahid Hasyim I', '2023-07-17 06:17:49', '2023-07-17 06:17:49', 1),
(2, '085349111065', 'JL.Keledang 1', '2023-07-17 06:26:34', '2023-07-17 06:26:34', 2),
(3, '085349111065', 'JL.Harapan Baru', '2023-07-17 06:32:08', '2023-07-17 06:32:08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_17_125812_create_address_user_table', 2),
(6, '2023_07_17_130026_create_paket_table', 2),
(7, '2023_07_17_130132_create_pemesanan_table', 2),
(8, '2023_07_17_130249_create_pengerjaan_table', 2),
(9, '2023_07_17_130401_create_pembayaran_table', 2),
(10, '2023_07_17_130507_create_pengiriman_table', 2),
(11, '2023_07_17_132247_add_users_id_on_table_users', 3),
(12, '2023_07_18_211246_add_softdelete_on_all_tables', 4),
(13, '2023_07_21_072245_add_column_at_table_pemesanan', 5),
(14, '2023_07_22_075821_add_date_on_table_pemesanan', 6),
(15, '2023_07_22_130348_edit_status_on_table_pemesanan', 7),
(16, '2023_07_22_130946_add_status_on_table_pemesanan', 8);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `harga` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan_harga` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `jenis`, `deskripsi`, `harga`, `jumlah`, `satuan_harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Biasa', 'pilihan paket yang ditawarkan untuk setrika pakaian yang umum dan standar. Paket ini cocok untuk pakaian sehari-hari yang tidak memerlukan perawatan khusus atau penanganan khusus. Dalam paket ini, setrika dilakukan dengan tarif berdasarkan berat pakaian yang diberikan. Misalnya, tarif per kilogram pakaian yang akan disetrika.', 5000, 1, 'kilogram', '2023-07-17 22:09:43', '2023-07-18 12:15:55', NULL),
(2, 'Khusus', 'Jenis-jenis pakaian pada kategori \"Pakaian Khusus\" dalam konteks setrika dapat mencakup pakaian-pakaian dengan karakteristik atau detail khusus yang memerlukan perhatian ekstra dalam proses setrika. Berikut adalah beberapa contoh pakaian khusus yang mungkin termasuk dalam kategori ini:\n\nBaju Tuxedo: Pakaian formal pria dengan potongan dan detail khusus seperti kerah bersudut, manset tangan, dan aksen satin.\n\nDress Berpayet: Gaun yang dihiasi dengan payet, manik-manik, atau kristal yang membutuhkan penanganan hati-hati agar tidak merusak hiasan tersebut.\n\nJas Hujan: Pakaian pelindung yang terbuat dari bahan tahan air seperti karet atau plastik yang memerlukan setrikaan yang berhati-hati agar tidak merusak atau melar bahan tersebut.\n\nGaun Pengantin: Gaun pernikahan yang sering kali memiliki desain rumit, detail bordir, hiasan manik-manik, renda, atau kain khusus yang membutuhkan penanganan yang hati-hati agar tidak merusak keindahan dan keunikan gaun tersebut.\n\nKostum Teater atau Panggung: Pakaian dengan karakteristik khusus yang digunakan untuk pertunjukan teater, panggung, atau acara kostum. Ini dapat mencakup kostum era tertentu, kostum karakter fantasi, atau kostum yang memiliki aksesori dan detail rumit.\n\nSeragam Olahraga dengan Patch atau Bordir: Pakaian olahraga seperti seragam sepak bola, basket, atau seragam tim lainnya yang memiliki patch atau bordir khusus seperti logo tim, nama pemain, atau sponsor yang memerlukan penanganan yang hati-hati agar tidak merusak atau melonggarkan detail tersebut.\n\nPakaian Etnik Tradisional: Pakaian tradisional khas suatu daerah atau budaya dengan desain, bordir, atau aksen khusus yang memerlukan setrikaan yang tepat agar tetap terjaga keasliannya.\n\nPakaian Renang dengan Aksen atau Aplikasi Khusus: Pakaian renang dengan aksen seperti payet, pita, atau aplikasi khusus yang memerlukan penanganan yang hati-hati agar tidak merusak atau melonggarkan aksen tersebut.', 15000, 1, 'pakaian', '2023-07-18 12:15:13', '2023-07-18 12:15:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `tipe_pengambilan` enum('antar','ambil') DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `waktu_pembayaran` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pemesanan_id`, `bukti_pembayaran`, `tipe_pengambilan`, `total`, `tanggal_pembayaran`, `waktu_pembayaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, NULL, NULL, NULL, NULL, NULL, '2023-07-25 10:46:24', '2023-07-25 10:46:24', NULL),
(2, 8, '1RZNHYX5Wq5ZRRd1LgCp7CX5iY0mQXrUchQiSuLO.jpg', 'ambil', 195000, NULL, NULL, '2023-07-24 17:54:13', '2023-07-23 12:40:31', NULL),
(4, 9, 'ZqRFv9AoRgKiwVtD0v3U4FLkQoNZEiyFG56y3OHW.jpg', 'antar', 40000, NULL, NULL, '2023-07-23 23:13:59', '2023-07-23 23:19:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_pemesanan` varchar(255) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('waiting','process','pending','pickup','finished','cancelled') NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `nomor_pemesanan`, `users_id`, `paket_id`, `address`, `jumlah`, `total_price`, `created_at`, `updated_at`, `deleted_at`, `tanggal_mulai`, `tanggal_selesai`, `status`) VALUES
(1, 'ORD-001', 4, 1, 'gggbtdrhghghtgb', 10, 50000, '2023-07-12 13:10:23', '2023-07-23 23:01:09', NULL, '2023-07-13', '2023-07-15', 'process'),
(3, 'ORD-002', 1, 1, 'JL.KH.Wahid Hasyim I', 10, 50000, '2023-07-22 06:29:10', '2023-07-23 01:35:50', NULL, '2023-07-04', '2023-07-06', 'finished'),
(8, 'ORD-003', 1, 2, 'JL.KH.Wahid Hasyim I, RT.14', 13, 195000, '2023-07-23 03:56:09', '2023-07-23 23:23:12', NULL, '2023-07-19', '2023-07-21', 'finished'),
(9, 'ORD-004', 3, 1, 'JL.Harapan Baru', 5, 25000, '2023-07-23 23:13:59', '2023-07-23 23:23:25', NULL, '2023-07-18', '2023-07-18', 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `pengerjaan`
--

CREATE TABLE `pengerjaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengerjaan`
--

INSERT INTO `pengerjaan` (`id`, `users_id`, `pemesanan_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 3, '2023-07-25 10:48:54', '2023-07-25 10:48:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('sudah','belum') DEFAULT NULL,
  `tanggal_pengiriman` date DEFAULT NULL,
  `waktu_pengiriman` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `pembayaran_id`, `status`, `tanggal_pengiriman`, `waktu_pengiriman`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '', '2023-07-26', '18:50:55', '2023-07-25 10:50:55', '2023-07-25 10:50:55', NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL, '2023-07-23 23:13:59', '2023-07-23 23:13:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Adrian', 'singapore.solid1@gmail.com', NULL, '$2y$10$EwKTcZ7y71BvvYMMFWc2XegeCQnxX7vgFeOc/xWI.RAP687VyyHPC', 'admin', NULL, '2023-07-17 04:49:19', '2023-07-17 04:49:19', NULL),
(2, 'Ibnu', 'singapore.solid2@gmail.com', NULL, '$2y$10$tD.sdbqUPUa2/5KqSFbCEePKLxi1ZSAeW2hiaPwPA9fTsOZgtUQW2', 'admin', NULL, '2023-07-17 06:26:34', '2023-07-18 13:46:50', '2023-07-18 13:46:50'),
(3, 'Fadil', 'singapore.solid3@gmail.com', NULL, '$2y$10$UNafRE5ibn/Lh4vBo2XlbugsAIY1jce06B2yrPBz8ICU/cs31R.N.', 'customer', NULL, '2023-07-17 06:32:07', '2023-07-17 06:32:07', NULL),
(4, 'Customer 1', 'singapore.solid4@gmail.com', NULL, '$2y$10$ad5RdEruC/UfIb1I/bzmRuCcuV/Py29ymK/bSm11ZHMoQpGvIZasW', 'customer', NULL, '2023-07-18 23:15:55', '2023-07-18 23:15:55', NULL),
(5, 'Customer 2', 'singapore.solid5@gmail.com', NULL, '$2y$10$bQzkHMkWFrY7mPoev6il6.YkMXXCkwVxYND.P9O/p0J9sHDC0j8Gm', 'customer', NULL, '2023-07-19 15:44:44', '2023-07-19 15:44:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_status`
--

CREATE TABLE `users_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Working','Available','Offline') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_user`
--
ALTER TABLE `address_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_users_id_foreign` (`users_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_users_id_foreign` (`users_id`),
  ADD KEY `pemesanan_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengerjaan_users_id_foreign` (`users_id`),
  ADD KEY `pengerjaan_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengiriman_pembayaran_id_foreign` (`pembayaran_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_status`
--
ALTER TABLE `users_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_status_users_id_foreign` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_user`
--
ALTER TABLE `address_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_status`
--
ALTER TABLE `users_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_user`
--
ALTER TABLE `address_user`
  ADD CONSTRAINT `address_user_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`),
  ADD CONSTRAINT `pemesanan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD CONSTRAINT `pengerjaan_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`),
  ADD CONSTRAINT `pengerjaan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_pembayaran_id_foreign` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`);

--
-- Constraints for table `users_status`
--
ALTER TABLE `users_status`
  ADD CONSTRAINT `users_status_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
