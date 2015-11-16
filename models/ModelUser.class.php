<?php

require_once('api/IModel.class.php');
include_once('api/Model.class.php');
require_once('api/Obiwan.class.php');
require_once('api/utility.php');

define('TABLE_NAME_ADH', '`t_adherent_adh`');
define('TABLE_NAME_CPT', '`t_compte_cpt`');

/*
 * \class ModelUser
 * \brief Modèle représentant les tables t_adherent_adh et t_compte_cpt.
 * 
 *  Ce modèle représente les données relatives aux tables t_adherent_adh
 * et t_compte_cpt.
 * 
 *  Il permet :
 *   - la création d'un adhérent et de son compte utilisateur.
 *   - la récupération d'un adhérent et de son compte utilisateur ;
 *  \todo Suppression d'un utilisateur dans la base de données.
 */
class ModelUser extends Model implements IModel
{
	private $query_results = array();	//!< Contient le résultat de la dernière requête SQL effectuée.

	private static $add_adh_query = 'INSERT INTO'. TABLE_NAME_ADH .'
				( `cpt_pseudo`
				, `adh_nom`
				, `adh_prenom`
				, `adh_date_naissance`
				, `adh_rue`
				, `adh_code_postal`
				, `adh_ville`
				, `adh_telephone1`
				, `adh_telephone2`
				, `adh_telephone3`
				, `adh_mail`
				, `adh_num_rue`
				) VALUES
			  ( :cpt_pseudo
				, :adh_nom
				, :adh_prenom
				, :adh_date_naissance
				, :adh_rue
				, :adh_code_postal
				, :adh_ville
				, :adh_telephone1
				, :adh_telephone2
				, :adh_telephone3
				, :adh_mail
				, :adh_num_rue
				)';

	private static $add_cpt_query = 'INSERT INTO'. TABLE_NAME_CPT .'
				( `cpt_pseudo`
				, `cpt_password`
				) VALUES
				( :cpt_pseudo
				, :cpt_password
				)';
	private static $del_adh_query = 'DELETE FROM '. TABLE_NAME_ADH .' WHERE adh_id=';
	private static $del_cpt_query = 'DELETE FROM '. TABLE_NAME_CPT .' WHERE adh_id=';
	private static $get_usr_query = 'SELECT * FROM '. TABLE_NAME_ADH .' NATURAL JOIN '.
											   TABLE_NAME_CPT .' WHERE cpt_pseudo=';

	/*!
	 * \brief Constructeur.
	 * 
	 *  Remplie les données du modèle avec $array.
	 */
	public function __construct($array)
	{
		$this->data = array_merge(array(
			  'cpt_pseudo' => ''
			, 'cpt_password' => ''
			, 'cpt_password_verif' => ''
			, 'adh_prenom' => ''
			, 'adh_nom' => ''
			, 'adh_date_naissance' => ''
			, 'adh_rue' => ''
			, 'adh_num_rue' => ''
			, 'adh_code_postal' => ''
			, 'adh_ville' => ''
			, 'adh_telephone1' => ''
			, 'adh_telephone2' => ''
			, 'adh_telephone3' => ''
			, 'adh_mail' => ''), $array);
	}

	/*!
	 * \brief Enregistre un adhérent et son compte utilisateur.
	 * \param $array Liste des champs.
	 * 
	 *  Enregistre un adhérent et son compte utilisateur avec les données contenu
	 * dans $array, qui doit être indexé de la même manière que dans les tables.
	 *  Après exécution, vérifier qu'une erreur n'a pas été détectée avec
	 * ModelUser::hasErrors().
	 */
	public function tryAddAccount($array)
	{
		$this->data = $array;

		// Verification de la présence des informations reçues
		if (are_all_set($this->data, array(
			  'cpt_pseudo'
			, 'cpt_password'
			, 'cpt_password_verif'
			, 'adh_prenom'
			, 'adh_nom'
			, 'adh_date_naissance'
			, 'adh_rue'
			, 'adh_num_rue'
			, 'adh_code_postal'
			, 'adh_ville'
			, 'adh_telephone1'
			, 'adh_telephone2'
			, 'adh_telephone3'
			, 'adh_mail'
		)))
		{
			$this->tryAddAccountPrivate();
		}
		else
		{
			$this->addError('');
		}

		$this->data = array_merge($this->data, array('errors' => $this->errors));
	}

