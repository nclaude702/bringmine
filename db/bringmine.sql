-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 04:41 AM
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
(1, 'rutikanga anicet', '0736971373', 'huye', 'tumba', 'National Id', '1199480033592374', '', '', '', '', '', 'Searching'),
(2, 'rukundo ange', '0782679199', 'ruhango', 'mbuye', 'Degree', '234312', 'ndikumana alex', '0736971373', 'gisagara', 'save', 'Driving Licence', 'Found'),
(3, '', '', '', '', '', '1200180023435623', 'kamanzi augustin', '0736971373', 'nyaruguru', 'nyabimata', 'national Id', 'Searching'),
(4, 'ndayambaje eric', '0736971373', 'burera', 'cyeru', 'National Id', '1199680041592208', '', '', '', '', '', 'Searching'),
(5, '', '', '', '', '', '14555', 'Kwihagana Emmy', '0736971373', 'karongi', 'bwishura', 'Degree', 'Searching'),
(6, 'kamana onesphole', '0782679199', 'ruhango', 'mbuye', 'Driving License', '15344', '', '', '', '', '', 'Searching');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `message` text NOT NULL,
  `r_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `username`, `message`, `r_date`) VALUES
(1, 'mukamana solina', 'well done', '0000-00-00'),
(2, 'mukamana solina', 'done 2', '2025-02-11'),
(3, 'mukamana solina', 'where are you to take yours', '2025-02-11'),
(4, 'IRANZI Theoneste', 'to you all', '2025-02-12'),
(5, 'IRANZI Theoneste', 'dfg', '2025-02-12');

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
  `type` varchar(25) NOT NULL DEFAULT 'user',
  `profile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `names`, `username`, `password`, `e_mail`, `phone`, `type`, `profile`) VALUES
(1, 'IRANZI Theoneste', 'iranzi', 'iranzi', 'iranzii@gmail.com', '0782679199', 'admin', 0x6173736574732f70726f66696c652f494d475f32303139303732305f3132333335385f362e6a7067),
(2, 'KAMANZI Ange', 'kamanzi', 'kamanzi', 'kamanzi@gmail.com', '0736971373', 'user', ''),
(3, 'mukamana solina', 'solina', 'solina', 'solina@gmail.com', '0782679199', 'user', 0x6173736574732f70726f66696c652f363761353761393936373738315f2b3235302037383320363934203030372032303139303631365f3232303431382e6a7067),
(4, 'jean mundende', 'jean', 'solina', 'jean@gmail.com', '0783339198', 'user', 0x6173736574732f70726f66696c652f363761353763633534633739375f494d475f32303137313130345f3134313230372e6a7067),
(5, 'kamanzi paul', 'paul', 'paul', 'paul@gmail.com', '0782679199', 'user', 0x6173736574732f70726f66696c652f494d475f32303138303533315f3038333934302e6a7067),
(6, 'BOBO KING', 'Bobo', 'Bobo@123', '', '', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lostfound`
--
ALTER TABLE `lostfound`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
