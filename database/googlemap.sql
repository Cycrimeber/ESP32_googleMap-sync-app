-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 01:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `googlemap`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `ID` int(11) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `metallic` int(11) NOT NULL,
  `emf` int(11) NOT NULL,
  `Time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`ID`, `longitude`, `latitude`, `metallic`, `emf`, `Time`) VALUES
(1, 8.76299, 7.77529, 0, 0, '2024-04-21 13:06:38'),
(2, 8.76299, 7.77529, 0, 0, '2024-04-21 13:06:58'),
(3, 3.35494, 6.50578, 0, 0, '2024-04-21 13:23:15'),
(4, 9.21237, 12.4283, 0, 0, '2024-04-21 13:58:02'),
(5, 6.51801, 3.37732, 0, 0, '2024-04-21 14:01:21'),
(6, 3.38247, 6.51665, 0, 0, '2024-04-21 19:34:47'),
(7, 6.51665, 3.38247, 0, 0, '2024-04-21 19:36:19'),
(8, 4.06272, 7.40904, 0, 0, '2024-04-21 19:42:48'),
(9, -1.42139, 8.5019, 0, 0, '2024-04-21 20:04:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
