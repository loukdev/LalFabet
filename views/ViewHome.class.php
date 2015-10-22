<?php
include_once("api/IView.class.php");

class ViewHome implements IView
{
	protected $model;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function show()
	{
		$articles = $this->model;

		ob_start();

		include_once("templates/begin.php");
		include_once("templates/header.php");
		include_once("templates/home_section.php");
		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
