<?php
include_once('api/IView.class.php');

class ViewUser implements IView
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

		echo '<section>';

		if (count($this->get('errors')))
		{
			foreach ($this->get('errors') as $err)
			{
				echo '<p style="color: red;">' . $err . '</p>';
			}
		}
		else
		{
			include_once('templates/user_section.php');
		}

		echo '</section>';

		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}

	private function get($key)
	{
		$tab = $this->model->getInfos();
		if (isset($tab[$key])) 
			return $tab[$key];
		else
			return '';
	}
	
}