	/*!
	 * \brief Enregistre les un compte.
	 * 
	 *  Exécute "le sale boulot" pour ajouter un compte : vérification de la
	 * validité de toutes les données
	 */
	private function tryAddAccountPrivate()
	{
		if (strlen($this->data['cpt_pseudo']) < 1
			or strlen($this->data['cpt_password']) < 1
			or strlen($this->data['cpt_password_verif']) < 1
			or strlen($this->data['adh_prenom']) < 1
			or strlen($this->data['adh_nom']) < 1
			or strlen($this->data['adh_date_naissance']) < 1
			or strlen($this->data['adh_rue']) < 1
			or strlen($this->data['adh_code_postal']) < 1
			or strlen($this->data['adh_ville']) < 1
			or strlen($this->data['adh_telephone1']) < 1
			or strlen($this->data['adh_mail']) < 1)
		{
			$this->addError('Tous les champs avec une étoile sont à renseigner.');
		}

		// verification mot de passe
		if ($this->data['cpt_password'] != $this->data['cpt_password_verif'])
		{
			$this->addError('Les deux mots de passe ne correspondent pas.');
		}

		// verification numéros de téléphone
		$nombre_num_valides = 0;
		if (strlen($this->data['adh_telephone1']) > 0)
		{
			if (strlen($this->data['adh_telephone1']) != 10) {
				$this->addError('Téléphone 1 invalide.');
			} else {
				$nombre_num_valides++; }
		}
		if (strlen($this->data['adh_telephone2']) > 0)
		{
			if (strlen($this->data['adh_telephone2']) != 10) {
				$this->addError('Téléphone 2 invalide.');
			} else {
				$nombre_num_valides++; }
		}
		if (strlen($this->data['adh_telephone3']) > 0)
		{
			if (strlen($this->data['adh_telephone3']) != 10) {
				$this->addError('Téléphone 3 invalide.');
			} else {
				$nombre_num_valides++; }
		}

		// verification date de naissance
		$time = strtotime($this->data['adh_date_naissance']);
		$diff_time = 0;
		if ($time != false and ($diff_time = time() - $time) > 0)
		{
			if ($diff_time < 18 * 356 * 24 * 3600 && $nombre_num_valides < 2) {
				$this->addError('Si vous avez moins de 18 ans, vous avez besoin de deux numéros de téléphone.');
			} else {
				$this->data['adh_date_naissance'] = date('Y-m-d', $time); }
		}
		else
		{
			$this->addError('Date invalide.');
		}
    
		// vérification adresse mail
		if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->data['adh_mail']))
		{
			$this->addError('Adresse mail invalide.');
		}

		// code postal
		if (strlen($this->data['adh_code_postal']) != 5)
		{
			$this->addError('Code postal invalie');
		}

		if (count($this->errors) > 0)
		{
			return;
		}

		$db = NULL;
		try
		{
			// récupération de la bdd et début de transaction
			$db = Obiwan::PDO();
			$db->beginTransaction();

			// ajout d'une entrée à t_compte_cpt
			$cpt = $db->prepare(self::$add_cpt_query);
			if (!$cpt->execute(array( 'cpt_pseudo' => $this->data['cpt_pseudo']
									, 'cpt_password' =>  $this->data['cpt_password'])))
			{
				$err = $cpt->errorInfo();
				throw new Exception("Une erreur serveur est survenue. Le nom d'utilisateur existe peut-être déjà.");
			}
			// ajout à t_adherent_adh
			$adh = $db->prepare(self::$add_adh_query);
			if (!$adh->execute(
				poor_array_diff_key($this->data, array('cpt_password' => ''
														   , 'cpt_password_verif' => ''))
				))
			{
				$err = $adh->errorInfo();
				throw new Exception('Une erreur serveur est survenue. ' . $err[2]);
			}

			// transaction terminée sans erreurs
			$db->commit();
		}
		catch (Exception $e)
		{
			// si jamais le problème provient d'une requête, on rollback
			if (!is_null($db))
			{
				$db->rollBack();
			}

			$this->addError($e->getMessage());
		}
	}

	public function save()
	{
		$this->tryAddAccountPrivate();
	}

	public function delete()
	{
		$db = null;
		try {
			$db = Obiwan::PDO();
			$db->beginTransaction();

			$adh = $db->query(self::$del_adh_query);
			if(!$adh)
			{
				$err = $db->errorInfo();
				throw new Exception('Une erreur serveur est survenue. '. $err[2]);
			}

			$cpt = $db->query(self::$del_cpt_query);
			if(!$cpt)
			{
				$err = $db->errorInfo();
				throw new Exception('Une erreur serveur est survenue. '. $err[2]);
			}

			$db->commit();
		} catch (Exception $e) {
			if(!is_null($db))
			{
				$db->rollBack();
			}

			$this->addError($e->getMessage());
		}
	}

	public static function getAll()
	{
	}

	public function getInfos()
	{
		return $this->data;
	}

	public function getRows()
	{
		return $this->query_results;
	}

	public static function signIn($array)
	{
		$ret = new ModelUser($array);
		$ret->tryAddAccount($array);

		return $ret;
	}

	public static function getUser($username)
	{
		return ModelUser::getUserPrivate($username, true);
	}

	private static function getUserPrivate($username, $verif)
	{
		$ret = new ModelUser(array());
		// si verif, alors verifier le droit d'acceder a ce compte
		if ($verif)
		{
			if (!isset($_SESSION['cpt_pseudo']))
			{
				$ret->addError("Vous n'êtes pas connecté.");
				return $ret;
			}

			if ($_SESSION['cpt_pseudo'] != $username)
			{

				// récupération du groupe de l'utilisateur
				$db = Obiwan::PDO();
				$q = $db->query("SELECT `grp_id`
												FROM `t_groupe_grp`
												NATURAL JOIN `t_abonnement_abo`
												WHERE `cpt_pseudo` = '" . $_SESSION['cpt_pseudo'] . "'
															AND `abo_fin` > NOW()");
															
				// pas d'abonnement, pas de droit
				if (!is_null($q))
				{
					$this->addError("Votre abonnement n'est pas à jour.");
					return $ret;
				}
			
				$res = $q->fetchAll();
				switch ($res['grp_id'])
				{
					// pas de droit pour les petits/grands debrouillards
					case Obiwan::GROUP_SMALL:
					case Obiwan::GROUP_BIG:
						$this->addError("Vous n'avez pas les droits pour accéder à ces informations.");
						return;

					// un animateur ne peut que accéder aux petits/grands debrouillards
					case Obiwan::GROUP_ANIMATOR:
					{
						$q2 = $db->query("SELECT `grp_id`
									FROM `t_groupe_grp`
									NATURAL JOIN `t_abonnement_abo`
									WHERE `cpt_pseudo` = '" . $username . "'
												AND `abo_fin` > NOW()");

						// pas d'abonnement, pas de droit
						if (!is_null($q))
						{
							$this->addError("Erreur.");
							return $ret;
						}
						$res2 = $q2->fetchAll();
						if ($res2['grp_id'] != Obiwan::GROUP_SMALL && $res2['grp_id'] != Obiwan::GROUP_BIG)
						{
							$this->addError("Vous n'avez pas les droits pour faire cela.");
							return $ret;
						}
					}

					// accès à tout pour le reste
					case Obiwan::GROUP_MANAGER:
					case Obiwan::GROUP_ADMIN:
					default: break;
				}
			}
		}

		try
		{
			$db = Obiwan::PDO();

			$q = $db->query(self::$get_usr_query . "'$username'");

			if(!$q or $q->rowCount() <= 0)
				throw new Exception($db->errorInfo()[2]);
			else
				$ret->query_results = $q;

			/*if ($q->rowCount() > 0)
				$ret->query_results = $q;
			else
			{
				$ret->query_results = false;
			}*/
		}
		catch (Exception $e)
		{
			$ret->addError('Une erreur serveur est survenue. '. $e->getMessage());
		}

		if (!$ret->query_results)
		{
			$ret->addError("Aucun utilisateur n'a pour nom $username.");
		}
		else
		{
			$arr = $ret->query_results->fetchAll();
			$ret->data = $arr[0];
		}

		return $ret;
	}

	public static function tryConnect($array)
	{
		$ret = ModelUser::getUserPrivate($array['cpt_pseudo'], false);
		if (!$ret->hasErrors())
		{
			if ($array['cpt_password'] != $ret->data['cpt_password'])
			{
				$ret->addError('Mauvais mot de passe.');
			}
		}

		return $ret;
	}
}
