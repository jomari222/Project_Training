/*
 Navicat Premium Data Transfer

 Source Server         : Assessment
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : jomari

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 24/01/2020 15:22:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account`  (
  `account_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `activation_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `registration_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `member_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`account_id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE,
  CONSTRAINT `fk_member_id_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for fund
-- ----------------------------
DROP TABLE IF EXISTS `fund`;
CREATE TABLE `fund`  (
  `member_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `peso_wallet` smallint(5) NOT NULL,
  `voucher_points` tinyint(3) NOT NULL,
  PRIMARY KEY (`member_id`) USING BTREE,
  CONSTRAINT `fk_member_id_fund` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `member_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(13) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `first_name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_name` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
