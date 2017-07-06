-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2017 at 01:40 PM
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
  `work` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telephone` varchar(1000) NOT NULL,
  `email` text NOT NULL,
  `description` text NOT NULL,
  `groups` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` varchar(17) COLLATE utf8_bin NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `postperson` varchar(30) COLLATE utf8_bin NOT NULL,
  `postgroups` longtext COLLATE utf8_bin NOT NULL,
  `image` longblob NOT NULL,
  `caption` varchar(255) COLLATE utf8_bin NOT NULL,
  `bold` int(2) NOT NULL,
  `reactions` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED',
  `like` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED LIKE',
  `love` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED LOVE',
  `wow` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED WOW',
  `angry` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED ANGRY',
  `sad` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED SAD',
  `haha` longtext COLLATE utf8_bin NOT NULL COMMENT 'USERS WHO REACTED HAHA',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `SNum` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(80) COLLATE utf8_bin NOT NULL,
  `userName` varchar(30) COLLATE utf8_bin NOT NULL,
  `userPSW` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userName`),
  UNIQUE KEY `userEmail` (`userEmail`),
  KEY `SNum` (`SNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
