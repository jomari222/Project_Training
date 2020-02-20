/*
 Navicat Premium Data Transfer

 Source Server         : Assessment
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : login_db

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 14/01/2020 13:14:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tblemployee
-- ----------------------------
DROP TABLE IF EXISTS `tblemployee`;
CREATE TABLE `tblemployee`  (
  `fEmployeeID` smallint(5) NOT NULL AUTO_INCREMENT,
  `fFirstname` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fLastname` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fGender` tinyint(1) NOT NULL,
  `fPosition` tinyint(3) NOT NULL,
  `fStatus` tinyint(1) UNSIGNED NOT NULL,
  `fStamp` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`fEmployeeID`) USING BTREE,
  UNIQUE INDEX `FullName`(`fFirstname`, `fLastname`) USING BTREE,
  INDEX `fPosition`(`fPosition`) USING BTREE,
  CONSTRAINT `fk_EmployeeID_tbluser` FOREIGN KEY (`fEmployeeID`) REFERENCES `tbluser` (`fEmployeeID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Position_tblempposition` FOREIGN KEY (`fPosition`) REFERENCES `tblempposition` (`fID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tblemployee
-- ----------------------------
INSERT INTO `tblemployee` VALUES (1, 'JOMARI', 'GARCIA', 1, 1, 1, '2020-01-09 16:56:21');
INSERT INTO `tblemployee` VALUES (2, 'GARCIA', 'JOMARI', 1, 2, 1, '2020-01-09 16:56:28');
INSERT INTO `tblemployee` VALUES (3, 'MARIA ERNALYN', 'SUCTE', 0, 1, 1, '2020-01-12 19:01:44');
INSERT INTO `tblemployee` VALUES (4, 'JOHN', 'REYES', 1, 2, 1, '2020-01-09 16:56:42');
INSERT INTO `tblemployee` VALUES (5, 'JOBERT', 'LUBRIN', 1, 2, 1, '2020-01-11 13:17:13');
INSERT INTO `tblemployee` VALUES (6, 'FREDERICK', 'AMAWAN', 1, 2, 1, '2020-01-09 16:56:58');
INSERT INTO `tblemployee` VALUES (7, 'JOMAR', 'CHIDAY', 1, 2, 1, '2020-01-09 16:58:07');
INSERT INTO `tblemployee` VALUES (8, 'OTHNEIL JAN', 'DOMINE', 1, 2, 1, '2020-01-12 20:03:41');
INSERT INTO `tblemployee` VALUES (9, 'JEANROSS', 'GANO', 1, 2, 1, '2020-01-09 16:57:21');
INSERT INTO `tblemployee` VALUES (10, 'JASON', 'SILVER', 1, 2, 1, '2020-01-12 20:04:41');
INSERT INTO `tblemployee` VALUES (11, 'DELTA', 'ALPHA', 1, 2, 1, '2020-01-09 16:57:35');
INSERT INTO `tblemployee` VALUES (12, 'STEPHEN OLIVER', 'SARMIENTO', 1, 2, 1, '2020-01-12 14:55:24');
INSERT INTO `tblemployee` VALUES (13, 'KYLE', 'ESCAPE', 1, 2, 1, '2020-01-09 16:58:52');
INSERT INTO `tblemployee` VALUES (14, 'JAYSON', 'MANLONGAT', 1, 2, 1, '2020-01-09 17:03:37');
INSERT INTO `tblemployee` VALUES (15, 'JERICHO', 'SAMSON', 1, 2, 1, '2020-01-09 17:04:12');
INSERT INTO `tblemployee` VALUES (16, 'JOHAN REI', 'PAJARILLO', 1, 1, 1, '2020-01-12 20:04:56');
INSERT INTO `tblemployee` VALUES (17, 'JOHN KENNETH', 'DELA CRUZ', 1, 2, 1, '2020-01-09 21:09:45');
INSERT INTO `tblemployee` VALUES (18, 'GLENN FORD', 'BACGALANG', 1, 2, 1, '2020-01-11 09:47:58');
INSERT INTO `tblemployee` VALUES (19, 'JAMES ROSS', 'ESTRADA', 1, 2, 1, '2020-01-12 14:56:46');
INSERT INTO `tblemployee` VALUES (20, 'ZALDY JAMES', 'BAGTUNA', 1, 2, 1, '2020-01-12 14:57:21');
INSERT INTO `tblemployee` VALUES (21, 'BRIAN', 'CALUMINGA', 1, 2, 1, '2020-01-12 14:59:10');
INSERT INTO `tblemployee` VALUES (22, 'JOANA MARIE', 'PAJARILLO', 0, 1, 1, '2020-01-12 20:02:18');
INSERT INTO `tblemployee` VALUES (23, 'JESSICA MAE', 'GARCIA', 0, 1, 1, '2020-01-12 20:02:58');
INSERT INTO `tblemployee` VALUES (24, 'MONA', 'SUDARA', 0, 2, 1, '2020-01-14 13:12:44');

-- ----------------------------
-- Table structure for tblempposition
-- ----------------------------
DROP TABLE IF EXISTS `tblempposition`;
CREATE TABLE `tblempposition`  (
  `fID` tinyint(3) NOT NULL,
  `fPosition` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`fID`) USING BTREE,
  INDEX `fPosition`(`fPosition`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tblempposition
-- ----------------------------
INSERT INTO `tblempposition` VALUES (1, 'Administrator');
INSERT INTO `tblempposition` VALUES (2, 'Employee');

-- ----------------------------
-- Table structure for tbluser
-- ----------------------------
DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE `tbluser`  (
  `fEmployeeID` smallint(5) NOT NULL,
  `fUsername` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fPassword` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`fEmployeeID`) USING BTREE,
  UNIQUE INDEX `Username`(`fUsername`) USING BTREE,
  INDEX `fEmployeeID`(`fEmployeeID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbluser
-- ----------------------------
INSERT INTO `tbluser` VALUES (1, 'admin', '$2y$10$BUn5F1znNOmJFBpbV.R34u8ymUkXFWUUKmEufwczEz4MtHpOpycN2');
INSERT INTO `tbluser` VALUES (2, 'Jomari', '$2y$10$ZjYQzxAm01QX8fjTx4FYf.wAjbMT86Hgs70mgzfV6knr6.OkM4Uw6');
INSERT INTO `tbluser` VALUES (3, 'Maria', '$2y$10$sp/GO4QzVzLdAetnDjsZ3OKFotn7k84QJ7VLohpV4EGLlt4/5wPoW');
INSERT INTO `tbluser` VALUES (4, 'John', '$2y$10$ALDXYwg7kxfqI4/js.AM8.5bfPkQSBwAFY4b9T5xHqHCVK/mMlkOS');
INSERT INTO `tbluser` VALUES (5, 'Jobert', '$2y$10$KdmaFaOCL7xzx47EUhPksu0W.OoS4qkHPg77rq58WGw96LCDXceFK');
INSERT INTO `tbluser` VALUES (6, 'Fred001', '$2y$10$.BD/NIkCG8J9u1znayP1iu8dMr9lThpFR6b5Bq13KExLIN120ky4W');
INSERT INTO `tbluser` VALUES (7, 'Jomar222', '$2y$10$EwKbcoeFxHwOJUpmgYEu0.42vf2PGr4z/.c4/H1lMzihfSU814fQ.');
INSERT INTO `tbluser` VALUES (8, 'Othneil02', '$2y$10$9wyZZKJSpdZfImvYfUArRezyw5kwaZATWLFtrJ5QZpSPwuzj7b272');
INSERT INTO `tbluser` VALUES (9, 'Jean123', '$2y$10$Aek2a/ZFH7fiRjuwOteUdeyWIC5zQoSnJZe8ZWUw97twiuNO4UKR6');
INSERT INTO `tbluser` VALUES (10, 'silver', '$2y$10$v1aa3rVDDNzAOZeR.BUuHu1ZJ5exJwZ/UOnyrtVfg6kxKvGfthAGq');
INSERT INTO `tbluser` VALUES (11, 'Delta', '$2y$10$QFEI1mlCk4vwSkm8OfmWMO/pbhwLEQfJGi.ztL2C30LUHw52yioy2');
INSERT INTO `tbluser` VALUES (12, 'stephen', '$2y$10$lRgqmwJBawhEMepClV/4SeczPAAY6wRcmMI7pMAcHOb478jfPiuk.');
INSERT INTO `tbluser` VALUES (13, 'kyle01', '$2y$10$KX1BTpFrz5GjN7L/Q3COeOTcQbPSBDTaZ//nLMfro0oNeV7/yMBsO');
INSERT INTO `tbluser` VALUES (14, 'jason', '$2y$10$ZrNYB.LfzFpYBktG892iUebthTFfm9wIcH1XB2Ru7kTCd3V/xjOyi');
INSERT INTO `tbluser` VALUES (15, 'sams', '$2y$10$eGhW/8NyMq0E92khL8aveuwZ0bix4sRu82cwXS6Iah6qMuDDHEL7i');
INSERT INTO `tbluser` VALUES (16, 'johan', '$2y$10$bkJ90CjYi9Sridj8nYgCluA6qeCxAs4jT0EP9ZC.Xjd5WULbAH0VG');
INSERT INTO `tbluser` VALUES (17, 'kenneth', '$2y$10$KZyfwOalcgiTpzIrPSXoMu3kI1mxb8PPqzxR9O3aEgOMr6lx5Gad6');
INSERT INTO `tbluser` VALUES (18, 'Glesd_', '$2y$10$BlS2a3yYryXVATGSFvwyDuBBAZhOXbAyuoGYUrqSKSQV0APkCbDyS');
INSERT INTO `tbluser` VALUES (19, 'james_26', '$2y$10$vAtHV2CYXG4Dww/VDfXzDOW5V6MRkChlhhGV2u3TE9w7pk2VQVL4S');
INSERT INTO `tbluser` VALUES (20, 'Zalds', '$2y$10$F4sYxHwQAeDUEIzp1rVLvuqFc2k8VC6b9oPruKJnpdcJ7uku4II8S');
INSERT INTO `tbluser` VALUES (21, 'calum_G', '$2y$10$/pf4Idm6htXXASBUbOWlyOatPamlHHyiNr04vc0KUvjVPr1JwH7U6');
INSERT INTO `tbluser` VALUES (22, 'joman', '$2y$10$SXH.DIOZWsXvtUaBS0lxTOyRiWqAbmiDjmX/H5tJpoQFI9d8iuKie');
INSERT INTO `tbluser` VALUES (23, 'jessica', '$2y$10$1bMQ7318XMHXjghaw2jJTOtUTzhvkXQTGjSGFsnG3tf1samFVuCcu');
INSERT INTO `tbluser` VALUES (24, 'mona', '$2y$10$K233JPfAfKVDPCvwqBXIuunTp.iztvAStw9WyJPBPJGQIkTgqXJw6');

SET FOREIGN_KEY_CHECKS = 1;
