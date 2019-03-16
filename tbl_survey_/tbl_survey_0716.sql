-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2019 at 01:09 PM
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
-- Table structure for table `tbl_survey_choices`
--

CREATE TABLE `tbl_survey_choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_text` varchar(200) NOT NULL,
  `choice_weight` int(11) NOT NULL,
  `choice_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_survey_choices`
--

INSERT INTO `tbl_survey_choices` (`id`, `question_id`, `choice_text`, `choice_weight`, `choice_status`, `created_at`, `updated_at`) VALUES
(1, 1, '', 1, 1, '2019-03-12 16:55:18', '2019-03-12 16:55:18'),
(2, 2, 'tbl_partner', 1, 1, '2019-03-12 16:56:04', '2019-03-12 16:56:04'),
(3, 3, 'Choice 1', 1, 1, '2019-03-12 16:57:08', '2019-03-12 16:57:08'),
(4, 3, 'Choice 2', 2, 1, '2019-03-12 16:57:08', '2019-03-12 16:57:08'),
(5, 3, 'Choice 3', 3, 1, '2019-03-12 16:57:08', '2019-03-12 16:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_questions`
--

CREATE TABLE `tbl_survey_questions` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `choice_type` varchar(50) NOT NULL,
  `question_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_survey_questions`
--

INSERT INTO `tbl_survey_questions` (`id`, `survey_id`, `question_text`, `choice_type`, `question_status`, `created_at`) VALUES
(1, 1, 'What is the question', 'Prose', 1, '2019-03-12 16:55:18'),
(2, 1, 'What is the other question', 'List', 1, '2019-03-12 16:56:04'),
(3, 1, 'What is the next other question', 'Multichoice', 1, '2019-03-12 16:57:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_survey_choices`
--
ALTER TABLE `tbl_survey_choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_questions`
--
ALTER TABLE `tbl_survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_survey_choices`
--
ALTER TABLE `tbl_survey_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_survey_questions`
--
ALTER TABLE `tbl_survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
