<?php

require_once('api/Imodel.class.php');
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
			or strlen($this->post_infos['adh_prenom']) < 1
			or strlen($this->post_infos['adh_nom']) < 1
			or strlen($this->post_infos['adh_date_naissance']) < 1
			or strlen($this->post_infos['adh_rue']) < 1
			or strlen($this->post_infos['adh_code_postal']) < 1
			or strlen($this->post_infos['adh_ville']) < 1
			or strlen($this->post_infos['adh_telephone1']) < 1
			or strlen($this->post_infos['adh_mail']) < 1
			or strlen($this->post_infos['adh_num_rue']) < 1)
		{
			array_push($this->errors, 'Tous les champs avec une étoile sont à renseigner.');
		}


		// verification date de naissance
		$time = strtotime($this->post_infos['adh_date_naissance']);
		if ($time != false or $time > time())
		{
			$this->post_infos['adh_date_naissance'] = date('Y-m-d', $time);
		}
		else
		{
			array_push($this->errors, 'Date invalide.');
		}

		// verification numéros de téléphone
		if (strlen($this->post_infos['adh_telephone1']) > 0 && strlen($this->post_infos['adh_telephone1']) != 10)
		{
			array_push($this->errors, 'Téléphone 1 invalide.');
		}
		if (strlen($this->post_infos['adh_telephone2']) > 0 && strlen($this->post_infos['adh_telephone2']) != 10)
		{
			array_push($this->errors, 'Téléphone 2 invalide.');
		}
		if (strlen($this->post_infos['adh_telephone3']) > 0 && strlen($this->post_infos['adh_telephone3']) != 10)
		{
			array_push($this->errors, 'Téléphone 3 invalide.');
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
				throw new Exception ("Une erreur serveur est survenue. " . $cpt->errorInfo()[2]);
				
			// ajout à t_adherent_adh
			$adh = $db->prepare($this->add_adh_query);
			if (!$adh->execute(
					poor_array_diff_key($this->post_infos, array('cpt_password' => ''))))
				throw new Exception ("Une erreur serveur est survenue. " . $adh->errorInfo()[2]);


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
		$ret = new ModelUser(array());
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
			$ret->post_infos = $ret->query_results->fetchAll()[0];
		}

		$ret->post_infos = array_merge($ret->post_infos, array('errors' => $ret->errors));

		return $ret;
	}

	public static function tryConnect($array)
	{
		$ret = ModelUser::getUser($array['cpt_pseudo']);
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