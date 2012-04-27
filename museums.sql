-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2012 at 04:55 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `harr0475`
--

-- --------------------------------------------------------

--
-- Table structure for table `museums`
--

CREATE TABLE IF NOT EXISTS `museums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `rate_count` int(11) NOT NULL DEFAULT '0',
  `rate_total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `museums`
--

INSERT INTO `museums` (`id`, `name`, `longitude`, `latitude`, `rate_count`, `rate_total`) VALUES
(2, 'Billings Estate National Historic Site', -75.6727346881424, 45.3896895443035, 0, 0),
(3, 'Bytown Museum', -75.6976704406878, 45.4258403509525, 0, 0),
(4, 'Cumberland Heritage Village Museum', -75.3903524268591, 45.5164637694132, 0, 0),
(5, 'Diefenbunker: Canada''s Cold War Museum', -76.0477363805347, 45.351653839198, 0, 0),
(6, 'Goulbourn Museum', -75.9059743325697, 45.2345487721525, 0, 0),
(7, 'Muséoparc Vanier Museopark', -75.6596309695265, 45.4438907889497, 0, 0),
(8, 'Nepean Museum', -75.7414738970196, 45.3491336771731, 0, 0),
(9, 'Osgoode Township Historical Society and Museum', -75.4624889953521, 45.159965768618, 0, 0),
(10, 'Ottawa Jewish Archives', -75.7519873345627, 45.3761498300788, 0, 0),
(11, 'Ottawa Room', -75.6955319434698, 45.4202457646201, 0, 0),
(12, 'Pinhey''s Point Historic Site', -75.953270548815, 45.4404227729787, 0, 0),
(13, 'Watson''s Mill', -75.6828052084775, 45.2269992476022, 0, 0);
