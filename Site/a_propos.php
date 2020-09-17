<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>A propos</title>
		<link rel="stylesheet" href="header.css" />
		<link rel="stylesheet" href="a_propos.css" />
		<?php
			if (isset($_SESSION["pseudo"]))
			{
				if ($_SESSION["pseudo"]=="admin")
				{
		?>
					<link rel="stylesheet" href="ajout_administration.css" />
		<?php
				}
				else
				{
		?>
					<link rel="stylesheet" href="ajout_gestion_compte.css" />
		<?php
				}
			}
		?>
		<link rel="stylesheet" href="assassin/stylesheet.css" />
		<link rel="stylesheet" href="roboto_thin/stylesheet.css" />
		<link rel="icon" sizes="144x144" href="design/icon.png" />
	</head>
	<body>
		<header>
			<img src="design/ac2logo.png" alt="Logo d'Assassin's Creed II" />
			<h1>Assassin's Creed II</h1>
			<nav>
				<ul>
					<li><a href="index.php" class="menu">Accueil</a></li>
					<li id="gestion_compte"><a href="gestion_compte.php" class="menu">Gestion du compte</a></li>
					<li id="administration"><a href="administration.php" class="menu">Administration</a></li>
					<li id="a_propos"><a href="a_propos.php" class="menu" id="en_cour">A propos</a></li>
					<?php
						if (!isset($_SESSION["pseudo"]))
						{
					?>
							<li><a href="inscription.php" class="inscr_conn">Inscription</a></li>
							<li><a href="connexion.php" class="inscr_conn">Connexion</a></li>
					<?php
						}
						else
						{
					?>
							<li><a href="deconnexion.php" class="inscr_conn">Deconnexion</a></li>
					<?php
						}
					?>
				</ul>
			</nav>
		</header>
	<section>
        	<h2>A propos</h2>
		<br />
		<p>
			<span class="titre">Notre Concept</span>
			<br />
			<br />
			Assassin's Creed II fait partie des jeux de la saga mondial "Assassin's Creed" et est considérer par beaucoup de fans comme le pilier de la série. Notre site est avant toutn un 				site pour les fans du jeu et de la saga de manière général. Néanmoins si vous ne faites pas partie de ces personnes mais que vous souhaiter en savoir plus sur la saga, alors vous 				êtes au bon endroit.Fans en tout genre, spécialistes des jeux et leurs histoires, futur fans ou joueur en recherche de réponses à leurs questions et en recherche de débats, soyez 				les bienvenus. Inscrivez vous sur le site, créer votre compte et passer un agréable momment en compagnie des autres assassins. N'oubliez pas la règle essentiel : "Rien n'est vrai, 				tout est permis".
		</p>
		<br />
		<p>
			<span class="titre">Notre Histoire</span>
			<br />
			<br />
			Nous somme un petite équipe de fans et de joueurs avant tout. Assassin's Creed étant notre saga de prédiléction, nous avions envie de créer un site dédié aux fans de cette saga ou 				d'un des jeux en particulier (pour nous vous avez dû remarquez lequel) mais pas seulement. Sur le web il existe beaucoup de site ou de forum pour les fans mais la plupart sont 			focalisé sur un seul et unique sujet et sans laissé de réel liberté aux membres en terme de discussion, de débat et de partage. Nous sommes différents, notre équipe  à créer un 				site déstinée à tout le monde, Assassin's Creed est une saga qui raconte l'hisotire de la guilde des assassins, la guilde à des branches partout dans le monde et nous, nous 				voulions créer notre branche sur le web. Soyez la bienvenu Assassins.
		</p>
		<br />
		<p>
			<span class="titre">Notre Equipe</span>
			<br />
			<br />
			Nous somme trois développeurs et aussi trois fans de la série. Nous avons élaborer ce projet dans son intégralité à seulement trois personnes sachant que le site à été entièrement 				codé à la main. Nous sommes une équipe de volontaires et de passionnés, ayant un objectif commun : réunnir tous les fans de la communauté francophone à travers le web au même 				endroit dans un esprit d'entraide et de partage.
		</p>
	</section>
	<aside>
		<p>Les Mentors :
		<br />
		<br />
		- Mathieu PROT
		<br />
		- Dimitri OBEID
		<br />
		- Romain MARTIN
		<br />
		</p>
	</aside>
	</body>
</html>
