-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 07:51 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GETMAXIMUMID` (IN `tab_name` VARCHAR(64), IN `col_name` VARCHAR(64))  BEGIN
 SET @t1 =CONCAT('SELECT max(',col_name,') FROM ',tab_name );
 PREPARE stmt3 FROM @t1;
 EXECUTE stmt3;
 DEALLOCATE PREPARE stmt3;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calllist`
--

CREATE TABLE `tbl_calllist` (
  `nid` int(10) NOT NULL,
  `ncall_list_id` int(10) NOT NULL,
  `ddate` datetime NOT NULL,
  `cphone_number` varchar(10) NOT NULL,
  `cperson_name` varchar(50) NOT NULL,
  `corg_name` varchar(50) NOT NULL,
  `cpurpose` varchar(50) NOT NULL,
  `cbriefTalk` varchar(256) NOT NULL,
  `dnext_date` datetime NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_calllist`
--

INSERT INTO `tbl_calllist` (`nid`, `ncall_list_id`, `ddate`, `cphone_number`, `cperson_name`, `corg_name`, `cpurpose`, `cbriefTalk`, `dnext_date`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`) VALUES
(1, 1, '2020-11-10 12:12:17', '1234', 'Peter', 'A', 'Purpose', 'BriefTalk', '2020-11-10 12:12:17', b'1', b'1', '2020-11-10 12:12:17', '2020-11-10 12:12:17');

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
-- Table structure for table `tbl_contactperson`
--

