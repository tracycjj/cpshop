/*
SQLyog Professional v12.08 (64 bit)
MySQL - 5.5.38 : Database - cpshop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cpshop` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cpshop`;

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

insert  into `tp_admin`(`id`,`username`,`password`,`actiontime`,`status`,`sessionid`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3',1487812749,1,'hskj4sv835nlrmss67hcoj8732'),(2,'test','c70c9859167b76bda1382626a403d547',1470363280,1,'pkss7bdmcvlp25l22gputr9j12');

/*Table structure for table `tp_ads` */

DROP TABLE IF EXISTS `tp_ads`;

CREATE TABLE `tp_ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(33) NOT NULL,
  `tag` varchar(33) NOT NULL,
  `profile` text,
  `picimg` text NOT NULL,
  `link` text,
  `paixu` int(5) DEFAULT '0',
  `ctime` varchar(44) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp_ads` */

insert  into `tp_ads`(`id`,`cid`,`name`,`tag`,`profile`,`picimg`,`link`,`paixu`,`ctime`,`status`) values (1,1,'1231231','123','表格由 <table> 标签来定义。每个表格均有若干行(由 <tr> 标签定义),每行被分割为若干单元格(由 <td> 标签定义)。字母 td 指表格数据(table data),即数据...','/Uploads/Ads/2016-11-23/58353ca145d81.jpg','http://www.cpshop.com/index.php/Admin/AdsManager/adsList.html?cid=1',1,'1479883937',0),(2,1,'1231231','123','升    水    属    性','/Uploads/Ads/2016-11-25/5837f36a7fb9e.jpg','http://www.cpshop.com/index.php/Admin/AdsManager/adsList.html?cid=1',2,'1480061802',1),(3,1,'爱    撒潇   洒下是xXSAXSXSA...........','撒潇   洒潇   洒   ','潇洒    潇洒潇洒2我23个。。。。。。。。。。。。。。。','/Uploads/Ads/2016-11-23/583551338e298.jpg','。。。。。。。。。。。。',3,'1479890179',0);

/*Table structure for table `tp_ads_cate` */

DROP TABLE IF EXISTS `tp_ads_cate`;

CREATE TABLE `tp_ads_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varbinary(55) DEFAULT NULL,
  `tag` varchar(55) DEFAULT NULL,
  `ctime` varchar(32) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tp_ads_cate` */

insert  into `tp_ads_cate`(`id`,`name`,`tag`,`ctime`,`status`) values (1,'测试','ceshi','1479877709',1);

/*Table structure for table `tp_article` */

DROP TABLE IF EXISTS `tp_article`;

CREATE TABLE `tp_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` varchar(44) NOT NULL,
  `profile` text,
  `content` text,
  `picimg` text,
  `ctime` varchar(44) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `readcs` int(11) NOT NULL DEFAULT '0',
  `zancs` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tp_article` */

insert  into `tp_article`(`id`,`cid`,`title`,`profile`,`content`,`picimg`,`ctime`,`status`,`readcs`,`zancs`) values (1,2,'爱似水仙1231','&lt;p&gt;ded啥潇洒dedaxa潇洒潇洒潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;&lt;p&gt;潇洒&lt;/p&gt;&lt;p&gt;显示是是水水水水是闪闪说水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水水飒飒&lt;/p&gt;','&lt;p&gt;洗啊撒潇洒潇洒下线上线啊上限123456&lt;/p&gt;','/Uploads/Article/2016-11-24/58368daeed637.jpg','1479970222',1,0,0);

/*Table structure for table `tp_article_cate` */

DROP TABLE IF EXISTS `tp_article_cate`;

CREATE TABLE `tp_article_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(44) NOT NULL,
  `ctime` varchar(44) NOT NULL,
  `picimg` text NOT NULL,
  `level` int(3) NOT NULL DEFAULT '0',
  `path` varchar(55) NOT NULL DEFAULT '0',
  `profile` text,
  `tag` varchar(44) DEFAULT NULL,
  `type` int(3) NOT NULL DEFAULT '1' COMMENT '1单页 2默认',
  `show` int(4) NOT NULL DEFAULT '1' COMMENT '首页展示 1 展示  0不展示',
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tp_article_cate` */

insert  into `tp_article_cate`(`id`,`pid`,`name`,`ctime`,`picimg`,`level`,`path`,`profile`,`tag`,`type`,`show`,`status`) values (1,0,'潇洒下撒','1480652319','',1,'0','&lt;p&gt;潇洒潇洒下&lt;/p&gt;','xsa',1,0,1),(2,1,'xsxas ','1480652433','/Uploads/Article/2016-12-02/5840f691c3c94.png',2,'0-1','&lt;p&gt;潇洒下撒&lt;/p&gt;','xsax',2,0,1),(3,2,'xax','1480651423','/Uploads/Article/2016-12-02/5840f29f3e88c.jpg',3,'0-2-1','&lt;p&gt;xasxas&lt;/p&gt;','xas',1,1,1),(5,0,'啊啊啊啊水水水水','1480652475','',1,'0','&lt;p&gt;下水线&lt;/p&gt;','qwe',2,1,1);

/*Table structure for table `tp_goods_attr` */

DROP TABLE IF EXISTS `tp_goods_attr`;

CREATE TABLE `tp_goods_attr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL COMMENT 'goodsid',
  `attrpid` int(11) NOT NULL,
  `attrid` int(11) NOT NULL,
  `attrname` varchar(44) NOT NULL,
  `price` float DEFAULT NULL,
  `color` varchar(55) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `tp_goods_attr` */

