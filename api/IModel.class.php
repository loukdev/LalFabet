<?php

/*!
 * \interface IModel
 * \brief Interface à implémenter par les modèles.
 * 
 *  Cette interface définit le squelette d'un modèle. Un modèle représente une table de la base de donnée.
 */
interface IModel
{
	public function save();		//!< Sauvegarde l'instance dans la base de donnée.
	public function delete();	//!< Supprime l'instance de la base de donnée.

	/*!
	 * \brief Renvoie la valeur de la clé $var.
	 * 
	 *  Comportement attendu :
	 *  Renvoie la valeur de la clé $var, où $var est une colonne de la (les)
	 *  table(s) représentée(s) par le modèle. Si $var ne correspond pas à une
	 *  colonne de table, une chaîne de caractères vide est renvoyée.
	 * 
	 * \param $var Colonne de la (les) table(s) représentée(s) par le modèle.
	 */
	public function __get($var);

	public static function getAll();	//!< Récupère toutes les entrées de la table correspondant au modèle.
}
