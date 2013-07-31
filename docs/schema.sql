--
-- MySQL 5.5.8
-- Wed, 31 Jul 2013 22:00:17 +0000
--

CREATE DATABASE `peusto` DEFAULT CHARSET utf8;

USE `peusto`;

CREATE TABLE `users` (
   `idusers` int(11) not null auto_increment,
   `name` varchar(45) not null,
   `password` varchar(45),
   `email` varchar(100),
   `mobile` varchar(45),
   `register_time` datetime,
   PRIMARY KEY (`idusers`),
   UNIQUE KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

INSERT INTO `users` (`idusers`, `name`, `password`, `email`, `mobile`, `register_time`) VALUES 
('1', '0', 'ssssss', '0', '0', ''),
('4', 'ddd', 'ssssss', 'aaa@bbb.net', '', '');