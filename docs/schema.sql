--
-- MySQL 5.5.8
-- Wed, 07 Aug 2013 00:45:49 +0000
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

INSERT INTO `interest_area` (`idinterest_area`, `interest_area_name`, `display_order`) VALUES 
('1', '个人事业', '1'),
('3', '家庭', '2'),
('4', '工作', '3'),
('8', '健康', '4'),
('9', '社会交往', '5');

CREATE TABLE `target` (
   `idtarget` int(11) not null auto_increment,
   `target_name` varchar(140),
   `interest_area` int(11),
   `priority` int(11),
   `owner` int(11),
   `create_time` timestamp not null default CURRENT_TIMESTAMP,
   `target_type` int(11),
   PRIMARY KEY (`idtarget`),
   KEY `FK_targe_ref_interest_area_idx` (`interest_area`),
   KEY `FK_target_ref_user_idx` (`owner`),
   KEY `fk_target_ref_user_target_type_idx` (`target_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

-- [表 `target` 为空]

CREATE TABLE `target_type` (
   `idtarget_type` int(11) not null auto_increment,
   `target_type_name` varchar(30),
   PRIMARY KEY (`idtarget_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=14;

INSERT INTO `target_type` (`idtarget_type`, `target_type_name`) VALUES 
('1', '日目标'),
('2', '周目标'),
('3', '月目标'),
('4', '季目标'),
('5', '半年目标'),
('6', '年度目标'),
('7', '2年目标'),
('8', '3年目标'),
('9', '5年目标'),
('10', '10年目标'),
('11', '15年目标'),
('12', '20年目标'),
('13', '人生目标');

CREATE TABLE `task` (
   `idtask` int(11) not null auto_increment,
   `owner` int(11),
   `task_name` varchar(140),
   `expected_duration` tinyint(4),
   `start_time` datetime,
   `due_time` datetime,
   `target` int(11),
   `interest_area` int(11),
   `is_appointment` bit(1),
   PRIMARY KEY (`idtask`),
   KEY `fk_task_ref_user_idx` (`owner`),
   KEY `fk_task_ref_target_idx` (`target`),
   KEY `fk_task_ref_interest_area_idx` (`interest_area`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=6;

INSERT INTO `task` (`idtask`, `owner`, `task_name`, `expected_duration`, `start_time`, `due_time`, `target`, `interest_area`, `is_appointment`) VALUES 
('5', '22', 'a', '30', '2013-08-07 04:25:00', '2013-08-08 09:50:00', '9', '15', '1');

CREATE TABLE `user_interest_area` (
   `iduser_interest_area` int(11) not null auto_increment,
   `owner` int(11),
   `user_interest_area_name` varchar(20),
   `display_order` tinyint(4),
   `create_time` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`iduser_interest_area`),
   KEY `FK_user_interest_area_ref_users_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=65;

INSERT INTO `user_interest_area` (`iduser_interest_area`, `owner`, `user_interest_area_name`, `display_order`, `create_time`) VALUES 
('59', '29', '工作', '1', '2013-08-07 08:42:36'),
('60', '29', '个人事业', '2', '2013-08-07 08:42:36'),
('61', '29', '家庭', '3', '2013-08-07 08:42:36'),
('62', '29', '个人健康', '4', '2013-08-07 08:42:36'),
('63', '29', '社会交往', '5', '2013-08-07 08:42:36'),
('64', '29', '其他', '6', '2013-08-07 08:42:36');

CREATE TABLE `user_target_type` (
   `iduser_target_type` int(11) not null auto_increment,
   `user_target_type_name` varchar(30),
   `owner` int(11),
   PRIMARY KEY (`iduser_target_type`),
   KEY `fk_user_target_type_ref_target_type_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=18;

INSERT INTO `user_target_type` (`iduser_target_type`, `user_target_type_name`, `owner`) VALUES 
('1', '日目标', '29'),
('2', '周目标', '29'),
('3', '月目标', '29'),
('4', '季目标', '29'),
('5', '半年目标', '29'),
('6', '年度目标', '29'),
('7', '2年目标', '29'),
('8', '3年目标', '29'),
('9', '4年目标', '29'),
('10', '5年目标', '29'),
('11', '6年目标', '29'),
('12', '7年目标', '29'),
('13', '8年目标', '29'),
('14', '9年目标', '29'),
('15', '10年目标', '29'),
('16', '15年目标', '29'),
('17', '20年目标', '29');

CREATE TABLE `user_work_time` (
   `iduser_work_time` int(11) not null auto_increment,
   `morning_start_time` varchar(10),
   `morning_end_time` varchar(10),
   `afternoon_start_time` varchar(10),
   `afternoon_end_time` varchar(10),
   `owner` int(11),
   PRIMARY KEY (`iduser_work_time`),
   KEY `fk_user_work_time_ref_users_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `user_work_time` (`iduser_work_time`, `morning_start_time`, `morning_end_time`, `afternoon_start_time`, `afternoon_end_time`, `owner`) VALUES 
('5', '8:30', '11:30', '13:00', '17:30', '29');

CREATE TABLE `users` (
   `idusers` int(11) not null auto_increment,
   `username` varchar(45) not null,
   `password` varchar(45),
   `email` varchar(100),
   `mobile` varchar(45),
   `register_time` timestamp not null default CURRENT_TIMESTAMP,
   PRIMARY KEY (`idusers`),
   UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=30;

INSERT INTO `users` (`idusers`, `username`, `password`, `email`, `mobile`, `register_time`) VALUES 
('28', 'sss', 'af15d5fdacd5fdfea300e88a8e253e82', 'sss@sss.net', '', '2013-08-07 08:41:35'),
('29', 'aaa', 'af15d5fdacd5fdfea300e88a8e253e82', 'sss@sss.net', '', '2013-08-07 08:42:36');