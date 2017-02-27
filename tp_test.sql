/*
SQLyog Professional v12.08 (64 bit)
MySQL - 5.5.38 : Database - tp_test
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tp_test` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tp_test`;

/*Table structure for table `tp_access` */

DROP TABLE IF EXISTS `tp_access`;

CREATE TABLE `tp_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tp_access` */

insert  into `tp_access`(`role_id`,`node_id`,`level`,`module`) values (1,1,3,NULL),(1,5,3,NULL),(1,6,3,NULL),(1,7,3,NULL),(1,8,3,NULL),(1,9,3,NULL),(1,2,3,NULL),(1,4,3,NULL),(2,1,3,NULL),(2,5,3,NULL),(2,6,3,NULL),(2,7,3,NULL),(2,8,3,NULL),(2,9,3,NULL),(2,2,3,NULL),(2,4,3,NULL);

/*Table structure for table `tp_admin` */

DROP TABLE IF EXISTS `tp_admin`;

CREATE TABLE `tp_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `actiontime` int(22) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `sessionid` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tp_admin` */

insert  into `tp_admin`(`id`,`username`,`password`,`actiontime`,`status`,`sessionid`) values (1,'admin','c8bc620edf43f012eb8627511e01472d',1474438948,1,'h7ntrbg0q4vqo309dsvfte9ga3'),(2,'test','c70c9859167b76bda1382626a403d547',1470363280,1,'pkss7bdmcvlp25l22gputr9j12');

/*Table structure for table `tp_custom` */

DROP TABLE IF EXISTS `tp_custom`;

CREATE TABLE `tp_custom` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(44) NOT NULL,
  `content` text NOT NULL,
  `createtime` varchar(44) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tp_custom` */

/*Table structure for table `tp_customorder` */

DROP TABLE IF EXISTS `tp_customorder`;

CREATE TABLE `tp_customorder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(33) NOT NULL,
  `extid` int(11) NOT NULL,
  `stid` int(11) NOT NULL,
  `sttitle` varchar(55) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `content` text NOT NULL,
  `phoneMess` tinytext NOT NULL,
  `createtime` varchar(33) NOT NULL,
  `amount` float NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `orderstatus` int(2) NOT NULL,
  `eid` int(11) NOT NULL,
  `acttime` varchar(33) DEFAULT NULL,
  `note` text,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tp_customorder` */

insert  into `tp_customorder`(`id`,`orderid`,`extid`,`stid`,`sttitle`,`phone`,`content`,`phoneMess`,`createtime`,`amount`,`status`,`orderstatus`,`eid`,`acttime`,`note`) values (9,'109946001473302981',1,3,'222','15071602515','150716025151507160251515071602515150716025151507160251515071602515150716025151507160251515071602515150716025151507160251515071602515150716025151507160','湖北移动','1473302981',260,1,1,0,NULL,'a:2:{s:3:\"one\";i:99;s:3:\"two\";i:20;}'),(7,'183208001473234666',1,3,'222','15071602515','kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk','湖北移动','1473234666',260,0,1,0,NULL,'a:2:{s:3:\"one\";i:99;s:3:\"two\";i:20;}'),(8,'572660001473234691',1,3,'222','15071602515','kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk','湖北移动','1473234691',260,0,1,0,NULL,'a:2:{s:3:\"one\";i:99;s:3:\"two\";i:20;}');

/*Table structure for table `tp_employee` */

DROP TABLE IF EXISTS `tp_employee`;

CREATE TABLE `tp_employee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `createtime` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp_employee` */

insert  into `tp_employee`(`id`,`username`,`password`,`status`,`createtime`) values (2,'一号','e10adc3949ba59abbe56e057f20f883e',1,'1470879713'),(3,'二号','e10adc3949ba59abbe56e057f20f883e',1,'1470879721');

/*Table structure for table `tp_extension` */

DROP TABLE IF EXISTS `tp_extension`;

CREATE TABLE `tp_extension` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(33) NOT NULL,
  `phone` varchar(33) NOT NULL,
  `password` varchar(33) NOT NULL,
  `alipay` varchar(33) NOT NULL,
  `extenimg` text NOT NULL,
  `picimg` text NOT NULL,
  `createtime` varchar(33) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `allmoney` float NOT NULL DEFAULT '0',
  `getmoney` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tp_extension` */

