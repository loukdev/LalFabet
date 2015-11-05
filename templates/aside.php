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
                    ?><a href="?disconnect">Se déconnecter (<?php echo $_SESSION['cpt_pseudo']; ?>)</a>
            <?php } ?>
            </li>

            <br />
<?php
if (isset($_SESSION['cpt_pseudo']) and $_SESSION['cpt_pseudo'] != '')
{
?>
						<li><a href="">Ajouter une publication</a></li>
<?php
}
?>
					</ul>
				</aside>
