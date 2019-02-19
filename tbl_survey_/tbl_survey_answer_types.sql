-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2019 at 06:21 AM
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
-- Table structure for table `tbl_survey_answer_types`
--

CREATE TABLE `tbl_survey_answer_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_survey_answer_types`
--

INSERT INTO `tbl_survey_answer_types` (`id`, `name`, `slug`) VALUES
(1, 'List', 'list'),
(2, 'Prose', 'prose'),
(3, 'Multichoice Single', 'multichoice_single'),
(4, 'Multichoice Multiple', 'multichoice_multiple');

--
-- Triggers `tbl_survey_answer_types`
--
DELIMITER $$
CREATE TRIGGER `slugifyName` BEFORE INSERT ON `tbl_survey_answer_types` FOR EACH ROW SET NEW.slug = LOWER(REPLACE(NEW.name,' ', '_'))
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_survey_answer_types`
--
ALTER TABLE `tbl_survey_answer_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_survey_answer_types`
--
ALTER TABLE `tbl_survey_answer_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
