-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pressit.address_user
CREATE TABLE IF NOT EXISTS `address_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address_user_users_id_foreign` (`users_id`),
  CONSTRAINT `address_user_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.address_user: ~4 rows (approximately)
REPLACE INTO `address_user` (`id`, `users_id`, `telp`, `address`, `created_at`, `updated_at`) VALUES
	(1, 1, '085349111065', 'JL.KH.Wahid Hasyim I', '2023-07-26 04:13:03', '2023-07-26 04:13:04'),
	(2, 2, '088888888889', 'JL. Keledang 2', '2023-07-26 10:45:15', '2023-07-26 12:04:43'),
	(3, 3, '08888888', 'fhkghsrkj', '2023-07-30 23:52:32', '2023-07-30 23:52:32'),
	(4, 4, '0812345678', 'JL. Harapan Baru', '2023-08-07 23:19:06', '2023-08-07 23:19:06');

-- Dumping structure for table pressit.batas
CREATE TABLE IF NOT EXISTS `batas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `batas` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.batas: ~7 rows (approximately)
REPLACE INTO `batas` (`id`, `tanggal_mulai`, `tanggal_selesai`, `batas`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '2023-07-24', '2023-07-25', 40, '2023-07-27 07:04:53', '2023-07-27 07:04:55', NULL),
	(2, '2023-08-12', '2023-08-13', 25, '2023-07-27 07:05:28', '2023-08-06 02:47:34', NULL),
	(3, '2023-08-06', '2023-08-07', 0, '2023-07-30 05:18:06', '2023-07-29 21:44:23', NULL),
	(4, '2023-07-31', '2023-08-01', 40, '2023-07-27 18:52:57', '2023-07-27 18:52:57', NULL),
	(5, '2023-08-02', '2023-08-03', 15, '2023-07-29 21:34:04', '2023-07-30 23:55:31', NULL),
	(6, '2023-08-09', '2023-08-10', 40, '2023-07-30 00:00:13', '2023-07-30 00:10:44', NULL),
	(8, '2023-08-24', '2023-08-25', 30, '2023-08-07 23:13:20', '2023-08-07 23:20:09', NULL);

-- Dumping structure for table pressit.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pressit.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.migrations: ~13 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_07_26_014621_create_address_user_table', 1),
	(6, '2023_07_26_024915_users_status', 1),
	(7, '2023_07_26_025412_create_paket_table', 1),
	(8, '2023_07_26_025858_create_pemesanan_table', 1),
	(9, '2023_07_26_030903_create_pengerjaan_table', 1),
	(10, '2023_07_26_032415_create_pembayaran_table', 1),
	(11, '2023_07_26_033913_create_pengiriman_table', 1),
	(12, '2023_07_26_200832_add_soft_delete_table_pemesanan', 2),
	(13, '2023_07_27_063732_create_batas_table', 3);

-- Dumping structure for table pressit.paket
CREATE TABLE IF NOT EXISTS `paket` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint NOT NULL,
  `jumlah` int NOT NULL,
  `satuan_harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.paket: ~2 rows (approximately)
REPLACE INTO `paket` (`id`, `jenis`, `deskripsi`, `harga`, `jumlah`, `satuan_harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Biasa', 'Paket Pakaian Biasa dirancang untuk mencakup pakaian-pakaian sehari-hari dengan kualitas setrika yang standar. Paket ini cocok untuk pakaian seperti baju, celana, rok, kemeja, dan pakaian lainnya yang umum digunakan dalam aktivitas sehari-hari. Tim setrika kami akan dengan cermat menyetrika pakaian Anda untuk memberikan hasil yang rapi dan nyaman digunakan. Dengan harga yang terjangkau, Paket Pakaian Biasa memberikan kemudahan bagi pelanggan yang ingin pakaian mereka terjaga kerapihannya tanpa perlu merogoh kocek terlalu dalam.', 5000, 1, 'kilogram', '2023-07-26 12:20:46', '2023-07-26 12:20:46', NULL),
	(2, 'Khusus', 'Paket Pakaian Khusus dirancang untuk memenuhi kebutuhan pelanggan dengan pakaian-pakaian yang memiliki karakteristik khusus atau detail rumit. Paket ini cocok untuk pakaian formal seperti gaun pesta, baju tuxedo, atau gaun pengantin yang memiliki desain istimewa dan menggunakan bahan berkualitas tinggi. Tim setrika kami dilatih untuk menangani pakaian dengan embel-embel, payet, aplikasi bordir, atau detail rumit lainnya dengan hati-hati agar tetap terjaga keindahannya. Dengan penggunaan setrika yang tepat dan perawatan khusus, kami berkomitmen untuk memberikan hasil yang memuaskan bagi pelanggan yang ingin tampil istimewa dengan pakaian pilihan mereka. Harga Paket Pakaian Khusus mencerminkan tingkat keahlian dan perhatian ekstra yang kami berikan pada setiap pakaian, sehingga Anda dapat merasa percaya diri dengan penampilan terbaik Anda.', 10000, 1, 'pakaian', '2023-07-26 12:21:45', '2023-07-26 12:21:45', NULL);

