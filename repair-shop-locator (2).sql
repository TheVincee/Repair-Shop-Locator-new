-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 06:15 PM
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
(31, 'asd', 'asdsad', '23123', 'ursa@gmail.com', 'asd', 'asdas', 'asd', '21:32:00', '2024-07-27', 'Pending'),
(32, 'asdsa', 'asd', '2132131', 'ursa@gmail.com', 'asd', 'asd', 'asd', '10:03:00', '2024-07-27', 'Pending'),
(33, 'asdsad', 'asd', '7878978', 'ursavince7@gmail.com', 'asdasd', 'asdsad', 'asdsad', '08:12:00', '2024-07-28', 'Pending'),
(34, 'asdss', 'asd', '21312', 'asdasd@gmail.com', 'asdasd', 'asdasd', 'asdsd', '08:33:00', '2024-07-28', 'Pending'),
(39, 'Vince', 'ursal', '123', 'asdas@gmail.com', 'asd', 'asd', 'sadad', '18:25:00', '2024-08-22', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(0, 'anoskong', 4, 'Repair Good ', 1724331304),
(0, 'anoskong', 4, 'Repair Good ', 1724331355),
(0, 'Kingkong', 4, 'hellow', 1724331960),
(0, 'Kingkong', 4, 'hellowas', 1724331967),
(0, 'asd', 4, 'asd', 1724332021),
(0, 'asd', 4, 'asd', 1724332117),
(0, 'asd', 4, 'asd', 1724332234),
(0, 'as', 5, 'as', 1724332330),
(0, '', 5, 'asd', 1724377560),
(0, 'retiza ', 5, 'asd', 1724377784),
(0, 'asd', 3, 'asd', 1724377894),
(0, 'asd', 2, 'asd', 1724379773),
(0, 'as', 4, 'as', 1724380637);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_tb`
--

CREATE TABLE `tasks_tb` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_pass`
--

CREATE TABLE `user_pass` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `confirm_password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_pass`
--

INSERT INTO `user_pass` (`id`, `email`, `password`, `usertype`, `confirm_password`, `name`) VALUES
(6, 'admin@gmail.com', 'admin123', 'admin', '', ''),
(7, 'user1@gmail.com', 'user1', 'user', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `email`, `password`, `address`, `address2`, `city`, `state`, `zip`, `profile_picture`) VALUES
(1, 'admin@yahoo.com', '$2y$10$N9QQvRm7.u.bcERtaviOO.9S/1Ths9h/YdLFTW1op1DEfWsdvszdG', 'dsfadsf', '', 'asd', 'K', '2222', 'uploads/IMG_20231130_152656_735.jpg'),
(2, 'admin@yahoo.com', '$2y$10$DaQG2z4I0Gnw8zTtlb5WY.bCF3r0y/b/4U878xPYGqfaO8eE4mxz.', 'dsfadsf', '', 'asd', 'K', '2222', 'uploads/IMG_20231130_152656_735.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tasks_tb`
--
ALTER TABLE `tasks_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `user_pass`
--
ALTER TABLE `user_pass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks_tb`
--
ALTER TABLE `tasks_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_pass`
--
ALTER TABLE `user_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks_tb`
--
ALTER TABLE `tasks_tb`
  ADD CONSTRAINT `tasks_tb_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
