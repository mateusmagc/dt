-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema desafiot
--

CREATE DATABASE IF NOT EXISTS desafiot;
USE desafiot;

--
-- Definition of table `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Hora` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`ID`,`Hora`) VALUES 
 (1,'00:00'),
 (2,'01:00'),
 (3,'02:00'),
 (4,'03:00'),
 (5,'04:00'),
 (6,'05:00'),
 (7,'06:00'),
 (8,'07:00'),
 (9,'08:00'),
 (10,'09:00'),
 (11,'10:00'),
 (12,'11:00'),
 (13,'12:00'),
 (14,'13:00'),
 (15,'14:00'),
 (16,'15:00'),
 (17,'16:00'),
 (18,'17:00'),
 (19,'18:00'),
 (20,'19:00'),
 (21,'20:00'),
 (22,'21:00'),
 (23,'22:00'),
 (24,'23:00');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE `reservas` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Sala` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Horario` int(10) unsigned NOT NULL,
  `Data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservas`
--

/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;


--
-- Definition of table `salas`
--

DROP TABLE IF EXISTS `salas`;
CREATE TABLE `salas` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Sala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salas`
--

/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
INSERT INTO `salas` (`ID`,`Sala`) VALUES 
 (1,'SALA 01'),
 (3,'SALA 02'),
 (6,'SALA 03');
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`ID`,`Nome`,`Email`,`Senha`) VALUES 
 (1,'ADMIN','ADMIN@ADMIN.COM','admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
