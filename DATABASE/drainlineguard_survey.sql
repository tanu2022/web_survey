-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2022 at 10:27 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drainlineguard_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_tbl`
--

CREATE TABLE `address_tbl` (
  `id` int(11) NOT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location_drop_tbl`
--

CREATE TABLE `location_drop_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_drop_tbl`
--

CREATE TABLE `material_drop_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_tbl`
--

CREATE TABLE `survey_tbl` (
  `id` int(11) NOT NULL,
  `resident_f_name` varchar(150) DEFAULT NULL,
  `resident_l_name` varchar(150) DEFAULT NULL,
  `resident_address` text DEFAULT NULL,
  `location_of_meter` varchar(150) DEFAULT NULL,
  `size_of_service` decimal(10,2) DEFAULT NULL,
  `material_of_service` varchar(150) DEFAULT NULL,
  `date_constructed` date DEFAULT NULL,
  `photo_upstream_meter` text DEFAULT NULL,
  `photo_meter` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(150) DEFAULT NULL,
  `l_name` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_tbl`
--
ALTER TABLE `address_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_drop_tbl`
--
ALTER TABLE `location_drop_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_drop_tbl`
--
ALTER TABLE `material_drop_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_tbl`
--
ALTER TABLE `survey_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_tbl`
--
ALTER TABLE `address_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_drop_tbl`
--
ALTER TABLE `location_drop_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_drop_tbl`
--
ALTER TABLE `material_drop_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_tbl`
--
ALTER TABLE `survey_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
