-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 08:03 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_canteen_manag_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `canteens`
--

CREATE TABLE `canteens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','in active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `canteens`
--

INSERT INTO `canteens` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Engineering', 'active', '2022-03-01 07:09:57', '2022-03-01 10:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('veg','non-veg') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'veg',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canteen_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `type`, `image`, `price`, `description`, `canteen_id`, `created_at`, `updated_at`) VALUES
(1, 'Fried Rice', 'veg', '1646118783.jpg', 120.00, 'Fried rice is a dish of cooked rice that has been stir-fried in a wok or a frying pan and is usually mixed with other ingredients such as eggs, vegetables,', 1, '2022-03-01 07:13:03', '2022-03-01 07:13:03'),
(2, 'Biryani', 'veg', '1646119703.jpg', 200.00, 'Long-grained rice (like basmati) flavored with fragrant spices such as saffron and layered with lamb, chicken, fish, or vegetables and a thick gravy.', 1, '2022-03-01 07:28:23', '2022-03-01 07:28:23'),
(3, 'Chicken Biryani', 'non-veg', '1646119794.jpg', 280.00, 'Traditional chicken biryani is made by layering marinated chicken at the bottom of a pot followed by another layer of par cooked rice, herbs, ...', 1, '2022-03-01 07:29:54', '2022-03-01 07:29:54'),
(4, 'Dosa', 'veg', '1646127163.jpg', 60.00, 'dfujvbfdkvfovndmvnbdgbn', 1, '2022-03-01 09:32:43', '2022-03-01 09:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_14_141532_create_profiles_table', 1),
(6, '2022_02_15_154645_create_permission_tables', 1),
(7, '2022_02_21_185922_create_canteens_table', 1),
(8, '2022_02_22_134734_create_food_items_table', 1),
(9, '2022_02_27_133954_create_orders_table', 1),
(10, '2022_02_27_170955_create_notifications_table', 1),
(13, '2022_03_06_121808_create_offers_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('05ea22c0-a903-4ae2-b243-9e602b7a86f5', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Dosa!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"QO1c6U2KTu6BgD0PPOgO\"}', '2022-03-02 17:55:41', '2022-03-01 11:48:50', '2022-03-02 17:55:41'),
('1c8b3adc-3f73-4a37-bef4-87379330f54f', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Biryani!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"bMoS1w527n8vsY2z85Bn\"}', '2022-03-02 17:55:41', '2022-03-01 11:48:43', '2022-03-02 17:55:41'),
('22da8113-0ccd-4f66-a932-974d061154ca', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Biryani!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"S2v30OWepEsWng2plMzh\"}', '2022-03-01 09:40:29', '2022-03-01 07:37:10', '2022-03-01 09:40:29'),
('37a6e1f7-1d27-4895-89c5-9d523838a732', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Fried Rice!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"aOvZqjhARQBO1mCvYvLB\"}', '2022-03-02 17:55:41', '2022-03-01 11:46:04', '2022-03-02 17:55:41'),
('54fd1332-be26-4c15-96e2-cf3d55435224', 'App\\Notifications\\Status', 'App\\Models\\User', 2, '{\"info\":\"Order is in-progress!\",\"link\":\"http:\\/\\/localhost:8000\\/order\\/8\"}', NULL, '2022-03-15 07:40:38', '2022-03-15 07:40:38'),
('5d66e4b2-0669-4ff2-9812-4885bc83b700', 'App\\Notifications\\NewOffer', 'App\\Models\\User', 2, '{\"info\":\"New Offer Womens Day\",\"link\":\"http:\\/\\/localhost:8000\\/offer\"}', NULL, '2022-03-06 08:10:56', '2022-03-06 08:10:56'),
('67ff3861-3240-43d6-9004-4dc1bddc4f74', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Fried Rice!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"snFZrC6ckv4PAI1GSVY5\"}', '2022-03-02 17:55:41', '2022-03-01 11:55:00', '2022-03-02 17:55:41'),
('6da3fe50-435f-4660-af1c-6517db4f8ba5', 'App\\Notifications\\Status', 'App\\Models\\User', 3, '{\"info\":\"Order is delivered!\",\"link\":\"http:\\/\\/localhost:8000\\/order\\/3\"}', '2022-03-01 11:33:39', '2022-03-01 10:25:11', '2022-03-01 11:33:39'),
('8481e538-3166-4ecd-b0fe-a8f78028ede6', 'App\\Notifications\\NewOffer', 'App\\Models\\User', 3, '{\"info\":\"New Offer Womens Day\",\"link\":\"http:\\/\\/localhost:8000\\/offer\"}', NULL, '2022-03-06 08:10:56', '2022-03-06 08:10:56'),
('8baa48a8-788f-4ceb-bfeb-64bca8c270fc', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Chicken Biryani!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"EHm9QyEDTWFjLrkyUMQj\"}', '2022-03-02 17:55:41', '2022-03-01 10:24:30', '2022-03-02 17:55:41'),
('9d85d445-863f-4461-85f7-7992789cdcca', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Chicken Biryani!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"J038b9Un4qRMn8khIcV9\"}', '2022-03-01 09:40:29', '2022-03-01 07:41:10', '2022-03-01 09:40:29'),
('aca5cb2e-7ee3-4513-a3f7-ae583eaf150a', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"info\":\"New Order Fried Rice!\",\"customer_name\":\"Ranjith Acharya\",\"order\":\"edcJNQ3PqvUWiTL9vipx\"}', '2022-03-15 07:52:44', '2022-03-15 07:25:54', '2022-03-15 07:52:44'),
('da317a9a-d364-4583-b698-0088d82d1d8e', 'App\\Notifications\\Status', 'App\\Models\\User', 2, '{\"info\":\"Order is in-progress!\",\"link\":\"http:\\/\\/localhost:8000\\/order\\/1\"}', NULL, '2022-03-01 09:34:34', '2022-03-01 09:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(8,2) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `percentage`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Womens Day', '25.00', 'KJWOMEN25', 'Its Womens Day', '2022-03-06 08:10:56', '2022-03-06 08:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `type` enum('veg','non-veg') COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` decimal(8,2) UNSIGNED NOT NULL,
  `total` decimal(8,2) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_status` enum('ordered','in-progress','on-the-way','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('received','in-progress','on-the-way','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `canteen_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `price`, `type`, `count`, `total`, `reference`, `customer_status`, `status`, `customer_id`, `canteen_id`, `created_at`, `updated_at`) VALUES
