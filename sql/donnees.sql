-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 26 Mars 2019 à 08:45
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simon_dromer`
--

-- --------------------------------------------------------

--
-- Structure de la table `ASSOCIER`
--

CREATE TABLE `ASSOCIER` (
  `LIBELLE` varchar(50) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `ASSOCIER`
--

INSERT INTO `ASSOCIER` (`LIBELLE`, `ID_QUESTION`) VALUES
('Développement durable', 4),
('Histoire', 1),
('Informatique', 5),
('Littérature', 3),
('Littérature', 9),
('Mécanique des fluides', 8),
('Nature', 2),
('Nature', 6),
('Science', 7);

-- --------------------------------------------------------

--
-- Structure de la table `CONTENIR`
--

CREATE TABLE `CONTENIR` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `Barème` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `CONTENIR`
--

INSERT INTO `CONTENIR` (`ID_QUESTION`, `ID_QUESTIONNAIRE`, `Barème`) VALUES
(1, 1, '1'),
(1, 2, '0'),
(2, 1, '1'),
(2, 2, '0'),
(3, 2, '0');

-- --------------------------------------------------------

--
-- Structure de la table `CREER`
--

CREATE TABLE `CREER` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `CREER`
--

INSERT INTO `CREER` (`ID_QUESTION`, `ID_USER`) VALUES
(1, 13),
(2, 37),
(3, 21),
(4, 13),
(5, 65);

-- --------------------------------------------------------

--
-- Structure de la table `DISPOSER`
--

CREATE TABLE `DISPOSER` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_PROPOSITION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `DISPOSER`
--

INSERT INTO `DISPOSER` (`ID_QUESTION`, `ID_PROPOSITION`) VALUES
(1, 1),
(1, 2),
(1, 6),
(1, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(4, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(7, 21),
(7, 22),
(7, 23),
(7, 24),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(9, 29),
(9, 30),
(9, 31),
(9, 32);

-- --------------------------------------------------------

--
-- Structure de la table `ENSEIGNANT`
--

CREATE TABLE `ENSEIGNANT` (
  `ID_USER` int(11) NOT NULL,
  `LOGIN` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `INTERNE` tinyint(1) DEFAULT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `MAIL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `ENSEIGNANT`
--

INSERT INTO `ENSEIGNANT` (`ID_USER`, `LOGIN`, `PASSWORD`, `INTERNE`, `DESCRIPTION`, `NOM`, `PRENOM`, `MAIL`) VALUES
(13, '', '', 0, 'Intervenant de MIBI', 'CORDONNIER', 'Jean-Loup', 'jl@c.com'),
(21, '', '', 1, 'Professor of opérational research', 'LUJAK', 'Marin', 'bidule@mail.com'),
(37, '', '', 0, 'Professeur de mathématiques', 'ATALI', 'Jack', 'test@mail.com'),
(65, '', '', 1, 'Doctorant', 'NEWTON', 'Isaac', 'op@mail.com'),
(115, '', '', 1, 'Professeur de mathématiques', 'COQUEREL', 'Quentin', 'qc@mail.com');

-- --------------------------------------------------------

--
-- Structure de la table `EST_INVITE`
--

