-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 07:50 AM
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
  `nkey_ac_manager_id` int(10) NOT NULL,
  `ckey_ac_manager` varchar(50) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `cmobile_number` varchar(10) NOT NULL,
  `calt_mobile_number` int(10) NOT NULL,
  `cuser_type` varchar(50) NOT NULL,
  `cemail_id` varchar(50) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `cuser_name` varchar(50) NOT NULL,
  `cpassword` varchar(50) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `nid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employeemaster`
--

INSERT INTO `tbl_employeemaster` (`cengineer_name`, `ccity`, `cstate`, `ccountry`, `nkey_ac_manager_id`, `ckey_ac_manager`, `caddress`, `cmobile_number`, `calt_mobile_number`, `cuser_type`, `cemail_id`, `isAvailable`, `isActive`, `cuser_name`, `cpassword`, `dcreated_date`, `dupdated_date`, `nid`) VALUES
('A', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, 'null', 'Pyrotech Unit 2', '787654321', 65798989, '4', 'a@gmail', b'1', b'1', 'a@123', 'a@123', '2020-11-02 10:31:41', '2020-11-02 10:31:41', 86),
('B1', 'JAIPUR', 'RAJASTHAN', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', 65798989, '3', 'b1@gmail', b'1', b'1', 'b1@123', 'b1@123', '2020-11-02 10:35:56', '2020-11-02 10:35:56', 87),
('B2', 'JAIPUR', 'RAJASTHAN', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', 65798989, '3', 'a@gmail', b'1', b'1', 'b2@123', 'b2@123', '2020-11-02 10:35:56', '2020-11-02 10:35:56', 88),
('C1', 'JAIPUR', 'RAJASTHAN', 'INDIA', 87, 'B1', 'Pyrotech Unit 2', '787654321', 65798989, '3', 'c1@gmail', b'1', b'1', 'c1@123', 'c1@123', '2020-11-02 10:55:55', '2020-11-02 10:55:55', 92),
('C2', 'JAIPUR', 'RAJASTHAN', 'INDIA', 87, 'B1', 'Pyrotech Unit 2', '787654321', 65798989, '3', 'c1@gmail', b'1', b'1', 'c1@123', 'c1@123', '2020-11-02 10:55:55', '2020-11-02 10:55:55', 93),
('C3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', 65798989, '3', 'c3@gmail', b'1', b'1', 'c3@123', 'c3@123', '2020-11-02 10:55:55', '2020-11-02 10:55:55', 94),
('C4', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', 65798989, '3', 'c4@gmail', b'1', b'1', 'c4@123', 'c4@123', '2020-11-02 10:55:55', '2020-11-02 10:55:55', 95);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_segment`
--

CREATE TABLE `tbl_segment` (
  `nid` int(10) NOT NULL,
  `nsegment_id` int(10) NOT NULL,
  `csegment_name` varchar(50) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_segment`
--

INSERT INTO `tbl_segment` (`nid`, `nsegment_id`, `csegment_name`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`) VALUES
(1, 1, 'Segment A', b'1', b'1', '2020-10-31 11:46:14', '2020-10-31 11:46:14'),
(2, 2, 'Segment-B', b'1', b'1', '2020-10-31 16:42:50', '2020-10-31 16:42:50');

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
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_segment`
--
ALTER TABLE `tbl_segment`
  ADD PRIMARY KEY (`nid`);

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
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tbl_segment`
--
ALTER TABLE `tbl_segment`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
