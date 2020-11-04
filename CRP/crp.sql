-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 11:01 AM
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
  `calt_mobile_number` varchar(10) NOT NULL,
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
('A', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, 'null', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'a@gmail', b'1', b'1', 'a@123', 'a@123', '2020-11-02 10:31:41', '2020-11-02 10:31:41', 86),
('B1', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', '65798989', '3', 'b1@gmail', b'1', b'1', 'b1@123', 'b1@123', '2020-11-02 10:35:56', '2020-11-04 10:25:59', 87),
('B2', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', '65798989', '3', 'b2@gmail', b'1', b'1', 'b2@123', 'b2@123', '2020-11-02 10:35:56', '2020-11-03 12:54:32', 88),
('C2', 'JAIPUR', 'RAJASTHAN', 'INDIA', 87, 'B1', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c2@gmail', b'1', b'1', 'c2@123', 'c2@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 98),
('C3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c3@gmail', b'1', b'1', 'c3@123', 'c3@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 99),
('C4', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c4@gmail', b'1', b'1', 'c4@123', 'c4@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 100),
('D3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 98, 'C2', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd3@gmail', b'1', b'1', 'd3@123', 'd3@123', '2020-11-02 17:41:34', '2020-11-02 17:41:34', 103),
('D4', 'JAIPUR', 'RAJASTHAN', 'INDIA', 98, 'C2', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd4@gmail', b'1', b'1', 'd4@123', 'd4@123', '2020-11-02 17:41:34', '2020-11-02 17:41:34', 104),
('D5', 'JAIPUR', 'RAJASTHAN', 'INDIA', 99, 'C3', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd5@gmail', b'1', b'1', 'd5@123', 'd5@123', '2020-11-02 17:41:34', '2020-11-02 17:41:34', 105),
('D6', 'AHEMDABAD', 'GUJRAT', 'INDIA', 114, 'C3', 'Pyrotech Unit 2', '787654321', '65798989', '1', 'd6@gmail', b'1', b'1', 'd6@123', 'd6@123', '2020-11-02 17:41:34', '2020-11-04 09:58:06', 106),
('D7', 'JAIPUR', 'RAJASTHAN', 'INDIA', 100, 'C4', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd7@gmail', b'1', b'1', 'd7@123', 'd7@123', '2020-11-02 17:41:35', '2020-11-02 17:41:35', 107),
('D8', 'JAIPUR', 'RAJASTHAN', 'INDIA', 100, 'C4', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd8@gmail', b'1', b'1', 'd8@123', 'd8@123', '2020-11-02 17:41:35', '2020-11-02 17:41:35', 108),
('C1', 'BANG KHEN', 'BANGKOK', 'THAILAND', 0, 'B1', 'c1', 'c1', 'mobile', '2', 'c1', b'1', b'1', 'c1@123', 'c1@123', '2020-11-03 14:33:40', '2020-11-04 15:02:34', 114),
('D1', 'AHEMDABAD', 'GUJRAT', 'INDIA', 114, 'C1', 'D1', 'D1', 'D1', '1', 'D1', b'1', b'1', 'D1', 'D1', '2020-11-04 15:03:19', '0000-00-00 00:00:00', 126);

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
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `tbl_segment`
--
ALTER TABLE `tbl_segment`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
