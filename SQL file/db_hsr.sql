/*
Navicat MySQL Data Transfer

Source Server         : koneksi01
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_hsr

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-04 15:59:18
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `element`
-- ----------------------------
DROP TABLE IF EXISTS `element`;
CREATE TABLE `element` (
  `id_element` int(11) NOT NULL AUTO_INCREMENT,
  `nama_element` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_element`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of element
-- ----------------------------
INSERT INTO `element` VALUES ('1', 'Physical');
INSERT INTO `element` VALUES ('2', 'Fire');
INSERT INTO `element` VALUES ('3', 'Ice');
INSERT INTO `element` VALUES ('4', 'Lightning');
INSERT INTO `element` VALUES ('5', 'Wind');
INSERT INTO `element` VALUES ('6', 'Quantum');

-- ----------------------------
-- Table structure for `karakter`
-- ----------------------------
DROP TABLE IF EXISTS `karakter`;
CREATE TABLE `karakter` (
  `id_karakter` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `id_path` int(11) DEFAULT NULL,
  `id_element` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_karakter`),
  KEY `id_path` (`id_path`),
  KEY `id_element` (`id_element`),
  CONSTRAINT `id_element` FOREIGN KEY (`id_element`) REFERENCES `element` (`id_element`),
  CONSTRAINT `id_path` FOREIGN KEY (`id_path`) REFERENCES `path` (`id_path`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of karakter
-- ----------------------------
INSERT INTO `karakter` VALUES ('1', 'kafka.png', 'Kafka', 'Wanita', '168', '5', '4');
INSERT INTO `karakter` VALUES ('2', 'jingliu.png', 'Jingliu', 'Wanita', '165', '1', '3');
INSERT INTO `karakter` VALUES ('3', 'gepard.png', 'Gepard', 'Pria', '191', '6', '3');
INSERT INTO `karakter` VALUES ('4', 'blackswan.png', 'Black Swan', 'Wanita', '173', '5', '5');
INSERT INTO `karakter` VALUES ('5', 'topaz.png', 'Topaz & Numby', 'Wanita', '165', '2', '2');
INSERT INTO `karakter` VALUES ('6', 'argenti.png', 'Argenti', 'Pria', '180', '3', '1');
INSERT INTO `karakter` VALUES ('7', 'sparkle.png', 'Sparkle', 'Wanita', '139', '4', '6');
INSERT INTO `karakter` VALUES ('8', 'acheron.png', 'Acheron', 'Wanita', '173', '5', '4');

-- ----------------------------
-- Table structure for `path`
-- ----------------------------
DROP TABLE IF EXISTS `path`;
CREATE TABLE `path` (
  `id_path` int(11) NOT NULL AUTO_INCREMENT,
  `nama_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_path`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of path
-- ----------------------------
INSERT INTO `path` VALUES ('1', 'Destruction');
INSERT INTO `path` VALUES ('2', 'The Hunt');
INSERT INTO `path` VALUES ('3', 'Erudition');
INSERT INTO `path` VALUES ('4', 'Harmony');
INSERT INTO `path` VALUES ('5', 'Nihility');
INSERT INTO `path` VALUES ('6', 'Preservation');
