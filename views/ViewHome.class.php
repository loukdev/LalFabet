<?php
include_once('api/IView.class.php');
include_once('models/ModelArticle.class.php');

/*!
 * \class ViewHome
 * \brief Vue représentant la page d'accueil.
 * 
 *  Cette vue est le point d'entrée du site.
 *  Usage : <url du site>
 */
class ViewHome implements IView
{
	/*!
	 * \brief Constructeur.
	 * 
	 *  Ne prend pas de modèle en paramètre : cette vue récupère tous les
	 * articles via la méthode statique ModelArticle::getAll().
	 */
	public function __construct() {}

	/*!
	 * \brief Génère et affiche le code HTML.
	 * \see IView::show().
	 * 
	 *  Récupère la liste des articles dans une variable, puis les affiche sur
	 * la page dans l'ordre décroissant de la date de publication.
	 *  home_section.php se charge de les afficher un par un via une boucle dans
	 * laquelle home_article.php est inclus.
	 */
	public function show()
	{
		$articles = ModelArticle::getAll();

		ob_start();

		include_once("templates/begin.php");
		include_once("templates/header.php");
		include_once("templates/home_section.php");
		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
