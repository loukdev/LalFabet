<?php

include_once('api/IModel.class.php');
include_once('api/Model.class.php');
include_once('api/Obiwan.class.php');

define('TABLE_NAME_ACT', '`t_actualite_act`');

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

class ModelArticle extends Model implements IModel
{
	private $add_act_query = 'INSERT INTO `.'. TABLE_NAME_ACT .'`
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
	private $del_act_query = 'DELETE FROM '. TABLE_NAME_ACT .' WHERE act_id = ';
	private $get_act_query = 'SELECT * FROM '. TABLE_NAME_ACT . 'WHERE ';

	/*!
	 * \brief Constructeur, remplie les données contenues dans $array.
	 * \param $array Liste des champs contenant les données.
	 * 
	 *  Remplie les données du modèle en s'assurant que tous les champs de la
	 * table TABLE_NAME_ACT sont présent.
	 */
	public function __construct($array)
	{
		$this->data = array_merge(array(
			'act_id' => ''
		  , 'cpt_pseudo' => ''
		  , 'act_titre' => ''
		  , 'act_contenu' => ''
		  , 'act_date' => ''), $array);
	}

	/*!
	 * \brief Renvoie l'article correspondant à l'id envoyé.
	 * \param $id_or_title Id ou titre de l'article
	 * \return Le modèle associé à l'id.
	 * 
	 *  Renvoie l'article correspondant à l'id envoyé, qui peut aussi être son
	 * titre.
	 *  Lance une exception si la requête a échouée.
	 */
	public static function get($id_or_title)
	{
		$str_id = 'act_titre = ';
		if(is_int($id_or_title))
			$str_id = 'act_id = ';

		$result = Obiwan::PDO()->query($this->get_act_query . $str_id . $id_or_title);
		if(!$result) {
			throw new Exception(__CLASS__ . '::get : select query failed.');
		} else {
			return new ModelArticle($result->fetch()); }
	}

	public static function getAll()
	{
		try
		{
			$db = Obiwan::PDO();
			$q  = $db->query('SELECT * FROM '. TABLE_NAME_ACT);
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
