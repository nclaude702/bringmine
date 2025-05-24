-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 04:29 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bringmine`
--

-- --------------------------------------------------------

--
-- Table structure for table `lostfound`
--

CREATE TABLE `lostfound` (
  `id` int(10) NOT NULL,
  `lost_names` varchar(60) NOT NULL,
  `lost_phone` varchar(10) NOT NULL,
  `lost_district` varchar(25) NOT NULL,
  `lost_sector` varchar(40) NOT NULL,
  `lost_property_name` varchar(50) NOT NULL,
  `propert_number` varchar(40) NOT NULL,
  `found_names` varchar(60) NOT NULL,
  `found_phone` varchar(10) NOT NULL,
  `found_district` varchar(25) NOT NULL,
  `found_sector` varchar(40) NOT NULL,
  `found_propert_name` varchar(40) NOT NULL,
  `lost_found_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lostfound`
--

INSERT INTO `lostfound` (`id`, `lost_names`, `lost_phone`, `lost_district`, `lost_sector`, `lost_property_name`, `propert_number`, `found_names`, `found_phone`, `found_district`, `found_sector`, `found_propert_name`, `lost_found_status`) VALUES
(1, 'dw', 'w', 'd', '', '', '', '', '', '', '', '', ''),
(2, 'ndago', '1233', 'huye', 'ngoma', 'National Id', '11', 'kaka', '54656', 'kigali', 'cyuve', 'national Id', 'Found'),
(3, 'jean clau', '345345', 'huye', 'ngoma', 'National Id', '111', '', '', '', '', '', 'Searching'),
(4, 'jean clau', '345345', 'huye', 'ngoma', 'National Id', '5465', '', '', '', '', '', 'Searching'),
(5, 'dc', '34', 'huye', 'ngoma', 'Driving Licence', '4355', 'kamari', '35', 'huye', 'ngoma', 'national Id', 'Found'),
(6, 'kabanda', '478785', 'gisagara', 'save', 'National Id', '5555', '', '', '', '', '', 'Searching'),
(7, 'cxv', '544', 'fdgb', 'ngoma', 'Degree', '134', 'kigabo germain', '35565', 'nyamagabe', 'nkuri', 'Driving Licence', 'Found'),
(8, '', '', '', '', '', '34', 'ert', '34', 'sd', 'sd', 'national Id', 'Searching');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `names` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `profile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `names`, `username`, `password`, `e_mail`, `phone`, `profile`) VALUES
(1, 'ndayi', 'ndayi', '123', 'ndayi@gmail.com', '0784354413', ''),
(2, 'nda', 'nda', 'nda', 'nda@gmail.com', '0736971373', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lostfound`
--
ALTER TABLE `lostfound`
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
-- AUTO_INCREMENT for table `lostfound`
--
ALTER TABLE `lostfound`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
