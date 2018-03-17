-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2018 at 04:16 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.1.15-1+ubuntu16.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `customer_id`, `coupon_id`, `total_price`, `created_at`, `updated_at`) VALUES
(5, 6, 4, '3920000.00', '2018-01-12 04:19:58', '2018-01-12 04:19:58'),
(6, 7, 1, '1500000.00', '2018-01-12 08:17:56', '2018-01-12 08:17:56'),
(7, 8, 2, '4900000.00', '2018-01-12 08:20:20', '2018-01-12 08:20:20'),
(8, 9, NULL, '6600000.00', '2018-01-12 08:47:33', '2018-01-12 08:47:33'),
(9, 10, 4, '2000000.00', '2018-01-12 08:49:45', '2018-01-12 08:49:45'),
(10, 11, NULL, '4500000.00', '2018-01-14 10:43:04', '2018-01-14 10:43:04'),
(11, 12, NULL, '900000.00', '2018-01-14 10:47:03', '2018-01-14 10:47:03'),
(12, 13, 1, '1250000.00', '2018-01-15 01:50:05', '2018-01-15 01:50:05'),
(13, 14, 3, '180000.00', '2018-01-15 08:12:27', '2018-01-15 08:12:27'),
(14, 15, NULL, '980000.00', '2018-01-17 00:21:52', '2018-01-17 00:21:52'),
(15, 16, 3, '810000.00', '2018-01-17 00:29:13', '2018-01-17 00:29:13'),
(16, 17, NULL, '2500000.00', '2018-01-17 23:58:20', '2018-01-17 23:58:20'),
(17, 19, 4, '1568000.00', '2018-01-18 08:52:41', '2018-01-18 08:52:41'),
(18, 20, 4, '2352000.00', '2018-01-18 08:57:12', '2018-01-18 08:57:12'),
(19, 21, 2, '1372000.00', '2018-01-18 09:02:56', '2018-01-18 09:02:56'),
(20, 22, 3, '4050000.00', '2018-01-19 13:14:02', '2018-01-19 13:14:02'),
(21, 23, 6, '1800000.00', '2018-01-19 13:23:40', '2018-01-19 13:23:40'),
(22, 25, 5, '810000.00', '2018-01-20 08:03:53', '2018-01-20 08:03:53'),
(23, 26, 4, '5850666.40', '2018-01-20 12:33:48', '2018-01-20 12:33:48'),
(24, 27, NULL, '1300000.00', '2018-02-27 13:53:40', '2018-02-27 13:53:40'),
(25, 28, NULL, '5200000.00', '2018-02-27 13:54:30', '2018-02-27 13:54:30'),
(26, 29, 2, '2465555.40', '2018-02-27 14:41:05', '2018-02-27 14:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_display` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `slug_name`, `description`, `order_display`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', '', '<p>Thương hiệu gi&agrave;y thể thao đẳng cấp quốc tế</p>', NULL, '2017-12-26 12:23:30', '2017-12-27 08:27:52'),
(2, 'Nike', '', '<p>Trẻ trung v&agrave; năng động</p>', NULL, '2017-12-27 08:28:38', '2018-01-08 09:02:02'),
(3, 'Bitis', '', '<p>N&acirc;ng niu b&agrave;n ch&acirc;n việt</p>', NULL, '2018-01-15 13:41:15', '2018-01-15 13:41:15'),
(4, 'Cole Haan', '', '<p>Sang trọng, đẳng cấp</p>', NULL, '2018-01-20 09:29:42', '2018-01-20 09:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_display` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug_name`, `order_display`, `parent_id`, `created_at`, `updated_at`, `full_name`) VALUES
(1, 'Nam', 'giay-nam', NULL, 0, NULL, '2017-12-13 07:42:53', 'Giày nam'),
(2, 'Nữ', 'giay-nam', NULL, 0, NULL, '2017-12-13 07:43:52', 'Giày nữ'),
(3, 'Sneakers', 'the-thao', NULL, 1, NULL, '2017-12-13 07:44:12', 'Sneakers nam'),
(4, 'Boots', 'boot', NULL, 1, NULL, '2017-12-13 07:44:25', 'Boots nam'),
(5, 'Loafers', 'loafers', NULL, 1, '2017-12-13 02:07:50', '2017-12-13 07:44:42', 'Loafers nam'),
(9, 'Sneakers', 'sneakers', NULL, 2, '2017-12-13 02:09:39', '2017-12-13 07:46:16', 'Sneakers nữ'),
(10, 'Boots', 'boots', NULL, 2, '2017-12-13 02:09:52', '2017-12-13 07:46:29', 'Boots nữ'),
(12, 'Loafers', 'loadfers', NULL, 2, '2017-12-13 02:10:37', '2017-12-30 07:42:33', 'Loafers Nữ'),
(13, 'Sandals', 'sandals', NULL, 1, '2017-12-13 02:11:04', '2017-12-30 07:42:59', 'Sandals Nam');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double(8,2) DEFAULT NULL,
  `type_coupon` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `name`, `value`, `type_coupon`, `created_at`, `updated_at`) VALUES
