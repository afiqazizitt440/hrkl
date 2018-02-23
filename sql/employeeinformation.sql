-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2018 at 02:45 AM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezcar_rentAppsDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `employeeinformation`
--

CREATE TABLE IF NOT EXISTS `employeeinformation` (
  `employeeid` varchar(80) NOT NULL DEFAULT '',
  `branchid` varchar(255) DEFAULT NULL,
  `branchid2` varchar(255) DEFAULT NULL,
  `branchid3` varchar(255) DEFAULT NULL,
  `branchid4` varchar(255) DEFAULT NULL,
  `branchid5` varchar(255) DEFAULT NULL,
  `deptid` varchar(255) DEFAULT NULL,
  `jobcategory` varchar(50) DEFAULT NULL,
  `datejoin` date DEFAULT NULL,
  `dateresign` date DEFAULT NULL,
  `datetransfer` date DEFAULT NULL,
  `datepromote` date DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `idcom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeeinformation`
--

INSERT INTO `employeeinformation` (`employeeid`, `branchid`, `branchid2`, `branchid3`, `branchid4`, `branchid5`, `deptid`, `jobcategory`, `datejoin`, `dateresign`, `datetransfer`, `datepromote`, `email`, `idcom`) VALUES
('0175', 'Skudai - Impian Emas', 'Kulai', 'Johor Bahru - Larkin Sentral', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'abdul.hakam@klezcar.com', '1079828-T'),
('0395', 'Kota Bharu - Pusat Bandaraya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'abdullah.fadhil@klezcar.com', '1079828-T'),
('0276', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'abu.aiman@klezcar.com ', '1079828-T'),
('0033', 'Headquarters', 'Seremban - Rasah', 'Kajang - Hentian Kajang', 'Seremban - Seremban 2', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'adam@klezcar.com', '1079828-T'),
('0324', 'Pengkalan Chepa', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'ahmad.fadhil@klezcar.com', '1079828-T'),
('0297', 'Kulai', '', '', '', '', NULL, 'Non-Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'ahmad.noor@klezcar.com', '1079828-T'),
('0387', 'Kajang - Hentian Kajang', 'Putrajaya', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'ahmad.wafiuddin@klezcar.com', '1079828-T'),
('0396', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ahmad_wafiuddin@klezcar.com', '1079828-T'),
('0246', 'Kota Bharu - Pusat Bandaraya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'aiman.ismail@klezcar.com', '1079828-T'),
('0027', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'aina@klezcar.com', '1079828-T'),
('0369', 'Petaling Jaya', NULL, NULL, NULL, NULL, 'CRM', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'alif.aziz@klezcar.com', '1079828-T'),
('0315', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'amar.izaty@klezcar.com', '1079828-T'),
('0314', 'Seremban - Rasah', 'Seremban - Seremban 2', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'amier.azrieq@klezcar.com', '1079828-T'),
('0378', 'Petaling Jaya', NULL, NULL, NULL, NULL, 'CS', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'aminah.osman@klezcar.com', '1079828-T'),
('0081', 'Seremban - Seremban 2', 'Seremban - Rasah', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'amir.amsyar@klezcar.com', '1079828-T'),
('0034', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'amirul.hakimin@klezcar.com', '1079828-T'),
('0355', 'Skudai - Impian Emas', 'Kulai', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'arif.ishak@klezcar.com', '1079828-T'),
('0356', 'Petaling Jaya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'arina.apil@klezcar.com', '1079828-T'),
('0223', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'asrolablah@klezcar.com', '1079828-T'),
('0377', 'Klang - Bandar Puteri', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'azeem.zuhaili@klezcar.com', '1079828-T'),
('0226', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'azim@klezcar.com', '1079828-T'),
('0323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'borhan.osman@klezcar.com', '1079828-T'),
('0005', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'che.mohd.taufik@gmail.com', '1079828-T'),
('0382', 'Petaling Jaya', '', '', '', '', 'OPERATIONS', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'danial.addin@klezcar.com', '1079828-T'),
('0028', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'ellyana@klezcar.com', '1079828-T'),
('0230', 'Bandar Kinrara/Puncak Jalil', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fadzan.isa@klezcar.com', '1079828-T'),
('0171', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fairuzfuad@gmail.com', '1079828-T'),
('0011', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'farhansalleh@klezcar.com ', '1079828-T'),
('0264', 'Petaling Jaya', 'Headquarters', '', '', '', 'CS', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fatin.najieha@klezcar.com', '1079828-T'),
('0222', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fazli@klezcar.com', '1079828-T'),
('0010', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fhatiazait1@gmail.com', '1079828-T'),
('0163', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fitri.sinan@gmail.com', '1079828-T'),
('0001', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'fuad@klezcar.com', '1079828-T'),
('0214', 'Kajang - Hentian Kajang', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'geedan90@gmail.com', '1079828-T'),
('0354', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'habibullah.hassan@klezcar.com', '1079828-T'),
('0379', 'Terminal Bersepadu Selatan (TBS)', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'hafidzul.hafiz@klezcar.com', '1079828-T'),
('0349', 'Pasir Mas', 'Rantau Panjang - Masjid Beijing', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'hafizuddin.bakhtiar@klezcar.com', '1079828-T'),
('0008', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'hafizudin@klezcar.com', '1079828-T'),
('0366', 'Putrajaya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'hakim.hamdan@klezcar.com', '1079828-T'),
('0340', 'Seremban - Seremban 2', 'Senawang', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'hakim.sukri@klezcar.com', '1079828-T'),
('0385', 'Kajang - Hentian Kajang', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'hamdi@klezcar.com', '1079828-T'),
('0253', 'Kok Lanas', 'Kuala Krai', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'haziman.hamzah@klezcar.com', '1079828-T'),
('0386', 'Senawang', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'haziq@klezcar.com', '1079828-T'),
('0257', 'Senawang', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'helmi.jaafar@klezcar.com', '1079828-T'),
('0083', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'iqbal@klezcar.com', '1079828-T'),
('0362', 'Petaling Jaya', NULL, NULL, NULL, NULL, 'CRM', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'iqwan.aini@klezcar.com', '1079828-T'),
('0168', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'khairudin.mkr@gmail.com', '1079828-T'),
('0374', 'Kuala Krai', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'khairul.hiesyam@klezcar.com', '1079828-T'),
('0344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'khairun.abhalim@klezcar.com', '1079828-T'),
('0004', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'khalis@klezcar.com', '1079828-T'),
('0403', '', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'm.amirul@klezcar.com', '1079828-T'),
('0394', 'Skudai - Impian Emas', 'Johor Bahru - Larkin Sentral', '', '', '', NULL, '', '2018-01-04', '0000-00-00', '0000-00-00', '0000-00-00', 'mohamad.amirrul@klezcar.com', '1079828-T'),
('0398', 'Kuala Krai', '', '', '', '', NULL, '', '2017-12-30', '0000-00-00', '0000-00-00', '0000-00-00', 'mohamad.amri@klezcar.com', '1079828-T'),
('0361', 'Wangsa Maju', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'mohd.akhimullah@klezcar.com', '1079828-T'),
('0331', 'Skudai - Impian Emas', 'Gelang Patah - GP Sentral', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'mohd.azlizam@klezcar.com', '1079828-T'),
('0399', 'Skudai - Impian Emas', '', '', '', '', NULL, '', '2018-01-24', '0000-00-00', '0000-00-00', '0000-00-00', 'mohdhafiz.zaidi@klezcar.com', '1079828-T'),
('0397', 'Puchong - Puchong Utama', '', '', '', '', NULL, '', '2018-01-17', '0000-00-00', '0000-00-00', '0000-00-00', 'morizan.ahmad@klezcar.com', '1079828-T'),
('0220', 'Seremban - Seremban 2', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'muhamad.azim@klezcar.com', '1079828-T'),
('0390', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'muhamad.effendi@klezcar.com', '1079828-T'),
('0401', 'Pengkalan Chepa', '', '', '', '', NULL, '', '2018-01-21', '0000-00-00', '0000-00-00', '2018-02-08', 'muhammad.azwan@klezcar.com', '1079828-T'),
('0174', 'Johor Bahru - Larkin Sentral', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'muhammad.ilyas@klezcar.com', '1079828-T'),
('0360', 'Petaling Jaya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'muhammad.syukri@klezcar.com', '1079828-T'),
('0357', 'Petaling Jaya', NULL, NULL, NULL, NULL, 'CS', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'muhammad.taufek@klezcar.com', '1079828-T'),
('0383', 'Kota Bharu - Pusat Bandaraya', '', '', '', '', NULL, '', '0000-00-00', '2018-01-12', '0000-00-00', '0000-00-00', 'muhammadzulkarnain@klezcar.com', '1079828-T'),
('0309', 'Johor Bahru - Larkin Sentral', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nadia.rosli@klezcar.com', '1079828-T'),
('0161', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nazeem9075@gmail', '1079828-T'),
('0381', 'Kota Bharu - Pusat Bandaraya', 'Pengkalan Chepa', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nik.fitri@klezcar.com', '1079828-T'),
('0402', 'Headquarters', '', '', '', '', NULL, 'Non-Executive', '2018-02-06', '0000-00-00', '0000-00-00', '0000-00-00', 'nik.mohamed@klezcar.com', '1079828-T'),
('0346', 'Bandar Kinrara/Puncak Jalil', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'noor.azlee@klezcar.com', '1079828-T'),
('0393', 'Headquarters', '', '', '', '', NULL, '', '2018-01-02', '0000-00-00', '0000-00-00', '0000-00-00', 'noraini.zainol@klezcar.com', '1079828-T'),
('0371', 'Petaling Jaya', '', '', '', '', 'CS', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'norasiah.salleh@klezcar.com', '1079828-T'),
('0016', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'norazaima@klezcar.com', '1079828-T'),
('0285', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'norhasshareena@klezcar.com', '1079828-T'),
('0162', 'Pasir Mas', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'norliza.sidik@klezcar.com', '1079828-T'),
('0322', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nur.jannah@klezcar.com', '1079828-T'),
('0372', 'Petaling Jaya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nur.shazlinah@klezcar.com', '1079828-T'),
('0359', 'Putrajaya', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nurazielia@klezcar.com', '1079828-T'),
('0367', 'Klang - Bandar Puteri', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nurfazlyshah.talib@klezcar.com', '1079828-T'),
('0400', 'Skudai - Impian Emas', '', '', '', '', NULL, '', '2018-01-24', '0000-00-00', '0000-00-00', '0000-00-00', 'nurhidayah.yazid@klezcar.com', '1079828-T'),
('0186', 'Petaling Jaya', '', '', '', '', 'CRM', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nurul.suriani@klezcar.com', '1079828-T'),
('0363', 'Terminal Bersepadu Selatan (TBS)', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'nurul.syafiqa@klezcar.com', '1079828-T'),
('0319', 'Petaling Jaya', NULL, NULL, NULL, NULL, 'CRM', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'omm.muammar@klezcar.com', '1079828-T'),
('0328', 'Seremban - Rasah', 'Senawang', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'rizal.tarmizi@klezcar.com', '1079828-T'),
('0183', 'Rantau Panjang - Masjid Beijing', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'rozaimi.zainoh@klezcar.com', '1079828-T'),
('0152', 'Senawang', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'sahar.tamildanan@klezcar.com', '1079828-T'),
('0232', 'Bandar Kinrara/Puncak Jalil', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'saifulazzlan.yahya@klezcar.com', '1079828-T'),
('0002', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'shahril@klezcar.com', '1079828-T'),
('0327', 'Pasir Mas', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'shahrol.naim@klezcar.com', '1079828-T'),
('0365', 'Puchong - Puchong Utama', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'shahrul.hizan@klezcar.com', '1079828-T'),
('0018', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'shakila.kamarolzaman@klezcar.com', '1079828-T'),
('0196', 'Kota Bharu - Pusat Bandaraya', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'shariful.azli@klezcar.com', '1079828-T'),
('0375', 'Petaling Jaya', NULL, NULL, NULL, NULL, 'CRM', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'shazreen.zamri@klezcar.com', '1079828-T'),
('0266', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'siti.nabilah@klezcar.com', '1079828-T'),
('0405', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'siti.nazirah@klezcar.com', '1079828-T'),
('0326', 'Headquarters', '', '', '', '', NULL, '', '0000-00-00', '2018-01-05', '0000-00-00', '0000-00-00', 'siti.zahratul@klezcar.com', '1079828-T'),
('0021', 'Terminal Bersepadu Selatan (TBS)', 'Headquarters', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'sitirohaiza@klezcar.com', '1079828-T'),
('0389', 'Kajang - Hentian Kajang', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'sufian@klezcar.com', '1079828-T'),
('0384', 'Putrajaya', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'suha@klezcar.com', '1079828-T'),
('0332', '', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'sulah74@yahoo.com', '1079828-T'),
('0263', 'Kulai', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'syafiq.zainal@klezcar.com', '1079828-T'),
('0014', 'Headquarters', '', '', '', '', NULL, 'Executive', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'syahida.ismail@klezcar.com', '1079828-T'),
('0388', 'Kajang - Hentian Kajang', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'syaidatul@klezcar.com', '1079828-T'),
('0043', 'Kok Lanas', 'Petaling Jaya', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'syarulnizam@klezcar.com', '1079828-T'),
('0224', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'tarmizi@klezcar.com', '1079828-T'),
('0237', 'Klang - Bandar Puteri', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'umi.amira@klezcar.com', '1079828-T'),
('0364', 'Petaling Jaya', 'Terminal Bersepadu Selatan (TBS)', 'Bandar Kinrara/Puncak Jalil', 'Klang - Bandar Puteri', 'Headquarters', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'yusof.syollehan@klezcar.com', '1079828-T'),
('0179', 'Johor Bahru - Larkin Sentral', '', '', '', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'zahari.affendi@klezcar.com', '1079828-T'),
('0159', 'Headquarters', NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'zainalabidin.halim@klezcar.com', '1079828-T'),
('0370', 'Pengkalan Chepa', '', '', '', '', NULL, '', '0000-00-00', '2018-01-12', '0000-00-00', '0000-00-00', 'zukarnan.zain@klezcar.com', '1079828-T'),
('0044', 'Headquarters', 'Kok Lanas', 'Kuala Krai', 'Kota Bharu - Pusat Bandaraya', 'Petaling Jaya', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'zulfakhruddin@klezcar.com', '1079828-T'),
('0036', 'Kota Bharu - Pusat Bandaraya', 'Pasir Mas', 'Pengkalan Chepa', 'Rantau Panjang - Masjid Beijing', 'Headquarters', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'zulfikrie@klezcar.com', '1079828-T'),
('0080', 'Headquarters', 'Senawang', 'Puchong - Puchong Utama', 'Putrajaya', '', NULL, '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'zulhaziq.naim@klezcar.com', '1079828-T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeinformation`
--
ALTER TABLE `employeeinformation`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
