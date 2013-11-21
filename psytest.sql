-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 21-11-2013 a las 14:49:36
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=92 ;

-- 
-- Volcar la base de datos para la tabla `picture`
-- 

INSERT INTO `picture` VALUES (1, 'MFP12.jpg', 'MFP12', 'alegria', 88, 124);
INSERT INTO `picture` VALUES (2, 'HDNG11.jpg', 'HDNG11', 'asco', 93, 124);
INSERT INTO `picture` VALUES (3, 'HMNG13.jpg', 'HMNG13', 'miedo', 100, 123);
INSERT INTO `picture` VALUES (4, 'HSNG16.jpg', 'HSNG16', 'sorpresa', 95, 123);
INSERT INTO `picture` VALUES (5, 'HSP17.jpg', 'HSP17', 'sorpresa', 92, 124);
INSERT INTO `picture` VALUES (6, 'HSP22.jpg', 'HSP22', 'sorpresa', 91, 123);
INSERT INTO `picture` VALUES (7, 'MN14.jpg', 'MN14', 'neutra', 100, 124);
INSERT INTO `picture` VALUES (8, 'MRNG15.jpg', 'MRNG15', 'ira', 96, 123);
INSERT INTO `picture` VALUES (9, 'MRNG21.jpg', 'MRNG21', 'ira', 98, 124);
INSERT INTO `picture` VALUES (10, 'MTNG181.jpg', 'MTNG18', 'tristeza', 90, 123);
INSERT INTO `picture` VALUES (11, 'HMNG24.jpg', 'HMNG24', 'miedo', 101, 141);
INSERT INTO `picture` VALUES (13, 'HDNG971.jpg', 'HDNG97', 'asco', 105, 141);
INSERT INTO `picture` VALUES (14, 'HFP71.jpg', 'HFP71', 'alegria', 105, 140);
INSERT INTO `picture` VALUES (15, 'HFP106.jpg', 'HFP106', 'alegria', 117, 141);
INSERT INTO `picture` VALUES (16, 'HFP117.jpg', 'HFP117', 'alegria', 104, 141);
INSERT INTO `picture` VALUES (17, 'HMNG66.jpg', 'HMNG66', 'miedo', 105, 141);
INSERT INTO `picture` VALUES (18, 'HN65.jpg', 'HN65', 'neutra', 113, 141);
INSERT INTO `picture` VALUES (19, 'HN92.jpg', 'HN92', 'neutra', 109, 141);
INSERT INTO `picture` VALUES (20, 'HRNG41.jpg', 'HRNG41', 'ira', 107, 141);
INSERT INTO `picture` VALUES (21, 'HRNG94.jpg', 'HRNG94', 'ira', 115, 141);
INSERT INTO `picture` VALUES (22, 'MN48.jpg', 'MN48', 'neutra', 103, 141);
INSERT INTO `picture` VALUES (23, 'HSNG98.jpg', 'HSNG98', 'sorpresa', 108, 141);
INSERT INTO `picture` VALUES (24, 'HSP31.jpg', 'HSP31', 'sorpresa', 110, 141);
INSERT INTO `picture` VALUES (25, 'MFP58.jpg', 'MFP58', 'alegria', 112, 141);
INSERT INTO `picture` VALUES (26, 'HTNG26.jpg', 'HTNG26', 'tristeza', 115, 141);
INSERT INTO `picture` VALUES (27, 'HTNG56.jpg', 'HTNG56', 'tristeza', 109, 141);
INSERT INTO `picture` VALUES (28, 'MTNG181.jpg', 'MTNG18', 'tristeza', 103, 141);
INSERT INTO `picture` VALUES (29, 'MTNG96.jpg', 'MTNG96', 'tristeza', 113, 141);
INSERT INTO `picture` VALUES (30, 'MDNG42.jpg', 'MDNG42', 'asco', 107, 141);
INSERT INTO `picture` VALUES (31, 'MDNG112.jpg', 'MDNG112', 'asco', 111, 141);
INSERT INTO `picture` VALUES (32, 'MRNG55.jpg', 'MRNG55', 'ira', 107, 141);
INSERT INTO `picture` VALUES (33, 'MSNG25.jpg', 'MSNG25', 'sorpresa', 99, 141);
INSERT INTO `picture` VALUES (34, 'MSP105.jpg', 'MSP105', 'sorpresa', 108, 141);
INSERT INTO `picture` VALUES (35, 'MMNG88.jpg', 'MMN88', 'miedo', 98, 141);
INSERT INTO `picture` VALUES (36, 'MMNG107.jpg', 'MMNG107', 'miedo', 118, 141);
INSERT INTO `picture` VALUES (37, 'HDNG34.jpg', 'HDNG34', 'asco', 117, 141);
INSERT INTO `picture` VALUES (38, 'HTNG32.jpg', 'HTNG32', 'tristeza', 117, 141);
INSERT INTO `picture` VALUES (39, 'MDNG23.jpg', 'MDNG23', 'asco', 122, 141);
INSERT INTO `picture` VALUES (40, 'MFP27.jpg', 'MFP27', 'alegria', 112, 141);
INSERT INTO `picture` VALUES (41, 'MN28.jpg', 'MN28', 'neutra', 104, 141);
INSERT INTO `picture` VALUES (42, 'MRNG33.jpg', 'MRNG33', 'ira', 101, 141);
INSERT INTO `picture` VALUES (43, 'HFP45.jpg', 'HFP45', 'alegria', 104, 141);
INSERT INTO `picture` VALUES (44, 'HMNG37.jpg', 'HMNG37', 'miedo', 104, 141);
INSERT INTO `picture` VALUES (45, 'HMNG44.jpg', 'HMNG44', 'miedo', 114, 141);
INSERT INTO `picture` VALUES (46, 'HSP43.jpg', 'HSP43', 'sorpresa', 110, 141);
INSERT INTO `picture` VALUES (47, 'MFP35.jpg', 'MFP35', 'alegria', 101, 141);
INSERT INTO `picture` VALUES (48, 'MN36.jpg', 'MN36', 'neutra', 102, 141);
INSERT INTO `picture` VALUES (49, 'MSNG38.jpg', 'MSNG38', 'sorpresa', 121, 141);
INSERT INTO `picture` VALUES (50, 'MTNG46.jpg', 'MTNG46', 'tristeza', 114, 141);
INSERT INTO `picture` VALUES (51, 'HDNG53.jpg', 'HDNG53', 'asco', 101, 141);
INSERT INTO `picture` VALUES (52, 'HN51.jpg', 'HN51', 'neutra', 113, 141);
INSERT INTO `picture` VALUES (53, 'MMNG52.jpg', 'MMNG52', 'miedo', 106, 141);
INSERT INTO `picture` VALUES (54, 'MSNG47.jpg', 'MSNG47', 'sorpresa', 108, 141);
INSERT INTO `picture` VALUES (55, 'MSNG54.png', 'MSNG54', 'sorpresa', 99, 141);
INSERT INTO `picture` VALUES (56, 'MSP57.jpg', 'MSP57', 'sorpresa', 103, 141);
INSERT INTO `picture` VALUES (57, 'HDNG68.jpg', 'HDNG68', 'asco', 107, 141);
INSERT INTO `picture` VALUES (58, 'MDNG72.jpg', 'MDNG72', 'asco', 101, 141);
INSERT INTO `picture` VALUES (59, 'MFP62.jpg', 'MFP62', 'alegria', 101, 141);
INSERT INTO `picture` VALUES (60, 'MRNG67.jpg', 'MRNG67', 'ira', 109, 141);
INSERT INTO `picture` VALUES (61, 'MSNG61.jpg', 'MSNG61', 'sorpresa', 101, 141);
INSERT INTO `picture` VALUES (62, 'MSP64.jpg', 'MSP64', 'sorpresa', 120, 141);
INSERT INTO `picture` VALUES (63, 'MTNG63.jpg', 'MTNG63', 'tristeza', 102, 141);
INSERT INTO `picture` VALUES (64, 'HFP86.jpg', 'HFP86', 'alegria', 108, 141);
INSERT INTO `picture` VALUES (65, 'HN77.jpg', 'HN77', 'neutra', 103, 141);
INSERT INTO `picture` VALUES (66, 'HN101.jpg', 'HN101', 'neutra', 107, 141);
INSERT INTO `picture` VALUES (67, 'MN85.jpg', 'MN85', 'neutra', 109, 141);
INSERT INTO `picture` VALUES (68, 'MN115.jpg', 'MN115', 'neutra', 121, 141);
INSERT INTO `picture` VALUES (69, 'HRNG82.jpg', 'HRNG82', 'ira', 100, 141);
INSERT INTO `picture` VALUES (70, 'HRNG103.jpg', 'HRNG103', 'ira', 101, 141);
INSERT INTO `picture` VALUES (71, 'HRNG116.jpg', 'HRNG116', 'ira', 110, 141);
INSERT INTO `picture` VALUES (72, 'HSNG73.jpg', 'HSNG73', 'sorpresa', 104, 141);
INSERT INTO `picture` VALUES (73, 'HSNG81.jpg', 'HSNG81', 'sorpresa', 99, 141);
INSERT INTO `picture` VALUES (74, 'HSNG118.jpg', 'HSNG118', 'sorpresa', 114, 141);
INSERT INTO `picture` VALUES (75, 'HSP75.jpg', 'HSP75', 'sorpresa', 109, 141);
INSERT INTO `picture` VALUES (76, 'HTNG111.jpg', 'HTNG111', 'tristeza', 107, 141);
INSERT INTO `picture` VALUES (77, 'MDNG87.jpg', 'MDNG87', 'asco', 97, 139);
INSERT INTO `picture` VALUES (78, 'MDNG108.jpg', 'MDNG108', 'asco', 99, 141);
INSERT INTO `picture` VALUES (79, 'MFP93.jpg', 'MFP93', 'alegria', 112, 141);
INSERT INTO `picture` VALUES (80, 'MMNG74.jpg', 'MMNG74', 'miedo', 103, 141);
INSERT INTO `picture` VALUES (81, 'MMNG881.jpg', 'MMNG88', 'miedo', 97, 141);
INSERT INTO `picture` VALUES (82, 'MMNG91.jpg', 'MMNG91', 'miedo', 105, 141);
INSERT INTO `picture` VALUES (83, 'MMNG113.jpg', 'MMNG113', 'miedo', 98, 141);
INSERT INTO `picture` VALUES (84, 'MRNG78.jpg', 'MRNG78', 'ira', 107, 141);
INSERT INTO `picture` VALUES (85, 'MSNG102.jpg', 'MSNG102', 'sorpresa', 104, 141);
INSERT INTO `picture` VALUES (86, 'MSP83.jpg', 'MSP83', 'sorpresa', 105, 141);
INSERT INTO `picture` VALUES (87, 'MSP95.jpg', 'MSP95', 'sorpresa', 98, 141);
INSERT INTO `picture` VALUES (88, 'MSP114.jpg', 'MSP114', 'sorpresa', 100, 141);
INSERT INTO `picture` VALUES (89, 'MTNG76.jpg', 'MTNG76', 'tristeza', 124, 141);
INSERT INTO `picture` VALUES (90, 'MTNG84.jpg', 'MTNG84', 'tristeza', 106, 139);
INSERT INTO `picture` VALUES (91, 'MTNG104.jpg', 'MTNG104', 'tristeza', 115, 141);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `slide_cref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `slide_memcref`
-- 

CREATE TABLE `slide_memcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `type` smallint(1) unsigned NOT NULL default '1' COMMENT '1-before, 2-after',
  `order` smallint(2) unsigned NOT NULL default '0',
  `suborder` smallint(2) unsigned NOT NULL default '0',
  `test_fk` int(10) unsigned NOT NULL,
  `picture_fk` int(10) unsigned NOT NULL,
  `rotation` smallint(3) NOT NULL default '0',
  `flip` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `slide_memcref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `slide_stroop`
-- 

CREATE TABLE `slide_stroop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_fk` int(10) unsigned NOT NULL,
  `word` varchar(20) collate utf8_spanish2_ci NOT NULL default 'XXXX',
  `color` varchar(20) collate utf8_spanish2_ci NOT NULL default 'black',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `slide_stroop`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `slide_timedcref`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_cref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_digit`
