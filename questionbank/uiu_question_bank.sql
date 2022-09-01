-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2019 at 06:14 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uiu_question_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Faculty_id` int(11) NOT NULL,
  `Faculty_name` varchar(50) NOT NULL,
  `f_email` varchar(100) NOT NULL,
  `f_password` varchar(100) NOT NULL,
  `f_reg_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_id`, `Faculty_name`, `f_email`, `f_password`, `f_reg_date`) VALUES
(123456, 'MD Arafat Hossain', 'arafathossainarafat6@gmail.com', '12345', '2019-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE `question_bank` (
  `Question_id` int(11) NOT NULL,
  `Question_path` varchar(255) DEFAULT NULL,
  `Dept_name` varchar(50) NOT NULL,
  `Trimester_name` varchar(100) NOT NULL,
  `Course_name` varchar(100) NOT NULL,
  `Faculty_id` int(11) NOT NULL,
  `Question_name` varchar(255) DEFAULT NULL,
  `solution_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`Question_id`, `Question_path`, `Dept_name`, `Trimester_name`, `Course_name`, `Faculty_id`, `Question_name`, `solution_path`) VALUES
(6, 'uploads/5d5fd9b951df93.44889552.pdf', 'cse', '171', 'TOC', 123456, 'HR schema', NULL),
(7, 'uploads/5d5fdf0c8a1236.04810083.pdf', 'afsd', 'asdfsd', 'asdfd', 123456, 'adfdsf', 'uploads/5d5fdf0c8a12b0.08279038.pdf'),
(9, 'uploads/5d600d61925403.39110344.pdf', 'cse', '193', 'apl lab', 123456, 'apl', 'uploads/5d600d61925454.61838119.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `Question_id` int(11) NOT NULL,
  `Student_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`Question_id`, `Student_id`, `rating`) VALUES
(6, 11171158, 2),
(7, 11171158, 2),
(9, 11171158, 5);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `Student_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `req_dates` date DEFAULT NULL,
  `req` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`Student_id`, `faculty_id`, `req_dates`, `req`) VALUES
(11171158, 123456, '2019-08-23', 'i need java solve'),
(11171158, 123456, '2019-08-23', 'i need DC questions');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `s_reg_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `s_email`, `password`, `s_reg_date`) VALUES
(11171158, 'Arafat Hossain', 'arafathossainarafat6@gmail.com', '12345', '2019-08-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Faculty_id`),
  ADD UNIQUE KEY `f_email` (`f_email`);

--
-- Indexes for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD PRIMARY KEY (`Question_id`,`Dept_name`,`Trimester_name`),
  ADD KEY `Faculty_id` (`Faculty_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`Question_id`,`Student_id`),
  ADD KEY `Student_id` (`Student_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD KEY `Student_id` (`Student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `s_email` (`s_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question_bank`
--
ALTER TABLE `question_bank`
  MODIFY `Question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD CONSTRAINT `question_bank_ibfk_1` FOREIGN KEY (`Faculty_id`) REFERENCES `faculty` (`Faculty_id`);

--
-- Constraints for table `rank`
--
ALTER TABLE `rank`
  ADD CONSTRAINT `rank_ibfk_1` FOREIGN KEY (`Question_id`) REFERENCES `question_bank` (`Question_id`),
  ADD CONSTRAINT `rank_ibfk_2` FOREIGN KEY (`Student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`Student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`Faculty_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
