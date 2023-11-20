-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 04:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computerlaboratorymanagementsystem`
--
CREATE DATABASE IF NOT EXISTS `computerlaboratorymanagementsystem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `computerlaboratorymanagementsystem`;

-- --------------------------------------------------------

--
-- Table structure for table `clms_laboratories`
--

CREATE TABLE `clms_laboratories` (
  `laboratory_id` int(11) NOT NULL,
  `laboratory_name` varchar(50) NOT NULL,
  `laboratory_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clms_laboratories`
--

INSERT INTO `clms_laboratories` (`laboratory_id`, `laboratory_name`, `laboratory_status`) VALUES
(1, 'Internet Laboratory', 'Inactive'),
(2, 'CISCO Laboratory', 'Active'),
(3, 'Auto CAD Laboratory', 'Inactive'),
(4, 'CIT Laboratory', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `clms_logs`
--

CREATE TABLE `clms_logs` (
  `id` int(11) NOT NULL,
  `srcode` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `session_code` varchar(20) NOT NULL,
  `laboratory_id` int(11) NOT NULL,
  `laboratory_name` varchar(100) NOT NULL,
  `timein` varchar(20) DEFAULT NULL,
  `timeout` varchar(20) DEFAULT NULL,
  `date` varchar(50) NOT NULL,
  `faculty_name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `pc_number` varchar(11) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clms_logs`
--

INSERT INTO `clms_logs` (`id`, `srcode`, `fullname`, `session_code`, `laboratory_id`, `laboratory_name`, `timein`, `timeout`, `date`, `faculty_name`, `subject`, `section`, `pc_number`, `department`, `course`, `purpose`) VALUES
(1, '19-63740', 'MARIÃ‘O, JOHN KEVIN S.', 'IL-041723-Y653', 1, 'Internet Laboratory', '10:49:05 am', '10:49:09 am', '2023-04-17', '', '', '', '1', 'CICS', 'BS Information Technology', 'Studies'),
(2, '19-63740', 'MARIÃ‘O, JOHN KEVIN S.', 'IL-041723-Y653', 1, 'Internet Laboratory', '10:49:40 am', '10:49:42 am', '2023-04-17', '', '', '', '1', 'CICS', 'BS Information Technology', 'Studies'),
(3, '19-05309', 'MALOLES, CARL VINCENT M.', 'IL-041723-Y653', 1, 'Internet Laboratory', '10:54:32 am', '12:57:12 pm', '2023-04-17', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(4, '19-63740', 'MARIÃ‘O, JOHN KEVIN S.', 'IL-041723-Y653', 1, 'Internet Laboratory', '11:09:51 am', '11:10:03 am', '2023-04-17', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(5, '19-61072', 'LOPEZ, JOHN KENNETH M.', 'IL-041723-Y653', 1, 'Internet Laboratory', '12:03:39 pm', '12:03:54 pm', '2023-04-17', 'ICT Office', '', '', '3', 'CICS', 'BS Information Technology', 'Studies'),
(6, '19-61072', 'LOPEZ, JOHN KENNETH M.', 'IL-041723-Y653', 1, 'Internet Laboratory', '01:30:43 pm', '01:31:16 pm', '2023-04-17', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(7, '19-61072', 'LOPEZ, JOHN KENNETH M.', 'IL-041723-Y653', 1, 'Internet Laboratory', '01:31:24 pm', '01:39:58 pm', '2023-04-17', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(8, '19-63740', 'MARIÃ‘O, JOHN KEVIN S.', 'IL-041823-R447', 1, 'Internet Laboratory', '07:56:51 am', '08:05:48 am', '2023-04-18', '', '', '', '2', 'CICS', 'BS Information Technology', 'Studies'),
(9, '20-61927', 'VERGARA, CASSANDRA M.', 'IL-041823-R447', 1, 'Internet Laboratory', '08:41:57 am', '09:05:39 am', '2023-04-18', '', '', '', '5', 'CABEIHM', 'BS Business Administration', 'Studies'),
(10, '20-64318', 'CATALA, CARMELA FAITH M.', 'IL-041823-R447', 1, 'Internet Laboratory', '08:52:12 am', '09:11:54 am', '2023-04-18', '', '', '', '10', 'CABEIHM', 'BS Business Administration', 'Studies'),
(11, '20-61927', 'VERGARA, CASSANDRA M.', 'IL-041823-R447', 1, 'Internet Laboratory', '09:06:46 am', '09:11:54 am', '2023-04-18', '', '', '', '4', 'CABEIHM', 'BS Business Administration', 'Studies'),
(12, '20-64318', 'CATALA, CARMELA FAITH M.', 'IL-041823-R447', 1, 'Internet Laboratory', '09:37:25 am', '09:37:55 am', '2023-04-18', '', '', '', '10', 'CABEIHM', 'BS Business Administration', 'Studies'),
(13, '20-69210', 'SANVICTORES, JIREH EMMANUEL K.', 'IL-041923-47Q4', 1, 'Internet Laboratory', '09:06:37 am', '09:49:23 am', '2023-04-19', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(14, '22-64063', 'BALAGUER, AARON I.', 'IL-041923-47Q4', 1, 'Internet Laboratory', '09:08:56 am', '09:49:25 am', '2023-04-19', 'ICT Office', '', '', '11', 'CICS', 'BS Information Technology', 'Studies'),
(15, '22-64263', 'MALABANAN, AARON M.', 'IL-041923-47Q4', 1, 'Internet Laboratory', '09:09:22 am', '09:49:25 am', '2023-04-19', 'ICT Office', '', '', '12', 'CICS', 'BS Information Technology', 'Studies'),
(16, 'J18-67943', 'CADRO, DEAN JAYLORD V.', 'IL-041923-47Q4', 1, 'Internet Laboratory', '01:07:39 pm', '01:22:31 pm', '2023-04-19', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(17, '19-60497', 'MERCADO, NATHANIEL L.', 'IL-042023-19F5', 1, 'Internet Laboratory', '08:16:28 am', '10:03:02 am', '2023-04-20', '', '', '', '4', 'CABEIHM', 'BS Management Accounting', 'Studies'),
(18, '20-62175', 'MAGPANTAY, CHERRY NICOLE V.', 'IL-042023-19F5', 1, 'Internet Laboratory', '04:19:12 pm', '04:30:10 pm', '2023-04-20', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(20, '21-62417', 'ALVAREZ, LESTER F.', 'IL-042423-98F0', 1, 'Internet Laboratory', '04:58:07 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '12', 'CICS', 'BS Information Technology', 'Studies'),
(21, '21-69134', 'MORCILLA, CHARLES CLARENCE M.', 'IL-042423-98F0', 1, 'Internet Laboratory', '04:58:10 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(22, '21-67767', 'SOLIS, MARVIN F.', 'IL-042423-98F0', 1, 'Internet Laboratory', '04:58:18 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(23, '21-68408', 'GUEVARRA, JOICE DIAN R.', 'IL-042423-98F0', 1, 'Internet Laboratory', '04:58:29 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '11', 'CICS', 'BS Information Technology', 'Studies'),
(24, '21-64303', 'ANGULO, WILLEN .', 'IL-042423-98F0', 1, 'Internet Laboratory', '04:58:50 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '5', 'CICS', 'BS Information Technology', 'Studies'),
(25, '21-69993', 'MONCAYO, JUSTINE M.', 'IL-042423-98F0', 1, 'Internet Laboratory', '05:01:36 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '7', 'CICS', 'BS Information Technology', 'Studies'),
(26, '21-61193', 'ORNA, KIM LEO S.', 'IL-042423-98F0', 1, 'Internet Laboratory', '05:01:49 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(27, '20-62960', 'ABANO, JOHN LORENZ L.', 'IL-042423-98F0', 1, 'Internet Laboratory', '05:04:02 pm', '07:56:46 am', '2023-04-24', 'ICT Office', '', '', '8', 'CICS', 'BS Information Technology', 'Studies'),
(28, '20-62830', 'SALVADOR, JHENNY E.', 'IL-042523-N686', 1, 'Internet Laboratory', '09:37:01 am', '11:50:02 am', '2023-04-25', 'ICT Office', '', '', '7', 'CICS', 'BS Information Technology', 'Studies'),
(29, '20-62656', 'YANSON, JESSICA B.', 'IL-042523-N686', 1, 'Internet Laboratory', '09:38:21 am', '11:03:23 am', '2023-04-25', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(30, '19-66443', 'BACAY, ME ANNE JOYCE P.', 'IL-042523-N686', 1, 'Internet Laboratory', '10:48:03 am', '02:06:12 pm', '2023-04-25', 'ICT Office', '', '', '10', 'CICS', 'BS Computer Science', 'Studies'),
(31, '20-62830', 'SALVADOR, JHENNY E.', 'IL-042523-N686', 1, 'Internet Laboratory', '11:51:07 am', '11:51:20 am', '2023-04-25', 'ICT Office', '', '', '7', 'CICS', 'BS Information Technology', 'Studies'),
(32, '19-66629', 'MANGUIAT, JAKE BRYAN L.', 'IL-042523-N686', 1, 'Internet Laboratory', '01:32:53 pm', '05:27:23 pm', '2023-04-25', 'ICT Office', '', '', '4', 'CICS', 'BS Computer Science', 'Studies'),
(33, '19-63753', 'REAÃ‘O, ALLYSSA J.', 'IL-042523-N686', 1, 'Internet Laboratory', '01:40:23 pm', '05:25:04 pm', '2023-04-25', 'ICT Office', '', '', '7', 'CICS', 'BS Computer Science', 'Studies'),
(34, '19-68269', 'GONZAGA, NICIA P.', 'IL-042523-N686', 1, 'Internet Laboratory', '02:26:58 pm', '02:50:06 pm', '2023-04-25', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(35, '19-61283', 'BALAZON, KLARK IVAN MARK P.', 'IL-042523-N686', 1, 'Internet Laboratory', '03:01:26 pm', '04:04:09 pm', '2023-04-25', 'ICT Office', '', '', '12', 'CICS', 'BS Computer Science', 'Studies'),
(36, '20-80489', 'CUADRO, MARYGRACE A.', 'IL-042523-N686', 1, 'Internet Laboratory', '03:40:46 pm', '06:20:18 pm', '2023-04-25', 'ICT Office', '', '', '9', 'CICS', 'BS Information Technology', 'Studies'),
(37, '20-66751', 'LIWAG, R.J. C.', 'IL-042523-N686', 1, 'Internet Laboratory', '03:41:25 pm', '06:20:18 pm', '2023-04-25', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(38, '20-68720', 'CAMPIT, ELFIE MARVIN JOHN F.', 'IL-042523-N686', 1, 'Internet Laboratory', '03:48:01 pm', '06:20:18 pm', '2023-04-25', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(40, 'j18-68399', 'ALTIZA, SHIERWEN R.', 'IL-042623-8B05', 1, 'Internet Laboratory', '11:54:57 am', '03:08:22 pm', '2023-04-26', 'ICT Office', '', '', '7', 'CICS', 'BS Computer Science', 'Studies'),
(42, '20-60291', 'MASA, JAMES V.', 'IL-042723-E570', 1, 'Internet Laboratory', '08:58:23 am', '09:44:50 am', '2023-04-27', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(43, '21-64014', 'SIBUMA, JOHN BERNARD D.', 'IL-042723-E570', 1, 'Internet Laboratory', '08:58:24 am', '02:34:05 pm', '2023-04-27', 'ICT Office', '', '', '12', 'CICS', 'BS Information Technology', 'Studies'),
(44, '21-66120', 'ALMOGUERRA, JOMARIE A.', 'IL-042723-E570', 1, 'Internet Laboratory', '08:58:32 am', '09:44:38 am', '2023-04-27', 'ICT Office', '', '', '11', 'CICS', 'BS Information Technology', 'Studies'),
(45, '21-64264', 'ALBA, JENE RUSSEL R.', 'IL-042723-E570', 1, 'Internet Laboratory', '01:14:43 pm', '02:26:21 pm', '2023-04-27', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(46, '20-60291', 'MASA, JAMES V.', 'IL-042723-E570', 1, 'Internet Laboratory', '01:19:57 pm', '02:37:19 pm', '2023-04-27', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(47, '21-66120', 'ALMOGUERRA, JOMARIE A.', 'IL-042723-E570', 1, 'Internet Laboratory', '01:20:10 pm', '02:35:51 pm', '2023-04-27', 'ICT Office', '', '', '11', 'CICS', 'BS Information Technology', 'Studies'),
(48, '21-69553', 'LIMBO, DANIELLA JIANSHE C.', 'IL-042723-E570', 1, 'Internet Laboratory', '01:20:57 pm', '02:34:12 pm', '2023-04-27', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(49, '21-64014', 'SIBUMA, JOHN BERNARD D.', 'IL-042823-4I62', 1, 'Internet Laboratory', '10:19:32 am', '11:49:53 am', '2023-04-28', 'ICT Office', '', '', '12', 'CICS', 'BS Information Technology', 'Studies'),
(50, '20-60291', 'MASA, JAMES V.', 'IL-042823-4I62', 1, 'Internet Laboratory', '10:19:36 am', '01:47:33 pm', '2023-04-28', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(51, '21-66120', 'ALMOGUERRA, JOMARIE A.', 'IL-042823-4I62', 1, 'Internet Laboratory', '10:19:33 am', '11:43:34 am', '2023-04-28', 'ICT Office', '', '', '11', 'CICS', 'BS Information Technology', 'Studies'),
(52, '21-65427', 'PALIMA, JANLLORD ELMER M.', 'IL-042823-4I62', 1, 'Internet Laboratory', '11:12:16 am', '12:03:53 pm', '2023-04-28', 'ICT Office', '', '', '5', 'CICS', 'BS Information Technology', 'Studies'),
(53, '21-65467', 'LEUS, KENT ADRIAN D.', 'IL-042823-4I62', 1, 'Internet Laboratory', '11:16:35 am', '12:03:58 pm', '2023-04-28', 'ICT Office', '', '', '7', 'CICS', 'BS Information Technology', 'Studies'),
(54, '21-65467', 'LEUS, KENT ADRIAN D.', 'IL-042823-4I62', 1, 'Internet Laboratory', '01:46:29 pm', '04:07:03 pm', '2023-04-28', 'ICT Office', '', '', '12', 'CICS', 'BS Information Technology', 'Studies'),
(55, '21-65427', 'PALIMA, JANLLORD ELMER M.', 'IL-042823-4I62', 1, 'Internet Laboratory', '01:48:05 pm', '03:58:48 pm', '2023-04-28', 'ICT Office', '', '', '11', 'CICS', 'BS Information Technology', 'Studies'),
(56, '21-62728', 'QUIBAL JR, IRENEO T.', 'IL-042823-4I62', 1, 'Internet Laboratory', '01:54:08 pm', '04:06:56 pm', '2023-04-28', 'ICT Office', '', '', '4', 'CICS', 'BS Information Technology', 'Studies'),
(57, '21-69553', 'LIMBO, DANIELLA JIANSHE C.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:14:53 pm', '03:53:38 pm', '2023-04-28', 'ICT Office', '', '', '7', 'CICS', 'BS Information Technology', 'Studies'),
(58, '21-61360', 'HINELAZO, DAIZY ANN A.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:15:19 pm', '03:50:51 pm', '2023-04-28', 'ICT Office', '', '', '9', 'CICS', 'BS Information Technology', 'Studies'),
(59, '21-67906', 'TAPAY, KRISTINE JOY H.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:15:22 pm', '03:53:21 pm', '2023-04-28', 'ICT Office', '', '', '8', 'CICS', 'BS Information Technology', 'Studies'),
(60, '21-67074', 'ARAÃ‘EZ, JAMES ANDREW R.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:16:04 pm', '04:06:59 pm', '2023-04-28', 'ICT Office', '', '', '5', 'CICS', 'BS Information Technology', 'Studies'),
(61, '21-66838', 'MIGO, JORISH ANN M.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:17:45 pm', '04:00:19 pm', '2023-04-28', 'ICT Office', '', '', '16', 'CICS', 'BS Information Technology', 'Studies'),
(62, '20-60291', 'MASA, JAMES V.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:18:17 pm', '04:46:10 pm', '2023-04-28', 'ICT Office', '', '', '10', 'CICS', 'BS Information Technology', 'Studies'),
(63, '21-66120', 'ALMOGUERRA, JOMARIE A.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:21:06 pm', '03:56:57 pm', '2023-04-28', 'ICT Office', '', '', '1', 'CICS', 'BS Information Technology', 'Studies'),
(64, '21-04654', 'BENAMIR, GIORDAN S.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:25:19 pm', '04:00:21 pm', '2023-04-28', 'ICT Office', '', '', '13', 'CICS', 'BS Information Technology', 'Studies'),
(65, '21-61360', 'HINELAZO, DAIZY ANN A.', 'IL-042823-4I62', 1, 'Internet Laboratory', '03:51:08 pm', '03:51:13 pm', '2023-04-28', 'ICT Office', '', '', '9', 'CICS', 'BS Information Technology', 'Studies'),
(67, '22-69782', 'BADILLO, PATRICK T.', 'IL-050223-M488', 1, 'Internet Laboratory', '05:36:11 pm', '05:36:54 pm', '2023-05-02', 'JOHN DOE', 'Computer Subject', 'IT-302', '2', 'CABEIHM', 'BS Business Administration', ''),
(68, '123456', 'AGBUYA, LORD SUN L.', 'IL-082423-2102', 1, 'Internet Laboratory', '05:57:25 pm', '05:58:52 pm', '2023-08-24', 'JOHN DOE', '', '', '1', 'CABEIHM', 'Bachelor of Elementary Education', 'Studies'),
(69, '22-67450', 'AGBUYA, LORD SUN L.', 'IL-082423-2102', 1, 'Internet Laboratory', '06:00:57 pm', '06:01:29 pm', '2023-08-24', 'JOHN DOE', '', '', '1', 'CABEIHM', 'BS Business Administration', 'Studies'),
(70, 'rt6uyrtuye5', 'AGBUYA, LORD SUN L.', 'IL-082423-2102', 1, 'Internet Laboratory', '06:01:12 pm', '06:01:31 pm', '2023-08-24', 'JOHN DOE', '', '', '2', 'CIT', 'Bachelor of Secondary Education', 'Studies'),
(71, '22-67450', 'AGBUYA, LORD SUN L.', 'IL-082423-2102', 1, 'Internet Laboratory', '06:01:36 pm', '06:04:43 pm', '2023-08-24', 'JOHN DOE', '', '', '1', 'CABEIHM', 'BS Business Administration', 'Studies'),
(72, '123456', 'RECIDO, EDWARD JAMES', 'IL-082423-2102', 1, 'Internet Laboratory', '06:04:25 pm', '06:04:44 pm', '2023-08-24', 'JOHN DOE', '', '', '2', 'CICS', 'BS Information Technology', 'Studies'),
(73, '123456', 'EDWARD JAMES RECIDO', 'IL-082423-2102', 1, 'Internet Laboratory', '06:06:22 pm', '06:06:38 pm', '2023-08-24', 'JOHN DOE', '', '', '2', 'CICS', 'BS Information Technology', 'Studies');

-- --------------------------------------------------------

--
-- Table structure for table `clms_pc`
--

CREATE TABLE `clms_pc` (
  `id` int(11) NOT NULL,
  `pc_number` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_srcode` varchar(20) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `laboratory_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `session_code` varchar(50) DEFAULT NULL,
  `report_id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clms_pc`
--

INSERT INTO `clms_pc` (`id`, `pc_number`, `status`, `user_srcode`, `date`, `time`, `laboratory_id`, `ip_address`, `session_code`, `report_id`) VALUES
(1, 1, 'available', NULL, NULL, NULL, 1, '192.168.204.150', NULL, NULL),
(2, 2, 'available', NULL, NULL, NULL, 1, '192.168.222.127', NULL, NULL),
(3, 3, 'not available', NULL, NULL, NULL, 1, '192.168.212.143', NULL, '3'),
(4, 4, 'available', NULL, NULL, NULL, 1, '192.168.199.53', NULL, NULL),
(5, 5, 'available', NULL, NULL, NULL, 1, '192.168.197.112', NULL, NULL),
(6, 6, 'not available', NULL, NULL, NULL, 1, '192.168.204.151', NULL, '2'),
(7, 7, 'available', NULL, NULL, NULL, 1, '192.168.212.137', NULL, NULL),
(8, 8, 'available', NULL, NULL, NULL, 1, '192.168.209.100', NULL, NULL),
(9, 9, 'available', NULL, NULL, NULL, 1, '192.168.203.15', NULL, NULL),
(10, 10, 'available', NULL, NULL, NULL, 1, '192.168.221.166', NULL, NULL),
(11, 11, 'available', NULL, NULL, NULL, 1, '192.168.202.110', NULL, NULL),
(12, 12, 'available', NULL, NULL, NULL, 1, '192.168.218.106', NULL, NULL),
(13, 13, 'available', NULL, NULL, NULL, 1, '192.168.212.19', NULL, NULL),
(14, 14, 'available', NULL, NULL, NULL, 1, '192.168.209.253', NULL, NULL),
(15, 15, 'available', NULL, NULL, NULL, 1, '192.168.221.182', NULL, NULL),
(16, 16, 'available', NULL, NULL, NULL, 1, '192.168.203.218', NULL, NULL),
(17, 17, 'available', NULL, NULL, NULL, 1, '', NULL, NULL),
(19, 19, 'available', NULL, NULL, NULL, 1, '', NULL, NULL),
(52, 20, 'available', NULL, NULL, NULL, 1, '', NULL, NULL),
(56, 18, 'available', NULL, NULL, NULL, 1, '', NULL, NULL),
(76, 2, 'available', NULL, NULL, NULL, 2, '192.168.196.147', NULL, NULL),
(77, 3, 'available', NULL, NULL, NULL, 2, '192.168.204.143', NULL, NULL),
(78, 4, 'available', NULL, NULL, NULL, 2, '192.168.204.247', NULL, NULL),
(79, 5, 'available', NULL, NULL, NULL, 2, '192.168.197.243', NULL, NULL),
(80, 6, 'available', NULL, NULL, NULL, 2, '192.168.199.117', NULL, NULL),
(81, 7, 'available', NULL, NULL, NULL, 2, '192.168.201.196', NULL, NULL),
(82, 8, 'available', NULL, NULL, NULL, 2, '192.168.198.105', NULL, NULL),
(83, 9, 'available', NULL, NULL, NULL, 2, '192.168.192.147', NULL, NULL),
(84, 10, 'available', NULL, NULL, NULL, 2, '192.168.195.147', NULL, NULL),
(85, 11, 'available', NULL, NULL, NULL, 2, '192.168.221.164', NULL, NULL),
(86, 12, 'available', NULL, NULL, NULL, 2, '192.168.208.121', NULL, NULL),
(87, 13, 'available', NULL, NULL, NULL, 2, '192.168.196.107', NULL, NULL),
(88, 14, 'available', NULL, NULL, NULL, 2, '192.168.196.148', NULL, NULL),
(89, 15, 'available', NULL, NULL, NULL, 2, '192.168.215.201', NULL, NULL),
(90, 16, 'available', NULL, NULL, NULL, 2, '192.168.209.160', NULL, NULL),
(91, 17, 'available', NULL, NULL, NULL, 2, '192.168.198.189', NULL, NULL),
(92, 18, 'available', NULL, NULL, NULL, 2, '192.168.210.197', NULL, NULL),
(93, 1, 'not available', NULL, NULL, NULL, 2, '192.168.123.45', NULL, '4'),
(94, 19, 'not available', NULL, NULL, NULL, 2, '192.168.123.45', NULL, '5'),
(95, 20, 'not available', NULL, NULL, NULL, 2, '192.168.123.45', NULL, '6');

-- --------------------------------------------------------

--
-- Table structure for table `clms_problems`
--

CREATE TABLE `clms_problems` (
  `id` int(11) NOT NULL,
  `laboratory_id` varchar(11) NOT NULL,
  `laboratory_name` varchar(50) NOT NULL,
  `pc_number` int(11) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `report_statement` varchar(255) NOT NULL,
  `reported_by` varchar(50) NOT NULL,
  `reported_date` varchar(50) NOT NULL,
  `fixed_date` varchar(50) DEFAULT NULL,
  `report_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clms_problems`
--

INSERT INTO `clms_problems` (`id`, `laboratory_id`, `laboratory_name`, `pc_number`, `pc_id`, `report_statement`, `reported_by`, `reported_date`, `fixed_date`, `report_status`) VALUES
(1, '1', 'Internet Laboratory', 6, 6, 'No internet connection', 'ICT Office', '2023-04-25 09:48:41', '2023-04-25 13:53:39', 'FIXED'),
(2, '1', 'Internet Laboratory', 6, 6, 'No internet connection', 'ICT Office', '2023-04-25 13:54:06', NULL, 'PENDING'),
(3, '1', 'Internet Laboratory', 3, 3, 'NO AVR', 'ICT Office', '2023-04-26 16:51:48', NULL, 'PENDING'),
(4, '2', 'CISCO Laboratory', 1, 93, 'No Display', 'Im User', '2023-04-27 14:01:16', NULL, 'PENDING'),
(5, '2', 'CISCO Laboratory', 19, 94, 'PC cannot open\n', 'Im User', '2023-04-27 14:01:50', NULL, 'PENDING'),
(6, '2', 'CISCO Laboratory', 20, 95, 'Blackscreen PC', 'Im User', '2023-04-27 14:01:57', NULL, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `clms_session`
--

CREATE TABLE `clms_session` (
  `session_id` int(11) NOT NULL,
  `session_code` varchar(20) NOT NULL,
  `laboratory_id` int(11) NOT NULL,
  `laboratory_name` varchar(100) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `faculty_name` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `session_date` varchar(50) NOT NULL,
  `session_status` varchar(50) NOT NULL,
  `end_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clms_session`
--

INSERT INTO `clms_session` (`session_id`, `session_code`, `laboratory_id`, `laboratory_name`, `user_id`, `faculty_name`, `subject`, `section`, `purpose`, `session_date`, `session_status`, `end_date`) VALUES
(1, 'IL-041723-Y653', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-17 10:48:26', 'Expired', '2023-04-18 07:51:23'),
(2, 'IL-041823-Z364', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-18 07:51:59', 'Expired', '2023-04-18 07:55:55'),
(3, 'IL-041823-R447', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-18 07:56:13', 'Expired', '2023-04-18 17:05:03'),
(4, 'IL-041923-47Q4', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-19 09:03:45', 'Expired', '2023-04-20 08:11:41'),
(5, 'IL-042023-19F5', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-20 08:11:52', 'Expired', '2023-04-24 08:41:03'),
(6, 'IL-042423-7L02', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-24 08:41:45', 'Expired', '2023-04-24 16:26:42'),
(7, 'IL-042423-7W27', 1, 'Internet Laboratory', '3', 'ICT Office', 'Computer Subject', 'IT-302', '', '2023-04-24 16:27:03', 'Expired', '2023-04-24 16:35:47'),
(8, 'IL-042423-98F0', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-24 16:52:18', 'Expired', '2023-04-25 07:57:02'),
(9, 'IL-042523-N686', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-25 08:53:31', 'Expired', '2023-04-25 18:20:18'),
(10, 'IL-042623-8B05', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-26 09:13:37', 'Expired', '2023-04-26 19:00:00'),
(11, 'IL-042723-E570', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-27 08:55:19', 'Expired', '2023-04-27 16:59:50'),
(14, 'CL-042723-Q555', 2, 'CISCO Laboratory', '2', 'Im User', '', '', 'Others', '2023-04-27 14:01:00', 'Expired', '2023-04-27 14:02:04'),
(15, 'IL-042823-4I62', 1, 'Internet Laboratory', '3', 'ICT Office', '', '', 'Studies', '2023-04-28 08:24:46', 'Active', NULL),
(16, 'IL-050223-M488', 1, 'Internet Laboratory', '2', 'JOHN DOE', 'Computer Subject', 'IT-302', '', '2023-05-02 17:17:39', 'Expired', '2023-05-02 17:46:46'),
(17, 'CL-071223-0948', 2, 'CISCO Laboratory', '2', 'JOHN DOE', '', '', '', '2023-07-12 10:29:03', 'Expired', '2023-07-12 10:29:07'),
(18, 'CL-071223-3187', 2, 'CISCO Laboratory', '2', 'JOHN DOE', '', '', '', '2023-07-12 10:29:09', 'Expired', '2023-07-12 10:29:13'),
(19, 'CL-071223-5844', 2, 'CISCO Laboratory', '2', 'JOHN DOE', '', '', '', '2023-07-12 10:29:17', 'Expired', '2023-07-12 10:29:20'),
(20, 'CL-071223-0255', 2, 'CISCO Laboratory', '2', 'JOHN DOE', '', '', '', '2023-07-12 10:29:22', 'Expired', '2023-07-12 10:29:25'),
(21, 'IL-082423-2102', 1, 'Internet Laboratory', '2', 'JOHN DOE', '', '', 'Studies', '2023-08-24 16:30:32', 'Expired', '2023-08-24 18:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `clms_user`
--

CREATE TABLE `clms_user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clms_user`
--

INSERT INTO `clms_user` (`user_id`, `fullname`, `username`, `password`, `user_role`) VALUES
(1, 'Master Admin', 'admin', '$2y$10$TDoJ39NPWFn2HspwwPFG8ujAvUd7mR2LGWSlFEHfB69tBHtn6yGX6', 'Admin'),
(2, 'JOHN DOE', 'user', '$2y$10$xzM0MxIqAj9LSMxXPnJ8gufoedRe1eyO0yaryX0T2QA54xQDvBEPy', 'User'),
(3, 'ICT Office', 'ictoffice', '$2y$10$BUG4PwQ.b7gAo3vpCho13u7v3yfYu5a.LknlVu5pHeNfGWHd6hw6i', 'User'),
(6, 'ERWIN DE CASTRO', 'edecastro', '$2y$10$7h0IOaFkJ68ViqQXuI9ll.JY.iVRkfEG10wT6wrctUU/q3g3SFCdq', 'User'),
(7, 'JOHNREY MANZANAL', 'jmanzanal', '$2y$10$Z4McYiKrxQl/f0kBOxoNDeUMnD7OInIONtLWxlgH6SoTg6BSQl51K', 'User'),
(8, 'DONNA GARCIA', 'dgarcia', '$2y$10$BHKVhdrwcdM0NxdlRkYW1OE8wqJ7URLyFuKSx3wf.Ow9IZB68jCbm', 'User'),
(9, 'MICHAEL RAMILO', 'mramilo', '$2y$10$1uaUNKcOD/NppqwBvzRT0.ED90HeIXWUjzZ/pwDudKI78mvbo.1zi', 'User'),
(10, 'MELVIN BABOL', 'mbabol', '$2y$10$1xZAus.qqduyJV4VflC73uyDSNxAb2dR8drwiB./R3LqXLv7NdwNq', 'User'),
(11, 'NOEL VIRREY', 'nvirrey', '$2y$10$wDC1wTGCCYBIOa9ufNpSqOue97m0L0TQTLdcPnAqbM3UqFETf/yHG', 'User'),
(12, 'EDDIE BUCAD', 'ebucad', '$2y$10$w6/NuJjYD6a77b9rW8obN.IJpL0.peGKcu78MhosRKerl/KB5CEEm', 'User'),
(13, 'HOMER CASTILLO', 'hcastillo', '$2y$10$uEx46S9ZOr2W.NihoHoBR.HcWv1ukRK.ild5EDrBQWu81KiJtP5vW', 'User'),
(14, 'MIGUEL ROSAL', 'mrosal', '$2y$10$2hoH.biIZGpKTZpmOfR1But9p/onVLlFhanfYVkJ8CTXqlD3Gw7pi', 'User'),
(15, 'JOSEPH RIZALDE CASTILLO', 'jrcastillo', '$2y$10$dNIKGEJG/UHIU.Ed0rrT9eNfcDIE5e5mczpJ7QslCXjJG0fmJUAf2', 'User'),
(16, 'MENARD CANOY', 'mcanoy', '$2y$10$OplDZakgoKMbduSu4/lB3ufe8bYkza5fDEHVM/u4udkNDPmONlpfu', 'User'),
(17, 'HILANIE NIEVA', 'hnieva', '$2y$10$RHXoPCjizPsrdwskIyMx3.3kZppd7Bn/W56upEscDm/mnnyGB8Sty', 'User'),
(18, 'VAL BISCOCHO', 'vbiscocho', '$2y$10$jsznHCF16nRgHEcqJoLUbOTPhiSU97gDaIFUHPf2YYkc40jamqLxC', 'User'),
(19, 'GLENN CARAIG', 'gcaraig', '$2y$10$RnVc2I/Q5CsEhzO23g9EDO238n3smenHfQI.5Uxa7Zw0O/zaNqovS', 'User'),
(20, 'CHRISTINA CARANDANG', 'ccarandang', '$2y$10$vVTAYxwqqUYwkUq1O9d65ePpRY5hHry/.RDNVQ4IClckBIC7Kfq8G', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clms_laboratories`
--
ALTER TABLE `clms_laboratories`
  ADD PRIMARY KEY (`laboratory_id`);

--
-- Indexes for table `clms_logs`
--
ALTER TABLE `clms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clms_pc`
--
ALTER TABLE `clms_pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clms_problems`
--
ALTER TABLE `clms_problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clms_session`
--
ALTER TABLE `clms_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `clms_user`
--
ALTER TABLE `clms_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clms_laboratories`
--
ALTER TABLE `clms_laboratories`
  MODIFY `laboratory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clms_logs`
--
ALTER TABLE `clms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `clms_pc`
--
ALTER TABLE `clms_pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `clms_problems`
--
ALTER TABLE `clms_problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clms_session`
--
ALTER TABLE `clms_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clms_user`
--
ALTER TABLE `clms_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
