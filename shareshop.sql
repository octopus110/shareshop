/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : shareshop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-12-16 10:18:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '0 普通地址 1默认地址',
  `info` varchar(300) NOT NULL COMMENT '地址信息',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '收件人姓名',
  `phone` varchar(15) NOT NULL COMMENT '收件人联系方式',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf32 COMMENT='地址表';

-- ----------------------------
-- Records of address
-- ----------------------------

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) unsigned NOT NULL COMMENT '商品id',
  `shareshopid` varchar(50) DEFAULT NULL COMMENT '分享者id',
  `sum` int(5) unsigned NOT NULL DEFAULT '1' COMMENT '产品数量',
  `attr` varchar(100) DEFAULT NULL,
  `total` float(6,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf32 COMMENT='购物车';

-- ----------------------------
-- Records of carts
-- ----------------------------

-- ----------------------------
-- Table structure for classifys
-- ----------------------------
DROP TABLE IF EXISTS `classifys`;
CREATE TABLE `classifys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '分类名称',
  `src` varchar(255) DEFAULT NULL COMMENT '分类logo',
  `sort` tinyint(2) unsigned NOT NULL COMMENT '分类排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf32 COMMENT='分类表';

-- ----------------------------
-- Records of classifys
-- ----------------------------

-- ----------------------------
-- Table structure for commoditys
-- ----------------------------
DROP TABLE IF EXISTS `commoditys`;
CREATE TABLE `commoditys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL COMMENT '属于哪个商户的商品',
  `name` varchar(100) NOT NULL COMMENT '商品名称',
  `quantity` int(11) unsigned NOT NULL COMMENT '商品数量',
  `sales` int(255) unsigned DEFAULT '0' COMMENT '产品销量',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '商品状态 0 健康 1下架',
  `introduce` text COMMENT '商品介绍',
  `classify_id` int(11) NOT NULL COMMENT '商品分类',
  `price` float NOT NULL COMMENT '商品价格',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classify_id` (`classify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf32 COMMENT='商品表';

-- ----------------------------
-- Records of commoditys
-- ----------------------------

-- ----------------------------
-- Table structure for earnings
-- ----------------------------
DROP TABLE IF EXISTS `earnings`;
CREATE TABLE `earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` float NOT NULL COMMENT '收益金额',
  `cid` int(11) NOT NULL COMMENT '产品id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COMMENT='收益表';

-- ----------------------------
-- Records of earnings
-- ----------------------------

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(100) NOT NULL COMMENT '图片路径',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '对应商品id',
  `classify` tinyint(2) NOT NULL DEFAULT '0' COMMENT '分类 0商品图片 1banner图片 2分类图片',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf32 COMMENT='图片表';

-- ----------------------------
-- Records of images
-- ----------------------------

-- ----------------------------
-- Table structure for informations
-- ----------------------------
DROP TABLE IF EXISTS `informations`;
CREATE TABLE `informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `IDnumber` varchar(18) NOT NULL COMMENT '身份证号',
  `sex` tinyint(1) NOT NULL COMMENT '性别',
  `birthplace` varchar(100) NOT NULL COMMENT '出生地',
  `abode` varchar(100) NOT NULL COMMENT '居住地',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='个人信息表';

-- ----------------------------
-- Records of informations
-- ----------------------------

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL COMMENT '用户对应微信UID',
  `head` varchar(255) DEFAULT NULL COMMENT '头像',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户类型 0 普通用户 1 个体商',
  `realname` varchar(20) DEFAULT NULL,
  `IDnumber` varchar(20) DEFAULT NULL,
  `sex` tinyint(1) unsigned DEFAULT '0' COMMENT '0 男 1 女',
  `earnings` float DEFAULT '0' COMMENT '用户收益 每次发放就清0',
  `getearnings` float unsigned DEFAULT '0' COMMENT '发放金额',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf32 COMMENT='前台注册会员表';

-- ----------------------------
-- Records of members
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL COMMENT '属于哪个商户的订单',
  `cid` int(11) unsigned NOT NULL COMMENT '商品id',
  `shareshopid` varchar(50) DEFAULT NULL COMMENT '分享者id',
  `type` tinyint(2) NOT NULL COMMENT '订单类型 0 购物订单 1提现订单',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `money` float NOT NULL COMMENT '订单金额',
  `rid` varchar(100) NOT NULL COMMENT '订单号',
  `sum` int(5) unsigned NOT NULL DEFAULT '1' COMMENT '产品数量',
  `proinfo` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `attr` varchar(255) DEFAULT NULL COMMENT '产品属性',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '0 已付款 1 未付款 2关闭',
  `delivery` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态 0未发货 1已发货 2已签收',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf32 COMMENT='订单表';

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for propertys
-- ----------------------------
DROP TABLE IF EXISTS `propertys`;
CREATE TABLE `propertys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '商品id',
  `title` varchar(20) NOT NULL COMMENT '属性标题',
  `content` varchar(100) NOT NULL COMMENT '属性内容 用，隔开',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf32 COMMENT='商品属性表';

-- ----------------------------
-- Records of propertys
-- ----------------------------

-- ----------------------------
-- Table structure for records
-- ----------------------------
DROP TABLE IF EXISTS `records`;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) NOT NULL COMMENT '0 已付款 1未付款',
  `rid` int(11) NOT NULL COMMENT '流水id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='流水表';

-- ----------------------------
-- Records of records
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `storename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺名称',
  `storeintroduce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺简介',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商店logo',
  `weixin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户微信号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '法人或负责人名字',
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系方式',
  `IDnumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身份证号',
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司注册号',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱 用户登录',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profit` float(255,0) unsigned DEFAULT '0' COMMENT '分红额度',
  `deadline` int(255) unsigned DEFAULT '3' COMMENT '获得分红的期限',
  `mid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '所拥有的个体渠道商',
  `grade` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户等级 0 超级管理员 1 普通商家',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='注册商表';

-- ----------------------------
-- Records of users
-- ----------------------------
