-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 23-05-2013 a las 18:29:17
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `psytest`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `picture`
-- 

CREATE TABLE `picture` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `path` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `code` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `emotion` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `width` int(5) unsigned NOT NULL default '0',
  `height` int(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `picture`
-- 

INSERT INTO `picture` VALUES (1, 'MFP122.jpg', 'MFP12', 'alegria', 88, 124);
INSERT INTO `picture` VALUES (2, 'HDNG111.jpg', 'HDNG11', 'asco', 93, 124);
INSERT INTO `picture` VALUES (3, 'HMNG13.jpg', 'HMNG13', 'miedo', 100, 123);
INSERT INTO `picture` VALUES (4, 'HSNG161.jpg', 'HSNG16', 'sorpresa', 95, 123);
INSERT INTO `picture` VALUES (5, 'HSP17.jpg', 'HSP17', 'sorpresa', 92, 124);
INSERT INTO `picture` VALUES (6, 'HSP22.jpg', 'HSP22', 'sorpresa', 91, 123);
INSERT INTO `picture` VALUES (7, 'MN14.jpg', 'MN14', 'neutra', 100, 124);
INSERT INTO `picture` VALUES (8, 'MRNG15.jpg', 'MRNG15', 'ira', 96, 123);
INSERT INTO `picture` VALUES (9, 'MRNG21.jpg', 'MRNG21', 'ira', 98, 124);
INSERT INTO `picture` VALUES (10, 'MTNG181.jpg', 'MTNG18', 'tristeza', 90, 123);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `slide`
-- 

CREATE TABLE `slide` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `order` smallint(2) unsigned NOT NULL default '0',
  `test_fk` int(10) unsigned NOT NULL,
  `picture_fk` int(10) unsigned NOT NULL,
  `posx` int(4) default NULL,
  `posy` int(4) default NULL,
  `color` smallint(2) NOT NULL default '0',
  `rotation` smallint(3) NOT NULL default '0',
  `flip` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=20 ;

-- 
-- Volcar la base de datos para la tabla `slide`
-- 

INSERT INTO `slide` VALUES (1, 1, 1, 1, NULL, NULL, 0, 0, 3);
INSERT INTO `slide` VALUES (2, 2, 1, 2, NULL, NULL, 0, 90, 0);
INSERT INTO `slide` VALUES (3, 3, 1, 1, 100, 100, 0, 0, 0);
INSERT INTO `slide` VALUES (7, 0, 4, 1, 23, 45, 0, 0, 1);
INSERT INTO `slide` VALUES (8, 1, 4, 1, NULL, NULL, 0, 51, 2);
INSERT INTO `slide` VALUES (9, 2, 4, 1, NULL, NULL, 0, 0, 2);
INSERT INTO `slide` VALUES (10, 0, 5, 8, NULL, NULL, 0, 0, 0);
INSERT INTO `slide` VALUES (11, 1, 5, 6, NULL, NULL, 0, 0, 0);
INSERT INTO `slide` VALUES (12, 2, 5, 10, NULL, NULL, 0, 0, 2);
INSERT INTO `slide` VALUES (13, 3, 5, 1, NULL, NULL, 0, 0, 0);
INSERT INTO `slide` VALUES (14, 4, 5, 9, NULL, NULL, 0, 0, 2);
INSERT INTO `slide` VALUES (15, 0, 6, 10, NULL, NULL, 0, 0, 0);
INSERT INTO `slide` VALUES (16, 1, 6, 6, NULL, NULL, 0, 0, 0);
INSERT INTO `slide` VALUES (17, 2, 6, 2, NULL, NULL, 0, 0, 2);
INSERT INTO `slide` VALUES (18, 3, 6, 1, NULL, NULL, 0, 0, 0);
INSERT INTO `slide` VALUES (19, 4, 6, 9, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test`
-- 

CREATE TABLE `test` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `exposure` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `test`
-- 

INSERT INTO `test` VALUES (1, 'Primera Prueba', '2013-05-15 15:33:23', 0, 3000);
INSERT INTO `test` VALUES (4, 'XX', '2013-05-22 09:04:19', 1, 2000);
INSERT INTO `test` VALUES (5, 'Diego', '2013-05-22 16:05:32', 0, 3000);
INSERT INTO `test` VALUES (6, '3SECWPERT', '2013-05-23 09:32:31', 1, 3000);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result`
-- 

CREATE TABLE `test_result` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_fk` int(10) unsigned NOT NULL,
  `firstname` varchar(80) collate utf8_spanish2_ci NOT NULL,
  `lastname` varchar(80) collate utf8_spanish2_ci NOT NULL,
  `age` tinyint(2) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `docid` varchar(20) collate utf8_spanish2_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_item`
-- 

CREATE TABLE `test_result_item` (
  `id` int(10) unsigned NOT NULL,
  `test_result_fk` int(11) NOT NULL,
  `pic_code` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- 
-- Volcar la base de datos para la tabla `test_result_item`
-- 

