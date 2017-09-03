/*
Navicat MySQL Data Transfer

Source Server         : 阿里云
Source Server Version : 50635
Source Host           : 120.77.36.182:3306
Source Database       : basic

Target Server Type    : MYSQL
Target Server Version : 50635
File Encoding         : 65001

Date: 2017-09-03 12:38:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bas_project`
-- ----------------------------
DROP TABLE IF EXISTS `bas_project`;
CREATE TABLE `bas_project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bas_project
-- ----------------------------
INSERT INTO `bas_project` VALUES ('1', 'voidking-title', 'voidking-content');
