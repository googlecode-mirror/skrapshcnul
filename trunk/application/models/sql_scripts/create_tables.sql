-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2011 at 09:35 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `lldb_add_inf`
--

CREATE TABLE IF NOT EXISTS `lldb_add_inf` (
  `user_id` bigint(16) unsigned NOT NULL,
  `interests` varchar(1024) DEFAULT NULL,
  `groups` varchar(1024) DEFAULT NULL,
  `honours` varchar(1024) DEFAULT NULL,
  `websites` varchar(1024) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lldb_add_inf`
--


-- --------------------------------------------------------

--
-- Table structure for table `lldb_edu`
--

CREATE TABLE IF NOT EXISTS `lldb_edu` (
  `user_id` bigint(16) unsigned NOT NULL,
  `school_name` varchar(128) NOT NULL,
  `degree` varchar(128) DEFAULT NULL,
  `fields` varchar(1024) DEFAULT NULL,
  `start_time` varchar(8) DEFAULT NULL,
  `end_time` varchar(8) DEFAULT NULL,
  `is_current` varchar(8) NOT NULL DEFAULT 'FALSE',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lldb_edu`
--


-- --------------------------------------------------------

--
-- Table structure for table `lldb_exp`
--

CREATE TABLE IF NOT EXISTS `lldb_exp` (
  `user_id` bigint(16) NOT NULL,
  `company` varchar(128) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `start_time` varchar(8) DEFAULT NULL,
  `end_time` varchar(8) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lldb_exp`
--


-- --------------------------------------------------------

--
-- Table structure for table `lldb_per_inf`
--

CREATE TABLE IF NOT EXISTS `lldb_per_inf` (
  `phone_number` varchar(16) DEFAULT NULL,
  `im` varchar(16) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `birthday` varchar(8) DEFAULT NULL,
  `marial_status` varchar(8) DEFAULT NULL,
  `user_id` bigint(16) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='personal information';

--
-- Dumping data for table `lldb_per_inf`
--

