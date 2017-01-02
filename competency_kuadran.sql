-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2016 at 08:50 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erlangga_hris__`
--

-- --------------------------------------------------------

--
-- Table structure for table `competency_kuadran`
--

DROP TABLE IF EXISTS `competency_kuadran`;
CREATE TABLE IF NOT EXISTS `competency_kuadran` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



INSERT INTO `competency_kuadran` (`id`, `title`) VALUES
(1, 'SDM MAU, TIDAK MAMPU (Teknis & Kepemimpinan) Kurang/Tidak Baik (Sikap Mau Belajar dan Mau Berubah) Baik'),
(2, 'SDM MAU, MAMPU (Teknis & Kepemimpinan) Baik (Sikap Mau Belajar dan Mau Berubah) Baik'),
(3, 'SDM TIDAK MAU, MAMPU (Teknis & Kepemimpinan) Baik (Sikap Mau Belajar dan Mau Berubah) Kurang/Tidak Baik'),
(4, 'SDM TIDAK MAU, TIDAK MAMPU (Teknis & Kepemimpinan) Kurang/Tidak Baik (Sikap Mau Belajar dan Mau Berubah) Kurang/Tidak Baik');


ALTER TABLE `competency_kuadran`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `competency_kuadran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

ALTER TABLE `competency_form_penilaian` ADD `kuadran_id` INT NOT NULL AFTER `nik`;




ALTER TABLE `competency_form_evaluasi_training` ADD `hrd2` VARCHAR(10) NOT NULL AFTER `date_app`, ADD `hrd2_is_app` TINYINT(4) NOT NULL AFTER `hrd2`, ADD `hrd2_app_status_id` INT(11) NOT NULL AFTER `hrd2_is_app`, ADD `hrd2_date_app` DATE NOT NULL AFTER `hrd2_app_status_id`;
ALTER TABLE `competency_form_evaluasi_training` ADD `hrd2_note` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL;
ALTER TABLE `competency_personal_assesment` ADD `comp_session_id` INT(11) NOT NULL AFTER `id`;

ALTER TABLE `competency_form_penilaian` ADD `comp_session_id` INT(11) NOT NULL AFTER `id`;


ALTER TABLE `competency_mapping_kpi_detail` ADD `created_on` DATETIME NOT NULL , ADD `created_by` INT NOT NULL , ADD `edited_on` DATETIME NOT NULL , ADD `edited_by` INT NOT NULL , ADD `is_deleted` INT NOT NULL , ADD `deleted_on` DATETIME NOT NULL , ADD `deleted_by` INT NOT NULL ;