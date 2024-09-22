-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 03:44 PM
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
-- Database: `machines`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `oil` int(11) NOT NULL,
  `msch_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `date`, `oil`, `msch_id`) VALUES
(1, '2024-02-23', 1, 1),
(2, '2024-02-24', 3, 2),
(3, '2024-02-25', 3, 3),
(6, '2024-04-24', 4, 2),
(7, '2024-04-24', 2, 1),
(8, '2024-04-24', 8, 1),
(9, '2024-04-25', 2, 1),
(10, '2024-04-25', 2, 2),
(11, '2024-04-25', 3, 2),
(12, '2024-04-25', 9, 2),
(13, '2024-04-25', 10, 5),
(14, '2024-04-25', 12, 5),
(15, '2024-04-25', 18, 5),
(16, '2024-04-29', 20, 5),
(17, '2024-04-29', 30, 5),
(18, '2024-06-06', 35, 5),
(19, '2024-06-06', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine_info`
--

CREATE TABLE `machine_info` (
  `msch_id` int(255) NOT NULL,
  `msch_name` varchar(255) NOT NULL,
  `line_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machine_info`
--

INSERT INTO `machine_info` (`msch_id`, `msch_name`, `line_no`) VALUES
(1, 'kfplui', 'johndeer'),
(2, 'kfplu2', 'bullcage line'),
(3, 'kfplu3', 'crank case line'),
(4, 'kfplu4', 'mahindra h1 line'),
(5, 'kfplu5', 'block line');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_info`
--
ALTER TABLE `machine_info`
  ADD PRIMARY KEY (`msch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `machine_info`
--
ALTER TABLE `machine_info`
  MODIFY `msch_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
