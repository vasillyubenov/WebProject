# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.11.2-MariaDB)
# Database: web
# Generation Time: 2023-06-25 06:22:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table presentations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `presentations`;

CREATE TABLE `presentations` (
  `id` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) unsigned NOT NULL,
  `time` varchar(50) NOT NULL,
  `audio_format` varchar(11) NOT NULL DEFAULT '',
  `text_step` float NOT NULL,
  `playback_step` float NOT NULL,
  `play_reverse` tinyint(1) NOT NULL,
  `play_button_shape` varchar(11) NOT NULL DEFAULT '',
  `pause_button_shape` varchar(11) NOT NULL DEFAULT '',
  `play_button_color` varchar(11) NOT NULL DEFAULT '',
  `pause_button_color` varchar(11) NOT NULL DEFAULT '',
  `text_color` varchar(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `pho` (`owner_id`),
  CONSTRAINT `pho` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `presentations` WRITE;
/*!40000 ALTER TABLE `presentations` DISABLE KEYS */;

INSERT INTO `presentations` (`id`, `owner_id`, `time`, `audio_format`, `text_step`, `playback_step`, `play_reverse`, `play_button_shape`, `pause_button_shape`, `play_button_color`, `pause_button_color`, `text_color`)
VALUES
	(6,6,'2023-06-18_15:20:41','mpeg',4,0.5,0,'circle','circle','feda4a','feda4a','feda4a');

/*!40000 ALTER TABLE `presentations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `created_at`)
VALUES
	(1,'alexx110@abv.bg','$2y$10$RHJTFyTp6sRT/rFII8CxfePcTFSF1FRPlJEfOflcEEFmU3VURu1K6','2023-05-25 17:10:36'),
	(2,'alexx110@abv.bgh','$2y$10$H5p2qe6EfY.B39B03ugo2uxv5ZN50CCfBMOXPdSm6g2gRq9qsSfTe','2023-05-25 17:38:29'),
	(5,'test@abv.bg','202cb962ac59075b964b07152d234b70','2023-06-12 20:06:46'),
	(6,'xxglentxx@gmail.com','202cb962ac59075b964b07152d234b70','2023-06-18 13:56:54');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
