-- MySQL dump 10.13  Distrib 5.6.10, for osx10.8 (x86_64)
--
-- Host: localhost    Database: eight
-- ------------------------------------------------------
-- Server version	5.6.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES binary */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `source` text NOT NULL,
  `comment` text,
  `release_date` datetime NOT NULL,
  `release_status` int(4) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `action_release`
--

DROP TABLE IF EXISTS `action_release`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action_release` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `source` text NOT NULL,
  `comment` text,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mail_address` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(255) DEFAULT NULL,
  `valid_flag` int(2) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applicant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `data` text,
  `carrier` int(4) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `app_version` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `serial` (`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=40133 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `delivery_mail_magazine`
--

DROP TABLE IF EXISTS `delivery_mail_magazine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_mail_magazine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enquete_log`
--

DROP TABLE IF EXISTS `enquete_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquete_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail`
--

DROP TABLE IF EXISTS `mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=49612 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail_address_temporary`
--

DROP TABLE IF EXISTS `mail_address_temporary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_address_temporary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail_template`
--

DROP TABLE IF EXISTS `mail_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `from` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `release_date` datetime NOT NULL,
  `release_status` int(4) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail_template_release`
--

DROP TABLE IF EXISTS `mail_template_release`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_template_release` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `from` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varbinary(100) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `seat1` varchar(100) DEFAULT NULL,
  `seat2` varchar(100) DEFAULT NULL,
  `seat3` varchar(100) DEFAULT NULL,
  `seat4` varchar(100) DEFAULT NULL,
  `gate` varchar(100) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kname` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `pref` varchar(255) DEFAULT NULL,
  `pair_serial` varchar(100) DEFAULT NULL,
  `pair_seat1` varchar(100) DEFAULT NULL,
  `pair_seat2` varchar(100) DEFAULT NULL,
  `pair_seat3` varchar(100) DEFAULT NULL,
  `pair_seat4` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `pair_name` varchar(255) DEFAULT NULL,
  `pair_kname` varchar(255) DEFAULT NULL,
  `pair_zip` varchar(255) DEFAULT NULL,
  `pair_pref` varchar(255) DEFAULT NULL,
  `pair_address1` varchar(255) DEFAULT NULL,
  `pair_address2` varchar(255) DEFAULT NULL,
  `pair_phone` varchar(255) DEFAULT NULL,
  `pair_age` varchar(100) DEFAULT NULL,
  `ua` varchar(255) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `is_pair` int(2) unsigned NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `check_gate` varchar(100) DEFAULT NULL,
  `valid_flag` int(2) unsigned NOT NULL DEFAULT '1',
  `register_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `serial` (`serial`),
  KEY `pair_serial` (`pair_serial`),
  KEY `uid` (`uid`),
  KEY `seat1` (`seat1`,`seat2`,`seat3`,`seat4`),
  KEY `pair_seat1` (`pair_seat1`,`pair_seat2`,`pair_seat3`,`pair_seat4`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `member_point_log`
--

DROP TABLE IF EXISTS `member_point_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_point_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `action_code` varchar(100) DEFAULT NULL,
  `content_type` varchar(100) NOT NULL,
  `source_mobile` text,
  `source_smartphone` text,
  `is_close` int(2) NOT NULL DEFAULT '0',
  `release_date` datetime NOT NULL,
  `release_status` int(4) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `page_release`
--

DROP TABLE IF EXISTS `page_release`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_release` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `action_code` varchar(100) DEFAULT NULL,
  `content_type` varchar(100) NOT NULL,
  `source_mobile` text,
  `source_smartphone` text,
  `is_close` int(2) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` varchar(255) DEFAULT NULL,
  `uid` varbinary(100) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `mail_address` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data` text,
  `carrier` int(4) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `app_version` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registration2`
--

DROP TABLE IF EXISTS `registration2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` varchar(255) DEFAULT NULL,
  `uid` varbinary(100) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `mail_address` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data` text,
  `carrier` int(4) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `app_version` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=290 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `bit` int(11) NOT NULL DEFAULT '0',
  `valid_flag` int(2) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `serial`
--

DROP TABLE IF EXISTS `serial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `serial_number`
--

DROP TABLE IF EXISTS `serial_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serial_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_id` int(11) NOT NULL,
  `n` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_serial_number_serial` (`serial_id`),
  KEY `n` (`n`),
  CONSTRAINT `fk_serial_number_serial` FOREIGN KEY (`serial_id`) REFERENCES `serial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=151001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `serial_use`
--

DROP TABLE IF EXISTS `serial_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serial_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` varchar(100) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `n` varchar(100) NOT NULL,
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `params` text,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `n` (`n`),
  KEY `serial_use_idx1` (`code`,`uid`),
  KEY `create_date` (`create_date`)
) ENGINE=InnoDB AUTO_INCREMENT=83768 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fqdn` varchar(100) NOT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `valid_flag` int(2) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `uid`
--

DROP TABLE IF EXISTS `uid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_address` varchar(255) NOT NULL,
  `course` varchar(255) DEFAULT NULL,
  `name1` varchar(100) DEFAULT NULL,
  `name2` varchar(100) DEFAULT NULL,
  `kname1` varchar(100) DEFAULT NULL,
  `kname2` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `prefecture` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `pair` int(2) NOT NULL DEFAULT '0',
  `pair_name1` varchar(100) DEFAULT NULL,
  `pair_name2` varchar(100) DEFAULT NULL,
  `pair_kname1` varchar(100) DEFAULT NULL,
  `pair_kname2` varchar(100) DEFAULT NULL,
  `pair_postcode` varchar(100) DEFAULT NULL,
  `pair_address1` varchar(100) DEFAULT NULL,
  `pair_address2` varchar(100) DEFAULT NULL,
  `pair_prefecture` varchar(100) DEFAULT NULL,
  `pair_age` varchar(100) DEFAULT NULL,
  `pair_sex` varchar(100) DEFAULT NULL,
  `pair_tel` varchar(100) DEFAULT NULL,
  `is_uid_changed` int(2) DEFAULT '0',
  `uid` varbinary(255) DEFAULT NULL,
  `default_uid` varbinary(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `serial1` varchar(100) DEFAULT NULL,
  `serial2` varchar(100) DEFAULT NULL,
  `is_checked` int(2) DEFAULT '0',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `mail_address` (`mail_address`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `uid2`
--

DROP TABLE IF EXISTS `uid2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uid2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_address` varchar(255) NOT NULL,
  `course` varchar(255) DEFAULT NULL,
  `name1` varchar(100) DEFAULT NULL,
  `name2` varchar(100) DEFAULT NULL,
  `kname1` varchar(100) DEFAULT NULL,
  `kname2` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `prefecture` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `pair` int(2) NOT NULL DEFAULT '0',
  `pair_name1` varchar(100) DEFAULT NULL,
  `pair_name2` varchar(100) DEFAULT NULL,
  `pair_kname1` varchar(100) DEFAULT NULL,
  `pair_kname2` varchar(100) DEFAULT NULL,
  `pair_postcode` varchar(100) DEFAULT NULL,
  `pair_address1` varchar(100) DEFAULT NULL,
  `pair_address2` varchar(100) DEFAULT NULL,
  `pair_prefecture` varchar(100) DEFAULT NULL,
  `pair_age` varchar(100) DEFAULT NULL,
  `pair_sex` varchar(100) DEFAULT NULL,
  `pair_tel` varchar(100) DEFAULT NULL,
  `is_uid_changed` int(2) DEFAULT '0',
  `uid` varbinary(255) DEFAULT NULL,
  `default_uid` varbinary(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `serial1` varchar(100) DEFAULT NULL,
  `serial2` varchar(100) DEFAULT NULL,
  `is_checked` int(2) DEFAULT '0',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `mail_address` (`mail_address`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-18 16:43:47
