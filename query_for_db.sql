-- php_info.users definition

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(2),
  `birth` date DEFAULT NULL,
  `street` varchar(30) NOT NULL,
  `number_house` int NOT NULL,
  `city` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  `study_year` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`id`)
) 