-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 07:33 AM
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
(2, 2, '2020-11-12', '232451', 1, 3, 2, 'hello how are you', '2020-11-12', b'1', b'1', '2020-11-12 14:19:45', '2020-11-12 16:06:59', 1, 0),
(3, 3, '2020-11-17', '325', 2, 1, 1, 'hey', '2020-11-17', b'1', b'1', '2020-11-12 14:22:00', '2020-11-17 18:06:40', 2, 0),
(4, 4, '2020-11-13', '54745', 3, 1, 2, 'dhb', '2020-12-11', b'1', b'1', '2020-11-12 14:27:03', '2020-11-12 14:27:03', 3, 0),
(6, 45, '2020-11-17', '1234', 3, 1, 1, 'code number 45', '2020-11-17', b'1', b'1', '2020-11-17 12:17:41', '2020-11-17 12:17:41', 5, 0),
(7, 44, '2020-11-27', '3245', 2, 2, 2, 'heya!!', '2020-11-27', b'1', b'1', '2020-11-27 14:22:51', '2020-11-27 14:22:51', 6, 2),
(8, 973217, '2028-11-20', '9427665395', 973217, 2, 1, 'BUSY', '2020-11-20', b'1', b'1', '2020-11-27 15:26:01', '2020-11-27 16:04:32', 7, 1),
(9, 77, '2020-11-13', '756467', 973217, 1, 2, 'logged in user added', '2020-11-24', b'1', b'1', '2020-11-26 12:58:37', '2020-11-26 12:58:37', 8, 86);

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
(2, 2, 0, 'B', 1, '234', '432', 'b@123', 2, b'1', b'1', '2020-11-09 17:11:07', '2020-11-09 17:11:07', 2),
(3, 3, 0, 'A', 1, '345678', '234567', 'a@123', 1, b'1', b'1', '2020-11-09 17:52:18', '2020-11-09 17:52:18', 3),
(4, 973217, 777, 'MR. CHIRAG SALOT', 1, '9427665395', '9427665395', 'chhayaelectric@gmail.com', 2, b'1', b'1', '2020-11-27 15:24:17', '2020-11-27 16:03:34', 4),
(5, 78, 86, 'PEPL', 1, '323232', '434343', 'pepl@123', 1, b'1', b'1', '2020-11-26 12:44:50', '2020-11-26 12:44:50', 5);

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
  `nid` int(11) NOT NULL,
  `ninternal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employeemaster`
--

