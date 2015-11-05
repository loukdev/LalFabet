				<aside>
					<ul>
						<li><a href="?signin">S'inscrire</a></li>
						<li>
            <?php if (!isset($_SESSION['cpt_pseudo']))
                  { 
                    ?> <a href="?connect">Se connecter</a>
            <?php } 
                  else
                  {
                    ?><a href="?disconnect">Se déconnecter</a>
            <?php } ?>
            </li>

            <br />

						<li><a href="">Ajouter une publication</a></li>
					</ul>
				</aside>
