-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2023 at 09:07 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stagingdbhoteleers`
--
CREATE DATABASE IF NOT EXISTS `stagingdbhoteleers` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `stagingdbhoteleers`;

-- --------------------------------------------------------

--
-- Table structure for table `employer_image`
--

DROP TABLE IF EXISTS `employer_image`;
CREATE TABLE `employer_image` (
  `id` int NOT NULL,
  `line` int NOT NULL,
  `doc_image` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `file_size` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `employer_image`
--

INSERT INTO `employer_image` (`id`, `line`, `doc_image`, `file_size`) VALUES
(15, 1, '1657502588_DELIMONDO PO.jpg', '0.108'),
(15, 2, '1657502588_JFPC PO.jpg', '0.107'),
(15, 3, '1657502588_NETSUITE SAMPLE PO WITH COMMENT.jpg', '0.133'),
(15, 4, '1657502588_NETSUITE SAMPLE PO WITH COMMENT1 (1).jpg', '0.137'),
(15, 5, '1657502588_NETSUITE SAMPLE PO WITH COMMENT1.jpg', '0.137'),
(15, 6, '1657502588_school-items-white-background-flat-lay.jpg', '10.154'),
(38, 1, '1661838050_Hive_Logo_Simplified.png', '0.209'),
(42, 1, '1662975140_seda1.jpg', '0.194'),
(42, 2, '1662975147_seda2.jpg', '0.454'),
(42, 3, '1662975160_seda3.jpg', '0.067'),
(49, 1, '1662972395_280715796.jpg', '0.100'),
(49, 2, '1662972395_bedroom-jpeg.jpg', '0.029'),
(49, 3, '1662972395_ebf42f10b7e63c9c8d588ab145b62c9a.jpg', '0.130'),
(17, 1, '1657798231_donnie-rosie-taO2fC7sxDU-unsplash.jpg', '4.364'),
(17, 2, '1657798231_pexels-craig-adderley-1563356.jpg', '5.840'),
(17, 3, '1659582268_prf.jpg', '0.010'),
(86, 1, '1676971282_Screen Shot 2023-02-20 at 11.35.50 PM.png', '0.101'),
(21, 5, '1662953992_Subic-Waterfront-Resort-and-Hotel.jpeg', '0.093'),
(21, 6, '1662953992_subic-waterfront-resort.jpeg', '0.067');

-- --------------------------------------------------------

--
-- Table structure for table `employer_saved_applicant`
--

DROP TABLE IF EXISTS `employer_saved_applicant`;
CREATE TABLE `employer_saved_applicant` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'employer_saved_applicant',
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_applicant`
--

DROP TABLE IF EXISTS `job_post_applicant`;
CREATE TABLE `job_post_applicant` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post_applicant',
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_for_interview`
--

DROP TABLE IF EXISTS `job_post_for_interview`;
CREATE TABLE `job_post_for_interview` (
  `id` int NOT NULL,
  `job_post_id` int NOT NULL,
  `line` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post_for_interview',
  `user_id` int NOT NULL,
  `interview_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `interview_start_time` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `interview_end_time` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `interviewer_name_position` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `interview_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `virtual_interview_link` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notes_to_interviewee` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_move_to`
--

DROP TABLE IF EXISTS `job_post_move_to`;
CREATE TABLE `job_post_move_to` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post_move_to',
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_report`
--

DROP TABLE IF EXISTS `job_post_report`;
CREATE TABLE `job_post_report` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post_report',
  `user_id` int NOT NULL,
  `comment` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_trending`
--

DROP TABLE IF EXISTS `job_post_trending`;
CREATE TABLE `job_post_trending` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post_trending',
  `user_id` int NOT NULL,
  `points` int NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_views`
--

DROP TABLE IF EXISTS `job_post_views`;
CREATE TABLE `job_post_views` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post_views',
  `user_id` int NOT NULL,
  `points` int NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oaud`
--

DROP TABLE IF EXISTS `oaud`;
CREATE TABLE `oaud` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `action` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `record_id` int NOT NULL,
  `record_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `line` int NOT NULL DEFAULT '0',
  `record_field` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `record_field_old_value` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `record_field_new_value` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ocurrency`
--

DROP TABLE IF EXISTS `ocurrency`;
CREATE TABLE `ocurrency` (
  `id` int NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ocurrency`
--

