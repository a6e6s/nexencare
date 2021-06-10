-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2021 at 07:08 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexencare`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `permissions` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `description`, `permissions`, `status`, `create_date`, `modified_date`) VALUES
(1, 'الإدارة', 'مجموعه تملك كافة الصلاحيات', '{\"admin_login\":{\"view\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Members\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Pages\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Settings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Users\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"}}', 1, 1543493061, 1623245091),
(2, 'الاشراف', 'مجموعة تملك صلاحيات التعديل والاضافة والعرض', '{\"admin_login\":{\"view\":\"1\"},\"Contacts\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donations\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Donors\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Menus\":{\"index\":\"1\"},\"Messagings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Pages\":{\"index\":\"1\"},\"Paymentmethods\":{\"index\":\"1\"},\"Projectcategories\":{\"index\":\"1\"},\"Projects\":{\"index\":\"1\"},\"Projecttags\":{\"index\":\"1\"},\"Reports\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"Settings\":{\"index\":\"1\"},\"Slides\":{\"index\":\"1\"},\"Statuses\":{\"index\":\"1\"},\"Users\":{\"index\":\"1\"}}', 1, 1543746264, 1586894988),
(3, 'المراقبين', '', '{\"admin_login\":{\"view\":\"1\"},\"Groups\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"},\"Pages\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"},\"Settings\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"},\"Users\":{\"index\":\"1\",\"search\":\"1\",\"show\":\"1\",\"status\":\"1\",\"add\":\"1\",\"edit\":\"1\"}}', 1, 1549259804, 1572870120);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `birthdate` int(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `second_name`, `last_name`, `family_name`, `birthdate`, `gender`, `nationality`, `image`, `status`, `deleted_at`, `updated_at`, `created_at`) VALUES
(1, 'Ahmed', 'Elmahdy', 'Samy', 'Elmenshawy', NULL, 'ذكر', 'Austrian', 'image_636dd.jpg', 0, NULL, 1623243601, 1623243601),
(2, 'سعود', 'مبارك', 'القحطاني', 'القحطاني', NULL, 'ذكر', 'Saudi', 'image_c72fb.jpg', 0, NULL, 1623246903, 1623246903);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `value` mediumtext DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `title`, `alias`, `value`, `create_date`, `modified_date`) VALUES
(1, 'الاعدادات العامة', 'site', '{\"title\":\"\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0643\\u0633\\u0646 \\u0645\\u0644\\u0641 \\u0635\\u062d\\u064a \\u0645\\u0648\\u062d\\u062f \\u0644\\u0643\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0645\\u0646\\u0634\\u0622\\u062a \\u0627\\u0644\\u0635\\u062d\\u064a\\u0629\",\"about\":\"\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0643\\u0633\\u0646 \\u0647\\u0648 \\u0646\\u0638\\u0627\\u0645 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u062a\\u0641\\u0627\\u0639\\u0644\\u064a \\u0644\\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0648\\u0645\\u064a\\u0643\\u0646\\u0629 \\u0627\\u0644\\u0625\\u062c\\u0631\\u0627\\u0621\\u0627\\u062a \\u0627\\u0644\\u0635\\u062d\\u064a\\u0629 \\u0628\\u062d\\u064a\\u062b \\u064a\\u062d\\u062a\\u0648\\u064a \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0644\\u0649 \\u0645\\u0644\\u0641 \\u0635\\u062d\\u064a \\u0645\\u0648\\u062d\\u062f \\u0645\\u0639 \\u0648\\u062d\\u062f\\u0627\\u062a \\u0637\\u0628\\u064a\\u0629 \\u0648\\u0625\\u062f\\u0631\\u0627\\u064a\\u0629 \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u062a\\u062e\\u062f\\u0645 \\u0643\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0623\\u0642\\u0633\\u0627\\u0645 \\u0627\\u0644\\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u062f\\u0627\\u062e\\u0644 \\u0627\\u0644\\u0645\\u0646\\u0634\\u0623\\u0629 \\u0627\\u0644\\u0635\\u062d\\u064a\\u0629\\u060c \\u0648\\u064a\\u0642\\u0648\\u0645 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0628\\u0627\\u0644\\u0631\\u0628\\u0637 \\u0628\\u064a\\u0646 \\u0645\\u062e\\u062a\\u0644\\u0641 \\u0627\\u0644\\u0645\\u0646\\u0634\\u0622\\u062a \\u0648\\u0627\\u0644\\u0623\\u0646\\u0638\\u0645\\u0629 \\u0627\\u0644\\u0635\\u062d\\u064a\\u0629 \\u0648\\u064a\\u0633\\u0627\\u0647\\u0645 \\u0641\\u064a \\u062a\\u062d\\u0642\\u064a\\u0642 \\u0627\\u0644\\u062a\\u062d\\u0648\\u0644 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a \\u0628\\u062a\\u0637\\u0628\\u064a\\u0642 \\u0623\\u0641\\u0636\\u0644 \\u0627\\u0644\\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u0635\\u062d\\u064a\\u0629 \\u0645\\u0639 \\u0645\\u064a\\u0632\\u0629 \\u062a\\u0642\\u062f\\u064a\\u0645 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0628\\u0643\\u0629 \\u0627\\u0644\\u0633\\u062d\\u0627\\u0628\\u064a\\u0629 \\u0644\\u0636\\u0645\\u0627\\u0646 \\u0633\\u0631\\u0639\\u0629 \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0648\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0645\\u0639 \\u062a\\u0642\\u0644\\u064a\\u0644 \\u0627\\u0644\\u062c\\u0647\\u062f \\u0648\\u0627\\u0644\\u0645\\u062e\\u0627\\u0637\\u0631 \\u0648\\u0627\\u0644\\u062a\\u0643\\u0644\\u0641\\u0629.\",\"welcomeText\":\"\\u0646\\u0643\\u0633\\u0646  \\u062a\\u0631\\u062d\\u0628 \\u0628\\u0643\\u0645\",\"header_code\":\"\",\"footer_code\":\"\",\"show_video\":\"1\",\"videoTitle\":\"\\u0641\\u0640\\u064a\\u0640\\u062f\\u064a\\u0640\\u0648 \\u062a\\u0640\\u0639\\u0640\\u0631\\u064a\\u0640\\u0641\\u0640\\u064a\",\"videoDescription\":\"\\u062a\\u0645 \\u0627\\u0628\\u062a\\u0643\\u0627\\u0631 \\u0646\\u0643\\u0633\\u0646 \\u0644\\u064a\\u0643\\u0648\\u0646 \\u0646\\u0638\\u0627\\u0645\\u064b\\u0627 \\u0635\\u062d\\u064a\\u0651\\u064b\\u0627 \\u0631\\u0627\\u0626\\u062f\\u064b\\u0627 \\u0648\\u064a\\u0648\\u0641\\u0631 \\u0628\\u064a\\u0626\\u0629 \\u0639\\u0645\\u0644 \\u0630\\u0643\\u064a\\u0629 \\u0648\\u0645\\u062a\\u0643\\u0627\\u0645\\u0644\\u0629 \\u0644\\u0644\\u0645\\u0646\\u0634\\u0622\\u062a \\u0627\\u0644\\u0635\\u062d\\u064a\\u0629 (\\u0627\\u0644\\u062a\\u064a \\u062a\\u0642\\u062f\\u0645 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629) \\u0648\\u0627\\u0644\\u0641\\u0631\\u062f (\\u0627\\u0644\\u0630\\u064a \\u064a\\u0633\\u062a\\u0641\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629)\",\"videoURL\":\"https:\\/\\/youtu.be\\/mxrvqu9ZDu4\",\"videoMore\":\"http:\\/\\/localhost\\/nexencare\\/pages\\/subscription\",\"show_footer\":\"1\"}', 1583845973, 1623308776),
(2, 'اعدادات بيانات الاتصال', 'contact', '{\"phone\":\"\",\"phone2\":\"\",\"mobile\":\"0500647070 \",\"mobile2\":\"\",\"whatsapp\":\"\",\"fax\":\"\",\"email\":\"\",\"address\":\"\",\"map\":\"\",\"cphone\":\"\",\"ctphone\":\"\",\"cmobile\":\"\",\"cfax\":\"\",\"caddress\":\"\"}', 1583845973, 1623308710),
(3, 'اعدادات الارشفة', 'seo', '{\"meta_keywords\":\"\",\"meta_description\":\"\\r\\n\"}', 1583845973, 1584003723),
(5, 'اعدادات البريد الالكتروني', 'email', '{\"host\":\"\",\"user\":\"\",\"password\":\"\",\"port\":\"\",\"sending_email\":\"\",\"sending_name\":\"\"}', 1583845973, 1623308688),
(10, 'اعدادات التنبيهات', 'notifications', '{\"memberEmail\":\"a6e6s1@gmail.com\",\"memberContent\":\"<p style=\\\"text-align:center;\\\"><span style=\\\"color:#3498db;\\\"><strong>\\u0645\\u062d\\u062a\\u0648\\u064a \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u064a\\u0645\\u0643\\u0646 \\u0627\\u0636\\u0627\\u0641\\u062a\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0627\\u0644\\u0627\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a<\\/strong><\\/span><\\/p>\\r\\n\"}', 1587077117, 1623247311);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `image` tinytext DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `activation_code` varchar(100) DEFAULT NULL,
  `request_password_time` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `login_date` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `groups` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `mobile`, `image`, `bio`, `activation_code`, `request_password_time`, `group_id`, `login_date`, `status`, `modified_date`, `create_date`) VALUES
(22, 'احمد المهدي', 'a6e6s1@gmail.com', '$2y$10$veHBsCh4q39J.k0MPGKfDuHhraBWnyQmnhoBVRIA1rZyL.eLAp61a', '597767751', 'image_09883.jpg', '', '98783', 0, 1, 1623245095, 1, 1623234114, 1543831099);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
