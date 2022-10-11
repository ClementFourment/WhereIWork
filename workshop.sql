-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2022 at 08:02 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE IF NOT EXISTS `reserver` (
  `IdReserver` int(11) NOT NULL AUTO_INCREMENT,
  `IdSalle` int(11) DEFAULT NULL,
  `IdUtilisateur` int(11) DEFAULT NULL,
  `PrixUnitaire` decimal(15,2) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `PlageHoraire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdReserver`),
  KEY `IdSalle` (`IdSalle`),
  KEY `IdUtilisateur` (`IdUtilisateur`),
  KEY `IdUtilisateur_2` (`IdUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserver`
--

INSERT INTO `reserver` (`IdReserver`, `IdSalle`, `IdUtilisateur`, `PrixUnitaire`, `Date`, `PlageHoraire`) VALUES
(83, 9, 64, NULL, '2022-10-11', 'Matin'),
(84, 9, 64, NULL, '2022-10-11', 'Après-midi'),
(86, 1, 64, NULL, '2022-10-11', 'Matin'),
(87, 1, 64, NULL, '2022-10-11', 'Après-midi');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `IdSalle` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdSalle`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`IdSalle`, `Nom`, `Type`) VALUES
(1, 'parking1', 'Place de parking'),
(2, 'parking2', 'Place de parking'),
(3, 'parking3', 'Place de parking'),
(4, 'parking4', 'Place de parking'),
(5, 'parking5', 'Place de parking'),
(6, 'Réunion 1', 'Salle de réunion'),
(7, 'Réunion 2', 'Salle de réunion'),
(8, 'Réunion 3', 'Salle de réunion'),
(9, 'Bureau 1', 'Bureau'),
(10, 'Bureau 2', 'Bureau'),
(11, 'Bureau 3', 'Bureau'),
(12, 'Bureau 4', 'Bureau'),
(13, 'Bureau 5', 'Bureau');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Login` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MotDePasse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `Nom`, `Prenom`, `Login`, `MotDePasse`, `Type`) VALUES
(64, 'user', 'user', 'user', 'mdp', 'Employé'),
(65, 'user2', 'user2', 'user2', 'mdp', 'Employé');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `reserver_ibfk_3` FOREIGN KEY (`IdSalle`) REFERENCES `salle` (`IdSalle`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
