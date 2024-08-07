-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: June 20, 2024 at 07:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(13, 'Atieno Jane', 'atis98@gmail.com', 'a48b5f8723a339c5a865e7b34e1194ee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `full_name`, `username`, `password`) VALUES
(18, 'Administator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `id` int(10) UNSIGNED NOT NULL,
  `car` varchar(150) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passengers` int(10) NOT NULL,
  `pickup` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `book_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`id`, `car`, `customer_name`, `contact`, `email`, `passengers`, `pickup`, `destination`, `book_date`, `total`, `status`) VALUES
(8, 'Subaru Impreza', 'kyle Big', 71234567, 'big@gmail.com', 1, 'JKIA', 'Langata', '2022-10-11 06:25:18', '15.00', 'Alighted'),
(9, 'Toyota Noah', 'mohan Abdi', 798654321, 'abdi@gmail.com', 2, 'JKIA', 'Roysambu', '2022-10-11 06:29:40', '30.00', 'Alighted'),
(10, 'Subaru Legacy', 'Nicholas Kiprop', 720602644, 'nicolas@gmail.com', 3, 'Jerusalem', 'Annex', '2022-10-11 08:48:21', '45.00', 'Alighted'),
(11, 'Toyota Wish 706T', 'ray', 87654433, 'ray@gmail.com', 1, 'jhjh', 'khjhj', '2021-12-17 06:34:23', '15.00', 'Cancelled'),
(12, 'Toyota Vitz', 'Kiptoo Ruto', 717892540, 'kip@gmail.com', 6, 'Kapsoya', 'lessos', '2022-12-28 11:28:23', '90.00', 'Alighted'),
(13, 'Bmw', 'Kipkosgei Koech', 723456789, 'hi@gmail.com', 1, 'eldoret poytechnic', 'eldoret cbd', '2022-12-28 11:32:55', '15.00', 'Alighted'),
(14, 'Isuzu Dmax', 'Mtu Imara', 745939751, 'rutocollins98@gmail.com', 1, 'Chepterwai', 'Kaiboi', '2023-02-13 03:36:02', '15.00', 'Boarded');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car`
--

CREATE TABLE `tbl_car` (
  `id` int(10) UNSIGNED NOT NULL,
  `tittle` varchar(150) NOT NULL,
  `passengers` decimal(10,0) NOT NULL,
  `details` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_car`
--

INSERT INTO `tbl_car` (`id`, `tittle`, `passengers`, `details`, `image_name`, `category_id`, `featured`, `active`) VALUES
(10, 'Isuzu Dmax', '1', 'Main Station', 'Car-7234.jpg', 0, 'Yes', 'Yes'),
(11, 'Toyota Noah', '6', 'Main Station', 'Car-1851.jpg', 0, 'Yes', 'Yes'),
(12, 'Toyota Vitz', '3', 'Main Station', 'Car-3108.jpg', 17, 'Yes', 'Yes'),
(13, 'Subaru Impreza', '5', 'Jomo Kenyatta Airport', 'Car-5147.jpg', 0, 'Yes', 'Yes'),
(14, 'Toyota Wish 706T', '5', 'Available within Eldoret CBD', 'Car-4300.JPG', 0, 'Yes', 'Yes'),
(15, 'Subaru Legacy', '5', 'Main Station', 'Car-504.jpg', 0, 'Yes', 'Yes'),
(16, 'Honda ', '5', 'Mainstation', 'Car-4058.jpg', 18, 'Yes', 'Yes'),
(17, 'Vanguard', '7', 'Eldoret Inter. Airport', 'Car-2189.jpg', 17, 'Yes', 'Yes'),
(18, 'Bmw', '3', 'Eldoret Polytechnic', 'Car-6017.jpg', 0, 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `tittle` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `tittle`, `image_name`, `featured`, `active`) VALUES
(15, 'Luggage Transport', 'service-771.jpg', 'Yes', 'No'),
(16, 'Tour Services', 'service-222.jpg', 'Yes', 'Yes'),
(17, 'Taxi Services', 'service-381.jpg', 'Yes', 'Yes'),
(18, 'Airport Pick-up', 'service-493.jpg', 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_car`
--
ALTER TABLE `tbl_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_car`
--
ALTER TABLE `tbl_car`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
