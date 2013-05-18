-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 18-05-2013 a las 09:47:08
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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `picture`
-- 

INSERT INTO `picture` VALUES (1, 'set1/HDNG11.jpg', 'HDNG11', 'asco');
INSERT INTO `picture` VALUES (2, 'set1/MFP12.jpg', 'MFP12', 'alegria');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `slide`
-- 

INSERT INTO `slide` VALUES (1, 1, 1, 1, NULL, NULL, 0, 0, 3);
INSERT INTO `slide` VALUES (2, 2, 1, 2, NULL, NULL, 0, 90, 0);
INSERT INTO `slide` VALUES (3, 3, 1, 1, 100, 100, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `test`
-- 

INSERT INTO `test` VALUES (1, 'Test', '2013-05-15 15:33:23', 0, 3000);

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

