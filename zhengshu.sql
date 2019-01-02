/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zhengshu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-01-02 17:35:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zs_classinfo
-- ----------------------------
DROP TABLE IF EXISTS `zs_classinfo`;
CREATE TABLE `zs_classinfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classid` int(11) unsigned NOT NULL COMMENT '课程类别id',
  `tag` varchar(255) NOT NULL DEFAULT '' COMMENT '课程内容标签 以-分割',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '课程价格表',
  `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠价格',
  `discountdate` datetime DEFAULT NULL COMMENT '优惠截止日期',
  `teacherid` varchar(255) DEFAULT '' COMMENT '授课讲师id 以逗号分割',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '课程封面图地址',
  `staus` tinyint(1) unsigned DEFAULT '1' COMMENT '是否下架',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='课程详情表';

-- ----------------------------
-- Records of zs_classinfo
-- ----------------------------

-- ----------------------------
-- Table structure for zs_classlist
-- ----------------------------
DROP TABLE IF EXISTS `zs_classlist`;
CREATE TABLE `zs_classlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classinfoid` int(11) NOT NULL COMMENT '所属课程id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '所属章节id 0代表章 其他代表节',
  `video` varchar(255) NOT NULL COMMENT '课程视频地址',
  `name` varchar(255) DEFAULT NULL COMMENT '章节名称',
  `teachername` varchar(255) DEFAULT NULL COMMENT '主讲老师姓名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='课程章节表';

-- ----------------------------
-- Records of zs_classlist
-- ----------------------------

-- ----------------------------
-- Table structure for zs_classtype
-- ----------------------------
DROP TABLE IF EXISTS `zs_classtype`;
CREATE TABLE `zs_classtype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) NOT NULL DEFAULT '0' COMMENT '上级类型id id-pid',
  `name` varchar(255) NOT NULL COMMENT '课程类型名',
  `img` varchar(255) NOT NULL COMMENT '分类图片',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '类别路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='课程类型表';

-- ----------------------------
-- Records of zs_classtype
-- ----------------------------

-- ----------------------------
-- Table structure for zs_comment
-- ----------------------------
DROP TABLE IF EXISTS `zs_comment`;
CREATE TABLE `zs_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classid` int(10) unsigned NOT NULL COMMENT '课程id',
  `text` text NOT NULL COMMENT '评论内容',
  `memberid` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `time` datetime DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='评论表';

-- ----------------------------
-- Records of zs_comment
-- ----------------------------

-- ----------------------------
-- Table structure for zs_manager
-- ----------------------------
DROP TABLE IF EXISTS `zs_manager`;
CREATE TABLE `zs_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acount` varchar(24) NOT NULL DEFAULT '' COMMENT '登录名',
  `phone` char(11) NOT NULL DEFAULT '',
  `passwd` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `time` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否禁用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `acount` (`acount`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of zs_manager
-- ----------------------------
INSERT INTO `zs_manager` VALUES ('3', 'admin', '18224577267', 'e10adc3949ba59abbe56e057f20f883e', 'admins122', '2018-12-29 07:16:46', '1');

-- ----------------------------
-- Table structure for zs_member
-- ----------------------------
DROP TABLE IF EXISTS `zs_member`;
CREATE TABLE `zs_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `phone` char(11) NOT NULL COMMENT '手机号',
  `passwd` varchar(255) DEFAULT '' COMMENT '密码',
  `name` varchar(24) DEFAULT '' COMMENT '昵称',
  `sex` enum('0','1') DEFAULT '1' COMMENT '性别',
  `qq` varchar(255) DEFAULT '',
  `wechat` varchar(255) DEFAULT '' COMMENT '微信号码',
  `hkadd` varchar(255) DEFAULT '' COMMENT '户口地址',
  `idcard` varchar(255) DEFAULT '' COMMENT '身份证号码',
  `readd` varchar(255) DEFAULT '' COMMENT '收货地址',
  `emcontact` varchar(255) DEFAULT '' COMMENT '紧急联系人',
  `emcontactcall` char(11) DEFAULT '' COMMENT '紧急联系人电话',
  `edu` enum('5','4','3','2','1') DEFAULT '1' COMMENT '学历',
  `source` varchar(255) DEFAULT '' COMMENT '来源',
  `time` datetime DEFAULT NULL COMMENT '创建时间',
  `status` enum('1','0') DEFAULT '1' COMMENT '是否禁用',
  PRIMARY KEY (`id`,`phone`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of zs_member
-- ----------------------------
INSERT INTO `zs_member` VALUES ('1', '18224577267', 'e10adc3949ba59abbe56e057f20f883e', 'user1', '1', '', '', '', '', '', '', '', '1', '后台添加', '2019-01-02 06:55:48', '1');

-- ----------------------------
-- Table structure for zs_order
-- ----------------------------
DROP TABLE IF EXISTS `zs_order`;
CREATE TABLE `zs_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classid` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `ispay` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否付款',
  `history` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '学习进度 classlist章节id',
  `orderid` varchar(11) NOT NULL DEFAULT '' COMMENT '订单号',
  `payway` varchar(255) NOT NULL COMMENT '支付方式',
  `payid` varchar(255) NOT NULL COMMENT '第三方支付单号',
  `createtime` datetime NOT NULL COMMENT '订单创建时间',
  `paytime` datetime NOT NULL COMMENT '支付完成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of zs_order
-- ----------------------------