CREATE TABLE `EST_INVITE` (
  `ID_USER` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `A_PARTICIPE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `EST_INVITE`
--

INSERT INTO `EST_INVITE` (`ID_USER`, `ID_QUESTIONNAIRE`, `A_PARTICIPE`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 1, 1),
(3, 1, 1),
(3, 2, 0),
(4, 2, 1),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `NOTE`
--

CREATE TABLE `NOTE` (
  `ID_USER` int(11) NOT NULL,
  `ENS_ID_USER` int(11) NOT NULL,
  `ID_NOTE` int(11) NOT NULL,
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `VALEUR` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `NOTE`
--

INSERT INTO `NOTE` (`ID_USER`, `ENS_ID_USER`, `ID_NOTE`, `ID_QUESTIONNAIRE`, `VALEUR`) VALUES
(1, 13, 1, 1, '4'),
(2, 13, 2, 1, '2'),
(3, 13, 1, 1, '1'),
(5, 13, 1, 1, '1');

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPANT`
--

CREATE TABLE `PARTICIPANT` (
  `ID_USER` int(11) NOT NULL,
  `LOGIN` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `PROMOTION` int(11) DEFAULT NULL,
  `MAJEURE` varchar(50) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `MAIL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `PARTICIPANT`
--

INSERT INTO `PARTICIPANT` (`ID_USER`, `LOGIN`, `PASSWORD`, `PROMOTION`, `MAJEURE`, `NOM`, `PRENOM`, `MAIL`) VALUES
(1, '', '', 2020, 'ISIC', 'COQUEREL', 'Quentin', 'quentin.coquerel@etu.imt-lille-douai.fr'),
(2, '', '', 2019, 'IM', 'GUYOT', 'Thomas', 'thomas.guyot@etu.imt-lille-douai.fr'),
(3, 'simon', 'simon', 2018, 'ISIC', 'DROMER', 'Simon', 'simon.dromer@etu.imt-lille-douai.fr'),
(4, '', '', 2020, 'EI', 'MARY', 'Erwan', 'erwan.mary@etu.imt-lille-douai.fr'),
(5, '', '', NULL, NULL, 'MARY', 'Grégoire', 'gregoire@test.fr');

-- --------------------------------------------------------

--
-- Structure de la table `QUESTION`
--

CREATE TABLE `QUESTION` (
  `ID_QUESTION` int(11) NOT NULL,
  `TYPE` enum('QCM','QO','QCU','QA') NOT NULL,
  `INTITULE_QUESTION` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `QUESTION`
--

INSERT INTO `QUESTION` (`ID_QUESTION`, `TYPE`, `INTITULE_QUESTION`) VALUES
(1, 'QCU', 'Date de la révolution française'),
(2, 'QCM', 'Quels animaux sont des mammifères'),
(3, 'QA', 'Associer ces éléments'),
(4, 'QO', 'Réaliser une dissertation de 750 lignes sur le dév'),
(5, 'QCU', 'Que signifie RGB ?'),
(6, 'QCU', 'Quel est le poids moyen d\'un rhinocéros blanc?'),
(7, 'QCU', 'Quelle est la circonférence de la Terre au niveau de l\'équateur?'),
(8, 'QCU', 'Quelle est la formule liant la force, la pression et la surface?'),
(9, 'QCU', 'Qui a écrit \"une maison de poupée\"?');

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONNAIRE`
--

CREATE TABLE `QUESTIONNAIRE` (
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `TITRE` varchar(50) NOT NULL,
  `DESCRIPTION_QUESTIONNAIRE` varchar(200) DEFAULT NULL,
  `DATE_OUVERTURE` date DEFAULT NULL,
  `DATE_FERMETURE` date DEFAULT NULL,
  `CONNEXION_REQUISE` tinyint(1) NOT NULL,
  `ETAT` enum('corrigé','ouvert','en cours de correction','fermé') NOT NULL,
  `URL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `QUESTIONNAIRE`
--

INSERT INTO `QUESTIONNAIRE` (`ID_QUESTIONNAIRE`, `TITRE`, `DESCRIPTION_QUESTIONNAIRE`, `DATE_OUVERTURE`, `DATE_FERMETURE`, `CONNEXION_REQUISE`, `ETAT`, `URL`) VALUES
(1, ' ad Mesopotamiam missus a socero per militares', 'Ideoque fertur neminem aliquando ob haec vel similia poenae addictum oblato de more elogio revocari iussisse, quod inexorabiles quoque principes factitarunt. et exitiale hoc vitium, quod in aliis non ', '2019-03-13', '2019-03-30', 1, 'ouvert', 'AdclivitasdefendentibusquoniamIsauriaetriduum.com'),
(2, 'Inpetraverim est multos statuas non.', 'Pacataeque et et redierit partes Romani pacataeque sunt securitas patrum partes sint nomen omnes Romani partes securitas securitas domina circumspectum canities suscipitur set quotquot licet tribus et', '0000-00-00', '0000-00-00', 0, 'ouvert', 'Suntplurimum.com');

-- --------------------------------------------------------

--
-- Structure de la table `REGLE`
--

CREATE TABLE `REGLE` (
  `ID_REGLE` int(11) NOT NULL,
  `TITRE_REGLE` varchar(50) NOT NULL,
  `DESCRIPTION_REGLE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `REGLE`
--

INSERT INTO `REGLE` (`ID_REGLE`, `TITRE_REGLE`, `DESCRIPTION_REGLE`) VALUES
(1, 'Classique', '1 point pour bon 0 pour faux'),
(2, 'Pénalité', '1 point pour bon -0.5 pour faux'),
(3, 'Non noté', 'Pas de note'),
(4, 'Grosse pénalité', '1 point pour bon -1 pour faux');

-- --------------------------------------------------------

--
-- Structure de la table `REPONSE_DISPONIBLE`
--

CREATE TABLE `REPONSE_DISPONIBLE` (
  `ID_PROPOSITION` int(11) NOT NULL,
  `REP_ID_PROPOSITION` int(11) DEFAULT NULL,
  `REP_ID_PROPOSITION2` int(11) DEFAULT NULL,
  `INTITULE_PROPOSITION` varchar(50) DEFAULT NULL,
  `REPONSE_CORRECTE` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `REPONSE_DISPONIBLE`
--

INSERT INTO `REPONSE_DISPONIBLE` (`ID_PROPOSITION`, `REP_ID_PROPOSITION`, `REP_ID_PROPOSITION2`, `INTITULE_PROPOSITION`, `REPONSE_CORRECTE`) VALUES
(1, NULL, NULL, '1789', 1),
(2, NULL, NULL, '1689', 0),
(6, NULL, NULL, '1698', 0),
(7, NULL, NULL, '1798', 0),
(8, NULL, NULL, 'Vache', 1),
(9, NULL, NULL, 'Ornithorynque', 0),
(10, NULL, NULL, 'Poule', 0),
(11, NULL, NULL, 'Souris', 1),
(12, NULL, NULL, 'Veuillez écrire ici', NULL),
(13, NULL, NULL, 'Rouge Gris Bleu', 0),
(14, NULL, NULL, 'Red Green Blue', 1),
(15, NULL, NULL, 'Red Grey Blue', 0),
(16, NULL, NULL, 'Rouage Grille Bille', 0),
(17, NULL, NULL, '8000kg', 0),
(18, NULL, NULL, '2500kg', 1),
(19, NULL, NULL, '700kg', 0),
(20, NULL, NULL, '5000kg', 0),
(21, NULL, NULL, '4000 km', 0),
(22, NULL, NULL, '40000 km', 1),
(23, NULL, NULL, '8000 km', 0),
(24, NULL, NULL, '80000 km', 0),
(25, NULL, NULL, 'P=F/S', 0),
(26, NULL, NULL, 'F=S/P', 0),
(27, NULL, NULL, 'P=F^S', 0),
(28, NULL, NULL, 'F=P/S', 1),
(29, NULL, NULL, 'La Boétie', 0),
(30, NULL, NULL, 'Montesquieu', 0),
(31, NULL, NULL, 'Ibsen', 1),
(32, NULL, NULL, 'M Pokora', 0);

-- --------------------------------------------------------

--
-- Structure de la table `SPECIFIER`
--

CREATE TABLE `SPECIFIER` (
  `ID_QUESTIONNAIRE` int(11) NOT NULL,
  `ID_REGLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `SPECIFIER`
--

INSERT INTO `SPECIFIER` (`ID_QUESTIONNAIRE`, `ID_REGLE`) VALUES
(1, 3),
(2, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `TAG`
--

CREATE TABLE `TAG` (
  `LIBELLE` varchar(50) NOT NULL,
  `COULEUR` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `TAG`
--

INSERT INTO `TAG` (`LIBELLE`, `COULEUR`) VALUES
('Développement Durable', 'Cyan'),
('Géographie', 'Violet'),
('Histoire', 'Jaune'),
('Informatique', 'Bleu'),
('Littérature', 'Rouge'),
('Mécanique des Fluides', 'Marron'),
('Nature', 'Vert'),
('Science', 'Poupre');

-- --------------------------------------------------------

--
-- Structure de la table `TENTER`
--

CREATE TABLE `TENTER` (
  `ID_USER` int(11) NOT NULL,
  `ID_REPONSE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `TENTER`
--

INSERT INTO `TENTER` (`ID_USER`, `ID_REPONSE`) VALUES
(1, 2),
(1, 8),
(1, 11),
(1, 12),
(1, 14);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ASSOCIER`
--
ALTER TABLE `ASSOCIER`
  ADD PRIMARY KEY (`LIBELLE`,`ID_QUESTION`),
  ADD KEY `FK_ASSOCIER2` (`ID_QUESTION`);

--
-- Index pour la table `CONTENIR`
--
ALTER TABLE `CONTENIR`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_QUESTIONNAIRE`),
  ADD KEY `FK_CONTENIR2` (`ID_QUESTIONNAIRE`);

--
-- Index pour la table `CREER`
--
ALTER TABLE `CREER`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_USER`),
  ADD KEY `FK_CREER2` (`ID_USER`);

--
-- Index pour la table `DISPOSER`
--
ALTER TABLE `DISPOSER`
  ADD PRIMARY KEY (`ID_QUESTION`,`ID_PROPOSITION`),
  ADD KEY `FK_DISPOSER2` (`ID_PROPOSITION`);

--
-- Index pour la table `ENSEIGNANT`
--
ALTER TABLE `ENSEIGNANT`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Index pour la table `EST_INVITE`
--
ALTER TABLE `EST_INVITE`
  ADD PRIMARY KEY (`ID_USER`,`ID_QUESTIONNAIRE`),
  ADD KEY `FK_PARTICIPER2` (`ID_QUESTIONNAIRE`);

--
-- Index pour la table `NOTE`
--
ALTER TABLE `NOTE`
  ADD PRIMARY KEY (`ID_USER`,`ENS_ID_USER`,`ID_NOTE`),
  ADD KEY `FK_CORRESPONDRE` (`ID_QUESTIONNAIRE`),
  ADD KEY `FK_GERER` (`ENS_ID_USER`);

--
-- Index pour la table `PARTICIPANT`
--
ALTER TABLE `PARTICIPANT`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Index pour la table `QUESTION`
--
ALTER TABLE `QUESTION`
  ADD PRIMARY KEY (`ID_QUESTION`);

--
-- Index pour la table `QUESTIONNAIRE`
--
ALTER TABLE `QUESTIONNAIRE`
  ADD PRIMARY KEY (`ID_QUESTIONNAIRE`);

--
-- Index pour la table `REGLE`
--
ALTER TABLE `REGLE`
  ADD PRIMARY KEY (`ID_REGLE`);

--
-- Index pour la table `REPONSE_DISPONIBLE`
--
ALTER TABLE `REPONSE_DISPONIBLE`
  ADD PRIMARY KEY (`ID_PROPOSITION`),
  ADD KEY `FK_APPAREILLER` (`REP_ID_PROPOSITION2`),
  ADD KEY `FK_APPAREILLER2` (`REP_ID_PROPOSITION`);

--
-- Index pour la table `SPECIFIER`
--
ALTER TABLE `SPECIFIER`
  ADD PRIMARY KEY (`ID_QUESTIONNAIRE`,`ID_REGLE`),
  ADD KEY `FK_SPECIFIER2` (`ID_REGLE`);

--
-- Index pour la table `TAG`
--
ALTER TABLE `TAG`
  ADD PRIMARY KEY (`LIBELLE`);

--
-- Index pour la table `TENTER`
--
ALTER TABLE `TENTER`
  ADD PRIMARY KEY (`ID_USER`,`ID_REPONSE`),
  ADD KEY `FK_TENTER2` (`ID_REPONSE`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `QUESTION`
--
ALTER TABLE `QUESTION`
  MODIFY `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `REPONSE_DISPONIBLE`
--
ALTER TABLE `REPONSE_DISPONIBLE`
  MODIFY `ID_PROPOSITION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ASSOCIER`
--
ALTER TABLE `ASSOCIER`
  ADD CONSTRAINT `FK_ASSOCIER` FOREIGN KEY (`LIBELLE`) REFERENCES `TAG` (`LIBELLE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ASSOCIER2` FOREIGN KEY (`ID_QUESTION`) REFERENCES `QUESTION` (`ID_QUESTION`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `CONTENIR`
--
ALTER TABLE `CONTENIR`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`ID_QUESTION`) REFERENCES `QUESTION` (`ID_QUESTION`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `QUESTIONNAIRE` (`ID_QUESTIONNAIRE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `CREER`
--
ALTER TABLE `CREER`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_QUESTION`) REFERENCES `QUESTION` (`ID_QUESTION`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CREER2` FOREIGN KEY (`ID_USER`) REFERENCES `ENSEIGNANT` (`ID_USER`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `DISPOSER`
--
ALTER TABLE `DISPOSER`
  ADD CONSTRAINT `FK_DISPOSER` FOREIGN KEY (`ID_QUESTION`) REFERENCES `QUESTION` (`ID_QUESTION`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DISPOSER2` FOREIGN KEY (`ID_PROPOSITION`) REFERENCES `REPONSE_DISPONIBLE` (`ID_PROPOSITION`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `EST_INVITE`
--
ALTER TABLE `EST_INVITE`
  ADD CONSTRAINT `FK_PARTICIPER` FOREIGN KEY (`ID_USER`) REFERENCES `PARTICIPANT` (`ID_USER`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PARTICIPER2` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `QUESTIONNAIRE` (`ID_QUESTIONNAIRE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `NOTE`
--
ALTER TABLE `NOTE`
  ADD CONSTRAINT `FK_CORRESPONDRE` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `QUESTIONNAIRE` (`ID_QUESTIONNAIRE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_GERER` FOREIGN KEY (`ENS_ID_USER`) REFERENCES `ENSEIGNANT` (`ID_USER`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OBTENIR` FOREIGN KEY (`ID_USER`) REFERENCES `PARTICIPANT` (`ID_USER`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `REPONSE_DISPONIBLE`
--
ALTER TABLE `REPONSE_DISPONIBLE`
  ADD CONSTRAINT `FK_APPAREILLER` FOREIGN KEY (`REP_ID_PROPOSITION2`) REFERENCES `REPONSE_DISPONIBLE` (`ID_PROPOSITION`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_APPAREILLER2` FOREIGN KEY (`REP_ID_PROPOSITION`) REFERENCES `REPONSE_DISPONIBLE` (`ID_PROPOSITION`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `SPECIFIER`
--
ALTER TABLE `SPECIFIER`
  ADD CONSTRAINT `FK_SPECIFIER` FOREIGN KEY (`ID_QUESTIONNAIRE`) REFERENCES `QUESTIONNAIRE` (`ID_QUESTIONNAIRE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SPECIFIER2` FOREIGN KEY (`ID_REGLE`) REFERENCES `REGLE` (`ID_REGLE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `TENTER`
--
ALTER TABLE `TENTER`
  ADD CONSTRAINT `FK_TENTER` FOREIGN KEY (`ID_USER`) REFERENCES `PARTICIPANT` (`ID_USER`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TENTER2` FOREIGN KEY (`ID_REPONSE`) REFERENCES `REPONSE_DISPONIBLE` (`ID_PROPOSITION`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
