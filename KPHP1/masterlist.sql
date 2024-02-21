-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 05:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masterlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `ID` int(10) NOT NULL,
  `recID` int(10) NOT NULL,
  `block` int(10) NOT NULL,
  `lot` int(10) NOT NULL,
  `stat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`ID`, `recID`, `block`, `lot`, `stat`) VALUES
(48, 1, 1, 10, 1),
(49, 2, 2, 10, 1),
(50, 3, 3, 10, 1),
(51, 4, 4, 10, 1),
(52, 5, 5, 10, 1),
(53, 6, 6, 10, 1),
(54, 7, 7, 10, 1),
(55, 8, 8, 10, 1),
(56, 9, 9, 10, 1),
(57, 10, 10, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `status`) VALUES
(1, 'admin', 'admin', 0, 'k@gmail.com', '', 1),
(2, 'ken', 'ken', 1, 'kp@gmail.com', '09234235267', 1),
(3, 'kyle', 'kyle', 2, 'kyle.sanchez5@icloud.com', '43242342342', 1),
(7, 'Crispin', 'Crispin', 2, 'kyleangelosanchez2@gmail.com', '09759913641', 1),
(8, 'mic', 'mic', 3, 'kennethpantonilla98@gmail.com', '09465873215', 1);

-- --------------------------------------------------------

--
-- Table structure for table `homeowners`
--

CREATE TABLE `homeowners` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homeowners`
--

INSERT INTO `homeowners` (`ID`, `username`, `password`) VALUES
(34, 'kenneth', 'pantonilla'),
(35, 'jayrald', 'palmaria'),
(36, 'charlee', 'pantonilla'),
(37, 'kyle', 'sanchez'),
(38, 'alwyn', 'niones'),
(39, 'emmanuelle', 'salas'),
(40, 'marc', 'chelvin'),
(41, 'rollievert', 'gomez'),
(42, 'brian', 'bronosa'),
(43, 'james', 'astilla');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(11) NOT NULL,
  `Address` int(100) NOT NULL,
  `Month` varchar(225) NOT NULL,
  `Year` year(4) NOT NULL,
  `Amount` int(100) DEFAULT NULL,
  `Receipt` int(100) DEFAULT NULL,
  `CurrDate` date DEFAULT NULL,
  `stat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID`, `Address`, `Month`, `Year`, `Amount`, `Receipt`, `CurrDate`, `stat`) VALUES
(1421, 48, '10', '2023', 100, 321654987, '2023-10-19', 1),
(1422, 49, '10', '2023', 100, 32164897, '2023-10-19', 1),
(1423, 50, '10', '2023', 100, 321654987, '2023-10-19', 1),
(1424, 51, '10', '2023', 100, 321654987, '2023-10-19', 1),
(1425, 52, '10', '2023', 100, 321654987, '2023-10-19', 1),
(1426, 53, '10', '2023', 100, 321654987, '2023-10-19', 1),
(1427, 54, '10', '2023', 100, 32165987, '2023-10-19', 1),
(1428, 48, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1429, 49, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1430, 50, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1431, 51, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1432, 52, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1433, 53, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1434, 54, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1435, 48, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1436, 49, '12', '2023', 100, 103654897, '2023-10-19', 1),
(1437, 50, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1438, 51, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1439, 52, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1440, 53, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1441, 54, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1442, 55, '10', '2023', NULL, NULL, '2023-10-19', 0),
(1443, 56, '10', '2023', 100, 32156497, '2023-10-19', 1),
(1444, 57, '10', '2023', 100, 2147483647, '2023-10-19', 1),
(1445, 55, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1446, 56, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1447, 57, '11', '2023', NULL, NULL, '2023-10-19', 0),
(1448, 55, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1449, 56, '12', '2023', NULL, NULL, '2023-10-19', 0),
(1450, 57, '12', '2023', NULL, NULL, '2023-10-19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `stat` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`ID`, `Firstname`, `Lastname`, `email`, `stat`) VALUES
(1, 'kenneth', 'pantonilla', 'kennethpantonilla0@gmail.com', 1),
(2, 'jayrald', 'palmaria', 'kennethpantonilla0@gmail.com', 1),
(3, 'charlee', 'pantonilla', 'kennethpantonilla0@gmail.com', 1),
(4, 'kyle', 'sanchez', 'kennethpantonilla0@gmail.com', 1),
(5, 'alwyn', 'niones', 'kennethpantonilla0@gmail.com', 1),
(6, 'emmanuelle', 'salas', 'kennethpantonilla0@gmail.com', 1),
(7, 'marc', 'chelvin', 'kennethpantonilla0@gmail.com', 1),
(8, 'rollievert', 'gomez', 'kennethpantonilla0@gmail.com', 1),
(9, 'brian', 'bronosa', 'kennethpantonilla0@gmail.com', 1),
(10, 'james', 'astilla', 'kennethpantonilla0@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeowners`
--
ALTER TABLE `homeowners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `homeowners`
--
ALTER TABLE `homeowners`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1451;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
