<?php

class Obiwan
{
	private function __construct() {}
	
	public static function PDO()
	{
	static $pdo = NULL;
		if (is_null($pdo))
		{
			$pdo = new PDO("mysql:dbname=fablab;host=localhost"
								, "root"
								, "");
		}

		return $pdo;
	}
}
