<?php

require_once('api/IModel.class.php');
require_once('api/Obiwan.class.php');
require_once('api/utility.php');

/*
 * Ce modèle représente les données relatives aux tables t_adherent_adh
 * et t_compte_cpt
 * 
 * Il faut utiliser ce modèle pour avoir accès aux données venant
 * de ces tables ou pour inscrire une personne
 * 
 */

class ModelUser implements IModel
{  
	private $post_infos = array();
	private $errors = array();
	private $query_results = array();

	private $add_adh_query = "INSERT INTO `t_adherent_adh`
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
				)";

	private $add_cpt_query = "INSERT INTO `t_compte_cpt`
				( `cpt_pseudo`
				, `cpt_password`
				) VALUES
				( :cpt_pseudo
				, :cpt_password
				)";


	public function __construct($array)
	{
		$this->post_infos = array_merge(array(
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

	// Fonction à appeler pour ajouter un compte à la volée
	// $array doit contenir tous les champs des tables
	// indexés comme il le sont dans les tables

	public function tryAddAccount($array)
	{
		$this->post_infos = $array;

		// Verification de la présence des informations reçues
		if (are_all_set($this->post_infos, array(
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
			array_push($this->errors, '');
		}

		$this->post_infos = array_merge($this->post_infos, array('errors' => $this->errors));
	}

	// Se charge d'ajouter un compte
	private function tryAddAccountPrivate()
	{
		if (strlen($this->post_infos['cpt_pseudo']) < 1
			or strlen($this->post_infos['cpt_password']) < 1
			or strlen($this->post_infos['cpt_password_verif']) < 1
			or strlen($this->post_infos['adh_prenom']) < 1
			or strlen($this->post_infos['adh_nom']) < 1
			or strlen($this->post_infos['adh_date_naissance']) < 1
			or strlen($this->post_infos['adh_rue']) < 1
			or strlen($this->post_infos['adh_code_postal']) < 1
			or strlen($this->post_infos['adh_ville']) < 1
			or strlen($this->post_infos['adh_telephone1']) < 1
			or strlen($this->post_infos['adh_mail']) < 1)
		{
			array_push($this->errors, 'Tous les champs avec une étoile sont à renseigner.');
		}

		// verification mot de passe
		if ($this->post_infos['cpt_password'] != $this->post_infos['cpt_password_verif'])
		{
			array_push($this->errors, 'Les deux mots de passe ne correspondent pas.');
		}
		
		// verification numéros de téléphone
    $nombre_num_valides = 0;
		if (strlen($this->post_infos['adh_telephone1']) > 0)
		{
      if (strlen($this->post_infos['adh_telephone1']) != 10)
        array_push($this->errors, 'Téléphone 1 invalide.');
      else
        $nombre_num_valides++;
		}
		if (strlen($this->post_infos['adh_telephone2']) > 0)
		{
      if (strlen($this->post_infos['adh_telephone2']) != 10)
        array_push($this->errors, 'Téléphone 2 invalide.');
      else
        $nombre_num_valides++;
		}
		if (strlen($this->post_infos['adh_telephone3']) > 0)
		{
      if (strlen($this->post_infos['adh_telephone3']) != 10)
        array_push($this->errors, 'Téléphone 3 invalide.');
      else
        $nombre_num_valides++;
		}

		// verification date de naissance
		$time = strtotime($this->post_infos['adh_date_naissance']);
    $diff_time = 0;
		if ($time != false and ($diff_time = time() - $time) > 0)
		{
      if ($diff_time < 18 * 356 * 24 * 3600 && $nombre_num_valides < 2)
      {
        array_push($this->errors, 'Si vous avez moins de 18 ans, vous avez besoin de deux numéros de téléphone.');
      }
      else      
        $this->post_infos['adh_date_naissance'] = date('Y-m-d', $time);
		}
		else
		{
			array_push($this->errors, 'Date invalide.');
		}

    
		// vérification adresse mail
		if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->post_infos['adh_mail']))
		{
			array_push($this->errors, 'Adresse mail invalide.');
		}

		// code postal
		if (strlen($this->post_infos['adh_code_postal']) != 5)
		{
			array_push($this->errors, "Code postal invalie");
		}

		if (count($this->errors) > 0)
			return;

		$db = NULL;
		try
		{
			// récupération de la bdd et début de transaction
			$db = Obiwan::PDO();
			$db->beginTransaction();

			// ajout d'une entrée à t_compte_cpt
			$cpt = $db->prepare($this->add_cpt_query);
			if (!$cpt->execute(array( 'cpt_pseudo' => $this->post_infos['cpt_pseudo']
														  , 'cpt_password' =>  $this->post_infos['cpt_password'])))
			{
				$err = $cpt->errorInfo();
				throw new Exception ("Une erreur serveur est survenue. " . $err[2]);
			}				
			// ajout à t_adherent_adh
			$adh = $db->prepare($this->add_adh_query);
			if (!$adh->execute(
					poor_array_diff_key($this->post_infos, array('cpt_password' => '', 'cpt_password_verif' => ''))))
			{
				$err = $adh->errorInfo();
				throw new Exception ("Une erreur serveur est survenue. " . $err[2]);
			}

			// transaction terminée sans erreurs
			$db->commit();
		}
		catch (Exception $e)
		{
			// si jamais le problème provient d'une requête, on rollback
			if (!is_null($db))
				$db->rollBack();

			array_push($this->errors, $e->getMessage());
		}

	}

	public function save() {}
	public function delete() {}

	public function __get($var)
	{
	}

	public static function getAll()
	{
	}

	public function getInfos()
	{
		return $this->post_infos;
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
				array_push($ret->errors, "Vous n'êtes pas connecté.");
		$ret->post_infos = array_merge($ret->post_infos, array('errors' => $ret->errors));
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
					array_push($ret->errors, "Votre abonnement n'est pas à jour.");
		$ret->post_infos = array_merge($ret->post_infos, array('errors' => $ret->errors));
		return $ret;
				}
			
				$res = $q->fetchAll();
				switch ($res['grp_id'])
				{
					// pas de droit pour les petits/grands debrouillards
					case Obiwan::GROUP_SMALL:
					case Obiwan::GROUP_BIG: array_push($this->errors, "Vous n'avez pas les droits pour faire cela."); return;

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
							array_push($ret->errors, "Erreur.");
							return $ret;
						}
						$res2 = $q2->fetchAll();
						if ($res2['grp_id'] != Obiwan::GROUP_SMALL && $res2['grp_id'] != Obiwan::GROUP_BIG)
						{
							array_push($ret->errors, "Vous n'avez pas les droits pour faire cela.");
		$ret->post_infos = array_merge($ret->post_infos, array('errors' => $ret->errors));
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
			
			$q = $db->query("SELECT * FROM `t_adherent_adh` NATURAL JOIN `t_compte_cpt` WHERE cpt_pseudo='$username'");

			if ($q->rowCount() > 0)
			{
				$ret->query_results = $q;
			}
			else
			{
				$ret->query_results = false;
			}
		}
		catch (Exception $e)
		{
			array_push($ret->errors, "Une erreur serveur est survenue.");
		}

		if (!$ret->query_results)
		{
			array_push($ret->errors, "Aucun utilisateur n'a pour nom $username.");
		}
		else
		{
			$arr = $ret->query_results->fetchAll();
			$ret->post_infos = $arr[0];
		}
		
		$ret->post_infos = array_merge($ret->post_infos, array('errors' => $ret->errors));
		return $ret;
	}

	public static function tryConnect($array)
	{
		$ret = ModelUser::getUserPrivate($array['cpt_pseudo'], false);
		if (count($ret->errors) < 1)
		{
			if ($array['cpt_password'] != $ret->post_infos['cpt_password'])
			{
				array_push($ret->errors, 'Mauvais mot de passe.');
				$ret->post_infos = array_merge($ret->post_infos, array('errors' => $ret->errors));
			}
		}

		return $ret;
	}
}

?>
