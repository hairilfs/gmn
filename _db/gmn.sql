-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2017 at 08:17 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gmn`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_budget`
--

CREATE TABLE IF NOT EXISTS `performance_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `contract_number` varchar(255) NOT NULL,
  `contract_date` timestamp NULL DEFAULT NULL,
  `value` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `performance_budget`
--

INSERT INTO `performance_budget` (`id`, `client_name`, `client_address`, `job_title`, `contract_number`, `contract_date`, `value`, `created_at`, `updated_at`) VALUES
(1, 'PT. MANCING MANIA MANTAP', 'Jl. Jakarta Lewat Bandung', 'Tambah tiang pemancars', 'ERR-00404KHGS-63', '2017-11-03 17:00:00', 5600000, '2017-08-14 16:09:10', '2017-08-26 15:14:39'),
(2, 'PT. MONDAR MANDIR', 'Jl. Ketapang Ketipung', 'Pasang baru', 'EESddfsd-33', '2017-10-08 17:00:00', 67000000, '2017-08-14 16:13:43', '2017-08-26 15:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `performance_budget_detail`
--

CREATE TABLE IF NOT EXISTS `performance_budget_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `performance_budget_id` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `performance_budget_detail`
--

INSERT INTO `performance_budget_detail` (`id`, `performance_budget_id`, `pekerjaan`, `qty`, `satuan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'Setting out / persiapan lokasi', 2, 'ls', 15000000, '2017-08-15 16:50:18', '2017-08-15 16:50:18'),
(4, 1, 'gembae', 454, 'ons', 231000, '2017-08-19 15:34:56', '2017-08-19 15:34:56'),
(5, 1, 'pasang kabel', 30, 'm', 1200000, '2017-08-22 12:59:13', '2017-08-22 12:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `po_detail`
--

CREATE TABLE IF NOT EXISTS `po_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `uraian` text NOT NULL,
  `harga` bigint(20) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`id`, `po_id`, `qty`, `unit`, `uraian`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 470, 'Unit', '<p><strong>PLTS-PLTD Kalimantan Barat</strong></p>\r\n\r\n<p>Baterai Merk Nipress type OpzV 2-1000 2V</p>\r\n', 4800000, 0, '2017-08-28 16:52:19', '2017-08-29 14:32:59'),
(2, 1, 100, 'Meter', '<p>Kabel Listrik. Tipe SS-09MK</p>\r\n', 90000, 0, '2017-08-29 14:26:55', '2017-08-29 14:26:55'),
(3, 1, 20, 'Lembar', '<p>Panel Surya KL-D899XN</p>\r\n', 300000, 0, '2017-08-29 14:36:15', '2017-08-29 14:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_no` varchar(255) NOT NULL,
  `performance_budget_id` int(11) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `person` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `pembayaran` varchar(255) NOT NULL,
  `pengiriman` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `purchase_order_no`, `performance_budget_id`, `kepada`, `address`, `phone`, `person`, `position`, `pembayaran`, `pengiriman`, `created_at`, `updated_at`) VALUES
(1, '123/WDS/BII/E342', 1, 'PT. ABC Alkaline Energy', 'Jl. Setrum No. 23', '021-666-521-66 / 012234232123', 'Bapak Hendri Anung', 'Branch Marketing', 'ngutang', 'belakangan', '2017-08-26 16:06:08', '2017-08-28 15:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hairil', 'hairilfiqri@gmail.com', '$2y$10$ccYzdzcyTcLEWkU2r2Jt0uex/1lrIkTuleb0/HvVJVvilKXMK8GhK', '84k9LaeRR0IVSsg1H1A2yT7vUpzS8ZGfW1945iPfXhbIduMgtqCpSaDKlYFo', '2017-08-08 06:28:14', '2017-08-22 13:44:26'),
(2, 'ADE SAPUTRA', 'ade_gmn@yahoo.com', '$2y$10$8GMI2ZstXSymb5CLeH/G7eZye5lCWNGo8xD2LZ5F5fX.uCkjVRoQq', '3PN4rbh7bR7WJBxZKKdfwJUuLT7YBdla6vhicVjKzieSgrvYhCnIbLjfJEHY', '2017-08-22 13:46:37', '2017-08-22 13:56:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
