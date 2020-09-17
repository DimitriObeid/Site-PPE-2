<?php
	session_start();
	try
	{
		$bdd = new PDO("mysql:host=localhost;dbname=PPE;charset=utf8", "phpmyadmin", "phpmyadmin*1");
	}
	catch (Exception $e)
	{
			  die("Erreur : " . $e->getMessage());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Administration</title>
		<link rel="stylesheet" href="header.css" />
		<link rel="stylesheet" href="administration.css" />
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
					<li><a href="index.php" class= "menu">Accueil</a></li>
					<li id="gestion_compte"><a href="gestion_compte.php" class="menu">Gestion du compte</a></li>
					<li id="administration"><a href="administration.php" id="en_cour">Administration</a></li>
					<li id="a_propos"><a href="a_propos.php" class="menu">A propos</a></li>
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
			<h2>Administration</h2>
			<p>
				<span>Liste des membres</span><br /><br />
				Kasam
				<a href="administration.php">Supprimer</a><br /><br />

				Dimob
				<a href="administration.php">Supprimer</a><br /><br />

				Leukos
				<a href="administration.php">Supprimer</a><br /><br />

				Rockvald
				<a href="administration.php">Supprimer</a><br /><br />
			</p>
		</section>
	</body>
</html>
