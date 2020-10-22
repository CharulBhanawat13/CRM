-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 02:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crp`
--
CREATE DATABASE IF NOT EXISTS `crp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crp`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

DROP TABLE IF EXISTS `tbl_cities`;
CREATE TABLE `tbl_cities` (
  `nid` int(11) NOT NULL,
  `cstate_name` varchar(255) NOT NULL,
  `cname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isActive` bit(1) DEFAULT b'1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`nid`, `cstate_name`, `cname`, `isActive`) VALUES
(1, 'RAJASTHAN', 'UDAIPUR', b'1'),
(2, 'GUJRAT', 'AHEMDABAD', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

DROP TABLE IF EXISTS `tbl_countries`;
CREATE TABLE `tbl_countries` (
  `nid` int(11) NOT NULL,
  `cname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`nid`, `cname`, `isActive`) VALUES
(1, 'INDIA', b'1'),
(2, 'PAKISTAN', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employeemaster`
--

DROP TABLE IF EXISTS `tbl_employeemaster`;
CREATE TABLE `tbl_employeemaster` (
  `cengineer_name` varchar(255) NOT NULL,
  `ccity` varchar(255) NOT NULL,
  `cstate` varchar(255) NOT NULL,
  `ccountry` varchar(255) NOT NULL,
  `ckey_ac_manager` varchar(255) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `cmobile_number` varchar(10) NOT NULL,
  `cemail_id` varchar(255) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `nengineer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employeemaster`
--

INSERT INTO `tbl_employeemaster` (`cengineer_name`, `ccity`, `cstate`, `ccountry`, `ckey_ac_manager`, `caddress`, `cmobile_number`, `cemail_id`, `isAvailable`, `isActive`, `dcreated_date`, `dupdated_date`, `nengineer_id`) VALUES
('abc', 'abc', 'abc', 'abc', 'abc', 'abc', 'abc', 'abc', b'1', b'1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 16),
('def', 'def', 'def', 'def', 'def', 'def', 'def', 'def', b'1', b'1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17),
('hello', '2', '1', '1', '12', 'sec-3', '212121212', 'hello@ymail.com', b'1', b'1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18),
('aaa', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 'Choose one', 'saaa', 'aaa', 'saaa', b'1', b'1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19),
('ssss', 'AHEMDABAD', 'GUJRAT', 'INDIA', 'strtolower(Peter)', 'dsvbgdf', '1111111111', 'dxbgv', b'1', b'1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 20),
('fd', 'AHEMDABAD', 'GUJRAT', 'INDIA', 'Peter', 'ed', 'sdf', 'zcv', b'1', b'1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

DROP TABLE IF EXISTS `tbl_states`;
CREATE TABLE `tbl_states` (
  `nid` int(11) NOT NULL,
  `ccountry_name` varchar(255) NOT NULL,
  `cname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isActive` bit(1) DEFAULT b'1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`nid`, `ccountry_name`, `cname`, `isActive`) VALUES
(1, 'INDIA', 'RAJASTHAN', b'1'),
(2, 'INDIA', 'GUJRAT', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  ADD PRIMARY KEY (`nengineer_id`);

--
-- Indexes for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD PRIMARY KEY (`nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  MODIFY `nengineer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_states`
--
ALTER TABLE `tbl_states`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
