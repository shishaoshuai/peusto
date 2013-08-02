--
-- MySQL 5.5.8
-- Fri, 02 Aug 2013 08:49:39 +0000
--

CREATE DATABASE `peusto` DEFAULT CHARSET utf8;

USE `peusto`;

CREATE TABLE `interest_area` (
   `idinterest_area` int(11) not null auto_increment,
   `interest_area_name` varchar(20),
   `display_order` tinyint(4),
   PRIMARY KEY (`idinterest_area`),
   UNIQUE KEY (`interest_area_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

INSERT INTO `interest_area` (`idinterest_area`, `interest_area_name`, `display_order`) VALUES 
('1', '23', '1'),
('3', ' ¬“µ', '2'),
('4', 'º“Õ•', '3');

CREATE TABLE `users` (
   `idusers` int(11) not null auto_increment,
   `username` varchar(45) not null,
   `password` varchar(45),
   `email` varchar(100),
   `mobile` varchar(45),
   `register_time` timestamp default CURRENT_TIMESTAMP,
   PRIMARY KEY (`idusers`),
   UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=16;

INSERT INTO `users` (`idusers`, `username`, `password`, `email`, `mobile`, `register_time`) VALUES 
('15', 'sss', 'af15d5fdacd5fdfea300e88a8e253e82', 'sss@sss.net', '', '2013-08-02 08:16:33');