insert  into `tp_goods_attr`(`id`,`gid`,`attrpid`,`attrid`,`attrname`,`price`,`color`,`status`) values (1,9,16,17,'10-15寸',0,'#5BC0DE',0),(2,9,11,15,'粉色',0,'pink',0),(3,9,21,24,'xs',0,'#5BC0DE',0),(4,9,16,18,'15-20寸',0,'#5BC0DE',0),(5,9,11,14,'绿色',0,'#5BC0DE',0),(6,4,16,17,'10-15寸',10,'#5BC0DE',1),(7,4,11,15,'粉色',0,'pink',0),(8,4,21,24,'xs',0,'#5BC0DE',0),(9,4,11,14,'绿色',0,'#5BC0DE',0),(10,4,21,25,'sss',0,'#5BC0DE',0),(11,4,11,20,'紫色',0,'purple',0),(12,9,16,17,'10-15寸',0,'#5BC0DE',0),(13,9,16,17,'10-15寸',2,'#5BC0DE',1),(14,9,11,15,'粉色',10,'pink',0);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp_role` */

insert  into `tp_role`(`id`,`name`,`pid`,`status`,`remark`) values (1,'superadmin',NULL,1,'超级管理员'),(2,'admin',NULL,1,'管理员'),(3,'s',NULL,1,'s');

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

/*Table structure for table `tp_shop_attr` */

DROP TABLE IF EXISTS `tp_shop_attr`;

CREATE TABLE `tp_shop_attr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(33) NOT NULL,
  `ctime` varchar(33) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `color` varchar(44) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_attr` */

insert  into `tp_shop_attr`(`id`,`pid`,`name`,`ctime`,`status`,`color`) values (16,0,'尺寸','1479865343',1,'#5BC0DE'),(15,11,'粉色','1479704952',1,'pink'),(13,11,'绿色','1479699837',0,'#85C88B'),(14,11,'绿色','1479700703',1,'#5BC0DE'),(12,0,'颜色1','1479699678',0,'#85C88B'),(11,0,'颜色','1479699527',1,'#5BC0Dd'),(17,16,'10-15寸','1479865359',1,'#5BC0DE'),(18,16,'15-20寸','1479865368',1,'#5BC0DE'),(19,16,'20-25寸','1479865375',1,'#5BC0DE'),(20,11,'紫色','1479871190',1,'purple'),(21,0,'1231','1480990514',1,'#5BC0DE'),(22,16,'25-30','1480990531',1,'#5BC0DE'),(23,16,'25-30','1480990532',1,'#5BC0DE'),(24,21,'xs','1481613699',1,'#5BC0DE'),(25,21,'sss','1481613703',1,'#5BC0DE');

/*Table structure for table `tp_shop_card` */

DROP TABLE IF EXISTS `tp_shop_card`;

CREATE TABLE `tp_shop_card` (
  `id` int(111) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(66) NOT NULL,
  `type` int(5) NOT NULL COMMENT '1=>代金券 2=>优惠券',
  `rule` float NOT NULL,
  `value` float NOT NULL,
  `showimg` text,
  `ctime` varchar(44) NOT NULL,
  `code` varchar(33) NOT NULL COMMENT '发放码',
  `status` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_card` */

insert  into `tp_shop_card`(`id`,`name`,`type`,`rule`,`value`,`showimg`,`ctime`,`code`,`status`) values (1,'123',1,200,0.85,'/Uploads/Card/2016-12-05/58452676138b1.jpg','1480926838','5FQnwEhlfO1g',1),(2,'123',1,123,1,NULL,'1480928763','1aZzp66mguHM',1);

