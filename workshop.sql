-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 13, 2022 at 09:54 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `Date` varchar(50) NOT NULL,
  `HeureDebut` varchar(50) NOT NULL,
  `HeureFin` varchar(50) NOT NULL,
  `Place` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`IdActivite`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activite`
--

INSERT INTO `activite` (`IdActivite`, `Nom`, `Description`, `Date`, `HeureDebut`, `HeureFin`, `Place`, `IdUtilisateur`) VALUES
(1, 'zef', 'zef', 'zefz', 'zef', 'zef', 2, 65),
(2, 'zef', 'zef', 'zefz', 'zef', 'zef', 2, 65),
(3, 'zef', 'zef', 'zefz', 'zef', 'zef', 2, 65),
(4, 'zef', 'zef', 'zefz', 'zef', 'zef', 2, 65);

-- --------------------------------------------------------

--
-- Table structure for table `covoiturage`
--

DROP TABLE IF EXISTS `covoiturage`;
CREATE TABLE IF NOT EXISTS `covoiturage` (
  `IdCovoiturage` int(11) NOT NULL AUTO_INCREMENT,
  `Depart` varchar(50) NOT NULL,
  `Arrivee` varchar(50) NOT NULL,
  `Place` int(11) NOT NULL,
  `Heure` varchar(50) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`IdCovoiturage`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `covoiturage`
--

INSERT INTO `covoiturage` (`IdCovoiturage`, `Depart`, `Arrivee`, `Place`, `Heure`, `IdUtilisateur`) VALUES
(2, 'Montpellier', 'Bordeaux', 2, '12h00', 64);

-- --------------------------------------------------------

--
-- Table structure for table `covoiturer`
--

DROP TABLE IF EXISTS `covoiturer`;
CREATE TABLE IF NOT EXISTS `covoiturer` (
  `IdCovoiturage` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  KEY `IdCovoiturage` (`IdCovoiturage`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `covoiturer`
--

INSERT INTO `covoiturer` (`IdCovoiturage`, `IdUtilisateur`) VALUES
(2, 65);

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

--
-- Dumping data for table `participer`
--

INSERT INTO `participer` (`IdActivite`, `IdUtilisateur`) VALUES
(1, 64),
(3, 64);

-- --------------------------------------------------------

--
-- Table structure for table `reserverrestaurant`
--

DROP TABLE IF EXISTS `reserverrestaurant`;
CREATE TABLE IF NOT EXISTS `reserverrestaurant` (
  `IdReserver` int(11) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`IdReserver`),
  KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserverrestaurant`
--

INSERT INTO `reserverrestaurant` (`IdReserver`, `IdUtilisateur`, `Date`) VALUES
(9, 65, '2022-10-13'),
(8, 65, '2022-10-12'),
(7, 65, '2022-10-12'),
(10, 65, '2022-10-13'),
(11, 65, '2022-10-13'),
(12, 65, '2022-10-15'),
(13, 64, '2022-10-12'),
(14, 64, '2022-10-13'),
(15, 64, '2022-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `reserversalle`
--

DROP TABLE IF EXISTS `reserversalle`;
CREATE TABLE IF NOT EXISTS `reserversalle` (
  `IdReserver` int(11) NOT NULL AUTO_INCREMENT,
  `IdSalle` int(11) DEFAULT NULL,
  `IdUtilisateur` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`IdReserver`),
  KEY `IdSalle` (`IdSalle`),
  KEY `IdUtilisateur` (`IdUtilisateur`),
  KEY `IdUtilisateur_2` (`IdUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserversalle`
--

INSERT INTO `reserversalle` (`IdReserver`, `IdSalle`, `IdUtilisateur`, `Date`) VALUES
(332, 2, 65, '2022-10-12'),
(336, 6, 65, '2022-10-13'),
(342, 5, 64, '2022-10-13'),
(343, 10, 64, '2022-10-13');

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
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `IdTeam` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  PRIMARY KEY (`IdTeam`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`IdTeam`, `Nom`) VALUES
(1, 'Développement'),
(2, 'Marketing');

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
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Team` int(11) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  UNIQUE KEY `Login` (`Login`),
  KEY `Team` (`Team`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `Nom`, `Prenom`, `Login`, `MotDePasse`, `Email`, `Type`, `Team`) VALUES
(64, 'user', 'user', 'user', 'mdp', 'mail@mail.fr', 'Employé', 0),
(65, 'user2', 'user2', 'user2', 'mdp', 'mail2@mail.fr', 'Employé', 0);

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
-- Constraints for table `reserversalle`
--
ALTER TABLE `reserversalle`
  ADD CONSTRAINT `reserversalle_ibfk_3` FOREIGN KEY (`IdSalle`) REFERENCES `salle` (`IdSalle`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
