-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2020 at 07:38 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `GETMAXIMUM` (IN `tab_name` VARCHAR(64), IN `col_name` VARCHAR(64), OUT `total` INT)  BEGIN
 SET @c2 = '';
 SET @t1 =CONCAT('SELECT max(',col_name,') INTO @c2 FROM ',tab_name );
 PREPARE stmt3 FROM @t1;
 EXECUTE stmt3;
 DEALLOCATE PREPARE stmt3;
 SET total=@c2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GETMAXIMUMID` (IN `tab_name` VARCHAR(64), IN `col_name` VARCHAR(64))  BEGIN
 SET @t1 =CONCAT('SELECT max(',col_name,') FROM ',tab_name);
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
  `ddate` date NOT NULL,
  `cphoneNumber` varchar(50) NOT NULL,
  `nperson_id` int(10) NOT NULL,
  `norg_id` int(10) NOT NULL,
  `npurpose_id` int(10) NOT NULL,
  `tbriefTalk` text NOT NULL,
  `dnext_date` date NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL,
  `nlogged_in_user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_calllist`
--

INSERT INTO `tbl_calllist` (`nid`, `ncall_list_id`, `ddate`, `cphoneNumber`, `nperson_id`, `norg_id`, `npurpose_id`, `tbriefTalk`, `dnext_date`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`, `ninternal_id`, `nlogged_in_user_id`) VALUES
(10, 1, '2020-12-03', '879789', 1, 1, 1, 'first Entry', '2021-01-09', b'1', b'1', '2020-12-03 13:38:45', '2020-12-03 13:38:45', 1, 4),
(11, 2, '2020-12-03', '89879789', 1, 1, 2, 'date format', '2020-12-03', b'1', b'1', '2020-12-03 14:48:37', '2020-12-03 14:48:37', 2, 1),
(12, 977234, '2020-12-08', '9352527680', 977234, 977234, 1, 'Discuss about dalmia cement regarding order of 40L', '2020-12-09', b'1', b'1', '2020-12-05 09:52:42', '2020-12-05 09:52:42', 3, 1),
(13, 967822, '2020-12-05', '91', 967822, 1, 1, 'hello', '2020-12-05', b'1', b'1', '2020-12-05 10:10:54', '2020-12-05 10:10:54', 4, 4802);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_state_country`
--

CREATE TABLE `tbl_city_state_country` (
  `nid` int(11) NOT NULL,
  `ccity` varchar(25) NOT NULL,
  `cstate` varchar(25) NOT NULL,
  `ccountry` varchar(25) NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city_state_country`
--

