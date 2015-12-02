<?php

/*!
 * \mainpage
 * 
 *  Bienvenue dans la doc de LalFabet !
 * 
 *  Elle a été générée via doxygen, tous les fichiers ont été commentés dans ce
 * but.
 * 
 * 
 * 
 *  Ce site web est conçu sur le modèle du patron de conception MVC (Model View
 * Controller), en réalité appliqué en MVT (Model View Template).
 * 
 *  La seule partie pouvant être considérée comme étant un controleur est le
 * fichier index.php, qui redirige vers la page en fonction des valeurs de _GET.
 * 
 *  Il y a donc plutôt ces trois différentes composantes :
 *  - les modèles
 *  - les vues
 *  - les templates
 *
 * 
 *  Chaque vue correspond à une page du site web. Elles incluent les différents
 * templates permettant de former la page en entier, parfois en fonction d'un
 * de données reçues via un modèle envoyé en paramètre du constructeur.
 * 
 *  Chaque modèle correspond à une - voir deux - tables de la base de données.
 * Ils s'occupent de récupérer et d'envoyer les données et de les encapsuler
 * dans un objet (du type de la classe qui sert de modèle).
 * 
 *  Les templates sont des morceaux de code HTML avec le minimum de code php.
 *  Dans l'idéal, ils doivent se restreindre au minimum logique, comme par
 * exemple une boucle sur l'inclusion d'un autre template. Ils sont utilisés par
 * les vues pour former une page complète.
 */

