--
-- MySQL 5.5.8
-- Wed, 28 Aug 2013 07:34:06 +0000
--

CREATE DATABASE `peusto` DEFAULT CHARSET utf8;

USE `peusto`;

CREATE TABLE `day_type` (
   `idday_type` int(11) not null auto_increment,
   `day_type_name` varchar(10),
   `day_type_description` varchar(45),
   PRIMARY KEY (`idday_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

INSERT INTO `day_type` (`idday_type`, `day_type_name`, `day_type_description`) VALUES 
('1', '工作日', '需要上班的日子，一般是每周一——周五'),
('2', '休息日', '一般包括周末、国家法定假日'),
('3', '每天', '包含每一天');

CREATE TABLE `high_perfomance_time` (
   `idhigh_perfomance_time` int(11) not null auto_increment,
   `day_type` int(11),
   `time_span_start` varchar(10),
   `time_span_end` varchar(45),
   `owner` int(11),
   PRIMARY KEY (`idhigh_perfomance_time`),
   KEY `fk_high_performance_time_ref_user_idx` (`owner`),
   KEY `fk_high_performance_time_ref_day_type_idx` (`day_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [表 `high_perfomance_time` 为空]

CREATE TABLE `interest_area` (
   `idinterest_area` int(11) not null auto_increment,
   `interest_area_name` varchar(20),
   `display_order` tinyint(4),
   PRIMARY KEY (`idinterest_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

INSERT INTO `interest_area` (`idinterest_area`, `interest_area_name`, `display_order`) VALUES 
('1', '职业', '1'),
('3', '财富', '2'),
('4', '教育', '3'),
('8', '家庭', '4'),
('9', '爱好', '5'),
('10', '社会地位', '6'),
('11', '健康', '7');

CREATE TABLE `regular_arrangement` (
   `idRegular_arrangement` int(11) not null auto_increment,
   `ra_type` int(11),
   `ra_name` varchar(45),
   `interest_area` int(11),
   `start_time` varchar(45),
   `end_time` varchar(45),
   PRIMARY KEY (`idRegular_arrangement`),
   KEY `fk_ra_ref_rat_idx` (`ra_type`),
   KEY `fk_ra_ref_interest_area_idx` (`interest_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `regular_arrangement` (`idRegular_arrangement`, `ra_type`, `ra_name`, `interest_area`, `start_time`, `end_time`) VALUES 
('1', '1', '睡觉', '8', '23:00', '5::00'),
('2', '5', '吃早饭', '8', '7:25', '7:55');

CREATE TABLE `regular_arrangement_type` (
   `id_rat` int(11) not null auto_increment,
   `rat_name` varchar(45),
   PRIMARY KEY (`id_rat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `regular_arrangement_type` (`id_rat`, `rat_name`) VALUES 
('1', '每日'),
('2', '每周'),
('3', '每月'),
('4', '每年'),
('5', '每周一到周五');

CREATE TABLE `target` (
   `idtarget` int(11) not null auto_increment,
   `target_name` varchar(140),
   `dis_order` int(11),
   `owner` int(11),
   `due_date` date,
   `status` int(11) default '0',
   `create_time` timestamp not null default CURRENT_TIMESTAMP,
   `last_modified_time` datetime,
   `parent_target` int(11),
   PRIMARY KEY (`idtarget`),
   KEY `FK_target_ref_user_idx` (`owner`),
   KEY `fk_self_ref_idx` (`parent_target`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=65;

INSERT INTO `target` (`idtarget`, `target_name`, `dis_order`, `owner`, `due_date`, `status`, `create_time`, `last_modified_time`, `parent_target`) VALUES 
('39', '1', '1', '31', '2013-12-28', '0', '2013-08-27 08:51:59', '', ''),
('40', '2', '2', '31', '2013-12-28', '0', '2013-08-27 08:51:59', '', ''),
('41', '3', '3', '31', '2013-12-28', '0', '2013-08-27 08:51:59', '', ''),
('42', '4', '4', '31', '2013-12-28', '0', '2013-08-27 08:51:59', '', ''),
('43', '5', '5', '31', '2013-12-28', '0', '2013-08-27 08:51:59', '', ''),
('44', '11', '', '31', '', '0', '2013-08-27 08:52:48', '', '39'),
('45', '12', '', '31', '', '0', '2013-08-27 08:52:48', '', '39'),
('46', '13', '', '31', '', '0', '2013-08-27 08:52:48', '', '39'),
('47', '111', '', '31', '', '0', '2013-08-27 08:52:48', '', '44'),
('48', '131', '', '31', '', '0', '2013-08-27 08:52:48', '', '46'),
('62', 'fasf', '', '31', '2013-08-31', '0', '2013-08-28 12:42:19', '', '48'),
('63', 'sffff', '', '31', '2013-08-30', '0', '2013-08-28 12:46:46', '', '62'),
('64', 'fadsf', '', '31', '2013-08-29', '0', '2013-08-28 12:48:52', '', '63');

CREATE TABLE `target_tree` (
   `child_id` int(11) not null,
   `parent_id` int(11),
   PRIMARY KEY (`child_id`),
   KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- [表 `target_tree` 为空]

CREATE TABLE `target_type` (
   `idtarget_type` int(11) not null auto_increment,
   `target_type_name` varchar(30),
   PRIMARY KEY (`idtarget_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;

INSERT INTO `target_type` (`idtarget_type`, `target_type_name`) VALUES 
('1', '日目标'),
('2', '周目标'),
('3', '月目标'),
('4', '季目标'),
('5', '半年目标'),
('6', '年度目标'),
('7', '2年目标'),
('8', '3年目标'),
('9', '4年目标'),
('10', '5年目标'),
('11', '6年目标'),
('12', '7年目标'),
('13', '8年目标'),
('14', '9年目标'),
('15', '10年目标'),
('16', '15年目标'),
('17', '20年目标'),
('18', '人生目标');

CREATE TABLE `todo` (
   `todo_id` int(11) not null auto_increment,
   `owner` int(11),
   `todo_name` varchar(140),
   `expected_duration` tinyint(4),
   `start_time` datetime,
   `due_time` datetime,
   `target` int(11),
   `interest_area` int(11),
   `is_appointment` bit(1),
   PRIMARY KEY (`todo_id`),
   KEY `fk_task_ref_user_idx` (`owner`),
   KEY `fk_task_ref_target_idx` (`target`),
   KEY `fk_task_ref_interest_area_idx` (`interest_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=78;

INSERT INTO `todo` (`todo_id`, `owner`, `todo_name`, `expected_duration`, `start_time`, `due_time`, `target`, `interest_area`, `is_appointment`) VALUES 
('76', '31', '与TD讨论方案', '60', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '13', '71', '0'),
('77', '31', '将初稿发给都英麒，征询都英麒意见', '15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '12', '71', '0');

CREATE TABLE `user_interest_area` (
   `iduser_interest_area` int(11) not null auto_increment,
   `owner` int(11),
   `user_interest_area_name` varchar(20),
   `display_order` tinyint(4),
   `create_time` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`iduser_interest_area`),
   KEY `FK_user_interest_area_ref_users_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=77;

INSERT INTO `user_interest_area` (`iduser_interest_area`, `owner`, `user_interest_area_name`, `display_order`, `create_time`) VALUES 
('71', '31', '工作', '1', '2013-08-07 13:50:17'),
('72', '31', '个人事业', '2', '2013-08-07 13:50:17'),
('73', '31', '家庭', '3', '2013-08-07 13:50:17'),
('74', '31', '个人健康', '4', '2013-08-07 13:50:17'),
('75', '31', '社会交往', '5', '2013-08-07 13:50:17'),
('76', '31', '其他', '6', '2013-08-07 13:50:17');

CREATE TABLE `user_regular_arrangement` (
   `id_ura` int(11) not null auto_increment,
   `ura_name` varchar(45),
   `start_time` varchar(45),
   `end_time` varchar(45),
   `ura_type` int(11),
   `interest_area` int(11),
   `target` int(11),
   `create_time` timestamp default CURRENT_TIMESTAMP,
   `owner` int(11),
   PRIMARY KEY (`id_ura`),
   KEY `fk_ura_ref_uia_idx` (`interest_area`),
   KEY `fk_ura_users_idx` (`owner`),
   KEY `fk_ura_target_idx` (`target`),
   KEY `fk_ura_ref_rat_idx` (`ura_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [表 `user_regular_arrangement` 为空]

CREATE TABLE `user_target_type` (
   `iduser_target_type` int(11) not null auto_increment,
   `target_type_id` tinyint(4),
   `owner` int(11),
   PRIMARY KEY (`iduser_target_type`),
   KEY `fk_user_target_type_ref_target_type_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=65;

INSERT INTO `user_target_type` (`iduser_target_type`, `target_type_id`, `owner`) VALUES 
('51', '16', '31'),
('54', '2', '31'),
('55', '5', '31'),
('57', '15', '31'),
('58', '17', '31'),
('59', '3', '31'),
('60', '10', '31'),
('61', '4', '31'),
('62', '6', '31'),
('63', '18', '31'),
('64', '8', '31');

CREATE TABLE `user_work_time` (
   `iduser_work_time` int(11) not null auto_increment,
   `morning_start_time` varchar(10),
   `morning_end_time` varchar(10),
   `afternoon_start_time` varchar(10),
   `afternoon_end_time` varchar(10),
   `owner` int(11),
   `day_type` int(11),
   PRIMARY KEY (`iduser_work_time`),
   KEY `fk_user_work_time_ref_users_idx` (`owner`),
   KEY `fk_user_work_time_ref_day_type_idx` (`day_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

INSERT INTO `user_work_time` (`iduser_work_time`, `morning_start_time`, `morning_end_time`, `afternoon_start_time`, `afternoon_end_time`, `owner`, `day_type`) VALUES 
('7', '8:30', '11:30', '13:00', '17:30', '31', '1');

CREATE TABLE `users` (
   `idusers` int(11) not null auto_increment,
   `username` varchar(45) not null,
   `password` varchar(45),
   `email` varchar(100),
   `mobile` varchar(45),
   `register_time` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`idusers`),
   UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=32;

INSERT INTO `users` (`idusers`, `username`, `password`, `email`, `mobile`, `register_time`) VALUES 
('31', 'sss', 'af15d5fdacd5fdfea300e88a8e253e82', 'sss@sss.net', '', '2013-08-07 13:50:17');