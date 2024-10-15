-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2023 at 10:23 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

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
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `request_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `requested_blood_group` varchar(5) NOT NULL,
  `urgency` varchar(20) NOT NULL,
  `amount_required` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `user_id` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donation_date` date NOT NULL,
  `blood_units_donated` int(11) NOT NULL
) ;

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
  `blood_group` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `requested_date` date DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `vc_admin`
--

CREATE TABLE `vc_admin` (
  `admin_id` int(11) NOT NULL,
  `a_fullname` varchar(250) NOT NULL,
  `a_address` varchar(200) NOT NULL,
  `a_email` varchar(200) NOT NULL,
  `a_password` varchar(100) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `vc_appointment`
--

CREATE TABLE `vc_appointment` (
  `appo_id` int(11) NOT NULL,
  `appo_name` varchar(50) NOT NULL,
  `appo_email` varchar(50) NOT NULL,
  `appo_phone` varchar(10) NOT NULL,
  `appo_bloodtype` varchar(5) NOT NULL,
  `appo_date` date NOT NULL,
  `appo_time` time NOT NULL
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_blood_requests_recipients` (`email`),
  ADD KEY `fk_blood_requests_users` (`user_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD UNIQUE KEY `unique_recp_email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `vc_admin`
--
ALTER TABLE `vc_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `a_email` (`a_email`),
  ADD UNIQUE KEY `unique_a_email` (`a_email`);

--
-- Indexes for table `vc_appointment`
--
ALTER TABLE `vc_appointment`
  ADD PRIMARY KEY (`appo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vc_admin`
--
ALTER TABLE `vc_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vc_appointment`
--
ALTER TABLE `vc_appointment`
  MODIFY `appo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `fk_blood_requests_recipients` FOREIGN KEY (`email`) REFERENCES `recipient` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_blood_requests_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkuserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
