<?php
require_once('config.php');

class Obiwan
{
	private function __construct() {}

	public static function PDO()
	{
		static $pdo = NULL;
		if (is_null($pdo))
		{
			$pdo = new PDO(	'mysql:dbname='. DB_NAME .';'.
							'host='. DB_HOST,
							DB_USER,
							DB_PASSWD);
		}

		return $pdo;
	}
}
