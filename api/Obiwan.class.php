<?php

class Obiwan
{
	private function __construct() {}
	
	public static function PDO()
	{
	static $pdo = NULL;
		if (is_null($pdo))
		{
			$pdo = new PDO("mysql:dbname=zfl3-blanlear;host=obiwan.univ-brest.fr"
								, "blanlear"
								, "1mwwtaq5");
		}

		return $pdo;
	}
}
