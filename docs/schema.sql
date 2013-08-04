--
-- MySQL 5.5.8
-- Sun, 04 Aug 2013 21:53:52 +0000
--

CREATE DATABASE `peusto` DEFAULT CHARSET gbk;

USE `peusto`;

CREATE TABLE `interest_area` (
   `idinterest_area` int(11) not null auto_increment,
   `interest_area_name` varchar(20),
   `display_order` tinyint(4),
   PRIMARY KEY (`idinterest_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

INSERT INTO `interest_area` (`idinterest_area`, `interest_area_name`, `display_order`) VALUES 
('1', '������ҵ', '1'),
('3', '��ͥ', '2'),
('4', '����', '3'),
('8', '����', '4'),
('9', '��ύ��', '5');

CREATE TABLE `target` (
   `idtarget` int(11) not null auto_increment,
   `target_name` varchar(140),
   `interest_area` int(11),
   `priority` int(11),
   `owner` int(11),
   `create_time` timestamp default CURRENT_TIMESTAMP,
   PRIMARY KEY (`idtarget`),
   KEY `FK_targe_ref_interest_area_idx` (`interest_area`),
   KEY `FK_target_ref_user_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

INSERT INTO `target` (`idtarget`, `target_name`, `interest_area`, `priority`, `owner`, `create_time`) VALUES 
('4', '���Peusto Web��ԭ������', '14', '1', '22', ''),
('5', '��ɡ��ƽ���-����ҵ�ĵ��Ĵθ��������ı�д', '16', '1', '22', '2013-08-03 23:54:42'),
('6', 'ÿ�ܶ�������ʱ�䲻����3Сʱ', '17', '1', '22', '2013-08-04 00:29:14'),
('7', 'ÿ���㺢��ʱ�䲻����10Сʱ', '15', '1', '22', '2013-08-04 00:29:59'),
('8', 'ÿ�������Ѿۻ�һ��', '18', '1', '22', '2013-08-04 00:31:29'),
('9', 'ÿ�����������첻����1Сʱ', '15', '2', '22', '2013-08-04 00:32:50');

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
   `user_interest_area_name` varchar(45),
   `display_order` tinyint(4),
   `create_time` timestamp default CURRENT_TIMESTAMP,
   PRIMARY KEY (`iduser_interest_area`),
   KEY `FK_user_interest_area_ref_users_idx` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=21;

INSERT INTO `user_interest_area` (`iduser_interest_area`, `owner`, `user_interest_area_name`, `display_order`, `create_time`) VALUES 
('14', '22', '������ҵ3', '1', '0000-00-00 00:00:00'),
('15', '22', '��ͥ', '2', '0000-00-00 00:00:00'),
('16', '22', '����', '3', '0000-00-00 00:00:00'),
('17', '22', '����', '4', '0000-00-00 00:00:00'),
('18', '22', '��ύ��', '5', '0000-00-00 00:00:00'),
('19', '22', '����', '6', '2013-08-04 00:33:21'),
('20', '22', '����', '7', '2013-08-05 04:54:20');

CREATE TABLE `users` (
   `idusers` int(11) not null auto_increment,
   `username` varchar(45) not null,
   `password` varchar(45),
   `email` varchar(100),
   `mobile` varchar(45),
   `register_time` timestamp default CURRENT_TIMESTAMP,
   PRIMARY KEY (`idusers`),
   UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=23;

INSERT INTO `users` (`idusers`, `username`, `password`, `email`, `mobile`, `register_time`) VALUES 
('22', 'sss', 'af15d5fdacd5fdfea300e88a8e253e82', 'shishaoshuai@sina.com', '', '2013-08-03 00:05:04');