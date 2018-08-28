-- Adminer 4.6.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `auth_tbl_roles`;
CREATE TABLE `auth_tbl_roles` (
  `roleId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `auth_tbl_roles` (`roleId`, `role`) VALUES
(1,	'Administrator'),
(2,	'Manager');

DROP TABLE IF EXISTS `auth_tbl_users`;
CREATE TABLE `auth_tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `roleId` tinyint(4) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `auth_tbl_users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `roleId`, `createdDtm`, `updatedDtm`) VALUES
(1,	'Kariukye John',	'0',	'kariukijoni@gmail.com',	'+254989009895',	'$2y$10$4KB5fzRHkow3ttnYDWBr9.PFhzKMpDPCfbVYZV/Y4DAoU8aCWJpoW',	1,	'2015-07-01 18:56:49',	'2017-06-28 12:00:22'),
(70,	'kariuki',	'John',	'k@mail.com',	'23654865',	'c20ad4d76fe97759aa27a0c99bff6710',	2,	'2018-08-27 12:25:54',	'2018-08-27 12:25:54');

-- 2018-08-28 14:28:40
