<?php
include_once('api/IView.class.php');

class ViewConnect implements IView
{
	private $model = NULL;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function show()
	{
		ob_start();

		include_once("templates/begin.php");
		include_once("templates/header.php");
		include_once("templates/connection_section.php");
		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
