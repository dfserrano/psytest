-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 31-05-2013 a las 12:06:23
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
-- Estructura de tabla para la tabla `slide_cref`
-- 

CREATE TABLE `slide_cref` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=25 ;

-- 
-- Volcar la base de datos para la tabla `slide_cref`
-- 

INSERT INTO `slide_cref` VALUES (1, 1, 1, 1, NULL, NULL, 0, 0, 3);
INSERT INTO `slide_cref` VALUES (2, 2, 1, 2, NULL, NULL, 0, 90, 0);
INSERT INTO `slide_cref` VALUES (3, 3, 1, 1, 100, 100, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (7, 0, 4, 1, 23, 45, 0, 0, 1);
INSERT INTO `slide_cref` VALUES (8, 1, 4, 1, NULL, NULL, 0, 51, 2);
INSERT INTO `slide_cref` VALUES (9, 2, 4, 1, NULL, NULL, 0, 0, 2);
INSERT INTO `slide_cref` VALUES (10, 0, 5, 8, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (11, 1, 5, 6, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (12, 2, 5, 10, NULL, NULL, 0, 0, 2);
INSERT INTO `slide_cref` VALUES (13, 3, 5, 1, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (14, 4, 5, 9, NULL, NULL, 0, 0, 2);
INSERT INTO `slide_cref` VALUES (15, 0, 6, 10, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (16, 1, 6, 6, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (17, 2, 6, 2, NULL, NULL, 0, 0, 2);
INSERT INTO `slide_cref` VALUES (18, 3, 6, 1, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (19, 4, 6, 9, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (20, 0, 7, 1, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (21, 1, 7, 3, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (22, 2, 7, 7, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (23, 3, 7, 6, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_cref` VALUES (24, 4, 7, 9, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `slide_timedcref`
-- 

CREATE TABLE `slide_timedcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `order` smallint(2) unsigned NOT NULL default '0',
  `test_fk` int(10) unsigned NOT NULL,
  `picture_fk` int(10) unsigned NOT NULL,
  `exposure` int(11) unsigned NOT NULL default '1000',
  `posx` int(4) default NULL,
  `posy` int(4) default NULL,
  `color` smallint(2) NOT NULL default '0',
  `rotation` smallint(3) NOT NULL default '0',
  `flip` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `slide_timedcref`
-- 

INSERT INTO `slide_timedcref` VALUES (1, 0, 1, 1, 1000, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_timedcref` VALUES (2, 1, 1, 5, 3000, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_timedcref` VALUES (3, 2, 1, 6, 5000, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_cref`
-- 

CREATE TABLE `test_cref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `exposure` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `test_cref`
-- 

INSERT INTO `test_cref` VALUES (1, 'Primera Prueba', '2013-05-15 15:33:23', 0, 3000);
INSERT INTO `test_cref` VALUES (4, 'XX', '2013-05-22 09:04:19', 1, 2000);
INSERT INTO `test_cref` VALUES (5, 'Diego', '2013-05-22 16:05:32', 0, 3000);
INSERT INTO `test_cref` VALUES (6, '3SECWPERT', '2013-05-23 09:32:31', 1, 3000);
INSERT INTO `test_cref` VALUES (7, 'CREF', '2013-05-29 12:53:45', 0, 4500);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_cref`
-- 

CREATE TABLE `test_result_cref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_fk` int(10) unsigned NOT NULL,
  `firstname` varchar(80) collate utf8_spanish2_ci NOT NULL,
  `lastname` varchar(80) collate utf8_spanish2_ci NOT NULL,
  `age` tinyint(2) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `docid` varchar(20) collate utf8_spanish2_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=12 ;

-- 
-- Volcar la base de datos para la tabla `test_result_cref`
-- 

INSERT INTO `test_result_cref` VALUES (6, 6, '', '', 0, '2013-05-28 16:20:29', '');
INSERT INTO `test_result_cref` VALUES (7, 6, '', '', 0, '2013-05-28 16:30:07', '');
INSERT INTO `test_result_cref` VALUES (8, 6, '', '', 0, '2013-05-29 09:00:44', '');
INSERT INTO `test_result_cref` VALUES (9, 6, '', '', 0, '2013-05-29 09:01:28', '');
INSERT INTO `test_result_cref` VALUES (10, 6, '', '', 0, '2013-05-29 12:35:02', '');
INSERT INTO `test_result_cref` VALUES (11, 7, '', '', 0, '2013-05-29 12:58:18', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_item_cref`
-- 

CREATE TABLE `test_result_item_cref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `pic_code` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=32 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_cref`
-- 

INSERT INTO `test_result_item_cref` VALUES (2, 6, 'MTNG18', 'ira', 'tristeza', 1027);
INSERT INTO `test_result_item_cref` VALUES (3, 6, 'HSP22', 'miedo', 'sorpresa', 428);
INSERT INTO `test_result_item_cref` VALUES (4, 6, 'HDNG11', 'sorpresa', 'asco', 651);
INSERT INTO `test_result_item_cref` VALUES (5, 6, 'MFP12', 'asco', 'alegria', 708);
INSERT INTO `test_result_item_cref` VALUES (6, 6, 'MRNG21', 'alegria', 'ira', 356);
INSERT INTO `test_result_item_cref` VALUES (7, 7, 'MTNG18', 'asco', 'tristeza', 644);
INSERT INTO `test_result_item_cref` VALUES (8, 7, 'HSP22', 'asco', 'sorpresa', 348);
INSERT INTO `test_result_item_cref` VALUES (9, 7, 'HDNG11', 'asco', 'asco', 371);
INSERT INTO `test_result_item_cref` VALUES (10, 7, 'MFP12', 'asco', 'alegria', 430);
INSERT INTO `test_result_item_cref` VALUES (11, 7, 'MRNG21', 'asco', 'ira', 420);
INSERT INTO `test_result_item_cref` VALUES (12, 8, 'MTNG18', 'miedo', 'tristeza', 2632);
INSERT INTO `test_result_item_cref` VALUES (13, 8, 'HSP22', 'sorpresa', 'sorpresa', 2644);
INSERT INTO `test_result_item_cref` VALUES (14, 8, 'HDNG11', 'asco', 'asco', 1644);
INSERT INTO `test_result_item_cref` VALUES (15, 8, 'MFP12', 'alegria', 'alegria', 1221);
INSERT INTO `test_result_item_cref` VALUES (16, 8, 'MRNG21', 'asco', 'ira', 2332);
INSERT INTO `test_result_item_cref` VALUES (17, 9, 'MTNG18', 'tristeza', 'tristeza', 3277);
INSERT INTO `test_result_item_cref` VALUES (18, 9, 'HSP22', 'miedo', 'sorpresa', 2228);
INSERT INTO `test_result_item_cref` VALUES (19, 9, 'HDNG11', 'asco', 'asco', 1484);
INSERT INTO `test_result_item_cref` VALUES (20, 9, 'MFP12', 'alegria', 'alegria', 1828);
INSERT INTO `test_result_item_cref` VALUES (21, 9, 'MRNG21', 'ira', 'ira', 2013);
INSERT INTO `test_result_item_cref` VALUES (22, 10, 'MTNG18', 'tristeza', 'tristeza', 9222);
INSERT INTO `test_result_item_cref` VALUES (23, 10, 'HSP22', 'sorpresa', 'sorpresa', 6963);
INSERT INTO `test_result_item_cref` VALUES (24, 10, 'HDNG11', 'asco', 'asco', 3164);
INSERT INTO `test_result_item_cref` VALUES (25, 10, 'MFP12', 'alegria', 'alegria', 1948);
INSERT INTO `test_result_item_cref` VALUES (26, 10, 'MRNG21', 'ira', 'ira', 4724);
INSERT INTO `test_result_item_cref` VALUES (27, 11, 'MFP12', 'alegria', 'alegria', 1406);
INSERT INTO `test_result_item_cref` VALUES (28, 11, 'HMNG13', 'sorpresa', 'miedo', 1558);
INSERT INTO `test_result_item_cref` VALUES (29, 11, 'MN14', 'neutra', 'neutra', 1412);
INSERT INTO `test_result_item_cref` VALUES (30, 11, 'HSP22', 'miedo', 'sorpresa', 2158);
INSERT INTO `test_result_item_cref` VALUES (31, 11, 'MRNG21', 'ira', 'ira', 2278);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_item_timedcref`
-- 

CREATE TABLE `test_result_item_timedcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `pic_code` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `actual_time` int(11) unsigned NOT NULL,
  `target_time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_timedcref`
-- 

INSERT INTO `test_result_item_timedcref` VALUES (1, 12, 'MFP12', 1452, 1000);
INSERT INTO `test_result_item_timedcref` VALUES (2, 12, 'HSP17', 942, 3000);
INSERT INTO `test_result_item_timedcref` VALUES (3, 12, 'HSP22', 4681, 5000);
INSERT INTO `test_result_item_timedcref` VALUES (4, 13, 'MFP12', 1177, 1000);
INSERT INTO `test_result_item_timedcref` VALUES (5, 13, 'HSP17', 2718, 3000);
INSERT INTO `test_result_item_timedcref` VALUES (6, 13, 'HSP22', 4687, 5000);
INSERT INTO `test_result_item_timedcref` VALUES (7, 14, 'MFP12', 863, 1000);
INSERT INTO `test_result_item_timedcref` VALUES (8, 14, 'HSP17', 5279, 3000);
INSERT INTO `test_result_item_timedcref` VALUES (9, 14, 'HSP22', 6430, 5000);
INSERT INTO `test_result_item_timedcref` VALUES (10, 15, 'MFP12', 1558, 1000);
INSERT INTO `test_result_item_timedcref` VALUES (11, 15, 'HSP17', 3531, 3000);
INSERT INTO `test_result_item_timedcref` VALUES (12, 15, 'HSP22', 5526, 5000);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_timedcref`
-- 

CREATE TABLE `test_result_timedcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_fk` int(10) unsigned NOT NULL,
  `firstname` varchar(80) collate utf8_spanish2_ci NOT NULL,
  `lastname` varchar(80) collate utf8_spanish2_ci NOT NULL,
  `age` tinyint(2) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `docid` varchar(20) collate utf8_spanish2_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=16 ;

-- 
-- Volcar la base de datos para la tabla `test_result_timedcref`
-- 

INSERT INTO `test_result_timedcref` VALUES (12, 1, '', '', 0, '2013-05-29 18:42:46', '');
INSERT INTO `test_result_timedcref` VALUES (13, 1, '', '', 0, '2013-05-29 18:43:41', '');
INSERT INTO `test_result_timedcref` VALUES (14, 1, '', '', 0, '2013-05-29 18:54:39', '');
INSERT INTO `test_result_timedcref` VALUES (15, 1, '', '', 0, '2013-05-29 19:02:16', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_timedcref`
-- 

CREATE TABLE `test_timedcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `test_timedcref`
-- 

INSERT INTO `test_timedcref` VALUES (1, 'CREF timed', '2013-05-29 16:25:37', 0);
