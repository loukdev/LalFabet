			<section>
				<?php include_once("aside.php"); ?>

				<!-- Un <article></article> pour chaque publication : -->
				<article id="presentation">
					<h1> Mais qu'est-ce don' l'AlFabet ? </h1>
					<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. </p>
				</article>
				<?php foreach($articles as $article) {
					include("home_article.php");
				} ?>

			</section>
