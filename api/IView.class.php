<?php

/*!
 * \interface IView
 * \brief Interface à implémenter par les vues.
 * 
 *  Cette interface définit le squelette d'une vue. Une vue représente une page
 *  du site web.
 */
interface IView
{
	public function show();	//!< Génère et affiche le code HTML à partir des templates.
}
