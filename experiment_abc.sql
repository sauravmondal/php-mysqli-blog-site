-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2021 at 01:53 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `experiment_abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `hashed_password`) VALUES
(1, 'saurav', '$2y$10$IpeDaZzx36hfVfMtqSvOwech82AK.T1lbSp9CNdw6QGM.rnwbFR6u'),
(2, 'mondal', '$2y$10$wdw2ZDWGc7dWrOjomv4Zq.k3abgIkvKs9GT6yEBa/FC0Sg6CQwJ2K'),
(3, 'abcde', '$2y$10$0liK3s7MXnzt2d2ft8RuweEKEksfwgBot4X12tpnoQx4EalXnTzZq'),
(4, 'vwxyz', '$2y$10$1oW1swFGxpqGqcq5lDMaFu.67XB2ncdkoB5h.3QheVGm8nE7Evb26'),
(5, 'testing', '$2y$10$7K/AE79KAXTcwylgXSI/0ev0iMbApTWf5OA/zEpSeN.l0PpplsQFK');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment` text,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `comment`, `visible`) VALUES
(1, 1, 'good', 1),
(2, 1, 'very good', 1),
(3, 2, 'nice', 1),
(4, 2, 'very nice', 0),
(5, 8, 'good site', 1),
(11, 24, 'abcd', 1),
(12, 24, 'wxyz', 1),
(14, 5, 'abcd', 1),
(15, 4, '12345', 1),
(16, 4, 'ab', 0),
(18, 8, 'abcd', 0),
(24, 5, 'test', 0),
(28, 12, 'good', 1),
(29, 11, 'nice', 0),
(30, 12, 'nice', 0),
(31, 11, 'good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(20) NOT NULL,
  `post_content` text NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_name`, `post_content`, `visible`) VALUES
(1, 'Technology', 'all about tech', 1),
(2, 'IT', 'all about IT', 1),
(4, 'crud1', 'crud1', 1),
(5, 'crud2', 'abcde', 1),
(8, 'testig', 'abcd', 1),
(11, 'saurav\'s blog', 'abcde', 1),
(12, 'saurav\'s blog', 'abcde', 1),
(24, 'qwerty', 'qwert', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
