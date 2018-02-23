-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 10:33 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klezcar_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `staffleaveapproval`
--

CREATE TABLE IF NOT EXISTS `staffleaveapproval` (
  `idapproval` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(80) NOT NULL DEFAULT '',
  `idleave` int(11) DEFAULT NULL,
  `dateapplied` date NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `noofdays` int(2) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `attachments` longblob,
  `status` varchar(120) DEFAULT NULL,
  `remarksby` varchar(255) DEFAULT NULL,
  `dateremarks` date DEFAULT NULL,
  PRIMARY KEY (`idapproval`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
