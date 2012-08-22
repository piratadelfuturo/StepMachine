/*
 Navicat Premium Data Transfer

 Source Server         : mamp
 Source Server Type    : MySQL
 Source Server Version : 50525
 Source Host           : 127.0.0.1
 Source Database       : sevenboom

 Target Server Type    : MySQL
 Target Server Version : 50525
 File Encoding         : utf-8

 Date: 08/22/2012 13:03:42 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `activity`
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boom_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `data` longtext COLLATE utf8_bin NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_AC74095A33C9EC5D` (`boom_id`),
  KEY `IDX_AC74095AA76ED395` (`user_id`),
  CONSTRAINT `FK_AC74095A33C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`),
  CONSTRAINT `FK_AC74095AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `bm_group`
-- ----------------------------
DROP TABLE IF EXISTS `bm_group`;
CREATE TABLE `bm_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `roles` longtext COLLATE utf8_bin NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4BB75C705E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `bm_user`
-- ----------------------------
DROP TABLE IF EXISTS `bm_user`;
CREATE TABLE `bm_user` (
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
  `image_path` tinytext COLLATE utf8_bin,
  `image_option` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_23BBCF7992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_23BBCF79A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_23BBCF79E17C91E8` (`facebookId`),
  UNIQUE KEY `UNIQ_23BBCF795FF5F412` (`twitterId`),
  UNIQUE KEY `UNIQ_23BBCF795E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `bm_user`
-- ----------------------------
BEGIN;
INSERT INTO `bm_user` VALUES ('5', 'piratadelfuturo', 'piratadelfuturo', 'facebook@echo.mx', 'facebook@echo.mx', '1', '', 'BFEQkknI/c+Nd7BaG7AaiyTfUFby/pkMHy3UsYqKqDcmvHoPRX/ame9TnVuOV2GrBH0JK9g4koW+CgTYI9mK+w==', '2012-08-22 17:38:21', '0', '0', null, null, null, 0x613a333a7b693a303b733a31333a22524f4c455f46414345424f4f4b223b693a313b733a31313a22524f4c455f534f4349414c223b693a323b733a31303a22524f4c455f41444d494e223b7d, '0', null, 'Daniel', 'Maldonado', '100000344182924', null, null, null, null, null, 0x687474703a2f2f67726170682e66616365626f6f6b2e636f6d2f3130303030303334343138323932342f706963747572653f747970653d6c61726765, '1');
COMMIT;

-- ----------------------------
--  Table structure for `bm_user_favorite_boom`
-- ----------------------------
DROP TABLE IF EXISTS `bm_user_favorite_boom`;
CREATE TABLE `bm_user_favorite_boom` (
  `user_id` int(11) NOT NULL,
  `boom_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`boom_id`),
  KEY `IDX_77C66A5A76ED395` (`user_id`),
  KEY `IDX_77C66A533C9EC5D` (`boom_id`),
  CONSTRAINT `FK_77C66A533C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`),
  CONSTRAINT `FK_77C66A5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `bm_user_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `bm_user_user_group`;
CREATE TABLE `bm_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_5D5A4D4AA76ED395` (`user_id`),
  KEY `IDX_5D5A4D4AFE54D947` (`group_id`),
  CONSTRAINT `FK_5D5A4D4AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`),
  CONSTRAINT `FK_5D5A4D4AFE54D947` FOREIGN KEY (`group_id`) REFERENCES `bm_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `boom`
-- ----------------------------
DROP TABLE IF EXISTS `boom`;
CREATE TABLE `boom` (
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
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `reply_enabled` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_22860604989D9B62` (`slug`),
  KEY `IDX_228606043DA5256D` (`image_id`),
  KEY `IDX_22860604A76ED395` (`user_id`),
  KEY `IDX_22860604727ACA70` (`parent_id`),
  KEY `IDX_2286060412469DE2` (`category_id`),
  CONSTRAINT `FK_2286060412469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_228606043DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  CONSTRAINT `FK_22860604727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `boom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_22860604A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `boom`
-- ----------------------------
BEGIN;
INSERT INTO `boom` VALUES ('2', null, null, null, 'hey-i-just-met-you', 'hey I just met you', 0x616e642074686973206973206372617a79, '2012-08-20 03:09:13', '2012-08-20 08:09:00', '0', '1', '0', '2', '2', '0', '0', '1', '0'), ('3', null, null, null, 'miu-s', 'miu \\\'s', 0x5b625d6d697527735b2f625d, '2012-08-20 03:31:37', '2012-08-20 18:31:00', '0', '1', '0', '2', '3', '0', '0', '1', '0'), ('4', null, null, null, 'test', 'Test', 0x5b625d68656c6c6f5b2f625d, '2012-08-21 22:58:39', '2012-08-21 22:58:39', '0', '1', '0', '2', '4', '0', '0', '2', '0'), ('5', null, null, null, 'test-1', 'test', 0x74657374737373, '2012-08-22 17:38:59', '2012-08-22 17:38:59', '0', '1', '0', '2', '5', '0', '0', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `boomelement`
-- ----------------------------
DROP TABLE IF EXISTS `boomelement`;
CREATE TABLE `boomelement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `content` longtext COLLATE utf8_bin,
  `position` int(11) NOT NULL,
  `community_position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57CBBBB0727ACA70` (`parent_id`),
  KEY `IDX_57CBBBB03DA5256D` (`image_id`),
  CONSTRAINT `FK_57CBBBB03DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  CONSTRAINT `FK_57CBBBB0727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `boom` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `boomelement`
-- ----------------------------
BEGIN;
INSERT INTO `boomelement` VALUES ('1', '2', null, 'But heres\\\'s my number', 0x536f2063616c6c206d65206d61796265, '1', '0'), ('2', '2', null, null, null, '2', '0'), ('3', '2', null, null, null, '3', '0'), ('4', '2', null, null, null, '4', '0'), ('5', '2', null, null, null, '5', '0'), ('6', '2', null, null, null, '6', '0'), ('7', '2', null, null, null, '7', '0'), ('8', '3', null, 'miu \\\'s j', 0x6d6975205c2773, '2', '0'), ('9', '3', null, 'aahahah', null, '1', '0'), ('10', '3', null, null, null, '3', '0'), ('11', '3', null, null, null, '4', '0'), ('12', '3', null, null, null, '5', '0'), ('13', '3', null, null, null, '6', '0'), ('14', '3', null, null, null, '7', '0'), ('15', '4', null, 'hola', 0x484148414841, '1', '0'), ('16', '4', null, null, null, '2', '0'), ('17', '4', null, null, null, '3', '0'), ('18', '4', null, null, null, '4', '0'), ('19', '4', null, null, null, '5', '0'), ('20', '4', null, null, null, '6', '0'), ('21', '4', null, null, null, '7', '0'), ('22', '5', null, null, null, '1', '0'), ('23', '5', null, null, null, '2', '0'), ('24', '5', null, null, null, '3', '0'), ('25', '5', null, null, null, '4', '0'), ('26', '5', null, null, null, '5', '0'), ('27', '5', null, null, null, '6', '0'), ('28', '5', null, null, null, '7', '0');
COMMIT;

-- ----------------------------
--  Table structure for `boomelement_rank`
-- ----------------------------
DROP TABLE IF EXISTS `boomelement_rank`;
CREATE TABLE `boomelement_rank` (
  `boom_id` int(11) NOT NULL,
  `boomelement_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`boom_id`,`boomelement_id`,`user_id`),
  UNIQUE KEY `search_primary` (`user_id`,`boom_id`,`boomelement_id`),
  KEY `IDX_67E8EB4333C9EC5D` (`boom_id`),
  KEY `IDX_67E8EB43A898573C` (`boomelement_id`),
  KEY `IDX_67E8EB43A76ED395` (`user_id`),
  CONSTRAINT `FK_67E8EB4333C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`),
  CONSTRAINT `FK_67E8EB43A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`),
  CONSTRAINT `FK_67E8EB43A898573C` FOREIGN KEY (`boomelement_id`) REFERENCES `boomelement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `booms_categories`
-- ----------------------------
DROP TABLE IF EXISTS `booms_categories`;
CREATE TABLE `booms_categories` (
  `boom_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`boom_id`,`category_id`),
  KEY `IDX_B691B0C833C9EC5D` (`boom_id`),
  KEY `IDX_B691B0C812469DE2` (`category_id`),
  CONSTRAINT `FK_B691B0C812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B691B0C833C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `booms_categories`
-- ----------------------------
BEGIN;
INSERT INTO `booms_categories` VALUES ('2', '1'), ('3', '1'), ('4', '1'), ('5', '1');
COMMIT;

-- ----------------------------
--  Table structure for `booms_tags`
-- ----------------------------
DROP TABLE IF EXISTS `booms_tags`;
CREATE TABLE `booms_tags` (
  `boom_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`boom_id`,`tag_id`),
  KEY `IDX_2FE5013333C9EC5D` (`boom_id`),
  KEY `IDX_2FE50133BAD26311` (`tag_id`),
  CONSTRAINT `FK_2FE5013333C9EC5D` FOREIGN KEY (`boom_id`) REFERENCES `boom` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2FE50133BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(140) COLLATE utf8_bin NOT NULL,
  `name` varchar(140) COLLATE utf8_bin NOT NULL,
  `position` int(11) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `category`
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES ('1', 'musica', 'Música', '1', '1'), ('2', 'sexo', 'Sexo', '0', '1'), ('3', 'cine', 'Cine', '2', '1'), ('4', 'chacharas', 'Chacharas', '3', '0'), ('5', 'tecnologia', 'Tecnología', '4', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ext_log_entries`
-- ----------------------------
DROP TABLE IF EXISTS `ext_log_entries`;
CREATE TABLE `ext_log_entries` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `follow`
-- ----------------------------
DROP TABLE IF EXISTS `follow`;
CREATE TABLE `follow` (
  `user_id` int(11) NOT NULL,
  `follow_user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`follow_user_id`),
  KEY `IDX_68344470A76ED395` (`user_id`),
  KEY `IDX_68344470F99B8B25` (`follow_user_id`),
  CONSTRAINT `FK_68344470A76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`),
  CONSTRAINT `FK_68344470F99B8B25` FOREIGN KEY (`follow_user_id`) REFERENCES `bm_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `galleries_images`
-- ----------------------------
DROP TABLE IF EXISTS `galleries_images`;
CREATE TABLE `galleries_images` (
  `image_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`,`gallery_id`),
  KEY `IDX_6A81D6923DA5256D` (`image_id`),
  KEY `IDX_6A81D6924E7AF8F` (`gallery_id`),
  CONSTRAINT `FK_6A81D6923DA5256D` FOREIGN KEY (`image_id`) REFERENCES `gallery` (`id`),
  CONSTRAINT `FK_6A81D6924E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `image` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `gallery`
-- ----------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `nsfw` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_472B783AA76ED395` (`user_id`),
  CONSTRAINT `FK_472B783AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `image`
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(140) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `path` varchar(255) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `date_created` datetime NOT NULL,
  `nsfw` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FA76ED395` (`user_id`),
  CONSTRAINT `FK_C53D045FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `bm_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(140) COLLATE utf8_bin NOT NULL,
  `name` varchar(140) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
