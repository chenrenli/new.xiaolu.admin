# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.19)
# Database: xiaolu
# Generation Time: 2018-06-01 10:10:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table xl_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_admin`;

CREATE TABLE `xl_admin` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `truename` varchar(40) NOT NULL DEFAULT '' COMMENT '真名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(80) NOT NULL DEFAULT '' COMMENT 'email',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效:0无,1有',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_admin` WRITE;
/*!40000 ALTER TABLE `xl_admin` DISABLE KEYS */;

INSERT INTO `xl_admin` (`uid`, `username`, `truename`, `password`, `email`, `create_time`, `status`)
VALUES
	(9,'admin','123456','0421bd8d4d862b98dfcef6e52dce1748','',1488350628,1);

/*!40000 ALTER TABLE `xl_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_app
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_app`;

CREATE TABLE `xl_app` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `packagename` varchar(80) NOT NULL DEFAULT '' COMMENT '包名',
  `gamename` varchar(80) NOT NULL DEFAULT '' COMMENT '游戏名',
  `channel_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '渠道ID',
  `channel_title` varchar(100) NOT NULL DEFAULT '' COMMENT '渠道名称',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启:0否,1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_app` WRITE;
/*!40000 ALTER TABLE `xl_app` DISABLE KEYS */;

INSERT INTO `xl_app` (`id`, `packagename`, `gamename`, `channel_id`, `channel_title`, `create_time`, `update_time`, `status`)
VALUES
	(1,'com.test','com.test',1,'test',1527645944,1527645944,1),
	(3,'com.titan.stub','test',2,'xiaomi',1527822480,1527822480,1),
	(4,'test','test',1,'视频广告2',1527651703,1527651703,1);

/*!40000 ALTER TABLE `xl_app` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_app_ad
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_app_ad`;

CREATE TABLE `xl_app_ad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sdk_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'sdkId',
  `sdk_title` varchar(100) NOT NULL DEFAULT '' COMMENT 'sdk名称',
  `app_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'app Id',
  `position_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告类型ID',
  `position_title` varchar(200) NOT NULL DEFAULT '' COMMENT '广告类型名称',
  `adid` varchar(100) NOT NULL DEFAULT '' COMMENT '第三方广告ID',
  `appid` varchar(100) NOT NULL DEFAULT '' COMMENT '第三方应用ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有效:0无,1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='应用关联的广告';

LOCK TABLES `xl_app_ad` WRITE;
/*!40000 ALTER TABLE `xl_app_ad` DISABLE KEYS */;

INSERT INTO `xl_app_ad` (`id`, `sdk_id`, `sdk_title`, `app_id`, `position_id`, `position_title`, `adid`, `appid`, `status`)
VALUES
	(1,2,'test333',1,1,'视频广告','fdsfdas','test',0),
	(2,1,'test',1,2,'插屏广告','test','test444',0),
	(4,1,'test',3,1,'视频广告','tst123456','test444',0),
	(5,2,'test333',3,2,'插屏广告','tst123456','test5555',0),
	(6,1,'test',1,3,'横幅广告','555555','test444',0);

/*!40000 ALTER TABLE `xl_app_ad` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_auth_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_auth_group`;

CREATE TABLE `xl_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `xl_auth_group` WRITE;
/*!40000 ALTER TABLE `xl_auth_group` DISABLE KEYS */;

INSERT INTO `xl_auth_group` (`id`, `title`, `status`, `rules`)
VALUES
	(1,'fdsafdsa',1,'1,4,5'),
	(6,'fsdafdsa',1,''),
	(10,'fsafd',1,'1,3'),
	(11,'超级管理员',1,'3');

/*!40000 ALTER TABLE `xl_auth_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_auth_group_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_auth_group_access`;

CREATE TABLE `xl_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `xl_auth_group_access` WRITE;
/*!40000 ALTER TABLE `xl_auth_group_access` DISABLE KEYS */;

INSERT INTO `xl_auth_group_access` (`uid`, `group_id`)
VALUES
	(1,10);

