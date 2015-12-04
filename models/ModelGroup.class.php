<?php
include_once('api/Model.class.php');
include_once('api/IModel.class.php');

define('TABLE_NAME_GRP', '`t_groupe_grp`');

/*!
 * \class ModelGroup
 * \brief Modèle représentant la table t_group_grp.
 * 
 *  Ce modèle représente les données relatives à la table t_group_grp.
 * 
 *  Il permet :
 *   - la création d'un groupe (ne sera à priori pas utilisé) ;
 *   - la suppression d'un groupe (ne sera à priori pas utilisé) ;
 *   - la récupéraion des données d'un groupe ;
 *   - la récupération de tous les groupes (dans un array) ;
 */
class ModelGroup extends Model implements IModel
{
	private static $add_grp_query = 'INSERT INTO `.'. TABLE_NAME_GRP .'`
		 (`grp_id`, 
		  `grp_niveau`,
		  `grp_acces_petit`,
		  `grp_acces_autre`) VALUES
		  ( :grp_id
		  , :grp_niveau
		  , :grp_acces_petit
		  , :grp_acces_autre)';
	private static $del_grp_query = 'DELETE FROM '. TABLE_NAME_GRP .' WHERE grp_id = ';
	private static $get_grp_query = 'SELECT * FROM '. TABLE_NAME_GRP . 'WHERE grp_id = ';

	// n = niveau ; p = accès petit ; g = accès grand
	//									<-  n ->pg
	public static $MINOR =		4;
	public static $ADULT =		3;
	public static $LEADER =		2;
	public static $MANAGER =	1;
	public static $ADMIN =		0;

	/*!
	 * \brief Constructeur, remplie les données contenues dans $array.
	 * \param $array Liste des champs contenant les données.
	 * 
	 *  Remplie les données du modèle en s'assurant que tous les champs de la
	 * table TABLE_NAME_ACT sont présents.
	 */
	public function __construct($array)
	{
		$this->data = array_merge(array(
			'grp_id' => ''
		  , 'grp_niveau' => ''
		  , 'grp_acces_petit' => ''
		  , 'grp_acces_autre' => ''), $array);
	}

	public function save()
	{
		$query = Obiwan::PDO()->prepare($this->add_grp_query);

		$result = $query->execute($this->data);
		if(!$result) {
			throw new Exception(__CLASS__ . '::save : insert query failed.');
		} else {
			return $result->fetch(); }
	}

	public function delete()
	{
		$result = Obiwan::PDO()->query($this->del_grp_query . $this->data['grp_id']);
		if(!$result) {
			throw new Exception(__CLASS__ . '::delete : delete query failed.');
		} else {
			return $result->fetch(); }
	}

	/*!
	 * \brief Renvoie le groupe correspondant à l'id envoyé.
	 * \param $id Id du groupe
	 * \return Le modèle associé à l'id.
	 * 
	 *  Renvoie le groupe correspondant à l'id envoyé.
	 *  Lance une exception si la requête a échouée.
	 */
	public static function get($id)
	{
		$result = Obiwan::PDO()->query(self::$get_grp_query . $id);
		if(!$result) {
			throw new Exception(__CLASS__ . '::get : select query failed.');
		} else {
			return new ModelGroup($result->fetch()); }
	}

	public static function getAll()
	{
		try
		{
			$db = Obiwan::PDO();
			$q  = $db->query('SELECT * FROM '. TABLE_NAME_GRP);
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