(1, 'GiamGia50', 0.50, 1, NULL, NULL),
(2, 'GiamGia30', 0.30, 1, NULL, NULL),
(3, 'GiamGia10', 0.10, 2, NULL, NULL),
(4, 'GiamGia20', 0.20, 2, NULL, '2018-01-20 07:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `gender`, `email`, `address`, `phone`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Lê Duy', 'Trung', 1, 'duytrung@gmail.com', 'Vinh Nghệ An', 'Trung', NULL, NULL, '2018-01-12 03:19:09', '2018-01-12 03:19:09'),
(2, 'Lê Duy', 'Trung', 1, 'duytrung@gmail.com', 'vinh nghệ an', '016559132', NULL, NULL, '2018-01-12 03:30:30', '2018-01-12 03:30:30'),
(3, 'Lê Duy', 'Trung', 1, 'Duytrung@gmail.com', 'vinh nghệ an', '01655913123', NULL, NULL, '2018-01-12 03:33:12', '2018-01-12 03:33:12'),
(4, 'Le duy', 'Haha', 1, 'Duytrung@gmail.com', 'vinh nghệ An', '0123213123', NULL, NULL, '2018-01-12 03:41:54', '2018-01-12 03:41:54'),
(5, 'Lê Ha', 'Na', 1, 'duytrung@gmail.com', 'VinhNghean', '0151232131', NULL, NULL, '2018-01-12 03:57:13', '2018-01-12 03:57:13'),
(6, 'dad', 'deed', 1, 'duytrubn@gmail.com', 'vinh nghe ab', '0133123213', NULL, NULL, '2018-01-12 04:19:58', '2018-01-12 04:19:58'),
(7, 'Lê', 'Duy', 1, 'duytrung@gmail.com', 'Ha Noi', '065199234', NULL, NULL, '2018-01-12 08:17:56', '2018-01-12 08:17:56'),
(8, 'HiHI', 'HahA', 1, 'Duytrung@gmail.com', 'Vinh Nghệ', '04512312323', NULL, NULL, '2018-01-12 08:20:20', '2018-01-12 08:20:20'),
(9, 'Lê', 'Linh', 2, 'linh@gmail.com', 'Hồ chí minh', '0154543232', NULL, NULL, '2018-01-12 08:47:33', '2018-01-12 08:47:33'),
(10, 'Lan', 'Com', 1, 'Lan@gmail.com', 'vinh', '012323123', NULL, NULL, '2018-01-12 08:49:45', '2018-01-12 08:49:45'),
(11, 'hih', 'haha', 1, 'duytrung@gmail.com', 'vinh', '01', NULL, NULL, '2018-01-14 10:43:04', '2018-01-14 10:43:04'),
(12, 'ho', 'ten', 1, 'dutyrung@gmail.com', '1231231', '123123123123123', NULL, NULL, '2018-01-14 10:47:03', '2018-01-14 10:47:03'),
(13, 'dd', 'dd', 1, 'ddd@gmail.com', 'vinh', '12123123', NULL, NULL, '2018-01-15 01:50:05', '2018-01-15 01:50:05'),
(14, 'viet', 'nam', 1, 'Duytrung@gmail.com', 'sdsdsdsdsdsdsd', '012312312', NULL, NULL, '2018-01-15 08:12:27', '2018-01-15 08:12:27'),
(15, 'Vinh', 'Na', 1, 'lde@gmail.com', 'Vietnam', '0103123', NULL, NULL, '2018-01-17 00:21:52', '2018-01-17 00:21:52'),
(16, 'Lê Duy', 'Trung', 1, 'trung3859@gmail.com', 'Vinh Nghệ An', '01655913859', NULL, NULL, '2018-01-17 00:29:13', '2018-01-17 00:29:13'),
(17, 'test1', 'test', 1, 'Duy@gmail.com', 'hanoi', '12312313', NULL, NULL, '2018-01-17 23:58:20', '2018-01-17 23:58:20'),
(18, 'Lê Duy', 'Trung', 1, 'letrung@gmail.com', 'assc', '012312332', NULL, NULL, '2018-01-18 08:51:38', '2018-01-18 08:51:38'),
(19, 'Lê Duy', 'Trung', 1, 'ledutrng@gmail.com', 'vinh', '0154232323', NULL, NULL, '2018-01-18 08:52:41', '2018-01-18 08:52:41'),
(20, 'Lê Duy', 'Trung', 1, 'trung@gmail.com', 'vinh', '01655914869', NULL, NULL, '2018-01-18 08:57:11', '2018-01-18 08:57:11'),
(21, 'Lê', 'test', 1, 'trung@gmail.com', 'vietNam', '091312312', NULL, NULL, '2018-01-18 09:02:56', '2018-01-18 09:02:56'),
(22, 'Le', 'Test', 1, 'test@gmail.com', 'Vinh', '0121312323', NULL, NULL, '2018-01-19 13:14:02', '2018-01-19 13:14:02'),
(23, 'Lte', 'test', 1, 'test@gmail.com', '123123123123', '12312321312', NULL, NULL, '2018-01-19 13:23:40', '2018-01-19 13:23:40'),
(24, 'Lê', 'Trung', 1, 'letrung@gmail.com', 'Mặt đất', '0123123123', NULL, NULL, '2018-01-19 15:52:40', '2018-01-19 15:52:40'),
(25, 'Lê', 'Test', 1, 'test@gmail.com', 'Vinh', '015441232', NULL, NULL, '2018-01-20 08:03:53', '2018-01-20 08:03:53'),
(26, 'Lê Duy', 'Trung', 1, 'trung@gmail.com', 'Vinh  Nghệ An', '0155499349', NULL, NULL, '2018-01-20 12:33:48', '2018-01-20 12:33:48'),
(27, 'Lê', 'Duy Trung', 1, 'trungduy@gmail.com', 'vinh', '014343434434', NULL, NULL, '2018-02-27 13:53:40', '2018-02-27 13:53:40'),
(28, 'Haha', 'Hi', 1, 'hihi@gmail.com', 'Hà Tĩnh', '345535453534', NULL, NULL, '2018-02-27 13:54:30', '2018-02-27 13:54:30'),
(29, 'hihi', 'trung', 1, 'duytrung@gmail.com', 'test', '123123123', NULL, NULL, '2018-02-27 14:41:05', '2018-02-27 14:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `detail_bill`
--

CREATE TABLE `detail_bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_bill`
--

INSERT INTO `detail_bill` (`id`, `bill_id`, `product_id`, `size_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(5, 5, 11, 5, 1, '4000000.00', '2018-01-12 04:19:58', '2018-01-12 04:19:58'),
(8, 7, 11, 5, 1, '4000000.00', '2018-01-12 08:20:20', '2018-01-12 08:20:20'),
(10, 8, 9, 1, 1, '3000000.00', '2018-01-12 08:47:33', '2018-01-12 08:47:33'),
(11, 8, 12, 6, 1, '3600000.00', '2018-01-12 08:47:33', '2018-01-12 08:47:33'),
(13, 10, 12, 6, 1, '3600000.00', '2018-01-14 10:43:04', '2018-01-14 10:43:04'),
(15, 11, 7, 3, 1, '900000.00', '2018-01-14 10:47:03', '2018-01-14 10:47:03'),
(17, 13, 2, 3, 1, '200000.00', '2018-01-15 08:12:27', '2018-01-15 08:12:27'),
(18, 14, 18, 5, 1, '980000.00', '2018-01-17 00:21:52', '2018-01-17 00:21:52'),
(19, 15, 8, 2, 1, '900000.00', '2018-01-17 00:29:13', '2018-01-17 00:29:13'),
(20, 16, 9, 1, 1, '2500000.00', '2018-01-17 23:58:20', '2018-01-17 23:58:20'),
(21, 17, 19, 2, 1, '980000.00', '2018-01-18 08:52:41', '2018-01-18 08:52:41'),
(22, 18, 19, 2, 1, '980000.00', '2018-01-18 08:57:12', '2018-01-18 08:57:12'),
(23, 18, 18, 5, 2, '1960000.00', '2018-01-18 08:57:12', '2018-01-18 08:57:12'),
(24, 19, 18, 6, 1, '980000.00', '2018-01-18 09:02:56', '2018-01-18 09:02:56'),
(25, 19, 18, 5, 1, '980000.00', '2018-01-18 09:02:56', '2018-01-18 09:02:56'),
(26, 20, 7, 4, 3, '2430000.00', '2018-01-19 13:14:02', '2018-01-19 13:14:02'),
(27, 20, 7, 3, 2, '1620000.00', '2018-01-19 13:14:02', '2018-01-19 13:14:02'),
(28, 21, 7, 3, 2, '1800000.00', '2018-01-19 13:23:40', '2018-01-19 13:23:40'),
(29, 22, 8, 1, 1, '810000.00', '2018-01-20 08:03:53', '2018-01-20 08:03:53'),
(30, 23, 26, 8, 2, '2400000.00', '2018-01-20 12:33:48', '2018-01-20 12:33:48'),
(31, 23, 18, 7, 1, '784000.00', '2018-01-20 12:33:48', '2018-01-20 12:33:48'),
(32, 23, 16, 6, 3, '2666666.40', '2018-01-20 12:33:48', '2018-01-20 12:33:48'),
(33, 24, 21, 1, 1, '1300000.00', '2018-02-27 13:53:40', '2018-02-27 13:53:40'),
(34, 25, 21, 3, 4, '5200000.00', '2018-02-27 13:54:30', '2018-02-27 13:54:30'),
(35, 26, 21, 1, 1, '910000.00', '2018-02-27 14:41:05', '2018-02-27 14:41:05'),
(36, 26, 16, 6, 2, '1555555.40', '2018-02-27 14:41:05', '2018-02-27 14:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_product`
--

CREATE TABLE `image_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_display` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_product`
--

INSERT INTO `image_product` (`id`, `name`, `product_id`, `order_display`, `created_at`, `updated_at`) VALUES
(12, '_anh5a4053dbcbdde.jpg', 8, NULL, '2017-12-24 02:16:18', '2017-12-25 01:26:51'),
(13, '_anh5a3f7062f1d006.46028020.jpg', 8, NULL, '2017-12-24 02:16:18', '2017-12-24 02:16:18'),
(14, '_anh5a3f9140dcd914.87170897.jpg', 7, NULL, '2017-12-24 11:36:32', '2017-12-24 11:36:32'),
(15, '_anh5a3f9140de1d94.59598515.jpg', 7, NULL, '2017-12-24 11:36:32', '2017-12-24 11:36:32'),
(19, '_anh5a3f9cffa0ce97.10281055.jpg', 8, NULL, '2017-12-24 12:26:39', '2017-12-24 12:26:39'),
(20, '_anh5a3f9cffa24dc6.07462636.jpg', 8, NULL, '2017-12-24 12:26:39', '2017-12-24 12:26:39'),
(21, '_anh5a3fab82565db9.59091868.jpg', 9, NULL, '2017-12-24 13:28:34', '2017-12-24 13:28:34'),
(22, '_anh5a3fab82581011.86597130.jpg', 9, NULL, '2017-12-24 13:28:34', '2017-12-24 13:28:34'),
(23, '_anh5a5331c8b302d1.67884601.jpg', 10, NULL, '2018-01-08 08:54:32', '2018-01-08 08:54:32'),
(24, '_anh5a5331c8b91070.13533458.jpg', 10, NULL, '2018-01-08 08:54:32', '2018-01-08 08:54:32'),
(25, '_anh5a5331c8baa2f1.99941737.jpg', 10, NULL, '2018-01-08 08:54:32', '2018-01-08 08:54:32'),
(26, '_anh5a5331c8bbb8a9.12044407.jpg', 10, NULL, '2018-01-08 08:54:32', '2018-01-08 08:54:32'),
(27, '_anh5a5331c8c0c9f1.22039226.jpg', 10, NULL, '2018-01-08 08:54:32', '2018-01-08 08:54:32'),
(28, '_anh5a533341926140.23420373.jpg', 11, NULL, '2018-01-08 09:00:49', '2018-01-08 09:00:49'),
(29, '_anh5a533341967e43.63123320.jpg', 11, NULL, '2018-01-08 09:00:49', '2018-01-08 09:00:49'),
(30, '_anh5a53334199b679.73477641.jpg', 11, NULL, '2018-01-08 09:00:49', '2018-01-08 09:00:49'),
(31, '_anh5a5333419aef93.98927402.jpg', 11, NULL, '2018-01-08 09:00:49', '2018-01-08 09:00:49'),
(32, '_anh5a5333419c25d1.67121816.jpg', 11, NULL, '2018-01-08 09:00:49', '2018-01-08 09:00:49'),
(33, '_anh5a5333419d4393.96227070.jpg', 11, NULL, '2018-01-08 09:00:49', '2018-01-08 09:00:49'),
(34, '_anh5a53342fcc8642.97883539.jpg', 12, NULL, '2018-01-08 09:04:47', '2018-01-08 09:04:47'),
(35, '_anh5a53342fcd9536.08431542.jpg', 12, NULL, '2018-01-08 09:04:47', '2018-01-08 09:04:47'),
(36, '_anh5a53342fcebb67.77143911.jpg', 12, NULL, '2018-01-08 09:04:47', '2018-01-08 09:04:47'),
(37, '_anh5a53342fcfc959.23558074.jpg', 12, NULL, '2018-01-08 09:04:47', '2018-01-08 09:04:47'),
(38, '_anh5a53342fd25be2.78630361.jpg', 12, NULL, '2018-01-08 09:04:47', '2018-01-08 09:04:47'),
(39, '_anh5a53342fd7b540.50057495.jpg', 12, NULL, '2018-01-08 09:04:47', '2018-01-08 09:04:47'),
(40, '_anh5a5ad70dbecd83.45744903.jpg', 13, NULL, '2018-01-14 04:05:33', '2018-01-14 04:05:33'),
(41, '_anh5a5ad70dc48cb7.29218252.jpg', 13, NULL, '2018-01-14 04:05:33', '2018-01-14 04:05:33'),
(42, '_anh5a5ad70dc5c576.45096778.jpg', 13, NULL, '2018-01-14 04:05:33', '2018-01-14 04:05:33'),
(43, '_anh5a5ad70dc6e1a5.95778210.jpg', 13, NULL, '2018-01-14 04:05:33', '2018-01-14 04:05:33'),
(44, '_anh5a5ad70dcb0db3.16864015.jpg', 13, NULL, '2018-01-14 04:05:33', '2018-01-14 04:05:33'),
(45, '_anh5a5ad7846182e4.63687845.jpg', 14, NULL, '2018-01-14 04:07:32', '2018-01-14 04:07:32'),
(46, '_anh5a5ad7846285b4.62774423.jpg', 14, NULL, '2018-01-14 04:07:32', '2018-01-14 04:07:32'),
(47, '_anh5a5ad78463eab5.06154820.jpg', 14, NULL, '2018-01-14 04:07:32', '2018-01-14 04:07:32'),
(48, '_anh5a5ad78464f0c1.82324624.jpg', 14, NULL, '2018-01-14 04:07:32', '2018-01-14 04:07:32'),
(49, '_anh5a5ad78467a141.19522108.jpg', 14, NULL, '2018-01-14 04:07:32', '2018-01-14 04:07:32'),
(50, '_anh5a5ad7e56f5d24.20785408.jpg', 15, NULL, '2018-01-14 04:09:09', '2018-01-14 04:09:09'),
(51, '_anh5a5ad7e57740d3.38550386.jpg', 15, NULL, '2018-01-14 04:09:09', '2018-01-14 04:09:09'),
(52, '_anh5a5ad7e5787698.39511529.jpg', 15, NULL, '2018-01-14 04:09:09', '2018-01-14 04:09:09'),
(53, '_anh5a5ad7e579dd56.74665486.jpg', 15, NULL, '2018-01-14 04:09:09', '2018-01-14 04:09:09'),
(54, '_anh5a5ad7e57b1659.28773313.jpg', 15, NULL, '2018-01-14 04:09:09', '2018-01-14 04:09:09'),
(55, '_anh5a5ad85a6b56d9.28316782.jpg', 16, NULL, '2018-01-14 04:11:06', '2018-01-14 04:11:06'),
(56, '_anh5a5ad85a6c6948.98868765.jpg', 16, NULL, '2018-01-14 04:11:06', '2018-01-14 04:11:06'),
(57, '_anh5a5ad85a6d7869.10243742.jpg', 16, NULL, '2018-01-14 04:11:06', '2018-01-14 04:11:06'),
(58, '_anh5a5ad85a6ed235.48356679.jpg', 16, NULL, '2018-01-14 04:11:06', '2018-01-14 04:11:06'),
(59, '_anh5a5cb01e0e69b3.41416056.jpeg', 17, NULL, '2018-01-15 13:43:58', '2018-01-15 13:43:58'),
(60, '_anh5a5cb01e0fbec4.78656445.jpeg', 17, NULL, '2018-01-15 13:43:58', '2018-01-15 13:43:58'),
(61, '_anh5a5cb01e10c917.90269414.jpeg', 17, NULL, '2018-01-15 13:43:58', '2018-01-15 13:43:58'),
(62, '_anh5a5cb01e121a80.11951328.jpeg', 17, NULL, '2018-01-15 13:43:58', '2018-01-15 13:43:58'),
(63, '_anh5a5cb01e132f39.11818352.jpeg', 17, NULL, '2018-01-15 13:43:58', '2018-01-15 13:43:58'),
(64, '_anh5a5cb0938d02c9.66166043.jpeg', 18, NULL, '2018-01-15 13:45:55', '2018-01-15 13:45:55'),
(65, '_anh5a5cb0939254b2.77909702.jpeg', 18, NULL, '2018-01-15 13:45:55', '2018-01-15 13:45:55'),
(66, '_anh5a5cb093951e18.97366775.jpeg', 18, NULL, '2018-01-15 13:45:55', '2018-01-15 13:45:55'),
(67, '_anh5a5cb093963384.25429011.jpeg', 18, NULL, '2018-01-15 13:45:55', '2018-01-15 13:45:55'),
(68, '_anh5a5cb093974427.90889497.jpeg', 18, NULL, '2018-01-15 13:45:55', '2018-01-15 13:45:55'),
(69, '_anh5a5cb093985f28.32371038.jpeg', 18, NULL, '2018-01-15 13:45:55', '2018-01-15 13:45:55'),
(70, '_anh5a5cb10a765e65.21885522.jpeg', 19, NULL, '2018-01-15 13:47:54', '2018-01-15 13:47:54'),
(71, '_anh5a5cb10a786fd6.73054269.jpeg', 19, NULL, '2018-01-15 13:47:54', '2018-01-15 13:47:54'),
(72, '_anh5a5cb10a79a0f8.25184327.jpeg', 19, NULL, '2018-01-15 13:47:54', '2018-01-15 13:47:54'),
(73, '_anh5a5cb10a7bd366.46707139.jpeg', 19, NULL, '2018-01-15 13:47:54', '2018-01-15 13:47:54'),
(74, '_anh5a62ffadae4343.72015104.jpg', 1, NULL, '2018-01-20 08:37:01', '2018-01-20 08:37:01'),
(75, '_anh5a62ffadb00703.39265547.jpg', 1, NULL, '2018-01-20 08:37:01', '2018-01-20 08:37:01'),
(77, '_anh5a630789105397.99535563.jpg', 20, NULL, '2018-01-20 09:10:33', '2018-01-20 09:10:33'),
(78, '_anh5a630789159875.51847338.jpg', 20, NULL, '2018-01-20 09:10:33', '2018-01-20 09:10:33'),
(79, '_anh5a63078916c510.18003583.jpg', 20, NULL, '2018-01-20 09:10:33', '2018-01-20 09:10:33'),
(80, '_anh5a63078917e898.04631688.jpg', 20, NULL, '2018-01-20 09:10:33', '2018-01-20 09:10:33'),
(81, '_anh5a630789195b45.88285784.jpg', 20, NULL, '2018-01-20 09:10:33', '2018-01-20 09:10:33'),
(82, '_anh5a6307891bcaf7.19138774.jpg', 20, NULL, '2018-01-20 09:10:33', '2018-01-20 09:10:33'),
(83, '_anh5a630824418e57.14262195.jpg', 21, NULL, '2018-01-20 09:13:08', '2018-01-20 09:13:08'),
(84, '_anh5a63082443d4e8.79152069.jpg', 21, NULL, '2018-01-20 09:13:08', '2018-01-20 09:13:08'),
(85, '_anh5a630824451a22.49505447.jpg', 21, NULL, '2018-01-20 09:13:08', '2018-01-20 09:13:08'),
(86, '_anh5a630824464329.52180269.jpg', 21, NULL, '2018-01-20 09:13:08', '2018-01-20 09:13:08'),
(87, '_anh5a630824475fd8.37626020.jpg', 21, NULL, '2018-01-20 09:13:08', '2018-01-20 09:13:08'),
(88, '_anh5a630824487fa0.12924929.jpg', 21, NULL, '2018-01-20 09:13:08', '2018-01-20 09:13:08'),
(89, '_anh5a63099619396.jpg', 22, NULL, '2018-01-20 09:16:38', '2018-01-20 09:19:18'),
(90, '_anh5a63099fefc07.jpg', 22, NULL, '2018-01-20 09:16:38', '2018-01-20 09:19:27'),
(91, '_anh5a6309a645937.jpg', 22, NULL, '2018-01-20 09:16:38', '2018-01-20 09:19:34'),
(92, '_anh5a6309acdff38.jpg', 22, NULL, '2018-01-20 09:16:38', '2018-01-20 09:19:40'),
(93, '_anh5a6309b4090b3.jpg', 22, NULL, '2018-01-20 09:16:38', '2018-01-20 09:19:48'),
(94, '_anh5a6308f6e1c732.53370240.jpg', 22, NULL, '2018-01-20 09:16:38', '2018-01-20 09:16:38'),
(95, '_anh5a630a3f2f6699.25562198.jpg', 23, NULL, '2018-01-20 09:22:07', '2018-01-20 09:22:07'),
(96, '_anh5a630a3f30e1e6.59615751.jpg', 23, NULL, '2018-01-20 09:22:07', '2018-01-20 09:22:07'),
(97, '_anh5a630a3f33e279.42967905.jpg', 23, NULL, '2018-01-20 09:22:07', '2018-01-20 09:22:07'),
(98, '_anh5a630a3f351163.11028286.jpg', 23, NULL, '2018-01-20 09:22:07', '2018-01-20 09:22:07'),
(99, '_anh5a630a3f364067.62484670.jpg', 23, NULL, '2018-01-20 09:22:07', '2018-01-20 09:22:07'),
(100, '_anh5a630c905bc851.83134452.jpg', 24, NULL, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(101, '_anh5a630c905d6c48.23227541.jpg', 24, NULL, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(102, '_anh5a630c905e88f6.15441794.jpg', 24, NULL, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(103, '_anh5a630c905fb526.08325466.jpg', 24, NULL, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(104, '_anh5a630c90610775.24717021.jpg', 24, NULL, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(105, '_anh5a630c90622f97.21603592.jpg', 24, NULL, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(106, '_anh5a630d23ebf709.94971711.jpg', 25, NULL, '2018-01-20 09:34:27', '2018-01-20 09:34:27'),
(107, '_anh5a630d23ed5f69.13301882.jpg', 25, NULL, '2018-01-20 09:34:27', '2018-01-20 09:34:27'),
(108, '_anh5a630d23f1ff17.62792330.jpg', 25, NULL, '2018-01-20 09:34:27', '2018-01-20 09:34:27'),
(109, '_anh5a630d23f31675.45220483.jpg', 25, NULL, '2018-01-20 09:34:27', '2018-01-20 09:34:27'),
(110, '_anh5a630d24001e08.15230554.jpg', 25, NULL, '2018-01-20 09:34:28', '2018-01-20 09:34:28'),
(111, '_anh5a630d9f5d0141.26080352.jpg', 26, NULL, '2018-01-20 09:36:31', '2018-01-20 09:36:31'),
(112, '_anh5a630d9f5e0756.77270589.jpg', 26, NULL, '2018-01-20 09:36:31', '2018-01-20 09:36:31'),
(113, '_anh5a630d9f5f5ad5.23582998.jpg', 26, NULL, '2018-01-20 09:36:31', '2018-01-20 09:36:31'),
(114, '_anh5a630d9f605554.06086209.jpg', 26, NULL, '2018-01-20 09:36:31', '2018-01-20 09:36:31'),
(115, '_anh5a630d9f619046.21479790.jpg', 26, NULL, '2018-01-20 09:36:31', '2018-01-20 09:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2017_12_10_020102_edit_table_users', 1),
(8, '2017_12_10_021128_create_table', 1),
(9, '2017_12_10_021811_detele_category_table', 2),
(10, '2017_12_11_150008_create_category_table', 3),
(11, '2017_12_11_150311_create_product_table', 4),
(12, '2017_12_11_151907_add_unsigned_foregin_key_product', 5),
(13, '2017_12_11_152155_create_brand_table', 6),
(14, '2017_12_11_152544_create_size_table', 7),
(15, '2017_12_11_152714_create_bills_table', 8),
(16, '2017_12_11_153040_create_detail_bill_table', 9),
(17, '2017_12_11_153611_create_image_product_table', 10),
(18, '2017_12_11_153834_create_product_properties_table', 11),
(19, '2017_12_11_154147_create_customer_table', 12),
(20, '2017_12_12_004421_drop_collum_in_product_properties', 13),
(21, '2017_12_12_004608_create_two_primary_key', 14),
(22, '2017_12_12_004922_set_unsigne_size_id_collum_in_product_properties', 15),
(23, '2017_12_12_005057_create_two_primary_key_2', 16),
(24, '2017_12_12_064722_edit_price_type', 16),
(25, '2017_12_12_065217_edit_price_type_2', 16),
(26, '2017_12_13_142811_add_new_collum_at_category', 16),
(27, '2017_12_18_081809_change_nullable_order_dispay_image', 17),
(28, '2017_12_28_155935_edit_product_foreign_key', 18),
(29, '2017_12_28_162015_edit_product_foreign_key_2', 19),
(30, '2017_12_28_162727_create_table_test', 20),
(31, '2017_12_28_162916_create_table_test_2', 21),
(37, '2017_12_28_163822_edit_product_foreign_key', 22),
(38, '2017_12_28_165054_edit_product_image_foreign_key', 23),
(39, '2017_12_28_170538_drop_testuser_table', 24),
(40, '2017_12_28_170635_drop_prod_table', 24),
(41, '2017_12_28_170750_drop_testuser_table_2', 25),
(42, '2018_01_11_211831_create_coupon_table', 26),
(43, '2018_01_12_082132_update_customer_table', 27),
(44, '2018_01_12_083004_edit_customer_order_column', 28),
(45, '2018_01_12_083115_update_customer_table_2', 29),
(46, '2018_01_12_095512_add_coupon_column_in_bills', 30),
(47, '2018_01_12_102635_edit_price_column_in_billdetail', 31),
(48, '2018_01_12_102915_drop_price_column_in_customer', 32),
(49, '2018_01_12_104345_edit_tottal_price_column_in_bills', 33),
(50, '2018_01_12_105531_edit_price_column_in_billdetail', 34),
(51, '2018_01_12_154542_change_phone_column_in_customer_table', 35),
(52, '2018_01_17_172302_change_user_name_to_firstname_lastname', 36),
(53, '2018_01_17_172923_add_firstname_lastname_users', 37),
(54, '2018_01_19_170633_create_bill_detail_foreign_key', 38),
(55, '2018_03_11_215802_add_active_column_in_users_table', 39),
(56, '2018_03_11_220137_add_user_activations_table', 40),
(57, '2018_03_11_225127_create_jobs_table', 41),
(58, '2018_03_11_225143_create_failed_jobs_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_product` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `unit_price` decimal(12,2) NOT NULL,
  `promotion_price` decimal(12,2) DEFAULT '0.00',
  `new` int(11) DEFAULT '0',
  `view_count` int(11) DEFAULT NULL,
  `cate_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `slug_name`, `meta_name`, `image_product`, `description`, `detail`, `unit_price`, `promotion_price`, `new`, `view_count`, `cate_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Nike sf air force 1', 'nike-sf-air-force-1', 'Nike sf air force 1', '_anh5a44e756d88ec9.90265729.jpg', '<p>gi&agrave;y nhẹ tho&aacute;ng m&aacute;t</p>', '<p>chất liệu vải cavans kết hợp da</p>', '200000.00', '0.00', 0, NULL, 3, 2, NULL, '2018-01-20 08:37:01'),
(2, 'NIKE AIR HUARACHE Nike Ar huarache', 'nike-air-huarache-nike-ar-huarache', 'NIKE AIR HUARACHE Nike Ar huarache', '_anh5a63056435c997.59184809.jpg', '<p>gi&agrave;y nhẹ tho&aacute;ng m&aacute;t</p>', '<p>chất liệu vải cavans kết hợp da</p>', '200000.00', '0.00', 0, NULL, 3, 1, NULL, '2018-01-20 09:01:24'),
(5, 'Nike air foamposite pro', 'nike-air-foamposite-pro', 'Nike air foamposite pro', '_anh5a533507c9af02.32806589.jpg', '<p>gi&agrave;y nhẹ tho&aacute;ng m&aacute;t</p>', '<p>chất liệu vải cavans kết hợp da</p>', '2500000.00', '1890000.00', 1, NULL, 3, 2, NULL, '2018-01-15 13:55:28'),
(6, 'Nike lunar force 1', 'nike-lunar-force-1', 'Nike lunar force 1', '_anh5a52c845522a12.28937920.jpg', '<p>gi&agrave;y nhẹ tho&aacute;ng m&aacute;t</p>', '<p>chất liệu vải cavans kết hợp da</p>', '2500000.00', '0.00', 1, NULL, 3, 1, NULL, '2018-01-14 04:12:47'),
(7, 'Converse chuck 70 high top', 'converse-chuck-70-high-top', 'Converse chuck 70 high top', '_anh5a5334bc35ab27.19543867.jpg', '<p>chat lieu cavans</p>', '<p>chat lieu cavans</p>', '1000000.00', '900000.00', 0, NULL, 3, 2, '2017-12-18 01:15:48', '2018-01-14 14:11:14'),
(8, 'Converse Chuck 70 Low Top', 'converse-chuck-70-low-top', 'Converse Chuck 70 Low Top', '_anh5a570e4f108888.03027039.jpg', '<p>Chất liệu xịn</p>', '<p>chat lieu cavans</p>', '1000000.00', '900000.00', 1, NULL, 3, 1, '2017-12-18 01:22:15', '2018-01-11 07:12:15'),
(9, 'ULTRABOOST SHOES', 'ultraboost-shoes', 'ULTRABOOST SHOES', '_anh5a377d062d4451.32956727.jpg', '<h1>ULTRABOOST SHOES</h1>', '<h1>ULTRABOOST SHOES</h1>', '3000000.00', '2500000.00', 0, NULL, 4, 2, '2017-12-18 01:32:06', '2018-01-12 08:41:34'),
(10, 'Ultraboost uncaged shoes', 'ultraboost-uncaged-shoes', 'Ultraboost uncaged shoes', '_anh5a5331c8a9c580.78498643.jpg', '<p>A turbocharger for your feet. The ultra-responsive boost&trade; in these men&#39;s running shoes absorbs the force from your footstrike to release it at push-off for an energized ride. A simplified design combines a cage-free adidas&nbsp;</p>', '<ul>\r\n	<li>Runner type: neutral</li>\r\n	<li>boost&trade; is our most responsive cushioning ever: The more energy you give, the more you get</li>\r\n	<li>adidas Primeknit upper wraps the foot in adaptive support and ultralight comfort; SOCKFIT upper for a snug, supportive fit; Internal reinforcements for support</li>\r\n	<li>TORSION&reg; SYSTEM between the heel and forefoot for a stable ride</li>\r\n	<li>FITCOUNTER molded heel counter provides a natural fit that allows optimal movement of the Achilles</li>\r\n	<li>Continental&trade; Rubber outsole for extraordinary traction in wet and dry conditions; STRETCHWEB rubber outsole flexes underfoot for an energized ride</li>\r\n	<li>Weight: 10.5 ounces (size 9)</li>\r\n	<li>Midsole drop: 10 mm (heel: 29 mm / forefoot: 19 mm)</li>\r\n	<li>Textile upper / Textile lining / Rubber outsole</li>\r\n	<li>Imported</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Product code: CG4095</li>\r\n</ul>', '3500000.00', '0.00', 1, NULL, 4, 1, '2018-01-08 08:54:32', '2018-01-08 08:54:32'),
(11, 'Prophere shoes', 'prophere-shoes', 'Prophere shoes', '_anh5a570e1bc082b1.11447128.jpg', '<p>Created for sneakerheads, these men&#39;s shoes feature adidas heritage details and a streetwise attitude.</p>', '<ul>\r\n	<li>Knit upper with nubuck 3-Stripes</li>\r\n	<li>Embroidered toe</li>\r\n	<li>Elastic collar for quick on and off</li>\r\n	<li>Comfortable textile lining</li>\r\n	<li>Polyurethane midsole with sculpted sidewall</li>\r\n	<li>Rubber outsole</li>\r\n	<li>Imported</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Product code: CQ3023</li>\r\n	<li>Product color: Grey / Running White / Infrared</li>\r\n</ul>', '4000000.00', '0.00', 1, NULL, 3, 2, '2018-01-08 08:59:42', '2018-01-14 14:10:57'),
(12, 'NMD_XR1 shoes', 'nmd-xr1-shoes', 'NMD_XR1 shoes', '_anh5a53342fc80a15.60585037.jpg', '<p>The adidas archive always inspires. Designed after authentic running shoes, these men&#39;s sneakers bring modern looks and innovative tech to the streets.&nbsp;</p>', '<ul>\r\n	<li>boost&trade; is our most responsive cushioning ever: The more energy you give, the more you get</li>\r\n	<li>Premium breathable knit upper</li>\r\n	<li>Milky TPU midfoot cage</li>\r\n	<li>Sock-like construction</li>\r\n	<li>Molded EVA midsole plugs for NMD aesthetic; Reflective heel patch</li>\r\n	<li>Rubber outsole</li>\r\n	<li>Textile and synthetic upper / Textile lining / Rubber outsole</li>\r\n	<li>Imported</li>\r\n</ul>', '111111111.00', '3600000.00', 1, NULL, 3, 1, '2018-01-08 09:04:47', '2018-01-14 07:13:01'),
(13, 'PUREBOOST DPR SHOES', 'pureboost-dpr-shoes', 'PUREBOOST DPR SHOES', '_anh5a5ad70db87101.43434946.jpg', '<p>dddddddd</p>', '<p>dddddddddd</p>', '1000000.00', '9000000.00', 2, NULL, 3, 1, '2018-01-14 04:05:33', '2018-01-14 04:05:33'),
(14, 'PUREBOOST dpr shoes2', 'pureboost-dpr-shoes2', 'PUREBOOST dpr shoes2', '_anh5a5ad7845d09b6.94571846.jpg', '<p>123123123</p>', '<p>123123</p>', '111111111.00', '11111111.00', 1, NULL, 3, 1, '2018-01-14 04:07:32', '2018-01-14 04:11:42'),
(15, 'NMD_CS1 GTX PRIMEKNIT', 'nmd-cs1-gtx-primeknit', 'NMD_CS1 GTX PRIMEKNIT', '_anh5a5ad7e56a9fb4.55947241.jpg', '<p>13123123</p>', '<p>Chất liệu tho&aacute;ng m&aacute;t</p>', '111111.00', '11111.00', 0, NULL, 3, 1, '2018-01-14 04:09:09', '2018-01-20 09:03:15'),
(16, 'PREDATOR 18+ FIRM', 'predator-18-firm', 'PREDATOR 18+ FIRM', '_anh5a5ad85a67a851.38146529.jpg', '<p>123123</p>', '<p>123123</p>', '111111111.00', '1111111.00', 1, NULL, 3, 1, '2018-01-14 04:11:06', '2018-01-16 07:27:43'),
(17, 'Biti\'s Hunter Nam Black', 'bitis-hunter-nam-black', 'Biti\'s Hunter Nam Black', '_anh5a5cb01e0c3498.47713801.jpeg', '<p>Gi&agrave;y thể thao nhẹ tho&aacute;ng m&aacute;t</p>', '<p>N&acirc;ng niu b&agrave;n ch&acirc;n việt</p>', '680000.00', '0.00', 1, NULL, 3, 3, '2018-01-15 13:43:58', '2018-01-15 13:54:29'),
(18, 'X2 Red Dawn', 'x2-red-dawn', 'X2 Red Dawn', '_anh5a5cb0938afde7.90782799.jpeg', '<p>N&acirc;ng niu b&agrave;n ch&acirc;n việt</p>', '<p>N&acirc;ng niu b&agrave;n ch&acirc;n việt</p>', '980000.00', '0.00', 1, NULL, 3, 3, '2018-01-15 13:45:55', '2018-01-15 13:52:04'),
(19, 'Hunter Nam Midnight X2', 'hunter-nam-midnight-x2', 'Hunter Nam Midnight X2', '_anh5a5cb10a716191.34511734.jpeg', '<p>Nhẹ tho&aacute;ng m&aacute;t, ph&ugrave; hợp chạy bộ thể thao</p>', '<p>N&acirc;ng niu b&agrave;n ch&acirc;n việt</p>', '980000.00', '0.00', 1, NULL, 3, 3, '2018-01-15 13:47:54', '2018-01-16 07:27:26'),
(20, 'Ultraboost pink', 'ultraboost-pink', 'Ultraboost pink', '_anh5a630788b161e9.84926581.jpg', '<p>This product is excluded from all promotional discounts and offers.</p>', '<p>Combining sport-proven performance with sleek style, the Ultraboost recaptures the feeling of your best-ever run. Built for the dedicated runner, these women&#39;s shoes deliver superior long-distance support. They feature a sock-like adidas Primeknit upper that adapts to your foot&#39;s changing shape as you run. A molded heel cradles your foot for a stable stride, while energy-returning Boost fuels every step. A super-grippy outsole provides exceptional traction in wet and dry conditions.</p>', '2500000.00', '0.00', 1, NULL, 9, 1, '2018-01-20 09:10:32', '2018-01-20 09:10:32'),
(21, 'Bw avenue Shoes', 'bw-avenue-shoes', 'Bw avenue Shoes', '_anh5a630823f2d861.13794058.jpg', '<p>Combining modern tennis-inspired design with the spirit of vintage German army indoor sneakers</p>', '<ul>\r\n	<li>Leather upper with suede blocking</li>\r\n	<li>Leather lining</li>\r\n	<li>Trefoil logo on tongue and heel patch</li>\r\n	<li>Perforated 3-Stripes</li>\r\n	<li>Rubber outsole</li>\r\n	<li>Main materials: Leather upper / Leather lining / Rubber outsole</li>\r\n	<li>Imported</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Product code: CQ3152</li>\r\n	<li>Product color: Running White / Running White</li>\r\n</ul>', '1500000.00', '1300000.00', 1, NULL, 9, 1, '2018-01-20 09:13:07', '2018-01-20 09:13:07'),
(22, 'EVERYN SHOES', 'everyn-shoes', 'EVERYN SHOES', '_anh5a6309c075d183.98974429.jpg', '<p>Looking to the legacy styles for inspiration, adidas Originals always creates something new.</p>', '<ul>\r\n	<li>Leather upper</li>\r\n	<li>Reinforced rubber toe; Perforated 3-Stripes</li>\r\n	<li>Leather collar and sockliner</li>\r\n	<li>Metallic linear Trefoil logo on lateral side</li>\r\n	<li>Enjoy the comfort and performance of OrthoLite&reg; sockliner; Debossed logo on sockliner; Nubuck leather heel patch</li>\r\n	<li>Vulcanized rubber outsole</li>\r\n	<li>Main materials: Leather upper / Leather lining / Rubber outsole</li>\r\n	<li>Imported</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Product code: CQ2004</li>\r\n	<li>Product color: Running White / Running White / Ash Pearl</li>\r\n</ul>', '200000.00', '180000.00', 1, NULL, 10, 1, '2018-01-20 09:16:38', '2018-01-20 09:20:00'),
(23, 'PHARRELL WILLIAMS', 'pharrell-williams', 'PHARRELL WILLIAMS', '_anh5a630a3ec70a81.91729521.jpg', '<p>A collaboration between adidas Originals and Pharrell Williams, these women&#39;s sneakers were inspired by the beauty of humanity in all of its colors.</p>', '<ul>\r\n	<li>Soft, breathable knit upper</li>\r\n	<li>Embroidered 3-Stripes</li>\r\n	<li>Trefoil tongue loop with Pharrell Hu sign-off; 3-Stripes heel patch with Pharrell Williams sign-off</li>\r\n	<li>Comfortable textile lining</li>\r\n	<li>EVA midsole and outsole for lightweight cushioning</li>\r\n	<li>Rubber outsole inserts</li>\r\n</ul>', '200000.00', '0.00', 1, NULL, 10, 1, '2018-01-20 09:22:06', '2018-01-20 09:22:06'),
(24, 'Bit loafer', 'bit-loafer', 'Bit loafer', '_anh5a630c90190dd7.44555756.jpg', '<p>Mercanti Fiorentini is back again with authentic Italian craftsmanship that comes through in the Bit loafer.</p>', '<p>These slip-ons are made with supple leather and is finished with a square toe design that adds a sophisticated finish to your look.</p>\r\n\r\n<ul>\r\n	<li>Item # 408579</li>\r\n	<li>UPC # 090654500063</li>\r\n</ul>', '2300000.00', '2000000.00', 1, NULL, 5, 4, '2018-01-20 09:32:00', '2018-01-20 09:32:00'),
(25, 'SHEPARD LOAFER', 'shepard-loafer', 'SHEPARD LOAFER', '_anh5a630d239f03a4.40685013.jpg', '<p>Casual and tailored style come together in the handsome Shepard loafer from Cole Haan!&nbsp;</p>', '<p>Casual and tailored style come together in the handsome Shepard loafer from Cole Haan!&nbsp;</p>\r\n\r\n<p>Casual and tailored style come together in the handsome Shepard loafer from Cole Haan!&nbsp;</p>', '1800000.00', '0.00', 1, NULL, 5, 4, '2018-01-20 09:34:27', '2018-01-20 09:34:27'),
(26, 'GRAND CROSSCOURT', 'grand-crosscourt', 'GRAND CROSSCOURT', '_anh5a630d9f187c38.52165861.jpg', '<p>Pair the Grand Crosscourt II sneaker from Cole Haan with any outfit for a fresh look.&nbsp;</p>', '<p>Pair the Grand Crosscourt II sneaker from Cole Haan with any outfit for a fresh look. GRAND.&Oslash;S technology keeps these low-tops incredibly lightweight and comfortable!</p>\r\n\r\n<ul>\r\n	<li>Item # 409734</li>\r\n	<li>UPC # 190595706439</li>\r\n</ul>', '1600000.00', '1500000.00', 1, NULL, 9, 4, '2018-01-20 09:36:31', '2018-01-20 09:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_properties`
--

CREATE TABLE `product_properties` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_properties`
--

INSERT INTO `product_properties` (`product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, NULL),
(1, 2, 13, NULL, NULL),
(1, 3, 13, NULL, NULL),
(1, 7, 6, '2018-01-20 09:00:31', '2018-01-20 09:00:31'),
(1, 8, 6, '2018-01-20 09:00:35', '2018-01-20 09:00:35'),
(1, 10, 6, '2018-01-20 09:00:39', '2018-01-20 09:00:39'),
(1, 11, 6, '2018-01-20 09:00:43', '2018-01-20 09:00:43'),
(2, 3, 33, NULL, NULL),
(2, 4, 12, NULL, NULL),
(2, 7, 1, '2018-01-20 09:01:32', '2018-01-20 09:01:32'),
(2, 8, 3, '2018-01-20 09:01:35', '2018-01-20 09:01:35'),
(2, 10, 4, '2018-01-20 09:01:39', '2018-01-20 09:01:39'),
(2, 11, 5, '2018-01-20 09:01:43', '2018-01-20 09:01:43'),
(6, 2, 13, '2017-12-29 16:04:53', '2017-12-29 16:04:53'),
(7, 3, 1, '2017-12-23 02:38:14', '2017-12-23 02:38:14'),
(7, 4, 41, '2017-12-23 02:38:10', '2017-12-23 02:38:10'),
(7, 5, 0, '2017-12-23 02:38:24', '2017-12-23 02:38:24'),
(7, 6, 12, '2017-12-23 02:38:03', '2017-12-23 02:38:03'),
(7, 7, 12, '2017-12-23 02:38:37', '2017-12-23 02:38:37'),
(8, 1, 3, '2017-12-24 02:18:32', '2017-12-24 02:18:32'),
(8, 2, 23, '2017-12-24 09:24:31', '2017-12-24 09:24:31'),
(8, 4, 12, '2017-12-24 02:19:12', '2017-12-24 02:19:12'),
(8, 5, 23, '2017-12-24 02:19:15', '2017-12-24 02:19:15'),
(8, 6, 12, '2017-12-24 02:19:05', '2017-12-24 02:19:05'),
(8, 7, 34, '2017-12-24 02:18:45', '2017-12-24 02:18:45'),
(9, 1, 43, '2017-12-21 03:27:30', '2017-12-21 03:27:30'),
(9, 2, 23, '2017-12-21 03:27:45', '2017-12-21 03:27:45'),
(9, 3, 54, '2017-12-21 03:27:02', '2017-12-21 03:27:02'),
(9, 4, 23, '2017-12-25 02:20:23', '2017-12-25 02:20:23'),
(9, 5, 12, '2017-12-25 02:20:31', '2017-12-25 02:20:31'),
(9, 6, 23, '2017-12-21 03:51:14', '2017-12-21 03:51:14'),
(9, 7, 10, '2017-12-21 03:51:28', '2017-12-21 03:51:28'),
(11, 5, 5, '2018-01-08 09:01:10', '2018-01-08 09:01:10'),
(11, 6, 6, '2018-01-08 09:01:16', '2018-01-08 09:01:16'),
(11, 7, 1, '2018-01-08 09:01:19', '2018-01-08 09:01:19'),
(12, 6, 8, '2018-01-08 12:24:04', '2018-01-08 12:24:04'),
(12, 7, 8, '2018-01-08 12:24:13', '2018-01-08 12:24:13'),
(14, 6, 54, '2018-01-20 09:03:49', '2018-01-20 09:03:49'),
(14, 7, 4, '2018-01-20 09:03:53', '2018-01-20 09:03:53'),
(14, 8, 5, '2018-01-20 09:03:56', '2018-01-20 09:03:56'),
(14, 10, 6, '2018-01-20 09:04:00', '2018-01-20 09:04:00'),
(14, 11, 4, '2018-01-20 09:04:02', '2018-01-20 09:04:02'),
(15, 6, 5, '2018-01-20 09:02:47', '2018-01-20 09:02:47'),
(15, 7, 6, '2018-01-20 09:02:50', '2018-01-20 09:02:50'),
(15, 8, 4, '2018-01-20 09:02:53', '2018-01-20 09:02:53'),
(15, 10, 6, '2018-01-20 09:02:57', '2018-01-20 09:02:57'),
(15, 11, 4, '2018-01-20 09:03:00', '2018-01-20 09:03:00'),
(16, 6, 0, '2018-01-20 09:02:04', '2018-01-20 09:02:04'),
(16, 7, 6, '2018-01-20 09:02:07', '2018-01-20 09:02:07'),
(16, 8, 7, '2018-01-20 09:02:11', '2018-01-20 09:02:11'),
(16, 10, 8, '2018-01-20 09:02:14', '2018-01-20 09:02:14'),
(16, 11, 6, '2018-01-20 09:02:18', '2018-01-20 09:02:18'),
(17, 5, 12, '2018-01-15 13:52:47', '2018-01-15 13:52:47'),
(17, 6, 10, '2018-01-15 13:52:32', '2018-01-15 13:52:32'),
(17, 7, 7, '2018-01-15 13:52:42', '2018-01-15 13:52:42'),
(18, 5, 0, '2018-01-15 13:53:14', '2018-01-15 13:53:14'),
(18, 6, 0, '2018-01-15 13:53:21', '2018-01-15 13:53:21'),
(18, 7, 0, '2018-01-15 13:53:25', '2018-01-15 13:53:25'),
(19, 2, 2, '2018-01-18 06:55:25', '2018-01-18 06:55:25'),
(19, 4, 3, '2018-01-18 06:55:20', '2018-01-18 06:55:20'),
(19, 6, 3, '2018-01-18 06:55:29', '2018-01-18 06:55:29'),
(19, 7, 4, '2018-01-18 06:55:34', '2018-01-18 06:55:34'),
(20, 1, 5, '2018-01-20 09:14:17', '2018-01-20 09:14:17'),
(20, 2, 5, '2018-01-20 09:14:20', '2018-01-20 09:14:20'),
(20, 3, 4, '2018-01-20 09:14:25', '2018-01-20 09:14:25'),
(20, 4, 6, '2018-01-20 09:14:30', '2018-01-20 09:14:30'),
(20, 5, 4, '2018-01-20 09:14:34', '2018-01-20 09:14:34'),
(21, 1, 2, '2018-01-20 09:13:47', '2018-01-20 09:13:47'),
(21, 2, 5, '2018-01-20 09:13:50', '2018-01-20 09:13:50'),
(21, 3, 2, '2018-01-20 09:13:54', '2018-01-20 09:13:54'),
(21, 4, 1, '2018-01-20 09:13:58', '2018-01-20 09:13:58'),
(22, 1, 5, '2018-01-20 09:16:48', '2018-01-20 09:16:48'),
(22, 2, 4, '2018-01-20 09:16:51', '2018-01-20 09:16:51'),
(22, 3, 5, '2018-01-20 09:16:54', '2018-01-20 09:16:54'),
(22, 4, 4, '2018-01-20 09:16:58', '2018-01-20 09:16:58'),
(22, 5, 5, '2018-01-20 09:17:02', '2018-01-20 09:17:02'),
(23, 1, 4, '2018-01-20 09:22:20', '2018-01-20 09:22:20'),
(23, 2, 5, '2018-01-20 09:22:24', '2018-01-20 09:22:24'),
(23, 3, 5, '2018-01-20 09:22:27', '2018-01-20 09:22:27'),
(23, 4, 5, '2018-01-20 09:22:33', '2018-01-20 09:22:33'),
(23, 5, 6, '2018-01-20 09:22:38', '2018-01-20 09:22:38'),
(24, 6, 2, '2018-01-20 09:32:30', '2018-01-20 09:32:30'),
(24, 7, 4, '2018-01-20 09:32:34', '2018-01-20 09:32:34'),
(24, 8, 4, '2018-01-20 09:32:40', '2018-01-20 09:32:40'),
(24, 10, 3, '2018-01-20 09:32:37', '2018-01-20 09:32:37'),
(24, 11, 4, '2018-01-20 09:32:43', '2018-01-20 09:32:43'),
(25, 6, 7, '2018-01-20 09:34:41', '2018-01-20 09:34:41'),
(25, 7, 6, '2018-01-20 09:34:48', '2018-01-20 09:34:48'),
(25, 8, 7, '2018-01-20 09:34:44', '2018-01-20 09:34:44'),
(26, 7, 4, '2018-01-20 12:31:01', '2018-01-20 12:31:01'),
(26, 8, 3, '2018-01-20 12:31:04', '2018-01-20 12:31:04'),
(26, 10, 5, '2018-01-20 12:31:06', '2018-01-20 12:31:06'),
(26, 11, 6, '2018-01-20 12:31:09', '2018-01-20 12:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '35', NULL, NULL),
(2, '36', NULL, NULL),
(3, '37', NULL, NULL),
(4, '38', NULL, '2018-01-19 09:52:58'),
(5, '39', NULL, NULL),
(6, '40', NULL, NULL),
(7, '41', NULL, NULL),
(8, '42', '2018-01-19 09:43:06', '2018-01-19 09:43:06'),
(10, '43', '2018-01-19 10:30:00', '2018-01-19 10:30:00'),
(11, '44', '2018-01-19 10:30:02', '2018-01-19 10:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `active`, `remember_token`, `created_at`, `updated_at`, `address`, `phone`, `level`) VALUES
(1, 'duy', 'trung', 'duytrung@gmail.com', '$2y$10$68ZjwlJsAz3AETV1iEH9a.UMeLFQW9c9DBPY4woIMrKPE7GWs6B1C', 1, 'fAJ0RhpmvKBW2cF4VcgTEdEh9Rd8FiIWRT5ycut7nkmQtNnEB0c19AFiDE9y', '2017-12-29 09:09:30', '2017-12-29 09:29:27', NULL, NULL, 2),
(2, 'duy', 'trung', 'Trung@gmail.com', '$2y$10$gUIrFbCVs/fdJQYKF7hNNOiNPHH8gBl1h4NxUWa4YbcuMjvAv5xNW', 1, '43LDYlOelBa8pBJkj7q6JGMI34qSRCN15xic4NuW5RWjtGq5yiQHmPSR2TaG', '2018-01-17 10:40:21', '2018-01-17 10:40:21', NULL, NULL, 2),
(3, 'dolo', 'test', 'test@gmail.com', '$2y$10$p3tt9u8H7ZsMNBfxpsq4sOVqgaM3l3NC088cCOJIcnjuHWGqmEmJW', 1, '2NbmFSzuICOPuYoJYBabNAN0ujRvy03C5ZZsCAyFtikIeib5MCSG6vKVABlN', '2018-01-17 10:59:34', '2018-01-17 10:59:34', NULL, NULL, 1),
(4, 'hihi', 'haha', 'hiahi@gmail.com', '$2y$10$QAc.SY4jwcboHYf96FoX2OoCeMfl83lPdFGx27MoC021tM0PiJ54a', 1, NULL, '2018-01-17 11:00:18', '2018-01-17 11:00:18', NULL, NULL, 1),
(5, 'hihi', 'haha', 'dong@gmail.com', '$2y$10$IfdKa/qhxsny0KJL1VJ1JOnBhqdC.vyhLtr25xshVn4tXAPbcrrY2', 1, NULL, '2018-01-17 11:01:17', '2018-01-17 11:01:17', NULL, NULL, 1),
(6, 'le van', 'nam', 'duy@gmail.com', '$2y$10$BcIeCXSOaLtRMtUuvkortOWC.ZgUJmIvwImGHgzu0nsgbq4rWg8He', 1, 'YH15Iicugi99lNJdjI8vfFlEZWvOh8owjTM1Wc67HE6GSmgSdEh9wKpMSksk', '2018-02-27 14:39:38', '2018-02-27 14:39:38', NULL, NULL, 1),
(14, 'le', 'Duy Trung', 'trung3859@gmail.com', '$2y$10$qDuZn0wHOUMR8hnx8hEzJ.hu1LM8nvmOxikryjYmLnez.8CJ7pZiq', 1, 'DwtBZ393eZM1bq7ZPwSgiNBXROis8n6VqmWkOOu6ZH6Rk0dRWhx6RmoSXwlI', '2018-03-11 17:05:17', '2018-03-11 17:07:13', NULL, NULL, 1),
(15, 'le duy', 'trung', 'ldtrung.steam@gmail.com', '$2y$10$5ird7B4cE3yAGwD1/a4Y..Qd0KrPk41/XpgmifBhH/eZ67gNi1dKG', 1, 'Zt4Vg54wNBPNlTVptD8bNCrf51AXwgqnOebyg0L4yj1kvTZcwmIZSmWU8DSk', '2018-03-11 17:17:48', '2018-03-11 17:19:01', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_bill_product_id_foreign` (`product_id`),
  ADD KEY `detail_bill_bill_id_foreign` (`bill_id`),
  ADD KEY `detail_bill_size_id_foreign` (`size_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_cate_id_foreign` (`cate_id`),
  ADD KEY `product_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD PRIMARY KEY (`product_id`,`size_id`),
  ADD KEY `product_properties_size_id_foreign` (`size_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD KEY `user_activations_activation_code_index` (`activation_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `detail_bill`
--
ALTER TABLE `detail_bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `image_product`
--
ALTER TABLE `image_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD CONSTRAINT `detail_bill_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_bill_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_bill_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_product`
--
ALTER TABLE `image_product`
  ADD CONSTRAINT `image_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD CONSTRAINT `product_properties_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_properties_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
