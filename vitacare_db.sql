-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 06:52 AM
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
-- Database: `vitacare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_donor_table`
--

CREATE TABLE `active_donor_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `needed_time` time DEFAULT NULL,
  `request_status` enum('accept','reject','pending') DEFAULT 'pending',
  `recipient_name` varchar(255) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `active_donor_table`
--

INSERT INTO `active_donor_table` (`id`, `user_id`, `donor_name`, `contact_number`, `blood_group`, `message`, `created_at`, `needed_time`, `request_status`, `recipient_name`, `latitude`, `longitude`) VALUES
(1, 12, 'Test', '9818455889', 'A+', 'urgent blood needed', '2024-11-11 04:11:36', '09:48:00', 'accept', 'Sumiksha Neupane', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `request_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `requested_blood_group` varchar(5) NOT NULL,
  `message` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `blood_group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`request_id`, `email`, `requested_blood_group`, `message`, `created_at`, `approval_status`, `user_id`, `blood_group_id`) VALUES
(1, NULL, 'A+', 'Urgent! We are in need of A+ blood for a patient at local hospital who requires an immediate transfusion. If you or someone you know has this blood type, your support could make a life-saving difference. Please reach out as soon as possible. Thank yo', '2024-11-09 14:27:48', 'pending', 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` enum('donor','recipient') NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `blood_group` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `requested_date` date DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `blood_group_id` int(11) DEFAULT NULL,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 0,
  `deactivation_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `fullname`, `gender`, `age`, `email`, `contact`, `address`, `blood_group`, `password`, `approval_status`, `requested_date`, `latitude`, `longitude`, `blood_group_id`, `last_seen`, `status`, `deactivation_reason`) VALUES
(11, 'donor', 'Test', 'Female', 22, 'test@gmail.com', '9818455886', 'Nayabasti', 'A+', '$2y$10$PkKrOCeUGmUE62OK3jhDXeH.E9sZcWr6/2pD/UkhTPTv1nb3gYgce', 'pending', '2024-11-09', 27.63820000, 85.50510000, NULL, '2024-11-14 02:25:58', 1, NULL),
(12, 'recipient', 'Sumiksha Neupane', 'Female', 33, 'npsumiksha@gmail.com', '9818455889', '', 'A+', '$2y$10$yNSVxARAHph0aIvVSuTMO.1SMRkWIoVtaWVTu30Y.Xu0QVU4EvdQu', 'pending', '2024-11-09', NULL, NULL, NULL, '2024-11-11 08:41:50', 0, 'aCCOUMT NOT NEEDED'),
(13, 'recipient', 'Sumiksha Neupane', 'Female', 22, 'sumiksha@gmail.com', '9818455889', '', 'A+', '$2y$10$FUk29sNyLpoEgpkmOaRy7evtdAXRKP7VEzFbh1Hb2zNP1T9r7OXAC', 'pending', '2024-11-09', 27.97800000, 83.45920000, NULL, '2024-11-11 08:41:50', 0, NULL),
(14, 'donor', 'Furba Lama', 'Female', 21, 'furba@gmail.com', '9877465647', '', 'A-', '$2y$10$vQ5u7U.hGkeLcuvqLEtX/utlKpwt2ji8Q7CmldkRaAdS.oYeGFoPa', 'pending', '2024-11-11', 27.61670000, 85.54170000, NULL, '2024-11-11 09:31:36', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_donor_table`
--
ALTER TABLE `active_donor_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_blood_requests_recipients` (`email`),
  ADD KEY `fk_blood_requests_users` (`user_id`),
  ADD KEY `blood_group_id` (`blood_group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `blood_group_id` (`blood_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_donor_table`
--
ALTER TABLE `active_donor_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_ibfk_1` FOREIGN KEY (`blood_group_id`) REFERENCES `blood_groups` (`blood_group_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`blood_group_id`) REFERENCES `blood_groups` (`blood_group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
