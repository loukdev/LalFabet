<?php

/**
 * \author Louka
 * 
 * \class Model
 * \brief Classe abstraite à hériter par les modèles.
 * 
 *  Cette classe définit les comportements par défaut de quelques méthodes,
 * notamment pour la gestion des erreurs.
 */
class Model
{
	protected $errors = array();	//!< Contient les erreurs éventuellement apparues lors de traitements.
	protected $data = array();		//!< Contient les données du modèle.

	/*!
	 * \brief Renvoie la valeur du champ $var.
	 * \param $var Champs de la table à récupérer.
	 * 
	 *  Renvoie la valeur du champs correspondant à la table. Si la clé $var
	 * n'est pas un champs de la table, renvoie une chaîne de caractères vide.
	 */
	public function __get($var)
	{
		if(!array_key_exists($var, $this->data)) {
			return '';
		}

		return $this->data[$var];
	}

	/*!
	 * \brief Renvoie s'il y a des erreurs ou non.
	 * \return Un booléen.
	 */
	public function hasErrors()
	{
		return !empty($this->errors);
	}

	/*!
	 * \brief Renvoie la liste des erreurs.
	 * \return La liste des erreurs.
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/*!
	 * \brief Ajoute une erreur.
	 * \param $err Erreur à ajouter.
	 */
	protected function addError($err)
	{
		array_push($this->errors, $err);
	}
}