INSERT INTO `tbl_employeemaster` (`nemployee_unique_id`, `cengineer_name`, `ccity`, `cstate`, `ccountry`, `nkey_ac_manager_id`, `ckey_ac_manager`, `caddress`, `cmobile_number`, `calt_mobile_number`, `cuser_type`, `cemail_id`, `isAvailable`, `isActive`, `cuser_name`, `cpassword`, `dcreated_date`, `dupdated_date`, `nid`, `ninternal_id`) VALUES
(86, 'A', 'JAIPUR', 'RAJASTHAN', 'INDIA', 0, 'null', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'a@gmail', b'1', b'1', 'a@123', 'a@123', '2020-11-02 10:31:41', '2020-11-02 10:31:41', 86, 16),
(87, 'B1', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', '65798989', '3', 'b2@gmail', b'1', b'1', 'b1@123', 'b2@123', '2020-11-02 10:35:56', '2020-11-17 16:38:44', 87, 15),
(88, 'B2', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', 'Pyrotech Unit 2', '787654321', '65798989', '3', 'b2@gmail', b'1', b'1', 'b2@123', 'b2@123', '2020-11-02 10:35:56', '2020-11-03 12:54:32', 88, 14),
(98, 'C2', 'BANG KHEN', 'BANGKOK', 'THAILAND', 87, 'B1', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c2@gmail', b'1', b'1', 'c2@123', 'c2@123', '2020-11-02 17:35:55', '2020-11-07 12:35:41', 98, 13),
(99, 'C3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c3@gmail', b'1', b'1', 'c3@123', 'c3@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 99, 12),
(100, 'C4', 'JAIPUR', 'RAJASTHAN', 'INDIA', 88, 'B2', 'Pyrotech Unit 2', '787654321', '65798989', '2', 'c4@gmail', b'1', b'1', 'c4@123', 'c4@123', '2020-11-02 17:35:55', '2020-11-02 17:35:55', 100, 11),
(103, 'D3', 'JAIPUR', 'RAJASTHAN', 'INDIA', 98, 'C2', 'Pyrotech Unit 2', '787654321', '65798989', '4', 'd3@gmail', b'1', b'1', 'd3@123', 'd3@123', '2020-11-02 17:41:34', '2020-11-26 18:51:10', 103, 10),
(106, 'D6', 'AHEMDABAD', 'GUJRAT', 'INDIA', 114, 'C3', 'Pyrotech Unit 2', '787654321', '65798989', '1', 'd6@gmail', b'1', b'1', 'd6@123', 'd6@123', '2020-11-02 17:41:34', '2020-11-04 09:58:06', 106, 7),
(126, 'D1', 'AHEMDABAD', 'GUJRAT', 'INDIA', 114, 'C1', 'D1', 'D1', 'D1', '1', 'D1', b'1', b'1', 'D1', 'D1', '2020-11-04 15:03:19', '0000-00-00 00:00:00', 126, 6),
(102, 'Dolar', 'JAIPUR', 'RAJASTHAN', 'INDIA', 103, 'D3_1', 'Dolar', 'Dolar', 'Dolar', '3', 'Dolar', b'1', b'1', 'Dolar', 'Dolar', '2020-11-07 12:43:38', '0000-00-00 00:00:00', 130, 3),
(22, 'sand', 'JAIPUR', 'RAJASTHAN', 'INDIA', 104, 'D4_1', 'sand', 'sand', 'sand', '3', 'sand', b'1', b'1', 'sand', 'sand', '2020-11-17 16:26:49', '0000-00-00 00:00:00', 132, 2),
(32, 'q', 'AHEMDABAD', 'GUJRAT', 'INDIA', 104, 'D4_1', 'q', 'q', 'q', '3', 'q', b'1', b'1', 'q', 'q', '2020-11-18 12:20:46', '0000-00-00 00:00:00', 133, 1),
(108, 'Donald', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', '167,sec-2', '890890890', '890890', '3', 'donald@123', b'1', b'1', 'donald@123', 'donald@123', '2020-11-27 16:38:32', '0000-00-00 00:00:00', 134, 17),
(0, 'TRump', 'JAIPUR', 'RAJASTHAN', 'INDIA', 98, 'C2', 'America', '456456', '3463456', '1', 'usertype@123', b'1', b'1', 'usertype@123', 'usertype@123', '2020-11-27 16:39:49', '0000-00-00 00:00:00', 135, 18),
(111111, 'zdxvcf', 'BANG KHEN', 'BANGKOK', 'THAILAND', 103, 'D3', 'szdf', 'zdf', 'zdcv', '3', 'zfc', b'1', b'1', 'sd v', 'n  ,', '2020-11-26 11:23:34', '0000-00-00 00:00:00', 136, 19),
(4806, 'Vishnu prajapat', 'UDAIPUR', 'RAJASTHAN', 'INDIA', 103, 'D3', '123, Purbiya Gali , Kanpur   , Udaipur  Raj .', '9024859461', '9352513959', '4', 'Vprajapat@pyrotechlighting.com', b'1', b'1', 'vishnu', 'vishnu', '2020-12-02 17:54:38', '0000-00-00 00:00:00', 137, 20),
(90, 'Newe ', 'AHEMDABAD', 'GUJRAT', 'INDIA', 86, 'A', 'newe', '9090909', '0898989', '3', 'newe@123', b'1', b'1', 'newe', 'newe', '2020-12-03 10:00:36', '0000-00-00 00:00:00', 138, 21);

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
(1, 1, 'Organisation A', 'Pyrotech 123', 'UDAIPUR', 'RAJASTHAN', 'INDIA', '987654321', 'orgA@1234', 2, b'1', b'1', '2020-11-05 11:40:01', '2020-11-26 18:51:55', 1),
(2, 2, 'Organisation B', 'Pyrotech Unit 3', 'UDAIPUR', 'RAJASTHAN', 'INDIA', '987654321', 'orgB@123', 2, b'1', b'1', '2020-11-05 11:40:01', '2020-11-27 11:48:49', 2),
(3, 3, 'Organisation c', 'Pyrotech Unit 3', 'UDAIPUR', 'RAJASTHAN', 'INDIA', '987654321', 'orgc@123', 2, b'1', b'0', '2020-11-05 11:40:01', '2020-11-05 17:46:00', 3),
(6, 81, 'Organisation D', 'Pyrotech unit 4', 'BANG KHEN', 'BANGKOK', 'THAILAND', '123454321', 'orgD@123', 1, b'1', b'0', '2020-11-27 12:14:07', '2020-11-27 12:16:07', 4),
(7, 973217, 'CHHAYA ELECTRIC STORES', 'Opp. Gitamandir Tower, Nr. Gita Manddir S.T. Stand', 'AHEMDABAD', 'GUJRAT', 'INDIA', '9427665395', 'chhayaelectric@gmail.com', 1, b'1', b'1', '2020-11-27 15:23:05', '2020-11-27 15:23:05', 5);

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
(1, 1, 21, 0, '2020-11-30', 1, 3, 1, 'first entry', '2020-12-01', b'1', b'1', '2020-11-27 11:41:23', '2020-11-26 18:53:52'),
(2, 2, 34, 86, '2020-11-09', 2, 973217, 1, 'logged in user added', '2020-11-24', b'1', b'1', '2020-11-26 12:54:24', '2020-11-26 12:54:24');

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
(5, 3, 21, 0, '2020-11-14', 2, 'BHILWARA', 2, 2, 'addition', '2020-11-30', b'1', b'1', '2020-11-28 13:46:27', '2020-11-27 15:53:46'),
(7, 4, 33, 0, '2020-11-24', 2, 'JODHPUR', 3, 1, 'done', '2020-12-05', b'1', b'1', '2020-11-27 15:54:36', '2020-11-27 15:54:36'),
(8, 5, 973217, 1, '2020-11-28', 2, 'AHMEDABAD', 973217, 1, 'LIGHT SAMPLE ', '2020-12-07', b'1', b'1', '2020-11-27 16:06:49', '2020-11-27 16:06:49'),
(9, 6, 54, 86, '2020-11-18', 1, 'JAIPUR', 78, 2, 'logged in user added', '2020-11-25', b'1', b'1', '2020-11-26 12:56:47', '2020-11-26 12:56:47');

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
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_city_state_country`
--
ALTER TABLE `tbl_city_state_country`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_contactperson`
--
ALTER TABLE `tbl_contactperson`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_employeemaster`
--
ALTER TABLE `tbl_employeemaster`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `tbl_organisation`
--
ALTER TABLE `tbl_organisation`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_visitplan`
--
ALTER TABLE `tbl_visitplan`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
