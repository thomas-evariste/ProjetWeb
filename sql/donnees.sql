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
(1, 'QCU', 'Quelle est la date de la révolution française?'),
(2, 'QCM', 'Quels animaux sont des mammifères'),
(3, 'QA', 'Associer ces éléments'),
(4, 'QO', 'Réaliser une dissertation de 750 lignes sur le dév'),
(5, 'QCU', 'Que signifie RGB ?'),
(6, 'QCU', 'Quel est le poids moyen d\'un rhinocéros blanc?'),
(7, 'QCU', 'Quelle est la circonférence de la Terre au niveau de l\'équateur?'),
(8, 'QCU', 'Quelle est la formule liant la force, la pression et la surface?'),
(9, 'QCU', 'Qui a écrit \"une maison de poupée\"?'),
(10, 'QCU', 'Comment s\'appelle l\'auteur du seigneur des anneaux?'),
(11, 'QCU', 'Qui a écrit le chien des Baskerville?'),
(12, 'QCU', 'Après avoir joué quelle pièce Molière est-il mort?'),
(13, 'QCU', 'En quelle année est tombé le mur de Berlin?'),
(14, 'QCU', 'En quelle année Charlemagne est-il couronné empereur d\'Occident?'),
(15, 'QCU', 'Lors de son assassinat, à qui Jules César aurait-il dit \"Toi aussi mon fils?\"?'),
(16, 'QCU','Quel est le meilleur langage de programmation du monde?'),
(17, 'QCU','Que signifie le sigle IBM?'),
(18, 'QCU','Combien de valeurs peut prendre un ensemble de 2 octets?'),
(19, 'QCU','Laquelle de ces espèces est apparue en premier?'),
(20, 'QCU','Vers quelle année se sont éteints les derniers mammouths?'),
(21, 'QCU','Qui avait proposé une théorie de l\'évolution avant Darwin?'),
(22, 'QCU','Lequel de ces pays est doublement enclavé? (Un pays enclavé n\'a pas d\'accès direct à la mer)'),
(23, 'QCU','Lequel de ces pays appartient au continent africain?'),
(24, 'QCU','Quelle est la mégalopole la plus peuplée du monde?'),
(25, 'QCU','Dans quel pays se situe la ville de Greenwich où passe le méridien d\'origine?'),
(26, 'QCU','Quelle est la forme de l\'ADN?'),
(27, 'QCU','Combien y a-t-il d\'atomes de carbone dans une molécule d\'éthanol?'),
(28, 'QCU','Quelle est l\'accélération de la pesanteur terrestre au niveau de l\'équateur en m.s-2?'),
(29, 'QCU','En quelle unité se mesurent les transferts chaleur?'),
(30, 'QCU','Pour un fluide ayant un débit constant dans un cylindre que se passe-t-il si on réduit la circonférence de ce dernier?'),
(31, 'QCU','Que signifie Tep en énergétique?'),
(32, 'QCU','Au total combien de litres d\'eau sont-ils consommés pour produire un kg de boeuf?'),
(33, 'QCU','Parmi ces aliments lequel consomme le plus d\'eau pour 1kg produit?'),
(34, 'QCU','Après la Chine et les USA quel est le pays qui émet le plus de CO2?'),
(35, 'QCU','Quelle est la part de l\'élevage dans les émissions de CO2?'),
(36, 'QCU','Lequel de ces nombres est premier?'),
(37, 'QCU','Quel est l\'élément neutre de l\'addition?'),
(38, 'QCU','Quel est le minimum de la fonction cosinus?'),
(39, 'QCU','Que vaut le logarithme népérien en 0?'),
(40, 'QCU','Quel pays a remporté la première coupe du monde de football?'),
(41, 'QCU','A tennis combien y a-t-il de tournois de grand chelem?'),
(42, 'QCU','Combien vaut un essai non transformé au rugby?'),
(43, 'QCU','Quel est le club de foot ayant temporté le plus de ligue des champions?'),
(44, 'QCU','Comment s\'appelle le critère qui permet d\'effectuer un échantillonnage correct?'),
(45, 'QCU','Quel est l\'inverse d\'une fréquence?'),
(46, 'QCU','Quel moyen permet de communiquer à une vitesse proche de celle de la lumière?'),
(47, 'QCU','Combien de couches comporte le modèle OSI?'),
(48, 'QCU','En anglais quel est le pluriel de souris?'),
(49, 'QCU','Comment dit-on âne en anglais?'),
(50, 'QCU','Comment dit-on meuble en anglais?'),
(51, 'QCU','Comment dit-on casque en anglais?');

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
(32, NULL, NULL, 'M Pokora', 0),
(33, NULL, NULL, 'J. R. R. Tolkien', 1),
(34, NULL, NULL, 'J. M. L. Tolkien', 0),
(35, NULL, NULL, 'J. M. M. Tolkien', 0),
(36, NULL, NULL, 'J. R. L. Tolkien', 0),
(37, NULL, NULL, 'Sir Arthur Conan Doyle', 1),
(38, NULL, NULL, 'Agatha Christie', 0),
(39, NULL, NULL, 'Edgar Allan Poe', 0),
(40, NULL, NULL, 'Maurice Leblanc', 0),
(41, NULL, NULL, 'Le malade imaginaire', 1),
(42, NULL, NULL, 'Les précieuses ridicules', 0),
(43, NULL, NULL, 'Les fourberies de Scapin', 0),
(44, NULL, NULL, 'L\'avare', 0),
(45, NULL, NULL, '1989', 1),
(46, NULL, NULL, '1991', 0),
(47, NULL, NULL, '1979', 0),
(48, NULL, NULL, '1982', 0),
(49, NULL, NULL, '800', 1),
(50, NULL, NULL, '700', 0),
(51, NULL, NULL, '600', 0),
(52, NULL, NULL, '500', 0),
(53, NULL, NULL, 'Marcus Brutus', 1),
(54, NULL, NULL, 'Néron', 0),
(55, NULL, NULL, 'Claudius', 0),
(56, NULL, NULL, 'Augustus', 0),
(57, NULL, NULL, 'Pharo', 1),
(58, NULL, NULL, 'Php', 0),
(59, NULL, NULL, 'Java', 0),
(60, NULL, NULL, 'C', 0),
(61, NULL, NULL, 'International Business Machines', 1),
(62, NULL, NULL, 'International Broadcast Machines', 0),
(63, NULL, NULL, 'International Business Material', 0),
(64, NULL, NULL, 'International Broadcast Material', 0),
(65, NULL, NULL, '65536', 1),
(66, NULL, NULL, '256', 0),
(67, NULL, NULL, '16', 0),
(68, NULL, NULL, '512', 0),
(69, NULL, NULL, 'Requins', 1),
(70, NULL, NULL, 'Arbres', 0),
(71, NULL, NULL, 'Dinosaures', 0),
(72, NULL, NULL, 'Loups', 0),
(73, NULL, NULL, '2000 avant JC', 1),
(74, NULL, NULL, '5000 avant JC', 0),
(75, NULL, NULL, '10000 avant JC', 0),
(76, NULL, NULL, '20000 avant JC', 0),
(77, NULL, NULL, 'Lamarck', 1),
(78, NULL, NULL, 'Laporte', 0),
(79, NULL, NULL, 'Laplace', 0),
(80, NULL, NULL, 'Lafitte', 0),
(81, NULL, NULL, 'Ouzbékistan', 1),
(82, NULL, NULL, 'Suisse', 0),
(83, NULL, NULL, 'Niger', 0),
(84, NULL, NULL, 'Bolivie', 0),
(85, NULL, NULL, 'Tanzanie', 1),
(86, NULL, NULL, 'Tasmanie', 0),
(87, NULL, NULL, 'Koweït', 0),
(88, NULL, NULL, 'Oman', 0),
(89, NULL, NULL, 'Tokyo', 1),
(90, NULL, NULL, 'New York', 0),
(91, NULL, NULL, 'Jakarta', 0),
(92, NULL, NULL, 'Séoul', 0),
(93, NULL, NULL, 'Royaume-Uni', 1),
(94, NULL, NULL, 'Etats Unis d\'Amérique', 0),
(95, NULL, NULL, 'Australie', 0),
(96, NULL, NULL, 'Canada', 0),
(97, NULL, NULL, 'Double hélice', 1),
(98, NULL, NULL, 'Sphérique', 0),
(99, NULL, NULL, 'Ellipse', 0),
(100, NULL, NULL, 'Hexagone', 0),
(101, NULL, NULL, '2', 1),
(102, NULL, NULL, '1', 0),
(103, NULL, NULL, '3', 0),
(104, NULL, NULL, '4', 0),
(105, NULL, NULL, '9.81', 1),
(106, NULL, NULL, '981', 0),
(107, NULL, NULL, '98.1', 0),
(108, NULL, NULL, '0.981', 0),
(109, NULL, NULL, 'Joules', 1),
(110, NULL, NULL, 'Kelvin', 0),
(111, NULL, NULL, 'Degré Celsius', 0),
(112, NULL, NULL, 'Kilogramme', 0),
(113, NULL, NULL, 'Sa vitesse augmente', 1),
(114, NULL, NULL, 'Sa vitesse diminue', 0),
(115, NULL, NULL, 'Le fluide s\'arrête', 0),
(116, NULL, NULL, 'Le fluide fait demi-tour', 0),
(117, NULL, NULL, 'Tonne d\'équivalent pétrole', 1),
(118, NULL, NULL, 'Tonne d\'équivalent plancton', 0),
(119, NULL, NULL, 'Tonne d\'équivalent phosphore', 0),
(120, NULL, NULL, 'Tonne d\'équivalent pizoélectrique', 0),
(121, NULL, NULL, '15000', 1),
(122, NULL, NULL, '1500', 0),
(123, NULL, NULL, '150', 0),
(124, NULL, NULL, '15', 0),
(125, NULL, NULL, 'avocat', 1),
(126, NULL, NULL, 'tomate', 0),
(127, NULL, NULL, 'concombre', 0),
(128, NULL, NULL, 'carotte', 0),
(129, NULL, NULL, 'Inde', 1),
(130, NULL, NULL, 'Russie', 0),
(131, NULL, NULL, 'Japon', 0),
(132, NULL, NULL, 'Allemagne', 0),
(133, NULL, NULL, '15%', 1),
(134, NULL, NULL, '10%', 0),
(135, NULL, NULL, '5%', 0),
(136, NULL, NULL, '20%', 0),
(137, NULL, NULL, '31', 1),
(138, NULL, NULL, '1', 0),
(139, NULL, NULL, '21', 0),
(140, NULL, NULL, '26', 0),
(141, NULL, NULL, '0', 1),
(142, NULL, NULL, '1', 0),
(143, NULL, NULL, '-1', 0),
(144, NULL, NULL, '10', 0),
(145, NULL, NULL, '-1', 1),
(146, NULL, NULL, '0', 0),
(147, NULL, NULL, 'Il n\'y a pas de minimum', 0),
(148, NULL, NULL, '1', 0),
(149, NULL, NULL, 'La fonction n\'est pas définie en 0', 1),
(150, NULL, NULL, '0', 0),
(151, NULL, NULL, '1', 0),
(152, NULL, NULL, 'e', 0),
(153, NULL, NULL, 'Urugay', 1),
(154, NULL, NULL, 'Italie', 0),
(155, NULL, NULL, 'Brésil', 0),
(156, NULL, NULL, 'Angleterre', 0),
(157, NULL, NULL, '3', 1),
(158, NULL, NULL, '4', 0),
(159, NULL, NULL, '5', 0),
(160, NULL, NULL, '6', 0),
(161, NULL, NULL, '5', 1),
(162, NULL, NULL, '6', 0),
(163, NULL, NULL, '7', 0),
(164, NULL, NULL, '8', 0),
(165, NULL, NULL, 'Réal Madrid CF', 1),
(166, NULL, NULL, 'FC Bayern Munich', 0),
(167, NULL, NULL, 'FC Barcelone', 0),
(168, NULL, NULL, 'Manchester United FC', 0),
(169, NULL, NULL, 'Shannon', 1),
(170, NULL, NULL, 'McMahon', 0),
(171, NULL, NULL, 'Ketchum', 0),
(172, NULL, NULL, 'Brandon', 0),
(173, NULL, NULL, 'La période', 1),
(174, NULL, NULL, 'La vitesse', 0),
(175, NULL, NULL, 'La longueur d\'onde', 0),
(176, NULL, NULL, 'La pression', 0),
(177, NULL, NULL, 'La fibre', 1),
(178, NULL, NULL, 'Les câbles en cuivre', 0),
(179, NULL, NULL, 'Le bouche à oreille', 0),
(180, NULL, NULL, 'Les câbles de fer', 0),
(181, NULL, NULL, '7', 1),
(182, NULL, NULL, '8', 0),
(183, NULL, NULL, '9', 0),
(184, NULL, NULL, '10', 0),
(185, NULL, NULL, 'Mice', 1),
(186, NULL, NULL, 'Mouse', 0),
(187, NULL, NULL, 'Mouses', 0),
(188, NULL, NULL, 'Mouth', 0),
(189, NULL, NULL, 'Donkey', 1),
(190, NULL, NULL, 'Monkey', 0),
(191, NULL, NULL, 'Turkey', 0),
(192, NULL, NULL, 'Mulkey', 0),
(193, NULL, NULL, 'Furniture', 1),
(194, NULL, NULL, 'Chair', 0),
(195, NULL, NULL, 'Bed', 0),
(196, NULL, NULL, 'Cushion', 0),
(197, NULL, NULL, 'Helmet', 1),
(198, NULL, NULL, 'Basket', 0),
(199, NULL, NULL, 'Comet', 0),
(200, NULL, NULL, 'Pocket', 0);