INSERT INTO `tbl_city_state_country` (`nid`, `ccity`, `cstate`, `ccountry`, `ninternal_id`) VALUES
(1, 'UDAIPUR', 'RAJASTHAN', 'INDIA', NULL),
(2, 'AHEMDABAD', 'GUJRAT', 'INDIA', NULL),
(3, 'JAIPUR', 'RAJASTHAN', 'INDIA', NULL),
(4, 'BANG KHEN', 'BANGKOK', 'THAILAND', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactperson`
--

CREATE TABLE `tbl_contactperson` (
  `nid` int(10) NOT NULL,
  `ncontact_person_id` int(10) NOT NULL,
  `nlogged_in_user_id` int(10) NOT NULL,
  `cperson_name` varchar(50) NOT NULL,
  `ndept_id` int(10) NOT NULL,
  `cmobile_number` varchar(50) NOT NULL,
  `cphone_number` varchar(50) NOT NULL,
  `cemail_id` varchar(50) NOT NULL,
  `norg_id` int(10) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contactperson`
--

INSERT INTO `tbl_contactperson` (`nid`, `ncontact_person_id`, `nlogged_in_user_id`, `cperson_name`, `ndept_id`, `cmobile_number`, `cphone_number`, `cemail_id`, `norg_id`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`, `ninternal_id`) VALUES
(6, 1, 1, 'PersonName A', 1, '09809780978', '0809780987', 'pna@123', 3, b'1', b'1', '2020-12-03 12:53:55', '2020-12-03 12:53:55', 1),
(7, 2, 4, 'CP A', 1, '870989890', '8797897679', 'cpa@123', 1, b'1', b'1', '2020-12-03 13:36:25', '2020-12-03 13:36:25', 2),
(8, 977234, 1, 'Anand krishna', 1, '9352527680', '9352527680', 'anandk18@gmail.com', 977234, b'1', b'1', '2020-12-05 09:51:42', '2020-12-05 09:51:42', 3),
(9, 967822, 1, 'Mr Chandresh Chauhan', 1, '8755603838', '91', 'chandresh.chauhan@airliquide.com', 1, b'1', b'1', '2020-12-05 09:57:25', '2020-12-05 09:57:25', 4);

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
  `dupdated_date` datetime NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`nid`, `ndept_id`, `cdept_name`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`, `ninternal_id`) VALUES
(1, 1, 'CEMENT', b'1', b'1', '2020-11-10 11:05:07', '2020-11-10 11:05:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_division`
--

CREATE TABLE `tbl_division` (
  `nid` int(10) NOT NULL,
  `ninternal_id` int(10) NOT NULL,
  `ndivision_id` int(10) NOT NULL,
  `cdivision_name` char(50) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_division`
--

INSERT INTO `tbl_division` (`nid`, `ninternal_id`, `ndivision_id`, `cdivision_name`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`) VALUES
(1, 1, 1, 'LIGHTING', b'1', b'1', '2020-12-08 10:40:31', '2020-12-08 10:40:31'),
(2, 2, 2, 'DRIVER', b'1', b'1', '2020-12-08 10:40:31', '2020-12-08 10:40:31'),
(3, 3, 3, 'PEPL', b'1', b'1', '2020-12-08 10:40:31', '2020-12-08 10:40:31');

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
  `ndivision_id` int(10) NOT NULL,
  `cemail_id` varchar(50) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `cuser_name` varchar(50) NOT NULL,
  `cpassword` varchar(50) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `nid` int(11) NOT NULL,
  `ninternal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employeemaster`
--

INSERT INTO `tbl_employeemaster` (`nemployee_unique_id`, `cengineer_name`, `ccity`, `cstate`, `ccountry`, `nkey_ac_manager_id`, `ckey_ac_manager`, `caddress`, `cmobile_number`, `calt_mobile_number`, `cuser_type`, `ndivision_id`, `cemail_id`, `isAvailable`, `isActive`, `cuser_name`, `cpassword`, `dcreated_date`, `dupdated_date`, `nid`, `ninternal_id`) VALUES
(1, 'Admin', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 0, 'null', 'Pyrotech Unit 1', '987654321', '9876543210', '4', 2, 'a@123', b'1', b'1', 'a@123', 'a@123', '2020-12-03 12:25:46', '2020-12-03 12:25:46', 1, 1),
(2, 'B1', 'BANG KHEN', 'BANGKOK', 'THAILAND', 1, 'Admin', 'PU1', '987987987', '987987987', '3', 1, 'b1@123', b'1', b'1', 'b1@123', 'b1@123', '2020-12-03 12:34:17', '0000-00-00 00:00:00', 139, 2),
(3, 'B2', 'JAIPUR', 'RAJASTHAN', 'INDIA', 1, 'Admin', 'PU2', '34343434', '545454545', '3', 3, 'b2@123', b'1', b'1', 'b2@123', 'b2@123', '2020-12-03 12:35:57', '0000-00-00 00:00:00', 140, 3),
(4, 'C!', 'JAIPUR', 'RAJASTHAN', 'INDIA', 2, 'B1', 'PU!1', '8796979879', '8796979879', '2', 2, 'c1@123', b'1', b'1', 'c1@123', 'c1@123', '2020-12-03 12:44:53', '0000-00-00 00:00:00', 142, 4),
(5, 'C2', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 2, 'B1', 'PU2', '9789698', '6798798', '2', 1, 'c2@123', b'1', b'1', 'c2@123', 'c2@123', '2020-12-03 12:46:58', '0000-00-00 00:00:00', 143, 5),
(6, 'C3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 3, 'B2', 'PU3', '980707099', '7807809780', '2', 3, 'c3@123', b'1', b'1', 'c3@123', 'c3@123', '2020-12-03 12:47:42', '0000-00-00 00:00:00', 144, 6),
(7, 'C4', 'AHEMDABAD', 'GUJRAT', 'INDIA', 3, 'B2', 'PU4', '8709798', '780780', '2', 2, 'c4@123', b'1', b'1', 'c4@123', 'c4@123', '2020-12-03 12:48:38', '0000-00-00 00:00:00', 145, 7),
(8, 'D1', 'AHEMDABAD', 'GUJRAT', 'INDIA', 4, 'C!', 'PU1', '7978978', '780890809', '1', 1, 'd1@123', b'1', b'1', 'd1@123', 'd1@123', '2020-12-03 12:49:30', '2020-12-03 12:49:44', 146, 8),
(4806, 'Vishnu', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 1, 'Admin', '123. Kanpur , Udaipur ', '9024859461', '9352513959', '3', 3, 'vprajapat@pyrotechlighting.com', b'1', b'1', 'vishnu', 'vishnu', '2020-12-03 14:21:59', '0000-00-00 00:00:00', 147, 9),
(4871, 'Anand Sinha', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 5, 'C2', 'Udaipur', '8107807072', '9352527680', '1', 2, 'southpyrotech@gmail.com', b'1', b'1', 'anand810', '8107807072', '2020-12-05 09:48:37', '0000-00-00 00:00:00', 148, 10),
(4802, 'Pradeep Paliwal', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 1, 'Admin', 'Panchwati Mohalla, Tehsil Road, Mavli', '8766036863', '9829114202', '4', 1, 'peplgujarat4@gmail.com', b'1', b'1', 'PP@123', 'PP@123', '2020-12-05 09:50:41', '0000-00-00 00:00:00', 149, 11),
(123, '123user', 'AHEMDABAD', 'GUJRAT', 'INDIA', 1, 'Admin', 'pu2', '6587568', '678678', '3', 1, '123@123', b'1', b'1', '123@123', '123@123', '2020-12-08 12:02:12', '2020-12-08 12:05:55', 153, 12);

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
  `dupdated_date` datetime NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_organisation`
--

INSERT INTO `tbl_organisation` (`nid`, `norg_id`, `corg_name`, `corg_address`, `corg_city`, `corg_state`, `corg_country`, `corg_mobileNumber`, `corg_emailId`, `norg_segment_id`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`, `ninternal_id`) VALUES
(8, 1, 'Organisation A', 'Pyrtotech A', 'AHEMDABAD', 'GUJRAT', 'INDIA', '780808709', '78978987', 1, b'1', b'1', '2020-12-03 12:58:32', '2020-12-03 12:58:32', 1),
(9, 977234, 'Siri Power System', 'chennai radhakrishna nagar ', 'BANG KHEN', 'BANGKOK', 'THAILAND', '9352527680', 'anandk18@gmail.com', 1, b'1', b'1', '2020-12-05 09:50:56', '2020-12-05 09:50:56', 2),
(10, 967822, 'AIR LIQUIDE INDIA HOLDING PVT LTD', '38/1, G.I.D.C. Industrial Estate, Jhagadia - 39311', 'AHEMDABAD', 'GUJRAT', 'INDIA', '8755603838', 'chandresh.chauhan@airliquide.com', 1, b'1', b'1', '2020-12-05 09:56:08', '2020-12-05 09:56:08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purpose`
--

CREATE TABLE `tbl_purpose` (
  `nid` int(10) NOT NULL,
  `npurpose_id` int(10) NOT NULL,
  `cpurpose_name` varchar(50) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purpose`
--

INSERT INTO `tbl_purpose` (`nid`, `npurpose_id`, `cpurpose_name`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`, `ninternal_id`) VALUES
(1, 1, 'Offer', b'1', b'1', '2020-11-12 04:12:09', '0000-00-00 00:00:00', NULL),
(2, 2, 'TEnder', b'1', b'1', '2020-11-12 04:12:09', '2020-11-12 11:54:42', NULL);

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
  `dupdated_date` datetime NOT NULL,
  `ninternal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_segment`
--

INSERT INTO `tbl_segment` (`nid`, `nsegment_id`, `csegment_name`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`, `ninternal_id`) VALUES
(1, 1, 'Segment A', b'1', b'1', '2020-10-31 11:46:14', '2020-10-31 11:46:14', NULL),
(2, 2, 'Segment-B', b'1', b'1', '2020-10-31 16:42:50', '2020-10-31 16:42:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `nid` int(11) NOT NULL,
  `ninternal_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`nid`, `ninternal_id`, `test_id`) VALUES
(15, 0, 12),
(16, 1, 66),
(17, 2, 99);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tour`
--

CREATE TABLE `tbl_tour` (
  `nid` int(10) NOT NULL,
  `ninternal_id` int(10) NOT NULL,
  `ntour_id` int(10) NOT NULL,
  `nlogged_in_user_id` int(10) NOT NULL,
  `ddate` date NOT NULL,
  `norg_id` int(10) NOT NULL,
  `nperson_to_meet_id` int(10) NOT NULL,
  `npurpose_id` int(10) NOT NULL,
  `tbriefTalk` text NOT NULL,
  `dnext_date` date NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tour`
--

INSERT INTO `tbl_tour` (`nid`, `ninternal_id`, `ntour_id`, `nlogged_in_user_id`, `ddate`, `norg_id`, `nperson_to_meet_id`, `npurpose_id`, `tbriefTalk`, `dnext_date`, `isAvailable`, `isActive`, `dcreated_date`, `dupdated_date`) VALUES
(3, 1, 1, 1, '2020-12-03', 1, 2, 1, 'first entry', '2020-12-04', b'1', b'1', '2020-12-03 14:51:52', '2020-12-03 14:51:52'),
(4, 2, 977234, 1, '2020-12-09', 977234, 977234, 1, 'dalmia offrer discussion', '2020-12-09', b'1', b'1', '2020-12-05 09:53:58', '2020-12-05 09:53:58'),
(5, 3, 4802, 4802, '2020-12-07', 1, 967822, 1, 'Hello', '2020-12-07', b'1', b'1', '2020-12-05 10:12:24', '2020-12-05 10:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitplan`
--

CREATE TABLE `tbl_visitplan` (
  `nid` int(10) NOT NULL,
  `ninternal_id` int(10) NOT NULL,
  `nvisit_plan_id` int(10) NOT NULL,
  `nlogged_in_user_id` int(10) NOT NULL,
  `ddate` date NOT NULL,
  `norg_id` int(10) NOT NULL,
  `ccity` varchar(50) NOT NULL,
  `nperson_to_meet_id` int(10) NOT NULL,
  `npurpose_id` int(10) NOT NULL,
  `tbriefTalk` text NOT NULL,
  `dnext_date` date NOT NULL,
  `isAvailable` bit(1) NOT NULL,
  `isActive` bit(1) NOT NULL,
  `dcreated_date` datetime NOT NULL,
  `dupdated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_visitplan`
--

INSERT INTO `tbl_visitplan` (`nid`, `ninternal_id`, `nvisit_plan_id`, `nlogged_in_user_id`, `ddate`, `norg_id`, `ccity`, `nperson_to_meet_id`, `npurpose_id`, `tbriefTalk`, `dnext_date`, `isAvailable`, `isActive`, `dcreated_date`, `dupdated_date`) VALUES
(10, 1, 1, 4, '2020-12-02', 1, 'JAIPUR', 2, 1, 'first entry', '2020-12-04', b'1', b'1', '2020-12-03 13:39:31', '2020-12-03 13:39:31'),
(11, 2, 977234, 1, '2020-12-09', 977234, 'chennai', 977234, 1, 'Dalmai', '2020-12-09', b'1', b'1', '2020-12-05 09:53:20', '2020-12-05 09:53:20'),
(12, 3, 4802, 4802, '2020-12-07', 1, 'Ahmedabad', 967822, 1, 'Hello', '2020-12-07', b'1', b'1', '2020-12-05 10:11:48', '2020-12-05 10:11:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_calllist`
--
ALTER TABLE `tbl_calllist`
  ADD PRIMARY KEY (`nid`);

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
-- Indexes for table `tbl_division`
--
ALTER TABLE `tbl_division`
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
-- Indexes for table `tbl_purpose`
--
ALTER TABLE `tbl_purpose`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_segment`
--
ALTER TABLE `tbl_segment`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_tour`
--
ALTER TABLE `tbl_tour`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tbl_visitplan`
--
ALTER TABLE `tbl_visitplan`
  ADD PRIMARY KEY (`nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_calllist`
--
ALTER TABLE `tbl_calllist`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_city_state_country`
--
ALTER TABLE `tbl_city_state_country`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_contactperson`
--
ALTER TABLE `tbl_contactperson`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_division`
--
ALTER TABLE `tbl_division`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `tbl_organisation`
--
ALTER TABLE `tbl_organisation`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_purpose`
--
ALTER TABLE `tbl_purpose`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_segment`
--
ALTER TABLE `tbl_segment`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_tour`
--
ALTER TABLE `tbl_tour`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_visitplan`
--
ALTER TABLE `tbl_visitplan`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
