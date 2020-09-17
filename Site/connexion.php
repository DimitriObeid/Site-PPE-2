<?php
	try
	{
		$bdd = new PDO("mysql:host=localhost;dbname=PPE;charset=utf8", "phpmyadmin", "phpmyadmin*1");
	}
	catch (Exception $e)
	{
			  die("Erreur : " . $e->getMessage());
	}

	if (isset($_POST["pseudo"])) {
		//  Récupération de l'utilisateur et de son mot de passe hashé
		$requete = $bdd->prepare("SELECT id, pseudo, pass FROM membres WHERE pseudo = :pseudo");
		$requete->execute(array(
			"pseudo" => $_POST["pseudo"]));
		$resultat = $requete->fetch();
		$requete->closeCursor();

		// Comparaison du mot de passe envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST["mdp"], $resultat["pass"]);

		if ($resultat AND $isPasswordCorrect)
		{
			session_start();
			$_SESSION["id"] = $resultat["id"];
			$_SESSION["pseudo"] = $resultat["pseudo"];
			header("Location: index.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Connexion</title>
		<link rel="stylesheet" href="header.css" />
		<link rel="stylesheet" href="connexion.css" />
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
					<li id="administration"><a href="administration.hmtl" class="menu">Administration</a></li>
					<li id="a_propos"><a href="a_propos.php" class="menu">A propos</a></li>
					<li><a href="inscription.php" class="inscr_conn">Inscription</a></li>
					<li><a href="connexion.php" class="inscr_conn">Connexion</a></li>
				</ul>
			</nav>
		</header>
		<section>
			<h2>Connexion</h2>
			<form action="connexion.php" method="post">
				<fieldset>
               <label>Pseudo</label>
               <input type ="text" id="pseudo" name="pseudo" required />
					<label>Mot de passe</label>
               <input type="password" id="mdp" name="mdp" required />
				</fieldset>
				<?php
					if (isset($resultat) OR isset($isPasswordCorrect))
					{
						if (!$resultat OR !$isPasswordCorrect)
						{
				?>
							<span id="incorrect">Mauvais identifiant ou mot de passe !</span>
				<?php
						}
					}
				?>
				<label for="image" id="connexion">Valider :</label>
				<input type="image" id="image" name="image" src="design/lame.png" alt="Lame d'assassin d'Assassin's Creed" />
        	</form>
		</section>
	</body>
</html>
