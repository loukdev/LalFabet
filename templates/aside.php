				<aside>
					<ul>
			<?php	if(!isset($_SESSION['cpt_pseudo']))
					{ 
					?>	<li><a href="?signin">S'inscrire</a></li>
						<li>
							<a href="?connect">Se connecter</a>
            <?php	}
					else
					{
					?>		<a href="?disconnect">Se déconnecter</a>
            <?php	}
					if(isset($_SESSION['grp_id']))
					{
						
					?>	<li><a href="?user=<?php echo $_SESSION['cpt_pseudo']; ?>">Profil (<?php echo $_SESSION['cpt_pseudo']; ?>)</a></li>
			<?php	}

		?>	</li>

            <br />
			<?php
			if (isset($_SESSION['cpt_pseudo']) and $_SESSION['cpt_pseudo'] != '')
			{
				?>		<li><a href="">Ajouter une publication</a></li>
	  <?php } ?>
					</ul>
				</aside>
