-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2019 at 05:35 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_services`
--

CREATE TABLE `add_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_services`
--

INSERT INTO `add_services` (`id`, `service`, `qty`, `tag`, `price`, `created_at`, `updated_at`) VALUES
(1, 'torn collar', '2', '597628288', '300', '2019-06-21 08:26:21', '2019-06-21 08:26:21'),
(2, 'Torn zip', '1', '597628288', '400', '2019-06-21 08:26:21', '2019-06-21 08:26:21'),
(3, 'torn collar', '2', '2110994699', '300', '2019-06-21 13:48:03', '2019-06-21 13:48:03'),
(4, 'Torn zip', '1', '2110994699', '400', '2019-06-21 13:48:03', '2019-06-21 13:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `amount`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Agbada', '2000', '3', '2019-06-21 05:39:47', '2019-06-21 05:42:44'),
(2, 'Iro, buba & Gele', '1550', '3', '2019-06-21 05:43:06', '2019-06-21 05:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `cus_id`, `created_at`, `updated_at`) VALUES
(2, 'Ayorinde Rachel Abel', 'abelrachel90@gmail.com', '09090908789', 'Sango Ota', 'b72e99e', '2019-06-12 13:01:45', '2019-06-12 13:17:49'),
(3, 'Yakubu Damilola', 'yd4u2c@yahoo.com', '09044353233', 'abeokuta', '4c4aa2f', '2019-06-12 14:05:00', '2019-06-12 14:05:00'),
(4, 'Adeola', 'Deola@gmail.com', '09090908789', 'Ikeja', '105ddb3', '2019-06-18 09:58:43', '2019-06-18 09:58:43');

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
(4, '2019_06_12_124833_create_customers_table', 3),
(8, '2019_06_10_214841_create_categories_table', 5),
(10, '2019_06_21_070132_create_services_table', 7),
(11, '2019_06_13_111434_create_stocks_table', 8),
(13, '2019_06_21_090157_create_add_services_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Worn-out zip', '400', '2019-06-21 06:10:51', '2019-06-21 14:10:43'),
(3, 'torn collar', '300', '2019-06-21 06:25:29', '2019-06-21 06:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fold` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addamount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collect_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_paid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `cus_id`, `tag`, `category`, `qty`, `exp`, `fold`, `price`, `info`, `addamount`, `collect_date`, `discount`, `balance`, `deposit`, `balance_paid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ayorinde Rachel Abel', 'b72e99e', '597628288', 'Agbada', '2', '3', 'Hang', '2000', '(1) green, (2) blue', '1000', '2019-06-30', '5', '3485', '3000', '2019-06-21', 1, '2019-06-21 07:41:58', '2019-06-21 09:24:02'),
(2, 'Ayorinde Rachel Abel', 'b72e99e', '597628288', 'Iro, buba & Gele', '1', '3', 'Fold', '1550', NULL, '1000', '2019-06-30', '5', '3485', '3000', '2019-06-21', 1, '2019-06-21 07:41:58', '2019-06-21 09:24:02'),
(3, 'Yakubu Damilola', '4c4aa2f', '2110994699', 'Agbada', '2', '3', 'Fold', '2000', '(1) green, (1) blue', '1000', '2019-06-29', '5', '6625', '3000', '2019-06-21', 1, '2019-06-21 13:46:45', '2019-06-21 13:57:17'),
(4, 'Yakubu Damilola', '4c4aa2f', '2110994699', 'Iro, buba & Gele', '3', '3', 'Hang', '1550', '(2) blue (1) yellow', '1000', '2019-06-29', '5', '6625', '3000', '2019-06-21', 1, '2019-06-21 13:46:45', '2019-06-21 13:57:17'),
(5, 'Adeola', '105ddb3', '1495670028', 'Agbada', '1', '3', 'Fold', '2000', '1 yellow', NULL, '2019-06-29', '0', '355', '5000', NULL, 0, '2019-06-21 14:11:21', '2019-06-21 14:15:03'),
(6, 'Adeola', '105ddb3', '1495670028', 'Iro, buba & Gele', '2', '3', 'Hang', '1550', 'i blue i green', NULL, '2019-06-29', '0', '355', '5000', NULL, 0, '2019-06-21 14:11:21', '2019-06-21 14:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin admin', 'admin@admin.com', NULL, '$2y$10$1QM5fUifmDE86VVEJhfVreMx/v7BWfCDKl9xe8knKI3rm6Qr0lDPq', '0', NULL, '2019-06-10 13:41:45', '2019-06-18 05:51:22'),
(5, 'Yakubu Damilola', 'yd4u2c@yahoo.com', NULL, '$2y$10$ApjfCjSUmbcW.7gQyv8eY.nRsWxJs6RZbKUh7jhHQe5ej6B5u4DV6', '1', NULL, '2019-06-18 05:48:30', '2019-06-18 05:48:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_services`
--
ALTER TABLE `add_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_unique` (`category`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
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
-- AUTO_INCREMENT for table `add_services`
--
ALTER TABLE `add_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
