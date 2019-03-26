-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2019 at 09:54 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `table`
--

-- --------------------------------------------------------

--
-- Table structure for table `associer`
--

DROP TABLE IF EXISTS `associer`;
CREATE TABLE `associer` (
  `LIBELLE` varchar(50) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE `contenir` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `BAREME` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creer`
--

DROP TABLE IF EXISTS `creer`;
CREATE TABLE `creer` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disposer`
--

DROP TABLE IF EXISTS `disposer`;
CREATE TABLE `disposer` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_PROPOSITION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE `enseignant` (
  `ID_USER` int(11) NOT NULL,
  `INTERNE` tinyint(1) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `MAIL` varchar(200) DEFAULT NULL,
  `LOGIN` varchar(200) DEFAULT NULL,
  `PASSWORD` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `est_invite`
--

DROP TABLE IF EXISTS `est_invite`;
CREATE TABLE `est_invite` (
  `ID_USER` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `A_PARTICIPE` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `ID_USER` int(11) NOT NULL,
  `ENS_ID_USER` int(11) NOT NULL,
  `ID_NOTE` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `VALEUR` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE `participant` (
  `ID_USER` int(11) NOT NULL,
  `PROMOTION` int(11) DEFAULT NULL,
  `MAJEURE` varchar(50) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `MAIL` varchar(200) DEFAULT NULL,
  `LOGIN` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `ID_QUESTION` int(11) NOT NULL,
  `TYPE` char(10) NOT NULL,
  `INTITULE_QUESTION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE `questionnaire` (
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `TITRE` varchar(50) NOT NULL,
  `DESCRIPTION_QUESTIONNAIRE` varchar(200) DEFAULT NULL,
  `DATE_OUVERTURE` date DEFAULT NULL,
  `DATE_FERMETURE` date DEFAULT NULL,
  `CONNEXION_REQUISE` tinyint(1) NOT NULL,
  `ETAT` varchar(50) NOT NULL,
  `URL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `regle`
--

DROP TABLE IF EXISTS `regle`;
CREATE TABLE `regle` (
  `ID_REGLE` int(11) NOT NULL,
  `TITRE_REGLE` varchar(50) NOT NULL,
  `DESCRIPTION_REGLE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reponse_disponible`
--

DROP TABLE IF EXISTS `reponse_disponible`;
CREATE TABLE `reponse_disponible` (
  `ID_PROPOSITION` int(11) NOT NULL,
  `REP_ID_PROPOSITION` int(11) DEFAULT NULL,
  `REP_ID_PROPOSITION2` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `INTITULE_PROPOSITION` varchar(50) DEFAULT NULL,
  `REPONSE_CORRECTE` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specifier`
--

DROP TABLE IF EXISTS `specifier`;
CREATE TABLE `specifier` (
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `ID_REGLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `LIBELLE` varchar(50) NOT NULL,
  `COULEUR` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tenter`
--

DROP TABLE IF EXISTS `tenter`;
CREATE TABLE `tenter` (
  `ID_USER` int(11) NOT NULL,
  `ID_PROPOSITION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associer`
--
ALTER TABLE `associer`
  ADD PRIMARY KEY (`LIBELLE`,`ID_QUESTION`),
  ADD KEY `FK_ASSOCIER2` (`ID_QUESTION`);

--
-- Indexes for table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_QUESTIONNAIRE`),
  ADD KEY `FK_CONTENIR2` (`ID_QUESTIONNAIRE`);

--
-- Indexes for table `creer`
--
ALTER TABLE `creer`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_USER`),
  ADD KEY `FK_CREER2` (`ID_USER`);

--
-- Indexes for table `disposer`
--
ALTER TABLE `disposer`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_PROPOSITION`),
  ADD KEY `FK_DISPOSER2` (`ID_PROPOSITION`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indexes for table `est_invite`
--
ALTER TABLE `est_invite`
  ADD PRIMARY KEY (`ID_USER`,`ID_QUESTIONNAIRE`),
  ADD KEY `FK_EST_INVITE2` (`ID_QUESTIONNAIRE`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`ID_NOTE`),
  ADD KEY `FK_CORRESPONDRE` (`ID_QUESTIONNAIRE`),
  ADD KEY `FK_GERER` (`ENS_ID_USER`),
  ADD KEY `FK_OBTENIR` (`ID_USER`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ID_QUESTION`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`ID_QUESTIONNAIRE`);

--
-- Indexes for table `regle`
--
ALTER TABLE `regle`
  ADD PRIMARY KEY (`ID_REGLE`);

--
-- Indexes for table `reponse_disponible`
--
ALTER TABLE `reponse_disponible`
  ADD PRIMARY KEY (`ID_PROPOSITION`),
  ADD KEY `FK_APPAREILLER` (`REP_ID_PROPOSITION2`),
  ADD KEY `FK_APPAREILLER2` (`REP_ID_PROPOSITION`),
  ADD KEY `FK_SUPERVISER` (`ID_USER`);

--
-- Indexes for table `specifier`
--
ALTER TABLE `specifier`
  ADD PRIMARY KEY (`ID_QUESTIONNAIRE`,`ID_REGLE`),
  ADD KEY `FK_SPECIFIER2` (`ID_REGLE`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`LIBELLE`);

--
-- Indexes for table `tenter`
--
ALTER TABLE `tenter`
  ADD PRIMARY KEY (`ID_USER`,`ID_PROPOSITION`),
  ADD KEY `FK_TENTER2` (`ID_PROPOSITION`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reponse_disponible`
--
ALTER TABLE `reponse_disponible`
  MODIFY `ID_PROPOSITION` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `associer`
--
ALTER TABLE `associer`
  ADD CONSTRAINT `FK_ASSOCIER` FOREIGN KEY (`LIBELLE`) REFERENCES `tag` (`LIBELLE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ASSOCIER2` FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `questionnaire` (`ID_QUESTIONNAIRE`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `creer`
--
ALTER TABLE `creer`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CREER2` FOREIGN KEY (`ID_USER`) REFERENCES `enseignant` (`ID_USER`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `disposer`
--
ALTER TABLE `disposer`
  ADD CONSTRAINT `FK_DISPOSER` FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DISPOSER2` FOREIGN KEY (`ID_PROPOSITION`) REFERENCES `reponse_disponible` (`ID_PROPOSITION`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `est_invite`
--
ALTER TABLE `est_invite`
  ADD CONSTRAINT `FK_EST_INVITE` FOREIGN KEY (`ID_USER`) REFERENCES `participant` (`ID_USER`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EST_INVITE2` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `questionnaire` (`ID_QUESTIONNAIRE`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_CORRESPONDRE` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `questionnaire` (`ID_QUESTIONNAIRE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_GERER` FOREIGN KEY (`ENS_ID_USER`) REFERENCES `enseignant` (`ID_USER`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OBTENIR` FOREIGN KEY (`ID_USER`) REFERENCES `participant` (`ID_USER`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `reponse_disponible`
--
ALTER TABLE `reponse_disponible`
  ADD CONSTRAINT `FK_APPAREILLER` FOREIGN KEY (`REP_ID_PROPOSITION2`) REFERENCES `reponse_disponible` (`ID_PROPOSITION`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_APPAREILLER2` FOREIGN KEY (`REP_ID_PROPOSITION`) REFERENCES `reponse_disponible` (`ID_PROPOSITION`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SUPERVISER` FOREIGN KEY (`ID_USER`) REFERENCES `enseignant` (`ID_USER`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `specifier`
--
ALTER TABLE `specifier`
  ADD CONSTRAINT `FK_SPECIFIER` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `questionnaire` (`ID_QUESTIONNAIRE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SPECIFIER2` FOREIGN KEY (`ID_REGLE`) REFERENCES `regle` (`ID_REGLE`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tenter`
--
ALTER TABLE `tenter`
  ADD CONSTRAINT `FK_TENTER` FOREIGN KEY (`ID_USER`) REFERENCES `participant` (`ID_USER`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TENTER2` FOREIGN KEY (`ID_PROPOSITION`) REFERENCES `reponse_disponible` (`ID_PROPOSITION`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
