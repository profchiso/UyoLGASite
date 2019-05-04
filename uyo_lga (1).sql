-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2018 at 05:27 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uyo_lga`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Serial_number` int(255) NOT NULL,
  `Admin_name` varchar(100) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Serial_number`, `Admin_name`, `Username`, `Password`) VALUES
(1, 'Okorie chinedu sunday', 'profchisot', '36009397pc');

-- --------------------------------------------------------

--
-- Table structure for table `indigene`
--

CREATE TABLE `indigene` (
  `Serial_number` bigint(255) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Othernames` varchar(100) NOT NULL,
  `Sex` varchar(8) NOT NULL,
  `Date_of_birth` varchar(20) NOT NULL,
  `Village` varchar(100) NOT NULL,
  `Clan` varchar(100) NOT NULL,
  `Ward` varchar(100) NOT NULL,
  `Unit_number` varchar(100) NOT NULL,
  `Residential_address` varchar(200) NOT NULL,
  `Current_address` varchar(200) NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `Email_address` varchar(200) NOT NULL,
  `Primary_school` varchar(200) NOT NULL,
  `Primary_Y_of_Graduation` varchar(40) NOT NULL,
  `Secondary_school` varchar(200) NOT NULL,
  `Secondary_Y_of_Graduation` varchar(20) NOT NULL,
  `Higher_institution` varchar(200) NOT NULL,
  `Higher_Y_of_Graduation` varchar(20) NOT NULL,
  `Specialization` varchar(100) NOT NULL,
  `Professional_body` varchar(200) NOT NULL,
  `Employment_status` varchar(50) NOT NULL,
  `Employee_name` varchar(200) NOT NULL,
  `Employee_address` varchar(200) NOT NULL,
  `Position` varchar(200) NOT NULL,
  `Position_year` varchar(40) NOT NULL,
  `Introduction` varchar(255) NOT NULL,
  `Passport` varchar(200) NOT NULL,
  `Agreement` varchar(20) NOT NULL,
  `Date_of Reg` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lga_cert_request`
--

CREATE TABLE `lga_cert_request` (
  `id` bigint(255) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `othernames` varchar(90) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `village` varchar(100) NOT NULL,
  `clan` varchar(128) NOT NULL,
  `ward` varchar(128) NOT NULL,
  `current_address` longtext NOT NULL,
  `email` varchar(200) NOT NULL,
  `village_head` varchar(100) NOT NULL,
  `village_head_phone_number` varchar(15) NOT NULL,
  `clan_head` varchar(100) NOT NULL,
  `clan_head_phone` varchar(15) NOT NULL,
  `identification` varchar(100) NOT NULL,
  `identification_number` varchar(100) NOT NULL,
  `tax_id_number` varchar(128) NOT NULL,
  `reason_for_request` varchar(1000) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `user_id` varchar(512) NOT NULL,
  `date_requested` varchar(128) NOT NULL,
  `password` varchar(200) NOT NULL,
  `verification_status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `date_uploaded` varchar(50) NOT NULL,
  `unique_hash` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lga_cert_request`
--

INSERT INTO `lga_cert_request` (`id`, `surname`, `othernames`, `gender`, `phone_number`, `village`, `clan`, `ward`, `current_address`, `email`, `village_head`, `village_head_phone_number`, `clan_head`, `clan_head_phone`, `identification`, `identification_number`, `tax_id_number`, `reason_for_request`, `passport`, `user_id`, `date_requested`, `password`, `verification_status`, `date_uploaded`, `unique_hash`) VALUES
(4, 'Inya', 'Enyinna', 'Male', '2343223333', 'ddd', 'dddee', 'dd', 'eee', 'enyinnai@brightspotcreative.com', 'Enyinna Inya', '2343223333', 'Enyinna Inya', '2343223333', 'National ID Card', '2222222222222', 'BSC', 'test 2', 'http://127.0.0.1/uyolga/img/passport_images/606ef7006edb8dc210d89f39368996ccd584cc98.jpg', '989b2f5673a2a7d9c87b5e05a690e51120296f4c', '2018-07-29 14:52:38', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'PENDING', '', '5245f5a8aa6309b950cebe2b995580220679c3fc');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Serial_number` bigint(255) NOT NULL,
  `Senders_name` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `Date_sent` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `Serial_number` bigint(255) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `News` varchar(255) NOT NULL,
  `Date_uploaded` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(512) NOT NULL,
  `payment_method` varchar(32) NOT NULL,
  `payment_status` varchar(32) NOT NULL,
  `payment_teller` varchar(1024) NOT NULL,
  `payment_date` varchar(128) NOT NULL,
  `amount_paid` int(64) NOT NULL,
  `payment_reference` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `payment_method`, `payment_status`, `payment_teller`, `payment_date`, `amount_paid`, `payment_reference`) VALUES
