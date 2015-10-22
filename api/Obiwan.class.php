<?php

class Obiwan
{
  static var $pdo = NULL;

  private function __construct()
  {
    
  }
  
  public static function PDO()
  {
    if (is_null($pdo))
    {
      $pdo = new PDO("mysql:dbname=zfl3-blanlear;host=obiwan.univ-brest.fr"
                , "blanlear"
                , "1mwwtaq5");
    }

    return $pdo;
  }
}

?>