-- 

CREATE TABLE `test_digit` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `exposure` int(10) NOT NULL,
  `type` smallint(1) unsigned NOT NULL default '1' COMMENT '1-direct, 2-reverse',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_digit`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_memcref`
-- 

CREATE TABLE `test_memcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `exposure` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_memcref`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_cref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_digit`
-- 

CREATE TABLE `test_result_digit` (
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
-- Volcar la base de datos para la tabla `test_result_digit`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_cref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_item_digit`
-- 

CREATE TABLE `test_result_item_digit` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_digit`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_item_memcref`
-- 

CREATE TABLE `test_result_item_memcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `num` smallint(2) unsigned NOT NULL default '0',
  `pic_id` int(11) unsigned NOT NULL,
  `actual_time` int(11) unsigned NOT NULL,
  `success` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_memcref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_item_stroop`
-- 

CREATE TABLE `test_result_item_stroop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `num` int(8) unsigned NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_stroop`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_item_timedcref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_memcref`
-- 

CREATE TABLE `test_result_memcref` (
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
-- Volcar la base de datos para la tabla `test_result_memcref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_result_stroop`
-- 

CREATE TABLE `test_result_stroop` (
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
-- Volcar la base de datos para la tabla `test_result_stroop`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_result_timedcref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `test_stroop`
-- 

CREATE TABLE `test_stroop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `type` smallint(1) unsigned NOT NULL default '1' COMMENT '1-no color, 2-color, 3-different color',
  `num_questions` int(5) unsigned NOT NULL default '1',
  `exposure` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_stroop`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `test_timedcref`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `user`
-- 

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `username` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `password` varchar(32) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `user`
-- 

INSERT INTO `user` VALUES (1, 'Diego Serrano', 'dfserrano', '202cb962ac59075b964b07152d234b70');
INSERT INTO `user` VALUES (2, 'Edward Prada', 'edward', '202cb962ac59075b964b07152d234b70');
