-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2019 at 09:17 AM
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
-- Table structure for table `tbl_surveys`
--

CREATE TABLE `tbl_surveys` (
  `id` int(11) NOT NULL,
  `survey_title` varchar(50) NOT NULL,
  `survey_description` text NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surveys`
--

INSERT INTO `tbl_surveys` (`id`, `survey_title`, `survey_description`, `start_date`, `end_date`) VALUES
(1, 'Survey Name 2', 'Description 4', '2019-02-12 11:08:15', '2020-02-12 11:08:15'),
(2, 'Survey Name 2', 'Description 4 sfdfdfsd fsdfsdf', '2019-02-13 07:14:34', '2020-02-13 07:14:34');

--
-- Triggers `tbl_surveys`
--
DELIMITER $$
CREATE TRIGGER `endDate` BEFORE INSERT ON `tbl_surveys` FOR EACH ROW SET NEW.end_date = TIMESTAMPADD(YEAR, 1, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_answers`
--

CREATE TABLE `tbl_survey_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `answer_text` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_choices`
--

CREATE TABLE `tbl_survey_choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_text` varchar(100) NOT NULL,
  `choice_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_questions`
--

CREATE TABLE `tbl_survey_questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` int(11) NOT NULL,
  `question_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_question_types`
--

CREATE TABLE `tbl_survey_question_types` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_surveys`
--
ALTER TABLE `tbl_surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_answers`
--
ALTER TABLE `tbl_survey_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_answer_types`
--
ALTER TABLE `tbl_survey_answer_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_survey_question_types`
--
ALTER TABLE `tbl_survey_question_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_surveys`
--
ALTER TABLE `tbl_surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_survey_answers`
--
ALTER TABLE `tbl_survey_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_survey_answer_types`
--
ALTER TABLE `tbl_survey_answer_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_survey_choices`
--
ALTER TABLE `tbl_survey_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_survey_questions`
--
ALTER TABLE `tbl_survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_survey_question_types`
--
ALTER TABLE `tbl_survey_question_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
