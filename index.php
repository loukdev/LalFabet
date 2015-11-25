<?php
session_start();

include_once("views/ViewSignIn.class.php");
include_once("views/ViewHome.class.php");
include_once("views/ViewUser.class.php");
include_once("views/ViewConnect.class.php");
include_once("models/ModelUser.class.php");

$view = NULL;
if(isset($_GET["signin"]))	// Page d'inscription.
{
	$view = new ViewSignIn(ModelUser::signIn($_POST));
}
else if (isset($_GET['user']))	// Page d'aperçu des données d'utilisateur.
{
	$view = new ViewUser(ModelUser::getUser($_GET['user']));
}
else if (isset($_GET['connect']))	// Page de connexion.
{
  if (isset($_POST['cpt_pseudo']) and isset($_POST['cpt_password']))	// Si les données POST existent,
    $view = new ViewConnect(ModelUser::tryConnect($_POST));				// on tente la connexion.
  else																	// Sinon,
    $view = new ViewConnect(new ModelUser(array()));					// on crée la vue avec des données vides.
}
else if (isset($_GET['disconnect']))	// Page de déconnexion.
{
  if (isset($_SESSION['cpt_pseudo']))	// Si un utilisateur est connecté,
    session_unset();					// on le déconnecte.

  $view = new ViewHome();				// On crée une vue d'accueil.
}
else
{
	$view = new ViewHome();
}

$view->show();
