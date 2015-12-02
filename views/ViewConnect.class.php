<?php
include_once('api/IView.class.php');

/*!
 * \class ViewConnect
 * \brief Vue représentant la page de connexion.
 * 
 *  Cette vue permet de se connecter sur le site.
 *  Usage : <url du site>/?connect
 */
class ViewConnect implements IView
{
	private $model = NULL;

	/*!
	 * \brief Constructeur.
	 * \param $model Modèle de l'utilisateur à connecter.
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

	/*!
	 * \brief Génère et affiche le code HTML.
	 * \see IView::show().
	 * 
	 *  Si le modèle ne contient pas de données, affiche la page de connexion.
	 *  Sinon, tente de connecter l'utilisateur avec les données POST.
	 *  Ce traitement est effectué dans connexion_section.php.
	 * 
	 *  En théorie, le template n'est pas sensé contenir de la logique. Cette
	 * partie du code est à revoir.
	 * 
	 * \todo Déplacer le code de connexion du fichier connection_section.php
	 * vers le modèle (soucis : la session ne semble pas se lancer lorsque
	 * session_start() est appelé dans ModelUser::tryConnect()).
	 */
	public function show()
	{
		ob_start();

		include_once("templates/begin.php");
		include_once("templates/header.php");
		include_once("templates/connection_section.php");
		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