-- Dumping structure for table pressit.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pressit.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pemesanan_id` bigint unsigned NOT NULL,
  `bukti_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` bigint DEFAULT '0',
  `tanggal_pembayaran` date DEFAULT NULL,
  `waktu_pembayaran` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_pemesanan_id_foreign` (`pemesanan_id`),
  CONSTRAINT `pembayaran_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.pembayaran: ~9 rows (approximately)
REPLACE INTO `pembayaran` (`id`, `pemesanan_id`, `bukti_pembayaran`, `total`, `tanggal_pembayaran`, `waktu_pembayaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, NULL, 0, NULL, NULL, '2023-07-27 07:55:31', '2023-07-27 07:55:32', NULL),
	(4, 5, 'sOqLaW502XxJx4lz4uvnZLI29DffsF5kNbUIL4d7.jpg', 100000, NULL, NULL, '2023-07-27 18:52:59', '2023-07-30 11:59:31', NULL),
	(5, 6, '9Rg6QYskCuaYUsUw8duCG7nwOEsnVOuoletzUjxg.jpg', 175000, NULL, NULL, '2023-07-30 00:00:14', '2023-07-30 12:13:04', NULL),
	(7, 8, 'iFtWiSAhaOepKEiWs47DXpVNDyxXdBWt52PElKD5.png', 170000, NULL, NULL, '2023-07-30 00:07:42', '2023-08-02 14:40:39', NULL),
	(9, 10, 'AJoLmtLA66XrLgyfReDwaiZwE1LmcdDXMQY1KITe.png', 80000, NULL, NULL, '2023-07-30 23:43:08', '2023-07-30 23:48:29', NULL),
	(10, 11, 'neMDivbRhoEMHfAj9XtMEN976CB5mppWsTEnsIdx.png', 50000, NULL, NULL, '2023-07-30 23:55:31', '2023-07-30 23:56:07', NULL),
	(11, 12, 'ArWZyWLl4L7KJhdufCexXg1YXkBPvsdhRH0nzgiB.png', 75000, NULL, NULL, '2023-08-06 02:47:34', '2023-08-06 02:51:30', NULL),
	(12, 13, 'T6vSBip3IrICeVmVZ2OSdMB9wE9li4SsDWLyB1dD.png', 75000, NULL, NULL, '2023-08-07 23:13:21', '2023-08-07 23:15:21', NULL),
	(13, 14, 'L24KO1wxaS8cKZmGOPLFykshZ7XKoiwxWQNdsufY.jpg', 240000, NULL, NULL, '2023-08-07 23:20:09', '2023-08-07 23:20:57', NULL);

