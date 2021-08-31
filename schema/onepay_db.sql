-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 10:16 AM
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
-- Database: `onepay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `o_addons`
--

CREATE TABLE `o_addons` (
  `uid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `amount` double(50,2) NOT NULL,
  `amount_type` varchar(50) NOT NULL COMMENT 'PERCENTAGE, FIXED',
  `loan_stage` varchar(50) NOT NULL,
  `automatic` int(1) NOT NULL COMMENT 'Applied automatically on loan creation',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_addons`
--

INSERT INTO `o_addons` (`uid`, `name`, `description`, `amount`, `amount_type`, `loan_stage`, `automatic`, `status`) VALUES
(1, 'Loan Interest', 'The first Interest of the Loan', 20.00, 'PERCENTAGE', 'CREATION', 0, 1),
(2, 'Initiation Fee', 'Applied to the first loan', 500.00, 'FIXED_VALUE', 'CREATION', 0, 1),
(3, 'Late Fee', 'When you miss  your installment', 4.00, 'PERCENTAGE', 'PARTIAL_DEFAULT', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_asset_categories`
--

CREATE TABLE `o_asset_categories` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_asset_categories`
--

INSERT INTO `o_asset_categories` (`uid`, `name`, `status`) VALUES
(1, 'Vehicle', 1),
(2, 'Land', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_branches`
--

