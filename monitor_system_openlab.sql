-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 05:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitor_system_openlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `name`, `location`, `description`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Lab Komputer 1', 'Gedung A Lt. 1', 'Laboratorium komputer utama dengan 30 unit PC', 2, '2025-08-01 06:38:42', '2025-08-04 07:37:22'),
(2, 'Lab Komputer 2', 'Gedung A Lt. 2', 'Laboratorium komputer sekunder dengan 25 unit PC', 2, '2025-08-01 06:38:42', '2025-08-04 07:37:23'),
(3, 'Lab Jaringan', 'Gedung B Lt. 1', 'Laboratorium khusus untuk praktikum jaringan', 1, '2025-08-01 06:38:42', '2025-08-04 07:37:06'),
(4, 'Lab Multimedia', 'Gedung B Lt. 2', 'Laboratorium untuk praktikum multimedia dan desain', 2, '2025-08-01 06:38:42', '2025-08-04 07:37:24'),
(5, 'Lab Server', 'Gedung C Lt. 1', 'Laboratorium server dan database', 1, '2025-08-01 06:38:42', '2025-08-04 07:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `lab_status_logs`
--

CREATE TABLE `lab_status_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lab_id` bigint(20) UNSIGNED NOT NULL,
  `previous_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `new_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_status_logs`
--

INSERT INTO `lab_status_logs` (`id`, `lab_id`, `previous_status_id`, `new_status_id`, `changed_by`, `changed_at`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, 2, '2025-08-01 15:31:40', '2025-08-01 08:31:40', '2025-08-01 08:31:40'),
(2, 3, NULL, NULL, 2, '2025-08-01 15:55:07', '2025-08-01 08:55:07', '2025-08-01 08:55:07'),
(3, 1, NULL, NULL, 2, '2025-08-01 15:57:45', '2025-08-01 08:57:45', '2025-08-01 08:57:45'),
(4, 3, NULL, NULL, 2, '2025-08-01 15:57:46', '2025-08-01 08:57:46', '2025-08-01 08:57:46'),
(5, 3, NULL, NULL, 2, '2025-08-01 15:57:47', '2025-08-01 08:57:47', '2025-08-01 08:57:47'),
(6, 3, NULL, NULL, 2, '2025-08-01 15:57:48', '2025-08-01 08:57:48', '2025-08-01 08:57:48'),
(7, 3, NULL, NULL, 2, '2025-08-01 15:57:49', '2025-08-01 08:57:49', '2025-08-01 08:57:49'),
(8, 1, NULL, NULL, 2, '2025-08-01 15:57:51', '2025-08-01 08:57:51', '2025-08-01 08:57:51'),
(9, 3, NULL, NULL, 2, '2025-08-01 15:58:08', '2025-08-01 08:58:08', '2025-08-01 08:58:08'),
(10, 1, NULL, NULL, 2, '2025-08-01 15:58:10', '2025-08-01 08:58:10', '2025-08-01 08:58:10'),
(11, 2, NULL, NULL, 2, '2025-08-01 15:58:11', '2025-08-01 08:58:11', '2025-08-01 08:58:11'),
(12, 2, NULL, NULL, 2, '2025-08-01 15:58:12', '2025-08-01 08:58:12', '2025-08-01 08:58:12'),
(13, 1, NULL, NULL, 2, '2025-08-01 15:58:33', '2025-08-01 08:58:33', '2025-08-01 08:58:33'),
(14, 2, NULL, NULL, 2, '2025-08-01 15:58:34', '2025-08-01 08:58:34', '2025-08-01 08:58:34'),
(15, 5, NULL, NULL, 2, '2025-08-01 15:58:35', '2025-08-01 08:58:35', '2025-08-01 08:58:35'),
(16, 3, NULL, NULL, 2, '2025-08-03 22:57:20', '2025-08-03 15:57:20', '2025-08-03 15:57:20'),
(17, 3, NULL, NULL, 2, '2025-08-03 22:57:36', '2025-08-03 15:57:36', '2025-08-03 15:57:36'),
(18, 3, NULL, NULL, 2, '2025-08-03 23:01:43', '2025-08-03 16:01:43', '2025-08-03 16:01:43'),
(19, 3, NULL, NULL, 2, '2025-08-03 23:01:45', '2025-08-03 16:01:45', '2025-08-03 16:01:45'),
(20, 3, NULL, NULL, 2, '2025-08-03 23:01:51', '2025-08-03 16:01:51', '2025-08-03 16:01:51'),
(21, 3, NULL, NULL, 2, '2025-08-03 23:02:54', '2025-08-03 16:02:54', '2025-08-03 16:02:54'),
(22, 3, NULL, NULL, 2, '2025-08-03 23:02:57', '2025-08-03 16:02:57', '2025-08-03 16:02:57'),
(23, 3, NULL, NULL, 2, '2025-08-03 23:02:59', '2025-08-03 16:02:59', '2025-08-03 16:02:59'),
(24, 3, NULL, NULL, 2, '2025-08-03 23:03:02', '2025-08-03 16:03:02', '2025-08-03 16:03:02'),
(25, 1, NULL, NULL, 2, '2025-08-03 23:03:04', '2025-08-03 16:03:04', '2025-08-03 16:03:04'),
(26, 5, NULL, NULL, 2, '2025-08-03 23:03:27', '2025-08-03 16:03:27', '2025-08-03 16:03:27'),
(27, 5, NULL, NULL, 2, '2025-08-03 23:03:28', '2025-08-03 16:03:28', '2025-08-03 16:03:28'),
(28, 5, NULL, NULL, 2, '2025-08-03 23:03:29', '2025-08-03 16:03:29', '2025-08-03 16:03:29'),
(29, 1, NULL, NULL, 2, '2025-08-03 23:03:34', '2025-08-03 16:03:34', '2025-08-03 16:03:34'),
(30, 3, NULL, NULL, 2, '2025-08-03 23:04:13', '2025-08-03 16:04:13', '2025-08-03 16:04:13'),
(31, 1, NULL, NULL, 2, '2025-08-03 23:04:26', '2025-08-03 16:04:26', '2025-08-03 16:04:26'),
(32, 1, NULL, NULL, 2, '2025-08-03 23:07:00', '2025-08-03 16:07:00', '2025-08-03 16:07:00'),
(33, 1, NULL, NULL, 2, '2025-08-03 23:07:05', '2025-08-03 16:07:05', '2025-08-03 16:07:05'),
(34, 1, NULL, NULL, 2, '2025-08-03 23:07:07', '2025-08-03 16:07:07', '2025-08-03 16:07:07'),
(35, 1, NULL, NULL, 2, '2025-08-03 23:07:27', '2025-08-03 16:07:27', '2025-08-03 16:07:27'),
(36, 2, NULL, NULL, 2, '2025-08-03 23:07:34', '2025-08-03 16:07:34', '2025-08-03 16:07:34'),
(37, 1, NULL, NULL, 2, '2025-08-03 23:07:34', '2025-08-03 16:07:34', '2025-08-03 16:07:34'),
(38, 5, NULL, NULL, 2, '2025-08-03 23:07:35', '2025-08-03 16:07:35', '2025-08-03 16:07:35'),
(39, 1, NULL, NULL, 2, '2025-08-03 23:07:50', '2025-08-03 16:07:50', '2025-08-03 16:07:50'),
(40, 2, NULL, NULL, 2, '2025-08-03 23:08:00', '2025-08-03 16:08:00', '2025-08-03 16:08:00'),
(41, 2, NULL, NULL, 2, '2025-08-03 23:08:02', '2025-08-03 16:08:02', '2025-08-03 16:08:02'),
(42, 2, NULL, NULL, 2, '2025-08-03 23:09:05', '2025-08-03 16:09:05', '2025-08-03 16:09:05'),
(43, 2, NULL, NULL, 2, '2025-08-03 23:09:06', '2025-08-03 16:09:06', '2025-08-03 16:09:06'),
(44, 2, NULL, NULL, 2, '2025-08-03 23:09:08', '2025-08-03 16:09:08', '2025-08-03 16:09:08'),
(45, 1, NULL, NULL, 2, '2025-08-03 23:12:21', '2025-08-03 16:12:21', '2025-08-03 16:12:21'),
(46, 1, NULL, NULL, 2, '2025-08-03 23:12:23', '2025-08-03 16:12:23', '2025-08-03 16:12:23'),
(47, 1, NULL, NULL, 2, '2025-08-03 23:12:25', '2025-08-03 16:12:25', '2025-08-03 16:12:25'),
(48, 1, NULL, NULL, 2, '2025-08-03 23:12:27', '2025-08-03 16:12:27', '2025-08-03 16:12:27'),
(49, 3, NULL, NULL, 2, '2025-08-04 14:37:06', '2025-08-04 07:37:06', '2025-08-04 07:37:06'),
(50, 2, NULL, NULL, 2, '2025-08-04 14:37:07', '2025-08-04 07:37:07', '2025-08-04 07:37:07'),
(51, 5, NULL, NULL, 2, '2025-08-04 14:37:09', '2025-08-04 07:37:09', '2025-08-04 07:37:09'),
(52, 1, NULL, NULL, 2, '2025-08-04 14:37:22', '2025-08-04 07:37:22', '2025-08-04 07:37:22'),
(53, 2, NULL, NULL, 2, '2025-08-04 14:37:23', '2025-08-04 07:37:23', '2025-08-04 07:37:23'),
(54, 4, NULL, NULL, 2, '2025-08-04 14:37:24', '2025-08-04 07:37:24', '2025-08-04 07:37:24');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_01_000001_create_statuses_table', 1),
(5, '2024_08_01_000002_create_labs_table', 1),
(6, '2024_08_01_000003_create_lab_status_logs_table', 1);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aKpqTzWioa3MJjyPVjlxJQcjQwpOr0JqLjJ7OM8T', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYzlOSml6cTlZdkRXamJkS2tmdVI5TVczcFZWSkdTd0NDYW5IUlU4ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754362680),
('fFm2HTGAa6obJRenSEuPXO7FBek8yiYfqpY95AWv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNkpDR2NqUlQ2ZjNreGd1N0xrQ2tnRUt0WExKeUVoNU0zRWFmU0JWeSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1754362684),
('tCZsXUhZq4qeNi2IhPooHzmPjleh2X2vnK6P9Igf', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib0Y1ajkzRFNsa2xCbXR6YXRpNUh0eTJDQ21JR3Axck9YMjJXS1hyaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1754320806);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `color_code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Kosong', '#28a745', '2025-08-01 06:38:42', '2025-08-01 06:38:42'),
(2, 'Terisi', '#dc3545', '2025-08-01 06:38:42', '2025-08-01 06:38:42'),
(3, 'Hampir Selesai', '#ffc107', '2025-08-01 06:38:42', '2025-08-01 06:38:42');

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
  `role` enum('admin','panitia') NOT NULL DEFAULT 'panitia',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-08-01 06:38:42', '$2y$12$YAgQjd1ZkFIGP5AJCpPhPOu8lXa6g89etTrbpcewzSyLetCeJZ0W.', 'panitia', 'lP8thM2Str', '2025-08-01 06:38:42', '2025-08-01 06:38:42'),
(2, 'Admin FPMIPA', 'admin@fpmipa.upi.edu', NULL, '$2y$12$ewpnxZ10vqVYnUWGKh09Au2Al5u.T1ycwWA0rPgWmMGG6D0MINUCW', 'admin', NULL, '2025-08-01 08:26:00', '2025-08-01 08:26:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labs_status_id_foreign` (`status_id`);

--
-- Indexes for table `lab_status_logs`
--
ALTER TABLE `lab_status_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_status_logs_lab_id_foreign` (`lab_id`),
  ADD KEY `lab_status_logs_previous_status_id_foreign` (`previous_status_id`),
  ADD KEY `lab_status_logs_new_status_id_foreign` (`new_status_id`),
  ADD KEY `lab_status_logs_changed_by_foreign` (`changed_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lab_status_logs`
--
ALTER TABLE `lab_status_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `labs`
--
ALTER TABLE `labs`
  ADD CONSTRAINT `labs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lab_status_logs`
--
ALTER TABLE `lab_status_logs`
  ADD CONSTRAINT `lab_status_logs_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lab_status_logs_lab_id_foreign` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lab_status_logs_new_status_id_foreign` FOREIGN KEY (`new_status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lab_status_logs_previous_status_id_foreign` FOREIGN KEY (`previous_status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
