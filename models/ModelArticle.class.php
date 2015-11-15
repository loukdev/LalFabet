<?php
include_once('api/bdd.php');
include_once('api/IModel.class.php');

/*!
 * \class ModelArticle
 * \brief Modèle représentant la table t_actualite_act.
 * 
 *  Ce modèle représente les données relatives à la table t_actualite_act.
 * 
 *  Il permet :
 *   - la création d'un article ;
 *   - la suppression d'un article ;
 *   - la récupération d'un article avec son id ;
 */

define('TABLE_NAME', 't_actualite_act');
class ModelArticle implements IModel
{
	private $data;

	private $add_act_query = 'INSERT INTO `.'. TABLE_NAME .'`
		  (`act_id`, 
		  `cpt_pseudo`,
		  `act_titre`,
		  `act_contenu`,
		  `act_date`) VALUES
		  ( :act_id
		  , :cpt_pseudo
		  , :act_titre
		  , :act_contenu
		  , :act_date)';
	private $del_act_query = 'DELETE FROM '. TABLE_NAME .' WHERE act_id = ';
	private $get_act_query = 'SELECT * FROM '. TABLE_NAME . 'WHERE act_id = ';

	public function __construct($array)
	{
		$this->data = array_merge($array, array(
			'act_id' => ''
		  , 'cpt_pseudo' => ''
		  , 'act_titre' => ''
		  , 'act_contenu' => ''
		  , 'act_date' => ''));
	}

	public static function get($id)
	{
		$result = Obiwan::PDO()->query($this->get_act_query . $this->data['act_id']);
		if(!$result) {
			throw new Exception(__CLASS__ . '::get : select query failed.');
		} else {
			return $result->fetch(); }
	}

	public static function getAll()
	{
		try
		{
			$db = Obiwan::PDO();
			$db->query("SET NAMES 'utf8'");
			$q  = $db->query("SELECT * FROM t_actualite_act");
			if (!$q) {
				throw new Exception("Nope");
			} else {
				return $q->fetchAll(); }
		}
		catch (Exception $_)
		{
			return array();
		}
	}

	public function __get($var)
	{
		if(!array_key_exists($var, $this->data)) {
			return '';
		}
		return $this->data[$var];
	}

	public function save()
	{
		$query = Obiwan::PDO()->prepare($this->add_act_query);

		$result = $query->execute($this->data);
		if(!$result) {
			throw new Exception(__CLASS__ . '::save : insert query failed.');
		} else {
			return $result->fetch(); }
	}

	public function delete()
	{
		$result = Obiwan::PDO()->query($this->del_act_query . $this->data['act_id']);
		if(!$result) {
			throw new Exception(__CLASS__ . '::delete : delete query failed.');
		} else {
			return $result->fetch(); }
	}
}
