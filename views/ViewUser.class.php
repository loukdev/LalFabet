<?php
include_once('api/IView.class.php');

/*!
 * \class ViewUser
 * \brief Vue représentant la page d'affichage des données utilisateur.
 * 
 *  Cette vue permet d'afficher toutes les informations de l'adhérent, dont
 *  l'identifiant est passé via GET.
 *  Usage : <url du site>/?user=pseudo.
 */
class ViewUser implements IView
{
	private $model = NULL;

	/*!
	 * \brief Constructeur.
	 * \param $model Modèle de l'utilisateur à afficher.
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

	/*!
	 * \brief Génère et affiche le code HTML.
	 * \see IView::show().
	 */
	public function show()
	{
		ob_start();

		include_once("templates/begin.php");
		include_once("templates/header.php");

		echo '<section>';

		if ($this->model->hasErrors())
		{
			foreach ($this->model->getErrors() as $err)
			{
				echo '<p style="color: red;">' . $err . '</p>';
			}
		}
		else
		{
			include_once('templates/user_section.php');
		}

		echo '</section>';

		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
