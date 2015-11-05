<?php
session_start();

include_once("api/bdd.php");
include_once("views/ViewSignIn.class.php");
include_once("views/ViewHome.class.php");
include_once("views/ViewUser.class.php");
include_once("views/ViewConnect.class.php");
include_once("models/ModelUser.class.php");
include_once("models/ModelArticle.class.php");

$view = NULL;
if(isset($_GET["signin"]))
{
	$view = new ViewSignIn(ModelUser::signIn($_POST));
}
else if (isset($_GET['user']))
{
	$view = new ViewUser(ModelUser::getUser($_GET['user']));
}
else if (isset($_GET['connect']))
{
  if (isset($_POST['cpt_pseudo']) and isset($_POST['cpt_password']))
    $view = new ViewConnect(ModelUser::tryConnect($_POST));
  else
    $view = new ViewConnect(new ModelUser(array()));
}
else if (isset($_GET['disconnect']))
{
  if (isset($_SESSION['cpt_pseudo']))
    session_unset();

  $view = new ViewHome();
}
else
{
	$view = new ViewHome();
}

$view->show();
