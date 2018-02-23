-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2018 at 07:37 AM
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
-- Table structure for table `userprofile`
--

CREATE TABLE IF NOT EXISTS `userprofile` (
  `email` varchar(80) NOT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `idcom` varchar(80) NOT NULL,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`email`, `pass`, `idcom`, `is_admin`) VALUES
('abdul.hakam@klezcar.com', '0175', '1079828-T', 0),
('abdullah.fadhil@klezcar.com', '0395', '1079828-T', 0),
('abu.aiman@klezcar.com', '0276', '1079828-T', 0),
('adam@klezcar.com', '0033', '1079828-T', 0),
('ahmad.fadhil@klezcar.com', '0324', '1079828-T', 0),
('ahmad.noor@klezcar.com', '0297', '1079828-T', 0),
('ahmad.wafiuddin@klezcar.com', '0387', '1079828-T', 0),
('ahmad_wafiuddin@klezcar.com', 'P@ssw0rd', '1079828-T', 0),
('aiman.ismail@klezcar.com', '0246', '1079828-T', 0),
('aina@klezcar.com', '0027', '1079828-T', 0),
('alif.aziz@klezcar.com', '0369', '1079828-T', 0),
('amar.izaty@klezcar.com', '0315', '1079828-T', 0),
('amier.azrieq@klezcar.com', '0314', '1079828-T', 0),
('aminah.osman@klezcar.com', '0378', '1079828-T', 0),
('amir.amsyar@klezcar.com', '0081', '1079828-T', 0),
('arif.ishak@klezcar.com', '0355', '1079828-T', 0),
('arina.apil@klezcar.com', '0356', '1079828-T', 0),
('asrolablah@klezcar.com', '0223', '1079828-T', 0),
('azeem.zuhaili@klezcar.com', '0377', '1079828-T', 0),
('aziey.azrieq@gmail.com', '0314', '1079828-T', 0),
('azim@klezcar.com', '0226', '1079828-T', 0),
('borhan.osman@klezcar.com', '0323', '1079828-T', 0),
('che.mohd.taufik@gmail.com', '0005', '1079828-T', 0),
('danial.addin@klezcar.com', '0382', '1079828-T', 0),
('ellyana@klezcar.com', '0028', '1079828-T', 0),
('fadzan.isa@klezcar.com', '0230', '1079828-T', 0),
('fairuzfuad@gmail.com', '0171', '1079828-T', 0),
('farhansalleh@klezcar.com', '0011', '1079828-T', 0),
('fatin.najieha@klezcar.com', '0264', '1079828-T', 0),
('fazli@klezcar.com', '0222', '1079828-T', 0),
('fhatiazait1@gmail.com', '0010', '1079828-T', 0),
('fitri.sinan@gmail.com', '0163', '1079828-T', 0),
('fuad@klezcar.com', '0001', '1079828-T', 0),
('geedan90@gmail.com', '0214', '1079828-T', 0),
('habibullah.hassan@klezcar.com', '0354', '1079828-T', 0),
('hafidzul.hafiz@klezcar.com', '0379', '1079828-T', 0),
('hafizuddin.bakhtiar@klezcar.com', '0349', '1079828-T', 0),
('hafizudin@klezcar.com', '0008', '1079828-T', 0),
('hakim.hamdan@klezcar.com', '0366', '1079828-T', 0),
('hakim.sukri@klezcar.com', '0340', '1079828-T', 0),
('hamdi@klezcar.com', 'Imlonely92', '1079828-T', 0),
('haziman.hamzah@klezcar.com', '0253', '1079828-T', 0),
('haziq@klezcar.com', '0386', '1079828-T', 0),
('helmi.jaafar@klezcar.com', '0257', '1079828-T', 0),
('iqbal@klezcar.com', '0083', '1079828-T', 1),
('iqwan.aini@klezcar.com', '0362', '1079828-T', 0),
('khairudin.mkr@gmail.com', '0168', '1079828-T', 0),
('khairul.hiesyam@klezcar.com', '0374', '1079828-T', 0),
('khairun.abhalim@klezcar.com', '0344', '1079828-T', 0),
('khalis@klezcar.com', '0004', '1079828-T', 0),
('m.amirul@klezcar.com', '0402', '1079828-T', 0),
('mohamad.amirrul@klezcar.com', 'Disember92', '1079828-T', 0),
('mohamad.amri@klezcar.com', '0398', '1079828-T', 0),
('mohd.akhimullah@klezcar.com', '0361', '1079828-T', 0),
('mohd.azlizam@klezcar.com', '0331', '1079828-T', 0),
('mohdhafiz.zaidi@klezcar.com', '0399', '1079828-T', 0),
('morizan.ahmad@klezcar.com', '0397', '1079828-T', 0),
('muhamad.azim@klezcar.com', '0220', '1079828-T', 0),
('muhamad.effendi@klezcar.com', '123', '1079828-T', 0),
('muhammad.azwan@klezcar.com', '0401', '1079828-T', 0),
('muhammad.ilyas@klezcar.com', '0174', '1079828-T', 0),
('muhammad.syukri@klezcar.com', 'Syukri123', '1079828-T', 0),
('muhammad.taufek@klezcar.com', '0357', '1079828-T', 0),
('muhammadzulkarnain@klezcar.com', '123', '1079828-T', 0),
('nadia.rosli@klezcar.com', '0309', '1079828-T', 0),
('nazeem9075@gmail', '0161', '1079828-T', 0),
('nik.fitri@klezcar.com', '0381', '1079828-T', 0),
('nik.mohamed@klezcar.com', '0402', '1079828-T', 0),
('noor.azlee@klezcar.com', '0346', '1079828-T', 0),
('noraini.zainol@klezcar.com', 'Nani123', '1079828-T', 0),
('norasiah.salleh@klezcar.com', '0371', '1079828-T', 0),
('norazaima@klezcar.com', '0016', '1079828-T', 0),
('norhasshareena@klezcar.com', '0285', '1079828-T', 0),
('norliza.sidik@klezcar.com', '0162', '1079828-T', 0),
('nur.jannah@klezcar.com', '0322', '1079828-T', 0),
('nur.shazlinah@klezcar.com', '123', '1079828-T', 0),
('nurazielia@klezcar.com', '0359', '1079828-T', 0),
('nurfazlyshah.talib@klezcar.com', '0367', '1079828-T', 0),
('nurfazlyshah.talib@lezcar.com', '0368', '1079828-T', 0),
('nurhidayah.yazid@klezcar.com', '0400', '1079828-T', 0),
('nurul.suriani@klezcar.com', '0186', '1079828-T', 0),
('nurul.syafiqa@klezcar.com', '0363', '1079828-T', 0),
('omm.muammar@klezcar.com', '0319', '1079828-T', 0),
('rizal.tarmizi@klezcar.com', '0328', '1079828-T', 0),
('rozaimi.zainoh@klezcar.com', '0183', '1079828-T', 0),
('sahar.tamildanan@klezcar.com', '0152', '1079828-T', 0),
('saifulazzlan.yahya@klezcar.com', '0232', '1079828-T', 0),
('shahril@klezcar.com', '0002', '1079828-T', 0),
('shahrol.naim@klezcar.com', '0327', '1079828-T', 0),
('shahrul.hizan@klezcar.com', '0365', '1079828-T', 0),
('shakila.kamarolzaman@klezcar.com', '0018', '1079828-T', 0),
('shariful.azli@klezcar.com', '0196', '1079828-T', 0),
('shazreen.zamri@klezcar.com', '0378', '1079828-T', 0),
('siti.nabilah@klezcar.com', '0266', '1079828-T', 0),
('siti.nazirah@klezcar.com', '0405', '1079828-T', 0),
('siti.zahratul@klezcar.com', '0326', '1079828-T', 0),
('sitirohaiza@klezcar.com', '0021', '1079828-T', 0),
('sufian@klezcar.com', '0389', '1079828-T', 0),
('suha@klezcar.com', '123', '1079828-T', 0),
('sulah74@yahoo.com', '0332', '1079828-T', 0),
('syafiq.zainal@klezcar.com', '0263', '1079828-T', 0),
('syahida.ismail@klezcar.com', '0014', '1079828-T', 0),
('syaidatul@klezcar.com', '123', '1079828-T', 0),
('syarulnizam@klezcar.com', '0043', '1079828-T', 0),
('tarmizi@klezcar.com', '0224', '1079828-T', 0),
('umi.amira@klezcar.com', '0237', '1079828-T', 0),
('yusof.syollehan@klezcar.com', '0364', '1079828-T', 0),
('zahari.affendi@klezcar.com', '0179', '1079828-T', 0),
('zainalabidin.halim@klezcar.com', '0159', '1079828-T', 0),
('zukarnan.zain@klezcar.com', '0372', '1079828-T', 0),
('zulfakhruddin@klezcar.com', '0044', '1079828-T', 0),
('zulfikrie@klezcar.com', '0036', '1079828-T', 0),
('zulhaziq.naim@klezcar.com', '0080', '1079828-T', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
