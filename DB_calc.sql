-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für db
DROP DATABASE IF EXISTS `db`;
CREATE DATABASE IF NOT EXISTS `db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db`;

-- Exportiere Struktur von Tabelle db.day
DROP TABLE IF EXISTS `day`;
CREATE TABLE IF NOT EXISTS `day` (
  `Day_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Day` date DEFAULT NULL,
  PRIMARY KEY (`Day_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle db.day: ~0 rows (ungefähr)
DELETE FROM `day`;
/*!40000 ALTER TABLE `day` DISABLE KEYS */;
/*!40000 ALTER TABLE `day` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle db.persons
DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `bread` int(5) DEFAULT NULL,
  `mett` int(5) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle db.persons: ~0 rows (ungefähr)
DELETE FROM `persons`;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle db.person_day
DROP TABLE IF EXISTS `person_day`;
CREATE TABLE IF NOT EXISTS `person_day` (
  `ID` int(11) NOT NULL,
  `Day_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Day_ID`),
  KEY `day` (`Day_ID`),
  CONSTRAINT `day` FOREIGN KEY (`Day_ID`) REFERENCES `day` (`Day_ID`),
  CONSTRAINT `user` FOREIGN KEY (`ID`) REFERENCES `persons` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Verknüfungstabelle';

-- Exportiere Daten aus Tabelle db.person_day: ~0 rows (ungefähr)
DELETE FROM `person_day`;
/*!40000 ALTER TABLE `person_day` DISABLE KEYS */;
/*!40000 ALTER TABLE `person_day` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
