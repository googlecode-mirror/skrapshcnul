-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2012 at 12:10 AM
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
-- Table structure for table `lss_components`
--

CREATE TABLE IF NOT EXISTS `lss_components` (
  `component_id` int(11) NOT NULL AUTO_INCREMENT,
  `component_name` varchar(250) NOT NULL,
  `component_desc` varchar(250) NOT NULL,
  `component_class_tag` varchar(100) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`component_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_events`
--

CREATE TABLE IF NOT EXISTS `lss_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_status` int(3) NOT NULL COMMENT '0 = pending request; -1 = cancelled ; 1 = confirmed upcomming event; 2 = past event',
  `date` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `deadline` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_events_users`
--

CREATE TABLE IF NOT EXISTS `lss_events_users` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rsvp` tinyint(4) NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`event_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

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
-- Table structure for table `lss_places`
--

CREATE TABLE IF NOT EXISTS `lss_places` (
  `place_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `primary_phone` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `geo_lat` varchar(11) NOT NULL,
  `geo_long` varchar(11) NOT NULL,
  `valid` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_places_verification_status`
--

CREATE TABLE IF NOT EXISTS `lss_places_verification_status` (
  `place_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remarks` text NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`place_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_places_xtra_restaurant`
--

CREATE TABLE IF NOT EXISTS `lss_places_xtra_restaurant` (
  `place_id` int(11) NOT NULL,
  `cuisine` varchar(250) NOT NULL,
  `opening_hours` varchar(250) NOT NULL,
  `special_features` text NOT NULL,
  `extras` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`place_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects`
--

CREATE TABLE IF NOT EXISTS `lss_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_type_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(250) NOT NULL,
  `cover_img` varchar(250) NOT NULL,
  `video_src` varchar(250) NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_apps`
--

CREATE TABLE IF NOT EXISTS `lss_projects_apps` (
  `project_id` int(11) NOT NULL,
  `ios_app_store_url` varchar(250) NOT NULL,
  `android_market_url` varchar(250) NOT NULL,
  `wp_market_url` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_external_urls`
--

CREATE TABLE IF NOT EXISTS `lss_projects_external_urls` (
  `project_id` int(11) NOT NULL,
  `homepage` varchar(250) NOT NULL,
  `github_url` varchar(250) NOT NULL,
  `facebook_url` varchar(250) NOT NULL,
  `twitter_url` varchar(250) NOT NULL,
  `gplus_url` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_screenshots`
--

CREATE TABLE IF NOT EXISTS `lss_projects_screenshots` (
  `project_screenshot_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `src` text NOT NULL,
  `is_external` tinyint(1) NOT NULL,
  `screenshot_details` text NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_screenshot_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_tags`
--

CREATE TABLE IF NOT EXISTS `lss_projects_tags` (
  `project_id` int(11) NOT NULL,
  `tags_type_id` int(11) NOT NULL,
  `tags_data` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`,`tags_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_team`
--

CREATE TABLE IF NOT EXISTS `lss_projects_team` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_joined` datetime NOT NULL,
  `date_leaved` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_type_xref`
--

CREATE TABLE IF NOT EXISTS `lss_projects_type_xref` (
  `project_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_type_name` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_projects_verification_status`
--

CREATE TABLE IF NOT EXISTS `lss_projects_verification_status` (
  `project_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remarks` text NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_recommendations`
--

CREATE TABLE IF NOT EXISTS `lss_recommendations` (
  `index` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `rec_reason` text,
  `approved` tinyint(1) NOT NULL,
  `selected` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_schedules`
--

CREATE TABLE IF NOT EXISTS `lss_schedules` (
  `index` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `repeat_params` text NOT NULL,
  `center_lat` double NOT NULL,
  `center_lng` double NOT NULL,
  `radius` double NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_statistics_total_users`
--

CREATE TABLE IF NOT EXISTS `lss_statistics_total_users` (
  `year_month` date NOT NULL,
  `total_users` int(11) NOT NULL,
  `details` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`year_month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lss_survey_data_1`
--

CREATE TABLE IF NOT EXISTS `lss_survey_data_1` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `target_point` double NOT NULL,
  `target_review` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`,`user_id`,`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lss_survey_data_2`
--

CREATE TABLE IF NOT EXISTS `lss_survey_data_2` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `restaurant_point` double NOT NULL,
  `restaurant_review` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `lss_users_groups`
--

CREATE TABLE IF NOT EXISTS `lss_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) NOT NULL,
  `group_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=287 ;

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
  `description` text NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`preferences_ref_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `location` text NOT NULL,
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
-- Table structure for table `lss_users_profile_verification_status`
--

CREATE TABLE IF NOT EXISTS `lss_users_profile_verification_status` (
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remarks` text NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;