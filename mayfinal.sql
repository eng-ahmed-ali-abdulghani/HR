-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 04:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `may`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SIT', '2025-01-08 14:32:13', '2025-01-08 14:32:13'),
(2, 'SDC', '2025-01-08 14:32:13', '2025-01-08 14:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `days` double DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `actor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `automatic` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `leader_id`, `created_at`, `updated_at`) VALUES
(5, 'IT', NULL, '2023-10-17 06:17:37', '2023-10-17 07:02:01'),
(9, 'HR', NULL, '2023-11-22 08:14:06', '2023-11-22 08:14:06'),
(10, 'Digital Marketing', NULL, '2023-11-22 08:14:56', '2023-11-22 09:24:13'),
(11, 'Mobile App', NULL, '2023-11-22 08:15:15', '2023-11-22 08:15:15'),
(12, 'DBA', NULL, '2023-11-22 08:15:38', '2023-11-22 08:15:38'),
(13, 'Web Developer', 13, '2023-11-22 08:15:56', '2023-11-22 08:15:56'),
(14, 'ERP Developer', NULL, '2023-11-22 08:19:21', '2023-11-22 08:19:21'),
(15, 'ERP Support', NULL, '2023-11-22 08:19:33', '2023-11-22 08:19:33'),
(16, 'HIS Developer', NULL, '2023-11-22 08:19:47', '2023-11-22 08:19:47'),
(17, 'HIS Support', NULL, '2023-11-22 08:19:59', '2023-11-22 08:19:59'),
(18, 'HIS UI/UX', NULL, '2023-11-22 08:20:25', '2023-11-22 08:20:25'),
(19, 'HIS Branch Manager', NULL, '2023-11-22 09:13:41', '2024-04-03 07:28:29'),
(20, 'General Manager', NULL, '2023-11-22 09:15:10', '2023-11-22 09:15:10'),
(21, 'cs', NULL, '2024-03-14 07:57:43', '2024-04-03 07:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `excuses`
--

CREATE TABLE `excuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `hours` double DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `actor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `leader_approve` tinyint(1) NOT NULL DEFAULT 0,
  `statu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mission` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `excuses`
--

INSERT INTO `excuses` (`id`, `date`, `hours`, `user_id`, `type_id`, `reason_id`, `actor_id`, `note`, `leader_approve`, `statu_id`, `mission`, `created_at`, `updated_at`) VALUES
(1, '2025-01-08', 1, 2, 1, 1, 2, 'محتاجها ضرورى جدا', 0, 3, 0, '2025-01-06 09:26:10', '2025-01-06 09:26:10'),
(2, '2025-01-08', 0.5, 2, 1, 1, 2, 'محتاجها ضرورى جدا', 0, 3, 0, '2025-01-06 09:33:44', '2025-01-06 09:33:44'),
(3, '2025-01-08', 0.5, 2, 1, 1, 2, 'محتاجها ضرورى جدا', 0, 3, 0, '2025-01-06 09:39:22', '2025-01-06 09:39:22'),
(4, '2025-01-08', 0.5, 2, 1, 1, 2, 'محتاجها ضرورى جدا', 0, 3, 1, '2025-01-06 09:39:28', '2025-01-06 09:39:28'),
(5, '2025-01-08', 0.5, 2, 1, 1, 2, 'محتاجها ضرورى جدا', 0, 3, 1, '2025-01-06 12:01:45', '2025-01-06 12:01:45');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2013_12_30_103554_create_departments_table', 1),
(2, '2013_12_31_080655_create_companies_table', 1),
(3, '2013_12_31_095853_create_shifts_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2024_12_31_112628_create_types_table', 1),
(9, '2024_12_31_112634_create_reasons_table', 1),
(12, '2024_12_31_115410_create_deductions_table', 1),
(13, '2024_12_31_120346_create_rewards_table', 1),
(14, '2025_01_01_122330_create_images_table', 1),
(15, '2023_01_06_090548_create_status_table', 2),
(16, '2024_12_31_113251_create_vacations_table', 3),
(17, '2024_12_31_114634_create_excuses_table', 3);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'API TOKEN', '38ee5a9f9792bd4dcd5613d687b4597e158e91b9cf891e6f47e9de7e805e12dd', '[\"*\"]', '2025-01-14 12:08:51', NULL, '2025-01-06 09:06:17', '2025-01-14 12:08:51'),
(2, 'App\\Models\\User', 2, 'API TOKEN', '23f5276e0654e501b8bd5ded6e86c2b887ebb60ca232929369b159e9116352cc', '[\"*\"]', NULL, NULL, '2025-01-07 09:46:02', '2025-01-07 09:46:02'),
(3, 'App\\Models\\User', 2, 'API TOKEN', '527addd9027bfdafc688e37f4e1a21e04b4159b9ccbb505d94e423a664b8ec57', '[\"*\"]', NULL, NULL, '2025-01-08 12:30:10', '2025-01-08 12:30:10'),
(4, 'App\\Models\\User', 2, 'API TOKEN', 'ac7216860a671c417aa2cef6941fe224a4b535ee75fe1f49b88dc8b2a0c54e15', '[\"*\"]', NULL, NULL, '2025-01-08 12:35:03', '2025-01-08 12:35:03'),
(5, 'App\\Models\\User', 2, 'API TOKEN', 'dbc36768634f84318b0861cf6f0cda46765d6749f144fe5d5232ae7a4e06468f', '[\"*\"]', NULL, NULL, '2025-01-08 12:35:58', '2025-01-08 12:35:58'),
(6, 'App\\Models\\User', 2, 'API TOKEN', '44325fb02289e5a9b28a6e181036cb81c2716955b5a73cdacc1437a23b051a9f', '[\"*\"]', NULL, NULL, '2025-01-08 12:36:13', '2025-01-08 12:36:13'),
(7, 'App\\Models\\User', 2, 'API TOKEN', '684d983eee98be1f0379863e96d1657412e7698c938733ec9d943ac3577211ea', '[\"*\"]', NULL, NULL, '2025-01-08 12:37:46', '2025-01-08 12:37:46'),
(8, 'App\\Models\\User', 2, 'API TOKEN', '438a287c8e08a5fc32a8ce7b32abf507e3babbe4782aa1d8ead1974f0a3a1233', '[\"*\"]', NULL, NULL, '2025-01-08 12:39:54', '2025-01-08 12:39:54'),
(9, 'App\\Models\\User', 2, 'API TOKEN', '240c0a6dc724e9ca2de9fe8c723a30468a476fbf1e7ed0b0839c46945511df76', '[\"*\"]', NULL, NULL, '2025-01-08 12:40:21', '2025-01-08 12:40:21'),
(10, 'App\\Models\\User', 2, 'API TOKEN', '3969124a290e6f012b6ecb564496c0551558e2309238ada7d3bdf1d976e7159a', '[\"*\"]', NULL, NULL, '2025-01-08 12:40:55', '2025-01-08 12:40:55'),
(11, 'App\\Models\\User', 2, 'API TOKEN', 'efd5f67089fa9841cc1ac1d1b5ecccba32b3328297a4525d6a46a4dd6fb9341f', '[\"*\"]', NULL, NULL, '2025-01-08 12:41:38', '2025-01-08 12:41:38'),
(12, 'App\\Models\\User', 2, 'API TOKEN', 'a7a61668281071a457d6ddc66b421523277c559a9e36c3c8c330b196bb632e24', '[\"*\"]', NULL, NULL, '2025-01-08 12:45:31', '2025-01-08 12:45:31'),
(13, 'App\\Models\\User', 2, 'API TOKEN', '305eb3f6229f11b1dd7cee037705021ae4b96d119a9edbe0ce45d69e15471dfe', '[\"*\"]', NULL, NULL, '2025-01-08 12:45:55', '2025-01-08 12:45:55'),
(14, 'App\\Models\\User', 2, 'API TOKEN', '7bb5f9cef4b16c2775c1f44a181bf4d2d768715b7e6b42b53ce2b8c4b052e44b', '[\"*\"]', NULL, NULL, '2025-01-08 12:46:09', '2025-01-08 12:46:09'),
(15, 'App\\Models\\User', 2, 'API TOKEN', '8187bd9afae2c9c204e3977bbec5a2696564c62b6e21e59975b3ff3ef15bd1e2', '[\"*\"]', NULL, NULL, '2025-01-08 12:47:19', '2025-01-08 12:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kind` enum('vacation','excuse') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `kind`, `created_at`, `updated_at`) VALUES
(1, 'ظرف شخصى', 'excuse', '2025-01-05 07:29:03', '2025-01-05 07:29:03'),
(2, 'موعد طبى', 'excuse', '2025-01-05 07:29:03', '2025-01-05 07:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` time NOT NULL DEFAULT '00:00:00',
  `end` time NOT NULL DEFAULT '00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, '08:00:00', '05:00:00', NULL, NULL),
(2, '09:00:00', '06:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'موافقة', 'Approved', '2025-01-06 09:14:22', '2025-01-06 09:14:22'),
(2, 'مرفوض', 'Rejected', '2025-01-06 09:14:22', '2025-01-06 09:14:22'),
(3, 'تحت الدراسة', 'Pending', '2025-01-06 09:14:22', '2025-01-06 09:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kind` enum('vacation','excuse') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `kind`, `created_at`, `updated_at`) VALUES
(1, 'إذن خلال ساعات العمل ', 'excuse', '2025-01-05 07:21:16', '2025-01-05 07:21:16'),
(2, 'إذن تأخير عن موعد العمل ', 'excuse', '2025-01-05 07:21:16', '2025-01-05 07:21:16'),
(3, 'إذن إنصارف مبكر عن موعد العمل ', 'excuse', '2025-01-05 07:21:16', '2025-01-05 07:21:16'),
(4, 'عارضة', 'vacation', '2025-01-05 07:21:16', '2025-01-05 07:21:16'),
(5, 'اعتيادية', 'vacation', '2025-01-05 07:21:16', '2025-01-05 07:21:16'),
(6, 'مرضية', 'vacation', '2025-01-05 07:21:16', '2025-01-05 07:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `vacations` double NOT NULL DEFAULT 21,
  `sallary` double NOT NULL DEFAULT 0,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shift_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `fcm_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `title`, `code`, `password`, `phone`, `gender`, `age`, `birth_date`, `vacations`, `sallary`, `start_date`, `end_date`, `department_id`, `company_id`, `shift_id`, `user_type`, `fcm_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'test', 'test', NULL, 'oracle appex developer', '123', '$2y$12$oOuyDq6ItXaj6G3pA8dIjOe9GgYol40NabHV4m4z1TbYkG3hboP.y', '123456789', NULL, NULL, NULL, 21, 0, '2025-01-05 11:22:13', '2025-01-14 15:20:52', 13, 1, 2, 'user', NULL, NULL, '2025-01-05 09:22:13', '2025-01-05 09:22:13'),
(3, 'qutp', 'qutp', NULL, NULL, '111', '$2y$12$xlOWeQt.Ew4DoCC/O4BEsO5jQP3ER9fE7Rbb/kTYh/Srf4GcqTqZO', '111111111', NULL, NULL, NULL, 21, 0, '2025-01-05 11:22:13', '2025-01-08 14:41:34', 13, 1, NULL, 'user', NULL, NULL, '2025-01-05 09:22:13', '2025-01-05 09:22:13'),
(4, 'May', 'May', NULL, NULL, '000', '$2y$12$aVD30qGWMYTHVGoJ675B3u7ieV.VP2nOB0P3kBYpr2jyvDBDiDPoq', '000000000', NULL, NULL, NULL, 21, 0, '2025-01-05 11:22:13', '2025-01-12 14:55:24', 9, 1, NULL, 'admin', NULL, NULL, '2025-01-05 09:22:13', '2025-01-05 09:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

CREATE TABLE `vacations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `day` enum('1','0.5') DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `actor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `alternative_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `leader_approve` tinyint(1) DEFAULT NULL,
  `statu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacations`
--

INSERT INTO `vacations` (`id`, `date`, `day`, `user_id`, `type_id`, `reason_id`, `actor_id`, `alternative_id`, `note`, `leader_approve`, `statu_id`, `created_at`, `updated_at`) VALUES
(1, '2025-01-08', '1', 2, 4, 1, 2, 3, 'محتاجها ضرورى جدا', 1, 3, '2025-01-07 07:56:41', '2025-01-07 07:56:41'),
(2, '2025-01-08', '0.5', 2, 4, 1, 2, 3, 'محتاجها ضرورى جدا', 0, 3, '2025-01-07 08:09:03', '2025-01-07 08:09:03'),
(3, '2025-01-08', '1', 2, 4, 1, 2, 3, 'محتاجها ضرورى جدا', NULL, 3, '2025-01-07 08:10:18', '2025-01-07 08:10:18'),
(4, '2025-01-08', '0.5', 2, 4, 1, 2, 3, 'محتاجها ضرورى جدا', 0, 2, '2025-01-07 08:10:24', '2025-01-19 06:21:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deductions_user_id_foreign` (`user_id`),
  ADD KEY `deductions_type_id_foreign` (`type_id`),
  ADD KEY `deductions_reason_id_foreign` (`reason_id`),
  ADD KEY `deductions_actor_id_foreign` (`actor_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excuses`
--
ALTER TABLE `excuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `excuses_user_id_foreign` (`user_id`),
  ADD KEY `excuses_type_id_foreign` (`type_id`),
  ADD KEY `excuses_reason_id_foreign` (`reason_id`),
  ADD KEY `excuses_actor_id_foreign` (`actor_id`),
  ADD KEY `excuses_statu_id_foreign` (`statu_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_code_unique` (`code`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_company_id_foreign` (`company_id`),
  ADD KEY `users_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacations_user_id_foreign` (`user_id`),
  ADD KEY `vacations_type_id_foreign` (`type_id`),
  ADD KEY `vacations_reason_id_foreign` (`reason_id`),
  ADD KEY `vacations_actor_id_foreign` (`actor_id`),
  ADD KEY `vacations_alternative_id_foreign` (`alternative_id`),
  ADD KEY `vacations_statu_id_foreign` (`statu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `excuses`
--
ALTER TABLE `excuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deductions`
--
ALTER TABLE `deductions`
  ADD CONSTRAINT `deductions_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `deductions_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`),
  ADD CONSTRAINT `deductions_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `deductions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `excuses`
--
ALTER TABLE `excuses`
  ADD CONSTRAINT `excuses_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `excuses_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`),
  ADD CONSTRAINT `excuses_statu_id_foreign` FOREIGN KEY (`statu_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `excuses_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `excuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`);

--
-- Constraints for table `vacations`
--
ALTER TABLE `vacations`
  ADD CONSTRAINT `vacations_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vacations_alternative_id_foreign` FOREIGN KEY (`alternative_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vacations_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`),
  ADD CONSTRAINT `vacations_statu_id_foreign` FOREIGN KEY (`statu_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `vacations_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `vacations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