-- Dumping structure for table pressit.pemesanan
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_pemesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` bigint unsigned NOT NULL,
  `paket_id` bigint unsigned NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total_price` bigint NOT NULL,
  `tipe_pickup` enum('kurir','mandiri') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mandiri',
  `harga_kurir` bigint NOT NULL DEFAULT '0',
  `status` enum('waiting','process','pending','pickup','finished','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `batas_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pemesanan_users_id_foreign` (`users_id`),
  KEY `pemesanan_paket_id_foreign` (`paket_id`),
  KEY `pemesanan_batas_id_foreign` (`batas_id`),
  CONSTRAINT `pemesanan_batas_id_foreign` FOREIGN KEY (`batas_id`) REFERENCES `batas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pemesanan_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pemesanan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.pemesanan: ~9 rows (approximately)
REPLACE INTO `pemesanan` (`id`, `nomor_pemesanan`, `users_id`, `paket_id`, `address`, `jumlah`, `total_price`, `tipe_pickup`, `harga_kurir`, `status`, `created_at`, `updated_at`, `deleted_at`, `batas_id`) VALUES
	(1, 'ORD-001', 2, 1, 'JL. Keledang 1 (seberang RRI)', 35, 175000, 'kurir', 0, 'cancelled', '2023-07-27 07:44:18', '2023-07-29 21:44:23', NULL, 3),
	(5, 'ORD-002', 2, 1, 'JL. Keledang 1 (Seberang RRI dan dekat DEKA)', 20, 100000, 'mandiri', 20400, 'finished', '2023-07-27 18:52:58', '2023-08-06 02:52:12', NULL, 4),
	(6, 'ORD-003', 2, 2, 'JL. Keledang 1 (dekat DEKA)', 15, 175000, 'kurir', 25000, 'finished', '2023-07-30 00:00:14', '2023-07-30 23:50:30', NULL, 6),
	(8, 'ORD-004', 2, 2, 'JL. Keledang 1 coba lagi', 15, 150000, 'kurir', 20000, 'finished', '2023-07-30 00:07:42', '2023-08-02 14:51:30', NULL, 6),
	(10, 'ORD-005', 2, 1, 'JL. Keledang 1', 10, 50000, 'kurir', 30000, 'finished', '2023-07-30 23:43:08', '2023-07-30 23:50:35', NULL, 5),
	(11, 'ORD-006', 3, 2, 'fhkghsrkj', 5, 50000, 'mandiri', 0, 'finished', '2023-07-30 23:55:31', '2023-08-06 02:52:02', NULL, 5),
	(12, 'ORD-007', 2, 1, 'JL. Keledang 2', 10, 50000, 'kurir', 25000, 'finished', '2023-08-06 02:47:34', '2023-08-06 02:52:08', NULL, 2),
	(13, 'ORD-008', 2, 1, 'JL. Keledang 10', 10, 50000, 'kurir', 25000, 'process', '2023-08-07 23:13:21', '2023-08-07 23:15:41', NULL, 8),
	(14, 'ORD-009', 4, 2, 'JL. Harapan Baru, Samarinda Seberang', 20, 200000, 'kurir', 40000, 'finished', '2023-08-07 23:20:09', '2023-08-07 23:21:19', NULL, 8);

-- Dumping structure for table pressit.pengerjaan
CREATE TABLE IF NOT EXISTS `pengerjaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned NOT NULL,
  `pemesanan_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengerjaan_users_id_foreign` (`users_id`),
  KEY `pengerjaan_pemesanan_id_foreign` (`pemesanan_id`),
  CONSTRAINT `pengerjaan_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengerjaan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.pengerjaan: ~0 rows (approximately)

-- Dumping structure for table pressit.pengiriman
CREATE TABLE IF NOT EXISTS `pengiriman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pembayaran_id` bigint unsigned NOT NULL,
  `status` enum('sudah','belum') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'belum',
  `tanggal_pengiriman` date DEFAULT NULL,
  `waktu_pengiriman` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengiriman_pembayaran_id_foreign` (`pembayaran_id`),
  CONSTRAINT `pengiriman_pembayaran_id_foreign` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.pengiriman: ~9 rows (approximately)
REPLACE INTO `pengiriman` (`id`, `pembayaran_id`, `status`, `tanggal_pengiriman`, `waktu_pengiriman`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'belum', NULL, NULL, NULL, NULL, NULL),
	(3, 4, 'belum', NULL, NULL, '2023-07-27 18:52:59', '2023-07-27 18:52:59', NULL),
	(4, 5, 'belum', NULL, NULL, '2023-07-30 00:00:15', '2023-07-30 00:00:15', NULL),
	(6, 7, 'belum', NULL, NULL, '2023-07-30 00:07:43', '2023-07-30 00:07:43', NULL),
	(8, 9, 'belum', NULL, NULL, '2023-07-30 23:43:08', '2023-07-30 23:43:08', NULL),
	(9, 10, 'belum', NULL, NULL, '2023-07-30 23:55:31', '2023-07-30 23:55:31', NULL),
	(10, 11, 'belum', NULL, NULL, '2023-08-06 02:47:35', '2023-08-06 02:47:35', NULL),
	(11, 12, 'belum', NULL, NULL, '2023-08-07 23:13:21', '2023-08-07 23:13:21', NULL),
	(12, 13, 'belum', NULL, NULL, '2023-08-07 23:20:09', '2023-08-07 23:20:09', NULL);

-- Dumping structure for table pressit.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table pressit.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usertype` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.users: ~4 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Adrian', 'singapore.solid1@gmail.com', NULL, '$2y$10$yhk73CN6xGiJqq2aZDQ3POsycNybdfTeW/vSOGz6H9OSVSvW1IR5q', NULL, 'admin', '2023-07-25 19:54:21', '2023-07-25 19:54:21', NULL),
	(2, 'Ibnu', 'singapore.solid2@gmail.com', NULL, '$2y$10$YOYrM.gt3pG/doiQ5rbmhuI7lJVKxvV.I03rAmn4m9BFmcRsfqfi6', NULL, 'customer', '2023-07-26 10:45:14', '2023-07-26 12:05:14', NULL),
	(3, 'Bang Rilo', 'rilo@customer.com', NULL, '$2y$10$qH8LjGpCjggXUVmjlMYDB.46IbN7JJ5oKa.b5G9LUJx/CbIobSoU.', NULL, 'customer', '2023-07-30 23:52:32', '2023-07-30 23:52:32', NULL),
	(4, 'Fadil', 'fadil@customer.com', NULL, '$2y$10$ircdBK0P36HU4WqBWw8xoOP8BYf/BL.2/0LjWdYSpK7ZN9LFwY662', NULL, 'customer', '2023-08-07 23:19:06', '2023-08-07 23:19:06', NULL);

-- Dumping structure for table pressit.users_status
CREATE TABLE IF NOT EXISTS `users_status` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint unsigned NOT NULL,
  `status` enum('working','available','offline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_status_users_id_foreign` (`users_id`),
  CONSTRAINT `users_status_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pressit.users_status: ~1 rows (approximately)
REPLACE INTO `users_status` (`id`, `users_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'available', '2023-07-26 04:14:16', '2023-07-26 04:14:18');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
