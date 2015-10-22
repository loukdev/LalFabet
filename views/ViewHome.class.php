<?php
include_once('api/IView.class.php');
include_once('models/ModelArticle.class.php');

class ViewHome implements IView
{
	public function __construct() {}

	public function show()
	{
		$articles = ModelArticle::getAll();

		ob_start();

		include_once("templates/begin.php");
		include_once("templates/header.php");
		include_once("templates/home_section.php");
		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
