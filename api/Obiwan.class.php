<?php

class Obiwan
{
	private function __construct() {}
	
	public static function PDO()
	{
		static $pdo = NULL;
		if (is_null($pdo))
		{
			$pdo = new PDO(	'mysql:dbname='. $GLOBALS['DB_NAME'] .';'.
							'host='. $GLOBALS['DB_HOST'] .'localhost',
							$GLOBALS['DB_USER'],
							$GLOBALS['DB_PASSWD']);
		}

		return $pdo;
	}
}
