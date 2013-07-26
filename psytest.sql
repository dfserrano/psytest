-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 26, 2013 at 05:59 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `psytest`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `picture`
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
-- Dumping data for table `picture`
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
-- Table structure for table `slide_cref`
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
-- Dumping data for table `slide_cref`
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
-- Table structure for table `slide_memcref`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=89 ;

-- 
-- Dumping data for table `slide_memcref`
-- 

INSERT INTO `slide_memcref` VALUES (81, 1, 0, 0, 11, 1, 0, 0);
INSERT INTO `slide_memcref` VALUES (82, 1, 0, 1, 11, 2, 0, 0);
INSERT INTO `slide_memcref` VALUES (83, 2, 0, 2, 11, 1, 0, 0);
INSERT INTO `slide_memcref` VALUES (84, 2, 0, 3, 11, 9, 0, 0);
INSERT INTO `slide_memcref` VALUES (85, 1, 1, 4, 11, 2, 0, 0);
INSERT INTO `slide_memcref` VALUES (86, 1, 1, 5, 11, 5, 0, 0);
INSERT INTO `slide_memcref` VALUES (87, 2, 1, 6, 11, 5, 0, 0);
INSERT INTO `slide_memcref` VALUES (88, 2, 1, 7, 11, 6, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `slide_stroop`
-- 

CREATE TABLE `slide_stroop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_fk` int(10) unsigned NOT NULL,
  `word` varchar(20) collate utf8_spanish2_ci NOT NULL default 'XXXX',
  `color` varchar(20) collate utf8_spanish2_ci NOT NULL default 'black',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `slide_stroop`
-- 

INSERT INTO `slide_stroop` VALUES (1, 2, 'ROJO', 'red');
INSERT INTO `slide_stroop` VALUES (2, 2, 'VERDE', 'green');
INSERT INTO `slide_stroop` VALUES (3, 2, 'AZUL', 'blue');
INSERT INTO `slide_stroop` VALUES (4, 3, 'XXXX', 'green');
INSERT INTO `slide_stroop` VALUES (5, 3, 'XXXX', 'red');
INSERT INTO `slide_stroop` VALUES (6, 3, 'XXXX', 'blue');
INSERT INTO `slide_stroop` VALUES (7, 4, 'Azul', 'blue');
INSERT INTO `slide_stroop` VALUES (8, 4, 'Rojo', 'red');
INSERT INTO `slide_stroop` VALUES (9, 4, 'Verde', 'green');

-- --------------------------------------------------------

-- 
-- Table structure for table `slide_timedcref`
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
-- Dumping data for table `slide_timedcref`
-- 

INSERT INTO `slide_timedcref` VALUES (1, 0, 1, 1, 1000, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_timedcref` VALUES (2, 1, 1, 5, 3000, NULL, NULL, 0, 0, 0);
INSERT INTO `slide_timedcref` VALUES (3, 2, 1, 6, 5000, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_cref`
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
-- Dumping data for table `test_cref`
-- 

INSERT INTO `test_cref` VALUES (1, 'Primera Prueba', '2013-05-15 15:33:23', 0, 3000);
INSERT INTO `test_cref` VALUES (4, 'XX', '2013-05-22 09:04:19', 1, 2000);
INSERT INTO `test_cref` VALUES (5, 'Diego', '2013-05-22 16:05:32', 0, 3000);
INSERT INTO `test_cref` VALUES (6, '3SECWPERT', '2013-05-23 09:32:31', 1, 3000);
INSERT INTO `test_cref` VALUES (7, 'CREF', '2013-05-29 12:53:45', 0, 4500);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_digit`
-- 

CREATE TABLE `test_digit` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `exposure` int(10) NOT NULL,
  `type` smallint(1) unsigned NOT NULL default '1' COMMENT '1-direct, 2-reverse',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `test_digit`
-- 

INSERT INTO `test_digit` VALUES (1, 'Primera', '2013-06-18 11:51:34', 1, 1500, 1);
INSERT INTO `test_digit` VALUES (2, 'Inversa', '2013-06-18 17:45:47', 0, 1500, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_memcref`
-- 

CREATE TABLE `test_memcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  `exposure` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `test_memcref`
-- 

INSERT INTO `test_memcref` VALUES (11, 'Mem', '2013-06-12 09:57:11', 0, 1000);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_cref`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `test_result_cref`
-- 

INSERT INTO `test_result_cref` VALUES (6, 6, '', '', 0, '2013-05-28 16:20:29', '');
INSERT INTO `test_result_cref` VALUES (7, 6, '', '', 0, '2013-05-28 16:30:07', '');
INSERT INTO `test_result_cref` VALUES (8, 6, '', '', 0, '2013-05-29 09:00:44', '');
INSERT INTO `test_result_cref` VALUES (9, 6, '', '', 0, '2013-05-29 09:01:28', '');
INSERT INTO `test_result_cref` VALUES (10, 6, '', '', 0, '2013-05-29 12:35:02', '');
INSERT INTO `test_result_cref` VALUES (11, 7, '', '', 0, '2013-05-29 12:58:18', '');
INSERT INTO `test_result_cref` VALUES (12, 7, '', '', 0, '2013-05-31 12:27:42', '');
INSERT INTO `test_result_cref` VALUES (13, 1, '0', '0', 0, '2013-06-18 15:48:28', '0');
INSERT INTO `test_result_cref` VALUES (14, 1, '0', '0', 0, '2013-06-18 15:50:28', '0');
INSERT INTO `test_result_cref` VALUES (15, 1, '0', '0', 0, '2013-06-18 16:30:07', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_digit`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `test_result_digit`
-- 

INSERT INTO `test_result_digit` VALUES (1, 1, '0', '0', 0, '2013-06-18 16:32:48', '0');
INSERT INTO `test_result_digit` VALUES (2, 1, '0', '0', 0, '2013-06-18 16:45:05', '0');
INSERT INTO `test_result_digit` VALUES (3, 1, '0', '0', 0, '2013-06-18 16:52:39', '0');
INSERT INTO `test_result_digit` VALUES (4, 1, '0', '0', 0, '2013-06-18 17:36:55', '0');
INSERT INTO `test_result_digit` VALUES (5, 2, '0', '0', 0, '2013-06-18 17:50:58', '0');
INSERT INTO `test_result_digit` VALUES (6, 1, '0', '0', 0, '2013-07-03 10:04:08', '0');
INSERT INTO `test_result_digit` VALUES (7, 2, '0', '0', 0, '2013-07-03 10:09:01', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_item_cref`
-- 

CREATE TABLE `test_result_item_cref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `pic_code` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=37 ;

-- 
-- Dumping data for table `test_result_item_cref`
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
INSERT INTO `test_result_item_cref` VALUES (32, 12, 'MFP12', 'alegria', 'alegria', 1412);
INSERT INTO `test_result_item_cref` VALUES (33, 12, 'HMNG13', 'asco', 'miedo', 3364);
INSERT INTO `test_result_item_cref` VALUES (34, 12, 'MN14', 'neutra', 'neutra', 1742);
INSERT INTO `test_result_item_cref` VALUES (35, 12, 'HSP22', 'sorpresa', 'sorpresa', 5534);
INSERT INTO `test_result_item_cref` VALUES (36, 12, 'MRNG21', 'ira', 'ira', 1262);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_item_digit`
-- 

CREATE TABLE `test_result_item_digit` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=49 ;

-- 
-- Dumping data for table `test_result_item_digit`
-- 

INSERT INTO `test_result_item_digit` VALUES (1, 1, '51', '51', 2862);
INSERT INTO `test_result_item_digit` VALUES (2, 1, '83', '38', 2231);
INSERT INTO `test_result_item_digit` VALUES (3, 1, '555', '930', 2852);
INSERT INTO `test_result_item_digit` VALUES (4, 1, '111', '316', 1763);
INSERT INTO `test_result_item_digit` VALUES (5, 2, '73', '73', 2186);
INSERT INTO `test_result_item_digit` VALUES (6, 2, '29', '29', 2323);
INSERT INTO `test_result_item_digit` VALUES (7, 2, '845', '845', 3435);
INSERT INTO `test_result_item_digit` VALUES (8, 2, '652', '462', 3291);
INSERT INTO `test_result_item_digit` VALUES (9, 2, '8052', '8052', 4316);
INSERT INTO `test_result_item_digit` VALUES (10, 2, '3728', '3728', 3502);
INSERT INTO `test_result_item_digit` VALUES (11, 2, '35815', '35815', 4779);
INSERT INTO `test_result_item_digit` VALUES (12, 2, '21028', '21028', 4043);
INSERT INTO `test_result_item_digit` VALUES (13, 2, '307289', '307829', 6661);
INSERT INTO `test_result_item_digit` VALUES (14, 2, '246984', '264984', 5870);
INSERT INTO `test_result_item_digit` VALUES (15, 3, '74', '74', 2621);
INSERT INTO `test_result_item_digit` VALUES (16, 3, '32', '32', 2347);
INSERT INTO `test_result_item_digit` VALUES (17, 3, '011', '015', 2354);
INSERT INTO `test_result_item_digit` VALUES (18, 3, '875', '875', 3327);
INSERT INTO `test_result_item_digit` VALUES (19, 3, '2222', '1315', 2310);
INSERT INTO `test_result_item_digit` VALUES (20, 3, '2222', '8904', 2625);
INSERT INTO `test_result_item_digit` VALUES (21, 4, '52', '52', 3496);
INSERT INTO `test_result_item_digit` VALUES (22, 4, '38', '38', 2152);
INSERT INTO `test_result_item_digit` VALUES (23, 4, '745', '745', 3260);
INSERT INTO `test_result_item_digit` VALUES (24, 4, '079', '079', 4484);
INSERT INTO `test_result_item_digit` VALUES (25, 4, '6538', '6538', 3961);
INSERT INTO `test_result_item_digit` VALUES (26, 4, '6102', '6102', 4552);
INSERT INTO `test_result_item_digit` VALUES (27, 4, '93402', '93402', 4913);
INSERT INTO `test_result_item_digit` VALUES (28, 4, '70323', '70323', 4941);
INSERT INTO `test_result_item_digit` VALUES (29, 4, '485216', '485216', 5669);
INSERT INTO `test_result_item_digit` VALUES (30, 4, '591613', '591613', 5739);
INSERT INTO `test_result_item_digit` VALUES (31, 4, '9480808', '9408080', 8293);
INSERT INTO `test_result_item_digit` VALUES (32, 4, '1273409', '1273409', 5712);
INSERT INTO `test_result_item_digit` VALUES (33, 4, '62461523', '62461573', 7219);
INSERT INTO `test_result_item_digit` VALUES (34, 4, '89746862', '89784686', 6848);
INSERT INTO `test_result_item_digit` VALUES (35, 5, '40', '40', 3261);
INSERT INTO `test_result_item_digit` VALUES (36, 5, '03', '03', 6282);
INSERT INTO `test_result_item_digit` VALUES (37, 5, '298', '892', 2510);
INSERT INTO `test_result_item_digit` VALUES (38, 5, '623', '326', 2611);
INSERT INTO `test_result_item_digit` VALUES (39, 6, '81', '81', 5556);
INSERT INTO `test_result_item_digit` VALUES (40, 6, '43', '43', 2929);
INSERT INTO `test_result_item_digit` VALUES (41, 6, '421', '421', 3530);
INSERT INTO `test_result_item_digit` VALUES (42, 6, '666', '479', 6029);
INSERT INTO `test_result_item_digit` VALUES (43, 6, '6666', '4103', 17160);
INSERT INTO `test_result_item_digit` VALUES (44, 6, '1111', '5043', 2879);
INSERT INTO `test_result_item_digit` VALUES (45, 7, '79', '79', 4726);
INSERT INTO `test_result_item_digit` VALUES (46, 7, '19', '19', 3276);
INSERT INTO `test_result_item_digit` VALUES (47, 7, '456', '654', 3267);
INSERT INTO `test_result_item_digit` VALUES (48, 7, '278', '872', 3941);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_item_memcref`
-- 

CREATE TABLE `test_result_item_memcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `num` smallint(2) unsigned NOT NULL default '0',
  `pic_id` int(11) unsigned NOT NULL,
  `actual_time` int(11) unsigned NOT NULL,
  `success` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `test_result_item_memcref`
-- 

INSERT INTO `test_result_item_memcref` VALUES (1, 1, 1, 1, 1444, 1);
INSERT INTO `test_result_item_memcref` VALUES (2, 1, 2, 5, 3197, 1);
INSERT INTO `test_result_item_memcref` VALUES (3, 2, 1, 1, 444, 1);
INSERT INTO `test_result_item_memcref` VALUES (4, 2, 2, 5, 445, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_item_stroop`
-- 

CREATE TABLE `test_result_item_stroop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `num` int(8) unsigned NOT NULL,
  `actual` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `target` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=108 ;

-- 
-- Dumping data for table `test_result_item_stroop`
-- 

INSERT INTO `test_result_item_stroop` VALUES (1, 1, 1, 'Rojo', 'Rojo', 4602);
INSERT INTO `test_result_item_stroop` VALUES (2, 1, 2, 'Azul', 'Azul', 2061);
INSERT INTO `test_result_item_stroop` VALUES (3, 1, 3, 'Rojo', 'Rojo', 1405);
INSERT INTO `test_result_item_stroop` VALUES (4, 1, 4, 'Azul', 'Azul', 1237);
INSERT INTO `test_result_item_stroop` VALUES (5, 1, 5, 'Rojo', 'Verde', 1086);
INSERT INTO `test_result_item_stroop` VALUES (6, 1, 6, 'Azul', 'Azul', 2014);
INSERT INTO `test_result_item_stroop` VALUES (7, 1, 7, 'Verde', 'Rojo', 1534);
INSERT INTO `test_result_item_stroop` VALUES (8, 1, 8, 'Verde', 'Verde', 1314);
INSERT INTO `test_result_item_stroop` VALUES (9, 1, 9, 'Azul', 'Azul', 1327);
INSERT INTO `test_result_item_stroop` VALUES (10, 1, 10, 'Rojo', 'Rojo', 1344);
INSERT INTO `test_result_item_stroop` VALUES (11, 2, 1, 'Verde', 'Verde', 4103);
INSERT INTO `test_result_item_stroop` VALUES (12, 2, 2, 'Rojo', 'Rojo', 2030);
INSERT INTO `test_result_item_stroop` VALUES (13, 2, 3, 'Rojo', 'Azul', 698);
INSERT INTO `test_result_item_stroop` VALUES (14, 2, 4, 'Verde', 'Verde', 1818);
INSERT INTO `test_result_item_stroop` VALUES (15, 2, 5, 'Azul', 'Azul', 1545);
INSERT INTO `test_result_item_stroop` VALUES (16, 2, 6, 'Rojo', 'Rojo', 1042);
INSERT INTO `test_result_item_stroop` VALUES (17, 2, 7, 'Rojo', 'Azul', 925);
INSERT INTO `test_result_item_stroop` VALUES (18, 2, 8, 'Rojo', 'Rojo', 1610);
INSERT INTO `test_result_item_stroop` VALUES (19, 2, 9, 'Azul', 'Azul', 1205);
INSERT INTO `test_result_item_stroop` VALUES (20, 2, 10, 'Verde', 'Verde', 907);
INSERT INTO `test_result_item_stroop` VALUES (21, 3, 1, 'Azul', 'Azul', 2594);
INSERT INTO `test_result_item_stroop` VALUES (22, 3, 2, 'Rojo', 'Rojo', 2958);
INSERT INTO `test_result_item_stroop` VALUES (23, 3, 3, 'Verde', 'Verde', 2272);
INSERT INTO `test_result_item_stroop` VALUES (24, 3, 4, 'Rojo', 'Rojo', 1971);
INSERT INTO `test_result_item_stroop` VALUES (25, 4, 1, 'Azul', 'Verde', 2341);
INSERT INTO `test_result_item_stroop` VALUES (26, 4, 2, 'Azul', 'Rojo', 2709);
INSERT INTO `test_result_item_stroop` VALUES (27, 5, 1, 'Azul', 'Rojo', 1256);
INSERT INTO `test_result_item_stroop` VALUES (28, 5, 2, 'Azul', 'Verde', 883);
INSERT INTO `test_result_item_stroop` VALUES (29, 5, 3, 'Verde', 'Rojo', 1286);
INSERT INTO `test_result_item_stroop` VALUES (30, 5, 4, 'Verde', 'Azul', 1739);
INSERT INTO `test_result_item_stroop` VALUES (31, 5, 5, 'Verde', 'Rojo', 1045);
INSERT INTO `test_result_item_stroop` VALUES (32, 5, 6, 'Azul', 'Verde', 1313);
INSERT INTO `test_result_item_stroop` VALUES (33, 5, 7, 'Verde', 'Azul', 1820);
INSERT INTO `test_result_item_stroop` VALUES (34, 6, 1, 'Verde', 'Rojo', 1367);
INSERT INTO `test_result_item_stroop` VALUES (35, 6, 2, 'Rojo', 'Verde', 1870);
INSERT INTO `test_result_item_stroop` VALUES (36, 6, 3, 'Azul', 'Rojo', 1932);
INSERT INTO `test_result_item_stroop` VALUES (37, 6, 4, 'Rojo', 'Azul', 1412);
INSERT INTO `test_result_item_stroop` VALUES (38, 6, 5, 'Verde', 'Rojo', 1450);
INSERT INTO `test_result_item_stroop` VALUES (39, 6, 6, 'Rojo', 'Azul', 1557);
INSERT INTO `test_result_item_stroop` VALUES (40, 7, 1, 'Rojo', 'Azul', 2585);
INSERT INTO `test_result_item_stroop` VALUES (41, 8, 1, 'Azul', 'Verde', 3450);
INSERT INTO `test_result_item_stroop` VALUES (42, 8, 2, 'Verde', 'Azul', 3170);
INSERT INTO `test_result_item_stroop` VALUES (43, 9, 1, 'Rojo', 'Rojo', 3415);
INSERT INTO `test_result_item_stroop` VALUES (44, 9, 2, 'Azul', 'Azul', 1554);
INSERT INTO `test_result_item_stroop` VALUES (45, 10, 1, 'Verde', 'Verde', 1889);
INSERT INTO `test_result_item_stroop` VALUES (46, 10, 2, 'Azul', 'Azul', 1764);
INSERT INTO `test_result_item_stroop` VALUES (47, 10, 3, 'Rojo', 'Rojo', 1362);
INSERT INTO `test_result_item_stroop` VALUES (48, 10, 4, 'Rojo', 'Azul', 1215);
INSERT INTO `test_result_item_stroop` VALUES (49, 10, 5, 'Rojo', 'Rojo', 1805);
INSERT INTO `test_result_item_stroop` VALUES (50, 10, 6, 'Azul', 'Azul', 1516);
INSERT INTO `test_result_item_stroop` VALUES (51, 11, 1, 'Verde', 'Verde', 1301);
INSERT INTO `test_result_item_stroop` VALUES (52, 11, 2, 'Azul', 'Azul', 1594);
INSERT INTO `test_result_item_stroop` VALUES (53, 11, 3, 'Verde', 'Verde', 1272);
INSERT INTO `test_result_item_stroop` VALUES (54, 11, 4, 'Azul', 'Azul', 1785);
INSERT INTO `test_result_item_stroop` VALUES (55, 11, 5, 'Verde', 'Verde', 1253);
INSERT INTO `test_result_item_stroop` VALUES (56, 11, 6, 'Azul', 'Azul', 1124);
INSERT INTO `test_result_item_stroop` VALUES (57, 11, 7, 'Verde', 'Verde', 1276);
INSERT INTO `test_result_item_stroop` VALUES (58, 12, 1, 'Azul', 'Azul', 1725);
INSERT INTO `test_result_item_stroop` VALUES (59, 12, 2, 'Rojo', 'Rojo', 1084);
INSERT INTO `test_result_item_stroop` VALUES (60, 12, 3, 'Verde', 'Verde', 1103);
INSERT INTO `test_result_item_stroop` VALUES (61, 12, 4, 'Azul', 'Azul', 1801);
INSERT INTO `test_result_item_stroop` VALUES (62, 12, 5, 'Rojo', 'Rojo', 991);
INSERT INTO `test_result_item_stroop` VALUES (63, 12, 6, 'Azul', 'Azul', 1428);
INSERT INTO `test_result_item_stroop` VALUES (64, 12, 7, 'Rojo', 'Rojo', 1625);
INSERT INTO `test_result_item_stroop` VALUES (65, 13, 1, 'Azul', 'Negro', 4092);
INSERT INTO `test_result_item_stroop` VALUES (66, 13, 2, 'Verde', 'Negro', 1089);
INSERT INTO `test_result_item_stroop` VALUES (67, 13, 3, 'Rojo', 'Negro', 1164);
INSERT INTO `test_result_item_stroop` VALUES (68, 13, 4, 'Azul', 'Negro', 1193);
INSERT INTO `test_result_item_stroop` VALUES (69, 13, 5, 'Verde', 'Negro', 1004);
INSERT INTO `test_result_item_stroop` VALUES (70, 13, 6, 'Rojo', 'Negro', 1030);
INSERT INTO `test_result_item_stroop` VALUES (71, 14, 1, 'Azul', 'Azul', 1447);
INSERT INTO `test_result_item_stroop` VALUES (72, 14, 2, 'Rojo', 'Rojo', 1376);
INSERT INTO `test_result_item_stroop` VALUES (73, 14, 3, 'Azul', 'Azul', 1159);
INSERT INTO `test_result_item_stroop` VALUES (74, 14, 4, 'Verde', 'Verde', 1003);
INSERT INTO `test_result_item_stroop` VALUES (75, 14, 5, 'Rojo', 'Rojo', 1051);
INSERT INTO `test_result_item_stroop` VALUES (76, 14, 6, 'Verde', 'Verde', 896);
INSERT INTO `test_result_item_stroop` VALUES (77, 14, 7, 'Rojo', 'Rojo', 1072);
INSERT INTO `test_result_item_stroop` VALUES (78, 14, 8, 'Verde', 'Verde', 1019);
INSERT INTO `test_result_item_stroop` VALUES (79, 14, 9, 'Rojo', 'Rojo', 914);
INSERT INTO `test_result_item_stroop` VALUES (80, 15, 1, 'Rojo', 'Rojo', 1316);
INSERT INTO `test_result_item_stroop` VALUES (81, 15, 2, 'Azul', 'Azul', 1436);
INSERT INTO `test_result_item_stroop` VALUES (82, 15, 3, 'Rojo', 'Rojo', 974);
INSERT INTO `test_result_item_stroop` VALUES (83, 15, 4, 'Azul', 'Azul', 963);
INSERT INTO `test_result_item_stroop` VALUES (84, 15, 5, 'Rojo', 'Rojo', 943);
INSERT INTO `test_result_item_stroop` VALUES (85, 15, 6, 'Verde', 'Verde', 1085);
INSERT INTO `test_result_item_stroop` VALUES (86, 15, 7, 'Rojo', 'Rojo', 1339);
INSERT INTO `test_result_item_stroop` VALUES (87, 15, 8, 'Azul', 'Azul', 1154);
INSERT INTO `test_result_item_stroop` VALUES (88, 16, 1, 'Azul', 'Azul', 1826);
INSERT INTO `test_result_item_stroop` VALUES (89, 16, 2, 'Rojo', 'Rojo', 1783);
INSERT INTO `test_result_item_stroop` VALUES (90, 16, 3, 'Verde', 'Verde', 1536);
INSERT INTO `test_result_item_stroop` VALUES (91, 16, 4, 'Azul', 'Azul', 1377);
INSERT INTO `test_result_item_stroop` VALUES (92, 16, 5, 'Verde', 'Verde', 1636);
INSERT INTO `test_result_item_stroop` VALUES (93, 17, 1, 'Azul', 'Azul', 1348);
INSERT INTO `test_result_item_stroop` VALUES (94, 17, 2, 'Rojo', 'Rojo', 1256);
INSERT INTO `test_result_item_stroop` VALUES (95, 17, 3, 'Verde', 'Verde', 1528);
INSERT INTO `test_result_item_stroop` VALUES (96, 17, 4, 'Rojo', 'Rojo', 2899);
INSERT INTO `test_result_item_stroop` VALUES (97, 18, 1, 'Rojo', 'Rojo', 1746);
INSERT INTO `test_result_item_stroop` VALUES (98, 18, 2, 'Verde', 'Verde', 1215);
INSERT INTO `test_result_item_stroop` VALUES (99, 18, 3, 'Azul', 'Azul', 1494);
INSERT INTO `test_result_item_stroop` VALUES (100, 18, 4, 'Verde', 'Verde', 1318);
INSERT INTO `test_result_item_stroop` VALUES (101, 18, 5, 'Azul', 'Azul', 2018);
INSERT INTO `test_result_item_stroop` VALUES (102, 18, 6, 'Rojo', 'Rojo', 1655);
INSERT INTO `test_result_item_stroop` VALUES (103, 19, 1, 'Rojo', 'Rojo', 1663);
INSERT INTO `test_result_item_stroop` VALUES (104, 19, 2, 'Azul', 'Azul', 1453);
INSERT INTO `test_result_item_stroop` VALUES (105, 19, 3, 'Azul', 'Verde', 1936);
INSERT INTO `test_result_item_stroop` VALUES (106, 19, 4, 'Azul', 'Azul', 2223);
INSERT INTO `test_result_item_stroop` VALUES (107, 19, 5, 'Rojo', 'Rojo', 1639);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_item_timedcref`
-- 

CREATE TABLE `test_result_item_timedcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `test_result_fk` int(11) NOT NULL,
  `pic_code` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `actual_time` int(11) unsigned NOT NULL,
  `target_time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `test_result_item_timedcref`
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
INSERT INTO `test_result_item_timedcref` VALUES (13, 16, 'MFP12', 2228, 1000);
INSERT INTO `test_result_item_timedcref` VALUES (14, 16, 'HSP17', 3079, 3000);
INSERT INTO `test_result_item_timedcref` VALUES (15, 16, 'HSP22', 5224, 5000);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_memcref`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `test_result_memcref`
-- 

INSERT INTO `test_result_memcref` VALUES (1, 11, '0', '0', 0, '2013-06-12 09:57:23', '0');
INSERT INTO `test_result_memcref` VALUES (2, 11, '0', '0', 0, '2013-06-12 09:57:50', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_stroop`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `test_result_stroop`
-- 

INSERT INTO `test_result_stroop` VALUES (1, 3, '0', '0', 0, '2013-07-07 13:29:32', '0');
INSERT INTO `test_result_stroop` VALUES (2, 3, '0', '0', 0, '2013-07-07 13:30:20', '0');
INSERT INTO `test_result_stroop` VALUES (3, 3, '0', '0', 0, '2013-07-07 13:40:02', '0');
INSERT INTO `test_result_stroop` VALUES (4, 4, '0', '0', 0, '2013-07-09 15:13:12', '0');
INSERT INTO `test_result_stroop` VALUES (5, 4, '0', '0', 0, '2013-07-09 15:14:38', '0');
INSERT INTO `test_result_stroop` VALUES (6, 4, '0', '0', 0, '2013-07-09 15:22:43', '0');
INSERT INTO `test_result_stroop` VALUES (7, 4, '0', '0', 0, '2013-07-09 15:23:45', '0');
INSERT INTO `test_result_stroop` VALUES (8, 4, '0', '0', 0, '2013-07-09 15:58:14', '0');
INSERT INTO `test_result_stroop` VALUES (9, 4, '0', '0', 0, '2013-07-09 16:00:18', '0');
INSERT INTO `test_result_stroop` VALUES (10, 4, '0', '0', 0, '2013-07-09 16:00:54', '0');
INSERT INTO `test_result_stroop` VALUES (11, 3, '0', '0', 0, '2013-07-09 16:01:17', '0');
INSERT INTO `test_result_stroop` VALUES (12, 3, '0', '0', 0, '2013-07-09 16:01:43', '0');
INSERT INTO `test_result_stroop` VALUES (13, 2, '0', '0', 0, '2013-07-09 16:02:03', '0');
INSERT INTO `test_result_stroop` VALUES (14, 2, '0', '0', 0, '2013-07-09 16:05:27', '0');
INSERT INTO `test_result_stroop` VALUES (15, 3, '0', '0', 0, '2013-07-09 16:05:48', '0');
INSERT INTO `test_result_stroop` VALUES (16, 4, '0', '0', 0, '2013-07-09 16:06:10', '0');
INSERT INTO `test_result_stroop` VALUES (17, 2, '0', '0', 0, '2013-07-09 18:38:57', '0');
INSERT INTO `test_result_stroop` VALUES (18, 3, '0', '0', 0, '2013-07-09 18:40:08', '0');
INSERT INTO `test_result_stroop` VALUES (19, 4, '0', '0', 0, '2013-07-09 18:41:17', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `test_result_timedcref`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `test_result_timedcref`
-- 

INSERT INTO `test_result_timedcref` VALUES (12, 1, '', '', 0, '2013-05-29 18:42:46', '');
INSERT INTO `test_result_timedcref` VALUES (13, 1, '', '', 0, '2013-05-29 18:43:41', '');
INSERT INTO `test_result_timedcref` VALUES (14, 1, '', '', 0, '2013-05-29 18:54:39', '');
INSERT INTO `test_result_timedcref` VALUES (15, 1, '', '', 0, '2013-05-29 19:02:16', '');
INSERT INTO `test_result_timedcref` VALUES (16, 1, '', '', 0, '2013-05-31 12:26:18', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `test_stroop`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `test_stroop`
-- 

INSERT INTO `test_stroop` VALUES (2, 'Primera', '2013-07-06 19:45:05', 0, 1, 10, 10000);
INSERT INTO `test_stroop` VALUES (3, 'Solo Color', '2013-07-07 13:05:47', 0, 2, 10, 10000);
INSERT INTO `test_stroop` VALUES (4, 'Con Color', '2013-07-07 13:07:42', 0, 3, 10, 10000);

-- --------------------------------------------------------

-- 
-- Table structure for table `test_timedcref`
-- 

CREATE TABLE `test_timedcref` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL,
  `disturbance` smallint(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `test_timedcref`
-- 

INSERT INTO `test_timedcref` VALUES (1, 'CREF timed', '2013-05-29 16:25:37', 0);
