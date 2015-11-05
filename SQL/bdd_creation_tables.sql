-- phpMyAdmin SQL Dump
-- version 2.11.9.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2015 at 05:46 PM
-- Server version: 5.0.77
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zfl2-fraboulo`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_compte_cpt`
--

CREATE TABLE IF NOT EXISTS `t_compte_cpt` (
  `cpt_pseudo` varchar(128) NOT NULL,
  `cpt_password` varchar(128) NOT NULL,
  PRIMARY KEY  (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_groupe_grp`
--

CREATE TABLE IF NOT EXISTS `t_groupe_grp` (
  `grp_id` int(11) NOT NULL,
  `grp_niveau` int(11) NOT NULL,
  `grp_acces_petit` char(1) NOT NULL,
  `grp_acces_autre` char(1) NOT NULL,
  PRIMARY KEY  (`grp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `adh_telephone2` char(10) default NULL,
  `adh_telephone3` char(10) default NULL,
  `adh_mail` varchar(128) NOT NULL,
  PRIMARY KEY  (`cpt_pseudo`),
  KEY `adh_cpt_FK` (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_adherent_adh`
--
ALTER TABLE `t_adherent_adh`
  ADD CONSTRAINT `adh_cpt_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`)
  ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `t_abonnement_abo`
--

CREATE TABLE IF NOT EXISTS `t_abonnement_abo` (
  `abo_id` int(11) NOT NULL,
  `abo_debut` date NOT NULL,
  `abo_fin` date NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL,
  `grp_id` int(11) NOT NULL,
  PRIMARY KEY  (`abo_id`),
  KEY `abo_grp_FK` (`grp_id`),
  KEY `abo_adh_FK` (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_abonnement_abo`
--
ALTER TABLE `t_abonnement_abo`
  ADD CONSTRAINT `abo_grp_FK` FOREIGN KEY (`grp_id`) REFERENCES `t_groupe_grp` (`grp_id`)
  ON DELETE CASCADE,
  ADD CONSTRAINT `abo_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`)
  ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `t_actualite_act`
--

CREATE TABLE IF NOT EXISTS `t_actualite_act` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpt_pseudo` varchar(128) NOT NULL,
  `act_titre` varchar(128) NOT NULL,
  `act_contenu` text NOT NULL,
  `act_date` date NOT NULL,
  PRIMARY KEY  (`act_id`),
  KEY `act_adh_FK` (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  ADD CONSTRAINT `act_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`)
  ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `t_commande_cmd`
--

CREATE TABLE IF NOT EXISTS `t_commande_cmd` (
  `cmd_debut` date NOT NULL,
  `cmd_fin` date default NULL,
  PRIMARY KEY  (`cmd_debut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_item_ite`
--

CREATE TABLE IF NOT EXISTS `t_item_ite` (
  `ite_id` int(11) NOT NULL,
  `ite_reference` int(11) NOT NULL,
  `ite_fournisseur` varchar(128) NOT NULL,
  `ite_prix_unitaire` int(11) NOT NULL,
  `ite_description` text,
  PRIMARY KEY  (`ite_id`)
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
  `cit_quantite` int(11) NOT NULL,
  PRIMARY KEY  (`cit_id`),
  KEY `cit_ite_FK` (`ite_id`),
  KEY `cit_adh_FK` (`cpt_pseudo`),
  KEY `cit_cmd_FK` (`cmd_debut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_commande_item_cit`
--
ALTER TABLE `t_commande_item_cit`
  ADD CONSTRAINT `cit_ite_FK` FOREIGN KEY (`ite_id`) REFERENCES `t_item_ite` (`ite_id`)
  ON DELETE CASCADE,
  ADD CONSTRAINT `cit_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`)
  ON DELETE CASCADE,
  ADD CONSTRAINT `cit_cmd_FK` FOREIGN KEY (`cmd_debut`) REFERENCES `t_commande_cmd` (`cmd_debut`)
  ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `t_salle_sal`
--

CREATE TABLE IF NOT EXISTS `t_salle_sal` (
  `sal_nom` varchar(128) NOT NULL,
  `sal_description` text,
  PRIMARY KEY  (`sal_nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_equipement_eqp`
--

CREATE TABLE IF NOT EXISTS `t_equipement_eqp` (
  `eqp_id` int(11) NOT NULL AUTO_INCREMENT,
  `eqp_nom` varchar(128) NOT NULL,
  `sal_nom` varchar(128) default NULL,
  `eqp_niveau` int(11) NOT NULL,
  PRIMARY KEY  (`eqp_id`),
  KEY `eqp_sal_FK` (`sal_nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_equipement_eqp`
--
ALTER TABLE `t_equipement_eqp`
  ADD CONSTRAINT `eqp_sal_FK` FOREIGN KEY (`sal_nom`) REFERENCES `t_salle_sal` (`sal_nom`)
  ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `t_reservation_equipement_req`
--

CREATE TABLE IF NOT EXISTS `t_reservation_equipement_req` (
  `eqp_id` int(11) NOT NULL,
  `req_jour` date NOT NULL,
  `req_horaire` int(11) NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL,
  PRIMARY KEY  (`eqp_id`,`req_jour`,`req_horaire`),
  KEY `req_eqp_FK` (`eqp_id`),
  KEY `req_adh_FK` (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_reservation_equipement_req`
--
ALTER TABLE `t_reservation_equipement_req`
  ADD CONSTRAINT `req_eqp_FK` FOREIGN KEY (`eqp_id`) REFERENCES `t_equipement_eqp` (`eqp_id`)
  ON DELETE CASCADE,
  ADD CONSTRAINT `req_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`)
  ON DELETE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `t_reservation_salle_rsa`
--

CREATE TABLE IF NOT EXISTS `t_reservation_salle_rsa` (
  `rsa_jour` date NOT NULL,
  `rsa_horaire` int(11) NOT NULL,
  `sal_nom` varchar(128) NOT NULL,
  `cpt_pseudo` varchar(128) NOT NULL,
  PRIMARY KEY  (`rsa_jour`,`rsa_horaire`,`sal_nom`),
  KEY `rsa_sal_FK` (`sal_nom`),
  KEY `rsa_adh_FK` (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for table `t_reservation_salle_rsa`
--
ALTER TABLE `t_reservation_salle_rsa`
  ADD CONSTRAINT `rsa_sal_FK` FOREIGN KEY (`sal_nom`) REFERENCES `t_salle_sal` (`sal_nom`)
  ON DELETE CASCADE,
  ADD CONSTRAINT `rsa_adh_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_adherent_adh` (`cpt_pseudo`)
  ON DELETE CASCADE;

--
-- Constraints for dumped tables
--


