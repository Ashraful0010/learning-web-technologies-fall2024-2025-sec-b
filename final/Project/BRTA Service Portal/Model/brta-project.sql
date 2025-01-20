-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 11:59 AM
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
-- Database: `brta-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_fees`
--

CREATE TABLE `application_fees` (
  `id` int(3) NOT NULL,
  `application_name` varchar(50) NOT NULL,
  `application_cost` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_fees`
--

INSERT INTO `application_fees` (`id`, `application_name`, `application_cost`) VALUES
(8, 'Driving License Application', 7500),
(9, 'Vehicle Registration', 25000),
(10, 'Road Permit Application', 5000),
(11, 'Tax Token Renewal', 4000),
(12, 'License Renewal', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `serial` int(3) NOT NULL,
  `news_title` varchar(50) NOT NULL,
  `news_content` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`serial`, `news_title`, `news_content`) VALUES
(7, 'BRTA Launches Online Driving License Application S', 'The Bangladesh Road Transport Authority (BRTA) has introduced an online service for driving license applications. Applicants can now apply, upload doc'),
(8, 'BRTA Organizes Road Safety Awareness Campaign', 'BRTA conducted a week-long road safety awareness campaign across major cities. The campaign emphasized safe driving practices, helmet use for bikers, '),
(9, 'Electronic Toll Collection System Introduced by BR', 'BRTA has launched an electronic toll collection (ETC) system at key toll plazas nationwide. The new system enables contactless toll payments, reducing'),
(10, 'check', 'checking news post');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `serial` int(2) NOT NULL,
  `rules` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`serial`, `rules`) VALUES
(1, 'Applicants must be at least 18 years old for a non-professional driving license and 20 years old for a professional driving license.'),
(3, 'All motor vehicles must be registered with BRTA before being driven on public roads.'),
(4, 'Driving without a valid license, not wearing a seatbelt, or using a mobile phone while driving may result in fines');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `phone` int(12) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `username`, `phone`, `dob`, `email`, `password`) VALUES
('Arman Hossen', 'Tipu', 'Arman0010', 1789920840, '1996-03-25', 'ai0632891@gmail.com', '$2y$10$/jjf6Li9hBxDaVpY25LNEOywZc74n6FxfV/o2cPPXj7DalZG65p6W'),
('Ashraful Islam', 'Opu', 'ggwp123', 1789920840, '2025-01-09', 'ai0632891@gmail.com', '$2y$10$EXn1R4QhzWBChl152sBjZeMfLHFHufqAwEEVqq7xJpmyf4R7M6lo6'),
('Ashraful Islam', 'Opu', 'Opu0010', 1969053978, '2002-02-08', 'ashrafulislam@gmail.com', '$2y$10$4blaxCspWD1l2Zx029nGM.wMziRI8ue/EhRXWI7pbgQvKhVwZcqHS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_fees`
--
ALTER TABLE `application_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_fees`
--
ALTER TABLE `application_fees`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `serial` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `serial` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
