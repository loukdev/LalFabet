<?php
include_once("api/bdd.php");
include_once("views/ViewSignIn.class.php");
include_once("views/ViewHome.class.php");
include_once("models/ModelUser.class.php");
include_once("models/ModelArticle.class.php");

$view = NULL;
if(isset($_GET["signin"]))
{
	$view = new ViewSignIn(new ModelUser($_POST));
}
else
{
	$view = new ViewHome();
}

$view->show();
