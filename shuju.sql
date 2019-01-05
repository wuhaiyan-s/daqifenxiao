-- MySQL dump 10.14  Distrib 5.5.56-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fenxiao01
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wemall_access`
--

DROP TABLE IF EXISTS `wemall_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_access`
--

LOCK TABLES `wemall_access` WRITE;
/*!40000 ALTER TABLE `wemall_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_admin`
--

DROP TABLE IF EXISTS `wemall_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_admin`
--

LOCK TABLES `wemall_admin` WRITE;
/*!40000 ALTER TABLE `wemall_admin` DISABLE KEYS */;
INSERT INTO `wemall_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','2015-07-12 03:05:38');
/*!40000 ALTER TABLE `wemall_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_alipay`
--

DROP TABLE IF EXISTS `wemall_alipay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_alipay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipayname` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '֧',
  `partner` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'id',
  `key` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ȫ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_alipay`
--

LOCK TABLES `wemall_alipay` WRITE;
/*!40000 ALTER TABLE `wemall_alipay` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_alipay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_good`
--

DROP TABLE IF EXISTS `wemall_good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_good` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` text NOT NULL,
  `yongjin` text NOT NULL,
  `price` text NOT NULL,
  `commision` text NOT NULL,
  `old_price` text NOT NULL,
  `image` text NOT NULL,
  `detail` text,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_good`
--

LOCK TABLES `wemall_good` WRITE;
/*!40000 ALTER TABLE `wemall_good` DISABLE KEYS */;
INSERT INTO `wemall_good` VALUES (29,1,0,'测试0001','','0.1','0.05','0.1','5b69684971f27.png','<p>多23131231231</p>',1,'2018-08-07 09:37:13'),(28,1,1,'经济款修行打坐金字塔','','1999','1','2999','5b690566b73e8.jpg','<p><img src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336098426441.jpg\" _src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336098426441.jpg\"/></p><p><img src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336098155091.jpg\" _src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336098155091.jpg\" style=\"\"/></p><p><img src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101072876.jpg\" _src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101072876.jpg\" style=\"\"/><img src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101175365.jpg\" _src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101175365.jpg\" style=\"line-height: 1.5;\"/></p><p><img src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101198553.jpg\" _src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101198553.jpg\" style=\"\"/></p><p><img src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101326149.jpg\" _src=\"http://c.6gcc.com/weixin/Public/Plugin/umeditor/php/upload/20180807/15336101326149.jpg\" style=\"\"/></p><p><br/></p>',1,'2018-08-07 02:49:27');
/*!40000 ALTER TABLE `wemall_good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_info`
--

DROP TABLE IF EXISTS `wemall_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `notification` text NOT NULL,
  `theme` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_info`
--

LOCK TABLES `wemall_info` WRITE;
/*!40000 ALTER TABLE `wemall_info` DISABLE KEYS */;
INSERT INTO `wemall_info` VALUES (1,'直销360分销系统','欢迎使用直销360分销系统','default');
/*!40000 ALTER TABLE `wemall_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_mail`
--

DROP TABLE IF EXISTS `wemall_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_mail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `smtp` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `on` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_mail`
--

LOCK TABLES `wemall_mail` WRITE;
/*!40000 ALTER TABLE `wemall_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_member`
--

DROP TABLE IF EXISTS `wemall_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_member`
--

LOCK TABLES `wemall_member` WRITE;
/*!40000 ALTER TABLE `wemall_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_menu`
--

DROP TABLE IF EXISTS `wemall_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_menu`
--

LOCK TABLES `wemall_menu` WRITE;
/*!40000 ALTER TABLE `wemall_menu` DISABLE KEYS */;
INSERT INTO `wemall_menu` VALUES (1,' 宇宙之能修行打坐金字塔',0);
/*!40000 ALTER TABLE `wemall_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_node`
--

DROP TABLE IF EXISTS `wemall_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_node`
--

LOCK TABLES `wemall_node` WRITE;
/*!40000 ALTER TABLE `wemall_node` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_order`
--

DROP TABLE IF EXISTS `wemall_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `totalprice` decimal(11,2) DEFAULT NULL,
  `pay_style` varchar(255) NOT NULL,
  `pay_status` tinyint(3) unsigned NOT NULL,
  `note` text NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cartdata` text NOT NULL,
  `order_info` text NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `shouhuoname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `order` (`order_status`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_order`
--

LOCK TABLES `wemall_order` WRITE;
/*!40000 ALTER TABLE `wemall_order` DISABLE KEYS */;
INSERT INTO `wemall_order` VALUES (91,191,'201507062353157',0.01,'微信支付',1,'',0,'2015-07-06 15:53:38','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','','河北省,廊坊市,固安镇,测试一下','13541855055','看见'),(92,191,'201507070228218',0.01,'微信支付',1,'',0,'2015-07-11 00:49:00','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','','河北省,廊坊市,永清县,测试一下','13541855055','看见'),(93,194,'201507070812122',2199.00,'微信支付',0,'不能说的秘密',0,'2015-07-07 00:12:12','[{\"name\":\"美国艾奥尼克（ionicpro）空气净化器， TA500静音除雾霾PM2.5&lt;黑色&gt;\",\"num\":\"1\",\"price\":\"2199\"}]','','重庆市,重庆市,九龙坡区,测试中测试中','15312649823','测试中'),(94,197,'201507071004318',0.01,'微信支付',1,'很好很好很好',0,'2015-07-07 02:04:47','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','','北京市,北京市,东城区,呵呵哈哈哈','18510362698','张吉凯'),(95,199,'201507071222007',699.00,'微信支付',0,'j j k k',0,'2015-07-07 04:22:00','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','','甘肃省,兰州市,,土同志','15294181385','交流'),(96,200,'201507071401049',0.01,'微信支付',1,'',0,'2015-07-11 00:48:51','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','','辽宁省,沈阳市,沈河区,呵呵哈哈哈','8555','嘿嘿'),(97,200,'201507071408406',0.01,'微信支付',1,'',0,'2015-07-07 06:09:20','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','','辽宁省,沈阳市,沈河区,嘿嘿','8555','嘿嘿'),(98,200,'201507101452143',0.01,'微信支付',1,'',2,'2015-08-07 04:03:35','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12580\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','辽宁省,沈阳市,沈河区,考虑考虑','8555','嘿嘿'),(99,200,'201507101454153',0.01,'微信支付',1,'',0,'2015-07-11 11:20:00','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','天津市,天津市,和平区,哦了啦咯了','8555','嘿嘿'),(100,205,'201507101534321',2199.00,'微信支付',0,'',0,'2015-07-10 07:34:32','[{\"name\":\"美国艾奥尼克（ionicpro）空气净化器， TA500静音除雾霾PM2.5&lt;黑色&gt;\",\"num\":\"1\",\"price\":\"2199\"}]','','上海市,上海市,,ggg','17705280002','wei'),(101,207,'201507101639144',2199.00,'微信支付',0,'Haagou',0,'2015-07-10 08:39:14','[{\"name\":\"美国艾奥尼克（ionicpro）空气净化器， TA500静音除雾霾PM2.5&lt;黑色&gt;\",\"num\":\"1\",\"price\":\"2199\"}]','','广东省,深圳市,宝安区,西乡大道','18675545551','李佳晔'),(102,81,'201507102147199',0.01,'微信支付',1,'',2,'2015-07-11 13:59:20','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12580\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','山西省,晋城市,高平市,从而','15300082935','卖源码'),(103,175,'201507110120456',0.01,'微信支付',1,'',2,'2015-07-11 11:19:41','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12580\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','上海市,上海市,黄浦区,测试','13423777013','测试'),(104,215,'201507110138515',0.01,'微信支付',1,'',2,'2015-08-07 04:03:35','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','上海市,上海市,静安区,1的的','1111','豪'),(105,215,'201507110140002',0.01,'微信支付',1,'',2,'2015-08-07 04:03:35','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','重庆市,重庆市,江北区,好好','1111','豪'),(106,216,'201507110345564',2199.00,'微信支付',0,'',0,'2015-07-11 11:18:59','[{\"name\":\"美国艾奥尼克（ionicpro）空气净化器， TA500静音除雾霾PM2.5&lt;黑色&gt;\",\"num\":\"1\",\"price\":\"2199\"}]','{\"num\":\"2015\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','重庆市,重庆市,沙坪坝区,不会和','13813813838','方法'),(107,81,'201507110844208',699.00,'微信支付',1,'',2,'2015-07-11 11:18:51','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','{\"num\":\"12036\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','北京市,北京市,东城区,吴','15300000000','吴怡华'),(108,81,'201507110845405',699.00,'微信支付',1,'',2,'2015-07-11 11:18:45','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','{\"num\":\"12036\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','重庆市,重庆市,九龙坡区,25874','15300000000','吴怡华'),(109,208,'201507110923311',0.01,'微信支付',1,'',2,'2015-07-11 11:18:33','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','河北省,承德市,下板城镇,111','1111','1111'),(110,81,'201507110937417',2199.00,'微信支付',1,'',2,'2015-07-11 11:18:24','[{\"name\":\"美国艾奥尼克（ionicpro）空气净化器， TA500静音除雾霾PM2.5&lt;黑色&gt;\",\"num\":\"1\",\"price\":\"2199\"}]','{\"num\":\"110\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','北京市,北京市,宣武区,测试','15300000000','吴怡华'),(111,81,'201507111007033',2177.01,'微信支付',1,'',2,'2015-07-11 11:18:16','[{\"name\":\"美国艾奥尼克（ionicpro）空气净化器， TA500静音除雾霾PM2.5&lt;黑色&gt;\",\"num\":\"1\",\"price\":\"2177.01\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','重庆市,重庆市,九龙坡区,从而','15300000000','吴怡华'),(112,81,'201507111210402',0.01,'微信支付',1,'',2,'2015-07-11 11:08:12','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"3051029945\",\"name\":\"\\u987a\\u4e30\\u901f\\u8fd0\"}','重庆市,重庆市,九龙坡区,微信','15300000000','吴怡华'),(113,81,'201507111211549',699.00,'微信支付',1,'',2,'2015-07-11 11:08:10','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','{\"num\":\"3052261208\",\"name\":\"\\u5b85\\u6025\\u9001\"}','河北省,廊坊市,固安县,测试','15300000000','吴怡华'),(114,219,'201507111218248',0.01,'微信支付',0,'',0,'2015-07-11 04:18:24','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','','北京市,北京市,朝阳区,呵呵哈哈哈哈','13911001340','郭成'),(115,175,'201507111422468',0.01,'微信支付',1,'',2,'2015-08-07 04:03:35','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"5680489630\",\"name\":\"\\u987a\\u4e30\\u5feb\\u9012\"}','重庆市,重庆市,沙坪坝区,测试','13423777013','测试'),(116,220,'201507111423184',0.01,'微信支付',1,'',2,'2015-08-07 04:03:35','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','浙江省,宁波市,鄞州区,天童南路399号','15990555587','15990555587'),(117,81,'201507111430002',0.01,'微信支付',1,'',2,'2015-07-11 11:08:07','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.01\"}]','{\"num\":\"3052214563\",\"name\":\"\\u767e\\u4e16\\u6c47\\u901a\"}','河北省,唐山市,开平区,与测试','15300000000','吴怡华'),(118,208,'201507111912527',0.10,'微信支付',1,'',2,'2015-08-07 04:03:35','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','{\"num\":\"12306\",\"name\":\"\\u65cf\\u957f\\u901a\\u77e5\\u4e66\"}','河北省,唐山市,开平区,Q','1111','1111'),(119,228,'201507111944304',699.00,'微信支付',0,'',0,'2015-07-11 11:44:30','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','','重庆市,重庆市,九龙坡区,百度','56999','百度'),(120,81,'201507112307065',699.00,'微信支付',0,'丰润区',0,'2015-07-11 15:07:06','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','','河北省,唐山市,丰润区,测试货到付款','15300000000','吴怡华'),(121,81,'201507112307101',699.00,'微信支付',1,'丰润区',4,'2018-08-05 02:40:13','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','{\"num\":\"12580\",\"name\":\"\\u5706\\u901a\"}','河北省,唐山市,丰润区,测试货到付款','15300000000','吴怡华'),(122,248,'201507120043395',0.10,'微信支付',1,'',0,'2015-07-11 16:44:19','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','上海市,上海市,徐汇区,xndnndndss\n','15151515154','yq'),(123,81,'201507120106391',699.00,'微信支付',0,'',0,'2015-07-11 17:06:39','[{\"name\":\"戴克（DYKE）空气净化器 A400 家用无耗材除雾霾PM2.5终身无耗材（金色）\",\"num\":\"1\",\"price\":\"699\"}]','','河北省,廊坊市,固安镇,把腿就跑','15300000000','吴怡华'),(124,50001,'201508141607537',2980.00,'微信支付',1,'',2,'2015-08-14 08:13:31','[{\"name\":\"美国森盾终身无耗材空气净化器，雾霾，PM2.5,除甲醛\",\"num\":\"1\",\"price\":\"2980\"}]','{\"num\":\"\",\"name\":\"\"}','山东省,济南市,市中区,特色家常','198410','特色家常'),(125,50001,'201508141613283',0.10,'微信支付',1,'特色家常',2,'2015-08-18 06:35:32','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,东城区,特色家常','198410','特色家常'),(126,50001,'201508161417476',0.10,'微信支付',1,'',2,'2015-08-16 06:54:13','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','{\"num\":\"\",\"name\":\"\"}','北京市,北京市,东城区,乞丐省乞丐市乞丐村','198410','乞丐'),(127,50002,'201808051038002',0.10,'微信支付',0,'',0,'2018-08-05 02:38:00','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,大兴区,狼垡','18510036026','吴海艳'),(128,50002,'201808051038334',0.10,'微信支付',0,'',0,'2018-08-05 02:38:33','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','上海市,上海市,徐汇区,111111','18510036026','吴海艳'),(129,50002,'201808051046001',0.10,'微信支付',0,'',0,'2018-08-05 02:46:00','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,朝阳区,ghjk ','18510036026','吴海艳'),(130,50002,'201808051551353',0.10,'微信支付',1,'',2,'2018-08-06 09:35:29','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,大兴区,是大概','18510036026','吴海艳'),(131,50002,'201808060939345',0.10,'微信支付',1,'',2,'2018-08-06 09:35:29','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,东城区,小吃街','18510036026','吴海艳'),(132,50003,'201808061106188',0.10,'微信支付',1,'',0,'2018-08-06 03:06:29','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,东城区,新春佳节排骨','17080156028','法国红酒'),(133,50003,'201808061112426',1.00,'微信支付',1,'',3,'2018-08-07 09:36:36','[{\"name\":\"打坐帐篷\",\"num\":\"1\",\"price\":\"1\"}]','','北京市,北京市,东城区,带点东西','17080156028','法国红酒'),(134,50003,'201808061117019',0.10,'微信支付',1,'',3,'2018-08-07 09:36:36','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,东城区,巡考','17080156028','测试吴'),(135,50004,'201808061139093',1.00,'微信支付',0,'gdgydd',0,'2018-08-06 03:39:09','[{\"name\":\"打坐帐篷\",\"num\":\"1\",\"price\":\"1\"}]','','天津市,天津市,河北区,ysyysv','13020040188','13020040188'),(136,50004,'201808061217128',0.10,'微信支付',1,'hdhdj',2,'2018-08-06 09:35:29','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','天津市,天津市,河北区,hdjdjd','13020040188','13020040188'),(137,50003,'201808061723195',0.10,'微信支付',1,'',3,'2018-08-07 09:36:36','[{\"name\":\"测试，加入我们\",\"num\":\"1\",\"price\":\"0.1\"}]','','北京市,北京市,大兴区,vgjj ','17080156028','吴haiyan1'),(138,50003,'201808061827463',1.00,'微信支付',1,'',4,'2018-08-07 09:53:07','[{\"name\":\"打坐帐篷\",\"num\":\"1\",\"price\":\"1\"}]','','北京市,北京市,东城区,cchj ','17080156028','吴haiyan1'),(139,50002,'201808071731272',3998.00,'微信支付',0,'',0,'2018-08-07 09:31:27','[{\"name\":\"经济款修行打坐金字塔\",\"num\":\"2\",\"price\":\"1999\"}]','','北京市,北京市,东城区,aaadds','18510036026','吴海艳');
/*!40000 ALTER TABLE `wemall_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_order_level`
--

DROP TABLE IF EXISTS `wemall_order_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_order_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL,
  `level_type` tinyint(3) unsigned NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `active_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=338 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_order_level`
--

LOCK TABLES `wemall_order_level` WRITE;
/*!40000 ALTER TABLE `wemall_order_level` DISABLE KEYS */;
INSERT INTO `wemall_order_level` VALUES (1,'201504231550177',1,14,1,2.50,NULL),(2,'201504231552321',1,15,1,2.50,NULL),(3,'201504231552321',1,14,2,1.50,NULL),(4,'201504231554222',0,15,1,2.50,NULL),(5,'201504231554222',0,14,2,1.50,NULL),(6,'201504231554275',1,18,1,2.50,NULL),(7,'201504231554275',1,15,2,1.50,NULL),(8,'201504231554275',1,14,3,1.00,NULL),(9,'201504231611081',1,14,1,25.00,NULL),(10,'201504231614176',1,17,1,25.00,NULL),(11,'201504231614176',1,14,2,15.00,NULL),(12,'201504231617054',1,20,1,25.00,NULL),(13,'201504231617054',1,17,2,15.00,NULL),(14,'201504231617054',1,14,3,10.00,NULL),(15,'201504231619359',1,21,1,25.00,NULL),(16,'201504231619359',1,20,2,15.00,NULL),(17,'201504231619359',1,17,3,10.00,NULL),(18,'201504240950567',0,15,1,25.00,NULL),(19,'201504240950567',0,14,2,15.00,NULL),(20,'201504240952105',0,15,1,2.50,NULL),(21,'201504240952105',0,14,2,1.50,NULL),(22,'201504240952569',1,15,1,25.00,NULL),(23,'201504240952569',1,14,2,15.00,NULL),(24,'201504272240588',1,28,1,0.00,NULL),(25,'201504272307408',2,28,1,0.00,'2015-05-14 04:52:05'),(26,'201504272332013',2,28,1,0.00,'2015-05-21 04:18:42'),(27,'201504280844263',1,28,1,0.00,NULL),(28,'201504280845391',1,28,1,0.00,NULL),(29,'201504280940587',1,28,1,0.00,NULL),(30,'201504281100372',1,83,1,0.00,NULL),(31,'201504281116541',1,28,1,0.00,NULL),(32,'201504281121541',0,104,1,0.00,NULL),(33,'201504281121541',0,28,2,0.00,NULL),(34,'201504281127164',3,104,1,0.00,'2015-05-16 00:48:49'),(35,'201504281127164',2,28,2,0.00,'2015-05-16 00:48:49'),(36,'201504281131244',1,93,1,0.00,NULL),(37,'201504281210406',1,28,1,0.00,NULL),(38,'201504281212179',1,117,1,0.00,NULL),(39,'201504281212179',1,104,2,0.00,NULL),(40,'201504281212179',1,28,3,0.00,NULL),(41,'201504281321346',1,93,1,0.00,NULL),(42,'201504281400243',1,59,1,0.00,NULL),(43,'201504281453239',1,50,1,0.00,NULL),(44,'201504281505024',1,50,1,0.00,NULL),(45,'201504281518121',1,93,1,0.00,NULL),(46,'201504281635142',1,28,1,0.00,NULL),(47,'201504281639535',0,50,1,0.00,NULL),(48,'201504281651025',1,50,1,0.00,NULL),(49,'201504281926109',1,117,1,0.00,NULL),(50,'201504281926109',1,104,2,0.00,NULL),(51,'201504281926109',1,28,3,0.00,NULL),(52,'201504282108395',0,28,1,0.00,NULL),(53,'201504282109104',0,28,1,0.00,NULL),(54,'201504282110091',1,28,1,0.00,NULL),(55,'201504282129563',3,106,1,0.00,'2015-05-21 06:55:23'),(56,'201504282129563',2,28,2,0.00,'2015-05-21 06:55:23'),(57,'201504282136322',3,106,1,0.00,'2015-05-21 06:28:05'),(58,'201504282136322',2,28,2,0.00,'2015-05-21 06:28:05'),(59,'201504282143377',3,106,1,0.00,'2015-05-21 06:28:05'),(60,'201504282143377',2,28,2,0.00,'2015-05-21 06:28:05'),(61,'201504282222487',2,51,1,0.00,'2015-05-21 06:28:05'),(62,'201504282222487',2,28,2,0.00,'2015-05-21 06:28:05'),(63,'201504290046012',0,153,1,19.60,NULL),(64,'201504290046012',0,117,2,14.70,NULL),(65,'201504290046012',0,104,3,9.80,NULL),(66,'201504290609549',2,39,1,0.00,'2015-05-21 06:28:05'),(67,'201504290732577',0,117,1,0.00,NULL),(68,'201504290732577',0,104,2,0.00,NULL),(69,'201504290732577',0,28,3,0.00,NULL),(70,'201504290833013',0,59,1,0.00,NULL),(71,'201504290850126',1,59,1,0.00,NULL),(72,'201504290857336',1,28,1,0.00,NULL),(73,'201504290858122',3,117,1,0.00,'2015-05-17 09:25:17'),(74,'201504290858122',3,104,2,0.00,'2015-05-17 09:25:17'),(75,'201504290858122',2,28,3,0.00,'2015-05-17 09:25:17'),(76,'201504290904566',3,108,1,0.00,'2015-05-21 06:28:05'),(77,'201504290916071',0,153,1,0.00,NULL),(78,'201504290916071',0,117,2,0.00,NULL),(79,'201504290916071',0,104,3,0.00,NULL),(80,'201504290924555',1,153,1,0.00,NULL),(81,'201504290924555',1,117,2,0.00,NULL),(82,'201504290924555',1,104,3,0.00,NULL),(83,'201504290959252',0,28,1,0.00,NULL),(84,'201504291004301',2,28,1,0.00,'2015-05-21 06:28:05'),(85,'201504291255296',1,59,1,0.00,NULL),(86,'201504291255325',0,117,1,0.00,NULL),(87,'201504291255325',0,104,2,0.00,NULL),(88,'201504291255325',0,28,3,0.00,NULL),(89,'201504291259332',1,117,1,0.00,NULL),(90,'201504291259332',1,104,2,0.00,NULL),(91,'201504291259332',1,28,3,0.00,NULL),(92,'201504291303116',1,93,1,0.00,NULL),(93,'201504291308223',2,51,1,0.00,'2015-05-21 06:28:05'),(94,'201504291308223',2,28,2,0.00,'2015-05-21 06:28:05'),(95,'201504291309573',0,59,1,0.00,NULL),(96,'201504291313295',1,59,1,0.00,NULL),(97,'201504291313542',0,117,1,0.00,NULL),(98,'201504291313542',0,104,2,0.00,NULL),(99,'201504291313542',0,28,3,0.00,NULL),(100,'201504291317133',1,59,1,0.00,NULL),(101,'201504291318446',1,59,1,0.00,NULL),(102,'201504291322154',0,117,1,0.00,NULL),(103,'201504291322154',0,104,2,0.00,NULL),(104,'201504291322154',0,28,3,0.00,NULL),(105,'201504291324471',0,59,1,0.00,NULL),(106,'201504291335089',0,59,1,0.00,NULL),(107,'201504291349474',1,50,1,0.00,NULL),(108,'201504291351158',0,106,1,0.00,NULL),(109,'201504291351158',0,28,2,0.00,NULL),(110,'201504291352109',1,106,1,0.00,NULL),(111,'201504291352109',1,28,2,0.00,NULL),(112,'201504291353177',0,235,1,0.00,NULL),(113,'201504291353177',0,59,2,0.00,NULL),(114,'201504291357481',1,59,1,0.00,NULL),(115,'201504291401008',1,59,1,0.00,NULL),(116,'201504291403396',0,112,1,0.00,NULL),(117,'201504291403396',0,93,2,0.00,NULL),(118,'201504291414098',0,112,1,0.00,NULL),(119,'201504291414098',0,93,2,0.00,NULL),(120,'201504291414433',2,51,1,0.00,'2015-05-21 06:28:05'),(121,'201504291414433',2,28,2,0.00,'2015-05-21 06:28:05'),(122,'201504291421034',0,112,1,0.00,NULL),(123,'201504291421034',0,93,2,0.00,NULL),(124,'201504291422449',0,56,1,0.00,NULL),(125,'201504291431473',0,104,1,0.00,NULL),(126,'201504291431473',0,28,2,0.00,NULL),(127,'201504291434378',3,104,1,0.00,'2015-05-16 00:48:41'),(128,'201504291434378',2,28,2,0.00,'2015-05-16 00:48:41'),(129,'201504291438437',1,160,1,0.00,NULL),(130,'201504291438437',1,106,2,0.00,NULL),(131,'201504291438437',1,28,3,0.00,NULL),(132,'201504291443329',1,117,1,0.00,NULL),(133,'201504291443329',1,104,2,0.00,NULL),(134,'201504291443329',1,28,3,0.00,NULL),(135,'201504291452107',2,259,1,0.00,'2015-05-21 07:03:36'),(136,'201504291452107',2,51,2,0.00,'2015-05-21 07:03:36'),(137,'201504291452107',2,28,3,0.00,'2015-05-21 07:03:36'),(138,'201504291500522',0,160,1,0.00,NULL),(139,'201504291500522',0,106,2,0.00,NULL),(140,'201504291500522',0,28,3,0.00,NULL),(141,'201504291512285',3,117,1,0.00,'2015-05-21 07:56:02'),(142,'201504291512285',3,104,2,0.00,'2015-05-21 07:56:02'),(143,'201504291512285',2,28,3,0.00,'2015-05-21 07:56:02'),(144,'201504291514014',3,83,1,0.00,'2015-05-21 07:56:02'),(145,'201504291516058',1,117,1,0.00,NULL),(146,'201504291516058',1,104,2,0.00,NULL),(147,'201504291516058',1,28,3,0.00,NULL),(148,'201504291520094',1,259,1,0.00,NULL),(149,'201504291520094',1,51,2,0.00,NULL),(150,'201504291520094',1,28,3,0.00,NULL),(151,'201504291533378',0,160,1,0.00,NULL),(152,'201504291533378',0,106,2,0.00,NULL),(153,'201504291533378',0,28,3,0.00,NULL),(154,'201504291534005',0,160,1,0.00,NULL),(155,'201504291534005',0,106,2,0.00,NULL),(156,'201504291534005',0,28,3,0.00,NULL),(157,'201504291535004',1,160,1,0.00,NULL),(158,'201504291535004',1,106,2,0.00,NULL),(159,'201504291535004',1,28,3,0.00,NULL),(160,'201504291536314',0,59,1,0.00,NULL),(161,'201504291538419',1,117,1,0.00,NULL),(162,'201504291538419',1,104,2,0.00,NULL),(163,'201504291538419',1,28,3,0.00,NULL),(164,'201504291557565',0,93,1,0.00,NULL),(165,'201504291558377',1,59,1,0.00,NULL),(166,'201504291601189',0,73,1,0.00,NULL),(167,'201504291605534',0,59,1,0.00,NULL),(168,'201504291613198',1,59,1,0.00,NULL),(169,'201504291618161',4,160,1,0.00,NULL),(170,'201504291618161',4,106,2,0.00,NULL),(171,'201504291618161',4,28,3,0.00,NULL),(172,'201504291622085',1,107,1,0.00,NULL),(173,'201504291634164',0,160,1,0.00,NULL),(174,'201504291634164',0,106,2,0.00,NULL),(175,'201504291634164',0,28,3,0.00,NULL),(176,'201504291644235',0,93,1,0.00,NULL),(177,'201504291707367',1,93,1,0.00,NULL),(178,'201504291709131',1,93,1,0.00,NULL),(179,'201504291715259',1,73,1,0.00,NULL),(180,'201504291725216',1,164,1,0.00,NULL),(181,'201504291725216',1,51,2,0.00,NULL),(182,'201504291725216',1,28,3,0.00,NULL),(183,'201504291729535',1,73,1,0.00,NULL),(184,'201504291744522',1,159,1,0.00,NULL),(185,'201504291744522',1,39,2,0.00,NULL),(186,'201504291827338',1,280,1,0.00,NULL),(187,'201504291827338',1,259,2,0.00,NULL),(188,'201504291827338',1,51,3,0.00,NULL),(189,'201504291830599',1,117,1,0.00,NULL),(190,'201504291830599',1,104,2,0.00,NULL),(191,'201504291830599',1,28,3,0.00,NULL),(192,'201504291833519',1,259,1,0.00,NULL),(193,'201504291833519',1,51,2,0.00,NULL),(194,'201504291833519',1,28,3,0.00,NULL),(195,'201504291837311',1,280,1,0.00,NULL),(196,'201504291837311',1,259,2,0.00,NULL),(197,'201504291837311',1,51,3,0.00,NULL),(198,'201504291837565',1,159,1,0.00,NULL),(199,'201504291837565',1,39,2,0.00,NULL),(200,'201504291959345',0,59,1,0.00,NULL),(201,'201504292019476',1,117,1,0.00,NULL),(202,'201504292019476',1,104,2,0.00,NULL),(203,'201504292019476',1,28,3,0.00,NULL),(204,'201504292021319',1,208,1,0.00,NULL),(205,'201504292021319',1,117,2,0.00,NULL),(206,'201504292021319',1,104,3,0.00,NULL),(207,'201504292027119',0,271,1,0.00,NULL),(208,'201504292027119',0,259,2,0.00,NULL),(209,'201504292027119',0,51,3,0.00,NULL),(210,'201504292058169',1,28,1,0.00,NULL),(211,'201504292103258',0,51,1,0.00,NULL),(212,'201504292103258',0,28,2,0.00,NULL),(213,'201504292119452',1,83,1,0.00,NULL),(214,'201504292139255',0,59,1,0.00,NULL),(215,'201504292203275',1,59,1,0.00,NULL),(216,'201504292243175',1,73,1,0.00,NULL),(217,'201504292246187',0,188,1,0.00,NULL),(218,'201504292246187',0,93,2,0.00,NULL),(219,'201504300006529',0,39,1,0.00,NULL),(220,'201504300008058',1,39,1,0.00,NULL),(221,'201504300026255',0,160,1,0.00,NULL),(222,'201504300026255',0,106,2,0.00,NULL),(223,'201504300026255',0,28,3,0.00,NULL),(224,'201504300027398',1,160,1,0.00,NULL),(225,'201504300027398',1,106,2,0.00,NULL),(226,'201504300027398',1,28,3,0.00,NULL),(227,'201504300035509',1,160,1,0.00,NULL),(228,'201504300035509',1,106,2,0.00,NULL),(229,'201504300035509',1,28,3,0.00,NULL),(230,'201504300121182',1,117,1,0.00,NULL),(231,'201504300121182',1,104,2,0.00,NULL),(232,'201504300121182',1,28,3,0.00,NULL),(233,'201504300310011',1,138,1,0.00,NULL),(234,'201504300941038',0,138,1,0.00,NULL),(235,'201504300944327',1,138,1,0.00,NULL),(236,'201504301014059',0,117,1,0.00,NULL),(237,'201504301014059',0,104,2,0.00,NULL),(238,'201504301014059',0,28,3,0.00,NULL),(239,'201504301215031',1,117,1,0.00,NULL),(240,'201504301215031',1,104,2,0.00,NULL),(241,'201504301215031',1,28,3,0.00,NULL),(242,'201504301218436',1,107,1,0.00,NULL),(243,'201504301239485',0,108,1,0.00,NULL),(244,'201504301845086',1,153,1,0.00,NULL),(245,'201504301845086',1,117,2,0.00,NULL),(246,'201504301845086',1,104,3,0.00,NULL),(247,'201504302056134',0,84,1,0.00,NULL),(248,'201504302117038',0,138,1,0.00,NULL),(249,'201504302118506',0,84,1,0.00,NULL),(250,'201504302119192',1,138,1,0.00,NULL),(251,'201504302119452',1,84,1,0.00,NULL),(252,'201504302122108',0,84,1,0.00,NULL),(253,'201504302137179',1,138,1,0.00,NULL),(254,'201504302222148',0,52,1,0.00,NULL),(255,'201504302222148',0,28,2,0.00,NULL),(256,'201504302231114',1,93,1,0.00,NULL),(257,'201504302306265',0,375,1,0.00,NULL),(258,'201504302306265',0,93,2,0.00,NULL),(259,'201504302331309',1,375,1,0.00,NULL),(260,'201504302331309',1,93,2,0.00,NULL),(261,'201505010911031',1,159,1,0.00,NULL),(262,'201505010911031',1,39,2,0.00,NULL),(263,'201505011024534',1,28,1,0.00,NULL),(264,'201505011253041',1,93,1,0.00,NULL),(265,'201505012314327',0,138,1,19.60,NULL),(266,'201505012345431',0,73,1,0.00,NULL),(267,'201505012346098',0,73,1,0.00,NULL),(268,'201505012347503',1,73,1,0.00,NULL),(269,'201505012348323',1,73,1,0.00,NULL),(270,'201505012355332',0,73,1,0.00,NULL),(271,'201505021304175',1,117,1,0.00,NULL),(272,'201505021304175',1,104,2,0.00,NULL),(273,'201505021304175',1,28,3,0.00,NULL),(274,'201505021321105',0,117,1,0.00,NULL),(275,'201505021321105',0,104,2,0.00,NULL),(276,'201505021321105',0,28,3,0.00,NULL),(277,'201505021333003',1,235,1,0.00,NULL),(278,'201505021333003',1,59,2,0.00,NULL),(279,'201505021520105',1,153,1,0.00,NULL),(280,'201505021520105',1,117,2,0.00,NULL),(281,'201505021520105',1,104,3,0.00,NULL),(282,'201505021735441',1,117,1,0.00,NULL),(283,'201505021735441',1,104,2,0.00,NULL),(284,'201505021735441',1,28,3,0.00,NULL),(285,'201505021917082',1,229,1,0.00,NULL),(286,'201505021917082',1,59,2,0.00,NULL),(287,'201505022007574',1,271,1,0.00,NULL),(288,'201505022007574',1,259,2,0.00,NULL),(289,'201505022007574',1,51,3,0.00,NULL),(290,'201505080757385',1,1,1,61.50,NULL),(291,'201505080931221',1,1,1,5.00,NULL),(292,'201505081928299',1,1,1,61.50,NULL),(293,'201505091239235',1,1,1,61.50,NULL),(294,'201505091241055',3,1,1,61.50,'2015-05-09 05:22:25'),(295,'201505091306378',3,1,1,50.00,'2015-05-09 05:22:25'),(296,'201505091316381',3,1,1,50.00,'2015-05-09 05:17:33'),(297,'201505091425094',0,1,1,0.00,NULL),(298,'201505091802031',0,1,1,61.50,NULL),(299,'201505091803478',1,1,1,0.00,NULL),(300,'201505100859231',1,1,1,0.00,NULL),(301,'201505100859586',1,1,1,0.50,NULL),(302,'201505100906164',3,1,1,30.50,'2015-05-10 01:13:33'),(303,'201505100907276',3,1,1,30.50,'2015-05-10 01:12:19'),(304,'201505101159332',1,1,1,0.00,NULL),(305,'201505101212422',1,1,1,0.00,NULL),(306,'201505101214454',0,1,1,0.00,NULL),(307,'201505101704508',1,66,1,0.00,NULL),(308,'201505101716167',0,67,1,0.00,NULL),(309,'201505101716167',0,66,2,0.00,NULL),(310,'201505101716374',0,67,1,0.00,NULL),(311,'201505101716374',0,66,2,0.00,NULL),(312,'201505102342226',1,1,1,0.00,NULL),(313,'201505131830281',0,1,1,0.00,NULL),(314,'201505131831038',0,1,1,0.50,NULL),(315,'201506162001261',2,82,1,0.00,'2015-07-07 04:00:38'),(316,'201506171323527',0,82,1,0.00,NULL),(317,'201506171327566',0,82,1,62.70,NULL),(318,'201506171333187',0,82,1,114.00,NULL),(319,'201506171347597',1,82,1,114.00,NULL),(320,'201506171353063',0,82,1,114.00,NULL),(321,'201506171431031',2,82,1,0.00,'2015-07-07 04:00:38'),(322,'201506171447377',0,82,1,114.00,NULL),(323,'201506171510014',1,82,1,114.00,NULL),(324,'201506171702116',2,82,1,0.00,'2015-07-07 04:00:38'),(325,'201506171921293',0,86,1,114.00,NULL),(326,'201506172348208',1,86,1,0.00,NULL),(327,'201507062258241',4,81,1,294.00,NULL),(328,'201507101639144',0,191,1,120.00,NULL),(329,'201507110923311',4,81,1,0.00,'2015-07-12 04:34:10'),(330,'201507111423184',4,81,1,0.00,'2015-08-08 04:03:35'),(331,'201507111912527',4,81,1,0.00,'2015-08-08 04:03:35'),(332,'201507111944304',4,81,1,30.00,NULL),(333,'201808061106188',1,50002,1,0.00,NULL),(334,'201808061112426',3,50002,1,0.25,'2018-08-07 09:35:29'),(335,'201808061117019',3,50002,1,0.00,'2018-08-07 09:35:29'),(336,'201808061723195',3,50002,1,0.00,'2018-08-07 09:35:29'),(337,'201808061827463',4,50002,1,0.25,'2018-08-06 10:36:48');
/*!40000 ALTER TABLE `wemall_order_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_role`
--

DROP TABLE IF EXISTS `wemall_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_role`
--

LOCK TABLES `wemall_role` WRITE;
/*!40000 ALTER TABLE `wemall_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_role_user`
--

DROP TABLE IF EXISTS `wemall_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `admin_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_role_user`
--

LOCK TABLES `wemall_role_user` WRITE;
/*!40000 ALTER TABLE `wemall_role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_tx_record`
--

DROP TABLE IF EXISTS `wemall_tx_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_tx_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `price` float(6,2) NOT NULL,
  `bank_name` text NOT NULL,
  `bank_num` text NOT NULL,
  `name` text NOT NULL,
  `tel` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_tx_record`
--

LOCK TABLES `wemall_tx_record` WRITE;
/*!40000 ALTER TABLE `wemall_tx_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_tx_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_user`
--

DROP TABLE IF EXISTS `wemall_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `member` tinyint(3) unsigned NOT NULL COMMENT 'ǷǻԱ',
  `ticket` varchar(255) NOT NULL,
  `username` text NOT NULL,
  `phone` text NOT NULL,
  `weixin` text NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `wx_info` text NOT NULL,
  `price` float(6,2) NOT NULL,
  `jifen` int(11) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url` text NOT NULL,
  `l_id` int(11) unsigned NOT NULL COMMENT 'ϼID',
  `l_b` int(11) unsigned NOT NULL COMMENT 'ϼ',
  `l_c` int(11) unsigned NOT NULL COMMENT 'ϼ',
  `c_cnt` int(11) unsigned NOT NULL COMMENT '3',
  `b_cnt` int(11) unsigned NOT NULL COMMENT '2',
  `a_cnt` int(11) unsigned NOT NULL COMMENT '1',
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`),
  KEY `ticket` (`ticket`),
  KEY `l_id` (`l_id`),
  KEY `l_b` (`l_b`),
  KEY `l_c` (`l_c`)
) ENGINE=MyISAM AUTO_INCREMENT=50005 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_user`
--

LOCK TABLES `wemall_user` WRITE;
/*!40000 ALTER TABLE `wemall_user` DISABLE KEYS */;
INSERT INTO `wemall_user` VALUES (49999,'o80GWuHk0MjSMRDoy1a_bl2E9Kvk',0,'','','','','e10adc3949ba59abbe56e057f20f883e','','{\"subscribe\":1,\"openid\":\"o80GWuHk0MjSMRDoy1a_bl2E9Kvk\",\"nickname\":\"\\u5510\\u8a89\\u6cfd\\ue332\\u4e2d\\u56fd\\u5fae\\u521b\\u4e1a\\u8054\\u5408\\u4f53\\u53d1\\u8d77\\u4eba\",\"sex\":1,\"language\":\"zh_CN\",\"city\":\"\\u957f\\u6c99\",\"province\":\"\\u6e56\\u5357\",\"country\":\"\\u4e2d\\u56fd\",\"headimgurl\":\"http:\\/\\/wx.qlogo.cn\\/mmopen\\/PiajxSqBRaEKYCWtUnWTsIBheeia6CmYfShRr4A1ic8P4rQOBdO1fU4h9U5thmICMcfjLHsSCuiacaNgrkcR1r5E1g\\/0\",\"subscribe_time\":1436668824,\"remark\":\"\",\"groupid\":0}',0.00,0,'2015-08-18 06:32:01','',0,0,0,0,0,0,'',''),(50001,'50001',0,'','乞丐','198410','','e10adc3949ba59abbe56e057f20f883e','北京市,北京市,东城区,乞丐省乞丐市乞丐村','{\"nickname\":\"yanshi\",\"subscribe_time\":1439537261}',0.00,0,'2015-08-18 06:35:10','',0,0,0,0,0,0,'yanshi','yanshi@gmail.com'),(50002,'50002',1,'','吴海艳','18510036026','','e271b7c6ed709feca8776fd4f9b91e86','北京市,北京市,东城区,aaadds','{\"nickname\":\"haiyan\",\"subscribe_time\":1533436571,\"headimgurl\":\".\\/Public\\/Uploads\\/5b69668f6ffab.jpeg\"}',0.50,0,'2018-08-07 09:53:07','',0,0,0,0,0,0,'haiyan','w8hy@qq.com'),(50003,'50003',0,'','吴haiyan1','17080156028','','0ca3418491b0a3adcaa767b5c14080f0','北京市,北京市,东城区,cchj ','{\"nickname\":\"haiyan1\",\"subscribe_time\":1533517623}',0.00,1,'2018-08-07 09:53:07','',0,0,0,0,0,0,'haiyan1','w8hy1@qq.com'),(50004,'50004',1,'','13020040188','13020040188','','4d216cd16f004924a30e8529684a612a','天津市,天津市,河北区,hdjdjd','{\"nickname\":\"xulei8\",\"subscribe_time\":1533525730}',0.00,0,'2018-08-06 04:17:24','',0,0,0,0,0,0,'xulei8','xulei8@qq.com');
/*!40000 ALTER TABLE `wemall_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_wxconfig`
--

DROP TABLE IF EXISTS `wemall_wxconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_wxconfig` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `num` text NOT NULL,
  `ini_num` text NOT NULL,
  `token` text NOT NULL,
  `appid` text NOT NULL,
  `appsecret` text NOT NULL,
  `encodingaeskey` text NOT NULL,
  `partnerid` text NOT NULL,
  `partnerkey` text NOT NULL,
  `paysignkey` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_wxconfig`
--

LOCK TABLES `wemall_wxconfig` WRITE;
/*!40000 ALTER TABLE `wemall_wxconfig` DISABLE KEYS */;
INSERT INTO `wemall_wxconfig` VALUES (1,'北京川京科技公司','gh_35667e4759e1','CJWX001','wx7ac06fc198853a9f','2dc39a4066ff46bd1163a813eb296940','LXnplIW5Owa0uUJLHJTslFKVHwOT0RcA4nMHpWPBsU2','1490743072','426611f92c5dc76e5bd067d2a3579455','');
/*!40000 ALTER TABLE `wemall_wxconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_wxmenu`
--

DROP TABLE IF EXISTS `wemall_wxmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_wxmenu` (
  `menu_id` int(5) NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(10) DEFAULT NULL,
  `menu_name` varchar(10) NOT NULL,
  `event_key` varchar(200) NOT NULL,
  `view_url` varchar(300) NOT NULL,
  `pid` int(5) NOT NULL DEFAULT '0',
  `listorder` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_wxmenu`
--

LOCK TABLES `wemall_wxmenu` WRITE;
/*!40000 ALTER TABLE `wemall_wxmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `wemall_wxmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wemall_wxmessage`
--

DROP TABLE IF EXISTS `wemall_wxmessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wemall_wxmessage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `picurl` text NOT NULL,
  `url` text NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wemall_wxmessage`
--

LOCK TABLES `wemall_wxmessage` WRITE;
/*!40000 ALTER TABLE `wemall_wxmessage` DISABLE KEYS */;
INSERT INTO `wemall_wxmessage` VALUES (8,'1','回复','直销360：\r\n1、<a href=\"http://kd.mmmm6.com\">快递查询</a>\r\n\r\n2、<a href=\"http://mp.weixin.qq.com/s?__biz=MzA5Njg1NTAyNw==&amp;mid=852793799&amp;idx=1&amp;sn=029976cc3e5a1210b266e69221ef0813#rd\">关于佣金、提现、售后、物流详细说明</a>\r\n\r\n3、<a href=\"http://mp.weixin.qq.com/s?__biz=MzA5Njg1NTAyNw==&amp;mid=852793799&amp;idx=1&amp;sn=db1b48268ad387ac43063a810a9760e7#rd\">看看如何挣钱</a>\r\n\r\n4、<a href=\"https://qianbao.baidu.com/hd/huafei?invite_code=CHDXE9AF\" se_prerender_url=\"complete\">鸿美琪家族和百度赞助1分钱充5元话费</a>','553ed230caa26.jpg','','GET_INFO'),(12,'1','联系我们','联系我们：\r\n\r\n1、微信：zhixiao360\r\n\r\n2、Q  Q：852793799\r\n\r\n3、电话：<a href=\"tel:400-0899-512\">400-0899-512</a>','','','TEL_CALL'),(13,'1','拍拍商城','<center>\r\n<a href=\"http://shop.paipai.com/330440523\">拍拍商城</a></center>\r\n','','','P_PAIPAI');
/*!40000 ALTER TABLE `wemall_wxmessage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-07 17:57:13
