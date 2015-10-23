<?php

function are_all_set($array, $values)
{
	foreach ($values as $value)
	{
		if (!isset($array[$value]))
			return false;
	}
	
	return true;
}

function poor_array_diff_key($array1, $array2)
{
	$ret = array();
	foreach ($array1 as $k1 => $v1)
	{
		if (!array_key_exists($k1, $array2))
		{
			$ret = array_merge($ret, array($k1 => $v1));
		}
	}

	return $ret;
}

?>