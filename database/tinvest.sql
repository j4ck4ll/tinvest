-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2013 at 01:51 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tinvest`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `comment`, `datetime`) VALUES
(27, 11, 'komentiram in vse dela lepo', '2013-04-30 11:14:05'),
(30, 11, 'komentar', '2013-04-30 14:36:23'),
(31, 11, 'asdasd', '2013-04-30 14:36:27'),
(32, 11, 'asdasd', '2013-04-30 14:36:31'),
(33, 11, 'asdasd', '2013-04-30 14:36:35'),
(34, 11, 'asdasdasd', '2013-04-30 14:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idhistory` int(11) NOT NULL,
  `bought` tinyint(1) NOT NULL,
  `symbol` varchar(16) NOT NULL,
  `number` int(11) NOT NULL,
  `price` decimal(65,4) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `idhistory`, `bought`, `symbol`, `number`, `price`, `datetime`) VALUES
(206, 22, 0, 'GOOG', 10, 790.0500, '2013-04-14 21:20:05'),
(207, 21, 0, 'AAPL', 5, 429.8000, '2013-04-14 21:28:28'),
(208, 21, 1, 'GOOG', 10, 790.0500, '2013-04-14 21:29:15'),
(209, 21, 1, 'GOOG', 10, 790.0500, '2013-04-14 21:34:08'),
(210, 11, 1, 'AAPL', 10, 429.8000, '2013-04-14 21:36:30'),
(211, 11, 0, 'AAPL', 5, 429.8000, '2013-04-15 05:39:46'),
(212, 11, 0, 'GOOG', 10, 790.0500, '2013-04-15 05:39:59'),
(213, 11, 1, 'DOW', 10, 31.7500, '2013-04-15 05:44:05'),
(214, 11, 1, 'AAPL', 100, 423.1000, '2013-04-16 15:45:02'),
(215, 11, 1, 'AMD', 100, 2.4000, '2013-04-18 13:07:52'),
(216, 12, 1, 'AAPL', 10, 396.0000, '2013-04-22 16:51:14'),
(217, 12, 0, 'AAPL', 10, 396.0600, '2013-04-22 16:52:52'),
(218, 12, 1, 'GOOG', 10, 796.5500, '2013-04-22 16:53:21'),
(219, 12, 0, 'GOOG', 10, 796.6300, '2013-04-22 17:00:19'),
(220, 12, 1, 'AAPL', 10, 396.9000, '2013-04-22 17:01:09'),
(221, 12, 0, 'AAPL', 10, 397.6959, '2013-04-22 18:54:27'),
(222, 12, 1, 'GOOG', 10, 800.1520, '2013-04-22 19:03:41'),
(223, 12, 0, 'GOOG', 10, 800.1140, '2013-04-23 08:57:37'),
(224, 12, 1, 'AAPL', 10, 398.6700, '2013-04-23 09:01:40'),
(225, 7, 1, 'DDD', 10, 32.4700, '2013-04-23 12:38:38'),
(226, 11, 0, 'AMD', 90, 2.4600, '2013-04-23 13:14:52'),
(227, 13, 1, 'AAPL', 10, 405.0000, '2013-04-23 17:08:19'),
(228, 15, 1, 'AAPL', 10, 406.1300, '2013-04-24 06:16:13'),
(229, 15, 1, 'GOOG', 5, 807.9000, '2013-04-24 11:27:25'),
(230, 15, 1, 'DOW', 10, 31.6600, '2013-04-24 11:27:43'),
(231, 15, 0, 'AAPL', 5, 406.1300, '2013-04-24 11:29:13'),
(232, 15, 0, 'DOW', 10, 33.9100, '2013-05-01 11:26:28'),
(233, 15, 0, 'GOOG', 5, 824.5700, '2013-05-01 11:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(8) NOT NULL,
  `shares` int(11) NOT NULL,
  PRIMARY KEY (`id`,`symbol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `symbol`, `shares`) VALUES
(1, 'S&P', 2),
(2, 'Dow', 2),
(3, 'S&P', 3),
(5, 'S&P', 4),
(6, 'Dow', 4),
(7, 'DDD', 10),
(8, 'Dow', 5),
(11, 'AAPL', 5),
(11, 'DOW', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,4) NOT NULL DEFAULT '0.0000',
  `pic_url` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `is_admin`, `email`, `hash`, `cash`, `pic_url`) VALUES
(7, 'skroob', 0, NULL, '$1$ShNrTOQV$MJi15ovjzCu5gFOESuXBO.', 14769.2400, 'profile_pics/teo_mala.jpg'),
(8, 'vigenere', 0, NULL, '$1$baQJKVeH$y1w5GmhzdjADef2RCweYK0', 10000.0000, NULL),
(11, 'teo', 1, 'kabimel@gmail.com', '$1$fs..683.$oMGyQwTGpA.rEVii19KUy.', 55033.7000, 'profile_pics/teo_mala.jpg'),
(15, 'saÅ¡a', 0, 'sasa@gmail.com', '$1$HJ/.Eu..$4PzpdmZ54loKRt.pmu1/R.', 10105.8500, NULL),
(16, 'test', 0, 'test@test.si', '$1$D...QW2.$SnjmY1It51F0p8B4XciD3/', 10000.0000, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
