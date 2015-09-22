-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2015 at 08:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

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
-- Table structure for table `active_inactive`
--

CREATE TABLE IF NOT EXISTS `active_inactive` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_inactive`
--

INSERT INTO `active_inactive` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Active', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Inactive', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'Active by Term', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `alasan_cuti`
--

CREATE TABLE IF NOT EXISTS `alasan_cuti` (
`id` int(11) NOT NULL,
  `HRSLEAVETYPEID` varchar(254) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alasan_cuti`
--

INSERT INTO `alasan_cuti` (`id`, `HRSLEAVETYPEID`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'CTAM', 'Cuti Anak Menikah', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'CTB', 'Cuti Bersalin', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'CTH', 'Cuti Haid', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'CTI', 'Cuti Ibadah', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 'CTIM', 'Cuti Istri Melahirkan', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 'CTK', 'Cuti Kemalangan', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(7, 'CTM', 'Cuti Menikah', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(8, 'CTPS', 'Cuti Perkawinan Saudara Kandung', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(9, 'CTS-B', 'Cuti Sunat/ Baptis', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(10, 'CTT', 'Cuti Tahunan', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `alasan_resign`
--

CREATE TABLE IF NOT EXISTS `alasan_resign` (
`id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alasan_resign`
--

INSERT INTO `alasan_resign` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Diterima di perusahaan lain', 1, '2015-05-15', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Kuliah Lagi', 1, '2015-05-15', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Lingkungan kerja tidak nyaman', 1, '2015-05-18', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'Kesehatan tidak mendukung', 1, '2015-05-18', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 'Pendapatan tidak sesuai harapan', 1, '2015-05-18', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, 'Diterima Jadi PNS', 1, '2015-05-18', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, 'Membuka Usaha Sendiri', 1, '2015-06-04', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, 'lain-lain', 1, '2015-06-04', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `approval_status`
--

CREATE TABLE IF NOT EXISTS `approval_status` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_status`
--

INSERT INTO `approval_status` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Approved', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Rejected', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Pending', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`id` int(11) NOT NULL,
  `nik` varchar(250) NOT NULL,
  `jhk` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `opname` int(11) NOT NULL DEFAULT '0',
  `opname_istirahat` int(11) NOT NULL DEFAULT '0',
  `kecelakaan_kerja` int(11) NOT NULL DEFAULT '0',
  `cuti` int(11) NOT NULL,
  `phl` int(11) NOT NULL,
  `ijin` int(11) NOT NULL,
  `alpa` int(11) NOT NULL,
  `off` int(11) NOT NULL DEFAULT '0',
  `potong_gaji` int(11) NOT NULL DEFAULT '0',
  `pc` int(11) NOT NULL,
  `jh` int(11) NOT NULL,
  `hr` int(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '01',
  `bulan` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '01',
  `tahun` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '2012',
  `scan_masuk` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '-',
  `scan_pulang` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '-',
  `terlambat` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `plg_cepat` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `lembur` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ot_incidental` tinyint(4) NOT NULL DEFAULT '0',
  `ot_allow_shift` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'kelebihan jam kerja',
  `ot_cont_allow` varchar(4) NOT NULL DEFAULT '0' COMMENT 'Tunjangan hari kerja',
  `acc_ot_incidental` float NOT NULL DEFAULT '0',
  `acc_allow_shift` float NOT NULL DEFAULT '0',
  `acc_ot_cont_allow` float NOT NULL DEFAULT '0',
  `alasan_lembur` tinyint(4) NOT NULL DEFAULT '0',
  `jam_kerja` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `create_date` datetime NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_user_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `nik`, `jhk`, `sakit`, `opname`, `opname_istirahat`, `kecelakaan_kerja`, `cuti`, `phl`, `ijin`, `alpa`, `off`, `potong_gaji`, `pc`, `jh`, `hr`, `tanggal`, `bulan`, `tahun`, `scan_masuk`, `scan_pulang`, `terlambat`, `plg_cepat`, `lembur`, `ot_incidental`, `ot_allow_shift`, `ot_cont_allow`, `acc_ot_incidental`, `acc_allow_shift`, `acc_ot_cont_allow`, `alasan_lembur`, `jam_kerja`, `keterangan`, `create_date`, `create_user_id`, `modify_date`, `modify_user_id`) VALUES
(5, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '04', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-05-25 00:00:00', 30, '0000-00-00 00:00:00', 0),
(4, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '03', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-05-25 00:00:00', 30, '0000-00-00 00:00:00', 0),
(6, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '05', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-05-25 00:00:00', 30, '0000-00-00 00:00:00', 0),
(7, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '28', '05', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-05-28 00:00:00', 30, '0000-00-00 00:00:00', 0),
(8, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '29', '05', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-05-28 00:00:00', 30, '0000-00-00 00:00:00', 0),
(9, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '30', '05', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-05-28 00:00:00', 30, '0000-00-00 00:00:00', 0),
(10, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '19', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-18 00:00:00', 1, '0000-00-00 00:00:00', 0),
(11, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '19', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-18 00:00:00', 1, '0000-00-00 00:00:00', 0),
(12, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '20', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-18 00:00:00', 1, '0000-00-00 00:00:00', 0),
(13, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '22', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-20 00:00:00', 1, '0000-00-00 00:00:00', 0),
(14, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '23', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-20 00:00:00', 1, '0000-00-00 00:00:00', 0),
(15, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '22', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-20 00:00:00', 1, '0000-00-00 00:00:00', 0),
(16, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '23', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-20 00:00:00', 1, '0000-00-00 00:00:00', 0),
(17, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '22', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-20 00:00:00', 1, '0000-00-00 00:00:00', 0),
(18, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '23', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-20 00:00:00', 1, '0000-00-00 00:00:00', 0),
(19, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '24', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0),
(20, '8168   ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '25', '06', '2015', '-', '-', '0', NULL, NULL, 0, 0, '0', 0, 0, 0, 0, NULL, NULL, '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `award_warning_type`
--

CREATE TABLE IF NOT EXISTS `award_warning_type` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certification_type`
--

CREATE TABLE IF NOT EXISTS `certification_type` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certification_type`
--

INSERT INTO `certification_type` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'HPL', '2015-01-19 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Jakarta', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Bandung', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'Surabaya', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'Medan', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comp_session`
--

CREATE TABLE IF NOT EXISTS `comp_session` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `year` int(4) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `payroll_type_id` tinyint(2) NOT NULL DEFAULT '1',
  `is_absence` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comp_session`
--

INSERT INTO `comp_session` (`id`, `title`, `year`, `description`, `payroll_type_id`, `is_absence`, `is_active`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Session 2015', 2015, 'Company Session 2015', 1, 0, 1, '2015-02-11 00:00:00', 1, '2015-02-12 00:00:00', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_status`
--

CREATE TABLE IF NOT EXISTS `course_status` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_status`
--

INSERT INTO `course_status` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Registration', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Confirmation', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'Completed', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'Passed', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 'Waiting List', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 'Cancelled', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(7, 'Drop Out', '2015-01-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dollar_rate`
--

CREATE TABLE IF NOT EXISTS `dollar_rate` (
`id` int(11) NOT NULL,
  `comp_session_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(254) NOT NULL,
  `rupiah` decimal(16,0) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dollar_rate`
--

INSERT INTO `dollar_rate` (`id`, `comp_session_id`, `title`, `rupiah`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 1, 'dollar rate 2015', '12500', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `education_center`
--

CREATE TABLE IF NOT EXISTS `education_center` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education_degree`
--

CREATE TABLE IF NOT EXISTS `education_degree` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education_group`
--

CREATE TABLE IF NOT EXISTS `education_group` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
`id` int(11) NOT NULL,
  `sender_id` varchar(50) NOT NULL,
  `receiver_id` varchar(25) NOT NULL,
  `sent_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(250) NOT NULL,
  `email_body` text NOT NULL,
  `is_request_activation` tinyint(1) NOT NULL,
  `is_read` int(1) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_on` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `sender_id`, `receiver_id`, `sent_on`, `subject`, `email_body`, `is_request_activation`, `is_read`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'P0501', 'P0501', '2015-06-28 05:30:20', 'Notifikasi Inventaris Karyawan dari Atasan', 'Bitri Indriany telah mengetahui pengisian data inventaris Lili Sumarni, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/inventory/detail/30>Klik Disini</a><br />       <div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                <h4>Form <span class="semi-bold"><a href="http://localhost/hris_client/inventory">Inventaris Karyawan</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/inventory/add_inventory/14/it" method="post" accept-charset="utf-8" id="formInv">                <div class="row column-seperation">\r\n                  <div class="col-md-12">    \r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Nama</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                      <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Lili Sumarni" disabled="disabled">\r\n                      <input type="hidden" name="emp" value="30">\r\n                      </div>\r\n\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Wilayah</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Head Office                                       " disabled="disabled">\r\n                      </div>\r\n\r\n                    </div>\r\n\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">NIK</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="P1894" disabled="disabled">\r\n                      </div>\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Dept/Bagian</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="COMPENSATION & BENEFIT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Jabatan</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="KOOR. SEKRETARIAT & PAYROLL PUSAT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                      \r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <h4>Inventaris yang Dimiliki</h4>\r\n                        </div>\r\n                      </div>\r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <table class="table no-more-tables">\r\n                            <tr>\r\n                              <th>No</th>\r\n                              <th>Item</th>\r\n                              <th>Ketersediaan</th>\r\n                              <th>Keterangan / Jenis</th>\r\n                            </tr>\r\n                                                        <tr>\r\n                              <td>1</td>\r\n                              <td>HP</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="24">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_1" id="is_available24-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_1" id="note24" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>2</td>\r\n                              <td>Laptop</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="25">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_2" id="is_available25-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_2" id="note25" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>3</td>\r\n                              <td>Ipad</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="26">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_3" id="is_available26-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_3" id="note26" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                          </table>\r\n                        </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>', 0, 0, 0, NULL, NULL),
(2, 'P0501', 'P0501', '2015-06-28 05:31:47', 'Notifikasi Inventaris Karyawan dari Atasan', 'Bitri Indriany telah mengetahui pengisian data inventaris Lili Sumarni, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/inventory/detail/30>Klik Disini</a><br />       <div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                <h4>Form <span class="semi-bold"><a href="http://localhost/hris_client/inventory">Inventaris Karyawan</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/inventory/add_inventory/14/it" method="post" accept-charset="utf-8" id="formInv">                <div class="row column-seperation">\r\n                  <div class="col-md-12">    \r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Nama</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                      <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Lili Sumarni" disabled="disabled">\r\n                      <input type="hidden" name="emp" value="30">\r\n                      </div>\r\n\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Wilayah</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Head Office                                       " disabled="disabled">\r\n                      </div>\r\n\r\n                    </div>\r\n\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">NIK</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="P1894" disabled="disabled">\r\n                      </div>\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Dept/Bagian</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="COMPENSATION & BENEFIT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Jabatan</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="KOOR. SEKRETARIAT & PAYROLL PUSAT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                      \r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <h4>Inventaris yang Dimiliki</h4>\r\n                        </div>\r\n                      </div>\r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <table class="table no-more-tables">\r\n                            <tr>\r\n                              <th>No</th>\r\n                              <th>Item</th>\r\n                              <th>Ketersediaan</th>\r\n                              <th>Keterangan / Jenis</th>\r\n                            </tr>\r\n                                                        <tr>\r\n                              <td>1</td>\r\n                              <td>HP</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="24">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_1" id="is_available24-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_1" id="note24" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>2</td>\r\n                              <td>Laptop</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="25">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_2" id="is_available25-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_2" id="note25" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>3</td>\r\n                              <td>Ipad</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="26">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_3" id="is_available26-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_3" id="note26" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                          </table>\r\n                        </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>', 0, 1, 0, NULL, NULL),
(3, 'P0501', 'P0501', '2015-06-28 05:33:04', 'Notifikasi Inventaris Karyawan dari Atasan', 'Bitri Indriany telah mengetahui pengisian data inventaris Lili Sumarni, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/inventory/detail/30>Klik Disini</a><br />       <div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                <h4>Form <span class="semi-bold"><a href="http://localhost/hris_client/inventory">Inventaris Karyawan</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/inventory/add_inventory/14/it" method="post" accept-charset="utf-8" id="formInv">                <div class="row column-seperation">\r\n                  <div class="col-md-12">    \r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Nama</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                      <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Lili Sumarni" disabled="disabled">\r\n                      <input type="hidden" name="emp" value="30">\r\n                      </div>\r\n\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Wilayah</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Head Office                                       " disabled="disabled">\r\n                      </div>\r\n\r\n                    </div>\r\n\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">NIK</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="P1894" disabled="disabled">\r\n                      </div>\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Dept/Bagian</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="COMPENSATION & BENEFIT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Jabatan</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="KOOR. SEKRETARIAT & PAYROLL PUSAT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                      \r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <h4>Inventaris yang Dimiliki</h4>\r\n                        </div>\r\n                      </div>\r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <table class="table no-more-tables">\r\n                            <tr>\r\n                              <th>No</th>\r\n                              <th>Item</th>\r\n                              <th>Ketersediaan</th>\r\n                              <th>Keterangan / Jenis</th>\r\n                            </tr>\r\n                                                        <tr>\r\n                              <td>1</td>\r\n                              <td>HP</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="24">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_1" id="is_available24-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_1" id="note24" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>2</td>\r\n                              <td>Laptop</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="25">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_2" id="is_available25-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_2" id="note25" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>3</td>\r\n                              <td>Ipad</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="26">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_3" id="is_available26-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_3" id="note26" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                          </table>\r\n                        </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>', 0, 1, 0, NULL, NULL),
(4, 'P0501', 'B0018', '2015-06-28 06:16:27', 'Notifikasi Perubahan data Inventaris Karyawan', 'Bitri Indriany telah mengubah data inventaris Lili Sumarni, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/inventory/detail/30>Klik Disini</a><br />       <div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                <h4>Form <span class="semi-bold"><a href="http://localhost/hris_client/inventory">Inventaris Karyawan</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/inventory/add_inventory/14/it" method="post" accept-charset="utf-8" id="formInv">                <div class="row column-seperation">\r\n                  <div class="col-md-12">    \r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Nama</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                      <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Lili Sumarni" disabled="disabled">\r\n                      <input type="hidden" name="emp" value="30">\r\n                      </div>\r\n\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Wilayah</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Head Office                                       " disabled="disabled">\r\n                      </div>\r\n\r\n                    </div>\r\n\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">NIK</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="P1894" disabled="disabled">\r\n                      </div>\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Dept/Bagian</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="COMPENSATION & BENEFIT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Jabatan</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="KOOR. SEKRETARIAT & PAYROLL PUSAT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                      \r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <h4>Inventaris yang Dimiliki</h4>\r\n                        </div>\r\n                      </div>\r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <table class="table no-more-tables">\r\n                            <tr>\r\n                              <th>No</th>\r\n                              <th>Item</th>\r\n                              <th>Ketersediaan</th>\r\n                              <th>Keterangan / Jenis</th>\r\n                            </tr>\r\n                                                        <tr>\r\n                              <td>1</td>\r\n                              <td>HP</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="24">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_1" id="is_available24-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_1" id="note24" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>2</td>\r\n                              <td>Laptop</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="25">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_2" id="is_available25-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_2" id="note25" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>3</td>\r\n                              <td>Ipad</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="26">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_3" id="is_available26-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_3" id="note26" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                          </table>\r\n                        </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>', 0, 0, 0, NULL, NULL),
(5, 'P0501', 'B0018', '2015-06-28 06:16:28', 'Notifikasi Perubahan data Inventaris Karyawan', 'Bitri Indriany telah mengubah data inventaris Lili Sumarni, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/inventory/detail/30>Klik Disini</a><br />       <div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                <h4>Form <span class="semi-bold"><a href="http://localhost/hris_client/inventory">Inventaris Karyawan</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/inventory/add_inventory/14/it" method="post" accept-charset="utf-8" id="formInv">                <div class="row column-seperation">\r\n                  <div class="col-md-12">    \r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Nama</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                      <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Lili Sumarni" disabled="disabled">\r\n                      <input type="hidden" name="emp" value="30">\r\n                      </div>\r\n\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Wilayah</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Head Office                                       " disabled="disabled">\r\n                      </div>\r\n\r\n                    </div>\r\n\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">NIK</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="P1894" disabled="disabled">\r\n                      </div>\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Dept/Bagian</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="COMPENSATION & BENEFIT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Jabatan</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="KOOR. SEKRETARIAT & PAYROLL PUSAT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                      \r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <h4>Inventaris yang Dimiliki</h4>\r\n                        </div>\r\n                      </div>\r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <table class="table no-more-tables">\r\n                            <tr>\r\n                              <th>No</th>\r\n                              <th>Item</th>\r\n                              <th>Ketersediaan</th>\r\n                              <th>Keterangan / Jenis</th>\r\n                            </tr>\r\n                                                        <tr>\r\n                              <td>1</td>\r\n                              <td>HP</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="24">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_1" id="is_available24-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_1" id="note24" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>2</td>\r\n                              <td>Laptop</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="25">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_2" id="is_available25-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_2" id="note25" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>3</td>\r\n                              <td>Ipad</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="26">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_3" id="is_available26-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_3" id="note26" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                          </table>\r\n                        </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>', 0, 1, 0, NULL, NULL),
(6, 'B0018', 'P0501', '2015-06-28 06:19:41', 'Notifikasi Inventaris Karyawan dari Atasan', 'Suksma Wijaya telah mengetahui pengisian data inventaris Lili Sumarni, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/inventory/detail/30>Klik Disini</a><br />       <div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                <h4>Form <span class="semi-bold"><a href="http://localhost/hris_client/inventory">Inventaris Karyawan</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/inventory/add_inventory/14/it" method="post" accept-charset="utf-8" id="formInv">                <div class="row column-seperation">\r\n                  <div class="col-md-12">    \r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Nama</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                      <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Lili Sumarni" disabled="disabled">\r\n                      <input type="hidden" name="emp" value="30">\r\n                      </div>\r\n\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Wilayah</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="bu" type="text"  class="form-control" placeholder="Wilayah" value="Head Office                                       " disabled="disabled">\r\n                      </div>\r\n\r\n                    </div>\r\n\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">NIK</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="nik" type="text"  class="form-control" placeholder="NIK" value="P1894" disabled="disabled">\r\n                      </div>\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Dept/Bagian</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="organization" type="text"  class="form-control" placeholder="Dept/Bagian" value="COMPENSATION & BENEFIT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                    <div class="row form-row">\r\n                      <div class="col-md-2">\r\n                        <label class="form-label text-right">Jabatan</label>\r\n                      </div>\r\n                      <div class="col-md-3">\r\n                        <input name="form3LastName" id="position" type="text"  class="form-control" placeholder="Jabatan" value="KOOR. SEKRETARIAT & PAYROLL PUSAT" disabled="disabled">\r\n                      </div>\r\n                    </div>\r\n                      \r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <h4>Inventaris yang Dimiliki</h4>\r\n                        </div>\r\n                      </div>\r\n                      <div class="row form-row">\r\n                        <div class="col-md-12">\r\n                          <table class="table no-more-tables">\r\n                            <tr>\r\n                              <th>No</th>\r\n                              <th>Item</th>\r\n                              <th>Ketersediaan</th>\r\n                              <th>Keterangan / Jenis</th>\r\n                            </tr>\r\n                                                        <tr>\r\n                              <td>1</td>\r\n                              <td>HP</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="24">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_1" id="is_available24-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_1" id="note24" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>2</td>\r\n                              <td>Laptop</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="25">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_2" id="is_available25-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_2" id="note25" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                            <tr>\r\n                              <td>3</td>\r\n                              <td>Ipad</td>\r\n                              <td>\r\n                                <input type="hidden" name="inventory_id[]" value="26">\r\n                                <label class="radio-inline">\r\n                                  <input type="radio" name="is_available_3" id="is_available26-1" required value="1" checked>Ada                                </label>\r\n                              </td>\r\n                              <td><input name="note_3" id="note26" type="text"  class="form-control" placeholder="" value="ds" disabled></td>\r\n                            </tr>\r\n                                                          </table>\r\n                        </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>', 0, 0, 0, NULL, NULL),
(7, 'P0501', 'P0501', '2015-06-28 08:01:53', 'Rekapitulasi Rawat Jalan & Inap', 'Bitri Indriany membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/2>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : MIS MANAGER</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>B0018</td>\r\n                            <td>Suksma Wijaya</td>\r\n                            <td>tes</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34,343</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 34,343</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 0, 0, NULL, NULL),
(8, 'P0501', '1', '2015-06-28 08:01:54', 'Rekapitulasi Rawat Jalan & Inap', 'Bitri Indriany membuat rekapitulasi rawat jalan dan inap, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/2>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : MIS MANAGER</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>B0018</td>\r\n                            <td>Suksma Wijaya</td>\r\n                            <td>tes</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34,343</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 34,343</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 1, 0, NULL, NULL),
(9, 'P0501', 'P0501', '2015-06-28 08:02:41', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(10, 'P0501', 'P1493', '2015-06-28 08:02:43', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(11, 'P0501', 'P1463', '2015-06-28 08:02:44', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(12, 'P0501', 'P0035', '2015-06-28 08:02:46', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(13, 'P0501', 'D0001', '2015-06-28 08:02:48', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(14, 'P0501', 'P0501', '2015-06-28 08:09:03', 'Rekapitulasi Rawat Jalan & Inap', 'Bitri Indriany menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/2>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : MIS MANAGER</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>B0018</td>\r\n                            <td>Suksma Wijaya</td>\r\n                            <td>tes</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34,343</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 34,343</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 0, 0, NULL, NULL);
INSERT INTO `email` (`id`, `sender_id`, `receiver_id`, `sent_on`, `subject`, `email_body`, `is_request_activation`, `is_read`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(15, 'P0501', 'P0501', '2015-06-28 08:09:53', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(16, 'P0501', 'P1493', '2015-06-28 08:09:55', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(17, 'P0501', 'P1463', '2015-06-28 08:09:57', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(18, 'P0501', 'P0035', '2015-06-28 08:09:59', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(19, 'P0501', 'D0001', '2015-06-28 08:10:00', 'Pengajuan Rekomendasi Karyawan Keluar', 'Bitri Indriany mengajukan rekomendasi karyawan keluar untuk Suksma Wijaya, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_exit/detail/0>Klik Disini</a><br /><div class="row">\r\n          <div class="col-md-12">\r\n            <div class="grid simple">\r\n              <div class="grid-title no-border">\r\n                  <h4>Form Rekomendasi <span class="semi-bold"><a href="http://localhost/hris_client/form_exit">Karyawan Keluar</a></span></h4>\r\n              </div>\r\n              <div class="grid-body no-border">\r\n                 <form action="http://localhost/hris_client/form_exit/add" method="post" accept-charset="utf-8" id="formaddexit">              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n              \r\n    ', 0, 0, 0, NULL, NULL),
(20, '1', 'P1493', '2015-06-28 20:54:47', 'Rekapitulasi Rawat Jalan & Inap', 'administrator menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/1>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : COMPENSATION & BENEFIT</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>sad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 43</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 434</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 4,343</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 4,854</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 0, 0, NULL, NULL),
(21, '1', 'P1493', '2015-06-29 00:18:37', 'Rekapitulasi Rawat Jalan & Inap', 'administrator menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/1>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : COMPENSATION & BENEFIT</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>sad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 43</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 434</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 4,343</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 4,854</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 0, 0, NULL, NULL),
(22, '1', 'P1493', '2015-06-29 00:21:41', 'Rekapitulasi Rawat Jalan & Inap', 'administrator menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/1>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : COMPENSATION & BENEFIT</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>sad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 43</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 434</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 4,343</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 4,854</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 0, 0, NULL, NULL),
(23, '1', 'P1493', '2015-06-29 06:19:44', 'Rekapitulasi Rawat Jalan & Inap', 'administrator menyetujui rekapitulasi rawat jalan dan inap yang anda buat, untuk melihat detail silakan <a class="klikmail" href=http://localhost/hris_client/form_medical/detail/1>Klik Disini</a><br/><div class="grid-body no-border">\r\n            <h6 class="bold">BAGIAN : COMPENSATION & BENEFIT</h6>\r\n              <form class="form-no-horizontal-spacing" id="formApp"> \r\n                <div class="row column-seperation">\r\n\r\n                  <hr/>\r\n                  <h5 class="text-center"><span class="semi-bold">Rekapitulasi Rawat Jalan & Inap</span></h5>\r\n                    <table id="dataTable" class="table table-bordered">\r\n                      <thead>\r\n                        <tr>\r\n                          <th width="5%">NIK</th>\r\n                          <th width="25%">Nama</th>\r\n                          <th width="25%">Nama Pasien</th>\r\n                          <th width="15%">Hubungan</th>\r\n                          <th width="13%">Jenis Pemeriksaan</th>\r\n                          <th width="12%">Rupiah</th>\r\n                        </tr>\r\n                      </thead>\r\n                      <tbody>\r\n                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 43</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P0081</td>\r\n                            <td>Dede Susanti</td>\r\n                            <td>sad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 34</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsa</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 4,343</td>\r\n                          </tr>\r\n                                                                                  <tr>\r\n                            <td>P1575</td>\r\n                            <td>Maria Yulan Kurniawati</td>\r\n                            <td>dsad</td>\r\n                            <td>Pribadi</td>\r\n                            <td>Kesehatan</td>\r\n                            <td>Rp. 434</td>\r\n                          </tr>\r\n                                                                                    <tr>\r\n                            <td align="right" colspan="5">Total : </td><td>Rp. 4,854</td>\r\n                            </tr>\r\n                        </tbody>\r\n                      </table>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                </div>\r\n              </form>\r\n                  </div>  ', 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_status`
--

CREATE TABLE IF NOT EXISTS `employee_status` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_status`
--

INSERT INTO `employee_status` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Work Center', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Employed', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'Terminated', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'Honorarium', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `empl_status`
--

CREATE TABLE IF NOT EXISTS `empl_status` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empl_status`
--

INSERT INTO `empl_status` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Probation', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Permanent', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'Contract', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'Part Time', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 'Expat Contranct', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 'Sick', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(7, 'UPLeave', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(8, 'Ahli', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(9, 'Daily Contract', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(10, 'Daily Permanent', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(11, 'Job Training', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exit_type`
--

CREATE TABLE IF NOT EXISTS `exit_type` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exit_type`
--

INSERT INTO `exit_type` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'PHK', 1, '2015-06-08', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Pensiun', 1, '2015-06-08', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Resign', 1, '2015-06-08', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `exp_field`
--

CREATE TABLE IF NOT EXISTS `exp_field` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exp_level`
--

CREATE TABLE IF NOT EXISTS `exp_level` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exp_year`
--

CREATE TABLE IF NOT EXISTS `exp_year` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fpdata`
--

CREATE TABLE IF NOT EXISTS `fpdata` (
  `mchID` smallint(6) NOT NULL DEFAULT '0',
  `Nama` varchar(35) DEFAULT NULL,
  `ID` varchar(15) NOT NULL,
  `dept` varchar(30) DEFAULT NULL,
  `io` varchar(2) DEFAULT NULL,
  `priv` tinyint(4) DEFAULT NULL,
  `PC` varchar(50) DEFAULT NULL,
  `upld` varchar(10) DEFAULT NULL,
  `downld` varchar(10) DEFAULT NULL,
  `delflg` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fpdata`
--

INSERT INTO `fpdata` (`mchID`, `Nama`, `ID`, `dept`, `io`, `priv`, `PC`, `upld`, `downld`, `delflg`) VALUES
(9920, 'Abdul', 'P0674', NULL, NULL, NULL, NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fpfps`
--

CREATE TABLE IF NOT EXISTS `fpfps` (
  `mchID` smallint(6) NOT NULL,
  `fps` varchar(640) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'G01', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'G02', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'member', 'General User'),
(3, 'Admin IT', 'Administrator Bagian IT'),
(4, 'Admin HRD', 'Administrator Bagian HRD'),
(5, 'Admin Koperasi', 'Administrator Bagian Koperasi'),
(6, 'Admin Perpustakaan', 'Administrator Bagian Perpustakaan'),
(7, 'Admin Logistik', 'Administrator Bagian Logistik');

-- --------------------------------------------------------

--
-- Table structure for table `ikatan_dinas_type`
--

CREATE TABLE IF NOT EXISTS `ikatan_dinas_type` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `type_inventory_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `title`, `type_inventory_id`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Seragam', 1, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'ID Card', 1, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Motor', 3, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'STNK Motor', 3, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 'Mobil', 3, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, 'STNK Mobil', 3, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, 'HP', 2, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, 'Laptop', 2, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(9, 'Ipad', 2, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(10, 'Laporan Serah Terima', 1, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(11, 'Rekonsiliasi Saldo', 4, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(12, 'Pinjaman Koperasi', 4, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(13, 'Pinjaman Buku', 5, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(14, 'Ikatan Dinas', 1, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(15, 'Kartu Kredit', 4, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00'),
(16, 'Pinjaman Subsidi', 4, 1, '2015-06-23', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ipk`
--

CREATE TABLE IF NOT EXISTS `ipk` (
`id` int(11) NOT NULL,
  `title` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ipk`
--

INSERT INTO `ipk` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, '2,00', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, '2,50', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, '2,75', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, '3,00', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, '3,25', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE IF NOT EXISTS `jenis_kelamin` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(1) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Pria', 1, '2015-05-21', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Wanita', 1, '2015-05-21', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan_absen`
--

CREATE TABLE IF NOT EXISTS `keterangan_absen` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` smallint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keterangan_absen`
--

INSERT INTO `keterangan_absen` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(3, 'Tidak Absen (IN)', '2015-04-15', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(4, 'Tidak Absen (OUT)', '2015-04-15', 0, '0000-00-00', 0, 0, '0000-00-00', 0),
(5, 'Datang Terlambat', '2015-04-15', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(6, 'Pulang Lebih Awal', '2015-04-15', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(7, 'Lain-lain', '2015-04-15', 1, '0000-00-00', 0, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kg_kehadiran`
--

CREATE TABLE IF NOT EXISTS `kg_kehadiran` (
`id` bigint(20) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `scan` datetime DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marital`
--

CREATE TABLE IF NOT EXISTS `marital` (
`id` tinyint(2) NOT NULL,
  `title` varchar(254) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital`
--

INSERT INTO `marital` (`id`, `title`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Single', 0, '0000-00-00 00:00:00', 0),
(2, 'Married', 0, '0000-00-00 00:00:00', 0),
(3, 'Divorced', 0, '0000-00-00 00:00:00', 0),
(4, 'Widowhood', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mchid`
--

CREATE TABLE IF NOT EXISTS `mchid` (
  `nik` varchar(255) NOT NULL,
  `mchID` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mchid`
--

INSERT INTO `mchid` (`nik`, `mchID`) VALUES
('P0011     ', '0020   '),
('P0017     ', '0021   '),
('P0040     ', '0023   '),
('J0030     ', '0024   '),
('P0028     ', '0101   '),
('P0035     ', '0102   '),
('P0038     ', '0103   '),
('P0136     ', '0104   '),
('P0448     ', '0106   '),
('P0477     ', '0107   '),
('P0769     ', '0108   '),
('P0740     ', '0109   '),
('P0424     ', '0110   '),
('P0056     ', '0111   '),
('P0095     ', '0112   '),
('P0389     ', '0113   '),
('P0067     ', '0116   '),
('P0586     ', '0118   '),
('B0003     ', '0301   '),
('P0054     ', '0302   '),
('P0081     ', '0303   '),
('P0093     ', '0304   '),
('Y0008     ', '0305   '),
('P0493     ', '0307   '),
('P0151     ', '0402   '),
('P0501     ', '0404   '),
('P0159     ', '0405   '),
('P0974     ', '0406   '),
('P0076     ', '0501   '),
('P0097     ', '0601   '),
('P0006     ', '0602   '),
('P0090     ', '0603   '),
('P0099     ', '0604   '),
('P0111     ', '0605   '),
('P0117     ', '0606   '),
('P0121     ', '0607   '),
('P0122     ', '0608   '),
('P0140     ', '0609   '),
('P0193     ', '0610   '),
('P0236     ', '0611   '),
('P0250     ', '0612   '),
('P0349     ', '0613   '),
('P0413     ', '0616   '),
('P0416     ', '0619   '),
('P0421     ', '0621   '),
('P0595     ', '0625   '),
('P0650     ', '0626   '),
('P0765     ', '0630   '),
('P0773     ', '0632   '),
('P0125     ', '0801   '),
('P0098     ', '0802   '),
('P0156     ', '0803   '),
('P0229     ', '0804   '),
('P0230     ', '0805   '),
('P0272     ', '0807   '),
('P0347     ', '0808   '),
('P0490     ', '0809   '),
('P0583     ', '0812   '),
('P0734     ', '0814   '),
('P0788     ', '0819   '),
('P0078     ', '1001   '),
('P0192     ', '1004   '),
('P0226     ', '1005   '),
('P0228     ', '1006   '),
('P0249     ', '1007   '),
('P0314     ', '1008   '),
('P0319     ', '1009   '),
('P0433     ', '1012   '),
('P0789     ', '1024   '),
('P0798     ', '1027   '),
('P0806     ', '1030   '),
('P0808     ', '1031   '),
('P0976     ', '1034   '),
('P0979     ', '1037   '),
('P0594     ', '1041   '),
('P1019     ', '1047   '),
('P0089     ', '1203   '),
('P0109     ', '1204   '),
('P0142     ', '1205   '),
('P0200     ', '1206   '),
('P0358     ', '1209   '),
('P0646     ', '1210   '),
('P0782     ', '1214   '),
('P0783     ', '1215   '),
('P0791     ', '1216   '),
('P0039     ', '1402   '),
('P0087     ', '1403   '),
('P0100     ', '1404   '),
('P0101     ', '1405   '),
('P0102     ', '1406   '),
('P0103     ', '1407   '),
('P0114     ', '1408   '),
('P0204     ', '1410   '),
('P0232     ', '1412   '),
('P0242     ', '1414   '),
('P0244     ', '1415   '),
('P0245     ', '1416   '),
('P0248     ', '1417   '),
('P0259     ', '1418   '),
('P0327     ', '1419   '),
('P0444     ', '1420   '),
('P0600     ', '1421   '),
('P0596     ', '1423   '),
('P0785     ', '1427   '),
('P0786     ', '1428   '),
('P0084     ', '1431   '),
('P0237     ', '1432   '),
('P0238     ', '1433   '),
('P0085     ', '1440   '),
('P0491     ', '1441   '),
('P0492     ', '1442   '),
('P0023     ', '1601   '),
('P0045     ', '1602   '),
('P0052     ', '1603   '),
('P0060     ', '1604   '),
('P0381     ', '1605   '),
('P0221     ', '1755   '),
('P0252     ', '1756   '),
('P0584     ', '1758   '),
('P0971     ', '1763   '),
('P0957     ', '1908   '),
('J0075     ', '2002   '),
('P0092     ', '2003   '),
('P0120     ', '2004   '),
('P0139     ', '2005   '),
('P0380     ', '2007   '),
('P0437     ', '2008   '),
('J0478     ', '2009   '),
('J0481     ', '2010   '),
('P0873     ', '2012   '),
('J1554     ', '2013   '),
('P0388     ', '2015   '),
('J0042     ', '2016   '),
('P0196     ', '2101   '),
('P0810     ', '2102   '),
('P0400     ', '2151   '),
('P0775     ', '2152   '),
('P0037     ', '2201   '),
('P0046     ', '2202   '),
('P0116     ', '2203   '),
('P0132     ', '2204   '),
('P0148     ', '2205   '),
('P0160     ', '2206   '),
('P0165     ', '2207   '),
('P0169     ', '2208   '),
('P0190     ', '2209   '),
('P0209     ', '2210   '),
('P0218     ', '2211   '),
('P0222     ', '2212   '),
('P0223     ', '2213   '),
('P0379     ', '2214   '),
('P0435     ', '2216   '),
('P0436     ', '2217   '),
('P0510     ', '2218   '),
('P0024     ', '2302   '),
('P0050     ', '2303   '),
('P0055     ', '2304   '),
('P0082     ', '2307   '),
('P0164     ', '2309   '),
('P0208     ', '2310   '),
('P0211     ', '2311   '),
('P0291     ', '2313   '),
('P0768     ', '2315   '),
('P0395     ', '2316   '),
('P0514     ', '2318   '),
('P0529     ', '2319   '),
('P0673     ', '2320   '),
('P0191     ', '2322   '),
('P0996     ', '2323   '),
('P0997     ', '2324   '),
('P0158     ', '2326   '),
('P0066     ', '2327   '),
('P0998     ', '2328   '),
('P0999     ', '2329   '),
('P0471     ', '2330   '),
('P0018     ', '2332   '),
('P0346     ', '2333   '),
('P0545     ', '2335   '),
('P0474     ', '2336   '),
('P0394     ', '2338   '),
('P0566     ', '2401   '),
('P0059     ', '2402   '),
('P0086     ', '2451   '),
('P0206     ', '2452   '),
('P0224     ', '2453   '),
('P0014     ', '2501   '),
('J0849     ', '2601   '),
('J0711     ', '2602   '),
('P1035     ', '2603   '),
('P0047     ', '2605   '),
('P1024     ', '2608   '),
('2609      ', '2609   '),
('P1025     ', '2610   '),
('J0676     ', '2612   '),
('P1033     ', '2614   '),
('P0112     ', '3001   '),
('B0028     ', '3003   '),
('J0003     ', '3004   '),
('J0041     ', '3005   '),
('J0062     ', '3006   '),
('J0070     ', '3007   '),
('J0074     ', '3008   '),
('J0108     ', '3010   '),
('J0143     ', '3012   '),
('J0150     ', '3013   '),
('J0289     ', '3026   '),
('J0309     ', '3028   '),
('J0324     ', '3032   '),
('J0328     ', '3034   '),
('J0335     ', '3037   '),
('J0370     ', '3043   '),
('J0372     ', '3044   '),
('J0405     ', '3048   '),
('J0423     ', '3051   '),
('J0425     ', '3052   '),
('J0449     ', '3053   '),
('J0453     ', '3056   '),
('J0454     ', '3057   '),
('J0458     ', '3058   '),
('J0479     ', '3062   '),
('J0482     ', '3063   '),
('J0502     ', '3065   '),
('J0507     ', '3067   '),
('J0525     ', '3074   '),
('J0528     ', '3076   '),
('J0540     ', '3079   '),
('J0575     ', '3081   '),
('J0612     ', '3083   '),
('J0630     ', '3091   '),
('J0632     ', '3092   '),
('J0641     ', '3094   '),
('J0645     ', '3096   '),
('J0647     ', '3097   '),
('J0661     ', '3100   '),
('J0663     ', '3101   '),
('J0670     ', '3103   '),
('J0829     ', '3111   '),
('J0830     ', '3112   '),
('J0850     ', '3117   '),
('J0860     ', '3119   '),
('J0862     ', '3120   '),
('J0864     ', '3121   '),
('J0869     ', '3124   '),
('J0872     ', '3125   '),
('J0886     ', '3129   '),
('J0894     ', '3132   '),
('J0898     ', '3134   '),
('J0901     ', '3136   '),
('J0903     ', '3137   '),
('J0940     ', '3147   '),
('J1165     ', '3158   '),
('J1187     ', '3160   '),
('L0004     ', '3161   '),
('P0227     ', '3162   '),
('J0064     ', '4002   '),
('J0068     ', '4003   '),
('J0118     ', '4008   '),
('J0213     ', '4018   '),
('J0246     ', '4021   '),
('J0265     ', '4026   '),
('J0276     ', '4029   '),
('J0277     ', '4030   '),
('J0282     ', '4032   '),
('J0288     ', '4034   '),
('J0293     ', '4035   '),
('J0323     ', '4048   '),
('J0325     ', '4049   '),
('J0332     ', '4051   '),
('J0339     ', '4054   '),
('J0500     ', '4076   '),
('J0524     ', '4084   '),
('J0532     ', '4085   '),
('J0539     ', '4088   '),
('J0637     ', '4097   '),
('J0729     ', '4108   '),
('J0827     ', '4112   '),
('J0836     ', '4114   '),
('J0846     ', '4118   '),
('J0856     ', '4122   '),
('J0857     ', '4123   '),
('J0858     ', '4124   '),
('J0859     ', '4125   '),
('J0863     ', '4126   '),
('J0868     ', '4127   '),
('J0871     ', '4128   '),
('J0890     ', '4133   '),
('J0895     ', '4135   '),
('J0896     ', '4136   '),
('J0902     ', '4137   '),
('J0960     ', '4155   '),
('P1973     ', '4169   '),
('J1240     ', '4174   '),
('J0636     ', '4177   '),
('M0023     ', '4178   '),
('P0031     ', '5001   '),
('P0027     ', '5002   '),
('P0262     ', '5003   '),
('P0269     ', '5004   '),
('P0343     ', '5005   '),
('P1000     ', '5007   '),
('J0004     ', '5008   '),
('J0015     ', '5010   '),
('J0053     ', '5012   '),
('J0071     ', '5013   '),
('J0094     ', '5015   '),
('J0096     ', '5016   '),
('J0385     ', '5019   '),
('J0386     ', '5020   '),
('J0569     ', '5021   '),
('J1128     ', '5022   '),
('J0036     ', '5103   '),
('J0588     ', '5106   '),
('J0134     ', '5108   '),
('J0536     ', '5109   '),
('J0565     ', '5110   '),
('J0007     ', '5201   '),
('J0083     ', '5202   '),
('J0129     ', '5203   '),
('J0194     ', '5204   '),
('J0340     ', '5205   '),
('P0063     ', '5206   '),
('J0048     ', '5301   '),
('J0058     ', '5302   '),
('J0119     ', '5303   '),
('J0133     ', '5304   '),
('J0225     ', '5308   '),
('J0342     ', '5310   '),
('J0472     ', '5312   '),
('J0543     ', '5316   '),
('J0693     ', '5319   '),
('J0816     ', '5323   '),
('J0964     ', '5325   '),
('J1153     ', '5328   '),
('J0215     ', '5501   '),
('J0384     ', '5502   '),
('J0383     ', '5503   '),
('J0396     ', '5504   '),
('J1678     ', '5506   '),
('J0561     ', '5515   '),
('J0719     ', '5517   '),
('J2284     ', '5518   '),
('J0714     ', '5519   '),
('J0821     ', '5526   '),
('J1137     ', '5532   '),
('J0682     ', '5542   '),
('J0470     ', '5543   '),
('J0009     ', '5546   '),
('J0131     ', '5547   '),
('J0170     ', '5548   '),
('J0188     ', '5549   '),
('J0195     ', '5550   '),
('J0197     ', '5551   '),
('J0146     ', '5552   '),
('J0145     ', '5553   '),
('J0189     ', '5554   '),
('J0012     ', '5555   '),
('J0123     ', '1767   '),
('P1010     ', '1914   '),
('J1293     ', '3191   '),
('3192      ', '3192   '),
('J1368     ', '3193   '),
('3167      ', '3167   '),
('J1514     ', '5331   '),
('P0393     ', '3333   '),
('5112      ', '5112   '),
('J1302     ', '3187   '),
('J1299     ', '3179   '),
('J1287     ', '3178   '),
('J1238     ', '3168   '),
('J1347     ', '4219   '),
('J1319     ', '4197   '),
('J1344     ', '4206   '),
('4203      ', '4203   '),
('P0776     ', '2339   '),
('J1370     ', '4231   '),
('J1409     ', '4207   '),
('J0819     ', '1608   '),
('J1150     ', '5330   '),
('P1028     ', '2615   '),
('P0674     ', '2340   '),
('J0718     ', '2220   '),
('P1009     ', '0829   '),
('2622      ', '2622   '),
('J0080     ', '5014   '),
('P1056     ', '0115   '),
('P0263     ', '2312   '),
('P0292     ', '2314   '),
('P0155     ', '2308   '),
('P0672     ', '2331   '),
('P0426     ', '2334   '),
('J0356     ', '3039   '),
('P1014     ', '2404   '),
('P1042     ', '0119   '),
('J1492     ', '5113   '),
('P1043     ', '1049   '),
('P1020     ', '0831   '),
('2624      ', '2624   '),
('J1393     ', '3200   '),
('J1401     ', '3201   '),
('P1045     ', '2625   '),
('J1396     ', '4233   '),
('P0731     ', '2626   '),
('J1419     ', '5557   '),
('3205      ', '3205   '),
('P1048     ', '5025   '),
('J1473     ', '5026   '),
('P1050     ', '2627   '),
('G0023     ', '3207   '),
('4237      ', '4237   '),
('M0041     ', '4238   '),
('J1477     ', '4239   '),
('J1478     ', '4240   '),
('3212      ', '3212   '),
('3213      ', '3213   '),
('J1516     ', '3214   '),
('3215      ', '3215   '),
('P1059     ', '2628   '),
('J1509     ', '3216   '),
('P1060     ', '2629   '),
('J1480     ', '3218   '),
('P1047     ', '5333   '),
('J1410     ', '5334   '),
('J1487     ', '3220   '),
('P1052     ', '0407   '),
('3221      ', '3221   '),
('4242      ', '4242   '),
('J1494     ', '5115   '),
('P1061     ', '2630   '),
('J1432     ', '5335   '),
('J1525     ', '3222   '),
('K0005     ', '2155   '),
('J0317     ', '3030   '),
('J0202     ', '4016   '),
('J1510     ', '3224   '),
('J1511     ', '3225   '),
('P1063     ', '2633   '),
('Y0032     ', '3226   '),
('J1515     ', '4246   '),
('J1522     ', '4249   '),
('J1534     ', '5336   '),
('3227      ', '3227   '),
('2635      ', '2635   '),
('P1085     ', '0409   '),
('J1558     ', '4250   '),
('J1553     ', '5337   '),
('2637      ', '2637   '),
('P1080     ', '2639   '),
('P1091     ', '2640   '),
('P1090     ', '1055   '),
('J1570     ', '3229   '),
('J1573     ', '3234   '),
('2642      ', '2642   '),
('P1098     ', '1919   '),
('P1104     ', '1920   '),
('J1544     ', '5208   '),
('J1581     ', '4251   '),
('3235      ', '3235   '),
('J1588     ', '4254   '),
('P1105     ', '1056   '),
('J1620     ', '5564   '),
('5565      ', '5565   '),
('J1622     ', '5566   '),
('J1624     ', '5568   '),
('J1625     ', '5569   '),
('J1626     ', '5570   '),
('J1633     ', '5573   '),
('J1635     ', '5575   '),
('5576      ', '5576   '),
('J1594     ', '4256   '),
('P1124     ', '1922   '),
('J1646     ', '4258   '),
('J1645     ', '5117   '),
('J1608     ', '5580   '),
('J1421     ', '5581   '),
('J1440     ', '5582   '),
('J1431     ', '5583   '),
('J1456     ', '5584   '),
('J0726     ', '5585   '),
('P1112     ', '1058   '),
('P1111     ', '1059   '),
('J1642     ', '3238   '),
('J1657     ', '4260   '),
('J1663     ', '4261   '),
('P1113     ', '0503   '),
('P1114     ', '0504   '),
('4262      ', '4262   '),
('P1131     ', '1060   '),
('J1545     ', '3239   '),
('G0012     ', '1768   '),
('P1133     ', '1062   '),
('P1120     ', '1063   '),
('P1142     ', '1064   '),
('P1068     ', '2644   '),
('P1140     ', '2645   '),
('2647      ', '2647   '),
('J0279     ', '2648   '),
('J0180     ', '3240   '),
('J0970     ', '4263   '),
('M0034     ', '4264   '),
('J1671     ', '4268   '),
('P1141     ', '1065   '),
('J1679     ', '3241   '),
('J1684     ', '4269   '),
('P1152     ', '1923   '),
('P1092     ', '2154   '),
('J1699     ', '4271   '),
('J1683     ', '4272   '),
('P1149     ', '2649   '),
('J0624     ', '1609   '),
('5332      ', '5332   '),
('5338      ', '5338   '),
('J2326     ', '5339   '),
('5341      ', '5341   '),
('5342      ', '5342   '),
('J1641     ', '5343   '),
('J1681     ', '4274   '),
('J1712     ', '4277   '),
('J1716     ', '4278   '),
('3243      ', '3243   '),
('J1667     ', '5029   '),
('J1690     ', '3244   '),
('3157      ', '3157   '),
('J1664     ', '5540   '),
('J1702     ', '3249   '),
('3250      ', '3250   '),
('2345      ', '2345   '),
('P1094     ', '2650   '),
('P1158     ', '2653   '),
('J1672     ', '8133   '),
('J1732     ', '3248   '),
('P1162     ', '1925   '),
('J1726     ', '4288   '),
('J1649     ', '3247   '),
('J1688     ', '3245   '),
('J0456     ', '8069   '),
('P1171     ', '2656   '),
('J1718     ', '4284   '),
('J1744     ', '4289   '),
('J1704     ', '4281   '),
('J1705     ', '4282   '),
('J1730     ', '4290   '),
('J1682     ', '2022   '),
('J1796     ', '4291   '),
('P1186     ', '0410   '),
('J1749     ', '4294   '),
('J1758     ', '4295   '),
('P1199     ', '0638   '),
('P1203     ', '0642   '),
('P1182     ', '1069   '),
('P1183     ', '1070   '),
('J1790     ', '5032   '),
('P1184     ', '5033   '),
('J1764     ', '4298   '),
('J1759     ', '3252   '),
('J1748     ', '4299   '),
('4300      ', '4300   '),
('P1169     ', '2658   '),
('J1779     ', '3253   '),
('J1788     ', '3254   '),
('P1187     ', '1443   '),
('J1773     ', '4304   '),
('3255      ', '3255   '),
('J1778     ', '3256   '),
('J1783     ', '3257   '),
('J1812     ', '4305   '),
('P1215     ', '2156   '),
('P1216     ', '2157   '),
('P1233     ', '1071   '),
('P1185     ', '2023   '),
('J1185     ', '4307   '),
('J1829     ', '4309   '),
('J1474     ', '2021   '),
('P1241     ', '2025   '),
('J1781     ', '3259   '),
('P1218     ', '2346   '),
('J1878     ', '5209   '),
('5120      ', '5120   '),
('J1776     ', '5586   '),
('5588      ', '5588   '),
('J1845     ', '4310   '),
('J1883     ', '5121   '),
('J1821     ', '3260   '),
('P1247     ', '1444   '),
('P1254     ', '2027   '),
('P1253     ', '2029   '),
('J1876     ', '5035   '),
('P1214     ', '1218   '),
('3261      ', '3261   '),
('J1784     ', '4311   '),
('P1256     ', '1613   '),
('J1820     ', '4313   '),
('J1855     ', '4314   '),
('3262      ', '3262   '),
('P1030     ', '2618   '),
('P1266     ', '2660   '),
('J1746     ', '3263   '),
('J1857     ', '4315   '),
('P1145     ', '2343   '),
('P1267     ', '2454   '),
('P1289     ', '2030   '),
('P1178     ', '5210   '),
('J1800     ', '5211   '),
('J1897     ', '5212   '),
('J1799     ', '5213   '),
('P1177     ', '5214   '),
('J1898     ', '5216   '),
('P1176     ', '5217   '),
('5219      ', '5219   '),
('P1280     ', '0835   '),
('P1285     ', '0836   '),
('P1283     ', '0837   '),
('P1282     ', '0643   '),
('P1279     ', '0644   '),
('P1284     ', '0838   '),
('P1278     ', '0646   '),
('P1305     ', '1073   '),
('2661      ', '2661   '),
('2662      ', '2662   '),
('2663      ', '2663   '),
('J1879     ', '2664   '),
('P1180     ', '2665   '),
('P1172     ', '2666   '),
('P1300     ', '1928   '),
('P1302     ', '0648   '),
('P1295     ', '2455   '),
('G0019     ', '0317   '),
('S0005     ', '4316   '),
('D0001     ', '3264   '),
('P1208     ', '2233   '),
('P1220     ', '2234   '),
('P1272     ', '2412   '),
('P1257     ', '1614   '),
('P1275     ', '2667   '),
('P1029     ', '2620   '),
('P1309     ', '2159   '),
('J0300     ', '4039   '),
('J0365     ', '3041   '),
('J0321     ', '4046   '),
('P1259     ', '2668   '),
('P1323     ', '2032   '),
('P1078     ', '2669   '),
('5589      ', '5589   '),
('5591      ', '5591   '),
('J1864     ', '5592   '),
('5593      ', '5593   '),
('5594      ', '5594   '),
('5596      ', '5596   '),
('J1846     ', '5597   '),
('J1872     ', '5598   '),
('J1852     ', '5344   '),
('J1851     ', '5345   '),
('P1674     ', '5346   '),
('J1824     ', '5347   '),
('J1893     ', '5348   '),
('K0002     ', '0027   '),
('G0034     ', '0028   '),
('P1291     ', '1075   '),
('P1335     ', '2033   '),
('J1919     ', '4317   '),
('J1916     ', '4318   '),
('J1917     ', '4319   '),
('J1918     ', '4320   '),
('4323      ', '4323   '),
('J1960     ', '4321   '),
('J1959     ', '4322   '),
('J1915     ', '3265   '),
('J1932     ', '3266   '),
('J1938     ', '3267   '),
('J1936     ', '3268   '),
('J1934     ', '3269   '),
('J1933     ', '3270   '),
('J1935     ', '3271   '),
('J0157     ', '3272   '),
('3273      ', '3273   '),
('3274      ', '3274   '),
('P1326     ', '2670   '),
('2671      ', '2671   '),
('P0422     ', '5123   '),
('P1360     ', '2672   '),
('P1328     ', '2673   '),
('2674      ', '2674   '),
('P1076     ', '2675   '),
('P1334     ', '2034   '),
('P1336     ', '1931   '),
('P1337     ', '1932   '),
('P1338     ', '0649   '),
('P1346     ', '0651   '),
('P1339     ', '0653   '),
('P1321     ', '5036   '),
('P1324     ', '5037   '),
('P1333     ', '1616   '),
('P1359     ', '2414   '),
('P1325     ', '2160   '),
('P1365     ', '1617   '),
('P1341     ', '0412   '),
('J1929     ', '3275   '),
('J1930     ', '3276   '),
('J1931     ', '3277   '),
('3278      ', '3278   '),
('3279      ', '3279   '),
('3280      ', '3280   '),
('3281      ', '3281   '),
('3282      ', '3282   '),
('3284      ', '3284   '),
('3286      ', '3286   '),
('3287      ', '3287   '),
('3288      ', '3288   '),
('3289      ', '3289   '),
('J2002     ', '3290   '),
('3291      ', '3291   '),
('J2020     ', '3293   '),
('3294      ', '3294   '),
('2676      ', '2676   '),
('P1374     ', '2677   '),
('2678      ', '2678   '),
('P1362     ', '2679   '),
('P1315     ', '2348   '),
('P1296     ', '2350   '),
('2351      ', '2351   '),
('J1999     ', '4324   '),
('4325      ', '4325   '),
('J1998     ', '4326   '),
('J1980     ', '4327   '),
('4328      ', '4328   '),
('J1978     ', '3297   '),
('J1979     ', '3298   '),
('J2009     ', '3299   '),
('P1369     ', '1076   '),
('P1364     ', '1618   '),
('P1370     ', '1445   '),
('P1345     ', '1446   '),
('P1274     ', '2352   '),
('P1357     ', '2035   '),
('J0628     ', '4093   '),
('P1384     ', '1077   '),
('P1402     ', '1477   '),
('P1401     ', '2416   '),
('P1368     ', '2681   '),
('P1393     ', '2682   '),
('3301      ', '3301   '),
('J2037     ', '4330   '),
('J2033     ', '3302   '),
('J2031     ', '3303   '),
('J2032     ', '3304   '),
('J2039     ', '3305   '),
('P1416     ', '1078   '),
('P1385     ', '1080   '),
('P1436     ', '2684   '),
('P1434     ', '0120   '),
('P1433     ', '2036   '),
('P1437     ', '2685   '),
('G0024     ', '2503   '),
('P1493     ', '8168   '),
('P1463     ', '8170   '),
('P1469     ', '8171   '),
('P1468     ', '8172   '),
('P1466     ', '8173   '),
('P1465     ', '8174   '),
('P1459     ', '8175   '),
('P1445     ', '8181   '),
('P1439     ', '2688   '),
('P1395     ', '2687   '),
('P1444     ', '8155   '),
('P1455     ', '8182   '),
('8183      ', '8183   '),
('P1441     ', '8159   '),
('P1492     ', '8184   '),
('P1505     ', '8185   '),
('P1503     ', '8186   '),
('P1506     ', '8187   '),
('P1508     ', '8189   '),
('P1513     ', '8190   '),
('P1415     ', '8176   '),
('P1454     ', '8192   '),
('J2129     ', '8193   '),
('P1517     ', '8194   '),
('J2093     ', '8195   '),
('P1518     ', '8196   '),
('P1519     ', '8197   '),
('P1497     ', '8198   '),
('P1522     ', '5623   '),
('J2786     ', '5624   '),
('5625      ', '5625   '),
('P1525     ', '5626   '),
('P1526     ', '5627   '),
('J2074     ', '5628   '),
('J2120     ', '5629   '),
('P1394     ', '5631   '),
('P1404     ', '5632   '),
('P1538     ', '5633   '),
('P1502     ', '5634   '),
('P1536     ', '5635   '),
('P1535     ', '5636   '),
('M0007     ', '5630   '),
('B0018     ', '5637   '),
('P1534     ', '5638   '),
('5639      ', '5639   '),
('J2151     ', '5643   '),
('P1528     ', '5644   '),
('5646      ', '5646   '),
('J2140     ', '5647   '),
('J2141     ', '5648   '),
('J2142     ', '5649   '),
('P1540     ', '5650   '),
('P1510     ', '5651   '),
('5652      ', '5652   '),
('5653      ', '5653   '),
('J2136     ', '5654   '),
('5655      ', '5655   '),
('P1539     ', '5656   '),
('P1546     ', '5659   '),
('J2149     ', '5660   '),
('P1382     ', '5661   '),
('J2147     ', '5662   '),
('P1378     ', '5616   '),
('P1821     ', '5657   '),
('P1514     ', '5663   '),
('P1887     ', '5664   '),
('P1555     ', '5665   '),
('5666      ', '5666   '),
('P1556     ', '5668   '),
('5669      ', '5669   '),
('P1551     ', '5670   '),
('P1553     ', '5671   '),
('J2170     ', '5672   '),
('J2171     ', '5674   '),
('J0124     ', '2502   '),
('J2178     ', '5675   '),
('J2187     ', '5676   '),
('J2184     ', '5677   '),
('J2192     ', '5678   '),
('P1410     ', '5613   '),
('P1411     ', '5620   '),
('J2188     ', '5679   '),
('P1568     ', '5680   '),
('P1563     ', '5681   '),
('P1565     ', '5682   '),
('P1495     ', '5683   '),
('J0299     ', '8055   '),
('J1489     ', '3156   '),
('P1575     ', '5684   '),
('P1579     ', '5685   '),
('M0106     ', '5686   '),
('J1146     ', '5522   '),
('J0505     ', '8036   '),
('J2130     ', '5687   '),
('P1572     ', '5688   '),
('P1562     ', '5689   '),
('J1807     ', '4312   '),
('J2077     ', '5690   '),
('J2059     ', '5599   '),
('J2102     ', '5691   '),
('J2113     ', '5692   '),
('J2049     ', '5612   '),
('J2073     ', '8161   '),
('P1617     ', '5695   '),
('P1550     ', '5658   '),
('P1498     ', '5696   '),
('J2106     ', '5693   '),
('J2065     ', '8166   '),
('J2072     ', '8162   '),
('J2081     ', '5694   '),
('J2046     ', '5611   '),
('P1317     ', '5697   '),
('P1629     ', '5698   '),
('P1566     ', '5699   '),
('P1645     ', '5700   '),
('J2121     ', '5701   '),
('J2080     ', '5702   '),
('P1670     ', '5703   '),
('J1171     ', '4160   '),
('P1639     ', '5704   '),
('P1583     ', '5705   '),
('P1632     ', '5706   '),
('P1667     ', '5707   '),
('P1635     ', '5708   '),
('P1641     ', '5709   '),
('P1537     ', '5710   '),
('P1630     ', '5711   '),
('P1668     ', '5712   '),
('P1594     ', '5713   '),
('P1652     ', '5714   '),
('P1662     ', '5715   '),
('P1593     ', '5716   '),
('P1679     ', '5717   '),
('P1669     ', '5718   '),
('J2234     ', '5719   '),
('J2257     ', '5720   '),
('P1661     ', '5721   '),
('J2258     ', '5722   '),
('P1680     ', '5723   '),
('J2240     ', '5724   '),
('P1651     ', '5725   '),
('J2265     ', '5726   '),
('P1127     ', '1765   '),
('P1103     ', '4115   '),
('J2266     ', '5727   '),
('P1688     ', '5729   '),
('P1689     ', '5730   '),
('P1690     ', '5728   '),
('J2209     ', '5731   '),
('J2267     ', '5732   '),
('J0186     ', '2616   '),
('P1692     ', '5733   '),
('P1691     ', '5734   '),
('P1671     ', '5735   '),
('P1713     ', '5736   '),
('J2237     ', '5737   '),
('J2189     ', '5738   '),
('P1701     ', '5739   '),
('5740      ', 'J217   '),
('5741      ', 'J216   '),
('J2175     ', '5740   '),
('J2167     ', '5741   '),
('P1695     ', '5742   '),
('P1726     ', '5743   '),
('5642      ', '5642   '),
('5595      ', '5595   '),
('J2323     ', '5744   '),
('P1702     ', '5745   '),
('P1729     ', '5746   '),
('P1666     ', '5747   '),
('P1733     ', '5748   '),
('J2186     ', '5749   '),
('J2317     ', '5750   '),
('P1735     ', '5751   '),
('P1722     ', '5752   '),
('P1743     ', '5754   '),
('5753      ', '5753   '),
('P1744     ', '5755   '),
('P1688     ', '5729   '),
('P1742     ', '5753   '),
('P1717     ', '5756   '),
('P1705     ', '5757   '),
('P1706     ', '5758   '),
('P1745     ', '5759   '),
('P1734     ', '5760   '),
('P1746     ', '5761   '),
('P1756     ', '5762   '),
('P1758     ', '5763   '),
('P1757     ', '5764   '),
('J2330     ', '5765   '),
('J2311     ', '5766   '),
('J2239     ', '5767   '),
('J2232     ', '5768   '),
('J2195     ', '5769   '),
('J2190     ', '5770   '),
('J2263     ', '5771   '),
('J2087     ', '5773   '),
('J2236     ', '5774   '),
('J2329     ', '5775   '),
('J2277     ', '5776   '),
('J2177     ', '5777   '),
('P1741     ', '5778   '),
('J2318     ', '5779   '),
('P1527     ', '5780   '),
('P1582     ', '5781   '),
('J2324     ', '5782   '),
('P1687     ', '5783   '),
('J2227     ', '5784   '),
('P1520     ', '5785   '),
('P1732     ', '5786   '),
('P1512     ', '5787   '),
('J2328     ', '5788   '),
('J2334     ', '5789   '),
('J2210     ', '5772   '),
('P1558     ', '5790   '),
('5642      ', '5642   '),
('2609      ', '2609   '),
('4277      ', '4277   '),
('P1759     ', '5791   '),
('P1760     ', '5792   '),
('P1755     ', '5793   '),
('P1268     ', '5794   '),
('P1116     ', '5796   '),
('0000      ', '0000   '),
('P1748     ', '5797   '),
('J2339     ', '5798   '),
('Y0043     ', '5799   '),
('P1764     ', '5800   '),
('P1763     ', '5801   '),
('2676      ', '2676   '),
('P1752     ', '5802   '),
('J2340     ', '5803   '),
('J1662     ', '3113   '),
('J1914     ', '5804   '),
('J1858     ', '5805   '),
('J1869     ', '5806   '),
('P1117     ', '1026   '),
('J2092     ', '5807   '),
('J1856     ', '5808   '),
('J1949     ', '5809   '),
('J1763     ', '5810   '),
('J1178     ', '4166   '),
('P1765     ', '5811   '),
('D0011     ', '5812   '),
('P1751     ', '5813   '),
('J1952     ', '5814   '),
('J1904     ', '5815   '),
('P1616     ', '5816   '),
('P1785     ', '5817   '),
('P1640     ', '5818   '),
('P1615     ', '5819   '),
('P1786     ', '5820   '),
('P1784     ', '5821   '),
('J2341     ', '5822   '),
('J2345     ', '5823   '),
('J2344     ', '5824   '),
('J0281     ', '5825   '),
('J2325     ', '5826   '),
('J1407     ', '4234   '),
('J2287     ', '5827   '),
('J2290     ', '5828   '),
('J2291     ', '5829   '),
('J2292     ', '5830   '),
('J2327     ', '5831   '),
('J2248     ', '5832   '),
('J2288     ', '5833   '),
('J2247     ', '5834   '),
('J2246     ', '5835   '),
('J2289     ', '5836   '),
('J2250     ', '5837   '),
('J2256     ', '5838   '),
('P1788     ', '5839   '),
('J2245     ', '5840   '),
('J2304     ', '5841   '),
('J2243     ', '5842   '),
('J2280     ', '5843   '),
('J2283     ', '5844   '),
('J2255     ', '5845   '),
('P1213     ', '5846   '),
('J2268     ', '5848   '),
('P1787     ', '5850   '),
('5847      ', '5847   '),
('8197      ', '8197   '),
('J1665     ', '3135   '),
('J1866     ', '5849   '),
('P1767     ', '5851   '),
('2102      ', '2102   '),
('P1749     ', '5852   '),
('P1769     ', '5853   '),
('P1773     ', '5854   '),
('P1772     ', '5855   '),
('5112      ', '5112   '),
('2671      ', '2671   '),
('2675      ', '2675   '),
('J2269     ', '5856   '),
('J2360     ', '5857   '),
('J2361     ', '5858   '),
('3227      ', '3227   '),
('P1777     ', '5859   '),
('J2359     ', '5860   '),
('J2356     ', '5861   '),
('J2358     ', '5862   '),
('P1771     ', '5863   '),
('J2365     ', '5865   '),
('J2366     ', '5866   '),
('J2367     ', '5867   '),
('P1779     ', '5868   '),
('J2296     ', '5869   '),
('P1684     ', '5603   '),
('2676      ', '2676   '),
('4242      ', '4242   '),
('5591      ', '5591   '),
('5596      ', '5596   '),
('5653      ', '5653   '),
('P1211     ', '5870   '),
('J2370     ', '5871   '),
('3037      ', '3037   '),
('3226      ', '3226   '),
('J2371     ', '5872   '),
('P1780     ', '5873   '),
('J2372     ', '5874   '),
('J2375     ', '5875   '),
('J2376     ', '5876   '),
('5877      ', '5877   '),
('J2377     ', '5878   '),
('J2382     ', '5879   '),
('P1781     ', '5880   '),
('J2385     ', '5881   '),
('J2384     ', '5882   '),
('J2383     ', '5883   '),
('J2389     ', '5884   '),
('J2388     ', '5885   '),
('J2378     ', '5886   '),
('J2379     ', '5887   '),
('P1766     ', '5889   '),
('P1685     ', '5890   '),
('P1782     ', '5891   '),
('P1696     ', '5892   '),
('J2399     ', '5893   '),
('J2402     ', '5894   '),
('J2403     ', '5895   '),
('J2401     ', '5896   '),
('J2409     ', '5897   '),
('J2196     ', '5898   '),
('J2404     ', '5899   '),
('J2411     ', '5900   '),
('J2412     ', '5901   '),
('J2416     ', '5902   '),
('J2417     ', '5903   '),
('J2424     ', '5904   '),
('J2425     ', '5905   '),
('J2426     ', '5906   '),
('J2427     ', '5907   '),
('J2428     ', '5908   '),
('J2418     ', '5909   '),
('J2419     ', '5910   '),
('J2430     ', '5911   '),
('J2431     ', '5912   '),
('J2434     ', '5913   '),
('J2433     ', '5914   '),
('J2432     ', '5915   '),
('J2436     ', '5916   '),
('J2410     ', '5917   '),
('J2443     ', '5918   '),
('J2444     ', '5919   '),
('J2445     ', '5920   '),
('J2446     ', '5921   '),
('J2447     ', '5922   '),
('J2448     ', '5923   '),
('P1789     ', '5924   '),
('J2455     ', '5925   '),
('J2460     ', '5926   '),
('J2457     ', '5927   '),
('J2459     ', '5928   '),
('J2464     ', '5930   '),
('J2463     ', '5929   '),
('J2465     ', '5931   '),
('J2466     ', '5932   '),
('J2467     ', '5933   '),
('P1790     ', '5935   '),
('P1791     ', '5936   '),
('P1792     ', '5937   '),
('J2476     ', '5938   '),
('J2477     ', '5939   '),
('J2475     ', '5940   '),
('J2461     ', '5941   '),
('P1794     ', '5942   '),
('J2482     ', '5943   '),
('J2483     ', '5944   '),
('J2484     ', '5945   '),
('J2478     ', '5946   '),
('J2485     ', '5947   '),
('J2490     ', '5948   '),
('P1795     ', '5949   '),
('J2501     ', '5950   '),
('J2505     ', '5952   '),
('J2502     ', '5953   '),
('J2506     ', '5951   '),
('J2504     ', '5954   '),
('J2510     ', '5955   '),
('J2509     ', '5956   '),
('J2515     ', '5957   '),
('J2513     ', '5958   '),
('J2514     ', '5959   '),
('J2512     ', '5960   '),
('J2518     ', '5961   '),
('J2519     ', '5962   '),
('J2520     ', '5963   '),
('J2522     ', '5964   '),
('P1805     ', '5965   '),
('J2526     ', '5966   '),
('P1807     ', '5967   '),
('P1806     ', '5968   '),
('P1808     ', '5969   '),
('J2464     ', '5970   '),
('5930      ', '5930   '),
('P1800     ', '5971   '),
('P1801     ', '5972   '),
('P1802     ', '5973   '),
('P1803     ', '5974   '),
('P1804     ', '5975   '),
('J2538     ', '5976   '),
('J2539     ', '5977   '),
('P1811     ', '5978   '),
('P1810     ', '5979   '),
('J2533     ', '5980   '),
('J2534     ', '5981   '),
('J2532     ', '5982   '),
('J2527     ', '5983   '),
('J2546     ', '5984   '),
('J2547     ', '5985   '),
('J2548     ', '5986   '),
('J2549     ', '5987   '),
('J2550     ', '5988   '),
('J2551     ', '5989   '),
('J2552     ', '5990   '),
('J2553     ', '5991   '),
('J2554     ', '5992   '),
('J2555     ', '5993   '),
('J2556     ', '5994   '),
('J2557     ', '5995   '),
('J2559     ', '5996   '),
('J2558     ', '5997   '),
('J2560     ', '5998   '),
('J2561     ', '5999   '),
('J2562     ', '6000   '),
('J2563     ', '6001   '),
('J2564     ', '6002   '),
('J2565     ', '6003   '),
('J2566     ', '6004   '),
('J2567     ', '6005   '),
('3235      ', '3235   '),
('J2569     ', '5990   '),
('J2568     ', '6006   '),
('J2571     ', '6008   '),
('J2570     ', '6007   '),
('P1817     ', '6009   '),
('J2574     ', '6010   '),
('J2575     ', '6011   '),
('J2576     ', '6012   '),
('J2577     ', '6013   '),
('6014      ', '6014   '),
('P1816     ', '6015   '),
('P1814     ', '6016   '),
('P1818     ', '6017   '),
('P1819     ', '6018   '),
('J2578     ', '6019   '),
('J2579     ', '6020   '),
('J2580     ', '6021   '),
('J2581     ', '6022   '),
('J2582     ', '6023   '),
('J2583     ', '6024   '),
('J2584     ', '6025   '),
('J2585     ', '6026   '),
('J2586     ', '6027   '),
('J2587     ', '6028   '),
('J2588     ', '6029   '),
('P1822     ', '6030   '),
('J2589     ', '6031   '),
('J2590     ', '6032   '),
('P1820     ', '6033   '),
('P1823     ', '6034   '),
('J2591     ', '6035   '),
('J2594     ', '6038   '),
('J2595     ', '6039   '),
('J2592     ', '6036   '),
('J2593     ', '6037   '),
('J2596     ', '6040   '),
('J2597     ', '6041   '),
('J2598     ', '6042   '),
('J2599     ', '6043   '),
('J2600     ', '6044   '),
('J2601     ', '6045   '),
('J2602     ', '6046   '),
('J2603     ', '6047   '),
('J2604     ', '6048   '),
('P1826     ', '6049   '),
('P1824     ', '6050   '),
('J2605     ', '6051   '),
('J2606     ', '6052   '),
('J2609     ', '6053   '),
('J2607     ', '6054   '),
('J2608     ', '6055   '),
('J2610     ', '6056   '),
('J2611     ', '6057   '),
('P1831     ', '6058   '),
('P1828     ', '6059   '),
('J2613     ', '6060   '),
('J2614     ', '6061   '),
('J2616     ', '6062   '),
('J2617     ', '6063   '),
('J2618     ', '6064   '),
('J2619     ', '6065   '),
('J2620     ', '6066   '),
('J2621     ', '6067   '),
('J2622     ', '6068   '),
('6029      ', '6029   '),
('P1832     ', '6069   '),
('J2623     ', '6070   '),
('P1834     ', '6071   '),
('P1838     ', '6072   '),
('P1833     ', '6073   '),
('P1168     ', '5795   '),
('P1842     ', '6074   '),
('P1841     ', '6075   '),
('P1089     ', '1020   '),
('P1846     ', '6076   '),
('6077      ', 'J2626  '),
('J2626     ', '6077   '),
('J2627     ', '6078   '),
('J2629     ', '6079   '),
('J2630     ', '6080   '),
('J2631     ', '6081   '),
('J2628     ', '6082   '),
('J2632     ', '6083   '),
('P1848     ', '6084   '),
('P1849     ', '6085   '),
('J0820     ', '5524   '),
('P1850     ', '6086   '),
('J2635     ', '6087   '),
('P1851     ', '6088   '),
('P1852     ', '6089   '),
('P1853     ', '6090   '),
('P1854     ', '6091   '),
('J2636     ', '6092   '),
('P1855     ', '6093   '),
('P1856     ', '6094   '),
('P1852     ', '6095   '),
('P1858     ', '6096   '),
('P1859     ', '6097   '),
('J2633     ', '6098   '),
('P1860     ', '6099   '),
('J2650     ', '6100   '),
('J2651     ', '6101   '),
('P1857     ', '6089   '),
('P1861     ', '6102   '),
('P1865     ', '6103   '),
('P1863     ', '6104   '),
('P1866     ', '6105   '),
('P1868     ', '6106   '),
('J2654     ', '6107   '),
('P1869     ', '6108   '),
('P1862     ', '6109   '),
('P1864     ', '6110   '),
('P1271     ', '6111   '),
('P1870     ', '6112   '),
('P1873     ', '6113   '),
('P1874     ', '6114   '),
('P1872     ', '6115   '),
('P1871     ', '6116   '),
('J2664     ', '6117   '),
('J2663     ', '6118   '),
('P1875     ', '6119   '),
('P1876     ', '6120   '),
('S0059     ', '6121   '),
('J0126     ', '6122   '),
('P1877     ', '6123   '),
('J2666     ', '6124   '),
('P1882     ', '6127   '),
('P1881     ', '6126   '),
('J2670     ', '6128   '),
('M0018     ', '6129   '),
('6130      ', 'J030   '),
('J0305     ', '6130   '),
('P1880     ', '6125   '),
('P1878     ', '6131   '),
('P1879     ', '6132   '),
('P1883     ', '6133   '),
('P1884     ', '6134   '),
('7777      ', '7777   '),
('2455      ', '2455   '),
('3132      ', '3132   '),
('4325      ', '4325   '),
('5750      ', '5750   '),
('J2673     ', '6135   '),
('J2674     ', '6136   '),
('P1885     ', '6137   '),
('4304      ', 'P1115  '),
('P1115     ', '4111   '),
('J2675     ', '6138   '),
('J2676     ', '6139   '),
('J2678     ', '6140   '),
('P1889     ', '6141   '),
('P1890     ', '6142   '),
('J2682     ', '6143   '),
('P1891     ', '6144   '),
('J0535     ', '6145   '),
('J2684     ', '6146   '),
('P1892     ', '6147   '),
('P1886     ', '6148   '),
('K0003     ', '6149   '),
('J2688     ', '6150   '),
('J2689     ', '6151   '),
('J2690     ', '6152   '),
('J2693     ', '6153   '),
('P1893     ', '6154   '),
('J2698     ', '6155   '),
('P1496     ', '6156   '),
('J2701     ', '6157   '),
('P1964     ', '6158   '),
('P1097     ', '3073   '),
('P1899     ', '3084   '),
('P1899     ', '6159   '),
('P1900     ', '6160   '),
('P0343     ', '5005   '),
('P1901     ', '6161   '),
('P1902     ', '6162   '),
('J2705     ', '6163   '),
('J2707     ', '6164   '),
('J2712     ', '6165   '),
('P1906     ', '6166   '),
('P1907     ', '6167   '),
('P1908     ', '6168   '),
('0301      ', '0301   '),
('J2711     ', '6169   '),
('P1909     ', '6170   '),
('2455      ', '2455   '),
('3132      ', '3132   '),
('3235      ', '3235   '),
('3281      ', '3281   '),
('3282      ', '3282   '),
('3284      ', '3284   '),
('3286      ', '3286   '),
('3287      ', '3287   '),
('3288      ', '3288   '),
('3289      ', '3289   '),
('3291      ', '3291   '),
('3294      ', '3294   '),
('3301      ', '3301   '),
('4203      ', '4203   '),
('4262      ', '4262   '),
('4300      ', '4300   '),
('4325      ', '4325   '),
('5646      ', '5646   '),
('5750      ', '5750   '),
('7777      ', '7777   '),
('4323      ', '4323   '),
('6029      ', '6029   '),
('P1107     ', '1753   '),
('P1910     ', '6171   '),
('P1911     ', '6173   '),
('J2716     ', '6174   '),
('J2710     ', '6175   '),
('J2704     ', '6176   '),
('P1912     ', '6177   '),
('J2717     ', '6178   '),
('J2718     ', '6179   '),
('J2714     ', '6180   '),
('J2713     ', '6181   '),
('P1914     ', '6182   '),
('J2722     ', '6183   '),
('P1915     ', '6184   '),
('P1913     ', '6185   '),
('P1904     ', '6186   '),
('P1903     ', '6187   '),
('P1916     ', '6188   '),
('P1917     ', '6189   '),
('J2727     ', '6190   '),
('P1918     ', '6191   '),
('P1093     ', '3009   '),
('J0473     ', '2607   '),
('P1798     ', '6192   '),
('J2734     ', '6193   '),
('J2733     ', '6194   '),
('J2732     ', '6195   '),
('J2735     ', '6196   '),
('J2736     ', '6197   '),
('J2737     ', '6198   '),
('J2738     ', '6199   '),
('J2739     ', '6200   '),
('J2740     ', '6201   '),
('J2728     ', '6202   '),
('J2731     ', '6203   '),
('J2741     ', '6204   '),
('J2742     ', '6205   '),
('J2729     ', '6206   '),
('J2744     ', '6207   '),
('J2745     ', '6208   '),
('J2746     ', '6209   '),
('J2747     ', '6210   '),
('J2748     ', '6211   '),
('J2749     ', '6212   '),
('J2750     ', '6213   '),
('J2751     ', '6214   '),
('J2752     ', '6215   '),
('J2753     ', '6216   '),
('P1919     ', '6217   '),
('J2760     ', '6218   '),
('J2759     ', '6219   '),
('J2754     ', '6220   '),
('J2757     ', '6221   '),
('J2758     ', '6222   '),
('J2756     ', '6223   '),
('J2755     ', '6224   '),
('J2761     ', '6225   '),
('J2762     ', '6226   '),
('J2730     ', '6227   '),
('J2726     ', '6228   '),
('J2725     ', '6229   '),
('J2768     ', '6230   '),
('J2769     ', '6231   '),
('J2765     ', '6232   '),
('P1921     ', '6233   '),
('J2766     ', '6234   '),
('J2767     ', '6235   '),
('P1922     ', '6236   '),
('P1923     ', '6237   '),
('P1924     ', '6238   '),
('P1925     ', '6239   '),
('J2773     ', '6240   '),
('J2771     ', '6241   '),
('J2772     ', '6242   '),
('J2776     ', '6243   '),
('J2775     ', '6244   '),
('J2774     ', '6245   '),
('P1926     ', '6246   '),
('P1928     ', '6247   '),
('J2785     ', '6248   '),
('J2781     ', '6249   '),
('J2780     ', '6250   '),
('J2779     ', '6251   '),
('P1927     ', '6252   '),
('P1905     ', '6253   '),
('J2764     ', '6254   '),
('P1929     ', '6255   '),
('P1930     ', '6256   '),
('J2777     ', '6258   '),
('J2782     ', '6259   '),
('J2778     ', '6260   '),
('P1931     ', '6257   '),
('J2787     ', '6261   '),
('J2788     ', '6262   '),
('J2770     ', '6263   '),
('P1932     ', '6264   '),
('0301      ', '0301   '),
('P1933     ', '6265   '),
('P1934     ', '6266   '),
('P1935     ', '6267   '),
('J2792     ', '6268   '),
('J2793     ', '6269   '),
('P1936     ', '6270   '),
('J2797     ', '6271   '),
('J2798     ', '6272   '),
('P1937     ', '6273   '),
('P1938     ', '6274   '),
('J0113     ', '6275   '),
('5799      ', '5799   '),
('8196      ', '8196   '),
('P1940     ', '6276   '),
('J2802     ', '6277   '),
('P1941     ', '6278   '),
('P1939     ', '6279   '),
('P1943     ', '6280   '),
('P1942     ', '6281   '),
('P1944     ', '6282   '),
('P1945     ', '6283   '),
('P1946     ', '6284   '),
('P1948     ', '6285   '),
('P1950     ', '6286   '),
('P1951     ', '6287   '),
('P1952     ', '6288   '),
('M0053     ', '6289   '),
('P1949     ', '6290   '),
('J2790     ', '6291   '),
('P1953     ', '6292   '),
('P1954     ', '6293   '),
('J2805     ', '6294   '),
('J2806     ', '6295   '),
('J2804     ', '6296   '),
('6297      ', 'J280   '),
('J2807     ', '6297   '),
('P1955     ', '6298   '),
('J2805     ', '6300   '),
('J2809     ', '6301   '),
('P1956     ', '6299   '),
('B0041     ', '6302   '),
('J2791     ', '6303   '),
('J2812     ', '6304   '),
('P1960     ', '6305   '),
('J2810     ', '6306   '),
('B0023     ', '6307   '),
('P1897     ', '6308   '),
('6309      ', 'J2725  '),
('J2725     ', '6309   '),
('P1961     ', '6310   '),
('J2814     ', '6311   '),
('P1962     ', '6312   '),
('P1963     ', '6313   '),
('J2815     ', '6314   '),
('6229      ', '6229   '),
('J2816     ', '6315   '),
('J0967     ', '6316   '),
('S0109     ', '6320   '),
('J2763     ', '6325   '),
('P1965     ', '6321   '),
('J2820     ', '6317   '),
('J2821     ', '6318   '),
('J2822     ', '9319   '),
('J2825     ', '6326   '),
('J2824     ', '6327   '),
('J2826     ', '6323   '),
('J2827     ', '6324   '),
('J0966     ', '6328   '),
('J2801     ', '6319   '),
('J2833     ', '6329   '),
('J2828     ', '6322   '),
('J2836     ', '6330   '),
('J2835     ', '6331   '),
('P1968     ', '6333   '),
('P1967     ', '6334   '),
('P1966     ', '6332   '),
('J1827     ', '6335   '),
('J2837     ', '6336   '),
('P1970     ', '6337   '),
('P1969     ', '6339   '),
('J2843     ', '6342   '),
('J2844     ', '6343   '),
('J2842     ', '6341   '),
('J2841     ', '6340   '),
('J2838     ', '6344   '),
('J2845     ', '6345   '),
('J2846     ', '6346   '),
('J2847     ', '6347   '),
('J2850     ', '6350   '),
('J2852     ', '6351   '),
('J2853     ', '6352   '),
('J2851     ', '6349   '),
('P1974     ', '6353   '),
('P1972     ', '6348   '),
('J2859     ', '6354   '),
('J2857     ', '6355   '),
('J2856     ', '6356   '),
('J2858     ', '6357   '),
('J2860     ', '6358   '),
('J2861     ', '6360   '),
('J2862     ', '6361   '),
('J2863     ', '6362   '),
('P1409     ', '6359   ');

-- --------------------------------------------------------

--
-- Table structure for table `medical_hubungan`
--

CREATE TABLE IF NOT EXISTS `medical_hubungan` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_hubungan`
--

INSERT INTO `medical_hubungan` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Pribadi', 1, '2015-06-17', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Istri/Suami', 1, '2015-06-17', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `medical_jenis_pemeriksaan`
--

CREATE TABLE IF NOT EXISTS `medical_jenis_pemeriksaan` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_jenis_pemeriksaan`
--

INSERT INTO `medical_jenis_pemeriksaan` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Kesehatan', 1, '2015-06-17', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Obat', 1, '2015-06-17', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
`id` int(11) NOT NULL,
  `comp_session_id` int(11) NOT NULL DEFAULT '1',
  `parent_organization_id` int(3) NOT NULL DEFAULT '0',
  `organization_class_id` int(3) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `comp_session_id`, `parent_organization_id`, `organization_class_id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 1, 0, 1, 'Komunigrafik', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 1, 1, 2, 'Administration & Finance', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 1, 1, 2, 'Technology', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 1, 1, 2, 'Design & Multimedia', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 1, 1, 2, 'Marketing', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(7, 1, 3, 3, 'Administration', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(8, 1, 3, 3, 'Finance', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(9, 1, 4, 3, 'Program', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(10, 1, 5, 3, 'Design', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(11, 1, 5, 3, 'Multimedia', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(12, 1, 6, 3, 'Marketing', '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(13, 1, 10, 4, 'Design Section', '2015-02-12 04:46:02', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(14, 1, 13, 5, 'Design Unit', '2015-02-12 04:46:51', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `organization_class`
--

CREATE TABLE IF NOT EXISTS `organization_class` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `order_no` tinyint(3) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_class`
--

INSERT INTO `organization_class` (`id`, `title`, `order_no`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Company', 1, '2015-01-23 00:00:00', 1, '2015-02-06 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(2, 'Departement', 2, '2015-01-23 00:00:00', 1, '2015-02-06 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Division', 3, '2015-01-23 00:00:00', 1, '2015-02-06 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(4, 'Section', 4, '2015-01-23 00:00:00', 1, '2015-02-06 00:00:00', 1, 0, '2015-02-09 00:00:00', 1),
(5, 'Unit', 5, '2015-01-23 00:00:00', 1, '2015-02-06 00:00:00', 1, 1, '2015-02-09 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_by_position`
--

CREATE TABLE IF NOT EXISTS `payroll_by_position` (
`id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `amount` decimal(16,0) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_setup`
--

CREATE TABLE IF NOT EXISTS `payroll_setup` (
`id` int(11) NOT NULL,
  `comp_session_id` int(11) NOT NULL DEFAULT '1',
  `payroll_type_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(254) NOT NULL,
  `variable_name` varchar(254) NOT NULL,
  `amout` decimal(16,0) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_setup`
--

INSERT INTO `payroll_setup` (`id`, `comp_session_id`, `payroll_type_id`, `title`, `variable_name`, `amout`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 1, 1, 'Tunjangan Masa Kerja', 'tmk', '42500', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 1, 1, 'Jumlah Jam Kerja', 'jjk', '173', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 1, 1, 'Max hari kerja sebulan', 'mhk', '25', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 1, 1, 'Pembagi potongan BPJS', 'bpjs', '1000', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 1, 1, 'Variable tunjangan kehadiran', 'tjk', '150000', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 1, 1, 'variable pengurangan kehadiran', 'pkh', '6000', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(7, 1, 1, 'variable min alpha', 'mal', '1', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(8, 1, 1, 'variable min telat', 'mtl', '3', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(9, 1, 1, 'Tunjangan Transport', 'ttp', '5000', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_type`
--

CREATE TABLE IF NOT EXISTS `payroll_type` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `basic_salary_table` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_type`
--

INSERT INTO `payroll_type` (`id`, `title`, `basic_salary_table`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'by position', 'position', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'by position group', 'position_group', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'by individu', 'users_employement', '2015-02-11 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembiayaan`
--

CREATE TABLE IF NOT EXISTS `pembiayaan` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembiayaan`
--

INSERT INTO `pembiayaan` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(2, 'Perusahaan', '2015-04-14', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(3, 'Sponsor', '2015-04-14', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(4, 'Pribadi', '2015-04-14', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(5, 'Lain-lain', '2015-04-14', 1, '0000-00-00', 0, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggara`
--

CREATE TABLE IF NOT EXISTS `penyelenggara` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyelenggara`
--

INSERT INTO `penyelenggara` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(2, 'Internal', '2015-04-14', 1, '0000-00-00', 0, 0, '0000-00-00', 0),
(3, 'Eksternal', '2015-04-14', 1, '0000-00-00', 0, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `abbr` varchar(254) NOT NULL,
  `position_group_id` int(3) NOT NULL,
  `parent_position_id` int(3) NOT NULL DEFAULT '0',
  `organization_id` int(3) NOT NULL,
  `description` text NOT NULL,
  `basic_salary` decimal(16,0) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `title`, `abbr`, `position_group_id`, `parent_position_id`, `organization_id`, `description`, `basic_salary`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Director', 'Dir', 1, 0, 1, '', '4000000', '2015-01-14 00:00:00', 1, '2015-02-09 08:33:11', 1, 0, '0000-00-00 00:00:00', 0),
(2, 'Departement Head of Administration & Finance', 'Dept. Head Adm Fin', 2, 1, 3, '', '3000000', '2015-01-14 00:00:00', 1, '2015-02-09 08:34:07', 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Departement Head of Technology', 'Dept. Head Tech', 2, 1, 4, '', '3000000', '2015-02-09 08:34:42', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'Departement Head of Design & Multimedia', 'Dept. Head DM', 2, 1, 5, '', '3000000', '2015-02-09 08:35:25', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 'Departement Head of Marketing', 'Dept. Head Mkt', 2, 1, 6, '', '3000000', '2015-02-09 08:36:04', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 'Division Head of Administration', 'Div. Head Adm', 3, 2, 7, '', '2000000', '2015-02-09 08:37:18', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(7, 'Administration Officer', 'Adm Off', 5, 6, 7, '', '1000000', '2015-02-09 08:38:09', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(8, 'Finance Officer', 'Fin Off', 5, 6, 8, '', '1000000', '2015-02-09 08:38:49', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(9, 'Division Head of Technology', 'Div. Head Tech', 3, 3, 4, '', '2000000', '2015-02-09 08:39:26', 1, '2015-02-09 08:40:46', 1, 0, '0000-00-00 00:00:00', 0),
(10, 'Programmer Officer', 'Prog. Off', 5, 9, 9, '', '1000000', '2015-02-09 08:41:13', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(11, 'Division Head Of Design', 'Div. Head Des', 3, 4, 10, '', '2000000', '2015-02-09 08:44:02', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(12, 'Design Officer', 'Des. Off', 5, 11, 10, '', '1000000', '2015-02-09 08:45:50', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(13, 'Division Head of Multimedia', 'Div. Head Mul', 3, 4, 11, '', '2000000', '2015-02-09 08:46:20', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(14, 'Multimedia Officer', 'Mul. Off', 5, 13, 11, '', '1000000', '2015-02-09 08:47:19', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(15, 'Division Head of Marketing', 'Div. Head Mkt', 3, 5, 12, '', '2000000', '2015-02-09 08:47:46', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(16, 'Marketing Officer', 'Mkt. Off', 5, 15, 12, '', '1000000', '2015-02-09 08:48:11', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `position_group`
--

CREATE TABLE IF NOT EXISTS `position_group` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `abbr` varchar(254) NOT NULL,
  `level_order` int(3) NOT NULL,
  `level` set('Director','Management','Non Management') NOT NULL,
  `parent_position_group_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `basic_salary` decimal(16,0) NOT NULL DEFAULT '0',
  `gradeval_bottom` int(11) NOT NULL,
  `gradeval_top` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position_group`
--

INSERT INTO `position_group` (`id`, `title`, `abbr`, `level_order`, `level`, `parent_position_group_id`, `description`, `basic_salary`, `gradeval_bottom`, `gradeval_top`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Director', 'Dir', 10, 'Director', 0, '', '0', 0, 0, '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Departement Head', 'Dept. Head', 20, 'Management', 1, '', '0', 0, 0, '2015-01-14 00:00:00', 1, '2015-02-06 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Division Head', 'Div. Head', 30, 'Management', 2, '', '0', 0, 0, '2015-02-06 00:00:00', 1, '2015-02-06 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(5, 'Officer', 'Off', 40, 'Non Management', 3, '', '0', 0, 0, '2015-02-09 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, 'test', 'test', 70, '', 5, 'test', '0', 0, 0, '2015-02-12 08:07:32', 1, '0000-00-00 00:00:00', 0, 1, '2015-02-12 08:07:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_brevet`
--

CREATE TABLE IF NOT EXISTS `recruitment_brevet` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment_brevet`
--

INSERT INTO `recruitment_brevet` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'A', 1, '2015-06-26', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'B', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_jurusan`
--

CREATE TABLE IF NOT EXISTS `recruitment_jurusan` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment_jurusan`
--

INSERT INTO `recruitment_jurusan` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Teknologi Informasi', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Ekonomi', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_komputer`
--

CREATE TABLE IF NOT EXISTS `recruitment_komputer` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment_komputer`
--

INSERT INTO `recruitment_komputer` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Photoshop', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Microsoft Office', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_pendidikan`
--

CREATE TABLE IF NOT EXISTS `recruitment_pendidikan` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment_pendidikan`
--

INSERT INTO `recruitment_pendidikan` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'SMA', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'D-3', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'S-1', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'S-2', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_status`
--

CREATE TABLE IF NOT EXISTS `recruitment_status` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment_status`
--

INSERT INTO `recruitment_status` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Harian', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Kontrak', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'OJT', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'Tetap', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_urgensi`
--

CREATE TABLE IF NOT EXISTS `recruitment_urgensi` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment_urgensi`
--

INSERT INTO `recruitment_urgensi` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, '<15 Hari', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, '15-30 Hari', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, '>30 Hari', 1, '2015-05-20', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `resign_reason`
--

CREATE TABLE IF NOT EXISTS `resign_reason` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resign_reason`
--

INSERT INTO `resign_reason` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Pensiun', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'PHK', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'Mundur', '2015-01-14 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_setup`
--

CREATE TABLE IF NOT EXISTS `table_setup` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `default_val` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_setup`
--

INSERT INTO `table_setup` (`id`, `title`, `default_val`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'organization_class_limit', 10, '2015-02-04 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tadat`
--

CREATE TABLE IF NOT EXISTS `tadat` (
  `mchID` smallint(6) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fgrid` varchar(25) DEFAULT NULL,
  `shf` varchar(2) DEFAULT NULL,
  `idx` int(11) DEFAULT NULL,
  `fpsn` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tadat`
--

INSERT INTO `tadat` (`mchID`, `tgl`, `fgrid`, `shf`, `idx`, `fpsn`) VALUES
(8168, '2015-04-21 10:25:12', 'FGR', 'C', 1, '10.1.102.225'),
(9920, '2015-04-20 09:14:49', 'FGR', 'C', 1, '10.1.102.225'),
(9920, '2015-04-20 09:22:31', 'FGR', 'C', 2, '10.1.102.225'),
(9920, '2015-04-20 15:05:54', 'FGR', 'C', 2, '10.1.102.225'),
(9920, '2015-04-20 15:08:38', 'FGR', 'C', 3, '10.1.102.225'),
(9920, '2015-04-29 11:04:54', 'FGR', 'C', 1, '10.1.102.225'),
(9920, '2015-04-29 11:07:55', 'FGR', 'C', 2, '10.1.102.225'),
(9920, '2015-04-29 11:10:47', 'FGR', 'C', 3, '10.1.102.225'),
(9920, '2015-04-29 11:18:39', 'FGR', 'C', 4, '10.1.102.225'),
(9920, '2015-04-29 12:51:48', 'FGR', 'C', 5, '10.1.102.225'),
(9920, '2015-04-29 14:04:23', 'FGR', 'C', 6, '10.1.102.225');

-- --------------------------------------------------------

--
-- Table structure for table `toefl`
--

CREATE TABLE IF NOT EXISTS `toefl` (
`id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toefl`
--

INSERT INTO `toefl` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 200, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 250, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 300, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 350, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 400, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, 450, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, 500, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, 550, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(9, 600, 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `training_ikatan_dinas`
--

CREATE TABLE IF NOT EXISTS `training_ikatan_dinas` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_ikatan_dinas`
--

INSERT INTO `training_ikatan_dinas` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Tipe 1', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Tipe 2', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `training_type`
--

CREATE TABLE IF NOT EXISTS `training_type` (
`id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_type`
--

INSERT INTO `training_type` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Softskill', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Softskill 2', 1, '2015-06-05', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `training_waktu`
--

CREATE TABLE IF NOT EXISTS `training_waktu` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_waktu`
--

INSERT INTO `training_waktu` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, '3 Bulan', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, '6 Bulan', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, '9 Bulan', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, '12 Bulan', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, '24 Bulan', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(6, '36 Bulan', '2015-06-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE IF NOT EXISTS `transportation` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`id`, `title`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'Pesawat', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'Mobil Kantor', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_inventory`
--

CREATE TABLE IF NOT EXISTS `type_inventory` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_inventory`
--

INSERT INTO `type_inventory` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'HRD', 1, '2015-06-19', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'IT', 1, '2015-06-19', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Logistik', 1, '2015-06-19', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'Koperasi', 1, '2015-06-19', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 'Perpustakaan', 1, '2015-06-19', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nik` varchar(15) NOT NULL,
  `mchID` varchar(15) NOT NULL,
  `superior_id` varchar(15) DEFAULT NULL,
  `bod` datetime NOT NULL,
  `marital_id` tinyint(2) DEFAULT NULL,
  `photo` varchar(254) NOT NULL,
  `scan_kk` varchar(256) NOT NULL,
  `scan_akta` varchar(256) NOT NULL,
  `mobile_phone` varchar(40) NOT NULL,
  `previous_email` varchar(254) NOT NULL,
  `bb_pin` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `nik`, `mchID`, `superior_id`, `bod`, `marital_id`, `photo`, `scan_kk`, `scan_akta`, `mobile_phone`, `previous_email`, `bb_pin`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1435556452, 1, 'Admin', 'istrator', 'ADMIN', '0', '', '0', NULL, '1980-01-01 00:00:00', 1, '', '', '', '', '', ''),
(20, '::1', 'Bitri Indriany', '$2y$08$eak2Ws9asBD.qSbVClNqC.aXnKvxv0uP/6YdNbZLdr4s7KECP2IWq', NULL, 'bitri.indriany@erlangga.co.id', NULL, NULL, NULL, NULL, 1425554370, 1435499818, 1, 'Bitri', 'Indriany', NULL, '02191600634', 'P0501', '0404', 'P0159', '1973-05-24 00:00:00', 2, 'apache_pb2.png', 'DSC_0000059.jpg', 'DSCI0934.jpg', '', '', ''),
(26, '::1', 'Suksma Wijaya', '$2y$08$yy3Mv5/T6e88PAC/8TCsqecRmlfN1fG9bebYlDZtyjCe5NBmvvlFq', NULL, 'suksma.wijaya@erlangga.co.id', NULL, NULL, NULL, NULL, 1426472861, 1435465132, 1, 'Suksma', 'Wijaya', NULL, '', 'B0018', '5637', 'P0501', '1975-07-10 00:00:00', 2, '', '', '', '', '', ''),
(29, '::1', 'Wahyu Puji Sucianto', '$2y$08$OwWZ.UDSScf6ySR4FZzW0.6ttLMxr9y6/il8coZgZzBjCnn.0nSwi', NULL, 'wahyu.sucianto@erlangga.co.id', NULL, NULL, NULL, NULL, 1427864423, 1435430645, 1, 'Wahyu', 'Sucianto', NULL, '0218704165', 'P1493', '8168', 'P1894', '1985-06-02 00:00:00', 2, '', '', '', '', '', '12345'),
(30, '::1', 'Lili Sumarni', '$2y$08$DfzeQQdNeVlXxG.PUQtXq.i6KDF0i9DzNkFvKVquuZ9u8PciR2TlC', NULL, 'P1894', NULL, NULL, NULL, NULL, 1427864443, 1435183654, 1, 'Lili', 'Sumarni', NULL, '', 'P1894', '0', 'P0081', '1973-10-18 00:00:00', 2, '', '', '', '', '', ''),
(31, '::1', 'Dede Susanti', '$2y$08$hfYH5d48RrfYYfxVdDrmp.7aqimRqKrk0X8kXUVIn9B3syVapmDPu', NULL, 'dede.susanti@erlangga.co.id', NULL, NULL, NULL, NULL, 1427864457, 1435457861, 1, 'Dede', 'Susanti', '', '0218703753', 'P0081', '0303', 'P1894', '1970-06-15 00:00:00', 2, '', '', '', '', '', ''),
(33, '::1', 'Yudi', '$2y$08$1NsiTeVf4iJ.695ueQIMv.wFZPtyGrX/TJhmSUP48L7RwGaOMj2e2', NULL, 'P0674', NULL, NULL, NULL, NULL, 1429522821, 1434041966, 1, 'Yudi', 'Suryadi', NULL, '02187702464', 'P0674', '9920', '0', '1978-12-15 00:00:00', 2, '', '', '', '', '', ''),
(34, '10.1.102.221', 'Hasanuddin', '$2y$08$pfB1S2VsvlV2DaSCwla3/.uz9V5Mg6PtS92ttxIQ7e2/cJq72a7zW', NULL, 'P1943', NULL, NULL, NULL, NULL, 1429582683, 1429583670, 1, 'Hasanuddin', '', NULL, '0218727361', 'P1943', '', NULL, '1988-12-04 00:00:00', 2, '', '', '', '', '', ''),
(35, '::1', 'Sunaryo', '$2y$08$DFFhAryQrpQCVcKugyZXUes2kWKUuAwjEACexWjw/ir7Ou.sQzbW.', NULL, 'sunaryo.01@erlangga.co.id', NULL, NULL, NULL, NULL, 1429584616, 1429584760, 1, '', '', NULL, '', 'G0019', '0317', NULL, '1964-06-15 00:00:00', 2, '', '', '', '', '', ''),
(36, '::1', 'Teguh Ahmad Sujiono', '$2y$08$9qhIHm.MpJOzk//Fd0/6EO53XsuarjwyxIiSi6rqvLyfzT03XQHl2', NULL, 'teguh.sujiono@erlangga.co.id', NULL, NULL, NULL, NULL, 1429680119, 1429680185, 1, 'Teguh', 'Sujiono', NULL, '', 'J0126', '', NULL, '1971-07-01 00:00:00', 2, '', '', '', '', '', ''),
(37, '::1', 'Supriyanti', '$2y$08$QT3Q4.HflA4zfZfi2ijFLeOamJu1nlauFOh4EN9M3Ysy57QcPuKby', NULL, 'J0064', NULL, NULL, NULL, NULL, 1429680666, 1429680690, 1, 'Supriyanti', '', NULL, '', 'J0064', '', NULL, '1967-03-21 00:00:00', 2, '', '', '', '', '', ''),
(38, '::1', 'Destriana Murniati Tampubolon', '$2y$08$6LpCHCa.I4NarmYuuaXiGOqM.PDe2LagxAJMwCd/jOvN5KtiHHkeG', NULL, 'destriana.tampubolon@erlangga.co.id', NULL, NULL, NULL, NULL, 1429681574, 1429681596, 1, 'Destriana', 'Tampubolon', NULL, '0218725032', 'P0028', '', NULL, '1963-12-03 00:00:00', 1, '', '', '', '', '', ''),
(39, '::1', 'Herman Sinaga', '$2y$08$zbU3.WgHcwdSuBD4S1Zj2OXat.AdLEKOhwDH65/MQlNlukQtomcLy', NULL, 'herman.sinaga@erlangga.co.id', NULL, NULL, NULL, NULL, 1431504461, 1431504986, 1, 'Herman', 'Sinaga', NULL, '-', 'P0011', '0020   ', NULL, '1954-09-28 00:00:00', 2, '', '', '', '', '', ''),
(40, '::1', 'Dharma Hutauruk', '$2y$08$xeXB90RQ57Cct4ubfZ2YHO2yQPR42PcqRA6H0NAJEOVhqgGFGmOKa', NULL, 'dharma.hutauruk@erlangga.co.id', NULL, NULL, NULL, NULL, 1431504872, 1431504872, 0, '', '', NULL, '0217493459', 'P0017', '0021   ', NULL, '1955-10-07 00:00:00', 2, '', '', '', '', '', ''),
(41, '::1', 'Heri Purnomo', '$2y$08$I1V.6FzHGeM9xa0UDm8jNOrXk/GZAxlmFo4GCEYQBShVVPtzAf4Zq', NULL, 'heri.purnomo@erlangga.co.id', NULL, NULL, NULL, NULL, 1431788021, 1431788021, 0, 'Heri', 'Purnomo', NULL, '02194184155', 'P0159', '0405   ', NULL, '1973-09-10 00:00:00', 2, '', '', '', '', '', ''),
(42, '::1', 'Faiz Adnan', '$2y$08$Qby1UKZeh780slMIgI06d.gMgJMxkapzb/4zoioDCqvdb7nKroi/G', NULL, 'J2130', NULL, NULL, NULL, NULL, 1431788148, 1434041980, 1, 'Faiz', 'Adnan', NULL, '02198713183', 'J2130', '5687   ', 'P1894', '1986-10-21 00:00:00', 1, '', '', '', '', '', ''),
(43, '::1', 'Muhammad Arief Tiflen', '$2y$08$SnFEtiqoqComSirOiSS/jOiBtrwlcqaG15xUhGcNY6WTd.J7a6nOC', NULL, 'J2375', NULL, NULL, NULL, NULL, 1431788231, 1431788231, 0, 'Muhammad', 'Tiflen', NULL, '', 'J2375', '5875   ', 'P1894', '1992-05-06 00:00:00', 1, '', '', '', '', '', ''),
(44, '::1', 'Miranti Heras Tuwinda', '$2y$08$GUwSMheX7kWtgvv8DLxcJOL3cpxfWrt7nrU2B7bQCg7tAg0iQKjVW', NULL, 'miranti.tuwinda@erlangga.co.id', NULL, NULL, NULL, NULL, 1432006062, 1435299137, 1, 'Miranti', 'Tuwinda', NULL, '0218466275', 'P1463', '8170   ', '0', '1988-05-04 00:00:00', 1, '', '', '', '', '', ''),
(45, '::1', 'Sri Suharti', '$2y$08$N45gySgAnOYjECu3l/7Ayef8c17MaZ2HG7JYSMHlaKNahXRvVaWSu', NULL, 'sri.suharti@erlangga.co.id', NULL, NULL, NULL, NULL, 1432006534, 1435184003, 1, 'Sri', 'Suharti', NULL, '', 'P0035', '0102   ', '0', '1965-08-22 00:00:00', 2, '', '', '', '', '', ''),
(46, '::1', 'Ugartua Rumahorbo', '$2y$08$2aIqIzqDthxOx7h3Ax4fqejf77wL0zHYUvAXOGVy72aWNsOpBnKiW', NULL, 'ugartua.rumahorbo@erlangga.co.id', NULL, NULL, NULL, NULL, 1432009870, 1435298847, 1, 'Ugartua', 'Rumahorbo', NULL, '', 'D0001', '3264   ', '0', '1966-05-14 00:00:00', 2, '', '', '', '', '', ''),
(47, '::1', 'Hendi Sambudi', '$2y$08$AFH7HopUc70C8KpnzAXI.OlKhoRANcEwUeaiqrN4nDwtjm3j7TNi2', NULL, 'hendi.sambudi@erlangga.co.id', NULL, NULL, NULL, NULL, 1432610447, 1432610477, 1, '', '', NULL, '', 'S0007', '', 'P1894', '1967-05-18 00:00:00', 2, '', '', '', '', '', ''),
(48, '::1', 'Siamsul Hutagalung', '$2y$08$CRJtuE6.kyuMRnxkt2BVUePFvFD9dGaEHnNotHmMkLSVp0FXnf4ay', NULL, 'J0540', NULL, NULL, NULL, NULL, 1432612257, 1432612290, 1, '', '', NULL, '', 'J0540', '', NULL, '1980-11-29 00:00:00', 2, '', '', '', '', '', ''),
(49, '::1', 'Mohammad Nur Isnaeni', '$2y$08$9Fnve.Kp1QUHHZYFaLgDreY5BvWrC3a0W39nXc9z7Ev8U5hTlX8sS', NULL, 'mohammad.nurisnaeni@erlangga.co.id', NULL, NULL, NULL, NULL, 1434082158, 1434893759, 1, 'Mohammad', 'Isnaeni', NULL, '', 'P1880', '', NULL, '1987-07-25 00:00:00', 2, '', '', '', '', '', ''),
(50, '::1', 'Dwi Indah Purwanti', '$2y$08$y0RCZ5LdXIwcBD97liGusOmNKdWx3cwmjGnsXx2r5oyQcwSBh56.C', NULL, 'dwi.indah@erlangga.co.id', NULL, NULL, NULL, NULL, 1434551683, 1434598760, 1, 'Dwi', 'Indah', NULL, '02196187027', 'P1052', '', 'P0501', '1986-03-20 00:00:00', 2, '', '', '', '', '', ''),
(51, '::1', 'Faisal Rahman', '$2y$08$BkJbgyAfcg5qxPBgjC3SKOybCqvHfZQed6DVwKmpwBTqkvpK2r.W.', NULL, 'faisal.rahman@erlangga.co.id', NULL, NULL, NULL, NULL, 1434701796, 1434905259, 1, 'Faisal', 'Rahman', NULL, '0218742623', 'P1341', '', NULL, '1988-05-15 00:00:00', 1, '', '', '', '', '', ''),
(52, '::1', 'Naski Tiur Purnamasari', '$2y$08$RAfWr2Ljl5RzkrfJoAOLQueuQ8gB5J622o5jUpUuF0K0pm7C3evm6', NULL, 'naski.purnamasari@erlangga.co.id', NULL, NULL, NULL, NULL, 1434858192, 1434879430, 1, 'Naski', 'Purnamasari', NULL, '021-7495650', 'P1563', '', NULL, '1990-11-22 00:00:00', 1, '', '', '', '', '', ''),
(53, '::1', 'Dahlan Suherlan', '$2y$08$4c/aZF/HsFxwLv95lir8f.I.uDBPnSpjX3p.IyJv9dDr6vMD5MhbO', NULL, 'J1971', NULL, NULL, NULL, NULL, 1435049033, 1435049033, 1, '', '', NULL, '', 'J1971', '', NULL, '1984-06-23 00:00:00', 2, '', '', '', '', '', ''),
(54, '::1', 'Ferdy Tri Maulady', '$2y$08$nZ.COhehkL5kwOOPne0.6uLyzaMg97wHnMnTj4MKOJvSMvSW8bFme', NULL, 'J1973', NULL, NULL, NULL, NULL, 1435049154, 1435049154, 1, '', '', NULL, '08988998385', 'J1973', '', NULL, '1983-12-19 00:00:00', 1, '', '', '', '', '', ''),
(55, '::1', 'Muhammad Auliya Anshory', '$2y$08$fLJHNN2ZLms7DRhO6GdHDOLmCpHR/qzY18vvWyifEwv1YNKOww5lK', NULL, 'J1974', NULL, NULL, NULL, NULL, 1435049332, 1435049332, 1, 'Muha', '', NULL, '', 'J1974', '', NULL, '1989-01-04 00:00:00', 1, '', '', '', '', '', ''),
(56, '::1', 'Muhlisin', '$2y$08$99UxKJpB1.1VFzNZ8G36FeY9JlTE.c6FSG2BbARTHbkhtqZ871T/a', NULL, 'K1145', NULL, NULL, NULL, NULL, 1435100986, 1435101013, 1, 'Muhlisin', '', NULL, '', 'K1145', '', NULL, '1981-07-16 00:00:00', 2, '', '', '', '', '', ''),
(57, '::1', 'Riyan Hidayat', '$2y$08$Wd29lxo9nJ4jndfVMRcjF.mcHG7QjXJLoyK53n3/jCeBZFzxSIpwK', NULL, 'J2363', NULL, NULL, NULL, NULL, 1435183885, 1435183885, 0, 'Riyan', 'Hidayat', NULL, '', 'J2363', '', NULL, '1989-12-09 00:00:00', 2, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_absen`
--

CREATE TABLE IF NOT EXISTS `users_absen` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `date_tidak_hadir` date NOT NULL,
  `keterangan_id` int(11) NOT NULL,
  `alasan` varchar(100) DEFAULT NULL,
  `is_app_lv1` tinyint(1) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `is_app_lv2` tinyint(1) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `is_app_lv3` tinyint(1) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_api`
--

CREATE TABLE IF NOT EXISTS `users_api` (
`id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_api`
--

INSERT INTO `users_api` (`id`, `username`, `password`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'admin', '12345678', 1, '2015-05-01', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_awardwarning`
--

CREATE TABLE IF NOT EXISTS `users_awardwarning` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `award_warning_type_id` int(2) NOT NULL,
  `title` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `app_date` datetime NOT NULL,
  `sk_number` varchar(254) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_awardwarning`
--

INSERT INTO `users_awardwarning` (`id`, `user_id`, `award_warning_type_id`, `title`, `description`, `app_date`, `sk_number`, `start_date`, `end_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 0, 'test1_edit', 'test1', '2015-02-04 00:00:00', 'test1', '2015-02-05 00:00:00', '2015-02-05 00:00:00', '2015-02-04 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-02-04 00:00:00', 1),
(2, 8, 0, 'test1', 'test1', '2015-02-04 00:00:00', 'test1', '2015-02-05 00:00:00', '2015-02-06 00:00:00', '2015-02-04 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 8, 0, 'test2', 'test2', '2015-02-04 00:00:00', 'test2', '2015-02-05 00:00:00', '2015-02-06 00:00:00', '2015-02-04 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_certificate`
--

CREATE TABLE IF NOT EXISTS `users_certificate` (
`id` int(11) NOT NULL,
  `user_id` bigint(16) NOT NULL,
  `certification_type_id` int(3) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_certificate`
--

INSERT INTO `users_certificate` (`id`, `user_id`, `certification_type_id`, `description`, `start_date`, `end_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(2, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(3, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(4, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(5, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(6, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(7, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(8, 8, 1, '', '2015-01-29 00:00:00', '2015-01-31 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(9, 8, 1, '', '2015-01-04 00:00:00', '2015-01-05 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(10, 8, 1, '', '2015-01-04 00:00:00', '2015-01-09 00:00:00', '2015-01-30 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-30 00:00:00', 1),
(11, 8, 1, '', '2015-02-02 00:00:00', '2015-02-06 00:00:00', '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(12, 8, 1, '', '2015-02-09 00:00:00', '2015-02-13 00:00:00', '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-02-02 00:00:00', 1),
(13, 8, 1, '', '2015-02-15 00:00:00', '2015-02-20 00:00:00', '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(14, 8, 1, '', '2015-02-02 00:00:00', '2015-02-11 00:00:00', '2015-02-02 00:00:00', 1, '2015-02-02 00:00:00', 1, 1, '2015-02-02 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_course`
--

CREATE TABLE IF NOT EXISTS `users_course` (
`id` int(11) NOT NULL,
  `user_id` bigint(16) NOT NULL,
  `title` varchar(254) NOT NULL,
  `registration_date` datetime NOT NULL,
  `course_status_id` int(3) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_course`
--

INSERT INTO `users_course` (`id`, `user_id`, `title`, `registration_date`, `course_status_id`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 'tes1', '2015-01-27 00:00:00', 2, '2015-01-27 00:00:00', 1, '2015-01-27 00:00:00', 1, 1, '2015-01-27 00:00:00', 1),
(2, 8, 'tes2', '2011-03-23 00:00:00', 2, '2015-01-27 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-27 00:00:00', 1),
(3, 8, 'tes1', '2014-12-31 00:00:00', 2, '2015-01-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-28 00:00:00', 1),
(4, 8, 'tes', '2015-01-21 00:00:00', 6, '2015-01-28 00:00:00', 1, '2015-01-28 00:00:00', 1, 1, '2015-01-28 00:00:00', 1),
(5, 8, 'tes2', '2015-01-27 00:00:00', 2, '2015-01-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-28 00:00:00', 1),
(6, 8, 'tes3', '2015-01-18 00:00:00', 1, '2015-01-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-28 00:00:00', 1),
(7, 8, 'tes4', '2015-01-04 00:00:00', 7, '2015-01-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-28 00:00:00', 1),
(8, 8, 'tes5', '2015-01-05 00:00:00', 4, '2015-01-28 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-01-28 00:00:00', 1),
(9, 8, 'test1_edit_edit', '2014-10-07 00:00:00', 2, '2015-01-28 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(10, 8, 'test2_edit_edit_edit', '2015-01-29 00:00:00', 4, '2015-01-29 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(11, 8, 'test3_edit', '2015-01-29 00:00:00', 7, '2015-01-29 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(12, 8, 'test4_edit', '2015-01-06 00:00:00', 5, '2015-01-29 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(13, 8, 'test5_edit', '2015-01-06 00:00:00', 6, '2015-01-29 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(14, 8, 'test6_edit', '2015-01-05 00:00:00', 1, '2015-01-29 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(15, 8, 'test7_edit_edit', '2015-01-20 00:00:00', 3, '2015-01-29 00:00:00', 1, '2015-01-29 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(16, 8, 'test8', '2015-02-02 00:00:00', 7, '2015-02-02 00:00:00', 1, '2015-02-02 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(17, 8, 'test9', '2015-02-10 00:00:00', 1, '2015-02-02 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(18, 8, 'test10', '2015-02-25 00:00:00', 1, '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(19, 8, 'test11', '2015-02-03 00:00:00', 2, '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(20, 8, 'test12', '2015-02-24 00:00:00', 5, '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_cuti`
--

CREATE TABLE IF NOT EXISTS `users_cuti` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `date_mulai_cuti` date NOT NULL,
  `date_selesai_cuti` date NOT NULL,
  `jumlah_hari` tinyint(4) NOT NULL,
  `alasan_cuti_id` varchar(256) NOT NULL,
  `remarks` varchar(256) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `user_pengganti` varchar(11) NOT NULL COMMENT 'user_id kary pengganti',
  `alamat_cuti` text NOT NULL,
  `approval_status_id_lv1` int(11) NOT NULL,
  `is_app_lv1` tinyint(1) NOT NULL DEFAULT '0',
  `user_app_lv1` varchar(10) NOT NULL COMMENT 'user_id supervisor',
  `date_app_lv1` date NOT NULL,
  `note_app_lv1` text NOT NULL,
  `is_app_lv2` tinyint(1) NOT NULL DEFAULT '0',
  `approval_status_id_lv2` int(11) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL COMMENT 'user_id approval level2',
  `date_app_lv2` date NOT NULL,
  `note_app_lv2` text NOT NULL,
  `is_app_lv3` tinyint(1) NOT NULL DEFAULT '0',
  `approval_status_id_lv3` int(11) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_app_lv3` text NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `approval_status_id_hrd` int(11) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_app_hrd` varchar(256) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_cuti`
--

INSERT INTO `users_cuti` (`id`, `user_id`, `id_comp_session`, `date_mulai_cuti`, `date_selesai_cuti`, `jumlah_hari`, `alasan_cuti_id`, `remarks`, `contact`, `user_pengganti`, `alamat_cuti`, `approval_status_id_lv1`, `is_app_lv1`, `user_app_lv1`, `date_app_lv1`, `note_app_lv1`, `is_app_lv2`, `approval_status_id_lv2`, `user_app_lv2`, `date_app_lv2`, `note_app_lv2`, `is_app_lv3`, `approval_status_id_lv3`, `user_app_lv3`, `date_app_lv3`, `note_app_lv3`, `is_app_hrd`, `approval_status_id_hrd`, `user_app_hrd`, `date_app_hrd`, `note_app_hrd`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 29, 1, '2015-06-24', '2015-06-25', 2, 'CTAM', 'tes', 'tes', 'P1894', 'dsad', 1, 1, 'P1894', '2015-06-24', '', 1, 1, 'P0081', '2015-06-24', '', 0, 0, '0', '0000-00-00', '', 1, 1, '1', '2015-06-24', '', '2015-06-24 00:00:00', 29, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_cuti_plafon`
--

CREATE TABLE IF NOT EXISTS `users_cuti_plafon` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `hak_cuti` int(4) NOT NULL,
  `hak_cuti_sebelumnya` int(4) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_demolition`
--

CREATE TABLE IF NOT EXISTS `users_demolition` (
`id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alasan_demolition` varchar(256) NOT NULL,
  `is_app_lv1` tinyint(4) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_lv1` varchar(256) NOT NULL,
  `app_status_id_lv1` int(11) NOT NULL,
  `is_app_lv2` tinyint(4) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_lv2` varchar(256) NOT NULL,
  `app_status_id_lv2` int(11) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_lv3` varchar(256) NOT NULL,
  `app_status_id_lv3` int(11) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_hrd` varchar(256) NOT NULL,
  `app_status_id_hrd` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_demolition`
--

INSERT INTO `users_demolition` (`id`, `id_comp_session`, `user_id`, `alasan_demolition`, `is_app_lv1`, `user_app_lv1`, `date_app_lv1`, `note_lv1`, `app_status_id_lv1`, `is_app_lv2`, `user_app_lv2`, `date_app_lv2`, `note_lv2`, `app_status_id_lv2`, `is_app_lv3`, `user_app_lv3`, `date_app_lv3`, `note_lv3`, `app_status_id_lv3`, `is_app_hrd`, `user_app_hrd`, `date_app_hrd`, `note_hrd`, `app_status_id_hrd`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 0, 20, 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 0, 1, '2015-06-25', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 0, 20, 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 0, 1, '2015-06-25', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 0, 20, 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 0, 1, '2015-06-25', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 0, 20, 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 0, 1, '2015-06-25', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 0, 20, 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 1, '1', '2015-06-25', 'dsad', 2, 1, '2015-06-25', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_education`
--

CREATE TABLE IF NOT EXISTS `users_education` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `education_degree_id` int(2) NOT NULL,
  `education_group_id` int(2) NOT NULL,
  `education_center_id` int(2) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_education`
--

INSERT INTO `users_education` (`id`, `user_id`, `title`, `description`, `start_date`, `end_date`, `education_degree_id`, `education_group_id`, `education_center_id`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 'sd', 'sd 02 pagi', '1996-01-01 00:00:00', '2009-01-31 00:00:00', 0, 0, 0, '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 8, 'smp', 'smp 5', '2002-01-31 00:00:00', '2006-01-31 00:00:00', 0, 0, 0, '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 8, 'sma', 'sma', '2015-02-02 00:00:00', '2015-02-20 00:00:00', 0, 0, 0, '2015-02-02 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 8, 'S1_edit', 'universitas', '2014-11-03 00:00:00', '2015-02-02 00:00:00', 0, 0, 0, '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_employement`
--

CREATE TABLE IF NOT EXISTS `users_employement` (
`id` bigint(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seniority_date` datetime NOT NULL,
  `position_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `empl_status_id` int(11) NOT NULL,
  `employee_status_id` int(11) NOT NULL,
  `cost_center` varchar(254) NOT NULL,
  `position_group_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `resign_reason_id` int(11) NOT NULL,
  `active_inactive_id` int(2) NOT NULL,
  `basic_salary` decimal(16,0) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_employement`
--

INSERT INTO `users_employement` (`id`, `user_id`, `seniority_date`, `position_id`, `organization_id`, `empl_status_id`, `employee_status_id`, `cost_center`, `position_group_id`, `grade_id`, `resign_reason_id`, `active_inactive_id`, `basic_salary`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, '1995-01-01 00:00:00', 2, 3, 2, 2, '-', 2, 1, 1, 1, '0', '2015-02-06 00:00:00', 1, '2015-02-10 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(5, 9, '2008-01-01 00:00:00', 1, 1, 2, 2, 'C01', 1, 1, 3, 1, '0', '0000-00-00 00:00:00', 0, '2015-02-12 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(6, 10, '2008-01-01 00:00:00', 3, 4, 2, 1, '-', 2, 1, 1, 1, '0', '0000-00-00 00:00:00', 0, '2015-02-10 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(7, 11, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(8, 12, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(9, 13, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(10, 14, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(11, 15, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(12, 16, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(13, 17, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(14, 18, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(15, 19, '0000-00-00 00:00:00', 0, 0, 0, 0, '', 0, 0, 0, 0, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(16, 27, '2013-05-28 00:00:00', 13, 0, 1, 2, '-', 0, 2, 1, 1, '0', '2015-04-01 00:00:00', 1, '2015-04-01 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(17, 26, '2015-03-30 00:00:00', 1, 0, 1, 1, '-', 0, 1, 1, 1, '0', '2015-04-01 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_exit`
--

CREATE TABLE IF NOT EXISTS `users_exit` (
`id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_exit` date NOT NULL,
  `exit_type_id` int(11) NOT NULL,
  `user_exit_rekomendasi_id` int(11) NOT NULL,
  `is_purposed` tinyint(4) NOT NULL,
  `is_submit_it` tinyint(4) NOT NULL,
  `is_submit_hrd` tinyint(4) NOT NULL,
  `is_submit_logistik` tinyint(4) NOT NULL,
  `is_submit_koperasi` tinyint(4) NOT NULL,
  `is_submit_perpus` tinyint(4) NOT NULL,
  `user_submit_it` varchar(10) NOT NULL,
  `user_submit_hrd` varchar(10) NOT NULL,
  `user_submit_logistik` varchar(10) NOT NULL,
  `user_submit_koperasi` varchar(10) NOT NULL,
  `user_submit_perpus` varchar(10) NOT NULL,
  `date_submit_it` date NOT NULL,
  `date_submit_hrd` date NOT NULL,
  `date_submit_logistik` date NOT NULL,
  `date_submit_koperasi` date NOT NULL,
  `date_submit_perpus` date NOT NULL,
  `user_edit_it` varchar(10) NOT NULL,
  `user_edit_hrd` varchar(10) NOT NULL,
  `user_edit_logistik` varchar(10) NOT NULL,
  `user_edit_koperasi` varchar(10) NOT NULL,
  `user_edit_perpus` varchar(10) NOT NULL,
  `date_edit_it` date NOT NULL,
  `date_edit_hrd` date NOT NULL,
  `date_edit_logistik` date NOT NULL,
  `date_edit_koperasi` date NOT NULL,
  `date_edit_perpus` date NOT NULL,
  `is_app_lv1_it` tinyint(4) NOT NULL,
  `user_app_lv1_it` varchar(10) NOT NULL,
  `date_app_lv1_it` date NOT NULL,
  `is_app_lv1_hrd` tinyint(4) NOT NULL,
  `user_app_lv1_hrd` varchar(10) NOT NULL,
  `date_app_lv1_hrd` date NOT NULL,
  `is_app_lv1_logistik` tinyint(4) NOT NULL,
  `user_app_lv1_logistik` varchar(10) NOT NULL,
  `date_app_lv1_logistik` date NOT NULL,
  `is_app_lv1_koperasi` tinyint(4) NOT NULL,
  `user_app_lv1_koperasi` varchar(10) NOT NULL,
  `date_app_lv1_koperasi` date NOT NULL,
  `is_app_lv1_perpus` tinyint(4) NOT NULL,
  `user_app_lv1_perpus` varchar(10) NOT NULL,
  `date_app_lv1_perpus` date NOT NULL,
  `is_app` tinyint(4) NOT NULL,
  `app_status_id` int(11) NOT NULL,
  `user_app` int(11) NOT NULL,
  `date_app` date NOT NULL,
  `note_app` text NOT NULL,
  `is_app_mgr` tinyint(4) NOT NULL,
  `app_status_id_mgr` int(11) NOT NULL,
  `user_app_mgr` int(11) NOT NULL,
  `date_app_mgr` date NOT NULL,
  `note_mgr` varchar(256) NOT NULL,
  `is_app_koperasi` tinyint(4) NOT NULL,
  `app_status_id_koperasi` int(11) NOT NULL,
  `user_app_koperasi` int(11) NOT NULL,
  `date_app_koperasi` date NOT NULL,
  `note_koperasi` varchar(256) NOT NULL,
  `is_app_perpus` tinyint(4) NOT NULL,
  `app_status_id_perpus` int(11) NOT NULL,
  `user_app_perpus` int(11) NOT NULL,
  `date_app_perpus` date NOT NULL,
  `note_perpus` varchar(256) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `app_status_id_hrd` int(11) NOT NULL,
  `user_app_hrd` int(11) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_hrd` varchar(256) NOT NULL,
  `is_app_it` tinyint(4) NOT NULL,
  `user_app_it` varchar(10) NOT NULL,
  `date_app_it` date NOT NULL,
  `note_it` varchar(256) NOT NULL,
  `app_status_id_it` int(11) NOT NULL,
  `is_app_lv1` tinyint(4) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_lv1` varchar(256) NOT NULL,
  `app_status_id_lv1` int(11) NOT NULL,
  `is_app_lv2` tinyint(4) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_lv2` varchar(256) NOT NULL,
  `app_status_id_lv2` int(11) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_lv3` varchar(256) NOT NULL,
  `app_status_id_lv3` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_exit_rekomendasi`
--

CREATE TABLE IF NOT EXISTS `users_exit_rekomendasi` (
`id` int(11) NOT NULL,
  `user_exit_id` int(11) NOT NULL,
  `is_pesangon` tinyint(4) NOT NULL,
  `is_uang_ganti` tinyint(4) NOT NULL,
  `is_uang_jasa` tinyint(4) NOT NULL,
  `is_uang_pisah` tinyint(4) NOT NULL,
  `is_sk_kerja` tinyint(4) NOT NULL,
  `is_ijazah` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_exit_rekomendasi`
--

INSERT INTO `users_exit_rekomendasi` (`id`, `user_exit_id`, `is_pesangon`, `is_uang_ganti`, `is_uang_jasa`, `is_uang_pisah`, `is_sk_kerja`, `is_ijazah`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 1, 1, 1, 0, 0, 1, 0, 1, '2015-06-26', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 0, 1, 0, 1, 0, 1, 0, 20, '2015-06-28', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 0, 1, 0, 1, 0, 1, 0, 20, '2015-06-28', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_experience`
--

CREATE TABLE IF NOT EXISTS `users_experience` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company` varchar(254) NOT NULL,
  `position` varchar(254) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` datetime NOT NULL,
  `address` text NOT NULL,
  `line_business` varchar(254) NOT NULL,
  `resign_reason_id` int(2) NOT NULL,
  `last_salary` decimal(10,0) NOT NULL,
  `exp_level_id` int(2) NOT NULL,
  `exp_year_id` int(2) NOT NULL,
  `exp_field_id` int(2) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_experience`
--

INSERT INTO `users_experience` (`id`, `user_id`, `company`, `position`, `start_date`, `end_date`, `address`, `line_business`, `resign_reason_id`, `last_salary`, `exp_level_id`, `exp_year_id`, `exp_field_id`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 'comp1_edit', 'comp', '2014-12-07', '2015-02-04 00:00:00', 'depok', 'IT', 1, '1000000', 0, 0, 0, '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(54, 1, 1),
(55, 1, 2),
(84, 20, 3),
(81, 29, 4),
(86, 44, 6),
(85, 45, 5),
(87, 46, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users_ikatan_dinas`
--

CREATE TABLE IF NOT EXISTS `users_ikatan_dinas` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ikatan_dinas_type` int(2) NOT NULL,
  `title` varchar(254) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_ikatan_dinas`
--

INSERT INTO `users_ikatan_dinas` (`id`, `user_id`, `ikatan_dinas_type`, `title`, `start_date`, `end_date`, `amount`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 0, 'test1_edit', '2015-02-04 00:00:00', '2015-02-05 00:00:00', '1500000', '2015-02-04 00:00:00', 1, '2015-02-04 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(2, 8, 0, 'test2', '2015-02-04 00:00:00', '2015-02-05 00:00:00', '2000000', '2015-02-04 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-02-04 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_inventory`
--

CREATE TABLE IF NOT EXISTS `users_inventory` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_exit_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `is_available` tinyint(4) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_inventory_exit`
--

CREATE TABLE IF NOT EXISTS `users_inventory_exit` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_exit_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `is_available` tinyint(4) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_jabatan`
--

CREATE TABLE IF NOT EXISTS `users_jabatan` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_id` int(2) NOT NULL,
  `position_id` int(11) NOT NULL,
  `employee_group_id` int(2) NOT NULL,
  `grade_id` int(2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `branch_id` int(2) NOT NULL,
  `personnel_action_id` int(3) NOT NULL,
  `sk_date` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_jabatan`
--

INSERT INTO `users_jabatan` (`id`, `user_id`, `organization_id`, `position_id`, `employee_group_id`, `grade_id`, `start_date`, `end_date`, `branch_id`, `personnel_action_id`, `sk_date`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 2, 2, 2, 2, '2015-02-08 00:00:00', '2015-02-04 00:00:00', 0, 0, '2015-02-04 00:00:00', '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(2, 8, 1, 1, 1, 1, '2015-02-24 00:00:00', '2015-02-02 00:00:00', 0, 0, '2015-02-02 00:00:00', '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_medical`
--

CREATE TABLE IF NOT EXISTS `users_medical` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_medical_detail_id` varchar(500) NOT NULL,
  `is_app_lv1` tinyint(4) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `is_app_lv2` tinyint(4) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_medical`
--

INSERT INTO `users_medical` (`id`, `user_id`, `user_medical_detail_id`, `is_app_lv1`, `user_app_lv1`, `date_app_lv1`, `is_app_lv2`, `user_app_lv2`, `date_app_lv2`, `is_app_lv3`, `user_app_lv3`, `date_app_lv3`, `is_app_hrd`, `user_app_hrd`, `date_app_hrd`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 29, '1,2,3,4,', 0, 'P0081', '0000-00-00', 0, '0', '0000-00-00', 0, '0', '0000-00-00', 1, '1', '2015-06-29', 29, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 20, '5,', 1, 'P0501', '2015-06-28', 0, '0', '0000-00-00', 0, '0', '0000-00-00', 0, '', '0000-00-00', 20, '2015-06-28', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_medical_detail`
--

CREATE TABLE IF NOT EXISTS `users_medical_detail` (
`id` int(11) NOT NULL,
  `user_medical_id` int(11) NOT NULL,
  `karyawan_id` varchar(10) NOT NULL,
  `pasien` varchar(256) NOT NULL,
  `hubungan_id` int(11) NOT NULL,
  `jenis_pemeriksaan_id` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_medical_detail`
--

INSERT INTO `users_medical_detail` (`id`, `user_medical_id`, `karyawan_id`, `pasien`, `hubungan_id`, `jenis_pemeriksaan_id`, `rupiah`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 1, 'P0081', 'sad', 1, 1, 34, 29, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 1, 'P0081', 'dsa', 1, 1, 43, 29, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 1, 'P1575', 'dsa', 1, 1, 4343, 29, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 1, 'P1575', 'dsad', 1, 1, 434, 29, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 2, 'B0018', 'tes', 1, 1, 34343, 20, '2015-06-28', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_medical_hrd`
--

CREATE TABLE IF NOT EXISTS `users_medical_hrd` (
`id` int(11) NOT NULL,
  `user_medical_detail_id` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL COMMENT 'biaya yang diseujui hrd',
  `is_approve` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_on` int(11) NOT NULL,
  `edited_by` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_medical_hrd`
--

INSERT INTO `users_medical_hrd` (`id`, `user_medical_detail_id`, `rupiah`, `is_approve`, `created_by`, `created_on`, `edited_on`, `edited_by`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(13, 1, 34, 0, 1, '2015-06-29', 2015, '0000-00-00', 0, 0, '0000-00-00'),
(14, 2, 43, 1, 1, '2015-06-29', 2015, '0000-00-00', 0, 0, '0000-00-00'),
(15, 4, 434, 1, 1, '2015-06-29', 2015, '0000-00-00', 0, 0, '0000-00-00'),
(16, 3, 4343, 0, 1, '2015-06-29', 2015, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_promosi`
--

CREATE TABLE IF NOT EXISTS `users_promosi` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_bu` varchar(50) NOT NULL,
  `old_org` varchar(50) NOT NULL,
  `old_pos` varchar(50) NOT NULL,
  `new_bu` varchar(50) NOT NULL,
  `new_org` varchar(50) NOT NULL,
  `new_pos` varchar(50) NOT NULL,
  `date_promosi` date NOT NULL,
  `alasan` text NOT NULL,
  `is_app_lv1` tinyint(4) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_lv1` varchar(256) NOT NULL,
  `app_status_id_lv1` int(11) NOT NULL,
  `is_app_lv2` tinyint(4) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_lv2` varchar(256) NOT NULL,
  `app_status_id_lv2` int(11) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_lv3` varchar(256) NOT NULL,
  `app_status_id_lv3` int(11) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_hrd` varchar(256) NOT NULL,
  `app_status_id_hrd` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_promosi`
--

INSERT INTO `users_promosi` (`id`, `user_id`, `old_bu`, `old_org`, `old_pos`, `new_bu`, `new_org`, `new_pos`, `date_promosi`, `alasan`, `is_app_lv1`, `user_app_lv1`, `date_app_lv1`, `note_lv1`, `app_status_id_lv1`, `is_app_lv2`, `user_app_lv2`, `date_app_lv2`, `note_lv2`, `app_status_id_lv2`, `is_app_lv3`, `user_app_lv3`, `date_app_lv3`, `note_lv3`, `app_status_id_lv3`, `is_app_hrd`, `user_app_hrd`, `date_app_hrd`, `note_hrd`, `app_status_id_hrd`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 20, '50', '50313000', 'PST104', '54                                                ', '541211000', 'BDG2-11', '2015-06-25', 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 0, 1, '2015-06-25', 0, '0000-00-00', 0, '0000-00-00', 0),
(2, 20, '50', '50313000', 'PST104', '54                                                ', '541211000', 'BDG2-11', '2015-06-25', 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 0, 1, '2015-06-25', 0, '0000-00-00', 0, '0000-00-00', 0),
(3, 26, '50', '543113000', 'BDG59', '51                                                ', '511211000', 'JKT2-8', '2015-06-25', 'tes', 0, 'P0501', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 1, '1', '2015-06-25', 'te', 1, 20, '2015-06-25', 0, '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_recruitment`
--

CREATE TABLE IF NOT EXISTS `users_recruitment` (
`id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bu_id` varchar(15) NOT NULL,
  `parent_organization_id` varchar(25) NOT NULL,
  `organization_id` varchar(25) NOT NULL,
  `position_id` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `urgensi_id` int(11) NOT NULL,
  `user_kualifikasi_id` int(11) NOT NULL,
  `user_kemampuan_id` int(11) NOT NULL,
  `is_app_lv1` tinyint(4) NOT NULL,
  `approval_status_id_lv1` int(11) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_lv1` varchar(250) NOT NULL,
  `is_app_lv2` tinyint(4) NOT NULL,
  `approval_status_id_lv2` int(11) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_lv2` varchar(250) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `approval_status_id_lv3` int(11) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_lv3` varchar(256) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `approval_status_id_hrd` int(11) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_hrd` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_recruitment`
--

INSERT INTO `users_recruitment` (`id`, `id_comp_session`, `user_id`, `bu_id`, `parent_organization_id`, `organization_id`, `position_id`, `jumlah`, `status_id`, `urgensi_id`, `user_kualifikasi_id`, `user_kemampuan_id`, `is_app_lv1`, `approval_status_id_lv1`, `user_app_lv1`, `date_app_lv1`, `note_lv1`, `is_app_lv2`, `approval_status_id_lv2`, `user_app_lv2`, `date_app_lv2`, `note_lv2`, `is_app_lv3`, `approval_status_id_lv3`, `user_app_lv3`, `date_app_lv3`, `note_lv3`, `is_app_hrd`, `approval_status_id_hrd`, `user_app_hrd`, `date_app_hrd`, `note_hrd`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 1, 1, '54             ', '542110200', '542110215', 'BDG35', 42, 2, 1, 1, 1, 0, 0, 'P1341', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '0', '0000-00-00', '', 0, 0, '', '0000-00-00', '', 1, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_recruitment_kemampuan`
--

CREATE TABLE IF NOT EXISTS `users_recruitment_kemampuan` (
`id` int(11) NOT NULL,
  `user_recruitment_id` int(11) NOT NULL,
  `komputer` varchar(256) NOT NULL,
  `bahasa_pemrograman` varchar(500) NOT NULL,
  `komunikasi` varchar(256) NOT NULL,
  `grafika` varchar(256) NOT NULL,
  `desain` varchar(256) NOT NULL,
  `brevet_id` int(11) NOT NULL,
  `lain_lain` varchar(256) NOT NULL,
  `portofolio` varchar(256) NOT NULL,
  `pengalaman` varchar(256) NOT NULL,
  `lama_pengalaman` int(11) NOT NULL,
  `job_desc` text NOT NULL,
  `note_pengaju` text NOT NULL,
  `created_on` int(11) NOT NULL,
  `created_by` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_recruitment_kemampuan`
--

INSERT INTO `users_recruitment_kemampuan` (`id`, `user_recruitment_id`, `komputer`, `bahasa_pemrograman`, `komunikasi`, `grafika`, `desain`, `brevet_id`, `lain_lain`, `portofolio`, `pengalaman`, `lama_pengalaman`, `job_desc`, `note_pengaju`, `created_on`, `created_by`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 1, '2', 'vc', '', '', '', 2, '', '', '', 0, 'ccccc', 'ccc', 2015, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_recruitment_kualifikasi`
--

CREATE TABLE IF NOT EXISTS `users_recruitment_kualifikasi` (
`id` int(11) NOT NULL,
  `user_recruitment_id` int(11) NOT NULL,
  `jenis_kelamin_id` varchar(50) NOT NULL,
  `pendidikan_id` varchar(50) NOT NULL,
  `jurusan` varchar(256) NOT NULL,
  `ipk` varchar(5) NOT NULL,
  `toefl` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_recruitment_kualifikasi`
--

INSERT INTO `users_recruitment_kualifikasi` (`id`, `user_recruitment_id`, `jenis_kelamin_id`, `pendidikan_id`, `jurusan`, `ipk`, `toefl`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 1, '2', '2', '1', '1', 1, 1, '2015-06-24', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_resignment`
--

CREATE TABLE IF NOT EXISTS `users_resignment` (
`id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_resign` date NOT NULL,
  `alasan_resign_id` varchar(256) NOT NULL,
  `desc_resign` text NOT NULL,
  `procedure_resign` text NOT NULL,
  `kepuasan_resign` text NOT NULL,
  `saran_resign` text NOT NULL,
  `rework_resign` text NOT NULL,
  `is_app_lv1` tinyint(4) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_lv1` varchar(256) NOT NULL,
  `app_status_id_lv1` int(11) NOT NULL,
  `is_app_lv2` tinyint(4) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_lv2` varchar(256) NOT NULL,
  `app_status_id_lv2` int(11) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_lv3` varchar(256) NOT NULL,
  `app_status_id_lv3` int(11) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_hrd` text NOT NULL,
  `app_status_id_hrd` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_sk`
--

CREATE TABLE IF NOT EXISTS `users_sk` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sk_date` datetime NOT NULL,
  `sk_no` varchar(254) NOT NULL,
  `position_id` int(2) NOT NULL,
  `departement_id` int(2) NOT NULL,
  `effective_date` datetime NOT NULL,
  `location` varchar(254) NOT NULL,
  `sign_name` varchar(254) NOT NULL,
  `sign_position` varchar(254) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_sk`
--

INSERT INTO `users_sk` (`id`, `user_id`, `sk_date`, `sk_no`, `position_id`, `departement_id`, `effective_date`, `location`, `sign_name`, `sign_position`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, '2015-02-04 00:00:00', '1', 1, 0, '2015-02-10 00:00:00', '1', '1', '1', '2015-02-03 00:00:00', 1, '0000-00-00 00:00:00', 0, 1, '2015-02-03 00:00:00', 1),
(2, 8, '2015-02-04 00:00:00', '1', 1, 0, '2015-02-11 00:00:00', '1', 'edit', 'IT officer', '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 1, '2015-02-03 00:00:00', 1),
(3, 8, '2015-02-04 00:00:00', '1', 1, 0, '2015-02-11 00:00:00', '1', '1', '1', '2015-02-03 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 8, '2015-02-10 00:00:00', '2_edit', 1, 0, '2015-02-12 00:00:00', '2', '2', '2', '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_dalam`
--

CREATE TABLE IF NOT EXISTS `users_spd_dalam` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `task_receiver` varchar(15) NOT NULL COMMENT 'user_id yang ditugaskan ',
  `task_creator` varchar(15) NOT NULL,
  `destination` varchar(254) NOT NULL,
  `date_spd` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_submit` tinyint(1) NOT NULL DEFAULT '0',
  `date_submit` date NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user_id yang memberi tugas',
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_spd_dalam`
--

INSERT INTO `users_spd_dalam` (`id`, `title`, `task_receiver`, `task_creator`, `destination`, `date_spd`, `start_time`, `end_time`, `is_submit`, `date_submit`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'tes', 'B0018', 'P0501', 'tes', '2015-06-22', '20:12:30', '20:12:30', 0, '0000-00-00', '2015-06-22 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'dsad', 'B0018', 'B0018', 'dsad', '2015-06-26', '01:08:45', '01:08:45', 0, '0000-00-00', '2015-06-25 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'ghfh', 'P0159', 'P0501', 'uy', '2015-06-26', '01:43:30', '01:43:30', 0, '0000-00-00', '2015-06-25 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'ghfh', 'P0159', 'P0501', 'uy', '2015-06-26', '01:43:30', '01:43:30', 0, '0000-00-00', '2015-06-25 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(5, 'dsa', 'B0018', 'P0501', 'dsa', '2015-06-30', '02:23:45', '02:23:45', 1, '2015-06-25', '2015-06-25 00:00:00', 20, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_dalam_group`
--

CREATE TABLE IF NOT EXISTS `users_spd_dalam_group` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `task_receiver` varchar(1000) NOT NULL COMMENT 'user_id yang ditugaskan ',
  `task_creator` varchar(15) NOT NULL,
  `destination` varchar(254) NOT NULL,
  `date_spd` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_submit` tinyint(1) NOT NULL DEFAULT '0',
  `user_submit` varchar(1000) NOT NULL,
  `date_submit` date NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user_id yang memberi tugas',
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_spd_dalam_group`
--

INSERT INTO `users_spd_dalam_group` (`id`, `title`, `task_receiver`, `task_creator`, `destination`, `date_spd`, `start_time`, `end_time`, `is_submit`, `user_submit`, `date_submit`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'dsa', 'B0018,P0501', 'B0018', 'rtwe', '2015-06-26', '01:05:45', '01:05:45', 0, '', '0000-00-00', '2015-06-25 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_dalam_report`
--

CREATE TABLE IF NOT EXISTS `users_spd_dalam_report` (
`id` int(11) NOT NULL,
  `user_spd_dalam_id` int(11) NOT NULL,
  `is_done` tinyint(4) NOT NULL,
  `attachment` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `result` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_spd_dalam_report`
--

INSERT INTO `users_spd_dalam_report` (`id`, `user_spd_dalam_id`, `is_done`, `attachment`, `description`, `result`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 5, 1, 'installation_status.xml', 'dsa', 'dsa', '2015-06-25 00:00:00', 26, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 5, 0, '', 'dsa', 'dsa', '2015-06-25 00:00:00', 26, '2015-06-25 00:00:00', 26, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_dalam_report_group`
--

CREATE TABLE IF NOT EXISTS `users_spd_dalam_report_group` (
`id` int(11) NOT NULL,
  `user_spd_dalam_group_id` int(11) NOT NULL,
  `is_done` tinyint(4) NOT NULL,
  `attachment` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `result` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_luar`
--

CREATE TABLE IF NOT EXISTS `users_spd_luar` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `task_receiver` varchar(15) NOT NULL COMMENT 'user_id yang ditugaskan ',
  `task_creator` varchar(15) NOT NULL,
  `destination` varchar(254) NOT NULL,
  `date_spd_start` date NOT NULL,
  `date_spd_end` date NOT NULL,
  `from_city_id` int(11) NOT NULL,
  `to_city_id` int(11) NOT NULL,
  `transportation_id` int(11) NOT NULL,
  `is_submit` tinyint(1) NOT NULL DEFAULT '0',
  `date_submit` date NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user_id yang memberi tugas',
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_spd_luar`
--

INSERT INTO `users_spd_luar` (`id`, `title`, `task_receiver`, `task_creator`, `destination`, `date_spd_start`, `date_spd_end`, `from_city_id`, `to_city_id`, `transportation_id`, `is_submit`, `date_submit`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'rew', 'B0018', 'P0501', 'er', '2015-06-24', '2015-06-26', 1, 1, 1, 0, '0000-00-00', '2015-06-24 00:00:00', 20, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'cxzc', 'P1808', 'B0018', 'xzc', '2015-06-24', '2015-06-25', 1, 1, 1, 0, '0000-00-00', '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'dsa', 'P0159', 'B0018', 'dsa', '2015-06-26', '2015-06-30', 1, 1, 1, 0, '0000-00-00', '2015-06-25 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_luar_group`
--

CREATE TABLE IF NOT EXISTS `users_spd_luar_group` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `task_receiver` varchar(1000) NOT NULL COMMENT 'user_id yang ditugaskan ',
  `task_creator` varchar(15) NOT NULL,
  `destination` varchar(254) NOT NULL,
  `date_spd_start` date NOT NULL,
  `date_spd_end` date NOT NULL,
  `from_city_id` int(11) NOT NULL,
  `to_city_id` int(11) NOT NULL,
  `transportation_id` int(11) NOT NULL,
  `is_submit` tinyint(1) NOT NULL DEFAULT '0',
  `user_submit` varchar(1000) NOT NULL,
  `date_submit` date NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user_id yang memberi tugas',
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_spd_luar_group`
--

INSERT INTO `users_spd_luar_group` (`id`, `title`, `task_receiver`, `task_creator`, `destination`, `date_spd_start`, `date_spd_end`, `from_city_id`, `to_city_id`, `transportation_id`, `is_submit`, `user_submit`, `date_submit`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 'dsa', 'B0018,P0159,P0501,P1341,P1563', 'P0501', 'asd', '2015-06-24', '2015-06-26', 1, 2, 2, 0, '', '0000-00-00', '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(2, 'dsa', 'P0567,P1160,P1493', 'P1493', 'asd', '2015-06-24', '2015-06-26', 1, 2, 2, 0, '', '0000-00-00', '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(3, 'dsad', 'B0018,P0159,P0501,P1052,P1341,P1563,P1808,P1869,P1889', 'B0018', 'dsad', '2015-06-24', '2015-06-23', 1, 1, 1, 0, '', '0000-00-00', '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0),
(4, 'dsad', 'B0018,P0159,P0501,P1052,P1341,P1563,P1808,P1869,P1889', 'B0018', 'dsad', '2015-06-24', '2015-06-23', 1, 1, 1, 0, '', '0000-00-00', '2015-06-24 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_luar_report`
--

CREATE TABLE IF NOT EXISTS `users_spd_luar_report` (
`id` int(11) NOT NULL,
  `user_spd_luar_id` int(11) NOT NULL,
  `is_done` tinyint(4) NOT NULL,
  `attachment` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `result` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_spd_luar_report_group`
--

CREATE TABLE IF NOT EXISTS `users_spd_luar_report_group` (
`id` int(11) NOT NULL,
  `user_spd_luar_group_id` int(11) NOT NULL,
  `is_done` tinyint(4) NOT NULL,
  `attachment` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `result` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_sti`
--

CREATE TABLE IF NOT EXISTS `users_sti` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `identity_no` varchar(254) NOT NULL,
  `ijazah_name` varchar(254) NOT NULL,
  `ijazah_number` varchar(254) NOT NULL,
  `ijazah_history` varchar(254) NOT NULL,
  `institution` varchar(254) NOT NULL,
  `published_place` varchar(254) NOT NULL,
  `activation_date` datetime NOT NULL,
  `position_id` int(2) NOT NULL,
  `receivedby_id` int(11) NOT NULL,
  `acknowledgeby_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_sti`
--

INSERT INTO `users_sti` (`id`, `user_id`, `identity_no`, `ijazah_name`, `ijazah_number`, `ijazah_history`, `institution`, `published_place`, `activation_date`, `position_id`, `receivedby_id`, `acknowledgeby_id`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 8, 'sdf', 'sdf', '1', '1', '1', '1', '2015-02-04 00:00:00', 2, 8, 8, '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 1, '2015-02-03 00:00:00', 1),
(2, 8, 'test', 'test', '2', '2', '2', '2', '2015-02-24 00:00:00', 2, 8, 8, '2015-02-03 00:00:00', 1, '2015-02-03 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(3, 8, '3 edit', '3 edit', '3', '3', '3', '3', '2015-02-17 00:00:00', 1, 8, 1, '2015-02-03 00:00:00', 1, '2015-02-04 00:00:00', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_training`
--

CREATE TABLE IF NOT EXISTS `users_training` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `training_name` varchar(50) NOT NULL,
  `tujuan_training` varchar(150) NOT NULL,
  `training_type_id` int(11) NOT NULL,
  `penyelenggara_id` int(11) NOT NULL,
  `pembiayaan_id` int(11) NOT NULL,
  `ikatan_dinas_id` int(11) NOT NULL,
  `waktu_id` int(11) NOT NULL,
  `besar_biaya` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `lama_training_bulan` int(11) NOT NULL COMMENT 'lama training dalam bulan',
  `lama_training_hari` int(11) NOT NULL COMMENT 'lama training dalam hari',
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `narasumber` varchar(256) NOT NULL,
  `vendor` varchar(256) NOT NULL,
  `is_app_lv1` tinyint(1) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_app_lv1` text NOT NULL,
  `approval_status_id_lv1` int(11) NOT NULL,
  `is_app_lv2` tinyint(1) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_app_lv2` text NOT NULL,
  `approval_status_id_lv2` int(11) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_app_lv3` varchar(256) NOT NULL,
  `approval_status_id_lv3` int(11) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_app_hrd` varchar(256) NOT NULL,
  `approval_status_id_hrd` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_training_group`
--

CREATE TABLE IF NOT EXISTS `users_training_group` (
`id` int(11) NOT NULL,
  `user_pengaju_id` int(11) NOT NULL,
  `user_peserta_id` varchar(500) NOT NULL,
  `id_comp_session` int(11) NOT NULL,
  `training_name` varchar(50) NOT NULL,
  `tujuan_training` varchar(150) NOT NULL,
  `training_type_id` int(11) NOT NULL,
  `penyelenggara_id` int(11) NOT NULL,
  `pembiayaan_id` int(11) NOT NULL,
  `ikatan_dinas_id` int(11) NOT NULL,
  `waktu_id` int(11) NOT NULL,
  `besar_biaya` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `lama_training_bulan` int(11) NOT NULL COMMENT 'lama training dalam bulan',
  `lama_training_hari` int(11) NOT NULL COMMENT 'lama training dalam hari',
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `narasumber` varchar(256) NOT NULL,
  `vendor` varchar(256) NOT NULL,
  `is_app_lv1` tinyint(1) NOT NULL,
  `user_app_lv1` varchar(10) NOT NULL,
  `date_app_lv1` date NOT NULL,
  `note_app_lv1` text NOT NULL,
  `approval_status_id_lv1` int(11) NOT NULL,
  `is_app_lv2` tinyint(1) NOT NULL,
  `user_app_lv2` varchar(10) NOT NULL,
  `date_app_lv2` date NOT NULL,
  `note_app_lv2` text NOT NULL,
  `approval_status_id_lv2` int(11) NOT NULL,
  `is_app_lv3` tinyint(4) NOT NULL,
  `user_app_lv3` varchar(10) NOT NULL,
  `date_app_lv3` date NOT NULL,
  `note_app_lv3` varchar(256) NOT NULL,
  `approval_status_id_lv3` int(11) NOT NULL,
  `is_app_hrd` tinyint(4) NOT NULL,
  `user_app_hrd` varchar(10) NOT NULL,
  `date_app_hrd` date NOT NULL,
  `note_app_hrd` varchar(256) NOT NULL,
  `approval_status_id_hrd` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_att`
--
CREATE TABLE IF NOT EXISTS `view_att` (
`id` int(11)
,`jhk` int(11)
,`sakit` int(11)
,`opname` int(11)
,`opname_istirahat` int(11)
,`kecelakaan_kerja` int(11)
,`cuti` int(11)
,`phl` int(11)
,`ijin` int(11)
,`alpa` int(11)
,`off` int(11)
,`potong_gaji` int(11)
,`pc` int(11)
,`jh` int(11)
,`hr` int(11)
,`tanggal` varchar(255)
,`bulan` varchar(255)
,`tahun` varchar(255)
,`scan_masuk` varchar(255)
,`scan_pulang` varchar(255)
,`terlambat` varchar(255)
,`plg_cepat` varchar(255)
,`lembur` varchar(255)
,`ot_incidental` tinyint(4)
,`ot_allow_shift` tinyint(4)
,`ot_cont_allow` varchar(4)
,`acc_ot_incidental` float
,`acc_allow_shift` float
,`acc_ot_cont_allow` float
,`alasan_lembur` tinyint(4)
,`jam_kerja` varchar(255)
,`keterangan` text
,`create_date` datetime
,`create_user_id` int(11)
,`modify_date` datetime
,`modify_user_id` int(11)
,`date_full` text
,`nik` varchar(15)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(100)
,`mchID` varchar(15)
);
-- --------------------------------------------------------

--
-- Structure for view `view_att`
--
DROP TABLE IF EXISTS `view_att`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_att` AS select `a`.`id` AS `id`,`a`.`jhk` AS `jhk`,`a`.`sakit` AS `sakit`,`a`.`opname` AS `opname`,`a`.`opname_istirahat` AS `opname_istirahat`,`a`.`kecelakaan_kerja` AS `kecelakaan_kerja`,`a`.`cuti` AS `cuti`,`a`.`phl` AS `phl`,`a`.`ijin` AS `ijin`,`a`.`alpa` AS `alpa`,`a`.`off` AS `off`,`a`.`potong_gaji` AS `potong_gaji`,`a`.`pc` AS `pc`,`a`.`jh` AS `jh`,`a`.`hr` AS `hr`,`a`.`tanggal` AS `tanggal`,`a`.`bulan` AS `bulan`,`a`.`tahun` AS `tahun`,`a`.`scan_masuk` AS `scan_masuk`,`a`.`scan_pulang` AS `scan_pulang`,`a`.`terlambat` AS `terlambat`,`a`.`plg_cepat` AS `plg_cepat`,`a`.`lembur` AS `lembur`,`a`.`ot_incidental` AS `ot_incidental`,`a`.`ot_allow_shift` AS `ot_allow_shift`,`a`.`ot_cont_allow` AS `ot_cont_allow`,`a`.`acc_ot_incidental` AS `acc_ot_incidental`,`a`.`acc_allow_shift` AS `acc_allow_shift`,`a`.`acc_ot_cont_allow` AS `acc_ot_cont_allow`,`a`.`alasan_lembur` AS `alasan_lembur`,`a`.`jam_kerja` AS `jam_kerja`,`a`.`keterangan` AS `keterangan`,`a`.`create_date` AS `create_date`,`a`.`create_user_id` AS `create_user_id`,`a`.`modify_date` AS `modify_date`,`a`.`modify_user_id` AS `modify_user_id`,concat(`a`.`tahun`,'-',`a`.`bulan`,'-',`a`.`tanggal`) AS `date_full`,`b`.`nik` AS `nik`,`b`.`first_name` AS `first_name`,`b`.`last_name` AS `last_name`,`b`.`email` AS `email`,`b`.`mchID` AS `mchID` from (`attendance` `a` join `users` `b` on((`b`.`mchID` = convert(`a`.`nik` using utf8))));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_inactive`
--
ALTER TABLE `active_inactive`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alasan_cuti`
--
ALTER TABLE `alasan_cuti`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alasan_resign`
--
ALTER TABLE `alasan_resign`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_status`
--
ALTER TABLE `approval_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`id`), ADD KEY `karyawan` (`nik`), ADD KEY `tanggal` (`tanggal`), ADD KEY `bulan` (`bulan`), ADD KEY `tahun` (`tahun`), ADD KEY `jhk` (`jhk`,`sakit`,`cuti`,`ijin`,`alpa`,`off`,`potong_gaji`,`pc`,`jh`);

--
-- Indexes for table `award_warning_type`
--
ALTER TABLE `award_warning_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certification_type`
--
ALTER TABLE `certification_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comp_session`
--
ALTER TABLE `comp_session`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_status`
--
ALTER TABLE `course_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dollar_rate`
--
ALTER TABLE `dollar_rate`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_center`
--
ALTER TABLE `education_center`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_degree`
--
ALTER TABLE `education_degree`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_group`
--
ALTER TABLE `education_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_status`
--
ALTER TABLE `employee_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empl_status`
--
ALTER TABLE `empl_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exit_type`
--
ALTER TABLE `exit_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_field`
--
ALTER TABLE `exp_field`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_level`
--
ALTER TABLE `exp_level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_year`
--
ALTER TABLE `exp_year`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fpdata`
--
ALTER TABLE `fpdata`
 ADD PRIMARY KEY (`mchID`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ikatan_dinas_type`
--
ALTER TABLE `ikatan_dinas_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipk`
--
ALTER TABLE `ipk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keterangan_absen`
--
ALTER TABLE `keterangan_absen`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kg_kehadiran`
--
ALTER TABLE `kg_kehadiran`
 ADD PRIMARY KEY (`id`), ADD KEY `karyawan` (`nik`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital`
--
ALTER TABLE `marital`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_hubungan`
--
ALTER TABLE `medical_hubungan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_jenis_pemeriksaan`
--
ALTER TABLE `medical_jenis_pemeriksaan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_class`
--
ALTER TABLE `organization_class`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_by_position`
--
ALTER TABLE `payroll_by_position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_setup`
--
ALTER TABLE `payroll_setup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_type`
--
ALTER TABLE `payroll_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_group`
--
ALTER TABLE `position_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_brevet`
--
ALTER TABLE `recruitment_brevet`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_jurusan`
--
ALTER TABLE `recruitment_jurusan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_komputer`
--
ALTER TABLE `recruitment_komputer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_pendidikan`
--
ALTER TABLE `recruitment_pendidikan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_status`
--
ALTER TABLE `recruitment_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_urgensi`
--
ALTER TABLE `recruitment_urgensi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resign_reason`
--
ALTER TABLE `resign_reason`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_setup`
--
ALTER TABLE `table_setup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tadat`
--
ALTER TABLE `tadat`
 ADD PRIMARY KEY (`mchID`,`tgl`);

--
-- Indexes for table `toefl`
--
ALTER TABLE `toefl`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_ikatan_dinas`
--
ALTER TABLE `training_ikatan_dinas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_type`
--
ALTER TABLE `training_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_waktu`
--
ALTER TABLE `training_waktu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_inventory`
--
ALTER TABLE `type_inventory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `users_absen`
--
ALTER TABLE `users_absen`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_api`
--
ALTER TABLE `users_api`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_awardwarning`
--
ALTER TABLE `users_awardwarning`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_certificate`
--
ALTER TABLE `users_certificate`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_course`
--
ALTER TABLE `users_course`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_cuti`
--
ALTER TABLE `users_cuti`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_users_sti` (`user_id`);

--
-- Indexes for table `users_cuti_plafon`
--
ALTER TABLE `users_cuti_plafon`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_users_sti` (`user_id`);

--
-- Indexes for table `users_demolition`
--
ALTER TABLE `users_demolition`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_education`
--
ALTER TABLE `users_education`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_employement`
--
ALTER TABLE `users_employement`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_exit`
--
ALTER TABLE `users_exit`
 ADD PRIMARY KEY (`id`,`user_id`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users_exit_rekomendasi`
--
ALTER TABLE `users_exit_rekomendasi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_experience`
--
ALTER TABLE `users_experience`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_ikatan_dinas`
--
ALTER TABLE `users_ikatan_dinas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_inventory`
--
ALTER TABLE `users_inventory`
 ADD PRIMARY KEY (`id`), ADD KEY `users_inventory_ibfk_1` (`user_exit_id`);

--
-- Indexes for table `users_inventory_exit`
--
ALTER TABLE `users_inventory_exit`
 ADD PRIMARY KEY (`id`), ADD KEY `users_inventory_exit_ibfk_1` (`user_exit_id`);

--
-- Indexes for table `users_jabatan`
--
ALTER TABLE `users_jabatan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_medical`
--
ALTER TABLE `users_medical`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_medical_detail`
--
ALTER TABLE `users_medical_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `user_medical_id` (`user_medical_id`);

--
-- Indexes for table `users_medical_hrd`
--
ALTER TABLE `users_medical_hrd`
 ADD PRIMARY KEY (`id`), ADD KEY `users_medical_hrd_ibfk_1` (`user_medical_detail_id`);

--
-- Indexes for table `users_promosi`
--
ALTER TABLE `users_promosi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_recruitment`
--
ALTER TABLE `users_recruitment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_recruitment_kemampuan`
--
ALTER TABLE `users_recruitment_kemampuan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_recruitment_kualifikasi`
--
ALTER TABLE `users_recruitment_kualifikasi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_resignment`
--
ALTER TABLE `users_resignment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_sk`
--
ALTER TABLE `users_sk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_dalam`
--
ALTER TABLE `users_spd_dalam`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_dalam_group`
--
ALTER TABLE `users_spd_dalam_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_dalam_report`
--
ALTER TABLE `users_spd_dalam_report`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_dalam_report_group`
--
ALTER TABLE `users_spd_dalam_report_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_luar`
--
ALTER TABLE `users_spd_luar`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_luar_group`
--
ALTER TABLE `users_spd_luar_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_luar_report`
--
ALTER TABLE `users_spd_luar_report`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_spd_luar_report_group`
--
ALTER TABLE `users_spd_luar_report_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_sti`
--
ALTER TABLE `users_sti`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_training`
--
ALTER TABLE `users_training`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_training_group`
--
ALTER TABLE `users_training_group`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_inactive`
--
ALTER TABLE `active_inactive`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `alasan_cuti`
--
ALTER TABLE `alasan_cuti`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `alasan_resign`
--
ALTER TABLE `alasan_resign`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `approval_status`
--
ALTER TABLE `approval_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `award_warning_type`
--
ALTER TABLE `award_warning_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certification_type`
--
ALTER TABLE `certification_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comp_session`
--
ALTER TABLE `comp_session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `course_status`
--
ALTER TABLE `course_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dollar_rate`
--
ALTER TABLE `dollar_rate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `education_center`
--
ALTER TABLE `education_center`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education_degree`
--
ALTER TABLE `education_degree`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education_group`
--
ALTER TABLE `education_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `employee_status`
--
ALTER TABLE `employee_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `empl_status`
--
ALTER TABLE `empl_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `exit_type`
--
ALTER TABLE `exit_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exp_field`
--
ALTER TABLE `exp_field`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exp_level`
--
ALTER TABLE `exp_level`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exp_year`
--
ALTER TABLE `exp_year`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ikatan_dinas_type`
--
ALTER TABLE `ikatan_dinas_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ipk`
--
ALTER TABLE `ipk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `keterangan_absen`
--
ALTER TABLE `keterangan_absen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kg_kehadiran`
--
ALTER TABLE `kg_kehadiran`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marital`
--
ALTER TABLE `marital`
MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `medical_hubungan`
--
ALTER TABLE `medical_hubungan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `medical_jenis_pemeriksaan`
--
ALTER TABLE `medical_jenis_pemeriksaan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `organization_class`
--
ALTER TABLE `organization_class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payroll_by_position`
--
ALTER TABLE `payroll_by_position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payroll_setup`
--
ALTER TABLE `payroll_setup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payroll_type`
--
ALTER TABLE `payroll_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `position_group`
--
ALTER TABLE `position_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `recruitment_brevet`
--
ALTER TABLE `recruitment_brevet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `recruitment_jurusan`
--
ALTER TABLE `recruitment_jurusan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `recruitment_komputer`
--
ALTER TABLE `recruitment_komputer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `recruitment_pendidikan`
--
ALTER TABLE `recruitment_pendidikan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `recruitment_status`
--
ALTER TABLE `recruitment_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `recruitment_urgensi`
--
ALTER TABLE `recruitment_urgensi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `resign_reason`
--
ALTER TABLE `resign_reason`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_setup`
--
ALTER TABLE `table_setup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `toefl`
--
ALTER TABLE `toefl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `training_ikatan_dinas`
--
ALTER TABLE `training_ikatan_dinas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `training_type`
--
ALTER TABLE `training_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `training_waktu`
--
ALTER TABLE `training_waktu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_inventory`
--
ALTER TABLE `type_inventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `users_absen`
--
ALTER TABLE `users_absen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_api`
--
ALTER TABLE `users_api`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_awardwarning`
--
ALTER TABLE `users_awardwarning`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_certificate`
--
ALTER TABLE `users_certificate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_course`
--
ALTER TABLE `users_course`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users_cuti`
--
ALTER TABLE `users_cuti`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_cuti_plafon`
--
ALTER TABLE `users_cuti_plafon`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_demolition`
--
ALTER TABLE `users_demolition`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_education`
--
ALTER TABLE `users_education`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_employement`
--
ALTER TABLE `users_employement`
MODIFY `id` bigint(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users_exit`
--
ALTER TABLE `users_exit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_exit_rekomendasi`
--
ALTER TABLE `users_exit_rekomendasi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_experience`
--
ALTER TABLE `users_experience`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `users_ikatan_dinas`
--
ALTER TABLE `users_ikatan_dinas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_inventory`
--
ALTER TABLE `users_inventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_inventory_exit`
--
ALTER TABLE `users_inventory_exit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_jabatan`
--
ALTER TABLE `users_jabatan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_medical`
--
ALTER TABLE `users_medical`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_medical_detail`
--
ALTER TABLE `users_medical_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_medical_hrd`
--
ALTER TABLE `users_medical_hrd`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users_promosi`
--
ALTER TABLE `users_promosi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_recruitment`
--
ALTER TABLE `users_recruitment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_recruitment_kemampuan`
--
ALTER TABLE `users_recruitment_kemampuan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_recruitment_kualifikasi`
--
ALTER TABLE `users_recruitment_kualifikasi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_resignment`
--
ALTER TABLE `users_resignment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_sk`
--
ALTER TABLE `users_sk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_spd_dalam`
--
ALTER TABLE `users_spd_dalam`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_spd_dalam_group`
--
ALTER TABLE `users_spd_dalam_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_spd_dalam_report`
--
ALTER TABLE `users_spd_dalam_report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_spd_dalam_report_group`
--
ALTER TABLE `users_spd_dalam_report_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_spd_luar`
--
ALTER TABLE `users_spd_luar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_spd_luar_group`
--
ALTER TABLE `users_spd_luar_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_spd_luar_report`
--
ALTER TABLE `users_spd_luar_report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_spd_luar_report_group`
--
ALTER TABLE `users_spd_luar_report_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_sti`
--
ALTER TABLE `users_sti`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_training`
--
ALTER TABLE `users_training`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_training_group`
--
ALTER TABLE `users_training_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_inventory`
--
ALTER TABLE `users_inventory`
ADD CONSTRAINT `users_inventory_ibfk_1` FOREIGN KEY (`user_exit_id`) REFERENCES `users_exit` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users_inventory_exit`
--
ALTER TABLE `users_inventory_exit`
ADD CONSTRAINT `users_inventory_exit_ibfk_1` FOREIGN KEY (`user_exit_id`) REFERENCES `users_exit` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users_medical_detail`
--
ALTER TABLE `users_medical_detail`
ADD CONSTRAINT `users_medical_detail_ibfk_1` FOREIGN KEY (`user_medical_id`) REFERENCES `users_medical` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_medical_hrd`
--
ALTER TABLE `users_medical_hrd`
ADD CONSTRAINT `users_medical_hrd_ibfk_1` FOREIGN KEY (`user_medical_detail_id`) REFERENCES `users_medical_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
