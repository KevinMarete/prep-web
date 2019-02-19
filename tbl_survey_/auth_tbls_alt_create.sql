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
-- Alter table structure for table `auth_tbl_users`
--

ALTER TABLE `auth_tbl_users` 
ADD `organization` VARCHAR(20) NOT NULL AFTER `mobile`, 
ADD `scope` INT NOT NULL AFTER `organization`, 
ADD `county` INT NOT NULL AFTER `scope`, 
ADD `subcounty` INT NOT NULL AFTER `county`, 
ADD `auth_token` VARCHAR(200) NOT NULL AFTER `subcounty`;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_tbl_organizations`
--
ALTER TABLE `auth_tbl_organizations`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `auth_tbl_scope`
--
ALTER TABLE `auth_tbl_scope`
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
-- AUTO_INCREMENT for table `auth_tbl_scope`
--
ALTER TABLE `auth_tbl_scope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
