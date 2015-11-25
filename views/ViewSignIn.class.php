<?php
include_once('api/IView.class.php');

/*!
 * \class ViewSignIn
 * \brief Vue représentant la page d'inscription.
 * 
 *  Cette vue permet de s'inscrire sur le site via un formulaire.
 *  Usage : <url du site>/?signin.
 */
class ViewSignIn implements IView
{
	private $model = NULL;

	/*!
	 * \brief Constructeur.
	 * \param $model Modèle de l'utilisateur à inscrire.
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

	/*!
	 * \brief Génère et affiche le code HTML.
	 * \see IView::show().
	 * 
	 *  Si le modèle contient au moins une erreur, elle est affichée au-dessus
	 * du formulaire.
	 *  Sinon, une section indiquant le succès de l'inscription est affichée.
	 * 
	 *  La gestion d'un utilisateur pour l'inscription est pour l'instant un peu
	 * bancale : si un utilisateur vient d'arriver sur cette page, le modèle est
	 * vide (la variable _POST ne contenait rien lors de l'appel à
	 * ModelUser::signIn()), mais contient une erreur : une chaine de caractère
	 * vide. Par conséquent, le formulaire est affiché sans erreur apparente (il
	 * y en a une, mais invisible).
	 *
	 *  Si l'utilisateur a rempli un ou plusieurs champs, le modèle n'est pas
	 * vide (la variable _POST contenait des données lors de l'appel à
	 * ModelUser::signIn()) et contient éventuellement une ou plusieurs erreurs.
	 * 
	 * \todo Revoir le modèle ModelUser et les interactions entre ce dernier, la
	 * page index et cette vue.
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
				echo '<span style="color: red;">' . $err . '</span><br/>';
			}

			include_once('templates/signin_form.php');
		}
		else
		{
			include_once('templates/signin_success.php');
		}

		echo '</section>';

		include_once("templates/footer.php");
		include_once("templates/end.php");

		ob_end_flush();
	}
}
