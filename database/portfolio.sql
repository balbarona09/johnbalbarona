-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2023 at 01:33 PM
-- Server version: 8.0.29
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` tinyint NOT NULL COMMENT '0=phone, 1=email, 2=url',
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `type`, `value`) VALUES
(6, 'Phone', 0, '09664455680'),
(7, 'Email', 1, 'balbarona09@gmail.com'),
(8, 'Github', 2, 'https://github.com/balbarona09'),
(9, 'Facebook', 2, 'https://www.facebook.com/johnmichael.balbarona.1');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `languages` varchar(100) NOT NULL,
  `thumbnail` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `name`, `languages`, `thumbnail`, `url`) VALUES
(1, 'Blog Site', 'HTML, CSS', '029e03ed90fbeb21c59c9d09d94433f9.jpg', 'johnbalbarona.tech'),
(2, 'Chat room', 'PHP, MySQL, JavaScript, CSS, HTML', 'a55bd839b8cced5ebac4c6cd24fba3da.png', 'johnbalbarona.tech'),
(3, 'Snake Game', 'JavaScript, HTML, CSS', 'c87fb96a55c494b40caa336f77e0c33c.png', 'johnbalbarona.tech'),
(4, 'Restaurant', 'PHP, MySQL, JavaScript, HTML, CSS', 'c13edcf4d81e3f5f25aa83c38c5cd92a.png', 'johnbalbarona.tech');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skill_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skill_id`, `name`, `description`, `icon`) VALUES
(1, 'PHP', 'PHP is my first server side programming language. I can say that I am quite confident in this language. Throughout my learning I made many websites along with MySQL as database such as Chat App, Cakeshop Management System and this portfolio website.', '<i class=\"fab fa-php\" title=\"PHP\"></i>'),
(2, 'MySQL', 'MySQL is my first Relational Database Management System Language. I can use MySQL on command line or on GUI such as phpMyAdmin.', '<i class=\"fas fa-database\" title=\"MySQL\"></i>'),
(3, 'JavaScript', 'Compared to C which is my first learned programming language, JavaScript is easy to learn, nevertheless it\'s a powerful programming language. Some things I can do with JavaScript are DOM Manipulation, AJAX, OOP, and Procedural Programming.', '<i class=\"fab fa-js-square\" title=\"Javascript\"></i>'),
(4, 'HTML', 'I have been coding in HTML since 2021 along with languages like CSS and JavaScript. I can produce HTML code fast with sematically in mind as I am so used to it.', '<i class=\"fab fa-html5\" title=\"HTML5\"></i>'),
(5, 'CSS', 'With CSS I can make a website beautiful and responsive. I can use CSS Flexbox and Grid to layout a website. This portfolio website is one of my projects that I use pure CSS.', '<i class=\"fab fa-css3\" title=\"CSS3\"></i>'),
(6, 'Bootstrap', 'With Bootstrap I can make an HTML code looks good, responsive, and interactive in a short amount of time so I can proceed to backend right away. I can also override bootstrap so it doesn\'t look all the same.', '<i class=\"fab fa-bootstrap\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `email`, `password`) VALUES
(1, 'John Michael Balbarona', 'admin@gmail.com', '$2y$10$UPo1y4ipWXy1.QKeUO6GVuZqbBezIBzwBWH3Gj.bQ69dMzBSrZGna');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skill_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
