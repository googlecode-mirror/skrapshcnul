-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2011 at 09:28 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `lss_linkedin_data`
--

CREATE TABLE IF NOT EXISTS `lss_linkedin_data` (
  `id` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `lss_schedules`
--

CREATE TABLE IF NOT EXISTS `lss_schedules` (
  `user_id` int(10) unsigned NOT NULL,
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `center_lat` double NOT NULL,
  `center_lng` double NOT NULL,
  `radius` double NOT NULL,
  KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;



-- --------------------------------------------------------

--
-- Table structure for table `lss_suggestion`
--

CREATE TABLE IF NOT EXISTS `lss_suggestion` (
  `userid` int(10) unsigned NOT NULL,
  `suggested_userid` int(10) unsigned NOT NULL,
  `reason` text NOT NULL,
  `respond` text NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `lss_0_accepted_recs`
--

CREATE TABLE IF NOT EXISTS `lss_0_accepted_recs` (
  `index` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lss_0_auto_recs`
--

CREATE TABLE IF NOT EXISTS `lss_0_auto_recs` (
  `index` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `rec_reason` text,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_0_negotiated_recs`
--

CREATE TABLE IF NOT EXISTS `lss_0_negotiated_recs` (
  `index` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lss_0_selected_recs`
--

CREATE TABLE IF NOT EXISTS `lss_0_selected_recs` (
  `index` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lss_0_successful_recs`
--

CREATE TABLE IF NOT EXISTS `lss_0_successful_recs` (
  `index` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_states`
--

CREATE TABLE IF NOT EXISTS `lss_users_states` (
  `user_id` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;