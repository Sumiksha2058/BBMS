-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 10:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

--

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
(60, 'Ranjana C.', 'Female', 26, 'ranjana@gmail.com', 2147483647, 'O-', '27b5d00c23fbdd2265f3489156fcf7d6'),
(61, 'Ram kumar thapa', 'Male', 47, 'kumarram@gmail.com', 986763476, 'O+', '4641999a7679fcaef2df0e26d11e3c72'),
(62, 'suba lal khanal', 'Male', 57, 'suba@gmail.com', 2147483647, 'O-', '3538fc1dd47d3e92ac62dabd91d45aef'),
(63, 'suba lal khanal', 'Male', 57, 'suba@gmail.com', 2147483647, 'O-', '3538fc1dd47d3e92ac62dabd91d45aef'),
(64, 'susma maharjan', 'Female', 34, 'sushma@gmail.com', 2147483647, 'O+', 'e41e25979bc909c51157039ec1b2b2a3'),
(65, 'gorge', 'Male', 44, 'gorge@gmail.com', 986763476, 'A+', 'cd66114c342f26ddd0eddeff0742fcd9'),
(66, 'Saurav Timilsena', 'Female', 24, 'saurav@gmail.com', 2147483647, 'O+', 'b0051bc1f3d78e81eb3d169af478dc8e'),
(67, 'Sita', 'Female', 42, 'sita123@gmail.com', 2147483647, 'O+', '0b530d59ce9c47c4abc59ca7f261e8dd'),
(68, 'Sita', 'Female', 42, 'sita123@gmail.com', 2147483647, 'O+', '0b530d59ce9c47c4abc59ca7f261e8dd'),
(69, 'Sita', 'Female', 42, 'sita123@gmail.com', 2147483647, 'O+', '0b530d59ce9c47c4abc59ca7f261e8dd'),
(70, 'Sita', 'Female', 21, 'avds@gmail.com', 2147483647, 'A+', 'ad07706b97957ed5bc787cfb39d5befe'),
(71, 'Sarisha', 'Female', 21, 'sarisa@gmail.com', 2147483647, 'B-', '855af8fbd504e6f634331d18ef2636d2'),
(72, 'Sumiksha', 'Female', 21, 'npsumiksha@gmail.com', 2147483647, 'A+', '10575e56060aef9cff549590c3fff3ba'),
(73, 'Sita bk', 'Female', 22, 'sita123@gmail.com', 2147483647, 'O+', '9551cd08303499c0c191a7435d5520f1');

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
(3, 'bcd', 'Male', 22, 'bcd@gmail.com', '9876767622', 'O-', 'computer fundamental assignment.pdf', '5f76b5df6d1d0f278065de3fdb844d4e'),
(4, 'bcd', 'Male', 22, 'bcd@gmail.com', '9876767622', 'O-', 'computer fundamental assignment.pdf', '5f76b5df6d1d0f278065de3fdb844d4e'),
(5, 'bcd', 'Male', 22, 'bcd@gmail.com', '9876767622', 'O-', 'computer fundamental assignment.pdf', '5f76b5df6d1d0f278065de3fdb844d4e'),
(6, 'bcd', 'Male', 22, 'bcd@gmail.com', '9876767622', 'O-', 'computer fundamental assignment.pdf', '5f76b5df6d1d0f278065de3fdb844d4e'),
(7, 'sarita', 'Female', 44, 'sarita@gmail.com', '9876767643', 'A+', '', '4d0b85200ccf43a692fdb2c6a8e417da'),
(8, 'sarita', 'Female', 44, 'sarita@gmail.com', '9876767643', 'A+', '', '4d0b85200ccf43a692fdb2c6a8e417da'),
(9, 'ramisha', 'Female', 21, 'ramisha@gmail.com', '9876764743', 'O-', '', '93c6478b870e471867dc1d6f1caa1161'),
(10, 'rajesh shrestha', 'Male', 21, 'rajesh@gmail.com', '9846435446', 'O+', '', 'cabf031d5e3dc279f3856ac9a4fdde7d'),
(11, 'Kritik', 'Male', 33, 'kritik@gmail.com', '9876767644', 'A-', '', 'd39d2d6c1d3a66a442ee64b2b8dd6fc6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`recp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `d_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `recp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
