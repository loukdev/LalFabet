<?php
include_once("api/bdd.php");
include_once("views/ViewSignIn.class.php");
include_once("views/ViewHome.class.php");
include_once("models/ModelSignIn.class.php");
include_once("models/ModelHome.class.php");

$view = NULL;
if(isset($_GET["signin"]))
{
	$view = new ViewSignIn(new ModelSignIn($_POST));
}
else
{
	$view = new ViewHome(new ModelArticle());
}

$view->show();

