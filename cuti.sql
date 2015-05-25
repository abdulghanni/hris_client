-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2015 at 03:34 PM
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
-- Table structure for table `alasan_cuti`
--

CREATE TABLE IF NOT EXISTS `alasan_cuti` (
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
-- Dumping data for table `alasan_cuti`
--


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
  `alasan_cuti_id` int(11) NOT NULL,
  `user_pengganti` int(11) NOT NULL COMMENT 'user_id kary pengganti',
  `alamat_cuti` text NOT NULL,
  `is_app_lv1` tinyint(1) NOT NULL DEFAULT '0',
  `user_app_lv1` int(11) NOT NULL COMMENT 'user_id supervisor',
  `date_app_lv1` date NOT NULL,
  `note_app_lv1` text NOT NULL,
  `is_app_lv2` tinyint(1) NOT NULL DEFAULT '0',
  `user_app_lv2` int(11) NOT NULL COMMENT 'user_id approval level2',
  `date_app_lv2` date NOT NULL,
  `note_app_lv2` text NOT NULL,
  `is_app_lv3` tinyint(1) NOT NULL DEFAULT '0',
  `user_app_lv3` int(11) NOT NULL,
  `date_app_lv3` date NOT NULL,
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

INSERT INTO `users_cuti` (`id`, `user_id`, `id_comp_session`, `date_mulai_cuti`, `date_selesai_cuti`, `jumlah_hari`, `alasan_cuti_id`, `user_pengganti`, `alamat_cuti`, `is_app_lv1`, `user_app_lv1`, `date_app_lv1`, `note_app_lv1`, `is_app_lv2`, `user_app_lv2`, `date_app_lv2`, `note_app_lv2`, `is_app_lv3`, `user_app_lv3`, `date_app_lv3`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 1, 1, '2015-03-04', '2015-03-10', 6, 1, 97, 'jl.xxx', 1, 1, '2015-03-16', '', 1, 1, '2015-03-16', '', 1, 1, '2015-03-16', '2015-03-16 00:00:00', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alasan_cuti`
--
ALTER TABLE `alasan_cuti`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alasan_cuti`
--
ALTER TABLE `alasan_cuti`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