insert  into `tp_extension`(`id`,`pid`,`username`,`phone`,`password`,`alipay`,`extenimg`,`picimg`,`createtime`,`status`,`allmoney`,`getmoney`) values (1,0,'柯南 ','15071602515','e10adc3949ba59abbe56e057f20f883e','15071602519','/uploads/ercode/1-cl-0.76588400 1468550194.png','','1468550077',1,119,0),(2,1,'12311','15071602510','42dae262b8531b3df48cde9cc018c512','15071602517','/uploads/ercode/2-cl-0.18121300 1468891787.png','','1468891712',1,99,0);

/*Table structure for table `tp_getmoney` */

DROP TABLE IF EXISTS `tp_getmoney`;

CREATE TABLE `tp_getmoney` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `extenid` int(11) NOT NULL,
  `alipay` varchar(32) NOT NULL,
  `getmoney` float NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tp_getmoney` */

insert  into `tp_getmoney`(`id`,`extenid`,`alipay`,`getmoney`,`createtime`,`status`) values (1,2,'15071602510',48,1468913242,1),(2,2,'15071602510',300,1468913274,2);

/*Table structure for table `tp_goods` */

DROP TABLE IF EXISTS `tp_goods`;

CREATE TABLE `tp_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(11) NOT NULL,
  `goodtitle` varchar(50) NOT NULL,
  `createtime` int(30) NOT NULL,
  `picimg` text NOT NULL,
  `price` float NOT NULL,
  `isnew` int(2) NOT NULL,
  `ishot` int(2) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp_goods` */

insert  into `tp_goods`(`id`,`cateid`,`goodtitle`,`createtime`,`picimg`,`price`,`isnew`,`ishot`,`content`,`status`) values (1,4,'1',1473131224,'/uploads/2016-09-06/57ce32d87e26d.jpg',1,1,1,'/uploads/2016-09-06/57ce32d8ae7e9.mp3',1),(2,4,'123',1463029167,'/mypro/uploads/2016-05-12/57340dafe5eda.jpg',1,1,0,'/mypro/uploads/2016-05-12/57340d1e8f2e8.mp3',1),(3,1,'222',1473234615,'/tp_yj/uploads/2016-04-19/57161be3e290c.gif',1,1,0,'/tp_yj/uploads/2016-04-19/57161be3e34c4.mp4',1);

/*Table structure for table `tp_goods_cate` */

DROP TABLE IF EXISTS `tp_goods_cate`;

CREATE TABLE `tp_goods_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lever` int(5) NOT NULL DEFAULT '0',
  `catename` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `pid` int(3) NOT NULL DEFAULT '0',
  `click` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tp_goods_cate` */

insert  into `tp_goods_cate`(`id`,`lever`,`catename`,`status`,`pid`,`click`) values (1,1,'A',1,0,0),(2,1,'B',1,0,0),(3,1,'C',1,0,1),(4,2,'A-121',1,1,200),(5,2,'A-2',1,1,78);

/*Table structure for table `tp_node` */

DROP TABLE IF EXISTS `tp_node`;

