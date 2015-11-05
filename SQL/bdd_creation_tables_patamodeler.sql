-- Généré par Oracle SQL Developer Data Modeler 4.1.1.888
--   à :        2015-10-01 20:01:59 CEST
--   site :      Oracle Database 11g
--   type :      Oracle Database 11g

SET storage_engine=INNODB;

CREATE TABLE t_abonnement_abo
  (
    abo_id    INTEGER NOT NULL ,
    abo_debut DATE NOT NULL ,
    abo_fin   DATE NOT NULL ,
    cpt_login VARCHAR (128) NOT NULL ,
    grp_id    INTEGER NOT NULL
  ) ;
ALTER TABLE t_abonnement_abo ADD CONSTRAINT abo_PK PRIMARY KEY ( abo_id, cpt_login ) ;


CREATE TABLE t_actualite_act
  (
    act_id    INTEGER NOT NULL ,
    cpt_login VARCHAR (128) NOT NULL ,
    act_contenu TEXT NOT NULL ,
    act_date DATE NOT NULL
  ) ;
ALTER TABLE t_actualite_act ADD CONSTRAINT act_PK PRIMARY KEY ( act_id ) ;


CREATE TABLE t_adherent_adh
  (
    cpt_login          VARCHAR (128) NOT NULL ,
    adh_nom            VARCHAR (128) NOT NULL ,
    adh_prenom         VARCHAR (128) NOT NULL ,
    adh_date_naissance DATE NOT NULL ,
    adh_rue            INTEGER NOT NULL ,
    adh_code_postal    CHAR (5) NOT NULL ,
    adh_ville          VARCHAR (128) NOT NULL ,
    adh_telephone      CHAR (10) NOT NULL ,
    adh_mail           VARCHAR (128) NOT NULL
  ) ;
ALTER TABLE t_adherent_adh ADD CONSTRAINT adh_PK PRIMARY KEY ( cpt_login ) ;


CREATE TABLE t_commande_cmd
  ( cmd_debut DATE NOT NULL , cmd_fin DATE
  ) ;
ALTER TABLE t_commande_cmd ADD CONSTRAINT cmd_PK PRIMARY KEY ( cmd_debut ) ;


CREATE TABLE t_commande_item_cit
  (
    cit_id       INTEGER NOT NULL ,
    cmd_debut    DATE NOT NULL ,
    ite_id       INTEGER NOT NULL ,
    cpt_login    VARCHAR (128) NOT NULL ,
    cit_quantite INTEGER NOT NULL
  ) ;
ALTER TABLE t_commande_item_cit ADD CONSTRAINT cit_PK PRIMARY KEY ( cit_id ) ;


CREATE TABLE t_compte_cpt
  (
    cpt_login    VARCHAR (128) NOT NULL ,
    cpt_password VARCHAR (128) NOT NULL
  ) ;
ALTER TABLE t_compte_cpt ADD CONSTRAINT cpt_PK PRIMARY KEY ( cpt_login ) ;


CREATE TABLE t_equipement_eqp
  (
    eqp_id       INTEGER NOT NULL ,
    eqp_moveable CHAR (1) NOT NULL ,
    sal_nom      VARCHAR (128) NOT NULL ,
    eqp_nom      VARCHAR (128) NOT NULL ,
    eqp_niveau   INTEGER NOT NULL
  ) ;
ALTER TABLE t_equipement_eqp ADD CONSTRAINT eqp_PK PRIMARY KEY ( eqp_id ) ;


CREATE TABLE t_groupe_grp
  (
    grp_id     INTEGER NOT NULL ,
    grp_niveau INTEGER NOT NULL
  ) ;
ALTER TABLE t_groupe_grp ADD CONSTRAINT grp_PK PRIMARY KEY ( grp_id ) ;


CREATE TABLE t_item_ite
  (
    ite_id            INTEGER NOT NULL ,
    ite_reference     INTEGER NOT NULL ,
    ite_fournisseur   VARCHAR (128) NOT NULL ,
    ite_prix_unitaire INTEGER NOT NULL ,
    ite_description TEXT
  ) ;
