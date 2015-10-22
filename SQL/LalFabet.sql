-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2015 at 06:48  
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LalFabet`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_abonnement_abo`
--

CREATE TABLE IF NOT EXISTS `t_abonnement_abo` (
  `abo_id` int(11) NOT NULL,
  `abo_debut` date NOT NULL,
  `abo_fin` date NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL,
  `grp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_actualite_act`
--

CREATE TABLE IF NOT EXISTS `t_actualite_act` (
  `act_id` int(11) NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL,
  `act_titre` varchar(128) NOT NULL,
  `act_contenu` text NOT NULL,
  `act_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_actualite_act`
--

INSERT INTO `t_actualite_act` (`act_id`, `cpt_pseudo`, `act_titre`, `act_contenu`, `act_date`) VALUES
(1, 'loukiluk', 'Le site est en construction !', 'Bienvenue sur le site de LalFabet qui est actuellement en développement !', '2015-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `t_adherent_adh`
--

CREATE TABLE IF NOT EXISTS `t_adherent_adh` (
  `cpt_pseudo` varchar(128) NOT NULL,
  `adh_nom` varchar(128) NOT NULL,
  `adh_prenom` varchar(128) NOT NULL,
  `adh_date_naissance` date NOT NULL,
  `adh_rue` varchar(128) NOT NULL,
  `adh_num_rue` int(11) NOT NULL,
  `adh_code_postal` char(5) NOT NULL,
  `adh_ville` varchar(128) NOT NULL,
  `adh_telephone1` char(10) NOT NULL,
  `adh_telephone2` char(10) DEFAULT NULL,
  `adh_telephone3` char(10) DEFAULT NULL,
  `adh_mail` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_adherent_adh`
--

INSERT INTO `t_adherent_adh` (`cpt_pseudo`, `adh_nom`, `adh_prenom`, `adh_date_naissance`, `adh_rue`, `adh_num_rue`, `adh_code_postal`, `adh_ville`, `adh_telephone1`, `adh_telephone2`, `adh_telephone3`, `adh_mail`) VALUES
('loukiluk', 'Louka', 'Fraboulet', '1995-02-11', 'Edouard Corps-à-bière', 42, '29200', 'Brest', '0296159501', NULL, NULL, 'hihi@rofl.ninja'),
('Shumush', 'Arthur', 'Blanleuil', '1995-01-02', 'harteloire', 12, '29200', 'Brest', '0296159506', NULL, NULL, 'hehe@rofl.ninja');

-- --------------------------------------------------------

--
-- Table structure for table `t_commande_cmd`
--

CREATE TABLE IF NOT EXISTS `t_commande_cmd` (
  `cmd_debut` date NOT NULL,
  `cmd_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_commande_item_cit`
--

CREATE TABLE IF NOT EXISTS `t_commande_item_cit` (
  `cit_id` int(11) NOT NULL,
  `cmd_debut` date NOT NULL,
  `ite_id` int(11) NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL,
  `cit_quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_compte_cpt`
--

CREATE TABLE IF NOT EXISTS `t_compte_cpt` (
  `cpt_pseudo` varchar(128) NOT NULL,
  `cpt_password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_pseudo`, `cpt_password`) VALUES
('loukiluk', 'abs(-sqrt(-52))'),
('Shumush', 'l33tsp!k');

-- --------------------------------------------------------

--
-- Table structure for table `t_equipement_eqp`
--

CREATE TABLE IF NOT EXISTS `t_equipement_eqp` (
  `eqp_id` int(11) NOT NULL,
  `eqp_nom` varchar(128) NOT NULL,
  `sal_nom` varchar(128) DEFAULT NULL,
  `eqp_niveau` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_equipement_eqp`
--

INSERT INTO `t_equipement_eqp` (`eqp_id`, `eqp_nom`, `sal_nom`, `eqp_niveau`) VALUES
(1, 'Imprimante 3D 1', NULL, 1),
(2, 'Imprimante 3D 2', NULL, 1),
(3, 'Imprimante 3D 3', NULL, 1),
(4, 'Imprimante 3D 4', NULL, 1),
(5, 'Imprimante 3D 5', NULL, 1),
(6, 'Plastifieuse A3', NULL, 1),
(7, 'Decoupeuse vinyle', NULL, 1),
(8, 'Boite à outils 1', NULL, 1),
(9, 'Boite à outils 2', NULL, 1),
(10, 'Fer à souder 1', NULL, 1),
(11, 'Fer à souder 2', NULL, 1),
(12, 'Fer à souder 3', NULL, 1),
(13, 'Fer à souder 4', NULL, 1),
(14, 'Fer à souder 5', NULL, 1),
(15, 'Badgeuse', NULL, 1),
(16, 'Projo', NULL, 1),
(17, 'Ecran', NULL, 1),
(18, 'PC 1', NULL, 1),
(19, 'PC 2', NULL, 1),
(20, 'PC 3', NULL, 1),
(21, 'PC 4', NULL, 1),
(22, 'PC 5', NULL, 1),
(23, 'PC 6', NULL, 1),
(24, 'PC 7', NULL, 1),
(25, 'PC 8', NULL, 1),
(26, 'PC 9', NULL, 1),
(27, 'PC 10', NULL, 1),
(28, 'Fraiseuse', 'atelier 2', 2),
(29, 'Tour', 'atelier 2', 2),
(30, 'Scie circulaire', 'atelier 2', 2),
(31, 'Découpeuse laser', 'atelier 2', 2),
(32, 'Perceuse à colonne', 'atelier 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_groupe_grp`
--

CREATE TABLE IF NOT EXISTS `t_groupe_grp` (
  `grp_id` int(11) NOT NULL,
  `grp_niveau` int(11) NOT NULL,
  `grp_acces_petit` char(1) NOT NULL,
  `grp_acces_autre` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_groupe_grp`
--

INSERT INTO `t_groupe_grp` (`grp_id`, `grp_niveau`, `grp_acces_petit`, `grp_acces_autre`) VALUES
(0, 255, '1', '1'),
(1, 2, '1', '0'),
(2, 1, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `t_item_ite`
--

CREATE TABLE IF NOT EXISTS `t_item_ite` (
  `ite_id` int(11) NOT NULL,
  `ite_reference` int(11) NOT NULL,
  `ite_fournisseur` varchar(128) NOT NULL,
  `ite_prix_unitaire` int(11) NOT NULL,
  `ite_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_reservation_equipement_req`
--

CREATE TABLE IF NOT EXISTS `t_reservation_equipement_req` (
  `eqp_id` int(11) NOT NULL,
  `req_jour` date NOT NULL,
  `req_horaire` int(11) NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_reservation_salle_rsa`
--

CREATE TABLE IF NOT EXISTS `t_reservation_salle_rsa` (
  `rsa_jour` date NOT NULL,
  `rsa_horaire` int(11) NOT NULL,
  `sal_nom` varchar(128) NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_salle_sal`
--

CREATE TABLE IF NOT EXISTS `t_salle_sal` (
  `sal_nom` varchar(128) NOT NULL,
  `sal_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_salle_sal`
--

INSERT INTO `t_salle_sal` (`sal_nom`, `sal_description`) VALUES
('atelier 1', 'Contient des équipements mobiles.'),
('atelier 2', 'Contient les équipements fixes.'),
('atelier 3', 'Contient des équipements mobiles.'),
('coworking', 'Salle de coworking.'),
('peda 1', 'Salle de pédagogie.'),
('peda 2', 'Salle de pédagogie.'),
('showroom', 'Salle de démonstration.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_abonnement_abo`
--
ALTER TABLE `t_abonnement_abo`
  ADD PRIMARY KEY (`abo_id`),
  ADD KEY `abo_adh_FK` (`cpt_pseudo`),
  ADD KEY `abo_grp_FK` (`grp_id`);

--
-- Indexes for table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `act_adh_FK` (`cpt_pseudo`);

--
-- Indexes for table `t_adherent_adh`
--
ALTER TABLE `t_adherent_adh`
  ADD PRIMARY KEY (`cpt_pseudo`);

--
-- Indexes for table `t_commande_cmd`
--
ALTER TABLE `t_commande_cmd`
  ADD PRIMARY KEY (`cmd_debut`);

--
-- Indexes for table `t_commande_item_cit`
--
ALTER TABLE `t_commande_item_cit`
  ADD PRIMARY KEY (`cit_id`),
  ADD KEY `cit_adh_FK` (`cpt_pseudo`),
  ADD KEY `cit_cmd_FK` (`cmd_debut`),
  ADD KEY `cit_ite_FK` (`ite_id`);

--
-- Indexes for table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`cpt_pseudo`);

--
-- Indexes for table `t_equipement_eqp`
--
ALTER TABLE `t_equipement_eqp`
  ADD PRIMARY KEY (`eqp_id`),
  ADD KEY `eqp_sal_FK` (`sal_nom`);

--
-- Indexes for table `t_groupe_grp`
--
ALTER TABLE `t_groupe_grp`
  ADD PRIMARY KEY (`grp_id`);

--
-- Indexes for table `t_item_ite`
--
ALTER TABLE `t_item_ite`
  ADD PRIMARY KEY (`ite_id`);

--
-- Indexes for table `t_reservation_equipement_req`
--
ALTER TABLE `t_reservation_equipement_req`
  ADD PRIMARY KEY (`eqp_id`,`req_jour`,`req_horaire`),
  ADD KEY `req_adh_FK` (`cpt_pseudo`),
  ADD KEY `req_eqp_FK` (`eqp_id`);

--
-- Indexes for table `t_reservation_salle_rsa`
--
ALTER TABLE `t_reservation_salle_rsa`
  ADD PRIMARY KEY (`rsa_jour`,`rsa_horaire`,`sal_nom`),
  ADD KEY `rsa_adh_FK` (`cpt_pseudo`),
  ADD KEY `rsa_sal_FK` (`sal_nom`);

--
-- Indexes for table `t_salle_sal`
--
ALTER TABLE `t_salle_sal`
  ADD PRIMARY KEY (`sal_nom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_equipement_eqp`
--
ALTER TABLE `t_equipement_eqp`
  MODIFY `eqp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_abonnement_abo`
--
ALTER TABLE `t_abonnement_abo`
  ADD CONSTRAINT `abo_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `abo_grp_FK` FOREIGN KEY (`grp_id`) REFERENCES `t_groupe_grp` (`grp_id`) ON DELETE CASCADE;

--
-- Constraints for table `t_adherent_adh`
--
ALTER TABLE `t_adherent_adh`
  ADD CONSTRAINT `adh_cpt_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`) ON DELETE CASCADE;

--
-- Constraints for table `t_commande_item_cit`
--
ALTER TABLE `t_commande_item_cit`
  ADD CONSTRAINT `cit_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `cit_cmd_FK` FOREIGN KEY (`cmd_debut`) REFERENCES `t_commande_cmd` (`cmd_debut`) ON DELETE CASCADE,
  ADD CONSTRAINT `cit_ite_FK` FOREIGN KEY (`ite_id`) REFERENCES `t_item_ite` (`ite_id`) ON DELETE CASCADE;

--
-- Constraints for table `t_equipement_eqp`
--
ALTER TABLE `t_equipement_eqp`
  ADD CONSTRAINT `eqp_sal_FK` FOREIGN KEY (`sal_nom`) REFERENCES `t_salle_sal` (`sal_nom`) ON DELETE CASCADE;

--
-- Constraints for table `t_reservation_equipement_req`
--
ALTER TABLE `t_reservation_equipement_req`
  ADD CONSTRAINT `req_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `req_eqp_FK` FOREIGN KEY (`eqp_id`) REFERENCES `t_equipement_eqp` (`eqp_id`) ON DELETE CASCADE;

--
-- Constraints for table `t_reservation_salle_rsa`
--
ALTER TABLE `t_reservation_salle_rsa`
  ADD CONSTRAINT `rsa_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `rsa_sal_FK` FOREIGN KEY (`sal_nom`) REFERENCES `t_salle_sal` (`sal_nom`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