(11, '989b2f5673a2a7d9c87b5e05a690e51120296f4c', 'ONLINE', 'VERIFIED', '', '2018-07-29 16:13:47', 5000, '5245f5a8aa6309b950cebe2b995580220679c3fc');

-- --------------------------------------------------------

--
-- Table structure for table `request_verification`
--

CREATE TABLE `request_verification` (
  `Serial_number` bigint(255) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Othernames` varchar(90) NOT NULL,
  `Sex` varchar(8) NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `Village` varchar(100) NOT NULL,
  `Clan` varchar(100) NOT NULL,
  `Ward` varchar(100) NOT NULL,
  `Current_address` varchar(200) NOT NULL,
  `Email_address` varchar(200) NOT NULL,
  `Village_head` varchar(100) NOT NULL,
  `Village_head_phone` varchar(15) NOT NULL,
  `Clan_head` varchar(100) NOT NULL,
  `Clan_head_phone` varchar(15) NOT NULL,
  `Identification` varchar(100) NOT NULL,
  `Identification_number` varchar(100) NOT NULL,
  `Tax_id_number` varchar(100) NOT NULL,
  `Reason` varchar(1000) NOT NULL,
  `Passport` varchar(200) NOT NULL,
  `Payment_teller` varchar(200) NOT NULL,
  `Agreement` varchar(5) NOT NULL,
  `Date_of_request` varchar(70) NOT NULL,
  `Payment_status` varchar(20) NOT NULL,
  `Verification_status` varchar(20) NOT NULL,
  `Certificate` varchar(200) NOT NULL,
  `General_status` varchar(20) NOT NULL,
  `Date_uploaded` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_reg`
--

CREATE TABLE `training_reg` (
  `Serial_number` bigint(255) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Othernames` varchar(100) NOT NULL,
  `Sex` varchar(8) NOT NULL,
  `Date_of_birth` varchar(30) NOT NULL,
  `Residential_address` varchar(200) NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `Email_address` varchar(100) NOT NULL,
  `Level` varchar(50) NOT NULL,
  `Interest` varchar(100) NOT NULL,
  `Passport` varchar(200) NOT NULL,
  `Agreement` varchar(20) NOT NULL,
  `Date_of_reg` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Serial_number`,`Username`);

--
-- Indexes for table `indigene`
--
ALTER TABLE `indigene`
  ADD PRIMARY KEY (`Serial_number`,`Phone_number`,`Email_address`);

--
-- Indexes for table `lga_cert_request`
--
ALTER TABLE `lga_cert_request`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Serial_number`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Serial_number`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_reg`
--
ALTER TABLE `training_reg`
  ADD PRIMARY KEY (`Serial_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Serial_number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `indigene`
--
ALTER TABLE `indigene`
  MODIFY `Serial_number` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lga_cert_request`
--
ALTER TABLE `lga_cert_request`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `Serial_number` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `Serial_number` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `training_reg`
--
ALTER TABLE `training_reg`
  MODIFY `Serial_number` bigint(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
