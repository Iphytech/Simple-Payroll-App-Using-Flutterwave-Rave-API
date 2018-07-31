/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100124
Source Host           : localhost:3306
Source Database       : rave

Target Server Type    : MYSQL
Target Server Version : 100124
File Encoding         : 65001

Date: 2018-07-31 10:52:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for groupmembers
-- ----------------------------
DROP TABLE IF EXISTS `groupmembers`;
CREATE TABLE `groupmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) DEFAULT NULL,
  `staffname` varchar(255) DEFAULT NULL,
  `staffbank` varchar(255) DEFAULT NULL,
  `staffacctno` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groupmembers
-- ----------------------------
INSERT INTO `groupmembers` VALUES ('1', '1', 'Ezejiugo Emmanuel Chigbo', '044', '0020176170', '3000');
INSERT INTO `groupmembers` VALUES ('2', '1', 'Ezejiugo Emmanuel Chigbo', '063', '0031823879', '3000');
INSERT INTO `groupmembers` VALUES ('3', '1', 'Seamaco Technologies', '033', '2094713437', '15000');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) DEFAULT NULL,
  `groupdesc` text,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Company Cleaners', 'For cleaners in the company', '3');
INSERT INTO `groups` VALUES ('2', 'Another Group', 'Another Description', '3');

-- ----------------------------
-- Table structure for userdetails
-- ----------------------------
DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `walletamount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of userdetails
-- ----------------------------
INSERT INTO `userdetails` VALUES ('3', 'John Doe', 'user', 'password1', '66000');
