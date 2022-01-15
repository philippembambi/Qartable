-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 07 fév. 2021 à 18:51
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kdgdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `nomadmin` int(255) NOT NULL,
  `mpadmin` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `idcat` int(11) NOT NULL AUTO_INCREMENT,
  `nomcat` varchar(25) NOT NULL,
  `imagesurl` varchar(255) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idcat`, `nomcat`, `imagesurl`) VALUES
(1, 'Hommes', 'hommes.png'),
(2, 'Femmes', 'femmes.png'),
(3, 'Enfants', 'enfants.png'),
(4, 'Aliments', 'aliments.png'),
(5, 'Divers', 'divers.png');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `nomclient` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'User',
  `numtelclient` varchar(25) CHARACTER SET utf8 NOT NULL,
  `gmailclient` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'exemple@gmail.com',
  `adresse` text CHARACTER SET utf8 NOT NULL,
  `sexeclient` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT 'NON DEFINI',
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`idclient`, `nomclient`, `numtelclient`, `gmailclient`, `adresse`, `sexeclient`) VALUES
(24, 'Josue', '+243852690333', 'vhjj', 'chhjj', 'MASCULIN'),
(39, 'autre', '+243814009038', 'ww@zutre', 'bbbbbb', 'MASCULIN'),
(40, 'trÃ©sor 3', '+243851193968', 'elail@vvv', 'kuna', 'MASCULIN'),
(41, 'Ben ', '+242822029230', 'courageb', 'pulili tonton\nbumbu kinshasa rdc', 'MASCULIN'),
(42, 'Ben ', '+242822029230', 'courageb', 'pulili tonton\nbumbu kinshasa rdc', 'MASCULIN'),
(43, 'User', '+242822029230', 'exemple@gmail.com', '', 'NON DEFINI'),
(44, 'User', '+243826057697', 'exemple@gmail.com', '', 'NON DEFINI'),
(45, 'ed', '+243999900555', 'moi@gmail.com', 'limete', 'MASCULIN'),
(46, 'GÃ©dÃ©on', '+243852211223', 'm@gh', 'gghhhh', 'MASCULIN'),
(47, 'Christian', '+243894231548', 'kadjangubisimwac5@gmail.com', 'No 13, 10eme rue limetÃ© industriel\nlimetÃ© Kinshasa RDC', 'MASCULIN'),
(48, 'Christian', '+243894231548', 'kadjangubisimwac5@gmail.com', 'No 13, 10eme rue limetÃ© industriel\nlimetÃ© Kinshasa RDC', 'MASCULIN'),
(49, 'Christian', '+243894231548', 'exemple@gmail.com', '', 'NON DEFINI'),
(50, 'Christian', '+243894231548', 'exemple@gmail.com', '', 'NON DEFINI'),
(51, 'Christian', '+243894231548', 'exemple@gmail.com', '', 'NON DEFINI'),
(52, 'hhhhh', '+243894231548', 'exemple@gmail.com', '', 'NON DEFINI');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `idcom` int(11) NOT NULL AUTO_INCREMENT,
  `datecom` datetime NOT NULL,
  `quantcom` int(11) DEFAULT NULL,
  `ptcom` double(10,2) DEFAULT NULL,
  `couleurcom` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `taillecom` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `nomautre` varchar(255) NOT NULL,
  `validationcom` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT 'NON VALIDE',
  `numautre` varchar(50) NOT NULL,
  `adresseautre` text NOT NULL,
  `idprod` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`idcom`),
  KEY `idprod` (`idprod`),
  KEY `idclient` (`idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `couleurs`
--

