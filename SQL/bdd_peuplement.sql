--
-- Dumping data for table `t_groupe_grp`
--

INSERT INTO `t_groupe_grp` (`grp_id`, `grp_niveau`, `grp_acces_petit`, `grp_acces_autre`) VALUES
(0, 255, '1', '1'),
(1, 2, '1', '0'),
(2, 1, '0', '0');

--
-- Dumping data for table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_pseudo`, `cpt_password`) VALUES
('loukiluk', 'abs(-sqrt(-52))'),
('Shumush', 'l33tsp!k');

--
-- Dumping data for table `t_adherent_adh`
--

INSERT INTO `t_adherent_adh` (`cpt_pseudo`, `adh_nom`, `adh_prenom`, `adh_date_naissance`, `adh_rue`, `adh_num_rue`, `adh_code_postal`, `adh_ville`, `adh_telephone1`, `adh_mail`) VALUES
('loukiluk', 'Louka', 'Fraboulet', '1995-02-11', 'Edouard Corps-à-bière', 42, '29200', 'Brest', '0296159501', 'hihi@rofl.ninja'),
('Shumush', 'Arthur', 'Blanleuil', '1995-01-02', 'harteloire', 12, '29200', 'Brest', '0296159506', 'hehe@rofl.ninja');

--
-- Dumping data for table `t_abonnement_abo`
--

INSERT INTO `t_abonnement_abo` (`abo_id`, `abo_debut`, `abo_fin`, `cpt_pseudo`, `grp_id`) VALUES
(0, '2000-01-01', '2000-12-31', 'loukiluk', 0);

--
-- Dumping data for table `t_actualite_act`
--
INSERT INTO `t_actualite_act` (`cpt_pseudo`, `act_titre`, `act_contenu`, `act_date`) VALUES
('loukiluk', 'Le site est en construction !', 'Bienvenue sur le site de LalFabet qui est actuellement en développement !', CURRENT_DATE());

--
-- Dumping data for table `t_commande_cmd`
--


--
-- Dumping data for table `t_item_ite`
--


--
-- Dumping data for table `t_commande_item_cit`
--


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
-- Dumping data for table `t_equipement_eqp`
--

INSERT INTO `t_equipement_eqp` (`eqp_nom`, `sal_nom`, `eqp_niveau`) VALUES
('Imprimante 3D 1', NULL, 1),
('Imprimante 3D 2', NULL, 1),
('Imprimante 3D 3', NULL, 1),
('Imprimante 3D 4', NULL, 1),
('Imprimante 3D 5', NULL, 1),
('Plastifieuse A3', NULL, 1),
('Decoupeuse vinyle', NULL, 1),
('Boite à outils 1', NULL, 1),
('Boite à outils 2', NULL, 1),
('Fer à souder 1', NULL, 1),
('Fer à souder 2', NULL, 1),
('Fer à souder 3', NULL, 1),
('Fer à souder 4', NULL, 1),
('Fer à souder 5', NULL, 1),
('Badgeuse', NULL, 1),
('Projo', NULL, 1),
('Ecran', NULL, 1),
('PC 1', NULL, 1),
('PC 2', NULL, 1),
('PC 3', NULL, 1),
('PC 4', NULL, 1),
('PC 5', NULL, 1),
('PC 6', NULL, 1),
('PC 7', NULL, 1),
('PC 8', NULL, 1),
('PC 9', NULL, 1),
('PC 10', NULL, 1),
('Fraiseuse', 'atelier 2', 2),
('Tour', 'atelier 2', 2),
('Scie circulaire', 'atelier 2', 2),
('Découpeuse laser', 'atelier 2', 2),
('Perceuse à colonne', 'atelier 2', 2);

--
-- Dumping data for table `t_reservation_equipement_req`
--

INSERT INTO `t_reservation_equipement_req` VALUES (1, CURRENT_DATE(), 22, 'loukiluk');

--
-- Dumping data for table `t_reservation_salle_rsa`
--

