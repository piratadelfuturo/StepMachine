-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2012 at 04:19 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sevenboom`
--
DROP DATABASE `sevenboom`;
CREATE DATABASE `sevenboom` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `sevenboom`;

-- --------------------------------------------------------

--
-- Table structure for table `bm_group`
--

DROP TABLE IF EXISTS `bm_group`;
CREATE TABLE IF NOT EXISTS `bm_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `roles` longtext COLLATE utf8_bin NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4BB75C705E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bm_user`
--

DROP TABLE IF EXISTS `bm_user`;
CREATE TABLE IF NOT EXISTS `bm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_bin NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_bin NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebookId` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `twitterId` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `twitter_username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `bio` tinytext COLLATE utf8_bin,
  `discr` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_23BBCF7992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_23BBCF79A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_23BBCF79E17C91E8` (`facebookId`),
  UNIQUE KEY `UNIQ_23BBCF795FF5F412` (`twitterId`),
  UNIQUE KEY `UNIQ_23BBCF795E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bm_user`
--

INSERT INTO `bm_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `firstname`, `lastname`, `facebookId`, `twitterId`, `twitter_username`, `nickname`, `name`, `bio`, `discr`) VALUES
(1, 'piratadelfuturo', 'piratadelfuturo', 'facebook@echo.mx', 'facebook@echo.mx', 1, '', '', '2012-08-08 11:21:42', 0, 0, NULL, NULL, NULL, 0x613a323a7b693a303b733a31333a22524f4c455f46414345424f4f4b223b693a313b733a31313a22524f4c455f534f4349414c223b7d, 0, NULL, 'Daniel', 'Maldonado', '100000344182924', NULL, NULL, NULL, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `bm_user_user_group`
--

DROP TABLE IF EXISTS `bm_user_user_group`;
CREATE TABLE IF NOT EXISTS `bm_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_5D5A4D4AA76ED395` (`user_id`),
  KEY `IDX_5D5A4D4AFE54D947` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `boom`
--

DROP TABLE IF EXISTS `boom`;
CREATE TABLE IF NOT EXISTS `boom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(140) COLLATE utf8_bin NOT NULL,
  `title` varchar(140) COLLATE utf8_bin NOT NULL,
  `summary` longtext COLLATE utf8_bin NOT NULL,
  `date_created` datetime NOT NULL,
  `date_published` datetime DEFAULT NULL,
  `nsfw` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_22860604989D9B62` (`slug`),
  KEY `IDX_228606043DA5256D` (`image_id`),
  KEY `IDX_22860604A76ED395` (`user_id`),
  KEY `IDX_22860604727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `boom`
--

INSERT INTO `boom` (`id`, `image_id`, `user_id`, `parent_id`, `slug`, `title`, `summary`, `date_created`, `date_published`, `nsfw`) VALUES
(1, NULL, NULL, NULL, 'musica', 'Musica', 0x4d75636861205b695d6d756368615b2f695d205b625d6d75736963615b2f625d2061205b696d675d687474703a2f2f7777772e6262636f64652e6f72672f696d616765732f6c756265636b5f736d616c6c2e6a70675b2f696d675d0d0a5b696d675d687474703a2f2f7777772e6262636f64652e6f72672f696d616765732f6c756265636b5f736d616c6c2e6a70675b2f696d675d0d0a5b696d675d687474703a2f2f7777772e6262636f64652e6f72672f696d616765732f6c756265636b5f736d616c6c2e6a70675b2f696d675d0d0a5b796f75747562655d47427459694c46483835415b2f796f75747562655d0d0a5b71756f74653d5c2268656c696f735c225d4d792071756f74655b2f71756f74655d0d0a0d0a5b6f6c6973745d0d0a5b6c695d4974656d206f6e655b2f696c5d0d0a5b6c695d4974656d2074776f5b2f696c5d0d0a5b2f6f6c6973745d0d0a556e6f726465726564206c6973740d0a5b6c6973745d0d0a5b6c695d4974656d206f6e655b2f696c5d0d0a5b6c695d4974656d2074776f5b2f696c5d0d0a5b2f6c6973745d0d0a416e6f746865722076617269616e740d0a5b6c6973745d0d0a5b6c695d4974656d206f6e655b2f696c5d0d0a5b6c695d4974656d2074776f5b2f696c5d0d0a5b2f6c6973745d, '2012-08-08 11:30:46', NULL, 0),
(2, NULL, NULL, NULL, 'prueba', 'prueba', 0x686f6c61205b625d746573745b2f625d0d0a5b67616c6c6572793d32345d, '2012-08-08 13:02:03', '2012-08-08 13:02:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `boomelement`
--

DROP TABLE IF EXISTS `boomelement`;
CREATE TABLE IF NOT EXISTS `boomelement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `content` longtext COLLATE utf8_bin,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57CBBBB0727ACA70` (`parent_id`),
  KEY `IDX_57CBBBB03DA5256D` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Dumping data for table `boomelement`
--

INSERT INTO `boomelement` (`id`, `parent_id`, `image_id`, `title`, `content`, `position`) VALUES
(1, 1, NULL, 'Musica 1', 0x4d75636861206d75636861205b625d6d757369636120325b2f625d, 1),
(2, 1, NULL, NULL, NULL, 2),
(3, 1, NULL, NULL, NULL, 3),
(4, 1, NULL, NULL, NULL, 4),
(5, 1, NULL, NULL, NULL, 5),
(6, 1, NULL, NULL, NULL, 6),
(7, 1, NULL, NULL, NULL, 7),
(8, 2, NULL, 'test', 0x5b625d746573745b2f625d, 1),
(9, 2, NULL, NULL, NULL, 2),
(10, 2, NULL, NULL, NULL, 3),
(11, 2, NULL, NULL, NULL, 4),
(12, 2, NULL, NULL, NULL, 5),
(13, 2, NULL, NULL, NULL, 6),
(14, 2, NULL, NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `booms_categories`
--

DROP TABLE IF EXISTS `booms_categories`;
CREATE TABLE IF NOT EXISTS `booms_categories` (
  `boom_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`boom_id`,`category_id`),
  KEY `IDX_B691B0C833C9EC5D` (`boom_id`),
  KEY `IDX_B691B0C812469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `booms_categories`
--

INSERT INTO `booms_categories` (`boom_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `booms_tags`
--

