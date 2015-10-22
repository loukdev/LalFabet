<section>
  <!-- formulaire d'inscription -->
  <form id="inscription_form" method="post" action="inscription.php">
      <label for="pseudo">Identifiant :</label>
      <input type="text" name="pseudo" id="pseudo" value="<?=this->get("pseudo")?>" /> <br />

      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" value="<?=this->get("password")?>" /> <br />

      <label for="prenom">Prénom :</label>
      <input type="text" name="prenom" id="prenom" value="<?=this->get("prenom")?>" /> <br />

      <label for="nom">Nom :</label>
      <input type="text" name="nom" id="nom" value="<?=this->get("nom")?>" /> <br />

      <label for="date">Date de naissance :</label>
      <input type="date" name="date" id="date" value="<?=this->get("date")?>" /> <br />

      <label for="rue">Rue :</label>
      <input type="text" name="rue" id="rue" value="<?=this->get("rue")?>" />
      <label for="numrue">Numéro de rue :</label>
      <input type="number" name="numrue" id="numrue" value="<?=this->get("numrue")?>" /> <br />

      <label for="codepostal">Code postal :</label>
      <input type="text" name="codepostal" id="codepostal" value="<?=this->get("codepostal")?>" />
      <label for="ville">Ville :</label>
      <input type="text" name="ville" id="ville" value="<?=this->get("ville")?>" /> <br />

      <label for="telephone1">Téléphone 1 :</label>
      <input type="text" name="telephone1" id="telephone1" value="<?=this->get("telephone1")?>" />
      <label for="telephone2">Téléphone 2 :</label>
      <input type="text" name="telephone2" id="telephone2" value="<?=this->get("telephone2")?>" /> <br />

      <label for="email">E-mail :</label>
      <input type="email" name="email" id="email" value="<?=this->get("email")?>" /> <br />
      
      <input type="submit" value="S'inscrire" />
  <form>
</section>
