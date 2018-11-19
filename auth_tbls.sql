-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2018 at 06:47 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prep`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_tbl_organizations`
--

CREATE TABLE `auth_tbl_organizations` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `abbrev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tbl_roles`
--

CREATE TABLE `auth_tbl_roles` (
  `roleId` tinyint(4) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_tbl_roles`
--

INSERT INTO `auth_tbl_roles` (`roleId`, `role`) VALUES
(1, 'Administrator'),
(2, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tbl_scope`
--

CREATE TABLE `auth_tbl_scope` (
  `id` int(11) NOT NULL,
  `scope` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_tbl_scope`
--

INSERT INTO `auth_tbl_scope` (`id`, `scope`) VALUES
(1, 'National'),
(2, 'County'),
(3, 'Sub County');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tbl_users`
--

CREATE TABLE `auth_tbl_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `organization` varchar(20) NOT NULL,
  `scope` int(11) NOT NULL,
  `county` int(11) NOT NULL,
  `subcounty` int(11) NOT NULL,
  `auth_token` varchar(200) NOT NULL,
  `password` varchar(128) NOT NULL,
  `roleId` tinyint(4) NOT NULL,
  `is_authorized` tinyint(1) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_tbl_users`
--

INSERT INTO `auth_tbl_users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `organization`, `scope`, `county`, `subcounty`, `auth_token`, `password`, `roleId`, `is_authorized`, `createdDtm`, `updatedDtm`) VALUES
(1, 'Kariukye John', '0', 'kariukijoni@gmail.com', '+254989009895', '', 0, 0, 0, '', '$2y$10$4KB5fzRHkow3ttnYDWBr9.PFhzKMpDPCfbVYZV/Y4DAoU8aCWJpoW', 1, 0, '2015-07-01 18:56:49', '2017-06-28 12:00:22'),
(70, 'kariuki', 'John', 'k@mail.com', '23654865', '', 0, 0, 0, '', 'c20ad4d76fe97759aa27a0c99bff6710', 2, 0, '2018-08-27 12:25:54', '2018-08-27 12:25:54'),
(71, 'Kevin', 'Marete', 'kevomarete@gmail.com', '0725102659', '', 0, 0, 0, '', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, '2018-09-17 13:32:52', '2018-09-17 13:32:52'),
(114, 'Watson', 'Ndethi', 'ndethiw@gmail.com', '0788332342', 'CHAI', 1, 37, 67, '48b07caab5be2044046c4ce2740c85a1', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0, '2018-11-16 11:20:21', '2018-11-16 11:20:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_tbl_organizations`
--
ALTER TABLE `auth_tbl_organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tbl_roles`
--
ALTER TABLE `auth_tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `auth_tbl_scope`
--
ALTER TABLE `auth_tbl_scope`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tbl_users`
--
ALTER TABLE `auth_tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_tbl_organizations`
--
ALTER TABLE `auth_tbl_organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tbl_roles`
--
ALTER TABLE `auth_tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_tbl_scope`
--
ALTER TABLE `auth_tbl_scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_tbl_users`
--
ALTER TABLE `auth_tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
