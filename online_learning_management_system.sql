-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 09:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_learning_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockchain_resources`
--

CREATE TABLE `blockchain_resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blockchain_resources`
--

INSERT INTO `blockchain_resources` (`resource_id`, `title`, `description`, `type`) VALUES
(7, 'amen', 'amen', 'amen'),
(8, 'fghjkl', 'ghjk', 'hujikl'),
(9, 'oo', 'oo', 'ooo');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `coursename` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `instructor` varchar(30) NOT NULL,
  `duration` varchar(40) NOT NULL,
  `skills_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`coursename`, `description`, `instructor`, `duration`, `skills_level`) VALUES
('amen', 'amen', 'amen', '2', 'amen'),
('amen', 'amen', 'amen', '2', 'amen'),
('gfhujkl', 'fghjkl', 'fghjukl', '9', 'ghjk');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_form`
--

CREATE TABLE `discussion_form` (
  `post_title` varchar(50) NOT NULL,
  `post_content` varchar(100) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussion_form`
--

INSERT INTO `discussion_form` (`post_title`, `post_content`, `post_date`) VALUES
('fghjk', 'fghujkl', '2024-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `student_name` varchar(60) DEFAULT NULL,
  `course_title` varchar(60) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `status` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`student_name`, `course_title`, `enrollment_date`, `status`) VALUES
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL),
('dfghj', 'cghj,', '2024-05-21', 'fghjk');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `specialization` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `name`, `email`, `specialization`) VALUES
(NULL, 'yuio', 'tyuiot@gmail.com', 'tyuio'),
(NULL, 'yuio', 'tyuiot@gmail.com', 'tyuio'),
(3, 'fds', 'fred@gmail.com', 'fred@gmail.com'),
(4, 'ooo', 'fred@gmail.com', 'ooo'),
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL),
(NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_title` varchar(70) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_title`, `content`, `duration`) VALUES
(NULL, NULL, NULL),
(NULL, NULL, NULL),
(NULL, NULL, NULL),
(NULL, NULL, NULL),
(NULL, NULL, NULL),
('fghj', 'ghjk', 8);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `title`, `description`) VALUES
(8, 'amen', 'amen');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amounts` int(11) DEFAULT NULL,
  `payment_dates` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `amounts`, `payment_dates`) VALUES
(5, 6, 123, '2024-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_title` varchar(100) DEFAULT NULL,
  `questions` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `quiz_title`, `questions`) VALUES
(9, 'amen', 'amen');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `submission_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`submission_id`, `user_id`, `assignment_id`, `submission_date`) VALUES
(1, 2, 3, '2024-05-14'),
(9, 8, 0, '2024-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `role`) VALUES
('didi', 'did@gmail.com', '1234567890', 'user'),
('denyse', 'denyse@gmail.com', '$2y$10$SnXyDQwxGatG1iYF8tm./Oy3l4uzeulvFi4dZCquLBMZ/i0J4H24K', 'user'),
('peace', 'peace@gmail.com', '$2y$10$NzigjEIYEh1zHzgBrhOJ4erJhk/EVfy8OOkFZyXipf3C3WyFetIxW', 'user'),
('fred', 'fred@gmail.com', '$2y$10$3fnH6H82iSaJtgKUyjTAoOcEicJGZ3vC/dawVLwyprTI8PRdGhuvO', 'student'),
('frank', 'frank@gmail.com', '$2y$10$nUTMdmpTD68GBWxQ1hVTju.0sP100lIsWtWl1WJ.TYuBb9aEONtf2', 'user'),
('den', 'denyse@gmail.com', '$2y$10$ikV.Lzvkziijn/.H15jt/OEcNeW0Wf.8EHlX2/a1Q7.iUbaIqq8RC', 'user'),
('babe', 'prince@gmail.com', '$2y$10$n.3HwqWb1egMpcfaIfIMlOhqh5vq.gQ5ErfmoI1zF/RNdBv5DIqf.', 'student'),
('hi', 'hi@gmail.com', '$2y$10$HX../G0PU2cJuZ8/yDQIVOSCGe9KwZssicEOwGQIyQZbKJzyqBWUS', 'user'),
('de', 'de@gmail.com', '$2y$10$cxVV4MqaG0WzRCbKeC7zPuPn9jwo.saFklvH/jSL5jOM8qMdCgjg6', 'user'),
('ya', 'ya@gmaoil.com', '$2y$10$F2OCcy2RMuSGzaDH8tcSjuLOK3haPm74YFv.SqcguVGLrQuRPraWW', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockchain_resources`
--
ALTER TABLE `blockchain_resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blockchain_resources`
--
ALTER TABLE `blockchain_resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
