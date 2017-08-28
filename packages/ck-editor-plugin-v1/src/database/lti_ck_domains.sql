-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2017 at 05:58 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsugi`
--

-- --------------------------------------------------------

--
-- Table structure for table `lti_ck_domains`
--

CREATE TABLE `lti_ck_domains` (
  `id` int(10) UNSIGNED NOT NULL,
  `launch_url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lti_ck_domains`
--

INSERT INTO `lti_ck_domains` (`id`, `launch_url`, `key`, `secret`, `created_at`, `updated_at`) VALUES
(1, 'https://bltools.creighton.edu/lti/ltimaps/ltimaps/map.php ', '12345', 'secret', '2017-03-14 00:31:00', '2017-03-14 00:31:00'),
(2, 'https://mirror.unisaonline.net/tao/ltiDeliveryProvider/DeliveryTool/launch/eyJkZWxpdmVyeSI6Imh0dHA6XC9cL3VuaXNhdGVzdDIuY2xvdWRhcHAubmV0XC90YW9cL3VuaXNhLnJkZiNpMTQ2NDYwODEyMjQzNzI4NjczIn0=', 'unisa', '12345', '2017-03-14 01:13:51', '2017-03-14 01:13:51'),
(3, 'https://www.edu-apps.org/titanpad', '', '', '2017-03-14 04:22:30', '2017-03-14 04:22:30'),
(4, 'https://steamboat.youseeu.com/lti/955rf3/lti_connect.php', '', '', '2017-03-14 04:52:38', '2017-03-14 04:52:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lti_ck_domains`
--
ALTER TABLE `lti_ck_domains`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lti_ck_domains`
--
ALTER TABLE `lti_ck_domains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
