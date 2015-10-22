<?php

interface IModel
{
	public function save();
	public function delete();

	public function __get($var);

	public static function getAll();
}
