# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.19)
# Database: xiaolu
# Generation Time: 2018-06-08 11:21:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table xl_country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xl_country`;

CREATE TABLE `xl_country` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(120) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `code` varchar(64) NOT NULL DEFAULT '' COMMENT '英文字符',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xl_country` WRITE;
/*!40000 ALTER TABLE `xl_country` DISABLE KEYS */;

INSERT INTO `xl_country` (`id`, `name`, `pid`, `parentid`, `code`)
VALUES
	(0,NULL,NULL,NULL,''),
	(110000,'北京',0,NULL,'Beijing'),
	(110100,'北京',110000,NULL,'Beijing'),
	(120000,'天津',0,NULL,'Tianjin'),
	(120100,'天津',120000,NULL,'Tianjing'),
	(130000,'河北',0,NULL,'Hebei'),
	(130100,'石家庄',130000,NULL,'Shijiazhuang'),
	(130200,'唐山',130000,NULL,'Tangshan'),
	(140000,'山西',0,NULL,'Shanxi'),
	(140100,'太原',140000,NULL,'Taiyuan'),
	(150000,'内蒙古自治',0,NULL,'Nei Mongol'),
	(150100,'呼和浩特',150000,NULL,'Hohhot'),
	(150200,'包头',150000,NULL,'Baotou'),
	(210000,'辽宁',0,NULL,'Liaoning'),
	(210100,'沈阳',210000,NULL,'Shenyang'),
	(210200,'大连',210000,NULL,'Dalian'),
	(220000,'吉林',0,NULL,'Jilin'),
	(220100,'长春',220000,NULL,'Changchun'),
	(220403,'西安',220401,NULL,'Xian'),
	(230000,'黑龙江',0,NULL,'Heilongjiang'),
	(230100,'哈尔滨',230000,NULL,'Harbin'),
	(231005,'西安',231001,NULL,'Xian'),
	(310000,'上海',0,NULL,'Shanghai'),
	(310100,'上海',310000,NULL,'Shanghai'),
	(320000,'江苏',0,NULL,'Jiangsu'),
	(320100,'南京',320000,NULL,'Nanjing'),
	(320200,'无锡',320000,NULL,'Wuxi'),
	(320500,'苏州',320000,NULL,'Suzhou'),
	(330000,'浙江',0,NULL,'Zhejiang'),
	(330100,'杭州',330000,NULL,'Hangzhou'),
	(330200,'宁波',330000,NULL,'Ningbo'),
	(340000,'安徽',0,NULL,'Anhui'),
	(340100,'合肥',340000,NULL,'Hefei'),
	(341402,'居巢',NULL,NULL,''),
	(350000,'福建',0,NULL,'Fujian'),
	(350100,'福州',350000,NULL,'Fuzhou'),
	(350200,'厦门',350000,NULL,'Xiamen'),
	(350500,'泉州',350000,NULL,'Quanzhou'),
	(360000,'江西',0,NULL,'Jiangxi'),
	(360100,'南昌',360000,NULL,'Nanchang'),
	(370000,'山东',0,NULL,'Shandong'),
	(370100,'济南',370000,NULL,'Jinan'),
	(370200,'青岛',370000,NULL,'Qingdao'),
	(370600,'烟台',370000,NULL,'Yantai'),
	(410000,'河南',0,NULL,'Henan'),
	(410100,'郑州',410000,NULL,'Zhengzhou'),
	(420000,'湖北',0,NULL,'Hubei'),
	(420100,'武汉',420000,NULL,'Wuhan'),
	(430000,'湖南',0,NULL,'Hunan'),
	(430100,'长沙',430000,NULL,'Changsha'),
	(440000,'广东',0,NULL,'Guangdong'),
	(440100,'广州',440000,NULL,'Guangzhou'),
	(440300,'深圳',440000,NULL,'Shenzhen'),
	(440400,'珠海',440000,NULL,'Zhuhai'),
	(440600,'佛山',440000,NULL,'Foshan'),
	(441900,'东莞',440000,NULL,'Dongguan'),
	(450000,'广西壮族自治',0,NULL,'Guangxi'),
	(450100,'南宁',450000,NULL,'Nanning'),
	(460000,'海南',0,NULL,'Hainan'),
	(500000,'重庆',0,NULL,'Chongqing'),
	(500100,'重庆',500000,NULL,'Chongqing'),
	(510000,'四川',0,NULL,'Sichuan'),
	(510100,'成都',510000,NULL,'Chengdu'),
	(520000,'贵州',0,NULL,'Guizhou'),
	(520100,'贵阳',520000,NULL,'Guiyang'),
	(530000,'云南',0,NULL,'Yunnan'),
	(530100,'昆明',530000,NULL,'Kunming'),
	(540000,'西藏自治',0,NULL,'Xizang'),
	(610000,'陕西',0,NULL,'Shanxi'),
	(610100,'西安',610000,NULL,'Xian'),
	(620000,'甘肃',0,NULL,'Gansu'),
	(620100,'兰州',620000,NULL,'Nanzhou'),
	(630000,'青海',0,NULL,'Qinghai'),
	(640000,'宁夏回族自治',0,NULL,'Ningxia'),
	(650000,'新疆维吾尔自治',0,NULL,'Xinjiang'),
	(650100,'乌鲁木齐',650000,NULL,'Urumqi');

/*!40000 ALTER TABLE `xl_country` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
