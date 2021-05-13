-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 07:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bokakanot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_invitations`
--

CREATE TABLE `admin_invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `centre_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_invitations`
--

INSERT INTO `admin_invitations` (`id`, `email`, `centre_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 'peter@puschel.se', 38, 'YU2K58YZ8G6vLpnynnhfTcn72K3l5sFLUiUmPHYItSRarZwbtOSvNlBwJjrWyNEV', '2017-03-27 17:17:31', '2017-03-27 17:17:31'),
(2, 'hyr.kanot@karlstadspaddlarklubb.se', 17, 'dQvbwiQZaPDTamHxjsYS01wFgaZfgNFkxFNoepJEXj3yp9IlpL3b8nrkHuv3tzNd', '2018-05-10 08:47:35', '2018-05-10 08:47:35'),
(3, 'hyrkanot@karlstadspaddlarklubb.se', 17, 'eEcZsIRrjJuFBmBUgUMDPiFw17eGdgup2jdls9iDQlGQ6AEj5eN7U1xIjP4QuizJ', '2018-05-10 08:48:07', '2018-05-10 08:48:07'),
(4, '', 17, 'eEwVEAjUKx1RMuqWU0dNb39i4H5poXh8uq46V7fvP0p1FAets3K71297g9NaR9Xn', '2018-05-11 08:29:33', '2018-05-11 08:29:33'),
(5, 'peter@rebuy.se', 17, 'FpPrrGvs1jHm7kWXN8cx86RLGGcGiVHbK2ekxJo8P8KfEzxdyfjaGyW2b8lLObBf', '2018-05-29 15:15:40', '2018-05-29 15:15:40'),
(6, 'ketherm@puschel.se', 17, '2Wpi4tBJYNNrtctnfOH5RPyDr8iktHlI8RaD0HmSqixN2uldITyNvkm9NSRYSGLe', '2018-05-29 16:33:09', '2018-05-29 16:33:09'),
(7, 'peter@brutalteknik.se', 17, '36SVppK9eP6dFjBkyEk0BNSdq1XJ8K0Ex6OtcYJyTEE8pKAen5EeYWjLpJVBuvtn', '2018-05-29 19:27:38', '2018-05-29 19:27:38'),
(8, '', 23, 'Dkw5EcxOMyPUxHwqGkWPd9EnDdeVkZMYpFS07YaFfN7GcFS5Ae6ws45pZ0SMMswE', '2019-04-20 04:48:59', '2019-04-20 04:48:59'),
(9, '', 46, 'FIeZ1oUEUih0jVFr6a0kMCHAjIipWAQidp4aYW8uugyeYNIcuKqUazfsHa0OUKDt', '2019-04-23 04:49:56', '2019-04-23 04:49:56'),
(10, 'karthikathiruvengatam11.karthi@gmail.com', 46, 'U5QZJBP2LXlI7OuLK8dZfIQwmV1XW8eRlrv47aTkNpVOVYsDxAD8TpIs9OmMVD5K', '2019-04-23 04:50:32', '2019-04-23 04:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `centre_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bookingcountry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_post_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `klarna_orderId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klarna_reservationId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `can_be_cancelled` tinyint(1) NOT NULL DEFAULT 1,
  `booking_invoice_id` int(10) DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `country` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `stripe_customer_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `freeText` text COLLATE utf8_unicode_ci NOT NULL,
  `bookingFee` decimal(10,2) NOT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `default_language` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'se',
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `centre_id`, `token`, `name`, `address`, `address2`, `city`, `bookingcountry`, `post_code`, `email`, `billing_email`, `billing_name`, `billing_address`, `billing_address2`, `billing_city`, `billing_post_code`, `billing_country`, `billing_telephone`, `telephone`, `user_id`, `status`, `paid`, `payment_method`, `payment_method_id`, `klarna_orderId`, `klarna_reservationId`, `can_be_cancelled`, `booking_invoice_id`, `payment_date`, `created_at`, `updated_at`, `deleted_at`, `country`, `customer_type`, `stripe_customer_number`, `stripe_charge_id`, `freeText`, `bookingFee`, `cancelled_at`, `default_language`, `terms_accepted`) VALUES
(1, 46, 'LD0tZcVAqI7ZahFuq8A66vGFqqfrzXCoAqEtFRq7duHFsSRX9DvARd9IMKARPghQ', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 00:05:19', '2019-04-24 00:05:45', '2019-04-24 00:05:45', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(2, 46, 'SPdBMUuc2LqYMGyjKDZHhDbGgNYLfHQ8aktmhjJSZFZNdRPmNtO8x8Wp2JvrCqtZ', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 00:12:42', '2019-04-24 01:09:53', '2019-04-24 01:09:53', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(3, 46, 'p0JWbkVeqGC4SrzbQSUCbyoNITwEnkjVTHcB9BKZ0OzhyIJPrb56QsJEaVKvqWUn', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 01:10:19', '2019-04-24 02:16:57', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(4, 46, 'pMzR1mH8rbZFYfNl2riUfyXmycrspPrKN7n1390c5HOsss3gGczH96XQGzFEdS53', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 03:12:54', '2019-04-24 03:13:00', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(5, 46, '3wU7FwtXiMb22oatu9XHFP1JSjDSmxylIAzfCBRbrVRWtKOJzQtbyx0LdGx20miH', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 5, 0, 'Cash', 2, '', '', 1, NULL, '2019-04-24 10:27:48', '2019-04-24 03:26:51', '2019-04-24 04:57:54', NULL, 0, 0, '', '', '', '0.00', '2019-04-24 04:57:54', 'se', 0),
(6, 46, 'CXaCVxENBGKWMhvsnR7Gh1Umynw829Qlye2D7LPlzxxKzLQoy6Nrb2pcGFp5K18Z', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 05:00:04', '2019-04-24 05:00:22', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(7, 47, 'GpOi8taSUP9paCvrIcPqkdW7AoI09gL6vvmq3P2tvG82BLdLALsvEyh2vcIcjae8', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 4, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 05:11:11', '2019-04-24 05:13:06', NULL, 0, 0, '', '', '', '0.00', '2019-04-24 05:13:06', 'se', 0),
(8, 47, 'HobPG4u1CMBPi1tADWlrhXyfGbTAO3FWVCvkIB7kWlOHFZKV6y8ku0w09VYVIqp4', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 4, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 05:15:31', '2019-04-24 05:17:01', NULL, 0, 0, '', '', '', '0.00', '2019-04-24 05:17:01', 'se', 0),
(9, 47, 'IAy29WcAulfFeGI7OXmQJK7H7Ys27DHGXaBME29aOUglslu6psmlWHECoZYWpfIY', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '2019-04-24 10:50:28', '2019-04-24 05:18:07', '2019-04-24 23:43:19', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(10, 47, 'USODvce7VHksElVHgHUFOMtfheQ9wNzD77qWg4CfQS949v5UmLZgyAlkaWJsOAi7', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 05:21:50', '2019-04-24 05:22:29', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(11, 46, 'DHSVJDRBuuliJdFoXXn3ZFjGSxB1HzHW6R3tPgL1Z2zJZFyPJCPTiYBRRKcjGmXV', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 05:55:47', '2019-04-24 05:55:47', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(12, 46, 'S8t8Qjp99mv985IaH2kLSjPC3UqtajgT0xDUM1X5V3bVcokDFbnQZtwoojOTYFty', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 22:32:22', '2019-04-24 22:32:39', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(13, 46, 'YQx4S6hrKCmUipv8yx4TXK9jPlwzYOemF9jTpYw9brDOMGtXDeSAaeXKmc3AmLAW', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 22:48:31', '2019-04-24 23:10:45', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(14, 47, 'SYwtyhPCKBT3KCppIyjYjBz9rUefZkLI2CN3kO9P54FmuyF4NEhGrWZHMIET737R', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 23:15:28', '2019-04-24 23:17:56', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(15, 47, 'A51nmPsti9MBphlbOeoFFLR7bRhCwTsKfh9osCT3OBrBIylRHYj3WVWAH1ZTEja3', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 51, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 23:26:52', '2019-04-24 23:26:52', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(16, 47, 'tLVbxKOdxosHkMNaNIsgaRi1RXqjnDGLLK15fUGWH5PXf9Jyyct6IDDGNIVwZ0BJ', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 23:43:50', '2019-04-24 23:44:13', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(17, 47, 'aulu72zAFK44Ln3zUOWSkhyYg65nCAcbiQrc6ni6TFYIDgfULFVKSN2KQjf6JIR4', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 23:55:45', '2019-04-24 23:56:04', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(18, 47, 'EoSGalEggAa10jCigUW9wqKa8rJtUKyXWrfxeN2jePKWPj88DdhIqjsPF14Hleia', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-24 23:57:00', '2019-04-24 23:58:08', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(19, 47, 'XGwrPPgIwdEZ1HeoFzr6RUzd6DHWCCrJzHqhXYd5Xw76M4nXcfqhbVIDUAvwr2c5', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-25 00:04:57', '2019-04-25 00:06:00', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(20, 47, 'udLtTOG90Qe8tFGmKirMCrsCCj7xU8sdkuyIhWVeBKyfEogJD1zulDNspTXaxP8P', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-25 00:11:47', '2019-04-25 00:12:04', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(21, 47, 'W4FHrh5PxQzUzIXtW6b61pA1YVj4TcVIodJKJa9G4AKSboSRTby6Cux4eekZSAe5', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-25 00:12:59', '2019-04-25 00:13:17', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(22, 47, 'yrKegg76I7GVqvDTYwpNJzQ8wBvtFBXcWu9cyhFT1OCc13jmSDTPK7xKIoc0POHa', 'Company', 'Madurai', '', 'Madurai', NULL, '625016', 'karthikathiruvengatam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '8989897678', 51, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-25 00:15:12', '2019-04-25 00:15:28', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(23, 46, 'z2sxttELgkn9brZFZJUxICH5onpBBlx5KSSmFPTwf7fzFdYjxNqgzjX3CASffTpV', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-25 05:00:32', '2019-04-25 05:09:43', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(24, 46, 'aZqFxa4xLii5lLa0n782TxV0yw1BcANezapxq5uywVIMtzTW2ZKUJKgOxuajGKvT', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '2019-04-26 10:29:47', '2019-04-25 05:26:18', '2019-04-26 04:59:48', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(25, 48, 'etr2KucNsvFHYoxvQ2p8whCDk1LVoLxWhs01UPYUd2lDgPqOScLaXDdp7FcEiCZt', 'rytyry', '', '', '', NULL, '', 'karthikathiruvengam11.karthi@gmail.com', '', '', '', '', '', '', '', '', '656565656', 52, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-25 05:31:22', '2019-04-25 05:31:38', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(26, 46, 'evvH0tGoe2Kqp4Gz3NRnfNs6C8cvgxe8QczwEPMTEeqH28dOPlBHZs92QBzlXrI0', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-26 04:01:50', '2019-04-26 05:02:21', '2019-04-26 05:02:21', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(27, 46, 'J1C1OmnzcfBAAQnuRAiD1S7AQL9yEBW38Oode4xTqDL0VTuEsx3di8nVrNO1LJNg', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-26 05:02:52', '2019-04-26 05:02:57', '2019-04-26 05:02:57', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(28, 46, '43sfMMkTYXxptExHdJec0Jo8Saq6CNSv1TORj44g0MqepPccLLRmQhyskBQIVj1L', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-26 05:03:58', '2019-04-26 05:05:27', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(29, 46, 'mk2GCW8RTBZMTfGqFFp1gYIZSuBWj2F5TNwqFmNKaXwd0yJkDTKPEKCEuC2ebxHL', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-26 23:46:05', '2019-04-27 00:22:00', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(30, 46, 'pT23EMMvKyz2EUKlLdE6vaJfNKpiOh6J6sxQAhFA7LoZeXdDg1EnHzytDqzdBrki', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 00:37:41', '2019-04-27 00:37:50', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(31, 46, 'ev4lTlPIp6VZ0qOZOOrZ5LlZqJZTrc34vrhFOBxfLnO3Xpc3mLA9QwaVkLAec54h', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 00:39:51', '2019-04-27 00:39:56', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(32, 46, '0i5a4A7R4Ej10Cg07WQORp0Yd2jbxvLFAKqpi7K6fxKlxHoc3zQa4wNikoaCLnLT', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 00:43:33', '2019-04-27 00:43:39', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(33, 46, 'JIaZ2eQdpHui76TFSgVO3kHWzHVo8msFixOaUZvsr59iASVSOXi3aRjdCUIFvkAQ', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 00:48:30', '2019-04-27 00:57:27', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(34, 46, 'IS6vlSEDeL0Mud52oUo6rguS34cumr3HeLnj1iBzmH8pVdxLT9pRK5B4qaLcsSwM', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 01:00:39', '2019-04-27 01:02:12', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(35, 46, '1QsAQtBmVj74GLVOzVm25KAjLiPurTKoNLJTtfVb1YZ5rKtQ2prJOolF5tZnpNER', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 01:04:56', '2019-04-27 01:05:13', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(36, 46, 'dAlPLRSkx1OejQukwLGRZ2mzJ23RJlqYFr9qW3opKzJARE4E4rtTncgVFAcSTKJL', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 01:11:24', '2019-04-27 01:15:44', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(37, 46, 'NGuHOfflPZQiKqzeKCRGNdrkbJ2SdUCOJIXTzPHFZiJoVF0fN47E83vEYQaHgWhj', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 01:20:22', '2019-04-27 01:35:35', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(38, 46, 'zw7Iop1yAWJmIzRrslckmcu1x0z0vOqQo7Cogeo81nEDnQz0YNpBFFtXsLwmJc8O', 'ISquare', '', '', 'Madurai', NULL, '', 'mohaideenjailani@gmail.com', '', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 1, 0, 'iZettle', 7, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 01:38:32', '2019-04-27 05:44:13', NULL, 1, 2, '', '', '', '0.00', NULL, 'se', 0),
(39, 46, '6a2qWTM0NzPC4UITgTjiFJDRq660e8v5naTtjfyI1mmtfKnUfmPThz4XGCKMBnrW', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 01:51:20', '2019-04-27 02:00:12', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(40, 46, 'mnp8rzhhCCqvPm7eOnAuTxE8kNTOkFzgKPDvtSs1WzMRLLHvbGp17Lvh9Hhzl9dM', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 02:02:30', '2019-04-27 02:02:52', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(41, 46, 'Fkp5HEPnlg0y6NXp7ZmMGerZYX5gRWlU89QpWEp5o1LJgexresNxPj8LZLgseZJ4', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 02:06:48', '2019-04-27 02:07:03', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(42, 46, 'EWeRfXKHhbkRQv9dpyuaI4M923Jrfo3RjEfAU4Uvh3o57vHu9riFLQuivMx6uDsP', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 02:08:00', '2019-04-27 02:08:17', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(43, 46, 'vo9KtKoj7g2fq3q2cRTis90F9iAwJ7Bc6v1QMRnYBP2BXKhZpIfduT15qzpbWV1j', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 02:12:00', '2019-04-27 02:13:19', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(44, 46, 'Vr63DYKskELHa8oGW5MDNamy3ZKNOdoeDIaE29eKEIcSFW5fPgjjc6NnPvYFL0zA', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-27 05:45:50', '2019-04-27 08:22:12', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(45, 46, 'kFzXgMQK5oQvDrU8BQeiyZxrlVozvuswXFvlew8rJE9iCx7RoR41PE1oMyCtizbq', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 5, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 07:15:12', '2019-04-29 00:30:02', '2019-04-29 01:46:55', NULL, 0, 0, 'cus_EyQWkwCYQyuKpA', 'ch_1EUTfXHEuxLQELZWJkXL2xIm', '', '0.00', '2019-04-29 01:46:55', 'se', 0),
(46, 46, 'l0qNK4riEN5GepcFvRlboShmbf70ZoYaTttXNgo4eslaTn2wRJZwG7zzAVG4OqJh', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 07:23:42', '2019-04-29 01:49:17', '2019-04-29 01:53:52', NULL, 0, 0, 'cus_EyQfigBdPjCxAg', 'ch_1EUTnlHEuxLQELZWbvUCQPoH', '', '0.00', NULL, 'se', 0),
(47, 46, 'Vfrg2opxKf0vMjJzCScmlcCN2AW9LsWOfuxYJ9RP2RFsvM8wb0Neny5cgsUJCO5b', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 07:30:35', '2019-04-29 01:56:29', '2019-04-29 02:00:44', NULL, 0, 0, 'cus_EyQlxw3cw9WLlT', 'ch_1EUTuPHEuxLQELZWSArupTJW', '', '0.00', NULL, 'se', 0),
(48, 46, 'tzXKpxtq00CFOS4WGWyCWv926cdkhODNxe8ntqzeMWMuJmk5rNrCKdnV1YJfTrA5', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 07:48:32', '2019-04-29 02:12:32', '2019-04-29 02:18:41', NULL, 0, 0, 'cus_EyR3q4QBbEd7IZ', 'ch_1EUUBnHEuxLQELZWEA0PNvqY', '', '0.00', NULL, 'se', 0),
(49, 46, 'd9t2IYslH2tnpBDoTaEflMDighQ5LUfZ70gMYsEohD7jEhUuZ70RmzJvQ2NtlVdh', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 07:54:39', '2019-04-29 02:24:04', '2019-04-29 02:24:48', NULL, 0, 0, 'cus_EyRAB5mSRPenSS', 'ch_1EUUHhHEuxLQELZWK8tEqcdb', '', '0.00', NULL, 'se', 0),
(50, 46, 'nJ9Tz9eljxPlvGnTWj3jY5s183zYwlJQB4k0EewutohFJGtPTCvqDVvxXPQaEpzs', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 07:55:51', '2019-04-29 02:25:12', '2019-04-29 02:25:59', NULL, 0, 0, 'cus_EyRBnspHAyVciC', 'ch_1EUUIrHEuxLQELZWDs55MR3K', '', '0.00', NULL, 'se', 0),
(51, 46, '7qxOtcMBlB8DF4fVfZ6tht14ceK8ylifkZjHUVDKXpTLOAUy0P1aylHgYO2Bb9qm', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 09:38:06', '2019-04-29 02:28:35', '2019-04-29 04:08:15', NULL, 0, 0, 'cus_EySphzXnWiK1Lh', 'ch_1EUVtqHEuxLQELZWJoYE4ezD', '', '0.00', NULL, 'se', 0),
(52, 46, '2iXezA9HNYIkNJk3B7EPWfWDNqvp22qqjezPqor0rZQniir9oHjS6ouPnPSYB37W', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 11:16:01', '2019-04-29 05:44:43', '2019-04-29 05:46:10', NULL, 0, 0, 'cus_EyUPLEmJm9hBaq', 'ch_1EUXQaHEuxLQELZWMo7UrUci', '', '0.00', NULL, 'se', 0),
(53, 46, 'I80RxFeSkdXhhcgYLvdjHMhXTxAGC5RDK1WmsqTV9N5LyzA67ZsvcqGHFK0VnKrY', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-29 11:36:49', '2019-04-29 06:04:57', '2019-04-29 06:06:59', NULL, 0, 0, 'cus_EyUkrQfVBnNBSV', 'ch_1EUXkiHEuxLQELZWH1ERRx5R', '', '0.00', NULL, 'se', 0),
(54, 46, 'Kj3Kk9sz2TGuTbsRZVC3v6N3U8YFnA6iBykDwZzIKkkQZqVsKBEvoxokKu4h4zu0', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-29 06:23:19', '2019-04-29 09:01:08', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(55, 46, 'sOklTAB3XgzalhgfhQJOK25s8iv2DpeVJsHflCXktFzNMFUyKaSlfmyLenltpDMx', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'karthika@isquarebs.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-30 04:30:24', '2019-04-29 22:48:33', '2019-04-29 23:00:33', NULL, 0, 0, 'cus_Eyl5oHwDAJlS72', 'ch_1EUnZbHEuxLQELZWrypJ1Tls', '', '0.00', NULL, 'se', 0),
(56, 46, 'mRTVPlO99vY3UAXCFQRpu46kqHPp5ZEU1EzDYXgSKrXMrBqoSxgODMqQnEWYVQ6D', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-29 23:03:33', '2019-04-29 23:25:16', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(57, 46, 'vSm4SZcZpsvzkZveAtk3WxEtVrcqBj41yaUaHVeQZ5wR3EsPGqIWRGgIkIDRHjDe', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-30 00:09:54', '2019-04-30 00:15:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(58, 46, '94isRtzL0h6BO94sV273kzSct3EkAVOmsUZCZwNLZ4v8A2nqdPB7oyGY85ctqgRv', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-04-30 06:46:23', '2019-04-30 00:38:48', '2019-04-30 01:16:35', NULL, 0, 0, 'cus_EynH4LkswmvFw0', 'ch_1EUphDHEuxLQELZW5EJim63B', '', '0.00', NULL, 'se', 0),
(59, 46, 'FxclqCY0awxYufpfwv4sUEERCp60Vabp7W1v4g0vVhIa8wgTdrBEzCVTev5Sz3l0', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, 'iZettle', 7, '', '', 1, NULL, '2019-04-30 08:11:39', '2019-04-30 01:19:27', '2019-04-30 02:41:48', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(60, 46, 'BLfHVcvk5Cw58i5QNTZxFoQ4qHo5MBAspK8BwE5GeRdDzaVne8YOeDzf4fCXzlaS', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, 'iZettle', 7, '', '', 1, NULL, '2019-04-30 09:22:03', '2019-04-30 02:44:25', '2019-04-30 03:52:13', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(61, 46, 'yktQ1iAEPpDTFfg1MOB1HdueuF8mlYY4b5rDVuBVawzZ0Xfn0JVpv4pljBe6l3iR', 'ISquare', '', '', 'Madurai', NULL, '', 'mohaideenjailani@gmail.com', 'karthi111@gmail.com', 'ISquare', '', '', '', '', '1', '', '9876565656', 50, 1, 0, 'iZettle', 7, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-30 03:53:22', '2019-04-30 03:53:54', NULL, 1, 2, '', '', '', '0.00', NULL, 'se', 0),
(62, 46, 'jrPX5K9EOXAau4emBzoj3rkUgDU7230uOGWkF9D63eUTXoMllGaTEZaxPxlzNCn7', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, 'iZettle', 7, '', '', 1, NULL, '2019-04-30 11:37:07', '2019-04-30 03:57:04', '2019-04-30 06:07:19', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(63, 46, '1NlFdU7j2IQWYI8slO3lLS1YjjVbHvH4A31CrGaIo5Q52QkM9lsXN8qQIWew7hkk', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, 'iZettle', 7, '', '', 1, NULL, '2019-04-30 11:38:22', '2019-04-30 06:08:05', '2019-04-30 06:08:30', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(64, 46, 'fOYU3ekLvTAq7MSKgxaMlsedlXXEINgc7zJLHSbIWGvgpeIENHiZR6vIoq3ZdT4Q', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-30 06:12:29', '2019-04-30 08:33:22', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(65, 46, 'UxrxdTEIesUdfUotL9wsMlOJML1o52XSjviUj4NrvroaOmYpXKCV4Er6vqEa3ie8', 'ISquare', 'Madurai', '', 'Madurai', NULL, '625010', 'mohaideenjailani@gmail.com', '', '', '', '', '', '', '', '', '9876565656', 50, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-04-30 23:13:24', '2019-04-30 23:28:07', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(66, 50, 'D6qQ171SDjw8RQCc4ZRwo6zAtVsO7qsiSaaxNYOzhqFgh92b7kduRDzQ93xYIVeD', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-05-25 08:30:00', '2019-05-25 08:31:02', NULL, 0, 0, '', '', 'fsd', '22.00', NULL, 'se', 0),
(67, 50, '071Eou0m7mFYSNxcdp6H4kmLKBulb7dBvQ8P0gLIM43vSgnM8LdUCHo1HfothD8H', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-05-31 03:46:08', '2019-05-31 03:46:08', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(68, 50, '7sLjbz4BunjcO0YD510YwwxjKJ1N20Erw92H9yO75Y5R4nWnmntxp4aUN5uY78Ch', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-05-31 03:50:15', '2019-05-31 03:50:15', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(69, 50, '6J1WW1Ojq0eUoBRZ8Mmjq9W2iLnRHz1DQ6zA4s3EnF9GX98hDw2eqLaD3MoIVIm7', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 19:14:30', '2019-06-04 19:14:30', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(70, 50, '1mur2wjuhG76nHdI4PC5k2AMyIyrvLBC7dT60fKkmSjziC4ryolAe4TtmWdS3npZ', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 20:04:24', '2019-06-04 20:04:24', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(71, 50, 'xGRXVaf9RJxRAmBapQ9i9tvNvwNcnyo86auHZEa6Iom5GXeNNIdGqnC0v1OvWEmh', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 20:05:35', '2019-06-04 20:05:35', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(72, 50, 'ZSuSCZYQbalSE01TEtI3srZS5z9JY4c9iMZSVPBVtdGBlbJscloFZjILl4wINGPC', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 20:06:45', '2019-06-04 20:06:45', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(73, 50, 'u8wTb257VM8EoUYj6MZmHFRfo1tKZiETw4Oq1dHynFTJYqqam4j6JpYjjVafsnVO', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 20:11:36', '2019-06-04 20:11:36', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(74, 50, 'fMC7dmox1Ydscqyaqkvib7719L6Fb4S1NlTPzD4qqZPfarS83ZIWWcyPZ9HoXiJE', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 20:30:22', '2019-06-04 20:30:22', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(75, 50, 'zdB2NZUjfaJXizyQML6t50yZSQvo5I47Bnf8yCtCVTSKGaQ2w16M6txRKvwqVrPG', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-04 20:34:10', '2019-06-04 20:34:10', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(76, 23, 'pNIitOtZCAWy4qYqTrE9Ui9ry04ZNu6bN6Lpjs6f3ggpGLYIjFlgETLOqPRBMjo5', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-05 07:51:44', '2019-06-05 07:51:44', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(77, 52, 'A01tG0fR7FxmUfvr6TL6vGh1wCPn48kZwFrBl5iQyYClWEXouhgqlIYfYpNf5dKB', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 56, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-06 18:19:40', '2019-06-06 18:19:40', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(78, 23, 'sihnR2fN4QrSLBF1FSXkTLsu8P5yBkxNup9jgyT1OiMIOmAszuRhSHz78WGaKoXN', 'Sid Bahuguna', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-06 18:55:15', '2019-06-06 18:56:21', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(79, 23, 'Syk8OxoHXYLSenc4nrNVlnOvZUQpKZSTj0RTSgZvrdbBQmdcELNtn96D2vIv39D2', 'karthika', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-06 19:04:59', '2019-06-06 19:53:05', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(80, 50, 'eLg8WEAuzwojjWJNSY5dK6VpwsvMroklRkn1GRXITlBsIW93sgfFLxgg9iV0PyRv', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-07 12:53:18', '2019-06-07 12:54:36', '2019-06-07 12:54:36', 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(81, 50, 'iC9PiErHgAsgUnJCfrqoytzuGIDHGw4gNuY2j22ACLqNwtDlF7NxLlhziRjDS0Bm', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-07 12:55:02', '2019-06-07 12:55:17', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(82, 50, 'nOg9dky843RNea7bccCGVgU0wBMWzU3KqWQUj8yiQpouY3epQT4apQhCEhbWeAMt', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-07 16:59:17', '2019-06-07 16:59:17', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(83, 23, 'PCQfzFS8uSJPWaB5w1vJOfGJjtu8AwvLBKxrBZ1ylCIfRKxMriQtzGBw3foeXL7s', 'Manesh Bahuguna', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-08 12:53:06', '2019-06-08 12:53:25', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(84, 50, '6bg4B7jQWmfeGhTPq0WK4eZMeMI9hwn2EWy0nIDmDZaO1JJB50FMYJ99cvSeUjl9', 'karthika', 'Madurai', '', '', NULL, '625001', 'karthika@gmail.com', 'jeevaishu24@gmail.com', 'karthika', 'Madurai', '', 'Madurai', '625001', '1', '9876543432', '1234567898', 54, 1, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-08 20:27:18', '2019-06-08 20:35:32', NULL, 1, 2, '', '', '', '22.00', NULL, 'se', 0),
(85, 53, 'KWhQTOks4B0xGjMiPfvwTjiDaYGbBfkl2gAk91yzWlLYfC9u7Gcetq74xkI87aCN', 'Isquare', 'Madurai', '', 'Madurai', NULL, '625009', 'jeevaishu24@gmail.com', 'karthika@gmail.com', 'Isquare', 'Madurai', '', 'Madurai', '625009', '1', '', '8987676545', 57, 1, 0, 'Cash', 2, '', '', 1, NULL, '2019-06-08 14:16:20', '2019-06-08 20:39:21', '2019-06-08 22:02:13', NULL, 1, 2, 'cus_FDWN85pyKBKaOp', 'ch_1Ej5LEHEuxLQELZWq1l5EBWf', '', '22.00', NULL, 'se', 0),
(86, 23, '32ZH6WfhqNZrzswLCOSqfF733ffdY8YabMSnhZLoEhxEUPIy8GuB2dIw5Et6nkji', 'Manesh', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-09 09:10:28', '2019-06-09 09:10:54', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(87, 23, 'vG0sbWqLVgXzCbN84N6KnmB5oczaBN4bIfv0f61sl8Yrs6vIgSXFsfAEJaOfAIOK', 'Manesh Bahuguna- Frontline', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 08:00:56', '2019-06-10 08:01:23', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(88, 23, 'xH4tx4lW8aby1PzSOdgTsnmDlGIqI7FIF5kIv19fwPwWLinWLtcR3GVGppHzua5x', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 08:20:08', '2019-06-10 08:43:47', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(89, 50, 'BU1jAS9ZMzx8zWQ290jgVmEpdfKrrG29hUsXout5coooQFGhasHHgrxKPTTVVC46', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 12:16:48', '2019-06-10 12:16:48', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(90, 54, 'khBfM2pffOTAWaSADZtHYmvr7sXlkBJ5ipBO8mBEiQpXUpTV9goQTM19L0AEcc9Q', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 58, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 12:24:31', '2019-06-10 12:24:31', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(91, 50, 'DkNXROAIjHKpfX8avfIlSjKihNA8bakDcDCWDw7w7ZhMEUzAHyoKbk1rBf6PWzfX', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 14:36:08', '2019-06-10 14:36:08', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(92, 50, 'ykqqMtPk9g6BZaxZbcTHbvub964mcLn5PYrHEJpNGfHgUsfadOjpvo8QAdrO9OWt', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 14:40:09', '2019-06-10 14:40:09', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(93, 50, 'NsCFXDYL0bVvYfKKr1BHOpKwOJeJItO6WpKAOnzaWlmqPS1D9r1yETLIZeYSgoGl', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 14:41:46', '2019-06-10 14:41:46', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(94, 50, 'e8E66CPxyFbdTFvCeLR0rvRA67dwY0ErgW6ObdlZdQ7cidl60JNfN7WzIeWlDX2T', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 14:43:20', '2019-06-10 16:33:23', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(95, 50, 'HOGkc6nNbZbiRnkmM9NqKvJmrqwrSXJSv3j5VwJAKqZGgH3fk5umu5LmvcozSWeu', 'Karthika', '', '', 'Madurai', NULL, '', '', '', 'Karthika', '', '', '', '', '1', '', '1234567898', NULL, 1, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-10 18:55:45', '2019-06-10 19:07:06', NULL, 1, 2, '', '', '', '22.00', NULL, 'se', 0),
(96, 23, 'OW1ZHr0qOtjNUESvqS940Nzo55W0I31ZssHaGDlj4QKQR2VAvVBaHMdqLU0IBVam', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-11 07:33:31', '2019-06-11 07:33:31', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(97, 50, 'wAbRsYo5Q6YcrV4JH9v2FA1fstEPLScxAblvYWqP8STHC0RIT8YQTP7t82Id5RoL', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-12 11:37:54', '2019-06-12 12:06:18', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(98, 50, '2PtdSjtiTyA8lqzFGwAYBjqWe4ax86z3Zz6y1lJSqSQ5u9bS55hjM9mADUkKMYo3', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 14:00:17', '2019-06-13 14:55:31', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(99, 50, 'wAOgmFOMjYvAtxIaXTWtDKOsVZDGyeFe6Xb5MimHoqltuRlybypVD8WlIgyE1Z3j', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 18:57:24', '2019-06-13 18:57:24', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(100, 50, 'dKFxiArEfWgRxD3itBPK8pxiNJXQBiEtqaFyWUsIYqfte5lf7riefcnnZEHMcF2Y', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 19:06:54', '2019-06-13 20:25:44', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(101, 50, 'kLNtJK9H6f1T5A1rRmTjfIy8PbKamfwCgLnmJO2TuBpQXl02WoKPukpB5eKp7bKX', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 19:08:28', '2019-06-13 19:08:28', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(102, 50, '2rIEgHDJORDTpDz0POJr1jPkEq90MW9ta6tXISLr2z7BsMPiOvx1IPjTHurGP2r3', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:26:10', '2019-06-13 20:26:16', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(103, 50, 'cctx4UupFIFwQZFENhB5zp6vpbpmttKp3w1X31ygzbtDNHF0kVYIQUTw1qWqBamg', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:28:21', '2019-06-13 20:28:31', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(104, 50, 'kd1QVETHX66RL2pGXsdHpXtNKZoIN0DiBuGxXco66WMcTozjn4mDNUZ6I3RdULiY', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:29:10', '2019-06-13 20:29:16', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(105, 50, 'GfGe1znwAisQ78O75vDuSyV4fxqmkscQqet0baEFquL0LCF3fLApoLkr2DdkDM1b', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:29:52', '2019-06-13 20:29:58', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(106, 50, '68VD0ETPrrFBxYBzLD00v78vTjuglWIqlfmwRK5qYpCO9GenJOOsfn1ZH559yc9M', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:30:31', '2019-06-13 20:30:42', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(107, 50, '3BwfXQ0M5mqVLWNTxHnd5ssDKdDHhA8GxYnFJE99ZqlFxpN8CJNxu5yGQp6288Yu', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:31:31', '2019-06-13 20:32:06', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(108, 50, 'P7i8foXzDHMuw4nxY1ONbt4ChVnbHOonf9vUNH1IormXgq6qLbKMgrFLbiaGfxq8', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-13 20:32:44', '2019-06-13 20:32:49', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(109, 23, 'hwY0WHr0Pho4gBzqFPs7khV5BpGYdofFMYJ1SE0bavyiszlDi7kpchMQcDBPWszP', 'Manesh Sid', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 08:49:19', '2019-06-14 08:49:43', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(110, 23, 'Bv4qO2IqdHfrNXEfxYYxle8VNmI7PHesGSaerk3uqvR27tsxsrBFr2yAIJVAeWyH', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 08:50:20', '2019-06-14 08:50:35', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(111, 23, 'c5QDDMzw9A7PE37OlPLEpbsueNns07KQg1QozcSyEG6XnaspO7kWRXZITH8I3e0F', 'Manesh Bahuguna - Sid', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 08:52:40', '2019-06-14 08:53:04', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(112, 23, 'JdaPErisIZrsO5uDLYr84rZZmuIskqvOEzW5zUF1AalfZdtUEs10FasWwf62vtfI', 'Manesh Bahuguna-frontline', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 08:59:12', '2019-06-14 08:59:42', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(113, 23, 'INd8c3dvWbWm9EeS8I6pAIB3m7ttQB86EHrAoh5XW1uWas9ZoF4RpFnaVjt4humH', 'frontline web-sid', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 09:02:16', '2019-06-14 09:02:34', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(114, 23, '0k4NOyOAl8gIV0qfWOShLVNCidCJZDCVY2Cw9KCGcmELvU0xGvkWR78RDPngoehc', 'frontline web-Romina', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 09:10:30', '2019-06-14 09:10:47', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(115, 23, '2NUnIC7hBZeiNGvNORzJd3nPprhoaHGiXOPU17qPegKTk8FgBd2lqot3iRNFyTPc', 'frontline web-Romina 12hrs', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 09:12:33', '2019-06-14 09:12:52', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(116, 23, '6l5LGootAeORNEj1QD4V5Es8LABHKIEROAuPq6lLkntzxmi40zKnS3VOkNcssqaR', 'frontline web- 20hrs', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-14 09:15:31', '2019-06-14 09:16:44', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(117, 50, 'w5wqHWnj9KscuvaH4sOiCywGOlfikMxFC2twHrRP0r6iVNmun6eUkv1Gfa3jrvCd', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:37:25', '2019-06-15 19:37:31', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(118, 50, 'Vpdvrtc4cIJGY84toB0B30vE72at3LRO3FzBDblL1sjlxExYyvfWyGh1i1aFMSgu', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:40:18', '2019-06-15 19:41:08', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(119, 50, 'B6PqfEcKd7X9UlWhRRm9Vc2DUGzBZLAJSnNs9DFoE1pEAfOMj0MeQnmYzvwxcHR1', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:41:42', '2019-06-15 19:41:50', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(120, 50, '5rD1cFZfPkryUtXBQWc7L40j8jo1J5U9PTO4B9GTwvTKfiL8sHAmyXDfI47n8DpD', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:54:37', '2019-06-15 19:54:41', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(121, 50, 'HOYJ2YoQkmYvkKo4IPcGrmNOJl3Rqz82zJF1aKWR30YhhVn1LWNKAc80SmB4fB7V', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:55:28', '2019-06-15 19:55:32', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(122, 50, 'W26cKidN7fauDrYs2fkosfq7nMA1FKcBFFzt4nn44B6XgiYtbZttBXRztXa6a29T', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:56:22', '2019-06-15 19:56:27', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(123, 50, 'w17yooQAWIdkxIc1lgdLKdSvw2oUR8M2GoPrryZCknhB1hDtEqLY94vuSEvvgIWI', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 19:57:40', '2019-06-15 19:57:47', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(124, 50, 'JE9BS6QSp5AWjBPWDPcbAfPIFRDR6tUaM8ZtColG5jhFoXNyezQ1h6h5cZsJ2gSc', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:17:04', '2019-06-15 20:17:10', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(125, 50, '9JzekK9Sy6X4NGYtkVbyFsDlbgVazer4bcuoD4DIAlXW14P8dudSCV34FOxQ6m1Z', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:19:56', '2019-06-15 20:20:00', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(126, 50, 'kd5iC0p6J1Yeqm7ssAADxFYcFBBK1x60pqUIwboP1rM4lcUiWLX8bdzitrzGT0lA', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:22:01', '2019-06-15 20:22:05', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(127, 50, 'rtjOHsUEGg9PEQi6zwgXwpb6XQgIcKORXvvMupka6eaJ9AqIuayogAFOG5J0jHXk', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:22:30', '2019-06-15 20:22:35', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(128, 50, '6klWVxvwkHKAvDSiAW5ePGQZPRQHs9xvdiIxsOkswjBGYQHWZPUYq9EO9P1Rr54l', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:25:21', '2019-06-15 20:25:26', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(129, 50, 'orAX53LDJB1b5fT4eZtVPkRSud3RUg0ryTz9mHH74vB2weXlJjR7T8FqdkyBQaW2', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:26:17', '2019-06-15 20:26:22', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(130, 50, 'HZZGvmWaklDWaeAfXdvY5b6mvHBpigfsydkQplXR5IoKwp6hCCBNl4M707FIgPSy', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:26:51', '2019-06-15 20:26:55', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(131, 50, 'LOP6dEr4Rs4Z2CrUWUwCkqkDUpkAMnUkupnAJ91NLeHbHJ4LhomcGX9SmCoxWai1', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:27:18', '2019-06-15 20:27:47', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(132, 50, 'EgeumRFTWpjnxhfSj3OiXI0nVeFLEI28DBzaRC96GwunYpYLJn9RbdzeNA2KXcR6', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:29:20', '2019-06-15 20:29:25', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(133, 50, 'jXIxEvbmmXebFVfsfKOmL161KKNB2Gp61nnmHllUFkjM8QPUP11QKyW1vm7t4weB', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:30:48', '2019-06-15 20:30:48', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(134, 50, 'E1EMH4KHOjKl8yL5B4WMSU0yscFXs1W83ew8v46usyiSQhzLeVov7YQtUdSRkBF5', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-15 20:31:08', '2019-06-15 20:31:20', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(135, 23, '3bYaDndjPZzD7rdiPeuqolXiH9E8wSOsCO5twEPaOumcmY5Q7yDAPxzh2VLLl30I', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-16 19:02:06', '2019-06-16 19:02:16', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(136, 23, 'cDcA30DdRKAdpaqiP4xsqfO4Zzyq43EoKCAuw2f0Xk2ANCYwj2YKlMOQewLDRucx', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-16 19:04:46', '2019-06-16 19:04:54', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(137, 23, 'R5hk70CHSsq2kPll331HKZN3oOnXZVeMlSHW8V5PkL3PRuQGt79ireAYU180fAgA', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-16 19:08:09', '2019-06-16 19:08:15', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(138, 50, '7LU4odN62dNRy09xzGUWXMDXbonPoVTaN1pSh8TDAsPTF5mRs5QkPncWB1sP8Pv4', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-06-17 18:19:38', '2019-06-17 18:19:44', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(139, 50, 'U6Tp3X82uSNWilRnpWltrBDKL8xbUAK50MqZXWpShc9mZd0Y80ViW6sIdA4Sy1LQ', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-16 19:32:43', '2019-08-16 19:32:43', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(140, 50, 'SfOUxQEeiafhgq7C4AFYEDBCzkXTyLekbTPO7TXuWgPY2WcdENEFzJQD3BkK66hK', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-17 11:00:45', '2019-08-17 11:00:56', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(141, 23, '88hSLZWoq3JOjPgYEj40kUrYApkXohEa8bKPBfzjxWgJhzOZ9AGln1Kxl1oZxKHK', 'Manesh', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-17 11:35:26', '2019-08-17 11:35:44', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0);
INSERT INTO `bookings` (`id`, `centre_id`, `token`, `name`, `address`, `address2`, `city`, `bookingcountry`, `post_code`, `email`, `billing_email`, `billing_name`, `billing_address`, `billing_address2`, `billing_city`, `billing_post_code`, `billing_country`, `billing_telephone`, `telephone`, `user_id`, `status`, `paid`, `payment_method`, `payment_method_id`, `klarna_orderId`, `klarna_reservationId`, `can_be_cancelled`, `booking_invoice_id`, `payment_date`, `created_at`, `updated_at`, `deleted_at`, `country`, `customer_type`, `stripe_customer_number`, `stripe_charge_id`, `freeText`, `bookingFee`, `cancelled_at`, `default_language`, `terms_accepted`) VALUES
(142, 23, 'YTkemCIv7jM1JZmv0yubXqRyXprUqnN1heNEW8XZOKBvuFyv97v396yIHgrxvujE', 'Abu', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-17 11:45:06', '2019-08-17 11:45:28', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(143, 23, '8kGkqdIneXfP0ibkP0hLcgaYSAt4WE6fM2NAVzHicsK65WodlpZ57kfkFLFSxyYz', 'Manesh Bahuguna', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-19 14:41:56', '2019-08-19 14:42:16', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(144, 23, 'PmZE0IEfJ4hAWtJ5fxDmVcSfyHooTCtRhBJqg8v582Ew6S9F4VhWkyK2KL887XlO', 'Manesh', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-29 10:30:15', '2019-08-29 10:30:29', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(145, 50, 'I7kqM33AVuwdDBWMtn9b3MjGIOl7vu9j66Z4MSZvByH2xCYQYDSU0qEGK06ew2Xy', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-08-30 04:50:51', '2019-08-29 16:18:43', '2019-08-30 11:50:51', NULL, 1, 2, 'cus_FiT0elSxEzxZgP', 'ch_1FD24UHEuxLQELZWu20Z1vah', '', '22.00', NULL, 'se', 0),
(146, 23, 'yOl94FP71sJhSKq6K2LSlwUYZIFwrKEX2cI42TtRSRsKlqStxCMaN8fwYO3HQebT', 'Manesh', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 13:58:47', '2019-08-30 13:59:12', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(147, 23, 'MQf3s6i9RcrYzJ8Gtb7BTamtlDdEStp7E7Mzl7X2fDfROmAdJRfhMJ82JzyOGzfm', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 14:01:16', '2019-08-30 14:02:07', '2019-08-30 14:02:07', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(148, 23, 'RgZptqu49nSx5kWxZVS2cC0qozwK8LqH73RUxb4LbDtoDDAzC0LrZO5yunxGIOA9', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 14:02:28', '2019-08-30 14:07:02', '2019-08-30 14:07:02', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(149, 23, '3ZaQD7cB9xMp5vBib4CshMC0g3bai5dLXfeHfZVD4Li6ek1PfKDXFV2ZrRmJ5axI', 'Manesh', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 14:07:19', '2019-08-30 14:07:35', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(150, 23, 'EVcsqGayyedHSBSvPqBcrvXrFqbXrFExLRaoZKIdQbuApUtenEDgh4VVoHJpplS5', 'Manesh', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 14:12:35', '2019-08-30 14:13:13', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(151, 23, 'ZdcTUaIkRYkCV5o7LT3OAJZyObvwDo0N8G9mmPkKrU9GhjvEPqLqG6aWijrPevES', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 14:16:34', '2019-08-30 14:17:01', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(152, 23, 'LsFt14mwwmVzPl6VasbFEQAWxAudrjYGqAY6wGOFzi60HH5GGeGQYdpFAFPr8jHn', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '2019-08-31 08:29:32', '2019-08-30 14:18:25', '2019-08-31 15:29:56', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(153, 23, 'ySevbL4rAZRG1as5hApPGZyppdsDhW8ijLwuKeKl8eLksgwaZaPENGU3rrnq0Ebv', 'frontline web', 'sdf', '', '', NULL, 'aaaa', 'manesh.bahuguna@gmail.com', '', 'frontline web', '', '', '', '', '1', '', '1234567898', 24, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-08-30 10:42:28', '2019-08-30 15:01:37', '2019-08-30 17:42:28', NULL, 1, 0, 'cus_FiYgYnhV3oHlAV', 'ch_1FD7YlHEuxLQELZW0fpYk3TG', '', '22.00', NULL, 'se', 0),
(154, 23, 'ev9VgI4e0t09O4luppzbaVGIg4xDrJ2JmgU3RAZmOajqo1SrRVwjsnKrw5KPGMZK', 'frontline web', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-30 17:39:12', '2019-08-30 17:39:19', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(155, 50, 'vx4DBHs6UrGNyVuJNSAAi7gipJbs3j4qNyTKXRIiXCmUICBheA2OD8xLu3jfGNgs', 'karthika', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', 'karthika', '', '', '', '', '1', '', '', 54, 1, 0, '', 5, '', '', 1, NULL, '2019-08-31 04:40:34', '2019-08-31 11:38:42', '2019-08-31 12:03:43', NULL, 1, 0, 'cus_Fiq4hKqCbNWXFT', 'ch_1FDOO5HEuxLQELZWZhlHH2QN', '', '0.00', NULL, 'se', 0),
(156, 23, 'XTTzZnVj18X3qZLXmIPg26pQj3b1rYH2NKuXCTGbcK6OmwocZNIrL9s1aYgxWBt6', 'Ednan Hossain', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 15:48:36', '2019-08-31 15:59:01', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(157, 23, 'g3xgWJwqdUOnN5yOHPxFYp9whDCQK0ZQ9GItFGYvFfuNWLxLHIFViWcH1VhsQKcQ', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 15:49:08', '2019-08-31 15:49:08', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(158, 23, 'S01pJjvFqhunTSA847UQKvWeH29CG5pa5ThoUjHbi70pUyBiFdWf9PBQ5eTJCQlB', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:01:25', '2019-08-31 16:08:48', '2019-08-31 16:08:48', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(159, 23, 'TZceex7uvpvlhXAeCyrtwS9APEiPw2rKKeW5VPz965CoWxGL2PHZQvADn06OteYi', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:03:41', '2019-08-31 16:03:41', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(160, 23, 'GpilR4M9JMZTYywAXjtUTbIxQxTepxjgMeZuXPaoglBrvKHTpSlptpdmAElW2M3U', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:05:57', '2019-08-31 16:05:57', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(161, 23, 'vg2SwICEjTfdmVQlQ7F68ss7oJK4RQFuC7qCKEJfeWAyaqNb0aUoOxNdGNRyZffG', 'M', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:08:03', '2019-08-31 16:08:46', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(162, 23, 'eqlAaoIdfH0XvJqRcO6wvRDVGnJPWxLjRbFLkH8JxpXdB4pHaXotBVPv7Dte03y0', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:09:03', '2019-08-31 16:09:03', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(163, 23, 'oNN2vtMRJRgLTeOM7catt5esw9yxbOYqwPDuE6bm2mcJdqH5pCi2NISOePwkdjoL', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:09:52', '2019-08-31 16:09:52', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(164, 23, 'f15zejGHEa1d9mwA7EQMzRZMEneEFCbUN7J5BIxqRUqcq8B1FEx3D7zoWrTtwJCw', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-08-31 16:09:55', '2019-08-31 16:09:55', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(165, 23, 'JdjtxUPCyyeTWE9tK5l2RT4vsRj65tIIDExAgkPotDrgOQBxZ9w0k71rp4onCFQx', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-01 15:52:36', '2019-09-01 15:52:36', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(166, 23, 'ImpbQ2eaJ3nlAqvTL9euZqwCLaKhG5p1Qy0Dh0uKrdXnJQm4huVCNVyD4S5EVsCW', 'test', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-01 16:27:25', '2019-09-01 16:27:42', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(167, 23, '8mvMgxscSniQgKNlvuMYeKPVoa177B2F4TGyciGfXWn9DNzN5jvgtQlQxRa05pLI', 'Peter', '', '', '', NULL, '3000', 'manesh.bahuguna@gmail.com', '', 'frontline web', '', '', '', '', '1', '', '', 24, 1, 0, '', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-01 16:33:26', '2019-09-01 16:40:09', NULL, 1, 0, '', '', '', '0.00', NULL, 'se', 0),
(168, 23, 'g3c7WbGbt7Z6tTlKMaBwjjLV8n6hvsN7wIbgFgiCb07KphhWkZxCSoCnNEuLypZE', 'frontline web', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', 'frontline web', '', '', '', '', '1', '', '', 24, 1, 0, '', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 11:26:41', '2019-09-02 11:58:37', NULL, 1, 0, '', '', '', '0.00', NULL, 'se', 0),
(169, 50, 'ntNpKO2UAQuEoo9sGWkFBeRqJfCnqLEQyL6X7QwCRasdRrj9gevsKp8eWX9UUdcM', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-09-02 06:22:40', '2019-09-02 13:07:24', '2019-09-02 13:22:51', NULL, 0, 0, 'cus_FjcAifbaI5ls73', 'ch_1FE8w0HEuxLQELZWBQp7uD6A', '', '22.00', NULL, 'se', 0),
(170, 50, 'pqSzPzy7q8RJ7N8xKoQqX5hLt4RBX8rRQH8iLb1BeFaQewJhyLAbfZgYydhBJfE3', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-09-02 06:23:58', '2019-09-02 13:23:40', '2019-09-02 13:24:08', NULL, 0, 0, 'cus_FjcBE0EYcCsBS5', 'ch_1FE8xFHEuxLQELZWUkAm4Ip6', '', '22.00', NULL, 'se', 0),
(171, 50, 'V0S5QQ7PjWgtk4NlvQB9TvaYRsI8DbXV0vDcq9wnPEfyxNwwn7rv0oSHnDGLCegS', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-09-02 06:28:17', '2019-09-02 13:27:58', '2019-09-02 13:28:27', NULL, 0, 0, 'cus_FjcFia5q7HFcPk', 'ch_1FE91QHEuxLQELZWkbkB9kCl', '', '22.00', NULL, 'se', 0),
(172, 23, 'z4vjb9zUz3VgGU00pM9qhPa0mr5W6YomDFWLMk1YOkYTbLquHhYVL0fNOmNoFKyc', 'Siddharth Bahuguna', '', '', '', NULL, '', '', '', 'Siddharth Bahuguna', '', '', '', '', '1', '', '', NULL, 3, 0, '', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 13:57:21', '2019-09-02 14:00:23', NULL, 1, 0, '', '', '', '0.00', NULL, 'se', 0),
(173, 23, 'XDXsoMtmByuUOjXjQ9yVQgEV11gIux9CuPa6HoUUA4ZPylWmze6yLFJzBgRQ6o6L', 'Romina E Bahuguna', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 14:03:11', '2019-09-02 14:03:30', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(174, 23, 'HkrHgQjIERsTIVEK8eEejIWiJU9Cl0v85vbyUgMl5JL34oxok5VUd0TBdP5nZ2SA', 'frontline web', 'blk 12 lot 2', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09898988979', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 15:32:18', '2019-09-02 16:28:11', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(175, 50, 'Q041XvfKy9rorL9Ze48mQuGb0uoQzaTqXomKge8Se9sqlMxrn26mufnTe66cuWZn', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 15:33:57', '2019-09-02 15:42:38', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(176, 23, 'N6PvNiFol5UGqROC5en2i2IzmMv7AUqJzcTOzLpSl07HJUhUxsADsi2lX2W7woLX', 'Manesh', 'Dreamcrest', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09277366115', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 16:30:06', '2019-09-02 16:31:01', NULL, 0, 0, '', '', 'Checking', '0.00', NULL, 'se', 0),
(177, 23, 'En9JbvQjLLxVZd9LsSpHuiY0DGRKVxp68rPLrjq1wUOC29YBBRPMedpRYs5EMwXN', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-02 16:31:54', '2019-09-02 16:31:54', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(178, 23, 'CHaWCmRHYAlwkUHsMZXSxWNdZLZApUOgOqMDNkPpp5sZ1ouvqehtFgLfz30EAHvB', 'frontline web', 'blk 12 lot 2', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09898988979', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-03 11:45:17', '2019-09-03 11:48:59', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(179, 23, '05at7fsyIPGyFdoNRV0EVZM8avV0mZ3ESc84kwuvxGVunNGjcdnjwBdaIIPLKEt3', 'frontline web', 'blk 12 lot 2', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09898988979', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-03 12:44:23', '2019-09-03 12:44:29', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(180, 23, 'zOZkTRnj7AsfZ1RvbMcNtoYoR1plXVET1pBJE7iijS58ewRFbIb8jfG8dRrc4DlW', 'Manesh', 'Dreamcrest', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09277366115', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-03 14:00:13', '2019-09-03 14:01:24', NULL, 0, 0, '', '', 'testing', '0.00', NULL, 'se', 0),
(181, 50, 'Q5oeGwks2KZWQKajp51pW1Rr8exVu5uwUgg0tP06xDZUWxrDuhvxKeueuVUJk3kj', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-03 16:13:56', '2019-09-03 16:14:03', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(182, 50, 'syOEwnE4BNWu90ns1LH9FSzBtwTTyZOdVNaHluGtod3PnunCWCHwtvNSxvpfwCs1', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-03 16:14:52', '2019-09-03 16:21:49', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(183, 50, 'qESrhgZm9cwXXWjgzGa5Gs1YAqoOtc5GENG8Yt5uyKmFkhoP0LwQWsu473N3LulT', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-05 11:15:30', '2019-09-05 11:15:37', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(184, 50, 'vdhgy4jlqjJRRQ2jVBbZqu47Zyk4SuGkN7QI0o2qUknOKGLULW4ZmLE8s75bZsqR', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-05 11:18:17', '2019-09-05 11:19:00', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(185, 23, '8sYkhnZQZ0rUT58uucDehFHXwCM5X0leaMqYkpNuT3jjkhNS9M55dgXWaupbyOmJ', 'Manesh', 'Dreamcrest', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', 'manesh.bahuguna@gmail.com', 'Manesh', '', '', '', '', '1', '', '09277366115', NULL, 5, 0, 'Stripe', 5, '', '', 1, NULL, '2019-09-05 05:15:57', '2019-09-05 12:13:48', '2019-09-05 12:18:25', NULL, 0, 0, 'cus_FkilSXvV9YjpRn', 'ch_1FFDK4HNSsTZQoN5YTwcVz2S', 'testing stripe', '0.00', '2019-09-05 12:18:25', 'se', 0),
(186, 23, 'GUGyTG0qwJnxoStnnZt7eclrphtvREFCAlplKBYLiNPpWrfnoHoZdRoYK8JCUDmc', 'Peter', 'test', '', 'test', NULL, '12345', 'peter@puschel.se', 'peter@puschel.se', 'Peter', '', '', '', '', '1', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-09-06 02:31:33', '2019-09-06 09:30:20', '2019-09-06 09:31:44', NULL, 0, 0, 'cus_Fl3LNbvUret476', 'ch_1FFXEXHNSsTZQoN5pRZCQcWK', '', '0.00', NULL, 'se', 0),
(187, 23, 'g4gjZ9D6hKxOYCJ5D7w0HGZAfzLc9LKpLfM9OxNpQix1rvlg59mUqcDmHW38UQdw', 'test', 'test', '', 'test', NULL, '12345', 'peter@puschel.se', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-06 09:51:28', '2019-09-06 09:57:05', NULL, 0, 0, '', '', 'test', '0.00', NULL, 'se', 0),
(188, 23, 'Q68mirL8sJ6VLmX6fjTQhaRazZllzPCFY8YaCFAvNnHK2wmd0iJFl2GP6S7odIvM', 'Manesh', 'Malolos', '', 'Malolos', NULL, '248001', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-09-15 17:59:44', '2019-09-15 18:00:33', NULL, 0, 0, '', '', 'Testing', '0.00', NULL, 'se', 0),
(189, 50, 'gpaaikRGVlzFSekrCGZi8BzM4u8wTymu9ODgFm3hyXBDL03xnLlsqa0OZ82bivjj', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-10 18:46:09', '2019-10-10 18:46:24', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(190, 23, 'D8JTe3FRdAZXOt9XisxLye1g5ecAn5EAMdBmA6os2e11TaXPvYMM4R85uKfmPJYn', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-13 06:47:04', '2019-10-13 06:47:32', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(191, 23, 'lVRNducbLLvHZY1e4wlmaBo9Fs6GlMLRgrEyAIK9Vo2bvPSEezSsaWcKaFWULSA2', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-14 10:10:15', '2019-10-14 10:12:57', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(192, 50, 'EcYgctrvSyS3XQbgMjuurRiaHxx3HkLOVnlHSwEZZk0MYBopUyBcdZgJNS0scpFe', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-14 14:59:56', '2019-10-14 15:00:03', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(193, 50, 'uuDNqiIkwEHgXFWlHkD3AcD6ar4Q1KkF6DLgLwYs74CAf7vrLcfltzPl4WvI5fGW', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', '', '', '', '', '', '', '', '', '1234567898', 54, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-14 15:11:43', '2019-10-14 15:12:00', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(194, 50, 'C6XKVlK1LiNj2wsUtDd99mjnaBOIRGyxxZn8Rl35CQ4Lj2Qb2SPAPVVICOkKK1FJ', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 08:29:41', '2019-10-14 15:23:46', '2019-10-14 15:29:41', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(195, 50, 'woUt20jQs5uW8SM2sKHEiioJBt2rCDq6v2Ry3MiCaRGNpLNt3FXT8VRVfjylM61r', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 08:41:55', '2019-10-14 15:35:14', '2019-10-14 15:41:55', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(196, 50, 'TAq85mByeqToepaBt8EowJwojBhcTwpYiSZLt5VNPWC1yropapsb2Dl4DReEU1LG', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 08:43:07', '2019-10-14 15:42:46', '2019-10-14 15:43:07', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(197, 23, 'VpmsxqnkmCrBIDUbxLwGvhAsQqqaWmVCzoSFVV7OtkttFomWoAUhtmjVj27eYf74', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-14 15:43:01', '2019-10-14 15:43:28', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(198, 50, '2FbOQBTh9gXzaKtYTx8Tt0j0DmHW4x3yyLjs4La4H0OCDemBJmdUo15ZwXvyPmHU', 'karthika', 'sdf', '', '', NULL, 'aaaa', 'karthika@gmail.com', 'karthika@gmail.com', 'karthika', '', '', '', '', '1', '', '1234567898', 54, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 08:44:26', '2019-10-14 15:43:55', '2019-10-14 15:44:26', NULL, 0, 0, '', '', '', '22.00', NULL, 'se', 0),
(199, 23, 'dpKnJxVE61SR5kiEUqvrCNY9xzqEUoJHH6raqBC6qQOsZ8vre0yf0ihx1UhcdqEP', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', 'manesh.bahuguna@gmail.com', 'Manesh', '', '', '', '', '1', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 08:46:11', '2019-10-14 15:44:40', '2019-10-14 15:46:11', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(200, 23, 'CORzFDKdfF3hkMny3UFhUeQVmDM0Z8Tq33dUQqbrzjsWFLUvY1hTeSkEzrZbXBhT', 'Peter', 'Vattugatan 4', '', 'Domsjö', NULL, '89250', 'peter@puschel.se', 'peter@puschel.se', 'Peter', '', '', '', '', '1', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 09:44:56', '2019-10-14 16:41:46', '2019-10-14 16:44:56', NULL, 0, 0, '', '', 'This is a test', '0.00', NULL, 'se', 0),
(201, 23, 'hRbZ2hWztFJx7JbQOP7lM4nnxV5Yrd6jepbkmeXZd5hBsF8gpfJyI9bpvxDvM1Lg', 'Peter', 'Vattugtan', '', 'Domsjö', NULL, '89250', 'peter@puschel.se', 'peter@puschel.se', 'Peter', '', '', '', '', '1', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-14 09:47:40', '2019-10-14 16:45:42', '2019-10-14 16:47:40', NULL, 0, 0, '', '', 'this is test 2', '0.00', NULL, 'se', 0),
(202, 23, 'vUVgCXY4XDHG8m2UYF2IP2JHiOGF2MQ6bP0nZPWJDeYx8zVm3zFtNhSgnq471FT9', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', 'manesh.bahuguna@gmail.com', 'Manesh', '', '', '', '', '1', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-15 08:19:46', '2019-10-15 15:18:20', '2019-10-15 15:19:46', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(203, 23, 'zq5djWb4ElcbaFl4Gs7d40iOMYAFYLn20S5C5NyQR6tdwFeOViIofmL2WgWDwnvn', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', 'manesh.bahuguna@gmail.com', 'Manesh', '', '', '', '', '1', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-15 08:30:18', '2019-10-15 15:26:27', '2019-10-15 15:30:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(204, 23, '0LQay3rw57oYz3JJ9Yl2KBO2uhJlFsiikWKGdBaFt6YJlHh6A9LVGCZs4osDpJnv', 'o', 'p', '', 'p', NULL, '9', 'peter@puschel.se', 'peter@puschel.se', 'o', '', '', '', '', '1', '', '9', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-15 08:35:23', '2019-10-15 15:34:08', '2019-10-15 15:35:23', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(205, 23, 'RMJUXsZ9TmMaRVdZhA1Pd8HsugIi0LiX6NTKg21fW9ypu3EFCfBM06T2ZZFZNXyR', 'p', 'p', '', 'p', NULL, 'p', 'peter@puschel.se', 'peter@puschel.se', 'p', '', '', '', '', '1', '', 'p', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-15 08:37:00', '2019-10-15 15:35:47', '2019-10-15 15:37:00', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(206, 23, '3xDL7bS9m7eQHY5IPw7G7Y1IDcKn9nlo0fWfUvsogbLzvz5ZPt1GwS7goPwKVu0E', 'p', 'p', '', 'p', NULL, 'p', 'peter@puschel.se', 'peter@puschel.se', 'p', '', '', '', '', '1', '', 'p', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-15 08:40:38', '2019-10-15 15:39:55', '2019-10-15 15:40:38', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(207, 23, '5EoiT72rZdbess4cisaBYUqdgKSHk3kyNvBsBR9Yed4FLs5AJOImO8Ufxg6Cbemx', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-16 15:01:11', '2019-10-16 15:01:11', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(208, 23, 'DykKaGXDSEr1zRfIqfSdjC582JnN27NToM8PrhzcIBFdJKyNcJTDjS4lDqOj1lSz', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-21 14:33:39', '2019-10-21 14:33:39', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(209, 23, 'rtYxSYFSVYE4AgSvevfpOdub6S5fmteYJeSwDbId08uJBpzZVayPvFJDbSbIdJgR', 'test', 'tete', '', 'ads', NULL, '1322', 'testt@gmail.com', '', '', '', '', '', '', '', '', '12312', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-22 11:28:27', '2019-10-22 11:32:11', NULL, 0, 0, '', '', 'asdas', '0.00', NULL, 'se', 0),
(210, 23, '7DwkNwF1GvJrKDFxTvZipautyMUIekzJMxQlen1kxrPAZ9ZrsDHjJ3EmRXVSojOb', 'Manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-22 11:31:07', '2019-10-22 11:33:10', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(211, 23, 'sEpAdHkDWcSiB0iFMLAqOuUOuqE21nIe77yMv28CFmyjtG26xfbVAC6GT9Rl04a3', 'manesh', '', '', '', NULL, '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-22 14:24:00', '2019-10-22 14:24:48', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(212, 23, 'yyug1B7rn2rmJI2yiMDdboaAbFYJIuSjgqrrFnbti4yNei1YLzkJQJXBoUlgW0oU', 'frontline web', 'blk 12 lot 2', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09898988979', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '2019-10-24 16:57:55', '2019-10-24 23:55:19', '2019-10-24 23:58:01', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(213, 23, 'JeXGzhoGcHqRRu5vIDE4mCZ8j1GmlbnFQXGkqApbB2AEoDEqUpX33QO4OLWlldBF', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-24 23:55:58', '2019-10-24 23:57:07', '2019-10-24 23:57:07', 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(214, 23, '0IHw1gQQWO1tVKZRxxdSJr08HyOgpoLZqBMaPCl7aacVAspTZ8AfXm7JLkl6n5I2', 'frontline web', 'blk 12 lot 2', '', 'Malolos', NULL, '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '09898988979', 24, 3, 0, 'Cash', 2, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-24 23:57:19', '2019-10-24 23:57:37', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(215, 23, 'psuz7NQOF5boulhGK0Cudq7Ct5csHDWCWWVFNsMHlXHsvgKll3SDlHONEcpXw0HZ', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-25 00:06:45', '2019-10-25 00:06:45', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(216, 23, 'NNxJtwfAq5snAFL47H4DfUIom3yR40vvPDv7KO1QsUbVjNMV1dqYFTqEgknGyoT9', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 24, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-25 12:27:49', '2019-10-25 12:27:49', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(217, 23, 'mkelxomLwGgukeHsAEfzWg9SbwIuRM94uC1kP7Hlo019f0Bg057oV4R4KISjDEzn', 'Test', 'ert', '', 'sdfsd', NULL, '9876543', 'rajanbhola893058@gmail.com', '', '', '', '', '', '', '', '', '9876543210', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-25 13:57:56', '2019-10-25 15:16:52', NULL, 0, 0, '', '', 'sd', '0.00', NULL, 'se', 0),
(218, 23, 'GGnEmCmx2gXwREDpohVUyyiBGvNhvElePobab0OgVv57LylyeoSU5xBsWjQwtqe2', 'Manesh', '', '', 'stockholm', NULL, '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-26 11:15:46', '2019-10-26 11:17:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(219, 23, '2TO9LF3O9dKQhiY4FsW43YdPBUA8CeVeYezakMBK9mciIplmgnh6gpb7APiPx6KH', 'Test', 'testt', '', 'asda', 'DE', '98765', 'bholarajan3.rs@gmail.com', '', '', '', '', '', '', '', '', '231312312', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-26 11:43:00', '2019-10-26 16:36:59', NULL, 0, 0, '', '', 'asda', '0.00', NULL, 'se', 0),
(220, 23, 'QK4fEOpAmL2BYvEMJSbr1DecKKY8wKHb8t6HP3VBcHkIC8yQxBGelwXEuJ1dQsxE', 'ada', 'asdas', '', 'dsada', 'DE', '232132', 'bholarajan3.rs@gmail.com', '', 'ada', '', '', '', '', '1', '', '532234234', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-26 13:24:51', '2019-10-26 18:42:21', '2019-10-26 20:24:51', NULL, 0, 0, '', '', 'zccasdsa', '0.00', NULL, 'se', 0),
(221, 23, 'NjRXiMtkZaP0YJh1svmpPKVr7nECYW8OM1UCc4WcilG8xfSV2IpmrbQugKbRK5X9', 'ssxczxc', 'xzczxc', '', 'sdasdas', 'DE', '213123', 'asdas@fdf.dfds', '', '', '', '', '', '', '', '', '12321321', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-26 20:26:45', '2019-10-26 21:46:00', NULL, 0, 0, '', '', 'd', '0.00', NULL, 'se', 0),
(222, 23, 'frAm0wvwRPdkd369IgI7SqCL8NvEABIHcK6USzSer05Da7JKMwGi8Svqe7krHC6Y', 'tesdsaf', 'fsdf', '', 'dsfdfd', 'SE', '324324', 'dsfsdf@fdf.fgdf', '', '', '', '', '', '', '', '', '3435435345', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-28 21:31:50', '2019-10-29 00:15:25', NULL, 0, 0, '', '', 'dfg', '0.00', NULL, 'se', 0),
(223, 23, 'NX9vjwuxMoP0P0yGrtLF54GCjJc2HDP4qMdTO2yBqhN4WyH3Zpb7ChHRKnG4qW1H', 'Manesh', '', '', '', 'SE', '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 09:30:31', '2019-10-29 09:31:04', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(224, 23, 'DU9CRwvQ0pfjuvO3G6GrZI30P23sdJIUzClORnezvhc9myXh7lhDud12RP9RUISJ', 'gfds', 'dsfgfgf', '', 'ewrwe', 'SE', '2314234', 'bholarajan3.rs@gmail.com', '', 'gfds', '', '', 'ewrwe', '2314234', 'SE', '32432324', '32432324', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-29 08:00:22', '2019-10-29 13:07:57', '2019-10-29 15:00:22', NULL, 0, 0, '', '', 'sfdsdf', '0.00', NULL, 'se', 0),
(225, 23, 'uZaYWIrCcvhnWvzHc7DlbFJ8TSiSu4eX7LzJ6VcLaTeKEoKbHcEV3RKz7hteo6es', 'hgrfdas', 'fsgdfg', '', 'gdfgds', 'DE', '234324', 'asdas@fdf.dfds', '', '', '', '', '', '', '', '', '9876543', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 15:02:39', '2019-10-30 09:51:55', NULL, 0, 0, '', '', 'rwerwer', '0.00', NULL, 'se', 0),
(226, 23, 'ckfrkRFauVaB5rjHQkW3x9pUQ4h8CmglgjCwK6aoPXaqTZnppUaEBUykoNmLFjmP', 'Manesh', '', '', '', 'BE', '', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 15:55:57', '2019-10-29 15:56:17', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(227, 23, 'OQTnFn2mKYIRmiE9fSEOh21JLRjL0nQiuG7q4747iKh7YaTklzDb031GXmAkx51r', 'fdsfsdf', 'sdfsdf', '', 'fdsfsdfds', 'BE', '324234', 'rajanbhola893058@gmail.com', '', '', '', '', '', '', '', '', '465754645', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 16:30:11', '2019-10-29 17:34:59', NULL, 0, 0, '', '', 'thfbd', '0.00', NULL, 'se', 0),
(228, 23, 'Lvxi5F5yquOPCBooCOajINiDg4mSCh0u15j8SFVxHPSqNFVS5I3aEIXOfTbBE0xd', 'dfs', 'sdfdsdfs', '', 'dsdsf', 'SE', '21312', 'rajanbhola893058@gmail.com', '', '', '', '', '', '', '', '', '23423423', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 17:53:35', '2019-10-29 18:56:32', NULL, 0, 0, '', '', 'ds', '0.00', NULL, 'se', 0),
(229, 23, 'sYV4cArGcFJGdmbL1V4z5wR9TOv9F3ESoEHFf0Q0T8Zx0ZiYRTYUwo5PzpJdoLXl', 'Manesh', 'Dreamcrest', '', 'Stockholm', 'BE', '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 19:13:00', '2019-10-29 19:21:45', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(230, 23, 'kby3tSvZHJkhYZwlKsjT5xHCYepQZ4lQZPj1naV8M6iOXnxxFMh7Thzz6iYaXs1L', 'jhgsdfs', 'fsdgsd', '', 'dfxgsdfgdfs', 'DE', '43535', 'rajanbhola893058@gmail.com', '', '', '', '', '', '', '', '', '4253425', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-29 23:08:36', '2019-10-29 23:12:04', NULL, 0, 0, '', '', 'sdfds', '0.00', NULL, 'se', 0),
(231, 23, 'GcPpJxMvODm4fu2yj7wqq6IfzJMr1CkpP0huV9EQcV7NOj7tGLteoUNqNBl8W7BW', 'Manesh-Credit Card', 'Manila', '', 'Stockholm', 'BE', '12500', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 09:18:33', '2019-10-30 09:23:16', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(232, 23, 'ZBeRPkT9IxgxVopCU7xLPfkotVdjGBX2keqnaReGRXNXuzzOhQv21le6CCpPymwd', 'Manesh-Bancnet', 'South', '', 'Stockholm', 'BE', '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 09:26:31', '2019-10-30 09:28:03', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(233, 23, 'dTEVquA9HKcYhkKvhxS585EFUGq0W4FhZtYVfMF90ftB1F7ZevwyJt0uzIc9LlEV', 'Manesh -Bancnet', 'Malolos', '', 'Manila', 'BE', '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 09:47:46', '2019-10-30 09:49:21', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(234, 23, 'm5pWPPGRjHjMZ5gB0z30nrYDt6gCOcMrniftpr8S2FOXcCGj64RiEk2IQ8YkT8ib', 'Manesh', 'Dreamcrest', '', 'Manila', 'SE', '3000', 'manesh.bahuguna@gmail.com', '', 'Manesh', '', '', 'Manila', '3000', 'SE', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-30 02:55:56', '2019-10-30 09:54:07', '2019-10-30 09:55:56', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(235, 23, 'OWlXcB5fQWlzruZY8WoQ6B46dIUmw149rr4iab1CPbfN8GVb5vNszHfbx7pW5PFN', 'jhgdfds', 'yjutgrfd', '', 'jhgfdkjhgf', 'BE', '876543', 'fdfs@fdg.gfhfg', '', 'jhgdfds', '', '', 'jhgfdkjhgf', '876543', 'BE', '786543', '786543', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-30 06:01:57', '2019-10-30 12:04:19', '2019-10-30 13:01:57', NULL, 0, 0, '', '', 'dfvf', '0.00', NULL, 'se', 0),
(236, 23, 'Dq3Hcvc6gkoGOhC5qUvHEaUPwxZ0Hd3UhoJ3iyYa0Deb9tTuwoWdBfGEwkieuPz8', 'Manesh', 'South', '', 'Manila', 'BE', '12500', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 12:48:54', '2019-10-30 12:50:55', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(237, 23, 'YvB5uK2ahQ9LfPcOX6ZUzKighrHmtZ4K4mJhbyLAvAtS9cY4V0whQ0y03SUUsPIe', 'Manesh', 'South', '', 'Malolos', 'BE', '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 12:54:02', '2019-10-30 12:54:40', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(238, 23, 'MBRnZJ20OsRFr5ykw9Hwk7rgmkLDXOkI7GolBahoFxrXwGV8nIG5zHjf1dNklFWo', 'dthgfddddddddddddd', 'gfhdf', '', 'dfgdfgfd', 'DE', '43534', 'bholarajan3.rs@gmail.com', '', '', '', '', '', '', '', '', '435234', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 13:17:10', '2019-10-30 13:18:26', NULL, 0, 0, '', '', 'dfgd', '0.00', NULL, 'se', 0),
(239, 23, 'JI4QEHmEWt3zWpzOekJwHfjvd4Cu2LauIZk7Ux93teY00tOsgBqkLfbTfsvjRcnm', 'Manesh', 'Longos', '', 'Malolos', 'BE', '3000', 'maninactionscript@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 14:33:33', '2019-10-30 14:34:58', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(240, 23, 'ElY0RvxgqetA9TE2b1UfPB3xcd4YY4lmXsBHyLhuJzsvqhjlhzL5ad16XYEriAZ0', 'Manesh', 'South', '', 'longos', 'BE', '3000', 'maninactionscript@gmail.com', '', 'Manesh', '', '', 'longos', '3000', 'BE', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-30 07:38:52', '2019-10-30 14:37:00', '2019-10-30 14:38:52', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(241, 23, '1HyvySjOuuoq1j0xGIxAD1Lh2xz22IHvQLX0XLCEyFtQTTkcb4Zi8bw4JmS4V69i', 'fgdsfa', 'dfsgdsg', '', 'sdfsdfds', 'BE', '324235', 'bholarajan3.rs@gmail.com', '', '', '', '', '', '', '', '', '342353', NULL, 0, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 17:12:18', '2019-10-30 17:25:18', NULL, 0, 0, '', '', 'dsfsd', '0.00', NULL, 'se', 0),
(242, 23, 'gwmxDlkKLBFFij1LVKgUyido8S7HvYCj5YIBz8RxjOQ5LvmXbJc3cYY3Wod6KvSM', 'dsff', 'dsfsdfsdf', '', 'fsdfsd', 'BE', '332432', 'rajanbhola893058@gmail.com', '', '', '', '', '', '', '', '', '32432', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 17:33:24', '2019-10-30 17:34:21', NULL, 0, 0, '', '', 'ewrew', '0.00', NULL, 'se', 0),
(243, 23, 'sEibYP4E4doXHH2MpK1mfZ9HWUoYfHryjJT7CYYMM1QjdGvh0zmQ5ElBYSAi82Tx', 'Manesh', 'Dreamcrest', '', 'Malolos', 'BE', '3000', 'manesh.bahuguna@gmail.com', '', '', '', '', '', '', '', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-30 18:11:33', '2019-10-30 18:12:44', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(244, 23, 'kAHIrtAx7k38FviNMGl9MrHUVwC0z5bI7gcgfV5vBg4o6F05RfR2Z7QmhfqEzuJC', 'Manesh', 'South', '', 'Malolos', 'BE', '3000', 'manesh.bahuguna@gmail.com', '', 'Manesh', '', '', 'Malolos', '3000', 'BE', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-30 11:16:40', '2019-10-30 18:15:11', '2019-10-30 18:16:40', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(245, 23, 'B5SxY7t0u9VSEZT0HpsPjU4qziAuAxNo5SG5QcHOE8XqNj4AObj4JEGR9x8AtXXP', 'htgrfds', 'sdfdsdf', '', 'rewter', 'BE', '332432', 'bholarajan3.rs@gmail.com', '', '', '', '', '', '', '', '', '35342', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-10-30 11:44:12', '2019-10-30 18:42:59', '2019-10-30 18:44:12', NULL, 0, 0, '', '', 'zvcxzv', '0.00', NULL, 'se', 0),
(246, 23, 'LFxaql7b0YVXggG57qy1BXxwVqxhrarizl5NSlOHoquDeJKUeTWt7PM33sURvNFO', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-31 13:35:06', '2019-10-31 13:35:06', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(247, 23, 'r4RxR1wDUXYwPmJbdHhYOghS6WUIr7KdoaXBrlOBJedEfFLlrO7LHiQQ35eA91d3', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-31 13:36:18', '2019-10-31 13:36:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(248, 23, 'DDLOyEHAga2W2pdLxaH8fsccmd9ePJ2hULXKSFUCC5MkBBMJdwqaGzLLoYtwqWij', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-10-31 13:40:05', '2019-10-31 13:40:05', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(249, 23, '9rJXKUNdDOM47XtL4iSBqWgH9YmJwWXOrGtUer7ntlKNbMIEjfpCk4EahiAT28zt', 'Manesh', 'Dreamcrest', '', 'Malolos', 'SE', '3000', 'manesh.bahuguna@gmail.com', '', 'Manesh', '', '', 'Malolos', '3000', 'SE', '', '', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-11-06 00:32:00', '2019-11-06 07:31:00', '2019-11-06 07:32:00', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(250, 23, '0sv3JMvjXEnoiDXoIz8oAItNjbNomZpAu32T75DlM8D4TwI8QhvXBHRivrMNJBNy', 'sadad', 'asdasd', '', 'wrwerw', 'SE', '322423', 'bholarajan3.rs@gmail.com', '', 'sadad', '', '', 'wrwerw', '322423', 'SE', '32432423', '32432423', NULL, 3, 0, 'Stripe', 5, '', '', 1, NULL, '2019-11-06 10:09:40', '2019-11-06 17:04:32', '2019-11-06 17:09:40', NULL, 0, 0, '', '', 'sdfsd', '0.00', NULL, 'se', 0),
(251, 23, 'h2FaeHf3IkZ0eg0TzEL36G0AcGbN0Olm250eY6o2By30skCRQuykh2h5WOKNdbfe', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-11-06 18:12:48', '2019-11-06 18:12:48', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(252, 23, 'unDVTv3ShUeBr0mrm1wk4tr3c8rrWEbVJzj01oUWA9bf4U5mp77SzqJ8HUMnfx3a', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2019-11-12 07:54:51', '2019-11-12 07:54:51', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(253, 17, 'aQy14Qv85rHslCQDcj7Wd0T57QamVgNgGaGoR1gseEDfZExKayRatKaxwkaS8cIl', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 17, 1, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-02 01:24:00', '2020-03-02 01:24:00', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(254, 23, 'QRmXsn9mzV8IWkEM7ASGf7b6i7eYJp26WtF91EXCyLMmzsChuvFgLqlqKkzeCTMl', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-02 05:48:19', '2020-03-02 05:48:19', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(255, 23, 'W1nu1jLA825UVAMhVvPBeApFcljTj6xfPFq2qu2ea3rThmgEtmjZ3s7gILqZQXQK', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-02 05:49:01', '2020-03-02 05:49:01', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(256, 23, 'j2gI5Hzwe36dtQEGnm71jeMVTfuczutqnI4McJPJoh0QIqKwHubV6ckCqXKxCUWR', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-02 05:49:28', '2020-03-02 05:49:28', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(257, 23, 'yNzeNjRndNayuRqhWtkFN5hXOrJFDeUavrv2kjFU1wDD9mxvtcl817NwsURQ2aoy', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-02 05:49:54', '2020-03-02 05:49:54', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(258, 17, 'UcE7N3ZdMZDAIm3ye5n26EQNg1fFfSO2Xc8aNVA7OP0GVukLOvZYqa2TEvpikKqj', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 17, 1, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-02 05:54:46', '2020-03-02 05:54:46', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(259, 23, 'G2tdakyGfbDBlhFFTxZrCA7XRyF6iPRdNJa1noaA5VqQXdOHMaj2qUEZUbnipUmB', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 02:11:18', '2020-03-03 02:11:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(260, 23, 'mH8MHrCOKuVUIo9CTw4nXbAfP4qbbuGm9nWHUo95i02aSXBkepRdKDNAZmdIFwI3', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 02:21:10', '2020-03-03 02:21:10', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(261, 23, '7bbCTsl1B73ScVDtgLjnuTZVV3GUk7ptKjvSxhsGRwCbVydoMYBEl3QF2SHYORvq', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 02:24:18', '2020-03-03 02:24:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(262, 23, 'E4ik2gkZse30mLTWIUGXj81gsDKPC0SvKkMr2T4dHEW4x0r9Ag4DUFPaqjctlp5i', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 03:40:45', '2020-03-03 03:40:45', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(263, 23, 'Hn9dIFEJTQPhPwAT55ncTLrdlo6xMgxPIYlkoeYzDoGXk1Jyhii1nYOTL3R0hGm1', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 03:46:52', '2020-03-03 03:46:52', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(264, 23, 'shn8h9wqNaY57QMTTgAGNvR0e0HiY2YdmnvG2NuLtxLuzEuxmVgbRElKsVx7ge1m', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 04:04:12', '2020-03-03 04:04:12', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(265, 23, 'QUQFWcB9AyjkiHlXuuxMgNTUT69QpIRdSJJBBM3eLiwPhXfe2fpsRotBxiWQhNuf', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 04:26:14', '2020-03-03 04:26:14', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(266, 23, '7NFjXyTOEP4P0KyoRp6kCdT7oYV8DaVUcYLLM2zaXDMVM195nPRVoFZI3cEmLUYq', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 04:31:13', '2020-03-03 04:31:13', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(267, 23, 'uCf0aRughuJyeGHbUMMQxZfpBCylUMRpMf7bLISnwArN9ojk4wGIWQPFuqMgjtEi', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 04:31:54', '2020-03-03 04:31:54', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(268, 23, 'Ke1aVKttKTF6iFe8168DuViGj8w5Ma8t6ZVEbYux4BUAjM93MP03VfOd915NFXQ1', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 06:48:36', '2020-03-03 06:48:36', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(269, 23, 'dczxaqZ0ATJ6SdIneGL0Xu39b3Nmi8VAWByiAjIxpjA2NwdOQRIXal37BAEArbyV', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 06:49:46', '2020-03-03 06:49:46', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(270, 17, 'LCcuHQGCZ350H2ET1LYat5Froub8mTx2MqA1snZUXcs8gVlzUI5rGQrp6pn1rF3p', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 17, 3, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 06:54:45', '2020-03-03 06:54:45', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(271, 23, '3rQFd2Btwii5GIIzedN9BZMGuFRFsndNbNYklzn0mEhEm7p78QiHlvreJzoQow8T', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 07:06:17', '2020-03-03 07:06:17', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(272, 23, 'tpnTgzBR87YP8B9OwoXYKPlaONDe4N4EaV6a7xjh11XiRzxDxaRxMWDzepUZVrct', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 07:08:33', '2020-03-03 07:08:33', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(273, 23, 'FakOocZUgxPZdgdz8t1AFmzMkuY1dV83cZEpR19c3UXfPb8cc6jtC72sBGim5EFo', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 07:08:41', '2020-03-03 07:08:41', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(274, 23, 'wud3bavATz6A1o5hP8LTjQFSWOz9KELOa10OIuy1r1L70Cb2CcpgpSGZnOh9C6N2', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 07:09:59', '2020-03-03 07:09:59', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(275, 23, 'EP0BScZaPZIjSzfPopApSaYwEYIENkUd6j3bDcG456tzEjUTG6pxcAiy7kCnr8ZR', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 07:11:18', '2020-03-03 07:11:18', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(276, 23, 'CRlfjb9UCFL0c8La47bQ6UJ3cEyrJprSVcrNW08EjVqHgXYxTaPJ05VvFZUNcRrm', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 07:14:04', '2020-03-03 07:14:04', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(277, 23, 'yFVokWaN4zyBaCYV4HBoheC62OOw4385NWKcDBcjvoEdCaDDnu8sRdbBkWIA04uJ', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-03 23:46:14', '2020-03-03 23:46:14', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0),
(278, 23, 'AHW6y0JiB8lescqx7e5D2g0a8DTbzstCmhT08534xuTgr7MJo42RBNHvwFvyajCA', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', 0, '', '', 1, NULL, '0000-00-00 00:00:00', '2020-03-04 02:03:42', '2020-03-04 02:03:42', NULL, 0, 0, '', '', '', '0.00', NULL, 'se', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_invoice`
--

CREATE TABLE `booking_invoice` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discounted` tinyint(1) NOT NULL DEFAULT 0,
  `discounted_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discounted_reason` varchar(255) NOT NULL,
  `cancelled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product`
--

CREATE TABLE `booking_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `per_type_time_id` int(11) DEFAULT NULL,
  `booking_invoice_id` int(10) DEFAULT NULL,
  `startDateTime` datetime NOT NULL,
  `endDateTime` datetime NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `persons` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `klarna_product_status` decimal(8,2) NOT NULL DEFAULT 1.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking_product`
--

INSERT INTO `booking_product` (`id`, `booking_id`, `product_id`, `price`, `per_type_time_id`, `booking_invoice_id`, `startDateTime`, `endDateTime`, `quantity`, `persons`, `klarna_product_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 124, '1.00', NULL, NULL, '2019-04-24 04:00:00', '2019-04-24 05:00:00', '1.00', NULL, '1.00', '2019-04-24 00:05:19', '2019-04-24 00:05:19', NULL),
(3, 2, 124, '1.00', NULL, NULL, '2019-04-27 04:00:00', '2019-04-27 05:00:00', '1.00', NULL, '1.00', '2019-04-24 00:20:39', '2019-04-26 22:44:35', '2019-04-26 22:44:35'),
(4, 3, 124, '1.00', NULL, NULL, '2019-04-26 04:00:00', '2019-04-26 05:00:00', '1.00', NULL, '1.00', '2019-04-24 01:10:19', '2019-04-26 07:38:13', '2019-04-26 07:38:13'),
(5, 4, 124, '1.00', NULL, NULL, '2019-04-28 04:00:00', '2019-04-28 05:00:00', '1.00', NULL, '1.00', '2019-04-24 03:12:54', '2019-04-26 22:40:36', '2019-04-26 22:40:36'),
(11, 5, 124, '1.00', NULL, NULL, '2019-05-02 04:00:00', '2019-05-02 05:00:00', '1.00', NULL, '1.00', '2019-04-24 03:55:40', '2019-04-24 03:55:40', NULL),
(12, 6, 124, '1.00', NULL, NULL, '2019-04-03 04:00:00', '2019-04-03 05:00:00', '1.00', NULL, '1.00', '2019-04-24 05:00:05', '2019-04-26 07:59:17', '2019-04-26 07:59:17'),
(13, 7, 125, '1.00', NULL, NULL, '2019-04-24 03:00:00', '2019-04-24 04:00:00', '1.00', NULL, '1.00', '2019-04-24 05:11:11', '2019-04-24 05:11:11', NULL),
(14, 8, 125, '1.00', NULL, NULL, '2019-04-24 03:00:00', '2019-04-24 04:00:00', '1.00', NULL, '1.00', '2019-04-24 05:15:31', '2019-04-24 05:15:31', NULL),
(15, 9, 125, '1.00', NULL, NULL, '2019-04-24 03:00:00', '2019-04-24 04:00:00', '1.00', NULL, '1.00', '2019-04-24 05:18:07', '2019-04-24 05:18:07', NULL),
(16, 10, 125, '1.00', NULL, NULL, '2019-04-16 03:00:00', '2019-04-16 04:00:00', '1.00', NULL, '1.00', '2019-04-24 05:21:50', '2019-04-24 05:21:50', NULL),
(18, 11, 127, '1.00', NULL, NULL, '2019-04-24 09:00:00', '2019-04-24 10:00:00', '1.00', NULL, '1.00', '2019-04-24 06:13:02', '2019-04-24 06:13:02', NULL),
(19, 12, 124, '1.00', NULL, NULL, '2019-04-25 04:00:00', '2019-04-25 05:00:00', '1.00', NULL, '1.00', '2019-04-24 22:32:23', '2019-04-26 08:03:56', '2019-04-26 08:03:56'),
(22, 13, 125, '1.00', NULL, NULL, '2019-06-14 03:00:00', '2019-06-14 04:00:00', '1.00', NULL, '1.00', '2019-04-24 23:10:27', '2019-04-24 23:10:27', NULL),
(23, 14, 125, '1.00', NULL, NULL, '2019-06-15 03:00:00', '2019-06-15 04:00:00', '1.00', NULL, '1.00', '2019-04-24 23:15:28', '2019-04-24 23:15:28', NULL),
(24, 15, 125, '1.00', NULL, NULL, '2019-04-25 03:00:00', '2019-04-25 04:00:00', '1.00', NULL, '1.00', '2019-04-24 23:26:52', '2019-04-24 23:26:52', NULL),
(25, 16, 125, '1.00', NULL, NULL, '2019-04-09 03:00:00', '2019-04-09 04:00:00', '1.00', NULL, '1.00', '2019-04-24 23:43:50', '2019-04-24 23:43:50', NULL),
(26, 17, 125, '1.00', NULL, NULL, '2019-02-13 03:00:00', '2019-02-13 04:00:00', '1.00', NULL, '1.00', '2019-04-24 23:55:45', '2019-04-24 23:55:45', NULL),
(27, 18, 125, '1.00', NULL, NULL, '2019-02-06 03:00:00', '2019-02-06 04:00:00', '1.00', NULL, '1.00', '2019-04-24 23:57:00', '2019-04-24 23:57:00', NULL),
(28, 19, 125, '1.00', NULL, NULL, '2019-04-10 03:00:00', '2019-04-10 04:00:00', '1.00', NULL, '1.00', '2019-04-25 00:04:57', '2019-04-25 00:04:57', NULL),
(29, 20, 125, '1.00', NULL, NULL, '2019-08-30 03:00:00', '2019-08-30 04:00:00', '1.00', NULL, '1.00', '2019-04-25 00:11:48', '2019-04-25 00:11:48', NULL),
(30, 21, 125, '1.00', NULL, NULL, '2019-04-18 03:00:00', '2019-04-18 04:00:00', '1.00', NULL, '1.00', '2019-04-25 00:13:00', '2019-04-25 00:13:00', NULL),
(31, 22, 125, '1.00', NULL, NULL, '2019-04-04 03:00:00', '2019-04-04 04:00:00', '1.00', NULL, '1.00', '2019-04-25 00:15:12', '2019-04-25 00:15:12', NULL),
(32, 23, 124, '1.00', NULL, NULL, '2019-03-06 04:00:00', '2019-03-06 05:00:00', '1.00', NULL, '1.00', '2019-04-25 05:00:32', '2019-04-26 08:01:03', '2019-04-26 08:01:03'),
(33, 24, 124, '1.00', NULL, NULL, '2019-02-26 04:00:00', '2019-02-26 05:00:00', '1.00', NULL, '1.00', '2019-04-25 05:26:18', '2019-04-26 08:00:06', '2019-04-26 08:00:06'),
(34, 25, 129, '2.00', NULL, NULL, '2019-04-25 07:00:00', '2019-04-25 08:00:00', '1.00', NULL, '1.00', '2019-04-25 05:31:22', '2019-04-25 05:31:22', NULL),
(36, 26, 130, '24.00', 2, NULL, '2019-04-26 10:00:00', '2019-04-27 10:00:00', '1.00', NULL, '1.00', '2019-04-26 05:01:25', '2019-04-26 05:01:25', NULL),
(37, 27, 130, '24.00', 2, NULL, '2019-04-26 10:00:00', '2019-04-27 10:00:00', '1.00', NULL, '1.00', '2019-04-26 05:02:52', '2019-04-26 05:02:52', NULL),
(40, 28, 124, '1.00', NULL, NULL, '2019-06-07 04:00:00', '2019-06-07 05:00:00', '1.00', NULL, '1.00', '2019-04-26 05:05:10', '2019-04-26 07:32:56', '2019-04-26 07:32:56'),
(42, 29, 124, '1.00', NULL, NULL, '2018-11-14 04:00:00', '2018-11-14 05:00:00', '1.00', NULL, '1.00', '2019-04-26 23:52:54', '2019-04-26 23:52:54', NULL),
(43, 30, 124, '1.00', NULL, NULL, '2019-04-01 04:00:00', '2019-04-01 05:00:00', '1.00', NULL, '1.00', '2019-04-27 00:37:41', '2019-04-27 00:37:41', NULL),
(44, 31, 124, '1.00', NULL, NULL, '2019-07-19 04:00:00', '2019-07-19 05:00:00', '1.00', NULL, '1.00', '2019-04-27 00:39:51', '2019-04-27 00:39:51', NULL),
(45, 32, 124, '1.00', NULL, NULL, '2019-08-16 04:00:00', '2019-08-16 05:00:00', '1.00', NULL, '1.00', '2019-04-27 00:43:34', '2019-04-27 00:43:34', NULL),
(47, 33, 124, '1.00', NULL, NULL, '2019-02-13 04:00:00', '2019-02-13 05:00:00', '1.00', NULL, '1.00', '2019-04-27 00:57:22', '2019-04-27 00:57:22', NULL),
(48, 34, 124, '1.00', NULL, NULL, '2019-06-06 04:00:00', '2019-06-06 05:00:00', '1.00', NULL, '1.00', '2019-04-27 01:00:39', '2019-04-27 01:00:39', NULL),
(49, 35, 124, '1.00', NULL, NULL, '2019-02-11 04:00:00', '2019-02-11 05:00:00', '1.00', NULL, '1.00', '2019-04-27 01:04:56', '2019-04-27 01:04:56', NULL),
(50, 36, 124, '1.00', NULL, NULL, '2019-04-12 04:00:00', '2019-04-12 05:00:00', '1.00', NULL, '1.00', '2019-04-27 01:11:24', '2019-04-27 01:11:24', NULL),
(52, 37, 124, '1.00', NULL, NULL, '2019-02-25 04:00:00', '2019-02-25 05:00:00', '1.00', NULL, '1.00', '2019-04-27 01:35:26', '2019-04-27 01:35:26', NULL),
(53, 38, 124, '1.00', NULL, NULL, '2019-02-19 04:00:00', '2019-02-19 05:00:00', '1.00', NULL, '1.00', '2019-04-27 01:38:32', '2019-04-27 01:38:32', NULL),
(54, 39, 124, '1.00', NULL, NULL, '2019-04-18 04:00:00', '2019-04-18 05:00:00', '1.00', NULL, '1.00', '2019-04-27 01:51:20', '2019-04-27 01:51:20', NULL),
(55, 40, 124, '1.00', NULL, NULL, '2019-04-29 04:00:00', '2019-04-29 05:00:00', '1.00', NULL, '1.00', '2019-04-27 02:02:30', '2019-04-27 02:02:30', NULL),
(56, 41, 124, '1.00', NULL, NULL, '2019-06-14 04:00:00', '2019-06-14 05:00:00', '1.00', NULL, '1.00', '2019-04-27 02:06:48', '2019-04-27 02:06:48', NULL),
(57, 42, 124, '1.00', NULL, NULL, '2019-05-09 04:00:00', '2019-05-09 05:00:00', '1.00', NULL, '1.00', '2019-04-27 02:08:00', '2019-04-27 02:08:00', NULL),
(58, 43, 124, '1.00', NULL, NULL, '2019-05-11 04:00:00', '2019-05-11 05:00:00', '1.00', NULL, '1.00', '2019-04-27 02:12:00', '2019-04-27 02:12:00', NULL),
(59, 44, 124, '1.00', NULL, NULL, '2019-06-13 04:00:00', '2019-06-13 05:00:00', '1.00', NULL, '1.00', '2019-04-27 05:45:50', '2019-04-27 05:45:50', NULL),
(60, 45, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 00:30:02', '2019-04-29 00:30:02', NULL),
(61, 46, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 01:49:17', '2019-04-29 01:49:17', NULL),
(62, 47, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 01:56:29', '2019-04-29 01:56:29', NULL),
(65, 48, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 02:17:37', '2019-04-29 02:17:37', NULL),
(66, 49, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 02:24:04', '2019-04-29 02:24:04', NULL),
(67, 50, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 02:25:12', '2019-04-29 02:25:12', NULL),
(68, 51, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 02:28:35', '2019-04-29 02:28:35', NULL),
(69, 52, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 05:44:43', '2019-04-29 05:44:43', NULL),
(70, 53, 130, '24.00', 2, NULL, '2019-04-29 10:00:00', '2019-04-30 10:00:00', '1.00', NULL, '1.00', '2019-04-29 06:04:57', '2019-04-29 06:04:57', NULL),
(72, 54, 130, '24.00', 2, NULL, '2019-04-16 10:00:00', '2019-04-17 10:00:00', '1.00', NULL, '1.00', '2019-04-29 08:29:26', '2019-04-29 08:29:26', NULL),
(74, 55, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-29 22:59:12', '2019-04-29 22:59:12', NULL),
(75, 56, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-29 23:03:33', '2019-04-29 23:03:33', NULL),
(76, 57, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 00:09:54', '2019-04-30 00:09:54', NULL),
(77, 58, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 00:38:48', '2019-04-30 00:38:48', NULL),
(78, 59, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 01:19:27', '2019-04-30 01:19:27', NULL),
(79, 60, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 02:44:25', '2019-04-30 02:44:25', NULL),
(80, 61, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 03:53:22', '2019-04-30 03:53:22', NULL),
(81, 62, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 03:57:04', '2019-04-30 03:57:04', NULL),
(82, 63, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 06:08:05', '2019-04-30 06:08:05', NULL),
(83, 64, 130, '24.00', 2, NULL, '2019-04-30 10:00:00', '2019-05-01 10:00:00', '1.00', NULL, '1.00', '2019-04-30 06:12:29', '2019-04-30 06:12:29', NULL),
(84, 65, 130, '24.00', 2, NULL, '2019-05-01 10:00:00', '2019-05-02 10:00:00', '1.00', NULL, '1.00', '2019-04-30 23:13:24', '2019-04-30 23:13:24', NULL),
(85, 66, 131, '5.00', NULL, NULL, '2019-05-25 05:00:00', '2019-05-25 06:00:00', '1.00', NULL, '1.00', '2019-05-25 08:30:01', '2019-05-25 08:30:01', NULL),
(86, 67, 131, '5.00', NULL, NULL, '2019-05-31 05:00:00', '2019-05-31 06:00:00', '1.00', NULL, '1.00', '2019-05-31 03:46:08', '2019-05-31 03:46:08', NULL),
(89, 70, 132, '7.00', NULL, NULL, '2019-06-04 20:00:00', '2019-06-04 21:00:00', '1.00', NULL, '1.00', '2019-06-04 20:04:44', '2019-06-04 20:04:44', NULL),
(90, 71, 131, '5.00', NULL, NULL, '2019-06-04 05:00:00', '2019-06-04 06:00:00', '1.00', NULL, '1.00', '2019-06-04 20:05:35', '2019-06-04 20:05:35', NULL),
(92, 72, 132, '7.00', NULL, NULL, '2019-06-04 05:00:00', '2019-06-04 06:00:00', '1.00', NULL, '1.00', '2019-06-04 20:07:15', '2019-06-04 20:07:15', NULL),
(93, 73, 131, '5.00', NULL, NULL, '2019-06-04 05:00:00', '2019-06-04 06:00:00', '1.00', NULL, '1.00', '2019-06-04 20:11:36', '2019-06-04 20:11:36', NULL),
(94, 74, 132, '7.00', NULL, NULL, '2019-06-04 05:00:00', '2019-06-04 06:00:00', '1.00', NULL, '1.00', '2019-06-04 20:30:22', '2019-06-04 20:30:22', NULL),
(95, 75, 132, '7.00', NULL, NULL, '2019-06-04 05:00:00', '2019-06-04 06:00:00', '1.00', NULL, '1.00', '2019-06-04 20:34:10', '2019-06-04 20:34:10', NULL),
(96, 76, 127, '1.00', NULL, NULL, '2019-06-05 09:00:00', '2019-06-05 10:00:00', '1.00', NULL, '1.00', '2019-06-05 07:51:44', '2019-06-05 07:51:44', NULL),
(97, 77, 142, '123.00', NULL, NULL, '2019-06-06 11:00:00', '2019-06-06 12:00:00', '1.00', NULL, '1.00', '2019-06-06 18:19:40', '2019-06-06 18:19:40', NULL),
(98, 78, 127, '150.00', 1, NULL, '2019-06-10 17:00:00', '2019-06-10 21:00:00', '1.00', NULL, '1.00', '2019-06-06 18:55:15', '2019-06-06 18:55:15', NULL),
(102, 80, 143, '5.00', NULL, NULL, '2019-06-07 06:00:00', '2019-06-07 07:00:00', '1.00', NULL, '1.00', '2019-06-07 12:53:18', '2019-06-07 12:53:18', NULL),
(103, 81, 143, '5.00', NULL, NULL, '2019-06-07 10:00:00', '2019-06-07 11:00:00', '1.00', NULL, '1.00', '2019-06-07 12:55:02', '2019-06-07 12:55:02', NULL),
(104, 82, 143, '5.00', NULL, NULL, '2019-06-06 10:00:00', '2019-06-06 11:00:00', '1.00', NULL, '1.00', '2019-06-07 16:59:17', '2019-06-07 16:59:17', NULL),
(105, 83, 127, '160.00', 1, NULL, '2019-06-15 16:00:00', '2019-06-15 20:00:00', '1.00', NULL, '1.00', '2019-06-08 12:53:06', '2019-06-08 12:53:06', NULL),
(107, 84, 143, '5.00', NULL, NULL, '2019-06-08 11:00:00', '2019-06-08 12:00:00', '1.00', NULL, '1.00', '2019-06-08 20:28:43', '2019-06-08 20:28:43', NULL),
(108, 85, 144, '8.00', NULL, NULL, '2019-06-08 10:00:00', '2019-06-08 11:00:00', '1.00', NULL, '1.00', '2019-06-08 20:39:21', '2019-06-08 20:39:21', NULL),
(109, 86, 127, '160.00', 1, NULL, '2019-06-15 16:00:00', '2019-06-15 20:00:00', '1.00', NULL, '1.00', '2019-06-09 09:10:28', '2019-06-09 09:10:28', NULL),
(110, 87, 127, '160.00', 1, NULL, '2019-06-15 17:00:00', '2019-06-15 21:00:00', '1.00', NULL, '1.00', '2019-06-10 08:00:56', '2019-06-10 08:00:56', NULL),
(112, 88, 127, '150.00', 1, NULL, '2019-06-20 17:00:00', '2019-06-20 21:00:00', '1.00', NULL, '1.00', '2019-06-10 08:43:29', '2019-06-10 08:43:29', NULL),
(113, 89, 145, '10.00', NULL, NULL, '2019-06-10 10:00:00', '2019-06-10 11:00:00', '1.00', NULL, '1.00', '2019-06-10 12:16:48', '2019-06-10 12:16:48', NULL),
(114, 90, 146, '10.00', NULL, NULL, '2019-06-10 13:00:00', '2019-06-10 14:00:00', '1.00', NULL, '1.00', '2019-06-10 12:24:31', '2019-06-10 12:24:31', NULL),
(115, 91, 145, '10.00', NULL, NULL, '2019-06-10 07:00:00', '2019-06-10 08:00:00', '1.00', NULL, '1.00', '2019-06-10 14:36:08', '2019-06-10 14:36:08', NULL),
(116, 93, 147, '30.00', NULL, NULL, '2019-06-10 07:00:00', '2019-06-10 08:00:00', '1.00', NULL, '1.00', '2019-06-10 14:41:46', '2019-06-10 14:41:46', NULL),
(117, 94, 147, '30.00', NULL, NULL, '2019-06-10 07:00:00', '2019-06-10 08:00:00', '1.00', NULL, '1.00', '2019-06-10 14:43:20', '2019-06-10 14:43:20', NULL),
(118, 95, 147, '30.00', NULL, NULL, '2019-06-10 07:00:00', '2019-06-10 08:00:00', '1.00', NULL, '1.00', '2019-06-10 18:55:45', '2019-06-10 18:55:45', NULL),
(120, 97, 147, '30.00', NULL, NULL, '2019-06-13 07:00:00', '2019-06-13 08:00:00', '1.00', NULL, '1.00', '2019-06-12 12:06:11', '2019-06-13 20:33:18', '2019-06-13 20:33:18'),
(122, 98, 147, '90.00', NULL, NULL, '2019-08-10 07:00:00', '2019-08-10 08:00:00', '3.00', NULL, '1.00', '2019-06-13 14:25:23', '2019-06-13 14:25:23', NULL),
(134, 100, 147, '40.00', 1, NULL, '2019-06-23 23:00:00', '2019-06-25 08:00:00', '1.00', NULL, '1.00', '2019-06-13 20:16:04', '2019-06-13 20:16:04', NULL),
(135, 102, 147, '20.00', 1, NULL, '2019-06-30 07:00:00', '2019-06-30 10:00:00', '1.00', NULL, '1.00', '2019-06-13 20:26:10', '2019-06-13 20:26:10', NULL),
(136, 103, 147, '40.00', 1, NULL, '2019-06-28 13:00:00', '2019-06-30 08:00:00', '1.00', NULL, '1.00', '2019-06-13 20:28:21', '2019-06-13 20:28:21', NULL),
(137, 104, 147, '30.00', 1, NULL, '2019-06-14 13:00:00', '2019-06-14 17:00:00', '1.00', NULL, '1.00', '2019-06-13 20:29:10', '2019-06-13 20:29:10', NULL),
(138, 105, 147, '40.00', 1, NULL, '2019-06-21 13:00:00', '2019-06-22 15:00:00', '1.00', NULL, '1.00', '2019-06-13 20:29:52', '2019-06-13 20:33:24', '2019-06-13 20:33:24'),
(139, 106, 147, '40.00', 1, NULL, '2019-06-22 13:00:00', '2019-06-24 08:00:00', '1.00', NULL, '1.00', '2019-06-13 20:30:31', '2019-06-13 20:30:31', NULL),
(140, 107, 147, '100.00', 1, NULL, '2019-06-25 13:00:00', '2019-06-30 13:00:00', '1.00', NULL, '1.00', '2019-06-13 20:31:31', '2019-06-13 20:31:31', NULL),
(141, 108, 147, '30.00', NULL, NULL, '2019-06-28 18:00:00', '2019-06-29 08:00:00', '1.00', NULL, '1.00', '2019-06-13 20:32:44', '2019-06-13 20:33:11', '2019-06-13 20:33:11'),
(142, 109, 127, '150.00', 1, NULL, '2019-06-20 17:00:00', '2019-06-21 09:00:00', '1.00', NULL, '1.00', '2019-06-14 08:49:19', '2019-06-14 08:49:19', NULL),
(143, 110, 127, '150.00', 1, NULL, '2019-06-20 16:00:00', '2019-06-21 09:00:00', '1.00', NULL, '1.00', '2019-06-14 08:50:20', '2019-06-14 08:50:20', NULL),
(144, 111, 127, '400.00', 1, NULL, '2019-06-22 14:00:00', '2019-06-23 14:00:00', '2.00', NULL, '1.00', '2019-06-14 08:52:40', '2019-06-14 08:52:40', NULL),
(145, 112, 127, '150.00', 1, NULL, '2019-06-25 09:00:00', '2019-06-26 09:00:00', '1.00', NULL, '1.00', '2019-06-14 08:59:12', '2019-06-14 08:59:12', NULL),
(146, 113, 127, '2400.00', NULL, NULL, '2019-06-26 16:00:00', '2019-06-26 17:00:00', '1.00', NULL, '1.00', '2019-06-14 09:02:16', '2019-06-14 09:02:16', NULL),
(147, 114, 127, '2400.00', NULL, NULL, '2019-06-28 17:00:00', '2019-06-29 09:00:00', '1.00', NULL, '1.00', '2019-06-14 09:10:30', '2019-06-14 09:10:30', NULL),
(148, 115, 127, '200.00', 1, NULL, '2019-06-30 17:00:00', '2019-07-01 09:00:00', '1.00', NULL, '1.00', '2019-06-14 09:12:33', '2019-06-14 09:12:33', NULL),
(150, 116, 127, '150.00', 1, NULL, '2019-06-18 17:00:00', '2019-06-19 13:00:00', '1.00', NULL, '1.00', '2019-06-14 09:16:23', '2019-06-14 09:16:23', NULL),
(151, 117, 147, '60.00', 1, NULL, '2019-06-25 18:00:00', '2019-06-27 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:37:26', '2019-06-15 19:37:26', NULL),
(152, 118, 147, '60.00', 1, NULL, '2019-06-25 18:00:00', '2019-06-27 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:40:18', '2019-06-15 19:40:18', NULL),
(153, 119, 147, '60.00', 1, NULL, '2019-06-25 18:00:00', '2019-06-27 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:41:42', '2019-06-15 19:41:42', NULL),
(154, 120, 147, '120.00', 1, NULL, '2019-06-27 18:00:00', '2019-07-01 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:54:37', '2019-06-15 19:54:37', NULL),
(155, 121, 147, '180.00', 1, NULL, '2019-06-25 18:00:00', '2019-07-01 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:55:28', '2019-06-15 19:55:28', NULL),
(156, 122, 147, '180.00', 1, NULL, '2019-06-25 18:00:00', '2019-07-01 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:56:22', '2019-06-15 19:56:22', NULL),
(157, 123, 147, '30.00', NULL, NULL, '2019-06-26 07:00:00', '2019-07-01 09:00:00', '1.00', NULL, '1.00', '2019-06-15 19:57:40', '2019-06-15 19:57:40', NULL),
(160, 126, 147, '60.00', 1, NULL, '2019-06-17 18:00:00', '2019-06-19 08:00:00', '1.00', NULL, '1.00', '2019-06-15 20:22:01', '2019-06-15 20:22:01', NULL),
(163, 129, 147, '60.00', 1, NULL, '2019-06-17 18:00:00', '2019-06-19 08:00:00', '1.00', NULL, '1.00', '2019-06-15 20:26:17', '2019-06-15 20:26:17', NULL),
(164, 130, 147, '60.00', 1, NULL, '2019-06-17 18:00:00', '2019-06-19 10:00:00', '1.00', NULL, '1.00', '2019-06-15 20:26:51', '2019-06-15 20:26:51', NULL),
(165, 131, 147, '120.00', 1, NULL, '2019-06-17 18:00:00', '2019-06-21 08:00:00', '1.00', NULL, '1.00', '2019-06-15 20:27:18', '2019-06-15 20:27:18', NULL),
(166, 132, 147, '20.00', 1, NULL, '2019-06-15 18:00:00', '2019-06-16 08:00:00', '1.00', NULL, '1.00', '2019-06-15 20:29:20', '2019-06-15 20:29:20', NULL),
(167, 133, 147, '20.00', 1, NULL, '2019-06-15 16:00:00', '2019-06-16 08:00:00', '1.00', NULL, '1.00', '2019-06-15 20:30:48', '2019-06-15 20:30:48', NULL),
(168, 134, 147, '40.00', 1, NULL, '2019-06-15 16:00:00', '2019-06-17 08:00:00', '1.00', NULL, '1.00', '2019-06-15 20:31:08', '2019-06-15 20:31:08', NULL),
(169, 135, 127, '450.00', 1, NULL, '2019-06-17 16:00:00', '2019-06-20 09:00:00', '1.00', NULL, '1.00', '2019-06-16 19:02:06', '2019-06-16 19:02:06', NULL),
(170, 136, 127, '400.00', 1, NULL, '2019-06-21 15:00:00', '2019-06-23 15:00:00', '1.00', NULL, '1.00', '2019-06-16 19:04:46', '2019-06-16 19:04:46', NULL),
(171, 137, 127, '2400.00', NULL, NULL, '2019-06-17 17:00:00', '2019-06-20 09:00:00', '1.00', NULL, '1.00', '2019-06-16 19:08:09', '2019-06-16 19:08:09', NULL),
(172, 138, 147, '60.00', 1, NULL, '2019-06-24 18:00:00', '2019-06-26 08:00:00', '1.00', NULL, '1.00', '2019-06-17 18:19:38', '2019-06-17 18:19:38', NULL),
(173, 139, 147, '20.00', 1, NULL, '2019-08-16 07:00:00', '2019-08-16 08:00:00', '1.00', NULL, '1.00', '2019-08-16 19:32:43', '2019-08-16 19:32:43', NULL),
(174, 139, 149, '10.00', NULL, NULL, '2019-08-16 00:00:00', '2019-08-16 08:00:00', '1.00', NULL, '1.00', '2019-08-16 20:32:45', '2019-08-16 20:32:45', NULL),
(175, 140, 149, '10.00', NULL, NULL, '2019-08-17 00:00:00', '2019-08-17 08:00:00', '1.00', NULL, '1.00', '2019-08-17 11:00:45', '2019-08-17 11:00:45', NULL),
(176, 141, 127, '2400.00', NULL, NULL, '2019-08-17 10:00:00', '2019-08-17 11:00:00', '1.00', NULL, '1.00', '2019-08-17 11:35:26', '2019-08-17 11:35:26', NULL),
(177, 142, 127, '2400.00', NULL, NULL, '2019-08-17 09:00:00', '2019-08-17 10:00:00', '1.00', NULL, '1.00', '2019-08-17 11:45:06', '2019-08-17 11:45:06', NULL),
(178, 143, 127, '2400.00', NULL, NULL, '2019-08-19 09:00:00', '2019-08-19 10:00:00', '1.00', NULL, '1.00', '2019-08-19 14:41:56', '2019-08-19 14:41:56', NULL),
(179, 144, 127, '2400.00', NULL, NULL, '2019-08-29 09:00:00', '2019-08-29 10:00:00', '1.00', NULL, '1.00', '2019-08-29 10:30:15', '2019-08-29 10:30:15', NULL),
(180, 145, 149, '10.00', NULL, NULL, '2019-08-29 00:00:00', '2019-08-29 08:00:00', '1.00', NULL, '1.00', '2019-08-29 16:18:43', '2019-08-29 16:18:43', NULL),
(181, 146, 127, '2400.00', NULL, NULL, '2019-08-30 09:00:00', '2019-08-30 10:00:00', '1.00', NULL, '1.00', '2019-08-30 13:58:47', '2019-08-30 13:58:47', NULL),
(182, 147, 127, '2400.00', NULL, NULL, '2019-08-30 09:00:00', '2019-08-30 10:00:00', '1.00', NULL, '1.00', '2019-08-30 14:01:16', '2019-08-30 14:01:16', NULL),
(183, 148, 127, '2400.00', NULL, NULL, '2019-09-10 09:00:00', '2019-09-10 10:00:00', '1.00', NULL, '1.00', '2019-08-30 14:02:28', '2019-08-30 14:02:28', NULL),
(184, 149, 127, '2400.00', NULL, NULL, '2019-09-15 09:00:00', '2019-09-15 10:00:00', '1.00', NULL, '1.00', '2019-08-30 14:07:19', '2019-08-30 14:07:19', NULL),
(185, 150, 127, '2400.00', NULL, NULL, '2019-09-10 13:00:00', '2019-09-10 14:00:00', '1.00', NULL, '1.00', '2019-08-30 14:12:35', '2019-08-30 14:12:35', NULL),
(186, 151, 127, '2400.00', NULL, NULL, '2019-08-30 09:00:00', '2019-08-30 10:00:00', '1.00', NULL, '1.00', '2019-08-30 14:16:34', '2019-08-30 14:16:34', NULL),
(187, 152, 127, '2400.00', NULL, NULL, '2019-08-30 09:00:00', '2019-08-30 10:00:00', '1.00', NULL, '1.00', '2019-08-30 14:18:25', '2019-08-30 14:18:25', NULL),
(188, 153, 127, '2400.00', NULL, NULL, '2019-08-30 09:00:00', '2019-08-30 10:00:00', '1.00', NULL, '1.00', '2019-08-30 15:01:37', '2019-08-30 15:01:37', NULL),
(189, 154, 127, '2400.00', NULL, NULL, '2019-08-30 13:00:00', '2019-08-30 14:00:00', '1.00', NULL, '1.00', '2019-08-30 17:39:13', '2019-08-30 17:39:13', NULL),
(190, 155, 149, '10.00', NULL, NULL, '2019-08-31 00:00:00', '2019-08-31 08:00:00', '1.00', NULL, '1.00', '2019-08-31 11:38:42', '2019-08-31 11:38:42', NULL),
(191, 156, 127, '4800.00', NULL, NULL, '2019-09-05 11:00:00', '2019-09-05 12:00:00', '2.00', NULL, '1.00', '2019-08-31 15:48:36', '2019-08-31 15:48:36', NULL),
(192, 157, 127, '4800.00', NULL, NULL, '2019-09-05 11:00:00', '2019-09-05 12:00:00', '2.00', NULL, '1.00', '2019-08-31 15:49:08', '2019-08-31 15:49:08', NULL),
(194, 159, 127, '2400.00', NULL, NULL, '2019-08-31 13:00:00', '2019-08-31 14:00:00', '1.00', NULL, '1.00', '2019-08-31 16:03:41', '2019-08-31 16:03:41', NULL),
(195, 158, 127, '4800.00', NULL, NULL, '2019-09-05 09:00:00', '2019-09-05 10:00:00', '2.00', NULL, '1.00', '2019-08-31 16:04:32', '2019-08-31 16:04:32', NULL),
(196, 160, 127, '4800.00', NULL, NULL, '2019-08-31 09:00:00', '2019-08-31 10:00:00', '2.00', NULL, '1.00', '2019-08-31 16:05:57', '2019-08-31 16:05:57', NULL),
(197, 161, 127, '2400.00', NULL, NULL, '2019-08-31 09:00:00', '2019-08-31 10:00:00', '1.00', NULL, '1.00', '2019-08-31 16:08:03', '2019-08-31 16:08:03', NULL),
(198, 162, 127, '4800.00', NULL, NULL, '2019-09-05 09:00:00', '2019-09-05 10:00:00', '2.00', NULL, '1.00', '2019-08-31 16:09:03', '2019-08-31 16:09:03', NULL),
(199, 163, 127, '2400.00', NULL, NULL, '2019-08-31 09:00:00', '2019-08-31 10:00:00', '1.00', NULL, '1.00', '2019-08-31 16:09:52', '2019-08-31 16:09:52', NULL),
(200, 164, 127, '4800.00', NULL, NULL, '2019-09-05 10:00:00', '2019-09-05 11:00:00', '2.00', NULL, '1.00', '2019-08-31 16:09:55', '2019-08-31 16:09:55', NULL),
(201, 165, 127, '2400.00', NULL, NULL, '2019-09-02 09:00:00', '2019-09-02 10:00:00', '1.00', NULL, '1.00', '2019-09-01 15:52:36', '2019-09-01 15:52:36', NULL),
(202, 166, 127, '2400.00', NULL, NULL, '2019-09-01 09:00:00', '2019-09-01 10:00:00', '1.00', NULL, '1.00', '2019-09-01 16:27:25', '2019-09-01 16:27:25', NULL),
(203, 167, 127, '2400.00', NULL, NULL, '2019-09-01 09:00:00', '2019-09-01 10:00:00', '1.00', NULL, '1.00', '2019-09-01 16:33:26', '2019-09-01 16:33:26', NULL),
(204, 168, 127, '2400.00', NULL, NULL, '2019-09-02 09:00:00', '2019-09-02 10:00:00', '1.00', NULL, '1.00', '2019-09-02 11:26:41', '2019-09-02 11:26:41', NULL),
(205, 169, 149, '10.00', NULL, NULL, '2019-09-02 00:00:00', '2019-09-02 08:00:00', '1.00', NULL, '1.00', '2019-09-02 13:07:24', '2019-09-02 13:07:24', NULL),
(206, 170, 149, '10.00', NULL, NULL, '2019-09-02 00:00:00', '2019-09-02 08:00:00', '1.00', NULL, '1.00', '2019-09-02 13:23:40', '2019-09-02 13:23:40', NULL),
(207, 171, 149, '10.00', NULL, NULL, '2019-09-02 00:00:00', '2019-09-02 08:00:00', '1.00', NULL, '1.00', '2019-09-02 13:27:58', '2019-09-02 13:27:58', NULL),
(208, 172, 127, '2400.00', NULL, NULL, '2019-09-02 10:00:00', '2019-09-02 11:00:00', '1.00', NULL, '1.00', '2019-09-02 13:57:21', '2019-09-02 13:57:21', NULL),
(209, 173, 127, '2400.00', NULL, NULL, '2019-09-02 09:00:00', '2019-09-02 10:00:00', '1.00', NULL, '1.00', '2019-09-02 14:03:11', '2019-09-02 14:03:11', NULL),
(210, 174, 127, '2400.00', NULL, NULL, '2019-09-02 09:00:00', '2019-09-02 10:00:00', '1.00', NULL, '1.00', '2019-09-02 15:32:18', '2019-09-02 15:32:18', NULL),
(211, 175, 149, '10.00', NULL, NULL, '2019-09-02 00:00:00', '2019-09-02 08:00:00', '1.00', NULL, '1.00', '2019-09-02 15:33:57', '2019-09-02 15:33:57', NULL),
(212, 176, 127, '2400.00', NULL, NULL, '2019-09-02 09:00:00', '2019-09-02 10:00:00', '1.00', NULL, '1.00', '2019-09-02 16:30:06', '2019-09-02 16:30:06', NULL),
(213, 177, 127, '2400.00', NULL, NULL, '2019-09-03 09:00:00', '2019-09-03 10:00:00', '1.00', NULL, '1.00', '2019-09-02 16:31:54', '2019-09-02 16:31:54', NULL),
(214, 178, 127, '2400.00', NULL, NULL, '2019-09-03 09:00:00', '2019-09-03 10:00:00', '1.00', NULL, '1.00', '2019-09-03 11:45:17', '2019-09-03 11:45:17', NULL),
(215, 179, 127, '2400.00', NULL, NULL, '2019-09-03 09:00:00', '2019-09-03 10:00:00', '1.00', NULL, '1.00', '2019-09-03 12:44:23', '2019-09-03 12:44:23', NULL),
(216, 180, 127, '2400.00', NULL, NULL, '2019-09-03 09:00:00', '2019-09-03 10:00:00', '1.00', NULL, '1.00', '2019-09-03 14:00:13', '2019-09-03 14:00:13', NULL),
(217, 181, 149, '10.00', NULL, NULL, '2019-09-04 00:00:00', '2019-09-04 08:00:00', '1.00', NULL, '1.00', '2019-09-03 16:13:56', '2019-09-03 16:13:56', NULL),
(218, 182, 149, '10.00', NULL, NULL, '2019-09-03 00:00:00', '2019-09-03 08:00:00', '1.00', NULL, '1.00', '2019-09-03 16:14:52', '2019-09-03 16:14:52', NULL),
(219, 183, 149, '10.00', NULL, NULL, '2019-09-05 00:00:00', '2019-09-05 08:00:00', '1.00', NULL, '1.00', '2019-09-05 11:15:30', '2019-09-05 11:15:30', NULL),
(220, 184, 149, '10.00', NULL, NULL, '2019-09-05 00:00:00', '2019-09-05 08:00:00', '1.00', NULL, '1.00', '2019-09-05 11:18:17', '2019-09-05 11:18:17', NULL),
(221, 185, 127, '2400.00', NULL, NULL, '2019-09-05 09:00:00', '2019-09-05 10:00:00', '1.00', NULL, '1.00', '2019-09-05 12:13:48', '2019-09-05 12:13:48', NULL),
(222, 186, 127, '2400.00', NULL, NULL, '2019-09-06 09:00:00', '2019-09-06 10:00:00', '1.00', NULL, '1.00', '2019-09-06 09:30:20', '2019-09-06 09:30:20', NULL),
(223, 187, 127, '2400.00', NULL, NULL, '2019-09-06 09:00:00', '2019-09-06 10:00:00', '1.00', NULL, '1.00', '2019-09-06 09:51:28', '2019-09-06 09:51:28', NULL),
(224, 188, 127, '2400.00', NULL, NULL, '2019-09-15 09:00:00', '2019-09-15 10:00:00', '1.00', NULL, '1.00', '2019-09-15 17:59:44', '2019-09-15 17:59:44', NULL),
(225, 189, 149, '10.00', NULL, NULL, '2019-10-10 00:00:00', '2019-10-10 08:00:00', '1.00', NULL, '1.00', '2019-10-10 18:46:09', '2019-10-10 18:46:09', NULL),
(226, 190, 127, '2400.00', NULL, NULL, '2019-10-13 09:00:00', '2019-10-13 10:00:00', '1.00', NULL, '1.00', '2019-10-13 06:47:04', '2019-10-13 06:47:04', NULL),
(227, 191, 127, '2400.00', NULL, NULL, '2019-10-14 09:00:00', '2019-10-14 10:00:00', '1.00', NULL, '1.00', '2019-10-14 10:10:15', '2019-10-14 10:10:15', NULL),
(228, 192, 149, '10.00', NULL, NULL, '2019-10-14 00:00:00', '2019-10-14 08:00:00', '1.00', NULL, '1.00', '2019-10-14 14:59:56', '2019-10-14 14:59:56', NULL),
(229, 193, 149, '10.00', NULL, NULL, '2019-10-14 00:00:00', '2019-10-14 08:00:00', '1.00', NULL, '1.00', '2019-10-14 15:11:43', '2019-10-14 15:11:43', NULL),
(230, 194, 149, '10.00', NULL, NULL, '2019-10-14 00:00:00', '2019-10-14 08:00:00', '1.00', NULL, '1.00', '2019-10-14 15:23:46', '2019-10-14 15:23:46', NULL),
(231, 195, 149, '10.00', NULL, NULL, '2019-10-14 00:00:00', '2019-10-14 08:00:00', '1.00', NULL, '1.00', '2019-10-14 15:35:14', '2019-10-14 15:35:14', NULL),
(232, 196, 149, '10.00', NULL, NULL, '2019-10-14 00:00:00', '2019-10-14 08:00:00', '1.00', NULL, '1.00', '2019-10-14 15:42:46', '2019-10-14 15:42:46', NULL),
(233, 197, 127, '2400.00', NULL, NULL, '2019-10-14 09:00:00', '2019-10-14 10:00:00', '1.00', NULL, '1.00', '2019-10-14 15:43:01', '2019-10-14 15:43:01', NULL),
(234, 198, 149, '10.00', NULL, NULL, '2019-10-14 00:00:00', '2019-10-14 08:00:00', '1.00', NULL, '1.00', '2019-10-14 15:43:55', '2019-10-14 15:43:55', NULL),
(235, 199, 127, '2400.00', NULL, NULL, '2019-10-14 09:00:00', '2019-10-14 10:00:00', '1.00', NULL, '1.00', '2019-10-14 15:44:40', '2019-10-14 15:44:40', NULL),
(236, 200, 127, '4800.00', NULL, NULL, '2019-10-14 09:00:00', '2019-10-14 10:00:00', '2.00', NULL, '1.00', '2019-10-14 16:41:46', '2019-10-14 16:41:46', NULL),
(237, 201, 127, '2400.00', NULL, NULL, '2019-10-15 09:00:00', '2019-10-15 10:00:00', '1.00', NULL, '1.00', '2019-10-14 16:45:42', '2019-10-14 16:45:42', NULL),
(238, 202, 127, '2400.00', NULL, NULL, '2019-10-15 11:00:00', '2019-10-15 12:00:00', '1.00', NULL, '1.00', '2019-10-15 15:18:21', '2019-10-15 15:18:21', NULL),
(239, 203, 127, '2400.00', NULL, NULL, '2019-10-17 09:00:00', '2019-10-17 10:00:00', '1.00', NULL, '1.00', '2019-10-15 15:26:27', '2019-10-15 15:26:27', NULL),
(240, 204, 127, '2400.00', NULL, NULL, '2019-10-15 09:00:00', '2019-10-15 10:00:00', '1.00', NULL, '1.00', '2019-10-15 15:34:08', '2019-10-15 15:34:08', NULL),
(241, 205, 127, '2400.00', NULL, NULL, '2019-10-16 09:00:00', '2019-10-16 10:00:00', '1.00', NULL, '1.00', '2019-10-15 15:35:47', '2019-10-15 15:35:47', NULL),
(242, 206, 127, '2400.00', NULL, NULL, '2019-10-17 09:00:00', '2019-10-17 10:00:00', '1.00', NULL, '1.00', '2019-10-15 15:39:55', '2019-10-15 15:39:55', NULL),
(243, 207, 127, '150.00', 1, NULL, '2019-10-24 16:00:00', '2019-10-25 09:00:00', '1.00', NULL, '1.00', '2019-10-16 15:01:11', '2019-10-16 15:01:11', NULL),
(244, 208, 127, '150.00', 1, NULL, '2019-10-21 09:00:00', '2019-10-22 09:00:00', '1.00', NULL, '1.00', '2019-10-21 14:33:39', '2019-10-21 14:33:39', NULL),
(245, 209, 127, '80.00', 1, NULL, '2019-10-22 09:00:00', '2019-10-22 11:00:00', '1.00', NULL, '1.00', '2019-10-22 11:28:27', '2019-10-22 11:28:27', NULL),
(246, 210, 127, '150.00', 1, NULL, '2019-10-22 09:00:00', '2019-10-22 13:00:00', '1.00', NULL, '1.00', '2019-10-22 11:31:07', '2019-10-22 11:31:07', NULL),
(247, 211, 127, '40.00', 1, NULL, '2019-10-22 09:00:00', '2019-10-22 10:00:00', '1.00', NULL, '1.00', '2019-10-22 14:24:00', '2019-10-22 14:24:00', NULL),
(248, 212, 127, '40.00', 1, NULL, '2019-10-24 09:00:00', '2019-10-24 10:00:00', '1.00', NULL, '1.00', '2019-10-24 23:55:19', '2019-10-25 12:18:29', '2019-10-25 12:18:29'),
(250, 213, 127, '40.00', 1, NULL, '2019-10-24 09:00:00', '2019-10-24 10:00:00', '1.00', NULL, '1.00', '2019-10-24 23:56:54', '2019-10-24 23:56:54', NULL),
(252, 215, 127, '150.00', 1, NULL, '2019-10-24 14:00:00', '2019-10-25 09:00:00', '1.00', NULL, '1.00', '2019-10-25 00:06:45', '2019-10-25 00:06:45', NULL),
(254, 217, 127, '40.00', 1, NULL, '2019-10-25 09:00:00', '2019-10-25 10:00:00', '1.00', NULL, '1.00', '2019-10-25 13:57:56', '2019-10-25 13:57:56', NULL),
(255, 218, 127, '200.00', 1, NULL, '2019-10-26 09:00:00', '2019-10-27 09:00:00', '1.00', NULL, '1.00', '2019-10-26 11:15:46', '2019-10-26 11:15:46', NULL),
(256, 219, 127, '40.00', 1, NULL, '2019-10-26 09:00:00', '2019-10-26 10:00:00', '1.00', NULL, '1.00', '2019-10-26 11:43:00', '2019-10-26 11:43:00', NULL),
(257, 220, 127, '40.00', 1, NULL, '2019-10-26 09:00:00', '2019-10-26 10:00:00', '1.00', NULL, '1.00', '2019-10-26 18:42:21', '2019-10-26 18:42:21', NULL),
(258, 221, 127, '40.00', 1, NULL, '2019-10-26 09:00:00', '2019-10-26 10:00:00', '1.00', '3', '1.00', '2019-10-26 20:26:45', '2019-10-26 20:26:45', NULL),
(259, 222, 127, '40.00', 1, NULL, '2019-10-28 09:00:00', '2019-10-28 10:00:00', '1.00', NULL, '1.00', '2019-10-28 21:31:50', '2019-10-28 21:31:50', NULL),
(260, 223, 127, '150.00', 1, NULL, '2019-10-29 09:00:00', '2019-10-30 09:00:00', '1.00', NULL, '1.00', '2019-10-29 09:30:31', '2019-10-29 09:30:31', NULL),
(261, 224, 127, '40.00', 1, NULL, '2019-10-29 09:00:00', '2019-10-29 10:00:00', '1.00', NULL, '1.00', '2019-10-29 13:07:57', '2019-10-29 13:07:57', NULL),
(262, 225, 127, '40.00', 1, NULL, '2019-10-29 09:00:00', '2019-10-29 10:00:00', '1.00', NULL, '1.00', '2019-10-29 15:02:39', '2019-10-29 15:02:39', NULL),
(263, 226, 127, '150.00', 1, NULL, '2019-10-29 09:00:00', '2019-10-30 09:00:00', '1.00', NULL, '1.00', '2019-10-29 15:55:57', '2019-10-29 15:55:57', NULL),
(264, 227, 127, '40.00', 1, NULL, '2019-10-29 09:00:00', '2019-10-29 10:00:00', '1.00', NULL, '1.00', '2019-10-29 16:30:11', '2019-10-29 16:30:11', NULL),
(265, 228, 127, '40.00', 1, NULL, '2019-10-30 09:00:00', '2019-10-30 10:00:00', '1.00', NULL, '1.00', '2019-10-29 17:53:35', '2019-10-29 17:53:35', NULL),
(266, 229, 127, '40.00', 1, NULL, '2019-10-31 09:00:00', '2019-10-31 10:00:00', '1.00', NULL, '1.00', '2019-10-29 19:13:00', '2019-10-29 19:13:00', NULL),
(267, 230, 127, '40.00', 1, NULL, '2019-10-30 09:00:00', '2019-10-30 10:00:00', '1.00', NULL, '1.00', '2019-10-29 23:08:36', '2019-10-29 23:08:36', NULL),
(268, 231, 127, '40.00', 1, NULL, '2019-10-31 14:00:00', '2019-10-31 15:00:00', '1.00', NULL, '1.00', '2019-10-30 09:18:34', '2019-10-30 09:18:34', NULL),
(269, 232, 127, '160.00', 1, NULL, '2019-11-01 09:00:00', '2019-11-01 11:00:00', '2.00', NULL, '1.00', '2019-10-30 09:26:31', '2019-10-30 09:26:31', NULL),
(270, 233, 127, '150.00', 1, NULL, '2019-11-15 09:00:00', '2019-11-15 14:00:00', '1.00', NULL, '1.00', '2019-10-30 09:47:46', '2019-10-30 09:47:46', NULL),
(271, 234, 127, '150.00', 1, NULL, '2019-11-20 09:00:00', '2019-11-20 15:00:00', '1.00', NULL, '1.00', '2019-10-30 09:54:07', '2019-10-30 09:54:07', NULL),
(272, 235, 127, '40.00', 1, NULL, '2019-10-30 09:00:00', '2019-10-30 10:00:00', '1.00', NULL, '1.00', '2019-10-30 12:04:19', '2019-10-30 12:04:19', NULL),
(273, 236, 127, '120.00', 1, NULL, '2019-10-30 09:00:00', '2019-10-30 12:00:00', '1.00', NULL, '1.00', '2019-10-30 12:48:54', '2019-10-30 12:48:54', NULL),
(274, 237, 127, '40.00', 1, NULL, '2019-11-24 09:00:00', '2019-11-24 10:00:00', '1.00', NULL, '1.00', '2019-10-30 12:54:02', '2019-10-30 12:54:02', NULL),
(275, 238, 127, '40.00', 1, NULL, '2019-10-30 09:00:00', '2019-10-30 10:00:00', '1.00', NULL, '1.00', '2019-10-30 13:17:11', '2019-10-30 13:17:11', NULL),
(276, 239, 127, '80.00', 1, NULL, '2019-11-29 09:00:00', '2019-11-29 11:00:00', '1.00', NULL, '1.00', '2019-10-30 14:33:33', '2019-10-30 14:33:33', NULL),
(277, 240, 127, '40.00', 1, NULL, '2019-11-10 09:00:00', '2019-11-10 10:00:00', '1.00', NULL, '1.00', '2019-10-30 14:37:00', '2019-10-30 14:37:00', NULL),
(278, 241, 127, '40.00', 1, NULL, '2019-10-31 09:00:00', '2019-10-31 10:00:00', '1.00', NULL, '1.00', '2019-10-30 17:12:18', '2019-10-30 17:12:18', NULL),
(279, 242, 127, '40.00', 1, NULL, '2019-10-31 09:00:00', '2019-10-31 10:00:00', '1.00', NULL, '1.00', '2019-10-30 17:33:24', '2019-10-30 17:33:24', NULL),
(280, 243, 127, '40.00', 1, NULL, '2019-11-30 09:00:00', '2019-11-30 10:00:00', '1.00', NULL, '1.00', '2019-10-30 18:11:33', '2019-10-30 18:11:33', NULL),
(281, 244, 127, '120.00', 1, NULL, '2019-12-21 09:00:00', '2019-12-21 12:00:00', '1.00', NULL, '1.00', '2019-10-30 18:15:11', '2019-10-30 18:15:11', NULL),
(282, 245, 127, '40.00', 1, NULL, '2019-10-31 09:00:00', '2019-10-31 10:00:00', '1.00', NULL, '1.00', '2019-10-30 18:42:59', '2019-10-30 18:42:59', NULL),
(283, 248, 127, '80.00', 1, NULL, '2019-10-31 09:00:00', '2019-10-31 11:00:00', '1.00', NULL, '1.00', '2019-10-31 13:40:05', '2019-10-31 13:40:05', NULL),
(284, 249, 127, '600.00', 1, NULL, '2019-11-07 09:00:00', '2019-11-11 09:00:00', '1.00', NULL, '1.00', '2019-11-06 07:31:00', '2019-11-06 07:31:00', NULL),
(285, 250, 127, '80.00', 1, NULL, '2019-11-06 09:00:00', '2019-11-06 11:00:00', '1.00', NULL, '1.00', '2019-11-06 17:04:32', '2019-11-06 17:04:32', NULL),
(286, 251, 127, '300.00', 1, NULL, '2019-11-06 17:00:00', '2019-11-08 17:00:00', '1.00', NULL, '1.00', '2019-11-06 18:12:48', '2019-11-06 18:12:48', NULL),
(287, 251, 127, '750.00', 1, NULL, '2019-11-06 17:00:00', '2019-11-11 09:00:00', '1.00', NULL, '1.00', '2019-11-06 18:32:15', '2019-11-06 18:32:15', NULL),
(288, 253, 150, '12.00', NULL, NULL, '2020-03-02 02:00:00', '2020-03-03 00:00:00', '1.00', NULL, '1.00', '2020-03-02 01:24:00', '2020-03-02 01:24:00', NULL),
(289, 254, 127, '40.00', 1, NULL, '2020-03-02 09:00:00', '2020-03-02 10:00:00', '1.00', NULL, '1.00', '2020-03-02 05:48:19', '2020-03-02 05:48:19', NULL),
(290, 255, 127, '40.00', 1, NULL, '2020-03-02 09:00:00', '2020-03-02 10:00:00', '1.00', NULL, '1.00', '2020-03-02 05:49:01', '2020-03-02 05:49:01', NULL),
(291, 256, 127, '40.00', 1, NULL, '2020-03-02 09:00:00', '2020-03-02 10:00:00', '1.00', NULL, '1.00', '2020-03-02 05:49:29', '2020-03-02 05:49:29', NULL),
(292, 257, 127, '40.00', 1, NULL, '2020-03-02 09:00:00', '2020-03-02 10:00:00', '1.00', NULL, '1.00', '2020-03-02 05:49:54', '2020-03-02 05:49:54', NULL),
(293, 258, 150, '12.00', NULL, NULL, '2020-03-02 02:00:00', '2020-03-03 00:00:00', '1.00', '4', '1.00', '2020-03-02 05:54:46', '2020-03-02 05:54:46', NULL),
(294, 258, 151, '12.00', NULL, NULL, '2020-03-02 01:00:00', '2020-03-03 00:00:00', '1.00', '5', '1.00', '2020-03-02 05:54:55', '2020-03-02 05:54:55', NULL),
(298, 261, 127, '40.00', 1, NULL, '2020-03-03 09:00:00', '2020-03-03 10:00:00', '1.00', NULL, '1.00', '2020-03-03 02:24:18', '2020-03-03 02:24:18', NULL),
(300, 263, 127, '40.00', 1, NULL, '2020-03-03 09:00:00', '2020-03-03 10:00:00', '1.00', NULL, '1.00', '2020-03-03 03:46:52', '2020-03-03 03:46:52', NULL),
(301, 266, 127, '40.00', 1, NULL, '2020-03-03 09:00:00', '2020-03-03 10:00:00', '1.00', NULL, '1.00', '2020-03-03 04:31:13', '2020-03-03 04:31:13', NULL),
(302, 269, 127, '80.00', 1, NULL, '2020-03-03 09:00:00', '2020-03-03 10:00:00', '2.00', '3', '1.00', '2020-03-03 06:49:46', '2020-03-03 06:49:46', NULL),
(303, 270, 151, '12.00', NULL, NULL, '2020-03-03 01:00:00', '2020-03-04 00:00:00', '1.00', '100', '1.00', '2020-03-03 06:54:45', '2020-03-03 06:54:45', NULL),
(304, 276, 127, '40.00', 1, NULL, '2020-03-03 09:00:00', '2020-03-03 10:00:00', '1.00', NULL, '1.00', '2020-03-03 07:14:04', '2020-03-03 07:14:04', NULL),
(305, 277, 127, '80.00', 1, NULL, '2020-03-04 09:00:00', '2020-03-04 10:00:00', '2.00', NULL, '1.00', '2020-03-03 23:46:14', '2020-03-03 23:46:14', NULL),
(306, 278, 127, '40.00', 1, NULL, '2020-03-04 09:00:00', '2020-03-04 10:00:00', '1.00', NULL, '1.00', '2020-03-04 02:03:42', '2020-03-04 02:03:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_de` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_de` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_se` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_se` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `centre_id` int(10) UNSIGNED NOT NULL,
  `parent_category_id` int(10) UNSIGNED DEFAULT NULL,
  `is_admin_category` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `name_de`, `description_de`, `name_se`, `description_se`, `image`, `centre_id`, `parent_category_id`, `is_admin_category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 'Övrigt', 'Övriga bokningsbara tillbehör', NULL, NULL, NULL, NULL, 'Övrigt_573db0a02b39e.jpg', 20, NULL, 0, '2016-05-19 10:25:04', '2016-05-19 10:25:04', NULL),
(30, 'Flytvästar', 'Vi har barnflytvästar och vanliga flytvästar', NULL, NULL, NULL, NULL, 'Flytvästar_573db3d5628ea.jpg', 20, 29, 0, '2016-05-19 10:38:45', '2016-05-19 10:38:45', NULL),
(31, 'Campingtillbehör', 'Du kan även hyra tält och kokutrustning', NULL, NULL, NULL, NULL, 'Campingtillbehör_573db42073b35.jpg', 20, 29, 0, '2016-05-19 10:40:00', '2016-05-19 10:40:00', NULL),
(32, 'Båtar', 'Övriga båtar, stand up boards, med mera', NULL, NULL, NULL, NULL, 'Båtar_573dd042cf9ca.jpg', 20, NULL, 0, '2016-05-19 12:40:02', '2016-05-19 12:40:02', NULL),
(33, 'Machine', 'Tree cutting Machine', NULL, NULL, NULL, NULL, '', 23, NULL, 0, '2016-05-23 21:26:03', '2019-04-23 04:22:08', '2019-04-23 04:22:08'),
(34, 'Kajaker - Västra Kajen', 'Kajaker att hyra vid filialen Västra Kajen', NULL, NULL, NULL, NULL, '', 27, NULL, 0, '2016-06-27 20:12:36', '2016-06-27 20:12:36', NULL),
(35, 'Kajaker - Renöhamn', 'Kajaker att hyra vid filialen Renöhamn', NULL, NULL, NULL, NULL, '', 27, NULL, 0, '2016-06-27 20:13:18', '2016-06-27 20:13:18', NULL),
(36, 'Test', 'Test', NULL, NULL, NULL, NULL, 'Test_5772ee9865228.jpg', 17, NULL, 0, '2016-06-28 19:39:36', '2016-06-28 19:56:01', '2016-06-28 19:56:01'),
(37, 'Kanotuthyrning', 'Här kan du som vill hyra kanot eller Kajak boka.', NULL, NULL, NULL, NULL, '', 28, NULL, 0, '2016-06-29 12:25:46', '2016-06-29 12:25:46', NULL),
(38, 'K1 Singelkajaker', 'singelkajaker', NULL, NULL, NULL, NULL, '', 29, NULL, 0, '2016-10-21 07:56:47', '2016-10-21 07:56:47', NULL),
(39, 'Havskajaker - K1', 'Enmanskajaker', NULL, NULL, NULL, NULL, 'Havskajaker K1_5813fc4038e37.jpg', 33, 63, 0, '2016-10-28 23:32:48', '2017-01-17 06:35:22', NULL),
(40, 'Stand Up Paddleboard - SUP', 'Uppblåsbara paddelbrädor', NULL, NULL, NULL, NULL, '', 33, 63, 0, '2016-10-28 23:38:56', '2017-01-17 06:36:24', NULL),
(43, 'Kajak 1-mans ', 'Havskajak med packluckor ', NULL, NULL, NULL, NULL, '', 34, NULL, 0, '2016-11-14 12:31:36', '2016-11-14 12:31:36', NULL),
(44, 'Kajak 2-mans ', 'Havskajak med packluckor ', NULL, NULL, NULL, NULL, '', 34, NULL, 0, '2016-11-14 12:32:01', '2016-11-14 12:32:01', NULL),
(45, 'Kanadensare ', 'Linder 525, Kanot för 2-3 personer', NULL, NULL, NULL, NULL, '', 34, NULL, 0, '2016-11-14 12:33:23', '2016-11-14 12:33:23', NULL),
(46, 'Flytväst', 'Vi har flytvästar för både barn och vuxna ', NULL, NULL, NULL, NULL, '', 34, 45, 0, '2016-11-14 12:36:59', '2016-11-14 12:45:07', NULL),
(47, 'Tält ', 'Vi har 2-mans, 3-man, 4-mans och 5-mans tält', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:37:49', '2016-11-14 12:42:31', NULL),
(48, 'Spritkök', 'Trangiakök', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:38:15', '2016-11-14 12:42:41', NULL),
(49, 'Sovsäck', 'Sovsäckar ', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:38:37', '2016-11-14 12:42:57', NULL),
(50, 'Liggunderlag', 'Liggunderlag', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:39:29', '2016-11-14 12:43:06', NULL),
(51, 'Kanotvagn', 'För att slippa bära kanoten vid lyft', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:40:05', '2016-11-14 12:43:16', NULL),
(52, 'Tunna', 'Vattentät packtunna, 30 eller 60 liter', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:40:46', '2016-11-14 12:43:26', NULL),
(53, 'Presenning', 'Presenning', NULL, NULL, NULL, NULL, '', 34, 54, 0, '2016-11-14 12:41:14', '2016-11-14 12:43:34', NULL),
(54, 'Övrigt', 'Övrig utrustning', NULL, NULL, NULL, NULL, '', 34, NULL, 0, '2016-11-14 12:42:19', '2016-11-14 12:42:19', NULL),
(55, 'Flytväst', 'Vi har flytvästar för barn och vuxna', NULL, NULL, NULL, NULL, '', 34, 43, 0, '2016-11-14 12:43:58', '2016-11-14 12:43:58', NULL),
(56, 'Flytväst', 'Vi har flytvästar för både barn och vuxna ', NULL, NULL, NULL, NULL, '', 34, 44, 0, '2016-11-14 12:44:41', '2016-11-14 12:44:41', NULL),
(57, 'Havskajaker - K2/K3', 'Tvåmanskajaker', NULL, NULL, NULL, NULL, 'Havskajaker - K2/K3_584a0ff928758.jpg', 33, NULL, 0, '2016-12-09 00:20:27', '2016-12-09 00:59:59', '2016-12-09 00:59:59'),
(58, 'Havskajaker - K2/K3', 'Tvåmanskajaker', NULL, NULL, NULL, NULL, '', 33, 63, 0, '2016-12-09 01:00:13', '2017-01-17 06:36:11', NULL),
(59, 'Båttransport', 'Bokning av båtöverfarten mellan Gräsö och Rävsten med vår egna mindre passbåt. <4 personer per tur, vid större sällskap körs extraturer.', NULL, NULL, NULL, NULL, 'Båttransport - \"Liten\"_587cbee5ae9c8.jpg', 33, NULL, 0, '2016-12-09 01:08:29', '2017-01-16 12:15:01', NULL),
(60, 'Kanot', 'Kanotpaket 1 dag', NULL, NULL, NULL, NULL, 'Kanot_584e9f0cc5b77.JPG', 35, NULL, 0, '2016-12-12 11:58:52', '2016-12-12 11:58:52', NULL),
(61, 'Campingutrustning', 'Uthyrning av tält, sovsäckar, liggunderlag, stormkök m.m.', NULL, NULL, NULL, NULL, '', 33, NULL, 0, '2016-12-17 03:14:14', '2016-12-17 03:14:14', NULL),
(62, 'Fiskeutrustning', 'Utrustning för fiske av exempelvis abborre, gädda och strömming. ', NULL, NULL, NULL, NULL, '', 33, NULL, 0, '2017-01-16 11:49:11', '2017-01-16 11:49:11', NULL),
(63, 'Kajaker', 'Uthyrning av kajaker och paddelbrädor', NULL, NULL, NULL, NULL, '', 33, NULL, 0, '2017-01-17 06:35:07', '2017-01-17 06:35:07', NULL),
(64, 'Kanotturer', 'Kanottur på Svartälven', NULL, NULL, NULL, NULL, 'Kanotturer_589c9aa2435a1.JPG', 36, NULL, 0, '2017-02-07 15:25:51', '2017-02-09 15:36:50', NULL),
(65, 'Kajaker', 'Hyr en havskajak och ge dig iväg på ett eget äventyr', NULL, NULL, NULL, NULL, 'Kajaker_589ae10ba2347.jpg', 37, NULL, 0, '2017-02-08 08:12:43', '2017-02-17 06:23:28', '2017-02-17 06:23:28'),
(66, 'Kurser', 'Upplev mer och gå en kajakkurs', NULL, NULL, NULL, NULL, 'Kurser_589ae17d74634.jpg', 37, NULL, 0, '2017-02-08 08:14:37', '2017-02-17 06:23:02', '2017-02-17 06:23:02'),
(67, 'Turer', 'Följ med på en tur i Roslagens skärgård', NULL, NULL, NULL, NULL, 'Turer_589ae1ccd9d6f.jpg', 37, NULL, 0, '2017-02-08 08:15:56', '2017-02-17 06:23:18', '2017-02-17 06:23:18'),
(68, 'Friluftsutrustning', 'Övrig utrustning du kan behöva för ditt äventyr i skärgården', NULL, NULL, NULL, NULL, 'Friluftsutrustning_589ae2833ca8e.jpg', 37, NULL, 0, '2017-02-08 08:18:59', '2017-02-17 06:22:57', '2017-02-17 06:22:57'),
(69, 'Singelkajak (K1)', 'Hyr en eller flera singelkajaker till din tur', NULL, NULL, NULL, NULL, 'Singelkajak (K1)_589ae2d1e505b.jpg', 37, 65, 0, '2017-02-08 08:20:17', '2017-02-08 08:20:17', NULL),
(70, 'Dubbelkajak (K2)', 'Hyr en eller flera dubbelkajaker till din tur', NULL, NULL, NULL, NULL, 'Dubbelkajak (K2)_589ae31b3b91a.jpg', 37, 65, 0, '2017-02-08 08:21:31', '2017-02-08 08:21:31', NULL),
(71, 'Guidade dagsturer', 'Följ med på en guidad dagstur i Roslagens skärgård', NULL, NULL, NULL, NULL, 'Guidade dagsturer_589ae38d62410.jpg', 37, 67, 0, '2017-02-08 08:23:25', '2017-02-08 08:23:25', NULL),
(72, 'Flerdagars \"All inclusive\"', 'Följ med på en längre tur där allt ingår! ', NULL, NULL, NULL, NULL, 'Flerdagars \"All inclusive\"_589ae3ccd8b88.jpg', 37, 67, 0, '2017-02-08 08:24:28', '2017-02-08 08:24:28', NULL),
(73, 'Flerdagars skärgårdsturer', 'För dig med egen utrustning och erfarenhet ', NULL, NULL, NULL, NULL, 'Flerdagars skärgårdsturer_589ae548f41d1.jpg', 37, 67, 0, '2017-02-08 08:30:49', '2017-02-08 08:30:49', NULL),
(74, 'Självguidade turer', 'För dig som vill ut på egen tur men vill gå en kurs först', NULL, NULL, NULL, NULL, 'Självguidade turer_589ae5b37f26c.jpg', 37, 67, 0, '2017-02-08 08:32:35', '2017-02-08 08:32:35', NULL),
(75, 'Bo och sova', 'Tält, sovsäckar och liggunderlag', NULL, NULL, NULL, NULL, 'Bo och sova_589ae7ca463d9.jpg', 37, 68, 0, '2017-02-08 08:40:56', '2017-02-17 06:22:44', '2017-02-17 06:22:44'),
(76, 'Laga och äta', 'Kök, matlagningsutrustning', NULL, NULL, NULL, NULL, 'Laga och äta_589ae81b85a25.jpg', 37, 68, 0, '2017-02-08 08:42:51', '2017-02-17 06:22:42', '2017-02-17 06:22:42'),
(77, 'Säkerhetsutrustning', 'Pump, flottör, paddellina ', NULL, NULL, NULL, NULL, 'Säkerhetsutrustning_589ae91a4aa51.jpg', 37, 68, 0, '2017-02-08 08:47:06', '2017-02-17 06:22:39', '2017-02-17 06:22:39'),
(78, 'Kajakturer', 'Kajak för 1 person inkl grundutrustning och transport', NULL, NULL, NULL, NULL, 'Kajakturer_589c9e9b705e1.JPG', 36, NULL, 0, '2017-02-09 15:30:32', '2017-02-09 15:53:47', NULL),
(79, 'Extra utrustning', 'Extra utrustning för vildmarksliv', NULL, NULL, NULL, NULL, 'Extra utrustning_589c9a47de8ef.JPG', 36, 64, 0, '2017-02-09 15:34:14', '2017-02-09 15:54:40', NULL),
(80, 'Singelkajak (K1)', 'Paddla själv i en singelkajak, finns både med skädda och roder', NULL, NULL, NULL, NULL, 'Singelkajak (K1)_58a6a584c940c.jpg', 37, NULL, 0, '2017-02-17 06:25:56', '2017-02-17 06:25:56', NULL),
(81, 'Dubbelkajak (K2)', 'Paddla två stycken i en dubbelkajak, finns även med extra packlucka i mitten för dig som ska vara iväg länge!', NULL, NULL, NULL, NULL, 'Dubbelkajak (K2)_58a6a625e5735.jpg', 37, NULL, 0, '2017-02-17 06:28:37', '2017-02-17 06:28:37', NULL),
(82, 'Rental - Self Guided ', 'Kayaks for rental and equipment for Self Guided trips', NULL, NULL, NULL, NULL, 'Rental - Self Guided _58d946254f4fa.jpg', 38, NULL, 0, '2017-03-27 15:04:37', '2017-03-27 15:04:37', NULL),
(83, 'Courses', 'Kajakkurser med #skrattgaranti. ', NULL, NULL, NULL, NULL, 'Courses_58d94d764130d.png', 38, NULL, 0, '2017-03-27 15:35:50', '2017-03-27 15:35:50', NULL),
(84, 'Kajak', 'Stabila kajaker med packluckor och plats för packning i vattentäta luckor.', NULL, NULL, NULL, NULL, 'Kajak_58f9aab07402e.jpg', 39, NULL, 0, '2017-04-21 04:46:08', '2017-04-21 04:46:08', NULL),
(85, 'Kajak', 'Våra Kajaker', NULL, NULL, NULL, NULL, '', 40, NULL, 0, '2017-05-23 18:24:06', '2017-05-23 18:24:06', NULL),
(86, 'Paddelpass', 'Paddelpass Grön', NULL, NULL, NULL, NULL, '', 40, NULL, 0, '2017-05-23 18:31:08', '2017-05-23 18:31:08', NULL),
(87, 'title', 'test', NULL, NULL, NULL, NULL, '', 41, NULL, 0, '2017-09-16 01:14:49', '2017-09-16 01:14:49', NULL),
(88, 'Kanoter', 'Kanoter för 2-3 personer', NULL, NULL, NULL, NULL, '', 42, NULL, 0, '2018-02-07 08:25:29', '2018-02-07 08:30:11', NULL),
(89, 'Kajaker', 'Kajaker för 1 person', NULL, NULL, NULL, NULL, '', 42, NULL, 0, '2018-02-13 09:26:49', '2018-02-13 09:26:49', NULL),
(90, 'Båtar', 'Roddbåtar', NULL, NULL, NULL, NULL, '', 42, NULL, 0, '2018-02-13 09:27:04', '2018-02-13 09:27:04', NULL),
(91, 'Kanadensare', 'Kanadensare', NULL, NULL, NULL, NULL, 'Kanadensare_5aaf740d0a30c.jpg', 43, NULL, 0, '2018-03-19 07:25:49', '2018-03-19 07:25:49', NULL),
(92, 'Tillbehör', 'Kanotvagn, tunna, extra paddlar osv. ', NULL, NULL, NULL, NULL, 'Tillbehör_5aaf7a9e6533f.jpg', 43, NULL, 0, '2018-03-19 07:53:50', '2018-03-19 07:53:50', NULL),
(93, 'Båtmotor', 'Motor att hyra till roddbåten', NULL, NULL, NULL, NULL, '', 42, NULL, 0, '2018-03-19 11:09:44', '2018-03-19 11:09:44', NULL),
(94, 'Tillval', 'Tillval ', NULL, NULL, NULL, NULL, '', 42, NULL, 0, '2018-03-19 11:10:01', '2018-03-19 11:10:01', NULL),
(95, 'Turistcanadensare', 'Enkla, stabila canadensare.', NULL, NULL, NULL, NULL, '', 17, NULL, 0, '2018-05-01 17:46:25', '2018-05-03 17:53:01', '2018-05-03 17:53:01'),
(96, 'Kanot/Canoe', 'Våra uthyrningskanoter', NULL, NULL, NULL, NULL, '', 17, NULL, 0, '2018-05-03 17:53:37', '2018-06-11 14:57:07', NULL),
(98, 'Övrigt', 'Övriga tillbehör', NULL, NULL, NULL, NULL, '', 17, NULL, 0, '2018-05-28 21:35:13', '2018-05-29 10:46:12', '2018-05-29 10:46:12'),
(99, 'tufuyg', 'hjh', NULL, NULL, NULL, NULL, '', 46, NULL, 0, '2019-04-15 23:13:58', '2019-04-22 01:34:21', '2019-04-22 01:34:21'),
(100, 'jlkll', 'uyiu', NULL, NULL, NULL, NULL, 'jlkll_5cbaf2daeb0cc.jpg', 23, 33, 1, '2019-04-20 04:52:18', '2019-04-20 06:17:53', '2019-04-20 06:17:53'),
(101, 'hfh', 'fjhftgj', NULL, NULL, NULL, NULL, '', 23, 33, 1, '2019-04-20 06:15:43', '2019-04-20 06:17:51', '2019-04-20 06:17:51'),
(112, 'Fruits', 'sample', NULL, NULL, NULL, NULL, '', 46, NULL, 0, '2019-04-23 06:16:56', '2019-04-23 06:16:56', NULL),
(113, 'Vehicle', 'Sample vehicle', NULL, NULL, NULL, NULL, 'Vehicle_5cc03c919fd80.jpg', 47, NULL, 0, '2019-04-24 05:08:09', '2019-04-24 05:08:09', NULL),
(115, 'Machine', 'Sample', NULL, NULL, NULL, NULL, '', 23, NULL, 0, '2019-04-24 06:12:19', '2019-04-24 06:12:19', NULL),
(116, 'yrtyr', 'yry', NULL, NULL, NULL, NULL, 'yrtyr_5cc193656e159.jpg', 48, NULL, 0, '2019-04-25 05:30:53', '2019-04-25 05:30:53', NULL),
(117, 'Title', 'fsdfsd', NULL, NULL, NULL, NULL, 'dsfsd_5ce94a2fd2492.jpg', 50, NULL, 0, '2019-05-25 08:29:11', '2019-06-06 18:13:15', '2019-06-06 18:13:15'),
(118, 'sada', 'sdas', NULL, NULL, NULL, NULL, 'sada_5cf22c191f8b8.png', 51, NULL, 0, '2019-06-01 02:11:13', '2019-06-01 02:11:13', NULL),
(119, 'Truck', 'Sats SB: 4 654 kr (RC, givare, SV, SQS35,00+SQS359,54)', NULL, NULL, NULL, NULL, '', 23, NULL, 0, '2019-06-05 07:57:52', '2019-06-05 08:00:05', NULL),
(120, 'Sample', 'asasas', NULL, NULL, NULL, NULL, 'Sample_5cf8f42c4f96d.jpg', 50, 117, 0, '2019-06-06 18:08:28', '2019-06-06 18:08:32', '2019-06-06 18:08:32'),
(121, 'Sample', 'Sample Description', NULL, NULL, NULL, NULL, '', 52, NULL, 0, '2019-06-06 18:17:25', '2019-06-06 18:17:25', NULL),
(122, 'Sample', 'Description', NULL, NULL, NULL, NULL, 'Sample_5cfbb730e2720.jpg', 50, NULL, 0, '2019-06-06 19:06:28', '2019-06-10 14:37:36', '2019-06-10 14:37:36'),
(123, 'Category', 'Category description', NULL, NULL, NULL, NULL, 'Category_5cfbba56a0090.jpg', 53, NULL, 0, '2019-06-08 20:38:30', '2019-06-08 20:38:30', NULL),
(124, 'Category', 'Category Description', NULL, NULL, NULL, NULL, '', 54, NULL, 0, '2019-06-10 12:23:06', '2019-06-10 12:23:06', NULL),
(125, 'Sample', 'dsafafda', NULL, NULL, NULL, NULL, 'Sample_5cfe23d572d2a.jpg', 50, NULL, 0, '2019-06-10 14:37:58', '2019-06-10 16:33:09', NULL),
(126, 'qweqw', 'eqweq', NULL, NULL, NULL, NULL, 'qweqw_5d025114b8d60.png', 50, NULL, 0, '2019-06-13 20:35:08', '2019-06-13 20:35:26', '2019-06-13 20:35:26'),
(127, 'tester', 'Nice', NULL, NULL, NULL, NULL, '', 17, NULL, 0, '2020-02-29 04:56:10', '2020-02-29 04:56:14', '2020-02-29 04:56:14'),
(128, 'tester', 'testing', NULL, NULL, NULL, NULL, '', 17, NULL, 0, '2020-02-29 04:56:21', '2020-02-29 04:56:21', NULL),
(129, 'sawe', 'swert', 'ascdf', 'axdf', 'qwety', 'qww', '', 17, NULL, 0, '2020-02-29 05:27:12', '2020-02-29 05:27:12', NULL),
(130, 'FaceBookAuthen', 'rrttetetren', 'ascdfde', 'axdfde', 'qwetyse', 'qwwse', '', 17, 128, 0, '2020-02-29 05:38:45', '2020-02-29 05:38:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `centres`
--

CREATE TABLE `centres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `web_page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `holidays` text COLLATE utf8_unicode_ci NOT NULL,
  `holidaysrange` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_pay_advance_days` int(11) NOT NULL,
  `stripe_secret_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_publishable_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iZettle_client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iZettle_secret_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klarna_api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klarna_api_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klarna_api_key_live` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klarna_api_secret_live` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klarna_test_mode` tinyint(1) NOT NULL DEFAULT 1,
  `noCancelDays` int(11) NOT NULL,
  `urlSlug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default_language` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'se',
  `bookingFee` decimal(10,2) NOT NULL,
  `useAdminFee` tinyint(1) NOT NULL DEFAULT 0,
  `adminFee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `klarna_only` tinyint(1) NOT NULL DEFAULT 0,
  `paypalemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centres`
--

INSERT INTO `centres` (`id`, `name`, `logo_url`, `telephone`, `address1`, `address2`, `post_code`, `city`, `web_page`, `startTime`, `endTime`, `holidays`, `holidaysrange`, `email`, `num_pay_advance_days`, `stripe_secret_key`, `stripe_publishable_key`, `iZettle_client_id`, `iZettle_secret_key`, `klarna_api_key`, `klarna_api_secret`, `klarna_api_key_live`, `klarna_api_secret_live`, `klarna_test_mode`, `noCancelDays`, `urlSlug`, `created_at`, `updated_at`, `default_language`, `bookingFee`, `useAdminFee`, `adminFee`, `klarna_only`, `paypalemail`) VALUES
(17, 'Karlstads Paddlarklubb', 'http://www.karlstadspaddlarklubb.se/wp-content/uploads/2018/07/Kanotuthyrning150.png', '0703 46 28 86', 'Box 206', '', '65106', 'Karlstad', 'http://www.karlstadspaddlarklubb.se', '00:00:00', '00:00:00', '', '', 'hyrkanot@karlstadspaddlarklubb.se', 1, 'sk_live_mLMDWGBKm9f3ueL0sBMenAIC', 'pk_live_v1s2YFC5nVbFPkH9ywIL8wQf', '', '', '6323', '84FOgBccj5pvJyT', '6323', '84FOgBccj5pvJyT', 1, 1, 'karlstadspaddlarklubb', '2016-05-06 11:37:25', '2018-07-22 14:14:35', 'se', '0.00', 0, '0.00', 0, ''),
(20, 'test', '', '', 'Vattugatan 4', '', '89250', 'Domsjö', '', '00:00:00', '00:00:00', '', '', NULL, 0, 'sk_test_9b5J9bii3G3b7oDikuCIh5ot', 'pk_test_LeK7QRxGVQRuLt7QhqYJp2Su', '', '', '6323', '84FOgBccj5pvJyT', '', '', 1, 0, 'test', '2016-05-11 13:10:54', '2018-05-18 21:53:05', 'se', '0.00', 0, '0.00', 0, ''),
(21, 'Swedish Outdoor Facilitation and Training', '', '0706624521', 'G:a Kontoret, Gimmersta', '', '64396', 'Julita', '', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'swedishoutdoorfacilitationandtraining', '2016-05-16 12:28:17', '2016-05-16 12:28:17', 'se', '0.00', 0, '0.00', 0, ''),
(22, 'Kanotpool Vättlefjäll', '', '0707-731593', 'Kryddnejlikegatan 2', '', '42453', 'Angered', 'http://www.kanotpoolen.se/', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'kanotpoolvttlefjll', '2016-05-16 12:38:02', '2016-05-16 12:38:02', 'se', '0.00', 0, '0.00', 0, ''),
(23, 'frontline web', '', '09898988979', 'blk 12 lot 2', 'dreamcrest homes', '3000', 'Malolos', '', '09:00:00', '17:00:00', '2019/12/09, 2019/12/10, 2019/12/11, 2019/12/12, 2019/11/20, 2019/11/21, 2019/11/22, 2019/11/23, 2019/11/24, 2019/11/25, 2019/11/26, 2019/11/27, 2019/11/28, 2019/11/29, 2019/11/30, 2019/11/12', '2019/12/09 - 2019/12/12,2019/11/20 - 2019/11/30,2019/11/12 - 2019/11/12', '', 3, 'sk_test_oI82V86ojy2h0kk8i3rmvW5H00OvAVTCV6', 'pk_test_10zxkRovzvmoQpSwtd2QCMSE008Vp6fwbE', '', '', '200', 'test', '', '', 0, 7, 'frontlineweb', '2016-05-23 08:19:49', '2019-11-12 07:34:33', 'se', '0.00', 0, '0.00', 0, 'abdul@isquarebs.com'),
(24, 'Kanotcenter SVIMA SPORT AB', '', '08-7302210', 'Ekelundsvägen 26', '', '171 73', 'Solna', 'http://www.svima.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'kanotcentersvimasportab', '2016-05-25 07:12:29', '2016-05-25 07:12:29', 'se', '0.00', 0, '0.00', 0, ''),
(25, 'Olofströms FK Kanotcentral.', '', '0454-402 80', 'Strandvägen 14', '', 'SE-293 39', 'Olofström', 'https://www.halenkanot.com', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'olofstrmsfkkanotcentral', '2016-06-17 05:33:18', '2016-06-17 05:33:18', 'se', '0.00', 0, '0.00', 0, ''),
(26, 'James Farrell', '', '15217204169', 'weserstr 37', '', '12045', 'Berlin', '', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'jamesfarrell1', '2016-06-22 13:03:26', '2016-06-22 13:03:26', 'se', '0.00', 0, '0.00', 0, ''),
(27, 'Guide Natura', '', '070 6722109', 'Lövgrundsvägen 93', '', '94141', 'Piteå', 'http://www.guide-natura.com', '00:00:00', '00:00:00', '', '', NULL, 1, '', '', '', '', '', '', '', '', 1, 1, 'guidenatura', '2016-06-27 20:08:26', '2016-06-27 21:12:01', 'se', '300.00', 0, '0.00', 0, ''),
(28, 'Friluftsfrämjandet Hammarö Lokalavdelning', '', '0729746779', 'Kilenevägen 41', '', '66342', 'Hammarö', 'http://www.friluftsframjandet.se/regioner/vast/lokalavdelningar/hammaro/', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'friluftsfrmjandethammarlokalavdelning', '2016-06-29 12:24:48', '2016-06-29 12:24:48', 'se', '0.00', 0, '0.00', 0, ''),
(29, 'Dalarö Kajak', '', '0739741034', 'Ångbåtsvägen 7', '', '13246', 'Saltsjö-Boo', 'http://www.dalarokajak.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'dalarkajak', '2016-10-21 07:52:45', '2016-10-21 08:01:51', 'se', '0.00', 0, '0.00', 0, ''),
(30, 'Kustleden Turism HB', '', '0650740030', 'Harmångersvägen  2', '', '82072', 'Strömsbruk', 'http://kustleden.com', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'kustledenturismhb', '2016-10-21 13:33:18', '2016-10-21 13:33:18', 'se', '0.00', 0, '0.00', 0, ''),
(31, 'EMventure AB', '', '072 514 64 02', 'Emhult 7', '', '57016', 'Kvillsfors', 'http://www.emventure.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'emventureab', '2016-10-21 14:03:00', '2016-10-21 14:03:00', 'se', '0.00', 0, '0.00', 0, ''),
(32, 'Nynäs Kajak & Upplevelse HB', '', '0707133470', 'Rosenvägen 21', '', '14941', 'Nynäshamn', 'http://www.nynaskajak.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'nynskajakupplevelsehb', '2016-10-21 14:10:04', '2016-10-21 14:10:04', 'se', '0.00', 0, '0.00', 0, ''),
(33, 'Gräsö Kanotcentral', 'http://www.grasokanot.se/logotyp2.jpg', '0173-360 03', 'Rävsten', '', '742 96', 'Gräsö', 'http://www.grasokanot.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 1, 'grskanotcentral', '2016-10-28 23:18:56', '2016-11-24 11:18:26', 'se', '0.00', 0, '0.00', 0, ''),
(34, 'Silverlake camp & Kanot', '', '070 6655222', 'Brogatan 2', '', '666 31', 'Bengtsfors', 'www.silverlake.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'silverlakecampkanot', '2016-11-03 08:28:25', '2016-11-14 12:27:08', 'se', '0.00', 0, '0.00', 0, ''),
(35, 'Voxnabruk Mat & Nöje AB', '', '0271 41150', 'Torrabergsvägen 4', '', '828 34', 'Edsbyn', 'http://www.kanotcamping.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 3, 'voxnabrukmatnjeab', '2016-12-08 19:11:47', '2016-12-12 12:08:01', 'se', '200.00', 0, '0.00', 0, ''),
(36, 'Sico Dob', '', '0738125601', 'Saxhyttevägen 2', 'Heikevägen 2', '71234', 'Hallefors', 'http://www.halleforsvandrarhem.com', '00:00:00', '00:00:00', '', '', NULL, 14, '', '', '', '', '', '', '', '', 1, 14, 'hlleforsvandrarhemkanotcenter', '2017-02-07 15:15:57', '2017-11-17 15:29:15', 'se', '0.00', 0, '0.00', 0, ''),
(37, 'Kajak & Uteliv', '', '0700914586', 'Gräddö Brygga', '', '760 15', 'Gräddö', 'http://www.kajak-uteliv.com', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'kajakuteliv', '2017-02-08 08:10:40', '2017-02-08 08:10:40', 'se', '0.00', 0, '0.00', 0, ''),
(38, 'Horisont Kajak', 'http://media1.horisontkajak.se/2016/09/logo-100-1.png', '+46 76 808 88 25', 'Apelvägen 25 only for mail', 'Address of operation: Norråvavägen, 13990 Värmdö ', '13437', 'Gustavsberg', 'http://www.horisontkajak.se', '00:00:00', '00:00:00', '', '', NULL, 1, '', '', '', '', '', '', '', '', 0, 0, 'horisontkajak', '2017-03-21 12:45:50', '2017-03-27 17:22:44', 'se', '0.00', 0, '0.00', 0, ''),
(39, 'André Axelsson Friluftsliv i Västmanland AB', '', '021-26100', 'Hejalund 1', '', '72695', 'Västerås', 'http://www.lakesideadventure.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'andraxelssonfriluftslivivstmanlandab', '2017-04-20 15:24:58', '2017-04-20 15:24:58', 'se', '0.00', 0, '0.00', 0, ''),
(40, 'SPK Test', '', '0709-500868', '-', '-', '-', 'Vällingby', 'http://www.spk.nu', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'spktest', '2017-05-23 18:22:30', '2017-05-23 18:37:48', 'se', '0.00', 0, '0.00', 0, ''),
(41, 'adm', '', '086712312', 'ad', 'admin', '12111', 'as', 'http:rebuy.com', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '6323', '84FOgBccj5pvJyT', '6323', '84FOgBccj5pvJyT', 1, 0, 'adm', '2017-09-16 01:14:08', '2017-09-16 01:17:18', 'se', '0.00', 0, '0.00', 0, ''),
(42, 'Sjöstugans camping i Älmhult AB', '', '0476-71600', 'Bökhult 27', '', '343 38', 'Älmhult', 'https://sjostugan.com', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '6323', '84FOgBccj5pvJyT', '', '', 1, 0, 'sjstuganscampingilmhultab', '2018-02-02 07:17:57', '2018-02-14 07:43:54', 'se', '0.00', 0, '0.00', 1, ''),
(43, 'Scandinavian Kayak & Outdoors', '', '0730274954', 'Kungsgårdsvägen 12', '', '76194', 'Norrtälje', 'http://www.kayakoutdoors.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'scandinaviankayakoutdoors', '2018-03-19 07:22:41', '2018-03-19 08:38:12', 'se', '0.00', 0, '0.00', 0, ''),
(44, 'Karlstads Paddlarklubb', '', '054-186405', '', '', '', 'Karlstad', 'http://www.karlstadspaddlarklubb.se', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'karlstadspaddlarklubb1', '2018-05-10 08:51:06', '2018-05-10 08:51:06', 'se', '0.00', 0, '0.00', 0, ''),
(45, 'Hällefors Kanotcenter', '', '0728125601', 'Saxhyttevägen 2', 'Heikevägen 2', '71234', 'Hallefors', 'https://www.halleforsvandrarhem.com/', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'hlleforskanotcenter', '2018-12-07 09:39:50', '2018-12-07 09:39:50', 'se', '0.00', 0, '0.00', 0, ''),
(46, 'ISquare', '', '9876565656', 'Madurai', 'Madurai', '625010', 'Madurai', '', '00:00:00', '00:00:00', '', '', '', 0, 'pk_test_TrG9e2pQVtpHxwFeEUmQ3Tum00lSqFKUTJ', 'sk_test_BQJvIdHiEY1Bg4SpGs9NnWB900IxwrNOg4', ' 95ddc132-63e8-4dd2-88d8-dc1e5dba5d10', 'IZSECc5d3eb57-de66-4ee0-a03c-462adae55742', '', '', '', '', 1, 0, 'isquare', '2019-04-15 23:13:35', '2019-04-30 01:54:14', 'se', '0.00', 0, '0.00', 0, ''),
(47, 'Company', '', '8989897678', 'Madurai', 'Madurai', '625016', 'Madurai', '', '00:00:00', '00:00:00', '', '', '', 0, '', '', 'dghfgfh', 'uytutyuty', '', '', '', '', 1, 0, 'company', '2019-04-24 05:07:08', '2019-04-26 01:31:12', 'se', '0.00', 0, '0.00', 0, ''),
(48, 'rytyry', '', '656565656', '', '', '', '', '', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'rytyry', '2019-04-25 05:30:20', '2019-04-25 05:30:20', 'se', '0.00', 0, '0.00', 0, ''),
(49, 'jeeva', '', '8976787878', '', '', '', '', '', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'jeeva', '2019-04-26 08:21:46', '2019-04-26 08:21:46', 'se', '0.00', 0, '0.00', 0, ''),
(50, 'karthika', 'shdsk', '1234567898', 'sdf', 'aaa', 'aaaa', '', 'sdf', '08:00:00', '17:00:00', '2019/07/12, 2019/07/27', '', 'karthika@gmail.com', 2, 'sk_test_oI82V86ojy2h0kk8i3rmvW5H00OvAVTCV6', 'pk_test_10zxkRovzvmoQpSwtd2QCMSE008Vp6fwbE', '', '', '', '', '', '', 1, 1, 'isquare1', '2019-05-25 00:42:55', '2019-10-14 15:28:38', 'se', '22.00', 0, '0.00', 0, ''),
(51, 'isquare', '', '', '', '', '', '', '', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'isquare2', '2019-06-01 02:05:54', '2019-06-01 02:05:54', 'se', '0.00', 0, '0.00', 0, ''),
(52, 'isquare', '', '9898673788', '', '', '', '', '', '08:00:00', '20:00:00', '', '', '', 0, '', '', '', '', '', '', '', '', 1, 0, 'isquare3', '2019-06-06 18:16:16', '2019-06-06 18:18:55', 'se', '0.00', 0, '0.00', 0, ''),
(53, 'Isquare', '', '8987676545', 'Madurai', 'Madurai', '625009', 'Madurai', '', '09:00:00', '16:00:00', '', '', '', 0, '', '', '', '', '', '', '', '', 1, 0, 'isquare4', '2019-06-08 20:38:05', '2019-06-08 21:20:42', 'se', '0.00', 0, '0.00', 0, ''),
(54, 'iSquare', '', '8987656543', 'Madurai', 'Madurai', '625001', 'madurai', '', '09:00:00', '18:00:00', '', '', '', 0, '', '', '', '', '', '', '', '', 1, 0, 'isquare5', '2019-06-10 12:22:40', '2019-06-10 12:24:23', 'se', '0.00', 0, '0.00', 0, ''),
(55, 'test', '', '32123123', 'ds', 'sdf', '121312', 'asdsad', 'https://www.google.com', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'test1', '2019-10-22 11:39:02', '2019-10-22 11:39:02', 'se', '0.00', 0, '0.00', 0, ''),
(56, 'Rajan', '', '9876543210', 'wdsa', 'asd', '2312312', 'Test', '', '00:00:00', '00:00:00', '', '', NULL, 0, '', '', '', '', '', '', '', '', 1, 0, 'rajan', '2019-10-25 12:01:18', '2019-10-25 12:01:18', 'se', '0.00', 0, '0.00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `centre_localisation`
--

CREATE TABLE `centre_localisation` (
  `id` int(10) UNSIGNED NOT NULL,
  `centre_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centre_localisation`
--

INSERT INTO `centre_localisation` (`id`, `centre_id`, `language`, `field_name`, `field_value`) VALUES
(1033, 27, 'en', 'confirmation_email', 'contact@guide-natura.com'),
(1034, 27, 'se', 'paymentTransferHow', ''),
(1035, 27, 'en', 'paymentTransferHow', ''),
(1036, 27, 'de', 'paymentTransferHow', ''),
(1037, 27, 'se', 'paymentCashHow', ''),
(1038, 27, 'en', 'paymentCashHow', ''),
(1039, 27, 'de', 'paymentCashHow', ''),
(1040, 27, 'se', 'paymentInvoiceHow', ''),
(1041, 27, 'en', 'paymentInvoiceHow', ''),
(1042, 27, 'de', 'paymentInvoiceHow', ''),
(1043, 27, 'se', 'invoice_text', ''),
(1044, 27, 'en', 'invoice_text', ''),
(1045, 27, 'de', 'invoice_text', ''),
(1046, 27, 'se', 'intro_text', ''),
(1047, 27, 'en', 'intro_text', ''),
(1048, 27, 'de', 'intro_text', ''),
(1049, 27, 'se', 'confirmation_text', ''),
(1050, 27, 'en', 'confirmation_text', ''),
(1051, 27, 'de', 'confirmation_text', ''),
(1052, 27, 'se', 'booking_conditions', ''),
(1053, 27, 'en', 'booking_conditions', ''),
(1054, 27, 'de', 'booking_conditions', ''),
(1055, 27, 'se', 'payment_policy', ''),
(1056, 27, 'en', 'payment_policy', ''),
(1057, 27, 'de', 'payment_policy', ''),
(1058, 27, 'se', 'admin_fee', ''),
(1059, 27, 'en', 'admin_fee', ''),
(1060, 27, 'de', 'admin_fee', ''),
(1173, 29, 'en', 'confirmation_email', ''),
(1174, 29, 'se', 'paymentTransferHow', ''),
(1175, 29, 'en', 'paymentTransferHow', ''),
(1176, 29, 'de', 'paymentTransferHow', ''),
(1177, 29, 'se', 'paymentCashHow', ''),
(1178, 29, 'en', 'paymentCashHow', ''),
(1179, 29, 'de', 'paymentCashHow', ''),
(1180, 29, 'se', 'paymentInvoiceHow', ''),
(1181, 29, 'en', 'paymentInvoiceHow', ''),
(1182, 29, 'de', 'paymentInvoiceHow', ''),
(1183, 29, 'se', 'invoice_text', ''),
(1184, 29, 'en', 'invoice_text', ''),
(1185, 29, 'de', 'invoice_text', ''),
(1186, 29, 'se', 'intro_text', ''),
(1187, 29, 'en', 'intro_text', ''),
(1188, 29, 'de', 'intro_text', ''),
(1189, 29, 'se', 'confirmation_text', ''),
(1190, 29, 'en', 'confirmation_text', ''),
(1191, 29, 'de', 'confirmation_text', ''),
(1192, 29, 'se', 'booking_conditions', ''),
(1193, 29, 'en', 'booking_conditions', ''),
(1194, 29, 'de', 'booking_conditions', ''),
(1195, 29, 'se', 'payment_policy', ''),
(1196, 29, 'en', 'payment_policy', ''),
(1197, 29, 'de', 'payment_policy', ''),
(1198, 29, 'se', 'admin_fee', ''),
(1199, 29, 'en', 'admin_fee', ''),
(1200, 29, 'de', 'admin_fee', ''),
(1285, 34, 'en', 'confirmation_email', 'office@silverlake.se '),
(1286, 34, 'se', 'paymentTransferHow', ''),
(1287, 34, 'en', 'paymentTransferHow', ''),
(1288, 34, 'de', 'paymentTransferHow', ''),
(1289, 34, 'se', 'paymentCashHow', ''),
(1290, 34, 'en', 'paymentCashHow', ''),
(1291, 34, 'de', 'paymentCashHow', ''),
(1292, 34, 'se', 'paymentInvoiceHow', ''),
(1293, 34, 'en', 'paymentInvoiceHow', ''),
(1294, 34, 'de', 'paymentInvoiceHow', ''),
(1295, 34, 'se', 'invoice_text', ''),
(1296, 34, 'en', 'invoice_text', ''),
(1297, 34, 'de', 'invoice_text', ''),
(1298, 34, 'se', 'intro_text', ''),
(1299, 34, 'en', 'intro_text', ''),
(1300, 34, 'de', 'intro_text', ''),
(1301, 34, 'se', 'confirmation_text', ''),
(1302, 34, 'en', 'confirmation_text', ''),
(1303, 34, 'de', 'confirmation_text', ''),
(1304, 34, 'se', 'booking_conditions', ''),
(1305, 34, 'en', 'booking_conditions', ''),
(1306, 34, 'de', 'booking_conditions', ''),
(1307, 34, 'se', 'payment_policy', ''),
(1308, 34, 'en', 'payment_policy', ''),
(1309, 34, 'de', 'payment_policy', ''),
(1310, 34, 'se', 'admin_fee', ''),
(1311, 34, 'en', 'admin_fee', ''),
(1312, 34, 'de', 'admin_fee', ''),
(1509, 33, 'en', 'confirmation_email', 'info@grasokanot.se'),
(1510, 33, 'se', 'paymentTransferHow', ''),
(1511, 33, 'en', 'paymentTransferHow', ''),
(1512, 33, 'de', 'paymentTransferHow', ''),
(1513, 33, 'se', 'paymentCashHow', 'Du kan betala direkt på plats, med antingen bankkort(Visa, Mastercard, Maestro m.m.) eller med kontanter.'),
(1514, 33, 'en', 'paymentCashHow', 'You can pay when you come here, with either debit cards (Visa, MasterCard, Maestro, etc.) or cash.'),
(1515, 33, 'de', 'paymentCashHow', 'Sie können zahlen, wenn Sie hierher kommen, mit entweder Debitkarten (Visa, MasterCard, Maestro, etc.) oder Bargeld.'),
(1516, 33, 'se', 'paymentInvoiceHow', 'Föreningar eller företag kan betala via faktura i efterskott, med upp till 20 dagars kredit.\r\nFakturaavgift på 25 kr tillkommer per faktura.'),
(1517, 33, 'en', 'paymentInvoiceHow', 'Only companies can pay by invoice.'),
(1518, 33, 'de', 'paymentInvoiceHow', 'Nur Unternehmen können per Rechnung bezahlen.'),
(1519, 33, 'se', 'invoice_text', ''),
(1520, 33, 'en', 'invoice_text', ''),
(1521, 33, 'de', 'invoice_text', ''),
(1522, 33, 'se', 'intro_text', ''),
(1523, 33, 'en', 'intro_text', ''),
(1524, 33, 'de', 'intro_text', ''),
(1525, 33, 'se', 'confirmation_text', 'Tack så mycket för din bokning, vi på Gräsö Kanotcentral hoppas att du/ni får en riktigt trevlig upplevelse här.\r\nÅterkom gärna vid eventuella frågor, gällande exempelvis tider, väderlek, utrustning, transport, m.m.\r\nVi nås lättast antingen via telefon, sms eller e-post.\r\n\r\nVanligtvis räcker det att man åker med Gräsöfärjan som avgår från Öregrund senast 30 minuter före din inbokade tid. Oftast avgår färjan varje hel- och halvtimme(se gärna tidtabell för mer info). Men tänk på att vissa dagar och tider kan det vara mycket trafik, vilket gör att färjan kör skytteltrafik i stället. Meddela oss snarast möjliga om det blir någon avvikelse.\r\nBehöver du/ni proviantera, så finns en Ica-butik strax norr om färjeläget på Gräsö.\r\n\r\n\r\nHjärtligt välkomna hit till Gräsö Kanotcentral, här på ön Rävsten!\r\n\r\n\r\nVänliga Hälsningar\r\nAlexander med personal\r\n\r\n\r\nTelefon: 0173-360 03\r\nMobil: 070-446 42 95\r\nE-post: info@grasokanot.se'),
(1526, 33, 'en', 'confirmation_text', ''),
(1527, 33, 'de', 'confirmation_text', ''),
(1528, 33, 'se', 'booking_conditions', ''),
(1529, 33, 'en', 'booking_conditions', ''),
(1530, 33, 'de', 'booking_conditions', ''),
(1531, 33, 'se', 'payment_policy', ''),
(1532, 33, 'en', 'payment_policy', ''),
(1533, 33, 'de', 'payment_policy', ''),
(1534, 33, 'se', 'admin_fee', ''),
(1535, 33, 'en', 'admin_fee', ''),
(1536, 33, 'de', 'admin_fee', ''),
(1565, 35, 'en', 'confirmation_email', 'info@kanotcamping.se'),
(1566, 35, 'se', 'paymentTransferHow', ''),
(1567, 35, 'en', 'paymentTransferHow', ''),
(1568, 35, 'de', 'paymentTransferHow', ''),
(1569, 35, 'se', 'paymentCashHow', ''),
(1570, 35, 'en', 'paymentCashHow', ''),
(1571, 35, 'de', 'paymentCashHow', ''),
(1572, 35, 'se', 'paymentInvoiceHow', ''),
(1573, 35, 'en', 'paymentInvoiceHow', ''),
(1574, 35, 'de', 'paymentInvoiceHow', ''),
(1575, 35, 'se', 'invoice_text', ''),
(1576, 35, 'en', 'invoice_text', ''),
(1577, 35, 'de', 'invoice_text', ''),
(1578, 35, 'se', 'intro_text', ''),
(1579, 35, 'en', 'intro_text', ''),
(1580, 35, 'de', 'intro_text', ''),
(1581, 35, 'se', 'confirmation_text', ''),
(1582, 35, 'en', 'confirmation_text', ''),
(1583, 35, 'de', 'confirmation_text', ''),
(1584, 35, 'se', 'booking_conditions', ''),
(1585, 35, 'en', 'booking_conditions', ''),
(1586, 35, 'de', 'booking_conditions', ''),
(1587, 35, 'se', 'payment_policy', ''),
(1588, 35, 'en', 'payment_policy', ''),
(1589, 35, 'de', 'payment_policy', ''),
(1590, 35, 'se', 'admin_fee', ''),
(1591, 35, 'en', 'admin_fee', ''),
(1592, 35, 'de', 'admin_fee', ''),
(2041, 38, 'en', 'confirmation_email', 'info@horisontkajak.se'),
(2042, 38, 'se', 'paymentTransferHow', ''),
(2043, 38, 'en', 'paymentTransferHow', ''),
(2044, 38, 'de', 'paymentTransferHow', ''),
(2045, 38, 'se', 'paymentCashHow', ''),
(2046, 38, 'en', 'paymentCashHow', ''),
(2047, 38, 'de', 'paymentCashHow', ''),
(2048, 38, 'se', 'paymentInvoiceHow', ''),
(2049, 38, 'en', 'paymentInvoiceHow', ''),
(2050, 38, 'de', 'paymentInvoiceHow', ''),
(2051, 38, 'se', 'invoice_text', ''),
(2052, 38, 'en', 'invoice_text', ''),
(2053, 38, 'de', 'invoice_text', ''),
(2054, 38, 'se', 'intro_text', ''),
(2055, 38, 'en', 'intro_text', ''),
(2056, 38, 'de', 'intro_text', ''),
(2057, 38, 'se', 'confirmation_text', ''),
(2058, 38, 'en', 'confirmation_text', ''),
(2059, 38, 'de', 'confirmation_text', ''),
(2060, 38, 'se', 'booking_conditions', 'Dessa villkor är tillämpliga avseende uthyrning, kurser och utfärder för företag och privatpersoner. Villkoren gäller inte våra aktiviteter utomlands.\r\n\r\nDet här ingår:\r\nKapell, flytväst och paddel. Sjökort/karta och kompass tar du med själv eller hyr/köper på plats.\r\n\r\nBokning och betalning\r\nBokning sker via vårt bokningsformulär. Din bokning är bindande och när du bokar betalar du med ditt bankkort eller via bankgiro. När du gjort det är din kajak reserverad åt dej eller din kursplats/aktivitet reserverad. Vid betalningspåminnelse debiterar vi påminnelseavgift.\r\n\r\nNär du bokar betalar du hela beloppet.\r\n\r\nAvbokning\r\nOm du bokar av tidigare än 21 dagar innan bokad aktivitet betalar vi tillbaka hela beloppet med 200 kr i avdrag för administrationskostnader.\r\nOm du bokar av 8-20 dagar innan bokad aktivitet betalar vi tillbaka 75% av det totala beloppet.\r\nOm du bokar av 1-7 dagar innan bokad aktivitet betalar vi tillbaka 50% av det totala beloppet.\r\nOm du bokar av mindre än 24 timmar innan bokad aktivitet görs ingen återbetalning.\r\nOm du uteblir utan att avboka görs ingen återbetalning.\r\n\r\nVi (Horisont Kajak AB) förbinder oss att hyra ut kajaker som är hela, funktionsdugliga och ändamålsenliga. Tillhörande utrustning ska likaledes vara i gott skick.\r\n\r\nVill du inte göra rent din kajak själv kan du köpa tjänsten av oss för 200 kr när du bokar. Det är även vad vi debiterar dig om du försummat att göra rent din kajak.\r\n\r\nAnsvar och försäkring\r\nDu måste vara simkunnig\r\n\r\nFlytväst måste du ha på dig när kajaken är på vattnet.\r\n\r\nBlir du försenad är du skyldig att meddela oss. Återkommer du inte när du angivit har vi rätt att kontakta Sjöräddningen.\r\nOm du uppträder olämpligt (t ex underlåter att iaktta allemansrättens regler, låter bli att bära flytväst), eller begår lagbrott, förbehåller vi oss rätten att återta hyrd utrustning för resterande hyrestid. Hyresbeloppet reduceras inte om vi behöver göra detta.\r\nAll paddling med våra kajaker sker på egen risk. Att paddla kajak räknas som att framföra vilken annan fritidsbåt som helst. Det är ditt ansvar att paddla enligt gällande sjöregler.\r\n\r\nOm skada uppstår på kajaken eller annan utrustning är du ersättningsansvarig. Kontrollera med ditt försäkringsbolag vad din hemförsäkring täcker vid skada eller förlust av hyrd utrustning.\r\n\r\nDu har ansvar för att lämna tillbaka kajaken vid hyrestidens slut. Horisont Kajak har inte ansvar för att transportera kajaker eller personer som inte förmår återvända till Norråva när hyrestiden är slut. Skulle du som kund vara i behov av assistans hjälper vi till i mån av resurser mot ersättning. I annat fall måste vi hänvisa till taxibåt.\r\n\r\nHorisont Kajak AB omfattas av en ansvarsförsäkring vid aktiviteter och kurser som arrangeras av oss.\r\n\r\nUtlämnings- och inlämningstider:\r\n\r\nUtlämning:\r\nFörmiddag: från kl 10.00\r\nEftermiddag: 17.30-17.45\r\n\r\nInlämning:\r\nSenast 17.30\r\nDå ska kajaker och utrustning vara rengjorda och färdiga för oss att besiktiga så att nästa kund får hel och ren utrustning.\r\n\r\nÅterlämnar du din kajak senare än ovan angivna tid debiterar vi dig 250 kr per påbörjad halvtimme.'),
(2061, 38, 'en', 'booking_conditions', ''),
(2062, 38, 'de', 'booking_conditions', ''),
(2063, 38, 'se', 'payment_policy', 'När betalning är gjord är din kajak eller tjänst reserverad. '),
(2064, 38, 'en', 'payment_policy', ''),
(2065, 38, 'de', 'payment_policy', ''),
(2066, 38, 'se', 'admin_fee', ''),
(2067, 38, 'en', 'admin_fee', ''),
(2068, 38, 'de', 'admin_fee', ''),
(2097, 40, 'en', 'confirmation_email', 'per.t.sjoholm@spk.nu'),
(2098, 40, 'se', 'paymentTransferHow', ''),
(2099, 40, 'en', 'paymentTransferHow', ''),
(2100, 40, 'de', 'paymentTransferHow', ''),
(2101, 40, 'se', 'paymentCashHow', ''),
(2102, 40, 'en', 'paymentCashHow', ''),
(2103, 40, 'de', 'paymentCashHow', ''),
(2104, 40, 'se', 'paymentInvoiceHow', ''),
(2105, 40, 'en', 'paymentInvoiceHow', ''),
(2106, 40, 'de', 'paymentInvoiceHow', ''),
(2107, 40, 'se', 'invoice_text', ''),
(2108, 40, 'en', 'invoice_text', ''),
(2109, 40, 'de', 'invoice_text', ''),
(2110, 40, 'se', 'intro_text', ''),
(2111, 40, 'en', 'intro_text', ''),
(2112, 40, 'de', 'intro_text', ''),
(2113, 40, 'se', 'confirmation_text', ''),
(2114, 40, 'en', 'confirmation_text', ''),
(2115, 40, 'de', 'confirmation_text', ''),
(2116, 40, 'se', 'booking_conditions', ''),
(2117, 40, 'en', 'booking_conditions', ''),
(2118, 40, 'de', 'booking_conditions', ''),
(2119, 40, 'se', 'payment_policy', ''),
(2120, 40, 'en', 'payment_policy', ''),
(2121, 40, 'de', 'payment_policy', ''),
(2122, 40, 'se', 'admin_fee', ''),
(2123, 40, 'en', 'admin_fee', ''),
(2124, 40, 'de', 'admin_fee', ''),
(2153, 41, 'en', 'confirmation_email', ''),
(2154, 41, 'se', 'paymentTransferHow', ''),
(2155, 41, 'en', 'paymentTransferHow', ''),
(2156, 41, 'de', 'paymentTransferHow', ''),
(2157, 41, 'se', 'paymentCashHow', ''),
(2158, 41, 'en', 'paymentCashHow', ''),
(2159, 41, 'de', 'paymentCashHow', ''),
(2160, 41, 'se', 'paymentInvoiceHow', ''),
(2161, 41, 'en', 'paymentInvoiceHow', ''),
(2162, 41, 'de', 'paymentInvoiceHow', ''),
(2163, 41, 'se', 'invoice_text', ''),
(2164, 41, 'en', 'invoice_text', ''),
(2165, 41, 'de', 'invoice_text', ''),
(2166, 41, 'se', 'intro_text', ''),
(2167, 41, 'en', 'intro_text', ''),
(2168, 41, 'de', 'intro_text', ''),
(2169, 41, 'se', 'confirmation_text', ''),
(2170, 41, 'en', 'confirmation_text', ''),
(2171, 41, 'de', 'confirmation_text', ''),
(2172, 41, 'se', 'booking_conditions', ''),
(2173, 41, 'en', 'booking_conditions', ''),
(2174, 41, 'de', 'booking_conditions', ''),
(2175, 41, 'se', 'payment_policy', ''),
(2176, 41, 'en', 'payment_policy', ''),
(2177, 41, 'de', 'payment_policy', ''),
(2178, 41, 'se', 'admin_fee', ''),
(2179, 41, 'en', 'admin_fee', ''),
(2180, 41, 'de', 'admin_fee', ''),
(2181, 36, 'en', 'confirmation_email', 'info@halleforsvandrarhem.com'),
(2182, 36, 'se', 'paymentTransferHow', ''),
(2183, 36, 'en', 'paymentTransferHow', ''),
(2184, 36, 'de', 'paymentTransferHow', ''),
(2185, 36, 'se', 'paymentCashHow', ''),
(2186, 36, 'en', 'paymentCashHow', ''),
(2187, 36, 'de', 'paymentCashHow', ''),
(2188, 36, 'se', 'paymentInvoiceHow', '20 % vid bokning och restsumma vid anresa med kort eller kontant'),
(2189, 36, 'en', 'paymentInvoiceHow', '20 % deposit with booking and restamount at arrival with card or cash'),
(2190, 36, 'de', 'paymentInvoiceHow', '20% Anzahlung bei Buchung und Restbetrag bei Anreise mit Karte oder Kontant'),
(2191, 36, 'se', 'invoice_text', ''),
(2192, 36, 'en', 'invoice_text', ''),
(2193, 36, 'de', 'invoice_text', ''),
(2194, 36, 'se', 'intro_text', ''),
(2195, 36, 'en', 'intro_text', ''),
(2196, 36, 'de', 'intro_text', ''),
(2197, 36, 'se', 'confirmation_text', ''),
(2198, 36, 'en', 'confirmation_text', ''),
(2199, 36, 'de', 'confirmation_text', ''),
(2200, 36, 'se', 'booking_conditions', ''),
(2201, 36, 'en', 'booking_conditions', ''),
(2202, 36, 'de', 'booking_conditions', ''),
(2203, 36, 'se', 'payment_policy', ''),
(2204, 36, 'en', 'payment_policy', ''),
(2205, 36, 'de', 'payment_policy', ''),
(2206, 36, 'se', 'admin_fee', ''),
(2207, 36, 'en', 'admin_fee', ''),
(2208, 36, 'de', 'admin_fee', ''),
(2209, 42, 'en', 'confirmation_email', ''),
(2210, 42, 'se', 'paymentTransferHow', ''),
(2211, 42, 'en', 'paymentTransferHow', ''),
(2212, 42, 'de', 'paymentTransferHow', ''),
(2213, 42, 'se', 'paymentCashHow', ''),
(2214, 42, 'en', 'paymentCashHow', ''),
(2215, 42, 'de', 'paymentCashHow', ''),
(2216, 42, 'se', 'paymentInvoiceHow', ''),
(2217, 42, 'en', 'paymentInvoiceHow', ''),
(2218, 42, 'de', 'paymentInvoiceHow', ''),
(2219, 42, 'se', 'invoice_text', ''),
(2220, 42, 'en', 'invoice_text', ''),
(2221, 42, 'de', 'invoice_text', ''),
(2222, 42, 'se', 'intro_text', ''),
(2223, 42, 'en', 'intro_text', ''),
(2224, 42, 'de', 'intro_text', ''),
(2225, 42, 'se', 'confirmation_text', ''),
(2226, 42, 'en', 'confirmation_text', ''),
(2227, 42, 'de', 'confirmation_text', ''),
(2228, 42, 'se', 'booking_conditions', ''),
(2229, 42, 'en', 'booking_conditions', ''),
(2230, 42, 'de', 'booking_conditions', ''),
(2231, 42, 'se', 'payment_policy', ''),
(2232, 42, 'en', 'payment_policy', ''),
(2233, 42, 'de', 'payment_policy', ''),
(2234, 42, 'se', 'admin_fee', ''),
(2235, 42, 'en', 'admin_fee', ''),
(2236, 42, 'de', 'admin_fee', ''),
(2293, 43, 'en', 'confirmation_email', ''),
(2294, 43, 'se', 'paymentTransferHow', 'Efter bokningen är gjord ska inbetalning ske till BG 123-456 senast 10 dagar efter bekräftelse för att bokningen ska vara fullgjord. '),
(2295, 43, 'en', 'paymentTransferHow', ''),
(2296, 43, 'de', 'paymentTransferHow', ''),
(2297, 43, 'se', 'paymentCashHow', ''),
(2298, 43, 'en', 'paymentCashHow', ''),
(2299, 43, 'de', 'paymentCashHow', ''),
(2300, 43, 'se', 'paymentInvoiceHow', ''),
(2301, 43, 'en', 'paymentInvoiceHow', ''),
(2302, 43, 'de', 'paymentInvoiceHow', ''),
(2303, 43, 'se', 'invoice_text', 'Test på fakturatext'),
(2304, 43, 'en', 'invoice_text', ''),
(2305, 43, 'de', 'invoice_text', ''),
(2306, 43, 'se', 'intro_text', ''),
(2307, 43, 'en', 'intro_text', ''),
(2308, 43, 'de', 'intro_text', ''),
(2309, 43, 'se', 'confirmation_text', ''),
(2310, 43, 'en', 'confirmation_text', ''),
(2311, 43, 'de', 'confirmation_text', ''),
(2312, 43, 'se', 'booking_conditions', ''),
(2313, 43, 'en', 'booking_conditions', ''),
(2314, 43, 'de', 'booking_conditions', ''),
(2315, 43, 'se', 'payment_policy', ''),
(2316, 43, 'en', 'payment_policy', ''),
(2317, 43, 'de', 'payment_policy', ''),
(2318, 43, 'se', 'admin_fee', ''),
(2319, 43, 'en', 'admin_fee', ''),
(2320, 43, 'de', 'admin_fee', ''),
(2657, 20, 'en', 'confirmation_email', ''),
(2658, 20, 'se', 'paymentTransferHow', ''),
(2659, 20, 'en', 'paymentTransferHow', ''),
(2660, 20, 'de', 'paymentTransferHow', ''),
(2661, 20, 'se', 'paymentCashHow', ''),
(2662, 20, 'en', 'paymentCashHow', ''),
(2663, 20, 'de', 'paymentCashHow', ''),
(2664, 20, 'se', 'paymentInvoiceHow', ''),
(2665, 20, 'en', 'paymentInvoiceHow', ''),
(2666, 20, 'de', 'paymentInvoiceHow', ''),
(2667, 20, 'se', 'invoice_text', ''),
(2668, 20, 'en', 'invoice_text', ''),
(2669, 20, 'de', 'invoice_text', ''),
(2670, 20, 'se', 'intro_text', ''),
(2671, 20, 'en', 'intro_text', ''),
(2672, 20, 'de', 'intro_text', ''),
(2673, 20, 'se', 'confirmation_text', ''),
(2674, 20, 'en', 'confirmation_text', ''),
(2675, 20, 'de', 'confirmation_text', ''),
(2676, 20, 'se', 'booking_conditions', 'Detta är våra bokningsregler på svenska. Kontakta oss angående avbokning. Tänk på att tvätta kanoterna efter användning, annars kommer vi att behöva städa dem själva och kanske ta ut en extra avgift för detta. Skriv mer bokningsregler här. Tänk på att om du bokar så accepterar du dessa bokningsregler!'),
(2677, 20, 'en', 'booking_conditions', ''),
(2678, 20, 'de', 'booking_conditions', ''),
(2679, 20, 'se', 'payment_policy', 'Detta är betalningsvillkoren. Du kan skriva vad du vill här, men tänk på att betalning ska vara oss tillhanda innan du börjar paddla. Om du avbokar dina kanoter så får du såklart tillbaka pengarna av oss. Och så vidare.'),
(2680, 20, 'en', 'payment_policy', ''),
(2681, 20, 'de', 'payment_policy', ''),
(2682, 20, 'se', 'admin_fee', ''),
(2683, 20, 'en', 'admin_fee', ''),
(2684, 20, 'de', 'admin_fee', ''),
(3011, 17, 'se', 'paymentTransferHow', ''),
(3012, 17, 'en', 'paymentTransferHow', ''),
(3013, 17, 'de', 'paymentTransferHow', ''),
(3014, 17, 'se', 'paymentCashHow', 'Betala på plats med kort eller Swish'),
(3015, 17, 'en', 'paymentCashHow', 'Please pay at location with your credit card.'),
(3016, 17, 'de', 'paymentCashHow', ''),
(3017, 17, 'se', 'paymentInvoiceHow', ''),
(3018, 17, 'en', 'paymentInvoiceHow', ''),
(3019, 17, 'de', 'paymentInvoiceHow', ''),
(3020, 17, 'se', 'invoice_text', ''),
(3021, 17, 'en', 'invoice_text', ''),
(3022, 17, 'de', 'invoice_text', ''),
(3023, 17, 'se', 'intro_text', ''),
(3024, 17, 'en', 'intro_text', ''),
(3025, 17, 'de', 'intro_text', ''),
(3026, 17, 'se', 'confirmation_text', 'Tack för din bokning.\r\nBokningen är inte giltig förrän du har tagit emot ett aktiveringsmejl.\r\n\r\nDu finner oss här, https://goo.gl/maps/rg13i.'),
(3027, 17, 'en', 'confirmation_text', 'Thank you for your booking.\r\n\r\n\r\nYou will find us at this location, https://goo.gl/maps/rg13i.'),
(3028, 17, 'de', 'confirmation_text', ''),
(3029, 17, 'se', 'booking_conditions', 'ALLMÄNNA VILLKOR FÖR UTHYRNING AV KANOTER\r\n\r\nAvtalsvillkor antagna av Svenska Kanotförbundet efter förhandlingar med Konsumentverket/KO att tillämpas.\r\n\r\n1. Villkoren avser yrkesmässig uthyrning till konsument och gäller för:\r\n- kanoter som uthyres för enskilt bruk\r\n\r\n2. Beställning\r\nBeställningen är bindande för båda parter när avtal är undertecknat eller uthyraren skriftligen bekräftat hyresmannens beställning.\r\n\r\n3. Kanotens användning\r\nKanoten får användas i Norden om ej annat avtalats i det enskilda fallet. Hyresmannen får inte hyra ut kanoten till annan utom enligt vad som sägs i punkt 6 angående överlåtelse av kontrakt före hyrestidens början.\r\n\r\n4. Betalning\r\nUthyraren äger rätt att begära att hyresmannen vid avtalets ingående erlägger en bokningsavgift uppgående till:\r\n\r\n20 % av den totala hyran 30 dagar före hyrestiden\r\n30 % av den totala hyran 29 – 14 dagar före hyrestiden\r\n40 % av den totala hyran 13 – 7 dagar före hyrestiden\r\n\r\nHyra utöver bokningsavgift betalas senast vid hyrestidens början om inte annat avtalats i det särskilda fallet. Om inte hyran betalas i rätt tid har uthyraren rätt att debitera dröjsmålsränta enligt räntelagen. Uthyraren har rätt att häva avtalet om inte hyresmannen betalar i rätt tid och förseningen inte är av liten betydelse för uthyraren. Hyresmannen är då ersättningsskyldig med hela hyresbeloppet om inte kanoten kan hyras ut till annan.\r\n\r\n5. Avbeställning\r\nOm hyresmannen avbeställer kanoten 7 dagar före hyrestidens början eller mer äger uthyraren tillgodoräkna sig den erlagda bokningsavgiften (se punkt 4). Om kanoten avbeställs senare än 7 dagar före hyrestiden men tidigare än 24 timmar innan, har uthyraren rätt att tillgodoräkna sig 50 % av den totala hyreskostnaden. Om kanoten avbeställs inom 24 timmar före hyrestidens början har uthyraren rätt att tillgodoräkna sig 80 % av den totala hyreskostnaden. Om avbeställd kanot hyrs ut till annan\r\nhar hyresmannen rätt att återfå erlagt belopp med avdrag för en expeditionsavgift om högst 100 kr. Expeditionsavgiften får dock inte överstiga avbeställningsavgiften enligt första stycket. Hyresmannen skall i så fall omgående återfå mellanskillnaden från uthyraren. Vid avbeställning av kanot före hyrestidens början pga dödsfall, allvarlig sjukdom eller liknande omständighet som  drabbat hyresmannen eller någon i dennes familj skall uthyraren återbetala vad om erlagts av hyresmannen. Sjukdom etc skall kunna styrkas genom läkarintyg eller liknande.\r\n\r\n6. Överlåtelse av kontrakt före hyrestidens början\r\nHyresmannen har alltid rätt att, istället för avbeställning, överlåta hyreskontraktet till annan person om inte uthyraren har grundad anledning att vägra godta denne som hyresman. Den ursprungliga hyresmannen blir därmed fri från alla åtaganden gentemot uthyraren.\r\n\r\n7. Kanotens skick och utrustning\r\nDet åligger uthyraren att vid hyrestidens början avlämna den avtalade kanoten i sjövärdigt och i övrigt funktionsdugligt skick samt försedd med erforderlig säkerhetsutrustning och beställd extra utrustning. Sedan är det kundens ansvar att den återges i samma skick.\r\n\r\n8. Försenad eller felaktig leverans\r\nTillhandahåller uthyraren inte kanoten i avtalsenligt skick och med avtalad utrustning vid den tidpunkt som överenskommits, är hyresmannen berättigad till sådan nedsättning av hyran som svarar mot förseningen. Om rättelse inte sker inom 3 timmar från avtalad tidpunkt, har hyresmannen rätt att häva avtalet. Hävning får dock inte ske om felet endast är av ringa betydelse för hyresmannen eller om uthyraren inom 3 timmar från avtalad tidpunkt tillhandahåller annan likvärdig kanot eller utrustning. Uthyraren är skyldig att ge hyresmannen skälig ersättning för den skada han åsamkats genom förseningen, utom då uthyraren kan visa att förseningen inte beror på försummelse från hans sida. Motsvarande gäller om avtalet hävs.\r\n\r\n9. Åtgärder vid fel, skada och förlust\r\nVid fel eller skada på kanot eller tillbehör, liksom vid förlust av kanot eller tillbehör, åligger det hyresmannen att snarast möjligt underrätta uthyraren. Uthyraren skall efter sådan underrättelse ofördröjligen meddela hyresmannen vilka åtgärder han skall vidta.\r\n\r\n10. Hyresmannens ansvar vid fel, skada och förlust\r\nHyresmannen är skyldig att ersätta förlust eller skada på kanot utom då han kan göra sannolikt att han inte varit försumlig. Hyresmannen är dock inte ersättningsskyldig för skada som uppkommit genom yttre olyckshändelse utanför hans kontroll, inte heller för uthyrarens kostnader i anledning av sådan olyckshändelse.\r\n\r\n11. Uthyrarens ansvar vid fel, skada och förlust\r\nOm fel, skada eller förlust av kanot eller tillbehör uppkommer under hyrestiden, och hyresmannen inte är ansvarig enligt föregående punkt, har hyresmannen rätt att häva avtalet eller begära sådan nedsättning av hyran som svarar mot felet, skadan eller förlusten. Hyresmannen har också rätt till skälig ersättning för skada som han åsamkats på grund av felet, skadan eller förlusten, utom då uthyraren kan visa att han själv inte varit försumlig. Avtalet får dock inte hävas om felet, skadan eller förlusten endast är av ringa betydelse för hyresmannen eller om uthyraren dagen efter underrättelse om händelsen lämnar likvärdig ersättningskanot eller reparerar kanoten.\r\n\r\n12. Återlämnande i förtid pga sjukdom etc\r\nVid dödsfall, allvarlig sjukdom eller annan liknande omständlig het som under hyrestiden drabbar hyresmannen eller någon i dennes familj äger hyresmannen rätt att återlämna kanoten före utgången av den överenskomna hyrestiden. Utnyttjad hyrestid skall därvid anses löpa till dagen efter återlämnandet. Sjukdom etc skall kunna styrkas genom läkarintyg eller liknande.\r\n\r\n13. Återlämnande vid hyrestiden utgång mm\r\nHyresmannen skall vid hyrestidens utgång återlämna kanoten på den plats där den avhämtats, om annan plats inte överenskommits. Kanoten skall lämnas väl städad och i samma skick som vid avhämtandet bortsett från normalt slitage. Uthyraren och hyresmannen skall om möjligt gemensamt besiktiga kanoten. Kan hyresmannen inte återlämna kanoten i avtalad tid skall han omedelbart underrätta uthyraren. Medger inte uthyraren att hyrestiden förlängs eller att kanoten återlämnas på annan plats än vad som överenskommits, utgår hyran med dubbelt belopp från och med dagen efter den då kanoten skulle ha återlämnats till och med dagen då den återställs till uthyraren. Beloppet räknas per dygn i förhållande till avtalad hyra. Beror underlåtenhet att återlämna kanot i avtalad tid på dödsfall, allvarlig sjukdom eller annan liknande omständighet som drabbar hyresmannen eller någon i dennes familj utgår enkel hyra under den tid hindret består. Efter en vecka utgår dock hyra med dubbelt belopp. Sjukdom etc skall kunna styrkas genom läkarintyg eller liknande. Om hyresmannen har övergett kanoten är uthyraren för att minska skadan skyldig att snarast möjligt låta omhänderta kanoten. Hyresmannen är i sådant fall skyldig att ersätta uthyraren de kostnader som varit nödvändiga för att återställa kanoten till sådan plats där den åter kan tagas i bruk av uthyraren.\r\n\r\n14. Tvist\r\nTvist som gäller tolkningen eller tillämpningen av dessa villkor skall parterna i första hand försöka lösa genom överenskommelse. Om parterna ej enas kan tvisten prövas av \r\nAllmänna reklamationsnämnden, i den mån ärendet är av sådan beskaffenhet att det kan behandlas av nämnden, eller av allmän domstol (tingsrätt). Det är alltid Svensk lag som gäller och regler för Sverige som används. Skador eller dödsfall som kunden råkar ut för kan aldrig bli uthyrarens fel. Det är alltid vårdnadshavare som ansvarar för sitt barns agerande och står som skyldig om något gått fel. Det vill säga, vårdnadshavaren är ekonomiskt ansvarig för sitt barn och dess utrustning om den inte återlämnas i fullgott skick.'),
(3030, 17, 'en', 'booking_conditions', 'GENERAL TERMS OF RENTAL OF CANOES\r\n\r\nTerms of agreement accepted by the Swedish Canoe Federation after negotiations with the Consumer Agency / KO to be applied.\r\n\r\n1. The terms relate to professional rental to the consumer and apply to:\r\n- Canoes for rent for single use\r\n\r\n2. Order\r\nThe order is binding on both parties when an agreement is signed or the lessor confirmed in writing the tenant\'s order.\r\n\r\n3. Use of the canoe\r\nThe canoe can be used in the Nordic region unless otherwise agreed in the individual case. The tenant may not lease the canoe to anyone except as stated in point 6 regarding the transfer of contracts prior to the rental period.\r\n\r\n4. Payment\r\nThe lessor is entitled to request that the tenant pay a booking fee of:\r\n\r\n20% of total rent 30 days prior to rental period\r\n30% of total rent 29 - 14 days prior to rental period\r\n40% of total rent 13 - 7 days prior to rental period\r\n\r\nRent in addition to booking fee is due at the latest at the beginning of the rental period unless otherwise agreed in the particular case. If the rent is not paid on time, the lessor is entitled to charge interest on late payment under the Interest Act. The lessor is entitled to cancel the contract unless the lessee pays on time and the delay is not of minor importance to the lessor. The tenant is then liable for full rental unless the canoe is rented to another.\r\n\r\n5. Cancellation\r\nIf the renter declines the canoe 7 days before the start of the rental period or more, the landlord will deduct the booked booking fee (see item 4). If the canoe is canceled later than 7 days before the rental period but earlier than 24 hours before, the lessee has the right to deduct 50% of the total rental cost. If the canoe is canceled within 24 hours prior to the rental period, the lessee is entitled to account for 80% of the total rental cost. If canceled canoe is rented to another\r\nthe lessee has the right to recover the amount paid less an expense fee of no more than 100 kr. However, the expedition fee may not exceed the cancellation fee according to the first paragraph. In that case, the tenant shall immediately reimburse the difference between the landlord. In case of cancellation of the canoe before the start of the rental period due to death, serious illness or similar circumstance affecting the tenant or someone in his or her family, the lessee shall reimburse what has been paid by the lessor. Disease etc must be confirmed by medical certificate or similar.\r\n\r\n6. Transfer of contracts before the start of the rental period\r\nThe tenant is always entitled to transfer the lease to another person, instead of cancellation, unless the landlord has reason to refuse to accept this as a landlord. The original tenant will therefore be free from all obligations to the lessee.\r\n\r\n7. Condition and equipment of the canoe\r\nIt is the responsibility of the landlord to deliver the agreed canoe at the time of the lease in seaworthy and otherwise operable condition and equipped with the required safety equipment and ordered extra equipment. Then it is the responsibility of the customer that it is reproduced in the same condition.\r\n\r\n8. Delayed or incorrect delivery\r\nIf the landlord does not provide the canoe in contractual condition and with agreed equipment at the time agreed, the lessee is entitled to such a reduction in the rent corresponding to the delay. If rectification does not occur within 3 hours from the agreed date, the lessee is entitled to cancel the agreement. However, cancellation may not be made if the fault is of minor importance to the lessor or if the lessee provides another equivalent canoe or equipment within 3 hours of the agreed date. The lessor is obliged to give the lessee reasonable compensation for the damage he has suffered through the delay, except when the lessee can show that the delay is not due to negligence on his part. The same applies if the agreement is canceled.\r\n\r\n9. Measures for failure, damage and loss\r\nIn case of malfunction or damage to the canoe or accessories, as well as loss of canoe or accessories, the tenant is obliged to inform the landlord as soon as possible. The lessor shall, after such notification, inform the tenant in advance of the measures which he shall take.\r\n\r\n10. Tenant\'s liability for failure, damage and loss\r\nThe tenant is obliged to compensate for loss or damage to the canoe except when he may be likely to have been negligent. However, the lessor is not liable for damage caused by external accidents outside his control, nor for the tenant\'s costs in connection with such an accident.\r\n\r\n11. Hirer\'s responsibility for failure, damage and loss\r\nIn case of malfunction, damage or loss of the canoe or accessories occur during the rental period, and the lessee is not responsible according to the previous paragraph, the lessee has the right to cancel the agreement or request such a reduction of the rent corresponding to the fault, damage or loss. The tenant is also entitled to reasonable compensation for damage caused to him by reason of the fault, damage or loss, except when the lessee can show that he himself has not been negligent. However, the agreement may not be canceled if the fault, damage or loss is of minor importance to the lessor or if the lessee leaves the equivalent of the replacement cante the day after notification of the event or repair the canoe.\r\n\r\n12. Early return due to illness etc.\r\nIn the case of death, serious illness or other similar circumstance that occurs during the rental period, the tenant or someone in his family owns the tenant the right to return the canoe before the expiry of the agreed rental period. The utilized rental period shall therefore be deemed to expire on the day after the return. Disease etc must be confirmed by medical certificate or similar.\r\n\r\n13. Return at rental time output mm\r\nAt the end of the rental period, the renter shall return the canoe at the place where it was picked up if another place has not been agreed. The canoe is to be left well cleaned and in the same condition as at the time of removal except for normal wear and tear. The tenant and the tenant shall, if possible, jointly inspect the canoe. If the landlord can not return the canoe during the agreed time, he shall immediately inform the landlord. If the landlord does not allow the rental period to be extended or that the canoe is returned elsewhere than agreed, the rent will be deducted from the day following the date when the canoe would have been returned until the day it is returned to the landlord. The amount is calculated per day in relation to the agreed rent. Due to the failure to return the canoe at the agreed time of death, serious illness or other similar circumstance that affects the tenant or someone in his family, it is easy to rent during the time that the obstacle exists. After one week, however, double-occupancy rent. Disease etc must be confirmed by medical certificate or similar. If the renter has abandoned the canoe, the lessee is required to reduce the damage as soon as possible to dispose of the canoe. In such cases, the tenant is obliged to replace the tenant with the costs necessary to restore the canoe to a place where it can be reused by the landlord.\r\n\r\n14. Disputes\r\nDisputes concerning the interpretation or application of these terms and conditions shall be sought by the parties in the first instance by resolution. If the parties do not agree, the dispute may be reviewed\r\nGeneral Complaints Board, insofar as the case is such that it may be dealt with by the Board or by the General Court (District Court). There is always Swedish law in force and rules for Sweden used. Damages or deaths incurred by the customer can never be the landlord\'s fault. It is always a guardian who is responsible for the actions of his child and is guilty of something wrong. That is, the custodian is financially responsible for his child and its equipment if it is not returned in full condition.'),
(3031, 17, 'de', 'booking_conditions', ''),
(3032, 17, 'se', 'payment_policy', ''),
(3033, 17, 'en', 'payment_policy', ''),
(3034, 17, 'de', 'payment_policy', ''),
(3035, 17, 'se', 'admin_fee', ''),
(3036, 17, 'en', 'admin_fee', ''),
(3037, 17, 'de', 'admin_fee', ''),
(4253, 47, 'se', 'paymentTransferHow', ''),
(4254, 47, 'en', 'paymentTransferHow', 'Bank'),
(4255, 47, 'de', 'paymentTransferHow', ''),
(4256, 47, 'se', 'paymentCashHow', ''),
(4257, 47, 'en', 'paymentCashHow', ''),
(4258, 47, 'de', 'paymentCashHow', ''),
(4259, 47, 'se', 'paymentInvoiceHow', ''),
(4260, 47, 'en', 'paymentInvoiceHow', ''),
(4261, 47, 'de', 'paymentInvoiceHow', ''),
(4262, 47, 'se', 'invoice_text', ''),
(4263, 47, 'en', 'invoice_text', ''),
(4264, 47, 'de', 'invoice_text', ''),
(4265, 47, 'se', 'intro_text', ''),
(4266, 47, 'en', 'intro_text', ''),
(4267, 47, 'de', 'intro_text', ''),
(4268, 47, 'se', 'confirmation_text', ''),
(4269, 47, 'en', 'confirmation_text', ''),
(4270, 47, 'de', 'confirmation_text', ''),
(4271, 47, 'se', 'booking_conditions', ''),
(4272, 47, 'en', 'booking_conditions', ''),
(4273, 47, 'de', 'booking_conditions', ''),
(4274, 47, 'se', 'payment_policy', ''),
(4275, 47, 'en', 'payment_policy', ''),
(4276, 47, 'de', 'payment_policy', ''),
(4277, 47, 'se', 'admin_fee', ''),
(4278, 47, 'en', 'admin_fee', ''),
(4279, 47, 'de', 'admin_fee', ''),
(4415, 46, 'se', 'paymentTransferHow', ''),
(4416, 46, 'en', 'paymentTransferHow', ''),
(4417, 46, 'de', 'paymentTransferHow', ''),
(4418, 46, 'se', 'paymentCashHow', ''),
(4419, 46, 'en', 'paymentCashHow', ''),
(4420, 46, 'de', 'paymentCashHow', ''),
(4421, 46, 'se', 'paymentInvoiceHow', ''),
(4422, 46, 'en', 'paymentInvoiceHow', ''),
(4423, 46, 'de', 'paymentInvoiceHow', ''),
(4424, 46, 'se', 'invoice_text', ''),
(4425, 46, 'en', 'invoice_text', ''),
(4426, 46, 'de', 'invoice_text', ''),
(4427, 46, 'se', 'intro_text', ''),
(4428, 46, 'en', 'intro_text', ''),
(4429, 46, 'de', 'intro_text', ''),
(4430, 46, 'se', 'confirmation_text', ''),
(4431, 46, 'en', 'confirmation_text', ''),
(4432, 46, 'de', 'confirmation_text', ''),
(4433, 46, 'se', 'booking_conditions', ''),
(4434, 46, 'en', 'booking_conditions', ''),
(4435, 46, 'de', 'booking_conditions', ''),
(4436, 46, 'se', 'payment_policy', ''),
(4437, 46, 'en', 'payment_policy', ''),
(4438, 46, 'de', 'payment_policy', ''),
(4439, 46, 'se', 'admin_fee', ''),
(4440, 46, 'en', 'admin_fee', ''),
(4441, 46, 'de', 'admin_fee', ''),
(5036, 52, 'se', 'paymentTransferHow', ''),
(5037, 52, 'en', 'paymentTransferHow', ''),
(5038, 52, 'de', 'paymentTransferHow', ''),
(5039, 52, 'se', 'paymentCashHow', ''),
(5040, 52, 'en', 'paymentCashHow', ''),
(5041, 52, 'de', 'paymentCashHow', ''),
(5042, 52, 'se', 'paymentInvoiceHow', ''),
(5043, 52, 'en', 'paymentInvoiceHow', ''),
(5044, 52, 'de', 'paymentInvoiceHow', ''),
(5045, 52, 'se', 'invoice_text', ''),
(5046, 52, 'en', 'invoice_text', ''),
(5047, 52, 'de', 'invoice_text', ''),
(5048, 52, 'se', 'intro_text', ''),
(5049, 52, 'en', 'intro_text', ''),
(5050, 52, 'de', 'intro_text', ''),
(5051, 52, 'se', 'confirmation_text', ''),
(5052, 52, 'en', 'confirmation_text', ''),
(5053, 52, 'de', 'confirmation_text', ''),
(5054, 52, 'se', 'booking_conditions', ''),
(5055, 52, 'en', 'booking_conditions', ''),
(5056, 52, 'de', 'booking_conditions', ''),
(5057, 52, 'se', 'payment_policy', ''),
(5058, 52, 'en', 'payment_policy', ''),
(5059, 52, 'de', 'payment_policy', ''),
(5060, 52, 'se', 'admin_fee', ''),
(5061, 52, 'en', 'admin_fee', ''),
(5062, 52, 'de', 'admin_fee', ''),
(5495, 53, 'se', 'paymentTransferHow', ''),
(5496, 53, 'en', 'paymentTransferHow', ''),
(5497, 53, 'de', 'paymentTransferHow', ''),
(5498, 53, 'se', 'paymentCashHow', ''),
(5499, 53, 'en', 'paymentCashHow', ''),
(5500, 53, 'de', 'paymentCashHow', ''),
(5501, 53, 'se', 'paymentInvoiceHow', ''),
(5502, 53, 'en', 'paymentInvoiceHow', ''),
(5503, 53, 'de', 'paymentInvoiceHow', ''),
(5504, 53, 'se', 'invoice_text', ''),
(5505, 53, 'en', 'invoice_text', ''),
(5506, 53, 'de', 'invoice_text', ''),
(5507, 53, 'se', 'intro_text', ''),
(5508, 53, 'en', 'intro_text', ''),
(5509, 53, 'de', 'intro_text', ''),
(5510, 53, 'se', 'confirmation_text', ''),
(5511, 53, 'en', 'confirmation_text', ''),
(5512, 53, 'de', 'confirmation_text', ''),
(5513, 53, 'se', 'booking_conditions', ''),
(5514, 53, 'en', 'booking_conditions', ''),
(5515, 53, 'de', 'booking_conditions', ''),
(5516, 53, 'se', 'payment_policy', ''),
(5517, 53, 'en', 'payment_policy', ''),
(5518, 53, 'de', 'payment_policy', ''),
(5519, 53, 'se', 'admin_fee', ''),
(5520, 53, 'en', 'admin_fee', ''),
(5521, 53, 'de', 'admin_fee', ''),
(5549, 54, 'se', 'paymentTransferHow', ''),
(5550, 54, 'en', 'paymentTransferHow', ''),
(5551, 54, 'de', 'paymentTransferHow', ''),
(5552, 54, 'se', 'paymentCashHow', ''),
(5553, 54, 'en', 'paymentCashHow', ''),
(5554, 54, 'de', 'paymentCashHow', ''),
(5555, 54, 'se', 'paymentInvoiceHow', ''),
(5556, 54, 'en', 'paymentInvoiceHow', ''),
(5557, 54, 'de', 'paymentInvoiceHow', ''),
(5558, 54, 'se', 'invoice_text', ''),
(5559, 54, 'en', 'invoice_text', ''),
(5560, 54, 'de', 'invoice_text', ''),
(5561, 54, 'se', 'intro_text', ''),
(5562, 54, 'en', 'intro_text', ''),
(5563, 54, 'de', 'intro_text', ''),
(5564, 54, 'se', 'confirmation_text', ''),
(5565, 54, 'en', 'confirmation_text', ''),
(5566, 54, 'de', 'confirmation_text', ''),
(5567, 54, 'se', 'booking_conditions', ''),
(5568, 54, 'en', 'booking_conditions', ''),
(5569, 54, 'de', 'booking_conditions', ''),
(5570, 54, 'se', 'payment_policy', ''),
(5571, 54, 'en', 'payment_policy', ''),
(5572, 54, 'de', 'payment_policy', ''),
(5573, 54, 'se', 'admin_fee', ''),
(5574, 54, 'en', 'admin_fee', ''),
(5575, 54, 'de', 'admin_fee', ''),
(6899, 50, 'se', 'paymentTransferHow', ''),
(6900, 50, 'en', 'paymentTransferHow', ''),
(6901, 50, 'de', 'paymentTransferHow', ''),
(6902, 50, 'se', 'paymentCashHow', ''),
(6903, 50, 'en', 'paymentCashHow', ''),
(6904, 50, 'de', 'paymentCashHow', ''),
(6905, 50, 'se', 'paymentInvoiceHow', ''),
(6906, 50, 'en', 'paymentInvoiceHow', ''),
(6907, 50, 'de', 'paymentInvoiceHow', ''),
(6908, 50, 'se', 'invoice_text', ''),
(6909, 50, 'en', 'invoice_text', ''),
(6910, 50, 'de', 'invoice_text', ''),
(6911, 50, 'se', 'intro_text', ''),
(6912, 50, 'en', 'intro_text', ''),
(6913, 50, 'de', 'intro_text', ''),
(6914, 50, 'se', 'confirmation_text', ''),
(6915, 50, 'en', 'confirmation_text', ''),
(6916, 50, 'de', 'confirmation_text', ''),
(6917, 50, 'se', 'booking_conditions', ''),
(6918, 50, 'en', 'booking_conditions', ''),
(6919, 50, 'de', 'booking_conditions', ''),
(6920, 50, 'se', 'payment_policy', ''),
(6921, 50, 'en', 'payment_policy', ''),
(6922, 50, 'de', 'payment_policy', ''),
(6923, 50, 'se', 'admin_fee', ''),
(6924, 50, 'en', 'admin_fee', ''),
(6925, 50, 'de', 'admin_fee', ''),
(7547, 23, 'se', 'paymentTransferHow', ''),
(7548, 23, 'en', 'paymentTransferHow', ''),
(7549, 23, 'de', 'paymentTransferHow', ''),
(7550, 23, 'se', 'paymentCashHow', ''),
(7551, 23, 'en', 'paymentCashHow', 'Please pay exact amount.'),
(7552, 23, 'de', 'paymentCashHow', ''),
(7553, 23, 'se', 'paymentInvoiceHow', ''),
(7554, 23, 'en', 'paymentInvoiceHow', ''),
(7555, 23, 'de', 'paymentInvoiceHow', ''),
(7556, 23, 'se', 'invoice_text', ''),
(7557, 23, 'en', 'invoice_text', ''),
(7558, 23, 'de', 'invoice_text', ''),
(7559, 23, 'se', 'intro_text', ''),
(7560, 23, 'en', 'intro_text', ''),
(7561, 23, 'de', 'intro_text', ''),
(7562, 23, 'se', 'confirmation_text', ''),
(7563, 23, 'en', 'confirmation_text', ''),
(7564, 23, 'de', 'confirmation_text', ''),
(7565, 23, 'se', 'booking_conditions', ''),
(7566, 23, 'en', 'booking_conditions', ''),
(7567, 23, 'de', 'booking_conditions', ''),
(7568, 23, 'se', 'payment_policy', ''),
(7569, 23, 'en', 'payment_policy', ''),
(7570, 23, 'de', 'payment_policy', ''),
(7571, 23, 'se', 'admin_fee', ''),
(7572, 23, 'en', 'admin_fee', ''),
(7573, 23, 'de', 'admin_fee', '');

-- --------------------------------------------------------

--
-- Table structure for table `centre_payment_methods`
--

CREATE TABLE `centre_payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_methods_id` int(10) UNSIGNED NOT NULL,
  `centre_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centre_payment_methods`
--

INSERT INTO `centre_payment_methods` (`id`, `payment_methods_id`, `centre_id`, `active`, `api_key`, `created_at`, `updated_at`) VALUES
(238, 2, 33, 1, '', NULL, NULL),
(239, 6, 33, 1, '', NULL, NULL),
(258, 3, 38, 1, '', NULL, NULL),
(261, 4, 41, 1, '', NULL, NULL),
(262, 6, 36, 1, '', NULL, NULL),
(263, 4, 42, 1, '', NULL, NULL),
(266, 3, 43, 1, '', NULL, NULL),
(286, 5, 20, 1, '', NULL, NULL),
(299, 5, 17, 1, '', NULL, NULL),
(345, 7, 47, 1, '', NULL, NULL),
(359, 2, 46, 1, '', NULL, NULL),
(360, 6, 46, 1, '', NULL, NULL),
(361, 7, 46, 1, '', NULL, NULL),
(362, 5, 46, 1, '', NULL, NULL),
(380, 2, 53, 1, '', NULL, NULL),
(447, 3, 50, 1, '', NULL, NULL),
(448, 2, 50, 1, '', NULL, NULL),
(449, 6, 50, 1, '', NULL, NULL),
(450, 5, 50, 1, '', NULL, NULL),
(519, 2, 23, 1, '', NULL, NULL),
(520, 7, 23, 1, '', NULL, NULL),
(521, 5, 23, 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `centre_user`
--

CREATE TABLE `centre_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `centre_id` int(10) UNSIGNED NOT NULL,
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centre_user`
--

INSERT INTO `centre_user` (`id`, `user_id`, `centre_id`, `user_type_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(16, 17, 17, 1, NULL, '2016-08-15 19:59:48', NULL),
(17, 18, 17, 1, NULL, NULL, NULL),
(20, 21, 20, 1, NULL, NULL, NULL),
(21, 22, 21, 1, NULL, NULL, NULL),
(22, 23, 22, 1, NULL, NULL, NULL),
(23, 24, 23, 1, NULL, NULL, NULL),
(24, 25, 24, 1, NULL, NULL, NULL),
(25, 26, 25, 1, NULL, NULL, NULL),
(26, 27, 26, 1, NULL, NULL, NULL),
(27, 28, 27, 1, NULL, NULL, NULL),
(28, 29, 28, 1, NULL, NULL, NULL),
(29, 30, 29, 1, NULL, NULL, NULL),
(30, 31, 30, 1, NULL, NULL, NULL),
(31, 32, 31, 1, NULL, NULL, NULL),
(32, 33, 32, 1, NULL, NULL, NULL),
(33, 34, 33, 1, NULL, NULL, NULL),
(34, 35, 34, 1, NULL, NULL, NULL),
(35, 36, 35, 1, NULL, NULL, NULL),
(36, 37, 36, 1, NULL, NULL, NULL),
(37, 38, 37, 1, NULL, NULL, NULL),
(38, 39, 38, 1, NULL, NULL, NULL),
(39, 40, 39, 1, NULL, NULL, NULL),
(40, 41, 40, 1, NULL, NULL, NULL),
(41, 42, 17, 1, NULL, '2017-09-14 12:10:48', '2017-09-14 12:10:48'),
(42, 43, 41, 1, NULL, NULL, NULL),
(43, 44, 42, 1, NULL, NULL, NULL),
(44, 45, 43, 1, NULL, NULL, NULL),
(45, 46, 17, 1, NULL, NULL, NULL),
(48, 48, 17, 2, NULL, NULL, NULL),
(49, 49, 45, 1, NULL, NULL, NULL),
(50, 50, 46, 1, NULL, NULL, NULL),
(51, 51, 47, 1, NULL, NULL, NULL),
(52, 52, 48, 1, NULL, NULL, NULL),
(53, 53, 49, 1, NULL, NULL, NULL),
(54, 54, 50, 1, NULL, NULL, NULL),
(55, 55, 51, 1, NULL, NULL, NULL),
(56, 56, 52, 1, NULL, NULL, NULL),
(57, 57, 53, 1, NULL, NULL, NULL),
(58, 58, 54, 1, NULL, NULL, NULL),
(59, 59, 55, 1, NULL, NULL, NULL),
(60, 60, 56, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `short_code`) VALUES
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de'),
(1, 'Sweden', 'se'),
(2, 'Germany', 'de');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_02_11_104855_create_user_types', 1),
('2013_02_15_105826_create_centres', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_02_15_104438_create_user_centre_link', 1),
('2016_02_15_105010_create_bookings', 1),
('2016_02_15_105199_create_categories', 1),
('2016_02_15_105200_create_products', 1),
('2016_02_15_105258_create_booking_products', 1),
('2016_02_15_110045_create_payment_methods', 1),
('2016_02_15_110046_create_centre_payment_methods', 1),
('2016_02_15_111200_create_prices', 1),
('2016_02_15_111239_create_price_product', 1),
('2016_02_15_111526_create_product_images', 1),
('2016_03_31_210346_start_times', 1),
('2016_03_31_210351_product_start_times', 1),
('2016_04_01_120405_per_types', 1),
('2016_04_01_120430_per_types_product', 1),
('2016_04_02_122130_per_type_times', 2),
('2016_04_02_122754_per_type_time_product', 2),
('2016_04_19_104120_centre_localisation', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('info@jamespfarrell.com', '06747325e253516049d6b1bbdc84f3692bf8b9272b22a745c27365c102ae28fd', '2016-05-10 18:19:10'),
('daniel@svima.se', 'b3db15e7313d6cdb69aa9e5de8e7ed86bef5f80283d8fe036b032af0c2e99fea', '2016-10-22 07:00:55'),
('jonas@softskills.se', 'b5b55c32bc133045a54878317b6d7e8bf3f271e83d366dec4fbc2adfc1660ab3', '2016-11-26 14:29:37'),
('karlstad@puschel.se', '876d58f5011fa590a8e13ce790971cd2cb38ebfc12cc4c9a80d5071641290066', '2017-09-14 10:11:05'),
('peter@puschel.se', '974d75868ffbce7d88c953d2273cefbc171c65b4df605253cc4dcea99718103f', '2019-09-01 16:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `shortName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `shortName`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Cash', 'Cash', NULL, NULL),
(3, 'Transfer', 'Bank Transfer', NULL, NULL),
(4, 'Klarna', 'Klarna', NULL, NULL),
(5, 'Stripe', 'Stripe', NULL, NULL),
(6, 'Invoice', 'Invoice', NULL, NULL),
(7, 'Paypal', 'Paypal', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `per_types`
--

CREATE TABLE `per_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `per_types`
--

INSERT INTO `per_types` (`id`, `type_name`, `type_value`) VALUES
(1, 'time', 'time'),
(3, 'product', 'product');

-- --------------------------------------------------------

--
-- Table structure for table `per_types_product`
--

CREATE TABLE `per_types_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `per_types_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `per_type_times`
--

CREATE TABLE `per_type_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_time_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_time_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `max_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `per_type_times`
--

INSERT INTO `per_type_times` (`id`, `type_time_name`, `type_time_value`, `lang`, `max_duration`) VALUES
(1, 'per hour', 'perHour', 'en', 0),
(2, 'per day', 'perDay', 'en', 0);

-- --------------------------------------------------------

--
-- Table structure for table `per_type_time_product`
--

CREATE TABLE `per_type_time_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `per_type_time_id` int(10) UNSIGNED NOT NULL,
  `max_duration` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `per_type_time_product`
--

INSERT INTO `per_type_time_product` (`id`, `product_id`, `per_type_time_id`, `max_duration`, `active`) VALUES
(1, 128, 2, 3, 1),
(2, 128, 1, 5, 1),
(3, 130, 2, 1, 1),
(4, 130, 1, 1, 1),
(5, 133, 2, 1, 1),
(9, 140, 2, 1, 1),
(10, 141, 2, 1, 1),
(11, 141, 1, 1, 1),
(28, 147, 2, 10, 1),
(29, 147, 1, 5, 1),
(30, 127, 2, 3, 1),
(31, 127, 1, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `name`, `shortCode`, `created_at`, `updated_at`) VALUES
(1, 'Per hour', 'PerHour', NULL, NULL),
(2, 'Per hour on the weekend', 'PerHourWeekend', NULL, NULL),
(3, 'Per day during the week', 'PerDay', '2016-05-18 17:47:20', NULL),
(4, 'Per day during the weekend', 'PerDayWeekend', NULL, NULL),
(7, 'Per product', 'PerProduct', NULL, NULL),
(8, 'Per booking', 'PerBooking', NULL, NULL),
(9, 'Price per hour (over 4 hours)', 'PerHourOverFour', NULL, NULL),
(10, 'Price / hour (> 4 hours on weekend)', 'PerHourOverFourWeekend', NULL, NULL),
(11, 'Pris / day (3-6 days)', 'PerThreeSixDays', '2016-05-23 18:00:32', '2016-05-23 18:00:32'),
(12, 'Per additional day above 1 week', 'PerWeekExtraDay', NULL, NULL),
(13, 'Per week', 'PerWeek', NULL, NULL),
(14, 'Per Two Days', 'PerTwoDays', NULL, NULL),
(15, 'Per Two Days Weekend', 'PerTwoDaysWeekend', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `price_product`
--

CREATE TABLE `price_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `price_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price_product`
--

INSERT INTO `price_product` (`id`, `price_id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(2853, 7, 124, '1.00', NULL, NULL),
(2854, 7, 125, '1.00', NULL, NULL),
(2857, 1, 128, '5.00', NULL, NULL),
(2858, 2, 128, '6.00', NULL, NULL),
(2859, 3, 128, '6.00', NULL, NULL),
(2860, 4, 128, '3.00', NULL, NULL),
(2861, 10, 128, '4.00', NULL, NULL),
(2862, 11, 128, '4.00', NULL, NULL),
(2863, 12, 128, '9.00', NULL, NULL),
(2864, 13, 128, '4.00', NULL, NULL),
(2865, 9, 128, '3.00', NULL, NULL),
(2866, 7, 129, '2.00', NULL, NULL),
(2867, 1, 130, '1.00', NULL, NULL),
(2868, 2, 130, '1.00', NULL, NULL),
(2869, 3, 130, '0.00', NULL, NULL),
(2870, 4, 130, '0.00', NULL, NULL),
(2871, 10, 130, '1.00', NULL, NULL),
(2872, 11, 130, '0.00', NULL, NULL),
(2873, 12, 130, '0.00', NULL, NULL),
(2874, 13, 130, '0.00', NULL, NULL),
(2875, 9, 130, '1.00', NULL, NULL),
(2876, 7, 131, '5.00', NULL, NULL),
(2877, 7, 132, '7.00', NULL, NULL),
(2878, 1, 133, '5.00', NULL, NULL),
(2879, 2, 133, '0.00', NULL, NULL),
(2880, 3, 133, '0.00', NULL, NULL),
(2881, 4, 133, '0.00', NULL, NULL),
(2882, 10, 133, '0.00', NULL, NULL),
(2883, 11, 133, '0.00', NULL, NULL),
(2884, 12, 133, '0.00', NULL, NULL),
(2885, 13, 133, '0.00', NULL, NULL),
(2886, 9, 133, '0.00', NULL, NULL),
(2887, 7, 134, '3.00', NULL, NULL),
(2888, 7, 135, '3.00', NULL, NULL),
(2889, 7, 136, '3.00', NULL, NULL),
(2890, 7, 137, '2.00', NULL, NULL),
(2891, 7, 138, '2.00', NULL, NULL),
(2893, 12, 139, '0.00', NULL, NULL),
(2894, 8, 139, '0.00', NULL, NULL),
(2895, 3, 139, '0.00', NULL, NULL),
(2896, 4, 139, '0.00', NULL, NULL),
(2897, 1, 139, '0.00', NULL, NULL),
(2898, 2, 139, '0.00', NULL, NULL),
(2899, 7, 139, '1.00', NULL, NULL),
(2900, 14, 139, '0.00', NULL, NULL),
(2901, 15, 139, '0.00', NULL, NULL),
(2902, 13, 139, '0.00', NULL, NULL),
(2903, 10, 139, '0.00', NULL, NULL),
(2904, 9, 139, '0.00', NULL, NULL),
(2905, 11, 139, '0.00', NULL, NULL),
(2941, 12, 140, '0.00', NULL, NULL),
(2942, 8, 140, '0.00', NULL, NULL),
(2943, 3, 140, '0.00', NULL, NULL),
(2944, 4, 140, '0.00', NULL, NULL),
(2945, 1, 140, '4.00', NULL, NULL),
(2946, 2, 140, '0.00', NULL, NULL),
(2947, 7, 140, '0.00', NULL, NULL),
(2948, 14, 140, '0.00', NULL, NULL),
(2949, 15, 140, '0.00', NULL, NULL),
(2950, 13, 140, '0.00', NULL, NULL),
(2951, 10, 140, '0.00', NULL, NULL),
(2952, 9, 140, '0.00', NULL, NULL),
(2953, 11, 140, '0.00', NULL, NULL),
(2955, 12, 141, '0.00', NULL, NULL),
(2956, 8, 141, '0.00', NULL, NULL),
(2957, 3, 141, '0.00', NULL, NULL),
(2958, 4, 141, '0.00', NULL, NULL),
(2959, 1, 141, '1.00', NULL, NULL),
(2960, 2, 141, '0.00', NULL, NULL),
(2961, 7, 141, '5.00', NULL, NULL),
(2962, 14, 141, '0.00', NULL, NULL),
(2963, 15, 141, '0.00', NULL, NULL),
(2964, 13, 141, '0.00', NULL, NULL),
(2965, 10, 141, '0.00', NULL, NULL),
(2966, 9, 141, '0.00', NULL, NULL),
(2967, 11, 141, '0.00', NULL, NULL),
(2968, 7, 142, '123.00', NULL, NULL),
(2996, 12, 143, '0.00', NULL, NULL),
(2997, 8, 143, '0.00', NULL, NULL),
(2998, 3, 143, '0.00', NULL, NULL),
(2999, 4, 143, '0.00', NULL, NULL),
(3000, 1, 143, '0.00', NULL, NULL),
(3001, 2, 143, '0.00', NULL, NULL),
(3002, 7, 143, '5.00', NULL, NULL),
(3003, 14, 143, '0.00', NULL, NULL),
(3004, 15, 143, '0.00', NULL, NULL),
(3005, 13, 143, '0.00', NULL, NULL),
(3006, 10, 143, '0.00', NULL, NULL),
(3007, 9, 143, '0.00', NULL, NULL),
(3008, 11, 143, '0.00', NULL, NULL),
(3009, 7, 144, '8.00', NULL, NULL),
(3023, 7, 145, '10.00', NULL, NULL),
(3024, 7, 146, '10.00', NULL, NULL),
(3157, 12, 148, '0.00', NULL, NULL),
(3158, 8, 148, '0.00', NULL, NULL),
(3159, 3, 148, '0.00', NULL, NULL),
(3160, 4, 148, '0.00', NULL, NULL),
(3161, 1, 148, '0.00', NULL, NULL),
(3162, 2, 148, '0.00', NULL, NULL),
(3163, 7, 148, '40.00', NULL, NULL),
(3164, 14, 148, '0.00', NULL, NULL),
(3165, 15, 148, '0.00', NULL, NULL),
(3166, 13, 148, '0.00', NULL, NULL),
(3167, 10, 148, '0.00', NULL, NULL),
(3168, 9, 148, '0.00', NULL, NULL),
(3169, 11, 148, '0.00', NULL, NULL),
(3261, 12, 147, '0.00', NULL, NULL),
(3262, 8, 147, '0.00', NULL, NULL),
(3263, 3, 147, '30.00', NULL, NULL),
(3264, 4, 147, '20.00', NULL, NULL),
(3265, 1, 147, '20.00', NULL, NULL),
(3266, 2, 147, '0.00', NULL, NULL),
(3267, 7, 147, '30.00', NULL, NULL),
(3268, 14, 147, '0.00', NULL, NULL),
(3269, 15, 147, '0.00', NULL, NULL),
(3270, 13, 147, '0.00', NULL, NULL),
(3271, 10, 147, '0.00', NULL, NULL),
(3272, 9, 147, '0.00', NULL, NULL),
(3273, 11, 147, '0.00', NULL, NULL),
(3287, 7, 149, '10.00', NULL, NULL),
(3288, 12, 127, '170.00', NULL, NULL),
(3289, 8, 127, '0.00', NULL, NULL),
(3290, 3, 127, '150.00', NULL, NULL),
(3291, 4, 127, '200.00', NULL, NULL),
(3292, 1, 127, '40.00', NULL, NULL),
(3293, 2, 127, '60.00', NULL, NULL),
(3294, 7, 127, '2400.00', NULL, NULL),
(3295, 14, 127, '0.00', NULL, NULL),
(3296, 15, 127, '0.00', NULL, NULL),
(3297, 13, 127, '850.00', NULL, NULL),
(3298, 10, 127, '0.00', NULL, NULL),
(3299, 9, 127, '0.00', NULL, NULL),
(3300, 11, 127, '0.00', NULL, NULL),
(3301, 7, 150, '12.00', NULL, NULL),
(3342, 12, 151, '0.00', NULL, NULL),
(3343, 8, 151, '0.00', NULL, NULL),
(3344, 3, 151, '0.00', NULL, NULL),
(3345, 4, 151, '0.00', NULL, NULL),
(3346, 1, 151, '0.00', NULL, NULL),
(3347, 2, 151, '0.00', NULL, NULL),
(3348, 7, 151, '12.00', NULL, NULL),
(3349, 14, 151, '0.00', NULL, NULL),
(3350, 15, 151, '0.00', NULL, NULL),
(3351, 13, 151, '0.00', NULL, NULL),
(3352, 10, 151, '0.00', NULL, NULL),
(3353, 9, 151, '0.00', NULL, NULL),
(3354, 11, 151, '0.00', NULL, NULL),
(3355, 7, 152, '12.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_se` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_se` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_de` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_de` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_persons` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `per_type_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `name_se`, `description_se`, `name_de`, `description_de`, `quantity`, `image`, `number_of_persons`, `per_type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(124, 112, 'Apple', 'sample apple', NULL, NULL, NULL, NULL, 1, '', 'no', 3, '2019-04-23 06:17:23', '2019-04-23 06:17:23', NULL),
(125, 113, 'Car', 'Sample car', NULL, NULL, NULL, NULL, 1, 'Car_5cc03d27b1cf0.jpg', 'no', 3, '2019-04-24 05:10:39', '2019-04-24 05:10:39', NULL),
(127, 115, 'Walking-Tree-Harvester', 'This machine is known as walking machine and it is Plustech’s best-known innovation so far. The objective of this item and its goal is to become a machine that has the best firmness and least effect on the landscape. ', NULL, NULL, NULL, NULL, 100, '', 'no', 1, '2019-04-24 06:12:41', '2019-10-16 14:59:41', NULL),
(128, 113, 'fdffff', 'gdfgdf', NULL, NULL, NULL, NULL, 3, '', 'no', 1, '2019-04-25 01:02:00', '2019-04-25 01:02:05', '2019-04-25 01:02:05'),
(129, 116, 'tryrt', 'yry5', NULL, NULL, NULL, NULL, 4, 'tryrt_5cc19375d22ab.jpg', 'no', 3, '2019-04-25 05:31:09', '2019-04-25 05:31:09', NULL),
(130, 112, 'Orange', 'orange is fruit', NULL, NULL, NULL, NULL, 10, 'Orange_5cc2cf8234cc1.jpg', 'no', 1, '2019-04-26 03:59:38', '2019-04-26 03:59:38', NULL),
(131, 117, 'sdf', 'sdfs', NULL, NULL, NULL, NULL, 2, 'sdf_5ce94a4f27948.jpg', 'no', 3, '2019-05-25 08:29:43', '2019-06-06 15:31:09', '2019-06-06 15:31:09'),
(132, 117, 'hfgh', 'hfgh', NULL, NULL, NULL, NULL, 6, 'hfgh_5cf0f194308a8.jpg', 'no', 3, '2019-05-31 03:49:16', '2019-06-06 15:31:07', '2019-06-06 15:31:07'),
(133, 117, 'rte', 'rtert', NULL, NULL, NULL, NULL, 4, 'rte_5cf10eaa78c4e.jpg', 'no', 1, '2019-05-31 05:53:22', '2019-06-06 15:31:05', '2019-06-06 15:31:05'),
(134, 117, 'rew', 'werwe', NULL, NULL, NULL, NULL, 3, '', 'no', 3, '2019-06-01 01:56:38', '2019-06-06 15:31:03', '2019-06-06 15:31:03'),
(135, 117, 'rew', 'werwe', NULL, NULL, NULL, NULL, 3, '', 'no', 3, '2019-06-01 01:57:41', '2019-06-06 15:31:01', '2019-06-06 15:31:01'),
(136, 117, 'rew', 'werwe', NULL, NULL, NULL, NULL, 3, '', 'no', 3, '2019-06-01 01:58:13', '2019-06-06 15:30:58', '2019-06-06 15:30:58'),
(137, 117, 'Sample', 'Sample', NULL, NULL, NULL, NULL, 1, 'Sample_5cf8c22fdc732.jpg', 'no', 3, '2019-06-06 14:35:11', '2019-06-06 15:30:56', '2019-06-06 15:30:56'),
(138, 117, 'Sample', 'Sample', NULL, NULL, NULL, NULL, 1, 'Sample_5cf8c5b467c73.jpg', 'no', 3, '2019-06-06 14:50:12', '2019-06-06 15:30:53', '2019-06-06 15:30:53'),
(139, 117, 'Sample5', 'sample', NULL, NULL, NULL, NULL, 4, '', 'no', 3, '2019-06-06 15:30:36', '2019-06-06 15:30:59', '2019-06-06 15:30:59'),
(140, 117, 'Sample', 'Sample', NULL, NULL, NULL, NULL, 1, '/tmp/phpRS7YzL', 'no', 1, '2019-06-06 15:36:47', '2019-06-06 15:37:46', '2019-06-06 15:37:46'),
(141, 117, 'Sample', 'Sample', NULL, NULL, NULL, NULL, 3, '', 'no', 1, '2019-06-06 18:08:06', '2019-06-06 18:09:04', NULL),
(142, 121, 'Sample product', 'Sample product Sample product', NULL, NULL, NULL, NULL, 2, '', 'no', 3, '2019-06-06 18:18:15', '2019-06-06 18:18:15', NULL),
(143, 122, 'Sample Product', 'Description', NULL, NULL, NULL, NULL, 1, '', 'no', 3, '2019-06-06 19:07:00', '2019-06-10 11:40:07', '2019-06-10 11:40:07'),
(144, 123, 'Product', 'Product Description', NULL, NULL, NULL, NULL, 4, 'Product_5cfbba72c272b.jpg', 'no', 3, '2019-06-08 20:38:58', '2019-06-08 20:38:58', NULL),
(145, 122, 'Sample Product', 'Description', NULL, NULL, NULL, NULL, 1, '', 'no', 3, '2019-06-10 11:39:50', '2019-06-10 14:37:18', '2019-06-10 14:37:18'),
(146, 124, 'Product', 'Description', NULL, NULL, NULL, NULL, 1, '', 'no', 3, '2019-06-10 12:23:29', '2019-06-10 12:23:29', NULL),
(147, 125, 'Product', 'Description', NULL, NULL, NULL, NULL, 10, '', 'no', 1, '2019-06-10 14:39:51', '2019-06-15 20:54:35', NULL),
(148, 125, 'dsf', 'sdfsd', NULL, NULL, NULL, NULL, 4, '/tmp/php4W5PAu', 'no', 3, '2019-06-13 20:35:48', '2019-06-13 20:37:46', '2019-06-13 20:37:46'),
(149, 125, 'product 3', 'product 3', NULL, NULL, NULL, NULL, 90000000, 'product 3_5d56b03f47fa4.jpg', 'no', 3, '2019-08-16 20:31:45', '2019-08-16 20:31:45', NULL),
(150, 128, 'tester', 'goof', NULL, NULL, NULL, NULL, 12, '', 'no', 3, '2020-02-29 04:57:30', '2020-02-29 04:57:30', NULL),
(151, 128, 'good', 'ncie', 'good_se', 'des_se', 'goode_de', 'des_de', 1, '', 'yes', 3, '2020-03-01 23:59:45', '2020-03-02 06:21:06', NULL),
(152, 128, 'python EN', 'good en', 'python se', 'good se', 'python de', 'good de', 1, 'python EN_5e5cf3f271885.jpg', 'no', 3, '2020-03-02 06:24:26', '2020-03-02 06:24:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `primary_image` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `primary_image`, `image`, `created_at`, `updated_at`) VALUES
(1, 125, 1, 'Car_5cc03d27b1cf0.jpg', '2019-04-24 05:10:39', '2019-04-24 05:10:39'),
(2, 129, 1, 'tryrt_5cc19375d22ab.jpg', '2019-04-25 05:31:10', '2019-04-25 05:31:10'),
(3, 130, 1, 'Orange_5cc2cf8234cc1.jpg', '2019-04-26 03:59:38', '2019-04-26 03:59:38'),
(4, 131, 1, 'sdf_5ce94a4f27948.jpg', '2019-05-25 08:29:43', '2019-05-25 08:29:43'),
(5, 132, 1, 'hfgh_5cf0f194308a8.jpg', '2019-05-31 03:49:16', '2019-05-31 03:49:16'),
(6, 133, 1, 'rte_5cf10eaa78c4e.jpg', '2019-05-31 05:53:23', '2019-05-31 05:53:23'),
(7, 139, 1, 'Sample_5cf8cf2ca0fcd.jpg', '2019-06-06 15:30:36', '2019-06-06 15:30:36'),
(8, 139, 0, 'Sample_5cf8cf2ca0fcd.jpg', '2019-06-06 15:30:47', '2019-06-06 15:30:47'),
(11, 140, 1, 'Sample_5cf8d0d77735a.jpg', '2019-06-06 15:37:43', '2019-06-06 15:37:43'),
(12, 141, 1, 'Sample_5cf8f41650b02.jpg', '2019-06-06 18:08:06', '2019-06-06 18:08:06'),
(13, 141, 0, 'Sample_5cf8f41650b02.jpg', '2019-06-06 18:09:04', '2019-06-06 18:09:04'),
(16, 143, 1, 'Sample Product_5cfbb7414e117.jpg', '2019-06-08 20:25:21', '2019-06-08 20:25:21'),
(17, 143, 0, '/tmp/phpGWO1eC', '2019-06-08 20:28:27', '2019-06-08 20:28:27'),
(18, 144, 1, 'Product_5cfbba72c272b.jpg', '2019-06-08 20:38:58', '2019-06-08 20:38:58'),
(19, 127, 1, 'Walking-Tree-Harvester_5cfdaff2e4149.jpg', '2019-06-10 08:18:42', '2019-06-10 08:18:42'),
(20, 147, 0, '', '2019-06-13 18:55:43', '2019-06-13 20:36:17'),
(21, 147, 0, '', '2019-06-13 19:13:14', '2019-06-13 20:36:17'),
(22, 147, 0, '', '2019-06-13 19:20:40', '2019-06-13 20:36:17'),
(23, 147, 0, '', '2019-06-13 20:15:06', '2019-06-13 20:36:17'),
(24, 147, 0, '', '2019-06-13 20:32:30', '2019-06-13 20:36:17'),
(31, 148, 1, 'dsf_5d0251853bdd5.jpg', '2019-06-13 20:37:12', '2019-06-13 20:37:12'),
(33, 127, 0, '/tmp/phpZuyzsG', '2019-06-14 09:01:45', '2019-06-14 09:01:45'),
(34, 127, 0, '', '2019-06-14 09:11:48', '2019-06-14 09:11:48'),
(35, 127, 0, '', '2019-06-14 09:14:22', '2019-06-14 09:14:22'),
(36, 147, 1, '/tmp/phpXv8pkY', '2019-06-15 19:36:43', '2019-06-15 19:36:43'),
(37, 147, 0, '', '2019-06-15 19:56:56', '2019-06-15 19:56:56'),
(38, 147, 0, '', '2019-06-15 20:16:46', '2019-06-15 20:16:46'),
(39, 147, 0, '', '2019-06-15 20:54:35', '2019-06-15 20:54:35'),
(40, 127, 0, '', '2019-06-16 19:07:03', '2019-06-16 19:07:03'),
(41, 149, 1, 'product 3_5d56b03f47fa4.jpg', '2019-08-16 20:31:45', '2019-08-16 20:31:45'),
(42, 127, 0, '', '2019-10-16 14:59:41', '2019-10-16 14:59:41'),
(43, 151, 1, '', '2020-03-02 00:51:02', '2020-03-02 00:51:02'),
(44, 151, 0, '', '2020-03-02 06:18:11', '2020-03-02 06:18:11'),
(45, 151, 0, '', '2020-03-02 06:18:29', '2020-03-02 06:18:29'),
(46, 151, 0, '', '2020-03-02 06:21:07', '2020-03-02 06:21:07'),
(47, 152, 1, 'python EN_5e5cf3f271885.jpg', '2020-03-02 06:24:26', '2020-03-02 06:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_start_times`
--

CREATE TABLE `product_start_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `start_times_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_start_times`
--

INSERT INTO `product_start_times` (`id`, `product_id`, `start_times_id`, `active`) VALUES
(2228, 124, 5, 1),
(2229, 125, 4, 1),
(2232, 128, 10, 1),
(2233, 129, 8, 1),
(2234, 130, 11, 1),
(2235, 131, 6, 1),
(2236, 132, 6, 1),
(2237, 132, 11, 1),
(2238, 132, 16, 1),
(2239, 132, 21, 1),
(2240, 133, 10, 1),
(2244, 139, 4, 1),
(2245, 139, 5, 1),
(2246, 139, 6, 1),
(2256, 140, 3, 1),
(2257, 140, 6, 1),
(2258, 140, 10, 1),
(2269, 141, 2, 1),
(2270, 141, 3, 1),
(2271, 141, 4, 1),
(2272, 141, 5, 1),
(2273, 141, 6, 1),
(2274, 141, 7, 1),
(2275, 141, 8, 1),
(2276, 141, 9, 1),
(2277, 141, 10, 1),
(2278, 141, 11, 1),
(2279, 142, 4, 1),
(2280, 142, 5, 1),
(2281, 142, 6, 1),
(2282, 142, 7, 1),
(2283, 142, 12, 1),
(2284, 142, 13, 1),
(2304, 143, 5, 1),
(2305, 143, 6, 1),
(2306, 143, 7, 1),
(2307, 143, 8, 1),
(2308, 143, 9, 1),
(2309, 143, 10, 1),
(2310, 143, 11, 1),
(2311, 143, 12, 1),
(2312, 143, 13, 1),
(2313, 143, 14, 1),
(2314, 143, 15, 1),
(2315, 143, 16, 1),
(2316, 144, 11, 1),
(2317, 144, 14, 1),
(2318, 144, 17, 1),
(2328, 145, 8, 1),
(2329, 145, 9, 1),
(2330, 145, 11, 1),
(2331, 146, 14, 1),
(2481, 148, 5, 1),
(2573, 147, 8, 1),
(2574, 147, 10, 1),
(2575, 147, 11, 1),
(2576, 147, 12, 1),
(2577, 147, 13, 1),
(2578, 147, 14, 1),
(2579, 147, 15, 1),
(2580, 147, 16, 1),
(2581, 147, 17, 1),
(2582, 147, 18, 1),
(2583, 147, 19, 1),
(2584, 147, 20, 1),
(2585, 147, 21, 1),
(2586, 147, 22, 1),
(2587, 147, 23, 1),
(2588, 147, 24, 1),
(2598, 149, 1, 1),
(2599, 127, 10, 1),
(2600, 127, 11, 1),
(2601, 127, 12, 1),
(2602, 127, 13, 1),
(2603, 127, 14, 1),
(2604, 127, 15, 1),
(2605, 127, 16, 1),
(2606, 127, 17, 1),
(2607, 127, 18, 1),
(2608, 150, 3, 1),
(2625, 151, 2, 1),
(2626, 151, 3, 1),
(2627, 151, 4, 1),
(2628, 151, 5, 1),
(2629, 151, 6, 1),
(2630, 152, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `start_times`
--

CREATE TABLE `start_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `start_times`
--

INSERT INTO `start_times` (`id`, `start_time`, `start_value`) VALUES
(1, '0:00', 0),
(2, '1:00', 100),
(3, '2:00', 200),
(4, '3:00', 300),
(5, '4:00', 400),
(6, '5:00', 500),
(7, '6:00', 600),
(8, '7:00', 700),
(9, '8:00', 800),
(10, '9:00', 900),
(11, '10:00', 1000),
(12, '11:00', 1100),
(13, '12:00', 1200),
(14, '13:00', 1300),
(15, '14:00', 1400),
(16, '15:00', 1500),
(17, '16:00', 1600),
(18, '17:00', 1700),
(19, '18:00', 1800),
(20, '19:00', 1900),
(21, '20:00', 2000),
(22, '21:00', 2100),
(23, '22:00', 2200),
(24, '23:00', 2300);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'Peter Püschel', 'peter@puschel.se', '$2y$10$ya.q1eNdBEusZzmomj4Njev93F4dk4uPoOhOg77fj76UskIGlYsRC', 'rUu6CnKNtUzzyGdcME9YQnYEe3Ydt1Zu5WtZWqyIni7W45f1OBZBnywenvPH', '2016-05-05 17:52:33', '2020-03-04 00:37:20'),
(18, 'Ulf Larsson', 'info@karlstadspaddlarklubb.se', '$2y$10$iFmWZiTdBREze.dF/Z3WkezjDha0T3KINh6LDbUCrWKu1GoS9/uxa', 'c2569knSSMg4zDQOZvTN3CPJS3WARcePFZEM3Il3rvsW21iBZpeWpKSY8S20', '2016-05-06 11:37:25', '2016-05-06 11:44:23'),
(19, 'James Farrell', 'info@jamespfarrell.com', '$2y$10$qBfR7byJ2QoOF4vuRMG7ju4AsWHoc49PQmgfaNZOTHDTrGWhghqi6', 'ap9f7ZKQyb2nWZIZy71JV95AFRWIqk9p9XJXyDGgZaxwDqR3fk9DsOEuulqp', '2016-05-10 18:18:53', '2016-05-10 18:18:57'),
(20, 'Demo av BokaKanot', 'jamespfarrell@gmail.com', '$2y$10$KNdgNlvm6CDxld4samZXmO.ZVD4M05igYAUmWR1MZD.ecV.qgpT1u', NULL, '2016-05-11 07:34:30', '2016-05-11 07:34:30'),
(21, 'Peter Püschel', 'demo@bokakanot.se', '$2y$10$/gG3vrrAShWW4xo.ubcy8.Out2csw0c8xq9r7J4hvDBY5e9wdcOxm', 'h7QQTUwQrXrBtZSGIsIDpXUIRiKaZxm1zZ2AZeflW3C4um5CHPols0spS3Dq', '2016-05-11 13:10:54', '2018-06-26 20:59:20'),
(22, 'Jonas Forsmark', 'jonas@softskills.se', '$2y$10$YCvdX2PWCiYBXKBXiNVBfufZGygGiyxDsif796AUom92RpblP5X2q', NULL, '2016-05-16 12:28:17', '2016-05-16 12:28:17'),
(23, 'Hans Fallström', 'hans.fallstrom@gmail.com', '$2y$10$3QWg5m4JkPLCL8GbxgUqSOBNGQdkCr5r5S34v361gL9hWS7HS/tNa', NULL, '2016-05-16 12:38:02', '2016-05-16 12:38:02'),
(24, 'Manesh', 'manesh.bahuguna@gmail.com', '$2y$10$9wwvghgzceFlm3Ov6wvsqORW33oeELViqAZCwaVPrRSwFCF3XxCQ6', 'ZuDM0RHOS3aMKDR1XvzXqd9vAMbM8kTSpioWCihCatLkKx6WeD2PPshfM30X', '2016-05-23 08:19:49', '2019-10-25 11:59:25'),
(25, 'Daniel Bengtsson', 'daniel@svima.se', '$2y$10$Ge7HgogcCZFwF/b2RZ0s4.qvv17P.MHSF0S6THlPG7m04gzSyWYou', NULL, '2016-05-25 07:12:29', '2016-05-25 07:12:29'),
(26, 'Per-Åke Persson', 'per-ake@halenkanot.com', '$2y$10$XIsE1J16CYIYnD7.sDZ5he34O6pFlMMIjy5LPccWUpplGN4WYTqY2', 'gbAOHdMtKaOTXxlji1IKrWoQAC5AgxzMfLEW8uQGLbTNxaLdbDNHLVRDtaaM', '2016-06-17 05:33:18', '2016-06-17 06:07:04'),
(27, 'James Farrell', 'infoa@jamespfarrell.cosdf', '$2y$10$nt8tWOxPghJTE8FQ695ZEe79rjMLXp6OucYf6N5iPmZc2ulXLPKli', NULL, '2016-06-22 13:03:26', '2016-06-22 13:03:26'),
(28, 'Hans Gelter', 'contact@guide-natura.com', '$2y$10$4k6VX5Y6syreyIFtMDxtE.M2RwL8YkjWzQIHzNSzvPUVJJYBCLCMW', NULL, '2016-06-27 20:08:26', '2016-06-27 20:08:26'),
(29, 'Daniel Mattsson', 'hammaro@friluftsframjandet.se', '$2y$10$FmNr.wv8.WID3a/r6Ra98OwfzAVcOn2oyHmZqVcyq0sjj2H9DJpR.', '0azS9I6ySdYrVF1qjQVSIHAMBeCHv028JY9mhI4g7dXXflwl99xhl4xYv2EM', '2016-06-29 12:24:48', '2016-06-29 12:33:11'),
(30, 'Daniel Bendrik', 'daniel@dalarokajak.se', '$2y$10$OB5CwKkfbwX7q17PtbthROUFc41YUVcxwNqE097XROOLJlMe2etB.', NULL, '2016-10-21 07:52:45', '2016-10-21 07:52:45'),
(31, 'Johan Adlercreutz', 'info@kustleden.com', '$2y$10$c/WUJ7YD1tlpmZR607zP8.CYOWreLPq/yBnI/Gs5emELyRSOifDpy', NULL, '2016-10-21 13:33:18', '2016-10-21 13:33:18'),
(32, 'Ronny Waumans', 'info@emventure.se', '$2y$10$d/gIDg0XtaFOMPxGdasM2.KE1VVohUIs5TzMAui.5qUUPXUL/iVIa', NULL, '2016-10-21 14:03:00', '2016-10-21 14:03:00'),
(33, 'Pelle Hammarström', 'pelle@nynaskajak.se', '$2y$10$KKgo0vLlsvxA8pGPhDBU3.AWAoQdrNYPn3glG.QhSUg7a8.qbxive', NULL, '2016-10-21 14:10:04', '2016-10-21 14:10:04'),
(34, 'Alexander Lindgren', 'alexander@grasokanot.se', '$2y$10$FKHcb/JfuIhUrUeY73CaROfmoxw8fesH/734buRYzcbYnhRac/Sae', 'F0egXEA1SFtnMmSiXEH0bThoagVYHUu7y86ZqyJ0XzycHduaLU85QyNedTNl', '2016-10-28 23:18:55', '2016-10-28 23:56:17'),
(35, 'Christer Emanuelsson', 'office@silverlake.se', '$2y$10$mOfmgJQMefYAd7.hh7otfuJBqsh42/BXik5sHYlR/suI2b.Vsn9dq', 'ZQ5qUItO2TaG03gOMctHbb6oWDTIyNqhEsDDOzaql27i6rJqjpatp6C7mxwt', '2016-11-03 08:28:25', '2016-11-14 13:03:34'),
(36, 'Christoffer karlströn', 'info@kanotcamping.se', '$2y$10$ZY8K2vcFnKuL937yMzCyK.UdvXiTSPIAJWwQdiqu7YSWcljMKmQva', NULL, '2016-12-08 19:11:46', '2016-12-08 19:11:46'),
(37, 'Sico Dob', 'info@halleforsvandrarhem.com', '$2y$10$hn6sVkMehPCBKgVaFYIrJ.18Gy9r3XZ002MrtfL8KxSt.yrpG9GMa', '1HjfGiBW5erhwIFXTn3xi37I0T7GNQJeEX9UoAOKsQ5p10fhSmy1uzKgXZuL', '2017-02-07 15:15:57', '2017-02-08 15:47:25'),
(38, 'Fredrik Karlsson', 'fredrik@kajak-uteliv.com', '$2y$10$JXwwHIAu5eT1mC75bu6W9ekuaCYuSDgOb2fKdnqsC1SHWxAIBRi7C', 'u8XJn69EVf3MSQaD1hlBbsf6KPEslMHF2NRjfo5QosENaC7qFKsrHunFqx5q', '2017-02-08 08:10:40', '2017-02-17 06:50:00'),
(39, 'Carin Green', 'info@horisontkajak.se', '$2y$10$TYGp0k8OveD6j1I2A3OY7ePCJ5Nlq8eUhf4CvcK1/HM1uFAAQbsDe', 'yyZFk7ljmJdb8dbRpzxomw5LhX9M8sDzvA2pBcpaGheLs112lab6C49edcl2', '2017-03-21 12:45:50', '2017-03-27 17:28:59'),
(40, 'André Axelsson', 'info@lakesideadventure.se', '$2y$10$S9h4I1Gt3k9XzPvTHRqj1Oo1I5lHlEb8MmBUkbjmYS8h1rr0I9Z9C', NULL, '2017-04-20 15:24:58', '2017-04-20 15:24:58'),
(41, 'Per Sjöholm', 'per.t.sjoholm@spk.nu', '$2y$10$6R6J36XEnMg2dN4k2qImyunCEUjWxBnlhHTvRKRIvsXXrNKk0Bvy.', 'zgpCsiBGc1UUx79egpeXWQT6dIgbXeDIRHVdula6PkwjWIpCvMpzoeTdWsvF', '2017-05-23 18:22:29', '2017-05-23 18:35:51'),
(42, 'Peter Karlstads Kanotklubb', 'karlstad@puschel.se', '$2y$10$/gG3vrrAShWW4xo.ubcy8.Out2csw0c8xq9r7J4hvDBY5e9wdcOxm', 'uq3fSihBfOyLylsGROkXBJ3EYLLeQaB6BGgnZWUaFXrhutlT1SZCvM19MNkU', '2017-09-14 12:09:55', '2017-09-14 20:13:24'),
(43, 'sam', 'sambath@yahoo.com', '$2y$10$R5FXHCnP0RG0Fbx1xQHB.ek2xI5g5qSJcUM9knVhfEqvH1blB.03G', NULL, '2017-09-16 01:14:08', '2017-09-16 01:14:08'),
(44, 'Jonas Olsson', 'info@sjostugan.com', '$2y$10$45alV.c6QVmOmJeJA9wMmOnscYu0yjSzZ.e3SALukZGGAbWX0W8cG', 'dNQPeoaMn7DhXpESQB0Gv3rt6VQ8k201nIRM81ltWvm6xqlgMmB74HMjPpr9', '2018-02-02 07:17:57', '2018-03-01 11:39:42'),
(45, 'Fredrik Karlsson', 'fredrik@kayakoutdoors.se', '$2y$10$PNeayib.GfwWbPcGdLiS/eTVZg4vUElb21nhC8s3RNyZKKw1gUzWS', NULL, '2018-03-19 07:22:41', '2018-03-19 07:22:41'),
(46, 'Kanotuthyrning Karlstads Paddlarklubb', 'hyrkanot@karlstadspaddlarklubb.se', '$2y$10$ya.q1eNdBEusZzmomj4Njev93F4dk4uPoOhOg77fj76UskIGlYsRC', 'f9ty28e3cBDy3GfLujI7MrSquMb6hR5zST331LMQeEgeIGULEkgN3PpnmGvp', '2018-05-10 08:51:06', '2018-07-09 13:48:31'),
(47, 'Peter Rebuy', 'peter@rebuy.se', '$2y$10$2IpH.Uam1yKnanUuYlIcIu5e7AF63IC854t.oFNHdu1eD9YEnwR1q', NULL, '2018-05-29 15:20:42', '2018-05-29 15:20:42'),
(48, 'Peter karlstad invite', 'peter@brutalteknik.se', '$2y$10$9gZqNtre0amUxmnrJYV8r.ZTJLp2J3s5tlEOfvCz/vFzUk1iQCBwu', 'tYP0WFcCq8Lp1UonVL6S6DbCuKGeFPNfXsZBAmcKpyyPM4weBid92DZbeFOr', '2018-05-29 19:29:39', '2018-06-26 17:46:16'),
(49, 'Sico Dob', 'info@halleforskanot.com', '$2y$10$4p.J9mH9rTkA0Wx8Yhi2oeeVvj8IkRvVBbR.3bKEBhqy5IneMETPW', NULL, '2018-12-07 09:39:50', '2018-12-07 09:39:50'),
(50, 'Mohideen', 'mohaideenjailani@gmail.com', '$2y$10$yjWeGTYpf6/t8Ln0EaCkb.pEnUJkekUvcUT4FEIzSEhXQ4shisR8C', '2ZI4BodaKeMKi9UiW32heELXwiXWbpiKki2Ipm1oOvne4sb5sq5Lq9Gpy89y', '2019-04-15 23:13:35', '2019-04-29 22:56:33'),
(51, 'Karthika', 'karthikathiruvengatam11.karthi@gmail.com', '$2y$10$38QM98J26IIyav8Tb7TuUuKDq7wEQa9EDrToRdPbbKhSZbT7j4p5K', 'IN7f0VV4SlE1vXjlTxvjk65UEA9S2A1DiiJJpMjvIH0cEqiPDhru40zuGy4l', '2019-04-24 05:07:08', '2019-04-24 23:14:08'),
(52, 'rtyrytry', 'karthikathiruvengam11.karthi@gmail.com', '$2y$10$wbgYysjxX0FVvVcmaw9hVu/Py7vocRfLn9H6R7i/35LS55T0OoFJS', 'MBbcCrk4NATiJv2742leu3HWdMdxL7YnECy2d30VlDLVOamz0QniSdHzdAJr', '2019-04-25 05:30:20', '2019-04-25 05:31:47'),
(53, 'Jeeva', 'jeevalakshmi@isquarebs.com', '$2y$10$/DoFyE.86vG18bBoLyWHD.3rbsr72Otm5JCpuw.oydfgoAW8B8SSe', NULL, '2019-04-26 08:21:46', '2019-04-26 08:21:46'),
(54, 'karthika', 'karthika@gmail.com', '$2y$10$WOsLiyGb1781FHvsIUpkqe38f9w8oN6MUTH5Skyr.3yZGSZ76TVF.', 'q19dqcDVfrA9KYITA44bYvqzzmEmmn9JR8kLPQNFikFE1HcTttEWGmetYqXI', '2019-05-25 00:42:55', '2019-09-05 11:43:54'),
(55, 'jeeva', 'jeeva@gmail.com', '$2y$10$UyF8ErGuDOH3eGvDRgADcOX0TrdoifRjqfodMjvZSHCvvtNg4hQWW', NULL, '2019-06-01 02:05:54', '2019-06-01 02:05:54'),
(56, 'Lakshmi', 'lakshmi@gmail.com', '$2y$10$jB1fahQBsyErPumzKER90eXatXRLOQPP5NcPf.GdaaWR8egB5o2kS', 'LMMmHWpATH1yBr8TbFwhQAzjTATWp8DEFXeS556HvJEYKVxGkWn8qEtr7nXr', '2019-06-06 18:16:16', '2019-06-06 19:56:15'),
(57, 'Jeeva', 'jeevaishu24@gmail.com', '$2y$10$I4vPqbGqWciLebNR.S/A/uxu34NoGEWW/ab9R.ec8myPKu5Sym4Ka', 'yDrwrd8HkzqEbBqa82ru5bkjmpFka02xOtfWiSkh6qfpALopmxqO9Bg4zhGX', '2019-06-08 20:38:05', '2019-06-08 22:01:39'),
(58, 'Karthika', 'karthika@isquarebs.com', '$2y$10$Cq4xq/9skhFr1PhkOb8b9eTa0/x/laYuK4bIxysAaTTVQPvOshUcq', NULL, '2019-06-10 12:22:40', '2019-06-10 12:22:40'),
(59, 'test', 'test@gmail.com', '$2y$10$e7DM4tXc8GUeHS4VwcW5l.v7KMHIoM72vcJg5W7r7KM04ITdkCmfm', NULL, '2019-10-22 11:39:02', '2019-10-22 11:39:02'),
(60, 'Test', 'bholarajan3.rs@gmail.com', '$2y$10$hvOBqBPE1z6mC753PHzNv.sQxX9.Fu3MieBhMZy11HiWVTntFf/9C', 'MoUnsXdkUnlv1guRxCNaHrB4nZ8yfNubQxLUCdjXABkYL7oyZorXzekr1DGl', '2019-10-25 12:01:18', '2019-10-25 12:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`name`, `id`, `created_at`, `updated_at`) VALUES
('Centre Admin', 1, NULL, NULL),
('Centre User', 2, NULL, NULL),
('Centre User', 51, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_invitations`
--
ALTER TABLE `admin_invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_invoice_id` (`booking_invoice_id`),
  ADD UNIQUE KEY `booking_invoice_id_2` (`booking_invoice_id`),
  ADD KEY `bookings_centre_id_index` (`centre_id`);

--
-- Indexes for table `booking_invoice`
--
ALTER TABLE `booking_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_product`
--
ALTER TABLE `booking_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_product_booking_id_index` (`booking_id`),
  ADD KEY `booking_product_product_id_index` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_centre_id_index` (`centre_id`),
  ADD KEY `categories_parent_category_id_index` (`parent_category_id`);

--
-- Indexes for table `centres`
--
ALTER TABLE `centres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `urlSlug` (`urlSlug`);

--
-- Indexes for table `centre_localisation`
--
ALTER TABLE `centre_localisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centre_localisation_centre_id_index` (`centre_id`);

--
-- Indexes for table `centre_payment_methods`
--
ALTER TABLE `centre_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centre_payment_methods_payment_methods_id_index` (`payment_methods_id`),
  ADD KEY `centre_payment_methods_centre_id_index` (`centre_id`);

--
-- Indexes for table `centre_user`
--
ALTER TABLE `centre_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centre_user_user_id_index` (`user_id`),
  ADD KEY `centre_user_centre_id_index` (`centre_id`),
  ADD KEY `centre_user_user_type_id_index` (`user_type_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_types`
--
ALTER TABLE `per_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_types_product`
--
ALTER TABLE `per_types_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `per_types_product_product_id_index` (`product_id`),
  ADD KEY `per_types_product_per_types_id_index` (`per_types_id`);

--
-- Indexes for table `per_type_times`
--
ALTER TABLE `per_type_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_type_time_product`
--
ALTER TABLE `per_type_time_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `per_type_time_product_product_id_index` (`product_id`),
  ADD KEY `per_type_time_product_per_type_time_id_index` (`per_type_time_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_product`
--
ALTER TABLE `price_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_product_price_id_index` (`price_id`),
  ADD KEY `price_product_product_id_index` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `per_type_id` (`per_type_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_start_times`
--
ALTER TABLE `product_start_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_start_times_product_id_index` (`product_id`),
  ADD KEY `product_start_times_start_times_id_index` (`start_times_id`);

--
-- Indexes for table `start_times`
--
ALTER TABLE `start_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_invitations`
--
ALTER TABLE `admin_invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `booking_invoice`
--
ALTER TABLE `booking_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product`
--
ALTER TABLE `booking_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `centres`
--
ALTER TABLE `centres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `centre_localisation`
--
ALTER TABLE `centre_localisation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7574;

--
-- AUTO_INCREMENT for table `centre_payment_methods`
--
ALTER TABLE `centre_payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;

--
-- AUTO_INCREMENT for table `centre_user`
--
ALTER TABLE `centre_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `per_types`
--
ALTER TABLE `per_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `per_types_product`
--
ALTER TABLE `per_types_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `per_type_times`
--
ALTER TABLE `per_type_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `per_type_time_product`
--
ALTER TABLE `per_type_time_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `price_product`
--
ALTER TABLE `price_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3356;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_start_times`
--
ALTER TABLE `product_start_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2631;

--
-- AUTO_INCREMENT for table `start_times`
--
ALTER TABLE `start_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_centre_id_foreign` FOREIGN KEY (`centre_id`) REFERENCES `centres` (`id`),
  ADD CONSTRAINT `bookings_invoice_id_foreign` FOREIGN KEY (`booking_invoice_id`) REFERENCES `booking_invoice` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product`
--
ALTER TABLE `booking_product`
  ADD CONSTRAINT `booking_product_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_centre_id_foreign` FOREIGN KEY (`centre_id`) REFERENCES `centres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_parent_category_id_foreign` FOREIGN KEY (`parent_category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `centre_localisation`
--
ALTER TABLE `centre_localisation`
  ADD CONSTRAINT `centre_localisation_centre_id_foreign` FOREIGN KEY (`centre_id`) REFERENCES `centres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `centre_payment_methods`
--
ALTER TABLE `centre_payment_methods`
  ADD CONSTRAINT `centre_payment_methods_centre_id_foreign` FOREIGN KEY (`centre_id`) REFERENCES `centres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `centre_payment_methods_payment_methods_id_foreign` FOREIGN KEY (`payment_methods_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `centre_user`
--
ALTER TABLE `centre_user`
  ADD CONSTRAINT `centre_user_centre_id_foreign` FOREIGN KEY (`centre_id`) REFERENCES `centres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `centre_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `centre_user_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);

--
-- Constraints for table `per_types_product`
--
ALTER TABLE `per_types_product`
  ADD CONSTRAINT `per_types_product_per_types_id_foreign` FOREIGN KEY (`per_types_id`) REFERENCES `per_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `per_types_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `per_type_time_product`
--
ALTER TABLE `per_type_time_product`
  ADD CONSTRAINT `per_type_time_product_per_type_time_id_foreign` FOREIGN KEY (`per_type_time_id`) REFERENCES `per_type_times` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `per_type_time_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_product`
--
ALTER TABLE `price_product`
  ADD CONSTRAINT `price_product_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`),
  ADD CONSTRAINT `price_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`per_type_id`) REFERENCES `per_types` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_start_times`
--
ALTER TABLE `product_start_times`
  ADD CONSTRAINT `product_start_times_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_start_times_start_times_id_foreign` FOREIGN KEY (`start_times_id`) REFERENCES `start_times` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
