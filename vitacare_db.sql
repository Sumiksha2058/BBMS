-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 04:38 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fullname` varchar(250) NOT NULL,
  `a_address` varchar(200) NOT NULL,
  `a_email` varchar(200) NOT NULL,
  `a_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `request_id` int(11) NOT NULL,
  `recp_email` varchar(100) DEFAULT NULL,
  `requested_blood_group` varchar(5) NOT NULL,
  `urgency` varchar(20) NOT NULL,
  `amount_required` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`request_id`, `recp_email`, `requested_blood_group`, `urgency`, `amount_required`, `message`, `request_date`, `approval_status`) VALUES
(1, 'kritik@gmail.com', 'A-', 'O+', 200, 'provide within 1 days', '2023-08-16 23:44:46', 'approved'),
(2, 'karishma@gmail.com', 'O+', 'O-', 200, 'provide within 3 week', '2023-08-17 03:29:11', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `donation_requests`
--

CREATE TABLE `donation_requests` (
  `donation_request_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `amount_to_donate` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_requests`
--

INSERT INTO `donation_requests` (`donation_request_id`, `email`, `amount_to_donate`, `request_date`, `approval_status`) VALUES
(6, 'ram@gmail.com', 200, '2023-08-17 07:17:11', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `d_id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gender` varchar(125) NOT NULL,
  `age` int(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` int(150) NOT NULL,
  `donorBlood` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`d_id`, `fullname`, `gender`, `age`, `email`, `contact`, `donorBlood`, `password`) VALUES
(1, 'ram', 'Male', 22, 'ram@gmail.com', 2147483647, 'A-', '1b7b4c38f626766bbdcfc895e2c514f6'),
(2, 'ghyanshyam', 'Male', 34, 'npsumiksha@gmail.com', 2147483647, 'O+', '3a9269fa853d374c70d09ee394a8386c');

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `recp_id` int(11) NOT NULL,
  `recp_fullname` varchar(250) NOT NULL,
  `recp_gender` varchar(200) NOT NULL,
  `recp_age` int(100) NOT NULL,
  `recp_email` varchar(200) NOT NULL,
  `recp_contact` varchar(200) NOT NULL,
  `recp_recp_reqblood` varchar(150) NOT NULL,
  `recp_medicalReport` varchar(250) DEFAULT NULL,
  `recp_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`recp_id`, `recp_fullname`, `recp_gender`, `recp_age`, `recp_email`, `recp_contact`, `recp_recp_reqblood`, `recp_medicalReport`, `recp_password`) VALUES
(1, 'abc', 'Male', 47, 'abc@gmail.com', '9876767627', 'B+', '', 'f4fc8a416f8be148db91d57412cc34a0'),
(2, 'bcd', 'Male', 22, 'bcd@gmail.com', '9876767622', 'O-', '', '5f76b5df6d1d0f278065de3fdb844d4e'),
(7, 'sarita', 'Female', 44, 'sarita@gmail.com', '9876767643', 'A+', '', '4d0b85200ccf43a692fdb2c6a8e417da'),
(9, 'ramisha', 'Female', 21, 'ramisha@gmail.com', '9876764743', 'O-', '', '93c6478b870e471867dc1d6f1caa1161'),
(10, 'rajesh shrestha', 'Male', 21, 'rajesh@gmail.com', '9846435446', 'O+', '', 'cabf031d5e3dc279f3856ac9a4fdde7d'),
(11, 'Kritik', 'Male', 33, 'kritik@gmail.com', '9876767644', 'A-', '', 'd39d2d6c1d3a66a442ee64b2b8dd6fc6'),
(12, 'karishma', 'Female', 22, 'karishma@gmail.com', '9876767622', 'O+', '', '802eb0b912e12b201338638df5e452fa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `a_email` (`a_email`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_blood_requests_recipients` (`recp_email`);

--
-- Indexes for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD PRIMARY KEY (`donation_request_id`),
  ADD KEY `fk_donor_email` (`email`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`recp_id`),
  ADD UNIQUE KEY `unique_recp_email` (`recp_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donation_requests`
--
ALTER TABLE `donation_requests`
  MODIFY `donation_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `d_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `recp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `fk_blood_requests_recipients` FOREIGN KEY (`recp_email`) REFERENCES `recipient` (`recp_email`) ON DELETE CASCADE;

--
-- Constraints for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD CONSTRAINT `fk_donor_email` FOREIGN KEY (`email`) REFERENCES `donor` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
