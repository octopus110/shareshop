/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : shareshop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-30 09:30:52
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
  `uid` int(11) NOT NULL COMMENT '用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='地址表';

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
  `cid` int(11) NOT NULL COMMENT '商品id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='购物车';

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf32 COMMENT='分类表';

-- ----------------------------
-- Records of classifys
-- ----------------------------
INSERT INTO `classifys` VALUES ('7', '服装', 'classify_1511847094441437.png', '1', '2017-11-28 13:31:34', '2017-11-28 05:31:34');
INSERT INTO `classifys` VALUES ('8', '家电', 'classify_1511847195176819.png', '2', '2017-11-28 13:33:15', '2017-11-28 05:33:15');
INSERT INTO `classifys` VALUES ('9', '数码', 'classify_1511847365209412.png', '3', '2017-11-28 13:36:05', '2017-11-28 05:36:05');
INSERT INTO `classifys` VALUES ('10', '美妆', 'classify_1511847374221192.png', '4', '2017-11-28 13:36:14', '2017-11-28 05:36:14');
INSERT INTO `classifys` VALUES ('11', '运动', 'classify_1511847385880310.png', '5', '2017-11-28 13:36:25', '2017-11-28 05:36:25');
INSERT INTO `classifys` VALUES ('12', '学习', 'classify_1511847395250702.png', '6', '2017-11-28 13:36:35', '2017-11-28 05:36:35');
INSERT INTO `classifys` VALUES ('13', '百货', 'classify_1511847404302735.png', '7', '2017-11-28 13:36:44', '2017-11-28 05:36:44');
INSERT INTO `classifys` VALUES ('14', '酒水', 'classify_1511847411537353.png', '8', '2017-11-28 13:36:51', '2017-11-28 05:36:51');
INSERT INTO `classifys` VALUES ('18', '饮料', 'classify_1511847920832153.png', '9', '2017-11-28 05:45:20', '2017-11-28 05:45:20');

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `classify_id` (`classify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf32 COMMENT='商品表';

-- ----------------------------
-- Records of commoditys
-- ----------------------------
INSERT INTO `commoditys` VALUES ('14', '3', 'AaNn羊绒落肩长款大衣 Eugene tong着用', '6', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"宽松\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">服装版型:&nbsp;宽松</li><li title=\"浅灰色 黑色\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色分类:&nbsp;浅灰色 黑色</li><li title=\"中长款\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">衣长:&nbsp;中长款</li><li title=\"S M L XL\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">尺码:&nbsp;S M L XL</li><li title=\"单排扣\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">衣门襟:&nbsp;单排扣</li><li title=\"羊绒\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">面料分类:&nbsp;羊绒</li><li title=\"其他/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;其他/other</li><li title=\"冬季\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用季节:&nbsp;冬季</li><li title=\"旅游\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用场景:&nbsp;旅游</li><li title=\"青春流行\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">基础风格:&nbsp;青春流行</li></ul>', '7', '699', '2017-11-28 13:07:22', '2017-11-27 09:37:47');
INSERT INTO `commoditys` VALUES ('15', '3', '撞色蓝色风衣男 ulzzang韩版中长款简约帅气披风外套时尚潮流秋冬', '20', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"中长款\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">衣长:&nbsp;中长款</li><li title=\"宽松\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">版型:&nbsp;宽松</li><li title=\"无扣\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">衣门襟:&nbsp;无扣</li><li title=\"雾蓝\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色:&nbsp;雾蓝</li><li title=\"M L\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">尺码:&nbsp;M L</li><li title=\"其它/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;其它/other</li><li title=\"秋季\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用季节:&nbsp;秋季</li><li title=\"其他休闲\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用场景:&nbsp;其他休闲</li><li title=\"青春流行\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">基础风格:&nbsp;青春流行</li></ul>', '7', '166', '2017-11-28 13:07:23', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('16', '3', '2017秋冬季纯黑色弹力牛仔裤男小脚紧身修身休闲长裤牛仔长裤潮男', '78', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"棉69% 聚酯纤维31%\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">材质成分:&nbsp;棉69% 聚酯纤维31%</li><li title=\"长裤\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">裤长:&nbsp;长裤</li><li title=\"H4065\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">货号:&nbsp;H4065</li><li title=\"黑色\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色:&nbsp;黑色</li><li title=\"29 30 31 32 33 34\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">尺码:&nbsp;29 30 31 32 33 34</li><li title=\"常规牛仔布\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">牛仔面料:&nbsp;常规牛仔布</li><li title=\"其它/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;其它/other</li><li title=\"缉明线\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">款式细节:&nbsp;缉明线</li><li title=\"2017年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">上市时间:&nbsp;2017年</li><li title=\"四季\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用季节:&nbsp;四季</li><li title=\"其他休闲\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用场景:&nbsp;其他休闲</li><li title=\"青年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用对象:&nbsp;青年</li><li title=\"棉\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">材质:&nbsp;棉</li><li title=\"微弹\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">弹力:&nbsp;微弹</li><li title=\"中腰\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">腰型:&nbsp;中腰</li><li title=\"小直脚\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">裤脚口款式:&nbsp;小直脚</li><li title=\"拉链\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">裤门襟:&nbsp;拉链</li><li title=\"水洗\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">洗水工艺:&nbsp;水洗</li><li title=\"常规\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">厚薄:&nbsp;常规</li><li title=\"修身小脚\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">款式版型:&nbsp;修身小脚</li><li title=\"青春流行\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">基础风格:&nbsp;青春流行</li><li title=\"潮\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">细分风格:&nbsp;潮</li></ul>', '7', '89', '2017-11-28 13:07:23', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('17', '3', '日系原创秋冬加绒立体剪裁拼料连帽卫衣男宽飘带长袖上衣外套男潮', '68', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"套头\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">款式:&nbsp;套头</li><li title=\"宽松\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">版型:&nbsp;宽松</li><li title=\"连帽\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">领型:&nbsp;连帽</li><li title=\"白色 红色 绿色 黑色\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色:&nbsp;白色 红色 绿色 黑色</li><li title=\"M L XL 2XL\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">尺码:&nbsp;M L XL 2XL</li><li title=\"插肩袖\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">袖型:&nbsp;插肩袖</li><li title=\"其他/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;其他/other</li><li title=\"纯色\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">图案:&nbsp;纯色</li><li title=\"秋季\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用季节:&nbsp;秋季</li><li title=\"休闲\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用场景:&nbsp;休闲</li><li title=\"青年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用对象:&nbsp;青年</li><li title=\"袋鼠兜\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">服装口袋样式:&nbsp;袋鼠兜</li><li title=\"加绒\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">厚薄:&nbsp;加绒</li><li title=\"青春流行\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">基础风格:&nbsp;青春流行</li><li title=\"日系复古\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">细分风格:&nbsp;日系复古</li></ul>', '7', '128', '2017-11-28 13:07:24', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('18', '3', '纽约大宝 Columbia/哥伦比亚 热反射男士冬季保暖棉衣外套XM0020', '27', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"常规\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">衣长:&nbsp;常规</li><li title=\"XM0020\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">货号:&nbsp;XM0020</li><li title=\"标准\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">版型:&nbsp;标准</li><li title=\"XM0020-010黑色 XM0020-369灰绿 XM0020-915绿色 XM0020-021银灰 XM0020-448蓝色 XM0020-438蓝色\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色:&nbsp;XM0020-010黑色 XM0020-369灰绿 XM0020-915绿色 XM0020-021银灰 XM0020-448蓝色 XM0020-438蓝色</li><li title=\"S 代购 M 代购 L 代购 XL 代购 XXL 代购 XS代购 S现货 M现货 L现货 XL现货 XXL现货 XS现货 S在途 M在途 L在途 XL在途 XXL在途 XS在途\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">尺码:&nbsp;S 代购 M 代购 L 代购 XL 代购 XXL 代购 XS代购 S现货 M现货 L现货 XL现货 XXL现货 XS现货 S在途 M在途 L在途 XL在途 XXL在途 XS在途</li><li title=\"Columbia/哥伦比亚\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;Columbia/哥伦比亚</li><li title=\"其他休闲\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用场景:&nbsp;其他休闲</li><li title=\"青年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用对象:&nbsp;青年</li><li title=\"常规\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">厚薄:&nbsp;常规</li><li title=\"时尚都市\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">基础风格:&nbsp;时尚都市</li></ul>', '7', '485', '2017-11-28 13:07:25', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('19', '6', 'Lenovo/联想 拯救者15 -ISK 四核I5 I7 R720-15 游戏本笔记本电脑', '11', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"2012010902583758\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">CCC证书编号:&nbsp;<a href=\"https://baike.taobao.com/view.htm?wd=2012010902583758&amp;ac=29\" target=\"blank\" style=\"text-decoration: none; color: rgb(51, 102, 204); outline: 0px;\">2012010902583758</a></li><li title=\"Lenovo/联想 拯救者15 -ISK\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">产品名称:&nbsp;Lenovo/联想 拯救者15 -ISK</li><li title=\"387mm X 272.6mm X 27.9mm\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">包装体积:&nbsp;387mm X 272.6mm X 27.9mm</li><li title=\"20.0mm及以上\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">厚度:&nbsp;20.0mm及以上</li><li title=\"标屏\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">屏幕类型:&nbsp;标屏</li><li title=\"否\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">是否PC平板二合一:&nbsp;否</li><li title=\"2.5kg\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">机身重量（含电池）:&nbsp;2.5kg</li><li title=\"2.69kg\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">毛重:&nbsp;2.69kg</li><li title=\"中国大陆\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">版本类型:&nbsp;中国大陆</li><li title=\"一级\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">能效等级:&nbsp;一级</li><li title=\"Lenovo/联想\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;Lenovo/联想</li><li title=\"拯救者15\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">系列:&nbsp;拯救者15</li><li title=\"-ISK\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">型号:&nbsp;-ISK</li><li title=\"15.6英寸\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">屏幕尺寸:&nbsp;15.6英寸</li><li title=\"16:9\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">屏幕比例:&nbsp;16:9</li><li title=\"英特尔 酷睿 i7-7700\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">CPU:&nbsp;英特尔 酷睿 i7-7700</li><li title=\"GTX1050\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">显卡类型:&nbsp;GTX1050</li><li title=\"2GB\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">显存容量:&nbsp;2GB</li><li title=\"1TB\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">机械硬盘容量:&nbsp;1TB</li><li title=\"128G\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">固态硬盘:&nbsp;128G</li><li title=\"8GB\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">内存容量:&nbsp;8GB</li><li title=\"无光驱\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">光驱类型:&nbsp;无光驱</li><li title=\"家庭影音 学生 商务办公 高清游戏 尊贵旗舰\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">适用场景:&nbsp;家庭影音 学生 商务办公 高清游戏 尊贵旗舰</li><li title=\"2kg(含)-2.5kg(不含)\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">重量:&nbsp;2kg(含)-2.5kg(不含)</li><li title=\"锂聚合物电池\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">锂电池电芯数量:&nbsp;锂聚合物电池</li><li title=\"全国联保\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">售后服务:&nbsp;全国联保</li><li title=\"I5-6300/8G/1T/960-4G 定制:I5-6300/8G/1T+128/960-4G I7-6700HQ/8G/1T/960-4G 定制:I7-6700/8G/1T+128/960-4G\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色分类:&nbsp;I5-6300/8G/1T/960-4G 定制:I5-6300/8G/1T+128/960-4G I7-6700HQ/8G/1T/960-4G 定制:I7-6700/8G/1T+128/960-4G</li><li title=\"2015年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">上市时间:&nbsp;2015年</li><li title=\"windows 10\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">操作系统:&nbsp;windows 10</li><li title=\"无线网卡 蓝牙\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">通信技术类型:&nbsp;无线网卡 蓝牙</li><li title=\"触摸板\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">输入设备:&nbsp;触摸板</li><li title=\"套餐一 套餐二 官方标配\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">套餐类型:&nbsp;套餐一 套餐二 官方标配</li><li title=\"否\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">是否超极本:&nbsp;否</li><li title=\"1920x1080\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">分辨率:&nbsp;1920x1080</li><li title=\"非触摸屏\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">是否触摸屏:&nbsp;非触摸屏</li></ul>', '9', '6199', '2017-11-28 13:07:25', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('20', '6', 'Microsoft/微软Surface Book 2 增强版 i5 i7 平板笔记本电脑国行', '5', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"2015010902807731\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">CCC证书编号:&nbsp;<a href=\"https://baike.taobao.com/view.htm?wd=2015010902807731&amp;ac=29\" target=\"blank\" style=\"text-decoration: none; color: rgb(51, 102, 204); outline: 0px;\">2015010902807731</a></li><li title=\"Intel/英特尔\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">处理器品牌:&nbsp;Intel/英特尔</li><li title=\"是\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">是否PC平板二合一:&nbsp;是</li><li title=\"中国大陆\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">版本类型:&nbsp;中国大陆</li><li title=\"Microsoft/微软\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;Microsoft/微软</li><li title=\"Surface Book i5 独立显卡\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">型号:&nbsp;Surface Book i5 独立显卡</li><li title=\"其他/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">屏幕尺寸:&nbsp;其他/other</li><li title=\"【1代】i7/8G/256G独显 【1代】i5/8G/128G集显—预售 【1代】i7/16G/512G独显 【1代】i5/8G/256G独显 【1代】i7/16G/1TB独显 【增强版】i7/8G/256G 新独显 【增强版】i7/16G/512G 新独显 【增强版】i7/16G/1TB 新独显 【1代】i5/8G/512G集显 Book2/I5/8G/256G/集显-现货 Book2/I7/8G/256G/GTX1050-现货 Book2/I7/16G/512G/GTX1050-现货 Book2/I7/16G/1TB/GTX1050-现货\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色分类:&nbsp;【1代】i7/8G/256G独显 【1代】i5/8G/128G集显—预售 【1代】i7/16G/512G独显 【1代】i5/8G/256G独显 【1代】i7/16G/1TB独显 【增强版】i7/8G/256G 新独显 【增强版】i7/16G/512G 新独显 【增强版】i7/16G/1TB 新独显 【1代】i5/8G/512G集显 Book2/I5/8G/256G/集显-现货 Book2/I7/8G/256G/GTX1050-现货 Book2/I7/16G/512G/GTX1050-现货 Book2/I7/16G/1TB/GTX1050-现货</li><li title=\"WIFI\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">网络类型:&nbsp;WIFI</li><li title=\"WiFi/重力感应/HDMI/3G外挂/U盘外挂 原笔迹手写 人脸识别 蓝牙\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">热门功能:&nbsp;WiFi/重力感应/HDMI/3G外挂/U盘外挂 原笔迹手写 人脸识别 蓝牙</li><li title=\"128GB及以上\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">存储容量:&nbsp;128GB及以上</li><li title=\"Windows\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">操作系统:&nbsp;Windows</li><li title=\"windows 10\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">windows版本:&nbsp;windows 10</li><li title=\"其他/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">CPU主频:&nbsp;其他/other</li><li title=\"其他/other\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">内存容量:&nbsp;其他/other</li><li title=\"支持\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">是否支持蓝牙:&nbsp;支持</li><li title=\"双摄像头\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">摄像头类型:&nbsp;双摄像头</li><li title=\"固态硬盘\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">存储类型:&nbsp;固态硬盘</li><li title=\"2015年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">上市时间:&nbsp;2015年</li><li title=\"全国联保\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">售后服务:&nbsp;全国联保</li><li title=\"官方标配 套餐一 套餐二 套餐三\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">套餐类型:&nbsp;官方标配 套餐一 套餐二 套餐三</li><li title=\"全新\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">成色:&nbsp;全新</li></ul>', '8', '22688', '2017-11-28 13:07:26', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('21', '6', '2017新款Apple/苹果 iPad Air2 32 128G iPad7 9.7寸 WiFi 4G国行', '58', '0', '0', '<ul class=\"attributes-list\" style=\"margin: 0px; padding: 0px 15px; list-style: none; clear: both; font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif;\"><li title=\"2014010902728475\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">CCC证书编号:&nbsp;<a href=\"https://baike.taobao.com/view.htm?wd=2014010902728475&amp;ac=29\" target=\"blank\" style=\"text-decoration: none; color: rgb(51, 102, 204); outline: 0px;\">2014010902728475</a></li><li title=\"Apple/苹果 iPad Air 2\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">产品名称:&nbsp;Apple/苹果 iPad Air 2</li><li title=\"Apple/苹果\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">处理器品牌:&nbsp;Apple/苹果</li><li title=\"双核\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">核心数:&nbsp;双核</li><li title=\"中国大陆\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">版本类型:&nbsp;中国大陆</li><li title=\"Apple/苹果\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">品牌:&nbsp;Apple/苹果</li><li title=\"iPad Air 2\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">型号:&nbsp;iPad Air 2</li><li title=\"9.7 英寸 (对角线) LED 背光 Multi?Touch 显示屏\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">屏幕尺寸:&nbsp;9.7 英寸 (对角线) LED 背光 Multi?Touch 显示屏</li><li title=\"【2017新款iPad】国行-深空灰色 【2017新款iPad】国行-银色 【2017新款iPad】国行-金色 【2017新款iPad】港版-深空灰色 【2017新款iPad】港版-银色 【2017新款iPad】港版-金色 实体店可自提，可维修，可置换 推荐大家先收藏或加入购物车 支持花呗分期0首付\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">颜色分类:&nbsp;【2017新款iPad】国行-深空灰色 【2017新款iPad】国行-银色 【2017新款iPad】国行-金色 【2017新款iPad】港版-深空灰色 【2017新款iPad】港版-银色 【2017新款iPad】港版-金色 实体店可自提，可维修，可置换 推荐大家先收藏或加入购物车 支持花呗分期0首付</li><li title=\"WIFI 4G\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">网络类型:&nbsp;WIFI 4G</li><li title=\"32GB 128GB\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">存储容量:&nbsp;32GB 128GB</li><li title=\"iOS 9\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">操作系统:&nbsp;iOS 9</li><li title=\"2048 x 1536 像素分辨率，264 ppi\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">分辨率:&nbsp;2048 x 1536 像素分辨率，264 ppi</li><li title=\"不详\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">CPU主频:&nbsp;不详</li><li title=\"不详\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">内存容量:&nbsp;不详</li><li title=\"2014年\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">上市时间:&nbsp;2014年</li><li title=\"10月\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">月份:&nbsp;10月</li><li title=\"全国联保\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">售后服务:&nbsp;全国联保</li><li title=\"官方标配 套餐一 套餐二 套餐三\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">套餐类型:&nbsp;官方标配 套餐一 套餐二 套餐三</li><li title=\"全新\" style=\"margin: 0px 20px 0px 0px; padding: 0px; display: inline; float: left; width: 206px; height: 24px; overflow: hidden; text-indent: 5px; line-height: 24px; white-space: nowrap; text-overflow: ellipsis;\">成色:&nbsp;全新</li></ul>', '8', '4300', '2017-11-28 13:07:27', '0000-00-00 00:00:00');
INSERT INTO `commoditys` VALUES ('22', '3', '【热卖13万双】骆驼运动鞋 秋冬男女轻便跑步鞋减震休闲跑鞋男鞋', '20', '0', '0', '<p class=\"attr-list-hd tm-clear\" style=\"margin: 0px; padding: 5px 20px; line-height: 22px; color: rgb(153, 153, 153); font-family: tahoma, arial, 微软雅黑, sans-serif;\"><span style=\"color: rgb(102, 102, 102); white-space: nowrap;\">产品名称：骆驼牌 A712318135</span><br /></p><ul id=\"J_AttrUL\" style=\"margin: 0px; padding: 0px 20px 18px; list-style: none; zoom: 1; border-top: 1px solid rgb(255, 255, 255); color: rgb(64, 64, 64); font-family: tahoma, arial, 微软雅黑, sans-serif;\"><li title=\"&nbsp;是\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">是否商场同款:&nbsp;是</li><li title=\"&nbsp;A73318613，梅红 女款 革面&nbsp;A73318613，紫粉红 女款 革面&nbsp;A73318613，灰/梅红 女款 革面&nbsp;A73318613，黑白 女款 革面&nbsp;A732318305，黑红 男款 革面&nbsp;A732318305，深灰桔 男款 革面&nbsp;A732318305，靛蓝 男款 革面&nbsp;A732318305，黑白 男款 革面&nbsp;A71318604，浅灰/紫粉 女&nbsp;A71318604，白/梅红 女&nbsp;A71318604，荧光粉/湖绿 女&nbsp;A712318135，靛蓝 男&nbsp;A712318135，灰/蓝 男&nbsp;A712318135，荧光绿 男&nbsp;A712318135，黑/荧光绿 男\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">颜色分类:&nbsp;A73318613，梅红 女款 革面&nbsp;A73318613，紫粉红 女款 革面&nbsp;A73318613，灰/梅红 女款 革面&nbsp;A73318613，黑白 女款 革面&nbsp;A732318305，黑红 男款 革面&nbsp;A732318305，深灰桔 男款 革面&nbsp;A732318305，靛蓝 男款 革面&nbsp;A732318305，黑白 男款 革面&nbsp;A71318604，浅灰/紫粉 女&nbsp;A71318604，白/梅红 女&nbsp;A71318604，荧光粉/湖绿 女&nbsp;A712318135，靛蓝 男&nbsp;A712318135，灰/蓝 男&nbsp;A712318135，荧光绿 男&nbsp;A712318135，黑/荧光绿 男</li><li title=\"&nbsp;A712318135\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">款号:&nbsp;A712318135</li><li id=\"J_attrBrandName\" title=\"&nbsp;骆驼牌\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">品牌:&nbsp;骆驼牌</li><li title=\"&nbsp;2017年春季\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">上市时间:&nbsp;2017年春季</li><li title=\"&nbsp;1280\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">吊牌价:&nbsp;1280</li><li title=\"&nbsp;男女通用\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">性别:&nbsp;男女通用</li><li title=\"&nbsp;PU+织物\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">帮面材质:&nbsp;PU+织物</li><li title=\"&nbsp;MD+RB\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">外底材料:&nbsp;MD+RB</li><li title=\"&nbsp;小道&nbsp;跑道\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">适合路面:&nbsp;小道&nbsp;跑道</li><li title=\"&nbsp;缓震胶&nbsp;扭转系统&nbsp;飞线技术&nbsp;强化避震缓冲&nbsp;透气技术\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">运动鞋科技:&nbsp;缓震胶&nbsp;扭转系统&nbsp;飞线技术&nbsp;强化避震缓冲&nbsp;透气技术</li><li title=\"&nbsp;减震&nbsp;防滑&nbsp;耐磨&nbsp;透气&nbsp;包裹性&nbsp;支撑&nbsp;平衡&nbsp;抗冲击&nbsp;轻便\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">功能:&nbsp;减震&nbsp;防滑&nbsp;耐磨&nbsp;透气&nbsp;包裹性&nbsp;支撑&nbsp;平衡&nbsp;抗冲击&nbsp;轻便</li><li title=\"&nbsp;35&nbsp;36&nbsp;37&nbsp;38&nbsp;39&nbsp;40&nbsp;41&nbsp;42&nbsp;43&nbsp;44&nbsp;45\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">鞋码:&nbsp;35&nbsp;36&nbsp;37&nbsp;38&nbsp;39&nbsp;40&nbsp;41&nbsp;42&nbsp;43&nbsp;44&nbsp;45</li><li title=\"&nbsp;系带\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">闭合方式:&nbsp;系带</li><li title=\"&nbsp;皮革拼接\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">流行元素:&nbsp;皮革拼接</li><li title=\"&nbsp;都市跑\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">运动系列:&nbsp;都市跑</li><li title=\"&nbsp;否\" style=\"margin: 10px 15px 0px 0px; padding: 0px; list-style: none; display: inline; float: left; width: 220px; height: 18px; overflow: hidden; line-height: 18px; vertical-align: top; white-space: nowrap; text-overflow: ellipsis; color: rgb(102, 102, 102);\">是否瑕疵:&nbsp;否</li></ul>', '7', '149', '2017-11-28 14:35:42', '2017-11-28 06:35:42');

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COMMENT='收益表';

-- ----------------------------
-- Records of earnings
-- ----------------------------
INSERT INTO `earnings` VALUES ('1', '100', '11', '1', '2017-11-26 12:11:37', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(100) NOT NULL COMMENT '图片路径',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '对应商品id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `classify` tinyint(2) NOT NULL DEFAULT '0' COMMENT '分类 0商品图片 1banner图片 2分类图片',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf32 COMMENT='图片表';

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES ('33', 'commodity_1511773881521118.jpg', '15', '2017-11-27 17:11:51', '2017-11-27 09:11:51', '0');
INSERT INTO `images` VALUES ('34', 'commodity_1511773881683197.jpg', '15', '2017-11-27 17:11:51', '2017-11-27 09:11:51', '0');
INSERT INTO `images` VALUES ('35', 'commodity_151177388110773.jpg', '15', '2017-11-27 17:11:51', '2017-11-27 09:11:51', '0');
INSERT INTO `images` VALUES ('36', 'commodity_1511773882185730.jpg', '15', '2017-11-27 17:11:51', '2017-11-27 09:11:51', '0');
INSERT INTO `images` VALUES ('37', 'commodity_1511774102890503.jpg', '16', '2017-11-27 17:16:59', '2017-11-27 09:16:59', '0');
INSERT INTO `images` VALUES ('38', 'commodity_1511774103479218.jpg', '16', '2017-11-27 17:16:59', '2017-11-27 09:16:59', '0');
INSERT INTO `images` VALUES ('39', 'commodity_1511774103927856.jpg', '16', '2017-11-27 17:16:59', '2017-11-27 09:16:59', '0');
INSERT INTO `images` VALUES ('40', 'commodity_1511774352466431.jpg', '17', '2017-11-27 17:19:14', '2017-11-27 09:19:14', '0');
INSERT INTO `images` VALUES ('41', 'commodity_1511774352110688.jpg', '17', '2017-11-27 17:19:14', '2017-11-27 09:19:14', '0');
INSERT INTO `images` VALUES ('42', 'commodity_1511774352157257.jpg', '17', '2017-11-27 17:19:14', '2017-11-27 09:19:14', '0');
INSERT INTO `images` VALUES ('43', 'commodity_1511774497301605.jpg', '18', '2017-11-27 17:22:02', '2017-11-27 09:22:02', '0');
INSERT INTO `images` VALUES ('44', 'commodity_1511774497849975.jpg', '18', '2017-11-27 17:22:02', '2017-11-27 09:22:02', '0');
INSERT INTO `images` VALUES ('45', 'commodity_1511774497260102.jpg', '18', '2017-11-27 17:22:02', '2017-11-27 09:22:02', '0');
INSERT INTO `images` VALUES ('46', 'commodity_1511774498365479.jpg', '18', '2017-11-27 17:22:02', '2017-11-27 09:22:02', '0');
INSERT INTO `images` VALUES ('47', 'commodity_151177540437781.jpg', '14', '2017-11-27 17:37:16', '2017-11-27 09:37:16', '0');
INSERT INTO `images` VALUES ('48', 'commodity_1511775571568726.png', '19', '2017-11-27 17:40:06', '2017-11-27 09:40:06', '0');
INSERT INTO `images` VALUES ('49', 'commodity_1511775571292633.png', '19', '2017-11-27 17:40:06', '2017-11-27 09:40:06', '0');
INSERT INTO `images` VALUES ('50', 'commodity_1511775571789428.png', '19', '2017-11-27 17:40:06', '2017-11-27 09:40:06', '0');
INSERT INTO `images` VALUES ('51', 'commodity_1511775571937591.png', '19', '2017-11-27 17:40:06', '2017-11-27 09:40:06', '0');
INSERT INTO `images` VALUES ('52', 'commodity_1511775670145447.jpg', '20', '2017-11-27 17:41:21', '2017-11-27 09:41:21', '0');
INSERT INTO `images` VALUES ('53', 'commodity_1511775671361115.jpg', '20', '2017-11-27 17:41:21', '2017-11-27 09:41:21', '0');
INSERT INTO `images` VALUES ('54', 'commodity_1511775671307068.jpg', '20', '2017-11-27 17:41:21', '2017-11-27 09:41:21', '0');
INSERT INTO `images` VALUES ('55', 'commodity_1511775763857788.jpg', '21', '2017-11-27 17:42:46', '2017-11-27 09:42:46', '0');
INSERT INTO `images` VALUES ('56', 'commodity_151177576437598.jpg', '21', '2017-11-27 17:42:46', '2017-11-27 09:42:46', '0');
INSERT INTO `images` VALUES ('64', 'banner_1511828877285248.jpg', '0', '2017-11-28 08:27:57', '0000-00-00 00:00:00', '1');
INSERT INTO `images` VALUES ('65', 'banner_151182887722889.jpg', '0', '2017-11-28 08:27:57', '0000-00-00 00:00:00', '1');
INSERT INTO `images` VALUES ('66', 'banner_151182887799945.jpg', '0', '2017-11-28 08:27:57', '0000-00-00 00:00:00', '1');
INSERT INTO `images` VALUES ('67', 'commodity_1511848762348725.jpg', '22', '2017-11-28 13:59:33', '2017-11-28 05:59:33', '0');
INSERT INTO `images` VALUES ('68', 'commodity_1511848763954193.jpg', '22', '2017-11-28 13:59:33', '2017-11-28 05:59:33', '0');

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `weixinid` varchar(50) NOT NULL COMMENT '用户对应微信UID',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户类型 0 普通用户 1 个体商',
  `earnings` float DEFAULT '0' COMMENT '用户收益 每次发放就清0',
  `getearnings` float unsigned DEFAULT '0' COMMENT '发放金额',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COMMENT='用户表';

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('1', '111', '1', '100', '100', '0000-00-00 00:00:00', '2017-11-26 10:29:06');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL COMMENT '属于哪个商户的订单',
  `cid` int(11) unsigned NOT NULL COMMENT '商品id',
  `type` tinyint(2) NOT NULL COMMENT '订单类型 0 购物订单 1提现订单',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `money` float NOT NULL COMMENT '订单金额',
  `rid` varchar(100) NOT NULL COMMENT '订单号',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '0 已付款 1 未付款 2关闭',
  `delivery` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态 0未发货 1已发货 2已签收',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COMMENT='订单表';

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '2', '11', '0', '251302356', '100', '1233012254', '0', '0', '2017-11-26 15:47:33', '2017-11-25 05:20:57');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('1169815992@qq.com', '$2y$10$f/oKb33CvgPAvXcPgoNGUu6Bw7PBc76..tnuweN4pEE1CEjPneEcm', '2017-11-25 08:18:46');

-- ----------------------------
-- Table structure for records
-- ----------------------------
DROP TABLE IF EXISTS `records`;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) NOT NULL COMMENT '0 已付款 1未付款',
  `rid` int(11) NOT NULL COMMENT '流水id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='注册商表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '', null, 'sdfsdfs', 'root', '13661643461', '372928199301027410', '225658965123', '1169815992@qq.com', '$2y$10$VQUzRqVcdFMxAwhp8E4OJuf6Pkaeq.21SjBisA0NeXmywxix/6VVm', '5', '3', '1', '0', 'DqG8S3zBzISOvZImyQFySHzWutLhKusolTGq7gPP5Gfd22GQVX2n8DbsPMI1', '2017-11-25 08:13:55', '2017-11-25 08:13:55', '2017-11-25 11:03:24');
INSERT INTO `users` VALUES ('3', 'GBstudios原创男装', 'GBstudios原创男装 海量新品 潮流穿搭 玩趣互动', '1259845635', '李章岭', '13661643461', '372829366542123595', '5842356411', '1169856235@qq.com', '$2y$10$3emDvyOjTh1QvyowMeoljehtFu1FK6GR6b2hw6JgEef3Shx6Fs.MO', '0', '3', null, '1', '02BG1XqDZcN7vPUAmcpc6tfEXvTuEkBGiy0VVTG6khsQobq6Qsu2VpFGMnof', null, '2017-11-25 10:29:28', '2017-11-27 09:33:32');
INSERT INTO `users` VALUES ('6', '联想笔记本电脑商城', '联想笔记本电脑商城', '1235698', '采购城888', '13661643569', '372928199301027456', '1256335422', '1169815996@qq.com', '$2y$10$OSq6Mxxny1cwMpxf4VUrDO4FbRt/TTNH14sW5guZr73AEl.pwrdJ2', '0', '3', null, '1', 'G3hsvet5EG6T6drbZOHy4Z8lAlZ04JIHaM9bmWU21WixzfqXoaMHlwVon6dN', null, '2017-11-27 02:03:06', '2017-11-27 09:34:58');
INSERT INTO `users` VALUES ('7', null, null, 'afd', 'li99', '136584795896', null, null, 'd@qq.com', '1qaz2wsx', '0', '3', null, '0', null, null, '2017-11-27 02:38:16', '2017-11-27 02:57:25');
