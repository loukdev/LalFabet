<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('api/bdd_connect.php');
include_once('models/ModelArticle.class.php');

$a = new ModelArticle(2, 'loukiluk', 'Test via php', 'Ceci est un article créé via php.', date('Y-d-m'));
$a->delete($bdd);

echo nl2br(print_r(ModelArticle::getAll($bdd), true));
