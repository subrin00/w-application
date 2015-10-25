-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2015 at 08:47 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_client`
--

CREATE TABLE IF NOT EXISTS `add_client` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `add_client`
--

INSERT INTO `add_client` (`id`, `name`, `details`, `date`, `time`) VALUES
(12, 'MR. Johan', 'df', '22-10-2015', '03:37:35 AM'),
(13, 'Kader', '', '22-10-2015', '02:00:36 AM');

-- --------------------------------------------------------

--
-- Table structure for table `add_customer`
--

CREATE TABLE IF NOT EXISTS `add_customer` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `m_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `add_customer`
--

INSERT INTO `add_customer` (`id`, `m_id`, `name`, `details`, `ddate`, `time`) VALUES
(46, '36', 'Johan', 'Mohakhali,Dhaka', '25-10-2015', '11:33:28 PM'),
(47, '36', 'Mr. Mohon', 'Mohammodpur, Dhaka', '25-10-2015', '11:37:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dbirth` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `admin` int(11) NOT NULL,
  `stat` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fname`, `lname`, `gender`, `dbirth`, `pic`, `email`, `pass`, `admin`, `stat`, `date`, `time`) VALUES
(11, 'MD Subrin', 'Md', 'Subrin', 'male', '1988-11-26', '../img/1.JPG', 'subrinphp@gmail.com', '123', 1, 1, '25-10-2015', '11:44:43'),
(12, 'Admin', 'Hasan', 'Khan', 'male', '1990-05-11', '../img/Awesome-High-Resolution-Video-Game-Wallpaper.jpg', 'subrincss@gmail.com', '123', 2, 1, '25-10-2015', '11:45:40'),
(13, 'Arif', 'Arif', 'Mahfuz', 'male', '2000-02-05', '../img/', 'sabbir_s00@yahoo.com', '123', 3, 1, '25-10-2015', '11:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE IF NOT EXISTS `bank_info` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `b_id` int(255) NOT NULL,
  `acname` varchar(255) NOT NULL,
  `acnum` varchar(255) NOT NULL,
  `deposit` varchar(255) NOT NULL,
  `withdrawal` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `b_id`, `acname`, `acnum`, `deposit`, `withdrawal`, `details`, `date`, `time`) VALUES
(18, 15, 'MD Subrin', '45665', '1000000', '12000', 'Some', '22-10-2015', '01:54:05 AM'),
(19, 15, '', '', '', '23000', 'For Something', '22-10-2015', '01:54:31 AM'),
(20, 15, '', '', '', '46000', 'Hello', '22-10-2015', '01:54:51 AM'),
(21, 16, 'Md', '5654', '50000', '2000', '', '22-10-2015', '01:57:13 AM'),
(22, 16, '', '', '', '1200', '', '22-10-2015', '01:57:28 AM'),
(23, 16, '', '', '', '6000', '', '22-10-2015', '01:57:33 AM');

-- --------------------------------------------------------

--
-- Table structure for table `bank_name`
--

CREATE TABLE IF NOT EXISTS `bank_name` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ac_type` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bank_name`
--

INSERT INTO `bank_name` (`id`, `name`, `ac_type`, `details`, `date`, `time`) VALUES
(15, 'DBBL', 'Savings', 'Faridpur Shaka', '22-10-2015', '01:53:42 AM'),
(16, 'Sonali Bank', 'BD', '', '22-10-2015', '01:56:37 AM');

-- --------------------------------------------------------

--
-- Table structure for table `client_details`
--

CREATE TABLE IF NOT EXISTS `client_details` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `c_id` int(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `ttk` varchar(255) NOT NULL,
  `paytk` varchar(255) NOT NULL,
  `bank_info` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `client_details`
--

INSERT INTO `client_details` (`id`, `c_id`, `item`, `quantity`, `ttk`, `paytk`, `bank_info`, `details`, `date`, `time`) VALUES
(17, 12, 'PC', '50', '1000000', '600000', '65165', 'safsd', '22-10-2015', '01:58:04'),
(18, 12, '', '', '', '250000', '', '', '22-10-2015', '01:59:02'),
(19, 12, '', '', '', '120000', '', '', '22-10-2015', '01:59:17'),
(20, 13, 'Monitor', '30', '300000', '150000', '654', 'sdf', '22-10-2015', '02:00:45'),
(21, 13, '', '', '', '50000', '', '', '22-10-2015', '02:01:43'),
(22, 13, '', '', '', '63000', '', '', '22-10-2015', '02:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `m_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `m_id`, `title`, `details`, `amount`, `time`, `ddate`) VALUES
(41, 36, 'Tea', 'Some of Details', '150', '11:39:07 PM', '25-10-2015'),
(42, 36, 'Shoping', '', '15000', '11:39:22 PM', '25-10-2015'),
(43, 36, 'Some Other Cost', '', '25000', '11:39:43 PM', '25-10-2015');

