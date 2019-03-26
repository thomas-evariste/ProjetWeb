-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 26 Mars 2019 à 09:17
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





--
-- Contenu de la table `ENSEIGNANT`
--

INSERT INTO `ENSEIGNANT` (`ID_USER`, `LOGIN`, `PASSWORD`, `INTERNE`, `DESCRIPTION`, `NOM`, `PRENOM`, `MAIL`) VALUES
(12, '', '', 0, 'Intervenant de MIBI', 'CORDONNIER', 'Jean-Loup', 'jl@c.com'),
(21, '', '', 1, 'Professor of opérational research', 'LUJAK', 'Marin', 'bidule@mail.com'),
(37, '', '', 0, 'Professeur de mathématiques', 'ATALI', 'Jack', 'test@mail.com'),
(65, '', '', 1, 'Doctorant', 'NEWTON', 'Isaac', 'op@mail.com'),
(115, '', '', 1, 'Professeur de mathématiques', 'COQUEREL', 'Quentin', 'qc@mail.com');


--
-- Contenu de la table `NOTE`
--

INSERT INTO `NOTE` (`ID_USER`, `ENS_ID_USER`, `ID_NOTE`, `ID_QUESTIONNAIRE`, `VALEUR`) VALUES
(1,1,1,1,'10');


--
-- Contenu de la table `PARTICIPANT`
--

INSERT INTO `PARTICIPANT` (`ID_USER`, `LOGIN`, `PASSWORD`, `PROMOTION`, `MAJEURE`, `NOM`, `PRENOM`, `MAIL`) VALUES
(3, 'simon', 'simon', 2018, 'ISIC', 'DROMER', 'Simon', 'simon.dromer@etu.imt-lille-douai.fr');


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

--
-- Contenu de la table `QUESTIONNAIRE`
--

INSERT INTO `QUESTIONNAIRE` (`ID_QUESTIONNAIRE`, `TITRE`, `DESCRIPTION_QUESTIONNAIRE`, `DATE_OUVERTURE`, `DATE_FERMETURE`, `CONNEXION_REQUISE`, `ETAT`, `URL`) VALUES
(1, ' ad Mesopotamiam missus a socero per militares', 'Ideoque fertur neminem aliquando ob haec vel similia poenae addictum oblato de more elogio revocari iussisse, quod inexorabiles quoque principes factitarunt. et exitiale hoc vitium, quod in aliis non ', '2019-03-13', '2019-03-30', 1, 'ouvert', 'AdclivitasdefendentibusquoniamIsauriaetriduum.com'),
(2, 'Inpetraverim est multos statuas non.', 'Pacataeque et et redierit partes Romani pacataeque sunt securitas patrum partes sint nomen omnes Romani partes securitas securitas domina circumspectum canities suscipitur set quotquot licet tribus et', '0000-00-00', '0000-00-00', 0, 'ouvert', 'Suntplurimum.com');

--
-- Contenu de la table `REGLE`
--

INSERT INTO `REGLE` (`ID_REGLE`, `TITRE_REGLE`, `DESCRIPTION_REGLE`) VALUES
(1, 'Classique', '1 point pour bon 0 pour faux'),
(2, 'Pénalité', '1 point pour bon -0.5 pour faux'),
(3, 'Non noté', 'Pas de note'),
(4, 'Grosse pénalité', '1 point pour bon -1 pour faux');

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

--
-- Contenu de la table `SPECIFIER`
--

INSERT INTO `SPECIFIER` (`ID_QUESTIONNAIRE`, `ID_REGLE`) VALUES
(1, 3),
(2, 1),
(2, 4);



--
-- Contenu de la table `TENTER`
--

INSERT INTO `TENTER` (`ID_USER`, `ID_PROPOSITION`) VALUES
(1, 2),
(1, 8),
(1, 11),
(1, 12),
(1, 14);

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

--
-- Contenu de la table `CONTENIR`
--

INSERT INTO `CONTENIR` (`ID_QUESTION`, `ID_QUESTIONNAIRE`, `BAREME`) VALUES
(1, 1, '1'),
(1, 2, '0'),
(2, 1, '1'),
(2, 2, '0'),
(3, 2, '0');

--
-- Contenu de la table `CREER`
--

INSERT INTO `CREER` (`ID_QUESTION`, `ID_USER`) VALUES
(1, 13),
(2, 37),
(3, 21),
(4, 13),
(5, 65);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
