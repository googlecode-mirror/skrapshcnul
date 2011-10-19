-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2011 at 04:35 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `binghan_llunch`
--

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_preferences_ref`
--

CREATE TABLE IF NOT EXISTS `lss_users_preferences_ref` (
  `preferences_ref_id` int(11) NOT NULL AUTO_INCREMENT,
  `preferences_name` varchar(100) NOT NULL,
  `description` text,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`preferences_ref_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lss_users_preferences_ref`
--

INSERT INTO `lss_users_preferences_ref` (`preferences_ref_id`, `preferences_name`, `description`, `created_on`) VALUES
(1, 'Networking', 'Area of interest that you looking for to expand your network.', '2011-10-14 23:24:40'),
(2, 'Career', 'Area of interest for the people that you would like to expand your career path.', '2011-10-14 23:24:49'),
(3, 'Offer', 'Area of interest that you have confident giving advice or skills .', '2011-10-14 23:25:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
