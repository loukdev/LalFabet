<?php

interface IModel
{
	public function save($bdd);
	public function delete($bdd);

	public function __get($var);

	public static function getAll($bdd);
}
