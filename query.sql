--
-- Table `produit_categorie`
--
CREATE TABLE `produits_categorie` (
`cat_id` int(11) NOT NULL AUTO_INCREMENT,
`cat_nom` varchar(30) collate latin1_general_ci NOT NULL,
`cat_ordre` int(11) NOT NULL,
PRIMARY KEY (`cat_id`),
UNIQUE KEY `cat_ordre` (`cat_ordre`)
);
--
-- Table `produit_produit`
--
CREATE TABLE `produits` (
`produit_id` int(11) NOT NULL AUTO_INCREMENT,
`produit_cat_id` mediumint(8) NOT NULL,
`produit_nom` varchar(30) collate latin1_general_ci NOT NULL,
`produit_desc` text collate latin1_general_ci NOT NULL,
`produit_ordre` mediumint(8) NOT NULL,
`produit_last_cmd_id` int(11) NOT NULL,
`produit_article` mediumint(8) NOT NULL,
`produit_cmd` mediumint(8) NOT NULL,
`auth_cmd` tinyint(4) NOT NULL,
`auth_article` tinyint(4) NOT NULL,
PRIMARY KEY (`produit_id`)
);
--
-- Table `produit_clients`
--
CREATE TABLE `client` (
`client_id` int(11) NOT NULL AUTO_INCREMENT,
`client_noms` varchar(30) collate latin1_general_ci NOT NULL,
`client_descr` varchar(250) collate latin1_general_ci NOT NULL,
`client_photo` varchar(100) collate latin1_general_ci NOT NULL,
`client_first_connect` int(11) NOT NULL,
`client_last_connect` int(11) NOT NULL,
`client_cmd` int(11) NOT NULL,
`client_coord` int(11) NOT NULL,
PRIMARY KEY (`client_id`),
FOREIGN KEY('client_coord') REFERENCES 'coordonnees'('coordo_id')
);
--
-- Table `coordonnées`
--
CREATE TABLE `coordonnees` (
`coordo_id` int(11) NOT NULL AUTO_INCREMENT,
`coordo_ville` varchar(30) collate latin1_general_ci NOT NULL,
`coordo_adresse` varchar(32) collate latin1_general_ci NOT NULL,
`coordo_email` varchar(250) collate latin1_general_ci NOT NULL,
`coordo_telephone` int(11) NOT NULL,
`coordo_description` varchar(100) collate latin1_general_ci NOT NULL,
PRIMARY KEY (`coordo_id`)
);
--
-- Table `post`
--
CREATE TABLE `commande` (
`cmd_id` int(11) NOT NULL AUTO_INCREMENT,
`cmd_createur` int(11) NOT NULL,
`cmd_code` char(60) collate latin1_general_ci NOT NULL,
`cmd_quantite` int(11) NOT NULL,
`cmd_description` char(60) collate latin1_general_ci NOT NULL,
`cmd_date` int(11) NOT NULL,
`article_id` int(11) NOT NULL,
`cmd_produit_id` int(11) NOT NULL,
`picture` varchar(100) collate latin1_general_ci NOT NULL,
PRIMARY KEY (`cmd_id`)
);
--
-- Table `article`
--
CREATE TABLE `article` (
`article_id` int(11) NOT NULL AUTO_INCREMENT,
`produit_id` int(11) NOT NULL,
`article_code` char(60) collate latin1_general_ci NOT NULL,
`article_libelle` varchar(30) collate latin1_general_ci NOT NULL,
`article_prix_unitaire` int(11) NOT NULL AUTO_INCREMENT,
`article_description` text collate latin1_general_ci NOT NULL,
`article_date` int(11) NOT NULL,
`article_genre` varchar(30) collate latin1_general_ci NOT NULL,
`article_last_cmd` int(11) NOT NULL,
`article_first_cmd` int(11) NOT NULL,
`article_cmd` mediumint(8) NOT NULL,
`article_createur` int(11) NOT NULL,
PRIMARY KEY (`article_id`),
UNIQUE KEY `article_last_cmd` (`article_last_cmd`)
);