/*Table structure for table `tp_shop_cart` */

DROP TABLE IF EXISTS `tp_shop_cart`;

CREATE TABLE `tp_shop_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `gid` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `picimg` text NOT NULL,
  `pricenow` float NOT NULL,
  `attrid` varchar(55) DEFAULT NULL,
  `attrprice` float DEFAULT NULL,
  `attrall` text,
  `number` int(11) NOT NULL,
  `amount` float NOT NULL,
  `ctime` varchar(55) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_cart` */

insert  into `tp_shop_cart`(`id`,`uid`,`gid`,`name`,`picimg`,`pricenow`,`attrid`,`attrprice`,`attrall`,`number`,`amount`,`ctime`,`status`) values (30,1,4,'123         潇   洒西安市    ，，，，，，西撒','/Uploads/ShopGoods/2016-12-01/583fd16398380.jpg',135,'6',10,'a:1:{i:0;a:5:{s:2:\"id\";s:1:\"6\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:2:\"10\";}}',1,145,'1482304382',1),(8,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(9,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(10,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(11,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(12,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(13,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(14,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(15,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(16,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(17,0,0,'','',0,NULL,NULL,NULL,0,0,'',1),(31,1,6,'213123','/Uploads/ShopGoods/2016-12-05/5844e1513947a.jpg',133,'0',0,'',8,1064,'1482740772',1);

/*Table structure for table `tp_shop_cate` */

DROP TABLE IF EXISTS `tp_shop_cate`;

CREATE TABLE `tp_shop_cate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `note` tinytext NOT NULL,
  `picimg` text NOT NULL,
  `ctime` varchar(45) NOT NULL,
  `level` int(3) NOT NULL DEFAULT '0',
  `path` varchar(15) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_cate` */

insert  into `tp_shop_cate`(`id`,`pid`,`name`,`note`,`picimg`,`ctime`,`level`,`path`,`status`) values (1,0,'男性','大分类','','1479453149',1,'0',1),(2,1,'护肤','子分类','/Uploads/ShopCate/2016-11-28/583b9d63f0e9b.jpg','1480301923',2,'0-1',1),(3,1,'护手霜1','产品分类1231321','/Uploads/ShopCate/2016-11-28/583b9d785b4b9.jpg','1480301944',2,'0-1',1),(5,1,'洗发','23','/Uploads/ShopCate/2016-11-28/583b9d8bb27ad.jpg','1480301963',2,'0-1',1);

/*Table structure for table `tp_shop_goods` */

DROP TABLE IF EXISTS `tp_shop_goods`;

CREATE TABLE `tp_shop_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(44) NOT NULL,
  `pricenow` float NOT NULL,
  `priceold` float DEFAULT NULL,
  `sales` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `stocks` int(11) NOT NULL DEFAULT '10000' COMMENT '库存',
  `picimg` text,
  `goodsimg` text,
  `profile` text COMMENT '简介说明',
  `content` text,
  `goodsattr` int(11) NOT NULL DEFAULT '0',
  `attrid` varchar(55) DEFAULT NULL COMMENT '属性大分类',
  `tagid` varchar(55) DEFAULT NULL COMMENT '标签id 默认 null,逗号隔开',
  `xiajia` int(11) NOT NULL DEFAULT '1' COMMENT '1=>上架 0=>下架',
  `fx` text COMMENT '分销设置',
  `ctime` varchar(44) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_goods` */

insert  into `tp_shop_goods`(`id`,`cid`,`name`,`pricenow`,`priceold`,`sales`,`stocks`,`picimg`,`goodsimg`,`profile`,`content`,`goodsattr`,`attrid`,`tagid`,`xiajia`,`fx`,`ctime`,`status`) values (4,5,'123         潇   洒西安市    ，，，，，，西撒',135,288,108,11111,'/Uploads/ShopGoods/2016-12-01/583fd16398380.jpg','/Uploads/ShopGoods/2016-11-21/5832c30b6ba0f.jpg,/Uploads/ShopGoods/2016-11-22/5833f7b91302d.jpg,/Uploads/ShopGoods/2016-11-22/5833f7b9143b5.jpg,','','&lt;p&gt;123发v潇洒潇 &amp;nbsp; &amp;nbsp;洒潇洒 &amp;nbsp; &amp;nbsp;下撒 潇洒潇洒 &amp;nbsp; 潇洒潇洒潇洒 &amp;nbsp;&amp;nbsp;&lt;/p&gt;',1,'16',NULL,1,'a:3:{s:1:\"o\";s:1:\"1\";s:1:\"t\";s:2:\"11\";s:1:\"s\";s:3:\"111\";}','1487037253',1),(5,3,'测试的热',1,11111,13456,10000,'/Upload/ShopGoods/2016-11-22/5833a90a65fee.jpg','/Upload/ShopGoods/2016-11-22/5833a90a68ae7.png,',NULL,'&lt;p&gt;123擦擦擦达到输出到处都是传递参数&lt;/p&gt;',1,NULL,NULL,1,NULL,'1479780618',0),(6,5,'213123',133,222,133,10000,'/Uploads/ShopGoods/2016-12-05/5844e1513947a.jpg',',/Uploads/ShopGoods/2016-12-12/584e16ae84c75.jpg,',NULL,'&lt;p&gt;1321&lt;/p&gt;',1,'','1,3',1,'a:3:{s:1:\"o\";s:2:\"11\";s:1:\"t\";s:1:\"2\";s:1:\"s\";s:1:\"3\";}','1481512622',1),(7,NULL,'',0,NULL,0,10000,NULL,NULL,NULL,NULL,0,NULL,NULL,1,NULL,NULL,0),(8,1,'2312',1,1,0,10000,NULL,NULL,NULL,'',0,NULL,NULL,1,NULL,'1480919173',0),(9,5,'asxasxxsx',1,111,115,1000,'/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg','/Uploads/ShopGoods/2016-12-12/584e6bbf4996c.png,','&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0026.gif&quot;/&gt;&lt;/p&gt;','&lt;p&gt;12312vfdvdffvvdvdfv&lt;/p&gt;',1,'16','1,2,3',1,'a:3:{s:1:\"o\";s:1:\"1\";s:1:\"t\";s:1:\"1\";s:1:\"s\";s:1:\"1\";}','1481534399',1);

/*Table structure for table `tp_shop_order` */

DROP TABLE IF EXISTS `tp_shop_order`;

CREATE TABLE `tp_shop_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(30) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `totalnum` int(11) NOT NULL COMMENT '商品总数',
  `totalprice` float NOT NULL COMMENT '商品总价格',
  `kdprice` float NOT NULL DEFAULT '0' COMMENT '快递价格',
  `cardid` int(11) NOT NULL DEFAULT '0' COMMENT '卡券id',
  `ispay` int(3) NOT NULL DEFAULT '0' COMMENT '是否支付',
  `payment` int(3) NOT NULL COMMENT '支付方式 1=>支付宝 2=>微信',
  `payprice` float NOT NULL COMMENT '支付金额',
  `address` text NOT NULL COMMENT '地址',
  `phone` varchar(33) NOT NULL COMMENT '电话',
  `username` varchar(33) NOT NULL COMMENT '姓名',
  `note` tinytext COMMENT '留言',
  `giftnote` tinytext COMMENT '贺卡',
  `kdname` varchar(33) DEFAULT NULL COMMENT '发货快递',
  `kdorder` varchar(55) DEFAULT NULL COMMENT '发货快递单号',
  `isfh` int(2) NOT NULL DEFAULT '0' COMMENT '是否发货',
  `fhtime` varchar(33) DEFAULT NULL COMMENT '发货时间',
  `ctime` varchar(33) NOT NULL COMMENT '订单时间',
  `goodsmess` text NOT NULL COMMENT '订单商品信息',
  `orderstatus` int(4) NOT NULL DEFAULT '0' COMMENT '//订单状态 0=>未付款 1=>已付款 2=>已发货 3=>已签收（订单完成） 4=>退货 5=>订单关闭',
  `status` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_order` */

insert  into `tp_shop_order`(`id`,`orderid`,`uid`,`totalnum`,`totalprice`,`kdprice`,`cardid`,`ispay`,`payment`,`payprice`,`address`,`phone`,`username`,`note`,`giftnote`,`kdname`,`kdorder`,`isfh`,`fhtime`,`ctime`,`goodsmess`,`orderstatus`,`status`) values (1,'019293001482217998',0,6,18,12,0,0,1,30,'1','15071602515','1·','123','1231',NULL,NULL,0,NULL,'1482217998','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(2,'736739001482218617',0,6,18,12,0,0,1,30,'','','','','',NULL,NULL,0,NULL,'1482218617','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(3,'664021001482218622',0,6,18,12,0,0,1,30,'','1','123','','',NULL,NULL,0,NULL,'1482218622','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(4,'036103001482218694',0,6,18,12,0,0,0,30,'asxsax','15071602515','xasxsaa','xxsaxax','xsxsa',NULL,NULL,0,NULL,'1482218694','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(5,'698918001482218795',0,6,18,12,0,0,1,30,'asxsax','15071602515','xasxsaa','xxsaxax','xsxsa',NULL,NULL,0,NULL,'1482218795','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(6,'725006001482218814',0,6,18,12,0,0,1,30,'3213','15071602515','1\' OR \'1\'=\'1','123213121323','13223',NULL,NULL,0,NULL,'1482218814','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(7,'425565001482218894',0,6,18,12,0,0,0,30,'13','15071602515','13375948211','12','',NULL,NULL,0,NULL,'1482218894','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(8,'990741001482218914',0,6,18,12,0,0,1,30,'13','15071602515','13375948211','12','',NULL,NULL,0,NULL,'1482218915','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(9,'038185001482219150',0,6,18,12,0,0,1,30,'1','15071602511','13375948211','','',NULL,NULL,0,NULL,'1482219150','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(10,'908521001482219155',0,6,18,12,0,0,1,30,'1','15071602511','13375948211','','',NULL,NULL,0,NULL,'1482219155','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(11,'790846001482219493',0,6,18,12,0,0,1,30,'123','15071602515','15071602515','123123','131213',NULL,NULL,0,NULL,'1482219493','a:1:{i:0;a:9:{s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";i:2;s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"6\";s:6:\"amount\";i:18;}}',0,1),(12,'704990001482303791',1,1,3,12,0,0,1,15,'123','15071602515','123','12312','321321313',NULL,NULL,0,NULL,'1482303791','a:1:{i:0;a:13:{s:2:\"id\";s:1:\"5\";s:3:\"uid\";s:1:\"1\";s:3:\"gid\";s:1:\"9\";s:4:\"name\";s:9:\"asxasxxsx\";s:6:\"picimg\";s:47:\"/Uploads/ShopGoods/2016-12-12/584e176f8352c.jpg\";s:8:\"pricenow\";s:1:\"1\";s:6:\"attrid\";s:2:\"13\";s:9:\"attrprice\";s:1:\"2\";s:7:\"attrall\";a:1:{i:0;a:5:{s:2:\"id\";s:2:\"13\";s:7:\"attrpid\";s:2:\"16\";s:6:\"attrid\";s:2:\"17\";s:8:\"attrname\";s:8:\"10-15寸\";s:5:\"price\";s:1:\"2\";}}s:6:\"number\";s:1:\"1\";s:6:\"amount\";s:1:\"3\";s:5:\"ctime\";s:10:\"1482294661\";s:6:\"status\";s:1:\"1\";}}',0,1);

/*Table structure for table `tp_shop_set` */

DROP TABLE IF EXISTS `tp_shop_set`;

CREATE TABLE `tp_shop_set` (
  `id` int(11) DEFAULT NULL,
  `shopurl` text,
  `isyou` int(11) DEFAULT '0',
  `postage` float DEFAULT '12',
  `freepostage` float DEFAULT '99'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_set` */

insert  into `tp_shop_set`(`id`,`shopurl`,`isyou`,`postage`,`freepostage`) values (1,'http://www.cpshop.com/',1,12,99);

/*Table structure for table `tp_shop_tag` */

DROP TABLE IF EXISTS `tp_shop_tag`;

CREATE TABLE `tp_shop_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(44) DEFAULT NULL,
  `color` varchar(44) DEFAULT NULL,
  `ctime` varchar(44) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tp_shop_tag` */

insert  into `tp_shop_tag`(`id`,`name`,`color`,`ctime`,`status`) values (1,'1232i7ii7','#5BC0DEkui','1480906635',1),(2,'ascsacsac','casc','1480907034',1),(3,'cac88','#5BC0DEkk','1480907041',1);

/*Table structure for table `tp_user` */

DROP TABLE IF EXISTS `tp_user`;

CREATE TABLE `tp_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(44) NOT NULL,
  `email` varchar(44) NOT NULL,
  `password` varchar(44) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `ctime` varchar(44) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tp_user` */

insert  into `tp_user`(`id`,`username`,`email`,`password`,`status`,`ctime`) values (1,'15071602515','1521249977@qq.com','96e79218965eb72c92a549dd5a330112',1,'1482288232');

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

insert  into `tp_wx_config`(`id`,`token`,`appid`,`appsecret`,`machid`,`machkey`,`wechatnumber`) values (1,'TOKEN8','APPID','APPSECRET','MchID','MchKey','公众号');

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