DROP TABLE IF EXISTS `couleurs`;
CREATE TABLE IF NOT EXISTS `couleurs` (
  `idc` int(11) NOT NULL AUTO_INCREMENT,
  `nomcouleur` varchar(150) NOT NULL,
  `idp` int(11) NOT NULL,
  PRIMARY KEY (`idc`),
  KEY `idp` (`idp`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `couleurs`
--

INSERT INTO `couleurs` (`idc`, `nomcouleur`, `idp`) VALUES
(1, 'noire', 1),
(2, 'blanc', 1),
(3, 'grise', 1),
(4, 'jaune', 1),
(5, 'chocolat', 1),
(6, 'orange', 2),
(7, 'noire', 3),
(8, 'grise', 3),
(11, 'noire', 10),
(12, 'bleu', 10),
(13, 'noire', 11),
(14, 'rouge', 11),
(15, 'chocolat', 11),
(16, 'noire', 15),
(17, 'rouge', 15),
(31, 'noire', 18),
(32, 'orange', 18),
(33, 'grise', 18),
(34, 'noire', 24),
(35, 'grise', 24),
(36, 'blanc', 24),
(37, 'noire', 15),
(38, 'rouge', 15),
(39, 'jaune', 15),
(40, 'vertleger', 15),
(41, 'chocolat', 15);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `idimage` int(11) NOT NULL AUTO_INCREMENT,
  `urlimage` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prod_id` int(11) NOT NULL,
  PRIMARY KEY (`idimage`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`idimage`, `urlimage`, `prod_id`) VALUES
(6, 'images_023.jpg', 5),
(13, 'images_022.jpg', 11),
(20, 'images_011.jpg', 15),
(27, 'images_047.jpg', 18),
(31, 'images_074.jpg', 22),
(35, 'images_050.jpg', 24),
(36, 'images_020.jpg', 24),
(39, 'images_077.jpg', 15),
(40, 'images_012.jpg', 15),
(41, 'images_047.jpg', 15),
(42, 'images_033.jpg', 15);

-- --------------------------------------------------------

--
-- Structure de la table `imageupload`
--

DROP TABLE IF EXISTS `imageupload`;
CREATE TABLE IF NOT EXISTS `imageupload` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idmessage` int(11) NOT NULL AUTO_INCREMENT,
  `textmessage` text CHARACTER SET utf8,
  `datemessage` datetime NOT NULL,
  `propriomessage` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'C',
  `idclient` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  PRIMARY KEY (`idmessage`),
  KEY `FK_Messages_idclient` (`idclient`),
  KEY `idp` (`idp`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idmessage`, `textmessage`, `datemessage`, `propriomessage`, `idclient`, `idp`) VALUES
(1, 'b', '2020-03-01 19:25:12', 'C', 42, 23),
(2, 'g', '2020-03-01 19:25:18', 'C', 42, 23),
(3, '\ntout', '2020-03-01 19:26:31', 'AD', 42, 23),
(4, 'tout', '2020-03-01 19:26:41', 'AD', 42, 23),
(5, '.yty', '2020-03-01 19:27:22', 'C', 42, 23),
(6, 'voir', '2020-03-01 19:27:34', 'C', 42, 23),
(7, 'ccccc', '2020-03-07 17:07:14', 'AD', 42, 23),
(8, ',x', '2020-03-07 17:07:17', 'AD', 42, 23),
(9, 'bonjour', '2020-03-07 17:08:37', 'C', 46, 24),
(10, 'comment', '2020-03-07 17:08:43', 'C', 46, 24),
(11, 'tu vas bien !', '2020-03-07 17:09:12', 'AD', 46, 24),
(12, '?!', '2020-03-07 17:09:20', 'AD', 46, 24);

-- --------------------------------------------------------

--
-- Structure de la table `nouveautes`
--

DROP TABLE IF EXISTS `nouveautes`;
CREATE TABLE IF NOT EXISTS `nouveautes` (
  `idnv` int(11) NOT NULL AUTO_INCREMENT,
  `nomnv` varchar(255) NOT NULL,
  PRIMARY KEY (`idnv`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `nouveautes`
--

INSERT INTO `nouveautes` (`idnv`, `nomnv`) VALUES
(1, 'nouveaute1580921224841.jpg'),
(2, 'nouveaute1580921253639.jpg'),
(3, 'nouveaute1580921297466.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `idprod` int(11) NOT NULL AUTO_INCREMENT,
  `nomprod` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prixprod` int(11) NOT NULL,
  `urlimage` varchar(150) CHARACTER SET utf8 NOT NULL,
  `descprod` text CHARACTER SET utf8 NOT NULL,
  `redprix` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `promotion` varchar(50) NOT NULL DEFAULT 'NON',
  `livraison` varchar(50) NOT NULL DEFAULT 'NORMAL',
  `idcat` int(11) NOT NULL,
  `idtype` int(11) NOT NULL,
  PRIMARY KEY (`idprod`),
  KEY `idtype` (`idtype`),
  KEY `idcat` (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idprod`, `nomprod`, `prixprod`, `urlimage`, `descprod`, `redprix`, `promotion`, `livraison`, `idcat`, `idtype`) VALUES
(1, 'chaussure vance', 50, 'images_024.jpg', 'tres cool', '', 'NON', 'NORMAL', 1, 1),
(2, 'sandale ', 12, 'images_023.jpg', 'tres jolie', '10', 'NON', 'NORMAL', 2, 1),
(3, 'veste xd', 150, 'images_026.jpg', 'veste en nylon', '', 'NON', 'NORMAL', 1, 2),
(5, 'bikini ', 20, 'images_013.jpg', 'bikini en pagne ', '', 'NON', 'NORMAL', 2, 2),
(9, 'pantalon jeans', 15, 'images_027.jpg', 'pantalon jeans Daer', '', 'NON', 'NORMAL', 1, 2),
(10, 'polo', 10, 'images_028.jpg', 'polo manche longue en nylon', '10', 'NON', 'NORMAL', 1, 2),
(11, 'robe YuH', 14, 'images_044.jpg', 'robe Yuh chanel ', '', 'NON', 'NORMAL', 2, 2),
(13, 'ecouter', 4, 'images_032.jpg', 'ecouter samsung RC324', '', 'NON', 'NORMAL', 5, 1),
(14, 'lunette', 8, 'images_016.jpg', 'lunette de soleil ', '', 'NON', 'NORMAL', 5, 1),
(15, 'robe DIMSHO', 25, 'images_053.jpg', 'tres bien', '', 'NON', 'NORMAL', 2, 2),
(18, 'ceinture', 20, 'images_042.jpg', 'ceinture gucci', '', 'NON', 'NORMAL', 1, 3),
(22, 'fond de teint', 3, 'images_047.jpg', 'fond de teint numero 2', '', 'NON', 'GROS', 2, 3),
(23, 'spaghetti ', 2, 'images_050.jpg', 'spaghetti apolo', '', 'OUI', 'GROS', 4, 1),
(24, 'robe kid pop', 15, 'images_060.jpg', 'robe manche courte en nylon', '', 'NON', 'GROS', 3, 2),
(25, 'robe soiree', 14, 'images_054.jpg', 'robe jolie de taille', '15', 'NON', 'NORMAL', 2, 2),
(26, 'Singlet homme', 50, 'images_006.jpg', 'tres cool', '', 'OUI', 'NORMAL', 1, 1),
(27, 'sandales en talon', 12, 'images_023.jpg', 'tres jolie coo', '8%', 'OUI', 'NORMAL', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produitspanier`
--

DROP TABLE IF EXISTS `produitspanier`;
CREATE TABLE IF NOT EXISTS `produitspanier` (
  `idpanier` int(11) NOT NULL AUTO_INCREMENT,
  `nomprod` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prixprod` text CHARACTER SET utf8 NOT NULL,
  `redprix` varchar(50) NOT NULL,
  `descprod` text CHARACTER SET utf8 NOT NULL,
  `urlimage` varchar(250) CHARACTER SET utf8 NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`idpanier`),
  KEY `idclient` (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tailles`
--

DROP TABLE IF EXISTS `tailles`;
CREATE TABLE IF NOT EXISTS `tailles` (
  `idt` int(11) NOT NULL AUTO_INCREMENT,
  `nomtaille` varchar(150) NOT NULL,
  `idp` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idt`),
  KEY `idp` (`idp`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tailles`
--

INSERT INTO `tailles` (`idt`, `nomtaille`, `idp`) VALUES
(1, '33', 1),
(2, '34', 1),
(3, '30', 2),
(4, '31', 2),
(5, '32', 2),
(6, 'M', 3),
(7, 'XL', 3),
(11, 'S', 5),
(12, 'M', 5),
(13, 'S', 24),
(14, 'M', 24),
(15, '31', 15),
(16, '32', 15),
(17, '34', 15),
(18, '33', 15),
(19, '37', 15);

-- --------------------------------------------------------

--
-- Structure de la table `typesprod`
--

DROP TABLE IF EXISTS `typesprod`;
CREATE TABLE IF NOT EXISTS `typesprod` (
  `idtp` int(11) NOT NULL AUTO_INCREMENT,
  `nomtype` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idtp`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typesprod`
--

INSERT INTO `typesprod` (`idtp`, `nomtype`) VALUES
(1, 'Chaussures'),
(2, 'Vetements'),
(3, 'Accessoires');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `produits` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`idclient`) REFERENCES `clients` (`idclient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `couleurs`
--
ALTER TABLE `couleurs`
  ADD CONSTRAINT `couleurs_ibfk_1` FOREIGN KEY (`idp`) REFERENCES `produits` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `produits` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_Messages_idclient` FOREIGN KEY (`idclient`) REFERENCES `clients` (`idclient`),
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`idp`) REFERENCES `produits` (`idprod`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`idcat`) REFERENCES `categories` (`idcat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`idtype`) REFERENCES `typesprod` (`idtp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produitspanier`
--
ALTER TABLE `produitspanier`
  ADD CONSTRAINT `produitspanier_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `clients` (`idclient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tailles`
--
ALTER TABLE `tailles`
  ADD CONSTRAINT `tailles_ibfk_1` FOREIGN KEY (`idp`) REFERENCES `produits` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
