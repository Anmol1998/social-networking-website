-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2017 at 11:56 AM
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
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
