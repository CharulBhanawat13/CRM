-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 09:17 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_state_country`
--

CREATE TABLE `tbl_city_state_country` (
  `nid` int(11) NOT NULL,
  `ccity` varchar(25) NOT NULL,
  `cstate` varchar(25) NOT NULL,
  `ccountry` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city_state_country`
--

INSERT INTO `tbl_city_state_country` (`nid`, `ccity`, `cstate`, `ccountry`) VALUES
(1, 'UDAIPUR', 'RAJASTHAN', 'INDIA'),
(2, 'AHEMDABAD', 'GUJRAT', 'INDIA'),
(3, 'JAIPUR', 'RAJASTHAN', 'INDIA'),
(4, 'BANG KHEN', 'BANGKOK', 'THAILAND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employeemaster`
--

CREATE TABLE `tbl_employeemaster` (
  `cengineer_name` varchar(50) NOT NULL,
  `ccity` varchar(50) NOT NULL,
  `cstate` varchar(50) NOT NULL,
  `ccountry` varchar(50) NOT NULL,
  `ckey_ac_manager` varchar(50) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `cmobile_number` varchar(10) NOT NULL,
  `calt_mobile_number` int(10) NOT NULL,
  `cuser_type` varchar(50) NOT NULL,
  `cemail_id` varchar(50) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `nengineer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employeemaster`
--

INSERT INTO `tbl_employeemaster` (`cengineer_name`, `ccity`, `cstate`, `ccountry`, `ckey_ac_manager`, `caddress`, `cmobile_number`, `calt_mobile_number`, `cuser_type`, `cemail_id`, `isAvailable`, `isActive`, `dcreated_date`, `dupdated_date`, `nengineer_id`) VALUES
('Modi', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 'RAM NATH KOVIND', 'Delhi fort', '212121', 323232, '3', 'modi@123', b'1', b'1', '2020-10-22 12:44:50', '2020-10-22 12:44:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

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
-- Indexes for table `tbl_city_state_country`
--
ALTER TABLE `tbl_city_state_country`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  ADD PRIMARY KEY (`nengineer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_city_state_country`
--
ALTER TABLE `tbl_city_state_country`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  MODIFY `nengineer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