CREATE TABLE `tp_node` (
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `tp_node` */

insert  into `tp_node`(`id`,`name`,`title`,`status`,`remark`,`sort`,`pid`,`level`) values (1,'Admin','后台模块',1,NULL,NULL,0,1),(2,'Home','前台模块',1,NULL,NULL,0,1),(4,'User','用户模块',1,NULL,NULL,0,1),(5,'Admin','管理系统控制',1,NULL,NULL,1,2),(6,'add','添加管理员',1,NULL,NULL,5,3),(7,'edit','修改管理员',1,NULL,NULL,5,3),(8,'Goods','商品系统操作',1,NULL,NULL,1,2),(9,'addCate','添加栏目',1,NULL,NULL,8,3),(10,'Order','d',1,NULL,NULL,1,2),(12,'payment','s',1,NULL,NULL,10,3),(13,'nopayment','2',1,NULL,NULL,10,3),(14,'changeOrder','3',1,NULL,NULL,10,3),(15,'orderFh','4',1,NULL,NULL,10,3),(16,'orderDel','5',1,NULL,NULL,10,3),(17,'export','6',1,NULL,NULL,10,3);

/*Table structure for table `tp_order` */

DROP TABLE IF EXISTS `tp_order`;

CREATE TABLE `tp_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL,
  `orderid` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `orderstatus` int(5) NOT NULL,
  `createtime` int(20) NOT NULL,
  `goodstitle` varchar(66) NOT NULL COMMENT '标题',
  `status` int(2) NOT NULL DEFAULT '1',
  `extenid` int(11) NOT NULL DEFAULT '0',
  `acttime` int(20) DEFAULT NULL COMMENT '处理时间',
  `istk` int(2) DEFAULT '0' COMMENT '0 未退款 1 已退款',
  `phoneMess` varchar(50) DEFAULT NULL COMMENT '电话归属地信息',
  `eid` int(11) NOT NULL COMMENT '指定员工',
  `emp_note` text COMMENT 'yuangong备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Data for the table `tp_order` */

insert  into `tp_order`(`id`,`goodsid`,`orderid`,`phone`,`amount`,`orderstatus`,`createtime`,`goodstitle`,`status`,`extenid`,`acttime`,`istk`,`phoneMess`,`eid`,`emp_note`) values (7,3,'358667001470303461','15071602515',290,1,1470303462,'222',0,0,NULL,0,'湖北移动',0,NULL),(6,2,'235059001470303433','15071602515',290,1,1470303434,'123',0,0,NULL,0,'湖北移动',0,NULL),(8,3,'528649001470303478','15071602515',290,4,1470303479,'222',1,0,1470994015,0,'湖北移动',2,'88'),(9,1,'989508001470303545','15071602515',290,5,1470303547,'1',1,0,1470994413,0,'湖北移动',2,'888'),(10,2,'050835001470363318','15071602511',290,3,1470363319,'123',1,1,1470994276,0,'湖北移动',2,'8l8888'),(11,3,'533645001470388438','15071602515',0.01,3,1470388439,'222',1,1,1470994038,0,'湖北移动',2,'888ikiu'),(12,3,'320804001470388441','15071602515',0.01,1,1470388442,'222',0,1,NULL,0,'湖北移动',2,''),(13,3,'196112001470388464','15071602515',0.01,1,1470388465,'222',0,1,NULL,0,'湖北移动',2,NULL),(14,3,'163941001470388496','15071602515',0.01,1,1470388497,'222',0,1,NULL,0,'湖北移动',2,NULL),(15,3,'045165001470388535','15071602515',0.01,1,1470388536,'222',0,1,NULL,0,'湖北移动',0,NULL),(16,3,'854298001470388554','15071602515',0.01,1,1470388555,'222',0,1,NULL,0,'湖北移动',0,NULL),(17,3,'908790001470388615','15071602515',0.01,1,1470388616,'222',0,1,NULL,0,'湖北移动',0,NULL),(18,3,'128151001470388727','15071602515',0.01,1,1470388728,'222',0,1,NULL,0,'湖北移动',0,NULL),(19,3,'851137001470388761','15071602515',0.01,1,1470388762,'222',0,1,NULL,0,'湖北移动',0,NULL),(20,3,'415570001470388769','15071602515',0.01,1,1470388770,'222',0,1,NULL,0,'湖北移动',0,NULL),(21,3,'050350001470388783','15071602515',0.01,1,1470388784,'222',0,1,NULL,0,'湖北移动',0,NULL),(22,3,'396314001470388817','15071602515',0.01,1,1470388818,'222',0,1,NULL,0,'湖北移动',0,NULL),(23,3,'740135001470388831','15071602515',0.01,1,1470388832,'222',0,1,NULL,0,'湖北移动',0,NULL),(24,3,'159020001470388917','15071602515',0.01,1,1470388918,'222',0,1,NULL,0,'湖北移动',0,NULL),(25,3,'728277001470389358','15071602515',0.01,1,1470389359,'222',0,1,NULL,0,'湖北移动',0,NULL),(26,3,'260662001470391166','15071602515',0.01,1,1470391167,'222',0,1,NULL,0,'湖北移动',0,NULL),(27,3,'355669001470391201','15071602515',0.01,1,1470391202,'222',0,1,NULL,0,'湖北移动',0,NULL),(28,3,'931845001470391728','15071602515',0.01,1,1470391729,'222',0,1,NULL,0,'湖北移动',0,NULL),(29,3,'079973001470653305','15071602515',290,1,1470653306,'222',0,1,NULL,0,'湖北移动',0,NULL),(30,3,'669178001470653308','15071602515',290,1,1470653309,'222',0,1,NULL,0,'湖北移动',0,NULL),(31,3,'493513001470653349','15071602515',290,1,1470653350,'222',0,1,NULL,0,'湖北移动',0,NULL),(32,3,'090577001470653368','15071602515',290,1,1470653369,'222',0,1,NULL,0,'湖北移动',0,NULL),(33,3,'417388001470710935','15071602515',290,1,1470710936,'222',0,1,NULL,0,'湖北移动',0,NULL),(34,3,'334162001470710972','15071602515',290,1,1470710973,'222',0,1,NULL,0,'湖北移动',0,NULL),(35,3,'956951001470710991','15071602515',290,1,1470710992,'222',0,1,NULL,0,'湖北移动',0,NULL),(36,3,'204697001470711008','15071602515',290,1,1470711009,'222',0,1,NULL,0,'湖北移动',0,NULL),(37,3,'955445001470711023','15071602515',290,1,1470711024,'222',0,1,NULL,0,'湖北移动',0,NULL),(38,3,'953403001470711033','15071602515',290,1,1470711034,'222',0,1,NULL,0,'湖北移动',0,NULL),(39,3,'683348001470711041','15071602515',290,1,1470711042,'222',0,1,NULL,0,'湖北移动',0,NULL),(40,3,'748668001470711064','15071602515',290,1,1470711065,'222',0,1,NULL,0,'湖北移动',0,NULL),(41,3,'859276001470711075','15071602515',290,1,1470711076,'222',0,1,NULL,0,'湖北移动',0,NULL),(42,3,'730125001470711099','15071602515',290,1,1470711100,'222',0,1,NULL,0,'湖北移动',0,NULL),(43,3,'014932001470711110','15071602515',290,1,1470711111,'222',0,1,NULL,0,'湖北移动',0,NULL),(44,3,'430810001470711124','15071602515',290,1,1470711125,'222',0,1,NULL,0,'湖北移动',0,NULL),(45,3,'825934001470711131','15071602515',290,1,1470711132,'222',0,1,NULL,0,'湖北移动',0,NULL),(46,3,'856454001470711136','15071602515',290,1,1470711137,'222',0,1,NULL,0,'湖北移动',0,NULL),(47,3,'466591001470711482','15071602515',290,1,1470711483,'222',0,1,NULL,0,'湖北移动s',2,'123'),(48,0,'748351001472800187','15071602515',289,0,1472800188,'',1,0,NULL,0,'湖北移动',1,NULL),(49,0,'549542001472800243','15071602515',289,0,1472800244,'',1,0,NULL,0,NULL,1,NULL),(50,1,'114467001473131255','15071602515',198,1,1473131256,'1',0,1,NULL,0,'湖北移动',0,NULL);

/*Table structure for table `tp_order_change` */

DROP TABLE IF EXISTS `tp_order_change`;

CREATE TABLE `tp_order_change` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL,
  `orderid` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `orderstatus` int(2) NOT NULL DEFAULT '2',
  `createtime` varchar(20) NOT NULL,
  `goodstitle` varchar(66) NOT NULL COMMENT '商品id',
  `status` int(2) NOT NULL DEFAULT '1',
  `extenid` int(11) NOT NULL DEFAULT '0',
  `acttime` varchar(44) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tp_order_change` */

/*Table structure for table `tp_role` */

DROP TABLE IF EXISTS `tp_role`;

CREATE TABLE `tp_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tp_role` */

insert  into `tp_role`(`id`,`name`,`pid`,`status`,`remark`) values (1,'superadmin',NULL,1,'超级管理员'),(2,'admin',NULL,1,'管理员');

/*Table structure for table `tp_role_user` */

DROP TABLE IF EXISTS `tp_role_user`;

CREATE TABLE `tp_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tp_role_user` */

insert  into `tp_role_user`(`role_id`,`user_id`) values (1,'1'),(2,'2');

/*Table structure for table `tp_set_price` */

DROP TABLE IF EXISTS `tp_set_price`;

CREATE TABLE `tp_set_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `priceqj` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `status` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp_set_price` */

insert  into `tp_set_price`(`id`,`priceqj`,`price`,`status`) values (1,'一年',98,1),(2,'三年',198,1),(3,'五年',290,1);

/*Table structure for table `tp_st` */

DROP TABLE IF EXISTS `tp_st`;

CREATE TABLE `tp_st` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tp_st` */

insert  into `tp_st`(`id`,`sid`,`status`) values (5,2,0),(4,1,1);

/*Table structure for table `tp_user` */

DROP TABLE IF EXISTS `tp_user`;

CREATE TABLE `tp_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `createtime` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tp_user` */

insert  into `tp_user`(`id`,`username`,`password`,`email`,`createtime`,`status`) values (1,'123','123','1521249986@qq.com','',1),(2,'123111','123111','1521249986@qq.com','',1),(3,'2222','222','22@qq.com','',1),(4,'13213231','12321','1521249986@qq.com','',1),(5,'11','123123','1521249986@qq.com','',1),(6,'11','4297f44b13955235245b2497399d7a93','1521249986@qq.com','',1),(7,'rrr','rrr','root@qq.com','',1),(8,'rrr','44f437ced647ec3f40fa0841041871cd','root@qq.com','',1),(9,'88','0a113ef6b61820daa5611c870ed8d5ee','8@qq.com','',1),(10,'dd','dd','8@qq.com','',1);

/*Table structure for table `tp_usermessage` */

DROP TABLE IF EXISTS `tp_usermessage`;

CREATE TABLE `tp_usermessage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `content` text NOT NULL,
  `phone` varchar(21) NOT NULL,
  `createtime` varchar(55) NOT NULL,
  `type` int(5) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '1',
  `emp_note` text COMMENT '员工备注',
  `eid` int(11) DEFAULT '0' COMMENT 'yuangong ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `tp_usermessage` */

insert  into `tp_usermessage`(`id`,`gid`,`username`,`content`,`phone`,`createtime`,`type`,`status`,`emp_note`,`eid`) values (12,0,'123','123','15012359865','1470133775',1,1,'xsaxsax',2),(11,0,'1','131','15015649865','1470133667',0,1,NULL,NULL),(13,0,'123456','','15071602515','1474185330',0,1,NULL,0);

/*Table structure for table `tp_wx_config` */

DROP TABLE IF EXISTS `tp_wx_config`;

CREATE TABLE `tp_wx_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` text,
  `appid` varchar(50) DEFAULT NULL,
  `appsecret` varchar(50) DEFAULT NULL,
  `machid` varchar(50) DEFAULT NULL,
  `machkey` varchar(50) DEFAULT NULL,
  `wechatnumber` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tp_wx_config` */

insert  into `tp_wx_config`(`id`,`token`,`appid`,`appsecret`,`machid`,`machkey`,`wechatnumber`) values (1,'TOKEN','APPID','APPSECRET','MchID','MchKey','公众号');

/*Table structure for table `tp_wx_menu` */

DROP TABLE IF EXISTS `tp_wx_menu`;

CREATE TABLE `tp_wx_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menuname` varchar(32) NOT NULL,
  `path` varchar(32) NOT NULL,
  `type` tinyint(11) NOT NULL,
  `keywords` varchar(32) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tp_wx_menu` */

insert  into `tp_wx_menu`(`id`,`menuname`,`path`,`type`,`keywords`,`status`) values (7,'111333','1',1,'123',1),(6,'111222','1',1,'11222',1),(1,'111','0',1,'1',1);

/*Table structure for table `tp_wxuser` */

DROP TABLE IF EXISTS `tp_wxuser`;

CREATE TABLE `tp_wxuser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `createtime` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tp_wxuser` */

insert  into `tp_wxuser`(`id`,`openid`,`createtime`,`status`) values (1,'','1459223984',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
