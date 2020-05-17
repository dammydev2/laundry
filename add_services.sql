-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 01:15 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

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
  `service` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_services`
--

INSERT INTO `add_services` (`id`, `service`, `qty`, `tag`, `category`, `price`, `created_at`, `updated_at`) VALUES
(1, 'torn zip', '1', '10022', 'iro, buba & gele', '200', '2019-07-15 08:40:06', '2019-07-15 09:20:08'),
(2, 'wornout collar', '2', '10022', 'agbada', '100', '2019-07-15 08:40:06', '2019-07-15 09:06:58'),
(3, 'torn zip', '1', '10024', 'agbada', '200', '2019-07-15 08:42:08', '2019-07-15 09:20:08'),
(4, 'wornout collar', '1', '10024', 'iro, buba & gele', '100', '2019-07-15 08:42:08', '2019-07-15 09:06:58'),
(5, 'torn zip', '1', '10026', 'iro, buba & gele', '200', '2019-07-15 08:51:33', '2019-07-15 09:20:08'),
(6, 'wornout collar', '2', '10026', 'agbada', '100', '2019-07-15 08:51:33', '2019-07-15 09:06:58'),
(7, 'torn zip', '2', '10028', 'agbada', '200', '2019-07-15 09:02:10', '2019-07-15 09:20:08'),
(8, 'torn zip', '2', '10001', 'iro, buba & gele', '200', '2019-07-15 09:06:58', '2019-07-15 09:20:08'),
(9, 'wornout collar', '1', '10001', 'agbada', '100', '2019-07-15 09:06:58', '2019-07-15 09:06:58'),
(10, 'torn zip', '1', '10003', 'agbada', '200', '2019-07-15 09:17:29', '2019-07-15 09:20:08'),
(11, 'torn zip', '1', '10005', 'iro, buba & gele', '200', '2019-07-15 09:20:08', '2019-07-15 09:20:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_services`
--
ALTER TABLE `add_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_services`
--
ALTER TABLE `add_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
