-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 10:32 AM
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
-- Table structure for table `staffleaveinfo`
--

CREATE TABLE IF NOT EXISTS `staffleaveinfo` (
  `idleave` int(11) NOT NULL AUTO_INCREMENT,
  `leavename` varchar(255) DEFAULT NULL,
  `leavedescription` varchar(255) NOT NULL,
  `entitlement` int(2) DEFAULT '0',
  `enttype` varchar(80) NOT NULL,
  PRIMARY KEY (`idleave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `staffleaveinfo`
--

INSERT INTO `staffleaveinfo` (`idleave`, `leavename`, `leavedescription`, `entitlement`, `enttype`) VALUES
(1, 'ANNUAL', 'Annual leave (also known as holiday pay) allows an employee to be paid while having time off from work. The entitlement to annual leave comes from the National Employment Standards (NES).', 8, 'Day(s)'),
(2, 'SICK', 'Sick leave (or paid sick days or sick pay) is time off from work that workers can use to stay home to address their health and safety needs without losing pay. Paid sick leave is a statutory requirement in many nations.', 14, 'Day(s)'),
(3, 'HOSPITALISATION', 'The number of days of paid sick leave you are entitled to depends on your period of service, up to 14 days for outpatient non-hospitalisation leave and 60 days for hospitalisation leave.', 60, 'Day(s)'),
(4, 'CARRY FORWARD', 'Any holiday left unused beyond that point is likely to be lost.', 4, 'Day(s)'),
(5, 'MARRIAGE', 'Employees are entitled to paid marriage leave according to the relevant Wage Regulation Order that regulates the specific sector of industry in which they are employed.', 2, 'Day(s)'),
(6, 'MATERNITY', 'A period of absence from work granted to a mother before and after the birth of her child. FEMALES ONLY.', 60, 'Day(s)'),
(7, 'DEATH OF IMM FAMILY', 'Leave for Funerals and Bereavement', 1, 'Day(s)'),
(8, 'SERIOUS ILL OF FAMILY', 'Additional Medical Certification for Care of a Family Member with a Serious Health Condition.', 1, 'Day(s)'),
(9, 'PATERNITY', 'A period of absence from work granted to a father after or shortly before the birth of his child. MALES ONLY.', 1, 'Day(s)'),
(10, 'DISASTER', 'Unpaid community service leave for certain emergency management activities such as dealing with a natural disaster', 1, 'Day(s)'),
(11, 'UNPAID', 'A period of time that someone is allowed away from work for holiday, illness, or another special reason, but that they are not paid for.', 0, 'Day(s)'),
(12, 'TIME-OFF', 'Paid time off or personal time off (PTO) is a policy in some employee handbooks that provides a bank of hours in which the employer pools sick days, vacation days, and personal days that allows employees to use as the need or desire arises.', 2, 'Hour(s)'),
(13, 'INTERN', 'Leave for internship students', 2, 'Day(s)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
