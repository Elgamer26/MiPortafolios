/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31)
 Source Host           : localhost:3306
 Source Schema         : miportafolio

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31)
 File Encoding         : 65001

 Date: 02/07/2023 11:30:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lenguaje
-- ----------------------------
DROP TABLE IF EXISTS `lenguaje`;
CREATE TABLE `lenguaje`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lenguaje
-- ----------------------------
INSERT INTO `lenguaje` VALUES (1, 'PHP', 'IMG2842023232332.jpg', 1);
INSERT INTO `lenguaje` VALUES (2, 'PYTHON', 'IMG2632023144641.png', 1);
INSERT INTO `lenguaje` VALUES (3, 'C#', 'IMG2632023151233.png', 1);
INSERT INTO `lenguaje` VALUES (4, 'VISUAL BASIC', 'IMG2632023151212.png', 1);

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `apellidois` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `telefono` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `pais` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `profesion` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `sobremi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `foto` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `hojavida` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES (1, 'JORGE MOISES', 'RAMIREZ ZAVALA', 'ELGAMER-26@HOTMAIL.COM', '0985906677', 'ECUADOR', 'GUAYAS - MILAGRO - AV. AMAZONAS', 'INGENIERO EN SISTEMAS', 'DESARROLLADOR DE SISTEMAS ', 'IMG2632023183130.png', 'PDF2632023182454.pdf');

-- ----------------------------
-- Table structure for proyectos
-- ----------------------------
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `tipo_des` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `idlenguaje` int NULL DEFAULT NULL,
  `idtecnologia` int NULL DEFAULT NULL,
  `id_tipo_proyecto` int NULL DEFAULT NULL,
  `fecha_proyecto` date NULL DEFAULT NULL,
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idlenguaje`(`idlenguaje` ASC) USING BTREE,
  INDEX `idtecnologia`(`idtecnologia` ASC) USING BTREE,
  INDEX `id_tipo_proyecto`(`id_tipo_proyecto` ASC) USING BTREE,
  CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`idlenguaje`) REFERENCES `lenguaje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`idtecnologia`) REFERENCES `tecnologia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proyectos_ibfk_3` FOREIGN KEY (`id_tipo_proyecto`) REFERENCES `tipo_proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyectos
-- ----------------------------
INSERT INTO `proyectos` VALUES (9, 'PROYECTO WEB', 100.00, 0.00, 'no', 1, 2, 1, '2023-03-27', 'ES UN PROYECTO WEB DE REGISTRO', '2023-04-07 22:17:23', 1);
INSERT INTO `proyectos` VALUES (10, 'PROYECTO DE OPTICA TESIS', 50.00, 5.00, 'procentaje', 2, 1, 3, '2023-01-01', 'ES UN PROYECTO QUE SE REALIZO PARA UNA TESIS', '2023-04-07 23:28:03', 1);
INSERT INTO `proyectos` VALUES (11, 'aaaabbbb', 100.00, 50.00, 'moneda', 3, 4, 1, '2023-02-01', 'es de todo un poco', '2023-04-07 23:47:01', 1);
INSERT INTO `proyectos` VALUES (12, 'asasas', 22.00, 232.00, 'procentaje', 4, 4, 3, '2023-07-05', 'asasas', '2023-07-01 08:25:42', 1);

-- ----------------------------
-- Table structure for proyectos_imagen
-- ----------------------------
DROP TABLE IF EXISTS `proyectos_imagen`;
CREATE TABLE `proyectos_imagen`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_proyecto` int NULL DEFAULT NULL,
  `foto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_proyecto`(`id_proyecto` ASC) USING BTREE,
  CONSTRAINT `proyectos_imagen_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyectos_imagen
-- ----------------------------
INSERT INTO `proyectos_imagen` VALUES (21, 9, '5860d1c41d77b26fe4190e1c20c61b13ac59046316809238431.png');
INSERT INTO `proyectos_imagen` VALUES (23, 10, '35908150fa7ab691a8182f7c8bed28f371d71e9916809280830.jpg');
INSERT INTO `proyectos_imagen` VALUES (24, 10, 'fdce50ba69d758497added7619851dcd96a579a216809280831.png');
INSERT INTO `proyectos_imagen` VALUES (27, 11, 'dc527ef92b2fb4970bd74a85cff5784df33a3eb616809292212.jpg');
INSERT INTO `proyectos_imagen` VALUES (33, 11, 'dc527ef92b2fb4970bd74a85cff5784df33a3eb616882179130.jpg');
INSERT INTO `proyectos_imagen` VALUES (34, 12, 'abebb35f53fea37f388964bff47ed169be03140416882179420.jpg');
INSERT INTO `proyectos_imagen` VALUES (35, 12, '35908150fa7ab691a8182f7c8bed28f371d71e9916882179421.jpg');
INSERT INTO `proyectos_imagen` VALUES (36, 12, 'dc527ef92b2fb4970bd74a85cff5784df33a3eb616882179422.jpg');
INSERT INTO `proyectos_imagen` VALUES (37, 12, 'c974283113c800c5ba03363d8bda875e0a28ecde16882179423.jpg');
INSERT INTO `proyectos_imagen` VALUES (38, 12, 'a0e863f44d426e899b1f0ba272c6d2d5dac90ccd16882179424.jpg');

-- ----------------------------
-- Table structure for tecnologia
-- ----------------------------
DROP TABLE IF EXISTS `tecnologia`;
CREATE TABLE `tecnologia`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tecnologia
-- ----------------------------
INSERT INTO `tecnologia` VALUES (1, 'FLASK', 'IMG2632023152448.png', 1);
INSERT INTO `tecnologia` VALUES (2, 'CODEIGNITER 4', 'IMG2632023154754.png', 1);
INSERT INTO `tecnologia` VALUES (3, 'DJANGO', 'IMG2632023154839.png', 1);
INSERT INTO `tecnologia` VALUES (4, 'REACT', 'IMG2632023154855.jpeg', 1);

-- ----------------------------
-- Table structure for tipo_proyecto
-- ----------------------------
DROP TABLE IF EXISTS `tipo_proyecto`;
CREATE TABLE `tipo_proyecto`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_proyecto
-- ----------------------------
INSERT INTO `tipo_proyecto` VALUES (1, 'SISTEMA WEB', 1);
INSERT INTO `tipo_proyecto` VALUES (2, 'APP EDITADO', 1);
INSERT INTO `tipo_proyecto` VALUES (3, 'SISTEMA DE ESCRITORIO', 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `passwordd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'NUEVO USUARIO CREAOD', 'elgamer-26@hotmail.com', 'admin', '123', 'IMG26320230345.png', 1, '2023-03-25 22:02:46');
INSERT INTO `usuario` VALUES (2, 'JORGE MOISES RAMIREZ ZAVALA', 'wee26@hotmail.com', 'Elgamer26', '0xPxNnOl2g', 'IMG2842023232316.jpg', 1, '2023-03-25 22:31:14');
INSERT INTO `usuario` VALUES (3, 'NUSUARIO EDITADOasas', '123lgaaamer-26@hotmail.com', 'aaaaa12345', 'Elagmer26aa', 'IMG284202323239.jpg', 1, '2023-03-25 22:32:24');

SET FOREIGN_KEY_CHECKS = 1;
