-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 04:29 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advance_payment`
--

INSERT INTO `advance_payment` (`id`, `pb_id`, `nip`, `nama`, `request`, `request_date`, `request_note`, `confirm`, `confirm_date`, `confirm_note`, `created_at`, `updated_at`) VALUES
(1, 1, 'SDF-22319', 'Udin Marudin', 2300000, '2017-10-22 17:00:00', 'iseng aja ceritanya', 2300000, '2017-10-24 17:00:00', 'poko''e josss', '2017-10-24 15:42:10', '2017-10-25 14:53:27'),
(2, 1, 'A-934KL', 'Nordin', 5400000, '2017-10-28 17:00:00', 'Ganti rugi rumah warga', 0, NULL, '', '2017-10-29 08:12:40', '2017-10-29 08:12:40'),
(3, 4, '03TFK', 'TAUFIK', 35000000, '2017-11-27 17:00:00', 'Beli Seng', 36000000, '2017-11-28 17:00:00', 'minus sejuta gan -_-', '2017-11-29 15:19:16', '2017-11-29 15:19:47');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `po_id`, `no_invoice`, `nominal`, `tipe`, `invoice_date`, `created_at`, `updated_at`) VALUES
(2, '2', 'jyuiyiyui', 2342333, 1, '2017-09-11 17:00:00', '2017-09-17 08:07:36', '2017-09-17 08:20:56'),
(3, '1', 'SD-0990/IOJ/222', 23000000, 0, '2017-09-12 17:00:00', '2017-09-17 08:22:26', '2017-09-17 08:22:26'),
(4, '3', '01/inv', 99000000, 0, '2017-11-28 17:00:00', '2017-11-29 14:28:21', '2017-11-29 14:46:53'),
(5, '4', '02/inv', 100000000, 1, '2017-11-29 17:00:00', '2017-11-29 15:07:53', '2017-11-29 15:07:53');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `jenis`, `invoice_id`, `pb_id`, `jumlah`, `keterangan`, `pembayaran_date`, `created_at`, `updated_at`) VALUES
(1, 'Barang', 3, 1, 2300000, 'Mantap bung', '2017-10-14 17:00:00', '2017-10-22 04:20:02', '2017-10-22 04:59:13'),
(2, 'Jasa', 0, 1, 2000000, 'Tukang benerin listrik', '2017-10-21 17:00:00', '2017-10-22 04:35:13', '2017-10-22 04:58:29'),
(5, 'Jasa', NULL, 1, 4000000, 'Bayar tukang gali kabel', '2017-10-18 17:00:00', '2017-10-23 16:05:53', '2017-10-23 16:05:53'),
(6, 'Lain-lain', NULL, 1, 3000000, 'Transport ke bengkulu', '2017-10-28 17:00:00', '2017-10-29 04:56:42', '2017-10-29 04:56:42'),
(7, 'Barang', 4, 4, 99000000, 'Pelunasan Kabel', '2017-11-29 17:00:00', '2017-11-29 15:03:10', '2017-11-29 15:03:10'),
(8, 'Barang', 5, 4, 100000000, 'Pelunasan 100% pembelian tiang 7 meter', '2017-11-30 17:00:00', '2017-11-29 15:08:51', '2017-11-29 15:08:51');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `performance_budget`
--

INSERT INTO `performance_budget` (`id`, `client_name`, `client_address`, `job_title`, `contract_number`, `contract_date`, `value`, `created_at`, `updated_at`) VALUES
(1, 'PT. MANCING MANIA MANTAP', 'Jl. Jakarta Lewat Bandung', 'Tambah tiang pemancars', 'ERR-00404KHGS-63', '2017-11-03 17:00:00', 20000000, '2017-08-14 16:09:10', '2017-08-26 15:14:39'),
(2, 'PT. NUsa Bangsa', 'Jl. Manunggal No. 44', 'Pemasangan Baterai', '2342342342', '2017-11-24 17:00:00', 6000000000, '2017-11-29 13:19:44', '2017-11-29 13:19:44'),
(3, 'sf', 'sfgsdf', 'sdgsf', 'sfgsdfg', '2017-11-23 17:00:00', 7000000000, '2017-11-29 13:40:49', '2017-11-29 13:40:49'),
(4, 'Dirjen EBTKE', 'Cikini, Jakpus', 'Pemasangan LTSHE Papua V', 'sdjsfkjsdnfskdj/2017', '2017-10-31 17:00:00', 7000000000, '2017-11-29 14:20:44', '2017-11-29 14:20:44');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `performance_budget_detail`
--

INSERT INTO `performance_budget_detail` (`id`, `pb_id`, `pekerjaan`, `qty`, `satuan`, `harga`, `created_at`, `updated_at`) VALUES
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`id`, `po_id`, `qty`, `unit`, `uraian`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 470, 'Unit', '<p><strong>PLTS-PLTD Kalimantan Barat</strong></p>\r\n\r\n<p>Baterai Merk Nipress type OpzV 2-1000 2V</p>\r\n', 4800000, 0, '2017-08-28 16:52:19', '2017-08-29 14:32:59'),
(2, 1, 100, 'Meter', '<p>Kabel Listrik. Tipe SS-09MK</p>\r\n', 90000, 0, '2017-08-29 14:26:55', '2017-08-29 14:26:55'),
(3, 1, 20, 'Lembar', '<p>Panel Surya KL-D899XN</p>\r\n', 300000, 0, '2017-08-29 14:36:15', '2017-08-29 14:36:15'),
(4, 2, 23, 'sdfsdsdfsd', '<p>sdfsdfdfdsfsdfsd</p>\r\n', 2342343, 0, '2017-09-01 07:58:32', '2017-09-01 07:58:32'),
(5, 1, 80, 'Pcs', '<p>Beli batere ABC</p>\r\n', 5000, 0, '2017-10-21 13:53:25', '2017-10-21 13:53:25'),
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
(1, '123/WDS/BII/E342', 1, 'PT. ABC Alkaline Energy', 'Jl. Setrum No. 23', '021-666-521-66 / 012234232123', 'Bapak Hendri Anung', 'Branch Marketing', 'ngutang', 'belakangan', '2017-08-26 16:06:08', '2017-08-28 15:45:51'),
(2, 'sdf', 1, 'sdfsdf', 'sdfsd', 'sdfsdfsd', 'sdfsd', 'sdfsd', 'sdfs', 'sdfsdf', '2017-09-01 07:58:05', '2017-09-13 00:10:09'),
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