CREATE TABLE `o_branches` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `added_date` datetime NOT NULL,
  `manager_id` int(10) NOT NULL,
  `assistand_manager_id` int(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_branches`
--

INSERT INTO `o_branches` (`uid`, `name`, `added_date`, `manager_id`, `assistand_manager_id`, `address`, `status`) VALUES
(1, 'HQ', '2021-05-07 06:11:42', 0, 0, 'Main Office', 1),
(2, 'Kiambu', '2021-06-19 23:07:50', 1, 0, 'rrt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaigns`
--

CREATE TABLE `o_campaigns` (
  `uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `running_date` date NOT NULL,
  `running_status` int(5) NOT NULL DEFAULT '1',
  `frequency` int(5) NOT NULL,
  `repetitive` int(5) NOT NULL,
  `target_customers` int(5) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(5) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaigns`
--

INSERT INTO `o_campaigns` (`uid`, `name`, `description`, `running_date`, `running_status`, `frequency`, `repetitive`, `target_customers`, `added_date`, `added_by`, `status`) VALUES
(1, 'New Year', 'Holiday wishes to our customers', '2021-01-01', 1, 6, 1, 3, '2021-07-20 00:00:00', 51, 1),
(2, 'Good Friday', 'Holiday Wishes to all our customers', '2021-04-02', 1, 6, 2, 3, '2021-07-20 00:00:00', 51, 1),
(3, 'Easter Monday', 'Holiday wishes to our customers', '2021-04-05', 1, 6, 2, 3, '2021-07-20 00:00:00', 51, 1),
(4, 'Labour Day', 'Holiday wishes to our esteemed customers', '2021-05-01', 1, 6, 2, 3, '2021-07-20 00:00:00', 51, 1),
(5, 'Eld al_Fitr', 'Holiday wishes to our esteemed customers', '2021-05-14', 1, 6, 2, 3, '2021-07-20 00:00:00', 51, 1),
(6, 'Madaraka Day', 'Holiday wishes to our esteemed customers', '2021-06-01', 1, 6, 2, 3, '2021-07-20 00:00:00', 51, 1),
(7, 'Eid al-Adha', 'Holiday wishes to our customers', '2021-07-20', 1, 6, 2, 3, '2021-07-23 00:00:00', 51, 1),
(8, 'Huduma Day', 'Holiday wishes to our customers', '2021-10-11', 1, 6, 2, 3, '2021-07-23 00:00:00', 51, 1),
(9, 'Mashujaa Day', 'Holiday wishes to our customers', '2021-10-20', 1, 6, 2, 3, '2021-07-24 00:00:00', 51, 1),
(10, 'Jamhuri Day', 'Holiday wishes to our customers', '2021-12-13', 1, 6, 2, 3, '2021-07-24 00:00:00', 51, 0),
(11, 'Christmas Day', 'Holiday wishes to our customers', '2021-12-25', 1, 6, 1, 3, '2021-07-24 00:00:00', 51, 1),
(12, 'Utamaduni Day', 'Holiday wishes to our customers', '2021-12-27', 1, 6, 2, 3, '2021-07-24 00:00:00', 51, 2),
(13, 'Testing_1', 'Birthday wishes', '2021-07-22', 1, 6, 2, 1, '2021-07-24 00:00:00', 51, 1),
(14, 'Testing_2', 'Birthday wishes', '2021-07-23', 3, 6, 2, 1, '2021-07-24 00:00:00', 51, 1),
(15, 'Testing_3', 'Birthday wishes', '2021-07-24', 1, 6, 2, 1, '2021-07-24 00:00:00', 51, 0),
(16, 'Testing_4', 'Birthday wishes', '2021-07-25', 1, 6, 1, 2, '2021-07-24 00:00:00', 51, 0),
(17, 'Testing_5', 'Activation', '2021-07-26', 1, 1, 1, 1, '2021-07-24 00:00:00', 51, 0),
(18, 'Birthdays wishes', 'Send happy birthday message to all customers who have their birthdays  today ', '2021-08-08', 1, 1, 1, 2, '2021-07-26 00:00:00', 51, 1),
(19, 'Testing_6', 'Send message wishing happy holiday to our customers', '2021-07-26', 1, 6, 1, 3, '2021-07-26 00:00:00', 51, 0),
(20, 'Holidays Wishes2', 'A message to wish customers happy holidays', '2021-07-27', 2, 1, 1, 3, '2021-07-26 00:00:00', 0, 0),
(21, 'Testing_7', 'Campaign testing', '2021-07-26', 1, 1, 1, 1, '2021-07-26 00:00:00', 0, 0),
(22, 'Testing_8', 'Campaign test', '2021-07-26', 1, 1, 1, 2, '2021-07-26 00:00:00', 0, 0),
(23, 'test_', 'Campaign_test', '2021-07-26', 1, 2, 1, 1, '2021-07-26 00:00:00', 51, 0),
(24, 'test_2', 'Campaign_2 test', '2021-07-27', 1, 2, 2, 3, '2021-07-26 00:00:00', 0, 0),
(25, 'Message', 'Activation', '2021-08-09', 1, 6, 2, 1, '2021-08-09 00:00:00', 0, 1),
(26, 'Holiday Wishes', '', '2021-12-05', 1, 6, 2, 3, '2021-08-11 00:00:00', 0, 1),
(27, 'Campaign Testing', 'Wjhgfd', '2021-08-13', 1, 6, 2, 3, '2021-08-12 15:56:16', 0, 2),
(28, 'Campaign Testing_', 'testing', '2021-08-12', 1, 1, 1, 2, '2021-08-12 16:06:09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaigns_repetition_status`
--

CREATE TABLE `o_campaigns_repetition_status` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaigns_repetition_status`
--

INSERT INTO `o_campaigns_repetition_status` (`uid`, `name`, `status`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaign_frequencies`
--

CREATE TABLE `o_campaign_frequencies` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaign_frequencies`
--

INSERT INTO `o_campaign_frequencies` (`uid`, `name`, `status`) VALUES
(1, 'Daily', 1),
(2, 'Weekly', 1),
(3, 'Monthly', 1),
(4, 'Quarterly', 1),
(5, 'Semi-yearly', 1),
(6, 'Yearly', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaign_messages`
--

CREATE TABLE `o_campaign_messages` (
  `uid` int(10) NOT NULL,
  `campaign_id` int(10) NOT NULL,
  `message` varchar(250) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(5) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaign_messages`
--

INSERT INTO `o_campaign_messages` (`uid`, `campaign_id`, `message`, `added_date`, `added_by`, `status`) VALUES
(3, 0, 'Dear $fname we would like to wish you a happy holiday', '2021-07-26 19:35:42', 0, 1),
(4, 0, 'Dear $fname we would like to wish you a happy holiday2', '2021-07-26 19:47:23', 0, 1),
(5, 0, 'Dear, we would like to wish you a happy Holiday.', '2021-08-09 22:21:18', 51, 1),
(6, 25, 'Dear {{fname}} we offer the following products at low interest.', '2021-08-09 23:04:56', 51, 1),
(7, 25, 'Message Testing 2', '2021-08-11 20:39:11', 51, 0),
(8, 25, 'Message _testing ', '2021-08-11 20:41:14', 51, 0),
(9, 18, 'Dear {{fname}}, we would like to wish you a happy birthday.', '2021-08-11 22:44:14', 51, 1),
(10, 26, 'Dear {{fname}}, we would like to wish you happy holidays and a prosperous new year.', '2021-08-11 22:48:01', 51, 1),
(11, 11, 'Dear {{fname}}, we would like to wish you a merry Christmas.', '2021-08-11 22:51:28', 51, 1),
(12, 27, 'Holiday wishes to all our customers', '2021-08-12 16:02:40', 51, 1),
(13, 19, 'FGHJKLKJB', '2021-08-12 16:04:35', 51, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaign_running_statuses`
--

CREATE TABLE `o_campaign_running_statuses` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color_code` varchar(50) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaign_running_statuses`
--

INSERT INTO `o_campaign_running_statuses` (`uid`, `name`, `color_code`, `status`) VALUES
(1, 'Pending', '#ff8c00', 1),
(2, 'Running', '#6cce05', 1),
(3, 'Already Run', '#00fa9a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaign_statuses`
--

CREATE TABLE `o_campaign_statuses` (
  `uid` int(3) NOT NULL,
  `code` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaign_statuses`
--

INSERT INTO `o_campaign_statuses` (`uid`, `code`, `name`, `color`, `status`) VALUES
(1, 1, 'ACTIVE', 'bg-green', 1),
(2, 2, 'BLOCKED', 'bg-red', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_campaign_target_customers`
--

CREATE TABLE `o_campaign_target_customers` (
  `uid` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(250) NOT NULL,
  `custom_query` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_campaign_target_customers`
--

INSERT INTO `o_campaign_target_customers` (`uid`, `name`, `description`, `custom_query`, `status`) VALUES
(1, 'Activate  Dormant Customers', 'Send a message to all customers who have not taken a loan for 6 months', '', 1),
(2, 'Birthdays', 'Send Birthday Wishes', '', 1),
(3, 'Holiday Wishes', 'Send holiday wishes to all customers', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_collateral`
--

CREATE TABLE `o_collateral` (
  `uid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL COMMENT 'From o_customers table',
  `category` int(5) NOT NULL COMMENT 'From o_asset_categories',
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `money_value` double(50,2) DEFAULT NULL,
  `document_scan_address` varchar(10) NOT NULL COMMENT 'From o_documents',
  `doc_reference_no` varchar(100) NOT NULL COMMENT 'A unique number to identify the document',
  `filling_reference_no` varchar(100) NOT NULL COMMENT 'If a physical document is kept, the address of the file in filling cabinet',
  `added_date` datetime NOT NULL,
  `added_by` int(10) NOT NULL,
  `loan_id` int(10) NOT NULL,
  `status` int(3) NOT NULL COMMENT 'From o_collateral_statuses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_collateral`
--

INSERT INTO `o_collateral` (`uid`, `customer_id`, `category`, `title`, `description`, `money_value`, `document_scan_address`, `doc_reference_no`, `filling_reference_no`, `added_date`, `added_by`, `loan_id`, `status`) VALUES
(1, 0, 2, 'Land', 'Good land', NULL, '', '6765456', '7777665', '2021-05-17 23:33:09', 0, 0, 1),
(2, 3, 1, 'yyy', 'ggfdd', NULL, '', 'ggfdssd', 'hgfd', '2021-05-17 23:38:04', 0, 10, 2),
(3, 3, 2, 'TV', 'A 72 Inch Smart TV', 10000.00, '', '123456', '43455', '2021-05-20 14:22:27', 0, 10, 2),
(4, 11, 2, '80x100 Plot', 'A land in Ruiru', 3000000.00, '', '54463678', '', '2021-06-11 13:21:00', 1, 0, 0),
(5, 11, 1, 'Sedan Car KAG', 'The quick ', 500000.00, '', '646463643', '64636473', '2021-06-11 13:32:03', 1, 0, 0),
(6, 11, 1, 'Car KAG 1', 'The Quickjjf', 10000.00, '190', '546364', '87575545', '2021-06-11 17:40:37', 1, 0, 1),
(7, 12, 2, 'Land', '50 x 100', 300000.00, '', '', '', '2021-07-31 11:14:59', 51, 0, 1),
(8, 12, 1, 'Toyota Land Cruiser', 'As good as new', 600000.00, 'rtyuiop765', 'yiop', 'dfghjk', '2021-07-31 15:08:25', 51, 11, 1),
(9, 4, 1, 'Vehicle ', '', 700000.00, '', 'kbw', '345980', '2021-08-01 10:33:43', 51, 0, 1),
(10, 16, 2, 'Land', 'Located at Syokimau', 600000.00, '54321', '344322', '23456', '2021-08-08 22:37:55', 51, 0, 1),
(11, 16, 1, 'Vehicle', 'Model  Harrier', 1500000.00, 'k9876543', '56789', '98765', '2021-08-08 22:40:07', 51, 0, 1),
(12, 13, 1, 'Vehicle', 'Toyota Premio, as good as new.', 700000.00, '345678', '234567', '876543', '2021-08-09 15:08:37', 51, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `o_collateral_statuses`
--

CREATE TABLE `o_collateral_statuses` (
  `uid` int(5) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='The status of collateral items e.g. ';

--
-- Dumping data for table `o_collateral_statuses`
--

INSERT INTO `o_collateral_statuses` (`uid`, `code`, `name`, `status`) VALUES
(1, '1', 'Not Used', 1),
(2, '2', 'Engaged', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_contact_types`
--

CREATE TABLE `o_contact_types` (
  `uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'e.g. Alternative Phone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_contact_types`
--

INSERT INTO `o_contact_types` (`uid`, `name`) VALUES
(3, 'Alternative Email'),
(1, 'Alternative Phone'),
(2, 'Alternative Phone 2');

-- --------------------------------------------------------

--
-- Table structure for table `o_conversation_methods`
--

CREATE TABLE `o_conversation_methods` (
  `uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_conversation_methods`
--

INSERT INTO `o_conversation_methods` (`uid`, `name`, `details`, `status`) VALUES
(1, 'Face to face', 'fa-user-circle-o', 1),
(2, 'Chat', 'fa-comment-o', 1),
(3, 'Call', 'fa fa-phone', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_conversation_outcome`
--

CREATE TABLE `o_conversation_outcome` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_conversation_outcome`
--

INSERT INTO `o_conversation_outcome` (`uid`, `name`, `details`, `status`) VALUES
(1, 'Not Found On Call', 'fa-ban', 1),
(2, 'Repayment Plan', 'fa-clock-o', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_customers`
--

CREATE TABLE `o_customers` (
  `uid` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `primary_mobile` varchar(15) NOT NULL,
  `email_address` varchar(60) DEFAULT NULL,
  `physical_address` varchar(250) NOT NULL,
  `town` int(10) NOT NULL,
  `passport_photo` varchar(250) NOT NULL,
  `national_id` varchar(10) NOT NULL,
  `gender` varchar(5) NOT NULL COMMENT 'M, F',
  `dob` date NOT NULL,
  `added_by` int(10) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch` int(5) NOT NULL COMMENT 'From o_branches',
  `primary_product` int(5) NOT NULL COMMENT 'From o_products',
  `loan_limit` double(100,2) NOT NULL DEFAULT '0.00',
  `events` mediumtext NOT NULL,
  `status` int(5) NOT NULL COMMENT 'From o_customer_statuses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_customers`
--

INSERT INTO `o_customers` (`uid`, `full_name`, `primary_mobile`, `email_address`, `physical_address`, `town`, `passport_photo`, `national_id`, `gender`, `dob`, `added_by`, `added_date`, `branch`, `primary_product`, `loan_limit`, `events`, `status`) VALUES
(1, 'Jonah Ngarama', '254716330450', 'ngaramajonah@gmail.com', 'Ngong\nKobo Flat', 1, '', '28153539', 'M', '1990-01-04', 0, '2021-05-17 10:09:01', 1, 1, 10000.00, 'Customer created at [2021-05-17 10:09:01] by [{}root]', 1),
(2, 'Mercy Ezzy', '254702332796', 'mercyezzy92@gmail.com', 'Ngong\nKobo Flat', 1, '', '28153538', 'F', '2021-05-17', 0, '2021-05-17 10:24:24', 1, 1, 10.00, 'Customer created at [2021-05-17 10:24:24] by [{}root]', 2),
(3, 'Peter Witu', '254756330450', 'peterwitu@gmail.com', 'Ngong\nKobo Flat', 1, '', '28156647', 'M', '2021-05-17', 0, '2021-05-17 19:22:01', 1, 1, 60000.00, 'Customer created at [2021-05-17 19:22:01] by [{}root]', 1),
(4, 'Stephen Abundo', '254778999992', 'stephen@gmail.com', '217-202020                                                                                                 ', 1, '', '6789034', 'M', '2021-07-01', 1, '2021-06-08 19:07:32', 2, 1, 10000.00, 'Customer created at [2021-06-08 19:07:32] by [Jonah Ngarama{1}root]', 1),
(9, 'Paul Kin', '254717889887', 'ngaramajonah@gmail.com1', '123 street                                                                                                                                                                                                                                                ', 1, '', '78987689', 'M', '2021-06-08', 1, '2021-06-08 22:54:29', 1, 0, 5000.00, 'Customer created at [2021-06-08 22:54:29] by [Jonah Ngarama{1}root]', 1),
(10, 'Paul Muriithi111', '254724542111', 'ngaramampaul@gmail.com1111', 'Thome, Nyati Drive 1                                                                                                                                                       ', 1, '', '67788776', 'F', '1994-05-08', 1, '2021-06-08 23:02:25', 1, 2, 2000.00, 'Customer created at [2021-06-08 23:02:25] by [Jonah Ngarama{1}root]', 1),
(11, 'Billy Mwalili', '254793884883', 'billymwalili@gmail.com', '233 2424 street                                                                                                                        ', 1, '', '6474343', 'M', '1990-07-09', 1, '2021-06-09 11:45:29', 1, 1, 100000.00, '', 1),
(12, 'Samuel Munyi', '254112553167', 'samunyi90@gmail.com', '     214-20320                                                                                                                ', 1, '', '32909210', 'M', '1996-08-05', 51, '2021-07-12 11:11:28', 2, 0, 100000.00, '', 1),
(13, 'John Doe', '254112553169', 'john@gmail.com', '       14-20320                                                                                                                                                                                                 ', 1, '', '32909212', 'M', '2021-07-14', 51, '2021-07-14 11:24:05', 2, 1, 25000.00, '', 1),
(14, 'Grace Kagiri', '254711253167', 'kagiri@gmail.com', '                                        Sipili-Street                                                                                ', 1, '', '3456789', 'F', '2000-07-19', 51, '2021-07-19 09:23:44', 2, 1, 3000.00, '', 1),
(15, 'Aron Kinyanjui', '254711253177', 'aron@gmail.com', '                                        kiambaa Flat                                                                                                                        ', 1, '', '34251678', 'M', '1997-07-01', 51, '2021-07-19 09:26:04', 2, 1, 4000.00, '', 1),
(16, 'Martin Mwangi', '254705609184', 'martin567@gmail.com', '        Kimathi Street                                                                                                                                                        ', 1, '', '2345678', 'M', '2021-07-26', 51, '2021-07-26 12:39:58', 1, 2, 2500.00, '', 1),
(17, 'Irene Maingi', '254711567098', 'irene@gmail.com', '       Kiambu                                                                                                                                                                                                                                             ', 1, '', '327069', 'F', '2021-08-09', 51, '2021-08-09 18:07:46', 2, 1, 25000.00, '', 1),
(18, 'Jane Wanjiku', '254709123095', 'wanjiku21@gmail.com', '                       Embakasi                                                         ', 1, '', '54327890', 'F', '2021-08-17', 51, '2021-08-17 21:10:17', 2, 1, 12000.00, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_customer_contacts`
--

CREATE TABLE `o_customer_contacts` (
  `uid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `contact_type` int(10) NOT NULL COMMENT 'From o_contact_types table',
  `value` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_customer_contacts`
--

INSERT INTO `o_customer_contacts` (`uid`, `customer_id`, `contact_type`, `value`, `status`) VALUES
(1, 3963, 3, 'peter1dgd@gmail.com', 0),
(2, 3, 3, 'ngaramajonah@gmail.com', 0),
(3, 3, 1, '0716330450', 0),
(4, 3, 2, '123tete', 0),
(5, 2, 3, 'ngaramajonah@gmail.com', 0),
(6, 11, 1, '0756436447', 0),
(7, 10, 3, 'jdhdhs@gmail.com', 0),
(8, 11, 3, 'peterkinyanjui@gmail.com', 0),
(9, 0, 1, '07353', 1),
(10, 11, 2, 'hhhh', 0),
(11, 11, 3, 'gggg', 0),
(12, 11, 2, 'hhhhh', 0),
(13, 11, 2, 'gggg', 0),
(14, 11, 3, 'bbbb', 0),
(15, 11, 2, 'Thhh', 0),
(16, 11, 3, 'jjdf', 0),
(17, 11, 2, 'kdkd', 0),
(18, 11, 3, 'ndjdd', 0),
(19, 11, 3, 'jfjf', 0),
(20, 11, 2, 'jdjjsjsd d dsjsjdsjd dsjjdsjs', 0),
(21, 11, 2, 'djsdsd dsjdj', 0),
(22, 11, 3, 'ngarama@jdjsdjs..cd', 0),
(23, 11, 2, '09663627364', 0),
(24, 11, 2, '07163304502', 1),
(25, 11, 2, 'jddjd', 0),
(26, 11, 1, 'nnnffn', 0),
(27, 11, 3, 'The Email', 1),
(28, 11, 1, '536236632', 1),
(29, 10, 3, 'hgfds', 1),
(30, 12, 3, 'example@gmail.com', 1),
(31, 13, 3, 'example@gmail.com', 1),
(32, 13, 2, '0705609184', 0),
(33, 13, 2, '0705609184', 1),
(34, 16, 3, 'martin3@gmail.com', 1),
(35, 12, 1, '254112567890', 1),
(36, 4, 1, '254112456789', 1),
(37, 4, 2, '254112553167', 0),
(38, 4, 3, 'munyisamuel3@gmail.com', 1),
(39, 12, 2, '254705609184', 0),
(40, 12, 2, '254705609184', 1),
(41, 16, 1, '254112459805', 1),
(42, 16, 2, '254234098761', 0),
(43, 16, 3, 'mwangi2@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_customer_conversations`
--

CREATE TABLE `o_customer_conversations` (
  `uid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `agent_id` int(10) NOT NULL,
  `loan_id` int(10) NOT NULL,
  `transcript` varchar(250) NOT NULL,
  `conversation_method` int(5) NOT NULL COMMENT 'From o_conversation_methods',
  `conversation_date` datetime NOT NULL,
  `next_interaction` date DEFAULT NULL,
  `next_steps` int(5) NOT NULL COMMENT 'From o_next_steps',
  `flag` int(5) NOT NULL,
  `outcome` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_customer_conversations`
--

INSERT INTO `o_customer_conversations` (`uid`, `customer_id`, `agent_id`, `loan_id`, `transcript`, `conversation_method`, `conversation_date`, `next_interaction`, `next_steps`, `flag`, `outcome`, `status`) VALUES
(1, 1, 1, 1, 'THe event that was', 2, '0000-00-00 00:00:00', '0000-00-00', 0, 1, 0, 0),
(2, 1, 1, 1, 'The trans', 2, '2021-06-02 21:36:22', '2021-06-02', 2, 2, 0, 1),
(3, 3, 1, 1, 'He is not at home', 2, '2021-06-02 21:47:01', '2021-06-02', 2, 2, 0, 1),
(4, 10, 1, 1, 'The Client said they are not available', 2, '2021-06-17 18:50:14', '2021-06-19', 2, 1, 0, 1),
(5, 11, 1, 1, 'The client will not pay', 1, '2021-06-18 11:23:11', '2021-06-25', 2, 1, 0, 1),
(6, 9, 1, 1, 'Yestes', 1, '2021-06-18 12:38:05', '2021-06-17', 2, 2, 0, 1),
(7, 1, 1, 1, 'Another Interaction', 1, '2021-06-18 14:32:42', '2021-07-01', 1, 1, 0, 1),
(8, 9, 1, 1, 'Not Available', 1, '2021-07-10 11:50:41', '2021-07-10', 1, 1, 0, 1),
(9, 11, 1, 1, 'Client promised to pay in the course of the week', 1, '2021-08-11 09:58:29', '2021-08-11', 0, 1, 0, 1),
(10, 13, 1, 1, 'Yesterday', 2, '2021-08-11 09:59:34', '2021-08-10', 1, 2, 0, 1),
(11, 3, 1, 1, 'Today', 1, '2021-08-11 10:01:23', '2021-08-13', 2, 2, 0, 1),
(12, 4, 1, 1, 'Talked Today', 2, '2021-08-11 10:02:51', '0000-00-00', 0, 1, 0, 1),
(13, 10, 1, 1, 'Called Today,pledged to pay tomorrow', 3, '2021-08-11 11:51:34', '2021-08-12', 0, 1, 0, 1),
(14, 15, 1, 1, 'Could not be reached', 3, '2021-08-12 17:48:55', '2021-08-10', 1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_customer_document_categories`
--

CREATE TABLE `o_customer_document_categories` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `formats` varchar(250) NOT NULL COMMENT 'comma delimited extensions',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_customer_document_categories`
--

INSERT INTO `o_customer_document_categories` (`uid`, `name`, `formats`, `status`) VALUES
(1, 'Passport Photo', 'jpg,jpeg,png', 1),
(2, 'National ID Front', 'jpg,jpeg,png', 11),
(3, 'National ID Back', 'jpg,jpeg,png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_customer_referees`
--

CREATE TABLE `o_customer_referees` (
  `uid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  `referee_name` varchar(50) NOT NULL,
  `id_no` varchar(15) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `physical_address` varchar(145) DEFAULT NULL,
  `email_address` varchar(50) NOT NULL,
  `relationship` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_customer_referees`
--

INSERT INTO `o_customer_referees` (`uid`, `customer_id`, `added_date`, `referee_name`, `id_no`, `mobile_no`, `physical_address`, `email_address`, `relationship`, `status`) VALUES
(1, 11, '2021-05-17 22:49:02', 'Jonah Ngarama', '76787635', '254716330450', 'Ngong\nKobo Flat', 'undefined', 1, 0),
(2, 11, '2021-05-20 13:00:49', 'jonah ngarama', '567654536', '254716330450', 'Ngong1\nKobo Flat', 'ngaramajonah@gmail.com', 2, 1),
(3, 1, '2021-05-20 13:00:49', 'Peter Kigia', '56765453', '254716330450', 'Ngong\nKobo Flat', 'undefined', 2, 1),
(4, 14531, '2021-06-11 10:41:11', 'Paul Muriithi', '23452627', '254724542517', 'Thome, Nyati Drive\nSportview Road, Kasarani', 'ngaramampaul@gmail.com', 1, 1),
(5, 11, '2021-06-11 10:47:30', 'Paul Muriithi', '12345673', '254716330450', 'Ngong\nKobo Flat', 'ngaramampaul@gmail.com', 2, 1),
(6, 11, '2021-06-11 10:49:20', 'fkfjdf dfjduf', '7436453466', '254716330451', 'Ngong\nKobo Flat', 'jdjdjfj@uduusd.com', 1, 1),
(7, 11, '2021-06-11 10:52:03', 'jonah ngarama1', '747488545', '254716330451', 'Ngong1\nKobo Flat', 'ngaramajonah@gmail.com1', 1, 0),
(8, 11, '2021-06-11 10:53:52', 'Paul Muriithi1', '667377382', '254724542547', 'Thome, Nyati Drive\nSportview Road, Kasarani', 'ngaramampaul@gmail.com1', 1, 0),
(9, 12, '2021-07-31 10:18:08', 'Peter Munyi', '23450987', '254711345098', 'Narok Road', 'peter@gmail.com', 2, 0),
(10, 12, '2021-07-31 10:19:04', 'Peter Munyi', '12349876', '254711345098', 'Allshops', 'munyisamuel3@gmail.com', 2, 0),
(11, 12, '2021-07-31 10:24:31', 'Peter Munyi', '12349870', '254711345094', 'Allshops', 'munyisamuel4@gmail.com', 2, 1),
(12, 12, '2021-07-31 10:42:40', 'Peter Munyi', '12349876', '254711345093', 'Allshops', 'munyisamuel5@gmail.com', 2, 1),
(13, 4, '2021-08-01 10:35:25', 'Kennedy Abundo', '2345678', '254711567098', 'Nyamira Road', 'abundo@gmail.com', 3, 1),
(14, 16, '2021-08-08 22:34:18', 'Ann Mwangi', '2345345', '254712567098', 'Rimuru, Nairobi Highway', 'annah@gmail.com', 2, 1),
(15, 16, '2021-08-08 22:35:17', 'James Kirimi', '327069', '254711567090', 'Meru', 'kirimi@gmail.com', 4, 1),
(16, 13, '2021-08-09 15:11:22', 'Lucy Doe', '0987654', '254711856709', 'Thika', 'lucy34@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_customer_referee_relationships`
--

CREATE TABLE `o_customer_referee_relationships` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_customer_referee_relationships`
--

INSERT INTO `o_customer_referee_relationships` (`uid`, `name`, `status`) VALUES
(1, 'Spouse (Husband, Wife)', 1),
(2, 'Sibling (Brother, Sister)', 1),
(3, 'Parent(Father, Mother)', 1),
(4, 'Friend', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_customer_statuses`
--

CREATE TABLE `o_customer_statuses` (
  `uid` int(3) NOT NULL,
  `code` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store the statuses of customers';

--
-- Dumping data for table `o_customer_statuses`
--

INSERT INTO `o_customer_statuses` (`uid`, `code`, `name`, `color`, `status`) VALUES
(1, 0, 'DRAFT', NULL, 1),
(2, 1, 'ACTIVE', 'bg-green', 1),
(3, 2, 'BLOCKED', 'bg-red', 1),
(4, 3, 'LEAD', 'bg-gray', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_deductions`
--

CREATE TABLE `o_deductions` (
  `uid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `amount` double(50,2) NOT NULL,
  `amount_type` varchar(50) NOT NULL COMMENT 'PERCENTAGE, FIXED',
  `loan_stage` varchar(50) NOT NULL,
  `automatic` int(1) NOT NULL COMMENT 'Applied automatically on loan creation',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_deductions`
--

INSERT INTO `o_deductions` (`uid`, `name`, `description`, `amount`, `amount_type`, `loan_stage`, `automatic`, `status`) VALUES
(1, 'Evaluation Fees', 'The cost of evaluating the collateral worthiness', 3000.00, 'FIXED_VALUE', '0', 0, 1),
(2, 'Processing Fee', 'Amount to process a Loan', 500.00, 'FIXED_VALUE', 'CREATION', 0, 1),
(3, 'Insurance Fee', 'Fee for insurance', 5.00, 'PERCENTAGE', 'CREATION', 0, 1),
(4, 'Interest', 'The main interest', 20.00, 'PERCENTAGE', 'CREATION', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_disburse_methods`
--

CREATE TABLE `o_disburse_methods` (
  `uid` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `via_api` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_disburse_methods`
--

INSERT INTO `o_disburse_methods` (`uid`, `name`, `via_api`, `status`) VALUES
(1, 'Cash', 0, 1),
(2, 'Mpesa', 1, 1),
(3, 'EFT', 0, 1),
(4, 'Cheque', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_documents`
--

CREATE TABLE `o_documents` (
  `uid` int(10) NOT NULL,
  `code_name` varchar(50) NOT NULL COMMENT 'An easy way to identify documents e.g. NATIONAL_ID',
  `title` varchar(75) NOT NULL,
  `description` varchar(250) NOT NULL,
  `category` int(10) NOT NULL,
  `added_by` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  `tbl` varchar(50) NOT NULL COMMENT 'Table it belongs to e.g. o_customers',
  `rec` int(10) NOT NULL COMMENT 'record it belongs to e.g. 56',
  `stored_address` varchar(250) NOT NULL COMMENT 'Localtion in the server where image is stored',
  `status` int(1) NOT NULL COMMENT '0-unlinked, 1-available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_documents`
--

INSERT INTO `o_documents` (`uid`, `code_name`, `title`, `description`, `category`, `added_by`, `added_date`, `tbl`, `rec`, `stored_address`, `status`) VALUES
(1, '', 'Jonah', 'The Qui', 1, 1, '2021-05-19 06:37:21', 'o_customers', 1, 'r3CTl4vhtj.jpg', 1),
(2, '', 'ID Number', 'This is ID                                ', 2, 1, '2021-05-20 18:38:15', 'o_customers', 1, 'mlce9jXIvD.jpg', 1),
(3, '', 'Water', 'The water                 ', 1, 1, '2021-05-20 18:56:42', 'o_customers', 1, '3LZT8PPU2t.jpg', 1),
(4, '', 'National ID Back', '                                        ', 3, 1, '2021-05-20 19:30:55', 'o_customers', 1, 'GzTX7W26lG.jpg', 1),
(5, '', 'TV', 'hhyh      ', 1, 1, '2021-05-20 19:39:50', 'o_documents', 0, 'aGOug58dGs.jpg', 1),
(6, '', 'Hods', '123bluegdd', 2, 1, '2021-05-20 19:41:56', 'o_customers', 3, 'LltuG0zBod.JPG', 1),
(7, '', 'Passport', 'This is passport', 1, 1, '2021-06-08 04:46:27', 'o_customers', 3, '7UpkJa8zGa.jpg', 1),
(8, '', 'Upload', 'eheh', 1, 1, '2021-06-08 05:06:58', 'o_customers', 3, 'xx6UThED42.jpg', 1),
(9, '', 'ID Number', 'The', 3, 1, '2021-06-08 05:22:09', 'o_customers', 3, 'IYvpCeIk63.JPG', 1),
(10, '', 'ID Number', 'iid', 2, 1, '2021-06-08 05:24:17', 'o_customers', 3, 'eSQG4GPYML.JPG', 1),
(11, '', 'TV', 'hhss', 2, 1, '2021-06-08 05:29:53', 'o_customers', 3, '31k0GOUF3n.jpg', 1),
(12, '', 'ID Number', 'jdhdhd', 1, 1, '2021-06-08 05:30:57', 'o_customers', 3, 'USGvXBQ5Zy.jpg', 1),
(13, '', 'djdj', 'jsjs', 1, 1, '2021-06-08 05:33:05', 'o_customers', 3, 'g4QmlhKWVE.jpg', 1),
(14, '', 'ID Number', 'hhhhh', 1, 1, '2021-06-08 05:43:12', 'o_customers', 3, 'Ne82iKgOcvgotqxxX9gcNHPA2.jpg', 1),
(15, '', 'Passport', 'vv', 1, 1, '2021-06-08 05:44:52', 'o_customers', 2, 'nNfmj818WYIIQgtDCJqG2jw2L.jpg', 1),
(16, '', 'hhh', '', 1, 1, '2021-06-08 05:47:06', 'o_customers', 3, 'b4wopSVzXmc3Y4NO5TKHXY93R.jpg', 1),
(17, '', 'ID Number', 'hhhhh', 1, 1, '2021-06-08 05:47:55', 'o_customers', 3, 'Dl4btvRNnZYmbw27cOwHdl88n.jpg', 1),
(18, '', 'Passport', 'jdjd', 1, 1, '2021-06-08 19:15:03', 'o_customers', 4, 'aaujwG5QL23hNnGedItscoKqk.jpg', 1),
(19, '', 'Passport', 'nnn', 3, 1, '2021-06-08 23:58:37', 'o_customers', 10, 'CuX5NKPcA08DBGyOCfGwjFajV.jpeg', 1),
(20, '', 'jjj', 'jjj', 1, 1, '2021-06-09 00:01:43', 'o_customers', 10, '5J9Z3z83fcWpX3xRq5Fl6MVzq.png', 1),
(21, '', 'Passport', 'This is a passport', 2, 1, '2021-06-12 09:07:48', 'o_customers', 11, '9EBiOL5RMzMrRq66zYoP0YYb6.jpg', 0),
(22, '', 'ID Number', 'hydyd', 3, 1, '2021-06-12 09:18:31', 'o_customers', 11, 'tLrMtokJHfj459knao01geFN6.jpg', 0),
(23, '', 'TV', 'dhhddh', 1, 1, '2021-06-12 09:19:05', 'o_customers', 11, 'oM2j7ataeL9mSGxEiJgwXbvII.png', 0),
(24, '', 'Signature', 'The Quick Brown Fox', 2, 1, '2021-06-12 18:29:52', 'o_customers', 11, '2bbtuD0JUtPFm8SlT6HKwkvMw.jpg', 0),
(25, '', 'Passport', 'kkdkd', 2, 1, '2021-06-12 19:59:33', 'o_customers', 11, 'JRmLuZR4Y98pX6VGD2jfiUV31.jpg', 0),
(26, '', 'TV', 'TV', 2, 1, '2021-06-12 19:59:58', 'o_customers', 11, 'o0xrsHJvPeL9UhWAvmFW9nF4u.jpg', 0),
(27, '', 'Passport', 'The quick brown', 1, 1, '2021-06-15 02:38:00', 'o_customers', 11, 'pXiCIWJqsOZdWGMTflLjijYx6.jpg', 0),
(28, '', 'nbgggg', 'jhgg', 1, 1, '2021-07-07 14:56:31', 'o_customers', 11, 'urMYED1HgShyoVss0oD356Ygn.jpeg', 0),
(29, '', 'National ID', 'Front Side', 2, 1, '2021-07-31 12:39:35', 'o_customers', 12, 'dXqKOkjaHEKRZTHh1EgAw4P6R.jpg', 0),
(30, '', 'National ID', 'Front View', 2, 1, '2021-07-31 12:49:47', 'o_customers', 12, 'HrgwenpNkCal2gmBvEfnEuv3K.jpg', 0),
(31, '', 'National ID', 'Front View', 2, 1, '2021-07-31 14:09:11', 'o_customers', 12, 'jPQheSMOtvvbVS1MFdgjEqbUB.jpg', 0),
(32, '', 'Passport', 'Passport Photo size', 1, 1, '2021-07-31 14:11:40', 'o_customers', 12, 'fx97fyf83YxEcqEcMzCZBNDQZ.jpg', 0),
(33, '', 'National ID', 'wergh', 1, 1, '2021-07-31 14:18:57', 'o_customers', 12, 'VjIISHPyNy6ADelYcJM5lcVJF.jpg', 0),
(34, '', 'Photo', '', 1, 1, '2021-07-31 14:20:40', 'o_customers', 12, 'MoqlfgGI3ouR6GCNh4w1XatnF.jpg', 0),
(35, '', 'Photo', 'sdfghjk', 1, 1, '2021-07-31 14:46:54', 'o_customers', 12, '3NKFh3poOcLpcx5Nol499ifKo.jpg', 0),
(36, '', 'Passport', 'dfghjk', 3, 1, '2021-07-31 14:47:30', 'o_customers', 12, 'IdeJpSN321fDEsCwxXmrTcaMJ.jpg', 0),
(37, '', 'Passport', 'Photo Jpeg', 1, 1, '2021-07-31 14:54:48', 'o_customers', 12, 'JAxJXAy8gXM5dnTwatd7Rh0E8.jpg', 0),
(38, '', 'National ID', 'Front View', 2, 1, '2021-07-31 15:22:51', 'o_customers', 12, 'hvuVuUxvxFt0bglvNkyLAgtxL.jpg', 0),
(39, '', 'National ID', 'Back View', 3, 1, '2021-07-31 15:23:50', 'o_customers', 12, '6AsNej2XUk7XwhxzQgVkVrXGS.jpg', 0),
(40, '', 'Test', 'photo', 1, 1, '2021-08-07 16:18:38', 'o_customers', 12, '8P6ru56ny65v0GEVAnB6kKTaH.jpg', 0),
(41, '', 'Photo', 'id', 3, 1, '2021-08-07 16:19:46', 'o_customers', 12, 'aXtOi99O2WjJNiEL98JDUcKdB.jpg', 0),
(42, '', 'photo ', '', 1, 51, '2021-08-16 20:55:16', 'o_customers', 17, 'sgJRwiVuF5oDXPs6w7x32g706.jpg', 0),
(43, '', 'photo ', '', 1, 51, '2021-08-16 20:57:04', 'o_customers', 17, 'tpCW2d9cu0gZujqrs8uqcEJ2M.jpg', 0),
(44, '', 'photo ', '', 1, 51, '2021-08-16 21:03:08', 'o_customers', 17, 'ip6ocHtURVAdNmBd0IgLdBMiZ.png', 1),
(45, '', 'Passport', '', 1, 51, '2021-08-16 21:11:04', 'o_customers', 17, 'Xyhm91FNlV0ej7yEjg1z9UQae.png', 1),
(46, '', 'Passport', '', 1, 51, '2021-08-16 21:11:30', 'o_customers', 17, 'FQcxRtEi7NvBXZwA8LzmHGg4M.jpg', 1),
(47, '', 'photo ', '', 1, 51, '2021-08-16 21:34:05', 'o_customers', 16, 'jENfgTyHGPMEpPfQPcY5SziMH.png', 1),
(48, '', 'photo ', '', 1, 51, '2021-08-16 21:34:49', 'o_customers', 15, 'oKIPQSRem9SUBGwdEoF8gZKUY.png', 1),
(49, '', 'photo ', '', 1, 51, '2021-08-16 21:35:42', 'o_customers', 14, 'hi9sgO9D2p4OsPDJWkemNhwZU.png', 1),
(50, '', 'photo ', '', 1, 51, '2021-08-16 21:36:40', 'o_customers', 13, 'eFyLOIR0tODTP6TwPRAhtBNzP.jpg', 1),
(51, '', 'photo ', '', 1, 51, '2021-08-16 21:38:14', 'o_customers', 11, 'Qu5mPyDOUX3pazcAB7qLpdl9P.jpg', 1),
(52, '', 'photo ', 'passport', 1, 51, '2021-08-17 21:11:40', 'o_customers', 18, 'XHZLPt29RKQgLL2ebEYOI5xj1.png', 0),
(53, '', 'photo ', '', 1, 51, '2021-08-30 10:45:00', 'o_customers', 12, 'HE1JMEnPWRzmjYxnLlzhalwt0.jpg', 1),
(54, '', 'photo ', '', 1, 51, '2021-08-31 10:57:35', 'o_customers', 18, 'bMC2MHakuHIqlTbdNzvnYSrv4.png', 0),
(55, '', 'photo ', '', 1, 51, '2021-08-31 11:07:14', 'o_customers', 18, 'ZvVMMtuUt2BjdzCOMFv92TNVl.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_events`
--

CREATE TABLE `o_events` (
  `uid` int(20) NOT NULL,
  `tbl` varchar(30) NOT NULL,
  `fld` int(10) NOT NULL,
  `event_details` varchar(250) NOT NULL,
  `event_date` datetime NOT NULL,
  `event_by` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Store change occurrences';

--
-- Dumping data for table `o_events`
--

INSERT INTO `o_events` (`uid`, `tbl`, `fld`, `event_details`, `event_date`, `event_by`, `status`) VALUES
(1, 'o_customers', 10, 'Customer updated at [2021-06-09 11:23:48] by [Jonah Ngarama{1}root]', '2021-06-09 11:23:48', 1, 1),
(2, 'o_customers', 10, 'Customer updated at [2021-06-09 11:25:02] by [Jonah Ngarama{1}root]', '2021-06-09 11:25:02', 1, 1),
(3, 'o_customers', 10, 'Customer updated at [2021-06-09 11:25:20] by [Jonah Ngarama{1}root]', '2021-06-09 11:25:20', 1, 1),
(4, 'o_customers', 14531, 'Customer created at [2021-06-09 11:45:29] by [Jonah Ngarama{1}root]', '2021-06-09 11:45:29', 1, 1),
(5, 'o_customers', 11, 'Customer updated at [2021-06-09 17:54:20] by [Jonah Ngarama{1}root]', '2021-06-09 17:54:20', 1, 1),
(6, 'o_customers', 11, 'Customer updated at [2021-06-10 10:17:41] by [Jonah Ngarama{1}root]', '2021-06-10 10:17:41', 1, 1),
(7, 'o_customers', 9, 'Customer updated at [2021-06-10 10:20:27] by [Jonah Ngarama{1}root]', '2021-06-10 10:20:27', 1, 1),
(8, 'o_loans', 3, 'Loan moved to the next stage[Final Stage (Disburse)] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-16 18:49:32] with comment [moved]', '2021-06-16 18:49:32', 1, 1),
(9, 'o_loans', 3, 'Loan moved to the next stage[Line Manager Approval] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-16 18:50:06] with comment [final]', '2021-06-16 18:50:06', 1, 1),
(10, 'o_loans', 1, 'Loan moved to the next stage[Approval Level1] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-16 21:42:15] with comment [<i>Hello</i>]', '2021-06-16 21:42:15', 1, 1),
(11, 'o_loans', 1, 'Loan moved to the next stage[Approval Level2] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-16 21:42:28] with comment [<i>Held</i>]', '2021-06-16 21:42:28', 1, 1),
(12, 'o_loans', 1, 'Loan moved to the next stage[Final Stage (Disburse)] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-16 21:42:39] with comment [<i>djdjd</i>]', '2021-06-16 21:42:39', 1, 1),
(13, 'o_loans', 1, 'Loan moved to the next stage[Line Manager Approval] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-16 21:42:47] with comment [<i>oeoe</i>]', '2021-06-16 21:42:47', 1, 1),
(14, 'o_customers', 11, 'Customer updated at [2021-06-21 07:03:15] by [jonah ngarama{22}root]', '2021-06-21 07:03:15', 22, 1),
(15, 'o_loans', 4, 'Loan status changed to  () by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 00:28:44] with comment [<i></i>]', '2021-06-22 00:28:44', 1, 1),
(16, 'o_loans', 3, 'Loan status changed to  () by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 00:38:51] with comment [<i></i>]', '2021-06-22 00:38:51', 1, 1),
(17, 'o_loans', 2, 'Loan status changed to  () by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 00:39:15] with comment [<i></i>]', '2021-06-22 00:39:15', 1, 1),
(18, 'o_loans', 1, 'Loan status changed to  () by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 00:41:20] with comment [<i></i>]', '2021-06-22 00:41:20', 1, 1),
(19, 'o_loans', 8, 'Loan status changed to  () by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 01:02:39] with comment [<i></i>]', '2021-06-22 01:02:39', 1, 1),
(20, 'o_loans', 9, 'Loan moved to the next stage[Approval Level1] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 01:03:31] with comment [<i>This is approved</i>]', '2021-06-22 01:03:31', 1, 1),
(21, 'o_loans', 9, 'Loan moved to the next stage[Approval Level2] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 01:03:53] with comment [<i>This is app</i>]', '2021-06-22 01:03:53', 1, 1),
(22, 'o_loans', 9, 'Loan moved to the next stage[Final Stage (Disburse)] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 01:04:24] with comment [<i></i>]', '2021-06-22 01:04:24', 1, 1),
(23, 'o_loans', 9, 'Loan moved to the next stage[Line Manager Approval] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 01:04:30] with comment [<i></i>]', '2021-06-22 01:04:30', 1, 1),
(24, 'o_loans', 9, 'Loan moved to disbursement by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-22 01:04:45] with comment [<i></i>]', '2021-06-22 01:04:45', 1, 1),
(25, 'o_loans', 10, 'Loan moved to the next stage[Approval Level1] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-23 01:26:42] with comment [<i></i>]', '2021-06-23 01:26:42', 1, 1),
(26, 'o_loans', 10, 'Loan moved to the next stage[Approval Level2] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-23 01:26:59] with comment [<i></i>]', '2021-06-23 01:26:59', 1, 1),
(27, 'o_loans', 10, 'Loan moved to the next stage[Final Stage (Disburse)] by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-23 01:27:36] with comment [<i></i>]', '2021-06-23 01:27:36', 1, 1),
(28, 'o_loans', 10, 'Loan moved to disbursement by [Jonah Ngarama(ngaramajonah@gmail.com)] on [2021-06-23 01:27:49] with comment [<i></i>]', '2021-06-23 01:27:49', 1, 1),
(29, 'o_customers', 10, 'Customer updated at [2021-07-11 21:06:43] by [Jonah Ngarama{1}root]', '2021-07-11 21:06:43', 1, 1),
(30, 'o_customers', 12, 'Customer created at [2021-07-12 11:11:28] by [Samuel Munyi{51}root]', '2021-07-12 11:11:28', 51, 1),
(31, 'o_loans', 11, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-12 11:25:40] with comment [<i></i>]', '2021-07-12 11:25:40', 51, 1),
(32, 'o_loans', 11, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-12 11:25:49] with comment [<i></i>]', '2021-07-12 11:25:49', 51, 1),
(33, 'o_loans', 11, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-12 11:25:56] with comment [<i></i>]', '2021-07-12 11:25:56', 51, 1),
(34, 'o_loans', 11, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-12 11:26:10] with comment [<i></i>]', '2021-07-12 11:26:10', 51, 1),
(35, 'o_customers', 12, 'Customer updated at [2021-07-13 10:24:44] by [Samuel Munyi{51}root]', '2021-07-13 10:24:44', 51, 1),
(36, 'o_customers', 4, 'Customer updated at [2021-07-13 10:26:58] by [Samuel Munyi{51}root]', '2021-07-13 10:26:58', 51, 1),
(37, 'o_loans', 12, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:32:22] with comment [<i></i>]', '2021-07-13 10:32:22', 51, 1),
(38, 'o_loans', 13, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:33:46] with comment [<i></i>]', '2021-07-13 10:33:46', 51, 1),
(39, 'o_loans', 13, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:33:55] with comment [<i></i>]', '2021-07-13 10:33:55', 51, 1),
(40, 'o_loans', 13, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:33:59] with comment [<i></i>]', '2021-07-13 10:33:59', 51, 1),
(41, 'o_loans', 13, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:34:03] with comment [<i></i>]', '2021-07-13 10:34:03', 51, 1),
(42, 'o_loans', 13, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:34:04] with comment [<i></i>]', '2021-07-13 10:34:04', 51, 1),
(43, 'o_loans', 13, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-13 10:36:54] with comment [<i></i>]', '2021-07-13 10:36:54', 51, 1),
(44, 'o_customers', 17173, 'Customer created at [2021-07-14 11:24:05] by [Samuel Munyi{51}root]', '2021-07-14 11:24:05', 51, 1),
(45, 'o_customers', 13, 'Customer updated at [2021-07-14 11:30:24] by [Samuel Munyi{51}root]', '2021-07-14 11:30:24', 51, 1),
(46, 'o_customers', 18494, 'Customer created at [2021-07-19 09:23:44] by [Samuel Munyi{51}root]', '2021-07-19 09:23:44', 51, 1),
(47, 'o_customers', 19815, 'Customer created at [2021-07-19 09:26:04] by [Samuel Munyi{51}root]', '2021-07-19 09:26:04', 51, 1),
(48, 'o_loans', 14, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-20 20:55:46] with comment [<i></i>]', '2021-07-20 20:55:46', 51, 1),
(49, 'o_loans', 14, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-20 20:55:51] with comment [<i></i>]', '2021-07-20 20:55:51', 51, 1),
(50, 'o_loans', 14, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-20 20:55:55] with comment [<i></i>]', '2021-07-20 20:55:55', 51, 1),
(51, 'o_loans', 14, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-20 20:56:04] with comment [<i></i>]', '2021-07-20 20:56:04', 51, 1),
(52, 'o_loans', 14, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-07-20 21:13:46] with comment [<i></i>]', '2021-07-20 21:13:46', 51, 1),
(53, 'o_customers', 13, 'Customer updated at [2021-07-21 21:35:16] by [Samuel Munyi{51}root]', '2021-07-21 21:35:16', 51, 1),
(54, 'o_customers', 13, 'Customer updated at [2021-07-21 21:35:16] by [Samuel Munyi{51}root]', '2021-07-21 21:35:16', 51, 1),
(55, 'o_customers', 15, 'Customer updated at [2021-07-23 09:07:26] by [Samuel Munyi{51}root]', '2021-07-23 09:07:26', 51, 1),
(56, 'o_customers', 16, 'Customer created at [2021-07-26 12:39:58] by [Samuel Munyi{51}root]', '2021-07-26 12:39:58', 51, 1),
(57, 'o_customers', 12, 'Customer updated at [2021-08-02 16:19:11] by [Samuel Munyi{51}root]', '2021-08-02 16:19:11', 51, 1),
(58, 'o_customers', 13, 'Customer updated at [2021-08-04 15:42:40] by [Samuel Munyi{51}root]', '2021-08-04 15:42:40', 51, 1),
(59, 'o_customers', 4, 'Customer updated at [2021-08-06 16:51:15] by [Samuel Munyi{51}root]', '2021-08-06 16:51:15', 51, 1),
(60, 'o_customers', 9, 'Customer updated at [2021-08-07 15:58:00] by [Samuel Munyi{51}root]', '2021-08-07 15:58:00', 51, 1),
(61, 'o_customers', 9, 'Customer updated at [2021-08-07 15:58:36] by [Samuel Munyi{51}root]', '2021-08-07 15:58:36', 51, 1),
(62, 'o_customers', 9, 'Customer updated at [2021-08-07 15:59:15] by [Samuel Munyi{51}root]', '2021-08-07 15:59:15', 51, 1),
(63, 'o_customers', 9, 'Customer updated at [2021-08-07 16:00:00] by [Samuel Munyi{51}root]', '2021-08-07 16:00:00', 51, 1),
(64, 'o_customers', 9, 'Customer updated at [2021-08-07 16:00:56] by [Samuel Munyi{51}root]', '2021-08-07 16:00:56', 51, 1),
(65, 'o_customers', 9, 'Customer updated at [2021-08-07 16:01:30] by [Samuel Munyi{51}root]', '2021-08-07 16:01:30', 51, 1),
(66, 'o_customers', 9, 'Customer updated at [2021-08-07 16:02:23] by [Samuel Munyi{51}root]', '2021-08-07 16:02:23', 51, 1),
(67, 'o_loans', 19, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-07 16:03:53] with comment [<i></i>]', '2021-08-07 16:03:53', 51, 1),
(68, 'o_loans', 19, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-07 16:03:57] with comment [<i></i>]', '2021-08-07 16:03:57', 51, 1),
(69, 'o_loans', 19, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-07 16:04:00] with comment [<i></i>]', '2021-08-07 16:04:00', 51, 1),
(70, 'o_loans', 19, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-07 16:04:10] with comment [<i></i>]', '2021-08-07 16:04:10', 51, 1),
(71, 'o_customers', 13, 'Customer updated at [2021-08-08 16:15:45] by [Samuel Munyi{51}root]', '2021-08-08 16:15:45', 51, 1),
(72, 'o_loans', 18, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:43:38] with comment [<i></i>]', '2021-08-08 16:43:38', 51, 1),
(73, 'o_loans', 18, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:43:38] with comment [<i></i>]', '2021-08-08 16:43:38', 51, 1),
(74, 'o_loans', 18, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:43:40] with comment [<i></i>]', '2021-08-08 16:43:40', 51, 1),
(75, 'o_loans', 18, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:44:00] with comment [<i></i>]', '2021-08-08 16:44:00', 51, 1),
(76, 'o_loans', 17, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:44:22] with comment [<i></i>]', '2021-08-08 16:44:22', 51, 1),
(77, 'o_loans', 17, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:44:30] with comment [<i></i>]', '2021-08-08 16:44:30', 51, 1),
(78, 'o_loans', 17, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:44:35] with comment [<i></i>]', '2021-08-08 16:44:35', 51, 1),
(79, 'o_loans', 17, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:44:43] with comment [<i></i>]', '2021-08-08 16:44:43', 51, 1),
(80, 'o_loans', 16, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:45:57] with comment [<i></i>]', '2021-08-08 16:45:57', 51, 1),
(81, 'o_loans', 16, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:46:00] with comment [<i></i>]', '2021-08-08 16:46:00', 51, 1),
(82, 'o_loans', 16, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:46:01] with comment [<i></i>]', '2021-08-08 16:46:01', 51, 1),
(83, 'o_loans', 16, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:46:20] with comment [<i></i>]', '2021-08-08 16:46:20', 51, 1),
(84, 'o_loans', 15, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:46:40] with comment [<i></i>]', '2021-08-08 16:46:40', 51, 1),
(85, 'o_loans', 15, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:46:47] with comment [<i></i>]', '2021-08-08 16:46:47', 51, 1),
(86, 'o_loans', 15, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:46:54] with comment [<i></i>]', '2021-08-08 16:46:54', 51, 1),
(87, 'o_loans', 15, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-08 16:47:01] with comment [<i></i>]', '2021-08-08 16:47:01', 51, 1),
(88, 'o_loans', 19, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 10:28:35] with comment [<i></i>]', '2021-08-09 10:28:35', 51, 1),
(89, 'o_loans', 18, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 10:28:57] with comment [<i></i>]', '2021-08-09 10:28:57', 51, 1),
(90, 'o_loans', 20, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 10:31:55] with comment [<i></i>]', '2021-08-09 10:31:55', 51, 1),
(91, 'o_loans', 20, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 10:32:07] with comment [<i></i>]', '2021-08-09 10:32:07', 51, 1),
(92, 'o_loans', 20, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 10:32:15] with comment [<i></i>]', '2021-08-09 10:32:15', 51, 1),
(93, 'o_loans', 20, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 11:00:42] with comment [<i></i>]', '2021-08-09 11:00:42', 51, 1),
(94, 'o_loans', 19, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 14:35:24] with comment [<i></i>]', '2021-08-09 14:35:24', 51, 1),
(95, 'o_loans', 19, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 14:41:29] with comment [<i></i>]', '2021-08-09 14:41:29', 51, 1),
(96, 'o_loans', 19, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-09 14:49:55] with comment [<i></i>]', '2021-08-09 14:49:55', 51, 1),
(97, 'o_customers', 16, 'Customer updated at [2021-08-09 16:44:33] by [Samuel Munyi{51}root]', '2021-08-09 16:44:33', 51, 1),
(98, 'o_customers', 16, 'Customer updated at [2021-08-09 16:45:02] by [Samuel Munyi{51}root]', '2021-08-09 16:45:02', 51, 1),
(99, 'o_customers', 16, 'Customer updated at [2021-08-09 17:31:03] by [Samuel Munyi{51}root]', '2021-08-09 17:31:03', 51, 1),
(100, 'o_customers', 17, 'Customer created at [2021-08-09 18:07:46] by [Samuel Munyi{51}root]', '2021-08-09 18:07:46', 51, 1),
(101, 'o_customers', 17, 'Customer updated at [2021-08-09 18:12:24] by [Samuel Munyi{51}root]', '2021-08-09 18:12:24', 51, 1),
(102, 'o_customers', 17, 'Customer updated at [2021-08-09 18:14:59] by [Samuel Munyi{51}root]', '2021-08-09 18:14:59', 51, 1),
(103, 'o_customers', 17, 'Customer updated at [2021-08-09 18:14:59] by [Samuel Munyi{51}root]', '2021-08-09 18:14:59', 51, 1),
(104, 'o_customers', 17, 'Customer updated at [2021-08-10 08:18:53] by [Samuel Munyi{51}root]', '2021-08-10 08:18:53', 51, 1),
(105, 'o_customers', 17, 'Customer updated at [2021-08-10 08:20:54] by [Samuel Munyi{51}root]', '2021-08-10 08:20:54', 51, 1),
(106, 'o_loans', 21, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-10 08:21:18] with comment [<i></i>]', '2021-08-10 08:21:18', 51, 1),
(107, 'o_customers', 17, 'Customer updated at [2021-08-10 08:21:53] by [Samuel Munyi{51}root]', '2021-08-10 08:21:53', 51, 1),
(108, 'o_campaign_messages', 8, 'Campaign message updated at [2021-08-11 22:08:30] by [{}root]', '2021-08-11 22:08:30', 0, 1),
(109, 'o_campaign_messages', 6, 'Campaign message updated at [2021-08-11 22:10:57] by [{}root]', '2021-08-11 22:10:57', 0, 1),
(110, 'o_campaign_messages', 6, 'Campaign message updated at [2021-08-11 22:11:39] by [{}root]', '2021-08-11 22:11:39', 0, 1),
(111, 'o_campaign_messages', 6, 'Campaign message updated at [2021-08-11 22:13:48] by [{}root]', '2021-08-11 22:13:48', 0, 1),
(112, 'o_campaign_messages', 6, 'Campaign message updated at [2021-08-11 22:13:58] by [{}root]', '2021-08-11 22:13:58', 0, 1),
(113, 'o_campaign_messages', 6, 'Campaign message updated at [2021-08-11 22:33:06] by [{}root]', '2021-08-11 22:33:06', 0, 1),
(114, 'o_campaign_messages', 9, 'Campaign message updated at [2021-08-11 22:44:26] by [{}root]', '2021-08-11 22:44:26', 0, 1),
(115, 'o_campaign_messages', 9, 'Campaign message updated at [2021-08-11 22:44:41] by [{}root]', '2021-08-11 22:44:41', 0, 1),
(116, 'o_campaign_messages', 12, 'Campaign message updated at [2021-08-12 16:03:15] by [{}root]', '2021-08-12 16:03:15', 0, 1),
(117, 'o_customers', 15, 'Customer updated at [2021-08-12 21:23:54] by [Samuel Munyi{51}root]', '2021-08-12 21:23:54', 51, 1),
(118, 'o_customers', 15, 'Customer updated at [2021-08-12 21:26:50] by [Samuel Munyi{51}root]', '2021-08-12 21:26:50', 51, 1),
(119, 'o_campaign_messages', 12, 'Campaign message updated at [2021-08-13 08:46:14] by [Samuel Munyi{51}root]', '2021-08-13 08:46:14', 51, 1),
(120, 'o_campaign_messages', 12, 'Campaign message updated at [2021-08-13 09:45:48] by [Samuel Munyi{51}root]', '2021-08-13 09:45:48', 51, 1),
(121, 'platform_settings', 1, '', '2021-08-13 23:16:08', 51, 1),
(122, 'platform_settings', 1, 'Settings updated at [2021-08-13 23:26:22] by [Samuel Munyi{51}root]', '2021-08-13 23:26:22', 51, 1),
(123, 'platform_settings', 1, 'Settings updated at [2021-08-13 23:27:04] by [Samuel Munyi{51}root]', '2021-08-13 23:27:04', 51, 1),
(124, 'platform_settings', 1, 'Settings updated at [2021-08-13 23:27:45] by [Samuel Munyi{51}root]', '2021-08-13 23:27:45', 51, 1),
(125, 'platform_settings', 1, 'Settings updated at [2021-08-13 23:30:07] by [Samuel Munyi{51}root]', '2021-08-13 23:30:07', 51, 1),
(126, 'platform_settings', 1, 'Settings updated at [2021-08-13 23:46:33] by [Samuel Munyi{51}root]', '2021-08-13 23:46:33', 51, 1),
(127, 'platform_settings', 1, 'Settings updated at [2021-08-13 23:49:42] by [Samuel Munyi{51}root]', '2021-08-13 23:49:42', 51, 1),
(128, 'platform_settings', 1, 'Settings updated at [2021-08-14 08:21:09] by [Samuel Munyi{51}root]', '2021-08-14 08:21:09', 51, 1),
(129, 'platform_settings', 1, 'Settings updated at [2021-08-14 08:35:30] by [Samuel Munyi{51}root]', '2021-08-14 08:35:30', 51, 1),
(130, 'platform_settings', 1, 'Settings updated at [2021-08-14 08:48:57] by [Samuel Munyi{51}root]', '2021-08-14 08:48:57', 51, 1),
(131, 'platform_settings', 1, 'Settings updated at [2021-08-14 08:50:59] by [Samuel Munyi{51}root]', '2021-08-14 08:50:59', 51, 1),
(132, 'platform_settings', 1, 'Settings updated at [2021-08-14 08:56:50] by [Samuel Munyi{51}root]', '2021-08-14 08:56:50', 51, 1),
(133, 'platform_settings', 1, 'Settings updated at [2021-08-14 08:59:31] by [Samuel Munyi{51}root]', '2021-08-14 08:59:31', 51, 1),
(134, 'platform_settings', 1, 'Settings updated at [2021-08-14 09:10:14] by [Samuel Munyi{51}root]', '2021-08-14 09:10:14', 51, 1),
(135, 'platform_settings', 1, 'Settings updated at [2021-08-14 09:11:55] by [Samuel Munyi{51}root]', '2021-08-14 09:11:55', 51, 1),
(136, 'platform_settings', 1, 'Settings updated at [2021-08-14 09:12:15] by [Samuel Munyi{51}root]', '2021-08-14 09:12:15', 51, 1),
(137, 'platform_settings', 1, 'Settings updated at [2021-08-14 09:21:55] by [Samuel Munyi{51}root]', '2021-08-14 09:21:55', 51, 1),
(138, 'platform_settings', 1, 'Settings updated at [2021-08-14 09:23:20] by [Samuel Munyi{51}root]', '2021-08-14 09:23:20', 51, 1),
(139, 'platform_settings', 1, 'Settings updated at [2021-08-14 09:32:02] by [Samuel Munyi{51}root]', '2021-08-14 09:32:02', 51, 1),
(140, 'platform_settings', 1, 'Settings updated at [2021-08-14 15:05:17] by [Samuel Munyi{51}root]', '2021-08-14 15:05:17', 51, 1),
(141, 'platform_settings', 1, 'Settings updated at [2021-08-14 15:05:36] by [Samuel Munyi{51}root]', '2021-08-14 15:05:36', 51, 1),
(142, 'o_campaign_messages', 9, 'Campaign message updated at [2021-08-14 15:25:45] by [Samuel Munyi{51}root]', '2021-08-14 15:25:45', 51, 1),
(143, 'platform_settings', 1, 'Settings updated at [2021-08-15 10:50:33] by [Samuel Munyi{51}root]', '2021-08-15 10:50:33', 51, 1),
(144, 'platform_settings', 1, 'Settings updated at [2021-08-15 12:06:10] by [Samuel Munyi{51}root]', '2021-08-15 12:06:10', 51, 1),
(145, 'platform_settings', 1, 'Settings updated at [2021-08-15 18:05:07] by [Samuel Munyi{51}root]', '2021-08-15 18:05:07', 51, 1),
(146, 'platform_settings', 1, 'Settings updated at [2021-08-16 17:06:23] by [Samuel Munyi{51}root]', '2021-08-16 17:06:23', 51, 1),
(147, 'platform_settings', 1, 'Settings updated at [2021-08-16 17:06:23] by [Samuel Munyi{51}root]', '2021-08-16 17:06:23', 51, 1),
(148, 'platform_settings', 1, 'Settings updated at [2021-08-16 17:07:26] by [Samuel Munyi{51}root]', '2021-08-16 17:07:26', 51, 1),
(149, 'platform_settings', 1, 'Settings updated at [2021-08-16 19:39:42] by [Samuel Munyi{51}root]', '2021-08-16 19:39:42', 51, 1),
(150, 'platform_settings', 1, 'Settings updated at [2021-08-16 19:43:54] by [Samuel Munyi{51}root]', '2021-08-16 19:43:54', 51, 1),
(151, 'platform_settings', 1, 'Settings updated at [2021-08-16 21:15:00] by [Samuel Munyi{51}root]', '2021-08-16 21:15:00', 51, 1),
(152, 'platform_settings', 1, 'Settings updated at [2021-08-16 21:15:50] by [Samuel Munyi{51}root]', '2021-08-16 21:15:50', 51, 1),
(153, 'o_customers', 14, 'Customer updated at [2021-08-16 21:35:20] by [Samuel Munyi{51}root]', '2021-08-16 21:35:20', 51, 1),
(154, 'platform_settings', 1, 'Settings updated at [2021-08-16 21:40:17] by [Samuel Munyi{51}root]', '2021-08-16 21:40:17', 51, 1),
(155, 'platform_settings', 1, 'Settings updated at [2021-08-16 21:41:40] by [Samuel Munyi{51}root]', '2021-08-16 21:41:40', 51, 1),
(156, 'platform_settings', 1, 'Settings updated at [2021-08-16 21:43:38] by [Samuel Munyi{51}root]', '2021-08-16 21:43:38', 51, 1),
(157, 'o_customers', 14, 'Customer updated at [2021-08-17 08:43:04] by [Samuel Munyi{51}root]', '2021-08-17 08:43:04', 51, 1),
(158, 'o_loans', 22, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 11:03:56] with comment [<i></i>]', '2021-08-17 11:03:56', 51, 1),
(159, 'o_customers', 17, 'Customer updated at [2021-08-17 11:04:45] by [Samuel Munyi{51}root]', '2021-08-17 11:04:45', 51, 1),
(160, 'o_loans', 23, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 13:36:16] with comment [<i></i>]', '2021-08-17 13:36:16', 51, 1),
(161, 'o_loans', 24, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 13:39:07] with comment [<i></i>]', '2021-08-17 13:39:07', 51, 1),
(162, 'o_loans', 25, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 13:40:15] with comment [<i></i>]', '2021-08-17 13:40:15', 51, 1),
(163, 'o_loans', 25, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 13:40:18] with comment [<i></i>]', '2021-08-17 13:40:18', 51, 1),
(164, 'o_loans', 25, 'Loan moved to the next stage[Final Stage (Disburse)] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 13:40:22] with comment [<i></i>]', '2021-08-17 13:40:22', 51, 1),
(165, 'o_loans', 25, 'Loan moved to disbursement by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 13:40:28] with comment [<i></i>]', '2021-08-17 13:40:28', 51, 1),
(166, 'o_customers', 18, 'Customer created at [2021-08-17 21:10:17] by [Samuel Munyi{51}root]', '2021-08-17 21:10:17', 51, 1),
(167, 'o_customers', 18, 'Customer updated at [2021-08-17 21:12:13] by [Samuel Munyi{51}root]', '2021-08-17 21:12:13', 51, 1),
(168, 'o_loans', 26, 'Loan moved to the next stage[Approval Level1] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 21:25:34] with comment [<i></i>]', '2021-08-17 21:25:34', 51, 1),
(169, 'o_loans', 26, 'Loan moved to the next stage[Approval Level2] by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-17 21:25:34] with comment [<i></i>]', '2021-08-17 21:25:34', 51, 1),
(170, 'o_loans', 9, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-18 15:41:51] with comment [<i></i>]', '2021-08-18 15:41:51', 51, 1),
(171, 'o_loans', 26, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-18 15:45:46] with comment [<i></i>]', '2021-08-18 15:45:46', 51, 1),
(172, 'o_loans', 26, 'Loan status changed to  () by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-18 16:19:52] with comment [<i></i>]', '2021-08-18 16:19:52', 51, 1),
(173, 'o_loans', 26, 'Loan status changed to 6 (Rejected) by [Samuel Munyi(munyisamuel3@gmail.com)] on [2021-08-18 16:29:48] with comment [<i></i>]', '2021-08-18 16:29:48', 51, 1),
(174, 'platform_settings', 1, 'Settings updated at [2021-08-24 17:31:17] by [Samuel Munyi{51}root]', '2021-08-24 17:31:17', 51, 1),
(175, 'platform_settings', 1, 'Settings updated at [2021-08-24 17:31:35] by [Samuel Munyi{51}root]', '2021-08-24 17:31:35', 51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_flags`
--

CREATE TABLE `o_flags` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_flags`
--

INSERT INTO `o_flags` (`uid`, `name`, `description`, `color_code`, `status`) VALUES
(1, 'Missed Rapayments', 'This loan or account has missed a repayment', '#ffa500', 1),
(2, 'Not Contactable', 'The client can not be reached', '#FF0000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_guarantors`
--

CREATE TABLE `o_guarantors` (
  `uid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `national_id` varchar(15) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `amount_guaranteed` double(100,2) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `o_incoming_payments`
--

CREATE TABLE `o_incoming_payments` (
  `uid` int(20) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL DEFAULT '0',
  `payment_method` int(5) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `amount` double(50,2) NOT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `loan_id` int(20) NOT NULL,
  `loan_balance` double(8,2) NOT NULL DEFAULT '0.00',
  `payment_date` date NOT NULL,
  `recorded_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(10) NOT NULL,
  `record_method` varchar(20) NOT NULL COMMENT 'API, MANUAL',
  `comments` varchar(100) NOT NULL DEFAULT 'Repayment',
  `status` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_incoming_payments`
--

INSERT INTO `o_incoming_payments` (`uid`, `customer_id`, `branch_id`, `payment_method`, `mobile_number`, `amount`, `transaction_code`, `loan_id`, `loan_balance`, `payment_date`, `recorded_date`, `added_by`, `record_method`, `comments`, `status`) VALUES
(1, 0, 0, 2, '254716330450', 4600.00, 'QWERSTSSU', 9, 0.00, '2021-06-22', '0000-00-00 00:00:00', 0, 'MANUAL', '', 0),
(2, 3, 1, 2, '0716330451', 600.09, '765678765uu', 10, 0.00, '2021-06-21', '0000-00-00 00:00:00', 0, 'MANUAL', 'the motor', 1),
(3, 3, 1, 1, '0716330450', 600.00, '76655444', 10, 0.00, '2021-06-23', '0000-00-00 00:00:00', 0, 'MANUAL', 'Wjys', 1),
(4, 12, 2, 2, '0112553167', 30000.00, 'PH172ORFO5', 11, 0.00, '2021-08-01', '0000-00-00 00:00:00', 0, 'MANUAL', 'Partial Payment From Sam', 1),
(5, 12, 2, 3, '112553167', 5000.00, 'ISO20022', 11, 0.00, '2021-08-02', '0000-00-00 00:00:00', 0, 'MANUAL', 'bank payment', 1),
(6, 12, 2, 4, '0112553167', 2000.00, 'N/A', 11, 0.00, '2021-08-02', '0000-00-00 00:00:00', 0, 'MANUAL', 'cash payment ', 1),
(7, 1, 1, 3, '254716330450', 2500.00, 'ISO20021', 9, 0.00, '2021-08-01', '0000-00-00 00:00:00', 0, 'MANUAL', 'Bank Payment', 0),
(8, 1, 1, 4, '254716330450', 2000.00, 'N/A', 9, 0.00, '2021-08-02', '0000-00-00 00:00:00', 0, 'MANUAL', 'Cash Payment', 0),
(9, 12, 2, 4, '254112553167', 1500.00, 'N/A', 11, 0.00, '2021-08-02', '0000-00-00 00:00:00', 0, 'MANUAL', 'Cash Payment', 1),
(10, 12, 2, 2, '0112553167', 500.00, 'RTUUGFGBVF', 11, 0.00, '2021-08-02', '0000-00-00 00:00:00', 0, 'MANUAL', 'Mobile Payment', 1),
(11, 12, 2, 4, '254112553167', 200.00, 'N/A', 11, 0.00, '2021-08-02', '2021-08-02 10:09:34', 0, 'MANUAL', 'Cash Payment', 1),
(12, 12, 2, 4, '254112553167', 100.00, 'N/A', 11, 0.00, '2021-08-01', '2021-08-02 10:11:01', 0, 'MANUAL', 'Cash Payment', 1),
(13, 12, 2, 4, '254112553167', 100.00, 'N/A', 11, 0.00, '2021-08-02', '2021-08-02 10:12:01', 0, 'MANUAL', 'Cash Payment ', 1),
(14, 12, 2, 4, '254112553167', 100.00, 'N/A', 11, 0.00, '2021-08-02', '2021-08-02 10:14:55', 0, 'MANUAL', 'Cash Payment', 1),
(15, 12, 2, 4, '254112553167', 100.00, 'N/A', 11, 0.00, '2021-08-02', '2021-08-02 10:15:42', 0, 'MANUAL', 'Cash Pay', 1),
(16, 12, 2, 4, '254112553167', 100.00, 'N/A', 11, 0.00, '2021-08-02', '2021-08-02 10:17:50', 0, 'MANUAL', 'Cash', 1),
(17, 1, 1, 4, '254716330450', 200.00, 'N/A', 9, 0.00, '2021-08-02', '2021-08-02 10:18:38', 0, 'MANUAL', 'Cash Payment', 0),
(18, 1, 1, 2, '254716330450', 100.00, 'FFGHJKKNB', 9, 0.00, '2021-08-02', '2021-08-02 10:19:25', 0, 'MANUAL', 'Mpesa Pay', 0),
(19, 1, 1, 4, '254716330450', 100.00, 'N/A', 9, 0.00, '2021-08-02', '2021-08-02 10:20:25', 0, 'MANUAL', 'Mobile Pay', 0),
(20, 1, 1, 2, '254716330450', 250.00, 'JGFUJHBNN', 9, 0.00, '2021-08-02', '2021-08-02 15:50:00', 0, 'MANUAL', 'M-pesa Payment', 0),
(21, 12, 2, 3, '0112553167', 100.00, 'ISO20020', 11, 0.00, '2021-08-03', '2021-08-03 09:07:37', 0, 'MANUAL', 'Bank Payment', 1),
(22, 11, 1, 2, '0112553167', 500.00, 'JHGFYUIJN', 16, 0.00, '2021-08-03', '2021-08-03 12:34:26', 0, 'MANUAL', 'Partial Pay Via MPESA', 1),
(23, 11, 1, 2, '0112553167', 500.00, 'FGHJKJHBV', 16, 0.00, '2021-08-03', '2021-08-03 18:08:08', 0, 'MANUAL', 'Partial Pay', 1),
(24, 12, 2, 2, '0112553167', 200.00, 'NBVCFGH', 11, 0.00, '2021-08-04', '2021-08-04 15:21:56', 0, 'MANUAL', 'Loan Payment Completed', 1),
(25, 12, 2, 2, '0112553167', 2000.00, 'VBJKJHGF', 11, 0.00, '2021-08-04', '2021-08-04 15:23:29', 0, 'MANUAL', 'Loan Payment In Exceeding Borrowed Amount', 1),
(26, 12, 2, 1, '712553167', 50.00, '23456789', 11, 0.00, '2021-08-04', '2021-08-06 15:13:28', 0, 'MANUAL', 'Repayment', 1),
(27, 11, 1, 1, '705609184', 500.00, '76543210', 16, 0.00, '2021-08-04', '2021-08-06 15:13:28', 0, 'MANUAL', 'Repayment', 1),
(28, 13, 2, 1, '112553789', 300.00, '34509876', 18, 0.00, '2021-08-04', '2021-08-06 15:13:28', 0, 'MANUAL', 'Repayment', 1),
(29, 12, 2, 3, '712553167', 50.00, 'N/A', 11, 0.00, '2006-08-21', '2021-08-06 16:05:12', 0, 'MANUAL', 'Repayment', 1),
(30, 11, 1, 2, '705609184', 500.00, 'HFGHNBVH', 16, 0.00, '2006-08-21', '2021-08-06 16:05:12', 0, 'MANUAL', 'Repayment', 1),
(31, 13, 2, 1, '112553789', 300.00, 'VBNMJGFH', 18, 0.00, '2006-08-21', '2021-08-06 16:05:13', 0, 'MANUAL', 'Repayment', 1),
(32, 12, 2, 3, '712553167', 50.00, 'N/A', 11, 0.00, '2021-08-06', '2021-08-06 16:15:34', 0, 'MANUAL', 'Repayment', 1),
(33, 11, 1, 2, '705609184', 500.00, 'HFGHNBVH', 16, 0.00, '2021-08-06', '2021-08-06 16:15:34', 0, 'MANUAL', 'Repayment', 1),
(34, 13, 2, 1, '112553789', 300.00, 'VBNMJGFH', 18, 0.00, '2021-08-06', '2021-08-06 16:15:34', 0, 'MANUAL', 'Repayment', 1),
(35, 12, 2, 3, '712553167', 50.00, 'N/A', 11, 0.00, '2021-08-06', '2021-08-06 16:23:10', 0, 'MANUAL', 'Repayment', 1),
(36, 11, 1, 2, '705609184', 500.00, 'HFGHNBVH', 16, 0.00, '2021-08-06', '2021-08-06 16:23:11', 0, 'MANUAL', 'Repayment', 1),
(37, 13, 2, 1, '112553789', 300.00, 'VBNMJGFH', 18, 0.00, '2021-08-06', '2021-08-06 16:23:11', 0, 'MANUAL', 'Repayment', 1),
(38, 4, 2, 3, '719553167', 700.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:28:27', 0, 'MANUAL', 'Repayment', 1),
(39, 11, 1, 2, '705609184', 500.00, 'HFGHNBVH', 16, 0.00, '2021-08-06', '2021-08-06 16:28:27', 0, 'MANUAL', 'Repayment', 1),
(40, 13, 2, 1, '112553789', 300.00, 'VBNMJGFH', 18, 0.00, '2021-08-06', '2021-08-06 16:28:27', 0, 'MANUAL', 'Repayment', 1),
(41, 4, 2, 3, '719553167', 700.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:31:35', 0, 'MANUAL', 'Repayment', 1),
(42, 11, 1, 2, '705609184', 500.00, 'HFGHNBVH', 16, 0.00, '2021-08-06', '2021-08-06 16:31:35', 0, 'MANUAL', 'Repayment', 1),
(43, 13, 2, 1, '112553789', 300.00, 'VBNMJGFH', 18, 0.00, '2021-08-06', '2021-08-06 16:31:35', 0, 'MANUAL', 'Repayment', 1),
(44, 4, 2, 3, '719553167', 700.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:34:16', 0, 'MANUAL', 'Repayment', 1),
(45, 11, 1, 2, '705609184', 500.00, 'HFGHNBVH', 16, 0.00, '2021-08-06', '2021-08-06 16:34:16', 0, 'MANUAL', 'Repayment', 1),
(46, 13, 2, 1, '112553789', 300.00, 'VBNMJGFH', 18, 0.00, '2021-08-06', '2021-08-06 16:34:16', 0, 'MANUAL', 'Repayment', 1),
(47, 4, 2, 2, '112553167', 200.00, 'ERTYUIOPO', 15, 0.00, '2021-08-06', '2021-08-06 16:38:11', 0, 'MANUAL', 'Repayment', 1),
(48, 1, 1, 3, '254716330450', 100.00, 'RTYUIIUYTE', 9, 150.00, '2021-08-06', '2021-08-06 16:41:56', 0, 'MANUAL', 'Repayment', 0),
(49, 4, 2, 3, '254112553167', 100.00, 'FGHJHGFD', 15, 0.00, '2021-08-06', '2021-08-06 16:44:05', 0, 'MANUAL', 'Repayment', 1),
(50, 4, 2, 3, '254716330450', 100.00, 'GHJKKJHGF', 15, 0.00, '2021-08-06', '2021-08-06 16:44:54', 0, 'MANUAL', 'Repayment', 1),
(51, 4, 2, 3, '254716330450', 100.00, 'GHJKKJHG', 15, 0.00, '2021-08-06', '2021-08-06 16:46:01', 0, 'MANUAL', 'Repayment', 1),
(52, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:47:24', 0, 'MANUAL', 'Repayment', 1),
(53, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:48:06', 0, 'MANUAL', 'Repayment', 1),
(54, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:48:48', 0, 'MANUAL', 'Repayment', 1),
(55, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 16:51:46', 0, 'MANUAL', 'Repayment', 1),
(56, 10, 1, 3, '719553167', 100.00, 'N/A', 17, 0.00, '2021-08-06', '2021-08-06 16:57:24', 0, 'MANUAL', 'Repayment', 1),
(57, 10, 1, 3, '719553167', 100.00, 'N/A', 17, 0.00, '2021-08-06', '2021-08-06 16:59:21', 0, 'MANUAL', 'Repayment', 1),
(58, 11, 1, 3, '254716330450', 100.00, 'FGHJ', 16, 0.00, '2021-08-06', '2021-08-06 17:09:19', 0, 'MANUAL', 'Repayment', 1),
(59, 11, 1, 3, '0112553167', 100.00, 'RTNBV', 16, 0.00, '2021-08-06', '2021-08-06 17:10:16', 0, 'MANUAL', 'Repayment', 1),
(60, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:12:11', 0, 'MANUAL', 'Repayment', 1),
(61, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:19:57', 0, 'MANUAL', 'Repayment', 1),
(62, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:21:34', 0, 'MANUAL', 'Repayment', 1),
(68, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:23:51', 0, 'MANUAL', 'Repayment', 1),
(69, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:32:12', 0, 'MANUAL', 'Repayment', 1),
(70, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:32:35', 0, 'MANUAL', 'Repayment', 1),
(71, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:35:43', 0, 'MANUAL', 'Repayment', 1),
(72, 11, 1, 3, '719553167', 100.00, 'N/A', 16, 0.00, '2021-08-06', '2021-08-06 17:36:02', 0, 'MANUAL', 'Repayment', 1),
(73, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:38:07', 0, 'MANUAL', 'Repayment', 1),
(74, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:38:59', 0, 'MANUAL', 'Repayment', 1),
(75, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:45:19', 0, 'MANUAL', 'Repayment', 1),
(76, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:45:19', 0, 'MANUAL', 'Repayment', 1),
(77, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:46:37', 0, 'MANUAL', 'Repayment', 1),
(78, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:46:37', 0, 'MANUAL', 'Repayment', 1),
(79, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:47:14', 0, 'MANUAL', 'Repayment', 1),
(80, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:47:14', 0, 'MANUAL', 'Repayment', 1),
(81, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:48:47', 0, 'MANUAL', 'Repayment', 1),
(82, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:48:48', 0, 'MANUAL', 'Repayment', 1),
(83, 4, 2, 3, '719553167', 100.00, 'N/A', 15, 0.00, '2021-08-06', '2021-08-06 17:49:10', 0, 'MANUAL', 'Repayment', 1),
(84, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:49:10', 0, 'MANUAL', 'Repayment', 1),
(85, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:50:06', 0, 'MANUAL', 'Repayment', 1),
(86, 10, 1, 3, '719553167', 100.00, 'N/A', 17, 0.00, '2021-08-06', '2021-08-06 17:52:41', 0, 'MANUAL', 'Repayment', 1),
(87, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:53:43', 0, 'MANUAL', 'Repayment', 1),
(88, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-06', '2021-08-06 17:54:08', 0, 'MANUAL', 'Repayment', 1),
(89, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-07', '2021-08-07 09:17:37', 0, 'MANUAL', 'Repayment', 1),
(90, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOIU', 17, 0.00, '2021-08-07', '2021-08-07 09:18:07', 0, 'MANUAL', 'Repayment', 1),
(91, 10, 1, 2, '705609185', 150.00, 'MPERTYUIOI', 17, -950.00, '2021-08-07', '2021-08-07 10:49:04', 0, 'MANUAL', 'Repayment', 1),
(92, 3, 1, 2, '254112553167', 200.00, 'ERIUYTDXCV', 10, 0.00, '2021-08-07', '2021-08-07 12:34:59', 0, 'MANUAL', 'Partial Repayment', 1),
(93, 3, 1, 2, '254112553167', 200.00, 'RTYUIUYFD', 10, 0.00, '2021-08-07', '2021-08-07 12:45:05', 0, 'MANUAL', 'Partial Repayment', 1),
(94, 3, 1, 3, '254112553167', 100.00, 'ERYUIOPOIH', 10, 2099.91, '2021-08-07', '2021-08-07 12:48:59', 0, 'MANUAL', 'Repayment', 1),
(95, 3, 1, 2, '254112553167', 200.00, 'ERYUIYUU', 10, 1999.91, '2021-08-07', '2021-08-07 13:28:39', 0, 'MANUAL', 'Repayment', 1),
(96, 3, 1, 3, '0112553167', 100.00, 'ERFGHJKLNB', 10, 1799.91, '2021-08-07', '2021-08-07 13:33:44', 0, 'MANUAL', 'Repayment', 1),
(97, 3, 1, 3, '719553167', 100.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 14:00:38', 0, 'MANUAL', 'Repayment', 1),
(98, 3, 1, 3, '719553167', 100.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 14:18:26', 0, 'MANUAL', 'Repayment', 1),
(99, 3, 1, 3, '719553167', 100.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 14:38:25', 0, 'MANUAL', 'Repayment', 1),
(100, 3, 1, 1, '254716330450', 100.00, 'ertyuiuyt', 10, 0.00, '2021-08-07', '2021-08-07 14:40:59', 0, 'MANUAL', 'repay', 1),
(101, 3, 1, 1, '254112553167', 100.00, 'dfghjhgfd', 10, 0.00, '2021-08-07', '2021-08-07 14:42:47', 0, 'MANUAL', 'repay', 1),
(102, 3, 1, 1, '254112553167', 100.00, 'erffds', 10, 0.00, '2021-08-07', '2021-08-07 14:53:57', 0, 'MANUAL', 'repay', 1),
(103, 3, 1, 3, '719553167', 100.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 15:09:13', 0, 'MANUAL', 'Repayment', 1),
(104, 3, 1, 4, '254716330450', 0.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 15:10:10', 0, 'MANUAL', 'repay', 1),
(105, 3, 1, 4, '0112553167', 50.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 15:16:35', 0, 'MANUAL', 'pay', 1),
(106, 3, 1, 4, '254112553167', 100.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 15:20:23', 0, 'MANUAL', 'repay', 1),
(107, 3, 1, 1, '254716330450', 100.00, 'dfghjkl', 10, 107.00, '2021-08-07', '2021-08-07 15:25:24', 0, 'MANUAL', 'repay', 1),
(108, 3, 1, 1, '254716330450', 50.00, 'sdfghj', 10, 0.00, '2021-08-07', '2021-08-07 15:27:10', 0, 'MANUAL', 'repay', 1),
(109, 3, 1, 4, '254716330450', 100.00, 'N/A', 10, 0.00, '2021-08-07', '2021-08-07 15:29:24', 0, 'MANUAL', 'repay', 1),
(110, 3, 1, 1, '254716330450', 100.00, 'dfghjk', 10, 0.00, '2021-08-07', '2021-08-07 15:31:06', 0, 'MANUAL', 'repay', 1),
(111, 3, 1, 2, '254112553167', 100.00, '23456234', 10, 0.00, '2021-08-07', '2021-08-07 15:32:53', 0, 'MANUAL', 'repay', 1),
(112, 3, 1, 2, '254716330450', 100.00, '2345678', 10, 299.91, '2021-08-07', '2021-08-07 15:33:58', 0, 'MANUAL', 'repay', 1),
(113, 3, 1, 3, '719553167', 100.00, 'TTYUIOIHBN', 10, 199.91, '2021-08-07', '2021-08-07 15:36:51', 0, 'MANUAL', 'Repayment', 1),
(114, 9, 1, 3, '719553167', 100.00, 'Null', 19, 2900.00, '2021-08-07', '2021-08-07 16:04:56', 0, 'MANUAL', 'Repayment', 0),
(115, 9, 1, 4, '719553167', 700.00, 'N/A', 19, 2200.00, '2021-08-07', '2021-08-07 16:05:25', 0, 'MANUAL', 'Repayment', 0),
(116, 9, 1, 1, '254716330450', 1100.00, '9876543', 19, 1200.00, '2021-08-08', '2021-08-08 15:12:25', 0, 'MANUAL', 'Repayment', 0),
(117, 9, 1, 3, '719553167', 700.00, 'N/A', 19, 400.00, '2021-08-08', '2021-08-08 15:15:25', 0, 'MANUAL', 'Repayment', 0),
(118, 9, 1, 3, '719553167', 100.00, 'RTYUIIUY', 19, 300.00, '2021-08-08', '2021-08-08 15:30:21', 0, 'MANUAL', 'Repayment', 0),
(119, 9, 1, 3, '719553167', 100.00, 'RTYUIUYTRE', 19, 200.00, '2021-08-08', '2021-08-08 15:43:05', 0, 'MANUAL', 'Repayment', 0),
(120, 9, 1, 3, '719553167', 100.00, 'RTYUIUYT', 19, 100.00, '2021-08-08', '2021-08-08 15:50:26', 0, 'MANUAL', 'Repayment', 0),
(121, 9, 1, 4, '719553167', 50.00, 'N/A', 19, 50.00, '2021-08-08', '2021-08-08 16:00:15', 0, 'MANUAL', 'Repayment', 0),
(122, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, 0.00, '2021-08-08', '2021-08-08 16:03:27', 0, 'MANUAL', 'Repayment', 0),
(123, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, -50.00, '2021-08-08', '2021-08-08 16:11:58', 0, 'MANUAL', 'Repayment', 0),
(124, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, -100.00, '2021-08-08', '2021-08-08 16:11:59', 0, 'MANUAL', 'Repayment', 0),
(125, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, -150.00, '2021-08-08', '2021-08-08 16:12:01', 0, 'MANUAL', 'Repayment', 0),
(126, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, -200.00, '2021-08-08', '2021-08-08 16:12:02', 0, 'MANUAL', 'Repayment', 0),
(127, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, -250.00, '2021-08-08', '2021-08-08 16:12:03', 0, 'MANUAL', 'Repayment', 0),
(128, 9, 1, 4, '2541125531167', 50.00, 'N/A', 19, -300.00, '2021-08-08', '2021-08-08 16:13:29', 0, 'MANUAL', 'Repayment', 0),
(129, 13, 2, 4, '2541125531167', 50.00, 'N/A', 20, 21530.00, '2021-08-09', '2021-08-09 21:30:55', 0, 'MANUAL', 'Repayment', 1),
(130, 13, 2, 4, '2541125531167', 1500.00, 'N/A', 20, 20030.00, '2021-08-09', '2021-08-09 21:32:00', 0, 'MANUAL', 'Repayment', 1),
(131, 13, 2, 1, '254716330450', 10000.00, '4567890', 20, 10030.00, '2021-08-12', '2021-08-12 14:28:11', 51, 'MANUAL', 'Bank Partial Repayment', 1),
(132, 13, 2, 4, '2541125531167', 500.00, 'N/A', 20, 9530.00, '2021-08-12', '2021-08-12 14:30:09', 0, 'MANUAL', 'Repayment', 1),
(133, 13, 2, 2, '2541125531167', 600.00, 'ERTYUIOP', 20, 8930.00, '2021-08-12', '2021-08-12 14:34:17', 0, 'MANUAL', 'Repayment', 1),
(134, 13, 2, 1, '2541125531167', 1600.00, '34567876', 20, 7330.00, '2021-08-12', '2021-08-12 14:39:54', 0, 'CSV Upload', 'Repayment', 1),
(135, 13, 2, 4, '2541125531167', 600.00, 'N/A', 20, 6730.00, '2021-08-12', '2021-08-12 14:43:31', 0, 'CSV Upload', 'Repayment', 1),
(136, 13, 2, 4, '2541125531167', 500.00, 'N/A', 20, 6230.00, '2021-08-12', '2021-08-12 14:47:07', 51, 'MANUAL', 'Repayment', 1),
(137, 17, 2, 1, '0112987456', 1200.00, '987543', 25, 19800.00, '2021-08-17', '2021-08-17 13:41:51', 51, 'MANUAL', 'first partial repayment', 1),
(138, 17, 2, 4, '1125531167', 2000.00, 'N/A', 25, 17800.00, '2021-08-17', '2021-08-17 13:45:09', 51, 'CSV Upload', 'Repayment', 1),
(139, 17, 2, 1, '0112987456', 1300.00, '876543', 25, 16500.00, '2021-08-18', '2021-08-18 15:13:54', 51, 'MANUAL', 'partial repayment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_key_values`
--

CREATE TABLE `o_key_values` (
  `uid` int(20) NOT NULL,
  `tbl` varchar(20) NOT NULL,
  `record` int(10) NOT NULL,
  `key_` varchar(50) NOT NULL,
  `value_` varchar(250) NOT NULL,
  `added_by` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Save key and values for anything';

--
-- Dumping data for table `o_key_values`
--

INSERT INTO `o_key_values` (`uid`, `tbl`, `record`, `key_`, `value_`, `added_by`, `added_date`, `status`) VALUES
(1, '0', 3, 'undefined', '', 0, '2021-05-20 10:09:38', 0),
(2, '0', 3, 'KRA PIN', '1234', 0, '2021-05-20 10:16:36', 0),
(3, '0', 3, 'KRA', '32323', 0, '2021-05-20 10:16:57', 0),
(4, 'o_customers', 3, 'KRA', '32323', 0, '2021-05-20 10:17:55', 0),
(5, 'o_customers', 11, 'Alternate Address', 'Kikuyu Drive Off Kiambu Road', 0, '2021-05-21 04:52:06', 1),
(6, 'o_customers', 11, 'KRA', '1234', 1, '2021-06-13 11:18:22', 1),
(7, 'o_customers', 11, 'PIN', '6567494777', 1, '2021-06-13 18:08:35', 1),
(8, 'o_customers', 11, 'Alternate Address1', '434', 1, '2021-06-13 18:20:07', 1),
(9, 'o_customers', 11, 'TYe', '33434', 1, '2021-06-13 18:37:14', 1),
(10, 'o_customers', 11, '8ru', '32', 1, '2021-06-13 18:37:23', 1),
(11, 'o_customers', 11, 'Huduma Number', '22333444', 1, '2021-06-21 15:14:48', 1),
(12, 'o_customers', 12, 'KRA PIN', '234', 51, '2021-07-31 11:16:09', 0),
(13, 'o_customers', 12, 'KRA ', '1234', 0, '2021-07-31 11:32:31', 0),
(14, 'o_customers', 12, 'KRA PIN2', '234r', 0, '2021-07-31 12:12:53', 0),
(15, 'o_customers', 12, 'Huduma Number', '345678', 0, '2021-07-31 12:14:22', 0),
(16, 'o_customers', 12, 'Peter Munyi', 'wertg', 0, '2021-07-31 12:16:42', 0),
(17, 'o_customers', 12, 'Huduma Number', 'ertyu', 0, '2021-07-31 12:18:35', 0),
(18, 'o_customers', 12, 'Huduma Number', '234567', 0, '2021-07-31 12:18:50', 1),
(19, 'o_customers', 12, 'KRA PIN', '23456789', 0, '2021-07-31 12:19:03', 1),
(20, 'o_customers', 12, 'KRA', '345678', 0, '2021-08-02 10:40:40', 0),
(21, 'o_customers', 12, 'KRA2', '45678', 51, '2021-08-02 10:40:57', 1),
(22, 'o_customers', 12, 'KRA2', '234567', 0, '2021-08-02 10:43:35', 0),
(23, 'o_customers', 12, 'KRA3', '234567', 0, '2021-08-02 10:43:57', 0),
(24, 'o_customers', 16, 'KRA3', '234560', 0, '2021-08-08 22:35:55', 0),
(25, 'o_customers', 16, 'KRA', '43223', 51, '2021-08-08 22:36:20', 1),
(26, 'o_customers', 16, 'KRA2', '3456', 0, '2021-08-08 22:36:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_loans`
--

CREATE TABLE `o_loans` (
  `uid` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `loan_amount` double(50,2) NOT NULL,
  `disbursed_amount` double(50,2) NOT NULL,
  `total_repayable_amount` double(50,2) NOT NULL,
  `total_repaid` double(50,2) NOT NULL,
  `loan_balance` double(50,2) NOT NULL,
  `period` int(10) NOT NULL,
  `period_units` varchar(30) NOT NULL,
  `payment_frequency` varchar(30) NOT NULL,
  `payment_breakdown` varchar(75) NOT NULL,
  `total_addons` double(50,2) NOT NULL,
  `total_deductions` double(50,2) NOT NULL,
  `total_instalments` int(5) NOT NULL COMMENT 'Total installments in this loan',
  `total_instalments_paid` int(5) NOT NULL COMMENT 'How many instalments have been paid',
  `current_instalment` int(5) NOT NULL COMMENT 'We are in instalment number?',
  `given_date` date NOT NULL,
  `next_due_date` date NOT NULL,
  `final_due_date` date NOT NULL,
  `added_by` int(10) NOT NULL,
  `current_agent` int(10) NOT NULL,
  `current_branch` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  `loan_stage` int(5) NOT NULL,
  `loan_flag` int(5) NOT NULL COMMENT 'from o_flags',
  `transaction_code` varchar(40) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `application_mode` varchar(40) NOT NULL COMMENT 'MANUAL, APP, USSD, SMS',
  `status` int(5) NOT NULL COMMENT 'From o_loan_statuses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_loans`
--

INSERT INTO `o_loans` (`uid`, `customer_id`, `product_id`, `loan_amount`, `disbursed_amount`, `total_repayable_amount`, `total_repaid`, `loan_balance`, `period`, `period_units`, `payment_frequency`, `payment_breakdown`, `total_addons`, `total_deductions`, `total_instalments`, `total_instalments_paid`, `current_instalment`, `given_date`, `next_due_date`, `final_due_date`, `added_by`, `current_agent`, `current_branch`, `added_date`, `loan_stage`, `loan_flag`, `transaction_code`, `transaction_date`, `application_mode`, `status`) VALUES
(1, 1, 2, 1000.00, 900.00, 0.00, 0.00, 0.00, 5, 'MONTHS', 'MONTHLY', '20,20,20,30,10', 100.00, 100.00, 0, 0, 0, '2021-05-27', '2021-06-27', '2021-10-23', 0, 0, 1, '2021-05-27 01:32:25', 5, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(2, 3, 1, 10000.00, 0.00, 0.00, 0.00, 0.00, 45, '1', '7', '', 0.00, 0.00, 0, 0, 1, '2021-05-28', '2021-06-04', '2021-07-12', 0, 0, 1, '0000-00-00 00:00:00', 2, 0, '', '2021-05-28 11:59:32', 'MANUAL', 0),
(3, 1, 1, 10000.00, 0.00, 0.00, 0.00, 0.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-05-28', '2021-06-04', '2021-07-12', 0, 0, 1, '2021-05-28 12:28:32', 5, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(4, 3, 2, 1000.00, 0.00, 0.00, 0.00, 0.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-05-28', '2021-06-27', '2021-06-27', 0, 0, 1, '2021-05-28 16:55:11', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(5, 1, 2, 3000.00, 0.00, 0.00, 0.00, 0.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-05-28', '2021-06-27', '2021-06-27', 0, 0, 1, '2021-05-28 17:02:17', 2, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(6, 3, 1, 19000.00, 0.00, 0.00, 0.00, 0.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-05-29', '2021-06-05', '2021-07-13', 0, 0, 1, '2021-05-29 16:54:41', 1, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(7, 11, 1, 10000.00, 0.00, 0.00, 0.00, 0.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-06-21', '2021-06-28', '2021-08-05', 0, 0, 0, '2021-06-21 07:08:00', 0, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(8, 1, 1, 10000.00, 0.00, 0.00, 0.00, 0.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-06-22', '2021-06-29', '2021-08-06', 0, 0, 1, '2021-06-22 00:44:18', 0, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(9, 1, 1, 10000.00, 10000.00, 10000.00, 9850.00, 150.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-06-22', '2021-06-29', '2021-08-06', 1, 0, 1, '2021-06-22 01:03:05', 5, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(10, 3, 2, 3000.00, 2154.00, 3700.00, 3500.09, 199.91, 5, '30', '15', '', 700.00, 846.00, 1, 0, 1, '2021-06-22', '2021-07-22', '2021-07-22', 0, 0, 1, '2021-06-22 12:41:51', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 7),
(11, 12, 1, 40000.00, 40000.00, 40000.00, 42200.00, -2200.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-07-12', '2021-07-19', '2021-08-26', 0, 0, 2, '2021-07-12 11:25:13', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 2),
(12, 4, 2, 2000.00, 2000.00, 2000.00, 0.00, 0.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-07-13', '2021-08-12', '2021-08-12', 0, 0, 0, '2021-07-13 10:29:57', 1, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(13, 4, 1, 10000.00, 10000.00, 10000.00, 0.00, 0.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-07-13', '2021-07-20', '2021-08-27', 0, 0, 0, '2021-07-13 10:33:24', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(14, 4, 2, 1000.00, 1000.00, 1000.00, 0.00, 0.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-07-13', '2021-08-12', '2021-08-12', 0, 0, 0, '2021-07-13 10:37:33', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(15, 4, 2, 3000.00, 3000.00, 3000.00, 3700.00, -700.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-08-03', '2021-09-02', '2021-09-02', 0, 0, 1, '2021-08-03 12:20:19', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 2),
(16, 11, 2, 2500.00, 2500.00, 2500.00, 5500.00, -3000.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-08-03', '2021-09-02', '2021-09-02', 0, 0, 1, '2021-08-03 12:26:41', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 2),
(17, 10, 2, 1000.00, 1000.00, 1000.00, 1950.00, -950.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-08-03', '2021-09-02', '2021-09-02', 0, 0, 1, '2021-08-03 12:32:30', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 2),
(18, 13, 2, 1500.00, 1500.00, 1500.00, 2100.00, 0.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-08-04', '2021-09-03', '2021-09-03', 0, 0, 2, '2021-08-04 15:43:50', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(19, 9, 2, 3000.00, 3000.00, 3000.00, 3300.00, 3000.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-08-07', '2021-09-06', '2021-09-06', 0, 0, 1, '2021-08-07 16:03:45', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(20, 13, 1, 17000.00, 17000.00, 21580.00, 15350.00, 6230.00, 45, '1', '7', '', 4580.00, 0.00, 6, 0, 1, '2021-08-09', '2021-08-16', '2021-09-23', 0, 0, 2, '2021-08-09 10:31:27', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 7),
(21, 17, 2, 3000.00, 3000.00, 3000.00, 0.00, 0.00, 1, '30', '0', '', 0.00, 0.00, 1, 0, 1, '2021-08-10', '2021-09-09', '2021-09-09', 51, 0, 2, '2021-08-10 08:20:00', 1, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(22, 17, 2, 3000.00, 2500.00, 4220.00, 0.00, 0.00, 1, '30', '0', '', 1220.00, 500.00, 1, 0, 1, '2021-08-10', '2021-09-09', '2021-09-09', 51, 0, 2, '2021-08-10 08:22:26', 1, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(23, 17, 1, 20000.00, 20000.00, 20000.00, 0.00, 20000.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-08-17', '2021-08-24', '2021-10-01', 51, 0, 2, '2021-08-17 11:05:30', 1, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(24, 17, 1, 20000.00, 20000.00, 20000.00, 0.00, 20000.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-08-17', '2021-08-24', '2021-10-01', 51, 0, 2, '2021-08-17 13:36:33', 1, 0, '', '0000-00-00 00:00:00', 'MANUAL', 0),
(25, 17, 1, 21000.00, 21000.00, 21000.00, 4500.00, 16500.00, 45, '1', '7', '', 0.00, 0.00, 6, 0, 1, '2021-08-17', '2021-08-24', '2021-10-01', 51, 0, 2, '2021-08-17 13:39:40', 4, 0, '', '0000-00-00 00:00:00', 'MANUAL', 3),
(26, 18, 1, 10000.00, 10000.00, 10400.00, 0.00, 10400.00, 45, '1', '7', '', 400.00, 0.00, 6, 0, 1, '2021-08-17', '2021-08-24', '2021-10-01', 51, 0, 2, '2021-08-17 21:25:26', 3, 0, '', '0000-00-00 00:00:00', 'MANUAL', 6);

-- --------------------------------------------------------

--
-- Table structure for table `o_loan_addons`
--

CREATE TABLE `o_loan_addons` (
  `uid` int(10) NOT NULL,
  `loan_id` int(10) NOT NULL,
  `addon_id` int(10) NOT NULL,
  `addon_amount` double(20,2) NOT NULL,
  `added_by` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_loan_addons`
--

INSERT INTO `o_loan_addons` (`uid`, `loan_id`, `addon_id`, `addon_amount`, `added_by`, `added_date`, `status`) VALUES
(1, 4, 1, 100.00, 22, '2021-06-21 08:38:35', 0),
(2, 4, 2, 100.00, 22, '2021-06-21 08:39:49', 0),
(3, 7, 3, 100.00, 22, '2021-06-21 08:45:07', 0),
(4, 4, 3, 100.00, 22, '2021-06-21 08:47:20', 1),
(5, 7, 3, 100.00, 22, '2021-06-21 08:52:41', 0),
(6, 7, 1, 100.00, 22, '2021-06-21 08:52:43', 0),
(7, 7, 2, 100.00, 22, '2021-06-21 08:53:13', 0),
(8, 7, 1, 100.00, 22, '2021-06-21 08:54:40', 1),
(9, 10, 3, 100.00, 22, '2021-06-21 08:54:57', 1),
(10, 10, 2, 100.00, 1, '2021-06-21 12:01:21', 1),
(11, 4, 1, 100.00, 1, '2021-06-21 12:01:23', 1),
(12, 1, 1, 100.00, 1, '2021-06-21 21:14:42', 1),
(13, 1, 2, 100.00, 1, '2021-06-21 21:14:44', 1),
(14, 1, 3, 100.00, 1, '2021-06-21 23:41:44', 1),
(15, 9, 2, 500.00, 1, '2021-06-22 01:40:20', 0),
(16, 9, 1, 3000.00, 1, '2021-06-22 01:45:53', 0),
(17, 9, 1, 3000.00, 1, '2021-06-22 01:45:57', 0),
(18, 9, 3, 0.00, 1, '2021-06-22 02:01:59', 0),
(19, 9, 3, 0.00, 1, '2021-06-22 02:08:30', 0),
(20, 9, 1, 0.00, 1, '2021-06-22 02:17:36', 0),
(21, 9, 2, 500.00, 1, '2021-06-22 02:25:35', 0),
(22, 9, 1, 0.00, 1, '2021-06-22 02:28:09', 0),
(23, 9, 1, 0.00, 1, '2021-06-22 02:28:12', 0),
(24, 9, 2, 500.00, 1, '2021-06-22 02:28:15', 0),
(25, 9, 3, 0.00, 1, '2021-06-22 02:28:17', 0),
(26, 9, 3, 0.00, 1, '2021-06-22 02:30:41', 0),
(27, 9, 3, 0.00, 1, '2021-06-22 02:34:32', 0),
(28, 9, 3, 0.00, 1, '2021-06-22 02:34:34', 0),
(29, 9, 1, 0.00, 1, '2021-06-22 02:34:37', 0),
(30, 9, 3, 77.00, 1, '2021-06-22 02:37:19', 0),
(31, 9, 3, 0.00, 1, '2021-06-22 02:42:31', 0),
(32, 9, 3, 0.00, 1, '2021-06-22 08:49:56', 1),
(33, 10, 2, 500.00, 1, '2021-06-22 12:42:10', 1),
(34, 10, 1, 430.00, 1, '2021-06-22 18:06:38', 0),
(35, 10, 3, 0.00, 1, '2021-06-22 18:07:17', 1),
(36, 10, 1, 0.00, 1, '2021-06-22 23:29:36', 1),
(37, 9, 1, 0.00, 1, '2021-06-22 23:47:58', 1),
(38, 20, 3, 680.00, 51, '2021-08-09 11:06:25', 0),
(39, 20, 1, 3400.00, 51, '2021-08-09 11:06:27', 0),
(40, 20, 2, 500.00, 51, '2021-08-09 11:06:28', 0),
(41, 20, 3, 680.00, 51, '2021-08-09 11:17:55', 0),
(42, 20, 1, 3400.00, 51, '2021-08-09 11:17:56', 0),
(43, 20, 3, 680.00, 51, '2021-08-09 11:18:53', 1),
(44, 20, 1, 3400.00, 51, '2021-08-09 11:18:54', 1),
(45, 20, 2, 500.00, 51, '2021-08-09 11:18:56', 1),
(46, 22, 1, 600.00, 51, '2021-08-16 12:04:53', 1),
(47, 22, 2, 500.00, 51, '2021-08-16 12:04:55', 1),
(48, 22, 3, 120.00, 51, '2021-08-16 12:04:56', 1),
(49, 26, 3, 400.00, 51, '2021-08-17 22:02:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_loan_deductions`
--

CREATE TABLE `o_loan_deductions` (
  `uid` int(10) NOT NULL,
  `loan_id` int(10) NOT NULL,
  `deduction_id` int(10) NOT NULL,
  `deduction_amount` double(20,2) NOT NULL,
  `added_by` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_loan_deductions`
--

INSERT INTO `o_loan_deductions` (`uid`, `loan_id`, `deduction_id`, `deduction_amount`, `added_by`, `added_date`, `status`) VALUES
(1, 4, 1, 100.00, 1, '2021-06-21 11:37:45', 0),
(2, 4, 2, 100.00, 1, '2021-06-21 11:44:41', 0),
(3, 4, 1, 100.00, 1, '2021-06-21 11:46:52', 0),
(4, 4, 2, 100.00, 1, '2021-06-21 11:46:57', 0),
(5, 4, 1, 100.00, 1, '2021-06-21 11:48:04', 1),
(6, 4, 2, 100.00, 1, '2021-06-21 11:48:05', 1),
(7, 1, 1, 100.00, 1, '2021-06-21 21:14:48', 1),
(8, 1, 2, 100.00, 1, '2021-06-21 21:14:49', 1),
(9, 10, 3, 0.00, 1, '2021-06-22 02:08:23', 0),
(10, 10, 4, 747.00, 1, '2021-06-22 02:08:25', 1),
(11, 10, 3, 99.00, 1, '2021-06-22 02:42:45', 1),
(12, 9, 4, 0.00, 1, '2021-06-22 02:43:32', 1),
(13, 20, 3, 850.00, 51, '2021-08-09 11:05:08', 0),
(14, 20, 4, 3400.00, 51, '2021-08-09 11:05:14', 0),
(15, 20, 3, 850.00, 51, '2021-08-09 11:07:22', 0),
(16, 20, 4, 3400.00, 51, '2021-08-09 11:07:24', 0),
(17, 20, 3, 850.00, 51, '2021-08-09 11:13:47', 0),
(18, 20, 4, 3400.00, 51, '2021-08-09 11:17:07', 0),
(19, 20, 3, 850.00, 51, '2021-08-09 11:17:14', 0),
(20, 20, 4, 3400.00, 51, '2021-08-09 11:17:15', 0),
(21, 20, 3, 850.00, 51, '2021-08-09 11:17:50', 0),
(22, 20, 3, 850.00, 51, '2021-08-09 11:21:30', 0),
(23, 20, 4, 3400.00, 51, '2021-08-09 11:21:31', 0),
(24, 20, 3, 850.00, 51, '2021-08-09 16:26:16', 0),
(25, 22, 1, 3000.00, 51, '2021-08-16 12:05:46', 0),
(26, 22, 2, 500.00, 51, '2021-08-16 12:05:48', 0),
(27, 22, 2, 500.00, 51, '2021-08-16 12:06:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_loan_products`
--

CREATE TABLE `o_loan_products` (
  `uid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `period` int(10) NOT NULL,
  `period_units` varchar(10) NOT NULL COMMENT 'DAYS, WEEKS, MONTHS, YEARS',
  `min_amount` double(50,2) NOT NULL,
  `max_amount` double(50,2) NOT NULL,
  `pay_frequency` varchar(20) NOT NULL COMMENT 'DAILY, WEEKLY, BI-WEEKLY, MONTHLY, BI-MONTHLY, QUARTERLY, BI-ANNUALY, ANNUALY',
  `percent_breakdown` varchar(250) NOT NULL COMMENT 'Payment Breakdown. comma delimited without the % sign. Leave blank for equal percentage',
  `disburse_method` int(5) NOT NULL COMMENT 'from o_disburse_methods',
  `added_date` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_loan_products`
--

INSERT INTO `o_loan_products` (`uid`, `name`, `description`, `period`, `period_units`, `min_amount`, `max_amount`, `pay_frequency`, `percent_breakdown`, `disburse_method`, `added_date`, `status`) VALUES
(1, 'Main Product', 'The Main product', 45, '1', 10000.00, 1000000.00, '7', '', 2, '2021-05-15 01:45:31', 1),
(2, 'Upia', 'Main Loan', 1, '30', 1000.00, 3000.00, '0', '', 3, '2021-05-24 08:58:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_loan_stages`
--

CREATE TABLE `o_loan_stages` (
  `uid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `stage_order` int(5) NOT NULL,
  `permissions` varchar(250) NOT NULL,
  `can_addon` int(1) NOT NULL,
  `can_deduct` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_loan_stages`
--

INSERT INTO `o_loan_stages` (`uid`, `name`, `description`, `stage_order`, `permissions`, `can_addon`, `can_deduct`, `status`) VALUES
(1, 'Initiation', 'The first level of a loan, freshly created loans', 1, '', 1, 0, 1),
(2, 'Approval Level1', 'First approval where loans can go the next level of approval', 10, '', 1, 1, 1),
(3, 'Approval Level2', 'Next stage of Approval by next manager', 20, '', 0, 0, 1),
(4, 'Final Stage (Disburse)', 'The loan is disbursed at this stage', 30, '', 0, 0, 1),
(5, 'Line Manager Approval', 'This is a line manager', 40, '', 1, 1, 1),
(6, 'undefined', 'undefined', 0, '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_loan_statuses`
--

CREATE TABLE `o_loan_statuses` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `active_loan` int(1) NOT NULL,
  `description` varchar(250) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_loan_statuses`
--

INSERT INTO `o_loan_statuses` (`uid`, `name`, `active_loan`, `description`, `color_code`, `status`) VALUES
(1, 'Created', 1, 'Imediately a loan is successfully created', '#6495ed', 1),
(2, 'Pending Disbursement', 1, 'Loan is in the approval stages but has not been sent', '#ff8c00', 1),
(3, 'Disbursed', 1, 'Money has been sent to the user', '#6cce05', 1),
(4, 'Partially Paid', 1, 'Loan has partial payment', '#1e90ff', 1),
(5, 'Cleared', 0, 'Loan has been settled', '#00fa9a', 1),
(6, 'Rejected', 0, 'The loan was not approved', '#ed143d', 1),
(7, 'Overdue', 1, 'The Loan went overdue', '#ff0000', 1),
(8, 'Missed Payment', 1, 'The loan missed a payment', '#f77a91', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_log_updates`
--

CREATE TABLE `o_log_updates` (
  `uid` int(20) NOT NULL,
  `table_` varchar(50) NOT NULL,
  `query_` text NOT NULL,
  `record_date` datetime NOT NULL,
  `update_by` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `o_next_steps`
--

CREATE TABLE `o_next_steps` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `details` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_next_steps`
--

INSERT INTO `o_next_steps` (`uid`, `name`, `details`, `status`) VALUES
(1, 'Pay Visit', '#788888', 1),
(2, 'Reposession', '#FF0000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_notifications`
--

CREATE TABLE `o_notifications` (
  `uid` int(10) NOT NULL,
  `staff_id` int(10) NOT NULL,
  `sent_date` datetime NOT NULL,
  `source_details` varchar(20) NOT NULL,
  `title` varchar(80) NOT NULL,
  `details` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_notifications`
--

INSERT INTO `o_notifications` (`uid`, `staff_id`, `sent_date`, `source_details`, `title`, `details`, `link`, `status`) VALUES
(1, 1, '2021-06-04 15:58:48', 'SYSTEM', 'Password Info', 'You have updated your password', '', 2),
(2, 1, '2021-06-04 15:58:48', '', 'New Task', 'You have a new task coming up', 'http://hhghg.vom', 2),
(3, 1, '2021-06-05 23:10:16', 'SYSTEM', 'You have new targets', 'Target 100, new customers 489', '', 2),
(4, 1, '2021-06-07 00:44:00', 'SYSTEM', 'Password Updated', 'Your Password was updated on 2021-06-07 00:44:00 from your profile', '#', 2),
(5, 1, '2021-06-07 00:44:35', 'SYSTEM', 'Password Updated', 'Your Password was updated on 2021-06-07 00:44:35 from your profile', '#', 2),
(6, 1, '2021-06-07 00:47:10', 'SYSTEM', 'Password Updated', 'Your Password was updated on 2021-06-07 00:47:10 from your profile', '#', 2),
(7, 1, '2021-07-10 09:11:16', 'SYSTEM', 'Password Updated', 'Your Password was updated on 2021-07-10 09:11:16 from your profile', '#', 2);

-- --------------------------------------------------------

--
-- Table structure for table `o_passes`
--

CREATE TABLE `o_passes` (
  `uid` int(20) NOT NULL,
  `user` int(20) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `pass_reset_token` varchar(255) DEFAULT NULL,
  `reset_status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o_passes`
--

INSERT INTO `o_passes` (`uid`, `user`, `pass`, `pass_reset_token`, `reset_status`) VALUES
(1, 1, '~^)54jr{[zCzozH3:Y[3J~CZfl4^A!+}', NULL, 0),
(2, 2, 'FsC11R{R0nzweiAv#LV2)98P@zWbM>m!', NULL, 0),
(3, 0, 'DFU5+O1HunX~t}g_|.89BD%4u@qsLylz', NULL, 0),
(4, 22, 'VwQ@L1uA{o{hZ.S+LxIC}O{kL1[1WxFo', NULL, 0),
(5, 51, 'wn@ivDGX%2>0U6!tRPh0o2(u{hUujE<S', NULL, 0),
(6, 52, 'B1X6sZ-{h0DEEKPA(dwB({n-jhpzCX^E', NULL, 0),
(7, 53, 'D_d))HNWPH+Unp7V{>c(TK>9Z_o7U|#@', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_payment_methods`
--

CREATE TABLE `o_payment_methods` (
  `uid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `account_details` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_payment_methods`
--

INSERT INTO `o_payment_methods` (`uid`, `name`, `account_details`, `status`) VALUES
(1, 'Bank', '', 1),
(2, 'Safaricom M-Pesa', 'PayBill: 54772 <br/>\r\nAccount No: 74389 <br/>', 1),
(3, 'Mobile Payment', '', 1),
(4, 'Cash', '', 1),
(5, 'Other', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_payment_schedule`
--

CREATE TABLE `o_payment_schedule` (
  `uid` int(20) NOT NULL,
  `loan_code` int(10) NOT NULL COMMENT 'From o_loans table',
  `schedule_date` date NOT NULL,
  `pay_percent` double(10,2) NOT NULL,
  `pay_amount` double(50,2) NOT NULL,
  `amount_paid` double(50,2) NOT NULL,
  `balance` double(50,2) NOT NULL,
  `status` int(3) NOT NULL COMMENT '1-scheduled, 2-cleared, 3-partial, 4-defaulted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `o_permissions`
--

CREATE TABLE `o_permissions` (
  `uid` int(10) NOT NULL,
  `group_id` int(5) NOT NULL,
  `user_id` int(10) NOT NULL,
  `tbl` varchar(50) NOT NULL,
  `rec` int(10) NOT NULL,
  `general_` int(1) NOT NULL DEFAULT '0',
  `create_` int(1) NOT NULL DEFAULT '0',
  `read_` int(1) NOT NULL DEFAULT '0',
  `update_` int(1) NOT NULL DEFAULT '0',
  `delete_` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_permissions`
--

INSERT INTO `o_permissions` (`uid`, `group_id`, `user_id`, `tbl`, `rec`, `general_`, `create_`, `read_`, `update_`, `delete_`) VALUES
(1, 1, 0, 'o_branches', 0, 1, 1, 0, 1, 0),
(2, 1, 0, 'o_customers', 0, 1, 1, 1, 1, 0),
(3, 2, 0, 'o_loan_stages', 2, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_product_addons`
--

CREATE TABLE `o_product_addons` (
  `uid` int(10) NOT NULL,
  `addon_id` int(10) NOT NULL COMMENT 'From o_addons table',
  `product_id` int(10) NOT NULL COMMENT 'From o_loan_products table',
  `date_added` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_product_addons`
--

INSERT INTO `o_product_addons` (`uid`, `addon_id`, `product_id`, `date_added`, `status`) VALUES
(1, 2, 1, '0000-00-00 00:00:00', 1),
(2, 1, 1, '0000-00-00 00:00:00', 1),
(3, 3, 2, '0000-00-00 00:00:00', 1),
(4, 2, 2, '0000-00-00 00:00:00', 1),
(5, 1, 2, '0000-00-00 00:00:00', 1),
(6, 3, 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_product_deductions`
--

CREATE TABLE `o_product_deductions` (
  `uid` int(10) NOT NULL,
  `deduction_id` int(10) NOT NULL COMMENT 'From o_addons table',
  `product_id` int(10) NOT NULL COMMENT 'From o_loan_products table',
  `date_added` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_product_deductions`
--

INSERT INTO `o_product_deductions` (`uid`, `deduction_id`, `product_id`, `date_added`, `status`) VALUES
(1, 3, 2, '0000-00-00 00:00:00', 0),
(2, 2, 2, '0000-00-00 00:00:00', 1),
(3, 1, 2, '0000-00-00 00:00:00', 1),
(4, 4, 1, '2021-05-26 14:45:20', 1),
(5, 3, 1, '2021-05-26 14:45:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_product_stages`
--

CREATE TABLE `o_product_stages` (
  `uid` int(10) NOT NULL,
  `stage_id` int(10) NOT NULL COMMENT 'From o_loan_stages table',
  `stage_order` int(10) NOT NULL,
  `is_final_stage` int(1) NOT NULL,
  `product_id` int(10) NOT NULL COMMENT 'From o_loan_products table',
  `date_added` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_product_stages`
--

INSERT INTO `o_product_stages` (`uid`, `stage_id`, `stage_order`, `is_final_stage`, `product_id`, `date_added`, `status`) VALUES
(1, 1, 10, 0, 1, '2021-05-25 23:15:27', 1),
(2, 2, 20, 0, 1, '2021-05-25 23:16:42', 1),
(3, 3, 30, 0, 1, '2021-05-25 23:21:26', 1),
(4, 4, 40, 0, 1, '2021-05-25 23:21:27', 1),
(5, 5, 50, 1, 1, '2021-05-25 23:23:59', 0),
(6, 1, 10, 0, 2, '2021-06-16 08:47:32', 1),
(7, 2, 20, 0, 2, '2021-06-16 08:47:33', 1),
(8, 3, 30, 0, 2, '2021-06-16 08:47:35', 1),
(9, 4, 40, 0, 2, '2021-06-16 08:47:36', 1),
(10, 5, 50, 0, 2, '2021-06-16 08:47:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `o_reports`
--

CREATE TABLE `o_reports` (
  `uid` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `row_query` text NOT NULL,
  `added_by` int(10) NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `viewable_by` varchar(50) DEFAULT NULL COMMENT '0 for all',
  `status` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_reports`
--

INSERT INTO `o_reports` (`uid`, `title`, `description`, `row_query`, `added_by`, `added_date`, `viewable_by`, `status`) VALUES
(1, 'Customer Acquisition', 'Customer Acquisition', 'SELECT uid, full_name,primary_mobile,email_address,	physical_address,	town,	passport_photo FROM o_customers WHERE uid > 0 order by uid asc limit 0,5', 1, '2021-06-18 18:23:30', '0', 1),
(3, 'Payments Acqusation', 'Payments Acquisition', 'SELECT uid, customer_id, branch_id, amount, payment_date, loan_balance FROM o_incoming_payments WHERE status > 0 AND uid > 0 order by uid desc LIMIT 0,4;  ', 51, '2021-08-08 12:00:26', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_staff_statuses`
--

CREATE TABLE `o_staff_statuses` (
  `uid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_staff_statuses`
--

INSERT INTO `o_staff_statuses` (`uid`, `name`, `color`) VALUES
(1, 'Active', 'bg-green'),
(2, 'Former', 'bg-red');

-- --------------------------------------------------------

--
-- Table structure for table `o_tokens`
--

CREATE TABLE `o_tokens` (
  `uid` int(20) NOT NULL,
  `userid` int(20) NOT NULL,
  `token` varchar(245) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime NOT NULL,
  `device_id` varchar(245) DEFAULT NULL,
  `browsername` varchar(250) DEFAULT NULL,
  `IPAddress` varchar(45) DEFAULT NULL,
  `OS` varchar(55) DEFAULT NULL,
  `usages` int(10) DEFAULT '0',
  `status` int(1) NOT NULL COMMENT '1-valid, 2-expired'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_tokens`
--

INSERT INTO `o_tokens` (`uid`, `userid`, `token`, `creation_date`, `expiry_date`, `device_id`, `browsername`, `IPAddress`, `OS`, `usages`, `status`) VALUES
(0, 51, 'CZrcTneGnLcxRShoeVG0pHKl7o0zjWCcHFMZNlJMzFIJGoclHNKrJhfL9vrofKtR', '2021-08-24 17:29:14', '2021-08-28 08:44:40', '', '', '', '', 0, 2),
(1, 1, 'AkEMJAl3gnFzWy9OJ5EHClYRwr6C8OL9GABrfHpV8PrA7iEEfmisD8iK2djKLvtp', '2021-03-20 04:45:58', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(2, 2, 'ywtkcZK7NzUnbzSVqb3TzbqaaakR80WjBVIlWZcFoMEfTiDuzXOOE2u9Qbetj00n', '2021-04-06 10:55:52', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(3, 2, 'XnezncaRJAcZvcDUibxdYhalJ68CpgfQwGxiZbXmMTesYGicTCugi3FmOWjBbkSE', '2021-04-06 11:06:18', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(4, 2, 'YEU13nO8NM5ogFmfuBXtL3RQW0Ujt4vXOTrQ7kuNGqNkeOfcSurQQl2KPKavBX3l', '2021-04-06 11:06:26', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(5, 2, '1uS3HvFHfoTz0BB5IiLXcVcCHbROLPLHJJ5bWdeW9TpAPUhkAsVY8uBaUXzAaOOA', '2021-04-06 11:07:10', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(6, 2, 'sMCNFtO4Z9oLQdFyd9vJiXJKcWlWQiuOknnapNMYaStBB5C3F1r0apoBZ0LpATr7', '2021-04-06 11:07:58', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(7, 2, '8DI1UyUsNuTvmQKWbScAyXkls7GbjKPmiqJ5s6vF30oAWHZ5E51iuMBcpq5iopfV', '2021-04-06 11:08:06', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(8, 2, 'd3N8Mi6OR2zfpt4Dfrbob5rEIcaXmkc6oOBwQafIgRM4ejXIf9eau5ra15VAagBE', '2021-04-06 11:08:55', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(9, 2, 'E3RP40D8iwfRColtohtXccv8rYXM0lm62X9G62I9E430M07Xv3VRl1tXhnE3dbwG', '2021-04-06 11:11:48', '2021-02-06 00:00:00', '', '', '', '', 0, 1),
(10, 2, 'X1aRvwY27nGx0UACYMXVXTPvAc2223niKMAMrkGGb4w0YG0YDzHnYaWBXwcpRr0w', '2021-04-06 11:56:35', '2021-05-06 00:00:00', '', '', '', '', 0, 1),
(11, 1, 'H3fVwwyHoNlyHZ2bmoRFH8YNMnE8woZwVuRi7J6qqNrFMHxDG371GCoAeXRcKBXv', '2021-04-19 00:38:23', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(12, 1, 'Cz45o1I2y6xcbHS6j02tmc5683MTzIbbOWo7XN778t004Ca2Z9yu3WeMaOTdwW49', '2021-04-19 00:46:04', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(13, 1, 'JzVkcAg0Bvh2fWVDOrxHdjLt4bS8UQ7wwIoKzkYK0Ku7NoSHTtnXIhvpzdkhNrb7', '2021-04-19 01:13:30', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(14, 1, 'TUBAI31NONhmZeJINiUxl7dy06EOWwCEmaNqjB85qBBe91SVDBsWWoY7V0ZV1cCh', '2021-04-19 01:15:42', '2021-05-19 00:00:00', '', '', '', '', 0, 0),
(15, 1, 'S902vwn0S75mL6ZhGdE5dX2g4IMcNmP8cge06Gz1E1oqvkd4qMkT1rvItUwKSLcq', '2021-04-19 01:20:34', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(16, 1, 'ZauKIJIO9wzY43ZdKWkzXXLMSdNMbBMXtlBNNtWXB0CKPLDMqmecDZbeZL1JLtTv', '2021-04-20 16:46:06', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(17, 1, 'cyTpzs7iiT3xZSo8Z3jQRaesn7BD03JfSHPribmzcjSU6zZEYP4vN2cegI5wQlmm', '2021-04-20 16:54:56', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(18, 1, 'yo5euNoKjbh9XThj0UprZrlGyU6KB3hDRAl9dcq9tgRcSrB9xaXURh1beY6VeSEt', '2021-04-20 16:56:46', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(19, 1, 'EaN0wGBHAIJAymd5te9H84qIL3riyyah6WGppXYWcJ48wnpsGMjPmZHAOdGXUu7T', '2021-04-20 19:30:57', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(20, 1, 'sFxk8XKobbJDSYmTK9QwvSGkbou4KMHl0JbIE7stDeX2NJE4QUTJqGlCU15Hv1zU', '2021-04-20 19:36:39', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(21, 1, 'e1cCBVJo9zATtz15isnbjegibCZ0bYfink7m4Zt686dvTJ8QM4KpwPRd6JL8gjFa', '2021-04-21 03:57:08', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(22, 1, 'cLLJsTIwBIEWhVtXartsTcboJfgGi3QeR9hqel0Eqn4nXfjjvcBRXoRqKR6dp8EY', '2021-04-28 12:15:25', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(23, 1, '2Yi1S2n0UCwWmT5CIXygQAKNKeizD880p7iK4RaikcGioM16fcgzxpTSPyZExMYQ', '2021-05-06 03:04:20', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(24, 1, 'yNApiLaYfMkpmUdSk3z8XBbWPMOWqb9TfHWmWaVvz0OjVN8nqHzzj7GNtpDb3qz4', '2021-05-15 01:15:48', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(25, 1, 'InnkGqbSCfvWzIRvyvOe1ZzTqLXBr9bXPaYBUxdWzQJy2EcZRcP9t4NJQdZMIEYB', '2021-05-20 08:38:34', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(26, 1, 'e2MJwDJyVfnqbCXD6xf4U3OckBTTdZDG6XZ7dTkT9mwR0flusQ4KxjZnCE7eoo5P', '2021-05-29 16:53:51', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(27, 1, 'bo3xI9hqDgzvTNZLenLK49t5HBQ16iKFWGSIk3SiS0l3PiD8uijKixOJVoGm1mnw', '2021-06-02 15:19:19', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(28, 1, 'VSZWbTPT7GdRJkBuiFpcefhDZkZlrvKuYlJ5jpcM7nIjtUWEsQ4OVZnYx1qkMwBt', '2021-06-06 10:01:00', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(29, 1, 'lFaLAXsXV2YlHYPDbEH3VPB1UgKVcOiY0hKQowOFM4nY5BD3zXOSxwOla2wIAnf6', '2021-06-07 00:28:06', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(30, 1, 'C55ZIwHD3FMxX9eUb8XDdjMgi8T6NbXLZdKYJaNB4oxdLhuo3ba6nJrPXRzahk55', '2021-06-07 12:11:10', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(31, 1, 'rzshJZnkTWD6DOAgGSzVXAsmv7PiesPyHm7ESW96naR5uHL29f1GrVqOpAvq7yTI', '2021-06-08 19:00:34', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(32, 1, 'PE70H8loJrk9m5PU3DQv1QG3q2x0kwphe5PoPbXUNAuYSDXEhCbdgFUc6SN4U4c0', '2021-06-08 21:47:10', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(33, 1, 'Ocdnd1iyRWrdyULhMcQwgqfsDpAmjeFdHI9ncoaiXYjZ1WVUpXtDnFJ0DkIEJEeX', '2021-06-09 09:45:25', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(34, 1, 'roEYyw6pMIIhQe6dTBSAlIciO8I4BmeEUUjvW7gHzZSBWEjEPA9TjM89DUixHzU9', '2021-06-11 07:10:17', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(35, 1, 'OpyWmY2LBFl8yL1OkSExlHL02NdgG4zg0xWFzF4mshxWF82bLv7MPEqxZYozdCBU', '2021-06-12 17:36:02', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(36, 1, 'SQYVDTr4SyMHwV0maO217ApRSTbfzci43D2iZREYPkpVkOxhn3eSdTEHhArrO6jD', '2021-06-15 01:43:06', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(37, 1, 'hgupBsVUc2qLMAEirp0EUzFcDPlLnZpqKXtxvHvUq6NcwgHFngKWLpmodY0bt1xO', '2021-06-15 09:46:21', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(38, 1, 'jl2Eac8Nr31PljOhcNgoRPFL7Hmv3yYrTFmsaa9gQqfUq9kEUKaDgijo8CZFrtdS', '2021-06-15 11:46:15', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(39, 1, 'gqsOsntlPx4iWcfotXAON9idZWHoTocReSq8ySwnU4OzegFno7Si1AUgeI67eNNc', '2021-06-16 18:04:52', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(40, 1, 'OkVHMka3NZHGYANxOqCWP968GvbOIxg8YiZAgz9yk7mIJh7OAFyZNjdUk0csoW6b', '2021-06-16 21:18:01', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(41, 1, 'N3bIGM0qkxQfhDu7XMR0LaO8gsP48FnNbZwTW3UAzGaSRc0mAzi49Raw5oc7LInO', '2021-06-17 18:48:23', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(42, 1, 'ConWbRXooZ8YVZgWsrWvuc1MPDMaLp7tXVor5CDJEJuWc27i3JQMGA8dSotfq6Xo', '2021-06-19 02:41:18', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(43, 1, 'C5AK3KfL0ijzPNjFD7JauYaM9cgqRmDxePBQ2DoS56BMNAPpBGv20kuKiE9oKlw1', '2021-06-20 00:10:55', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(44, 1, 'KyeAEOTKRNJDYQHYrJmTYBXdTMdz0rTn5S4i1r4JmwYCetn6pBhHFo0GZfRbkYGh', '2021-06-20 00:14:31', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(45, 1, 'IRkG60REmZnSVlNT0faeptCh2wTyyKHKPbQHOaIlVMCGDGRa0GyBm4qWeeAVbxwA', '2021-06-20 00:20:44', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(46, 22, 'e0Ebk7C7P3NvmyFLbKFWEl5GaYpvQbMLI1DAVFrSjF1qX4Zq6aKR8yFIa5r7BJCM', '2021-06-20 00:22:09', '2021-07-20 00:00:00', '', '', '', '', 0, 1),
(47, 22, 'umAbi8BuMyPl7eBlF0KicesDvgCZruBH9ol488R9NZg4DyGP4mYIxFmSf0WPHjvF', '2021-06-20 00:24:20', '2021-07-20 00:00:00', '', '', '', '', 0, 1),
(48, 1, 'RR2zB1s8LTZkd21JNnTAf9GyeRL0lZH12CPdUgLOUCFGft5ex6PwkVinzuTk4MxF', '2021-06-21 11:35:55', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(49, 1, 'hedtc9cDNoi0xivE754kWJV78vE2QsfJHRgiCVkeZYXEdiOiYAEA3nAYNciXYrn6', '2021-06-21 14:23:33', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(50, 1, 'I8RIu8zbthvRVU8OZ45Cz4hwW1qvptfXXNl8QQsVhb1rzhcPv5AeyehxdPNAprCO', '2021-06-21 14:35:23', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(51, 1, 'rX2PopqqtKKTJe4bjD5TT1W5UC11k52b2dMWeEcpwDn974oAZEOeNZHP6VzFdwsH', '2021-06-21 20:26:28', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(52, 1, 'YKFqENQemsl12upjFSBfbOgqhZNJzTi7JQtGmaz8iDzOluKqUaP1peNAo9roiRWW', '2021-06-22 18:03:41', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(53, 1, 'ob6rRKLuAY8CeIaxKlBqGcdTr7cK6D7u1J3sj1vptlTKyqEWKjsRTXvpAYj9xFDB', '2021-06-22 20:25:56', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(54, 1, 'jvxVRlmdQ2LZ6vyKBFX0KN06iKts4acJUzqgSWDvR9H23q7RaV9TLXnmwdRRPq9x', '2021-06-23 08:45:13', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(55, 1, 'iWJEYczHFQr3zvEnNDGQfW2gGPNhHJ8cYqk0bKSiTKxwiUN6s7loQ6L1p1kXCEA3', '2021-06-23 16:04:49', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(56, 1, 'C4J7654v0lE4MqFFcPEzOFfMhzlTIBRfjNc7pLIPJgC9yOfxTZmGnItvXwQZPQb9', '2021-06-23 16:38:38', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(57, 1, 'lfE87YatglMhULuKwPXEex8lcLvJCf2Sv96se1DvDj6SIVL4MWg8sppRC2bEW94h', '2021-06-25 10:49:06', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(58, 1, '0RkD7RdOoNv2ytcS0qKyaE6hqFNFmtHvA7aBQeZcxlAQCGmks0oQUpSdAeKx3z0i', '2021-06-25 21:22:44', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(59, 1, 'ad04llfdnKxKevrPBv4NpusqFhptKes13XILWslzuCGd8vFVKX9udz8qYcLjNzGV', '2021-06-27 12:54:57', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(60, 1, '5ihlNNUNASGJc8cbv4VQRSntQb5jwRPHjQOFnZUUxrY2vJ6vgn7qOrABrVka5ZVb', '2021-06-27 13:51:51', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(61, 1, 'TycUQH8RHOwD8GRWmJPoGr7YTbh32RABwKnFLzMdEkfXackLYC5w2te3ejikKSJt', '2021-07-02 16:29:17', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(62, 1, 'SjbZnCf26Z77nr2pVKGYhUz9OPSDcbyVWwXSkkJZ2cA8EeP7QRciqQSixnnhoC5u', '2021-07-05 12:24:31', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(63, 1, 'CnpAhU1qZbpizyVxjC8KJN0Etpv5ROl3yhqKaBKNWzuqfvRqmXY6lK2luRgQbe6Y', '2021-07-05 12:24:31', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(64, 1, 'NRBoKcudeT5YWe6rjJ0loETKn66xVX6uhzZv2ddLwzsL1QtcbqnT6nz0TSaVxqdn', '2021-07-05 18:46:16', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(65, 1, 'J80STL4uuI4a4pAqoai8omFujwogcR0OvVPbtxcpKbrRJufFUEc0yLv1OKMADUUn', '2021-07-07 14:25:17', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(66, 1, 'Z5p4JPJu888c7rO11piXY7lmHlKdMzO8KevL1CN5YQMgqa6mgdh13CoMHAw7tyak', '2021-07-10 09:10:31', '2021-07-10 17:10:39', '', '', '', '', 0, 2),
(67, 1, '4tYCCpmtnXa2j5EotatTWzozqntzg5xuJBptD8Yzeq5ci4NRv3Sl8kAso9xk0tTG', '2021-07-10 17:10:39', '2021-07-10 17:12:34', '', '', '', '', 0, 2),
(68, 1, 'KT9Nm966frGoH4pgdzzDoqwxNGvegq03QRvr7zQzS9uswPrMxE1BCEftAERceCPk', '2021-07-10 17:12:34', '2021-07-10 17:13:39', '', '', '', '', 0, 2),
(69, 1, '02UCYEZO287pXHhOdTI8TOMq0KezFaJBN5N3DvX3IsLJ9xI5Zh69ndlSNtkeWEMS', '2021-07-10 17:13:39', '2021-07-10 17:17:21', '', '', '', '', 0, 2),
(70, 1, 'UiqbLUb4RuPS6UoMBSF6lYg1lEoACrWJE9zcIYyYt4BaBmdCfOyUiNkDbmjQbZ0e', '2021-07-10 17:17:21', '2021-07-10 17:32:36', '', '', '', '', 0, 2),
(71, 1, 'wm1A6wft3xJ8jCBNLXZsGnq2FpPONVjVKnOL01dyk0JOtG24yKH32amoq71lBy8v', '2021-07-10 17:32:36', '2021-07-11 15:28:31', '', '', '', '', 0, 2),
(72, 1, 'KTVeXzaSrnE8sSlkEIZARZXVk8zBPMI1Iu2pcDa4NiZblYnjyZstu8AVzWpffLIm', '2021-07-11 15:28:31', '2021-07-11 15:29:03', '', '', '', '', 0, 2),
(73, 1, '6Nqyyfqi1EfD4VpoH8YOhBEBHCVKbNwfxNJ0S2RVWt81h2WgAPDbfsCcQCis2E90', '2021-07-11 15:29:03', '2021-07-11 15:30:35', '', '', '', '', 0, 2),
(74, 1, 'Vlliz2539l5VYfw2IkrCHl9DuQPRcZJfonz91YhDA5HshfuurL7rqFn7by7P3mvV', '2021-07-11 15:30:35', '2021-07-11 15:31:56', '', '', '', '', 0, 2),
(75, 1, 'IgjkEckHyCYUdFmrUaJ2Ix4ZM12RF8f3daxE5w8xv3RZahATRBSqxYKwr2wipde1', '2021-07-11 15:31:56', '2021-07-11 15:32:42', '', '', '', '', 0, 2),
(76, 1, 'AaV9H4PXtw9cWggxeo7OPTH9VUqqKilqwTWcbcKRtvaAOzYG6XWZZlzlNSG7jLKk', '2021-07-11 15:32:42', '2021-07-11 15:33:39', '', '', '', '', 0, 2),
(77, 1, 'UHDWOE26Bz5sxIem6w9mxFmrVGEIEqDCZZnbviqjIYetfFBDP8zQ1x5V3gGuv1GI', '2021-07-11 15:33:39', '2021-07-11 15:35:35', '', '', '', '', 0, 2),
(78, 1, '3zOhPJVQVkJyrO2hQSAaJ9O8GKkassFjsAWZzbQ12IJy7jZvuyNSEjKhZAfBE9QV', '2021-07-11 15:35:35', '2021-07-11 19:49:47', '', '', '', '', 0, 2),
(79, 1, 'HkRRnYUo7owKKRJjcA4uyFaWfUHwJOxwJBtET9z5xUIuUXIzLBPAVU6tfyN6ED9F', '2021-07-11 19:49:47', '2021-07-12 10:44:02', '', '', '', '', 0, 2),
(80, 1, 'AvMjl4ZKNpFAc20bWOhNfruShTuzXdMbDtuhijl5lZyr34HIMHkcNDoAG5qnrIEZ', '2021-07-12 10:44:02', '2021-07-12 10:47:55', '', '', '', '', 0, 2),
(81, 1, 'ADbPTpskYt9S0PECB9sqSLhDOHC6fItht3egAjOYymojsSSoi64GMrOxda9BkFBl', '2021-07-12 10:47:55', '2021-07-13 15:12:18', '', '', '', '', 0, 2),
(82, 51, 'vqKglY1PAIOmKHzF1XDd4fJs8K5lriQ3lIaoYMr5jANRYiPG06V95ofD7AK9CUP3', '2021-07-12 10:53:13', '2021-07-13 15:13:49', '', '', '', '', 0, 2),
(83, 1, 'lc2GImLMHTVoaX1kpPPetjlCTQd0zBJ0XryhKvmk2VSxuuIvtNnhX6M6BC4qEOYk', '2021-07-13 15:12:18', '2021-07-16 10:14:57', '', '', '', '', 0, 2),
(84, 51, 'Za8ecpKN8LWzS0xWKUd5Huw8bLeKygzzANNQoXLcW93z9weu6zUN7J4uhIpHD7Od', '2021-07-13 15:13:49', '2021-07-13 18:01:53', '', '', '', '', 0, 2),
(85, 51, 'M1svjXeuuHwvCG20HTpICyXludBlXThVIIYiylqWWlkyA4I4FdYL0NVCnR1dkroa', '2021-07-13 18:01:53', '2021-07-13 18:07:06', '', '', '', '', 0, 2),
(86, 51, 'aRHLPlpIo1TrUCmeZVDsAvzhvFgIPVFJzdFF43ZJTYwTkmf47v8IMlgN4bPH6H9Q', '2021-07-13 18:07:06', '2021-07-13 18:10:39', '', '', '', '', 0, 2),
(87, 51, 'AeDiOE5M97hfzXS666h5LmVlFdxFiEhiGAYdP9lcEK0t7aO4BODjsmkDTxGo1DYk', '2021-07-13 18:10:39', '2021-07-13 18:19:42', '', '', '', '', 0, 2),
(88, 51, '6PpzGhPoZOogQTZ8zu8USyXAQ9ejjhfYYdsfutcWSWsqDa7PccTiTq6a9iTcBw3G', '2021-07-13 18:19:42', '2021-07-14 16:41:29', '', '', '', '', 0, 2),
(89, 51, 'hUSSuq6dzo12oTO1Q5fUBoriTxRF9KcRuUXAWuzroBTKVLrqoZhopW7PBWPLwxnl', '2021-07-14 16:41:29', '2021-07-14 16:50:19', '', '', '', '', 0, 2),
(90, 51, 'UpZgpeMgVBjXNdazZYVBH14oLp8b7CaXR8la6FHtjWFpkfgyMksh0o04UebZqyO2', '2021-07-14 16:50:19', '2021-07-14 17:19:27', '', '', '', '', 0, 2),
(91, 51, 'GL5cox2wuufkjwgzhXQvX4tOQGBroiJx371M1IY0IETINvxlSTQE6J4n6i61q44e', '2021-07-14 17:19:27', '2021-07-16 10:15:19', '', '', '', '', 0, 2),
(92, 1, 'JX7tAsaBzcgsolYct8pdYyn4VGsODqN5NOyNqFWhJgzXBesBzka1LhIF1D33ybb9', '2021-07-16 10:14:57', '2021-08-15 00:00:00', '', '', '', '', 0, 1),
(93, 51, 'kHCz8YJSNf0EXZsmOc2dQdcF3XHQygPvbRPhP1aV14P0EVWfyA5mj1Y0rjAFSyke', '2021-07-16 10:15:19', '2021-07-18 11:18:28', '', '', '', '', 0, 2),
(94, 51, 'LdESGbcTwm3Hr7XLhSGFeGICxYiw9Iruic83A1YSkJtYk0SlsXJqHnBspLGzPOM7', '2021-07-18 11:18:28', '2021-07-18 15:23:28', '', '', '', '', 0, 2),
(95, 51, 'YMvYijuuN0Q887SeqdtcQjcJKAoZC2Fe8igGmAONioLpqu5ZjjnAuOW4xHXjuGEZ', '2021-07-18 15:23:28', '2021-07-19 11:11:39', '', '', '', '', 0, 2),
(96, 51, 'iJRJOjTduoDkiH1MCAmNueJSxftTPwUTTMDq6hDPiYxRJ5gsDx6z0hPYfQOPKvpA', '2021-07-19 11:11:39', '2021-07-19 11:18:15', '', '', '', '', 0, 2),
(97, 51, '7MP4oTRoTUqwapbn5ipxnAgFJHB0Mwj3ATKHA0RHJEm5JfNzTRChrlLkmYiFRG5o', '2021-07-19 11:18:15', '2021-07-19 22:03:35', '', '', '', '', 0, 2),
(98, 51, 'yZYXSMiZxmEK2EixDblpvVgnwtvYgBJnhDs1p1mojd6FgkfEPq3ws70yRcVkfdMV', '2021-07-19 22:03:35', '2021-07-20 13:05:14', '', '', '', '', 0, 2),
(99, 51, 'mm9KakYr7GAvY5kcULVnBsPkGZWg1IwnhsVzuAnJ3lpU45PH4Qfs73l9dRqgTn8U', '2021-07-20 13:05:14', '2021-07-21 09:55:05', '', '', '', '', 0, 2),
(100, 51, 'nZYmb3wD6deOgi5sZ66ns5agFHsPRK6n734xC0ZgMJddqDxr7MBnMiMJuVYPmeIT', '2021-07-21 09:55:05', '2021-07-21 10:01:23', '', '', '', '', 0, 2),
(101, 51, 'hfHADKBPU3LZnFsDFEdaRc3KYuqAlCf5ufoXy1lKIcClHskmqDJFITmVvN4u1m9a', '2021-07-21 10:01:23', '2021-07-22 08:48:15', '', '', '', '', 0, 2),
(102, 51, 'uGytEQVpjAsmMB4T2toTFj8TJCMnvV4f5SpLr8yGuSjsOnJTxOkqJ8aCY377Uhs8', '2021-07-22 08:48:15', '2021-07-22 09:26:25', '', '', '', '', 0, 2),
(103, 51, 'Bm5Yhp8xNhWUyS0U9pcIAXpnzPFuubyfPE6HDYZmZzYPjOBEWOFAwdHsSn4IBZ0D', '2021-07-22 09:26:25', '2021-07-22 09:35:08', '', '', '', '', 0, 2),
(104, 51, '2CLs044AUSCqMdIZsCfrllLFee03Rl3MqIg4Exrg61RbbC7T2m1KpZOF1DM57Mm2', '2021-07-22 09:35:08', '2021-07-22 09:36:16', '', '', '', '', 0, 2),
(105, 51, 'K6vyyKbF3nsFMDe9Vl6El4oYRlANNb0XXroOpqIa7VlJ8L37U9dTrlrSha18LamW', '2021-07-22 09:36:16', '2021-07-22 09:45:41', '', '', '', '', 0, 2),
(106, 51, 'icROw7Nfn8kTcK0YmbqGfzR6D5FuGKOHSwKDWS7uPgy0zNzKETt66AE9euweHmJ5', '2021-07-22 09:45:41', '2021-07-22 16:43:26', '', '', '', '', 0, 2),
(107, 51, 'Q45qtb1BhBGdKUKEKlyC6bl7aL41GDkvtnZw9T2oPwGD9fcDSNbu3t75dwtWoVMO', '2021-07-22 16:43:26', '2021-07-23 10:14:59', '', '', '', '', 0, 2),
(108, 51, 'f2Dv4hosyZpPcOF54jl5GRfrBaLqwmsd61tVHKJAujRdYXpwopNjhFUkmZumH74T', '2021-07-23 10:14:59', '2021-07-23 16:06:22', '', '', '', '', 0, 2),
(109, 51, 'YmJPTEbVE5MzxF6N2rLW2JIrHAmLhCWKzn1G9oTlNtdxofdf76IBnuauwMA7l351', '2021-07-23 16:06:22', '2021-07-24 09:34:05', '', '', '', '', 0, 2),
(110, 51, 'EdU5Zeezu9jXnVO0JGLpC2ruj7oGx2vdlQ5JEIzgy9NQD8GEDrELx9xOcK9nucZ1', '2021-07-24 09:34:05', '2021-07-25 07:56:32', '', '', '', '', 0, 2),
(111, 51, 'nmtdz4CprUfXxD1CQNx3eeqIwvAx84yShpUKPnLHuXDEfGH4fSp4bJUYltAjsFJD', '2021-07-25 07:56:32', '2021-07-25 12:24:48', '', '', '', '', 0, 2),
(112, 51, 'tpVpLqcdeY8QAQkGSdBYRlP4r67FCIuTlOpjevX1LQz35Bjgdis6oZzbOcuOv6SC', '2021-07-25 12:24:48', '2021-07-25 17:01:10', '', '', '', '', 0, 2),
(113, 51, 'hth3HMvXowEQWLbqHJHNczMQ61WLYsRz8h9Xhiu0UpFKlua12nmhdMybD9ucjXMR', '2021-07-25 17:01:10', '2021-07-26 16:39:03', '', '', '', '', 0, 2),
(114, 51, 'HFLdblevWVnazIpzH9aT66NMNm3NgoAZ30a4tKcg8n6qqgZEXeG5DGtaf0H8YVMT', '2021-07-26 16:39:03', '2021-07-26 16:50:33', '', '', '', '', 0, 2),
(115, 51, 'qo68TU1C95p5dFQyD7JcykxQ9VEGUepTomdqXo9VMsPCNK7DsuSXIgPIExeoKdg8', '2021-07-26 16:50:33', '2021-07-26 16:50:36', '', '', '', '', 0, 2),
(116, 51, 'tKJe1Ut16qOHSXijOEAFfZJ9aWWi4SCtizIUQ2pbZQXsgXQ8tsrwsTEhTWF8BPrc', '2021-07-26 16:50:36', '2021-07-26 17:41:18', '', '', '', '', 0, 2),
(117, 51, 'o4zLU0JcIs32sOAgUquSealdY0Z44sfmkTvgRZAZIONIuERTH5KATNEsWeHtO9ig', '2021-07-26 17:41:18', '2021-07-26 19:27:50', '', '', '', '', 0, 2),
(118, 51, 'cumwlsq02HXrol58Gx0aC8T3M7Z1V3VlcisfzVNR65miNlzufh9aTzkTQVLv2FWA', '2021-07-26 19:27:50', '2021-07-26 19:30:05', '', '', '', '', 0, 2),
(119, 51, '4wYcWtCcO9CQlYpiWJkINT4c7VuevmDy1Sw7og16P8M40B4CRkmcrD6PpXfrldGY', '2021-07-26 19:30:05', '2021-07-26 21:13:57', '', '', '', '', 0, 2),
(120, 51, 'zi7cjjxE3C9TgftsDw72iPN0LwPiBAcBtRHnsLaXeaGA7tcMarNeJbp1C4bRsYFb', '2021-07-26 21:13:57', '2021-07-31 00:07:26', '', '', '', '', 0, 2),
(121, 51, 'G9QM2fMU2u7Ngq0OVeJvjuf0kcGS4HvJuvwxqqvqAT2jgU6YmbqeCntMq6igpYvR', '2021-07-31 00:07:26', '2021-07-31 00:07:49', '', '', '', '', 0, 2),
(122, 51, 'BOxTqBroHqbPM6f7qGTtqCb2quA9XMlGiyE5hhWJ4s2iG4TxEqqaby37w7juYlI7', '2021-07-31 00:07:49', '2021-07-31 00:12:46', '', '', '', '', 0, 2),
(123, 51, 'Z9XivYIVvrU4IrRilJbzasiGtieCtnBgghVQeReqAqNqdqurLLXEIlfn7zuMRgG0', '2021-07-31 00:12:46', '2021-07-31 09:30:07', '', '', '', '', 0, 2),
(124, 51, 'PUyz1j0hIFWSRnwd2hR4Br3opoi0GOwyLuDzXPEOCcwPLhQkmgfo5pQJmFjamjKF', '2021-07-31 09:30:07', '2021-07-31 10:31:15', '', '', '', '', 0, 2),
(125, 51, 'Rxb5lAEyldy6ZxpNmYTAE3oMNKoIVOXamoj9lJSzJyXSkYG4fTyaqYFVHXBFUcdl', '2021-07-31 10:31:15', '2021-07-31 10:37:05', '', '', '', '', 0, 2),
(126, 51, 'DldeDKIQ901xZKWxNwuY8mxPcCCHUAnmRm3HVLKktAr5EDouIbqkT4sd3wRz4nfs', '2021-07-31 10:37:05', '2021-07-31 14:49:28', '', '', '', '', 0, 2),
(127, 51, 'W72bollPp6yXL0liIKID0gONeDvefWSe0vHvclA59WZDsx0ByonZMXviInp2kNsK', '2021-07-31 14:49:28', '2021-07-31 14:50:22', '', '', '', '', 0, 2),
(128, 51, '8AAlNyuK28Xbb7bAvDf3hsYk3FbsTkx3jPawYcRStFX58Enru79EVVsuDV2f1wba', '2021-07-31 14:50:22', '2021-07-31 14:50:22', '', '', '', '', 0, 2),
(129, 51, 'pwIfglBNHKkos30dKor08GOO8hhhDIDgfLhyoCueGTBrY7m0es5rU2ZaLkksxziF', '2021-07-31 14:50:22', '2021-07-31 14:51:24', '', '', '', '', 0, 2),
(130, 51, 'NDWlrSbnwJ1Zo9YrY9pD12EYrnTImMB6OvDcGGm6Ib87i8PaWSZ1VehpkHEdfuiY', '2021-07-31 14:51:24', '2021-07-31 14:56:41', '', '', '', '', 0, 2),
(131, 51, 'jme7K6lSitqAU5CLvCHSsMcrS9dfXDOPlts1ftRJK6HxdO8q6WduyjKuHYAIpOF0', '2021-07-31 14:56:41', '2021-07-31 15:38:12', '', '', '', '', 0, 2),
(132, 51, 'MNpOKM5KWCilwaub86FKVqqkWNvGOSz91hKU25bA222abWAMkRWpyJ31WXCvhXtY', '2021-07-31 15:38:12', '2021-07-31 21:31:54', '', '', '', '', 0, 2),
(133, 51, 'J9lRqHOWkC2BYSMEbgCpiMumaJNSvyFXPjQTytXfM4lUuXGEB3nsSE9GxOIOW5TW', '2021-07-31 21:31:54', '2021-07-31 22:48:52', '', '', '', '', 0, 2),
(134, 51, 'WV64ZOv1tCXdV5VwNlDUWx7EksSI124OFT0L9yfoGjjeleCgrU1y0YnSzAMqACWd', '2021-07-31 22:48:52', '2021-08-02 09:17:44', '', '', '', '', 0, 2),
(135, 51, 'rEFfYD3vq3xH24l7tE3TACYYMBIkjLwi73w2JxXJhDwBzmEFaTSAdkgRi5WjI8J8', '2021-08-02 09:17:44', '2021-08-02 09:19:13', '', '', '', '', 0, 2),
(136, 51, '19IsjFt6iVJKiJl8E2GEIxFWoKvTtRFmSllFH2bYePDj3eQQkOApEbxwtKqTFKmx', '2021-08-02 09:19:13', '2021-08-02 09:23:26', '', '', '', '', 0, 2),
(137, 51, 'ueRDYAjGxn8mowvQWT8Yxs6s4wfBxqZKTzzanUZ5nKucKSFm8JJJyBiUufG4770Q', '2021-08-02 09:23:26', '2021-08-02 09:24:17', '', '', '', '', 0, 2),
(138, 51, 'v4xLr17gdP9RpgwNPhV511r1FUpErzS3kf0aLEYzvWqOflzqy7FCgv2qqQmajNU3', '2021-08-02 09:24:17', '2021-08-02 09:33:46', '', '', '', '', 0, 2),
(139, 51, 'rJzEfWgW8EC0RgeckFSgCUgiVk09b0flgcQGp3NHoHsLW64m4pheH7PJeFny5u3W', '2021-08-02 09:33:46', '2021-08-02 09:36:04', '', '', '', '', 0, 2),
(140, 51, 'Hs1Ro5mU4tlquABf6sMH6FsrhwdNH7PussVBbPusLZHf8bBoIdxfdh8Xj3jX69ss', '2021-08-02 09:36:04', '2021-08-02 14:17:54', '', '', '', '', 0, 2),
(141, 51, 'wRZW4xQV7ANKX7LfafgSDdoTnY0kTCCF9b6nBGYhlHh3yydr0HjRrLR5sRCW5oc7', '2021-08-02 14:17:54', '2021-08-04 13:41:21', '', '', '', '', 0, 2),
(142, 51, 'fmahE8uFEPZyA5DOEcekFbW8E3GHP7o4s6nzuzCamVoWiRfxB5dwBEYoU3LnbQUs', '2021-08-04 13:41:21', '2021-08-04 14:19:49', '', '', '', '', 0, 2),
(143, 51, 'mOZ9ArUwuALD1gZ1IxgdMHnQfJ33vGijab6I4Y1huJTOwjZcJgitiVEy09YEGn7s', '2021-08-04 14:19:49', '2021-08-04 17:16:10', '', '', '', '', 0, 2),
(144, 51, '7yCmRLh3XC5QqmmLarOrUl7k0t7WkS9weyViCdiOFsa9qWtFmRJZSWThwPVbtCMZ', '2021-08-04 17:16:10', '2021-08-06 09:40:23', '', '', '', '', 0, 2),
(145, 51, 'H1ePsLOHr16RoVShypXoCm6Uvehe0LwOXtOrGQJyro74j2vtXvSZSWBQrVaH4ISZ', '2021-08-06 09:40:23', '2021-08-06 21:11:12', '', '', '', '', 0, 2),
(146, 51, 'pT7bLzt2vIZcTpAJ61L3fBn2zsTZfdR5Nhwa6e0KO635gedcxtrjXWKJhrJvsLd8', '2021-08-06 21:11:12', '2021-08-08 14:09:50', '', '', '', '', 0, 2),
(147, 51, 'v0ueev8D9haYxKEPQKGZtZ6rzF47TskezGJ6fmSKFr6HIIqBHQxzDKDN0EbNAeEG', '2021-08-08 14:09:50', '2021-08-08 21:56:45', '', '', '', '', 0, 2),
(148, 51, 'ADGbX9GEbXm2ooC8kqK43eCtFAwc5oOWxaGxA6e4kTTsVcr0BXBINF3FND1tzfEo', '2021-08-08 21:56:45', '2021-08-08 21:58:59', '', '', '', '', 0, 2),
(149, 51, 'D2K2QAIRn2LmB1xyjQqidaqSxFNtgxqUxPNSahY2VUKrX9o8VJh2klqrHwwAVF01', '2021-08-08 21:58:59', '2021-08-08 22:27:32', '', '', '', '', 0, 2),
(150, 52, 'nZk4lWMRmrOJA2sGVWWkUfiYOJLcJISOrNxZoU9uM9YpVnMBa99r7ZR6wO6m1HEw', '2021-08-08 22:27:01', '2021-09-07 00:00:00', '', '', '', '', 0, 1),
(151, 51, 'ZCWaMOU0hZHB81dkokERIBBDS4D2W4piblUFDXYLKljCF1haUxgzX5uVE4C0zg5y', '2021-08-08 22:27:32', '2021-08-09 17:54:41', '', '', '', '', 0, 2),
(152, 51, 'sn91j7Ntw3WLDX65VtEM0tQcPAWSX2FfTtqlTIH8OTjqT5IsnHB9yXYOYDVk4Mef', '2021-08-09 17:54:41', '2021-08-11 09:32:56', '', '', '', '', 0, 2),
(153, 51, '1TOw90B68kjsTG0HFTrsb4ibMBjxUrASIB2oZipvl52GIrQJ7SMT8NdeNH4halXc', '2021-08-11 09:32:56', '2021-08-11 19:31:12', '', '', '', '', 0, 2),
(154, 51, 'kXMQcePnBi2u8Ug4Cz8kbIjpFEYn833vC4wkYipw5zEBhTo4fmEIsTqX6tuhmQhn', '2021-08-11 19:31:12', '2021-08-12 14:23:07', '', '', '', '', 0, 2),
(155, 51, 'I4Kw4ec58rfF8VGoQWuS9V00h3Z79QTGcNEp8t5oq5DIkpkKzq9XKU5Nui4bP2PM', '2021-08-12 14:23:07', '2021-08-12 15:08:04', '', '', '', '', 0, 2),
(156, 51, 'lPHm7dPmmQbFXyMqnq0fF7S8Bgy7Oa7UR6A8Xpkpt85WhyAPYKNQs9E3R8Eg8G8p', '2021-08-12 15:08:04', '2021-08-13 22:50:38', '', '', '', '', 0, 2),
(157, 51, 'fdATG6byNgnUwkHvz45ql3eQbSFuBuZvudQZ26rjkiwYnzSY1TVNl5zx4G3SFZR1', '2021-08-13 22:50:38', '2021-08-13 23:05:03', '', '', '', '', 0, 2),
(158, 51, 'lIggenz69qFtCCP7YuOEHMsfLlzveFYaivmQHI15EIWjCHU1GKCqI1v8hCG7qIHD', '2021-08-13 23:05:03', '2021-08-13 23:05:04', '', '', '', '', 0, 2),
(159, 51, 'hzIGlFwslmIOy1LQk5yWokGKOSNaOxKc1z03t6KizP5hxyxy7QQqsX22EbonHs93', '2021-08-13 23:05:04', '2021-08-13 23:11:19', '', '', '', '', 0, 2),
(160, 51, 'inZ1c7enZ83HeeXcTaFpKcvjTMSiWstA1KFYzH0NJn2utky6q03VdmMUkYht5Oo8', '2021-08-13 23:11:19', '2021-08-13 23:29:20', '', '', '', '', 0, 2),
(161, 51, '9eZrsThMoGpAAJ9ovO6NycAkn8rxkHIKHUCYkIrgbsP9NVPMiOIdLOfUpQehtJXg', '2021-08-13 23:29:20', '2021-08-13 23:43:51', '', '', '', '', 0, 2),
(162, 51, 'cNz2TX287YxU4SXW8UHjOOHbFLbRXBBg9TDWF2SGdPcFUPSP1U1jKVh2RzBppWHq', '2021-08-13 23:43:51', '2021-08-13 23:43:52', '', '', '', '', 0, 2),
(163, 51, 'imwelYa9J6DTH33MR0kwS4A7hrmFQKagZLud6ZBwhOwWChmSu8WV8cAsEcKdTVpY', '2021-08-13 23:43:52', '2021-08-14 08:35:13', '', '', '', '', 0, 2),
(164, 51, 'Qh7lfejGqRcDVCK4mBvKKTWjqlhWFBu9idj0exjBmTczm7JaXa11Mv3RafCRn0DH', '2021-08-14 08:35:13', '2021-08-15 17:33:46', '', '', '', '', 0, 2),
(165, 51, 'OuT26TEYzS1FG2uLjKhU1BDsLPtceVVqxyOQpefZWuar1Jjs5X5uRZiGKBwCLa2D', '2021-08-15 17:33:46', '2021-08-15 17:57:50', '', '', '', '', 0, 2),
(166, 51, 'fVsZwrCPdk2hU04wBsODvG44TxUMcxMmf1AuM0EK6zDJ4FAzhDoPP4eapwP9PKgo', '2021-08-15 17:57:50', '2021-08-15 18:01:11', '', '', '', '', 0, 2),
(167, 51, 'a93o9zAGJ7oY1WziZbjpbgGIQu2prmyDXzETtXT5cXIlf3hcrw8IY42zJGvzoiMT', '2021-08-15 18:01:11', '2021-08-15 18:01:12', '', '', '', '', 0, 2),
(168, 51, 'gYRLhCI0raXMjGvRzCFfeRKL8x52lu5isCKSycWSqJAmu0WPAusN8xYOCvDzOUVY', '2021-08-15 18:01:12', '2021-08-16 09:40:41', '', '', '', '', 0, 2),
(169, 51, '2UTPZyBvY8z2OnzrU8HOk2lUfVMnlMM4nT7PyLlDs6Z4cgpAnNvDkN0k3UYSHw2G', '2021-08-16 09:40:41', '2021-08-16 09:41:49', '', '', '', '', 0, 2),
(170, 51, '2fUCXP7YGv18tn4FzUIqXeLehr81qRAYon1iKGvwU7FczqgIFzvGSWe283WRXhOf', '2021-08-16 09:41:49', '2021-08-16 09:42:32', '', '', '', '', 0, 2),
(171, 51, 'zAOaoVLybt1DfajQTznIErhDuuH949N9jI2WVw3QlUgblJOo4e21eXv4lhOLfGDp', '2021-08-16 09:42:32', '2021-08-16 17:02:06', '', '', '', '', 0, 2),
(172, 51, 'Y4RkcFfm6mqmB0ZEXmK3GSV5g1cSOR1ozPARFvXINn5BW20Z1olH9edlHMRqiglJ', '2021-08-16 17:02:06', '2021-08-16 17:19:55', '', '', '', '', 0, 2),
(173, 51, 'bXJL7gvLVWHZ71wBQYMOelX5NC4sYJfJMBmVj6c994ln60JJrZMaJUOYf9ylJsgu', '2021-08-16 17:19:55', '2021-08-16 19:40:29', '', '', '', '', 0, 2),
(174, 51, 'fWr1KjYfX0oyuSefuRr06mvWeuARY07TpRrMLJ8Ytx8tzuTIJDIorSLSVstX91zU', '2021-08-16 19:40:29', '2021-08-16 21:40:57', '', '', '', '', 0, 2),
(175, 51, 'zcnwZxYP87mbPMTjLbRuE1niATWRic9XbE4dn69xafoUKZijlg99XLQXOoQeiKOn', '2021-08-16 21:40:57', '2021-08-16 21:43:03', '', '', '', '', 0, 2),
(176, 51, 'uuXrqTMt2BdLps3J3fbnOOxqOifzM0G5C1C75oz7469ofUxA0cE3lwx2762CqNi7', '2021-08-16 21:43:03', '2021-08-17 09:51:21', '', '', '', '', 0, 2),
(177, 51, 'OwxGA22uG2CEiwFAISwl3iCTdOFCwENukJIZgvMT8rw7EfCvsCtu7Bh0qlcCZe63', '2021-08-17 09:51:21', '2021-08-17 16:48:18', '', '', '', '', 0, 2),
(178, 51, 'zzbghOxxItZpmoFvloJgibIzMePgXcbMXqaWBqngbpesRTDqRaDc6YzpB5Nv88VW', '2021-08-17 16:48:18', '2021-08-18 09:45:33', '', '', '', '', 0, 2),
(179, 51, '510ALtOjUlAluSuTo1X3IGHbORPJcAVBcNhjW3FUEnI9Qxs9URmu6c9vCfimQ0U5', '2021-08-18 09:45:33', '2021-08-18 09:56:01', '', '', '', '', 0, 2),
(180, 51, 'mADUk1hSpLfvMDQ11X03TxFmD5bssHP42hUijkF4vrB768h9q3Rl9Fkwlj53JzSy', '2021-08-18 09:56:01', '2021-08-18 09:56:38', '', '', '', '', 0, 2),
(181, 51, 'N0dAfOOc0bfPOvKqBELXG0IA1aZqtIv6LsoXCkY44p7kXHIVustoEVAI9ZxJ0Gwf', '2021-08-18 09:56:38', '2021-08-18 22:26:03', '', '', '', '', 0, 2),
(182, 51, 'n6wNHGuIe2fLCKfAgqfuCmvzrbBTNsRDwwU5g6a3EJ8usqM9sm0XvcEjmmDg5z03', '2021-08-18 22:26:03', '2021-08-24 17:29:14', '', '', '', '', 0, 2),
(183, 51, '6xceyeFB4Na0Q4IZA8x5vXx2piCz7ZJBrxrbV5HMv7649SzvmdAEFH9J2LBOTo3Q', '2021-08-28 08:44:40', '2021-08-28 11:34:10', '', '', '', '', 0, 2),
(184, 51, 'JdBuBCoixiqlaGNegEIaj4Z3UIJula34UkQt87ATExIz9JCHrtrWtX8n2OuEj6k1', '2021-08-28 11:34:10', '2021-08-30 10:42:21', '', '', '', '', 0, 2),
(185, 51, 'LKlCktEreKLE2dUAV4KPu7mAha7G8I2j16yaKxhFQjdqAW9ntWlDLST2HCQ5H0aR', '2021-08-30 10:42:21', '2021-09-29 00:00:00', '', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_towns`
--

CREATE TABLE `o_towns` (
  `uid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_towns`
--

INSERT INTO `o_towns` (`uid`, `name`, `county`, `status`) VALUES
(1, 'Nairobi', 'NAIROBI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_users`
--

CREATE TABLE `o_users` (
  `uid` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `national_id` varchar(15) NOT NULL,
  `join_date` datetime NOT NULL,
  `pass1` varchar(128) NOT NULL,
  `user_group` int(5) NOT NULL,
  `branch` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_users`
--

INSERT INTO `o_users` (`uid`, `name`, `email`, `phone`, `national_id`, `join_date`, `pass1`, `user_group`, `branch`, `status`) VALUES
(1, 'Jonah Ngarama', 'ngaramajonah@gmail.com', '254716330450', '', '2021-03-20 04:45:58', '1e4b269b4bc2c44c056548bb7f7fab9e78eee0bf0ca2ee1c6e8845f96f07489a', 1, 0, 1),
(2, 'Jonah Ngarama', 'mercynjqoki@gmail.com', '254716330550', '', '2021-04-06 10:55:52', 'a6bbe9af46a0689baedc2bf76974a4de36dfb585dc40056046bf0d080491da2e', 1, 0, 1),
(5, 'Mercysd', 'sddsdsd@jsdusudus.com', '', '', '2021-05-07 07:08:02', 'DypLGHvEXa', 2, 1, 2),
(9, 'Test test', 'ngaramaejonah@gmail.com', ' 254716330451', '', '2021-05-08 09:31:46', 'ye4g7xtSxa', 3, 1, 2),
(14, 'Mercy X', 'mercynjoki@gmail.com', '254716330451', '', '2021-05-08 20:22:25', '3SXpxjFmnO', 2, 1, 1),
(15, 'Mercy X', 'merdcynjoki@gmail.com', '254716330453', '', '2021-05-08 20:23:38', 'uJgZlmkQw8', 2, 1, 1),
(16, 'Another', 'ngarameajonah@gmail.com', '254715666343', '', '2021-05-12 14:26:50', 'sFOaX80f1K', 2, 1, 1),
(17, 'The Quicl', 'ngaramajonarrh@gmail.com', '254716730450', '', '2021-05-12 14:27:57', 'Ymg5p7S2ao', 2, 1, 1),
(18, 'The Hallo', 'mercynjqoki@gmail.comf', '254789887778', '', '2021-05-12 14:28:28', 'UuYv5MKNcr', 2, 1, 1),
(19, 'Newton Gikaru', 'newton@gmail.com', '254756663663', '', '2021-05-12 14:29:47', 'SGGvs8hRLV', 2, 1, 1),
(20, 'Nzirani Mwende', 'nziranimwende@gmail.com', '254716330457', '6787787', '2021-05-12 14:31:02', '538606721eb54c4f8a92124994a02bb612bcb546020be380f247f07867aa7847', 3, 2, 1),
(21, 'jonah ngarama', 'ngaramajonah@gmail.com11', '254789330450', '567654', '2021-06-20 00:18:05', 'bb0f5872ac86548d90be04688c3d99de19550e7abc98c1b7d316f2e1fd82b90e', 2, 2, 1),
(22, 'jonah ngarama', 'ngaramajonah@gmail.com7', '254716330870', '123456737', '2021-06-20 00:21:47', '8da143a5de9523eb95bba84949c4539a17b649045d74ed2f75c1bc9807a5188d', 1, 2, 1),
(50, 'Samuel Munyi', 'samunyi90@gmail.com', '254112553167', '3209876543', '2021-03-20 04:45:58', '190e94b55e3678bb4d643e76968000eda840142ab79e3638c41aed8a44b54795', 1, 2, 2),
(51, 'Samuel Munyi', 'munyisamuel3@gmail.com', '254112553177', '32909210', '2021-07-12 10:51:40', 'a2bbc0d689af1e9f149912fe17cf1f2e85a8f3aa24a7e1cef398676188e909ca', 1, 1, 1),
(52, 'Kelvin Kilonzo', 'kilonzo@gmail.com', '254711567098', '327069', '2021-08-08 21:51:50', '6fadfcde0d900ce80339f2c0afe6da57f15b425321c300232c05e7f512fbee4c', 3, 2, 1),
(53, 'Sam Munyi', 'munyi@gmail.com', '254709123095', '2345671', '2021-08-12 21:18:13', '32e3c496ab8b290946c6cccc6a6e49d4d99ae777e289856922ebe481174f1638', 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `o_user_groups`
--

CREATE TABLE `o_user_groups` (
  `uid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `o_user_groups`
--

INSERT INTO `o_user_groups` (`uid`, `name`, `description`, `status`) VALUES
(1, 'Super Admin', 'Given rights to do all operations in the system including deleting data. Some rights are assigned by default ', 1),
(2, 'Admin', 'Restricted Administrative Functionalilties', 1),
(3, 'Front Office', 'Minimal Permissions to view and add information', 1);

-- --------------------------------------------------------

--
-- Table structure for table `platform_settings`
--

CREATE TABLE `platform_settings` (
  `uid` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platform_settings`
--

INSERT INTO `platform_settings` (`uid`, `name`, `logo`, `icon`, `link`) VALUES
(1, 'SBS   ', 'LOGveR5ZOWnphqGzcECn8ljk5.png', 'sbs.ico', 'localhost/onepay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `o_addons`
--
ALTER TABLE `o_addons`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_asset_categories`
--
ALTER TABLE `o_asset_categories`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name_` (`name`);

--
-- Indexes for table `o_branches`
--
ALTER TABLE `o_branches`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `branch_name` (`name`);

--
-- Indexes for table `o_campaigns`
--
ALTER TABLE `o_campaigns`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_campaign_messages`
--
ALTER TABLE `o_campaign_messages`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_collateral`
--
ALTER TABLE `o_collateral`
  ADD UNIQUE KEY `collateral_id` (`uid`);

--
-- Indexes for table `o_collateral_statuses`
--
ALTER TABLE `o_collateral_statuses`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_contact_types`
--
ALTER TABLE `o_contact_types`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_conversation_methods`
--
ALTER TABLE `o_conversation_methods`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_conversation_outcome`
--
ALTER TABLE `o_conversation_outcome`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_customers`
--
ALTER TABLE `o_customers`
  ADD PRIMARY KEY (`uid`,`full_name`),
  ADD UNIQUE KEY `primary_phone_` (`primary_mobile`),
  ADD UNIQUE KEY `national_id_` (`national_id`),
  ADD UNIQUE KEY `email_address_` (`email_address`);

--
-- Indexes for table `o_customer_contacts`
--
ALTER TABLE `o_customer_contacts`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_customer_conversations`
--
ALTER TABLE `o_customer_conversations`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_customer_document_categories`
--
ALTER TABLE `o_customer_document_categories`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_customer_referees`
--
ALTER TABLE `o_customer_referees`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_customer_referee_relationships`
--
ALTER TABLE `o_customer_referee_relationships`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_customer_statuses`
--
ALTER TABLE `o_customer_statuses`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_deductions`
--
ALTER TABLE `o_deductions`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_disburse_methods`
--
ALTER TABLE `o_disburse_methods`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_documents`
--
ALTER TABLE `o_documents`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_events`
--
ALTER TABLE `o_events`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_flags`
--
ALTER TABLE `o_flags`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_guarantors`
--
ALTER TABLE `o_guarantors`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_incoming_payments`
--
ALTER TABLE `o_incoming_payments`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_key_values`
--
ALTER TABLE `o_key_values`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_loans`
--
ALTER TABLE `o_loans`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_loan_addons`
--
ALTER TABLE `o_loan_addons`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_loan_deductions`
--
ALTER TABLE `o_loan_deductions`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_loan_products`
--
ALTER TABLE `o_loan_products`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_loan_stages`
--
ALTER TABLE `o_loan_stages`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_loan_statuses`
--
ALTER TABLE `o_loan_statuses`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_log_updates`
--
ALTER TABLE `o_log_updates`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_next_steps`
--
ALTER TABLE `o_next_steps`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_notifications`
--
ALTER TABLE `o_notifications`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_passes`
--
ALTER TABLE `o_passes`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `o_payment_methods`
--
ALTER TABLE `o_payment_methods`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_payment_schedule`
--
ALTER TABLE `o_payment_schedule`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_permissions`
--
ALTER TABLE `o_permissions`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_product_addons`
--
ALTER TABLE `o_product_addons`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_product_deductions`
--
ALTER TABLE `o_product_deductions`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_product_stages`
--
ALTER TABLE `o_product_stages`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_reports`
--
ALTER TABLE `o_reports`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_staff_statuses`
--
ALTER TABLE `o_staff_statuses`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_tokens`
--
ALTER TABLE `o_tokens`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `o_towns`
--
ALTER TABLE `o_towns`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `o_users`
--
ALTER TABLE `o_users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `o_user_groups`
--
ALTER TABLE `o_user_groups`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `platform_settings`
--
ALTER TABLE `platform_settings`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `o_addons`
--
ALTER TABLE `o_addons`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `o_asset_categories`
--
ALTER TABLE `o_asset_categories`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_branches`
--
ALTER TABLE `o_branches`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_campaigns`
--
ALTER TABLE `o_campaigns`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `o_campaign_messages`
--
ALTER TABLE `o_campaign_messages`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `o_collateral`
--
ALTER TABLE `o_collateral`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `o_collateral_statuses`
--
ALTER TABLE `o_collateral_statuses`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_contact_types`
--
ALTER TABLE `o_contact_types`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `o_conversation_methods`
--
ALTER TABLE `o_conversation_methods`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `o_conversation_outcome`
--
ALTER TABLE `o_conversation_outcome`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_customers`
--
ALTER TABLE `o_customers`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `o_customer_contacts`
--
ALTER TABLE `o_customer_contacts`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `o_customer_conversations`
--
ALTER TABLE `o_customer_conversations`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `o_customer_document_categories`
--
ALTER TABLE `o_customer_document_categories`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `o_customer_referees`
--
ALTER TABLE `o_customer_referees`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `o_customer_referee_relationships`
--
ALTER TABLE `o_customer_referee_relationships`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `o_customer_statuses`
--
ALTER TABLE `o_customer_statuses`
  MODIFY `uid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `o_deductions`
--
ALTER TABLE `o_deductions`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `o_disburse_methods`
--
ALTER TABLE `o_disburse_methods`
  MODIFY `uid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `o_documents`
--
ALTER TABLE `o_documents`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `o_events`
--
ALTER TABLE `o_events`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `o_flags`
--
ALTER TABLE `o_flags`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_guarantors`
--
ALTER TABLE `o_guarantors`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_incoming_payments`
--
ALTER TABLE `o_incoming_payments`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `o_key_values`
--
ALTER TABLE `o_key_values`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `o_loans`
--
ALTER TABLE `o_loans`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `o_loan_addons`
--
ALTER TABLE `o_loan_addons`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `o_loan_deductions`
--
ALTER TABLE `o_loan_deductions`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `o_loan_products`
--
ALTER TABLE `o_loan_products`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_loan_stages`
--
ALTER TABLE `o_loan_stages`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `o_loan_statuses`
--
ALTER TABLE `o_loan_statuses`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `o_log_updates`
--
ALTER TABLE `o_log_updates`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_next_steps`
--
ALTER TABLE `o_next_steps`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_notifications`
--
ALTER TABLE `o_notifications`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `o_passes`
--
ALTER TABLE `o_passes`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `o_payment_methods`
--
ALTER TABLE `o_payment_methods`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `o_payment_schedule`
--
ALTER TABLE `o_payment_schedule`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_permissions`
--
ALTER TABLE `o_permissions`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `o_product_addons`
--
ALTER TABLE `o_product_addons`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `o_product_deductions`
--
ALTER TABLE `o_product_deductions`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `o_product_stages`
--
ALTER TABLE `o_product_stages`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `o_reports`
--
ALTER TABLE `o_reports`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `o_staff_statuses`
--
ALTER TABLE `o_staff_statuses`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_tokens`
--
ALTER TABLE `o_tokens`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `o_towns`
--
ALTER TABLE `o_towns`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `o_users`
--
ALTER TABLE `o_users`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `o_user_groups`
--
ALTER TABLE `o_user_groups`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `platform_settings`
--
ALTER TABLE `platform_settings`
  MODIFY `uid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
