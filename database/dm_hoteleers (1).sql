-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 06:59 PM
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
  `id` int(20) NOT NULL,
  `line` int(10) NOT NULL,
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
(17, 1, '1657798231_donnie-rosie-taO2fC7sxDU-unsplash.jpg', '4.364'),
(17, 2, '1657798231_pexels-craig-adderley-1563356.jpg', '5.840'),
(17, 3, '1659582268_prf.jpg', '0.010');

-- --------------------------------------------------------

--
-- Table structure for table `employer_saved_applicant`
--

DROP TABLE IF EXISTS `employer_saved_applicant`;
CREATE TABLE `employer_saved_applicant` (
  `id` int(20) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'employer_saved_applicant',
  `user_id` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employer_saved_applicant`
--

INSERT INTO `employer_saved_applicant` (`id`, `type`, `user_id`, `date_created`) VALUES
(77, 'employer_saved_applicant', 75, '2022-08-04 06:12:25'),
(77, 'employer_saved_applicant', 78, '2022-08-04 08:06:44'),
(77, 'employer_saved_applicant', 80, '2022-08-04 11:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_applicant`
--

DROP TABLE IF EXISTS `job_post_applicant`;
CREATE TABLE `job_post_applicant` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_applicant',
  `user_id` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_for_interview`
--

DROP TABLE IF EXISTS `job_post_for_interview`;
CREATE TABLE `job_post_for_interview` (
  `id` int(20) NOT NULL,
  `job_post_id` int(20) NOT NULL,
  `line` int(10) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_for_interview',
  `user_id` int(20) NOT NULL,
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
  `created_by` int(20) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_move_to`
--

DROP TABLE IF EXISTS `job_post_move_to`;
CREATE TABLE `job_post_move_to` (
  `id` int(20) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_move_to',
  `user_id` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_report`
--

DROP TABLE IF EXISTS `job_post_report`;
CREATE TABLE `job_post_report` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_report',
  `user_id` int(20) NOT NULL,
  `comment` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_views`
--

DROP TABLE IF EXISTS `job_post_views`;
CREATE TABLE `job_post_views` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post_views',
  `user_id` int(20) NOT NULL,
  `points` int(11) NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oaud`
--

DROP TABLE IF EXISTS `oaud`;
CREATE TABLE `oaud` (
  `id` int(20) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `action` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `record_id` int(20) NOT NULL,
  `record_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `line` int(10) NOT NULL DEFAULT 0,
  `record_field` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `record_field_old_value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `record_field_new_value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oaud`
--

INSERT INTO `oaud` (`id`, `username`, `user_id`, `action`, `record_id`, `record_type`, `line`, `record_field`, `record_field_old_value`, `record_field_new_value`, `date_time`) VALUES
(1541, '', 75, 'created', 0, 'profile_industry', 0, '', '', '', '2022-07-19 16:01:35'),
(1542, '', 75, 'created', 1, 'profile_industry', 0, '', '', '', '2022-07-19 16:01:35'),
(1543, '', 75, 'created', 0, 'profile_job_level', 0, '', '', '', '2022-07-19 16:01:35'),
(1544, '', 75, 'created', 1, 'profile_job_level', 0, '', '', '', '2022-07-19 16:01:35'),
(1545, '', 75, 'created', 2, 'profile_job_level', 0, '', '', '', '2022-07-19 16:01:35'),
(1546, '', 75, 'created', 0, 'profile_job_type', 0, '', '', '', '2022-07-19 16:01:35'),
(1547, '', 75, 'created', 1, 'profile_job_type', 0, '', '', '', '2022-07-19 16:01:35'),
(1548, '', 75, 'created', 2, 'profile_job_type', 0, '', '', '', '2022-07-19 16:01:35'),
(1549, '', 75, 'created', 0, 'profile_department', 0, '', '', '', '2022-07-19 16:01:35'),
(1550, '', 75, 'created', 0, 'profile_industry', 0, '', '', '', '2022-07-19 16:08:09'),
(1551, '', 75, 'created', 0, 'profile_job_level', 0, '', '', '', '2022-07-19 16:08:09'),
(1552, '', 75, 'created', 0, 'profile_job_type', 0, '', '', '', '2022-07-19 16:08:09'),
(1553, '', 75, 'created', 0, 'profile_department', 0, '', '', '', '2022-07-19 16:08:09'),
(1554, '', 75, 'created', 0, 'profile_industry', 0, '', '', '', '2022-07-19 16:09:59'),
(1555, '', 75, 'created', 1, 'profile_industry', 0, '', '', '', '2022-07-19 16:09:59'),
(1556, '', 75, 'created', 2, 'profile_industry', 0, '', '', '', '2022-07-19 16:09:59'),
(1557, '', 75, 'created', 3, 'profile_industry', 0, '', '', '', '2022-07-19 16:09:59'),
(1558, '', 75, 'created', 4, 'profile_industry', 0, '', '', '', '2022-07-19 16:09:59'),
(1559, '', 75, 'created', 0, 'profile_job_level', 0, '', '', '', '2022-07-19 16:09:59'),
(1560, '', 75, 'created', 1, 'profile_job_level', 0, '', '', '', '2022-07-19 16:09:59'),
(1561, '', 75, 'created', 0, 'profile_job_type', 0, '', '', '', '2022-07-19 16:09:59'),
(1562, '', 75, 'created', 1, 'profile_job_type', 0, '', '', '', '2022-07-19 16:09:59'),
(1563, '', 75, 'created', 0, 'profile_department', 0, '', '', '', '2022-07-19 16:09:59'),
(1564, '', 75, 'created', 1, 'profile_department', 0, '', '', '', '2022-07-19 16:09:59'),
(1565, '', 75, 'created', 2, 'profile_department', 0, '', '', '', '2022-07-19 16:09:59'),
(1566, '', 75, 'created', 3, 'profile_department', 0, '', '', '', '2022-07-19 16:09:59'),
(1567, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-19 16:27:49'),
(1568, '', 69, 'logged in', 0, 'login', 0, '', '', '', '2022-07-19 16:28:09'),
(1569, '', 69, 'created', 5, 'job_post', 0, '', '', '', '2022-07-19 16:30:34'),
(1570, '', 69, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-19 16:31:10'),
(1571, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-19 16:31:19'),
(1572, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-19 19:10:03'),
(1573, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-19 21:51:13'),
(1574, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-19 21:51:15'),
(1575, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-19 21:51:29'),
(1576, '', 69, 'logged in', 0, 'login', 0, '', '', '', '2022-07-19 21:51:48'),
(1577, '', 69, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-19 21:52:57'),
(1578, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-19 21:53:07'),
(1579, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-19 22:45:44'),
(1580, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-20 09:31:54'),
(1581, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-20 10:46:35'),
(1582, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-20 15:18:36'),
(1583, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-20 20:04:55'),
(1584, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-20 20:05:42'),
(1585, '', 75, 'updated', 75, 'applicant_info', 0, 'doc_image', '', '1658325387_photo.png', '2022-07-20 21:57:13'),
(1586, '', 75, 'updated', 75, 'applicant_info', 0, 'first_name', '', 'Phoenix', '2022-07-20 21:57:13'),
(1587, '', 75, 'updated', 75, 'applicant_info', 0, 'middle_name', '', 'Corpus', '2022-07-20 21:57:13'),
(1588, '', 75, 'updated', 75, 'applicant_info', 0, 'last_name', '', 'Langaman', '2022-07-20 21:57:13'),
(1589, '', 75, 'updated', 75, 'applicant_info', 0, 'dial_code', '', '+63', '2022-07-20 21:57:13'),
(1590, '', 75, 'updated', 75, 'applicant_info', 0, 'contact_number', '', '9171551303', '2022-07-20 21:57:13'),
(1591, '', 75, 'updated', 75, 'applicant_info', 0, 'location', '', 'San Mateo, Rizal, Philippines', '2022-07-20 21:57:13'),
(1592, '', 75, 'updated', 75, 'applicant_info', 0, 'lat', '0.0000000', '14.6958933', '2022-07-20 21:57:13'),
(1593, '', 75, 'updated', 75, 'applicant_info', 0, 'lng', '0.0000000', '121.1216992', '2022-07-20 21:57:13'),
(1594, '', 75, 'updated', 75, 'applicant_info', 0, 'locality', '', 'San Mateo', '2022-07-20 21:57:13'),
(1595, '', 75, 'updated', 75, 'applicant_info', 0, 'administrative_area_', '', 'Calabarzon', '2022-07-20 21:57:13'),
(1596, '', 75, 'updated', 75, 'applicant_info', 0, 'country', '', 'Philippines', '2022-07-20 21:57:13'),
(1597, '', 75, 'updated', 75, 'applicant_info', 0, 'highlights', '', 'fsaf', '2022-07-20 21:57:13'),
(1598, '', 75, 'updated', 75, 'applicant_info', 0, 'resume', '', '1658325395_CV-Phoenix-Langaman.docx', '2022-07-20 21:57:13'),
(1599, '', 75, 'updated', 75, 'applicant_info', 0, 'resume', '1658325395_CV-Phoenix-Langaman.docx', '', '2022-07-20 22:35:20'),
(1600, '', 75, 'updated', 75, 'applicant_info', 0, 'resume', '', '1658327738_CV-Phoenix-Langaman.docx', '2022-07-20 22:35:42'),
(1601, '', 75, 'updated', 75, 'applicant_info', 0, 'resume', '1658327738_CV-Phoenix-Langaman.docx', '', '2022-07-20 22:41:00'),
(1602, '', 75, 'updated', 75, 'applicant_info', 0, 'resume', '', '1658328945_CV-Phoenix-Langaman.docx', '2022-07-20 22:55:50'),
(1603, '', 75, 'updated', 75, 'applicant_info', 0, 'internship', '0', '1', '2022-07-20 23:07:08'),
(1604, '', 75, 'updated', 75, 'applicant_info', 0, 'internship', '1', '0', '2022-07-20 23:08:33'),
(1605, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-21 09:28:14'),
(1606, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-21 09:28:36'),
(1607, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-21 20:47:08'),
(1608, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-21 21:59:55'),
(1609, '', 75, 'updated', 75, 'applicant_info', 0, 'location', 'San Mateo, Rizal, Philippines', 'San Marcelino, Zambales, Philippines', '2022-07-21 23:24:04'),
(1610, '', 75, 'updated', 75, 'applicant_info', 0, 'lat', '14.6958933', '15.026051', '2022-07-21 23:24:04'),
(1611, '', 75, 'updated', 75, 'applicant_info', 0, 'lng', '121.1216992', '120.2743484', '2022-07-21 23:24:04'),
(1612, '', 75, 'updated', 75, 'applicant_info', 0, 'locality', 'San Mateo', 'San Marcelino', '2022-07-21 23:24:04'),
(1613, '', 75, 'updated', 75, 'applicant_info', 0, 'administrative_area_', 'Calabarzon', 'Central Luzon', '2022-07-21 23:24:04'),
(1614, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-21 23:24:17'),
(1615, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-21 23:24:35'),
(1616, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 07:00:07'),
(1617, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 07:03:22'),
(1618, '', 75, 'updated', 75, 'applicant_info', 0, 'internship', '0', '1', '2022-07-22 07:53:25'),
(1619, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:09:57'),
(1620, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:10:16'),
(1621, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:11:24'),
(1622, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:11:31'),
(1623, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:19:04'),
(1624, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:20:25'),
(1625, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:31:06'),
(1626, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:31:15'),
(1627, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:36:38'),
(1628, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:38:47'),
(1629, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:40:55'),
(1630, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:40:57'),
(1631, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:51:57'),
(1632, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:51:59'),
(1633, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:52:27'),
(1634, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:52:28'),
(1635, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 08:55:00'),
(1636, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 08:55:01'),
(1637, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 15:51:52'),
(1638, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 15:52:16'),
(1639, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 15:52:49'),
(1640, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 15:53:15'),
(1641, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 18:26:42'),
(1642, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 18:26:45'),
(1643, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 20:19:28'),
(1644, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 20:25:59'),
(1645, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 20:26:16'),
(1646, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 20:49:02'),
(1647, '', 69, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 20:49:29'),
(1648, '', 69, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 21:23:07'),
(1649, '', 69, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 21:23:09'),
(1650, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-22 22:17:18'),
(1651, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-22 22:54:50'),
(1652, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-23 13:57:40'),
(1653, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-23 13:58:02'),
(1654, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-23 14:11:37'),
(1655, '', 3, 'updated', 18, 'employer', 0, 'about', '', 'Mangilag Sur', '2022-07-23 21:13:44'),
(1656, '', 3, 'updated', 18, 'employer', 0, 'website', '', 'www.prbfi.com', '2022-07-23 21:13:44'),
(1657, '', 3, 'updated', 18, 'employer', 0, 'dial_code', '', '+63', '2022-07-23 21:13:44'),
(1658, '', 3, 'updated', 18, 'employer', 0, 'contact_number', '', '9171551303', '2022-07-23 21:13:44'),
(1659, '', 3, 'updated', 18, 'employer', 0, 'start_date', '', '7/22/2022', '2022-07-23 21:13:44'),
(1660, '', 3, 'updated', 18, 'employer', 0, 'start_time', '', '9:00 AM', '2022-07-23 21:13:44'),
(1661, '', 3, 'updated', 18, 'employer', 0, 'end_date', '', '7/23/2022', '2022-07-23 21:13:44'),
(1662, '', 3, 'updated', 18, 'employer', 0, 'end_time', '', '9:00 AM', '2022-07-23 21:13:44'),
(1663, '', 3, 'updated', 18, 'employer', 0, 'other_notes', '', 'Test', '2022-07-23 21:13:44'),
(1664, '', 3, 'updated', 18, 'employer', 0, 'end_date', '7/23/2022', '7/23/2023', '2022-07-23 21:14:16'),
(1665, '', 3, 'created', 76, 'user', 0, '', '', '', '2022-07-23 21:15:01'),
(1666, '', 3, 'created', 76, 'profile', 0, '', '', '', '2022-07-23 21:15:01'),
(1667, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-23 21:15:27'),
(1668, '', 76, 'logged in', 0, 'login', 0, '', '', '', '2022-07-23 21:15:38'),
(1669, '', 76, 'created', 6, 'job_post', 0, '', '', '', '2022-07-23 21:18:30'),
(1670, '', 76, 'updated', 18, 'employer', 0, 'doc_image', '', '1658582778_prf.jpg', '2022-07-23 21:26:23'),
(1671, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-23 22:03:30'),
(1672, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-23 22:20:19'),
(1673, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-23 22:20:20'),
(1674, '', 76, 'created', 7, 'job_post', 0, '', '', '', '2022-07-23 22:37:23'),
(1675, '', 76, 'updated', 7, 'job_post', 0, 'inactive', '1', '0', '2022-07-23 22:54:37'),
(1676, '', 76, 'created', 8, 'job_post', 0, '', '', '', '2022-07-23 22:56:42'),
(1677, '', 76, 'updated', 8, 'job_post', 0, 'inactive', '1', '0', '2022-07-23 22:57:18'),
(1678, '', 76, 'updated', 7, 'job_post', 0, 'job_expiration_date', '7/22/2022', '7/30/2022', '2022-07-23 23:00:50'),
(1679, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 07:53:22'),
(1680, '', 76, 'created', 9, 'job_post', 0, '', '', '', '2022-07-24 08:27:47'),
(1681, '', 76, 'updated', 9, 'job_post', 0, 'inactive', '1', '0', '2022-07-24 08:28:02'),
(1682, '', 76, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 15:14:18'),
(1683, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 15:14:30'),
(1684, '', 3, 'updated', 18, 'employer', 0, 'about', 'Mangilag Sur', 'Pacific Royal Basic Foods Inc. (PRBFI) is a highly regarded Philippine producer of desiccated and value-added coconut products. Our Sunripe brand is a preferred ingredient in a broad range of applications in the global food business.\r\n\r\n\r\nWe are a company that has chosen to first commit our resources to the continual improvement and development of our people, products and services ahead of any plans for expansion. Beyond this commitment to quality, we are determined to maintain our products rele', '2022-07-24 15:15:20'),
(1685, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 15:15:44'),
(1686, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 15:15:47'),
(1687, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 15:17:45'),
(1688, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 15:17:58'),
(1689, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 15:45:53'),
(1690, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 16:33:00'),
(1691, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 16:33:27'),
(1692, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 16:39:31'),
(1693, '', 69, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 16:39:52'),
(1694, '', 69, 'updated', 5, 'job_post', 0, 'created_by', '0', '69', '2022-07-24 16:40:10'),
(1695, '', 69, 'updated', 4, 'job_post', 0, 'inactive', '1', '0', '2022-07-24 16:40:12'),
(1696, '', 69, 'updated', 4, 'job_post', 0, 'created_by', '0', '69', '2022-07-24 16:40:12'),
(1697, '', 69, 'updated', 2, 'job_post', 0, 'created_by', '0', '69', '2022-07-24 16:40:15'),
(1698, '', 69, 'updated', 1, 'job_post', 0, 'created_by', '0', '69', '2022-07-24 16:40:17'),
(1699, '', 69, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 16:40:44'),
(1700, '', 76, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 16:41:19'),
(1701, '', 76, 'updated', 9, 'job_post', 0, 'created_by', '0', '76', '2022-07-24 16:41:37'),
(1702, '', 76, 'updated', 8, 'job_post', 0, 'created_by', '0', '76', '2022-07-24 16:41:50'),
(1703, '', 76, 'updated', 7, 'job_post', 0, 'created_by', '0', '76', '2022-07-24 16:41:52'),
(1704, '', 76, 'updated', 6, 'job_post', 0, 'created_by', '0', '76', '2022-07-24 16:41:54'),
(1705, '', 76, 'created', 10, 'job_post', 0, '', '', '', '2022-07-24 16:43:58'),
(1706, '', 76, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 16:44:59'),
(1707, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 16:45:05'),
(1708, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 17:18:32'),
(1709, '', 69, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 17:19:32'),
(1710, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 20:39:08'),
(1711, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 22:47:01'),
(1712, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-24 22:48:16'),
(1713, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-24 22:48:28'),
(1714, '', 75, 'created', 0, 'job_post', 0, '', '', '', '2022-07-24 22:57:08'),
(1715, '', 75, 'created', 0, 'job_post', 0, '', '', '', '2022-07-24 22:59:53'),
(1716, '', 75, 'created', 0, 'job_post', 0, '', '', '', '2022-07-24 23:00:42'),
(1717, '', 75, 'created', 0, 'job_post', 0, '', '', '', '2022-07-24 23:02:31'),
(1718, '', 75, 'created', 0, 'job_post', 0, '', '', '', '2022-07-24 23:05:06'),
(1719, '', 75, 'created', 0, 'job_post', 0, '', '', '', '2022-07-24 23:20:16'),
(1720, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 07:31:52'),
(1721, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 07:33:45'),
(1722, '', 69, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 07:36:02'),
(1723, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 07:36:08'),
(1724, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 07:40:37'),
(1725, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 07:40:39'),
(1726, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 07:40:44'),
(1727, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 07:42:09'),
(1728, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 07:58:51'),
(1729, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 07:59:06'),
(1730, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-25 08:24:34'),
(1731, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-07-25 08:45:34'),
(1732, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-25 08:45:41'),
(1733, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:29:12'),
(1734, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:43:44'),
(1735, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:44:19'),
(1736, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:44:57'),
(1737, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:45:41'),
(1738, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:45:54'),
(1739, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:46:23'),
(1740, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:46:39'),
(1741, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:46:52'),
(1742, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:47:02'),
(1743, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:47:21'),
(1744, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:47:28'),
(1745, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:50:45'),
(1746, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:52:00'),
(1747, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-25 09:55:28'),
(1748, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 19:43:32'),
(1749, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 20:09:15'),
(1750, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 20:09:42'),
(1751, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 20:19:17'),
(1752, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 20:19:21'),
(1753, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 20:19:26'),
(1754, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 20:19:30'),
(1755, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 21:07:44'),
(1756, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 21:08:15'),
(1757, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-25 21:20:24'),
(1758, '', 75, 'updated', 75, 'applicant_info', 0, 'resume', '1658328945_CV-Phoenix-Langaman.docx', '1658755547_LOR - Phoenix Langaman 2.docx', '2022-07-25 21:25:56'),
(1759, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-25 21:37:38'),
(1760, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-25 21:38:21'),
(1761, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 21:47:09'),
(1762, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 21:51:22'),
(1763, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-25 22:03:22'),
(1764, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 22:04:26'),
(1765, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-25 22:05:41'),
(1766, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-25 22:07:04'),
(1767, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 18:27:14'),
(1768, '', 3, 'deleted', 69, 'user', 0, '', '', '', '2022-07-26 20:18:48'),
(1769, '', 3, 'deleted', 68, 'user', 0, '', '', '', '2022-07-26 20:20:18'),
(1770, '', 3, 'created', 77, 'user', 0, '', '', '', '2022-07-26 20:21:08'),
(1771, '', 3, 'created', 77, 'profile', 0, '', '', '', '2022-07-26 20:21:08'),
(1772, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 20:21:42'),
(1773, '', 3, 'deleted', 76, 'user', 0, '', '', '', '2022-07-26 20:23:29'),
(1774, '', 77, 'created', 11, 'job_post', 0, '', '', '', '2022-07-26 20:27:22'),
(1775, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:28:25'),
(1776, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 20:28:33'),
(1777, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-07-26 20:28:56'),
(1778, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-26 20:29:02'),
(1779, '', 75, 'created', 0, 'job_post_report', 0, '', '', '', '2022-07-26 20:30:26'),
(1780, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:31:32'),
(1781, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 20:33:33'),
(1782, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:46:20'),
(1783, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 20:47:27'),
(1784, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:47:36'),
(1785, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 20:47:55'),
(1786, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:51:52'),
(1787, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:52:04'),
(1788, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 20:52:34'),
(1789, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 20:58:45'),
(1790, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 21:32:58'),
(1791, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 21:33:23'),
(1792, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 21:33:33'),
(1793, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 21:42:31'),
(1794, '', 77, 'created', 12, 'job_post', 0, '', '', '', '2022-07-26 21:43:40'),
(1795, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-07-26 21:44:04'),
(1796, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-26 21:44:11'),
(1797, '', 77, 'created', 13, 'job_post', 0, '', '', '', '2022-07-26 21:47:59'),
(1798, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-07-26 21:48:24'),
(1799, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-26 21:48:30'),
(1800, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 21:49:49'),
(1801, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-26 22:37:54'),
(1802, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-26 22:39:27'),
(1803, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-26 22:39:52'),
(1804, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-26 22:40:18'),
(1805, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-27 20:31:30'),
(1806, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-27 20:44:59'),
(1807, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-27 20:48:37'),
(1808, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-27 20:49:34'),
(1809, '', 77, 'created', 14, 'job_post', 0, '', '', '', '2022-07-27 20:50:38'),
(1810, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-07-27 20:51:25'),
(1811, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-27 20:51:36'),
(1812, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-07-27 22:40:02'),
(1813, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-28 21:13:26'),
(1814, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-28 21:16:43'),
(1815, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-28 21:18:05'),
(1816, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-28 21:20:21'),
(1817, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-28 21:20:43'),
(1818, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-28 21:22:04'),
(1819, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-28 21:43:09'),
(1820, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-28 22:34:09'),
(1821, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-28 22:34:19'),
(1822, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-29 20:10:44'),
(1823, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-29 20:16:13'),
(1824, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 13:43:22'),
(1825, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 13:48:06'),
(1826, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 13:56:46'),
(1827, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 14:53:48'),
(1828, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 14:53:55'),
(1829, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 15:14:06'),
(1830, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 15:14:15'),
(1831, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 15:14:20'),
(1832, 'algen.esturas@itgroupinc.asia', 0, 'created', 78, 'user', 0, '', '', '', '2022-07-30 15:14:44'),
(1833, 'algen.esturas@itgroupinc.asia', 0, 'created', 78, 'profile', 0, '', '', '', '2022-07-30 15:14:44'),
(1834, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 15:16:04'),
(1835, '', 78, 'created', 0, 'profile_industry', 0, '', '', '', '2022-07-30 15:16:28'),
(1836, '', 78, 'created', 0, 'profile_job_level', 0, '', '', '', '2022-07-30 15:16:28'),
(1837, '', 78, 'created', 0, 'profile_job_type', 0, '', '', '', '2022-07-30 15:16:28'),
(1838, '', 78, 'created', 0, 'profile_department', 0, '', '', '', '2022-07-30 15:16:28'),
(1839, '', 78, 'updated', 78, 'applicant_info', 0, 'first_name', '', 'Algen Patrick', '2022-07-30 15:19:24'),
(1840, '', 78, 'updated', 78, 'applicant_info', 0, 'last_name', '', 'Esturas', '2022-07-30 15:19:24'),
(1841, '', 78, 'updated', 78, 'applicant_info', 0, 'dial_code', '', '+63', '2022-07-30 15:19:24'),
(1842, '', 78, 'updated', 78, 'applicant_info', 0, 'contact_number', '', '9171551303', '2022-07-30 15:19:24'),
(1843, '', 78, 'updated', 78, 'applicant_info', 0, 'location', '', 'Quezon City, Metro Manila, Philippines', '2022-07-30 15:19:24'),
(1844, '', 78, 'updated', 78, 'applicant_info', 0, 'lat', '0.0000000', '14.6760413', '2022-07-30 15:19:24'),
(1845, '', 78, 'updated', 78, 'applicant_info', 0, 'lng', '0.0000000', '121.0437003', '2022-07-30 15:19:24'),
(1846, '', 78, 'updated', 78, 'applicant_info', 0, 'locality', '', 'Quezon City', '2022-07-30 15:19:24'),
(1847, '', 78, 'updated', 78, 'applicant_info', 0, 'administrative_area_', '', 'Metro Manila', '2022-07-30 15:19:24'),
(1848, '', 78, 'updated', 78, 'applicant_info', 0, 'country', '', 'Philippines', '2022-07-30 15:19:24'),
(1849, '', 78, 'updated', 78, 'applicant_info', 0, 'highlights', '', 'Test', '2022-07-30 15:19:24'),
(1850, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 15:28:09'),
(1851, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 15:28:17'),
(1852, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 15:28:30'),
(1853, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 15:58:19'),
(1854, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 16:24:00'),
(1855, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 16:24:16'),
(1856, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 16:35:59'),
(1857, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 16:36:01'),
(1858, '', 77, 'created', 15, 'job_post', 0, '', '', '', '2022-07-30 16:38:57'),
(1859, '', 3, 'created', 79, 'user', 0, '', '', '', '2022-07-30 17:24:56'),
(1860, '', 3, 'created', 79, 'profile', 0, '', '', '', '2022-07-30 17:24:56'),
(1861, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 17:25:25'),
(1862, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 17:25:31'),
(1863, '', 79, 'created', 16, 'job_post', 0, '', '', '', '2022-07-30 17:29:56'),
(1864, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 20:25:22'),
(1865, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 20:25:59'),
(1866, '', 78, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-07-30 20:26:39'),
(1867, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 21:49:14'),
(1868, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 21:49:25'),
(1869, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 21:56:19'),
(1870, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 22:03:41'),
(1871, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:03:42'),
(1872, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:08:14'),
(1873, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 22:08:53'),
(1874, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:09:00'),
(1875, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 22:09:05'),
(1876, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:09:26'),
(1877, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 22:09:57'),
(1878, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:10:02'),
(1879, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 22:15:22'),
(1880, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:15:28'),
(1881, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 22:39:47'),
(1882, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 22:40:26'),
(1883, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 23:42:13'),
(1884, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 23:42:20'),
(1885, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 23:42:56'),
(1886, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 23:43:21'),
(1887, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-30 23:56:29'),
(1888, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-07-30 23:56:38'),
(1889, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 00:01:29'),
(1890, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 00:02:14'),
(1891, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 00:02:22'),
(1892, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 00:05:58'),
(1893, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 00:05:59'),
(1894, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 09:36:13'),
(1895, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 09:36:38'),
(1896, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 09:36:50'),
(1897, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 09:36:55'),
(1898, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 10:51:03'),
(1899, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 10:53:57'),
(1900, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 10:58:22'),
(1901, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 10:58:34'),
(1902, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 11:23:15'),
(1903, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 11:23:25'),
(1904, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-07-31 11:23:47'),
(1905, '', 77, 'updated', 11, 'job_post', 0, 'job_expiration_date', '7/30/2022', '8/3/2022', '2022-07-31 13:55:12'),
(1906, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 14:11:01'),
(1907, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 14:11:08'),
(1908, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 14:22:25'),
(1909, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 14:45:13'),
(1910, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 15:50:51'),
(1911, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 15:57:42'),
(1912, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 17:19:32'),
(1913, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 17:19:51'),
(1914, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 18:06:08'),
(1915, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-07-31 19:37:45'),
(1916, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-07-31 20:16:42'),
(1917, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'notes_to_interviewee', '', 'test', '2022-07-31 20:34:15'),
(1918, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_type', 'face_to_face', 'virtual', '2022-07-31 20:35:24'),
(1919, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'virtual_interview_li', '', 'www.google.com', '2022-07-31 20:35:24'),
(1920, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_start_time', '7:36 PM', '8:36 PM', '2022-07-31 20:38:36'),
(1921, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_end_time', '8:36 PM', '9:36 PM', '2022-07-31 20:38:36'),
(1922, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_type', 'virtual', 'face_to_face', '2022-07-31 20:39:03'),
(1923, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_type', 'face_to_face', 'virtual', '2022-07-31 20:45:25'),
(1924, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_type', 'virtual', 'face_to_face', '2022-07-31 20:47:40'),
(1925, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-07-31 21:19:14'),
(1926, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-07-31 21:29:48'),
(1927, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-07-31 21:47:02'),
(1928, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-07-31 22:08:06'),
(1929, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 22:08:18'),
(1930, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-07-31 22:13:47'),
(1931, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-01 20:16:43'),
(1932, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-01 20:17:05'),
(1933, '', 3, 'created', 505, 'education', 0, '', '', '', '2022-08-01 20:29:24'),
(1934, '', 3, 'created', 506, 'education', 0, '', '', '', '2022-08-01 20:29:24'),
(1935, '', 3, 'updated', 77, 'profile', 0, 'contact_number', '9171551303', '9217697036', '2022-08-01 20:35:13'),
(1936, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-01 20:53:04'),
(1937, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'notes_to_interviewee', '', 'Test', '2022-08-01 20:53:49'),
(1938, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-01 20:57:23'),
(1939, '', 77, 'created', 11, 'favorites', 0, '', '', '', '2022-08-01 21:26:27'),
(1940, '', 77, 'updated', 15, 'job_post', 0, 'inactive', '1', '0', '2022-08-01 22:18:04'),
(1941, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-01 22:53:46'),
(1942, '', 77, 'updated', 11, 'job_post', 0, 'job_description', '- CSS JS', '- CSS JS test', '2022-08-01 23:03:29'),
(1943, '', 77, 'updated', 11, 'job_post', 0, 'department', '24', '3', '2022-08-01 23:25:16'),
(1944, '', 77, 'updated', 11, 'job_post', 0, 'department', '3', '24', '2022-08-01 23:25:27'),
(1945, '', 77, 'created', 17, 'job_post', 0, '', '', '', '2022-08-01 23:40:23'),
(1946, '', 77, 'created', 18, 'job_post', 0, '', '', '', '2022-08-01 23:41:21'),
(1947, '', 77, 'created', 19, 'job_post', 0, '', '', '', '2022-08-01 23:42:38'),
(1948, '', 77, 'updated', 15, 'job_post', 0, 'department', '8', '3', '2022-08-01 23:56:46'),
(1949, '', 77, 'updated', 15, 'job_post', 0, 'job_expiration_date', '8/4/2022', '8/1/2022', '2022-08-01 23:56:46'),
(1950, '', 77, 'updated', 15, 'job_post', 0, 'vacancies', '50', '', '2022-08-01 23:56:46'),
(1951, '', 77, 'updated', 15, 'job_post', 0, 'department', '3', '8', '2022-08-01 23:56:58'),
(1952, '', 77, 'updated', 15, 'job_post', 0, 'vacancies', '0', '', '2022-08-01 23:56:58'),
(1953, '', 77, 'updated', 15, 'job_post', 0, 'department', '8', '6', '2022-08-01 23:58:28'),
(1954, '', 77, 'updated', 15, 'job_post', 0, 'vacancies', '0', '', '2022-08-01 23:58:28'),
(1955, '', 77, 'updated', 15, 'job_post', 0, 'department', '6', '8', '2022-08-01 23:58:37'),
(1956, '', 77, 'updated', 15, 'job_post', 0, 'vacancies', '0', '', '2022-08-01 23:58:37'),
(1957, '', 77, 'updated', 15, 'job_post', 0, 'vacancies', '0', '', '2022-08-01 23:59:11'),
(1958, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-02 06:28:54'),
(1959, '', 77, 'created', 20, 'job_post', 0, '', '', '', '2022-08-02 06:44:17'),
(1960, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 06:52:29'),
(1961, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 07:24:20'),
(1962, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 07:24:56'),
(1963, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 07:38:12'),
(1964, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-02 07:55:39'),
(1965, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 07:56:40'),
(1966, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 08:20:23'),
(1967, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 08:47:57'),
(1968, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 08:48:08'),
(1969, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 08:50:59'),
(1970, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 08:52:15'),
(1971, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 08:52:46'),
(1972, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 08:52:58'),
(1973, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 08:53:08'),
(1974, '', 77, 'updated', 20, 'job_post', 0, 'job_expiration_date', '9/10/2022', '8/2/2022', '2022-08-02 10:01:52'),
(1975, '', 77, 'updated', 20, 'job_post', 0, 'vacancies', '20', '5', '2022-08-02 10:01:52'),
(1976, '', 77, 'updated', 20, 'job_post', 0, 'vacancies', '5', '', '2022-08-02 10:06:18'),
(1977, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 10:12:55'),
(1978, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 10:13:39'),
(1979, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 10:16:40'),
(1980, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 10:17:25'),
(1981, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 10:17:57'),
(1982, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 10:18:15'),
(1983, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_date', '7/31/2022', '8/6/2022', '2022-08-02 15:12:38'),
(1984, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_start_time', '9:46 PM', '8:46 PM', '2022-08-02 15:15:23'),
(1985, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_end_time', '10:46 PM', '9:46 PM', '2022-08-02 15:15:23'),
(1986, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_start_time', '8:46 PM', '9:46 PM', '2022-08-02 15:15:50'),
(1987, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_end_time', '9:46 PM', '10:46 PM', '2022-08-02 15:15:50'),
(1988, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 15:23:27'),
(1989, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:34:41'),
(1990, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:36:42'),
(1991, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:39:47'),
(1992, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:41:44'),
(1993, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:43:07'),
(1994, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:44:44'),
(1995, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_start_time', '5:42 PM', '6:42 PM', '2022-08-02 15:49:02'),
(1996, '', 77, 'updated', 11, 'job_post_for_intervi', 0, 'interview_end_time', '6:42 PM', '7:42 PM', '2022-08-02 15:49:02'),
(1997, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:56:01'),
(1998, '', 77, 'created', 0, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 15:56:44'),
(1999, '', 77, 'created', 1, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 16:45:05'),
(2000, '', 77, 'updated', 1, 'job_post_for_intervi', 0, 'interview_start_time', '4:44 PM', '5:44 PM', '2022-08-02 16:46:33'),
(2001, '', 77, 'updated', 1, 'job_post_for_intervi', 0, 'interview_end_time', '5:44 PM', '6:44 PM', '2022-08-02 16:46:33'),
(2002, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-02 16:49:46'),
(2003, '', 77, 'updated', 1, 'job_post_for_intervi', 0, 'notes_to_interviewee', '', 'test', '2022-08-02 16:51:49'),
(2004, '', 77, 'updated', 1, 'job_post_for_intervi', 0, 'notes_to_interviewee', 'test', 'testsdfas ', '2022-08-02 16:54:54'),
(2005, '', 77, 'created', 2, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 16:57:18'),
(2006, '', 77, 'updated', 2, 'job_post_for_intervi', 0, 'interview_start_time', '5:44 PM', '6:44 PM', '2022-08-02 17:02:51'),
(2007, '', 77, 'updated', 2, 'job_post_for_intervi', 0, 'interview_end_time', '6:44 PM', '7:44 PM', '2022-08-02 17:02:51'),
(2008, '', 77, 'updated', 2, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-02 18:03:06'),
(2009, '', 77, 'updated', 2, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-02 18:03:54'),
(2010, '', 77, 'updated', 1, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-02 18:18:35'),
(2011, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 18:28:42'),
(2012, '', 77, 'created', 3, 'job_post_for_intervi', 0, '', '', '', '2022-08-02 18:29:15'),
(2013, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 19:00:12'),
(2014, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-02 19:01:11'),
(2015, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-02 19:04:13'),
(2016, '', 79, 'logged in', 0, 'login', 0, '', '', '', '2022-08-02 19:04:21'),
(2017, '', 79, 'created', 21, 'job_post', 0, '', '', '', '2022-08-02 19:06:00'),
(2018, '', 79, 'updated', 21, 'job_post', 0, 'inactive', '1', '0', '2022-08-02 19:06:30'),
(2019, '', 79, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-02 19:06:48'),
(2020, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-02 19:06:56'),
(2021, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-08-02 19:08:15'),
(2022, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-02 19:09:51'),
(2023, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 08:49:16'),
(2024, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 08:49:52'),
(2025, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:10:38'),
(2026, '', 77, 'created', 4, 'job_post_for_intervi', 0, '', '', '', '2022-08-03 09:11:43'),
(2027, '', 77, 'updated', 4, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-03 09:25:48'),
(2028, '', 77, 'created', 5, 'job_post_for_intervi', 0, '', '', '', '2022-08-03 09:31:20'),
(2029, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:31:48'),
(2030, '', 77, 'updated', 5, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-03 09:32:20'),
(2031, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:34:52'),
(2032, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:34:59'),
(2033, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:41:51'),
(2034, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:42:00'),
(2035, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:43:12'),
(2036, '', 77, 'created', 6, 'job_post_for_intervi', 0, '', '', '', '2022-08-03 09:48:16'),
(2037, '', 77, 'created', 22, 'job_post', 0, '', '', '', '2022-08-03 09:50:20'),
(2038, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:51:28'),
(2039, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 09:51:56'),
(2040, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-03 09:52:32'),
(2041, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 09:52:38'),
(2042, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-08-03 10:00:19'),
(2043, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-03 12:01:51'),
(2044, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 12:01:58'),
(2045, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 12:02:20'),
(2046, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-03 15:17:05'),
(2047, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 15:17:14'),
(2048, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 16:10:43'),
(2049, '', 77, 'created', 7, 'job_post_for_intervi', 0, '', '', '', '2022-08-03 18:08:20'),
(2050, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-03 18:13:10'),
(2051, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 18:14:07'),
(2052, '', 78, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-08-03 18:14:22'),
(2053, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 18:21:50'),
(2054, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-03 21:58:15'),
(2055, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 21:58:23'),
(2056, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 21:58:46'),
(2057, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 23:07:57'),
(2058, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:16:01'),
(2059, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:16:24'),
(2060, '', 77, 'created', 8, 'job_post_for_intervi', 0, '', '', '', '2022-08-03 23:20:53'),
(2061, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:21:01'),
(2062, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:21:07'),
(2063, '', 77, 'created', 23, 'job_post', 0, '', '', '', '2022-08-03 23:22:31'),
(2064, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-03 23:22:52'),
(2065, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-03 23:22:56'),
(2066, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-08-03 23:23:05'),
(2067, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:23:13'),
(2068, '', 77, 'created', 9, 'job_post_for_intervi', 0, '', '', '', '2022-08-03 23:23:57'),
(2069, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:24:20'),
(2070, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-03 23:25:21'),
(2071, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 06:34:22'),
(2072, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 06:54:05'),
(2073, '', 3, 'updated', 5, 'homepage_banner', 0, 'description_a', 'Description A', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non condimentum erat, a aliquet enim. Nam dapibus sed dui sit amet egestas. Nullam sed aliquet lacus, vitae venenatis mi. Sed id hendrerit odio. Cras venenatis nisl lacus, vitae varius arcu vestibulum eget. Donec ultricies suscipit dui vel varius.', '2022-08-04 07:36:45'),
(2074, '', 3, 'updated', 5, 'homepage_banner', 0, 'description_b', 'Description B', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non condimentum erat, a aliquet enim. Nam dapibus sed dui sit amet egestas. Nullam sed aliquet lacus, vitae venenatis mi. Sed id hendrerit odio. Cras venenatis nisl lacus, vitae varius arcu vestibulum eget. Donec ultricies suscipit dui vel varius.', '2022-08-04 07:36:45'),
(2075, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 07:43:10'),
(2076, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 07:43:20'),
(2077, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 07:44:50'),
(2078, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 08:15:15'),
(2079, '', 77, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2022-08-04 08:38:07'),
(2080, '', 77, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2022-08-04 08:38:53'),
(2081, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 08:40:10'),
(2082, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 08:40:41'),
(2083, '', 77, 'created', 24, 'job_post', 0, '', '', '', '2022-08-04 10:08:58'),
(2084, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 10:09:30'),
(2085, '', 75, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-08-04 10:10:12'),
(2086, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-08-04 10:10:19'),
(2087, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-04 10:11:22'),
(2088, '', 77, 'created', 10, 'job_post_for_intervi', 0, '', '', '', '2022-08-04 10:13:15'),
(2089, '', 77, 'updated', 10, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-04 10:14:44'),
(2090, '', 77, 'created', 11, 'job_post_for_intervi', 0, '', '', '', '2022-08-04 10:26:05'),
(2091, '', 77, 'updated', 11, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-04 10:26:27'),
(2092, '', 77, 'created', 12, 'job_post_for_intervi', 0, '', '', '', '2022-08-04 10:28:46'),
(2093, '', 77, 'updated', 12, 'job_post', 0, 'status', 'pending', 'cancelled', '2022-08-04 10:29:17'),
(2094, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 10:42:23'),
(2095, 'gym@gmail.com', 0, 'created', 80, 'user', 0, '', '', '', '2022-08-04 10:42:55'),
(2096, 'gym@gmail.com', 0, 'created', 80, 'profile', 0, '', '', '', '2022-08-04 10:42:55'),
(2097, '', 80, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 10:43:07'),
(2098, '', 80, 'created', 0, 'profile_industry', 0, '', '', '', '2022-08-04 10:44:10'),
(2099, '', 80, 'created', 0, 'profile_job_level', 0, '', '', '', '2022-08-04 10:44:10'),
(2100, '', 80, 'created', 0, 'profile_job_type', 0, '', '', '', '2022-08-04 10:44:10'),
(2101, '', 80, 'created', 1, 'profile_job_type', 0, '', '', '', '2022-08-04 10:44:10'),
(2102, '', 80, 'created', 0, 'profile_department', 0, '', '', '', '2022-08-04 10:44:10'),
(2103, '', 80, 'updated', 80, 'applicant_info', 0, 'first_name', '', 'Gym Lyssa', '2022-08-04 10:55:49'),
(2104, '', 80, 'updated', 80, 'applicant_info', 0, 'middle_name', '', 'Silos', '2022-08-04 10:55:49'),
(2105, '', 80, 'updated', 80, 'applicant_info', 0, 'last_name', '', 'Langaman', '2022-08-04 10:55:49');
INSERT INTO `oaud` (`id`, `username`, `user_id`, `action`, `record_id`, `record_type`, `line`, `record_field`, `record_field_old_value`, `record_field_new_value`, `date_time`) VALUES
(2106, '', 80, 'updated', 80, 'applicant_info', 0, 'dial_code', '', '+63', '2022-08-04 10:55:49'),
(2107, '', 80, 'updated', 80, 'applicant_info', 0, 'contact_number', '', '9171551303', '2022-08-04 10:55:49'),
(2108, '', 80, 'updated', 80, 'applicant_info', 0, 'location', '', 'Manggalang 1, Sariaya, 4322 Quezon, Philippines', '2022-08-04 10:55:49'),
(2109, '', 80, 'updated', 80, 'applicant_info', 0, 'lat', '0.0000000', '13.8733756', '2022-08-04 10:55:49'),
(2110, '', 80, 'updated', 80, 'applicant_info', 0, 'lng', '0.0000000', '121.4856066', '2022-08-04 10:55:49'),
(2111, '', 80, 'updated', 80, 'applicant_info', 0, 'locality', '', 'Sariaya', '2022-08-04 10:55:49'),
(2112, '', 80, 'updated', 80, 'applicant_info', 0, 'administrative_area_', '', 'Calabarzon', '2022-08-04 10:55:49'),
(2113, '', 80, 'updated', 80, 'applicant_info', 0, 'country', '', 'Philippines', '2022-08-04 10:55:49'),
(2114, '', 80, 'updated', 80, 'applicant_info', 0, 'highlights', '', 'Malupet', '2022-08-04 10:55:49'),
(2115, '', 77, 'created', 17, 'employer', 3, '', '', '1659582268_prf.jpg', '2022-08-04 11:04:32'),
(2116, '', 80, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 11:12:49'),
(2117, '', 80, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 11:12:51'),
(2118, '', 77, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2022-08-04 13:43:52'),
(2119, '', 77, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2022-08-04 14:12:25'),
(2120, '', 80, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 15:03:35'),
(2121, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 15:03:41'),
(2122, '', 77, 'created', 0, 'usr_job_invite', 0, '', '', '', '2022-08-04 16:01:21'),
(2123, '', 77, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2022-08-04 16:06:44'),
(2124, '', 77, 'created', 0, 'usr_job_invite', 0, '', '', '', '2022-08-04 16:14:08'),
(2125, '', 77, 'created', 0, 'usr_job_invite', 0, '', '', '', '2022-08-04 16:21:57'),
(2126, '', 3, 'created', 4, 'employer_position', 0, '', '', '', '2022-08-04 17:46:09'),
(2127, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 17:46:32'),
(2128, '', 77, 'created', 0, 'usr_job_invite', 0, '', '', '', '2022-08-04 18:22:04'),
(2129, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:23:58'),
(2130, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 18:29:53'),
(2131, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:30:33'),
(2132, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 18:33:02'),
(2133, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 18:33:11'),
(2134, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:33:18'),
(2135, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:37:11'),
(2136, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 18:39:11'),
(2137, '', 80, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:39:20'),
(2138, '', 80, 'created', 0, 'job_post_applicant', 0, '', '', '', '2022-08-04 18:39:35'),
(2139, '', 77, 'created', 0, 'job_post_move_to', 0, '', '', '', '2022-08-04 18:40:06'),
(2140, '', 77, 'created', 13, 'job_post_for_intervi', 0, '', '', '', '2022-08-04 18:40:58'),
(2141, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 18:45:35'),
(2142, '', 80, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 18:54:29'),
(2143, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:54:35'),
(2144, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 18:54:55'),
(2145, '', 77, 'created', 0, 'employer_saved_appli', 0, '', '', '', '2022-08-04 19:00:53'),
(2146, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 19:59:10'),
(2147, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 20:17:37'),
(2148, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 20:17:43'),
(2149, '', 77, 'created', 0, 'usr_job_invite', 0, '', '', '', '2022-08-04 20:37:20'),
(2150, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 20:37:54'),
(2151, '', 77, 'created', 25, 'job_post', 0, '', '', '', '2022-08-04 21:01:20'),
(2152, '', 77, 'updated', 25, 'job_post', 0, 'job_expiration_date', '8/4/2022', '8/31/2022', '2022-08-04 21:01:48'),
(2153, '', 77, 'updated', 25, 'job_post', 0, 'vacancies', '0', '5', '2022-08-04 21:01:48'),
(2154, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 21:57:37'),
(2155, '', 75, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 22:21:07'),
(2156, '', 78, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 22:21:13'),
(2157, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 23:03:08'),
(2158, '', 78, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 23:03:17'),
(2159, '', 3, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 23:03:25'),
(2160, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 23:04:15'),
(2161, '', 3, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 23:07:34'),
(2162, '', 75, 'logged in', 0, 'login', 0, '', '', '', '2022-08-04 23:07:39'),
(2163, '', 77, 'logged out', 0, 'logout', 0, '', '', '', '2022-08-04 23:16:58'),
(2164, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-08-05 00:48:39'),
(2165, '', 75, 'created', 0, 'favorites', 0, '', '', '', '2022-08-05 00:48:47'),
(2166, '', 77, 'logged in', 0, 'login', 0, '', '', '', '2022-08-05 00:54:36'),
(2167, '', 77, 'created', 26, 'job_post', 0, '', '', '', '2022-08-05 00:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `odepartment`
--

DROP TABLE IF EXISTS `odepartment`;
CREATE TABLE `odepartment` (
  `id` int(20) NOT NULL,
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
(22, 'department', 'House Keeping', 0, '2022-06-25 11:50:21'),
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
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'education',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oeducation`
--

INSERT INTO `oeducation` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(275, 'education', 'Vocational', 0, '2022-06-25 19:07:37'),
(276, 'education', 'Certificate', 0, '2022-06-25 19:07:37'),
(277, 'education', 'College Level', 0, '2022-06-25 19:07:37'),
(281, 'education', 'Master\'s degree', 0, '2022-06-25 19:15:44'),
(282, 'education', 'Master\'s degree or higher', 0, '2022-06-25 19:15:44'),
(283, 'education', 'High School', 0, '2022-06-25 19:27:28'),
(285, 'education', '1', 0, '2022-06-26 13:04:14'),
(286, 'education', '2', 0, '2022-06-26 13:04:14'),
(287, 'education', '3', 0, '2022-06-26 13:04:14'),
(288, 'education', '4', 0, '2022-06-26 13:04:14'),
(289, 'education', '5', 0, '2022-06-26 13:04:14'),
(290, 'education', '6', 0, '2022-06-26 13:04:14'),
(291, 'education', '7', 0, '2022-06-26 13:04:14'),
(292, 'education', '8', 0, '2022-06-26 13:04:14'),
(293, 'education', '9', 0, '2022-06-26 13:04:14'),
(294, 'education', '10', 0, '2022-06-26 13:04:14'),
(295, 'education', '11', 0, '2022-06-26 13:04:14'),
(296, 'education', '12', 0, '2022-06-26 13:04:14'),
(297, 'education', '13', 0, '2022-06-26 13:04:14'),
(298, 'education', '14', 0, '2022-06-26 13:04:14'),
(299, 'education', '15', 0, '2022-06-26 13:04:14'),
(300, 'education', '16', 0, '2022-06-26 13:04:14'),
(301, 'education', '17', 0, '2022-06-26 13:04:14'),
(302, 'education', '18', 0, '2022-06-26 13:04:14'),
(303, 'education', '19', 0, '2022-06-26 13:04:14'),
(304, 'education', '20', 0, '2022-06-26 13:04:14'),
(305, 'education', '1', 0, '2022-06-26 13:04:14'),
(306, 'education', '2', 0, '2022-06-26 13:04:14'),
(307, 'education', '3', 0, '2022-06-26 13:04:14'),
(308, 'education', '4', 0, '2022-06-26 13:04:14'),
(309, 'education', '5', 0, '2022-06-26 13:04:14'),
(310, 'education', '6', 0, '2022-06-26 13:04:14'),
(311, 'education', '7', 0, '2022-06-26 13:04:14'),
(312, 'education', '8', 0, '2022-06-26 13:04:14'),
(313, 'education', '9', 0, '2022-06-26 13:04:14'),
(314, 'education', '10', 0, '2022-06-26 13:04:14'),
(315, 'education', '11', 0, '2022-06-26 13:04:14'),
(316, 'education', '12', 0, '2022-06-26 13:04:14'),
(317, 'education', '13', 0, '2022-06-26 13:04:14'),
(318, 'education', '14', 0, '2022-06-26 13:04:14'),
(319, 'education', '15', 0, '2022-06-26 13:04:14'),
(320, 'education', '16', 0, '2022-06-26 13:04:14'),
(321, 'education', '17', 0, '2022-06-26 13:04:14'),
(322, 'education', '18', 0, '2022-06-26 13:04:14'),
(323, 'education', '19', 0, '2022-06-26 13:04:14'),
(324, 'education', '1', 0, '2022-06-26 13:04:14'),
(325, 'education', '2', 0, '2022-06-26 13:04:14'),
(326, 'education', '3', 0, '2022-06-26 13:04:14'),
(327, 'education', '4', 0, '2022-06-26 13:04:14'),
(328, 'education', '5', 0, '2022-06-26 13:04:14'),
(329, 'education', '6', 0, '2022-06-26 13:04:14'),
(330, 'education', '7', 0, '2022-06-26 13:04:14'),
(331, 'education', '8', 0, '2022-06-26 13:04:14'),
(332, 'education', '9', 0, '2022-06-26 13:04:14'),
(333, 'education', '10', 0, '2022-06-26 13:04:14'),
(334, 'education', '11', 0, '2022-06-26 13:04:14'),
(335, 'education', '12', 0, '2022-06-26 13:04:14'),
(336, 'education', '13', 0, '2022-06-26 13:04:14'),
(337, 'education', '14', 0, '2022-06-26 13:04:14'),
(338, 'education', '15', 0, '2022-06-26 13:04:14'),
(339, 'education', '16', 0, '2022-06-26 13:04:14'),
(340, 'education', '17', 0, '2022-06-26 13:04:14'),
(341, 'education', '18', 0, '2022-06-26 13:04:14'),
(342, 'education', '19', 0, '2022-06-26 13:04:14'),
(343, 'education', '1', 0, '2022-06-26 13:04:14'),
(344, 'education', '2', 0, '2022-06-26 13:04:14'),
(345, 'education', '3', 0, '2022-06-26 13:04:14'),
(346, 'education', '4', 0, '2022-06-26 13:04:14'),
(347, 'education', '5', 0, '2022-06-26 13:04:14'),
(348, 'education', '6', 0, '2022-06-26 13:04:14'),
(349, 'education', '7', 0, '2022-06-26 13:04:14'),
(350, 'education', '8', 0, '2022-06-26 13:04:14'),
(351, 'education', '9', 0, '2022-06-26 13:04:14'),
(352, 'education', '10', 0, '2022-06-26 13:04:14'),
(353, 'education', '11', 1, '2022-06-26 13:04:14'),
(354, 'education', '12', 0, '2022-06-26 13:04:14'),
(355, 'education', '13', 0, '2022-06-26 13:04:14'),
(356, 'education', '14', 0, '2022-06-26 13:04:14'),
(357, 'education', '15', 0, '2022-06-26 13:04:14'),
(358, 'education', '16', 0, '2022-06-26 13:04:14'),
(359, 'education', '17', 0, '2022-06-26 13:04:14'),
(360, 'education', '18', 0, '2022-06-26 13:04:14'),
(361, 'education', '19', 0, '2022-06-26 13:04:14'),
(362, 'education', '1', 0, '2022-06-26 13:04:14'),
(363, 'education', '2', 0, '2022-06-26 13:04:14'),
(364, 'education', '3', 0, '2022-06-26 13:04:14'),
(365, 'education', '4', 0, '2022-06-26 13:04:14'),
(366, 'education', '5', 0, '2022-06-26 13:04:14'),
(367, 'education', '6', 0, '2022-06-26 13:04:14'),
(368, 'education', '7', 0, '2022-06-26 13:04:14'),
(369, 'education', '8', 0, '2022-06-26 13:04:14'),
(370, 'education', '9', 0, '2022-06-26 13:04:14'),
(371, 'education', '10', 0, '2022-06-26 13:04:14'),
(372, 'education', '11', 0, '2022-06-26 13:04:14'),
(373, 'education', '12', 0, '2022-06-26 13:04:14'),
(374, 'education', '13', 0, '2022-06-26 13:04:14'),
(375, 'education', '14', 0, '2022-06-26 13:04:14'),
(376, 'education', '15', 0, '2022-06-26 13:04:14'),
(377, 'education', '16', 0, '2022-06-26 13:04:14'),
(378, 'education', '17', 0, '2022-06-26 13:04:14'),
(379, 'education', '18', 0, '2022-06-26 13:04:14'),
(380, 'education', '19', 0, '2022-06-26 13:04:14'),
(381, 'education', '1', 0, '2022-06-26 13:04:14'),
(382, 'education', '2', 0, '2022-06-26 13:04:14'),
(383, 'education', '3', 0, '2022-06-26 13:04:14'),
(384, 'education', '4', 0, '2022-06-26 13:04:14'),
(385, 'education', '5', 0, '2022-06-26 13:04:14'),
(386, 'education', '6', 0, '2022-06-26 13:04:14'),
(387, 'education', '7', 0, '2022-06-26 13:04:14'),
(388, 'education', '8', 0, '2022-06-26 13:04:14'),
(389, 'education', '9', 0, '2022-06-26 13:04:14'),
(390, 'education', '10', 0, '2022-06-26 13:04:14'),
(391, 'education', '11', 0, '2022-06-26 13:04:14'),
(392, 'education', '12', 0, '2022-06-26 13:04:14'),
(393, 'education', '13', 0, '2022-06-26 13:04:14'),
(394, 'education', '14', 0, '2022-06-26 13:04:14'),
(395, 'education', '15', 0, '2022-06-26 13:04:14'),
(396, 'education', '16', 0, '2022-06-26 13:04:14'),
(397, 'education', '17', 0, '2022-06-26 13:04:14'),
(398, 'education', '18', 0, '2022-06-26 13:04:14'),
(399, 'education', '19', 0, '2022-06-26 13:04:14'),
(400, 'education', '20', 0, '2022-06-26 13:04:14'),
(401, 'education', '1', 0, '2022-06-26 13:04:14'),
(402, 'education', '2', 0, '2022-06-26 13:04:14'),
(403, 'education', '3', 0, '2022-06-26 13:04:14'),
(404, 'education', '4', 0, '2022-06-26 13:04:14'),
(405, 'education', '5', 0, '2022-06-26 13:04:14'),
(406, 'education', '6', 0, '2022-06-26 13:04:14'),
(407, 'education', '7', 0, '2022-06-26 13:04:14'),
(408, 'education', '8', 0, '2022-06-26 13:04:14'),
(409, 'education', '9', 0, '2022-06-26 13:04:14'),
(410, 'education', '10', 0, '2022-06-26 13:04:14'),
(411, 'education', '11', 0, '2022-06-26 13:04:14'),
(412, 'education', '12', 0, '2022-06-26 13:04:14'),
(413, 'education', '13', 0, '2022-06-26 13:04:14'),
(414, 'education', '14', 0, '2022-06-26 13:04:14'),
(415, 'education', '15', 0, '2022-06-26 13:04:14'),
(416, 'education', '16', 0, '2022-06-26 13:04:14'),
(417, 'education', '17', 0, '2022-06-26 13:04:14'),
(418, 'education', '18', 0, '2022-06-26 13:04:14'),
(419, 'education', '19', 0, '2022-06-26 13:04:14'),
(420, 'education', '1', 0, '2022-06-26 13:04:14'),
(421, 'education', '2', 0, '2022-06-26 13:04:14'),
(422, 'education', '3', 0, '2022-06-26 13:04:14'),
(423, 'education', '4', 0, '2022-06-26 13:04:14'),
(424, 'education', '1', 0, '2022-06-26 13:04:14'),
(425, 'education', '2', 0, '2022-06-26 13:04:14'),
(426, 'education', '3', 0, '2022-06-26 13:04:14'),
(427, 'education', '4', 0, '2022-06-26 13:04:14'),
(428, 'education', '5', 0, '2022-06-26 13:04:14'),
(429, 'education', '6', 0, '2022-06-26 13:04:14'),
(430, 'education', '7', 0, '2022-06-26 13:04:14'),
(431, 'education', '8', 0, '2022-06-26 13:04:14'),
(432, 'education', '9', 0, '2022-06-26 13:04:14'),
(433, 'education', '10', 0, '2022-06-26 13:04:14'),
(434, 'education', '11', 0, '2022-06-26 13:04:14'),
(435, 'education', '12', 0, '2022-06-26 13:04:14'),
(436, 'education', '13', 0, '2022-06-26 13:04:14'),
(437, 'education', '14', 0, '2022-06-26 13:04:14'),
(438, 'education', '15', 0, '2022-06-26 13:04:14'),
(439, 'education', '16', 0, '2022-06-26 13:04:14'),
(440, 'education', '17', 0, '2022-06-26 13:04:14'),
(441, 'education', '18', 0, '2022-06-26 13:04:14'),
(442, 'education', '19', 0, '2022-06-26 13:04:14'),
(443, 'education', '20', 0, '2022-06-26 13:04:14'),
(444, 'education', '1', 0, '2022-06-26 13:04:14'),
(445, 'education', '2', 0, '2022-06-26 13:04:14'),
(446, 'education', '3', 0, '2022-06-26 13:04:14'),
(447, 'education', '4', 0, '2022-06-26 13:04:14'),
(448, 'education', '5', 0, '2022-06-26 13:04:14'),
(449, 'education', '6', 0, '2022-06-26 13:04:14'),
(450, 'education', '7', 0, '2022-06-26 13:04:14'),
(451, 'education', '8', 0, '2022-06-26 13:04:14'),
(452, 'education', '9', 0, '2022-06-26 13:04:14'),
(453, 'education', '10', 0, '2022-06-26 13:04:14'),
(454, 'education', '11', 0, '2022-06-26 13:04:14'),
(455, 'education', '12', 0, '2022-06-26 13:04:14'),
(456, 'education', '13', 0, '2022-06-26 13:04:14'),
(457, 'education', '14', 0, '2022-06-26 13:04:14'),
(458, 'education', '15', 0, '2022-06-26 13:04:14'),
(459, 'education', '16', 0, '2022-06-26 13:04:14'),
(460, 'education', '17', 0, '2022-06-26 13:04:14'),
(461, 'education', '18', 0, '2022-06-26 13:04:14'),
(462, 'education', '19', 0, '2022-06-26 13:04:14'),
(463, 'education', '1', 0, '2022-06-26 13:04:14'),
(464, 'education', '2', 0, '2022-06-26 13:04:14'),
(465, 'education', '3', 0, '2022-06-26 13:04:14'),
(466, 'education', '4', 0, '2022-06-26 13:04:14'),
(467, 'education', '1', 0, '2022-06-26 13:04:14'),
(468, 'education', '2', 0, '2022-06-26 13:04:14'),
(469, 'education', '3', 0, '2022-06-26 13:04:14'),
(470, 'education', '4', 0, '2022-06-26 13:04:14'),
(471, 'education', '5', 0, '2022-06-26 13:04:14'),
(472, 'education', '6', 0, '2022-06-26 13:04:14'),
(473, 'education', '7', 0, '2022-06-26 13:04:14'),
(474, 'education', '8', 0, '2022-06-26 13:04:14'),
(475, 'education', '9', 0, '2022-06-26 13:04:14'),
(476, 'education', '10', 0, '2022-06-26 13:04:14'),
(477, 'education', '11', 0, '2022-06-26 13:04:14'),
(478, 'education', '12', 0, '2022-06-26 13:04:14'),
(479, 'education', '13', 0, '2022-06-26 13:04:14'),
(480, 'education', '14', 0, '2022-06-26 13:04:14'),
(481, 'education', '15', 0, '2022-06-26 13:04:14'),
(482, 'education', '16', 0, '2022-06-26 13:04:14'),
(483, 'education', '17', 0, '2022-06-26 13:04:14'),
(484, 'education', '18', 0, '2022-06-26 13:04:14'),
(485, 'education', '19', 0, '2022-06-26 13:04:14'),
(486, 'education', 'dfsg', 0, '2022-06-26 14:10:55'),
(487, 'education', 'dsgsdf', 0, '2022-06-26 14:10:55'),
(488, 'education', 'dfsgs', 0, '2022-06-26 14:10:55'),
(489, 'education', 'dsfgs', 0, '2022-06-26 14:10:55'),
(490, 'education', 'sdf', 0, '2022-06-26 14:10:55'),
(491, 'education', 'hfhfg', 0, '2022-06-26 14:10:55'),
(492, 'education', 'dfgs', 0, '2022-06-26 14:10:55'),
(493, 'education', 'asf', 0, '2022-06-26 14:10:55'),
(495, 'education', 'fdf', 0, '2022-06-26 14:11:14'),
(496, 'education', 'sd', 0, '2022-06-26 14:11:14'),
(497, 'education', 'dfgdf', 0, '2022-06-26 14:11:14'),
(498, 'education', 'dsfasd', 0, '2022-06-26 14:11:14'),
(499, 'education', 'dfdfg', 0, '2022-06-26 14:11:14'),
(500, 'education', 'sfasdf', 0, '2022-06-26 14:11:14'),
(501, 'education', 'dfgsdf', 0, '2022-06-26 14:11:14'),
(502, 'education', 'fsadf', 0, '2022-06-27 16:58:07'),
(503, 'education', 'gfd', 0, '2022-06-27 16:58:07'),
(504, 'education', 'ghhg', 0, '2022-06-27 16:58:07'),
(505, 'education', 'Kinder', 0, '2022-08-01 20:29:24'),
(506, 'education', 'Grade1', 0, '2022-08-01 20:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `oemail_template`
--

DROP TABLE IF EXISTS `oemail_template`;
CREATE TABLE `oemail_template` (
  `id` int(10) NOT NULL,
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
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '''employer''',
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
  `status` int(10) NOT NULL DEFAULT 1,
  `signup` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oemployer`
--

INSERT INTO `oemployer` (`id`, `type`, `doc_image`, `company_name`, `about`, `dial_code`, `contact_number`, `website`, `email`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `industry`, `start_date`, `start_time`, `end_date`, `other_notes`, `end_time`, `inactive`, `date_created`, `status`, `signup`) VALUES
(17, 'employer', '1657801891_73.png', 'IT Group Inc', 'Test About 2', '+63', '9171551303', 'www.google.com', 'phoenixlangaman087@gmail.com', '1471 Quezon Ave, Quezon City, 1104 Metro Manila, Philippines', '14.6404977', '121.0309626', 'Quezon City', 'Metro Manila', 'Philippines', 21, '7/11/2022', '10:42 PM', '7/12/2023', '', '10:42 PM', 0, '2022-07-11 14:23:21', 1, 302),
(18, 'employer', '1658582778_prf.jpg', 'PRBFI', 'Pacific Royal Basic Foods Inc. (PRBFI) is a highly regarded Philippine producer of desiccated and value-added coconut products. Our Sunripe brand is a preferred ingredient in a broad range of applications in the global food business.\r\n\r\n\r\nWe are a company that has chosen to first commit our resources to the continual improvement and development of our people, products and services ahead of any plans for expansion. Beyond this commitment to quality, we are determined to maintain our products relevance and value through research, constant interaction and collaboration with our chosen clients.\r\n\r\n\r\nThus, from modest beginnings at Candelaria, Quezon in 1984, Pacific Royal Basic Foods Inc. is now an established supplier of choice to discriminating customers with special requirements throughout the world.\r\n\r\n\r\nPacific Royal Basic Foods Inc. is a proud member of the JAKA Group.', '+63', '9171551303', 'www.prbfi.com', 'gymmasangkaysilos@gmail.com', 'Barrio Mangilag Sur, WFJ6+72V, Candelaria, Quezon, Philippines', '13.9307450', '121.4600570', 'Candelaria', 'Quezon Province', 'Philippines', 15, '7/22/2022', '9:00 AM', '7/23/2023', 'Test', '9:00 AM', 0, '2022-07-14 07:48:14', 1, 303),
(19, 'employer', '', 'PCL Corporation', '', '', '', '', 'partner2@gmail.com', 'Block 63 Lot 12 Masunurin St. Barangay, Fiesta Communities Inc, Castillejos, 2208 Zambales, Philippines', '14.9260337', '120.2155296', 'Castillejos', 'Central Luzon', 'Philippines', 15, '7/17/2022', '8:53 PM', '7/1/2023', '', '8:53 PM', 0, '2022-07-14 08:02:00', 1, 305),
(20, '\'employer\'', '', 'Autobots', '', '', '', '', 'optimusprime@gmail.com', '2 Casimiro Ave, Las Piñas, Metro Manila, Philippines', '14.4670530', '120.9702801', 'Las Piñas', 'Metro Manila', 'Philippines', 21, '', '', '', '', '', 0, '2022-07-17 06:00:34', 1, 308);

-- --------------------------------------------------------

--
-- Table structure for table `oemployer_position`
--

DROP TABLE IF EXISTS `oemployer_position`;
CREATE TABLE `oemployer_position` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'employer_position',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oemployer_position`
--

INSERT INTO `oemployer_position` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(4, 'employer_position', 'Test', 0, '2022-08-04 09:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `ohomepage_banner`
--

DROP TABLE IF EXISTS `ohomepage_banner`;
CREATE TABLE `ohomepage_banner` (
  `id` int(10) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'homepage_banner',
  `doc_image_a` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `doc_image_b` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `title_a` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title_b` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description_a` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `description_b` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ohomepage_banner`
--

INSERT INTO `ohomepage_banner` (`id`, `type`, `doc_image_a`, `doc_image_b`, `title_a`, `title_b`, `description_a`, `description_b`, `date_created`) VALUES
(5, 'homepage_banner', '1657780469_pexels-craig-adderley-1563356.jpg', '1657780481_donnie-rosie-taO2fC7sxDU-unsplash.jpg', 'Test A', 'Test B', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non condimentum erat, a aliquet enim. Nam dapibus sed dui sit amet egestas. Nullam sed aliquet lacus, vitae venenatis mi. Sed id hendrerit odio. Cras venenatis nisl lacus, vitae varius arcu vestibulum eget. Donec ultricies suscipit dui vel varius.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non condimentum erat, a aliquet enim. Nam dapibus sed dui sit amet egestas. Nullam sed aliquet lacus, vitae venenatis mi. Sed id hendrerit odio. Cras venenatis nisl lacus, vitae varius arcu vestibulum eget. Donec ultricies suscipit dui vel varius.', '2022-07-14 14:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `oindustry`
--

DROP TABLE IF EXISTS `oindustry`;
CREATE TABLE `oindustry` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'industry',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oindustry`
--

INSERT INTO `oindustry` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(11, 'industry', 'Airline', 0, '2022-06-25 11:31:07'),
(12, 'industry', 'Car Rental', 0, '2022-06-25 11:31:07'),
(13, 'industry', 'Consulting and Training', 0, '2022-06-25 11:31:07'),
(14, 'industry', 'Cruise Ship', 0, '2022-06-25 11:31:07'),
(15, 'industry', 'Food and Beverage', 0, '2022-06-25 11:31:07'),
(16, 'industry', 'Gaming', 0, '2022-06-25 11:31:07'),
(17, 'industry', 'Meetings and Events', 0, '2022-06-25 11:31:07'),
(18, 'industry', 'Retail', 0, '2022-06-25 11:31:07'),
(19, 'industry', 'Serviced Accomodation', 0, '2022-06-25 11:31:07'),
(20, 'industry', 'Spa and Wellness', 0, '2022-06-25 11:31:07'),
(21, 'industry', 'Software and Technology', 0, '2022-06-25 11:31:07'),
(22, 'industry', 'Support Services', 0, '2022-06-25 11:31:07'),
(23, 'industry', 'Talent Acquisition', 0, '2022-06-25 11:31:07'),
(24, 'industry', 'Theme Park', 0, '2022-06-25 11:31:07'),
(25, 'industry', 'Agency / Tour Operator', 0, '2022-07-03 06:57:23'),
(26, 'industry', 'Hotel and Resort', 0, '2022-07-16 12:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `ojob_level`
--

DROP TABLE IF EXISTS `ojob_level`;
CREATE TABLE `ojob_level` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_level',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ojob_level`
--

INSERT INTO `ojob_level` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(1, 'job_level', 'Internship', 0, '2022-06-25 11:59:18'),
(2, 'job_level', 'Entry Level', 0, '2022-06-25 11:59:18'),
(3, 'job_level', 'Associate', 0, '2022-06-25 11:59:18'),
(4, 'job_level', 'Mid-Senior Level', 0, '2022-06-25 11:59:18'),
(5, 'job_level', 'Director', 0, '2022-06-25 11:59:18'),
(6, 'job_level', 'Executive', 0, '2022-06-25 11:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `ojob_post`
--

DROP TABLE IF EXISTS `ojob_post`;
CREATE TABLE `ojob_post` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'job_post',
  `job_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(20) NOT NULL,
  `industry` int(20) NOT NULL,
  `job_level` int(20) NOT NULL,
  `job_type` int(20) NOT NULL,
  `education` int(20) NOT NULL,
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
  `perks_and_benefits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `job_expiration_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `vacancies` int(10) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_posted` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(20) NOT NULL,
  `employer` int(20) NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `remove_on` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_closed` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ojob_post`
--

INSERT INTO `ojob_post` (`id`, `type`, `job_title`, `department`, `industry`, `job_level`, `job_type`, `education`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `job_description`, `qualification`, `salary_currency`, `salary_from`, `salary_to`, `perks_and_benefits`, `job_expiration_date`, `vacancies`, `inactive`, `date_posted`, `date_created`, `created_by`, `employer`, `status`, `remove_on`, `date_closed`) VALUES
(26, 'job_post', 'Systems Developer', 24, 16, 4, 41, 281, '1471 Quezon Ave, Quezon City, 1104 Metro Manila, Philippines', '14.6404977', '121.0309626', 'Quezon City', 'Metro Manila', 'Philippines', '- Test', '- Test', 'PHP', '30000.00', '40000.00', '[\"4\",\"5\",\"6\",\"7\",\"8\",\"9\"]', '10/1/2022', 10, 0, '08/05/2022 12:56 AM', '2022-08-05 00:56:17', 77, 17, 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ojob_type`
--

DROP TABLE IF EXISTS `ojob_type`;
CREATE TABLE `ojob_type` (
  `id` int(20) NOT NULL,
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
(43, 'job_type', 'Contractual', 1, '2022-06-25 11:28:46'),
(44, 'job_type', 'Project', 0, '2022-06-25 11:28:46'),
(45, 'job_type', 'Internship', 0, '2022-06-25 11:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `olocation`
--

DROP TABLE IF EXISTS `olocation`;
CREATE TABLE `olocation` (
  `id` int(20) NOT NULL,
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
(5, 'location', 'Hong Kong', 0, '2022-06-25 12:06:00'),
(6, 'location', 'Indonesia', 0, '2022-06-25 12:06:00'),
(7, 'location', 'Japan', 0, '2022-06-25 12:06:00'),
(8, 'location', 'Macau', 0, '2022-06-25 12:06:00'),
(9, 'location', 'Malaysia', 0, '2022-06-25 12:06:00'),
(10, 'location', 'New Zealand', 0, '2022-06-25 12:06:00'),
(11, 'location', 'Philippines', 0, '2022-06-25 12:06:00'),
(12, 'location', 'Saipan', 0, '2022-06-25 12:06:00'),
(13, 'location', 'Singapore', 0, '2022-06-25 12:06:00'),
(14, 'location', 'South Korea', 0, '2022-06-25 12:06:00'),
(15, 'location', 'Taiwan', 0, '2022-06-25 12:06:00'),
(16, 'location', 'Thailand', 0, '2022-06-25 12:06:00'),
(17, 'location', 'Vietnam', 0, '2022-06-25 12:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `operks_and_benefits`
--

DROP TABLE IF EXISTS `operks_and_benefits`;
CREATE TABLE `operks_and_benefits` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'perks_and_benefits',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `operks_and_benefits`
--

INSERT INTO `operks_and_benefits` (`id`, `type`, `name`, `inactive`, `date_created`) VALUES
(4, 'perks_and_benefits', 'Vacation Leave', 0, '2022-07-14 13:01:23'),
(5, 'perks_and_benefits', 'Sick Leave', 0, '2022-07-14 13:01:23'),
(6, 'perks_and_benefits', 'Maternity Leave', 0, '2022-07-14 13:01:23'),
(7, 'perks_and_benefits', 'Paternity Leave', 0, '2022-07-14 13:01:23'),
(8, 'perks_and_benefits', 'HMO', 0, '2022-07-14 13:01:23'),
(9, 'perks_and_benefits', 'Paid Time Off', 0, '2022-07-14 13:01:23'),
(10, 'perks_and_benefits', 'Family Medical Leave', 0, '2022-07-14 13:01:23'),
(11, 'perks_and_benefits', 'Bereavement Leave', 0, '2022-07-14 13:01:23'),
(12, 'perks_and_benefits', 'Company bonus scheme', 0, '2022-07-14 13:01:23'),
(13, 'perks_and_benefits', 'Dental Benefits', 0, '2022-07-14 13:01:23'),
(14, 'perks_and_benefits', 'Vision Benefits', 0, '2022-07-14 13:01:23'),
(15, 'perks_and_benefits', 'Health Insurance Benefits', 0, '2022-07-14 13:01:23'),
(16, 'perks_and_benefits', 'Life Insurance', 0, '2022-07-14 13:01:23'),
(17, 'perks_and_benefits', 'Disability Insurance', 0, '2022-07-14 13:01:23'),
(18, 'perks_and_benefits', 'Employee Meals', 0, '2022-07-14 13:01:23'),
(19, 'perks_and_benefits', 'Uniforms Provided', 0, '2022-07-14 13:01:23'),
(20, 'perks_and_benefits', 'Company Discounts', 0, '2022-07-14 13:01:23'),
(21, 'perks_and_benefits', 'Housing allowance', 0, '2022-07-14 13:01:23'),
(22, 'perks_and_benefits', 'Housing provided', 0, '2022-07-14 13:01:23'),
(23, 'perks_and_benefits', 'Transport allowance', 0, '2022-07-14 13:01:23'),
(24, 'perks_and_benefits', 'Relocation reimbursement', 0, '2022-07-14 13:01:23'),
(25, 'perks_and_benefits', 'Internship allowance', 0, '2022-07-14 13:01:23'),
(26, 'perks_and_benefits', 'Executive benefits', 0, '2022-07-14 13:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `opermission`
--

DROP TABLE IF EXISTS `opermission`;
CREATE TABLE `opermission` (
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `record_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permission`))
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
('employer', 'applicant_info', '[\"view\",\"edit\",\"add\"]'),
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
  `id` int(20) NOT NULL,
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

--
-- Dumping data for table `oprofile`
--

INSERT INTO `oprofile` (`id`, `type`, `doc_image`, `honorifics`, `first_name`, `middle_name`, `last_name`, `email_add`, `designation`, `dial_code`, `contact_number`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `date_created`, `first_login`, `highlights`, `internship`, `resume`) VALUES
(75, 'profile', '1658325387_photo.png', '', 'Phoenix', 'Corpus', 'Langaman', 'applicant1@gmail.com', '', '+63', '9171551303', 'San Marcelino, Zambales, Philippines', '15.0260510', '120.2743484', 'San Marcelino', 'Central Luzon', 'Philippines', '2022-07-17 14:32:50', 0, 'fsaf', 1, '1658755547_LOR - Phoenix Langaman 2.docx'),
(77, 'profile', '', 'Mr.', 'Dex', '', 'Manreza', 'dex.manreza@gmail.com', 'OIC', '+63', '9217697036', '', '0.0000000', '0.0000000', '', '', '', '2022-07-26 20:21:08', 1, '', 0, ''),
(78, 'profile', '', '', 'Algen Patrick', '', 'Esturas', 'algen.esturas@itgroupinc.asia', '', '+63', '9171551303', 'Quezon City, Metro Manila, Philippines', '14.6760413', '121.0437003', 'Quezon City', 'Metro Manila', 'Philippines', '2022-07-30 15:14:44', 0, 'Test', 0, ''),
(79, 'profile', '', 'Mr.', 'Salvador', '', 'Carlos', 'saldy@gmail.com', 'Implementation Engineer', '+63', '9171551303', '', '0.0000000', '0.0000000', '', '', '', '2022-07-30 17:24:56', 1, '', 0, ''),
(80, 'profile', '', '', 'Gym Lyssa', 'Silos', 'Langaman', 'gym@gmail.com', '', '+63', '9171551303', 'Manggalang 1, Sariaya, 4322 Quezon, Philippines', '13.8733756', '121.4856066', 'Sariaya', 'Calabarzon', 'Philippines', '2022-08-04 10:42:55', 0, 'Malupet', 0, '');

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
  `industry` int(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `osignup`
--

INSERT INTO `osignup` (`id`, `type`, `username`, `password`, `honorifics`, `user_type`, `first_name`, `last_name`, `work_email`, `dial_code`, `contact_number`, `company_name`, `location`, `lat`, `lng`, `locality`, `administrative_area_level_1`, `country`, `designation`, `industry`, `status`, `date_created`) VALUES
(302, 'signup', 'phoenixlangaman087@gmail.com', 'Admin1234', 'Mr.', 'company', 'Phoenix', 'Langaman', 'phoenixlangaman05@gmail.com', '+63', '9171551303', 'IT Group Inc', '1471 Quezon Ave, Quezon City, 1104 Metro Manila, Philippines', '14.6404977', '121.0309626', 'Quezon City', 'Metro Manila', 'Philippines', 'Software Developer', 21, 2, '2022-07-11 14:13:50'),
(303, 'signup', 'gymmasangkaysilos@gmail.com', 'Admin1234', 'Ms.', 'company', 'Gym Lyssa', 'Langaman', 'gymmasangkaysilos@gmail.com', '+63', '9217697036', 'PRBFI', 'Barrio Mangilag Sur, WFJ6+72V, Candelaria, Quezon, Philippines', '13.9307450', '121.4600570', 'Candelaria', 'Quezon Province', 'Philippines', 'Accounting Staff', 15, 2, '2022-07-14 05:25:49'),
(304, 'signup', 'partner1@gmail.com', 'Partner1234', 'Mr.', 'company', 'Angel', 'Locsin', 'partner1@gmail.com', '+63', '9171551304', 'ABS-CBN', 'J2MV+V78, MRT Kamuning Station Overpass, Diliman, Quezon City, Metro Manila, Philippines', '14.6346633', '121.0431994', 'Quezon City', 'Metro Manila', 'Philippines', 'Artist', 23, 3, '2022-07-14 07:53:53'),
(305, 'signup', 'partner2@gmail.com', 'Partner21234', 'Ms.', 'company', 'Ciara Pauline', 'Silos', 'partner2@gmail.com', '+63', '9171551303', 'PCL Corporation', 'Block 63 Lot 12 Masunurin St. Barangay, Fiesta Communities Inc, Castillejos, 2208 Zambales, Philippines', '14.9260337', '120.2155296', 'Castillejos', 'Central Luzon', 'Philippines', 'Staff', 15, 2, '2022-07-14 08:01:45'),
(308, 'signup', 'optimusprime@gmail.com', 'Admin1234', 'Mr.', 'company', 'Optimus', 'Prime', 'optimusprime@gmail.com', '+509', '9171551303', 'Autobots', '2 Casimiro Ave, Las Piñas, Metro Manila, Philippines', '14.4670530', '120.9702801', 'Las Piñas', 'Metro Manila', 'Philippines', 'Team Lead', 21, 2, '2022-07-17 05:59:19');

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
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `employer` int(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_logged_in` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ousr`
--

INSERT INTO `ousr` (`id`, `type`, `name`, `username`, `password`, `email_add`, `user_type`, `inactive`, `employer`, `date_created`, `last_logged_in`) VALUES
(3, 'user', 'Phoenix Langaman', 'phoenixlangaman05@gmail.com', 'Admin1234', 'phoenixlangaman05@gmail.com', 'admin', 0, 0, '2022-07-13 16:24:58', '08/04/2022 11:03 PM'),
(21, 'user', 'Arman Simon', 'arman_simon@hotmail.com', 'Butandingna1021Payatot', 'arman_simon@hotmail.com', 'admin', 0, 0, '2022-07-13 16:24:58', '07/24/2022 04:33 PM'),
(75, 'user', 'Phoenix Langaman', 'applicant1@gmail.com', 'Admin1234', 'applicant1@gmail.com', 'applicant', 0, 0, '2022-07-17 14:32:50', '08/04/2022 11:07 PM'),
(77, 'user', 'Dex Manreza', 'dex.manreza@gmail.com', 'Lu7Zt3yi', 'dex.manreza@gmail.com', 'employer', 0, 17, '2022-07-26 20:21:08', '08/05/2022 12:54 AM'),
(78, 'user', 'Algen Patrick Esturas', 'algen.esturas@itgroupinc.asia', 'Algen1234', 'algen.esturas@itgroupinc.asia', 'applicant', 0, 0, '2022-07-30 15:14:44', '08/04/2022 10:21 PM'),
(79, 'user', 'Salvador Carlos', 'saldy@gmail.com', 'LJdHqo4l', 'saldy@gmail.com', 'employer', 0, 19, '2022-07-30 17:24:56', '08/02/2022 07:04 PM'),
(80, 'user', 'Gym Lyssa Langaman', 'gym@gmail.com', 'Gymlyssa1234', 'gym@gmail.com', 'applicant', 0, 0, '2022-08-04 10:42:55', '08/04/2022 06:39 PM');

-- --------------------------------------------------------

--
-- Table structure for table `profile_affiliations`
--

DROP TABLE IF EXISTS `profile_affiliations`;
CREATE TABLE `profile_affiliations` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_affiliations',
  `line` int(10) NOT NULL,
  `affiliation` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_affiliations`
--

INSERT INTO `profile_affiliations` (`id`, `type`, `line`, `affiliation`) VALUES
(75, 'profile_affiliations', 1, 'Aff 1'),
(75, 'profile_affiliations', 2, 'Aff 2'),
(75, 'profile_affiliations', 3, 'Aff 3');

-- --------------------------------------------------------

--
-- Table structure for table `profile_awards_achievements`
--

DROP TABLE IF EXISTS `profile_awards_achievements`;
CREATE TABLE `profile_awards_achievements` (
  `id` int(20) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_awards_achievements',
  `line` int(10) NOT NULL,
  `award_achievement` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_awards_achievements`
--

INSERT INTO `profile_awards_achievements` (`id`, `type`, `line`, `award_achievement`) VALUES
(75, 'profile_awards_achievements', 1, 'Awards 1');

-- --------------------------------------------------------

--
-- Table structure for table `profile_certifications_licenses`
--

DROP TABLE IF EXISTS `profile_certifications_licenses`;
CREATE TABLE `profile_certifications_licenses` (
  `id` int(20) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_certifications_licenses',
  `line` int(10) NOT NULL,
  `certification` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_certifications_licenses`
--

INSERT INTO `profile_certifications_licenses` (`id`, `type`, `line`, `certification`) VALUES
(75, 'profile_certifications_licenses', 1, 'Test Cert 1'),
(75, 'profile_certifications_licenses', 2, 'Test Cert 2'),
(75, 'profile_certifications_licenses', 3, 'Test Cert 3'),
(75, 'profile_certifications_licenses', 4, 'Test Cert 4');

-- --------------------------------------------------------

--
-- Table structure for table `profile_department`
--

DROP TABLE IF EXISTS `profile_department`;
CREATE TABLE `profile_department` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_department',
  `line` int(10) NOT NULL,
  `department` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_department`
--

INSERT INTO `profile_department` (`id`, `type`, `line`, `department`) VALUES
(75, 'profile_department', 1, 17),
(75, 'profile_department', 2, 13),
(75, 'profile_department', 3, 32),
(75, 'profile_department', 4, 7),
(78, 'profile_department', 1, 3),
(80, 'profile_department', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `profile_education`
--

DROP TABLE IF EXISTS `profile_education`;
CREATE TABLE `profile_education` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_education',
  `line` int(10) NOT NULL,
  `school` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `degree` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `education` int(20) NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_education`
--

INSERT INTO `profile_education` (`id`, `type`, `line`, `school`, `degree`, `education`, `start_date`, `end_date`, `if_current`) VALUES
(75, 'profile_education', 1, 'UE', 'Bachelor\'s Degree', 281, '7/21/2010', '7/21/2020', 0),
(75, 'profile_education', 2, 'SGNHS', 'HS', 275, '7/21/2010', '7/21/2010', 1),
(80, 'profile_education', 1, 'MSCUFCI', 'BSA', 281, '1/1/2014', '1/1/2018', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile_experience`
--

DROP TABLE IF EXISTS `profile_experience`;
CREATE TABLE `profile_experience` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_experience',
  `line` int(10) NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `if_current` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_experience`
--

INSERT INTO `profile_experience` (`id`, `type`, `line`, `designation`, `company_name`, `short_description`, `start_date`, `end_date`, `if_current`, `date_created`) VALUES
(75, 'profile_experience', 1, 'System Developer', 'DataFront Solutions', 'Service Company', '1/1/2018', '3/11/2019', 1, '2022-07-25 21:25:56'),
(75, 'profile_experience', 2, 'Database Admin', 'DB Quest', 'Weakling Company', '1/1/2018', '3/1/2022', 0, '2022-07-25 21:25:56'),
(80, 'profile_experience', 1, 'Accounting Assistant', 'PRBFI', 'Food', '1/1/2019', '1/1/2021', 0, '2022-08-04 10:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `profile_industry`
--

DROP TABLE IF EXISTS `profile_industry`;
CREATE TABLE `profile_industry` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_industry',
  `line` int(10) NOT NULL,
  `industry` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_industry`
--

INSERT INTO `profile_industry` (`id`, `type`, `line`, `industry`) VALUES
(75, 'profile_industry', 1, 11),
(75, 'profile_industry', 2, 12),
(75, 'profile_industry', 3, 15),
(75, 'profile_industry', 4, 20),
(75, 'profile_industry', 5, 16),
(78, 'profile_industry', 1, 11),
(80, 'profile_industry', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_level`
--

DROP TABLE IF EXISTS `profile_job_level`;
CREATE TABLE `profile_job_level` (
  `id` int(20) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_job_level',
  `line` int(10) NOT NULL,
  `job_level` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_job_level`
--

INSERT INTO `profile_job_level` (`id`, `type`, `line`, `job_level`) VALUES
(75, 'profile_job_level', 1, 3),
(75, 'profile_job_level', 2, 4),
(78, 'profile_job_level', 1, 3),
(80, 'profile_job_level', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `profile_job_type`
--

DROP TABLE IF EXISTS `profile_job_type`;
CREATE TABLE `profile_job_type` (
  `id` int(20) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_job_type',
  `line` int(10) NOT NULL,
  `job_type` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_job_type`
--

INSERT INTO `profile_job_type` (`id`, `type`, `line`, `job_type`) VALUES
(75, 'profile_job_type', 1, 42),
(75, 'profile_job_type', 2, 41),
(78, 'profile_job_type', 1, 42),
(80, 'profile_job_type', 1, 41),
(80, 'profile_job_type', 2, 42);

-- --------------------------------------------------------

--
-- Table structure for table `profile_language`
--

DROP TABLE IF EXISTS `profile_language`;
CREATE TABLE `profile_language` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_language',
  `line` int(10) NOT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_language`
--

INSERT INTO `profile_language` (`id`, `type`, `line`, `language`) VALUES
(75, 'profile_language', 1, 'ENGLISH'),
(75, 'profile_language', 2, 'FILIPINO'),
(75, 'profile_language', 3, 'ILOKANO'),
(80, 'profile_language', 1, 'Tagalog'),
(80, 'profile_language', 2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `profile_projects`
--

DROP TABLE IF EXISTS `profile_projects`;
CREATE TABLE `profile_projects` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_projects',
  `line` int(10) NOT NULL,
  `projects` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_projects`
--

INSERT INTO `profile_projects` (`id`, `type`, `line`, `projects`) VALUES
(75, 'profile_projects', 1, 'Test Projects 1'),
(75, 'profile_projects', 2, 'Test Projects 2'),
(75, 'profile_projects', 3, 'Test Projects 3');

-- --------------------------------------------------------

--
-- Table structure for table `profile_seminars_trainings`
--

DROP TABLE IF EXISTS `profile_seminars_trainings`;
CREATE TABLE `profile_seminars_trainings` (
  `id` int(20) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_seminars_trainings',
  `line` int(10) NOT NULL,
  `seminar_training` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_seminars_trainings`
--

INSERT INTO `profile_seminars_trainings` (`id`, `type`, `line`, `seminar_training`) VALUES
(75, 'profile_seminars_trainings', 1, 'Seminar 1'),
(75, 'profile_seminars_trainings', 2, 'Seminar 2');

-- --------------------------------------------------------

--
-- Table structure for table `profile_skills`
--

DROP TABLE IF EXISTS `profile_skills`;
CREATE TABLE `profile_skills` (
  `id` int(20) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile_skills',
  `line` int(10) NOT NULL,
  `skills` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_skills`
--

INSERT INTO `profile_skills` (`id`, `type`, `line`, `skills`) VALUES
(75, 'profile_skills', 1, 'css'),
(75, 'profile_skills', 2, 'java'),
(75, 'profile_skills', 3, 'jquery'),
(80, 'profile_skills', 1, 'Talkative');

-- --------------------------------------------------------

--
-- Table structure for table `usr_job_invite`
--

DROP TABLE IF EXISTS `usr_job_invite`;
CREATE TABLE `usr_job_invite` (
  `id` int(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usr_job_invite',
  `job_post` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usr_job_post_fav`
--

DROP TABLE IF EXISTS `usr_job_post_fav`;
CREATE TABLE `usr_job_post_fav` (
  `id` int(20) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usr_job_post_fav',
  `job_post` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

--
-- Indexes for table `ojob_type`
--
ALTER TABLE `ojob_type`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_post_for_interview`
--
ALTER TABLE `job_post_for_interview`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `oaud`
--
ALTER TABLE `oaud`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2168;

--
-- AUTO_INCREMENT for table `odepartment`
--
ALTER TABLE `odepartment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `oeducation`
--
ALTER TABLE `oeducation`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

--
-- AUTO_INCREMENT for table `oemail_template`
--
ALTER TABLE `oemail_template`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oemployer`
--
ALTER TABLE `oemployer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `oemployer_position`
--
ALTER TABLE `oemployer_position`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ohomepage_banner`
--
ALTER TABLE `ohomepage_banner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `oindustry`
--
ALTER TABLE `oindustry`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ojob_level`
--
ALTER TABLE `ojob_level`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ojob_post`
--
ALTER TABLE `ojob_post`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ojob_type`
--
ALTER TABLE `ojob_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `olocation`
--
ALTER TABLE `olocation`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `operks_and_benefits`
--
ALTER TABLE `operks_and_benefits`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `osignup`
--
ALTER TABLE `osignup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `ostatus`
--
ALTER TABLE `ostatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ousr`
--
ALTER TABLE `ousr`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