/*!40000 ALTER TABLE `xl_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_auth_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_auth_rule`;

CREATE TABLE `xl_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `group_name` char(40) NOT NULL DEFAULT '' COMMENT '权限分组',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `xl_auth_rule` WRITE;
/*!40000 ALTER TABLE `xl_auth_rule` DISABLE KEYS */;

INSERT INTO `xl_auth_rule` (`id`, `name`, `title`, `status`, `condition`, `group_name`)
VALUES
	(3,'测试2','测试2',1,'测试2','测试'),
	(4,'app_index','应用首页',1,'','应用管理');

/*!40000 ALTER TABLE `xl_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_channel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_channel`;

CREATE TABLE `xl_channel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '渠道名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态:0否,1开启',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_channel` WRITE;
/*!40000 ALTER TABLE `xl_channel` DISABLE KEYS */;

INSERT INTO `xl_channel` (`id`, `title`, `status`)
VALUES
	(1,'视频广告2',1),
	(2,'xiaomi',1),
	(3,'360',1),
	(4,'联想',1);

/*!40000 ALTER TABLE `xl_channel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_migrations`;

CREATE TABLE `xl_migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_migrations` WRITE;
/*!40000 ALTER TABLE `xl_migrations` DISABLE KEYS */;

INSERT INTO `xl_migrations` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`)
VALUES
	(20170206025313,'AddTable','2018-05-29 16:44:19','2018-05-29 16:44:19',0),
	(20170218134511,'AddTables','2018-05-29 16:44:19','2018-05-29 16:44:19',0),
	(20170321091910,'AddTopicFields','2018-05-29 16:44:19','2018-05-29 16:44:19',0),
	(20180529083749,'Sdk','2018-05-29 16:44:19','2018-05-29 16:44:19',0),
	(20180529094636,'Channel','2018-05-29 17:50:08','2018-05-29 17:50:08',0),
	(20180529102050,'App','2018-05-29 18:31:15','2018-05-29 18:31:15',0),
	(20180530022322,'Position','2018-05-30 10:27:04','2018-05-30 10:27:04',0),
	(20180530032027,'AppAd','2018-05-30 11:54:15','2018-05-30 11:54:15',0),
	(20180601071545,'Update','2018-06-01 15:19:03','2018-06-01 15:19:03',0);

/*!40000 ALTER TABLE `xl_migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_position
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_position`;

CREATE TABLE `xl_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '类型名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效:0无,1有',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '英文名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告类型';

LOCK TABLES `xl_position` WRITE;
/*!40000 ALTER TABLE `xl_position` DISABLE KEYS */;

INSERT INTO `xl_position` (`id`, `title`, `status`, `name`)
VALUES
	(1,'视频广告',1,'video'),
	(2,'插屏广告',1,'interstitial'),
	(3,'横幅广告',1,'banner');

/*!40000 ALTER TABLE `xl_position` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_sdk
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_sdk`;

CREATE TABLE `xl_sdk` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '名称',
  `start_path` varchar(200) NOT NULL DEFAULT '' COMMENT '启动路径',
  `start_class` varchar(200) NOT NULL DEFAULT '' COMMENT '启动类名',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_sdk` WRITE;
/*!40000 ALTER TABLE `xl_sdk` DISABLE KEYS */;

INSERT INTO `xl_sdk` (`id`, `title`, `start_path`, `start_class`, `create_time`, `update_time`)
VALUES
	(1,'test','test','test',1527645563,1527645563),
	(2,'test333','test','test',1527645574,1527645583);

/*!40000 ALTER TABLE `xl_sdk` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xl_update
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_update`;

CREATE TABLE `xl_update` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `version` char(20) NOT NULL DEFAULT '' COMMENT '版本号',
  `file_path` varchar(1000) NOT NULL DEFAULT '' COMMENT '文件更新路径',
  `ver` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '版本号数字版',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_update` WRITE;
/*!40000 ALTER TABLE `xl_update` DISABLE KEYS */;

INSERT INTO `xl_update` (`id`, `version`, `file_path`, `ver`)
VALUES
	(1,'1.0.2','http://www.baidu.com',102);

/*!40000 ALTER TABLE `xl_update` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