(1, 'Biryani', 200.00, 'veg', '2.00', '400.00', 'S2v30OWepEsWng2plMzh', 'in-progress', 'in-progress', 2, 1, '2022-03-01 07:37:10', '2022-03-01 09:34:34'),
(2, 'Chicken Biryani', 280.00, 'non-veg', '2.00', '560.00', 'J038b9Un4qRMn8khIcV9', 'ordered', 'received', 2, 1, '2022-02-26 07:41:10', '2022-03-01 07:41:10'),
(3, 'Chicken Biryani', 280.00, 'non-veg', '2.00', '560.00', 'EHm9QyEDTWFjLrkyUMQj', 'delivered', 'delivered', 3, 1, '2022-02-26 10:24:30', '2022-03-01 10:25:11'),
(4, 'Fried Rice', 120.00, 'veg', '2.00', '240.00', 'aOvZqjhARQBO1mCvYvLB', 'ordered', 'received', 3, 1, '2022-03-01 11:46:05', '2022-03-01 11:46:05'),
(5, 'Biryani', 200.00, 'veg', '2.00', '400.00', 'bMoS1w527n8vsY2z85Bn', 'ordered', 'received', 3, 1, '2022-03-01 11:48:43', '2022-03-01 11:48:43'),
(6, 'Dosa', 60.00, 'veg', '4.00', '240.00', 'QO1c6U2KTu6BgD0PPOgO', 'ordered', 'received', 3, 1, '2022-03-01 11:48:50', '2022-03-01 11:48:50'),
(7, 'Fried Rice', 120.00, 'veg', '2.00', '240.00', 'snFZrC6ckv4PAI1GSVY5', 'ordered', 'received', 3, 1, '2022-03-01 11:55:00', '2022-03-01 11:55:00'),
(8, 'Fried Rice', 120.00, 'veg', '2.00', '240.00', 'edcJNQ3PqvUWiTL9vipx', 'in-progress', 'in-progress', 2, 1, '2022-03-15 07:25:54', '2022-03-15 07:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ranjithacharya997@gmail.com', '$2y$10$u5GzRrrcatxkeOSI6l/ePOMrdg2m3o7HrHuMxRFijFIQTOoVtN8.a', '2022-03-01 10:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `avatar`, `branch`, `year`, `department`, `contact`, `instagram`, `linkedin`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, '1646127372.png', 'c.s', 'final', 'b.e', '9930116450', '_ranjithacharya_', 'ranjith-acharya', 2, '2022-03-01 09:36:12', '2022-03-01 09:36:12'),
(2, '1646137033.png', 'c.s', 'final', 'b.e', '9930116450', '_ranjithacharya_', 'ranjith-acharya', 3, '2022-03-01 12:17:13', '2022-03-01 12:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-02-28 12:04:06', '2022-02-28 12:04:06'),
(2, 'customer', 'web', '2022-02-28 12:04:06', '2022-02-28 12:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardcvv` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `card`, `cardcvv`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@app.com', 'o8cuia6CkQRtrJJX', 'NNYI', 'default.png', '2022-02-28 12:04:06', '$2y$10$WrtH22C.VZYsYA.EyST5HuQrn6o6wUPDyFwbRVgGZDsHd1yhwNJYi', NULL, '2022-02-28 12:04:06', '2022-02-28 12:04:06'),
(2, 'customer', 'Ranjith Acharya', 'customer@app.com', '1234567890123456', '666', '1646127372.png', '2022-03-01 07:07:00', '$2y$10$8lgX5QO77CF68jkIm7KGhO3VWO5tlA0BrBZroU/mpQNA4GkoYENUe', 'pwZ6WA3Z1mZ8AQiWGdy4Ah8tb6Ea9XTmyYez6FQbWfZHaIZgDFQz8dG7Dm37', '2022-02-28 12:06:08', '2022-03-01 09:36:12'),
(3, 'customer', 'Ranjith Acharya', 'ranjithacharya997@gmail.com', '9876543165164941', '666', '1646137033.png', '2022-03-01 10:22:12', '$2y$10$VktO4qtDwbvfeH/UwetuK.2nsS3pAASIkPb71BqKXSE3VQIOkgUDW', NULL, '2022-03-01 10:21:47', '2022-03-01 12:17:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canteens`
--
ALTER TABLE `canteens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_items_canteen_id_foreign` (`canteen_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offers_code_unique` (`code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_canteen_id_foreign` (`canteen_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_card_unique` (`card`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canteens`
--
ALTER TABLE `canteens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_items`
--
ALTER TABLE `food_items`
  ADD CONSTRAINT `food_items_canteen_id_foreign` FOREIGN KEY (`canteen_id`) REFERENCES `canteens` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_canteen_id_foreign` FOREIGN KEY (`canteen_id`) REFERENCES `canteens` (`id`),
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
