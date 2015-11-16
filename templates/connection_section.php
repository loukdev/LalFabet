<section>
<?php 

if ($this->model->hasErrors())
{
  ?>
 
   <form style="margin: auto; margin-top: 50px; width: 400px; text-align: center;" id="inscription_form" method="post" action="?connect">
  <span style="color: red;">Identifiants non valides.</span><br/>
     <label for="cpt_pseudo">Identifiant :</label>
      <input type="text" name="cpt_pseudo" id="cpt_pseudo" /> <br />

      <label for="cpt_password">Mot de passe :</label>
      <input type="password" name="cpt_password" id="cpt_password" /> <br />
      <input type="submit" value="Se connecter" />
    </form>
  <?php
}
else
{
  if (!isset($_POST['cpt_pseudo']))
  {
    ?>
    <form style="margin: auto; margin-top: 50px; width: 400px; text-align: center;" id="inscription_form" method="post" action="?connect">
      <label for="cpt_pseudo">Identifiant :</label>
      <input type="text" name="cpt_pseudo" id="cpt_pseudo" /> <br />

      <label for="cpt_password">Mot de passe :</label>
      <input type="password" name="cpt_password" id="cpt_password" /> <br />
      <input type="submit" value="Se connecter" />
    </form>
    <?php
  }
  else
  {
	  session_start();
    $_SESSION["cpt_pseudo"] = $this->model->cpt_pseudo;
    header("Location: ?user=" . $this->model->cpt_pseudo);
  }
}

?>
</section>
