-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2023 at 05:14 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookreturn`
--

DROP TABLE IF EXISTS `bookreturn`;
CREATE TABLE IF NOT EXISTS `bookreturn` (
  `bookReturnID` int NOT NULL AUTO_INCREMENT,
  `borrowID` int NOT NULL,
  `bookID` int NOT NULL,
  `bookTitle` varchar(200) NOT NULL,
  `studentID` int NOT NULL,
  `studentFullName` varchar(100) NOT NULL,
  `userID` int NOT NULL,
  `borrowAmount` int NOT NULL,
  `returnAmount` int NOT NULL,
  `borrowDate` date NOT NULL,
  `dueDate` timestamp NOT NULL,
  `priceLost` int NOT NULL,
  `noCopies` int NOT NULL,
  `createDate` timestamp NOT NULL,
  `createBy` varchar(100) NOT NULL,
  PRIMARY KEY (`bookReturnID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `bookID` int NOT NULL AUTO_INCREMENT,
  `bookTitle` varchar(100) NOT NULL,
  `edition` date NOT NULL,
  `author` varchar(100) NOT NULL,
  `copies` varchar(50) NOT NULL,
  `source` varchar(35) NOT NULL,
  `cost` int NOT NULL,
  `address` varchar(200) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `updateDate` timestamp NOT NULL,
  `updateBy` varchar(100) NOT NULL,
  `createDate` timestamp NOT NULL,
  `createBy` varchar(100) NOT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
CREATE TABLE IF NOT EXISTS `borrows` (
  `borrowID` int NOT NULL AUTO_INCREMENT,
  `bookID` int NOT NULL,
  `bookTitle` varchar(200) NOT NULL,
  `studentID` int NOT NULL,
  `studentFullName` varchar(100) NOT NULL,
  `userID` int NOT NULL,
  `borrowAmount` int NOT NULL,
  `borrowDate` timestamp NOT NULL,
  `dueDate` date NOT NULL,
  `priceLost` int NOT NULL,
  `noCopies` int NOT NULL,
  `createDate` timestamp NOT NULL,
  `createBy` varchar(25) NOT NULL,
  PRIMARY KEY (`borrowID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `studentID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `course` varchar(150) NOT NULL,
  `year` int NOT NULL,
  `contact` varchar(11) NOT NULL,
  `age` int NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blackList` bit(2) NOT NULL,
  `address` varchar(200) NOT NULL,
  `updateDate` datetime NOT NULL,
  `updateBy` varchar(100) NOT NULL,
  `createDate` timestamp NOT NULL,
  `createBy` varchar(100) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `contactNum` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` bit(2) NOT NULL,
  `address` varchar(200) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
