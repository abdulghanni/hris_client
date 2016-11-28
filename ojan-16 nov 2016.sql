/*
Navicat MySQL Data Transfer

Source Server         : lokalhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : erlangga_hris

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-11-16 02:04:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users_spd_luar_group
-- ----------------------------
DROP TABLE IF EXISTS `users_spd_luar_group`;
CREATE TABLE `users_spd_luar_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `task_receiver` varchar(1000) NOT NULL COMMENT 'user_id yang ditugaskan ',
  `task_creator` varchar(15) NOT NULL,
  `destination` varchar(254) NOT NULL,
  `date_spd_start` date NOT NULL,
  `date_spd_end` date NOT NULL,
  `from_city_id` int(11) NOT NULL,
  `to_city_id` int(11) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `nama_kantor_cabang` varchar(255) DEFAULT NULL,
  `transportation_id` varchar(50) NOT NULL,
  `is_submit` tinyint(1) NOT NULL DEFAULT '0',
  `user_submit` varchar(1000) NOT NULL,
  `date_submit` date NOT NULL,
  `diajukan_ke` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
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
  `app_status_id_lv1` int(11) NOT NULL,
  `note_lv1` varchar(256) NOT NULL,
  `app_status_id_lv2` int(11) NOT NULL,
  `note_lv2` varchar(256) NOT NULL,
  `app_status_id_lv3` int(11) NOT NULL,
  `note_lv3` varchar(256) NOT NULL,
  `app_status_id_hrd` int(11) NOT NULL,
  `note_hrd` varchar(256) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'user_id yang memberi tugas',
  `edited_on` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `cancel_note` varchar(255) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `is_app_lv4` tinyint(4) NOT NULL,
  `user_app_lv4` varchar(10) NOT NULL,
  `date_app_lv4` date NOT NULL,
  `is_app_lv5` tinyint(4) NOT NULL,
  `user_app_lv5` varchar(10) NOT NULL,
  `date_app_lv5` date NOT NULL,
  `is_app_lv6` tinyint(4) NOT NULL,
  `user_app_lv6` varchar(10) NOT NULL,
  `date_app_lv6` date NOT NULL,
  `is_app_lv7` tinyint(4) NOT NULL,
  `user_app_lv7` varchar(10) NOT NULL,
  `date_app_lv7` date NOT NULL,
  `is_app_lv8` tinyint(4) NOT NULL,
  `user_app_lv8` varchar(10) NOT NULL,
  `date_app_lv8` date NOT NULL,
  `is_app_lv9` tinyint(4) NOT NULL,
  `user_app_lv9` varchar(10) NOT NULL,
  `date_app_lv9` date NOT NULL,
  `is_app_lv10` tinyint(4) NOT NULL,
  `user_app_lv10` varchar(10) NOT NULL,
  `date_app_lv10` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pjd_biaya_intern
-- ----------------------------
DROP TABLE IF EXISTS `pjd_biaya_intern`;
CREATE TABLE `pjd_biaya_intern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `type_grade` int(11) NOT NULL,
  `jumlah_biaya` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
