<?php

function are_all_set_POST($array)
{
  foreach ($array as $value)
  {
    if (!isset($_POST[$value]))
      return false;
  }
  
  return true;
}

?>