DROP TABLE IF EXISTS `booms_tags`;
CREATE TABLE IF NOT EXISTS `booms_tags` (
  `boom_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`boom_id`,`tag_id`),
  KEY `IDX_2FE5013333C9EC5D` (`boom_id`),
  KEY `IDX_2FE50133BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(140) COLLATE utf8_bin NOT NULL,
  `name` varchar(140) COLLATE utf8_bin NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `name`, `position`) VALUES
(1, 'musica', 'Música', 0),
(2, 'cine', 'Cine', 1),
(3, 'sexo', 'Sexo', 2),
(4, 'tecnologia', 'Tecnología', 3),
(5, 'lucky-7', 'Lucky 7', 4),
(6, 'chistes', 'chistes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ext_log_entries`
--

DROP TABLE IF EXISTS `ext_log_entries`;
CREATE TABLE IF NOT EXISTS `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_bin NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_bin NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_bin COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `galleries_images`
--

DROP TABLE IF EXISTS `galleries_images`;
CREATE TABLE IF NOT EXISTS `galleries_images` (
  `image_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`,`gallery_id`),
  KEY `IDX_6A81D6923DA5256D` (`image_id`),
  KEY `IDX_6A81D6924E7AF8F` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_472B783AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `path` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(140) COLLATE utf8_bin NOT NULL,
  `name` varchar(140) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bm_user_user_group`
--
ALTER TABLE `bm_user_user_group`
  ADD CONSTRAINT `FK_5D5A4D4AFE54D947` FOREIGN KEY (`group_id`) REFERENCES `bm_group` (`id`),
  ADD CONSTRAINT `FK_5D5A4D4AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`);

--
-- Constraints for table `boom`
--
ALTER TABLE `boom`
  ADD CONSTRAINT `FK_22860604727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `boom` (`id`),
  ADD CONSTRAINT `FK_228606043DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_22860604A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`);

--
-- Constraints for table `boomelement`
--
ALTER TABLE `boomelement`
  ADD CONSTRAINT `FK_57CBBBB03DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_57CBBBB0727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `boom` (`id`);

--
-- Constraints for table `booms_categories`
--
ALTER TABLE `booms_categories`
  ADD CONSTRAINT `FK_B691B0C812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_B691B0C833C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`);

--
-- Constraints for table `booms_tags`
--
ALTER TABLE `booms_tags`
  ADD CONSTRAINT `FK_2FE50133BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2FE5013333C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries_images`
--
ALTER TABLE `galleries_images`
  ADD CONSTRAINT `FK_6A81D6924E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_6A81D6923DA5256D` FOREIGN KEY (`image_id`) REFERENCES `gallery` (`id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `FK_472B783AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