CREATE TABLE `tbl_contactperson` (
  `nid` int(10) NOT NULL,
  `ncontact_person_id` int(10) NOT NULL,
  `cperson_name` varchar(50) NOT NULL,
  `ndept_id` int(10) NOT NULL,
  `cmobile_number` varchar(50) NOT NULL,
  `cphone_number` varchar(50) NOT NULL,
  `cemail_id` varchar(50) NOT NULL,
  `norg_id` int(10) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contactperson`
--

INSERT INTO `tbl_contactperson` (`nid`, `ncontact_person_id`, `cperson_name`, `ndept_id`, `cmobile_number`, `cphone_number`, `cemail_id`, `norg_id`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`) VALUES
(1, 1, 'C', 1, '2323232', '029423456', 'a@123', 3, b'1', b'1', '2020-11-09 12:39:59', '2020-11-09 17:51:13'),
(2, 2, 'B', 1, '234', '432', 'b@123', 2, b'1', b'1', '2020-11-09 17:11:07', '2020-11-09 17:11:07'),
(3, 3, 'A', 1, '345678', '234567', 'a@123', 2, b'1', b'1', '2020-11-09 17:52:18', '2020-11-09 17:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `nid` int(10) NOT NULL,
  `ndept_id` int(10) NOT NULL,
  `cdept_name` varchar(50) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`nid`, `ndept_id`, `cdept_name`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`) VALUES
(1, 1, 'CEMENT', b'1', b'1', '2020-11-10 11:05:07', '2020-11-10 11:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employeemaster`
--

CREATE TABLE `tbl_employeemaster` (
  `nemployee_unique_id` int(10) NOT NULL,
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

INSERT INTO `tbl_employeemaster` (`nemployee_unique_id`, `cengineer_name`, `ccity`, `cstate`, `ccountry`, `nkey_ac_manager_id`, `ckey_ac_manager`, `caddress`, `cmobile_number`, `calt_mobile_number`, `cuser_type`, `cemail_id`, `isAvailable`, `isActive`, `cuser_name`, `cpassword`, `dcreated_date`, `dupdated_date`, `nid`) VALUES
(86, 'A', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, 'null', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'a@gmail', b'1', b'1', 'a@123', 'a@123', '2020-11-02 10:31:41', '2020-11-02 10:31:41', 86),
(87, 'B1', 'BANG KHEN', 'BANGKOK', 'THAILAND', 86, 'A', 'Pyrotech Unit 2', '787654321', '65798989', '3', 'b1@gmail', b'1', b'1', 'b1@123', 'b1@123', '2020-11-02 10:35:56', '2020-11-05 14:49:40', 87),
(88, 'B2', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', '65798989', '3', 'b2@gmail', b'1', b'1', 'b2@123', 'b2@123', '2020-11-02 10:35:56', '2020-11-03 12:54:32', 88),
(98, 'C2', 'BANG KHEN', 'BANGKOK', 'THAILAND', 87, 'B1', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c2@gmail', b'1', b'1', 'c2@123', 'c2@123', '2020-11-02 17:35:55', '2020-11-07 12:35:41', 98),
(99, 'C3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c3@gmail', b'1', b'1', 'c3@123', 'c3@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 99),
(100, 'C4', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c4@gmail', b'1', b'1', 'c4@123', 'c4@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 100),
(103, 'D3_1', 'JAIPUR', 'RAJASTHAN', 'INDIA', 98, 'C2', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd3@gmail', b'1', b'1', 'd3@123', 'd3@123', '2020-11-02 17:41:34', '2020-11-05 10:17:04', 103),
(104, 'D4_1', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, 'C2', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd4@gmail', b'1', b'1', 'd4@123', 'd4@123', '2020-11-02 17:41:34', '2020-11-05 10:08:18', 104),
(105, 'D5_1', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, 'C3', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd5@gmail', b'1', b'1', 'd5@123', 'd5@123', '2020-11-02 17:41:34', '2020-11-05 09:59:49', 105),
(106, 'D6', 'AHEMDABAD', 'GUJRAT', 'INDIA', 114, 'C3', 'Pyrotech Unit 2', '787654321', '65798989', '1', 'd6@gmail', b'1', b'1', 'd6@123', 'd6@123', '2020-11-02 17:41:34', '2020-11-04 09:58:06', 106),
(126, 'D1', 'AHEMDABAD', 'GUJRAT', 'INDIA', 114, 'C1', 'D1', 'D1', 'D1', '1', 'D1', b'1', b'1', 'D1', 'D1', '2020-11-04 15:03:19', '0000-00-00 00:00:00', 126),
(127, 'E', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, '', 'E', 'E', 'E', '1', 'E', b'1', b'1', 'e@123', 'e@123', '2020-11-05 10:19:04', '0000-00-00 00:00:00', 127),
(128, 'F', 'JAIPUR', 'RAJASTHAN', 'INDIA', 100, 'C4', 'F', 'F', 'F', '1', 'F', b'1', b'1', 'F', 'F', '2020-11-05 10:40:41', '0000-00-00 00:00:00', 128),
(102, 'Dolar', 'JAIPUR', 'RAJASTHAN', 'INDIA', 103, 'D3_1', 'Dolar', 'Dolar', 'Dolar', '3', 'Dolar', b'1', b'1', 'Dolar', 'Dolar', '2020-11-07 12:43:38', '0000-00-00 00:00:00', 130);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organisation`
--

CREATE TABLE `tbl_organisation` (
  `nid` int(10) NOT NULL,
  `norg_id` int(10) NOT NULL,
  `corg_name` varchar(50) NOT NULL,
  `corg_address` varchar(50) NOT NULL,
  `corg_city` varchar(50) NOT NULL,
  `corg_state` varchar(50) NOT NULL,
  `corg_country` varchar(50) NOT NULL,
  `corg_mobileNumber` varchar(10) NOT NULL,
  `corg_emailId` varchar(50) NOT NULL,
  `norg_segment_id` int(10) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_organisation`
--

INSERT INTO `tbl_organisation` (`nid`, `norg_id`, `corg_name`, `corg_address`, `corg_city`, `corg_state`, `corg_country`, `corg_mobileNumber`, `corg_emailId`, `norg_segment_id`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`) VALUES
(1, 1, 'Organisation A', 'Pyrotech 12', 'UDAIPUR', 'RAJASTHAN', 'INDIA', '987654321', 'orgA@123', 1, b'1', b'1', '2020-11-05 11:40:01', '2020-11-05 16:05:35'),
(2, 2, 'Organisation B', 'Pyrotech Unit 3', 'UDAIPUR', 'RAJASTHAN', 'INDIA', '987654321', 'orgB@123', 2, b'1', b'1', '2020-11-05 11:40:01', '2020-11-05 17:46:00'),
(3, 3, 'Organisation c', 'Pyrotech Unit 3', 'UDAIPUR', 'RAJASTHAN', 'INDIA', '987654321', 'orgc@123', 2, b'1', b'1', '2020-11-05 11:40:01', '2020-11-05 17:46:00');

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
-- Indexes for table `tbl_contactperson`
--
ALTER TABLE `tbl_contactperson`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_organisation`
--
ALTER TABLE `tbl_organisation`
  ADD PRIMARY KEY (`nid`,`norg_id`);

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
-- AUTO_INCREMENT for table `tbl_contactperson`
--
ALTER TABLE `tbl_contactperson`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tbl_organisation`
--
ALTER TABLE `tbl_organisation`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_segment`
--
ALTER TABLE `tbl_segment`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
