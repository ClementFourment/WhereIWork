-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2022 at 09:15 PM
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
-- Table structure for table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `IdActivite` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Date` date NOT NULL,
  `HeureDebut` timestamp NOT NULL,
  `HeureFin` timestamp NOT NULL,
  `Place` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`IdActivite`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `IdActivite` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  KEY `IdActivite` (`IdActivite`,`IdUtilisateur`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE IF NOT EXISTS `reserver` (
  `IdReserver` int(11) NOT NULL AUTO_INCREMENT,
  `IdSalle` int(11) DEFAULT NULL,
  `IdUtilisateur` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`IdReserver`),
  KEY `IdSalle` (`IdSalle`),
  KEY `IdUtilisateur` (`IdUtilisateur`),
  KEY `IdUtilisateur_2` (`IdUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserver`
--

INSERT INTO `reserver` (`IdReserver`, `IdSalle`, `IdUtilisateur`, `Date`) VALUES
(224, 9, 65, '2022-10-12'),
(290, 14, 64, '2022-10-12'),
(304, 12, 64, '2022-10-12'),
(306, 5, 64, '2022-10-12'),
(307, 6, 64, '2022-10-12'),
(308, 8, 64, '2022-10-12');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`IdSalle`, `Nom`, `Type`) VALUES
(1, '1', 'Bureau'),
(2, '2', 'Bureau'),
(3, '3', 'Bureau'),
(4, '4', 'Bureau'),
(5, '5', 'Bureau'),
(6, '6', 'Bureau'),
(7, '7', 'Bureau'),
(8, '8', 'Bureau'),
(9, '9', 'Bureau'),
(10, '10', 'Bureau'),
(11, '11', 'Bureau'),
(12, '12', 'Bureau'),
(13, '13', 'Bureau'),
(14, '14', 'Bureau'),
(15, '15', 'Bureau'),
(16, '16', 'Bureau');

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
-- Constraints for table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateur` (`IdUtilisateur`);

--
-- Constraints for table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`IdUtilisateur`) REFERENCES `utilisateur` (`IdUtilisateur`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`IdActivite`) REFERENCES `activite` (`IdActivite`);

--
-- Constraints for table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `reserver_ibfk_3` FOREIGN KEY (`IdSalle`) REFERENCES `salle` (`IdSalle`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
