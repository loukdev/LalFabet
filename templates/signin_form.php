
<!-- formulaire d'inscription -->
<form id="inscription_form" method="post" action="?signin">
    <label for="cpt_pseudo">Identifiant* :</label>
    <input type="text" name="cpt_pseudo" id="cpt_pseudo" value="<?php echo $this->get("cpt_pseudo")?>" /> <br />

    <label for="cpt_password">Mot de passe* :</label>
    <input type="password" name="cpt_password" id="cpt_password" value="<?php echo $this->get("cpt_password")?>" /> <br />

    <label for="adh_prenom">Prénom* :</label>
    <input type="text" name="adh_prenom" id="adh_prenom" value="<?php echo $this->get("adh_prenom")?>" /> <br />

    <label for="adh_nom">Nom* :</label>
    <input type="text" name="adh_nom" id="adh_nom" value="<?php echo $this->get("adh_nom")?>" /> <br />

    <label for="adh_date_naissance">Date de naissance* :</label>
    <input type="date" name="adh_date_naissance" id="adh_date_naissance" value="<?php echo $this->get("adh_date_naissance")?>" /> <br />

    <label for="adh_rue">Rue :</label>
    <input type="text" name="adh_rue" id="adh_rue" value="<?php echo $this->get("adh_rue")?>" />
    <label for="adh_num_rue">Numéro de rue* :</label>
    <input type="number" name="adh_num_rue" id="adh_num_rue" value="<?php echo $this->get("adh_num_rue")?>" /> <br />

    <label for="adh_code_postal">Code postal* :</label>
    <input type="text" name="adh_code_postal" id="adh_code_postal" value="<?php echo $this->get("adh_code_postal")?>" />
    <label for="adh_ville">Ville :</label>
    <input type="text" name="adh_ville" id="adh_ville" value="<?php echo $this->get("adh_ville")?>" /> <br />

    <label for="adh_telephone1">Téléphone 1* :</label>
    <input type="text" name="adh_telephone1" id="adh_telephone1" value="<?php echo $this->get("adh_telephone1")?>" />
    <label for="adh_telephone2">Téléphone 2 :</label>
    <input type="text" name="adh_telephone2" id="adh_telephone2" value="<?php echo $this->get("adh_telephone2")?>" />
    <label for="adh_telephone3">Téléphone 3 :</label>
    <input type="text" name="adh_telephone3" id="adh_telephone3" value="<?php echo $this->get("adh_telephone3")?>" /> <br />

    <label for="adh_mail">E-mail* :</label>
    <input type="mail" name="adh_mail" id="adh_mail" value="<?php echo $this->get("adh_mail")?>" /> <br />
    
    <input type="submit" value="S'inscrire" />
</form>