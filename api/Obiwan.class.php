<?php
include_once('config.php');

define('DB_NAME', 'LalFabet');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWD', '');

/*!
 * \class Obiwan
 * \brief Classe gérant la connexion à la BDD.
 * 
 *  Classe singleton contenant la fonction statique PDO() permettant de
 * récupérer l'objet PDO connecté à la BDD. Si PDO() est lancée pour la 1ere
 * fois, lance la connexion à la BDD.
 */
class Obiwan
{
	/*!
	 * \brief Constructeur rendu privé.
	 */
	private function __construct() {}

	/*!
	 * \brief Fonction statique renvoyant la connexion BDD.
	 */
	public static function PDO()
	{
		static $pdo = NULL;
		if (is_null($pdo))
		{
			$pdo = new PDO(	'mysql:dbname='. DB_NAME .';'.
							'host='. DB_HOST,
							DB_USER,
							DB_PASSWD);
			$pdo->query("SET NAMES 'utf8'");
		}

		return $pdo;
	}
}
