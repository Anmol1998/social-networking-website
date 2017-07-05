-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 03:40 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lno2`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `userA` varchar(30) COLLATE utf8_bin NOT NULL,
  `userB` varchar(30) COLLATE utf8_bin NOT NULL,
  `type` int(5) NOT NULL,
  `actionUser` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_members` longtext NOT NULL,
  `group_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
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
  `work` varchar(50) NOT NULL,
  `telephone` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `groups` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` varchar(17) COLLATE utf8_bin NOT NULL,
  `postperson` varchar(30) COLLATE utf8_bin NOT NULL,
  `postgroups` longtext COLLATE utf8_bin NOT NULL,
  `image` longblob NOT NULL,
  `caption` varchar(255) COLLATE utf8_bin NOT NULL,
  `bold` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `SNum` int(11) NOT NULL,
  `Name` varchar(60) COLLATE utf8_bin NOT NULL,
  `userEmail` varchar(80) COLLATE utf8_bin NOT NULL,
  `userName` varchar(30) COLLATE utf8_bin NOT NULL,
  `userPSW` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD UNIQUE KEY `userA` (`userA`,`userB`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userName`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD KEY `SNum` (`SNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