ALTER TABLE t_item_ite ADD CONSTRAINT ite_PK PRIMARY KEY ( ite_id ) ;


CREATE TABLE t_reservation_equipement_req
  (
    eqp_id      INTEGER NOT NULL ,
    req_jour    DATE NOT NULL ,
    req_horaire INTEGER NOT NULL ,
    cpt_login   VARCHAR (128) NOT NULL
  ) ;
ALTER TABLE t_reservation_equipement_req ADD CONSTRAINT req_PK PRIMARY KEY ( eqp_id, req_jour, req_horaire ) ;


CREATE TABLE t_reservation_salle_rsa
  (
    rsa_jour    DATE NOT NULL ,
    rsa_horaire INTEGER NOT NULL ,
    sal_nom     VARCHAR (128) NOT NULL ,
    cpt_login   VARCHAR (128) NOT NULL
  ) ;
ALTER TABLE t_reservation_salle_rsa ADD CONSTRAINT rsa_PK PRIMARY KEY ( rsa_jour, rsa_horaire, sal_nom ) ;


CREATE TABLE t_salle_sal
  (
    sal_nom VARCHAR (128) NOT NULL ,
    sal_description TEXT
  ) ;
ALTER TABLE t_salle_sal ADD CONSTRAINT sal_PK PRIMARY KEY ( sal_nom ) ;

ALTER TABLE t_abonnement_abo ADD CONSTRAINT abo_adh_FK FOREIGN KEY ( cpt_login ) REFERENCES t_adherent_adh ( cpt_login ) ;

ALTER TABLE t_abonnement_abo ADD CONSTRAINT abo_grp_FK FOREIGN KEY ( grp_id ) REFERENCES t_groupe_grp ( grp_id ) ;

ALTER TABLE t_actualite_act ADD CONSTRAINT act_adh_FK FOREIGN KEY ( cpt_login ) REFERENCES t_adherent_adh ( cpt_login ) ;

ALTER TABLE t_adherent_adh ADD CONSTRAINT adh_cpt_FK FOREIGN KEY ( cpt_login ) REFERENCES t_compte_cpt ( cpt_login ) ;

ALTER TABLE t_commande_item_cit ADD CONSTRAINT cit_adh_FK FOREIGN KEY ( cpt_login ) REFERENCES t_adherent_adh ( cpt_login ) ;

ALTER TABLE t_commande_item_cit ADD CONSTRAINT cit_cmd_FK FOREIGN KEY ( cmd_debut ) REFERENCES t_commande_cmd ( cmd_debut ) ;

ALTER TABLE t_commande_item_cit ADD CONSTRAINT cit_ite_FK FOREIGN KEY ( ite_id ) REFERENCES t_item_ite ( ite_id ) ;

ALTER TABLE t_equipement_eqp ADD CONSTRAINT eqp_sal_FK FOREIGN KEY ( sal_nom ) REFERENCES t_salle_sal ( sal_nom ) ;

ALTER TABLE t_reservation_equipement_req ADD CONSTRAINT req_adh_FK FOREIGN KEY ( cpt_login ) REFERENCES t_adherent_adh ( cpt_login ) ;

ALTER TABLE t_reservation_equipement_req ADD CONSTRAINT req_eqp_FK FOREIGN KEY ( eqp_id ) REFERENCES t_equipement_eqp ( eqp_id ) ;

ALTER TABLE t_reservation_salle_rsa ADD CONSTRAINT rsa_adh_FK FOREIGN KEY ( cpt_login ) REFERENCES t_adherent_adh ( cpt_login ) ;

ALTER TABLE t_reservation_salle_rsa ADD CONSTRAINT rsa_sal_FK FOREIGN KEY ( sal_nom ) REFERENCES t_salle_sal ( sal_nom ) ;


-- Rapport récapitulatif d'Oracle SQL Developer Data Modeler : 
-- 
-- CREATE TABLE                            12
-- CREATE INDEX                             0
-- ALTER TABLE                             24
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
