-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2017 at 08:19 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lno2`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `userA` varchar(30) COLLATE utf8_bin NOT NULL,
  `userB` varchar(30) COLLATE utf8_bin NOT NULL,
  `type` int(5) NOT NULL,
  `actionUser` varchar(30) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `userA` (`userA`,`userB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`userA`, `userB`, `type`, `actionUser`) VALUES
('abhinav', 'aditya', 1, 'aditya'),
('abhinav', 'rakshit', 1, 'rakshit'),
('abhinav', 'sonal', 1, 'sonal'),
('aman', 'kavya', 2, 'kavya'),
('astha', 'rakshit', 1, 'rakshit'),
('astha', 'sonal', 1, 'sonal'),
('jai', 'radhika', 1, 'radhika'),
('kavya', 'yash', 1, 'yash'),
('radhika', 'sonali', 1, 'sonali'),
('rajat', 'kavya', 1, 'kavya'),
('rakshit', 'aman', 1, 'aman'),
('rakshit', 'astha', 1, 'astha'),
('rakshit', 'kavya', 1, 'kavya'),
('rakshit', 'radhika', 1, 'radhika'),
('rakshit', 'ridhanshi', 1, 'ridhanshi'),
('ridhanshi', 'ishita', 1, 'ishita'),
('ridhanshi', 'khushi', 1, 'khushi'),
('shashank', 'aditya', 1, 'aditya'),
('shashank', 'rakshit', 1, 'rakshit'),
('shashank', 'shriya', 1, 'shriya'),
('shruti', 'kavya', 1, 'kavya'),
('snehil', 'kavya', 1, 'kavya'),
('tanmay', 'rakshit', 1, 'rakshit'),
('tarun', 'rakshit', 1, 'rakshit'),
('vaibhav', 'aman', 1, 'aman');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` varchar(17) COLLATE utf8_bin NOT NULL,
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `group_members` longtext COLLATE utf8_bin NOT NULL,
  `group_admin` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_members`, `group_admin`) VALUES
('1ed8c4681b703fe4', 'rj ki tolli', 'chirag;rakshit', 'rakshit'),
('836692d972d916a9', 'chirag', 'aman;chirag;rakshit', 'chirag');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `userName` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `errorMessage` mediumtext NOT NULL,
  `firstname` varchar(10000) NOT NULL,
  `lastname` varchar(10000) NOT NULL,
  `dp` longblob NOT NULL,
  `cover` longblob NOT NULL,
  `gender` varchar(10000) NOT NULL,
  `dob` varchar(1000) NOT NULL,
  `currentcity` varchar(10000) NOT NULL,
  `hometown` varchar(10000) NOT NULL,
  `school` varchar(10000) NOT NULL,
  `college` varchar(1000) NOT NULL,
  `telephone` varchar(1000) NOT NULL,
  `email` text NOT NULL,
  `description` text NOT NULL,
  `groups` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`userName`, `errorMessage`, `firstname`, `lastname`, `dp`, `cover`, `gender`, `dob`, `currentcity`, `hometown`, `school`, `college`, `telephone`, `email`, `description`, `groups`) VALUES
('aman', '', 'Aman', 'Singh', '', '', 'male', '', '', 'kanpur', '', '', '', '', '', ''),
('chirag', '', 'Chirag', 'Garg', '', '', 'male', '', 'delhi', 'delhi', '', '', '', 'chirag@vit.com', '', ';1ed8c4681b703fe4'),
('rakshit', '', 'Rakshit', 'Jain', '', '', 'male', '', 'delhi', 'delhi', '', '', '9313017723', 'rakshit@vit.com', '', ';1ed8c4681b703fe4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `SNum` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) COLLATE utf8_bin NOT NULL,
  `userEmail` varchar(80) COLLATE utf8_bin NOT NULL,
  `userName` varchar(30) COLLATE utf8_bin NOT NULL,
  `userPSW` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userName`),
  UNIQUE KEY `userEmail` (`userEmail`),
  KEY `SNum` (`SNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`SNum`, `Name`, `userEmail`, `userName`, `userPSW`) VALUES
(1, 'Rakshit Jain', 'rkashit@vit.com', 'rakshit', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
