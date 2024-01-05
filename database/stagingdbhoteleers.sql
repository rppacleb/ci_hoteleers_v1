-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 08:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
CREATE DATABASE IF NOT EXISTS `stagingdbhoteleers` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `stagingdbhoteleers`;

-- --------------------------------------------------------

--
-- Table structure for table `employer_image`
--

DROP TABLE IF EXISTS `employer_image`;
CREATE TABLE `employer_image` (
  `id` int(11) NOT NULL,
  `line` int(11) NOT NULL,
  `doc_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(21, 6, '1662953992_subic-waterfront-resort.jpeg', '0.067'),
(88, 1, '1677841110_key_rooms_guests_1.jpg', '0.076'),
(88, 2, '1677841194_key_rooms_suite_1.jpg', '0.099'),
(88, 3, '1677841282_key_rooms_residence_1.jpg', '0.143'),
(88, 4, '1677841305_key_meetings_events_31.jpg', '0.161'),
(88, 5, '1677841312_key_dining_jasmine_2.jpg', '0.165'),
(88, 6, '1677841323_key_dining_cafe_1.jpg', '0.162'),
(88, 7, '1677841330_Cafe-1228-Seafood-Buffet_282x190.jpg', '0.057'),
(88, 8, '1677841373_Superior-Room-960-x-375-px.jpg', '0.123'),
(89, 2, '1677842631_1243024330.jpg', '0.091'),
(89, 3, '1677842635_2240832483.jpg', '0.072'),
(89, 4, '1677842640_2242182330.jpg', '0.118'),
(89, 5, '1677842785_37020873.jpg', '0.075'),
(89, 7, '1677842806_4040595514.jpg', '0.145'),
(89, 8, '1677842814_3900121555.jpg', '0.080'),
(89, 9, '1677842827_3647802932.jpg', '0.082'),
(89, 10, '1677900419_3728867382.jpg', '0.120'),
(90, 1, '1678008400_MAC_UGC_abovedacloud9.jpg', '0.221'),
(90, 2, '1678008407_MAC_044_original.jpg', '0.103'),
(90, 4, '1678008590_MAC_322_original.jpg', '0.067'),
(90, 5, '1678008607_MAC_329_original.jpg', '0.085'),
(90, 6, '1678008616_MAC_268_original.jpg', '0.092'),
(90, 7, '1678008627_MAC_065_original.jpg', '0.093'),
(90, 8, '1678008635_MAC_070_original.jpg', '0.117'),
(90, 9, '1678008695_MAC_073_original.jpg', '0.116'),
(97, 1, '1681477056_10-best-hotels-in-davao-city-philippines-near-attractions-amp-airport-family-friendly-with-pool-1.jpg', '0.150'),
(97, 2, '1681477056_135fdbfed8e147ae9c51cdbcd64869d7_MEDIUM!_!5fcd30576e758a31c2b90981c3f14d3f.jpg', '0.042');

-- --------------------------------------------------------

--
-- Table structure for table `employer_saved_applicant`
--

DROP TABLE IF EXISTS `employer_saved_applicant`;
CREATE TABLE `employer_saved_applicant` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'employer_saved_applicant',
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer_saved_applicant`
--

INSERT INTO `employer_saved_applicant` (`id`, `type`, `user_id`, `date_created`) VALUES
(276, 'employer_saved_applicant', 270, '2023-03-04 03:29:31'),
(276, 'employer_saved_applicant', 271, '2023-03-04 03:29:32'),
(276, 'employer_saved_applicant', 269, '2023-03-04 03:29:33'),
(276, 'employer_saved_applicant', 282, '2023-03-05 09:10:48'),
(276, 'employer_saved_applicant', 283, '2023-03-05 09:10:51'),
(277, 'employer_saved_applicant', 274, '2023-03-05 16:24:32'),
(277, 'employer_saved_applicant', 312, '2023-03-29 09:00:54'),
(277, 'employer_saved_applicant', 282, '2023-03-29 09:06:30'),
(321, 'employer_saved_applicant', 312, '2023-04-21 02:24:42'),
(321, 'employer_saved_applicant', 270, '2023-04-21 02:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_applicant`
--

DROP TABLE IF EXISTS `job_post_applicant`;
CREATE TABLE `job_post_applicant` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_applicant',
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_post_applicant`
--

INSERT INTO `job_post_applicant` (`id`, `type`, `user_id`, `date_created`, `status`) VALUES
(263, 'job_post_applicant', 283, '2023-03-05 08:40:12', ''),
(265, 'job_post_applicant', 283, '2023-03-05 08:40:24', ''),
(262, 'job_post_applicant', 283, '2023-03-05 08:41:29', ''),
(264, 'job_post_applicant', 283, '2023-03-05 08:41:54', ''),
(266, 'job_post_applicant', 282, '2023-03-05 10:04:21', ''),
(271, 'job_post_applicant', 282, '2023-03-05 10:04:36', ''),
(274, 'job_post_applicant', 282, '2023-03-05 10:04:49', ''),
(265, 'job_post_applicant', 282, '2023-03-05 10:12:39', ''),
(271, 'job_post_applicant', 283, '2023-03-05 10:12:58', ''),
(274, 'job_post_applicant', 283, '2023-03-05 10:13:07', ''),
(268, 'job_post_applicant', 283, '2023-03-05 10:13:15', ''),
(272, 'job_post_applicant', 283, '2023-03-05 10:13:28', ''),
(261, 'job_post_applicant', 283, '2023-03-05 10:14:03', ''),
(274, 'job_post_applicant', 274, '2023-03-11 05:28:13', ''),
(265, 'job_post_applicant', 274, '2023-03-11 05:29:07', ''),
(261, 'job_post_applicant', 272, '2023-03-11 07:24:53', ''),
(271, 'job_post_applicant', 273, '2023-03-11 07:27:56', ''),
(271, 'job_post_applicant', 272, '2023-03-11 07:34:12', ''),
(276, 'job_post_applicant', 278, '2023-03-21 07:20:15', ''),
(271, 'job_post_applicant', 312, '2023-03-28 07:10:00', ''),
(277, 'job_post_applicant', 312, '2023-03-29 07:19:16', ''),
(278, 'job_post_applicant', 312, '2023-03-29 07:24:14', ''),
(262, 'job_post_applicant', 312, '2023-03-29 07:49:04', ''),
(281, 'job_post_applicant', 312, '2023-03-29 09:17:28', ''),
(282, 'job_post_applicant', 312, '2023-03-29 09:23:25', ''),
(281, 'job_post_applicant', 313, '2023-03-30 05:30:16', ''),
(287, 'job_post_applicant', 322, '2023-04-21 02:16:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_for_interview`
--

DROP TABLE IF EXISTS `job_post_for_interview`;
CREATE TABLE `job_post_for_interview` (
  `id` int(11) NOT NULL,
  `job_post_id` int(11) NOT NULL,
  `line` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_for_interview',
  `user_id` int(11) NOT NULL,
  `interview_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `interview_start_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `interview_end_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `interviewer_name_position` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `interview_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `virtual_interview_link` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `notes_to_interviewee` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_post_for_interview`
--

INSERT INTO `job_post_for_interview` (`id`, `job_post_id`, `line`, `type`, `user_id`, `interview_date`, `interview_start_time`, `interview_end_time`, `interviewer_name_position`, `interview_type`, `virtual_interview_link`, `notes_to_interviewee`, `date_created`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `created_by`, `status`) VALUES
(53, 271, 0, 'job_post_for_interview', 282, '3/9/2023', '11:00 AM', '12:00 PM', 'Consuelo', 'face_to_face', '', 'Please pass through Employee\'s entrance and get directions from security ', '2023-03-05 10:27:23', '3rd floor HR Office, Four Seasons Macao ', '0.0000000', '0.0000000', '', '', '', 277, 'pending'),
(54, 266, 0, 'job_post_for_interview', 282, '3/7/2023', '3:15 PM', '4:15 PM', '', 'face_to_face', '', '', '2023-03-07 07:20:08', 'Manila', '0.0000000', '0.0000000', '', '', '', 275, 'pending'),
(55, 271, 0, 'job_post_for_interview', 272, '3/13/2023', '3:41 PM', '4:44 PM', 'Johnny/HR Manager', 'face_to_face', '', 'Please come on time ', '2023-03-11 07:44:49', '3rd floor HR Office, Four Seasons Macao ', '0.0000000', '0.0000000', '', '', '', 277, 'cancelled'),
(56, 271, 0, 'job_post_for_interview', 312, '3/28/2023', '3:12 PM', '4:12 PM', 'HR', 'face_to_face', '', 'Bring ballpen', '2023-03-28 07:13:27', 'Eastwood', '0.0000000', '0.0000000', '', '', '', 277, 'cancelled'),
(57, 271, 0, 'job_post_for_interview', 312, '3/28/2023', '3:15 PM', '4:15 PM', 'HR', 'face_to_face', '', 'Ballpen', '2023-03-28 07:15:51', 'Eastwood QC', '0.0000000', '0.0000000', '', '', '', 277, 'pending'),
(58, 278, 0, 'job_post_for_interview', 312, '3/29/2023', '3:25 PM', '3:29 PM', 'HR', 'face_to_face', '', 'TESTTT', '2023-03-29 07:25:14', 'Eastwood', '0.0000000', '0.0000000', '', '', '', 316, 'pending'),
(59, 271, 0, 'job_post_for_interview', 282, '3/30/2023', '2:20 PM', '2:30 PM', 'HR', 'face_to_face', '', 'YEY', '2023-03-30 06:15:44', 'QC', '0.0000000', '0.0000000', '', '', '', 277, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_move_to`
--

DROP TABLE IF EXISTS `job_post_move_to`;
CREATE TABLE `job_post_move_to` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_move_to',
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_post_move_to`
--

INSERT INTO `job_post_move_to` (`id`, `type`, `user_id`, `date_created`, `status`, `if_current`) VALUES
(271, 'job_post_move_to', 282, '2023-03-05 10:15:51', 'short listed', 0),
(271, 'job_post_move_to', 283, '2023-03-05 10:16:03', 'short listed', 1),
(271, 'job_post_move_to', 282, '2023-03-05 10:27:23', 'for interview', 0),
(266, 'job_post_move_to', 282, '2023-03-07 07:20:08', 'for interview', 1),
(271, 'job_post_move_to', 272, '2023-03-11 07:40:57', 'short listed', 1),
(268, 'job_post_move_to', 283, '2023-03-12 01:52:17', 'short listed', 1),
(271, 'job_post_move_to', 312, '2023-03-28 07:12:15', 'hired', 0),
(271, 'job_post_move_to', 312, '2023-03-28 07:12:54', 'hired', 0),
(271, 'job_post_move_to', 312, '2023-03-28 07:13:27', 'for interview', 0),
(271, 'job_post_move_to', 312, '2023-03-28 07:14:05', 'hired', 0),
(278, 'job_post_move_to', 312, '2023-03-29 07:25:14', 'for interview', 1),
(281, 'job_post_move_to', 312, '2023-03-29 09:29:35', 'offered', 1),
(281, 'job_post_move_to', 313, '2023-03-30 05:31:15', 'offered', 1),
(271, 'job_post_move_to', 282, '2023-03-30 06:15:44', 'for interview', 1),
(287, 'job_post_move_to', 322, '2023-04-21 02:18:34', 'short listed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_post_report`
--

DROP TABLE IF EXISTS `job_post_report`;
CREATE TABLE `job_post_report` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_report',
  `user_id` int(11) NOT NULL,
  `comment` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_post_report`
--

INSERT INTO `job_post_report` (`id`, `type`, `user_id`, `comment`, `date_created`) VALUES
(271, 'job_post_report', 278, 'Test', '2023-03-21 07:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_trending`
--

DROP TABLE IF EXISTS `job_post_trending`;
CREATE TABLE `job_post_trending` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_trending',
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_views`
--

DROP TABLE IF EXISTS `job_post_views`;
CREATE TABLE `job_post_views` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_views',
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_post_views`
--

INSERT INTO `job_post_views` (`id`, `type`, `user_id`, `points`, `anonymous`, `date_created`) VALUES
(258, 'job_post_views', 278, 1, 0, '2023-03-03 16:46:28'),
(258, 'job_post_views', 273, 1, 0, '2023-03-03 16:54:36'),
(258, 'job_post_views', 272, 1, 0, '2023-03-03 16:55:02'),
(260, 'job_post_views', 273, 1, 0, '2023-03-03 19:14:43'),
(261, 'job_post_views', 282, 1, 0, '2023-03-05 16:12:47'),
(260, 'job_post_views', 282, 1, 0, '2023-03-05 16:28:18'),
(260, 'job_post_views', 282, 1, 0, '2023-03-05 16:28:22'),
(263, 'job_post_views', 283, 1, 0, '2023-03-05 16:40:06'),
(263, 'job_post_views', 283, 1, 0, '2023-03-05 16:40:10'),
(265, 'job_post_views', 283, 1, 0, '2023-03-05 16:40:20'),
(265, 'job_post_views', 283, 1, 0, '2023-03-05 16:40:23'),
(262, 'job_post_views', 283, 1, 0, '2023-03-05 16:40:31'),
(262, 'job_post_views', 283, 1, 0, '2023-03-05 16:40:37'),
(262, 'job_post_views', 283, 1, 0, '2023-03-05 16:41:39'),
(263, 'job_post_views', 283, 1, 0, '2023-03-05 16:41:45'),
(264, 'job_post_views', 283, 1, 0, '2023-03-05 16:41:52'),
(263, 'job_post_views', 283, 1, 0, '2023-03-05 16:42:50'),
(266, 'job_post_views', 282, 1, 0, '2023-03-05 18:04:19'),
(271, 'job_post_views', 282, 1, 0, '2023-03-05 18:04:34'),
(274, 'job_post_views', 282, 1, 0, '2023-03-05 18:04:47'),
(265, 'job_post_views', 282, 1, 0, '2023-03-05 18:12:37'),
(271, 'job_post_views', 283, 1, 0, '2023-03-05 18:12:57'),
(271, 'job_post_views', 283, 1, 0, '2023-03-05 18:13:01'),
(274, 'job_post_views', 283, 1, 0, '2023-03-05 18:13:06'),
(268, 'job_post_views', 283, 1, 0, '2023-03-05 18:13:14'),
(272, 'job_post_views', 283, 1, 0, '2023-03-05 18:13:27'),
(274, 'job_post_views', 283, 1, 0, '2023-03-05 18:13:51'),
(261, 'job_post_views', 283, 1, 0, '2023-03-05 18:14:02'),
(271, 'job_post_views', 282, 1, 0, '2023-03-06 00:04:42'),
(271, 'job_post_views', 282, 1, 0, '2023-03-06 00:09:20'),
(274, 'job_post_views', 310, 1, 0, '2023-03-07 15:03:36'),
(274, 'job_post_views', 310, 1, 0, '2023-03-07 15:04:12'),
(274, 'job_post_views', 274, 1, 0, '2023-03-11 13:28:11'),
(265, 'job_post_views', 274, 1, 0, '2023-03-11 13:28:44'),
(265, 'job_post_views', 274, 1, 0, '2023-03-11 13:29:03'),
(265, 'job_post_views', 274, 1, 0, '2023-03-11 13:29:13'),
(265, 'job_post_views', 274, 1, 0, '2023-03-11 14:54:36'),
(265, 'job_post_views', 274, 1, 0, '2023-03-11 15:07:40'),
(261, 'job_post_views', 272, 1, 0, '2023-03-11 15:24:49'),
(271, 'job_post_views', 272, 1, 0, '2023-03-11 15:25:10'),
(271, 'job_post_views', 273, 1, 0, '2023-03-11 15:27:50'),
(271, 'job_post_views', 273, 1, 0, '2023-03-11 15:30:51'),
(271, 'job_post_views', 272, 1, 0, '2023-03-11 15:34:08'),
(276, 'job_post_views', 278, 1, 0, '2023-03-21 15:19:49'),
(271, 'job_post_views', 278, 1, 0, '2023-03-21 15:20:33'),
(271, 'job_post_views', 278, 1, 0, '2023-03-21 15:21:21'),
(271, 'job_post_views', 312, 1, 0, '2023-03-28 15:02:39'),
(271, 'job_post_views', 312, 1, 0, '2023-03-28 15:06:20'),
(271, 'job_post_views', 312, 1, 0, '2023-03-28 15:10:13'),
(271, 'job_post_views', 312, 1, 0, '2023-03-28 15:14:16'),
(271, 'job_post_views', 312, 1, 0, '2023-03-28 15:15:02'),
(271, 'job_post_views', 312, 1, 0, '2023-03-28 15:16:09'),
(264, 'job_post_views', 312, 1, 0, '2023-03-29 11:32:29'),
(271, 'job_post_views', 312, 1, 0, '2023-03-29 13:59:44'),
(277, 'job_post_views', 312, 1, 0, '2023-03-29 15:19:14'),
(277, 'job_post_views', 312, 1, 0, '2023-03-29 15:19:41'),
(278, 'job_post_views', 312, 1, 0, '2023-03-29 15:24:12'),
(262, 'job_post_views', 312, 1, 0, '2023-03-29 15:47:35'),
(262, 'job_post_views', 312, 1, 0, '2023-03-29 15:48:08'),
(271, 'job_post_views', 312, 1, 0, '2023-03-29 15:50:52'),
(274, 'job_post_views', 312, 1, 0, '2023-03-29 15:52:35'),
(263, 'job_post_views', 312, 1, 0, '2023-03-29 15:52:44'),
(271, 'job_post_views', 312, 1, 0, '2023-03-29 15:53:04'),
(277, 'job_post_views', 312, 1, 0, '2023-03-29 15:56:45'),
(278, 'job_post_views', 312, 1, 0, '2023-03-29 15:56:58'),
(277, 'job_post_views', 312, 1, 0, '2023-03-29 16:04:33'),
(277, 'job_post_views', 312, 1, 0, '2023-03-29 16:04:43'),
(281, 'job_post_views', 312, 1, 0, '2023-03-29 17:17:23'),
(278, 'job_post_views', 312, 1, 0, '2023-03-29 17:23:16'),
(282, 'job_post_views', 312, 1, 0, '2023-03-29 17:23:22'),
(271, 'job_post_views', 277, 1, 0, '2023-03-29 17:26:19'),
(278, 'job_post_views', 277, 1, 0, '2023-03-29 17:26:47'),
(282, 'job_post_views', 277, 1, 0, '2023-03-29 17:27:21'),
(281, 'job_post_views', 313, 1, 0, '2023-03-30 13:30:15'),
(271, 'job_post_views', 312, 1, 0, '2023-03-30 13:55:04'),
(271, 'job_post_views', 312, 1, 0, '2023-03-30 13:55:24'),
(287, 'job_post_views', 322, 1, 0, '2023-04-21 10:12:01'),
(287, 'job_post_views', 322, 1, 0, '2023-04-21 10:13:06'),
(287, 'job_post_views', 322, 1, 0, '2023-04-21 10:16:26'),
(287, 'job_post_views', 322, 1, 0, '2023-04-21 10:16:33'),
(287, 'job_post_views', 322, 1, 0, '2023-04-21 10:16:41'),
(287, 'job_post_views', 322, 1, 0, '2023-04-21 10:16:53'),
(271, 'job_post_views', 322, 1, 0, '2023-04-21 10:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `oaud`
--

DROP TABLE IF EXISTS `oaud`;
CREATE TABLE `oaud` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `line` int(11) NOT NULL DEFAULT 0,
  `record_field` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `record_field_old_value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `record_field_new_value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oaud`
--

INSERT INTO `oaud` (`id`, `username`, `user_id`, `action`, `record_id`, `record_type`, `line`, `record_field`, `record_field_old_value`, `record_field_new_value`, `date_time`) VALUES
(8981, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-01 21:08:50'),
(8982, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-01 21:10:39'),
(8983, 'dexmanreza@gmail.com', 0, 'created', 373, 'signup', 0, '', '', '', '2023-03-01 21:11:57'),
(8984, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-01 21:12:10'),
(8985, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-01 21:12:50'),
(8986, 'arman1@gmail.com', 0, 'created', 265, 'user', 0, '', '', '', '2023-03-02 13:03:00'),
(8987, 'arman1@gmail.com', 0, 'created', 265, 'profile', 0, '', '', '', '2023-03-02 13:03:00'),
(8988, 'arman2@gmail.com', 0, 'created', 266, 'user', 0, '', '', '', '2023-03-02 13:03:25'),
(8989, 'arman2@gmail.com', 0, 'created', 266, 'profile', 0, '', '', '', '2023-03-02 13:03:25'),
(8990, 'arman3@gmail.com', 0, 'created', 267, 'user', 0, '', '', '', '2023-03-02 13:03:38'),
(8991, 'arman3@gmail.com', 0, 'created', 267, 'profile', 0, '', '', '', '2023-03-02 13:03:38'),
(8992, 'JohnnyUtah@gmail.com', 0, 'created', 374, 'signup', 0, '', '', '', '2023-03-02 13:07:49'),
(8993, 'JohnnyBravo@gmail.com', 0, 'created', 375, 'signup', 0, '', '', '', '2023-03-02 13:09:53'),
(8994, 'JohnnyCash@gmail.com', 0, 'created', 376, 'signup', 0, '', '', '', '2023-03-02 13:11:49'),
(8995, 'applicant_01@gmail.com', 0, 'created', 268, 'user', 0, '', '', '', '2023-03-02 20:36:39'),
(8996, 'applicant_01@gmail.com', 0, 'created', 268, 'profile', 0, '', '', '', '2023-03-02 20:36:39'),
(8997, '', 268, 'logged in', 0, 'login', 0, '', '', '', '2023-03-02 20:39:36'),
(8998, '', 268, 'updated', 268, 'logout', 0, 'first_name', '', 'Elmer', '2023-03-02 21:06:57'),
(8999, '', 268, 'updated', 268, 'logout', 0, 'last_name', '', 'Test', '2023-03-02 21:06:57'),
(9000, '', 268, 'updated', 268, 'logout', 0, 'dial_code', '', '+93', '2023-03-02 21:06:57'),
(9001, '', 268, 'updated', 268, 'logout', 0, 'contact_number', '', '9388751022', '2023-03-02 21:06:57'),
(9002, '', 268, 'updated', 268, 'logout', 0, 'location', '', 'Albania', '2023-03-02 21:06:57'),
(9003, '', 268, 'updated', 268, 'logout', 0, 'first_login', '1', '0', '2023-03-02 21:06:57'),
(9004, '', 268, 'updated', 268, 'applicant_info', 0, 'doc_image', '', '1677763733_Dongs Lakwatsa.png', '2023-03-02 21:31:14'),
(9005, '', 268, 'updated', 268, 'applicant_info', 0, 'resume', '', '1677763851_Resume.pdf', '2023-03-02 21:31:14'),
(9006, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-02 22:53:23'),
(9007, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-02 22:54:04'),
(9008, '', 188, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 10:02:25'),
(9009, '', 263, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 11:04:46'),
(9010, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 13:42:02'),
(9011, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 13:42:54'),
(9012, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 14:16:19'),
(9013, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 14:16:39'),
(9014, 'arman13@gmail.com', 0, 'created', 269, 'user', 0, '', '', '', '2023-03-03 14:38:45'),
(9015, 'arman13@gmail.com', 0, 'created', 269, 'profile', 0, '', '', '', '2023-03-03 14:38:45'),
(9016, '', 269, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 14:49:32'),
(9017, '', 269, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 14:52:28'),
(9018, 'arman14@gmail.com', 0, 'created', 270, 'user', 0, '', '', '', '2023-03-03 14:52:49'),
(9019, 'arman14@gmail.com', 0, 'created', 270, 'profile', 0, '', '', '', '2023-03-03 14:52:49'),
(9020, 'arman15@gmail.com', 0, 'created', 271, 'user', 0, '', '', '', '2023-03-03 14:54:54'),
(9021, 'arman15@gmail.com', 0, 'created', 271, 'profile', 0, '', '', '', '2023-03-03 14:54:54'),
(9022, '', 270, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 14:55:31'),
(9023, '', 270, 'updated', 270, 'applicant_info', 0, 'first_name', '', 'Arman', '2023-03-03 15:02:03'),
(9024, '', 270, 'updated', 270, 'applicant_info', 0, 'last_name', '', 'Test', '2023-03-03 15:02:03'),
(9025, '', 270, 'updated', 270, 'applicant_info', 0, 'dial_code', '', '+93', '2023-03-03 15:02:03'),
(9026, '', 270, 'updated', 270, 'applicant_info', 0, 'contact_number', '', '9388751000', '2023-03-03 15:02:03'),
(9027, '', 270, 'updated', 270, 'applicant_info', 0, 'location', '', 'Albania', '2023-03-03 15:02:03'),
(9028, '', 270, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:02:50'),
(9029, '', 269, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:02:57'),
(9030, '', 269, 'updated', 269, 'logout', 0, 'first_name', '', 'Arman', '2023-03-03 15:06:28'),
(9031, '', 269, 'updated', 269, 'logout', 0, 'last_name', '', 'Internship', '2023-03-03 15:06:28'),
(9032, '', 269, 'updated', 269, 'logout', 0, 'dial_code', '', '+1767', '2023-03-03 15:06:28'),
(9033, '', 269, 'updated', 269, 'logout', 0, 'contact_number', '', '9388751000', '2023-03-03 15:06:28'),
(9034, '', 269, 'updated', 269, 'logout', 0, 'location', '', 'Gabon', '2023-03-03 15:06:28'),
(9035, '', 269, 'updated', 269, 'logout', 0, 'first_login', '1', '0', '2023-03-03 15:06:28'),
(9036, '', 269, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:06:41'),
(9037, '', 271, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:06:48'),
(9038, '', 271, 'updated', 271, 'logout', 0, 'first_name', '', 'Arman', '2023-03-03 15:11:08'),
(9039, '', 271, 'updated', 271, 'logout', 0, 'last_name', '', 'Highschool', '2023-03-03 15:11:08'),
(9040, '', 271, 'updated', 271, 'logout', 0, 'dial_code', '', '+374', '2023-03-03 15:11:08'),
(9041, '', 271, 'updated', 271, 'logout', 0, 'contact_number', '', '9388751000', '2023-03-03 15:11:08'),
(9042, '', 271, 'updated', 271, 'logout', 0, 'location', '', 'Mali', '2023-03-03 15:11:08'),
(9043, '', 271, 'updated', 271, 'logout', 0, 'first_login', '1', '0', '2023-03-03 15:11:08'),
(9044, '', 271, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:11:17'),
(9045, '', 269, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:11:25'),
(9046, '', 269, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:11:37'),
(9047, '', 270, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:11:43'),
(9048, '', 270, 'updated', 270, 'logout', 0, 'last_name', 'Test', 'Vocational', '2023-03-03 15:13:28'),
(9049, '', 270, 'updated', 270, 'logout', 0, 'dial_code', '+93', '+376', '2023-03-03 15:13:28'),
(9050, '', 270, 'updated', 270, 'logout', 0, 'location', 'Albania', 'Venezuela', '2023-03-03 15:13:28'),
(9051, '', 270, 'updated', 270, 'logout', 0, 'first_login', '1', '0', '2023-03-03 15:13:28'),
(9052, '', 270, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:14:19'),
(9053, 'JohnyUtah@gmail.com', 0, 'created', 377, 'signup', 0, '', '', '', '2023-03-03 15:18:42'),
(9054, '', 270, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:20:42'),
(9055, 'JohnyBravo@gmail.com', 0, 'created', 378, 'signup', 0, '', '', '', '2023-03-03 15:21:01'),
(9056, '', 270, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:21:39'),
(9057, '', 269, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:21:47'),
(9058, '', 269, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:22:06'),
(9059, '', 271, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:22:11'),
(9060, '', 271, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:24:03'),
(9061, '', 271, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:24:08'),
(9062, 'JohnyCash@gmail.com', 0, 'created', 379, 'signup', 0, '', '', '', '2023-03-03 15:24:18'),
(9063, '', 271, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:24:56'),
(9064, '', 193, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:26:54'),
(9065, '', 269, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:27:22'),
(9066, 'arman01@gmail.com', 0, 'created', 272, 'user', 0, '', '', '', '2023-03-03 15:34:51'),
(9067, 'arman01@gmail.com', 0, 'created', 272, 'profile', 0, '', '', '', '2023-03-03 15:34:51'),
(9068, 'arman02@gmail.com', 0, 'created', 273, 'user', 0, '', '', '', '2023-03-03 15:36:02'),
(9069, 'arman02@gmail.com', 0, 'created', 273, 'profile', 0, '', '', '', '2023-03-03 15:36:02'),
(9070, 'arman03@gmail.com', 0, 'created', 274, 'user', 0, '', '', '', '2023-03-03 15:37:34'),
(9071, 'arman03@gmail.com', 0, 'created', 274, 'profile', 0, '', '', '', '2023-03-03 15:37:34'),
(9072, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:42:01'),
(9073, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:43:33'),
(9074, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 15:43:40'),
(9075, '', 3, 'created', 275, 'user', 0, '', '', '', '2023-03-03 15:46:54'),
(9076, '', 3, 'created', 275, 'profile', 0, '', '', '', '2023-03-03 15:46:54'),
(9077, '', 3, 'created', 276, 'user', 0, '', '', '', '2023-03-03 15:48:51'),
(9078, '', 3, 'created', 276, 'profile', 0, '', '', '', '2023-03-03 15:48:51'),
(9079, '', 3, 'created', 277, 'user', 0, '', '', '', '2023-03-03 15:50:38'),
(9080, '', 3, 'created', 277, 'profile', 0, '', '', '', '2023-03-03 15:50:38'),
(9081, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 15:54:25'),
(9082, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:09:06'),
(9083, '31d.employee@gmail.com', 0, 'created', 278, 'user', 0, '', '', '', '2023-03-03 16:11:15'),
(9084, '31d.employee@gmail.com', 0, 'created', 278, 'profile', 0, '', '', '', '2023-03-03 16:11:15'),
(9085, '31d.employer@gmail.com', 0, 'created', 380, 'signup', 0, '', '', '', '2023-03-03 16:17:46'),
(9086, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:18:00'),
(9087, '', 3, 'created', 279, 'user', 0, '', '', '', '2023-03-03 16:20:14'),
(9088, '', 3, 'created', 279, 'profile', 0, '', '', '', '2023-03-03 16:20:14'),
(9089, '', 3, 'created', 280, 'user', 0, '', '', '', '2023-03-03 16:21:52'),
(9090, '', 3, 'created', 280, 'profile', 0, '', '', '', '2023-03-03 16:21:52'),
(9091, '', 3, 'created', 281, 'user', 0, '', '', '', '2023-03-03 16:23:48'),
(9092, '', 3, 'created', 281, 'profile', 0, '', '', '', '2023-03-03 16:23:48'),
(9093, '', 270, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:24:52'),
(9094, '', 270, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:24:58'),
(9095, '', 280, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:26:25'),
(9096, '', 280, 'updated', 280, 'user', 0, '', '', '', '2023-03-03 16:26:44'),
(9097, '', 270, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:29:01'),
(9098, '', 270, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:29:27'),
(9099, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:31:09'),
(9100, '', 275, 'updated', 275, 'user', 0, '', '', '', '2023-03-03 16:31:37'),
(9101, '', 269, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:31:41'),
(9102, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:31:47'),
(9103, '', 276, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:32:04'),
(9104, '', 281, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:32:21'),
(9105, '', 276, 'updated', 276, 'user', 0, '', '', '', '2023-03-03 16:32:35'),
(9106, '', 276, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:32:41'),
(9107, '', 281, 'updated', 281, 'user', 0, '', '', '', '2023-03-03 16:32:44'),
(9108, '', 281, 'created', 50, 'perks_and_benefits', 0, '', '', '', '2023-03-03 16:35:34'),
(9109, '', 281, 'created', 51, 'perks_and_benefits', 0, '', '', '', '2023-03-03 16:35:34'),
(9110, '', 281, 'created', 258, 'job_post', 0, '', '', '', '2023-03-03 16:37:27'),
(9111, '', 281, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:37:38'),
(9112, '', 269, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:39:48'),
(9113, '', 278, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:39:56'),
(9114, '', 269, 'updated', 269, 'applicant_info', 0, 'last_name', 'Internship', 'Manager', '2023-03-03 16:40:13'),
(9115, '', 269, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:40:17'),
(9116, '', 270, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:40:22'),
(9117, '', 270, 'updated', 270, 'applicant_info', 0, 'last_name', 'Vocational', 'Director', '2023-03-03 16:40:35'),
(9118, '', 270, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:40:41'),
(9119, '', 271, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:40:45'),
(9120, '', 271, 'updated', 271, 'applicant_info', 0, 'last_name', 'Highschool', 'Entry', '2023-03-03 16:41:23'),
(9121, '', 271, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:41:29'),
(9122, '', 278, 'updated', 278, 'logout', 0, 'first_name', '', 'Juan', '2023-03-03 16:43:03'),
(9123, '', 278, 'updated', 278, 'logout', 0, 'middle_name', '', 'Santos', '2023-03-03 16:43:03'),
(9124, '', 278, 'updated', 278, 'logout', 0, 'last_name', '', 'Dela Cruz', '2023-03-03 16:43:03'),
(9125, '', 278, 'updated', 278, 'logout', 0, 'dial_code', '', '+63', '2023-03-03 16:43:03'),
(9126, '', 278, 'updated', 278, 'logout', 0, 'contact_number', '', '9663590399', '2023-03-03 16:43:03'),
(9127, '', 278, 'updated', 278, 'logout', 0, 'location', '', 'Philippines', '2023-03-03 16:43:03'),
(9128, '', 278, 'updated', 278, 'logout', 0, 'first_login', '1', '0', '2023-03-03 16:43:03'),
(9129, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:44:48'),
(9130, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:48:24'),
(9131, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:48:31'),
(9132, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:49:35'),
(9133, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:49:43'),
(9134, '', 278, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:50:38'),
(9135, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:51:04'),
(9136, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:51:14'),
(9137, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:51:27'),
(9138, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:51:28'),
(9139, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:51:48'),
(9140, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:52:03'),
(9141, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:54:23'),
(9142, '', 272, 'created', 0, 'favorites', 0, '', '', '', '2023-03-03 16:55:32'),
(9143, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 16:56:47'),
(9144, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 16:58:09'),
(9145, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 17:00:44'),
(9146, '', 281, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 17:01:11'),
(9147, '', 281, 'created', 259, 'job_post', 0, '', '', '', '2023-03-03 17:08:04'),
(9148, '', 281, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 17:18:13'),
(9149, '4arman@gmail.com', 0, 'created', 282, 'user', 0, '', '', '', '2023-03-03 17:37:22'),
(9150, '4arman@gmail.com', 0, 'created', 282, 'profile', 0, '', '', '', '2023-03-03 17:37:22'),
(9151, '5arman@gmail.com', 0, 'created', 283, 'user', 0, '', '', '', '2023-03-03 17:37:47'),
(9152, '5arman@gmail.com', 0, 'created', 283, 'profile', 0, '', '', '', '2023-03-03 17:37:47'),
(9153, '6arman@gmail.com', 0, 'created', 284, 'user', 0, '', '', '', '2023-03-03 17:38:08'),
(9154, '6arman@gmail.com', 0, 'created', 284, 'profile', 0, '', '', '', '2023-03-03 17:38:08'),
(9155, '7arman@gmail.com', 0, 'created', 285, 'user', 0, '', '', '', '2023-03-03 17:38:40'),
(9156, '7arman@gmail.com', 0, 'created', 285, 'profile', 0, '', '', '', '2023-03-03 17:38:40'),
(9157, '8arman@gmail.com', 0, 'created', 286, 'user', 0, '', '', '', '2023-03-03 17:39:13'),
(9158, '8arman@gmail.com', 0, 'created', 286, 'profile', 0, '', '', '', '2023-03-03 17:39:13'),
(9159, '9arman@gmail.com', 0, 'created', 287, 'user', 0, '', '', '', '2023-03-03 17:39:30'),
(9160, '9arman@gmail.com', 0, 'created', 287, 'profile', 0, '', '', '', '2023-03-03 17:39:30'),
(9161, '10arman@gmail.com', 0, 'created', 288, 'user', 0, '', '', '', '2023-03-03 17:39:58'),
(9162, '10arman@gmail.com', 0, 'created', 288, 'profile', 0, '', '', '', '2023-03-03 17:39:58'),
(9163, '1donie@gmail.com', 0, 'created', 289, 'user', 0, '', '', '', '2023-03-03 17:40:23'),
(9164, '1donie@gmail.com', 0, 'created', 289, 'profile', 0, '', '', '', '2023-03-03 17:40:23'),
(9165, '2donie@gmail.com', 0, 'created', 290, 'user', 0, '', '', '', '2023-03-03 17:40:42'),
(9166, '2donie@gmail.com', 0, 'created', 290, 'profile', 0, '', '', '', '2023-03-03 17:40:42'),
(9167, '3donie@gmail.com', 0, 'created', 291, 'user', 0, '', '', '', '2023-03-03 17:41:00'),
(9168, '3donie@gmail.com', 0, 'created', 291, 'profile', 0, '', '', '', '2023-03-03 17:41:00'),
(9169, '4donie@gmail.com', 0, 'created', 292, 'user', 0, '', '', '', '2023-03-03 17:41:16'),
(9170, '4donie@gmail.com', 0, 'created', 292, 'profile', 0, '', '', '', '2023-03-03 17:41:16'),
(9171, '5donie@gmail.com', 0, 'created', 293, 'user', 0, '', '', '', '2023-03-03 17:41:33'),
(9172, '5donie@gmail.com', 0, 'created', 293, 'profile', 0, '', '', '', '2023-03-03 17:41:33'),
(9173, '6donie@gmail.com', 0, 'created', 294, 'user', 0, '', '', '', '2023-03-03 17:41:49'),
(9174, '6donie@gmail.com', 0, 'created', 294, 'profile', 0, '', '', '', '2023-03-03 17:41:49'),
(9175, '7donie@gmail.com', 0, 'created', 295, 'user', 0, '', '', '', '2023-03-03 17:42:09'),
(9176, '7donie@gmail.com', 0, 'created', 295, 'profile', 0, '', '', '', '2023-03-03 17:42:09'),
(9177, '8donie@gmail.com', 0, 'created', 296, 'user', 0, '', '', '', '2023-03-03 17:43:19'),
(9178, '8donie@gmail.com', 0, 'created', 296, 'profile', 0, '', '', '', '2023-03-03 17:43:19'),
(9179, '9donie@gmail.com', 0, 'created', 297, 'user', 0, '', '', '', '2023-03-03 17:43:34'),
(9180, '9donie@gmail.com', 0, 'created', 297, 'profile', 0, '', '', '', '2023-03-03 17:43:34'),
(9181, '10donie@gmail.com', 0, 'created', 298, 'user', 0, '', '', '', '2023-03-03 17:43:53'),
(9182, '10donie@gmail.com', 0, 'created', 298, 'profile', 0, '', '', '', '2023-03-03 17:43:53'),
(9183, '1jose@gmail.com', 0, 'created', 299, 'user', 0, '', '', '', '2023-03-03 17:44:12'),
(9184, '1jose@gmail.com', 0, 'created', 299, 'profile', 0, '', '', '', '2023-03-03 17:44:12'),
(9185, '2jose@gmail.com', 0, 'created', 300, 'user', 0, '', '', '', '2023-03-03 17:44:29'),
(9186, '2jose@gmail.com', 0, 'created', 300, 'profile', 0, '', '', '', '2023-03-03 17:44:29'),
(9187, '3jose@gmail.com', 0, 'created', 301, 'user', 0, '', '', '', '2023-03-03 17:44:45'),
(9188, '3jose@gmail.com', 0, 'created', 301, 'profile', 0, '', '', '', '2023-03-03 17:44:45'),
(9189, '4jose@gmail.com', 0, 'created', 302, 'user', 0, '', '', '', '2023-03-03 17:44:59'),
(9190, '4jose@gmail.com', 0, 'created', 302, 'profile', 0, '', '', '', '2023-03-03 17:44:59'),
(9191, '5jose@gmail.com', 0, 'created', 303, 'user', 0, '', '', '', '2023-03-03 17:45:12'),
(9192, '5jose@gmail.com', 0, 'created', 303, 'profile', 0, '', '', '', '2023-03-03 17:45:12'),
(9193, '6jose@gmail.com', 0, 'created', 304, 'user', 0, '', '', '', '2023-03-03 17:45:29'),
(9194, '6jose@gmail.com', 0, 'created', 304, 'profile', 0, '', '', '', '2023-03-03 17:45:29'),
(9195, '7jose@gmail.com', 0, 'created', 305, 'user', 0, '', '', '', '2023-03-03 17:45:43'),
(9196, '7jose@gmail.com', 0, 'created', 305, 'profile', 0, '', '', '', '2023-03-03 17:45:43'),
(9197, '8jose@gmail.com', 0, 'created', 306, 'user', 0, '', '', '', '2023-03-03 17:45:57'),
(9198, '8jose@gmail.com', 0, 'created', 306, 'profile', 0, '', '', '', '2023-03-03 17:45:57'),
(9199, '9jose@gmail.com', 0, 'created', 307, 'user', 0, '', '', '', '2023-03-03 17:46:12'),
(9200, '9jose@gmail.com', 0, 'created', 307, 'profile', 0, '', '', '', '2023-03-03 17:46:12'),
(9201, '10jose@gmail.com', 0, 'created', 308, 'user', 0, '', '', '', '2023-03-03 17:46:27'),
(9202, '10jose@gmail.com', 0, 'created', 308, 'profile', 0, '', '', '', '2023-03-03 17:46:27'),
(9203, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 17:49:45'),
(9204, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 18:31:27'),
(9205, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 18:31:55'),
(9206, '', 275, 'created', 260, 'job_post', 0, '', '', '', '2023-03-03 18:38:24'),
(9207, '', 275, 'created', 261, 'job_post', 0, '', '', '', '2023-03-03 18:47:41'),
(9208, '', 275, 'created', 262, 'job_post', 0, '', '', '', '2023-03-03 18:51:50'),
(9209, '', 275, 'updated', 88, 'employer', 0, 'doc_image', '', '1677840824_new world makati.jpg', '2023-03-03 18:55:12'),
(9210, '', 275, 'updated', 88, 'employer', 0, 'about', '', 'NEWWORLDMAKATIHOTEL\r\nEvery one of us at the luxury, 5-star New World Makati Hotel in Manila wants to make your stay with us a pleasure, whether you’re here on business or leisure … or even to get married.\r\n\r\nWe make work a little easier with complimentary Internet service in your room and throughout the hotel, flexible venues for meetings and conferences of all sizes, and a business center that can handle all your needs, from office supplies and photocopying to secretarial support.\r\n\r\nWe make ho', '2023-03-03 18:55:12'),
(9211, '', 275, 'updated', 88, 'employer', 0, 'website', '', 'https://manila.newworldhotels.com/en/', '2023-03-03 18:55:12'),
(9212, '', 275, 'updated', 88, 'employer', 0, 'address', '', 'Esperanza Street corner Makati Avenue, Ayala Center, Makati City 1228, Philippines', '2023-03-03 18:55:12'),
(9213, '', 275, 'created', 88, 'employer', 1, '', '', '1677841110_key_rooms_guests_1.jpg', '2023-03-03 18:59:04'),
(9214, '', 275, 'created', 88, 'employer', 2, '', '', '1677841194_key_rooms_suite_1.jpg', '2023-03-03 19:03:59'),
(9215, '', 275, 'created', 88, 'employer', 3, '', '', '1677841282_key_rooms_residence_1.jpg', '2023-03-03 19:03:59'),
(9216, '', 275, 'created', 88, 'employer', 4, '', '', '1677841305_key_meetings_events_31.jpg', '2023-03-03 19:03:59'),
(9217, '', 275, 'created', 88, 'employer', 5, '', '', '1677841312_key_dining_jasmine_2.jpg', '2023-03-03 19:03:59'),
(9218, '', 275, 'created', 88, 'employer', 6, '', '', '1677841323_key_dining_cafe_1.jpg', '2023-03-03 19:03:59'),
(9219, '', 275, 'created', 88, 'employer', 7, '', '', '1677841330_Cafe-1228-Seafood-Buffet_282x190.jpg', '2023-03-03 19:03:59'),
(9220, '', 275, 'created', 88, 'employer', 8, '', '', '1677841373_Superior-Room-960-x-375-px.jpg', '2023-03-03 19:03:59'),
(9221, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 19:06:11'),
(9222, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 19:06:24'),
(9223, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 19:06:44'),
(9224, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 19:06:55'),
(9225, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 19:15:36'),
(9226, '', 276, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 19:19:30'),
(9227, '', 276, 'updated', 89, 'employer', 0, 'about', '', 'Luxury, heritage, and comfort combine gracefully at Dusit Thani Manila, a 5-star hotel in Makati.\r\n\r\nSituated in the heart of the financial capital, the five-star hotel in Makati boasts easy access to all the business, entertainment, and recreational options Makati has to offer.\r\n\r\nA choice of 500 exquisite rooms and suites in our Makati city hotel embodies a delightful blend of Filipino geniality and gracious Thai hospitality, while world-class dining destinations and full-service facilities en', '2023-03-03 19:21:46'),
(9228, '', 276, 'updated', 89, 'employer', 0, 'website', '', 'https://www.dusit.com/dusitthani-manila/', '2023-03-03 19:21:46'),
(9229, '', 276, 'updated', 89, 'employer', 0, 'address', '', 'Ayala Centre, 1223 Makati City Metro Manila, Philippines', '2023-03-03 19:21:46'),
(9230, '', 276, 'created', 89, 'employer', 2, '', '', '1677842631_1243024330.jpg', '2023-03-03 19:27:13'),
(9231, '', 276, 'created', 89, 'employer', 3, '', '', '1677842635_2240832483.jpg', '2023-03-03 19:27:13'),
(9232, '', 276, 'created', 89, 'employer', 4, '', '', '1677842640_2242182330.jpg', '2023-03-03 19:27:13'),
(9233, '', 276, 'created', 89, 'employer', 5, '', '', '1677842785_37020873.jpg', '2023-03-03 19:27:13'),
(9234, '', 276, 'created', 89, 'employer', 6, '', '', '1677842793_key_rooms_guests_1.jpg', '2023-03-03 19:27:13'),
(9235, '', 276, 'created', 89, 'employer', 7, '', '', '1677842806_4040595514.jpg', '2023-03-03 19:27:13'),
(9236, '', 276, 'created', 89, 'employer', 8, '', '', '1677842814_3900121555.jpg', '2023-03-03 19:27:13'),
(9237, '', 276, 'created', 89, 'employer', 9, '', '', '1677842827_3647802932.jpg', '2023-03-03 19:27:13'),
(9238, '', 276, 'created', 263, 'job_post', 0, '', '', '', '2023-03-03 19:33:07'),
(9239, '', 276, 'created', 264, 'job_post', 0, '', '', '', '2023-03-03 19:37:42'),
(9240, '', 276, 'created', 265, 'job_post', 0, '', '', '', '2023-03-03 19:42:46'),
(9241, '', 276, 'updated', 265, 'job_post', 0, 'vacancies', '10', '9', '2023-03-03 19:43:18'),
(9242, '', 276, 'updated', 265, 'job_post', 0, 'perks_and_benefits', '[\"5\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '[\"5\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '2023-03-03 19:43:18'),
(9243, '', 276, 'updated', 265, 'job_post', 0, 'vacancies_placeholde', '10', '9', '2023-03-03 19:43:18'),
(9244, '', 276, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-03 19:45:28'),
(9245, '', 276, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-03 19:45:47'),
(9246, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-03 21:39:37'),
(9247, '', 276, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 11:25:41'),
(9248, '', 276, 'created', 89, 'employer', 10, '', '', '1677900419_3728867382.jpg', '2023-03-04 11:27:05'),
(9249, '', 276, 'updated', 89, 'employer', 0, 'doc_image', '', '1677900523_3831843412d.jpg', '2023-03-04 11:28:49'),
(9250, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-04 11:29:31'),
(9251, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-04 11:29:32'),
(9252, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-04 11:29:33'),
(9253, '', 276, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 11:30:35'),
(9254, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 11:32:37'),
(9255, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 11:33:19'),
(9256, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 11:35:43'),
(9257, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 11:35:53'),
(9258, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 11:35:56'),
(9259, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 11:37:44'),
(9260, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 11:38:26'),
(9261, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 11:39:53'),
(9262, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 11:44:39'),
(9263, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 11:49:59'),
(9264, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 17:00:43'),
(9265, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 17:01:13'),
(9266, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 17:02:43'),
(9267, '', 3, 'updated', 88, 'employer', 0, 'other_notes', '', 'Test Internal Notes', '2023-03-04 17:04:54'),
(9268, '', 3, 'updated', 275, 'user', 0, 'name', 'Johny Utah', 'Johnny Utah', '2023-03-04 17:05:57'),
(9269, '', 3, 'updated', 275, 'profile', 0, 'first_name', 'Johny', 'Johnny', '2023-03-04 17:05:57'),
(9270, '', 3, 'updated', 275, 'user', 0, 'email_add', 'JohnyUtah@gmail.com', 'JohnnyUtah@gmail.com', '2023-03-04 17:06:15'),
(9271, '', 3, 'updated', 275, 'user', 0, 'username', 'JohnyUtah@gmail.com', 'JohnnyUtah@gmail.com', '2023-03-04 17:06:15'),
(9272, '', 3, 'updated', 275, 'profile', 0, 'email_add', 'JohnyUtah@gmail.com', 'JohnnyUtah@gmail.com', '2023-03-04 17:06:15'),
(9273, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 17:06:38'),
(9274, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 17:06:53'),
(9275, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 17:07:03'),
(9276, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 17:07:36'),
(9277, '', 3, 'updated', 276, 'user', 0, 'email_add', 'JohnyBravo@gmail.com', 'JohnnyBravo@gmail.com', '2023-03-04 17:09:13'),
(9278, '', 3, 'updated', 276, 'user', 0, 'name', 'Johny Bravo', 'Johnny Bravo', '2023-03-04 17:09:13'),
(9279, '', 3, 'updated', 276, 'user', 0, 'username', 'JohnyBravo@gmail.com', 'JohnnyBravo@gmail.com', '2023-03-04 17:09:13'),
(9280, '', 3, 'updated', 276, 'profile', 0, 'first_name', 'Johny', 'Johnny', '2023-03-04 17:09:13'),
(9281, '', 3, 'updated', 276, 'profile', 0, 'email_add', 'JohnyBravo@gmail.com', 'JohnnyBravo@gmail.com', '2023-03-04 17:09:13'),
(9282, '', 3, 'updated', 277, 'user', 0, 'email_add', 'JohnyCash@gmail.com', 'JohnnyCash@gmail.com', '2023-03-04 17:11:04'),
(9283, '', 3, 'updated', 277, 'user', 0, 'name', 'Johny Cash', 'Johnny Cash', '2023-03-04 17:11:04'),
(9284, '', 3, 'updated', 277, 'user', 0, 'username', 'JohnyCash@gmail.com', 'JohnnyCash@gmail.com', '2023-03-04 17:11:04'),
(9285, '', 3, 'updated', 277, 'profile', 0, 'first_name', 'Johny', 'Johnny', '2023-03-04 17:11:04'),
(9286, '', 3, 'updated', 277, 'profile', 0, 'email_add', 'JohnyCash@gmail.com', 'JohnnyCash@gmail.com', '2023-03-04 17:11:04'),
(9287, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 17:12:36'),
(9288, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 17:15:51'),
(9289, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 17:17:16'),
(9290, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 19:27:25'),
(9291, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 19:34:31'),
(9292, '', 299, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 19:35:43'),
(9293, '', 299, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 19:44:07'),
(9294, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 19:44:39'),
(9295, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 21:22:00'),
(9296, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 21:24:12'),
(9297, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-04 21:24:35'),
(9298, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-04 21:25:02'),
(9299, '', 277, 'updated', 277, 'user', 0, '', '', '', '2023-03-04 21:25:24'),
(9300, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 14:46:51'),
(9301, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 14:47:03'),
(9302, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 14:47:11'),
(9303, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 14:47:27'),
(9304, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 14:47:31'),
(9305, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 14:47:46'),
(9306, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:43:28'),
(9307, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 15:43:49'),
(9308, '', 276, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:44:16'),
(9309, '', 276, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 15:47:31'),
(9310, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:47:42'),
(9311, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 15:47:53'),
(9312, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:48:04'),
(9313, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 15:48:13'),
(9314, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:48:24'),
(9315, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 15:48:33'),
(9316, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:49:50'),
(9317, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 15:50:19'),
(9318, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 15:50:21'),
(9319, '', 282, 'updated', 282, 'applicant_info', 0, 'first_name', '', 'Arman', '2023-03-05 16:12:02'),
(9320, '', 282, 'updated', 282, 'applicant_info', 0, 'last_name', '', 'Certificate', '2023-03-05 16:12:02'),
(9321, '', 282, 'updated', 282, 'applicant_info', 0, 'dial_code', '', '+852', '2023-03-05 16:12:02'),
(9322, '', 282, 'updated', 282, 'applicant_info', 0, 'contact_number', '', '66142948', '2023-03-05 16:12:02'),
(9323, '', 282, 'updated', 282, 'applicant_info', 0, 'location', '', 'Hong Kong SAR', '2023-03-05 16:12:02'),
(9324, '', 282, 'updated', 282, 'applicant_info', 0, 'highlights', '', 'Negotiation, Corporate Events, Product Marketing, Public Relations, Event Marketing, and Event Coordination', '2023-03-05 16:12:02'),
(9325, '', 282, 'updated', 282, 'applicant_info', 0, 'doc_image', '', '1678003950_Jacobi 2x2.png', '2023-03-05 16:12:34'),
(9326, '', 282, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:28:20'),
(9327, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 16:29:38'),
(9328, '', 283, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 16:29:43'),
(9329, '', 283, 'updated', 283, 'logout', 0, 'first_name', '', 'Arman', '2023-03-05 16:35:26'),
(9330, '', 283, 'updated', 283, 'logout', 0, 'middle_name', '', 'L', '2023-03-05 16:35:26'),
(9331, '', 283, 'updated', 283, 'logout', 0, 'last_name', '', 'College', '2023-03-05 16:35:26'),
(9332, '', 283, 'updated', 283, 'logout', 0, 'dial_code', '', '+62', '2023-03-05 16:35:26'),
(9333, '', 283, 'updated', 283, 'logout', 0, 'contact_number', '', '9161234567', '2023-03-05 16:35:26'),
(9334, '', 283, 'updated', 283, 'logout', 0, 'location', '', 'Indonesia', '2023-03-05 16:35:26'),
(9335, '', 283, 'updated', 283, 'logout', 0, 'first_login', '1', '0', '2023-03-05 16:35:26'),
(9336, '', 283, 'updated', 283, 'applicant_info', 0, 'highlights', '', 'Experienced Guest Relations Officer with a demonstrated history of working in the hospitality industry. Skilled in Hotel Management, Hospitality Industry, OPERA, Front Office, and Hospitality Management. Strong support professional with a Diploma focused in Rooms Division from Jakarta International Hotels School. \r\n\r\nExperienced Guest Relations Officer with a demonstrated history of working in the hospitality industry. Skilled in Hotel Management, Hospitality Industry, OPERA, Front Office, and H', '2023-03-05 16:39:19'),
(9337, '', 283, 'updated', 283, 'applicant_info', 0, 'doc_image', '', '1678005570_Jacobi 2x2.png', '2023-03-05 16:39:34'),
(9338, '', 283, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:40:00'),
(9339, '', 283, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:40:01'),
(9340, '', 283, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:40:04'),
(9341, '', 283, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:40:08'),
(9342, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 16:40:12'),
(9343, '', 283, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:40:21'),
(9344, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 16:40:24'),
(9345, '', 283, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 16:40:34'),
(9346, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 16:41:29'),
(9347, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 16:41:54'),
(9348, '', 283, 'deleted', 283, 'favorites', 0, '', '', '', '2023-03-05 16:43:07'),
(9349, '', 283, 'deleted', 283, 'favorites', 0, '', '', '', '2023-03-05 16:43:11'),
(9350, '', 283, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 16:43:25'),
(9351, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 16:50:38'),
(9352, '', 275, 'created', 266, 'job_post', 0, '', '', '', '2023-03-05 16:53:46'),
(9353, '', 275, 'created', 267, 'job_post', 0, '', '', '', '2023-03-05 16:57:50'),
(9354, '', 275, 'created', 268, 'job_post', 0, '', '', '', '2023-03-05 17:01:13'),
(9355, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 17:01:36'),
(9356, '', 276, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 17:01:53'),
(9357, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-05 17:05:15'),
(9358, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-05 17:05:18'),
(9359, '', 276, 'created', 269, 'job_post', 0, '', '', '', '2023-03-05 17:09:45'),
(9360, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-05 17:10:48'),
(9361, '', 276, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-05 17:10:51'),
(9362, '', 276, 'created', 270, 'job_post', 0, '', '', '', '2023-03-05 17:15:49'),
(9363, '', 276, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-05 17:18:21'),
(9364, '', 276, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 17:18:35'),
(9365, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 17:18:45'),
(9366, '', 277, 'created', 271, 'job_post', 0, '', '', '', '2023-03-05 17:23:00'),
(9367, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 17:26:05'),
(9368, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 17:26:11'),
(9369, '', 277, 'updated', 90, 'employer', 0, 'doc_image', '', '1678008392_MAC_073_original.jpg', '2023-03-05 17:32:35'),
(9370, '', 277, 'updated', 90, 'employer', 0, 'about', '', 'AN ENCLAVE OF ELEGANCE, STEPS FROM THE CITY’S ACTION\r\nSurrounded by the glamour and buzz of the Cotai Strip, Four Seasons Hotel Macao is a haven of elegant accommodations, Michelin-star dining and innumerable opportunities for relaxation. Lounge by one of our five outdoor pools, pamper yourself with a decadent spa treatment or enjoy afternoon tea in the lounge: No pressure, no hurry and with impeccable service to attend to every need.', '2023-03-05 17:32:35'),
(9371, '', 277, 'updated', 90, 'employer', 0, 'website', '', 'https://www.fourseasons.com/macau/', '2023-03-05 17:32:35'),
(9372, '', 277, 'updated', 90, 'employer', 0, 'address', '', 'ESTRADA DA BAÍA DE N. SENHORA DA ESPERANÇA, S/N, TAIPA, MACAU, CHINA', '2023-03-05 17:32:35'),
(9373, '', 277, 'created', 90, 'employer', 1, '', '', '1678008400_MAC_UGC_abovedacloud9.jpg', '2023-03-05 17:32:35'),
(9374, '', 277, 'created', 90, 'employer', 2, '', '', '1678008407_MAC_044_original.jpg', '2023-03-05 17:32:35'),
(9375, '', 277, 'created', 90, 'employer', 4, '', '', '1678008590_MAC_322_original.jpg', '2023-03-05 17:32:35'),
(9376, '', 277, 'created', 90, 'employer', 5, '', '', '1678008607_MAC_329_original.jpg', '2023-03-05 17:32:35'),
(9377, '', 277, 'created', 90, 'employer', 6, '', '', '1678008616_MAC_268_original.jpg', '2023-03-05 17:32:35'),
(9378, '', 277, 'created', 90, 'employer', 7, '', '', '1678008627_MAC_065_original.jpg', '2023-03-05 17:32:35'),
(9379, '', 277, 'created', 90, 'employer', 8, '', '', '1678008635_MAC_070_original.jpg', '2023-03-05 17:32:35'),
(9380, '', 277, 'created', 90, 'employer', 9, '', '', '1678008695_MAC_073_original.jpg', '2023-03-05 17:32:35'),
(9381, '', 277, 'created', 272, 'job_post', 0, '', '', '', '2023-03-05 17:34:56'),
(9382, '', 277, 'created', 273, 'job_post', 0, '', '', '', '2023-03-05 17:37:09'),
(9383, '', 277, 'created', 274, 'job_post', 0, '', '', '', '2023-03-05 17:39:51'),
(9384, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-05 17:40:13'),
(9385, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-05 17:40:37'),
(9386, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 17:40:43'),
(9387, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:00:24'),
(9388, '', 282, 'updated', 282, 'logout', 0, 'dial_code', '+852', '+84', '2023-03-05 18:03:31'),
(9389, '', 282, 'updated', 282, 'logout', 0, 'contact_number', '66142948', '55558888', '2023-03-05 18:03:31'),
(9390, '', 282, 'updated', 282, 'logout', 0, 'location', 'Hong Kong SAR', 'Vietnam', '2023-03-05 18:03:31'),
(9391, '', 282, 'updated', 282, 'logout', 0, 'first_login', '1', '0', '2023-03-05 18:03:31'),
(9392, '', 282, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:04:21'),
(9393, '', 282, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 18:04:31'),
(9394, '', 282, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 18:04:34'),
(9395, '', 282, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:04:36'),
(9396, '', 282, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:04:49'),
(9397, '', 282, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 18:05:25'),
(9398, '', 282, 'deleted', 282, 'favorites', 0, '', '', '', '2023-03-05 18:05:33'),
(9399, '', 282, 'created', 0, 'favorites', 0, '', '', '', '2023-03-05 18:05:36'),
(9400, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:05:44'),
(9401, '', 283, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:05:51'),
(9402, '', 283, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:08:20'),
(9403, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:09:10'),
(9404, '', 3, 'created', 48, 'department', 0, '', '', '', '2023-03-05 18:10:15'),
(9405, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:10:25'),
(9406, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:10:54'),
(9407, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:11:44'),
(9408, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:12:31'),
(9409, '', 282, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:12:39'),
(9410, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:12:49'),
(9411, '', 283, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:12:53'),
(9412, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:12:58'),
(9413, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:13:07'),
(9414, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:13:15'),
(9415, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:13:28'),
(9416, '', 283, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-05 18:14:03'),
(9417, '', 283, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:14:41'),
(9418, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-05 18:15:16'),
(9419, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-05 18:15:51'),
(9420, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-05 18:16:03'),
(9421, '', 277, 'created', 53, 'job_post_for_intervi', 0, '', '', '', '2023-03-05 18:27:26'),
(9422, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-05 18:30:20'),
(9423, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:00:36'),
(9424, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:02:09'),
(9425, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:02:29'),
(9426, '', 282, 'updated', 282, 'applicant_info', 0, 'highlights', 'Negotiation, Corporate Events, Product Marketing, Public Relations, Event Marketing, and Event Coordination', 'Negotiation, Corporate Events, Product Marketing, Public Relations, Event Marketing, and Event Coordination, Reservations\r\n', '2023-03-06 00:03:32'),
(9427, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:03:38'),
(9428, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:03:50'),
(9429, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:04:19'),
(9430, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:04:34'),
(9431, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:05:12'),
(9432, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:05:24'),
(9433, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:07:30'),
(9434, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:07:43'),
(9435, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:09:45'),
(9436, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:09:56'),
(9437, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:10:26'),
(9438, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:10:38'),
(9439, '', 274, 'updated', 274, 'logout', 0, 'first_name', '', 'Arman', '2023-03-06 00:13:21'),
(9440, '', 274, 'updated', 274, 'logout', 0, 'last_name', '', 'High School', '2023-03-06 00:13:21'),
(9441, '', 274, 'updated', 274, 'logout', 0, 'dial_code', '', '+32', '2023-03-06 00:13:21'),
(9442, '', 274, 'updated', 274, 'logout', 0, 'contact_number', '', '9164054667', '2023-03-06 00:13:21'),
(9443, '', 274, 'updated', 274, 'logout', 0, 'location', '', 'Belgium', '2023-03-06 00:13:21'),
(9444, '', 274, 'updated', 274, 'logout', 0, 'first_login', '1', '0', '2023-03-06 00:13:21'),
(9445, '', 274, 'updated', 274, 'applicant_info', 0, 'highlights', '', 'Banquets and outdoor catering, specialize in European cuisine, french and spanish cooking', '2023-03-06 00:18:07'),
(9446, '', 274, 'updated', 274, 'applicant_info', 0, 'doc_image', '', '1678033102_Jacobi 2x2.png', '2023-03-06 00:19:06'),
(9447, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:20:27'),
(9448, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:20:45'),
(9449, '', 277, 'created', 275, 'job_post', 0, '', '', '', '2023-03-06 00:23:02'),
(9450, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:23:50'),
(9451, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:23:59'),
(9452, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-06 00:24:32'),
(9453, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-06 00:24:47'),
(9454, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:29:29'),
(9455, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:29:40'),
(9456, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:33:55'),
(9457, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-06 00:34:10'),
(9458, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 00:44:34'),
(9459, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-06 10:27:59'),
(9460, '', 280, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-07 14:04:24'),
(9461, '', 278, 'logged in', 0, 'login', 0, '', '', '', '2023-03-07 14:09:23'),
(9462, '', 278, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-07 14:16:16'),
(9463, 'Employee01@gmail.com', 0, 'created', 309, 'user', 0, '', '', '', '2023-03-07 14:18:21'),
(9464, 'Employee01@gmail.com', 0, 'created', 309, 'profile', 0, '', '', '', '2023-03-07 14:18:21'),
(9465, '', 309, 'logged in', 0, 'login', 0, '', '', '', '2023-03-07 14:21:53'),
(9466, '', 309, 'updated', 309, 'logout', 0, 'first_name', '', 'Elmer', '2023-03-07 14:26:57'),
(9467, '', 309, 'updated', 309, 'logout', 0, 'last_name', '', 'Employee01', '2023-03-07 14:26:57'),
(9468, '', 309, 'updated', 309, 'logout', 0, 'dial_code', '', '+358', '2023-03-07 14:26:57'),
(9469, '', 309, 'updated', 309, 'logout', 0, 'contact_number', '', '9388751000', '2023-03-07 14:26:57'),
(9470, '', 309, 'updated', 309, 'logout', 0, 'location', '', 'Japan', '2023-03-07 14:26:57'),
(9471, '', 309, 'updated', 309, 'logout', 0, 'first_login', '1', '0', '2023-03-07 14:26:57'),
(9472, '', 309, 'updated', 309, 'applicant_info', 0, 'resume', '', '1678170934_Resume.pdf', '2023-03-07 14:36:15'),
(9473, '', 309, 'updated', 309, 'applicant_info', 0, 'doc_image', '', '1678171109_Dongs Lakwatsa.png', '2023-03-07 14:41:04'),
(9474, '', 309, 'updated', 309, 'applicant_info', 0, 'highlights', '', 'Provide support to marketing department.\r\nExecute marketing strategy.\r\nWork with marketing team to manage brand and marketing initiatives.\r\nDevelop and execute marketing campaigns.\r\nPerform market and client research.\r\nCreate reports on marketing performance.\r\nMaintain schedules for marketing initiatives.\r\nAssist with social media and website content.\r\nAttend trade shows, company events.\r\nOrganize and manage marketing collateral.\r\nStrong written and verbal communication skills\r\nHigh level of org', '2023-03-07 14:41:04'),
(9475, '', 309, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-07 14:45:51'),
(9476, 'Employee02@gmail.com', 0, 'created', 310, 'user', 0, '', '', '', '2023-03-07 14:46:18'),
(9477, 'Employee02@gmail.com', 0, 'created', 310, 'profile', 0, '', '', '', '2023-03-07 14:46:18'),
(9478, '', 310, 'logged in', 0, 'login', 0, '', '', '', '2023-03-07 14:47:24'),
(9479, '', 310, 'updated', 310, 'applicant_info', 0, 'doc_image', '', '1678172441_Dongs Lakwatsa.png', '2023-03-07 15:00:46'),
(9480, '', 310, 'updated', 310, 'applicant_info', 0, 'first_name', '', 'Elmer', '2023-03-07 15:00:46'),
(9481, '', 310, 'updated', 310, 'applicant_info', 0, 'last_name', '', 'Employee02', '2023-03-07 15:00:46'),
(9482, '', 310, 'updated', 310, 'applicant_info', 0, 'dial_code', '', '+77', '2023-03-07 15:00:46'),
(9483, '', 310, 'updated', 310, 'applicant_info', 0, 'contact_number', '', '9388751000', '2023-03-07 15:00:46'),
(9484, '', 310, 'updated', 310, 'applicant_info', 0, 'location', '', 'Serbia', '2023-03-07 15:00:46'),
(9485, '', 310, 'updated', 310, 'applicant_info', 0, 'highlights', '', 'planning and organising production schedules.\r\nassessing project and resource requirements.\r\nestimating, negotiating and agreeing budgets and timescales with clients and managers.\r\nensuring that health and safety regulations are met.\r\ndetermining quality control standards.\r\n\r\nplanning and organising production schedules.\r\nassessing project and resource requirements.\r\nestimating, negotiating and agreeing budgets and timescales with clients and managers.\r\nensuring that health and safety regulation', '2023-03-07 15:00:46'),
(9486, '', 310, 'updated', 310, 'applicant_info', 0, 'resume', '', '1678172408_Resume.pdf', '2023-03-07 15:00:46'),
(9487, '', 310, 'created', 0, 'favorites', 0, '', '', '', '2023-03-07 15:03:34'),
(9488, '', 275, 'created', 54, 'job_post_for_intervi', 0, '', '', '', '2023-03-07 15:20:12'),
(9489, '', 275, 'created', 276, 'job_post', 0, '', '', '', '2023-03-07 15:27:38'),
(9490, '', 275, 'updated', 276, 'job_post', 0, 'inactive', '1', '0', '2023-03-07 15:28:55'),
(9491, '', 275, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-07 15:36:16'),
(9492, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-07 15:57:20'),
(9493, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-07 16:05:39'),
(9494, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-08 14:37:01'),
(9495, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-08 14:37:37'),
(9496, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-08 14:37:42'),
(9497, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-08 14:37:59'),
(9498, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-08 14:38:03');
INSERT INTO `oaud` (`id`, `username`, `user_id`, `action`, `record_id`, `record_type`, `line`, `record_field`, `record_field_old_value`, `record_field_new_value`, `date_time`) VALUES
(9499, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-08 14:38:15'),
(9500, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-08 14:39:55'),
(9501, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-08 14:49:09'),
(9502, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 13:43:41'),
(9503, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 13:43:54'),
(9504, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 13:44:05'),
(9505, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 13:44:15'),
(9506, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 13:44:23'),
(9507, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 13:44:31'),
(9508, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 13:44:47'),
(9509, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 13:44:54'),
(9510, '', 283, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 13:44:59'),
(9511, '', 283, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 13:45:04'),
(9512, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 13:45:47'),
(9513, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 13:46:07'),
(9514, '', 310, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 14:32:02'),
(9515, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 14:32:20'),
(9516, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 15:19:22'),
(9517, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 15:19:32'),
(9518, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 15:19:39'),
(9519, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 15:19:47'),
(9520, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 22:11:51'),
(9521, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 22:12:04'),
(9522, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 22:12:09'),
(9523, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 22:12:37'),
(9524, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 22:35:39'),
(9525, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 22:36:30'),
(9526, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 22:36:39'),
(9527, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 22:39:47'),
(9528, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-10 22:39:48'),
(9529, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-10 22:40:52'),
(9530, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 13:27:19'),
(9531, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 13:27:29'),
(9532, '', 274, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-11 13:28:13'),
(9533, '', 274, 'created', 0, 'favorites', 0, '', '', '', '2023-03-11 13:29:01'),
(9534, '', 274, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-11 13:29:07'),
(9535, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 13:45:56'),
(9536, 'helloconnie@gmail.com', 0, 'created', 311, 'user', 0, '', '', '', '2023-03-11 13:46:45'),
(9537, 'helloconnie@gmail.com', 0, 'created', 311, 'profile', 0, '', '', '', '2023-03-11 13:46:45'),
(9538, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 14:41:41'),
(9539, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 14:53:18'),
(9540, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 14:53:28'),
(9541, '', 274, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 14:54:29'),
(9542, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 14:59:44'),
(9543, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 14:59:47'),
(9544, '', 274, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 15:09:04'),
(9545, '', 273, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 15:09:09'),
(9546, '', 273, 'updated', 273, 'logout', 0, 'first_name', '', 'Arman', '2023-03-11 15:22:53'),
(9547, '', 273, 'updated', 273, 'logout', 0, 'last_name', '', 'Vocational', '2023-03-11 15:22:53'),
(9548, '', 273, 'updated', 273, 'logout', 0, 'dial_code', '', '+63', '2023-03-11 15:22:53'),
(9549, '', 273, 'updated', 273, 'logout', 0, 'contact_number', '', '9161234567', '2023-03-11 15:22:53'),
(9550, '', 273, 'updated', 273, 'logout', 0, 'location', '', 'Philippines', '2023-03-11 15:22:53'),
(9551, '', 273, 'updated', 273, 'logout', 0, 'first_login', '1', '0', '2023-03-11 15:22:53'),
(9552, '', 272, 'updated', 272, 'logout', 0, 'first_name', '', 'arman', '2023-03-11 15:23:47'),
(9553, '', 272, 'updated', 272, 'logout', 0, 'last_name', '', 'internship', '2023-03-11 15:23:47'),
(9554, '', 272, 'updated', 272, 'logout', 0, 'dial_code', '', '+244', '2023-03-11 15:23:47'),
(9555, '', 272, 'updated', 272, 'logout', 0, 'contact_number', '', '09223687675', '2023-03-11 15:23:47'),
(9556, '', 272, 'updated', 272, 'logout', 0, 'location', '', 'Philippines', '2023-03-11 15:23:47'),
(9557, '', 272, 'updated', 272, 'logout', 0, 'first_login', '1', '0', '2023-03-11 15:23:47'),
(9558, '', 272, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-11 15:24:53'),
(9559, '', 273, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-11 15:27:56'),
(9560, '', 273, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 15:32:29'),
(9561, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 15:33:09'),
(9562, '', 272, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-11 15:34:12'),
(9563, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-11 15:40:57'),
(9564, '', 277, 'created', 55, 'job_post_for_intervi', 0, '', '', '', '2023-03-11 15:44:53'),
(9565, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 15:55:50'),
(9566, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-11 16:02:29'),
(9567, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-11 16:22:26'),
(9568, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-12 09:47:13'),
(9569, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-12 09:51:20'),
(9570, '', 275, 'logged in', 0, 'login', 0, '', '', '', '2023-03-12 09:51:36'),
(9571, '', 275, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-12 09:52:17'),
(9572, '', 275, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-12 09:59:04'),
(9573, '', 282, 'logged in', 0, 'login', 0, '', '', '', '2023-03-12 09:59:15'),
(9574, '', 282, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-12 10:36:09'),
(9575, '', 278, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 15:13:04'),
(9576, '', 278, 'created', 0, 'favorites', 0, '', '', '', '2023-03-21 15:18:53'),
(9577, '', 278, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-21 15:20:15'),
(9578, '', 278, 'created', 0, 'job_post_report', 0, '', '', '', '2023-03-21 15:21:14'),
(9579, '', 278, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 15:24:09'),
(9580, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 15:25:19'),
(9581, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 15:32:00'),
(9582, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 15:36:36'),
(9583, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 15:38:40'),
(9584, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 16:02:04'),
(9585, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 23:13:00'),
(9586, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 23:13:54'),
(9587, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 23:14:16'),
(9588, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 23:15:09'),
(9589, '', 272, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 23:15:23'),
(9590, '', 272, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 23:15:50'),
(9591, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 23:15:54'),
(9592, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 23:16:49'),
(9593, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 23:17:17'),
(9594, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 23:21:33'),
(9595, '', 276, 'logged in', 0, 'login', 0, '', '', '', '2023-03-21 23:21:54'),
(9596, '', 276, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-21 23:29:39'),
(9597, 'gdiwata@thirtyonedigital.net', 0, 'created', 312, 'user', 0, '', '', '', '2023-03-28 11:37:29'),
(9598, 'gdiwata@thirtyonedigital.net', 0, 'created', 312, 'profile', 0, '', '', '', '2023-03-28 11:37:29'),
(9599, 'anne.diwata@gmail.com', 0, 'created', 313, 'user', 0, '', '', '', '2023-03-28 11:43:16'),
(9600, 'anne.diwata@gmail.com', 0, 'created', 313, 'profile', 0, '', '', '', '2023-03-28 11:43:16'),
(9601, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 11:47:47'),
(9602, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 11:49:55'),
(9603, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 11:50:06'),
(9604, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 11:50:34'),
(9605, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 11:51:40'),
(9606, 'aaganon@thirtyonedigital.net', 0, 'created', 381, 'signup', 0, '', '', '', '2023-03-28 11:53:16'),
(9607, '', 3, 'created', 314, 'user', 0, '', '', '', '2023-03-28 11:57:26'),
(9608, '', 3, 'created', 314, 'profile', 0, '', '', '', '2023-03-28 11:57:26'),
(9609, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 11:59:09'),
(9610, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 12:01:31'),
(9611, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 12:01:47'),
(9612, '', 314, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 12:03:59'),
(9613, '', 314, 'updated', 314, 'user', 0, '', '', '', '2023-03-28 12:04:47'),
(9614, '', 314, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 12:04:59'),
(9615, 'wmodern78@gmail.com', 0, 'created', 315, 'user', 0, '', '', '', '2023-03-28 12:05:49'),
(9616, 'wmodern78@gmail.com', 0, 'created', 315, 'profile', 0, '', '', '', '2023-03-28 12:05:49'),
(9617, '', 314, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 12:09:46'),
(9618, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 12:09:52'),
(9619, '', 314, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 12:11:40'),
(9620, '', 314, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 13:30:34'),
(9621, '', 314, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 13:40:37'),
(9622, '', 314, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 13:51:20'),
(9623, '', 314, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 14:09:26'),
(9624, '', 314, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 14:14:16'),
(9625, '', 312, 'updated', 312, 'logout', 0, 'first_name', '', 'Anne', '2023-03-28 14:35:12'),
(9626, '', 312, 'updated', 312, 'logout', 0, 'last_name', '', 'Diwata', '2023-03-28 14:35:12'),
(9627, '', 312, 'updated', 312, 'logout', 0, 'dial_code', '', '+63', '2023-03-28 14:35:12'),
(9628, '', 312, 'updated', 312, 'logout', 0, 'contact_number', '', '9327397084', '2023-03-28 14:35:12'),
(9629, '', 312, 'updated', 312, 'logout', 0, 'location', '', 'Philippines', '2023-03-28 14:35:12'),
(9630, '', 312, 'updated', 312, 'logout', 0, 'first_login', '1', '0', '2023-03-28 14:35:12'),
(9631, '', 314, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 14:37:26'),
(9632, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 14:37:35'),
(9633, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 14:48:32'),
(9634, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 14:48:33'),
(9635, '', 312, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-28 15:10:00'),
(9636, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-28 15:11:33'),
(9637, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-28 15:11:34'),
(9638, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-28 15:11:35'),
(9639, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-28 15:12:15'),
(9640, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-28 15:12:44'),
(9641, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-28 15:12:54'),
(9642, '', 277, 'created', 56, 'job_post_for_intervi', 0, '', '', '', '2023-03-28 15:13:31'),
(9643, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-28 15:14:05'),
(9644, '', 277, 'created', 57, 'job_post_for_intervi', 0, '', '', '', '2023-03-28 15:15:55'),
(9645, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 15:26:13'),
(9646, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 15:31:00'),
(9647, '', 312, 'created', 0, 'favorites', 0, '', '', '', '2023-03-28 15:38:36'),
(9648, '', 312, 'created', 0, 'favorites', 0, '', '', '', '2023-03-28 15:38:38'),
(9649, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-28 15:48:22'),
(9650, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-28 17:49:22'),
(9651, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 09:42:21'),
(9652, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 09:42:32'),
(9653, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 10:58:36'),
(9654, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 10:58:47'),
(9655, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 11:13:58'),
(9656, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 11:14:09'),
(9657, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 11:25:21'),
(9658, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 11:30:59'),
(9659, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 13:55:04'),
(9660, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 13:57:55'),
(9661, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 13:58:16'),
(9662, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 13:58:24'),
(9663, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 13:58:29'),
(9664, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 13:58:33'),
(9665, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 13:58:53'),
(9666, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 13:59:15'),
(9667, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 13:59:20'),
(9668, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 13:59:24'),
(9669, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 13:59:30'),
(9670, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 13:59:33'),
(9671, '', 312, 'created', 0, 'favorites', 0, '', '', '', '2023-03-29 13:59:41'),
(9672, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:00:01'),
(9673, 'donarc@gmail.com', 0, 'created', 382, 'signup', 0, '', '', '', '2023-03-29 14:01:23'),
(9674, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:02:56'),
(9675, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:04:12'),
(9676, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:04:40'),
(9677, '', 3, 'created', 316, 'user', 0, '', '', '', '2023-03-29 14:05:45'),
(9678, '', 3, 'created', 316, 'profile', 0, '', '', '', '2023-03-29 14:05:45'),
(9679, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:06:02'),
(9680, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:08:00'),
(9681, '', 316, 'updated', 316, 'user', 0, '', '', '', '2023-03-29 14:08:27'),
(9682, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:08:34'),
(9683, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:08:42'),
(9684, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:08:51'),
(9685, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:12:24'),
(9686, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:12:48'),
(9687, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:13:57'),
(9688, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:14:04'),
(9689, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:14:05'),
(9690, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:14:24'),
(9691, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:17:08'),
(9692, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:19:11'),
(9693, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:19:44'),
(9694, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:19:49'),
(9695, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:31:51'),
(9696, '', 277, 'created', 52, 'perks_and_benefits', 0, '', '', '', '2023-03-29 14:32:13'),
(9697, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:32:43'),
(9698, '', 277, 'created', 277, 'job_post', 0, '', '', '', '2023-03-29 14:34:20'),
(9699, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:36:43'),
(9700, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:36:46'),
(9701, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:37:41'),
(9702, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:37:49'),
(9703, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:38:36'),
(9704, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:38:41'),
(9705, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:46:19'),
(9706, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:46:38'),
(9707, '', 316, 'updated', 95, 'employer', 0, 'about', '', 'Very nice company', '2023-03-29 14:47:32'),
(9708, '', 316, 'updated', 95, 'employer', 0, 'website', '', 'www.31dtest.com', '2023-03-29 14:47:32'),
(9709, '', 316, 'updated', 95, 'employer', 0, 'address', '', 'eastwood 1800 building', '2023-03-29 14:47:32'),
(9710, '', 316, 'updated', 95, 'employer', 0, 'doc_image', '', '1680072498_Free-Logo.png', '2023-03-29 14:48:27'),
(9711, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:48:42'),
(9712, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:48:45'),
(9713, '', 316, 'updated', 95, 'employer', 0, 'company_name', '31DTest', '31DTest_test', '2023-03-29 14:49:29'),
(9714, '', 316, 'updated', 95, 'employer', 0, 'about', 'Very nice company', 'Very nice company here!', '2023-03-29 14:51:05'),
(9715, '', 316, 'updated', 95, 'employer', 0, 'website', 'www.31dtest.com', 'www.google.com', '2023-03-29 14:51:40'),
(9716, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:51:59'),
(9717, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:52:02'),
(9718, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:52:43'),
(9719, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:52:47'),
(9720, '', 313, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:53:29'),
(9721, '', 316, 'updated', 95, 'employer', 0, 'contact_number', '9171111111', '9154905847', '2023-03-29 14:55:00'),
(9722, '', 316, 'updated', 95, 'employer', 0, 'location', 'Philippines', 'Albania', '2023-03-29 14:55:00'),
(9723, '', 316, 'updated', 95, 'employer', 0, 'industry', '16', '13', '2023-03-29 14:55:00'),
(9724, '', 316, 'created', 95, 'employer', 1, '', '', '1680072871_Free-Logo.png', '2023-03-29 14:55:00'),
(9725, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:55:54'),
(9726, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 14:57:32'),
(9727, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 14:57:55'),
(9728, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:05:01'),
(9729, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:05:06'),
(9730, '', 312, 'updated', 312, 'applicant_info', 0, 'first_name', 'Anne', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', '2023-03-29 15:09:12'),
(9731, '', 312, 'updated', 312, 'applicant_info', 0, 'first_name', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343', '2023-03-29 15:09:24'),
(9732, '', 312, 'updated', 312, 'applicant_info', 0, 'first_name', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343!', '2023-03-29 15:10:01'),
(9733, '', 312, 'updated', 312, 'applicant_info', 0, 'middle_name', '', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343!', '2023-03-29 15:10:46'),
(9734, '', 312, 'updated', 312, 'applicant_info', 0, 'last_name', 'Diwata', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343!', '2023-03-29 15:10:46'),
(9735, '', 312, 'updated', 312, 'applicant_info', 0, 'first_name', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343!', 'Anne', '2023-03-29 15:11:36'),
(9736, '', 312, 'updated', 312, 'applicant_info', 0, 'middle_name', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343!', '', '2023-03-29 15:11:36'),
(9737, '', 312, 'updated', 312, 'applicant_info', 0, 'last_name', 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffs4343!', 'Diwata', '2023-03-29 15:11:36'),
(9738, '', 312, 'updated', 312, 'applicant_info', 0, 'internship', '0', '1', '2023-03-29 15:11:36'),
(9739, '', 312, 'updated', 312, 'applicant_info', 0, 'email_add', 'gdiwata@thirtyonedigital.net', 'gdiwata@thirtyone', '2023-03-29 15:12:23'),
(9740, '', 312, 'updated', 312, 'applicant_info', 0, 'email_add', 'gdiwata@thirtyone', 'gdiwata@thirtyonedigital.net', '2023-03-29 15:12:34'),
(9741, '', 312, 'updated', 312, 'applicant_info', 0, 'highlights', '', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenati', '2023-03-29 15:14:02'),
(9742, '', 312, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-29 15:19:16'),
(9743, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:21:40'),
(9744, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:21:43'),
(9745, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:22:06'),
(9746, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:22:08'),
(9747, '', 316, 'created', 278, 'job_post', 0, '', '', '', '2023-03-29 15:23:44'),
(9748, '', 312, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-29 15:24:14'),
(9749, '', 316, 'created', 58, 'job_post_for_intervi', 0, '', '', '', '2023-03-29 15:25:18'),
(9750, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:34:20'),
(9751, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:34:24'),
(9752, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:39:12'),
(9753, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:39:15'),
(9754, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:39:35'),
(9755, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:39:38'),
(9756, '', 312, 'updated', 312, 'applicant_info', 0, 'resume', '', '1680075570_MT.Dew (PRD) - 2.20.23.pdf', '2023-03-29 15:39:39'),
(9757, '', 312, 'updated', 312, 'applicant_info', 0, 'resume', '1680075570_MT.Dew (PRD) - 2.20.23.pdf', '1680075755_Dominic - Certificate of Completion and Invoice.pdf', '2023-03-29 15:43:58'),
(9758, '', 312, 'created', 0, 'favorites', 0, '', '', '', '2023-03-29 15:47:26'),
(9759, '', 312, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-29 15:49:04'),
(9760, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 15:51:37'),
(9761, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 15:51:40'),
(9762, '', 312, 'created', 0, 'favorites', 0, '', '', '', '2023-03-29 15:56:29'),
(9763, '', 277, 'created', 279, 'job_post', 0, '', '', '', '2023-03-29 15:59:45'),
(9764, '', 277, 'updated', 279, 'job_post', 0, 'job_title', 'Cheff', 'Chef', '2023-03-29 16:00:25'),
(9765, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-29 16:01:17'),
(9766, '', 312, 'deleted', 312, 'favorites', 0, '', '', '', '2023-03-29 16:04:02'),
(9767, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:10:37'),
(9768, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:10:37'),
(9769, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:10:48'),
(9770, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:10:48'),
(9771, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:10:52'),
(9772, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:11:06'),
(9773, '', 312, 'updated', 312, 'applicant_info', 0, 'location', 'Philippines', 'Albania', '2023-03-29 16:19:32'),
(9774, '', 277, 'updated', 56, 'job_post', 0, 'status', 'pending', 'cancelled', '2023-03-29 16:21:03'),
(9775, '', 277, 'updated', 55, 'job_post', 0, 'status', 'pending', 'cancelled', '2023-03-29 16:21:56'),
(9776, '', 277, 'updated', 57, 'job_post_for_intervi', 0, 'location', 'Eastwood', 'Eastwood QC', '2023-03-29 16:23:37'),
(9777, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 16:24:13'),
(9778, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 16:24:19'),
(9779, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 16:25:36'),
(9780, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 16:25:45'),
(9781, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 16:25:54'),
(9782, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 16:27:04'),
(9783, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_a', '1660136063_img-01.png', '1680078580_istockphoto-1225091693-170667a.jpg', '2023-03-29 16:30:10'),
(9784, '', 3, 'updated', 5, 'homepage_banner', 0, 'description_a', 'Get instant access to numerous job listings in the hospitality and travel industries. Create your profile and let Hoteleers help you find opportunities that match your skills and experiences. ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenati', '2023-03-29 16:30:56'),
(9785, '', 3, 'updated', 5, 'homepage_banner', 0, 'description_a', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenati', 'Get instant access to numerous job listings in the hospitality and travel industries. Create your profile and let Hoteleers help you find opportunities that match your skills and experiences. ', '2023-03-29 16:32:14'),
(9786, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_a', '1680078580_istockphoto-1225091693-170667a.jpg', '', '2023-03-29 16:35:57'),
(9787, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_a', '', '1680079164_shutterstock_654521416-1.jpg', '2023-03-29 16:39:30'),
(9788, '', 277, 'created', 280, 'job_post', 0, '', '', '', '2023-03-29 16:40:05'),
(9789, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 16:40:28'),
(9790, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 16:40:37'),
(9791, '', 277, 'updated', 279, 'job_post', 0, 'job_title', 'Chef', 'Chefs', '2023-03-29 16:40:58'),
(9792, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_c', '1671427390_new-section-image.jpg', '1680079205_istockphoto-1225091693-170667a.jpg', '2023-03-29 16:41:06'),
(9793, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_d', '1669634081_trendingdesktopbg.png', '1680079235_istockphoto-1225091693-170667a.jpg', '2023-03-29 16:41:06'),
(9794, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_b', '1669634093_homebannerb.png', '1680079256_istockphoto-1225091693-170667a.jpg', '2023-03-29 16:41:06'),
(9795, '', 277, 'deleted', 280, 'job_post', 0, '', '', '', '2023-03-29 16:41:15'),
(9796, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_c', '1680079205_istockphoto-1225091693-170667a.jpg', '1680079300_1671427390_new-section-image.jpg', '2023-03-29 16:42:22'),
(9797, '', 3, 'updated', 5, 'homepage_banner', 0, 'description_c', 'Looking for your first job? An internship? A new career? Or moving up?  Hoteleers is specially designed to make online job hunting fast, easy and convenient for you. We\'ve done all the work to keep it simple so you can focus on the things you need to do as a jobseeker: create a profile and apply for the job you want! ', 'Looking for your first job? An internship? A new career? Or moving up?  Hoteleers is specially designed to make online job hunting fast, easy and convenient for you. We\'ve done all the work to keep it simple so you can focus on the things you need to do as a jobseeker: create a profile and apply for the job you want!!', '2023-03-29 16:42:22'),
(9798, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_d', '1680079235_istockphoto-1225091693-170667a.jpg', '1680079308_1669634081_trendingdesktopbg.png', '2023-03-29 16:42:22'),
(9799, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_b', '1680079256_istockphoto-1225091693-170667a.jpg', '1680079323_1669634093_homebannerb.png', '2023-03-29 16:42:22'),
(9800, '', 3, 'updated', 5, 'homepage_banner', 0, 'title_b', 'that next adventure?', 'that next adventure??', '2023-03-29 16:42:22'),
(9801, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-29 16:57:24'),
(9802, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 17:00:54'),
(9803, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 17:00:55'),
(9804, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 17:00:56'),
(9805, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-29 17:04:50'),
(9806, '', 277, 'deleted', 277, 'employer_saved_appli', 0, '', '', '', '2023-03-29 17:04:56'),
(9807, '', 277, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-03-29 17:06:30'),
(9808, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 17:16:04'),
(9809, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 17:16:15'),
(9810, '', 277, 'created', 281, 'job_post', 0, '', '', '', '2023-03-29 17:16:48'),
(9811, '', 312, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-29 17:17:28'),
(9812, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-29 17:18:08'),
(9813, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 17:19:32'),
(9814, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 17:19:43'),
(9815, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 17:19:44'),
(9816, '', 277, 'created', 282, 'job_post', 0, '', '', '', '2023-03-29 17:22:43'),
(9817, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 17:23:06'),
(9818, '', 312, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-29 17:23:25'),
(9819, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-29 17:24:29'),
(9820, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-29 17:24:29'),
(9821, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-29 17:29:35'),
(9822, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 12:24:24'),
(9823, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 13:13:32'),
(9824, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 13:15:55'),
(9825, '', 3, 'created', 523, 'education', 0, '', '', '', '2023-03-30 13:20:32'),
(9826, '', 3, 'created', 524, 'education', 0, '', '', '', '2023-03-30 13:20:32'),
(9827, '', 3, 'deleted', 524, 'education', 0, '', '', '', '2023-03-30 13:22:19'),
(9828, '', 3, 'deleted', 523, 'education', 0, '', '', '', '2023-03-30 13:22:21'),
(9829, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-30 13:23:14'),
(9830, '', 277, 'created', 0, 'usr_job_invite', 0, '', '', '', '2023-03-30 13:23:18'),
(9831, '', 313, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 13:28:04'),
(9832, '', 313, 'updated', 313, 'logout', 0, 'first_name', '', 'Diwata', '2023-03-30 13:29:53'),
(9833, '', 313, 'updated', 313, 'logout', 0, 'middle_name', '', 'Arc', '2023-03-30 13:29:53'),
(9834, '', 313, 'updated', 313, 'logout', 0, 'last_name', '', 'Anne', '2023-03-30 13:29:53'),
(9835, '', 313, 'updated', 313, 'logout', 0, 'dial_code', '', '+63', '2023-03-30 13:29:53'),
(9836, '', 313, 'updated', 313, 'logout', 0, 'contact_number', '', '9154905846', '2023-03-30 13:29:53'),
(9837, '', 313, 'updated', 313, 'logout', 0, 'location', '', 'Philippines', '2023-03-30 13:29:53'),
(9838, '', 313, 'updated', 313, 'logout', 0, 'first_login', '1', '0', '2023-03-30 13:29:53'),
(9839, '', 313, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-03-30 13:30:16'),
(9840, '', 277, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-03-30 13:31:15'),
(9841, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 13:54:14'),
(9842, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 13:54:32'),
(9843, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 14:04:23'),
(9844, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 14:04:28'),
(9845, '', 316, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 14:05:21'),
(9846, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 14:05:23'),
(9847, '', 316, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 14:10:42'),
(9848, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 14:11:51'),
(9849, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 14:11:55'),
(9850, '', 277, 'created', 59, 'job_post_for_intervi', 0, '', '', '', '2023-03-30 14:15:48'),
(9851, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 14:21:09'),
(9852, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 14:30:30'),
(9853, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 15:02:56'),
(9854, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 15:13:10'),
(9855, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 15:25:28'),
(9856, '', 312, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 15:47:43'),
(9857, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 15:49:54'),
(9858, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 15:55:05'),
(9859, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-30 17:15:12'),
(9860, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-30 18:00:52'),
(9861, 'thirtyone@gmail.com', 0, 'created', 383, 'signup', 0, '', '', '', '2023-03-31 14:44:21'),
(9862, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-03-31 14:44:31'),
(9863, '', 3, 'created', 317, 'user', 0, '', '', '', '2023-03-31 14:46:24'),
(9864, '', 3, 'created', 317, 'profile', 0, '', '', '', '2023-03-31 14:46:24'),
(9865, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-31 15:15:10'),
(9866, '', 317, 'logged in', 0, 'login', 0, '', '', '', '2023-03-31 15:15:37'),
(9867, '', 317, 'updated', 317, 'user', 0, '', '', '', '2023-03-31 15:16:40'),
(9868, '', 317, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-31 15:17:47'),
(9869, '', 278, 'logged in', 0, 'login', 0, '', '', '', '2023-03-31 15:18:12'),
(9870, '', 278, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-31 15:18:28'),
(9871, '', 278, 'logged in', 0, 'login', 0, '', '', '', '2023-03-31 16:27:55'),
(9872, '', 278, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-31 16:39:40'),
(9873, '', 317, 'logged in', 0, 'login', 0, '', '', '', '2023-03-31 16:41:29'),
(9874, '', 317, 'created', 283, 'job_post', 0, '', '', '', '2023-03-31 16:44:42'),
(9875, '', 317, 'created', 284, 'job_post', 0, '', '', '', '2023-03-31 16:48:00'),
(9876, '', 317, 'logged out', 0, 'logout', 0, '', '', '', '2023-03-31 17:08:12'),
(9877, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-04 20:53:53'),
(9878, '', 312, 'logged in', 0, 'login', 0, '', '', '', '2023-04-04 20:53:56'),
(9879, '', 317, 'logged in', 0, 'login', 0, '', '', '', '2023-04-12 14:48:07'),
(9880, '', 317, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-12 14:48:14'),
(9881, 'thirtyoned@gmail.com', 0, 'created', 318, 'user', 0, '', '', '', '2023-04-12 14:49:12'),
(9882, 'thirtyoned@gmail.com', 0, 'created', 318, 'profile', 0, '', '', '', '2023-04-12 14:49:12'),
(9883, 'thirtyone.d@gmail.com', 0, 'created', 319, 'user', 0, '', '', '', '2023-04-12 16:03:14'),
(9884, 'thirtyone.d@gmail.com', 0, 'created', 319, 'profile', 0, '', '', '', '2023-04-12 16:03:14'),
(9885, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-14 10:58:25'),
(9886, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-14 10:58:34'),
(9887, 'Test@testemail.com', 0, 'created', 320, 'user', 0, '', '', '', '2023-04-14 15:15:59'),
(9888, 'Test@testemail.com', 0, 'created', 320, 'profile', 0, '', '', '', '2023-04-14 15:15:59'),
(9889, 'JohnnyDepp@gmail.com', 0, 'created', 384, 'signup', 0, '', '', '', '2023-04-14 20:15:14'),
(9890, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-14 20:16:24'),
(9891, '', 3, 'created', 321, 'user', 0, '', '', '', '2023-04-14 20:23:53'),
(9892, '', 3, 'created', 321, 'profile', 0, '', '', '', '2023-04-14 20:23:53'),
(9893, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-14 20:33:54'),
(9894, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-14 20:34:50'),
(9895, '', 321, 'updated', 321, 'user', 0, '', '', '', '2023-04-14 20:36:43'),
(9896, '', 321, 'updated', 97, 'employer', 0, 'about', '', 'A vibrant city filled with exotic food, stunning temples, exciting cityscapes and endless shopping. Banyan Tree Bangkok is conveniently located in the Sathon/Silom area. The city’s only 5-star all-suite hotel offers Bangkok’s largest luxurious accommodation, with world-class dining experiences, meeting and event spaces, and an award-winning spa.', '2023-04-14 20:57:50'),
(9897, '', 321, 'updated', 97, 'employer', 0, 'website', '', 'https://www.banyantree.com/thailand/bangkok', '2023-04-14 20:57:50'),
(9898, '', 321, 'updated', 97, 'employer', 0, 'address', '', '21/100 South Sathorn Road, Sathorn, Bangkok 10120, Thailand', '2023-04-14 20:57:50'),
(9899, '', 321, 'created', 97, 'employer', 1, '', '', '1681477056_10-best-hotels-in-davao-city-philippines-near-attractions-amp-airport-family-friendly-with-pool-1.jpg', '2023-04-14 20:57:50'),
(9900, '', 321, 'created', 97, 'employer', 2, '', '', '1681477056_135fdbfed8e147ae9c51cdbcd64869d7_MEDIUM!_!5fcd30576e758a31c2b90981c3f14d3f.jpg', '2023-04-14 20:57:50'),
(9901, '', 321, 'updated', 97, 'employer', 0, 'doc_image', '', '1681477372_CC631F0F0489A7D699B923094E945AAA1BDE3C421664743000200.jpg', '2023-04-14 21:03:12'),
(9902, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-14 21:41:29'),
(9903, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-14 21:41:31'),
(9904, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-14 21:41:33'),
(9905, '', 321, 'created', 53, 'perks_and_benefits', 0, '', '', '', '2023-04-14 21:43:18'),
(9906, '', 321, 'created', 54, 'perks_and_benefits', 0, '', '', '', '2023-04-14 21:45:16'),
(9907, '', 321, 'created', 55, 'perks_and_benefits', 0, '', '', '', '2023-04-14 21:45:16'),
(9908, '', 321, 'created', 56, 'perks_and_benefits', 0, '', '', '', '2023-04-14 21:45:16'),
(9909, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-14 21:45:27'),
(9910, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-14 22:02:51'),
(9911, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-18 18:26:49'),
(9912, '', 321, 'created', 285, 'job_post', 0, '', '', '', '2023-04-18 18:29:30'),
(9913, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-18 18:50:02'),
(9914, '', 321, 'created', 286, 'job_post', 0, '', '', '', '2023-04-18 18:57:49'),
(9915, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-18 19:27:42'),
(9916, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-18 19:35:06'),
(9917, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-18 19:47:52'),
(9918, '', 277, 'logged in', 0, 'login', 0, '', '', '', '2023-04-19 11:14:24'),
(9919, '', 277, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-19 11:14:34'),
(9920, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-19 11:14:38'),
(9921, '', 3, 'updated', 5, 'homepage_banner', 0, 'doc_image_a', '1680079164_shutterstock_654521416-1.jpg', '1681874244_new.png', '2023-04-19 11:17:32'),
(9922, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-19 23:43:26'),
(9923, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-19 23:43:31'),
(9924, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-19 23:43:50'),
(9925, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-20 15:34:38'),
(9926, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-20 15:41:24'),
(9927, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-20 15:41:44'),
(9928, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-20 16:03:05'),
(9929, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-20 21:04:00'),
(9930, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-20 21:04:16'),
(9931, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 08:38:49'),
(9932, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 08:38:57'),
(9933, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:18:22'),
(9934, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 09:18:27'),
(9935, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:18:49'),
(9936, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 09:19:19'),
(9937, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:24:15'),
(9938, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 09:24:22'),
(9939, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:26:34'),
(9940, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 09:51:39'),
(9941, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:55:32'),
(9942, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 09:55:39'),
(9943, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:55:50'),
(9944, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 09:58:19'),
(9945, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 09:58:33'),
(9946, '', 321, 'created', 287, 'job_post', 0, '', '', '', '2023-04-21 10:01:26'),
(9947, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:05:56'),
(9948, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:06:00'),
(9949, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:06:17'),
(9950, 'johnpaulladao106@gmail.com', 0, 'created', 322, 'user', 0, '', '', '', '2023-04-21 10:09:56'),
(9951, 'johnpaulladao106@gmail.com', 0, 'created', 322, 'profile', 0, '', '', '', '2023-04-21 10:09:56'),
(9952, '', 322, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:11:23'),
(9953, '', 322, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:13:09'),
(9954, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:13:26'),
(9955, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:13:53'),
(9956, '', 322, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:14:02'),
(9957, '', 322, 'updated', 322, 'logout', 0, 'first_name', '', 'John', '2023-04-21 10:16:08'),
(9958, '', 322, 'updated', 322, 'logout', 0, 'last_name', '', 'Ladao', '2023-04-21 10:16:08'),
(9959, '', 322, 'updated', 322, 'logout', 0, 'dial_code', '', '+63', '2023-04-21 10:16:08'),
(9960, '', 322, 'updated', 322, 'logout', 0, 'contact_number', '', '9171551303', '2023-04-21 10:16:08'),
(9961, '', 322, 'updated', 322, 'logout', 0, 'location', '', 'Philippines', '2023-04-21 10:16:08'),
(9962, '', 322, 'updated', 322, 'logout', 0, 'first_login', '1', '0', '2023-04-21 10:16:08'),
(9963, '', 322, 'created', 0, 'favorites', 0, '', '', '', '2023-04-21 10:16:31'),
(9964, '', 322, 'created', 0, 'job_post_applicant', 0, '', '', '', '2023-04-21 10:16:43'),
(9965, '', 322, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:16:58'),
(9966, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:17:08'),
(9967, '', 321, 'created', 0, 'job_post_move_to', 0, '', '', '', '2023-04-21 10:18:34'),
(9968, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:24:00'),
(9969, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:24:31'),
(9970, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-21 10:24:42'),
(9971, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-21 10:24:57'),
(9972, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:29:57'),
(9973, '', 322, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:30:06'),
(9974, '', 322, 'updated', 322, 'applicant_info', 0, 'resume', '', '1682044233_SB2 - Integrations Setup.pdf', '2023-04-21 10:30:48'),
(9975, '', 322, 'updated', 322, 'applicant_info', 0, 'doc_image', '', '1682044288_Error printing sales contract.png', '2023-04-21 10:31:33'),
(9976, '', 322, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:32:45'),
(9977, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:33:12'),
(9978, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:35:20'),
(9979, '', 321, 'logged in', 0, 'login', 0, '', '', '', '2023-04-21 10:35:28'),
(9980, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-21 10:37:10'),
(9981, '', 321, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2023-04-21 10:37:12'),
(9982, '', 321, 'logged out', 0, 'logout', 0, '', '', '', '2023-04-21 10:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `ocurrency`
--

DROP TABLE IF EXISTS `ocurrency`;
CREATE TABLE `ocurrency` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'department',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(46, 'department', 'Transportation', 0, '2022-06-25 11:50:21'),
(48, 'department', 'Learning and Development', 0, '2023-03-05 10:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `oeducation`
--

DROP TABLE IF EXISTS `oeducation`;
CREATE TABLE `oeducation` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'education',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `level` int(11) NOT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `record_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oemployer`
--

DROP TABLE IF EXISTS `oemployer`;
CREATE TABLE `oemployer` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'employer',
  `doc_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dial_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `industry` int(11) NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `other_notes` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `signup` int(11) NOT NULL,
  `deactivated` tinyint(1) NOT NULL DEFAULT 0,
  `paused` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oemployer`
--

INSERT INTO `oemployer` (`id`, `type`, `doc_image`, `company_name`, `about`, `dial_code`, `contact_number`, `website`, `email`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `industry`, `start_date`, `start_time`, `end_date`, `other_notes`, `end_time`, `inactive`, `date_created`, `status`, `signup`, `deactivated`, `paused`, `address`) VALUES
(88, 'employer', '1677840824_new world makati.jpg', 'New World Makati Hotel, Manila', 'NEWWORLDMAKATIHOTEL\r\nEvery one of us at the luxury, 5-star New World Makati Hotel in Manila wants to make your stay with us a pleasure, whether you’re here on business or leisure … or even to get married.\r\n\r\nWe make work a little easier with complimentary Internet service in your room and throughout the hotel, flexible venues for meetings and conferences of all sizes, and a business center that can handle all your needs, from office supplies and photocopying to secretarial support.\r\n\r\nWe make holidays more enjoyable – if that’s the word for a good workout – with our no-excuses, always-open fitness center, relaxing spa, sauna room and swimming pool, which is accompanied by personal service at the drop of a sunhat.\r\n\r\nGreat food and shopping are a pleasure for everyone, so you’ll love the wide variety of authentic local dishes and delicious international fare at our many dining venues, and wonderful shopping at the nearby Greenbelt and Glorietta Lifestyle complexes, and the many local boutiques just a few steps away.\r\n\r\nAnd we love weddings. You won’t believe that everything you want in a day can really happen – until you talk to us.\r\n\r\nWhen what you want most is a luxury, 5-star stay in the heart of Makati, let us show you how wonderful life can be.', '+63', '9161234567', 'https://manila.newworldhotels.com/en/', 'JohnyUtah@gmail.com', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 26, '3/3/2023', '3:42 PM', '3/3/2024', 'Test Internal Notes', '3:42 PM', 0, '2023-03-03 07:42:56', 1, 377, 0, 0, 'Esperanza Street corner Makati Avenue, Ayala Center, Makati City 1228, Philippines'),
(89, 'employer', '1677900523_3831843412d.jpg', 'Dusit Thani Manila', 'Luxury, heritage, and comfort combine gracefully at Dusit Thani Manila, a 5-star hotel in Makati.\r\n\r\nSituated in the heart of the financial capital, the five-star hotel in Makati boasts easy access to all the business, entertainment, and recreational options Makati has to offer.\r\n\r\nA choice of 500 exquisite rooms and suites in our Makati city hotel embodies a delightful blend of Filipino geniality and gracious Thai hospitality, while world-class dining destinations and full-service facilities ensure business and leisure guests are completely at ease.\r\n\r\n', '+63', '9161234568', 'https://www.dusit.com/dusitthani-manila/', 'JohnyBravo@gmail.com', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 26, '3/3/2023', '3:44 PM', '3/3/2025', '', '3:44 PM', 0, '2023-03-03 07:44:12', 1, 378, 0, 0, 'Ayala Centre, 1223 Makati City Metro Manila, Philippines'),
(90, 'employer', '1678008392_MAC_073_original.jpg', 'Four Season Hotel Macao, Cotai Strip', 'AN ENCLAVE OF ELEGANCE, STEPS FROM THE CITY’S ACTION\r\nSurrounded by the glamour and buzz of the Cotai Strip, Four Seasons Hotel Macao is a haven of elegant accommodations, Michelin-star dining and innumerable opportunities for relaxation. Lounge by one of our five outdoor pools, pamper yourself with a decadent spa treatment or enjoy afternoon tea in the lounge: No pressure, no hurry and with impeccable service to attend to every need.', '+853', '66142946', 'https://www.fourseasons.com/macau/', 'JohnyCash@gmail.com', 'Macau SAR', '0.0000000', '0.0000000', '', '', 'Macau SAR', 26, '3/3/2023', '3:44 PM', '3/3/2026', '', '3:44 PM', 0, '2023-03-03 07:44:44', 1, 379, 0, 0, 'ESTRADA DA BAÍA DE N. SENHORA DA ESPERANÇA, S/N, TAIPA, MACAU, CHINA'),
(91, 'employer', '', 'Thirtyonedigital', '', '+63', '9388751000', '', '31d.employer@gmail.com', 'South Korea', '0.0000000', '0.0000000', '', '', 'South Korea', 21, '3/3/2023', '4:18 PM', '3/3/2024', '', '4:18 PM', 0, '2023-03-03 08:18:17', 1, 380, 0, 0, ''),
(92, 'employer', '', 'Four Seasons Hotel Macao, Cotai Strip', '', '+853', '66142945', '', 'JohnnyCash@gmail.com', 'Macau SAR', '0.0000000', '0.0000000', '', '', 'Macau SAR', 26, '3/4/2023', '12:11 AM', '3/4/2025', '', '12:11 AM', 0, '2023-03-03 16:11:43', 1, 376, 0, 0, ''),
(93, 'employer', '', 'IT Group Inc', '', '+63', '9171551303', '', 'dexmanreza@gmail.com', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 21, '3/4/2023', '12:13 AM', '3/4/2024', '', '12:13 AM', 0, '2023-03-03 16:13:51', 1, 373, 0, 0, ''),
(94, 'employer', '', '31D', '', '+63', '9154905847', '', 'aaganon@thirtyonedigital.net', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 26, '3/27/2023', '11:54 AM', '3/31/2023', '', '11:54 AM', 0, '2023-03-28 03:55:03', 1, 381, 0, 0, ''),
(95, 'employer', '1680072498_Free-Logo.png', '31DTest_test', 'Very nice company here!', '+63', '9154905847', 'www.google.com', 'donarc@gmail.com', 'Albania', '0.0000000', '0.0000000', '', '', 'Philippines', 13, '3/29/2023', '2:03 PM', '4/29/2023', '', '2:03 PM', 0, '2023-03-29 06:03:56', 1, 382, 0, 0, 'eastwood 1800 building'),
(96, 'employer', '', 'Thirty One', '', '+358', '9388751000', '', 'thirtyone@gmail.com', 'Djibouti', '0.0000000', '0.0000000', '', '', 'Djibouti', 21, '3/31/2023', '2:44 PM', '4/19/2023', '', '2:44 PM', 0, '2023-03-31 06:44:50', 1, 383, 0, 0, ''),
(97, 'employer', '1681477372_CC631F0F0489A7D699B923094E945AAA1BDE3C421664743000200.jpg', 'Banyan Tree Bangkok ', 'A vibrant city filled with exotic food, stunning temples, exciting cityscapes and endless shopping. Banyan Tree Bangkok is conveniently located in the Sathon/Silom area. The city’s only 5-star all-suite hotel offers Bangkok’s largest luxurious accommodation, with world-class dining experiences, meeting and event spaces, and an award-winning spa.', '+63', '9662569224', 'https://www.banyantree.com/thailand/bangkok', 'JohnnyDepp@gmail.com', 'Thailand', '0.0000000', '0.0000000', '', '', 'Thailand', 26, '4/14/2023', '8:16 PM', '4/13/2024', 'Test', '8:16 PM', 0, '2023-04-14 12:17:30', 1, 384, 0, 0, '21/100 South Sathorn Road, Sathorn, Bangkok 10120, Thailand');

-- --------------------------------------------------------

--
-- Table structure for table `oemployer_history`
--

DROP TABLE IF EXISTS `oemployer_history`;
CREATE TABLE `oemployer_history` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'employer_history',
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oemployer_history`
--

INSERT INTO `oemployer_history` (`id`, `type`, `status`, `start_date`, `end_date`, `date_created`) VALUES
(88, 'employer_history', 'activated', '', '', '2023-03-03 07:42:56'),
(89, 'employer_history', 'activated', '', '', '2023-03-03 07:44:12'),
(90, 'employer_history', 'activated', '', '', '2023-03-03 07:44:44'),
(91, 'employer_history', 'activated', '', '', '2023-03-03 08:18:17'),
(92, 'employer_history', 'activated', '', '', '2023-03-03 16:11:43'),
(93, 'employer_history', 'activated', '', '', '2023-03-03 16:13:51'),
(91, 'employer_history', 'deactivated', '', '', '2023-03-21 07:29:48'),
(91, 'employer_history', 'activated', '', '', '2023-03-21 07:36:53'),
(94, 'employer_history', 'activated', '', '', '2023-03-28 03:55:03'),
(94, 'employer_history', 'paused', '', '', '2023-03-29 03:21:19'),
(94, 'employer_history', 'deactivated', '', '', '2023-03-29 03:22:13'),
(94, 'employer_history', 'activated', '', '', '2023-03-29 05:58:07'),
(95, 'employer_history', 'activated', '', '', '2023-03-29 06:03:56'),
(96, 'employer_history', 'activated', '', '', '2023-03-31 06:44:50'),
(97, 'employer_history', 'activated', '', '', '2023-04-14 12:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `oemployer_position`
--

DROP TABLE IF EXISTS `oemployer_position`;
CREATE TABLE `oemployer_position` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'employer_position',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ohomepage_banner`
--

DROP TABLE IF EXISTS `ohomepage_banner`;
CREATE TABLE `ohomepage_banner` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'homepage_banner',
  `doc_image_a` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `doc_image_b` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `doc_image_c` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `doc_image_d` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `title_a` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title_b` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title_c` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title_d` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description_a` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `description_b` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `description_c` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `description_d` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ohomepage_banner`
--

INSERT INTO `ohomepage_banner` (`id`, `type`, `doc_image_a`, `doc_image_b`, `doc_image_c`, `doc_image_d`, `title_a`, `title_b`, `title_c`, `title_d`, `description_a`, `description_b`, `description_c`, `description_d`, `date_created`) VALUES
(5, 'homepage_banner', '1681874244_new.png', '1680079323_1669634093_homebannerb.png', '1680079300_1671427390_new-section-image.jpg', '1680079308_1669634081_trendingdesktopbg.png', '', 'that next adventure??', 'passionate individuals!', '', 'Get instant access to numerous job listings in the hospitality and travel industries. Create your profile and let Hoteleers help you find opportunities that match your skills and experiences. ', 'Let\'s get you started! Get your own unique account as a jobseeker. Create your applicant profile, save jobs that interest you, and view all your applications in a few clicks. We\'ve also created an extra list that matches job postings to your personal preferences!\r\n', 'Looking for your first job? An internship? A new career? Or moving up?  Hoteleers is specially designed to make online job hunting fast, easy and convenient for you. We\'ve done all the work to keep it simple so you can focus on the things you need to do as a jobseeker: create a profile and apply for the job you want!!', '', '2022-07-14 14:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `oindustry`
--

DROP TABLE IF EXISTS `oindustry`;
CREATE TABLE `oindustry` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'industry',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_level',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post',
  `job_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `job_level` int(11) NOT NULL,
  `job_type` int(11) NOT NULL,
  `education` int(11) NOT NULL,
  `location` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `salary_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `salary_from` decimal(20,2) NOT NULL,
  `salary_to` decimal(20,2) NOT NULL,
  `perks_and_benefits` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `job_expiration_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `vacancies` int(11) NOT NULL,
  `vacancies_placeholder` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_posted` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `employer` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `remove_on` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_closed` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ojob_post`
--

INSERT INTO `ojob_post` (`id`, `type`, `job_title`, `department`, `industry`, `job_level`, `job_type`, `education`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `job_description`, `qualification`, `salary_currency`, `salary_from`, `salary_to`, `perks_and_benefits`, `job_expiration_date`, `vacancies`, `vacancies_placeholder`, `inactive`, `date_posted`, `date_created`, `created_by`, `employer`, `status`, `remove_on`, `date_closed`) VALUES
(258, 'job_post', 'Pilot', 6, 11, 9, 41, 521, 'France', '0.0000000', '0.0000000', '', '', 'France', 'Pilot for Cargo plane Airbus 330', 'at least 1000 Flyinh hours', 'EUR', '500.00', '1000.00', '[\"4\",\"5\",\"6\",\"7\",\"17\",\"18\",\"19\",\"20\"]', '7/1/2023', 2, 2, 1, '03/03/2023 04:37 PM', '2023-03-03 16:37:27', 281, 91, 'inactive', '', ''),
(259, 'job_post', 'Pilot', 3, 11, 9, 41, 521, 'France', '0.0000000', '0.0000000', '', '', 'France', 'Test 1', 'Test 1', 'EUR', '200.00', '500.00', '', '3/22/2023', 4, 4, 1, '03/03/2023 05:08 PM', '2023-03-03 17:08:04', 281, 91, 'inactive', '', ''),
(260, 'job_post', 'Revenue Manager', 38, 26, 9, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'Maintains the transient rooms inventory for the hotel(s) and responsible for maximizing transient revenue. The Revenue Manager releases group rooms back into general inventory and ensures clean booking windows for customers. The position recommends pricing and positioning of cluster properties. In addition, the position oversees the inventory management system to verify appropriateness of agreed upon selling strategies.\r\n\r\nAnalyzing and Reporting Revenue Management Data\r\n• Compiles information, analyzes and monitors actual sales against projected sales.\r\n• Identifies the underlying principles, reasons, or facts of information by breaking down information or data into separate parts.\r\n• Analyzes information and evaluates results to choose the best solution and solve problems.\r\n• Using computers and computer systems (including hardware and software) to program, write software, set up functions, enter data, or process information.\r\n• Generates and provides accurate and timely results in the form of reports, presentations, etc.\r\n• Conducts sales strategy analysis and refines as appropriate to increase market share for all properties.\r\n• Maintains accurate reservation system information.\r\n• Analyzes period end and other available systems data to identify trends, future need periods and obstacles to achieving goals.\r\n• Generates updates on transient segment each period.\r\n• Assists with account diagnostics process and validates conclusions.\r\n\r\nExecuting Revenue Management Projects and Strategy\r\n• Updates market knowledge and aligns strategies and approaches accordingly.\r\n• Achieves and exceeds goals including performance goals, budget goals, team goals, etc.\r\n• Attends meetings to plan, organize, prioritize, coordinate and manage activities and solutions.\r\n• Establishes long-range objectives and specifying the strategies and actions to achieve them.\r\n• Takes a predetermined strategy and drives the execution of that strategy.\r\n• Demonstrates knowledge of job-relevant issues, products, systems, and processes.\r\n• Understands and meets the needs of key stakeholders (owners, corporate, guests, etc.).\r\n• Explores opportunities that drive profit, create value for clients, and encourage innovation; challenges existing processes/systems/products to make improvements.\r\n• Provides revenue management functional expertise to cluster general managers, leadership teams and market sales leaders.\r\n• Ensures hotel strategies conform to brand philosophies and initiatives.\r\n• Ensures that sales strategies and rate restrictions are communicated, implemented and modified as market conditions fluctuate.\r\n• Prepares sales strategy meeting agenda, supporting documentation.\r\n• Communicates proactively with properties regarding rate restrictions and strategy.\r\n• Manages rooms inventory to maximize cluster rooms revenue.\r\n• Assists hotels with pricing and provides input on business evaluation recommendations.\r\n• Leads efforts to coordinate strategies between group sales offices.\r\n• Supports cluster selling initiatives by working with all reservation centers.\r\n• Uses reservations system and demand forecasting systems to determine, implement and control selling strategies.\r\n• Checks distribution channels for hotel positioning, information accuracy and competitor positioning.\r\n• Ensures property diagnostic processes (PDP) are used to maximize revenue and profits.\r\n• Initiates, implements and evaluates revenue tests.\r\n• Provides recommendations to improve effectiveness of revenue management processes.\r\n• Communicates brand initiatives, demand and market analysis to hotels/clusters/franchise partners/owners.\r\n• Understands and communicates the value of the brand name as it relates to franchise partnerships and revenue management opportunities.\r\n• Promotes and protects brand equity.\r\n\r\nBuilding Successful Relationships\r\n• Develops and manages internal key stakeholder relationships in a proactive manner.\r\n• Acts as a liaison, when necessary, between property and regional/corporate systems support.\r\n\r\nAdditional Responsibilities\r\n• Informs and/or updates the executives, the peers and the subordinates on relevant information in a timely manner.\r\n• Attends staff/forecast/long range meetings as requested by properties.', 'Education and Experience\r\n• 2-year degree from an accredited university in Business Administration, Finance and Accounting, Economics, Hotel and Restaurant Management, or related major; 3 years experience in the revenue management, sales and marketing, or related professional area.\r\n\r\nOR\r\n\r\n• 4-year bachelor\'s degree from an accredited university in Business Administration, Finance and Accounting, Economics, Hotel and Restaurant Management, or related major; 1 year experience in the revenue management, sales and marketing, or related professional area.\r\n', 'PHP', '80000.00', '120000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '7/1/2023', 1, 1, 0, '03/03/2023 06:38 PM', '2023-03-03 18:38:24', 275, 88, 'active', '', ''),
(261, 'job_post', 'Concierge', 10, 26, 8, 41, 277, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'Answer phone an email inquiries from potential guests in a timely and respectful manner\r\nGreet guests and visitors warmly and make them feel welcome and attended\r\nOffer restaurant and activity recommendations and assist guests in arranging transportation and excursions\r\nReceive and redirect mail, phone calls, packages, etc\r\nEnsure that guest spaces and lobby are clean and tidy at all times\r\nAct as a liaison between guests and any department necessary including the kitchen, housekeeping, etc\r\nAnticipate guests needs in order to accommodate them and provide an exceptional guest experience\r\nMaintain inventory of supplies and order new stock as needed', '1+ years of previous customer service experience\r\nPositive phone demeanor and superior written and verbal communication skills are essential\r\nMust have a service oriented mindset and be capable of making every guest feel valued\r\nKnowledge of basic office equipment, including printers, scanners, copiers, etc\r\nExemplify strong organizational skills and attention to detail\r\nCompetent working with Microsoft Office suite, including Word, Outlook and Excel\r\nPossess a positive attitude and be willing to work as part of a team\r\nAbility to speak a second language is an asset\r\nWilling to work irregular shifts and weekends', 'PHP', '25000.00', '30000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '6/22/2023', 3, 3, 0, '03/03/2023 06:47 PM', '2023-03-03 18:47:41', 275, 88, 'active', '', ''),
(262, 'job_post', 'Front Desk Agent', 19, 26, 8, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'Greeting and thanking guests in a sincere, friendly manner.\r\nChecking guests in on arrival and out on departure.\r\nPosting charges to appropriate guest accounts.\r\nAnticipating and addressing guests\' needs, and resolving their problems and complaints.\r\nAssisting guests with disabilities.\r\nOperating switchboard and assisting with inquiries.\r\nAssisting the reservations manager with taking reservations.\r\nCollaborating and communicating with other internal departments to ensure guest satisfaction.\r\nComplying with company procedures and safety policies.\r\nPerforming duties on a daily checklist.', 'College degree or suitable equivalent.\r\n1+ years of front desk agent experience preferred.\r\nWell-groomed, professional appearance.\r\nOutstanding written and verbal communication skills.\r\nTeam player.\r\nPhysically agile, and able to stand for extended periods.\r\nAvailable to work shifts, over weekends, and on public holidays.', 'PHP', '30000.00', '40000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '7/1/2023', 5, 5, 0, '03/03/2023 06:51 PM', '2023-03-03 18:51:50', 275, 88, 'active', '', ''),
(263, 'job_post', ' Guest Services Manager', 21, 26, 9, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'We are looking for a skilled guest service manager to oversee the daily operations of our hotel. As a guest service manager, you will ensure that guests are welcomed when they arrive and that they are accompanied to their room. You will manage all lobby activities and see to the functionality of the hotel amenities.\r\n\r\nTo ensure success as a guest service manager, you will train staff and manage staff schedules and shifts. You will ensure that safety and security measures are in place to ensure the safety of guests and staff. A skilled guest service manager will fulfill requests made by guests to ensure that they have an unforgettable experience.\r\n\r\nGuest Service Manager Responsibilities:\r\nEnsuring that the check-in and check-out process runs as smoothly as possible and that guests are escorted to the correct room.\r\nResponding to requests or complaints made by guests in a professional and polite manner in order to guarantee customer satisfaction.\r\nImplementing procedures to improve services offered with the aim of attracting more customers.\r\nHiring and training staff in matters of professional conduct, and ensuring that there is enough staff at all times by organizing staffing schedules efficiently.\r\nSupporting service personnel with questions posed by guests and taking over from the support staff if any issues arise.\r\nUnderstanding what guest expectations are and anticipating problems in order to prevent complaints.\r\nActing as a link between guests and hotel management.\r\nAttending meetings with management to discuss problems and strategies for improvement.\r\nHandling cash or payments made by credit card.\r\nUnderstanding safety and emergency procedures.', 'Guest Service Manager Requirements:\r\n\r\nBachelor’s degree in business administration, hospitality management, or hotel management.\r\nThe ability to speak, read, and write the language used in the workplace and knowledge of one or more additional languages is preferred.\r\nA minimum of 2-5 years’ front desk experience as a hotel manager is preferred.\r\nProficiency in Excel, PowerPoint, and Microsoft Word and hospitality software.\r\nA proven track record of being able to lead a team and to multitask.\r\nFlexibility and a willingness to work beyond scheduled hours, including on weekends.\r\nAn ability to identify areas in need of change or improvement to offer guests an excellent hotel experience.\r\nUnderstanding of and compliance with hotel policies and regulations and communicating these clearly to the staff.\r\nReporting on daily operations in a timely manner.', '', '0.00', '0.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '7/1/2023', 2, 2, 0, '03/03/2023 07:33 PM', '2023-03-03 19:33:07', 276, 89, 'active', '', ''),
(264, 'job_post', 'Night Manager', 19, 26, 9, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'Manage and monitor activities of all employees in the Front Office department making sure they adhere to the standards of excellence and to the guidelines set in the employee handbook, hotel policies and procedures, coaching, training and correcting where needed.\r\nMaintain a professional and high-quality service oriented environment at all times\r\nAct as manager on duty for the hotel in the absence of the Front Office Manager dealing with complaints, problem-solving, disturbances, special requests and any other issues that may arise\r\nManage the night shift in the department ensuring all employees perform the tasks assigned to them and coordinate Front Office activities with other departments\r\nInform all Overnight staff of nightly activities, group and VIP arrivals as well as special requests and repeat guests.', 'Requirements\r\nPrevious Front Office experience in supervisory/management capacity in a luxury property required\r\nHigh School diploma, general education degree or international equivalent required.\r\nCollege degree preferred.\r\nProficient in English\r\nAn operational knowledge and proficiency in Front Office Systems-Micros-Fidelio and Microsoft Office suite (Word, Excel, PowerPoint)\r\nSkills\r\nLeadership\r\nWritten/verbal communication and interpersonal skills\r\nAble to balance a variety of conflicting priorities while considering all aspects of the job i.e. Financial, Operational, Human resources', 'PHP', '50000.00', '50000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '5/31/2023', 1, 1, 0, '03/03/2023 07:37 PM', '2023-03-03 19:37:42', 276, 89, 'active', '', ''),
(265, 'job_post', 'Public Attendant', 22, 26, 8, 42, 520, 'Philippines', '0.0000000', '0.0000000', '', '', '', ' Clean and maintain all public areas such as hotel lobbies and waiting rooms.\r\n• Perform cleaning duties in and around the building, prioritizing safety at all times.\r\n• Wash and disinfect public restrooms and replenish bathroom supplies.\r\ndelivering guest requested items such as towels, cribs, and mattresses.\r\nrequirements.\r\n• Sweep, mop, and remove debris from floors, corridors, and stairways of assigned areas.\r\n• Clean windows, glass partitions and mirrors using surface cleaners and sponges.\r\n• Mix water and detergent in containers to make chemical cleaning solution.\r\n• Dust, wipe and polish the furniture and fixtures.\r\n• Clean rugs, carpets and upholstered furniture using a vacuum cleaner, broom and shampoo machine.\r\n• Keep the front of the hotel free from trash.\r\n• Inspect facility and grounds and pick up the trash.\r\n• Empty trash containers and ashtrays and dispose of all garbage.\r\n• Operate compacter and balers to discard cardboard boxes and trash.\r\n• Stack and maintain housekeeping carts.\r\n• Collect dirty linens from soiled hamper rooms and transport to laundry room.\r\n• Wash and dry linens and towels.\r\n• Replenish stock with clean linens.\r\n• Identify and report furniture and equipment repair needs and maintenance concerns.\r\n• Repair and maintain loose wires and cleaning equipment.\r\n• Discover and report all maintenance issues and special cleaning.\r\n• Answer any guest inquiries in a polite and efficient manner.\r\n• Demonstrate an exceptional customer service attitude with stakeholders.\r\n• Carry baggage of guests and help room attendants in moving heavy items.\r\n• Maintain security of public areas and follow established safety procedures, diligently.', 'At least a high school diploma or GED. Some employers may prefer candidates who have completed a health care or hospitality program.\r\n\r\nTraining & Experience: Public area attendants typically receive on-the-job training from their supervisors or managers. This training may include how to clean and disinfect areas, how to use cleaning equipment and how to properly dispose of waste. Training may also include how to interact with customers and how to handle any customer complaints.\r\n\r\nCertifications & Licenses: While certifications are not often required for public area attendant jobs, they can help you compete for positions and demonstrate your skills and qualifications to employers.', 'PHP', '16000.00', '17000.00', '[\"5\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '5/26/2023', 9, 9, 0, '03/03/2023 07:43 PM', '2023-03-03 19:42:46', 276, 89, 'active', '', ''),
(266, 'job_post', 'Front Desk Supervisor', 19, 26, 8, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'Supervises the front office agents.\r\nIncludes night audit duties.\r\nGreeting and thanking guests in a sincere, friendly manner.\r\nChecking guests in on arrival and out on departure.\r\nPosting charges to appropriate guest accounts.\r\nAnticipating and addressing guests\' needs, and resolving their problems and complaints.\r\nAssisting guests with disabilities.\r\nOperating switchboard and assisting with inquiries.\r\nAssisting the reservations manager with taking reservations.\r\nCollaborating and communicating with other internal departments to ensure guest satisfaction.\r\nComplying with company procedures and safety policies.\r\nPerforming duties on a daily checklist.', 'College degree or suitable equivalent.\r\n1 year supervisory experience or 3+ years as front desk agent from reputable hotel\r\nWell-groomed, professional appearance.\r\nOutstanding written and verbal communication skills.\r\nTeam player.\r\nPhysically agile, and able to stand for extended periods.\r\nAvailable to work shifts, over weekends, and on public holidays.', 'PHP', '50000.00', '60000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '7/3/2023', 2, 2, 0, '03/05/2023 04:53 PM', '2023-03-05 16:53:46', 275, 88, 'active', '', ''),
(267, 'job_post', 'Cluster Revenue Manager', 38, 26, 9, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'Handles 3 properties within a 12 km radius\r\nMaintains the transient rooms inventory for the hotel(s) and responsible for maximizing transient revenue. The Revenue Manager releases group rooms back into general inventory and ensures clean booking windows for customers. The position recommends pricing and positioning of cluster properties. In addition, the position oversees the inventory management system to verify appropriateness of agreed upon selling strategies.\r\n\r\nAnalyzing and Reporting Revenue Management Data\r\n• Compiles information, analyzes and monitors actual sales against projected sales.\r\n• Identifies the underlying principles, reasons, or facts of information by breaking down information or data into separate parts.\r\n• Analyzes information and evaluates results to choose the best solution and solve problems.\r\n• Using computers and computer systems (including hardware and software) to program, write software, set up functions, enter data, or process information.\r\n• Generates and provides accurate and timely results in the form of reports, presentations, etc.\r\n• Conducts sales strategy analysis and refines as appropriate to increase market share for all properties.\r\n• Maintains accurate reservation system information.\r\n• Analyzes period end and other available systems data to identify trends, future need periods and obstacles to achieving goals.\r\n• Generates updates on transient segment each period.\r\n• Assists with account diagnostics process and validates conclusions.\r\n\r\nExecuting Revenue Management Projects and Strategy\r\n• Updates market knowledge and aligns strategies and approaches accordingly.\r\n• Achieves and exceeds goals including performance goals, budget goals, team goals, etc.\r\n• Attends meetings to plan, organize, prioritize, coordinate and manage activities and solutions.\r\n• Establishes long-range objectives and specifying the strategies and actions to achieve them.\r\n• Takes a predetermined strategy and drives the execution of that strategy.\r\n• Demonstrates knowledge of job-relevant issues, products, systems, and processes.\r\n• Understands and meets the needs of key stakeholders (owners, corporate, guests, etc.).\r\n• Explores opportunities that drive profit, create value for clients, and encourage innovation; challenges existing processes/systems/products to make improvements.\r\n• Provides revenue management functional expertise to cluster general managers, leadership teams and market sales leaders.\r\n• Ensures hotel strategies conform to brand philosophies and initiatives.\r\n• Ensures that sales strategies and rate restrictions are communicated, implemented and modified as market conditions fluctuate.\r\n• Prepares sales strategy meeting agenda, supporting documentation.\r\n• Communicates proactively with properties regarding rate restrictions and strategy.\r\n• Manages rooms inventory to maximize cluster rooms revenue.\r\n• Assists hotels with pricing and provides input on business evaluation recommendations.\r\n• Leads efforts to coordinate strategies between group sales offices.\r\n• Supports cluster selling initiatives by working with all reservation centers.\r\n• Uses reservations system and demand forecasting systems to determine, implement and control selling strategies.\r\n• Checks distribution channels for hotel positioning, information accuracy and competitor positioning.\r\n• Ensures property diagnostic processes (PDP) are used to maximize revenue and profits.\r\n• Initiates, implements and evaluates revenue tests.\r\n• Provides recommendations to improve effectiveness of revenue management processes.\r\n• Communicates brand initiatives, demand and market analysis to hotels/clusters/franchise partners/owners.\r\n• Understands and communicates the value of the brand name as it relates to franchise partnerships and revenue management opportunities.\r\n• Promotes and protects brand equity.\r\n\r\nBuilding Successful Relationships\r\n• Develops and manages internal key stakeholder relationships in a proactive manner.\r\n• Acts as a liaison, when necessary, between property and regional/corporate systems support.\r\n\r\nAdditional Responsibilities\r\n• Informs and/or updates the executives, the peers and the subordinates on relevant information in a timely manner.\r\n• Attends staff/forecast/long range meetings as requested by properties.', 'Education and Experience\r\n• 4-year degree from an accredited university in Business Administration, Finance and Accounting, Economics, Hotel and Restaurant Management, or related major; 10 years experience in the revenue management, sales and marketing, or related professional area.\r\n\r\nOR\r\n\r\n• 4-year bachelor\'s degree from an accredited university in Business Administration, Finance and Accounting, Economics, Hotel and Restaurant Management, or related major; 10 year experience in the revenue management, sales and marketing, or related professional area.\r\n', 'PHP', '180000.00', '220000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '3/5/2023', 1, 1, 0, '03/05/2023 04:57 PM', '2023-03-05 16:57:50', 275, 88, 'active', '', ''),
(268, 'job_post', 'Housekeeping Supervisor', 22, 26, 8, 41, 277, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'rain housekeepers on cleaning and maintenance tasks\r\nOversee staff on a daily basis\r\nCheck rooms and common areas, including stairways and lounge areas, for cleanliness\r\nSchedule shifts and arrange for replacements in cases of absence\r\nEstablish and educate staff on cleanliness, tidiness and hygiene standards\r\nMotivate team members and resolve any issues that occur on the job\r\nRespond to customer complaints and special requests\r\nMonitor and replenish cleaning products stock including floor cleaner, bleach and rubber gloves\r\nParticipate in large cleaning projects as required\r\nEnsure compliance with safety and sanitation policies in all areas', 'Work experience as a Housekeeping Supervisor or similar role\r\nHands-on experience with cleaning and maintenance tasks for large organizations\r\nAbility to use industrial cleaning equipment and products\r\nExcellent organizational and team management skills\r\nStamina to handle the physical demands of the job\r\nFlexibility to work various shifts, including evenings and weekends\r\nCollege level is a plus', 'PHP', '25000.00', '30000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '5/26/2023', 2, 2, 0, '03/05/2023 05:01 PM', '2023-03-05 17:01:13', 275, 88, 'active', '', ''),
(269, 'job_post', 'Food Server', 18, 26, 8, 42, 520, 'Philippines', '0.0000000', '0.0000000', '', '', '', ' Clean and maintain all public areas such as hotel lobbies and waiting rooms.\r\n• Perform cleaning duties in and around the building, prioritizing safety at all times.\r\n• Wash and disinfect public restrooms and replenish bathroom supplies.\r\ndelivering guest requested items such as towels, cribs, and mattresses.\r\nrequirements.\r\n• Sweep, mop, and remove debris from floors, corridors, and stairways of assigned areas.\r\n• Clean windows, glass partitions and mirrors using surface cleaners and sponges.\r\n• Mix water and detergent in containers to make chemical cleaning solution.\r\n• Dust, wipe and polish the furniture and fixtures.\r\n• Clean rugs, carpets and upholstered furniture using a vacuum cleaner, broom and shampoo machine.\r\n• Keep the front of the hotel free from trash.\r\n• Inspect facility and grounds and pick up the trash.\r\n• Empty trash containers and ashtrays and dispose of all garbage.\r\n• Operate compacter and balers to discard cardboard boxes and trash.\r\n• Stack and maintain housekeeping carts.\r\n• Collect dirty linens from soiled hamper rooms and transport to laundry room.\r\n• Wash and dry linens and towels.\r\n• Replenish stock with clean linens.\r\n• Identify and report furniture and equipment repair needs and maintenance concerns.\r\n• Repair and maintain loose wires and cleaning equipment.\r\n• Discover and report all maintenance issues and special cleaning.\r\n• Answer any guest inquiries in a polite and efficient manner.\r\n• Demonstrate an exceptional customer service attitude with stakeholders.\r\n• Carry baggage of guests and help room attendants in moving heavy items.\r\n• Maintain security of public areas and follow established safety procedures, diligently.', 'We are looking to recruit an enthusiastic food server to oversee, enhance, and ensure a pleasant dining experience for our guests. The food server will maintain a positive and respectful relationship with team members, engage with guests in a professional, dignified manner, and inform management of potential service and product issues before they arise. You will perform opening duties to prepare for service and closing duties at the end of your shift. You will employ sound judgment to establish whether to take guests’ food orders swiftly or to allow them time to relax.\r\n\r\nTo ensure success you will value our patrons as if they were guests in your home, and take pride in your work. Top candidates will be sincere, hospitable, and hard-working.\r\n\r\nFood Server Responsibilities:\r\nPerforming opening duties such as setting tables, polishing glasses, folding napkins, and replenishing condiments.\r\nAttending pre-shift and general meetings to update knowledge of special offers and stock-related issues, and to discuss service and product matters.\r\nAssisting management and hosts to meet, greet, and seat guests, and issuing them food and wine menus.\r\nIntroducing yourself to guests and informing them of special offers and stock shortages before they select items off the menu.\r\nEnsuring beverages are served swiftly and replenished continuously.\r\nEnsuring accuracy when entering orders into the point of sale (POS) system.\r\nFollowing up on food and beverage orders with the back of house (BOH).\r\nChecking on guests to establish satisfaction with the product and overall experience, and providing management with feedback.\r\nIssuing guests with their check on request, and greeting and thanking them sincerely on departure.\r\nPerforming closing duties such as sweeping and vacuuming, and preparing linens for collection by laundry service.', 'PHP', '16000.00', '17000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '6/30/2023', 5, 5, 0, '03/05/2023 05:09 PM', '2023-03-05 17:09:45', 276, 89, 'active', '', ''),
(270, 'job_post', 'Banquets Supervisor ', 18, 26, 8, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'DUTIES AND RESPONSIBILITIES:\r\n\r\nMeet and greet clients.\r\n\r\nOversee catered functions, in house and off site.\r\n\r\nResponsible for making the function space visually appealing and presenting the menu offering for the event.\r\n\r\nResponsible for the overall sanitation and cleanliness of the work areas, banquet rooms and storage areas.\r\n\r\nResponsible for the proper usage and good working order of all equipment, furniture and fixtures in the Banquet and Catering Section in the shift assigned.\r\n\r\nResponsible for consistently implementing the service standards and operating procedures in the banquet and Catering service.\r\n\r\nProvide excellent customer service and ensure customer needs are met.\r\n\r\nProvide unique and creative ideas to enhance meetings & group experience.\r\n\r\nShould posses in depth Knowledge of Food and Beverage preparation and presentation.\r\n\r\nSupervise events and team members throughout service.\r\n\r\nGuide the Banquet servers in set up of tables and place settings.\r\n\r\nBe familiar with all current and upcoming event details.\r\n\r\nResolve staff and customer concerns quickly and efficiently.\r\n\r\nCo-ordinate with the Kitchen and housekeeping department.\r\n\r\nShould be able to work under pressure and also work in long or break shifts.\r\n\r\nScheduling of banquet staff, prepare weekly duty chart to correspond with banquet functions and manage labour for monthly.\r\n\r\nAssist the Banquet Manager with scheduling, training and performance management.\r\n\r\nAssist and support the Conference Services Manager to provide excellent guest service\r\n\r\nOrganise Transportation of food and equipment to offsite catering events.\r\n\r\nShould have experience in operating sales and catering software’s like Opera S&M, Protel Banquet, Delphi etc.\r\n\r\nShould have experience in operating POS (point of sales) Software’s.\r\n\r\nResponsible for monthly inventory, consumption spreadsheet and banquet staff labours.\r\n\r\nResponsible for ensuring sufficient operating guest supplies, beverage supplies and operating equipment for functions assigned.\r\n\r\nSpeak with others using clear and professional language, and answer telephones using appropriate etiquette.\r\n\r\nStand, sit, or walk for an extended period of time. Move, lift, carry, push, pull, and place objects weighing less than or equal to 25 pounds without assistance.\r\n\r\nReach overhead and below the knees, including bending, twisting, pulling, and stooping.', 'Accredited certificate or diploma in catering, culinary Arts, hospitality, or similar.\r\nBachelor\'s degree in hospitality and culinary arts preferred.\r\n3-5 years of experience in banquet management, or similar.\r\nProficiency in catering management software, such as Better Cater and Caterease.\r\nExceptional ability to plan banquets, manage budgets, and meet deadlines.\r\nExperience in supervising banquet venue staff.\r\nAbility to collaborate with Banquet Sales Directors and Head Chefs.\r\nExtensive knowledge of catering equipment and venue requirements.\r\nIn-depth knowledge of hospitality industry best practices.\r\nExcellent interpersonal and communication skills.', 'PHP', '0.00', '0.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\"]', '6/4/2023', 2, 2, 0, '03/05/2023 05:15 PM', '2023-03-05 17:15:49', 276, 89, 'active', '', ''),
(271, 'job_post', 'Room Reservations Agent', 36, 26, 8, 41, 521, 'Macau SAR', '0.0000000', '0.0000000', '', '', '', 'We are looking for detail-oriented reservation agents to assist our customers with their booking needs. You will provide various planning and booking services, including answering customers’ questions, making travel suggestions, and booking rooms and tickets.\r\n\r\nTo be successful as a Reservation Agent you must be able to work with minimal supervision and have excellent customer service skills. Additionally, you should be able to up-sell and have excellent knowledge of deals and savings available to customers.\r\n\r\nReservation Agent Responsibilities:\r\nAssisting and advising customers who may be choosing from a variety of travel options.\r\nMaking reservations for customers based on their various requirements and budgetary allowances.\r\nChecking the availability of accommodation or transportation on the customers’ desired travel dates.\r\nHelping plan travel itineraries by suggesting local tourist attractions and places of interest.\r\nProcessing payments and sending confirmation details to customers.\r\nSorting out any issues that may arise with bookings or reservations.\r\nSelling and promoting reservation services.\r\nAnswering any questions customers might have about the reservation process.\r\nUp-selling, when appropriate, by informing customers of additional services or special packages, such as tour tickets, travel insurance, or upgraded seats/accommodations.\r\nProviding support to customers who may need to amend or cancel a reservation.\r\n', 'College Degree in Hotel or Tourism related courses\r\nCertified travel associate (CTA) or certified travel counselor (CTC), preferred.\r\nExperience working in sales or public relations, preferably in the hospitality or travel industries.\r\nCustomer-service experience.\r\nExcellent written and verbal communication skills.\r\nMulti-tasking and time-management skills, with the ability to prioritize tasks.\r\nProficient in microsoft office suite.\r\nData entry experience.\r\nFlexible working hours.', 'MOP', '12000.00', '15000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\"]', '6/29/2023', 2, 5, 0, '03/05/2023 05:23 PM', '2023-03-05 17:23:00', 277, 90, 'active', '', ''),
(272, 'job_post', 'Room Reservations Supervisor', 36, 26, 8, 41, 521, 'Macau SAR', '0.0000000', '0.0000000', '', '', '', 'Supervises al reservations agents.\r\n\r\nChecks all arrival details and coordinate pre-payments.\r\n\r\nWe are looking for detail-oriented reservation agents to assist our customers with their booking needs. You will provide various planning and booking services, including answering customers’ questions, making travel suggestions, and booking rooms and tickets.\r\n\r\nTo be successful as a Reservation Agent you must be able to work with minimal supervision and have excellent customer service skills. Additionally, you should be able to up-sell and have excellent knowledge of deals and savings available to customers.\r\n\r\nReservation Agent Responsibilities:\r\nAssisting and advising customers who may be choosing from a variety of travel options.\r\nMaking reservations for customers based on their various requirements and budgetary allowances.\r\nChecking the availability of accommodation or transportation on the customers’ desired travel dates.\r\nHelping plan travel itineraries by suggesting local tourist attractions and places of interest.\r\nProcessing payments and sending confirmation details to customers.\r\nSorting out any issues that may arise with bookings or reservations.\r\nSelling and promoting reservation services.\r\nAnswering any questions customers might have about the reservation process.\r\nUp-selling, when appropriate, by informing customers of additional services or special packages, such as tour tickets, travel insurance, or upgraded seats/accommodations.\r\nProviding support to customers who may need to amend or cancel a reservation.\r\n', 'College Degree in Hotel or Tourism related courses\r\nCertified travel associate (CTA) or certified travel counselor (CTC), preferred.\r\nExperience working in sales or public relations, preferably in the hospitality or travel industries.\r\nCustomer-service experience.\r\nExcellent written and verbal communication skills.\r\nMulti-tasking and time-management skills, with the ability to prioritize tasks.\r\nProficient in microsoft office suite.\r\nData entry experience.\r\nFlexible working hours.', 'MOP', '16000.00', '20000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\"]', '7/1/2023', 2, 2, 0, '03/05/2023 05:34 PM', '2023-03-05 17:34:56', 277, 90, 'active', '', ''),
(273, 'job_post', 'Front Desk Agent', 19, 26, 8, 41, 521, 'Macau SAR', '0.0000000', '0.0000000', '', '', '', 'We are looking to hire an upbeat front desk agent to assist with checking guests in and out of our establishment. The front desk agent will assist guests with inquiries, problems, and complaints. The front desk agent will be responsible for receiving guests’ payments and for balancing the cash at end of the shift. You will be familiar with the hotel layout, be up to date with different tariffs and special offers, understand the in-house restaurant\'s operation to facilitate guests\' dining reservations and to make recommendations, and be proficient with operating the switchboard. You will ensure keys are handed back on guests\' departure.\r\n\r\nTo ensure success you will be professional and pleasant in challenging situations and take responsibility for the satisfaction of guests from arrival to departure. Preferred candidates will be positive, proactive, and be skilled at multitasking in a fast-paced environment.\r\n\r\nFront Desk Agent Responsibilities:\r\nGreeting and thanking guests in a sincere, friendly manner.\r\nChecking guests in on arrival and out on departure.\r\nPosting charges to appropriate guest accounts.\r\nAnticipating and addressing guests\' needs, and resolving their problems and complaints.\r\nAssisting guests with disabilities.\r\nOperating switchboard and assisting with inquiries.\r\nAssisting the reservations manager with taking reservations.\r\nCollaborating and communicating with other internal departments to ensure guest satisfaction.\r\nComplying with company procedures and safety policies.\r\nPerforming duties on a daily checklist.', 'College Degree in Hotel or Tourism related courses\r\n\r\n1+ years of front desk agent experience preferred.\r\nWell-groomed, professional appearance.\r\nOutstanding written and verbal communication skills.\r\nTeam player.\r\nPhysically agile, and able to stand for extended periods.\r\nAvailable to work shifts, over weekends, and on public holidays.', 'MOP', '12000.00', '15000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\"]', '6/19/2023', 3, 3, 0, '03/05/2023 05:37 PM', '2023-03-05 17:37:09', 277, 90, 'active', '', ''),
(274, 'job_post', 'Front Desk Supervisor', 36, 26, 8, 41, 521, 'Macau SAR', '0.0000000', '0.0000000', '', '', '', 'Supervises all front desk agents.\r\n\r\nHandles group check ins\r\nChecks all arrival details and coordinate pre-payments.\r\n\r\nWe are looking to hire an upbeat front desk agent to assist with checking guests in and out of our establishment. The front desk agent will assist guests with inquiries, problems, and complaints. The front desk agent will be responsible for receiving guests’ payments and for balancing the cash at end of the shift. You will be familiar with the hotel layout, be up to date with different tariffs and special offers, understand the in-house restaurant\'s operation to facilitate guests\' dining reservations and to make recommendations, and be proficient with operating the switchboard. You will ensure keys are handed back on guests\' departure.\r\n\r\nTo ensure success you will be professional and pleasant in challenging situations and take responsibility for the satisfaction of guests from arrival to departure. Preferred candidates will be positive, proactive, and be skilled at multitasking in a fast-paced environment.\r\n\r\nFront Desk Suprvisor Responsibilities include:\r\nGreeting and thanking guests in a sincere, friendly manner.\r\nChecking guests in on arrival and out on departure.\r\nPosting charges to appropriate guest accounts.\r\nAnticipating and addressing guests\' needs, and resolving their problems and complaints.\r\nAssisting guests with disabilities.\r\nOperating switchboard and assisting with inquiries.\r\nAssisting the reservations manager with taking reservations.\r\nCollaborating and communicating with other internal departments to ensure guest satisfaction.\r\nComplying with company procedures and safety policies.\r\nPerforming duties on a daily checklist.', 'College Degree in Hotel or Tourism related courses\r\n3+ years of front desk agent experience preferred or 2 years as Supervisor in a luxury hotel or resort\r\n\r\nWell-groomed, professional appearance.\r\nOutstanding written and verbal communication skills.\r\nTeam player.\r\nPhysically agile, and able to stand for extended periods.\r\nAvailable to work shifts, over weekends, and on public holidays.', 'MOP', '18000.00', '20000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\"]', '4/28/2023', 2, 2, 0, '03/05/2023 05:39 PM', '2023-03-05 17:39:51', 277, 90, 'active', '', ''),
(275, 'job_post', 'Junior Chef', 16, 26, 9, 41, 277, 'Macau SAR', '0.0000000', '0.0000000', '', '', '', 'Develop new menu options based on seasonal changes and customer demand.\r\nAssist with the preparation and planning of meal designs.\r\nEnsure that kitchen activities operate in a timely manner.\r\nResolve customer problems and concerns personally.\r\nMonitor and record inventory, and if necessary, order new supplies.\r\nProvide support to junior kitchen employees with various tasks including line cooking, food preparation, and dish plating.\r\nRecruit and train new kitchen employees to meet restaurant and kitchen standards.\r\nCreate schedules for kitchen employees and evaluate their performance.\r\nAdhere to and implement sanitation regulations and safety regulations.\r\nManage the kitchen team in the executive chef\'s absence.', 'Bachelor’s degree in culinary science or relevant field.\r\nA minimum of 2 years’ experience in a similar role.\r\nStrong knowledge of cooking methods, kitchen equipment, and best practices.\r\nGood understanding of MS Office and restaurant software programs.\r\nTeamwork-oriented with outstanding leadership abilities.\r\nExcellent communication and interpersonal skills.', 'MOP', '25000.00', '28000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '7/4/2023', 1, 1, 0, '03/06/2023 12:23 AM', '2023-03-06 00:23:02', 277, 90, 'active', '', ''),
(276, 'job_post', 'Housekeeping Manager', 22, 26, 9, 41, 276, 'Philippines', '0.0000000', '0.0000000', '', '', '', 'To manage and oversee daily operations', 'at least 5 years experience', 'AMD', '0.00', '0.00', '[\"\"]', '3/24/2023', 1, 1, 0, '03/07/2023 03:29 PM', '2023-03-07 15:27:38', 275, 88, 'active', '03/09/2023 02:40 PM', ''),
(277, 'job_post', 'Desk Support', 24, 21, 9, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'You are a support in the desk !', 'You must possess\r\nYou must have??!', 'PHP', '20000.00', '30000.00', '[\"4\",\"5\",\"11\",\"12\",\"25\",\"51\",\"52\"]', '4/29/2023', 5, 5, 0, '03/29/2023 02:34 PM', '2023-03-29 14:34:20', 277, 90, 'active', '', ''),
(278, 'job_post', 'Test', 5, 26, 8, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'TEST!!!!!', 'TEST DAW', 'PHP', '10000.00', '11000.00', '[\"52\"]', '4/29/2023', 2, 2, 0, '03/29/2023 03:23 PM', '2023-03-29 15:23:44', 316, 95, 'active', '03/30/2023 03:34 PM', ''),
(279, 'job_post', 'Chefs', 5, 15, 8, 43, 277, 'Argentina', '0.0000000', '0.0000000', '', '', 'Argentina', 'bake bake', 'Need experience in baking', 'PHP', '5000.00', '10000.00', '[\"18\",\"19\"]', '4/7/2023', 1, 1, 0, '03/29/2023 04:40 PM', '2023-03-29 15:59:45', 277, 90, 'active', '', ''),
(281, 'job_post', 'Painter', 5, 26, 9, 45, 520, 'Afghanistan', '0.0000000', '0.0000000', '', '', 'Afghanistan', 'know how to paint', 'has paint brush', 'AED', '1200.00', '5200.00', '[\"17\",\"20\",\"22\",\"52\"]', '5/10/2023', 4, 5, 0, '03/29/2023 05:16 PM', '2023-03-29 17:16:48', 277, 90, 'active', '', ''),
(282, 'job_post', 'Test', 3, 28, 10, 44, 521, 'Angola', '0.0000000', '0.0000000', '', '', 'Angola', 'Test', 'Test', 'ALL', '30000.00', '60000.00', '[\"4\",\"7\",\"17\",\"18\",\"20\"]', '3/31/2023', 1, 1, 0, '03/29/2023 05:22 PM', '2023-03-29 17:22:43', 277, 90, 'active', '03/31/2023 02:20 PM', ''),
(283, 'job_post', 'Manager', 24, 21, 8, 41, 521, 'Yemen', '0.0000000', '0.0000000', '', '', 'Yemen', 'Test', 'Test', 'ALL', '10000.00', '12000.00', '[\"4\",\"5\",\"6\",\"7\"]', '4/12/2023', 2, 2, 0, '03/31/2023 04:44 PM', '2023-03-31 16:44:42', 317, 96, 'active', '', ''),
(284, 'job_post', 'HR', 7, 16, 9, 44, 522, 'Djibouti', '0.0000000', '0.0000000', '', '', '', 'Test', 'Test', 'CHW', '12000.00', '15000.00', '[\"4\",\"5\",\"6\",\"7\",\"10\",\"18\",\"20\"]', '4/7/2023', 3, 3, 0, '03/31/2023 04:48 PM', '2023-03-31 16:48:00', 317, 96, 'active', '', ''),
(285, 'job_post', 'Waiter', 8, 26, 9, 41, 521, 'Thailand', '0.0000000', '0.0000000', '', '', '', 'Test', 'test', 'THB', '5000.00', '10000.00', '[\"4\",\"5\",\"6\",\"7\",\"18\",\"19\",\"20\"]', '7/21/2023', 5, 5, 0, '04/18/2023 06:29 PM', '2023-04-18 18:29:30', 321, 97, 'active', '', ''),
(286, 'job_post', 'PR & Communication Manager', 28, 26, 9, 41, 521, 'Thailand', '0.0000000', '0.0000000', '', '', '', '1. To develop and foster a positive image and relationship between the hotel, the public, and the community. Will function under the preview of Director of Sales & Marketing;\r\n2. The Marketing Communications Manager performs her/his duties within the framework defined by the Banyan Tree Group, hotel norms and by internal rules and regulations as specified by Director of Sales & Marketing;\r\n3. The Marketing Communications Manager draws up the Public Relation action, advertising and media plan on an annual basis for the hotel;\r\n4. Organize regular visits by professional persons from the media and members of the trade to the hotel;\r\n5. Ensures that stationary and printed items are standardized and conforms to the Banyan Tree standards;\r\n6. Ensure optimum publicity is created for all major hotel happening;\r\n7. Supervise taking of photographs and prepare news release of events undertaken by the hotel;\r\n8. Organizes both internal and external PR activities. e.g. inter-departmental or in-house activities;\r\n9. The Marketing Communications Manager maintains contact with professional people, members of the press/media both local and international and any other persons who are clients or potential clients of the hotel;\r\n10. The Marketing Communications Manager maintains contact, coordinates with all other departments of the hotel, and may have contact with other PR Managers at a regional level. The Marketing Communications Manager ensures the smooth operation of the PR head office;\r\n11. Develops leisure marketing plan that addresses the distribution of rate offers, packages and programs designed to build occupancy.\r\n12. Maintain, updates, and manages all web sites\r\n13. Develops brochure and property collateral materials.\r\n14. Dominate social media presence\r\n15. Optimize search engines visibility', '16. Knowledge of Administration computer systems and personal computer\r\n17. Bilingual – English/ French and ideally Spanish\r\n18. Positive attitude and good communication skills\r\n19. Commitment to delivering a high level of customer service\r\n20. Excellent organizational and planning skills\r\n21. Excellent grooming standards\r\n22. Flexibility to respond to a range of different work situations\r\n23. Ability to work well under time pressure and/or demanding travel schedules\r\n24. Knowledge of Administration computer systems and personal computer', 'THB', '15000.00', '25000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"17\"]', '6/30/2023', 2, 2, 0, '04/18/2023 06:57 PM', '2023-04-18 18:57:49', 321, 97, 'active', '', ''),
(287, 'job_post', 'Programmer', 24, 11, 10, 41, 521, 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'Full Stack Developer', '- Knowledgeable to all programming language', 'PHP', '80000.00', '100000.00', '[\"4\",\"5\",\"6\",\"7\",\"17\",\"18\"]', '8/18/2023', 10, 10, 0, '04/21/2023 10:01 AM', '2023-04-21 10:01:26', 321, 97, 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ojob_type`
--

DROP TABLE IF EXISTS `ojob_type`;
CREATE TABLE `ojob_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_type',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'language',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'location',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'perks_and_benefits',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(26, 'perks_and_benefits', 'Executive benefits', 0, '2022-07-14 13:01:23', 3),
(50, 'perks_and_benefits', 'Annual Vacation', 0, '2023-03-03 08:35:34', 281),
(51, 'perks_and_benefits', 'Board and Lodging', 0, '2023-03-03 08:35:34', 281),
(52, 'perks_and_benefits', 'Leave', 0, '2023-03-29 06:32:13', 277),
(53, 'perks_and_benefits', 'Library card', 0, '2023-04-14 13:43:18', 321),
(54, 'perks_and_benefits', 'Pando Pro acc', 0, '2023-04-14 13:45:16', 321),
(55, 'perks_and_benefits', 'Grab Pro acc', 0, '2023-04-14 13:45:16', 321),
(56, 'perks_and_benefits', 'Angkas Pro Acc', 0, '2023-04-14 13:45:16', 321);

-- --------------------------------------------------------

--
-- Table structure for table `operks_and_benefits_removed`
--

DROP TABLE IF EXISTS `operks_and_benefits_removed`;
CREATE TABLE `operks_and_benefits_removed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `operks_and_benefits_removed`
--

INSERT INTO `operks_and_benefits_removed` (`id`, `user_id`, `date_created`) VALUES
(50, 276, '2023-03-05 09:05:15'),
(51, 276, '2023-03-05 09:05:18'),
(50, 321, '2023-04-14 13:41:29'),
(51, 321, '2023-04-14 13:41:31'),
(52, 321, '2023-04-14 13:41:33'),
(54, 321, '2023-04-14 13:45:27'),
(53, 321, '2023-04-18 10:50:02'),
(55, 321, '2023-04-21 02:37:10'),
(56, 321, '2023-04-21 02:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `opermission`
--

DROP TABLE IF EXISTS `opermission`;
CREATE TABLE `opermission` (
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `record_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `permission` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile',
  `doc_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `honorifics` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dial_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `first_login` tinyint(1) NOT NULL DEFAULT 1,
  `highlights` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `internship` tinyint(1) NOT NULL,
  `resume` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oprofile`
--

INSERT INTO `oprofile` (`id`, `type`, `doc_image`, `honorifics`, `first_name`, `middle_name`, `last_name`, `email_add`, `designation`, `dial_code`, `contact_number`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `date_created`, `first_login`, `highlights`, `internship`, `resume`) VALUES
(265, 'profile', '', '', '', '', '', 'arman1@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-02 13:02:56', 1, '', 0, ''),
(266, 'profile', '', '', '', '', '', 'arman2@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-02 13:03:21', 1, '', 0, ''),
(267, 'profile', '', '', '', '', '', 'arman3@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-02 13:03:34', 1, '', 0, ''),
(268, 'profile', '1677763733_Dongs Lakwatsa.png', '', 'Elmer', '', 'Test', 'applicant_01@gmail.com', '', '+93', '9388751022', 'Albania', '0.0000000', '0.0000000', '', '', '', '2023-03-02 20:36:35', 0, '', 0, '1677763851_Resume.pdf'),
(269, 'profile', '', '', 'Arman', '', 'Manager', 'arman13@gmail.com', '', '+1767', '9388751000', 'Gabon', '0.0000000', '0.0000000', '', '', '', '2023-03-03 14:38:41', 0, '', 0, ''),
(270, 'profile', '', '', 'Arman', '', 'Director', 'arman14@gmail.com', '', '+376', '9388751000', 'Venezuela', '0.0000000', '0.0000000', '', '', '', '2023-03-03 14:52:44', 0, '', 0, ''),
(271, 'profile', '', '', 'Arman', '', 'Entry', 'arman15@gmail.com', '', '+374', '9388751000', 'Mali', '0.0000000', '0.0000000', '', '', '', '2023-03-03 14:54:50', 0, '', 0, ''),
(272, 'profile', '', '', 'arman', '', 'internship', 'arman01@gmail.com', '', '+244', '09223687675', 'Philippines', '0.0000000', '0.0000000', '', '', '', '2023-03-03 15:34:46', 0, '', 0, ''),
(273, 'profile', '', '', 'Arman', '', 'Vocational', 'arman02@gmail.com', '', '+63', '9161234567', 'Philippines', '0.0000000', '0.0000000', '', '', '', '2023-03-03 15:35:58', 0, '', 0, ''),
(274, 'profile', '1678033102_Jacobi 2x2.png', '', 'Arman', '', 'High School', 'arman03@gmail.com', '', '+32', '9164054667', 'Belgium', '0.0000000', '0.0000000', '', '', '', '2023-03-03 15:37:30', 0, 'Banquets and outdoor catering, specialize in European cuisine, french and spanish cooking', 0, ''),
(275, 'profile', '', 'Mr.', 'Johnny', '', 'Utah', 'JohnnyUtah@gmail.com', 'HR Assistant', '+63', '9161234567', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 15:46:54', 1, '', 0, ''),
(276, 'profile', '', 'Mr.', 'Johnny', '', 'Bravo', 'JohnnyBravo@gmail.com', 'HR Manager', '+63', '9161234568', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 15:48:51', 1, '', 0, ''),
(277, 'profile', '', 'Mr.', 'Johnny', '', 'Cash', 'JohnnyCash@gmail.com', 'HR Director', '+853', '66142946', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 15:50:38', 1, '', 0, ''),
(278, 'profile', '', '', 'Juan', 'Santos', 'Dela Cruz', '31d.employee@gmail.com', '', '+63', '9663590399', 'Philippines', '0.0000000', '0.0000000', '', '', '', '2023-03-03 16:11:11', 0, '', 0, ''),
(279, 'profile', '', 'Mr.', 'Nix', '', '31D', '31d.nix@gmail.com', 'Developer', '+213', '9388751000', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 16:20:14', 1, '', 0, ''),
(280, 'profile', '', 'Mr.', 'Elmer', '', '31D', '31d.elmer@gmail.com', 'Project Manager', '+500', '9388751000', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 16:21:52', 1, '', 0, ''),
(281, 'profile', '', 'Mr.', 'Leo', '', '31D', '31d.leo@gmail.com', 'Business Development Officer and Account Manager', '+373', '9388751000', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 16:23:48', 1, '', 0, ''),
(282, 'profile', '1678003950_Jacobi 2x2.png', '', 'Arman', '', 'Certificate', '4arman@gmail.com', '', '+84', '55558888', 'Vietnam', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:37:18', 0, 'Negotiation, Corporate Events, Product Marketing, Public Relations, Event Marketing, and Event Coordination, Reservations\r\n', 0, ''),
(283, 'profile', '1678005570_Jacobi 2x2.png', '', 'Arman', 'L', 'College', '5arman@gmail.com', '', '+62', '9161234567', 'Indonesia', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:37:43', 0, 'Experienced Guest Relations Officer with a demonstrated history of working in the hospitality industry. Skilled in Hotel Management, Hospitality Industry, OPERA, Front Office, and Hospitality Management. Strong support professional with a Diploma focused in Rooms Division from Jakarta International Hotels School. \r\n\r\nExperienced Guest Relations Officer with a demonstrated history of working in the hospitality industry. Skilled in Hotel Management, Hospitality Industry, OPERA, Front Office, and Hospitality Management. Strong support professional with a Diploma focused in Rooms Division from Jakarta International Hotels School. \r\n\r\nExperienced Guest Relations Officer with a demonstrated history of working in the hospitality industry. Skilled in Hotel Management, Hospitality Industry, OPERA, Front Office, and Hospitality Management. Strong support professional with a Diploma focused in Rooms Division from Jakarta International Hotels School. ', 0, ''),
(284, 'profile', '', '', '', '', '', '6arman@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:38:04', 1, '', 0, ''),
(285, 'profile', '', '', '', '', '', '7arman@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:38:36', 1, '', 0, ''),
(286, 'profile', '', '', '', '', '', '8arman@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:39:09', 1, '', 0, ''),
(287, 'profile', '', '', '', '', '', '9arman@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:39:27', 1, '', 0, ''),
(288, 'profile', '', '', '', '', '', '10arman@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:39:54', 1, '', 0, ''),
(289, 'profile', '', '', '', '', '', '1donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:40:19', 1, '', 0, ''),
(290, 'profile', '', '', '', '', '', '2donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:40:38', 1, '', 0, ''),
(291, 'profile', '', '', '', '', '', '3donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:40:56', 1, '', 0, ''),
(292, 'profile', '', '', '', '', '', '4donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:41:11', 1, '', 0, ''),
(293, 'profile', '', '', '', '', '', '5donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:41:29', 1, '', 0, ''),
(294, 'profile', '', '', '', '', '', '6donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:41:44', 1, '', 0, ''),
(295, 'profile', '', '', '', '', '', '7donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:42:04', 1, '', 0, ''),
(296, 'profile', '', '', '', '', '', '8donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:43:15', 1, '', 0, ''),
(297, 'profile', '', '', '', '', '', '9donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:43:30', 1, '', 0, ''),
(298, 'profile', '', '', '', '', '', '10donie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:43:49', 1, '', 0, ''),
(299, 'profile', '', '', '', '', '', '1jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:44:08', 1, '', 0, ''),
(300, 'profile', '', '', '', '', '', '2jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:44:25', 1, '', 0, ''),
(301, 'profile', '', '', '', '', '', '3jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:44:41', 1, '', 0, ''),
(302, 'profile', '', '', '', '', '', '4jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:44:55', 1, '', 0, ''),
(303, 'profile', '', '', '', '', '', '5jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:45:08', 1, '', 0, ''),
(304, 'profile', '', '', '', '', '', '6jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:45:24', 1, '', 0, ''),
(305, 'profile', '', '', '', '', '', '7jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:45:39', 1, '', 0, ''),
(306, 'profile', '', '', '', '', '', '8jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:45:52', 1, '', 0, ''),
(307, 'profile', '', '', '', '', '', '9jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:46:08', 1, '', 0, ''),
(308, 'profile', '', '', '', '', '', '10jose@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-03 17:46:23', 1, '', 0, ''),
(309, 'profile', '1678171109_Dongs Lakwatsa.png', '', 'Elmer', '', 'Employee01', 'Employee01@gmail.com', '', '+358', '9388751000', 'Japan', '0.0000000', '0.0000000', '', '', '', '2023-03-07 14:18:17', 0, 'Provide support to marketing department.\r\nExecute marketing strategy.\r\nWork with marketing team to manage brand and marketing initiatives.\r\nDevelop and execute marketing campaigns.\r\nPerform market and client research.\r\nCreate reports on marketing performance.\r\nMaintain schedules for marketing initiatives.\r\nAssist with social media and website content.\r\nAttend trade shows, company events.\r\nOrganize and manage marketing collateral.\r\nStrong written and verbal communication skills\r\nHigh level of organization and attention to detail\r\nComfort with multi-tasking in a deadline-driven environment\r\nUnderstanding of basic business and marketing concepts\r\nExcellent time management skills\r\nOutgoing personality with strong interpersonal and social abilities\r\nAbility to spot emerging trends\r\nFamiliarity with social media, social networking, email marketing and search engines\r\nDemonstrated problem solving and critical thinking skills\r\nStrong writing and copy-editing abilities', 0, '1678170934_Resume.pdf'),
(310, 'profile', '1678172441_Dongs Lakwatsa.png', '', 'Elmer', '', 'Employee02', 'Employee02@gmail.com', '', '+77', '9388751000', 'Serbia', '0.0000000', '0.0000000', '', '', '', '2023-03-07 14:46:14', 1, 'planning and organising production schedules.\r\nassessing project and resource requirements.\r\nestimating, negotiating and agreeing budgets and timescales with clients and managers.\r\nensuring that health and safety regulations are met.\r\ndetermining quality control standards.\r\n\r\nplanning and organising production schedules.\r\nassessing project and resource requirements.\r\nestimating, negotiating and agreeing budgets and timescales with clients and managers.\r\nensuring that health and safety regulations are met.\r\ndetermining quality control standards.', 0, '1678172408_Resume.pdf'),
(311, 'profile', '', '', '', '', '', 'helloconnie@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-11 13:46:41', 1, '', 0, ''),
(312, 'profile', '', '', 'Anne', '', 'Diwata', 'gdiwata@thirtyonedigital.net', '', '+63', '9327397084', 'Albania', '0.0000000', '0.0000000', '', '', '', '2023-03-28 11:37:25', 0, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenati', 1, '1680075755_Dominic - Certificate of Completion and Invoice.pdf'),
(313, 'profile', '', '', 'Diwata', 'Arc', 'Anne', 'anne.diwata@gmail.com', '', '+63', '9154905846', 'Philippines', '0.0000000', '0.0000000', '', '', '', '2023-03-28 11:43:12', 0, '', 0, ''),
(314, 'profile', '', 'Mr.', 'John', '', 'Doe', 'aaganon@thirtyonedigital.net', 'Test', '+63', '9327397083', '', '0.0000000', '0.0000000', '', '', '', '2023-03-28 11:57:26', 1, '', 0, ''),
(315, 'profile', '', '', '', '', '', 'wmodern78@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-03-28 12:05:45', 1, '', 0, ''),
(316, 'profile', '', 'Mr.', 'Don', '', 'Arc', 'donarc@gmail.com', 'HR', '+63', '9171111111', '', '0.0000000', '0.0000000', '', '', '', '2023-03-29 14:05:45', 1, '', 0, ''),
(317, 'profile', '', 'Mr.', 'Thirty', '', 'One', 'thirtyone@gmail.com', 'Manager', '+93', '9388751000', '', '0.0000000', '0.0000000', '', '', '', '2023-03-31 14:46:24', 1, '', 0, ''),
(318, 'profile', '', '', '', '', '', 'thirtyoned@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-04-12 14:49:07', 1, '', 0, ''),
(319, 'profile', '', '', '', '', '', 'thirtyone.d@gmail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-04-12 16:03:09', 1, '', 0, ''),
(320, 'profile', '', '', '', '', '', 'Test@testemail.com', '', '', '', '', '0.0000000', '0.0000000', '', '', '', '2023-04-14 15:15:55', 1, '', 0, ''),
(321, 'profile', '', 'Mr.', 'Johnny ', '', 'Depp', 'JohnnyDepp@gmail.com', 'HR Assistant ', '+63', '9662563735', '', '0.0000000', '0.0000000', '', '', '', '2023-04-14 20:23:53', 1, '', 0, ''),
(322, 'profile', '1682044288_Error printing sales contract.png', '', 'John', '', 'Ladao', 'johnpaulladao106@gmail.com', '', '+63', '9171551303', 'Philippines', '0.0000000', '0.0000000', '', '', '', '2023-04-21 10:09:52', 0, '', 0, '1682044233_SB2 - Integrations Setup.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `oprofile_archive`
--

DROP TABLE IF EXISTS `oprofile_archive`;
CREATE TABLE `oprofile_archive` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile',
  `doc_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `honorifics` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dial_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `first_login` tinyint(1) NOT NULL DEFAULT 1,
  `highlights` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `internship` tinyint(1) NOT NULL,
  `resume` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `osignup`
--

DROP TABLE IF EXISTS `osignup`;
CREATE TABLE `osignup` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'signup',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `honorifics` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `work_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dial_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lng` decimal(11,7) NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `industry` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `osignup`
--

INSERT INTO `osignup` (`id`, `type`, `username`, `password`, `honorifics`, `user_type`, `first_name`, `last_name`, `work_email`, `dial_code`, `contact_number`, `company_name`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `designation`, `industry`, `status`, `date_created`) VALUES
(373, 'signup', 'dexmanreza@gmail.com', '', 'Mr.', 'company', 'Dex', 'Manreza', 'dexmanreza@gmail.com', '+63', '9171551303', 'IT Group Inc', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'OIC', 21, 2, '2023-03-01 13:11:57'),
(374, 'signup', 'JohnnyUtah@gmail.com', '', 'Mr.', 'company', 'Johnny', 'Utah', 'JohnnyUtah@gmail.com', '+63', '9161234567', 'New World Makati Hotel, Manila', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'HR Assistant', 26, 1, '2023-03-02 05:07:49'),
(375, 'signup', 'JohnnyBravo@gmail.com', '', 'Mr.', 'company', 'Johnny', 'Bravo', 'JohnnyBravo@gmail.com', '+63', '9161234568', 'Dusit Thani Manila', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'HR Manager', 26, 1, '2023-03-02 05:09:53'),
(376, 'signup', 'JohnnyCash@gmail.com', '', 'Mr.', 'company', 'Johnny', 'Cash', 'JohnnyCash@gmail.com', '+853', '66142945', 'Four Seasons Hotel Macao, Cotai Strip', 'Macau SAR', '0.0000000', '0.0000000', '', '', 'Macau SAR', 'HR Director', 26, 2, '2023-03-02 05:11:49'),
(377, 'signup', 'JohnyUtah@gmail.com', '', 'Mr.', 'company', 'Johny', 'Utah', 'JohnyUtah@gmail.com', '+63', '9161234567', 'New World Makati Hotel, Manila', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'HR Assistant', 26, 2, '2023-03-03 07:18:42'),
(378, 'signup', 'JohnyBravo@gmail.com', '', 'Mr.', 'company', 'Johnny', 'Bravo', 'JohnnyBravo@gmail.com', '+63', '9161234568', 'Dusit Thani Manila', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'HR Manager', 26, 2, '2023-03-03 07:21:01'),
(379, 'signup', 'JohnyCash@gmail.com', '', 'Mr.', 'company', 'Johnny', 'Cash', 'JohnnyCash@gmail.com', '+853', '66142946', 'Four Season Hotel Macao, Cotai Strip', 'Macau SAR', '0.0000000', '0.0000000', '', '', 'Macau SAR', 'HR Director', 26, 2, '2023-03-03 07:24:18'),
(380, 'signup', '31d.employer@gmail.com', '', 'Mr.', 'company', '31D', 'Employer', '31d.employer@gmail.com', '+63', '9388751000', 'Thirtyonedigital', 'South Korea', '0.0000000', '0.0000000', '', '', 'South Korea', 'System Admin', 21, 2, '2023-03-03 08:17:46'),
(381, 'signup', 'aaganon@thirtyonedigital.net', '', 'Mr.', 'company', 'John', 'Doe', 'aaganon@thirtyonedigital.net', '+63', '9154905847', '31D', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'test', 26, 2, '2023-03-28 03:53:16'),
(382, 'signup', 'donarc@gmail.com', '', 'Mr.', 'company', 'Don', 'Arc', 'donarc@gmail.com', '+63', '9171111111', '31DTest', 'Philippines', '0.0000000', '0.0000000', '', '', 'Philippines', 'HR', 16, 2, '2023-03-29 06:01:23'),
(383, 'signup', 'thirtyone@gmail.com', '', 'Mr.', 'company', 'Thirty', 'One', 'thirtyone@gmail.com', '+358', '9388751000', 'Thirty One', 'Djibouti', '0.0000000', '0.0000000', '', '', 'Djibouti', 'Manager', 21, 2, '2023-03-31 06:44:21'),
(384, 'signup', 'JohnnyDepp@gmail.com', '', 'Mr.', 'company', 'Johnny', 'Depp', 'JohnnyDepp@gmail.com', '+63', '9662569224', 'Banyan Tree Bangkok ', 'Thailand', '0.0000000', '0.0000000', '', '', 'Thailand', 'HR Assistant', 26, 2, '2023-04-14 12:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `ostatus`
--

DROP TABLE IF EXISTS `ostatus`;
CREATE TABLE `ostatus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `employer` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_logged_in` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `logged_in` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ousr`
--

INSERT INTO `ousr` (`id`, `type`, `name`, `username`, `password`, `email_add`, `user_type`, `inactive`, `employer`, `date_created`, `last_logged_in`, `password_changed`, `logged_in`) VALUES
(3, 'user', 'Phoenix Langaman', 'phoenixlangaman05@gmail.com', 'P@ssw0rd1234', 'phoenixlangaman05@gmail.com', 'admin', 0, 0, '2022-07-13 16:24:58', '04/21/2023 10:33 AM', 0, 0),
(265, 'user', '', 'arman1@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-02 13:02:56', '', 0, 0),
(266, 'user', '', 'arman2@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-02 13:03:21', '', 0, 0),
(267, 'user', '', 'arman3@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-02 13:03:34', '', 0, 0),
(268, 'user', 'Elmer Test', 'applicant_01@gmail.com', 'Passw0rd', 'applicant_01@gmail.com', 'applicant', 0, 0, '2023-03-02 20:36:35', '03/02/2023 08:39 PM', 0, 0),
(269, 'user', 'Arman Manager', 'arman13@gmail.com', 'HelloTest1', 'arman13@gmail.com', 'applicant', 0, 0, '2023-03-03 14:38:41', '03/03/2023 04:39 PM', 0, 0),
(270, 'user', 'Arman Director', 'arman14@gmail.com', 'HelloTest1', 'arman14@gmail.com', 'applicant', 0, 0, '2023-03-03 14:52:44', '03/03/2023 04:40 PM', 0, 0),
(271, 'user', 'Arman Entry', 'arman15@gmail.com', 'HelloTest1', 'arman15@gmail.com', 'applicant', 0, 0, '2023-03-03 14:54:50', '03/03/2023 04:40 PM', 0, 0),
(272, 'user', 'arman internship', 'arman01@gmail.com', 'HelloTest1', 'arman01@gmail.com', 'applicant', 0, 0, '2023-03-03 15:34:46', '03/21/2023 11:15 PM', 0, 0),
(273, 'user', 'Arman Vocational', 'arman02@gmail.com', 'HelloTest1', 'arman02@gmail.com', 'applicant', 0, 0, '2023-03-03 15:35:58', '03/11/2023 03:09 PM', 0, 0),
(274, 'user', 'Arman High School', 'arman03@gmail.com', 'HelloTest1', 'arman03@gmail.com', 'applicant', 0, 0, '2023-03-03 15:37:30', '03/11/2023 02:54 PM', 0, 0),
(275, 'user', 'Johnny Utah', 'JohnnyUtah@gmail.com', 'HelloTest1', 'JohnnyUtah@gmail.com', 'employer', 0, 88, '2023-03-03 15:46:54', '03/12/2023 09:51 AM', 1, 0),
(276, 'user', 'Johnny Bravo', 'JohnnyBravo@gmail.com', 'HelloTest1', 'JohnnyBravo@gmail.com', 'employer', 0, 89, '2023-03-03 15:48:51', '03/21/2023 11:21 PM', 1, 0),
(277, 'user', 'Johnny Cash', 'JohnnyCash@gmail.com', 'HelloTest1', 'JohnnyCash@gmail.com', 'employer', 0, 90, '2023-03-03 15:50:38', '04/19/2023 11:14 AM', 1, 0),
(278, 'user', 'Juan Dela Cruz', '31d.employee@gmail.com', 'Passw0rd', '31d.employee@gmail.com', 'applicant', 0, 0, '2023-03-03 16:11:11', '03/31/2023 04:27 PM', 0, 0),
(282, 'user', 'Arman Certificate', '4arman@gmail.com', 'HelloTest1', '4arman@gmail.com', 'applicant', 0, 0, '2023-03-03 17:37:18', '03/12/2023 09:59 AM', 0, 0),
(283, 'user', 'Arman College', '5arman@gmail.com', 'HelloTest1', '5arman@gmail.com', 'applicant', 0, 0, '2023-03-03 17:37:43', '03/10/2023 01:44 PM', 0, 0),
(284, 'user', '', '6arman@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:38:04', '', 0, 0),
(285, 'user', '', '7arman@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:38:36', '', 0, 0),
(286, 'user', '', '8arman@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:39:09', '', 0, 0),
(287, 'user', '', '9arman@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:39:27', '', 0, 0),
(288, 'user', '', '10arman@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:39:54', '', 0, 0),
(289, 'user', '', '1donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:40:19', '', 0, 0),
(290, 'user', '', '2donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:40:38', '', 0, 0),
(291, 'user', '', '3donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:40:56', '', 0, 0),
(292, 'user', '', '4donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:41:11', '', 0, 0),
(293, 'user', '', '5donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:41:29', '', 0, 0),
(294, 'user', '', '6donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:41:44', '', 0, 0),
(295, 'user', '', '7donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:42:04', '', 0, 0),
(296, 'user', '', '8donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:43:15', '', 0, 0),
(297, 'user', '', '9donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:43:30', '', 0, 0),
(298, 'user', '', '10donie@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:43:49', '', 0, 0),
(299, 'user', '', '1jose@gmail.com', 'HelloTest1', '', 'applicant', 0, 0, '2023-03-03 17:44:08', '03/04/2023 07:35 PM', 0, 0),
(300, 'user', '', '2jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:44:25', '', 0, 0),
(301, 'user', '', '3jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:44:41', '', 0, 0),
(302, 'user', '', '4jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:44:55', '', 0, 0),
(303, 'user', '', '5jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:45:08', '', 0, 0),
(304, 'user', '', '6jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:45:24', '', 0, 0),
(305, 'user', '', '7jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:45:39', '', 0, 0),
(306, 'user', '', '8jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:45:52', '', 0, 0),
(307, 'user', '', '9jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:46:08', '', 0, 0),
(308, 'user', '', '10jose@gmail.com', 'HelloTest1', '', 'applicant', 1, 0, '2023-03-03 17:46:23', '', 0, 0),
(309, 'user', 'Elmer Employee01', 'Employee01@gmail.com', 'Passw0rd', 'Employee01@gmail.com', 'applicant', 0, 0, '2023-03-07 14:18:17', '03/07/2023 02:21 PM', 0, 0),
(310, 'user', 'Elmer Employee02', 'Employee02@gmail.com', 'Passw0rd', 'Employee02@gmail.com', 'applicant', 0, 0, '2023-03-07 14:46:14', '03/07/2023 02:47 PM', 0, 0),
(311, 'user', '', 'helloconnie@gmail.com', 'Hoteleers2023', '', 'applicant', 1, 0, '2023-03-11 13:46:41', '', 0, 0),
(312, 'user', 'Anne Diwata', 'gdiwata@thirtyonedigital.net', 'Diwata123', 'gdiwata@thirtyonedigital.net', 'applicant', 0, 0, '2023-03-28 11:37:25', '04/04/2023 08:53 PM', 0, 0),
(313, 'user', 'Diwata Anne', 'anne.diwata@gmail.com', 'Diwata123', 'anne.diwata@gmail.com', 'applicant', 0, 0, '2023-03-28 11:43:12', '03/30/2023 01:28 PM', 0, 0),
(315, 'user', '', 'wmodern78@gmail.com', 'Aaganon31D', '', 'applicant', 1, 0, '2023-03-28 12:05:45', '', 0, 0),
(316, 'user', 'Don Arc', 'donarc@gmail.com', 'vVZf96Wa', 'donarc@gmail.com', 'employer', 0, 95, '2023-03-29 14:05:45', '03/30/2023 02:05 PM', 1, 0),
(318, 'user', '', 'thirtyoned@gmail.com', 'Passw0rd101', '', 'applicant', 1, 0, '2023-04-12 14:49:07', '', 0, 0),
(319, 'user', '', 'thirtyone.d@gmail.com', 'Passw0rd101', '', 'applicant', 1, 0, '2023-04-12 16:03:09', '', 0, 0),
(320, 'user', '', 'Test@testemail.com', 'Passw0rd101', '', 'applicant', 0, 0, '2023-04-14 15:15:55', '', 0, 0),
(321, 'user', 'Johnny  Depp', 'JohnnyDepp@gmail.com', 'Rejogusa103096', 'JohnnyDepp@gmail.com', 'employer', 0, 97, '2023-04-14 20:23:53', '04/21/2023 10:35 AM', 1, 0),
(322, 'user', 'John Ladao', 'johnpaulladao106@gmail.com', 'Admin1234', 'johnpaulladao106@gmail.com', 'applicant', 0, 0, '2023-04-21 10:09:52', '04/21/2023 10:30 AM', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ousr_archive`
--

DROP TABLE IF EXISTS `ousr_archive`;
CREATE TABLE `ousr_archive` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `employer` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_logged_in` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `logged_in` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ousr_archive`
--

INSERT INTO `ousr_archive` (`id`, `type`, `name`, `username`, `password`, `email_add`, `user_type`, `inactive`, `employer`, `date_created`, `last_logged_in`, `password_changed`, `logged_in`) VALUES
(279, 'user', 'Nix 31D', '31d.nix@gmail.com', '50A9kM9V', '31d.nix@gmail.com', 'employer', 0, 91, '2023-03-03 16:20:14', '', 0, 0),
(280, 'user', 'Elmer 31D', '31d.elmer@gmail.com', 'Passw0rd', '31d.elmer@gmail.com', 'employer', 0, 91, '2023-03-03 16:21:52', '03/03/2023 04:26 PM', 1, 0),
(281, 'user', 'Leo 31D', '31d.leo@gmail.com', 'Passw0rd', '31d.leo@gmail.com', 'employer', 0, 91, '2023-03-03 16:23:48', '03/03/2023 05:01 PM', 1, 0),
(314, 'user', 'John Doe', 'aaganon@thirtyonedigital.net', 'uGqTVwWA', 'aaganon@thirtyonedigital.net', 'employer', 0, 94, '2023-03-28 11:57:26', '03/28/2023 02:14 PM', 1, 0),
(317, 'user', 'Thirty One', 'thirtyone@gmail.com', 'Passw0rd101', 'thirtyone@gmail.com', 'employer', 0, 96, '2023-03-31 14:46:24', '04/12/2023 02:48 PM', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oyear`
--

DROP TABLE IF EXISTS `oyear`;
CREATE TABLE `oyear` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `from_range` int(11) NOT NULL,
  `to_range` int(11) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_affiliations',
  `line` int(11) NOT NULL,
  `affiliation` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_affiliations`
--

INSERT INTO `profile_affiliations` (`id`, `type`, `line`, `affiliation`) VALUES
(282, 'profile_affiliations', 1, 'Kiwanis Club of Saigon'),
(312, 'profile_affiliations', 1, 'tesssssst');

-- --------------------------------------------------------

--
-- Table structure for table `profile_awards_achievements`
--

DROP TABLE IF EXISTS `profile_awards_achievements`;
CREATE TABLE `profile_awards_achievements` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_awards_achievements',
  `line` int(11) NOT NULL,
  `award_achievement` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_awards_achievements`
--

INSERT INTO `profile_awards_achievements` (`id`, `type`, `line`, `award_achievement`) VALUES
(312, 'profile_awards_achievements', 1, 'tesssssst');

-- --------------------------------------------------------

--
-- Table structure for table `profile_certifications_licenses`
--

DROP TABLE IF EXISTS `profile_certifications_licenses`;
CREATE TABLE `profile_certifications_licenses` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_certifications_licenses',
  `line` int(11) NOT NULL,
  `certification` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_certifications_licenses`
--

INSERT INTO `profile_certifications_licenses` (`id`, `type`, `line`, `certification`) VALUES
(282, 'profile_certifications_licenses', 1, 'Certificate in Hotel Management '),
(312, 'profile_certifications_licenses', 1, 'dadad');

-- --------------------------------------------------------

--
-- Table structure for table `profile_department`
--

DROP TABLE IF EXISTS `profile_department`;
CREATE TABLE `profile_department` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_department',
  `line` int(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_department`
--

INSERT INTO `profile_department` (`id`, `type`, `line`, `department`) VALUES
(268, 'profile_department', 1, 3),
(269, 'profile_department', 1, 11),
(270, 'profile_department', 1, 20),
(271, 'profile_department', 1, 3),
(278, 'profile_department', 1, 3),
(283, 'profile_department', 1, 10),
(283, 'profile_department', 2, 9),
(283, 'profile_department', 3, 11),
(283, 'profile_department', 4, 21),
(283, 'profile_department', 5, 22),
(283, 'profile_department', 6, 39),
(274, 'profile_department', 1, 16),
(309, 'profile_department', 1, 4),
(310, 'profile_department', 1, 5),
(273, 'profile_department', 1, 11),
(273, 'profile_department', 2, 16),
(272, 'profile_department', 1, 5),
(282, 'profile_department', 1, 11),
(282, 'profile_department', 2, 19),
(282, 'profile_department', 3, 39),
(282, 'profile_department', 4, 10),
(282, 'profile_department', 5, 48),
(282, 'profile_department', 6, 23),
(282, 'profile_department', 7, 35),
(282, 'profile_department', 8, 30),
(282, 'profile_department', 9, 5),
(312, 'profile_department', 1, 3),
(313, 'profile_department', 1, 46),
(322, 'profile_department', 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `profile_education`
--

DROP TABLE IF EXISTS `profile_education`;
CREATE TABLE `profile_education` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_education',
  `line` int(11) NOT NULL,
  `school` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `degree` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `education` int(11) NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_education`
--

INSERT INTO `profile_education` (`id`, `type`, `line`, `school`, `degree`, `education`, `start_date`, `end_date`, `if_current`) VALUES
(268, 'profile_education', 1, 'Internationa University', 'Marketing', 521, '5/1/2019', '4/1/2019', 0),
(269, 'profile_education', 1, 'Hoteleers Univeristy', 'Hotel and Restaurant Management', 521, '5/1/2014', '5/1/2019', 0),
(270, 'profile_education', 1, 'Hoteleers University', 'Electrical', 275, '5/1/2019', '5/1/2021', 0),
(271, 'profile_education', 1, 'Hoteleers University', 'Management', 522, '5/1/2009', '5/1/2014', 0),
(278, 'profile_education', 1, 'San Jose College', 'Fine Arts', 521, '6/1/2010', '5/1/2014', 0),
(278, 'profile_education', 2, 'San Juan University', 'MBA', 522, '3/1/2023', '', 1),
(283, 'profile_education', 1, 'Jakarta International Hotel School', 'Rooms Division Management', 277, '6/1/2020', '3/1/2022', 0),
(274, 'profile_education', 1, 'Belgian High School', 'Secondary', 520, '3/1/2010', '3/1/2014', 0),
(309, 'profile_education', 1, 'URS Main', 'Marketing', 521, '5/1/2014', '5/1/2019', 0),
(310, 'profile_education', 1, 'FEU', 'Business Management', 277, '5/1/2008', '5/1/2012', 0),
(273, 'profile_education', 1, 'University of Makati', 'Catering', 0, '6/1/1991', '3/1/1995', 0),
(272, 'profile_education', 1, 'university of makati', 'nutrition', 521, '1/1/2018', '3/1/2023', 0),
(282, 'profile_education', 1, 'College of Hotel Management', 'Certificate in Rooms Division', 276, '3/1/2019', '2/1/2021', 0),
(312, 'profile_education', 1, 'PUP', 'IT', 521, '6/1/2019', '', 1),
(313, 'profile_education', 1, 'test', 'test', 277, '10/1/2000', '3/1/2023', 0),
(322, 'profile_education', 1, 'KNS', 'BSIT', 521, '7/1/2018', '8/1/2022', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile_experience`
--

DROP TABLE IF EXISTS `profile_experience`;
CREATE TABLE `profile_experience` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_experience',
  `line` int(11) NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_experience`
--

INSERT INTO `profile_experience` (`id`, `type`, `line`, `designation`, `company_name`, `short_description`, `start_date`, `end_date`, `if_current`, `date_created`) VALUES
(268, 'profile_experience', 1, 'Marketing Associate', 'International Company', 'Test_only', '4/1/2021', '4/1/2022', 0, '2023-03-02 21:31:14'),
(283, 'profile_experience', 1, 'Guest Service Agent', 'Four Points by Sheraton', 'Greeting guests upon arrival and making them feel welcomed.\r\nAdministering check-ins and check-outs.\r\nProviding front desk services to guests.\r\nAssigning rooms and taking care of administrative duties.\r\nDelivering mail and messages.\r\nProcessing guest payments.\r\nCoordinating with bell service and staff management.\r\nBeing a source of information to guests on various matters such as transport and restaurant advice.\r\nProcessing meal and beverage requests.\r\nAccommodating general and unique requests.\r\nDiffusing conflict or tense situations with guests.', '1/1/2022', '', 1, '2023-03-05 16:39:34'),
(283, 'profile_experience', 2, 'Guest Relations Officer', 'Hotel Borobudur Jakarta', 'Greet guests and provide them with superb customer service.\r\nEnsure the front desk is neat, presentable, and equipped with all the necessary supplies such as pens, forms, and paper.\r\nAnswer all client questions and incoming calls.\r\nRedirect phone calls to the appropriate department and take down messages.\r\nAccept all letters and packages, and distribute them to their appropriate departments.\r\nMonitor, organize and forward emails.\r\nTrack and order office equipment and supplies.\r\nMaintain records and files.', '12/1/2018', '1/1/2022', 0, '2023-03-05 16:39:34'),
(274, 'profile_experience', 2, 'Sous Chef', 'The Ritz Carlton Jakarta', 'Develop new menu options based on seasonal changes and customer demand.\r\nAssist with the preparation and planning of meal designs.\r\nEnsure that kitchen activities operate in a timely manner.\r\nResolve customer problems and concerns personally.\r\nMonitor and record inventory, and if necessary, order new supplies.\r\nProvide support to junior kitchen employees with various tasks including line cooking, food preparation, and dish plating.\r\nRecruit and train new kitchen employees to meet restaurant and kitchen standards.\r\nCreate schedules for kitchen employees and evaluate their performance.\r\nAdhere t', '4/1/2016', '4/1/2021', 0, '2023-03-06 00:20:18'),
(274, 'profile_experience', 1, 'Line Cook', 'Mandarin Oriental Bangkok', 'Ensuring the preparation station and the kitchen are set up and stocked.\r\nPreparing simple components of each dish on the menu by chopping vegetables, cutting meat, and preparing sauces.\r\nReporting to the executive chef and following instructions.\r\nMaking sure food preparation and storage areas meet health and safety standards.\r\nCleaning prep areas and taking care of leftovers.\r\nStocking inventory and supplies.\r\nCooking menu items with the support of the kitchen staff.', '3/1/2014', '3/1/2016', 0, '2023-03-06 00:20:18'),
(274, 'profile_experience', 2, 'Sous Chef', 'Kempinski Bangkok', 'Develop new menu options based on seasonal changes and customer demand.\r\nAssist with the preparation and planning of meal designs.\r\nEnsure that kitchen activities operate in a timely manner.\r\nResolve customer problems and concerns personally.\r\nMonitor and record inventory, and if necessary, order new supplies.\r\nProvide support to junior kitchen employees with various tasks including line cooking, food preparation, and dish plating.\r\nRecruit and train new kitchen employees to meet restaurant and kitchen standards.\r\nCreate schedules for kitchen employees and evaluate their performance.\r\nAdhere t', '4/1/2021', '', 1, '2023-03-06 00:20:18'),
(309, 'profile_experience', 1, 'Marketing Assistant', 'McDonalds', '* Undertake daily administrative tasks to ensure the functionality and coordination of the department’s activities\r\n* Support marketing executives in organizing various projects\r\n* Conduct market research and analyze consumer rating reports/ questionnaires', '3/1/2023', '4/1/2024', 0, '2023-03-07 14:42:58'),
(310, 'profile_experience', 1, 'Production Manager', 'Baked', 'planning and organising production schedules.\r\nassessing project and resource requirements.\r\nestimating, negotiating and agreeing budgets and timescales with clients and managers.\r\nensuring that health and safety regulations are met.\r\ndetermining quality control standards.', '5/1/2019', '1/1/2023', 0, '2023-03-07 15:00:46'),
(282, 'profile_experience', 1, 'Account Executive', 'Acacia Hotel Bacolod ', 'Sales Operations · Sales · Deal Closure · Finding Deals ·   · Request for Quotation (RFQ) · Exceeding Quotas · Exceeding Targets · Upselling · Telemarketing · email blast · Proposal Writing', '3/1/2022', '', 1, '2023-03-12 10:03:20'),
(282, 'profile_experience', 2, 'Reservations Agent', 'Hyatt Hotel Manila', 'Assisting and advising customers who may be choosing from a variety of travel options.\r\nMaking reservations for customers based on their various requirements and budgetary allowances.\r\nChecking the availability of accommodation or transportation on the customers’ desired travel dates.\r\nHelping plan travel itineraries by suggesting local tourist attractions and places of interest.\r\nProcessing payments and sending confirmation details to customers.\r\nSorting out any issues that may arise with bookings or reservations.\r\nSelling and promoting reservation services.\r\nAnswering any questions customers', '6/1/2021', '2/1/2022', 0, '2023-03-12 10:03:20'),
(312, 'profile_experience', 1, 'Chef', '31D', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenati', '2/1/2023', '', 1, '2023-03-29 16:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `profile_industry`
--

DROP TABLE IF EXISTS `profile_industry`;
CREATE TABLE `profile_industry` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_industry',
  `line` int(11) NOT NULL,
  `industry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_industry`
--

INSERT INTO `profile_industry` (`id`, `type`, `line`, `industry`) VALUES
(268, 'profile_industry', 1, 11),
(269, 'profile_industry', 1, 26),
(270, 'profile_industry', 1, 23),
(271, 'profile_industry', 1, 11),
(278, 'profile_industry', 1, 26),
(278, 'profile_industry', 2, 11),
(283, 'profile_industry', 1, 26),
(283, 'profile_industry', 2, 28),
(283, 'profile_industry', 3, 19),
(283, 'profile_industry', 4, 24),
(283, 'profile_industry', 5, 14),
(283, 'profile_industry', 6, 32),
(274, 'profile_industry', 1, 26),
(274, 'profile_industry', 2, 19),
(309, 'profile_industry', 1, 26),
(310, 'profile_industry', 1, 15),
(273, 'profile_industry', 1, 26),
(272, 'profile_industry', 1, 32),
(282, 'profile_industry', 1, 26),
(282, 'profile_industry', 2, 28),
(282, 'profile_industry', 3, 19),
(282, 'profile_industry', 4, 24),
(282, 'profile_industry', 5, 32),
(282, 'profile_industry', 6, 16),
(282, 'profile_industry', 7, 23),
(312, 'profile_industry', 1, 26),
(313, 'profile_industry', 1, 24),
(322, 'profile_industry', 1, 26),
(322, 'profile_industry', 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_level`
--

DROP TABLE IF EXISTS `profile_job_level`;
CREATE TABLE `profile_job_level` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_job_level',
  `line` int(11) NOT NULL,
  `job_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_job_level`
--

INSERT INTO `profile_job_level` (`id`, `type`, `line`, `job_level`) VALUES
(268, 'profile_job_level', 1, 8),
(269, 'profile_job_level', 1, 9),
(270, 'profile_job_level', 1, 8),
(271, 'profile_job_level', 1, 10),
(278, 'profile_job_level', 1, 9),
(283, 'profile_job_level', 1, 8),
(274, 'profile_job_level', 1, 8),
(274, 'profile_job_level', 2, 9),
(309, 'profile_job_level', 1, 9),
(310, 'profile_job_level', 1, 8),
(273, 'profile_job_level', 1, 8),
(272, 'profile_job_level', 1, 8),
(282, 'profile_job_level', 1, 8),
(312, 'profile_job_level', 1, 8),
(313, 'profile_job_level', 1, 10),
(322, 'profile_job_level', 1, 9),
(322, 'profile_job_level', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_preference`
--

DROP TABLE IF EXISTS `profile_job_preference`;
CREATE TABLE `profile_job_preference` (
  `id` int(11) NOT NULL,
  `line` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `job_level` int(11) NOT NULL,
  `job_type` int(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_type`
--

DROP TABLE IF EXISTS `profile_job_type`;
CREATE TABLE `profile_job_type` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_job_type',
  `line` int(11) NOT NULL,
  `job_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_job_type`
--

INSERT INTO `profile_job_type` (`id`, `type`, `line`, `job_type`) VALUES
(268, 'profile_job_type', 1, 41),
(269, 'profile_job_type', 1, 41),
(270, 'profile_job_type', 1, 43),
(271, 'profile_job_type', 1, 44),
(278, 'profile_job_type', 1, 41),
(278, 'profile_job_type', 2, 42),
(283, 'profile_job_type', 1, 43),
(283, 'profile_job_type', 2, 42),
(274, 'profile_job_type', 1, 43),
(274, 'profile_job_type', 2, 41),
(274, 'profile_job_type', 3, 42),
(309, 'profile_job_type', 1, 41),
(310, 'profile_job_type', 1, 44),
(273, 'profile_job_type', 1, 43),
(273, 'profile_job_type', 2, 42),
(273, 'profile_job_type', 3, 44),
(272, 'profile_job_type', 1, 43),
(282, 'profile_job_type', 1, 41),
(282, 'profile_job_type', 2, 42),
(282, 'profile_job_type', 3, 43),
(312, 'profile_job_type', 1, 42),
(313, 'profile_job_type', 1, 45),
(322, 'profile_job_type', 1, 43),
(322, 'profile_job_type', 2, 41);

-- --------------------------------------------------------

--
-- Table structure for table `profile_language`
--

DROP TABLE IF EXISTS `profile_language`;
CREATE TABLE `profile_language` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_language',
  `line` int(11) NOT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_language`
--

INSERT INTO `profile_language` (`id`, `type`, `line`, `language`) VALUES
(268, 'profile_language', 1, 'Korean'),
(269, 'profile_language', 1, 'English'),
(270, 'profile_language', 1, 'English'),
(271, 'profile_language', 1, 'Englsih'),
(278, 'profile_language', 1, 'English'),
(278, 'profile_language', 2, 'Filipino'),
(283, 'profile_language', 1, 'Indonesian'),
(283, 'profile_language', 2, 'English'),
(283, 'profile_language', 3, 'Russian'),
(283, 'profile_language', 4, 'Cantonese'),
(283, 'profile_language', 5, 'French'),
(274, 'profile_language', 1, 'Russian'),
(274, 'profile_language', 2, 'Spanish'),
(274, 'profile_language', 3, 'Mandarin'),
(309, 'profile_language', 1, 'English'),
(273, 'profile_language', 1, 'French'),
(273, 'profile_language', 2, 'English'),
(272, 'profile_language', 1, 'filipino'),
(282, 'profile_language', 1, 'English'),
(282, 'profile_language', 2, 'Spanish'),
(282, 'profile_language', 3, 'French'),
(312, 'profile_language', 1, 'Arabic'),
(313, 'profile_language', 1, 'Filipino'),
(322, 'profile_language', 1, 'English'),
(322, 'profile_language', 2, 'Tagalog');

-- --------------------------------------------------------

--
-- Table structure for table `profile_projects`
--

DROP TABLE IF EXISTS `profile_projects`;
CREATE TABLE `profile_projects` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_projects',
  `line` int(11) NOT NULL,
  `projects` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_projects`
--

INSERT INTO `profile_projects` (`id`, `type`, `line`, `projects`) VALUES
(312, 'profile_projects', 1, 'adad');

-- --------------------------------------------------------

--
-- Table structure for table `profile_seminars_trainings`
--

DROP TABLE IF EXISTS `profile_seminars_trainings`;
CREATE TABLE `profile_seminars_trainings` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_seminars_trainings',
  `line` int(11) NOT NULL,
  `seminar_training` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_seminars_trainings`
--

INSERT INTO `profile_seminars_trainings` (`id`, `type`, `line`, `seminar_training`) VALUES
(312, 'profile_seminars_trainings', 1, 'tesssssst');

-- --------------------------------------------------------

--
-- Table structure for table `profile_skills`
--

DROP TABLE IF EXISTS `profile_skills`;
CREATE TABLE `profile_skills` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_skills',
  `line` int(11) NOT NULL,
  `skills` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_skills`
--

INSERT INTO `profile_skills` (`id`, `type`, `line`, `skills`) VALUES
(268, 'profile_skills', 1, 'Riding'),
(283, 'profile_skills', 1, 'Opera PMS'),
(283, 'profile_skills', 2, 'Micros'),
(283, 'profile_skills', 3, 'customer service'),
(274, 'profile_skills', 1, 'european cuisine'),
(274, 'profile_skills', 2, 'french cuisine'),
(274, 'profile_skills', 3, 'spanish cuisine'),
(309, 'profile_skills', 1, 'Marketing'),
(309, 'profile_skills', 2, 'Public speaking'),
(309, 'profile_skills', 3, 'Customer service'),
(282, 'profile_skills', 1, 'Deal Closure'),
(282, 'profile_skills', 2, 'Client Relations'),
(282, 'profile_skills', 3, 'Upselling '),
(282, 'profile_skills', 4, 'Telemarketing '),
(312, 'profile_skills', 1, 'angry');

-- --------------------------------------------------------

--
-- Table structure for table `usr_job_invite`
--

DROP TABLE IF EXISTS `usr_job_invite`;
CREATE TABLE `usr_job_invite` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usr_job_invite',
  `job_post` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usr_job_invite`
--

INSERT INTO `usr_job_invite` (`id`, `type`, `job_post`, `date_created`) VALUES
(271, 'usr_job_invite', 265, '2023-03-03 11:45:24'),
(282, 'usr_job_invite', 270, '2023-03-05 09:18:17'),
(283, 'usr_job_invite', 273, '2023-03-05 09:40:09'),
(271, 'usr_job_invite', 273, '2023-03-05 09:40:33'),
(274, 'usr_job_invite', 275, '2023-03-05 16:24:43'),
(274, 'usr_job_invite', 276, '2023-03-07 07:36:12'),
(312, 'usr_job_invite', 272, '2023-03-28 07:12:40'),
(312, 'usr_job_invite', 279, '2023-03-29 08:01:13'),
(312, 'usr_job_invite', 273, '2023-03-30 05:23:10'),
(312, 'usr_job_invite', 274, '2023-03-30 05:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `usr_job_post_fav`
--

DROP TABLE IF EXISTS `usr_job_post_fav`;
CREATE TABLE `usr_job_post_fav` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usr_job_post_fav',
  `job_post` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usr_job_post_fav`
--

INSERT INTO `usr_job_post_fav` (`id`, `type`, `job_post`, `date_created`) VALUES
(272, 'usr_job_post_fav', 258, '2023-03-03 08:55:32'),
(282, 'usr_job_post_fav', 260, '2023-03-05 08:28:20'),
(283, 'usr_job_post_fav', 260, '2023-03-05 08:40:00'),
(283, 'usr_job_post_fav', 263, '2023-03-05 08:40:08'),
(283, 'usr_job_post_fav', 265, '2023-03-05 08:40:21'),
(283, 'usr_job_post_fav', 262, '2023-03-05 08:40:34'),
(282, 'usr_job_post_fav', 272, '2023-03-05 10:04:31'),
(282, 'usr_job_post_fav', 271, '2023-03-05 10:04:34'),
(282, 'usr_job_post_fav', 264, '2023-03-05 10:05:36'),
(310, 'usr_job_post_fav', 274, '2023-03-07 07:03:34'),
(274, 'usr_job_post_fav', 265, '2023-03-11 05:29:01'),
(278, 'usr_job_post_fav', 276, '2023-03-21 07:18:53'),
(312, 'usr_job_post_fav', 261, '2023-03-28 07:38:38'),
(312, 'usr_job_post_fav', 265, '2023-03-29 05:59:41'),
(312, 'usr_job_post_fav', 262, '2023-03-29 07:47:26'),
(312, 'usr_job_post_fav', 277, '2023-03-29 07:56:29'),
(322, 'usr_job_post_fav', 287, '2023-04-21 02:16:31');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `oaud`
--
ALTER TABLE `oaud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9983;

--
-- AUTO_INCREMENT for table `ocurrency`
--
ALTER TABLE `ocurrency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `odepartment`
--
ALTER TABLE `odepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `oeducation`
--
ALTER TABLE `oeducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;

--
-- AUTO_INCREMENT for table `oemail_template`
--
ALTER TABLE `oemail_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oemployer`
--
ALTER TABLE `oemployer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `oemployer_position`
--
ALTER TABLE `oemployer_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ohomepage_banner`
--
ALTER TABLE `ohomepage_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `oindustry`
--
ALTER TABLE `oindustry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ojob_level`
--
ALTER TABLE `ojob_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ojob_post`
--
ALTER TABLE `ojob_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `ojob_type`
--
ALTER TABLE `ojob_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `olanguage`
--
ALTER TABLE `olanguage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `olocation`
--
ALTER TABLE `olocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `operks_and_benefits`
--
ALTER TABLE `operks_and_benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `osignup`
--
ALTER TABLE `osignup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `ostatus`
--
ALTER TABLE `ostatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ousr`
--
ALTER TABLE `ousr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `oyear`
--
ALTER TABLE `oyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
