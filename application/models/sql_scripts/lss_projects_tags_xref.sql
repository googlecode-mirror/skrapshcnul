-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2012 at 04:37 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.8

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
-- Table structure for table `lss_projects_tags_xref`
--

CREATE TABLE IF NOT EXISTS `lss_projects_tags_xref` (
  `tags_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `tags_type_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tags_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lss_projects_tags_xref`
--

INSERT INTO `lss_projects_tags_xref` (`tags_type_id`, `is_private`, `tags_type_name`, `description`, `updated_on`) VALUES
(1, 0, 'Markets', '', '2012-03-04 13:04:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