INSERT INTO `ocurrency` (`id`, `code`, `name`, `country`) VALUES
(161, 'AED', '', ''),
(162, 'AFN', '', ''),
(163, 'ALL', '', ''),
(164, 'AMD', '', ''),
(165, 'ANG', '', ''),
(166, 'AOA', '', ''),
(167, 'ARS', '', ''),
(168, 'AUD', '', ''),
(169, 'AWG', '', ''),
(170, 'AZN', '', ''),
(171, 'BAM', '', ''),
(172, 'BBD', '', ''),
(173, 'BDT', '', ''),
(174, 'BGN', '', ''),
(175, 'BHD', '', ''),
(176, 'BIF', '', ''),
(177, 'BMD', '', ''),
(178, 'BND', '', ''),
(179, 'BOB', '', ''),
(180, 'BOV', '', ''),
(181, 'BRL', '', ''),
(182, 'BSD', '', ''),
(183, 'BTN', '', ''),
(184, 'BWP', '', ''),
(185, 'BYN', '', ''),
(186, 'BZD', '', ''),
(187, 'CAD', '', ''),
(188, 'CDF', '', ''),
(189, 'CHE', '', ''),
(190, 'CHF', '', ''),
(191, 'CHW', '', ''),
(192, 'CLF', '', ''),
(193, 'CLP', '', ''),
(194, 'CNY', '', ''),
(195, 'COP', '', ''),
(196, 'COU', '', ''),
(197, 'CRC', '', ''),
(198, 'CUC', '', ''),
(199, 'CUP', '', ''),
(200, 'CVE', '', ''),
(201, 'CZK', '', ''),
(202, 'DJF', '', ''),
(203, 'DKK', '', ''),
(204, 'DOP', '', ''),
(205, 'DZD', '', ''),
(206, 'EGP', '', ''),
(207, 'ERN', '', ''),
(208, 'ETB', '', ''),
(209, 'EUR', '', ''),
(210, 'FJD', '', ''),
(211, 'FKP', '', ''),
(212, 'GBP', '', ''),
(213, 'GEL', '', ''),
(214, 'GHS', '', ''),
(215, 'GIP', '', ''),
(216, 'GMD', '', ''),
(217, 'GNF', '', ''),
(218, 'GTQ', '', ''),
(219, 'GYD', '', ''),
(220, 'HKD', '', ''),
(221, 'HNL', '', ''),
(222, 'HRK', '', ''),
(223, 'HTG', '', ''),
(224, 'HUF', '', ''),
(225, 'IDR', '', ''),
(226, 'ILS', '', ''),
(227, 'INR', '', ''),
(228, 'IQD', '', ''),
(229, 'IRR', '', ''),
(230, 'ISK', '', ''),
(231, 'JMD', '', ''),
(232, 'JOD', '', ''),
(233, 'JPY', '', ''),
(234, 'KES', '', ''),
(235, 'KGS', '', ''),
(236, 'KHR', '', ''),
(237, 'KMF', '', ''),
(238, 'KPW', '', ''),
(239, 'KRW', '', ''),
(240, 'KWD', '', ''),
(241, 'KYD', '', ''),
(242, 'KZT', '', ''),
(243, 'LAK', '', ''),
(244, 'LBP', '', ''),
(245, 'LKR', '', ''),
(246, 'LRD', '', ''),
(247, 'LSL', '', ''),
(248, 'LYD', '', ''),
(249, 'MAD', '', ''),
(250, 'MDL', '', ''),
(251, 'MGA', '', ''),
(252, 'MKD', '', ''),
(253, 'MMK', '', ''),
(254, 'MNT', '', ''),
(255, 'MOP', '', ''),
(256, 'MRU', '', ''),
(257, 'MUR', '', ''),
(258, 'MVR', '', ''),
(259, 'MWK', '', ''),
(260, 'MXN', '', ''),
(261, 'MXV', '', ''),
(262, 'MYR', '', ''),
(263, 'MZN', '', ''),
(264, 'N/A', '', ''),
(265, 'NAD', '', ''),
(266, 'NGN', '', ''),
(267, 'NIO', '', ''),
(268, 'NOK', '', ''),
(269, 'NPR', '', ''),
(270, 'NZD', '', ''),
(271, 'OMR', '', ''),
(272, 'PAB', '', ''),
(273, 'PEN', '', ''),
(274, 'PGK', '', ''),
(275, 'PHP', '', ''),
(276, 'PKR', '', ''),
(277, 'PLN', '', ''),
(278, 'PYG', '', ''),
(279, 'QAR', '', ''),
(280, 'RON', '', ''),
(281, 'RSD', '', ''),
(282, 'RUB', '', ''),
(283, 'RWF', '', ''),
(284, 'SAR', '', ''),
(285, 'SBD', '', ''),
(286, 'SCR', '', ''),
(287, 'SDG', '', ''),
(288, 'SEK', '', ''),
(289, 'SGD', '', ''),
(290, 'SHP', '', ''),
(291, 'SLE', '', ''),
(292, 'SOS', '', ''),
(293, 'SRD', '', ''),
(294, 'SSP', '', ''),
(295, 'STN', '', ''),
(296, 'SVC', '', ''),
(297, 'SYP', '', ''),
(298, 'SZL', '', ''),
(299, 'THB', '', ''),
(300, 'TJS', '', ''),
(301, 'TMT', '', ''),
(302, 'TND', '', ''),
(303, 'TOP', '', ''),
(304, 'TRY', '', ''),
(305, 'TTD', '', ''),
(306, 'TWD', '', ''),
(307, 'TZS', '', ''),
(308, 'UAH', '', ''),
(309, 'UGX', '', ''),
(310, 'USD', '', ''),
(311, 'USN', '', ''),
(312, 'UYI', '', ''),
(313, 'UYU', '', ''),
(314, 'UZS', '', ''),
(315, 'VED', '', ''),
(316, 'VEF', '', ''),
(317, 'VND', '', ''),
(318, 'VUV', '', ''),
(319, 'WST', '', ''),
(320, 'XAF', '', ''),
(321, 'XCD', '', ''),
(322, 'XDR', '', ''),
(323, 'XOF', '', ''),
(324, 'XPF', '', ''),
(325, 'XSU', '', ''),
(326, 'XUA', '', ''),
(327, 'YER', '', ''),
(328, 'ZAR', '', ''),
(329, 'ZMW', '', ''),
(330, 'ZWL', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `odepartment`
--

DROP TABLE IF EXISTS `odepartment`;
CREATE TABLE `odepartment` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'department',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `odepartment`
--

INSERT INTO `odepartment` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(3, 'department', 'Administration and General', 0, '2022-06-25 11:50:21'),
(4, 'department', 'Asset Management', 0, '2022-06-25 11:50:21'),
(5, 'department', 'Bakery and Pastry', 0, '2022-06-25 11:50:21'),
(6, 'department', 'Cargo', 0, '2022-06-25 11:50:21'),
(7, 'department', 'Casino', 0, '2022-06-25 11:50:21'),
(8, 'department', 'Catering', 0, '2022-06-25 11:50:21'),
(9, 'department', 'Club Floor', 0, '2022-06-25 11:50:21'),
(10, 'department', 'Concierge', 0, '2022-06-25 11:50:21'),
(11, 'department', 'Customer Service', 0, '2022-06-25 11:50:21'),
(12, 'department', 'E-commerce', 0, '2022-06-25 11:50:21'),
(13, 'department', 'Engineering / Technical Services', 0, '2022-06-25 11:50:21'),
(14, 'department', 'Finance / Accounting', 0, '2022-06-25 11:50:21'),
(15, 'department', 'Flight Crew', 0, '2022-06-25 11:50:21'),
(16, 'department', 'Food and Beverage Kitchen', 0, '2022-06-25 11:50:21'),
(17, 'department', 'Food and Beverage Others', 0, '2022-06-25 11:50:21'),
(18, 'department', 'Food and Beverage Service', 0, '2022-06-25 11:50:21'),
(19, 'department', 'Front Office', 0, '2022-06-25 11:50:21'),
(20, 'department', 'Ground Crew', 0, '2022-06-25 11:50:21'),
(21, 'department', 'Guest Relations', 0, '2022-06-25 11:50:21'),
(22, 'department', 'Housekeeping', 0, '2022-06-25 11:50:21'),
(23, 'department', 'Human Resources', 0, '2022-06-25 11:50:21'),
(24, 'department', 'Information Technology', 0, '2022-06-25 11:50:21'),
(25, 'department', 'Legal', 0, '2022-06-25 11:50:21'),
(26, 'department', 'Logistics', 0, '2022-06-25 11:50:21'),
(27, 'department', 'Management', 0, '2022-06-25 11:50:21'),
(28, 'department', 'Marketing Communications', 0, '2022-06-25 11:50:21'),
(29, 'department', 'Meetings and Events', 0, '2022-06-25 11:50:21'),
(30, 'department', 'Operations', 0, '2022-06-25 11:50:21'),
(31, 'department', 'Others', 0, '2022-06-25 11:50:21'),
(32, 'department', 'Passenger Handling', 0, '2022-06-25 11:50:21'),
(33, 'department', 'Procurement', 0, '2022-06-25 11:50:21'),
(34, 'department', 'Public Relations', 0, '2022-06-25 11:50:21'),
(35, 'department', 'Recreation and Entertainment', 0, '2022-06-25 11:50:21'),
(36, 'department', 'Reservations', 0, '2022-06-25 11:50:21'),
(37, 'department', 'Retail', 0, '2022-06-25 11:50:21'),
(38, 'department', 'Revenue Management', 0, '2022-06-25 11:50:21'),
(39, 'department', 'Rooms Division', 0, '2022-06-25 11:50:21'),
(40, 'department', 'Sales', 0, '2022-06-25 11:50:21'),
(41, 'department', 'Sales and Marketing', 0, '2022-06-25 11:50:21'),
(42, 'department', 'Security', 0, '2022-06-25 11:50:21'),
(43, 'department', 'Spa and Wellness', 0, '2022-06-25 11:50:21'),
(44, 'department', 'Surveillance', 0, '2022-06-25 11:50:21'),
(45, 'department', 'Talent Acquisition', 0, '2022-06-25 11:50:21'),
(46, 'department', 'Transportation', 0, '2022-06-25 11:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `oeducation`
--

DROP TABLE IF EXISTS `oeducation`;
CREATE TABLE `oeducation` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'education',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` int NOT NULL,
  `sequence` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `oeducation`
--

INSERT INTO `oeducation` (`id`, `type`, `name`, `inactive`, `date_created`, `level`, `sequence`) VALUES
(275, 'education', 'Vocational', 0, '2022-06-25 19:07:37', 1, 6),
(276, 'education', 'Certificate', 0, '2022-06-25 19:07:37', 4, 2),
(277, 'education', 'College Level', 0, '2022-06-25 19:07:37', 3, 3),
(520, 'education', 'High School', 0, '2022-10-18 13:53:33', 2, 1),
(521, 'education', 'Bachelor\'s Degree', 0, '2022-10-18 13:53:33', 5, 4),
(522, 'education', 'Master\'s Degree or Higher', 0, '2022-10-18 13:53:33', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `oemail_template`
--

DROP TABLE IF EXISTS `oemail_template`;
CREATE TABLE `oemail_template` (
  `id` int NOT NULL,
  `record_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `subject` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oemployer`
--

DROP TABLE IF EXISTS `oemployer`;
CREATE TABLE `oemployer` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'employer',
  `doc_image` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `about` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dial_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `website` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `location` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `industry` int NOT NULL,
  `start_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_time` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `other_notes` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_time` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `signup` int NOT NULL,
  `deactivated` tinyint(1) NOT NULL DEFAULT '0',
  `paused` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(5000) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oemployer_history`
--

DROP TABLE IF EXISTS `oemployer_history`;
CREATE TABLE `oemployer_history` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'employer_history',
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oemployer_position`
--

DROP TABLE IF EXISTS `oemployer_position`;
CREATE TABLE `oemployer_position` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'employer_position',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ohomepage_banner`
--

DROP TABLE IF EXISTS `ohomepage_banner`;
CREATE TABLE `ohomepage_banner` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'homepage_banner',
  `doc_image_a` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `doc_image_b` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `doc_image_c` varchar(500) COLLATE utf8mb3_unicode_ci NOT NULL,
  `doc_image_d` varchar(500) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_a` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_b` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_c` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_d` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_a` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_b` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_c` varchar(5000) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_d` varchar(2000) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ohomepage_banner`
--

INSERT INTO `ohomepage_banner` (`id`, `type`, `doc_image_a`, `doc_image_b`, `doc_image_c`, `doc_image_d`, `title_a`, `title_b`, `title_c`, `title_d`, `description_a`, `description_b`, `description_c`, `description_d`, `date_created`) VALUES
(5, 'homepage_banner', '1660136063_img-01.png', '1669634093_homebannerb.png', '1671427390_new-section-image.jpg', '1669634081_trendingdesktopbg.png', '', 'that next adventure?', 'passionate individuals!', '', 'Get instant access to numerous job listings in the hospitality and travel industries. Create your profile and let Hoteleers help you find opportunities that match your skills and experiences. ', 'Let\'s get you started! Get your own unique account as a jobseeker. Create your applicant profile, save jobs that interest you, and view all your applications in a few clicks. We\'ve also created an extra list that matches job postings to your personal preferences!\r\n', 'Looking for your first job? An internship? A new career? Or moving up?  Hoteleers is specially designed to make online job hunting fast, easy and convenient for you. We\'ve done all the work to keep it simple so you can focus on the things you need to do as a jobseeker: create a profile and apply for the job you want! ', '', '2022-07-14 14:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `oindustry`
--

DROP TABLE IF EXISTS `oindustry`;
CREATE TABLE `oindustry` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'industry',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sequence` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `oindustry`
--

INSERT INTO `oindustry` (`id`, `type`, `name`, `inactive`, `date_created`, `sequence`) VALUES
(11, 'industry', 'Airline', 0, '2022-06-25 11:31:07', 0),
(12, 'industry', 'Car Rental', 0, '2022-06-25 11:31:07', 0),
(13, 'industry', 'Consulting and Training', 0, '2022-06-25 11:31:07', 0),
(14, 'industry', 'Cruise Ship', 0, '2022-06-25 11:31:07', 0),
(15, 'industry', 'Food and Beverage', 0, '2022-06-25 11:31:07', 0),
(16, 'industry', 'Casino', 0, '2022-06-25 11:31:07', 0),
(17, 'industry', 'Meetings and Events', 0, '2022-06-25 11:31:07', 0),
(18, 'industry', 'Retail', 0, '2022-06-25 11:31:07', 0),
(19, 'industry', 'Serviced Accommodation', 0, '2022-06-25 11:31:07', 0),
(20, 'industry', 'Spa and Wellness', 0, '2022-06-25 11:31:07', 0),
(21, 'industry', 'Software and Technology', 0, '2022-06-25 11:31:07', 0),
(22, 'industry', 'Support Services', 0, '2022-06-25 11:31:07', 0),
(23, 'industry', 'Talent Acquisition', 0, '2022-06-25 11:31:07', 0),
(24, 'industry', 'Theme Park', 0, '2022-06-25 11:31:07', 0),
(26, 'industry', 'Hotel and Resort', 0, '2022-07-16 12:37:15', 1),
(28, 'industry', 'Agency / Tour Operator', 0, '2022-08-26 09:01:20', 0),
(29, 'industry', 'Restaurant', 0, '2022-08-26 09:01:20', 0),
(31, 'industry', 'Property/Real Estate', 1, '2022-09-22 03:36:39', 0),
(32, 'industry', 'Country Club', 0, '2022-11-21 07:04:10', 0),
(33, 'industry', 'Golf and Country Club', 0, '2022-11-21 07:04:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ojob_level`
--

DROP TABLE IF EXISTS `ojob_level`;
CREATE TABLE `ojob_level` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_level',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ojob_level`
--

INSERT INTO `ojob_level` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(8, 'job_level', 'Entry Level', 0, '2022-11-21 07:02:49'),
(9, 'job_level', 'Mid Level', 0, '2022-11-21 07:02:49'),
(10, 'job_level', 'Senior Level', 0, '2022-11-21 07:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `ojob_post`
--

DROP TABLE IF EXISTS `ojob_post`;
CREATE TABLE `ojob_post` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_post',
  `job_title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `department` int NOT NULL,
  `industry` int NOT NULL,
  `job_level` int NOT NULL,
  `job_type` int NOT NULL,
  `education` int NOT NULL,
  `location` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `job_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `qualification` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `salary_currency` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `salary_from` decimal(20,2) NOT NULL,
  `salary_to` decimal(20,2) NOT NULL,
  `perks_and_benefits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `job_expiration_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vacancies` int NOT NULL,
  `vacancies_placeholder` int NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_posted` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `employer` int NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  `remove_on` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_closed` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ojob_type`
--

DROP TABLE IF EXISTS `ojob_type`;
CREATE TABLE `ojob_type` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'job_type',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ojob_type`
--

INSERT INTO `ojob_type` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(41, 'job_type', 'Full time', 0, '2022-06-25 11:28:46'),
(42, 'job_type', 'Part time', 0, '2022-06-25 11:28:46'),
(43, 'job_type', 'Contractual', 0, '2022-06-25 11:28:46'),
(44, 'job_type', 'Project', 0, '2022-06-25 11:28:46'),
(45, 'job_type', 'Internship', 0, '2022-06-25 11:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `olanguage`
--

DROP TABLE IF EXISTS `olanguage`;
CREATE TABLE `olanguage` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'language',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `olanguage`
--

INSERT INTO `olanguage` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(1, 'language', 'Arabic', 0, '2022-09-03 12:33:37'),
(2, 'language', 'Cantonese', 0, '2022-09-03 12:33:37'),
(3, 'language', 'English', 0, '2022-09-03 12:33:37'),
(4, 'language', 'French', 0, '2022-09-03 12:33:37'),
(5, 'language', 'German', 0, '2022-09-03 12:33:37'),
(6, 'language', 'Japanese', 0, '2022-09-03 12:33:37'),
(7, 'language', 'Korean', 0, '2022-09-03 12:34:56'),
(8, 'language', 'Mandarin', 0, '2022-09-03 12:34:56'),
(9, 'language', 'Portuguese', 0, '2022-09-03 12:34:56'),
(10, 'language', 'Russian', 0, '2022-09-03 12:34:56'),
(11, 'language', 'Spanish', 0, '2022-09-03 12:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `olocation`
--

DROP TABLE IF EXISTS `olocation`;
CREATE TABLE `olocation` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'location',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `olocation`
--

INSERT INTO `olocation` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(1, 'location', 'Australia', 0, '2022-06-25 12:06:00'),
(2, 'location', 'Cambodia', 0, '2022-06-25 12:06:00'),
(3, 'location', 'China', 0, '2022-06-25 12:06:00'),
(4, 'location', 'Guam', 0, '2022-06-25 12:06:00'),
(5, 'location', 'Hong Kong SAR', 0, '2022-06-25 12:06:00'),
(6, 'location', 'Indonesia', 0, '2022-06-25 12:06:00'),
(7, 'location', 'Japan', 0, '2022-06-25 12:06:00'),
(8, 'location', 'Macau SAR', 0, '2022-06-25 12:06:00'),
(9, 'location', 'Malaysia', 0, '2022-06-25 12:06:00'),
(10, 'location', 'New Zealand', 0, '2022-06-25 12:06:00'),
(11, 'location', 'Philippines', 0, '2022-06-25 12:06:00'),
(12, 'location', 'Saipan', 0, '2022-06-25 12:06:00'),
(13, 'location', 'Singapore', 0, '2022-06-25 12:06:00'),
(14, 'location', 'South Korea', 0, '2022-06-25 12:06:00'),
(15, 'location', 'Taiwan', 0, '2022-06-25 12:06:00'),
(16, 'location', 'Thailand', 0, '2022-06-25 12:06:00'),
(17, 'location', 'Vietnam', 0, '2022-06-25 12:06:00'),
(18, 'location', 'Test Loc', 0, '2022-09-05 10:43:47'),
(19, 'location', 'Antigua and Barbuda', 0, '2022-09-19 05:01:05'),
(20, 'location', 'Austria', 0, '2022-09-19 05:01:05'),
(21, 'location', 'Andorra', 0, '2022-09-19 05:01:05'),
(22, 'location', 'Argentina', 0, '2022-09-19 05:01:05'),
(23, 'location', 'Algeria', 0, '2022-09-19 05:01:05'),
(24, 'location', 'Afghanistan', 0, '2022-09-19 05:01:05'),
(26, 'location', 'Armenia', 0, '2022-09-19 05:01:05'),
(27, 'location', 'Albania', 0, '2022-09-19 05:01:05'),
(28, 'location', 'Azerbaijan', 0, '2022-09-19 05:01:05'),
(29, 'location', 'Belarus', 0, '2022-09-19 05:02:47'),
(30, 'location', 'Bhutan', 0, '2022-09-19 05:02:47'),
(31, 'location', 'Bulgaria', 0, '2022-09-19 05:02:47'),
(32, 'location', 'Brunei', 0, '2022-09-19 05:02:47'),
(33, 'location', 'Belize', 0, '2022-09-19 05:02:47'),
(34, 'location', 'Bahamas', 0, '2022-09-19 05:02:47'),
(35, 'location', 'Bosnia and Herzegovina', 0, '2022-09-19 05:02:47'),
(36, 'location', 'Barbados', 0, '2022-09-19 05:02:47'),
(37, 'location', 'Botswana', 0, '2022-09-19 05:02:47'),
(38, 'location', 'Brazil', 0, '2022-09-19 05:02:47'),
(39, 'location', 'Burkina Faso', 0, '2022-09-19 05:02:47'),
(40, 'location', 'Bahrain', 0, '2022-09-19 05:02:47'),
(41, 'location', 'Bangladesh', 0, '2022-09-19 05:02:47'),
(42, 'location', 'Benin', 0, '2022-09-19 05:02:47'),
(43, 'location', 'Burundi', 0, '2022-09-19 05:02:47'),
(44, 'location', 'Bolivia', 0, '2022-09-19 05:02:47'),
(45, 'location', 'Belgium', 0, '2022-09-19 05:02:47'),
(46, 'location', 'Comoros', 0, '2022-09-19 05:04:50'),
(47, 'location', 'Cabo Verde', 0, '2022-09-19 05:04:50'),
(49, 'location', 'Costa Rica', 0, '2022-09-19 05:04:50'),
(50, 'location', 'Colombia', 0, '2022-09-19 05:04:50'),
(51, 'location', 'Central African Republic', 0, '2022-09-19 05:04:50'),
(52, 'location', 'Croatia', 0, '2022-09-19 05:04:50'),
(53, 'location', 'Canada', 0, '2022-09-19 05:04:50'),
(54, 'location', 'Cameroon', 0, '2022-09-19 05:04:50'),
(55, 'location', 'Côte d\'Ivoire', 0, '2022-09-19 05:04:50'),
(56, 'location', 'Chile', 0, '2022-09-19 05:04:50'),
(57, 'location', 'Chad', 0, '2022-09-19 05:04:50'),
(58, 'location', 'Cyprus', 0, '2022-09-19 05:04:50'),
(59, 'location', 'Cuba', 0, '2022-09-19 05:04:50'),
(60, 'location', 'Czech Republic', 0, '2022-09-19 05:04:50'),
(61, 'location', 'Djibouti', 0, '2022-09-19 05:08:42'),
(62, 'location', 'Republic of Congo (Brazzaville)', 0, '2022-09-19 05:08:42'),
(63, 'location', 'Democratic Republic of the Congo (Kinshasa)', 0, '2022-09-19 05:08:42'),
(64, 'location', 'Dominica', 0, '2022-09-19 05:08:42'),
(65, 'location', 'Denmark', 0, '2022-09-19 05:08:42'),
(66, 'location', 'Dominican Republic', 0, '2022-09-19 05:08:42'),
(67, 'location', 'El Salvador', 0, '2022-09-19 05:09:23'),
(68, 'location', 'Eritrea', 0, '2022-09-19 05:09:23'),
(69, 'location', 'Ecuador', 0, '2022-09-19 05:09:23'),
(70, 'location', 'Equatorial Guinea', 0, '2022-09-19 05:09:23'),
(71, 'location', 'Estonia', 0, '2022-09-19 05:09:23'),
(72, 'location', 'Eswatini', 0, '2022-09-19 05:09:23'),
(73, 'location', 'Ethiopia', 0, '2022-09-19 05:09:23'),
(74, 'location', 'Egypt', 0, '2022-09-19 05:09:23'),
(75, 'location', 'Fiji', 0, '2022-09-19 05:09:44'),
(76, 'location', 'France', 0, '2022-09-19 05:09:44'),
(77, 'location', 'Finland', 0, '2022-09-19 05:09:44'),
(78, 'location', 'Germany', 0, '2022-09-19 05:11:03'),
(79, 'location', 'Guyana', 0, '2022-09-19 05:11:03'),
(80, 'location', 'Georgia', 0, '2022-09-19 05:11:03'),
(81, 'location', 'Ghana', 0, '2022-09-19 05:11:03'),
(82, 'location', 'Gambia', 0, '2022-09-19 05:11:03'),
(83, 'location', 'Gabon', 0, '2022-09-19 05:11:03'),
(84, 'location', 'Guinea-Bissau', 0, '2022-09-19 05:11:03'),
(85, 'location', 'Guatemala', 0, '2022-09-19 05:11:03'),
(86, 'location', 'Guinea', 0, '2022-09-19 05:11:03'),
(87, 'location', 'Grenada', 0, '2022-09-19 05:11:03'),
(88, 'location', 'Greece', 0, '2022-09-19 05:11:03'),
(89, 'location', 'Honduras', 0, '2022-09-19 05:12:17'),
(90, 'location', 'Hungary', 0, '2022-09-19 05:12:17'),
(91, 'location', 'Holy See', 0, '2022-09-19 05:12:17'),
(92, 'location', 'Haiti', 0, '2022-09-19 05:12:17'),
(93, 'location', 'Israel', 0, '2022-09-19 05:13:00'),
(94, 'location', 'Iran', 0, '2022-09-19 05:13:00'),
(95, 'location', 'Italy', 0, '2022-09-19 05:13:00'),
(96, 'location', 'Ireland', 0, '2022-09-19 05:13:00'),
(97, 'location', 'Iraq', 0, '2022-09-19 05:13:00'),
(98, 'location', 'Iceland', 0, '2022-09-19 05:13:00'),
(99, 'location', 'India', 0, '2022-09-19 05:13:00'),
(100, 'location', 'Jamaica', 0, '2022-09-19 05:13:17'),
(101, 'location', 'Jordan', 0, '2022-09-19 05:13:17'),
(102, 'location', 'Kyrgyzstan', 0, '2022-09-19 05:13:41'),
(103, 'location', 'Kenya', 0, '2022-09-19 05:13:41'),
(104, 'location', 'Kuwait', 0, '2022-09-19 05:13:41'),
(105, 'location', 'Kazakhstan', 0, '2022-09-19 05:13:41'),
(106, 'location', 'Kiribati', 0, '2022-09-19 05:13:41'),
(107, 'location', 'Laos', 0, '2022-09-19 05:14:09'),
(108, 'location', 'Libya', 0, '2022-09-19 05:14:09'),
(109, 'location', 'Lebanon', 0, '2022-09-19 05:14:09'),
(110, 'location', 'Luxembourg', 0, '2022-09-19 05:14:09'),
(111, 'location', 'Liberia', 0, '2022-09-19 05:14:09'),
(112, 'location', 'Liechtenstein', 0, '2022-09-19 05:14:09'),
(113, 'location', 'Lithuania', 0, '2022-09-19 05:14:09'),
(114, 'location', 'Lesotho', 0, '2022-09-19 05:14:09'),
(115, 'location', 'Latvia', 0, '2022-09-19 05:14:09'),
(116, 'location', 'Montenegro', 0, '2022-09-19 05:15:13'),
(117, 'location', 'Marshall Islands', 0, '2022-09-19 05:15:13'),
(118, 'location', 'Micronesia', 0, '2022-09-19 05:15:13'),
(119, 'location', 'Myanmar', 0, '2022-09-19 05:15:13'),
(120, 'location', 'Maldives', 0, '2022-09-19 05:15:13'),
(121, 'location', 'Mauritania', 0, '2022-09-19 05:15:13'),
(122, 'location', 'Malta', 0, '2022-09-19 05:15:13'),
(123, 'location', 'Moldova', 0, '2022-09-19 05:15:13'),
(124, 'location', 'Monaco', 0, '2022-09-19 05:15:13'),
(125, 'location', 'Morocco', 0, '2022-09-19 05:15:13'),
(126, 'location', 'Mongolia', 0, '2022-09-19 05:15:13'),
(127, 'location', 'Mozambique', 0, '2022-09-19 05:15:13'),
(128, 'location', 'Madagascar', 0, '2022-09-19 05:15:13'),
(129, 'location', 'Mali', 0, '2022-09-19 05:15:13'),
(130, 'location', 'Malawi', 0, '2022-09-19 05:15:13'),
(131, 'location', 'Mexico', 0, '2022-09-19 05:15:13'),
(132, 'location', 'Mauritius', 0, '2022-09-19 05:15:13'),
(133, 'location', 'Nicaragua', 0, '2022-09-19 05:16:15'),
(134, 'location', 'Norway', 0, '2022-09-19 05:16:15'),
(135, 'location', 'Nepal', 0, '2022-09-19 05:16:15'),
(137, 'location', 'Namibia', 0, '2022-09-19 05:16:15'),
(138, 'location', 'Niger', 0, '2022-09-19 05:16:15'),
(139, 'location', 'North Macedonia', 0, '2022-09-19 05:16:15'),
(140, 'location', 'Nigeria', 0, '2022-09-19 05:16:15'),
(141, 'location', 'Netherlands', 0, '2022-09-19 05:16:15'),
(142, 'location', 'Nauru', 0, '2022-09-19 05:16:15'),
(143, 'location', 'Oman', 0, '2022-09-19 05:16:25'),
(144, 'location', 'Papua New Guinea', 0, '2022-09-19 05:16:50'),
(145, 'location', 'Paraguay', 0, '2022-09-19 05:16:50'),
(146, 'location', 'Palestine State', 0, '2022-09-19 05:16:50'),
(147, 'location', 'Panama', 0, '2022-09-19 05:16:50'),
(148, 'location', 'Poland', 0, '2022-09-19 05:16:50'),
(149, 'location', 'Peru', 0, '2022-09-19 05:16:50'),
(150, 'location', 'Pakistan', 0, '2022-09-19 05:16:50'),
(151, 'location', 'Palau', 0, '2022-09-19 05:16:50'),
(152, 'location', 'Portugal', 0, '2022-09-19 05:16:50'),
(153, 'location', 'Qatar', 0, '2022-09-19 05:17:17'),
(154, 'location', 'Romania', 0, '2022-09-19 05:17:17'),
(155, 'location', 'Russia', 0, '2022-09-19 05:17:17'),
(156, 'location', 'Rwanda', 0, '2022-09-19 05:17:17'),
(157, 'location', 'Seychelles', 0, '2022-09-19 05:19:07'),
(158, 'location', 'Serbia', 0, '2022-09-19 05:19:07'),
(159, 'location', 'Switzerland', 0, '2022-09-19 05:19:07'),
(160, 'location', 'Sierra Leone', 0, '2022-09-19 05:19:07'),
(161, 'location', 'Solomon Islands', 0, '2022-09-19 05:19:07'),
(162, 'location', 'South Africa', 0, '2022-09-19 05:19:07'),
(163, 'location', 'Suriname', 0, '2022-09-19 05:19:07'),
(164, 'location', 'Slovakia', 0, '2022-09-19 05:19:07'),
(165, 'location', 'Saint Kitts and Nevis', 0, '2022-09-19 05:19:07'),
(166, 'location', 'Spain', 0, '2022-09-19 05:19:07'),
(167, 'location', 'Sudan', 0, '2022-09-19 05:19:07'),
(168, 'location', 'Saudi Arabia', 0, '2022-09-19 05:19:07'),
(169, 'location', 'San Marino', 0, '2022-09-19 05:19:07'),
(170, 'location', 'Sao Tome and Principe', 0, '2022-09-19 05:19:07'),
(171, 'location', 'Sri Lanka', 0, '2022-09-19 05:19:07'),
(172, 'location', 'Slovenia', 0, '2022-09-19 05:19:07'),
(173, 'location', 'Samoa', 0, '2022-09-19 05:19:07'),
(174, 'location', 'Saint Lucia', 0, '2022-09-19 05:19:07'),
(175, 'location', 'Syria', 0, '2022-09-19 05:19:07'),
(176, 'location', 'Senegal', 0, '2022-09-19 05:19:07'),
(177, 'location', 'Somalia', 0, '2022-09-19 05:19:07'),
(178, 'location', 'South Sudan', 0, '2022-09-19 05:19:07'),
(179, 'location', 'Saint Vincent and the Grenadines', 0, '2022-09-19 05:19:07'),
(180, 'location', 'Sweden', 0, '2022-09-19 05:19:07'),
(181, 'location', 'Scotland', 0, '2022-09-19 05:19:07'),
(182, 'location', 'Tajikistan', 0, '2022-09-19 05:20:11'),
(183, 'location', 'Turkey', 0, '2022-09-19 05:20:11'),
(184, 'location', 'Togo', 0, '2022-09-19 05:20:11'),
(185, 'location', 'Turkmenistan', 0, '2022-09-19 05:20:11'),
(186, 'location', 'Tanzania', 0, '2022-09-19 05:20:11'),
(187, 'location', 'Trinidad and Tobago', 0, '2022-09-19 05:20:11'),
(188, 'location', 'Timor-Leste', 0, '2022-09-19 05:20:11'),
(189, 'location', 'Tunisia', 0, '2022-09-19 05:20:11'),
(190, 'location', 'Tuvalu', 0, '2022-09-19 05:20:11'),
(191, 'location', 'Tonga', 0, '2022-09-19 05:20:11'),
(192, 'location', 'United Arab Emirates', 0, '2022-09-19 05:20:11'),
(193, 'location', 'United Kingdom', 0, '2022-09-19 05:20:11'),
(194, 'location', 'Uganda', 0, '2022-09-19 05:20:11'),
(195, 'location', 'Ukraine', 0, '2022-09-19 05:20:11'),
(196, 'location', 'Uruguay', 0, '2022-09-19 05:20:11'),
(197, 'location', 'Uzbekistan', 0, '2022-09-19 05:20:11'),
(198, 'location', 'United States of America', 0, '2022-09-19 05:20:11'),
(199, 'location', 'Vanuatu', 0, '2022-09-19 05:20:23'),
(200, 'location', 'Venezuela', 0, '2022-09-19 05:20:23'),
(201, 'location', 'Wales', 0, '2022-09-19 05:20:30'),
(202, 'location', 'Yemen', 0, '2022-09-19 05:20:45'),
(203, 'location', 'Zambia', 0, '2022-09-19 05:20:45'),
(204, 'location', 'Zimbabwe', 0, '2022-09-19 05:20:45'),
(205, 'location', 'Angola', 0, '2022-09-19 05:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `operks_and_benefits`
--

DROP TABLE IF EXISTS `operks_and_benefits`;
CREATE TABLE `operks_and_benefits` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'perks_and_benefits',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `operks_and_benefits`
--

INSERT INTO `operks_and_benefits` (`id`, `type`, `name`, `inactive`, `date_created`, `created_by`) VALUES
(4, 'perks_and_benefits', 'Vacation Leave', 0, '2022-07-14 13:01:23', 3),
(5, 'perks_and_benefits', 'Sick Leave', 0, '2022-07-14 13:01:23', 3),
(6, 'perks_and_benefits', 'Maternity Leave', 0, '2022-07-14 13:01:23', 3),
(7, 'perks_and_benefits', 'Paternity Leave', 0, '2022-07-14 13:01:23', 3),
(8, 'perks_and_benefits', 'HMO', 0, '2022-07-14 13:01:23', 3),
(9, 'perks_and_benefits', 'Paid Time Off', 0, '2022-07-14 13:01:23', 3),
(10, 'perks_and_benefits', 'Family Medical Leave', 0, '2022-07-14 13:01:23', 3),
(11, 'perks_and_benefits', 'Bereavement Leave', 0, '2022-07-14 13:01:23', 3),
(12, 'perks_and_benefits', 'Company bonus scheme', 0, '2022-07-14 13:01:23', 3),
(13, 'perks_and_benefits', 'Dental Benefits', 0, '2022-07-14 13:01:23', 3),
(14, 'perks_and_benefits', 'Vision Benefits', 0, '2022-07-14 13:01:23', 3),
(15, 'perks_and_benefits', 'Health Insurance Benefits', 0, '2022-07-14 13:01:23', 3),
(16, 'perks_and_benefits', 'Life Insurance', 0, '2022-07-14 13:01:23', 3),
(17, 'perks_and_benefits', 'Disability Insurance', 0, '2022-07-14 13:01:23', 3),
(18, 'perks_and_benefits', 'Employee Meals', 0, '2022-07-14 13:01:23', 3),
(19, 'perks_and_benefits', 'Uniforms provided', 0, '2022-07-14 13:01:23', 3),
(20, 'perks_and_benefits', 'Company Discounts', 0, '2022-07-14 13:01:23', 3),
(21, 'perks_and_benefits', 'Housing allowance', 0, '2022-07-14 13:01:23', 3),
(22, 'perks_and_benefits', 'Housing provided', 0, '2022-07-14 13:01:23', 3),
(23, 'perks_and_benefits', 'Transport allowance', 0, '2022-07-14 13:01:23', 3),
(24, 'perks_and_benefits', 'Relocation reimbursement', 0, '2022-07-14 13:01:23', 3),
(25, 'perks_and_benefits', 'Internship allowance', 0, '2022-07-14 13:01:23', 3),
(26, 'perks_and_benefits', 'Executive benefits', 0, '2022-07-14 13:01:23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `operks_and_benefits_removed`
--

DROP TABLE IF EXISTS `operks_and_benefits_removed`;
CREATE TABLE `operks_and_benefits_removed` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opermission`
--

DROP TABLE IF EXISTS `opermission`;
CREATE TABLE `opermission` (
  `user_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `record_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Dumping data for table `opermission`
--

INSERT INTO `opermission` (`user_type`, `record_type`, `permission`) VALUES
('admin', 'employer', '[\"view\",\"edit\",\"add\"]'),
('employer', 'employer', '[\"view\",\"edit\",\"add\"]'),
('admin', 'user', '[\"view\",\"edit\",\"add\"]'),
('admin', 'homepage_banner', '[\"view\",\"edit\",\"add\"]'),
('employer', 'job_type', '[\"view\",\"edit\",\"add\"]'),
('employer', 'job_post', '[\"view\",\"edit\",\"add\",\"copy\"]'),
('applicant', 'applicant_info', '[\"view\",\"edit\",\"add\"]'),
('employer', 'applicant_info', '[\"view\",\"add\"]'),
('employer', 'active_jobs', '[\"view\",\"edit\",\"add\"]'),
('employer', 'active_jobs_applicant', '[\"view\",\"edit\",\"add\"]'),
('employer', 'applicant_search', '[\"view\",\"edit\",\"add\"]'),
('employer', 'schedule', '[\"view\",\"edit\",\"add\"]');

-- --------------------------------------------------------

--
-- Table structure for table `oprofile`
--

DROP TABLE IF EXISTS `oprofile`;
CREATE TABLE `oprofile` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile',
  `doc_image` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `honorifics` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `middle_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_add` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dial_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `location` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_login` tinyint(1) NOT NULL DEFAULT '1',
  `highlights` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `internship` tinyint(1) NOT NULL,
  `resume` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `osignup`
--

DROP TABLE IF EXISTS `osignup`;
CREATE TABLE `osignup` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'signup',
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `honorifics` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `work_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dial_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `location` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `industry` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `osignup`
--

INSERT INTO `osignup` (`id`, `type`, `username`, `password`, `honorifics`, `user_type`, `first_name`, `last_name`, `work_email`, `dial_code`, `contact_number`, `company_name`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `designation`, `industry`, `status`, `date_created`) VALUES
(302, 'signup', 'phoenixlangaman087@gmail.com', 'Admin1234', 'Mr.', 'company', 'Phoenix', 'Langaman', 'phoenixlangaman05@gmail.com', '+63', '9171551303', 'IT Group Inc', 'Philippines', '14.6404977', '121.0309626', 'Quezon City', 'Metro Manila', 'Philippines', 'Software Developer', 21, 2, '2022-07-11 14:13:50'),
(303, 'signup', 'gymmasangkaysilos@gmail.com', 'Admin1234', 'Ms.', 'company', 'Gym Lyssa', 'Langaman', 'gymmasangkaysilos@gmail.com', '+63', '9217697036', 'PRBFI', 'Philippines', '13.9307450', '121.4600570', 'Candelaria', 'Quezon Province', 'Philippines', 'Accounting Staff', 15, 2, '2022-07-14 05:25:49'),
(304, 'signup', 'partner1@gmail.com', 'Partner1234', 'Mr.', 'company', 'Angel', 'Locsin', 'partner1@gmail.com', '+63', '9171551304', 'ABS-CBN', 'Philippines', '14.6346633', '121.0431994', 'Quezon City', 'Metro Manila', 'Philippines', 'Artist', 23, 3, '2022-07-14 07:53:53'),
(305, 'signup', 'partner2@gmail.com', 'Partner21234', 'Ms.', 'company', 'Ciara Pauline', 'Silos', 'partner2@gmail.com', '+63', '9171551303', 'PCL Corporation', 'Philippines', '14.9260337', '120.2155296', 'Castillejos', 'Central Luzon', 'Philippines', 'Staff', 15, 2, '2022-07-14 08:01:45'),
(308, 'signup', 'optimusprime@gmail.com', 'Admin1234', 'Mr.', 'company', 'Optimus', 'Prime', 'optimusprime@gmail.com', '+509', '9171551303', 'Autobots', 'Philippines', '14.4670530', '120.9702801', 'Las Piñas', 'Metro Manila', 'Philippines', 'Team Lead', 21, 2, '2022-07-17 05:59:19'),
(309, 'signup', 'rsabate@thirtyonedigital.net', 'Rejogusa19963010', 'Mr.', 'company', 'Red', 'Test', 'rendolfsabate21@gmail.com', '+93', '9662569220', 'Caltex', 'Philippines', '16.4804228', '121.1481284', 'Bayombong', 'Cagayan Valley', 'Philippines', 'Manager', 19, 2, '2022-08-05 06:23:27'),
(310, 'signup', 'ecarcer.31d@gmail.com', 'H0t3l33rsTesting', 'Mr.', 'company', 'Elmer31D', 'Testing', 'ecarcer.31d@gmail.com', '+63', '9388751022', 'Rides On Wheels', 'Philippines', '14.6037446', '121.3084088', '', 'Calabarzon', 'Philippines', 'QA', 12, 2, '2022-08-05 06:23:29'),
(311, 'signup', 'rendolfsabate21+9@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Pink', 'TestAcc', 'rendolfsabate21+9@gmail.com', '+63', '9662569224', 'Shangrila ', 'Philippines', '14.5377516', '121.0013794', 'Pasay', 'Metro Manila', 'Philippines', 'HR', 26, 2, '2022-08-09 06:27:51'),
(312, 'signup', 'employer1@gmail.com', 'Admin1234', 'Ms.', 'company', 'April', 'Totanes', 'joycetotanes414@gmail.com', '+63', '9953545746', 'Thirtyone Digital', 'Philippines', '14.6254827', '121.1244847', 'Antipolo', 'Calabarzon', 'Philippines', 'Project Management Dept', 21, 2, '2022-08-12 09:16:31'),
(313, 'signup', 'jbaquial@thirtyonedigital.com', 'Hoteleers2022', 'Mr.', 'company', 'Jorel', 'Baquial', 'jbaquial@thirtyonedigital.com', '+63', '9175087289', 'Kampani', 'Philippines', '14.6079394', '121.0803394', 'Quezon City', 'Metro Manila', 'Philippines', 'CEO', 11, 1, '2022-08-12 10:15:12'),
(314, 'signup', 'rendolfsabate21+10@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Alex', 'Jay', 'rendolfsabate21+10@gmail.com', '+93', '9662569224', 'Mcdonalds', 'Philippines', '14.6106495', '121.0793173', 'Quezon City', 'Metro Manila', 'Philippines', 'Manager', 15, 2, '2022-08-15 05:31:39'),
(315, 'signup', 'rendolfsabate21+13@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Pink', 'Test', 'rendolfsabate21+13@gmail.com', '+93', '9662569224', 'Summit', 'Philippines', '14.8967937', '120.2366297', 'Subic', 'Central Luzon', 'Philippines', 'CEO', 16, 3, '2022-08-16 05:41:40'),
(316, 'signup', 'rendolfsabate21+14@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Jorrel', 'Ttest', 'rendolfsabate21+14@gmail.com', '+93', '9662569924', '31D', 'Philippines', '14.5995124', '120.9842195', 'Manila', 'Metro Manila', 'Philippines', 'HR', 14, 2, '2022-08-18 03:10:58'),
(317, 'signup', 'mjaba.test+5@gmail.com', 'MJtest1234', 'Ms.', 'company', 'Mary Joy Anne', 'Annang', 'mjaba.test+5@gmail.com', '+63', '9982764970', 'Compass Co.', 'Philippines', '14.5948610', '120.9823312', 'Manila', 'Metro Manila', 'Philippines', 'n/a', 11, 1, '2022-08-22 09:17:04'),
(318, 'signup', 'mjaba.test+6@gmail.com', 'MJtest1234', 'Ms.', 'company', 'MJ', 'Annang', 'mjaba.test+6@gmail.com', '+63', '9982736470', 'MoJa Inc.', 'Philippines', '14.5900434', '120.9710874', 'Manila', 'Metro Manila', 'Philippines', 'n/a', 16, 1, '2022-08-22 09:19:11'),
(319, 'signup', 'mjaba.test+7@gmail.com', 'MJtest1234', 'Ms.', 'company', 'Ligaya', 'Annang', 'mjaba.test+7@gmail.com', '+63', '9178665754', 'Ligaya Co.', 'Philippines', '14.6152931', '121.0006132', 'Manila', 'Metro Manila', 'Philippines', 'n/a', 19, 1, '2022-08-22 09:21:15'),
(320, 'signup', 'mjaba.test+8@gmail.com', 'MJtest1234', 'Ms.', 'company', 'Joy', 'Annang', 'mjaba.test+8@gmail.com', '+63', '9865547865', 'EngiNears Co.', 'Philippines', '14.6096454', '120.9934034', 'Manila', 'Metro Manila', 'Philippines', 'n/a', 21, 1, '2022-08-22 09:23:50'),
(321, 'signup', 'mjaba.test+9@gmail.com', 'MJtest1234', 'Ms.', 'company', 'Anne', 'Annang', 'mjaba.test+9@gmail.com', '+63', '9657432908', 'Anne Dito Co.', 'Philippines', '14.5842290', '120.9834470', 'Pasay', 'Metro Manila', 'Philippines', 'n/a', 13, 2, '2022-08-22 09:25:30'),
(322, 'signup', 'jamesharoldf.09+ojtcmpny0@gmail.com', 'Awit123456', 'Mr.', 'company', 'James Harold', 'Francisco', 'jamesharoldf.09+ojtcmpny0@gmail.com', '+63', '9950488171', 'ISCP Biringan Campus', 'Philippines', '12.0972477', '124.8403408', 'Gandara', 'Eastern Visayas', 'Philippines', 'Trainer', 13, 2, '2022-08-22 10:12:19'),
(323, 'signup', 'jamesharoldf.09+ojtcmpny1@gmail.com', 'Awit123456', 'Mr.', 'company', 'James Harold', 'Abueva', 'jamesharoldf.09+ojtcmpny1@gmail.com', '+63', '9123456789', 'Atlanta Industries Inc.', 'Philippines', '14.6018872', '121.0936983', 'Pasig', 'Metro Manila', 'Philippines', 'Web Developer', 21, 2, '2022-08-22 10:19:16'),
(324, 'signup', 'jamesharoldf.09+ojtcmpny2@gmail.com', 'Awit123456', 'Mr.', 'company', 'James', 'Francisco', 'jamesharoldf.09+ojtcmpny2@gmail.com', '+31', '9123456789', 'Lorem Ipsum Incorporated', 'Philippines', '14.5496292', '120.9982906', 'Pasay', 'Metro Manila', 'Philippines', 'Placeholder Person', 23, 2, '2022-08-22 10:53:00'),
(325, 'signup', 'nicoleathenabelen+company1@gmail.com', 'User1234', 'Ms.', 'company', 'Nicole Athena', 'Belen', 'nicoleathenabelen+company1@gmail.com', '+63', '9762683331', 'Meral Co.', 'Philippines', '14.6323670', '121.0189360', 'Quezon City', 'Metro Manila', 'Philippines', 'Customer Service', 17, 2, '2022-08-22 10:56:06'),
(326, 'signup', 'jamesharoldf.09+ojtcmpny3@gmail.com', 'Awit123456', 'Mr.', 'company', 'Harold', 'Francisco', 'jamesharoldf.09+ojtcmpny3@gmail.com', '+63', '9123456789', 'Kaltas Kuto Services', 'Philippines', '14.6254827', '121.1244847', 'Antipolo', 'Calabarzon', 'Philippines', 'Shampoorer', 20, 2, '2022-08-22 10:56:30'),
(327, 'signup', 'jamesharoldf.09+ojtcmpny4@gmail.com', 'Awit123456', 'Mr.', 'company', 'James', 'Abueva', 'jamesharoldf.09+ojtcmpny4@gmail.com', '+93', '9123456789', 'May the Foot Be With You Salon', 'Philippines', '14.6681873', '121.0338725', 'Quezon City', 'Metro Manila', 'Philippines', 'Bartender', 15, 2, '2022-08-22 11:01:26'),
(328, 'signup', 'nicoleathenabelen+company2@gmail.com', 'User1234', 'Ms.', 'company', 'Merilyn', 'Budang', 'nicoleathenabelen+company2@gmail.com', '+63', '9277053943', 'Coffee Co.', 'Philippines', '14.6451109', '121.0171384', 'Quezon City', 'Metro Manila', 'Philippines', 'Salesman', 18, 2, '2022-08-22 11:04:35'),
(329, 'signup', 'nicoleathenabelen+company3@gmail.com', 'User1234', 'Ms.', 'company', 'Stephany', 'Curry', 'nicoleathenabelen+company3@gmail.com', '+63', '9277053943', 'Shoebe Co.', 'Philippines', '14.6317696', '121.0978826', 'Marikina', 'Metro Manila', 'Philippines', 'Salesman', 18, 2, '2022-08-22 11:11:03'),
(330, 'signup', 'nicoleathenabelen+company4@gmail.com', 'User1234', 'Ms.', 'company', 'Jude', 'Daisim', 'nicoleathenabelen+company4@gmail.com', '+63', '9277053943', 'Kukuru Co.', 'Philippines', '14.2843023', '121.0888928', 'Santa Rosa', 'Calabarzon', 'Philippines', 'Vice President', 21, 2, '2022-08-22 11:15:11'),
(331, 'signup', 'nicoleathenabelen+company5@gmail.com', 'User1234', 'Ms.', 'company', 'Nicole Athena', 'Belen', 'nicoleathenabelen+company5@gmail.com', '+63', '9277053943', 'Hakusen Inc.', 'Philippines', '14.6451109', '121.0171384', 'Quezon City', 'Metro Manila', 'Philippines', 'President', 21, 2, '2022-08-22 11:18:00'),
(332, 'signup', 'christianpaje1601+company1@gmail.com', 'Admin1234', 'Mr.', 'company', 'Solace', 'Gray', 'christianpaje1601+company1@gmail.com', '+63', '9223334444', 'Semicolon Bookstore', 'Philippines', '14.6264300', '121.0105010', 'Quezon City', 'Metro Manila', 'Philippines', 'CEO', 18, 2, '2022-08-22 11:20:47'),
(333, 'signup', 'christianpaje1601+company2@gmail.com', 'Admin1234', 'Mr.', 'company', 'Thatcher', 'Raven', 'christianpaje1601+company2@gmail.com', '+63', '9223334444', 'Visionary Gamers', 'Philippines', '14.6001410', '120.9744620', 'Manila', 'Metro Manila', 'Philippines', 'CEO', 16, 2, '2022-08-22 11:20:55'),
(334, 'signup', 'christianpaje1601+company3@gmail.com', 'Admin1234', 'Ms.', 'company', 'Hailey', 'Cromwell', 'christianpaje1601+company3@gmail.com', '+63', '9223334444', 'Fashtastic ', 'Philippines', '14.5212386', '121.0160391', 'Pasay', 'Metro Manila', 'Philippines', 'CEO', 18, 2, '2022-08-22 11:21:01'),
(335, 'signup', 'christianpaje1601+company4@gmail.com', 'Admin1234', 'Ms.', 'company', 'Madison', 'West', 'christianpaje1601+company4@gmail.com', '+63', '9223334444', 'Enchantress', 'Philippines', '14.5943375', '120.9700469', 'Manila', 'Metro Manila', 'Philippines', 'CEO', 23, 2, '2022-08-22 11:21:08'),
(336, 'signup', 'christianpaje1601+company5@gmail.com', 'Admin1234', 'Mr.', 'company', 'Miguel', 'Del Pilar', 'christianpaje1601+company5@gmail.com', '+63', '9223334444', 'Air Genesis', 'Philippines', '14.7789375', '120.2909375', 'Subic Bay Freeport Zone', 'Central Luzon', 'Philippines', 'CEO', 11, 2, '2022-08-22 11:21:16'),
(337, 'signup', 'paulois.taduran+company1@gmail.com', 'Admin1234', 'Ms.', 'company', 'Analyn', 'Muko', 'paulois.taduran+company1@gmail.com', '+63', '9123123123', 'Analyn Mue Co.', 'China', '26.8603125', '113.0168125', 'Hengyang', 'Hunan', 'China', 'Receptionist', 19, 2, '2022-08-22 11:26:08'),
(338, 'signup', 'paulois.taduran+company2@gmail.com', 'Admin1234', 'Mr.', 'company', 'Rudolf', 'Derednus', 'paulois.taduran+company2@gmail.com', '+93', '9123123123', 'Reindeer Inc.', 'Philippines', '14.6096454', '120.9759111', 'Manila', 'Metro Manila', 'Philippines', 'Helper', 11, 2, '2022-08-22 12:05:07'),
(339, 'signup', 'paulois.taduran+company3@gmail.com', 'Admin1234', 'Ms.', 'company', 'Cookie', 'Monster', 'paulois.taduran+company3@gmail.com', '+63', '9123123123', 'Cookie Co.', 'Philippines', '14.6113659', '120.9730783', 'Maynila', 'Kalakhang Maynila', 'Philippines', 'Admin Staff', 18, 2, '2022-08-22 12:08:16'),
(340, 'signup', 'paulois.taduran+company4@gmail.com', 'Admin1234', 'Mr.', 'company', 'Dex', 'Manreza', 'paulois.taduran+company4@gmail.com', '+63', '9123123123', 'Thirty One Digital Media Solutions Inc.', 'Philippines', '14.6074600', '121.0805347', 'Quezon City', 'Metro Manila', 'Philippines', 'Quality Assurance', 21, 2, '2022-08-22 12:15:34'),
(341, 'signup', 'paulois.taduran+company5@gmail.com', 'Admin1234', 'Ms.', 'company', 'Sassa', 'Gurl', 'paulois.taduran+company5@gmail.com', '+63', '9123123123', 'Liptint Co.', 'Philippines', '14.6089591', '121.0078349', 'Manila', 'Metro Manila', 'Philippines', 'Cashier', 20, 2, '2022-08-22 12:19:08'),
(342, 'signup', 'mapa.alfonso01@gmail.com', 'Tsunayoshi23', 'Mr.', 'company', 'Gabriel Alfonso', 'Mapa', 'mapa.alfonso01@gmail.com', '+63', '9083170758', 'Hive Incorporated ', 'Philippines', '14.5976323', '121.0176092', 'Manila', 'Metro Manila', 'Philippines', 'President', 21, 2, '2022-08-22 16:41:28'),
(343, 'signup', 'paulinebalagtas5+employer1@gmail.com', 'plnAuie12345', 'Ms.', 'company', 'Pauline', 'Balagtas1', 'paulinebalagtas5+employer1@gmail.com', '+63', '9755279648', 'Accenture Philippines', 'Philippines', '14.5737673', '121.0481448', 'Mandaluyong', 'Metro Manila', 'Philippines', 'HR', 21, 2, '2022-08-23 06:34:53'),
(344, 'signup', 'paulinebalagtas5+employer2@gmail.com', 'plnAuie12345', 'Ms.', 'company', 'Pauline', 'Balagtas2', 'paulinebalagtas5+employer2@gmail.com', '+63', '9755279648', 'University of Sto. Tomas Hospital', 'Philippines', '14.6097970', '120.9895724', 'Manila', 'Metro Manila', 'Philippines', 'HR', 20, 3, '2022-08-23 06:37:16'),
(345, 'signup', 'mapa.alfonso01+1@gmail.com', 'Tsunayoshi23', 'Mr.', 'company', 'Andrei', 'Mallari', 'mapa.alfonso01+1@gmail.com', '+93', '9083170758', 'Cruise Paradise ', 'Philippines', '14.5877861', '120.9672749', 'Manila', 'Metro Manila', 'Philippines', 'President', 14, 2, '2022-08-23 06:37:38'),
(346, 'signup', 'paulinebalagtas5+employer3@gmail.com', 'plnAuie12345', 'Ms.', 'company', 'Pauline', 'Balagtas3', 'paulinebalagtas5+employer3@gmail.com', '+63', '9755279648', 'Laresio', 'Philippines', '14.1801360', '121.2040053', 'Los Baños', 'Calabarzon', 'Philippines', 'HR', 20, 2, '2022-08-23 06:39:19'),
(347, 'signup', 'paulinebalagtas5+employer4@gmail.com', 'plnAuie12345', 'Ms.', 'company', 'Pauline', 'Balagtas4', 'paulinebalagtas5+employer4@gmail.com', '+63', '9755279648', 'NAIA', 'Philippines', '14.5195456', '121.0137990', 'Pasay', 'Metro Manila', 'Philippines', 'HR', 11, 2, '2022-08-23 06:40:47'),
(348, 'signup', 'mapa.alfonso01+2@gmail.com', 'Tsunayoshi23', 'Ms.', 'company', 'Almira', 'Suarez', 'mapa.alfonso01+2@gmail.com', '+93', '9083170758', 'Spa Aesthetic', 'Philippines', '14.6637878', '121.0026877', 'Quezon City', 'Metro Manila', 'Philippines', 'President', 20, 2, '2022-08-23 06:41:54'),
(349, 'signup', 'paulinebalagtas5+employer5@gmail.com', 'plnAuie12345', 'Ms.', 'company', 'Pauline', 'Balagtas5', 'paulinebalagtas5+employer5@gmail.com', '+63', '9755279648', 'Landmark', 'Philippines', '14.5520135', '121.0235142', 'Makati', 'Metro Manila', 'Philippines', 'HR', 18, 3, '2022-08-23 06:42:50'),
(350, 'signup', 'mapa.alfonso01+3@gmail.com', 'Tsunayoshi23', 'Mr.', 'company', 'Noel', 'Sison', 'mapa.alfonso01+3@gmail.com', '+63', '9083170758', 'Noel Mapa International Airport', 'Philippines', '14.5122739', '121.0165080', 'Pasay', 'Metro Manila', 'Philippines', 'President', 11, 2, '2022-08-23 06:44:06'),
(351, 'signup', 'mapa.alfonso01+4@gmail.com', 'Tsunayoshi23', 'Ms.', 'company', 'Leilani', 'Mallari', 'mapa.alfonso01+4@gmail.com', '+63', '9083170758', 'Food Feast', 'Philippines', '14.6568346', '121.0304290', 'Quezon City', 'Metro Manila', 'Philippines', 'President', 15, 2, '2022-08-23 06:46:52'),
(352, 'signup', 'jamesharoldabuevafrancisco@gmail.com', 'TXyMHrubZn2xXxn', 'Ms.', 'company', 'Test', 'Cases', 'jamesharoldabuevafrancisco@gmail.com', '+63', '9123456789', 'Star City', 'Philippines', '14.5559882', '120.9855401', 'Pasay', 'Metro Manila', 'Philippines', 'Rides Operator', 24, 2, '2022-08-31 08:02:37'),
(353, 'signup', 'mapa.alfonso01+5@gmail.com', 'Sinatraa1', 'Mr.', 'company', 'Frank', 'Sinatraa', 'mapa.alfonso01+5@gmail.com', '+63', '9083170758', 'Broadway Studios', 'Hong Kong', '0.0000000', '0.0000000', '', '', 'Hong Kong', 'Owner', 23, 2, '2022-09-05 09:18:56'),
(354, 'signup', 'rsabate+1@thirtyonedigital.net', 'Rejogusa19963010', 'Mr.', 'company', 'Rendolf Joel', 'Sabate', 'rsabate+1@thirtyonedigital.net', '+63', '9662569224', 'Bamboo Inn', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'CEO', 11, 2, '2022-09-28 03:30:05'),
(355, 'signup', 'test_country@gmail.com', 'Admin1234', 'Mr.', 'company', 'Niel', 'Abenoja', 'test_country@gmail.com', '+66', '812345678', 'NA', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'Software Developer', 26, 2, '2022-10-05 13:53:42'),
(356, 'signup', 'test_thailand@gmail.com', 'Admin1234', 'Mr.', 'company', 'Kirk', 'Jimenez', 'test_thailand@gmail.com', '+66', '812345989', 'KJ', 'Thailand', '0.0000000', '0.0000000', '', '', 'Thailand', 'Software Developer', 26, 2, '2022-10-05 13:57:44'),
(357, 'signup', 'doniel@grandlapa.com', 'Newpassword123', 'Mr.', 'company', 'Donie', 'Llenado', 'doniel@grandlapa.com', '+853', '12345678', 'AGL ', 'Macau', '0.0000000', '0.0000000', '', '', 'Macau', 'ADORR', 26, 2, '2022-10-12 11:59:55'),
(358, 'signup', 'thereef@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Song', 'Totanes', 'thereef@gmail.com', '+63', '9662569224', 'The Reef', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'CEO', 26, 2, '2022-10-19 06:40:24'),
(359, 'signup', 'mangrove@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Joyce ', 'Tan', 'mangrove@gmail.com', '+63', '9662569224', 'Mangrove Hotel & Resort', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'CEO', 26, 2, '2022-10-19 07:03:33'),
(360, 'signup', 'sanctuary@gmail.com', 'Rejogusa19963010', 'Mr.', 'company', 'Elmer', 'Tan', 'sanctuary@gmail.com', '+93', '9662569224', 'Sanctuary Beach Resort', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'COO', 26, 2, '2022-10-19 07:17:37'),
(361, 'signup', 'ram_morales1998@yahoo.com', 'RamHoteleer2', 'Mr.', 'company', 'Ramil', 'Morales', 'ram_morales1998@yahoo.com', '+63', '9098881234', 'Belvedere Hotel', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'Human Resources', 26, 2, '2022-10-19 13:48:19'),
(362, 'signup', 'ceo@redhotel.com', 'Rejogusa19963010', 'Mr.', 'company', 'Enzo', 'Cruz', 'ceo@redhotel.com', '+63', '9662569224', 'Red Hotel', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'secretary', 14, 2, '2022-11-21 06:18:08'),
(363, 'signup', 'rendolfsabate+21@gemora.com.ph', 'Rejogusa19963010', 'Mr.', 'company', 'Jm', 'Sabate', 'rendolfsabate+21@gemora.com.ph', '+54', '9662569224', 'Gemora', 'Argentina', '0.0000000', '0.0000000', '', '', 'Argentina', 'Secretary', 12, 1, '2022-12-01 02:51:42'),
(364, 'signup', 'rendolfsabate+70@gemora.com.ph', 'Rejogusa19963010', 'Mr.', 'company', 'jm', 'sabate', 'rendolfsabate+70@gemora.com.ph', '+93', '082365304835', 'Belmont', 'Finland', '0.0000000', '0.0000000', '', '', 'Finland', 'HR', 26, 2, '2022-12-01 03:11:06'),
(365, 'signup', 'rendolfgurat@icloud.com', '', 'Mr.', 'company', 'Jm', 'Gurat', 'rendolfgurat@icloud.com', '+243', '9662569224', 'Apple', 'Andorra', '0.0000000', '0.0000000', '', '', 'Andorra', 'HR', 12, 2, '2022-12-19 02:40:10'),
(366, 'signup', 'rendolf@email.com', '', '', 'company', 'Joel', 'Gurat', 'rendolf@email.com', '+1684', '993493659346', 'Dunkin', 'Antigua and Barbuda', '0.0000000', '0.0000000', '', '', 'Antigua and Barbuda', 'HR', 11, 1, '2022-12-20 09:40:00'),
(367, 'signup', 'rendolfsabate@31d.ph', '', 'Mr.', 'company', 'Rendolf Joel', 'Tan', 'rendolfsabate@31d.ph', '+213', '9476783678', '24/7 Resort', 'Brazil', '0.0000000', '0.0000000', '', '', 'Brazil', 'HR', 26, 2, '2023-01-27 09:08:35'),
(368, 'signup', 'red@orangehotel.com', '', 'Ms.', 'company', 'Rendolf Joel', 'Sabate', 'red@orangehotel.com', '+375', '9662563735', 'Orange  Hotel', 'Austria', '0.0000000', '0.0000000', '', '', 'Austria', 'Secretary', 26, 2, '2023-02-02 08:36:12'),
(369, 'signup', 'gawagawaeamail@gmail.com', '', 'Ms.', 'company', 'Gawa', 'Gawa', 'gawagawaeamail@gmail.com', '+358', '9388751000', 'Gawagawa Inc.', 'Andorra', '0.0000000', '0.0000000', '', '', 'Andorra', 'Secretary', 26, 2, '2023-02-20 14:48:35'),
(370, 'signup', 'ecarcer@gmail.com', '', 'Mr.', 'company', 'Elmer', 'Carcer', 'ecarcer@gmail.com', '+358', '9388751022', 'Elmer Inc', 'Albania', '0.0000000', '0.0000000', '', '', 'Albania', 'Manager', 26, 2, '2023-02-21 08:33:45'),
(371, 'signup', 'elmer@gmail.com', '', 'Mr.', 'company', 'Elmer', 'Testing', 'elmer@gmail.com', '+93', '9388751022', 'Elmer Test', 'Antigua and Barbuda', '0.0000000', '0.0000000', '', '', 'Antigua and Barbuda', 'Manager', 26, 2, '2023-02-21 08:46:01'),
(372, 'signup', 'employer.test@gmail.com', '', 'Mr.', 'company', 'Employer', 'Test', 'employer.test@gmail.com', '+93', '9388751000', 'Test Company', 'Afghanistan', '0.0000000', '0.0000000', '', '', 'Afghanistan', 'Tester', 26, 2, '2023-02-27 09:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `ostatus`
--

DROP TABLE IF EXISTS `ostatus`;
CREATE TABLE `ostatus` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ostatus`
--

INSERT INTO `ostatus` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Declined'),
(4, 'Activated'),
(5, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `ousr`
--

DROP TABLE IF EXISTS `ousr`;
CREATE TABLE `ousr` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_add` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `employer` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_logged_in` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT '0',
  `logged_in` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ousr`
--

INSERT INTO `ousr` (`id`, `type`, `name`, `username`, `password`, `email_add`, `user_type`, `inactive`, `employer`, `date_created`, `last_logged_in`, `password_changed`, `logged_in`) VALUES
(3, 'user', 'Phoenix Langaman', 'phoenixlangaman05@gmail.com', 'P@ssw0rd1234', 'phoenixlangaman05@gmail.com', 'admin', 0, 0, '2022-07-13 16:24:58', '03/01/2023 04:03 PM', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ousr_archive`
--

DROP TABLE IF EXISTS `ousr_archive`;
CREATE TABLE `ousr_archive` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_add` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `employer` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_logged_in` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT '0',
  `logged_in` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oyear`
--

DROP TABLE IF EXISTS `oyear`;
CREATE TABLE `oyear` (
  `id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `from_range` int NOT NULL,
  `to_range` int NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `oyear`
--

INSERT INTO `oyear` (`id`, `name`, `year`, `from_range`, `to_range`, `inactive`, `date_created`) VALUES
(1, '0 - 2 years', 1, 0, 2, 0, '2022-08-28 07:27:59'),
(2, '3 - 5 years', 2, 3, 5, 0, '2022-08-28 07:27:59'),
(3, '6 - 9 years', 3, 6, 9, 0, '2022-08-28 07:28:13'),
(4, '10 years up', 4, 10, 0, 0, '2022-08-28 07:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `profile_affiliations`
--

DROP TABLE IF EXISTS `profile_affiliations`;
CREATE TABLE `profile_affiliations` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_affiliations',
  `line` int NOT NULL,
  `affiliation` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_awards_achievements`
--

DROP TABLE IF EXISTS `profile_awards_achievements`;
CREATE TABLE `profile_awards_achievements` (
  `id` int NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_awards_achievements',
  `line` int NOT NULL,
  `award_achievement` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_certifications_licenses`
--

DROP TABLE IF EXISTS `profile_certifications_licenses`;
CREATE TABLE `profile_certifications_licenses` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_certifications_licenses',
  `line` int NOT NULL,
  `certification` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_department`
--

DROP TABLE IF EXISTS `profile_department`;
CREATE TABLE `profile_department` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_department',
  `line` int NOT NULL,
  `department` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_education`
--

DROP TABLE IF EXISTS `profile_education`;
CREATE TABLE `profile_education` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_education',
  `line` int NOT NULL,
  `school` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `degree` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `education` int NOT NULL,
  `start_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_experience`
--

DROP TABLE IF EXISTS `profile_experience`;
CREATE TABLE `profile_experience` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_experience',
  `line` int NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `short_description` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_date` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_industry`
--

DROP TABLE IF EXISTS `profile_industry`;
CREATE TABLE `profile_industry` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_industry',
  `line` int NOT NULL,
  `industry` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_level`
--

DROP TABLE IF EXISTS `profile_job_level`;
CREATE TABLE `profile_job_level` (
  `id` int NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_job_level',
  `line` int NOT NULL,
  `job_level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_preference`
--

DROP TABLE IF EXISTS `profile_job_preference`;
CREATE TABLE `profile_job_preference` (
  `id` int NOT NULL,
  `line` int NOT NULL,
  `industry` int NOT NULL,
  `job_level` int NOT NULL,
  `job_type` int NOT NULL,
  `department` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_type`
--

DROP TABLE IF EXISTS `profile_job_type`;
CREATE TABLE `profile_job_type` (
  `id` int NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_job_type',
  `line` int NOT NULL,
  `job_type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_language`
--

DROP TABLE IF EXISTS `profile_language`;
CREATE TABLE `profile_language` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_language',
  `line` int NOT NULL,
  `language` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_projects`
--

DROP TABLE IF EXISTS `profile_projects`;
CREATE TABLE `profile_projects` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_projects',
  `line` int NOT NULL,
  `projects` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_seminars_trainings`
--

DROP TABLE IF EXISTS `profile_seminars_trainings`;
CREATE TABLE `profile_seminars_trainings` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_seminars_trainings',
  `line` int NOT NULL,
  `seminar_training` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_skills`
--

DROP TABLE IF EXISTS `profile_skills`;
CREATE TABLE `profile_skills` (
  `id` int NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'profile_skills',
  `line` int NOT NULL,
  `skills` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usr_job_invite`
--

DROP TABLE IF EXISTS `usr_job_invite`;
CREATE TABLE `usr_job_invite` (
  `id` int NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'usr_job_invite',
  `job_post` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usr_job_post_fav`
--

DROP TABLE IF EXISTS `usr_job_post_fav`;
CREATE TABLE `usr_job_post_fav` (
  `id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'usr_job_post_fav',
  `job_post` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_post_for_interview`
--
ALTER TABLE `job_post_for_interview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oaud`
--
ALTER TABLE `oaud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ocurrency`
--
ALTER TABLE `ocurrency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odepartment`
--
ALTER TABLE `odepartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oeducation`
--
ALTER TABLE `oeducation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oemail_template`
--
ALTER TABLE `oemail_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oemployer`
--
ALTER TABLE `oemployer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oemployer_position`
--
ALTER TABLE `oemployer_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ohomepage_banner`
--
ALTER TABLE `ohomepage_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oindustry`
--
ALTER TABLE `oindustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ojob_level`
--
ALTER TABLE `ojob_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ojob_post`
--
ALTER TABLE `ojob_post`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ojob_post` ADD FULLTEXT KEY `job_title` (`job_title`);

--
-- Indexes for table `ojob_type`
--
ALTER TABLE `ojob_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olanguage`
--
ALTER TABLE `olanguage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olocation`
--
ALTER TABLE `olocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operks_and_benefits`
--
ALTER TABLE `operks_and_benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `osignup`
--
ALTER TABLE `osignup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ostatus`
--
ALTER TABLE `ostatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ousr`
--
ALTER TABLE `ousr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ousr_archive`
--
ALTER TABLE `ousr_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oyear`
--
ALTER TABLE `oyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_experience`
--
ALTER TABLE `profile_experience` ADD FULLTEXT KEY `designation` (`designation`);
ALTER TABLE `profile_experience` ADD FULLTEXT KEY `designation_2` (`designation`);

--
-- Indexes for table `profile_skills`
--
ALTER TABLE `profile_skills` ADD FULLTEXT KEY `skills` (`skills`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_post_for_interview`
--
ALTER TABLE `job_post_for_interview`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `oaud`
--
ALTER TABLE `oaud`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8981;

--
-- AUTO_INCREMENT for table `ocurrency`
--
ALTER TABLE `ocurrency`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `odepartment`
--
ALTER TABLE `odepartment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `oeducation`
--
ALTER TABLE `oeducation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT for table `oemail_template`
--
ALTER TABLE `oemail_template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oemployer`
--
ALTER TABLE `oemployer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `oemployer_position`
--
ALTER TABLE `oemployer_position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ohomepage_banner`
--
ALTER TABLE `ohomepage_banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `oindustry`
--
ALTER TABLE `oindustry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ojob_level`
--
ALTER TABLE `ojob_level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ojob_post`
--
ALTER TABLE `ojob_post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `ojob_type`
--
ALTER TABLE `ojob_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `olanguage`
--
ALTER TABLE `olanguage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `olocation`
--
ALTER TABLE `olocation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `operks_and_benefits`
--
ALTER TABLE `operks_and_benefits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `osignup`
--
ALTER TABLE `osignup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `ostatus`
--
ALTER TABLE `ostatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ousr`
--
ALTER TABLE `ousr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `oyear`
--
ALTER TABLE `oyear`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
