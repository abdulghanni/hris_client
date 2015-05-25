-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2015 at 07:59 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erlangga_hris`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(50) NOT NULL,
  `sent_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(250) NOT NULL,
  `email_body` text NOT NULL,
  `is_read` int(1) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `sender_id`, `sent_on`, `subject`, `email_body`, `is_read`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(33, 'B0460', '2015-03-13 07:15:44', 'Account Activation Request', 'Employee with Nik = B0460 request account activation', 0, 0, NULL, NULL),
(34, 'B0018', '2015-03-16 03:27:41', 'Account Activation Request', 'Employee with Nik = B0018 request account activation', 0, 0, NULL, NULL),
(35, 'B0478', '2015-03-16 08:57:19', 'Account Activation Request', 'Employee with Nik = B0478 request account activation', 0, 0, NULL, NULL),
(36, 'J0278', '2015-03-16 09:01:37', 'Account Activation Request', 'Employee with Nik = J0278 request account activation', 0, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
