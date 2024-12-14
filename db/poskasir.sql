-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Des 2024 pada 16.39
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poskasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `name`, `head_id`, `created_at`, `updated_at`) VALUES
(5, 'Penjualan', 3, NULL, NULL),
(6, 'Pemasukan', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` int NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'head'),
(3, 'pekerja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_11_034138_create_transaction_in_table', 1),
(6, '2023_01_11_040228_create_transaction_in_details_table', 1),
(7, '2023_01_11_040606_create_transaction_out_details_table', 1),
(8, '2023_01_11_040617_create_transaction_out_table', 1),
(9, '2023_01_11_072416_create_books_table', 2),
(10, '2023_04_02_131210_create_workers_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint UNSIGNED NOT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `priorities`
--

INSERT INTO `priorities` (`id`, `priority`, `created_at`, `updated_at`) VALUES
(4, 'Low', NULL, NULL),
(5, 'Mid', NULL, NULL),
(6, 'High', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `worker_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `price`, `amount`, `worker_id`, `created_at`, `updated_at`) VALUES
(1, 'naru', 'hodo', 30000, -14, 1, '2023-03-11 04:36:36', NULL),
(3, 'wewq', 'ewqeqw', 30000, -1, 1, '2023-03-11 04:36:38', NULL),
(4, 'vitka', '2342', 10000, 7, 1, '2023-03-11 04:36:39', NULL),
(5, 'tes', 'TES0787', 20000, 10, 1, '2023-04-11 04:37:32', '2023-04-11 04:37:32'),
(6, 'bunga', 'bnga', 1000, -2, 1, '2024-12-10 11:27:52', '2024-12-10 11:27:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `topic_id` bigint UNSIGNED NOT NULL,
  `priority_id` bigint UNSIGNED NOT NULL,
  `assign_id` bigint UNSIGNED DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `openDateTime` datetime NOT NULL,
  `closeDateTime` datetime DEFAULT NULL,
  `rating` decimal(1,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `department_id`, `topic_id`, `priority_id`, `assign_id`, `description`, `status`, `openDateTime`, `closeDateTime`, `rating`, `created_at`, `updated_at`) VALUES
(9, 3, 6, 0, 4, NULL, '331231', NULL, '2023-05-04 15:41:38', NULL, NULL, NULL, NULL),
(10, 3, 5, 0, 4, NULL, 'tess', NULL, '2023-05-04 16:53:43', NULL, NULL, NULL, NULL),
(11, 3, 6, 4, 5, 5, 'dadwas', NULL, '2023-05-04 16:54:37', NULL, NULL, NULL, NULL),
(12, 3, 6, 4, 6, NULL, 'SALAH HITUNG BABI', NULL, '2024-10-29 18:24:46', NULL, NULL, NULL, NULL),
(13, 3, 5, 5, 5, NULL, 'ada kekurangan nih untuk bagian perhitungan barang nya yang #025', NULL, '2024-12-10 18:32:55', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `chat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ticket_details`
--

INSERT INTO `ticket_details` (`id`, `ticket_id`, `date`, `chat`, `user_id`, `photo`, `created_at`, `updated_at`) VALUES
(25, 11, '2023-05-04 21:06:57', 'tes', 3, NULL, NULL, NULL),
(26, 13, '2024-12-10 18:33:29', 'tes', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `topics`
--

CREATE TABLE `topics` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `topics`
--

INSERT INTO `topics` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(4, 'Kesalahan hitung', 6, NULL, NULL),
(5, 'kesalahan hitung', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_in`
--

CREATE TABLE `transaction_in` (
  `id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `worker_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_in`
--

INSERT INTO `transaction_in` (`id`, `price`, `worker_id`, `created_at`, `updated_at`) VALUES
(19, 700000, 1, '2023-04-10 20:22:38', '2023-04-10 20:22:38'),
(20, 20000, 1, '2023-04-11 03:50:58', '2023-04-11 03:50:58'),
(22, 1090000, 1, '2024-11-23 17:23:39', '2024-11-23 17:23:39'),
(24, 13000, 1, '2024-12-10 11:28:44', '2024-12-10 11:28:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_in_details`
--

CREATE TABLE `transaction_in_details` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_in_details`
--

INSERT INTO `transaction_in_details` (`id`, `transaction_id`, `product_id`, `price`, `amount`, `created_at`, `updated_at`) VALUES
(27, 19, 1, 20000, 5, NULL, NULL),
(28, 19, 3, 50000, 5, NULL, NULL),
(29, 19, 4, 70000, 5, NULL, NULL),
(30, 20, 1, 10000, 2, NULL, NULL),
(32, 22, 1, 1000, 10, NULL, NULL),
(33, 22, 3, 3000, 10, NULL, NULL),
(34, 22, 4, 5000, 10, NULL, NULL),
(35, 22, 5, 100000, 10, NULL, NULL),
(38, 24, 6, 500, 4, NULL, NULL),
(39, 24, 1, 1000, 5, NULL, NULL),
(40, 24, 4, 2000, 3, NULL, NULL);

--
-- Trigger `transaction_in_details`
--
DELIMITER $$
CREATE TRIGGER `transaction_in_delete` BEFORE DELETE ON `transaction_in_details` FOR EACH ROW BEGIN
  UPDATE products
  SET amount = amount - OLD.amount  
  WHERE id = OLD.product_id;          
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaction_in_insert` AFTER INSERT ON `transaction_in_details` FOR EACH ROW BEGIN
  UPDATE products
  SET amount = amount + NEW.amount  
  WHERE id = NEW.product_id;          
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_out`
--

CREATE TABLE `transaction_out` (
  `id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `worker_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_out`
--

INSERT INTO `transaction_out` (`id`, `price`, `worker_id`, `created_at`, `updated_at`) VALUES
(28, 150000, 1, '2024-12-13 13:08:51', '2024-12-13 13:08:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_out_details`
--

CREATE TABLE `transaction_out_details` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_out_details`
--

INSERT INTO `transaction_out_details` (`id`, `transaction_id`, `product_id`, `price`, `amount`, `created_at`, `updated_at`) VALUES
(38, 28, 1, 30000, 2, NULL, NULL),
(39, 28, 3, 30000, 2, NULL, NULL),
(40, 28, 4, 10000, 3, NULL, NULL);

--
-- Trigger `transaction_out_details`
--
DELIMITER $$
CREATE TRIGGER `transaction_out_delete` BEFORE DELETE ON `transaction_out_details` FOR EACH ROW BEGIN
  UPDATE products
  SET amount = amount + OLD.amount  
  WHERE id = OLD.product_id;          
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaction_out_insert` AFTER INSERT ON `transaction_out_details` FOR EACH ROW BEGIN
  UPDATE products
  SET amount = amount - NEW.amount  
  WHERE id = NEW.product_id;          
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` int DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level_id`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'naru', 'naru@gmail.com', '$2y$10$y1sHimQF.ZlGrNVuVQGdK.a1uRZ9KZdxvRCiaBx/ZdIHQyIt9JlLy', 2, NULL, NULL, '2023-01-10 23:51:57', '2023-05-03 08:04:03'),
(3, 'admin', 'admin@gmail.com', '$2y$10$J7UsAartJ0shffzirXojOe2Lq28Z0RlRMEVnKw8JxbJVC.DbjYVAy', 1, 'DGaXvotma96ZYW8oVWMl.jpg', NULL, '2023-01-11 00:03:20', '2024-10-29 11:18:27'),
(5, 'hokage', 'hokage@gmail.com', '$2y$10$TLFvxDjEgTTpCCs24sCR6ucdY2CmZF3clYQwfgNfzTTcCo.XJLKue', 2, 'Ho42IHAxH11BHPs5Z3ZL.jpg', NULL, '2023-01-15 18:33:21', '2023-04-29 07:37:35'),
(6, 'kakashi', 'kakashi@gmail.com', '$2y$10$7c0gvNEyA1C59HKVoqI0IORh33Bfas4Wv57eM6dE1znVcRIxh2Gci', 2, NULL, NULL, '2023-04-03 21:29:40', '2023-04-03 21:49:15'),
(7, 'tes', 'tes@gmail.com', '$2y$10$mComFEo4ABwbqguaI9VsSeyYbISP.lCJ.WieICU31006f7bVCfRHe', 3, NULL, NULL, '2023-04-04 00:02:48', '2023-04-04 00:02:48'),
(10, 'tessa', 'teasdas@gmail.com', '$2y$10$0HXpQgECkNhTXa6BlKAxhOUaHUnCcEF18ny8RyntbKfT3zTFZ4DJS', 3, NULL, NULL, '2024-12-10 12:04:52', '2024-12-10 12:04:52'),
(11, 'dasda', 'dassda@jmail.com', '$2y$10$HAKyPpH2xOXl8OkugSqeyeGcE6pKXMs8F4Cg6GMfsU6TAecUsZHVC', 3, NULL, NULL, '2024-12-10 12:05:35', '2024-12-10 12:05:35'),
(12, 'dada', 'dada@jmail.com', '$2y$10$yO.ZcL4tqhLjr.Ueclz5ZOa7/oWo5MrdizybNylNHWUOzcBf.p/JW', 3, NULL, NULL, '2024-12-12 12:14:17', '2024-12-12 12:14:17'),
(13, 'Mario', 'mario@jmail.com', '$2y$10$Hy/mkLZ6y0TAuROJhA/3y.eD29d6XbIAxE/4cjkAT3Ju6qCMLwb.i', 3, NULL, NULL, '2024-12-13 11:29:10', '2024-12-13 11:29:10'),
(14, 'nelson', 'nelson@jmail.com', '$2y$10$jQApqoJ/5eCYQusjztkzwu0FL/GY0CcxuoQRvtmwgssP7/PlUZj02', 3, NULL, NULL, '2024-12-13 11:30:02', '2024-12-13 11:30:02'),
(15, 'tera', 'tera@gmail.com', '$2y$10$jp/QEJQLOJtPSGlf3o6P8O9/eBGLrzCRXDRL.fUwi9iWve9JUzhpu', 2, NULL, NULL, '2024-12-13 13:40:42', '2024-12-13 13:40:42'),
(16, 'tera', 'teras@gmail.com', '$2y$10$OgQU7gUN3FzcBm5pZ9FUne3dL6m7/7LHlm85zQU8Bs0R.jRXqXNrW', 2, NULL, NULL, '2024-12-13 13:41:11', '2024-12-13 13:41:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `workers`
--

CREATE TABLE `workers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIK` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `workers`
--

INSERT INTO `workers` (`id`, `name`, `NIK`, `number`, `user_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'bambang', '123', '544', 3, 5, NULL, NULL),
(2, 'Gobi', '322', '423', 5, 6, NULL, NULL),
(3, 'Budi', '3432', '412', 2, 5, NULL, '2023-04-04 00:03:46'),
(4, 'lord hokage', '312312', '32123', 6, NULL, '2023-04-03 21:29:40', '2023-04-03 21:49:15'),
(5, 'tes', '434', '2342', 7, 5, '2023-04-04 00:02:48', '2023-04-04 00:02:48'),
(7, 'tessa', '23423', '4523452344', 10, 6, '2024-12-10 12:04:52', '2024-12-10 12:04:52'),
(8, 'dasda', '342423', '424523423', 11, 6, '2024-12-10 12:05:35', '2024-12-10 12:05:35'),
(9, 'Hatake', '24234234', '63535347', 12, 6, '2024-12-12 12:14:17', '2024-12-12 12:14:17'),
(10, 'Mario', '534534534', '6345634', 13, 6, '2024-12-13 11:29:10', '2024-12-13 11:29:10'),
(11, 'Nelson', '67456745645', '7474566745', 14, 6, '2024-12-13 11:30:02', '2024-12-13 11:30:02'),
(12, 'tera', '34', '423423', 16, 5, '2024-12-13 13:41:11', '2024-12-13 13:41:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_head_id_foreign` (`head_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Index 3` (`code`),
  ADD KEY `FK_books_users` (`worker_id`) USING BTREE;

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_department_id_foreign` (`department_id`),
  ADD KEY `tickets_priority_id_foreign` (`priority_id`),
  ADD KEY `tickets_assign_id_foreign` (`assign_id`),
  ADD KEY `tickets_topics_id_foreign` (`topic_id`) USING BTREE;

--
-- Indeks untuk tabel `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_details_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_details_id_user_foreign` (`user_id`) USING BTREE;

--
-- Indeks untuk tabel `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `transaction_in`
--
ALTER TABLE `transaction_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_transaction_in_workers` (`worker_id`);

--
-- Indeks untuk tabel `transaction_in_details`
--
ALTER TABLE `transaction_in_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_transaction_in_details_transaction_in` (`transaction_id`),
  ADD KEY `FK_transaction_in_details_books` (`product_id`);

--
-- Indeks untuk tabel `transaction_out`
--
ALTER TABLE `transaction_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_transaction_out_workers` (`worker_id`);

--
-- Indeks untuk tabel `transaction_out_details`
--
ALTER TABLE `transaction_out_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `FK_users_levels` (`level_id`) USING BTREE;

--
-- Indeks untuk tabel `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `workers_nik_unique` (`NIK`),
  ADD KEY `workers_user_id_foreign` (`user_id`),
  ADD KEY `FK_workers_departments` (`department_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaction_in`
--
ALTER TABLE `transaction_in`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `transaction_in_details`
--
ALTER TABLE `transaction_in_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `transaction_out`
--
ALTER TABLE `transaction_out`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `transaction_out_details`
--
ALTER TABLE `transaction_out_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `workers`
--
ALTER TABLE `workers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `FK_departments_workers` FOREIGN KEY (`head_id`) REFERENCES `workers` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_books_workers` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Ketidakleluasaan untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `tickets_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`),
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `ticket_details_id_user_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ticket_details_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Ketidakleluasaan untuk tabel `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_in`
--
ALTER TABLE `transaction_in`
  ADD CONSTRAINT `FK_transaction_in_workers` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_in_details`
--
ALTER TABLE `transaction_in_details`
  ADD CONSTRAINT `FK_transaction_in_details_books` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_transaction_in_details_transaction_in` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_in` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_out`
--
ALTER TABLE `transaction_out`
  ADD CONSTRAINT `FK_transaction_out_workers` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_levels` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`);

--
-- Ketidakleluasaan untuk tabel `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `FK_workers_departments` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `workers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
