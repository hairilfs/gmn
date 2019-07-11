-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2019 at 01:00 AM
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
-- Table structure for table `advance_payment`
--

CREATE TABLE IF NOT EXISTS `advance_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_id` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `request` bigint(20) NOT NULL,
  `request_date` timestamp NULL DEFAULT NULL,
  `request_note` varchar(255) NOT NULL,
  `confirm` bigint(20) NOT NULL,
  `confirm_date` timestamp NULL DEFAULT NULL,
  `confirm_note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `advance_payment`
--

INSERT INTO `advance_payment` (`id`, `pb_id`, `nip`, `nama`, `request`, `request_date`, `request_note`, `confirm`, `confirm_date`, `confirm_note`, `created_at`, `updated_at`) VALUES
(3, 4, '03TFK', 'TAUFIK', 35000000, '2017-11-27 17:00:00', 'Beli Seng', 36000000, '2017-11-28 17:00:00', 'minus sejuta gan -_-', '2017-11-29 15:19:16', '2017-11-29 15:19:47'),
(4, 4, '909090', 'Udin', 230000, '2017-12-05 17:00:00', 'test aja', 0, NULL, '', '2017-12-10 13:42:56', '2017-12-10 13:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` varchar(255) NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `tipe` int(11) NOT NULL,
  `invoice_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(10) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `pb_id` int(11) NOT NULL,
  `jumlah` bigint(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `pembayaran_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `value` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `performance_budget`
--

INSERT INTO `performance_budget` (`id`, `client_name`, `client_address`, `job_title`, `contract_number`, `contract_date`, `start_date`, `end_date`, `value`, `created_at`, `updated_at`) VALUES
(2, 'PT. NUsa Bangsa', 'Jl. Manunggal No. 44', 'Pemasangan Baterai', '2342342342', '2017-11-24 17:00:00', NULL, NULL, 6000000000, '2017-11-29 13:19:44', '2017-11-29 13:19:44'),
(3, 'sf', 'sfgsdf', 'sdgsf', 'sfgsdfg', '2017-11-23 17:00:00', NULL, NULL, 7000000000, '2017-11-29 13:40:49', '2017-11-29 13:40:49'),
(4, 'Dirjen EBTKE', 'Cikini, Jakpus', 'Pemasangan LTSHE Papua V', 'sdjsfkjsdnfskdj/2017', '2017-10-31 17:00:00', NULL, NULL, 7000000000, '2017-11-29 14:20:44', '2017-11-29 14:20:44'),
(5, 'PT. Mandraguna', 'Jl. Condet 5', 'Masang apa aja boleh', '1231sdfsd12', '2017-12-20 17:00:00', '2017-06-14 17:00:00', '2017-09-18 17:00:00', 99988800, '2017-12-07 15:53:00', '2017-12-07 15:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `performance_budget_detail`
--

CREATE TABLE IF NOT EXISTS `performance_budget_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pb_id` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `performance_budget_detail`
--

INSERT INTO `performance_budget_detail` (`id`, `pb_id`, `pekerjaan`, `qty`, `satuan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 4, 'masang kabel', 725, 'meter', 245000, '2017-12-10 13:56:35', '2017-12-10 13:56:35');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`id`, `po_id`, `qty`, `unit`, `uraian`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(6, 3, 3000, 'meter', '<p>Kabel JTR</p>\r\n', 30000, 0, '2017-11-29 14:24:44', '2017-11-29 14:24:44'),
(7, 4, 100, 'pcs', '<p>Beli Tiang 7 meter HDG</p>\r\n', 1000000, 0, '2017-11-29 15:07:10', '2017-11-29 15:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_no` varchar(255) NOT NULL,
  `pb_id` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `purchase_order_no`, `pb_id`, `kepada`, `address`, `phone`, `person`, `position`, `pembayaran`, `pengiriman`, `created_at`, `updated_at`) VALUES
(3, '01/LTSHE', 4, 'SUTRADO', 'CIKARANG', '0229877383', 'Yuliandi', 'Sales', 'COD', 'Jalan Sapta Taruna Raya No.  16', '2017-11-29 14:23:24', '2017-11-29 14:23:24'),
(4, '02/LTSHE', 4, 'Nushapala', 'Bantar Gebang', '022398746', 'Abdul', 'Direktur', '100% Pelunasan', 'Jalan Sapta taruna raya', '2017-11-29 15:05:44', '2017-11-29 15:05:44');

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
