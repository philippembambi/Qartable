-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 04:30 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kartable`
--

-- --------------------------------------------------------

--
-- Table structure for table `08_01_2021`
--

CREATE TABLE IF NOT EXISTS `08_01_2021` (
  `compteur` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(20) NOT NULL,
  `id_classe` int(20) NOT NULL,
  `date_pointage` varchar(20) NOT NULL,
  `pointe_present` varchar(20) NOT NULL,
  `id_admin` int(20) NOT NULL,
  `id_admin_pointe` int(20) NOT NULL,
  PRIMARY KEY (`compteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `affectation_cours`
--

CREATE TABLE IF NOT EXISTS `affectation_cours` (
  `id_affectation` int(11) NOT NULL AUTO_INCREMENT,
  `id_enseignant` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `id_admin_affect` int(11) NOT NULL,
  `date_affect` int(20) NOT NULL,
  PRIMARY KEY (`id_affectation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `affectation_cours`
--

INSERT INTO `affectation_cours` (`id_affectation`, `id_enseignant`, `id_cours`, `id_admin_affect`, `date_affect`) VALUES
(2, 1, 22, 6, 1609188883),
(3, 2, 23, 6, 1609215310),
(4, 2, 15, 6, 1609215354),
(5, 1, 11, 6, 1609219839),
(6, 2, 9, 6, 1609211727),
(7, 1, 17, 6, 1609211756),
(8, 1, 8, 6, 1609211798),
(9, 3, 9, 6, 1609212367),
(10, 3, 18, 6, 1609212389),
(11, 3, 16, 6, 1609212407),
(12, 3, 24, 6, 1609212439),
(13, 3, 26, 6, 1609212457),
(14, 1, 18, 8, 1610129576);

-- --------------------------------------------------------

--
-- Table structure for table `heures`
--

CREATE TABLE IF NOT EXISTS `heures` (
  `id_heure` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_heure` varchar(20) NOT NULL,
  PRIMARY KEY (`id_heure`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `heures`
--

INSERT INTO `heures` (`id_heure`, `intitule_heure`) VALUES
(1, '7H30  -  8H30'),
(2, '8H30  -  9H30'),
(3, '9H30  -  10H30'),
(4, '10H45  -  11H45'),
(5, '11H45 - 12H30');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_admin`
--

CREATE TABLE IF NOT EXISTS `kartable_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `noms_admin` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `psw_admin` varchar(255) NOT NULL,
  `date_last_connetion` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `kartable_admin`
--

INSERT INTO `kartable_admin` (`id_admin`, `noms_admin`, `psw_admin`, `date_last_connetion`) VALUES
(7, 'Ben Kumala', 'd6194c68fcc7e79bb57401be603cb1cc', 1612037290),
(8, 'Philippe Mbambi', '6f50b8c8a110c2c710cbcd28fde3713c', 1615548734),
(6, 'Maurice Bambane', 'f71dbe52628a3f83a77ab494817525c6', 1612032667),
(9, 'Hello mysql', '', 0),
(10, 'Hello mysql', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_anne_scolaire`
--

CREATE TABLE IF NOT EXISTS `kartable_anne_scolaire` (
  `id_annee` int(11) NOT NULL AUTO_INCREMENT,
  `annee` varchar(10) NOT NULL,
  PRIMARY KEY (`id_annee`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kartable_anne_scolaire`
--

INSERT INTO `kartable_anne_scolaire` (`id_annee`, `annee`) VALUES
(1, '2020-2021');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_contrat`
--

CREATE TABLE IF NOT EXISTS `kartable_contrat` (
  `id_contrat` int(11) NOT NULL AUTO_INCREMENT,
  `noms_responsable` varchar(50) NOT NULL,
  `date_debut` varchar(20) NOT NULL,
  `mois_debut` varchar(10) NOT NULL,
  `temps_reel` int(20) NOT NULL,
  `echeance_contrat` varchar(20) NOT NULL,
  `observation` text NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id_contrat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kartable_contrat`
--

INSERT INTO `kartable_contrat` (`id_contrat`, `noms_responsable`, `date_debut`, `mois_debut`, `temps_reel`, `echeance_contrat`, `observation`, `id_admin`) VALUES
(1, 'Nzuzi Moto Bernand', '2020/12/28', '2020/12', 1608831957, '2021/05/08', 'Aucune observation prise en compte pour ce prÃ©sent contrat', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_cours`
--

CREATE TABLE IF NOT EXISTS `kartable_cours` (
  `id_cours` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_cours` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_cours`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `kartable_cours`
--

INSERT INTO `kartable_cours` (`id_cours`, `intitule_cours`) VALUES
(5, 'Réligion'),
(6, 'Éducation Civique & Morale'),
(7, 'Éducation à la vie'),
(8, 'Informatique'),
(9, 'Anglais'),
(10, 'Dessin'),
(11, 'Dessin Scientifique'),
(12, 'Éducation Physique'),
(13, 'Musique'),
(14, 'Géographie'),
(15, 'Histoire'),
(16, 'Sciences'),
(17, 'Technologie'),
(18, 'Français'),
(19, 'Mathématiques'),
(20, 'Sociétés Africaines'),
(21, 'Économie politique'),
(22, 'Biologie'),
(23, 'Chimie'),
(24, 'Physique'),
(25, 'Esthétique'),
(26, 'Philosophie');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_droit_acces`
--

CREATE TABLE IF NOT EXISTS `kartable_droit_acces` (
  `id_d_acces` int(15) NOT NULL AUTO_INCREMENT,
  `d_acces` varchar(20) NOT NULL,
  PRIMARY KEY (`id_d_acces`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kartable_droit_acces`
--

INSERT INTO `kartable_droit_acces` (`id_d_acces`, `d_acces`) VALUES
(1, 'root'),
(2, 'mod'),
(3, 'del'),
(4, 'config'),
(5, 'print_index'),
(6, 'print_class'),
(7, 'print_cpte');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_droit_admin`
--

CREATE TABLE IF NOT EXISTS `kartable_droit_admin` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `id_d_acces` int(15) NOT NULL,
  `id_admin` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kartable_droit_admin`
--

INSERT INTO `kartable_droit_admin` (`id`, `id_d_acces`, `id_admin`) VALUES
(6, 1, 7),
(2, 1, 6),
(3, 5, 8),
(4, 4, 8),
(5, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_eleves`
--

CREATE TABLE IF NOT EXISTS `kartable_eleves` (
  `id_eleve` int(11) NOT NULL AUTO_INCREMENT,
  `noms_eleve` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `sexe_eleve` varchar(2) NOT NULL,
  `date_naissance` varchar(11) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `lieu_naissance` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `classe_eleve` int(11) NOT NULL,
  `option_eleve` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `info_supplementaire` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `photo_eleve` varchar(100) NOT NULL,
  `date_inscription` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  `id_tuteur` int(11) NOT NULL,
  PRIMARY KEY (`id_eleve`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `kartable_eleves`
--

INSERT INTO `kartable_eleves` (`id_eleve`, `noms_eleve`, `sexe_eleve`, `date_naissance`, `lieu_naissance`, `classe_eleve`, `option_eleve`, `info_supplementaire`, `photo_eleve`, `date_inscription`, `admin_id`, `promotion_id`, `id_tuteur`) VALUES
(53, 'MATALATALA', 'F', '2020-11-28', 'MASIA', 3, 'biochimie', '', '', 1606746613, 7, 7, 34),
(54, 'mulala panis', 'M', '2020-12-18', 'kikwit', 3, 'biochimie', 'fer', '', 1608698531, 7, 7, 35),
(22, 'Mutwa Kingombe Henock', 'M', '2007-07-18', 'Kinshasa', 1, 'secondaire', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, sunt sapiente! Inventore cupiditate eum quam nesciunt? Nobis modi omnis itaque distinctio ex, aliquam iure tenetur.', 'user_blue.png', 0, 1, 1, 16),
(48, 'Sd test error', 'M', '2020-11-11', 'Kinshasa', 3, 'biochimie', 'SKD', 'patient.png', 1604665578, 0, 7, 29),
(42, '', 'M', '', 'Kishasa', 13, 'secondaire', '', '', 1602840887, 1, 0, 23),
(39, 'Bopili Ebunga Roger', 'M', 'Kinshasa', '38445', 2, 'secondaire', 'Lorem ipsum dolor, sâ€¦', 'user_black.png', 1601395747, 2, 15, 1),
(24, 'Ali Tambwe Gloire', 'M', '2008-07-24', 'Kinshasa', 1, 'secondaire', '', 'user_yellow.png', 0, 0, 1, 18),
(25, 'Falanga falanga Divine', 'F', '2009-09-08', 'Lubumbashi', 1, 'secondaire', '', 'user_white.png', 0, 0, 1, 19),
(49, 'test chez ben', 'M', '2020-10-23', 'kikwit', 3, 'biochimie', 'blablabla', '1.jpg', 1604665851, 0, 7, 30),
(27, 'Mbayi Koposo Sarah', 'F', '2007-09-05', 'Lubumbashi', 2, 'secondaire', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae vel mollitia voluptates corrupti, enim id quia aliquid ea nisi esse.', 'user_red.png', 1601395747, 0, 2, 21),
(52, 'KILOLO RESIA', 'F', '2020-06-10', 'KIKWIT', 3, 'commerciale', '', '', 1606746496, 7, 11, 33),
(28, 'Mbayi Koposo Sarah', 'F', '39330', 'Lubumbashi', 2, 'secondaire', 'Lorem ipsum dolor, sâ€¦', 'user_red.png', 1601395747, 2, 21, 1),
(44, '', 'M', '', '', 0, 'Non dÃ©finie', '', '', 1604208180, 0, 0, 25),
(46, 'BIZAU MADOU Ar', 'F', '2020-10-23', 'Masi', 3, 'biochimie', 'kjhihcid', '8.jpg', 1604660936, 0, 7, 27),
(47, 'Test sur erreur', 'M', '2020-11-03', 'Kinshasa', 3, 'biochimie', 'JDFLFF', 'garcon-utilisateur-icone-7572-96.png', 1604665032, 0, 7, 28),
(38, 'Bopili Ebunga Roger', 'M', 'Kinshasa', '38445', 2, 'secondaire', 'Lorem ipsum dolor, sâ€¦', 'user_black.png', 1601395747, 2, 15, 1),
(40, 'Bopili Ebunga Roger', 'M', '38445', 'Kinshasa', 2, 'secondaire', 'Lorem ipsum dolor, sâ€¦', 'user_black.png', 1601395747, 2, 2, 1),
(50, 'kasala mato', 'M', '2020-10-16', 'kikwit', 3, 'biochimie', '', '', 1604666810, 2, 7, 31),
(51, 'KLKK?LK', 'M', '2020-10-28', 'HBJH', 4, 'biochimie', '', '', 1604667846, 2, 8, 32);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_emprunt`
--

CREATE TABLE IF NOT EXISTS `kartable_emprunt` (
  `id_emp` int(11) NOT NULL AUTO_INCREMENT,
  `id_personnel` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `date_emp` varchar(20) NOT NULL,
  `montant_emp` int(15) NOT NULL,
  `devise_emp` varchar(10) NOT NULL,
  `note_emp` text NOT NULL,
  PRIMARY KEY (`id_emp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kartable_emprunt`
--

INSERT INTO `kartable_emprunt` (`id_emp`, `id_personnel`, `id_admin`, `date_emp`, `montant_emp`, `devise_emp`, `note_emp`) VALUES
(1, 3, 6, '22/12/2020', 120, 'usd', 'Some note'),
(2, 1, 6, '22/12/2020', 75, 'usd', 'Some note'),
(3, 5, 6, '23/12/2020', 25, 'usd', '');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_frais_scolaire`
--

CREATE TABLE IF NOT EXISTS `kartable_frais_scolaire` (
  `id_frais` int(20) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(20) NOT NULL,
  `montant` int(50) NOT NULL,
  `devise` varchar(10) NOT NULL,
  `modalite` varchar(100) NOT NULL,
  `desc_modalite` varchar(250) NOT NULL,
  `motif` varchar(100) NOT NULL,
  `desc_motif` text NOT NULL,
  `rest_a_payer` int(20) NOT NULL,
  `date_paiement` varchar(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `mois` varchar(50) NOT NULL,
  `erreur_signalee` varchar(10) NOT NULL,
  `date_erreur_signalee` int(20) NOT NULL,
  `id_admin_signal` int(11) NOT NULL,
  PRIMARY KEY (`id_frais`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `kartable_frais_scolaire`
--

INSERT INTO `kartable_frais_scolaire` (`id_frais`, `id_eleve`, `montant`, `devise`, `modalite`, `desc_modalite`, `motif`, `desc_motif`, `rest_a_payer`, `date_paiement`, `id_admin`, `mois`, `erreur_signalee`, `date_erreur_signalee`, `id_admin_signal`) VALUES
(1, 22, 160, '$', 'Accompte', 'Entrer une description ...', 'fraisScolaire', 'Ajouter une description ...', 0, '2020/11/26', 6, '9', 'oui', 1611918082, 6),
(2, 21, 200, '$', 'Accompte', 'Entrer une description ...', 'fraisScolaire', 'Ajouter une description ...', 0, '2020/11/26', 6, '9', '', 0, 0),
(3, 24, 150, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/11/25', 6, '9', '', 0, 0),
(4, 24, 50, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/11/24', 6, '9', '', 0, 0),
(5, 22, 120, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/11/24', 6, '9', '', 0, 0),
(6, 46, 300, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/11/23', 6, '10', '', 0, 0),
(7, 21, 100, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/11/27', 7, '10', '', 0, 0),
(10, 52, 50, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/11/30', 7, '1', '', 0, 0),
(11, 52, 60, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/11/29', 7, '12', '', 0, 0),
(12, 52, 65, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/11/28', 7, '11', '', 0, 0),
(13, 52, 50, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/11/29', 7, '2', '', 0, 0),
(14, 52, 300, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/11/28', 7, '3', '', 0, 0),
(15, 0, 120, '$', 'tranche2', '', 'fraisScolaire', '', 0, '2020/11/30', 7, '4', '', 0, 0),
(16, 52, 120, '$', 'tranche2', '', 'fraisScolaire', '', 0, '2020/11/30', 7, '4', '', 0, 0),
(30, 22, 120, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2021/01/08', 8, '01', '', 0, 0),
(18, 27, 60, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '12', '', 1608836050, 6),
(20, 27, 150, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '5', 'oui', 1609589558, 7),
(21, 27, 45, '$', 'tranche2', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '5', '', 0, 0),
(22, 27, 25, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '5', 'oui', 1609189212, 6),
(23, 39, 150, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '6', '', 0, 0),
(24, 39, 50, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '7', '', 0, 0),
(25, 39, 50, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '12', '', 0, 0),
(26, 39, 75, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2020/12/14', 6, '12', '', 0, 0),
(27, 50, 70, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/12/23', 6, '3', '', 0, 0),
(28, 50, 75, '$', 'Accompte', '', 'fraisScolaire', '', 0, '2020/12/23', 6, '3', '', 0, 0),
(31, 46, 100, '$', 'tranche1', '', 'fraisScolaire', '', 0, '2021/01/30', 7, '01', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_horaire`
--

CREATE TABLE IF NOT EXISTS `kartable_horaire` (
  `id_horaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_affectation` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `id_jour` int(11) NOT NULL,
  `heure` int(11) NOT NULL,
  `id_admin_h` int(11) NOT NULL,
  `date_enregistrement` int(11) NOT NULL,
  PRIMARY KEY (`id_horaire`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kartable_horaire`
--

INSERT INTO `kartable_horaire` (`id_horaire`, `id_affectation`, `id_promo`, `id_jour`, `heure`, `id_admin_h`, `date_enregistrement`) VALUES
(1, 2, 7, 1, 1, 6, 1609215595),
(2, 3, 7, 1, 2, 6, 1609215645),
(3, 4, 7, 1, 3, 6, 1609215691),
(4, 2, 7, 2, 1, 6, 1609219301),
(5, 5, 7, 2, 2, 6, 1609219895),
(6, 4, 7, 2, 3, 6, 1609211174),
(7, 8, 7, 1, 4, 6, 1609211865),
(8, 6, 7, 2, 4, 6, 1609211932),
(9, 12, 7, 1, 5, 6, 1609212523),
(10, 12, 7, 2, 5, 6, 1609212560),
(11, 10, 7, 3, 1, 6, 1609213173),
(12, 10, 7, 3, 2, 6, 1609213506),
(13, 13, 7, 3, 3, 6, 1609213600),
(14, 2, 7, 3, 4, 6, 1609213651),
(15, 2, 7, 3, 5, 6, 1609213684),
(16, 3, 7, 4, 1, 6, 1609213788),
(17, 2, 7, 4, 2, 6, 1609213828),
(18, 2, 7, 4, 3, 6, 1609213966),
(19, 3, 7, 4, 4, 6, 1609213990),
(20, 5, 7, 4, 5, 6, 1609214015),
(21, 2, 12, 1, 1, 6, 1610092357),
(22, 3, 12, 1, 2, 6, 1610092464),
(23, 4, 12, 2, 1, 6, 1610092587),
(24, 3, 12, 3, 1, 6, 1610092621),
(25, 8, 12, 4, 1, 6, 1610092673);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_jours`
--

CREATE TABLE IF NOT EXISTS `kartable_jours` (
  `id_jour` int(11) NOT NULL AUTO_INCREMENT,
  `nom_jour` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jour`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kartable_jours`
--

INSERT INTO `kartable_jours` (`id_jour`, `nom_jour`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_modalite`
--

CREATE TABLE IF NOT EXISTS `kartable_modalite` (
  `id_modalite` int(20) NOT NULL AUTO_INCREMENT,
  `modalite` varchar(100) NOT NULL,
  `montant_modalite` int(20) NOT NULL,
  `devise` varchar(20) NOT NULL,
  PRIMARY KEY (`id_modalite`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kartable_modalite`
--

INSERT INTO `kartable_modalite` (`id_modalite`, `modalite`, `montant_modalite`, `devise`) VALUES
(1, 'Accompte', 200, '$'),
(2, 'tranche1', 300, '$'),
(3, 'tranche2', 120, '$'),
(4, 'Solde', 620, '$');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_personnel`
--

CREATE TABLE IF NOT EXISTS `kartable_personnel` (
  `id_personel` int(11) NOT NULL AUTO_INCREMENT,
  `noms_personel` varchar(100) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `lieu_naissance` varchar(100) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `etudes` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `salaire_mensuel` int(11) NOT NULL,
  `prime` int(11) NOT NULL,
  `num_matricule` varchar(50) NOT NULL,
  PRIMARY KEY (`id_personel`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kartable_personnel`
--

INSERT INTO `kartable_personnel` (`id_personel`, `noms_personel`, `sexe`, `lieu_naissance`, `date_naissance`, `adresse`, `tel`, `fonction`, `etudes`, `photo`, `id_admin`, `salaire_mensuel`, `prime`, `num_matricule`) VALUES
(1, 'Mboso Bokule Didier', 'M', '', '0', 'Kahumba/Masina', '0826686661', 'enseignant', 'graduat', '', 0, 0, 0, ''),
(2, 'Muya Muwayi Albert', 'M', 'Boma', '1983', 'Kahumba/Masina', '0826686661', 'enseignant', 'licencie', '', 0, 0, 0, ''),
(3, 'Bope Mutwa Philippe', 'M', 'Kinshasa', '1971-10-13', 'Kotoko nÂ°100', '+243826686661', 'enseignant', 'master', '', 0, 0, 0, ''),
(4, 'Nzazi Muke Christine', 'F', 'Lubumbashi', '1975-09-10', 'Kahumba/Masina', '+243826686661', 'SEC', 'licencie', 'user_female.png', 0, 0, 0, ''),
(5, 'Owolo Pambo Ruth', 'F', 'Kinshasa', '1986-10-08', 'Kahumba/Masina', '+243826686661', 'DE', 'licencie', 'user_female.png', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_pointage`
--

CREATE TABLE IF NOT EXISTS `kartable_pointage` (
  `compteur` int(20) NOT NULL AUTO_INCREMENT,
  `id_personnel` int(11) NOT NULL,
  `date_pointage` varchar(20) NOT NULL,
  `pointe_present` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_admin_pointe` int(11) NOT NULL,
  `nbre_heure` int(11) NOT NULL,
  `mois` varchar(11) NOT NULL,
  PRIMARY KEY (`compteur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `kartable_pointage`
--

INSERT INTO `kartable_pointage` (`compteur`, `id_personnel`, `date_pointage`, `pointe_present`, `id_admin`, `id_admin_pointe`, `nbre_heure`, `mois`) VALUES
(75, 5, '23/11/2020', 'Non', 6, 0, 0, '11'),
(74, 4, '23/11/2020', 'Non', 6, 0, 0, '11'),
(73, 3, '23/11/2020', 'Oui', 6, 6, 0, '11'),
(72, 2, '23/11/2020', 'Oui', 6, 6, 0, '11'),
(71, 1, '23/11/2020', 'Oui', 6, 6, 0, '11'),
(70, 5, '21/11/2020', 'Non', 6, 0, 0, '11'),
(69, 4, '21/11/2020', 'Non', 6, 0, 0, '11'),
(68, 3, '21/11/2020', 'Non', 6, 0, 0, '11'),
(67, 2, '21/11/2020', 'Non', 6, 0, 0, '11'),
(66, 1, '21/11/2020', 'Non', 6, 0, 0, '11'),
(65, 5, '20/11/2020', 'Oui', 6, 6, 0, '11'),
(64, 4, '20/11/2020', 'Non', 6, 0, 0, '11'),
(63, 3, '20/11/2020', 'Oui', 6, 6, 0, '11'),
(62, 2, '20/11/2020', 'Oui', 6, 6, 0, '12'),
(61, 1, '20/11/2020', 'Oui', 6, 6, 0, '12'),
(76, 1, '26/11/2020', 'Oui', 7, 7, 0, '12'),
(77, 2, '26/11/2020', 'Non', 7, 0, 0, '12'),
(78, 3, '26/11/2020', 'Oui', 7, 7, 0, '12'),
(79, 4, '26/11/2020', 'Non', 7, 0, 0, '12'),
(80, 5, '26/11/2020', 'Non', 7, 0, 0, '12'),
(81, 1, '30/11/2020', 'Non', 7, 0, 0, '12'),
(82, 2, '30/11/2020', 'Non', 7, 0, 0, '12'),
(83, 3, '30/11/2020', 'Non', 7, 0, 0, '12'),
(84, 4, '30/11/2020', 'Non', 7, 0, 0, '12'),
(85, 5, '30/11/2020', 'Non', 7, 0, 0, '12'),
(86, 1, '22/12/2020', 'Oui', 6, 6, 0, '0'),
(87, 2, '22/12/2020', 'Oui', 6, 6, 0, '0'),
(88, 3, '22/12/2020', 'Oui', 6, 6, 0, '0'),
(89, 4, '22/12/2020', 'Oui', 6, 6, 0, '0'),
(90, 5, '22/12/2020', 'Oui', 6, 6, 0, '0'),
(91, 1, '23/12/2020', 'Oui', 6, 6, 5, '12'),
(92, 2, '23/12/2020', 'Oui', 6, 6, 6, '12'),
(93, 3, '23/12/2020', 'Oui', 6, 6, 4, '12'),
(94, 4, '23/12/2020', 'Non', 6, 0, 0, '12'),
(120, 5, '05/01/2021', 'Non', 6, 0, 0, ''),
(128, 3, '08/01/2021', 'Non', 6, 0, 0, ''),
(127, 2, '08/01/2021', 'Non', 6, 0, 0, ''),
(126, 1, '08/01/2021', 'Oui', 6, 8, 8, '01'),
(130, 5, '08/01/2021', 'Non', 6, 0, 0, ''),
(129, 4, '08/01/2021', 'Non', 6, 0, 0, ''),
(123, 3, '06/01/2021', 'Non', 6, 0, 0, ''),
(122, 2, '06/01/2021', 'Non', 6, 0, 0, ''),
(121, 1, '06/01/2021', 'Non', 6, 0, 0, ''),
(125, 5, '06/01/2021', 'Non', 6, 0, 0, ''),
(124, 4, '06/01/2021', 'Non', 6, 0, 0, ''),
(116, 1, '05/01/2021', 'Oui', 6, 6, 4, '01'),
(119, 4, '05/01/2021', 'Non', 6, 0, 0, ''),
(118, 3, '05/01/2021', 'Non', 6, 0, 0, ''),
(117, 2, '05/01/2021', 'Non', 6, 0, 0, ''),
(131, 1, '12/01/2021', 'Oui', 8, 8, 4, '01'),
(132, 2, '12/01/2021', 'Non', 8, 0, 0, ''),
(133, 3, '12/01/2021', 'Non', 8, 0, 0, ''),
(134, 4, '12/01/2021', 'Non', 8, 0, 0, ''),
(135, 5, '12/01/2021', 'Non', 8, 0, 0, ''),
(136, 1, '29/01/2021', 'Non', 8, 0, 0, ''),
(137, 2, '29/01/2021', 'Non', 8, 0, 0, ''),
(138, 3, '29/01/2021', 'Non', 8, 0, 0, ''),
(139, 4, '29/01/2021', 'Non', 8, 0, 0, ''),
(140, 5, '29/01/2021', 'Non', 8, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_promotion`
--

CREATE TABLE IF NOT EXISTS `kartable_promotion` (
  `id_promotion` int(11) NOT NULL AUTO_INCREMENT,
  `classe_promo` int(2) NOT NULL,
  `option_promo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `annee_scolaire` varchar(10) NOT NULL,
  PRIMARY KEY (`id_promotion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kartable_promotion`
--

INSERT INTO `kartable_promotion` (`id_promotion`, `classe_promo`, `option_promo`, `annee_scolaire`) VALUES
(1, 1, 'Secondaire', '2020-2021'),
(2, 2, 'Secondaire', '2020-2021'),
(3, 3, 'Latin Philo', '2020-2021'),
(4, 4, 'Latin Philo', '2020-2021'),
(5, 5, 'Latin Philo', '2020-2021'),
(6, 6, 'Latin Philo', '2020-2021'),
(7, 3, 'Chimie Biologie', '2020-2021'),
(8, 4, 'Chimie Biologie', '2020-2021'),
(9, 5, 'Chimie Biologie', '2020-2021'),
(10, 6, 'Chimie Biologie', '2020-2021'),
(11, 3, 'Commerciale Info', '2020-2021'),
(12, 4, 'Commerciale Info', '2020-2021'),
(13, 5, 'Commerciale Info', '2020-2021'),
(14, 6, 'Commerciale Info', '2020-2021');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_registre_appel`
--

CREATE TABLE IF NOT EXISTS `kartable_registre_appel` (
  `compteur` int(20) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL,
  `date_pointage` varchar(20) NOT NULL,
  `pointe_present` varchar(20) NOT NULL,
  `id_admin` int(20) NOT NULL,
  `id_admin_pointe` int(20) NOT NULL,
  `id_promo` int(20) NOT NULL,
  PRIMARY KEY (`compteur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=181 ;

--
-- Dumping data for table `kartable_registre_appel`
--

INSERT INTO `kartable_registre_appel` (`compteur`, `id_eleve`, `date_pointage`, `pointe_present`, `id_admin`, `id_admin_pointe`, `id_promo`) VALUES
(1, 21, '20/11/2020', '0', 6, 0, 0),
(2, 22, '20/11/2020', '0', 6, 0, 0),
(3, 48, '20/11/2020', '0', 6, 0, 0),
(4, 42, '20/11/2020', '0', 6, 0, 0),
(5, 39, '20/11/2020', '0', 6, 0, 0),
(6, 24, '20/11/2020', '0', 6, 0, 0),
(7, 25, '20/11/2020', '0', 6, 0, 0),
(8, 49, '20/11/2020', '0', 6, 0, 0),
(9, 27, '20/11/2020', '0', 6, 0, 0),
(10, 28, '20/11/2020', '0', 6, 0, 0),
(11, 44, '20/11/2020', '0', 6, 0, 0),
(12, 46, '20/11/2020', '0', 6, 0, 0),
(13, 47, '20/11/2020', '0', 6, 0, 0),
(14, 38, '20/11/2020', '0', 6, 0, 0),
(15, 40, '20/11/2020', '0', 6, 0, 0),
(16, 50, '20/11/2020', '0', 6, 0, 0),
(17, 51, '20/11/2020', '0', 6, 0, 0),
(18, 21, '21/11/2020', '0', 6, 0, 0),
(19, 22, '21/11/2020', '0', 6, 0, 0),
(20, 48, '21/11/2020', '0', 6, 0, 0),
(21, 42, '21/11/2020', '0', 6, 0, 0),
(22, 39, '21/11/2020', '0', 6, 0, 0),
(23, 24, '21/11/2020', '0', 6, 0, 0),
(24, 25, '21/11/2020', '0', 6, 0, 0),
(25, 49, '21/11/2020', '0', 6, 0, 0),
(26, 27, '21/11/2020', 'Oui', 6, 7, 0),
(27, 28, '21/11/2020', '0', 6, 0, 0),
(28, 44, '21/11/2020', '0', 6, 0, 0),
(29, 46, '21/11/2020', '0', 6, 0, 0),
(30, 47, '21/11/2020', '0', 6, 0, 0),
(31, 38, '21/11/2020', '0', 6, 0, 0),
(32, 40, '21/11/2020', '0', 6, 0, 0),
(33, 50, '21/11/2020', '0', 6, 0, 0),
(34, 51, '21/11/2020', '0', 6, 0, 0),
(35, 21, '23/11/2020', 'Non', 6, 0, 7),
(36, 22, '23/11/2020', 'Non', 6, 0, 7),
(37, 48, '23/11/2020', 'Oui', 6, 6, 7),
(38, 42, '23/11/2020', 'Non', 6, 0, 7),
(39, 39, '23/11/2020', 'Non', 6, 0, 7),
(40, 24, '23/11/2020', 'Non', 6, 0, 7),
(41, 25, '23/11/2020', 'Non', 6, 0, 7),
(42, 49, '23/11/2020', 'Oui', 6, 6, 7),
(43, 27, '23/11/2020', 'Oui', 6, 6, 7),
(44, 28, '23/11/2020', 'Non', 6, 0, 7),
(45, 44, '23/11/2020', 'Non', 6, 0, 7),
(46, 46, '23/11/2020', 'Non', 6, 0, 7),
(47, 47, '23/11/2020', 'Oui', 6, 6, 7),
(48, 38, '23/11/2020', 'Non', 6, 0, 7),
(49, 40, '23/11/2020', 'Non', 6, 0, 7),
(50, 50, '23/11/2020', 'Non', 6, 0, 7),
(51, 51, '23/11/2020', 'Non', 6, 0, 7),
(52, 21, '26/11/2020', 'Non', 7, 0, 2),
(53, 22, '26/11/2020', 'Non', 7, 0, 2),
(54, 48, '26/11/2020', 'Non', 7, 0, 2),
(55, 42, '26/11/2020', 'Non', 7, 0, 2),
(56, 39, '26/11/2020', 'Non', 7, 0, 2),
(57, 24, '26/11/2020', 'Non', 7, 0, 2),
(58, 25, '26/11/2020', 'Non', 7, 0, 2),
(59, 49, '26/11/2020', 'Non', 7, 0, 2),
(60, 27, '26/11/2020', 'Oui', 7, 7, 2),
(61, 28, '26/11/2020', 'Non', 7, 0, 2),
(62, 44, '26/11/2020', 'Non', 7, 0, 2),
(63, 46, '26/11/2020', 'Non', 7, 0, 2),
(64, 47, '26/11/2020', 'Non', 7, 0, 2),
(65, 38, '26/11/2020', 'Non', 7, 0, 2),
(66, 40, '26/11/2020', 'Non', 7, 0, 2),
(67, 50, '26/11/2020', 'Non', 7, 0, 2),
(68, 51, '26/11/2020', 'Non', 7, 0, 2),
(69, 53, '07/12/2020', 'Non', 6, 0, 4),
(70, 22, '07/12/2020', 'Non', 6, 0, 4),
(71, 48, '07/12/2020', 'Non', 6, 0, 4),
(72, 42, '07/12/2020', 'Non', 6, 0, 4),
(73, 39, '07/12/2020', 'Non', 6, 0, 4),
(74, 24, '07/12/2020', 'Non', 6, 0, 4),
(75, 25, '07/12/2020', 'Non', 6, 0, 4),
(76, 49, '07/12/2020', 'Non', 6, 0, 4),
(77, 27, '07/12/2020', 'Oui', 6, 6, 4),
(78, 52, '07/12/2020', 'Non', 6, 0, 4),
(79, 28, '07/12/2020', 'Non', 6, 0, 4),
(80, 44, '07/12/2020', 'Non', 6, 0, 4),
(81, 46, '07/12/2020', 'Non', 6, 0, 4),
(82, 47, '07/12/2020', 'Non', 6, 0, 4),
(83, 38, '07/12/2020', 'Non', 6, 0, 4),
(84, 40, '07/12/2020', 'Non', 6, 0, 4),
(85, 50, '07/12/2020', 'Non', 6, 0, 4),
(86, 51, '07/12/2020', 'Non', 6, 0, 4),
(87, 53, '20/12/2020', 'Non', 6, 0, 4),
(88, 22, '20/12/2020', 'Non', 6, 0, 4),
(89, 48, '20/12/2020', 'Non', 6, 0, 4),
(90, 42, '20/12/2020', 'Non', 6, 0, 4),
(91, 39, '20/12/2020', 'Non', 6, 0, 4),
(92, 24, '20/12/2020', 'Non', 6, 0, 4),
(93, 25, '20/12/2020', 'Non', 6, 0, 4),
(94, 49, '20/12/2020', 'Non', 6, 0, 4),
(95, 27, '20/12/2020', 'Non', 6, 0, 4),
(96, 52, '20/12/2020', 'Non', 6, 0, 4),
(97, 28, '20/12/2020', 'Non', 6, 0, 4),
(98, 44, '20/12/2020', 'Non', 6, 0, 4),
(99, 46, '20/12/2020', 'Non', 6, 0, 4),
(100, 47, '20/12/2020', 'Non', 6, 0, 4),
(101, 38, '20/12/2020', 'Non', 6, 0, 4),
(102, 40, '20/12/2020', 'Non', 6, 0, 4),
(103, 50, '20/12/2020', 'Non', 6, 0, 4),
(104, 51, '20/12/2020', 'Non', 6, 0, 4),
(105, 53, '24/12/2020', 'Non', 6, 0, 2),
(106, 54, '24/12/2020', 'Non', 6, 0, 2),
(107, 22, '24/12/2020', 'Non', 6, 0, 2),
(108, 48, '24/12/2020', 'Non', 6, 0, 2),
(109, 42, '24/12/2020', 'Non', 6, 0, 2),
(110, 39, '24/12/2020', 'Non', 6, 0, 2),
(111, 24, '24/12/2020', 'Non', 6, 0, 2),
(112, 25, '24/12/2020', 'Non', 6, 0, 2),
(113, 49, '24/12/2020', 'Non', 6, 0, 2),
(114, 27, '24/12/2020', 'Non', 6, 0, 2),
(115, 52, '24/12/2020', 'Non', 6, 0, 2),
(116, 28, '24/12/2020', 'Non', 6, 0, 2),
(117, 44, '24/12/2020', 'Non', 6, 0, 2),
(118, 46, '24/12/2020', 'Non', 6, 0, 2),
(119, 47, '24/12/2020', 'Non', 6, 0, 2),
(120, 38, '24/12/2020', 'Non', 6, 0, 2),
(121, 40, '24/12/2020', 'Non', 6, 0, 2),
(122, 50, '24/12/2020', 'Non', 6, 0, 2),
(123, 51, '24/12/2020', 'Non', 6, 0, 2),
(124, 53, '02/01/2021', 'Non', 7, 0, 3),
(125, 54, '02/01/2021', 'Non', 7, 0, 3),
(126, 22, '02/01/2021', 'Non', 7, 0, 3),
(127, 48, '02/01/2021', 'Non', 7, 0, 3),
(128, 42, '02/01/2021', 'Non', 7, 0, 3),
(129, 39, '02/01/2021', 'Non', 7, 0, 3),
(130, 24, '02/01/2021', 'Non', 7, 0, 3),
(131, 25, '02/01/2021', 'Non', 7, 0, 3),
(132, 49, '02/01/2021', 'Non', 7, 0, 3),
(133, 27, '02/01/2021', 'Non', 7, 0, 3),
(134, 52, '02/01/2021', 'Non', 7, 0, 3),
(135, 28, '02/01/2021', 'Non', 7, 0, 3),
(136, 44, '02/01/2021', 'Non', 7, 0, 3),
(137, 46, '02/01/2021', 'Non', 7, 0, 3),
(138, 47, '02/01/2021', 'Non', 7, 0, 3),
(139, 38, '02/01/2021', 'Non', 7, 0, 3),
(140, 40, '02/01/2021', 'Non', 7, 0, 3),
(141, 50, '02/01/2021', 'Non', 7, 0, 3),
(142, 51, '02/01/2021', 'Non', 7, 0, 3),
(143, 53, '08/01/2021', 'Non', 6, 0, 12),
(144, 54, '08/01/2021', 'Non', 6, 0, 12),
(145, 22, '08/01/2021', 'Non', 6, 0, 12),
(146, 48, '08/01/2021', 'Non', 6, 0, 12),
(147, 42, '08/01/2021', 'Non', 6, 0, 12),
(148, 39, '08/01/2021', 'Non', 6, 0, 12),
(149, 24, '08/01/2021', 'Non', 6, 0, 12),
(150, 25, '08/01/2021', 'Non', 6, 0, 12),
(151, 49, '08/01/2021', 'Non', 6, 0, 12),
(152, 27, '08/01/2021', 'Oui', 6, 8, 12),
(153, 52, '08/01/2021', 'Non', 6, 0, 12),
(154, 28, '08/01/2021', 'Non', 6, 0, 12),
(155, 44, '08/01/2021', 'Non', 6, 0, 12),
(156, 46, '08/01/2021', 'Non', 6, 0, 12),
(157, 47, '08/01/2021', 'Non', 6, 0, 12),
(158, 38, '08/01/2021', 'Non', 6, 0, 12),
(159, 40, '08/01/2021', 'Non', 6, 0, 12),
(160, 50, '08/01/2021', 'Non', 6, 0, 12),
(161, 51, '08/01/2021', 'Non', 6, 0, 12),
(162, 53, '10/01/2021', 'Non', 8, 0, 2),
(163, 54, '10/01/2021', 'Non', 8, 0, 2),
(164, 22, '10/01/2021', 'Non', 8, 0, 2),
(165, 48, '10/01/2021', 'Non', 8, 0, 2),
(166, 42, '10/01/2021', 'Non', 8, 0, 2),
(167, 39, '10/01/2021', 'Non', 8, 0, 2),
(168, 24, '10/01/2021', 'Non', 8, 0, 2),
(169, 25, '10/01/2021', 'Non', 8, 0, 2),
(170, 49, '10/01/2021', 'Non', 8, 0, 2),
(171, 27, '10/01/2021', 'Oui', 8, 8, 2),
(172, 52, '10/01/2021', 'Non', 8, 0, 2),
(173, 28, '10/01/2021', 'Non', 8, 0, 2),
(174, 44, '10/01/2021', 'Non', 8, 0, 2),
(175, 46, '10/01/2021', 'Non', 8, 0, 2),
(176, 47, '10/01/2021', 'Non', 8, 0, 2),
(177, 38, '10/01/2021', 'Non', 8, 0, 2),
(178, 40, '10/01/2021', 'Non', 8, 0, 2),
(179, 50, '10/01/2021', 'Non', 8, 0, 2),
(180, 51, '10/01/2021', 'Non', 8, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_remuneration`
--

CREATE TABLE IF NOT EXISTS `kartable_remuneration` (
  `id_rem` int(11) NOT NULL AUTO_INCREMENT,
  `type_rem` varchar(20) NOT NULL,
  `desc_rem` text NOT NULL,
  `date_rem` varchar(20) NOT NULL,
  `montant_rem` int(15) NOT NULL,
  `devise_rem` varchar(10) NOT NULL,
  `id_personnel` int(11) NOT NULL,
  `mois_rem` varchar(10) NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id_rem`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kartable_remuneration`
--

INSERT INTO `kartable_remuneration` (`id_rem`, `type_rem`, `desc_rem`, `date_rem`, `montant_rem`, `devise_rem`, `id_personnel`, `mois_rem`, `id_admin`) VALUES
(1, 'salaire', 'Some text', '21/12/2020', 200, 'usd', 3, '2020/12', 6),
(2, 'salaire', 'Some note', '22/12/2020', 150, 'usd', 3, '2020/12', 6),
(3, 'salaire', 'This is confirmed', '23/12/2020', 220, 'usd', 1, '2020/12', 6),
(4, 'salaire', 'This is not confirmed', '23/12/2020', 60, 'usd', 1, '2020/12', 6),
(5, 'salaire', 'Not confirmed', '23/12/2020', 150, 'usd', 1, '2020/12', 6),
(6, 'salaire', 'Denied', '23/12/2020', 500, 'usd', 1, '2020/12', 6),
(7, 'prime', '', '23/12/2020', 45, 'usd', 1, '2020/12', 6),
(8, 'salaire', 'Juste un texte', '23/12/2020', 230, 'usd', 5, '2020/12', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kartable_suppression`
--

CREATE TABLE IF NOT EXISTS `kartable_suppression` (
  `id_sup` int(11) NOT NULL AUTO_INCREMENT,
  `table_ref_sup` varchar(20) NOT NULL,
  `id_ref_sup` int(11) NOT NULL,
  `date_sup` int(11) NOT NULL,
  `id_admin_sup` int(11) NOT NULL,
  `somme_ignoree` int(15) NOT NULL,
  `date_operation` varchar(20) NOT NULL,
  PRIMARY KEY (`id_sup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kartable_suppression`
--

INSERT INTO `kartable_suppression` (`id_sup`, `table_ref_sup`, `id_ref_sup`, `date_sup`, `id_admin_sup`, `somme_ignoree`, `date_operation`) VALUES
(1, 'kartable_frais_scola', 19, 1609188450, 6, 0, ''),
(2, 'kartable_frais_scola', 17, 1609189246, 6, 50, '2020/12/14'),
(3, 'kartable_frais_scola', 29, 1609589509, 7, 70, '2020/12/24');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_tuteur`
--

CREATE TABLE IF NOT EXISTS `kartable_tuteur` (
  `id_tuteur` int(11) NOT NULL AUTO_INCREMENT,
  `t_noms` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `t_nationalite` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `t_profession` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `t_adresse` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `t_tel` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_tuteur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `kartable_tuteur`
--

INSERT INTO `kartable_tuteur` (`id_tuteur`, `t_noms`, `t_nationalite`, `t_profession`, `t_adresse`, `t_tel`) VALUES
(15, 'Mango Kapulu Jonas', 'Congolais', 'Chauffeur', '30 / Kotoko / Mapela / Masina / Kinshasa', '0826686661'),
(16, 'Mutwa Gabriel', 'Congolais', 'Musicien', '23 / Kotoko / Mapela / Masina / Kinshasa', '0826686661'),
(17, 'Kabasele Michee', 'Congolais', 'Charpentier', '78 / Kotoko / Mapela / Masina / Kinshasa', '0826686661'),
(18, 'Tambwe Emmanuel', 'Congolais', 'Non dÃ©finie', '100 / Kotoko / Mapela / Masina / Kinshasa', '0826686661'),
(19, 'Falanga Faustin', 'Congolais', 'Non dÃ©finie', '1', '0826686661'),
(20, 'Bamenga Frank', 'Congolais', 'MÃ©canicien', '100 / Kotoko / Mapela / Masina / Kinshasa', '0826686661'),
(21, 'Mbayi Crispin', 'Congolais', 'Enseignant', '100 / Kotoko / Mapela / Masina / Kinshasa', '0826686661'),
(22, '', '', '', '', ''),
(23, '', '', '', '', ''),
(24, 'Kumala', 'Congolais', 'Professeur', '100 / Kotoko / Mapela / Masina / Kinshasa', '0896686661'),
(25, '', '', '', '', ''),
(26, '', '', '', '', ''),
(27, 'kokjoolkl', 'congolaise', 'couture', '4 malj jhiuj', '0815464556'),
(28, 'test sur erreur', 'Congolais', 'Chauffeur', '100 / Kotoko / Mapela / Masina / Kinshasa', '0826738833'),
(29, 'utf iso', 'usa', 'blabla', 'blabla', '0826686661'),
(30, 'test chez ben', 'blabla', 'blabla', 'blabla', '0826768765'),
(31, 'nlk', 'congolaise', 'droit', 'gge', '0816536363'),
(32, 'L?LJHICONG', 'CONG', 'JHB', 'JIK', ''),
(33, 'KILOLO PPA', 'CONGOLAISE', 'Docteur', '20, kwango ', '0816315438'),
(34, 'HUJHIUHI', 'DDD', 'DC', 'D', '081667878'),
(35, 'lala', 'congolaise', 'medecin', 'zzezet', '');

-- --------------------------------------------------------

--
-- Table structure for table `kartable_whosonline`
--

CREATE TABLE IF NOT EXISTS `kartable_whosonline` (
  `online_id` int(11) NOT NULL,
  `online_time` int(11) NOT NULL,
  `online_ip` int(15) NOT NULL,
  PRIMARY KEY (`online_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kartable_whosonline`
--

INSERT INTO `kartable_whosonline` (`online_id`, `online_time`, `online_ip`) VALUES
(8, 1615548734, 2130706433);

-- --------------------------------------------------------

--
-- Table structure for table `messagerie_privee`
--

CREATE TABLE IF NOT EXISTS `messagerie_privee` (
  `id_msg` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL,
  `id_destinateur` int(11) NOT NULL,
  `titre_msg` varchar(100) NOT NULL,
  `contenu_msg` text NOT NULL,
  `date_msg` varchar(20) NOT NULL,
  `lu` varchar(10) NOT NULL,
  PRIMARY KEY (`id_msg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `messagerie_privee`
--

INSERT INTO `messagerie_privee` (`id_msg`, `id_expediteur`, `id_destinateur`, `titre_msg`, `contenu_msg`, `date_msg`, `lu`) VALUES
(1, 6, 7, 'Just a test', 'Salut ðŸ‘‹ Ben, voici un exemple de messagerie Ã©lectronique ðŸ“§ ', '22/12/2020', 'oui'),
(2, 6, 7, 'My second try for the backðŸ¥ˆ ', 'This is the second.. Test it please !!', '22/12/2020 Ã  07:12:', 'oui'),
(3, 6, 6, 'Message to myself', 'j''espÃ¨re que tu es toujours Ã  la maison ðŸ¡ ', '22/12/2020 Ã  07:12:', 'oui'),
(4, 6, 6, 'TroisiÃ¨me test', 'Ceci estest un peu plus de dÃ©tails ', '22/12/2020 Ã  08:12:', 'oui'),
(5, 7, 6, 'salutation', 'bonjour mon cher comment tu vas ?', '22/12/2020 Ã  10:12:', 'oui'),
(6, 6, 7, 'TP IG', 'Osili djÃ  TP ??', '22/12/2020 Ã  10:12:', 'oui'),
(7, 7, 6, 'jhhj', 'bonjour', '02/01/2021 Ã  13:01:', 'oui'),
(8, 7, 6, 'Ofrre N°001/2021', 'salut mon chère comment toi.?', '11/01/2021 à 06:01:0', 'oui'),
(9, 8, 7, 'Offre d''emploie', 'Je suis à la Maison ', '11/01/2021 à 07:01:4', 'oui'),
(10, 6, 8, 'Salutation', 'Bonjour philippe.. ça va ?', '29/01/2021 à 01:01:4', 'oui'),
(11, 6, 7, 'Salutation', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione iure deleniti vel porro cumque ut mollitia, quod totam illum atque provident sunt hic nulla dolores.', '29/01/2021 à 01:01:4', 'oui'),
(12, 6, 8, 'Code de travail', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed tempora officia eum? Est magni voluptas vel dicta eligendi laudantium quo.', '29/01/2021 à 13:01:5', 'oui'),
(13, 6, 8, 'New look in forms', '<strong>Texte en gras </strong>, <u>Je souligne ceci </u>, <span style="color: #3388cc;">Un peu de couleur</span>, [url=www.google.com]En voilà un lien[/url], <em>En fin en italique</em>', '30/01/2021 à 13:01:3', 'oui'),
(14, 6, 8, 'Read it plz', 'Check this message please guy !', '30/01/2021 à 13:01:2', 'oui'),
(15, 6, 8, 'Another one', '    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, modi cumque maiores voluptatum ullam soluta saepe sequi dicta iusto eligendi, a hic facilis!', '30/01/2021 à 14:01:1', 'oui'),
(16, 7, 6, 'salutation', 'BONJOUR MON CHER', '30/01/2021 à 19:01:4', 'oui');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
