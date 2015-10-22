<?php
include_once("api/IModel.class.php");

class ModelArticle implements IModel
{
	protected $data;

	public function __construct($id, $pseudo, $title, $content, $date)
	{
		$this->data['act_id'] = $id;
		$this->data['cpt_pseudo'] = $pseudo;
		$this->data['act_title'] = $title;
		$this->data['act_content'] = $content;
		$this->data['act_date'] = $date;
	}

	public static function getAll($bdd)
	{
		return $bdd->query("SELECT * FROM t_actualite_act")->fetchAll();
	}

	public function __get($var)
	{
		if(!array_key_exists($var, $this->data)) {
			throw new Exception(__CLASS__ .'::__get : '. $var .' is not a row.');
		}
		return $this->data[$var];
	}

	public function save($bdd)
	{
		foreach($this->data as $data) {
			$values = (empty($values) ? '' : $values . ', ') . (is_int($data) ? $data : "'$data'");
		}

		$result = $bdd->query('INSERT INTO t_actualite_act VALUES ('. $values .')');
		if(!$result) {
			throw new Exception(__CLASS__ . '::save : insert query failed.');
		} else {
			return $result->fetch(); }
	}

	public function delete($bdd)
	{
		$result = $bdd->query('DELETE FROM t_actualite_act WHERE act_id = '. $this->data["act_id"]);
		if(!$result) {
			throw new Exception(__CLASS__ . '::delete : delete query failed.');
		} else {
			return $result->fetch(); }
	}
}
