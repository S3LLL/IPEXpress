-- phpMyAdmin SQL Dump
-- version 4.0.0
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2014 at 10:15 PM
-- Server version: 5.6.11
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipxeboot`
--

-- --------------------------------------------------------

--
-- Table structure for table `ordinateur`
--

CREATE TABLE IF NOT EXISTS `ordinateur` (
  `id_ordi` int(11) NOT NULL AUTO_INCREMENT,
  `mac_ordi` binary(12) DEFAULT NULL,
  `ip_ordi` int(11) unsigned DEFAULT NULL,
  `mask_ordi` int(11) unsigned DEFAULT NULL,
  `last_update_ordi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `os_ordi` text NOT NULL,
  PRIMARY KEY (`id_ordi`),
  UNIQUE KEY `mac_ordi` (`mac_ordi`,`ip_ordi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ordinateur`
--

INSERT INTO `ordinateur` (`id_ordi`, `mac_ordi`, `ip_ordi`, `mask_ordi`, `last_update_ordi`, `os_ordi`) VALUES
(1, 'c82a144be37f', 3232235777, 4294967040, '2014-05-01 20:27:01', 'undefined'),
(2, '0019d1721f69', 3232235794, 4294967040, '2014-05-02 20:31:05', 'undefined'),
(3, '0019d1a465b8', 3232235791, 4294967040, '2014-05-02 15:09:57', 'undefined');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
