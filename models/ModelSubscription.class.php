<?php

include_once('api/IModel.class.php');
include_once('api/Model.class.php');

include_once('models/ModelGroup.class.php');

define('TABLE_NAME_ABO', '`t_abonnement_abo`');

/*!
 * \class ModelSubscription
 * \brief Modèle représentant la table t_abonnement_abo.
 * 
 *  Ce modèle représente les données relatives à la table t_abonnement_abo.
 * 
 *  Il permet :
 *   - la création d'un abonnement ;
 *   - la suppression d'un abonnement (à ne pas utiliser d'après le cahier
 * des charges) ;
 *   - la récupéraion des données d'un abonnement ;
 *   - la récupération de tous les abonnements (dans un array) ;
 */
class ModelSubscription extends Model implements IModel
{
	private static $add_abo_query = 'INSERT INTO `.'. TABLE_NAME_ABO .'`
		 (`abo_id`, 
		  `abo_debut`,
		  `abo_fin`,
		  `cpt_pseudo`,
		  `grp_id`) VALUES
		  ( :abo_id
		  , :abo_debut
		  , :abo_fin
		  , :cpt_pseudo
		  , :grp_id)';
	private static $del_abo_query = 'DELETE FROM '. TABLE_NAME_ABO .' WHERE abo_id = ';
	private static $get_abo_query = 'SELECT * FROM '. TABLE_NAME_ABO . ' WHERE ';

	/*!
	 * \brief Constructeur, remplie les données contenues dans $array.
	 * \param $array Liste des champs contenant les données.
	 * 
	 *  Remplie les données du modèle en s'assurant que tous les champs de la
	 * table TABLE_NAME_ABO sont présents.
	 *  Récupère également les infos concernant le groupe auquel l'abonnement
	 * est lié (si du moins grp_id existe dans la BDD).
	 */
	public function __construct($array)
	{
		if(!is_array($array))
			$array = array('abo_id' => '');
		$this->data = array_merge(array(
			'abo_id' => ''
		  , 'abo_debut' => ''
		  , 'abo_fin' => ''
		  , 'cpt_pseudo' => ''
		  , 'grp_id' => ''), $array);

		$group = ModelGroup::get($this->data['grp_id']);
		if($group)
			$this->data = array_merge($this->data, $group->getData());
	}

	public function save()
	{
		$query = Obiwan::PDO()->prepare($this->add_abo_query);

		$result = $query->execute($this->data);
		if(!$result) {
			throw new Exception(__CLASS__ . '::save : insert query failed.');
		} else {
			return $result->fetch(); }
	}

	public function delete()
	{
		$result = Obiwan::PDO()->query($this->del_abo_query . $this->data['abo_id']);
		if(!$result) {
			throw new Exception(__CLASS__ . '::delete : delete query failed.');
		} else {
			return $result->fetch(); }
	}

	/*!
	 * \brief Renvoie l'abonnement correspondant à l'id donné.
	 * \param $id Id de l'abonnement.
	 * \return Le modèle abonnement associé à l'id donné.
	 * 
	 *  Renvoie le modèle de l'abonnement correspondant à l'id donné.
	 *  Lance une exception si la requête a échouée.
	 */
	public static function get($id)
	{
		$result = Obiwan::PDO()->query(self::$get_abo_query .'abo_id = '. $id);
		if(!$result) {
			throw new Exception(__CLASS__ . '::get : select query failed.');
		} else {
			return new ModelSubscription($result->fetch()); }
	}

	/*!
	 * \brief Renvoie l'abonnement correspondant à l'utilisateur donné.
	 * \param $user Pseudo de l'utilisateur
	 * \return Le modèle abonnement associé à l'utilisateur donné.
	 * 
	 *  Renvoie le modèle de l'abonnement le plus récent associé à l'utilisateur
	 * donné.
	 *  Lance une exception si la requête a échouée.
	 */
	public static function getFromUser($user)
	{
		$result = Obiwan::PDO()->query(self::$get_abo_query ."cpt_pseudo = '$user'" .
									   ' ORDER BY abo_debut DESC');

		if(!$result) {
			throw new Exception(__CLASS__ . '::getFromUser : select query failed.');
		} else {
			//echo 'Sub::getFromUser <br />';
			return new ModelSubscription($result->fetch(PDO::FETCH_ASSOC)); }
	}

	public static function getAll()
	{
		try
		{
			$db = Obiwan::PDO();
			$q  = $db->query('SELECT * FROM '. TABLE_NAME_ABO);
			if (!$q) {
				throw new Exception(__CLASS__ . '::getAll : select query failed.');
			} else {
				return $q->fetchAll(); }
		}
		catch (Exception $_)
		{
			return array();
		}
	}
}
