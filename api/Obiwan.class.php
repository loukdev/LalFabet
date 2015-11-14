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
			$str = 'mysql:dbname='. DB_NAME .';'.
							'host='. DB_HOST;
			print($str);
			$pdo = new PDO(	$str,
							DB_USER,
							DB_PASSWD);
		}

		return $pdo;
	}
}