--
-- Contenu de la table `TAG`
--

INSERT INTO `TAG` (`LIBELLE`, `COULEUR`) VALUES
('Développement Durable', 'Cyan'),
('Géographie', 'Violet'),
('Histoire', 'Jaune'),
('Informatique', 'Bleu'),
('Littérature', 'Rouge'),
('Energétique', 'Marron'),
('Nature', 'Vert'),
('Physique Chimie', 'Poupre'),
('Mathématiques', 'Bleu turquoise'),
('Télécom et réseaux', 'Blanc'),
('Langues étrangères', 'Rose'),
('Sport', 'Noir');


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
('Physique Chimie', 7),
('Littérature', 9),
('Energétique', 8),
('Nature', 2),
('Nature', 6),
('Littérature', 10),
('Littérature', 11),
('Littérature', 12),
('Histoire', 13),
('Histoire', 14),
('Histoire', 15),
('Informatique', 16),
('Informatique', 17),
('Informatique', 18),
('Nature', 19),
('Nature', 20),
('Nature', 21),
('Géographie', 22),
('Géographie', 23),
('Géographie', 24),
('Géographie', 25),
('Physique Chimie', 26),
('Physique Chimie', 27),
('Physique Chimie', 28),
('Energétique', 29),
('Energétique', 30),
('Energétique', 31),
('Développement durable', 32),
('Développement durable', 33),
('Développement durable', 34),
('Développement durable', 35),
('Mathématiques', 36),
('Mathématiques', 37),
('Mathématiques', 38),
('Mathématiques', 39),
('Sport', 40),
('Sport', 41),
('Sport', 42),
('Sport', 43),
('Télécom et réseaux', 44),
('Télécom et réseaux', 45),
('Télécom et réseaux', 46),
('Télécom et réseaux', 47),
('Langues étrangères', 48),
('Langues étrangères', 49),
('Langues étrangères', 50),
('Langues étrangères', 51);

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
(9, 32),
(10, 33),
(10, 34),
(10, 35),
(10, 36),
(11, 37),
(11, 38),
(11, 39),
(11, 40),
(12, 41),
(12, 42),
(12, 43),
(12, 44),
(15, 45),
(13, 46),
(13, 47),
(13, 48),
(14, 49),
(14, 50),
(14, 51),
(14, 52),
(15, 53),
(15, 54),
(15, 55),
(15, 56),
(16, 57),
(16, 58),
(16, 59),
(16, 60),
(17, 61),
(17, 62),
(17, 63),
(17, 64),
(18, 65),
(18, 66),
(18, 67),
(18, 68),
(19, 69),
(19, 70),
(19, 71),
(19, 72),
(20, 73),
(20, 74),
(20, 75),
(20, 76),
(21, 77),
(21, 78),
(21, 79),
(21, 80),
(22, 81),
(22, 82),
(22, 83),
(22, 84),
(23, 85),
(23, 86),
(23, 87),
(23, 88),
(24, 89),
(24, 90),
(24, 91),
(24, 92),
(25, 93),
(25, 94),
(25, 95),
(25, 96),
(26, 97),
(26, 98),
(26, 99),
(26, 100),
(27, 101),
(27, 102),
(27, 103),
(27, 104),
(28, 105),
(28, 106),
(28, 107),
(28, 108),
(29, 109),
(29, 110),
(29, 111),
(29, 112),
(30, 113),
(30, 114),
(30, 115),
(30, 116),
(31, 117),
(31, 118),
(31, 119),
(31, 120),
(32, 121),
(32, 122),
(32, 123),
(32, 124),
(33, 125),
(33, 126),
(33, 127),
(33, 128),
(34, 129),
(34, 130),
(34, 131),
(34, 132),
(35, 133),
(35, 134),
(35, 135),
(35, 136),
(36, 137),
(36, 138),
(36, 139),
(36, 140),
(37, 141),
(37, 142),
(37, 143),
(37, 144),
(38, 145),
(38, 146),
(38, 147),
(38, 148),
(39, 149),
(39, 150),
(39, 151),
(39, 152),
(40, 153),
(40, 154),
(40, 155),
(40, 156),
(41, 157),
(41, 158),
(41, 159),
(41, 160),
(42, 161),
(42, 162),
(42, 163),
(42, 164),
(43, 165),
(43, 166),
(43, 167),
(43, 168),
(44, 169),
(44, 170),
(44, 171),
(44, 172),
(45, 173),
(45, 174),
(45, 175),
(45, 176),
(46, 177),
(46, 178),
(46, 179),
(46, 180),
(47, 181),
(47, 182),
(47, 183),
(47, 184),
(48, 185),
(48, 186),
(48, 187),
(48, 188),
(49, 189),
(49, 190),
(49, 191),
(49, 192),
(50, 193),
(50, 194),
(50, 195),
(50, 196),
(51, 197),
(51, 198),
(51, 199),
(51, 200);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
