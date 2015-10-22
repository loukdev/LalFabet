<?php

require_once("api/Obiwan.class.php");

function add_inscription($values)
{
  $db = NULL;
  try
  {
    $db = Obiwan::PDO();

    $db->beginTransaction();
    
    // ajout d'un adhérent avant le compte
    $adh = $db->prepare("INSERT INTO `t_adherent_adh`
      (`cpt_pseudo`, 
      `adh_nom`, 
      `adh_prenom`, 
      `adh_date_naissance`, 
      `adh_rue`, 
      `adh_code_postal`, 
      `adh_ville`, 
      `adh_telephone`, 
      `adh_mail`, 
      `adh_num_rue`) VALUES
      ( :pseudo
      , :nom
      , :prenom
      , :date
      , :rue
      , :codepostal
      , :ville
      , :telephone1
      , :mail
      , :numrue)");

    $adh->execute($values);

    // ajout du compte
    $cpt = $db->prepare("INSERT INTO `t_compte_cpt` (`cpt_pseudo`, `cpt_password`) VALUES (:pseudo, :password)");
    $cpt->execute($values);
    
    $db->commit();

    return NULL;
  }
  catch (Exception $e)
  {
    if (!is_null($db))
      $db->rollBack();

    return $e->getMessage();
  }
}

?>
