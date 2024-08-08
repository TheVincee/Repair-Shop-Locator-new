-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 12:48 PM
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
-- Database: `repair-shop-locator`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(400) DEFAULT NULL,
  `lastname` varchar(400) DEFAULT NULL,
  `phoneNumber` varchar(400) DEFAULT NULL,
  `emailAddress` varchar(400) DEFAULT NULL,
  `carmake` varchar(400) DEFAULT NULL,
  `carmodel` varchar(400) DEFAULT NULL,
  `repairdetails` varchar(400) DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `Status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `firstname`, `lastname`, `phoneNumber`, `emailAddress`, `carmake`, `carmodel`, `repairdetails`, `appointment_time`, `appointment_date`, `Status`) VALUES
(30, 'Vincen', 'asdasd', '123123', 'asdas@gmail.com', 'asdsad', 'sdfsdf', 'asdsadasdsad', '21:30:00', '2024-07-27', 'Pending'),
(31, 'asd', 'asdsad', '23123', 'ursa@gmail.com', 'asd', 'asdas', 'asd', '21:32:00', '2024-07-27', 'Pending'),
(32, 'asdsa', 'asd', '2132131', 'ursa@gmail.com', 'asd', 'asd', 'asd', '10:03:00', '2024-07-27', 'Pending'),
(33, 'asdsad', 'asd', '7878978', 'ursavince7@gmail.com', 'asdasd', 'asdsad', 'asdsad', '08:12:00', '2024-07-28', 'Pending'),
(34, 'asdss', 'asd', '21312', 'asdasd@gmail.com', 'asdasd', 'asdasd', 'asdsd', '08:33:00', '2024-07-28', 'Pending'),
(35, 'asdasd', 'saddasd', '23123', 'ffff@gmail.com', 'ffff', 'ffff', 'fffff', '13:46:00', '2024-07-31', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'dragonking@gmail.com', '$2y$10$oi8wkUm602CJ/3Jwvt7q/eb073/xOoc5VPir6DcIb4CwzAbUrwBCS', '2024-08-08 06:01:28'),
(2, 'king@gmail.com', '$2y$10$rNeCeHJgEgKxo8JGZiYeyOtIT23/lEyg86PRIzs0u.lVZ.KROrvc.', '2024-08-08 10:42:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
