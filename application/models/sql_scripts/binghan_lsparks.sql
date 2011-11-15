-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2011 at 11:18 AM
-- Server version: 5.5.13
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `binghan_lsparks`
--

-- --------------------------------------------------------

--
-- Table structure for table `lss_global_preferences`
--

CREATE TABLE IF NOT EXISTS `lss_global_preferences` (
  `keywords` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`keywords`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_groups`
--

CREATE TABLE IF NOT EXISTS `lss_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `lss_mainpage_elements`
--

CREATE TABLE IF NOT EXISTS `lss_mainpage_elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_meta`
--

CREATE TABLE IF NOT EXISTS `lss_meta` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_notifications`
--

CREATE TABLE IF NOT EXISTS `lss_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `component_id` int(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `url` text,
  `created_on` int(11) NOT NULL,
  `read_on` int(11) NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_page_completed_step`
--

CREATE TABLE IF NOT EXISTS `lss_page_completed_step` (
  `user_id` int(11) NOT NULL,
  `step1` tinyint(1) NOT NULL,
  `step2` tinyint(1) NOT NULL,
  `step3` tinyint(1) NOT NULL,
  `step4` tinyint(1) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL,
  `is_disabled` tinyint(1) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_schedules`
--

CREATE TABLE IF NOT EXISTS `lss_schedules` (
  `user_id` int(10) unsigned NOT NULL,
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `repeat_params` text,
  `center_lat` double NOT NULL,
  `center_lng` double NOT NULL,
  `radius` double NOT NULL,
  KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users`
--

CREATE TABLE IF NOT EXISTS `lss_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_groups`
--

CREATE TABLE IF NOT EXISTS `lss_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) NOT NULL,
  `group_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_invitations`
--

CREATE TABLE IF NOT EXISTS `lss_users_invitations` (
  `user_id` bigint(20) NOT NULL,
  `invitation_left` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_invitations_log`
--

CREATE TABLE IF NOT EXISTS `lss_users_invitations_log` (
  `user_id` int(11) NOT NULL,
  `invitee_email` varchar(100) NOT NULL,
  `invitation_code` varchar(32) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `created_on` datetime NOT NULL,
  `joined_on` datetime DEFAULT NULL,
  PRIMARY KEY (`invitee_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_login_history`
--

CREATE TABLE IF NOT EXISTS `lss_users_login_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `user_agent` varchar(100) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_lunch_buddy`
--

CREATE TABLE IF NOT EXISTS `lss_users_lunch_buddy` (
  `user_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`target_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_lunch_wishlist`
--

CREATE TABLE IF NOT EXISTS `lss_users_lunch_wishlist` (
  `user_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL,
  `is_added` tinyint(1) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`target_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_preferences`
--

CREATE TABLE IF NOT EXISTS `lss_users_preferences` (
  `user_id` bigint(11) NOT NULL,
  `preferences_ref_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`,`preferences_ref_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_profile`
--

CREATE TABLE IF NOT EXISTS `lss_users_profile` (
  `user_id` int(11) NOT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `firstname` varchar(250) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `delivery_email` varchar(250) DEFAULT NULL,
  `profile_img` varchar(250) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_profile_social_links`
--

CREATE TABLE IF NOT EXISTS `lss_users_profile_social_links` (
  `user_id` int(11) NOT NULL,
  `lunchsparks` varchar(250) DEFAULT NULL,
  `linkedin` varchar(250) DEFAULT NULL,
  `twitter` varchar(250) DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_providers`
--

CREATE TABLE IF NOT EXISTS `lss_users_providers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `auth_username` varchar(150) NOT NULL,
  `auth_token` int(11) NOT NULL,
  `auth_token_verifier` int(11) NOT NULL,
  `data` text NOT NULL,
  `createdOn` datetime NOT NULL,
  `updatedOn` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_providers_data`
--

CREATE TABLE IF NOT EXISTS `lss_users_providers_data` (
  `id` bigint(20) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_ratings`
--

CREATE TABLE IF NOT EXISTS `lss_users_ratings` (
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_ratings_log`
--

CREATE TABLE IF NOT EXISTS `lss_users_ratings_log` (
  `rating_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `point_change` int(11) NOT NULL,
  `remarks` text,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`rating_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_settings_notification`
--

CREATE TABLE IF NOT EXISTS `lss_users_settings_notification` (
  `user_id` int(11) NOT NULL,
  `chrome_desktop_notification` tinyint(1) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_settings_notification_email`
--

CREATE TABLE IF NOT EXISTS `lss_users_settings_notification_email` (
  `user_id` int(11) NOT NULL,
  `system_notification` tinyint(1) NOT NULL DEFAULT '1',
  `event_notification` tinyint(1) NOT NULL DEFAULT '1',
  `added_to_wishlist_notification` tinyint(1) NOT NULL DEFAULT '1',
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_settings_notification_phone`
--

CREATE TABLE IF NOT EXISTS `lss_users_settings_notification_phone` (
  `user_id` int(11) NOT NULL,
  `system_notification` tinyint(1) NOT NULL DEFAULT '1',
  `event_notification` tinyint(1) NOT NULL DEFAULT '1',
  `added_to_wishlist_notification` tinyint(1) NOT NULL DEFAULT '1',
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_settings_security`
--

CREATE TABLE IF NOT EXISTS `lss_users_settings_security` (
  `user_id` int(11) NOT NULL,
  `secure_browsing` tinyint(1) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_verification_status`
--

CREATE TABLE IF NOT EXISTS `lss_users_verification_status` (
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remarks` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
