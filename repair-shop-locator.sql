-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 04:42 AM
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
(30, 'Vinceneil ', 'asdasd', '123123', 'asdas@gmail.com', 'asdsad', 'sdfsdf', 'asdsadasdsad', '21:30:00', '2024-07-27', 'Pending'),
(31, 'asd', 'asdsad', '23123', 'ursa@gmail.com', 'asd', 'asdas', 'asd', '21:32:00', '2024-07-27', 'Pending'),
(32, 'asdsa', 'asd', '2132131', 'ursa@gmail.com', 'asd', 'asd', 'asd', '10:03:00', '2024-07-27', 'Pending'),
(33, 'asdsad', 'asd', '7878978', 'ursavince7@gmail.com', 'asdasd', 'asdsad', 'asdsad', '08:12:00', '2024-07-28', 'Pending'),
(34, 'asd', 'asd', '21312', 'asdasd@gmail.com', 'asdasd', 'asdasd', 'asdsd', '08:33:00', '2024-07-28', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `mobile`, `email`, `location`, `password`) VALUES
(1, 'valeriefLOR', 'pATALINHUG', '09100380217', '09100380217', 'thevinceursal123@gmail.com', NULL, '$2y$10$Z/gFngelbeoWbH7Gfxh7i.BLI5dqMXvzivt3tA8kO4B6pvhStfgZO'),
(2, 'valeriefLOR', 'pATALINHUG', '09100380217', '', 'thevinceursal123@gmail.com', 'asdf', '$2y$10$WLpHsKgIdUZLzU.TNZSsQu6Dqd7rpJoTWM.Nk6UYCQXCJmM1zgkAy');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
