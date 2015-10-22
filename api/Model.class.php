<?php

abstract class Model
{
	protected $data = array();

	public abstract function save();
	public abstract function delete();

	public function __get($var)
	{
		if (!array_key_exists($var, $this->data)) {
			throw new Exception("This model has no row name $var."); }
		return $this->data[$var];
	}

	public static abstract function getAll($bdd);
}
