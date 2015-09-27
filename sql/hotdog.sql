/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : hotdog

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-01-25 12:14:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hot_categories
-- ----------------------------
DROP TABLE IF EXISTS `hot_categories`;
CREATE TABLE `hot_categories` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分类名',
  `alias` varchar(50) NOT NULL COMMENT '英文别名',
  `description` varchar(100) DEFAULT NULL COMMENT '描述',
  `order` int(100) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hot_categories
-- ----------------------------
INSERT INTO `hot_categories` VALUES ('1', '分类一', 'cate', '分类一描述', null);

-- ----------------------------
-- Table structure for hot_documents
-- ----------------------------
DROP TABLE IF EXISTS `hot_documents`;
CREATE TABLE `hot_documents` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档id',
  `cid` int(10) unsigned NOT NULL COMMENT '分类id',
  `title` varchar(200) NOT NULL COMMENT '内容标题',
  `slug` varchar(200) NOT NULL COMMENT '英文别名',
  `order` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `created` int(10) NOT NULL,
  `modified` int(10) DEFAULT NULL,
  `contents` text COMMENT '详细内容html',
  `authorid` int(10) DEFAULT NULL COMMENT '作者id',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '内容状态',
  `allowComment` char(1) NOT NULL DEFAULT '1' COMMENT '是否可评论',
  `views` int(10) NOT NULL DEFAULT '0' COMMENT '访问次数',
  PRIMARY KEY (`did`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hot_documents
-- ----------------------------
INSERT INTO `hot_documents` VALUES ('1', '1', '标题', 'one', '0', '1489912', '123123123', '内容内容内容内容内容内容<h1>标题测定事实上</h1>', null, '1', '1', '0');
INSERT INTO `hot_documents` VALUES ('2', '1', '你妹', 'ok', '0', '123123123', '1231231233', 'post内容post内容post内容post内容post内容post内容post内容post内容post内容post内容post内容post内容post内容', null, '1', '1', '0');

-- ----------------------------
-- Table structure for hot_links
-- ----------------------------
DROP TABLE IF EXISTS `hot_links`;
CREATE TABLE `hot_links` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '链接名',
  `url` varchar(200) NOT NULL COMMENT 'url地址',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hot_links
-- ----------------------------

-- ----------------------------
-- Table structure for hot_tags
-- ----------------------------
DROP TABLE IF EXISTS `hot_tags`;
CREATE TABLE `hot_tags` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '标签名',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hot_tags
-- ----------------------------

-- ----------------------------
-- Table structure for hot_tags_documents
-- ----------------------------
DROP TABLE IF EXISTS `hot_tags_documents`;
CREATE TABLE `hot_tags_documents` (
  `tid` int(10) unsigned NOT NULL COMMENT '标签id',
  `did` int(10) unsigned NOT NULL COMMENT '文档id',
  PRIMARY KEY (`tid`,`did`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hot_tags_documents
-- ----------------------------

-- ----------------------------
-- Table structure for hot_user
-- ----------------------------
DROP TABLE IF EXISTS `hot_user`;
CREATE TABLE `hot_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `created` int(10) NOT NULL COMMENT '创建时间',
  `lastlogin` int(10) NOT NULL COMMENT '上次登录时间',
  `lock` char(1) DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hot_user
-- ----------------------------