-- --------------------------------------------------------

--
-- Table structure for table `goods_in`
--

CREATE TABLE IF NOT EXISTS `goods_in` (
  `g_id` int(255) NOT NULL AUTO_INCREMENT,
  `s_s_id` int(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `tk` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `sid` varchar(255) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `goods_in`
--

INSERT INTO `goods_in` (`g_id`, `s_s_id`, `quantity`, `tk`, `details`, `date`, `time`, `mid`, `sid`) VALUES
(142, 192, '8', '1276000', 'Black And Red Color Available ', '25-10-2015', '11:23:42 PM', '93', '158'),
(144, 195, '6', '1236000', 'Only Red Color Available ', '25-10-2015', '11:29:40 PM', '95', '161'),
(145, 194, '10', '1990000', 'Black, Red And Blue Color Available ', '25-10-2015', '11:32:31 PM', '95', '160'),
(146, 190, '5', '250000', 'Only Black Color Available', '25-10-2015', '11:36:08 PM', '93', '157'),
(147, 189, '15', '3000000', 'Black And Red Color Available ', '25-10-2015', '11:37:02 PM', '93', '157');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `date`) VALUES
(93, 'Bajaj', '25-10-2015'),
(95, 'Hero Honda', '25-10-2015');

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE IF NOT EXISTS `memo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`id`, `date`, `time`) VALUES
(36, '25-10-2015', '11:33:22 PM');

-- --------------------------------------------------------

--
-- Table structure for table `sub_item`
--

CREATE TABLE IF NOT EXISTS `sub_item` (
  `s_id` int(255) NOT NULL AUTO_INCREMENT,
  `i_id` int(255) NOT NULL,
  `s_title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `mid` varchar(255) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `sub_item`
--

INSERT INTO `sub_item` (`s_id`, `i_id`, `s_title`, `details`, `date`, `mid`) VALUES
(157, 93, 'Pulsar', '', '25-10-2015', '93'),
(158, 93, 'Discover', '', '25-10-2015', '93'),
(160, 95, 'Karizma', '', '25-10-2015', '95'),
(161, 95, 'Hunk', '', '25-10-2015', '95');

-- --------------------------------------------------------

--
-- Table structure for table `sub_memo`
--

CREATE TABLE IF NOT EXISTS `sub_memo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `m_id` int(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `sub_item` varchar(255) NOT NULL,
  `sub_sub_item` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `rate` int(255) NOT NULL,
  `tk` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `m_m_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=269 ;

--
-- Dumping data for table `sub_memo`
--

INSERT INTO `sub_memo` (`id`, `m_id`, `items`, `sub_item`, `sub_sub_item`, `quantity`, `rate`, `tk`, `ddate`, `time`, `m_m_id`) VALUES
(260, 43, '91', '153', '182', 2, 1000000, '2000000', '22-10-2015', '01:32:10 AM', '35'),
(261, 43, '90', '151', '180', 1, 1000000, '1000000', '22-10-2015', '01:32:31 AM', '35'),
(262, 44, '90', '149', '176', 3, 1000000, '3000000', '22-10-2015', '01:33:30 AM', '35'),
(263, 44, '92', '156', '188', 2, 1000000, '2000000', '22-10-2015', '01:33:44 AM', '35'),
(264, 45, '91', '152', '181', 2, 1000000, '2000000', '22-10-2015', '01:35:17 AM', '35'),
(266, 46, '93', '157', '190', 2, 250000, '500000', '25-10-2015', '11:34:43 PM', '36'),
(267, 47, '95', '161', '195', 1, 206000, '206000', '25-10-2015', '11:38:15 PM', '36'),
(268, 46, '95', '160', '194', 1, 199000, '199000', '25-10-2015', '11:43:45 PM', '36');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_item`
--

CREATE TABLE IF NOT EXISTS `sub_sub_item` (
  `s_s_id` int(255) NOT NULL AUTO_INCREMENT,
  `s_id` int(255) NOT NULL,
  `s_s_title` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `mid` varchar(255) NOT NULL,
  PRIMARY KEY (`s_s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=196 ;

--
-- Dumping data for table `sub_sub_item`
--

INSERT INTO `sub_sub_item` (`s_s_id`, `s_id`, `s_s_title`, `time`, `date`, `mid`) VALUES
(189, 157, '150 cc', '11:16:55 PM', '25-10-2015', '93'),
(190, 157, '180 cc', '11:17:03 PM', '25-10-2015', '93'),
(192, 158, '150 cc', '11:22:40 PM', '25-10-2015', '93'),
(194, 160, '150 cc', '11:27:21 PM', '25-10-2015', '95'),
(195, 161, '150 cc', '11:27:56 PM', '25-10-2015', '95');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
