<?php
include_once('api/bdd.php');
include_once('api/IModel.class.php');

class ModelArticle implements IModel
{
	protected $data;

	public function __construct($array)
	{
		$this->data = $array;
	}

	public static function getAll()
	{
		return Obiwan::PDO()->query("SELECT * FROM t_actualite_act")->fetchAll();
	}

	public function __get($var)
	{
		if(!array_key_exists($var, $this->data)) {
			throw new Exception(__CLASS__ .'::__get : '. $var .' is not a row.');
		}
		return $this->data[$var];
	}

	public function save()
	{
		$act = Obiwan::PDO()->prepare("INSERT INTO `t_actualite_act`
		  (`act_id`, 
		  `cpt_pseudo`,
		  `act_titre`,
		  `act_contenu`,
		  `act_date`) VALUES
		  ( :act_id
		  , :cpt_pseudo
		  , :act_titre
		  , :act_contenu
		  , :act_date)");

		$result = $act->execute($this->data);
		if(!$result) {
			throw new Exception(__CLASS__ . '::save : insert query failed.');
		} else {
			return; }
	}

	public function delete()
	{
		$result = Obiwan::PDO()->query('DELETE FROM t_actualite_act WHERE act_id = '. $this->data["act_id"]);
		if(!$result) {
			throw new Exception(__CLASS__ . '::delete : delete query failed.');
		} else {
			return $result->fetch(); }
	}
}
