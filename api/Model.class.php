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
abstract class Model
{
	protected $errors = array();	//!< Contient les erreurs éventuellement apparues lors de traitements.
	protected $data = array();

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
