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

	if (isset($_SESSION["pseudo"])) {
		$requete1 = $bdd->prepare("SELECT * FROM membres WHERE pseudo = :pseudo");
		$requete1->execute(array(
		   "pseudo" => $_SESSION["pseudo"]));
		$donnees = $requete1->fetch();
		$requete1->closeCursor();

		if (empty($_POST["pseudo"])) {
			$pseudo=$donnees["pseudo"];
		} else {
			$pseudo=$_POST["pseudo"];
		}
		if (empty($_POST["mdp"]) AND empty($_POST["nouv_mdp"])) {
			$mdp=$donnees["pass"];
		} else {
			$isPasswordCorrect = password_verify($_POST["mdp"], $donnees["pass"]);
			if ($isPasswordCorrect) {
				$mdp=password_hash($_POST["nouv_mdp"], PASSWORD_DEFAULT);
			} else {
				$mdp=$donnees["pass"];
			}
		}
		if (empty($_POST["mail"])) {
			$mail=$donnees["email"];
		} else {
			$mail=$_POST["mail"];
		}
		if (empty($_POST["nom"])) {
			$nom=$donnees["nom"];
		} else {
			$nom=$_POST["nom"];
		}
		if (empty($_POST["prenom"])) {
			$prenom=$donnees["prenom"];
		} else {
			$prenom=$_POST["prenom"];
		}
		if (empty($_POST["sexe"])) {
			$sexe=$donnees["sexe"];
		} else {
			$sexe=$_POST["sexe"];
		}
		if (empty($_POST["adresse"])) {
			$adresse=$donnees["adresse"];
		} else {
			$adresse=$_POST["adresse"];
		}
		if (empty($_POST["cp"])) {
			$cp=$donnees["CP"];
		} else {
			$cp=$_POST["cp"];
		}
		if (empty($_POST["ville"])) {
			$ville=$donnees["ville"];
		} else {
			$ville=$_POST["ville"];
		}
		if (empty($_POST["tel"])) {
			$tel=$donnees["telephone"];
		} else {
			$tel=$_POST["tel"];
		}
		if (empty($_POST["bio"])) {
			$bio=$donnees["biographie"];
		} else {
			$bio=$_POST["bio"];
		}

		$requete2 = $bdd->prepare("UPDATE membres SET pseudo=:pseudo, pass=:pass, email=:email, nom=:nom, prenom=:prenom, sexe=:sexe, adresse=:adresse, CP=:CP, ville=:ville, telephone=:telephone, biographie=:biographie WHERE pseudo=:nom_pseudo");
		$requete2->execute(array(
			"nom_pseudo" => $_SESSION["pseudo"],
			"pseudo" => $pseudo,
			"pass" => $mdp,
			"email" => $mail,
			"nom" => $nom,
			"prenom" => $prenom,
			"sexe" => $sexe,
			"adresse" => $adresse,
			"CP" => $cp,
			"ville" => $ville,
			"telephone" => $tel,
			"biographie" => $bio));
		$requete2->closeCursor();
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Gestion du compte</title>
		<link rel="stylesheet" href="header.css" />
		<link rel="stylesheet" href="gestion_compte.css" />
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
					<!-- N'oubliez pas de déplacer l'id="en_cour" à la page en cours. Ex : pour la page gestion_compte, enlever l'id de index, et le remettre à gestion_compte. -->
					<li><a href="index.php" class="menu">Accueil</a></li>
					<li id="gestion_compte"><a href="gestion_compte.php" class="menu" id="en_cour">Gestion du compte</a></li>
					<li id="administration"><a href="administration.php" class="menu">Administration</a></li>
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
			<h2>Gestion du Compte</h2>
			<form action="gestion_compte.php" method="post">
				<fieldset>
					<legend>Modification des informations de connexion</legend>
	            <label for="pseudo">Pseudo actuelle : <?php echo $donnees["pseudo"]; ?></label>
	            <input type ="text" id="pseudo" name="pseudo" placeholder="Nouveau Pseudo" />
	            <label for="mdp">Mot de passe</label>
					<?php
						if (isset($isPasswordCorrect))
						{
							if (!$isPasswordCorrect)
							{
					?>
								<span id="erreur">Mot de passe actuelle incorrect !</span>
					<?php
							}
						}
					?>
	            <input type="password" id="mdp" name="mdp" placeholder="Mot de passe actuelle" />
					<input type="password" id="nouv_mdp" name="nouv_mdp" placeholder="Nouveau mot de passe" />
	            <label for="mail">Adresse mail actuelle : <?php echo $donnees["email"]; ?></label>
					<input type="email" id="mail" name="mail" placeholder="Nouvelle adresse mail" />
				</fieldset>
				<fieldset>
					<legend>Modification des informations personnelles</legend>
					<label for="nom">Nom actuelle : <?php echo $donnees["nom"]; ?></label>
	            <input type="text" id="nom" name="nom" placeholder="Nouveau nom" />
	            <label for="prenom">Prénom actuelle : <?php echo $donnees["prenom"]; ?></label>
	            <input type="text" id="prenom" name="prenom" placeholder="Nouveau prénom" />
					<label for="adresse">Adresse actuelle : <?php echo $donnees["adresse"]; ?></label>
					<input type="text" id="adresse" name="adresse" placeholder="Nouvelle adresse" />
					<label for="cp">Code postale actuelle : <?php echo $donnees["CP"]; ?></label>
					<input type="text" id="cp" name="cp" placeholder="Nouveau code postale" />
					<label for="ville">Ville actuelle : <?php echo $donnees["ville"]; ?></label>
					<input type="text" id="ville" name="ville" placeholder="Nouvelle ville" />
					<label for="tel">Numéro de telephone actuelle : <?php echo $donnees["telephone"]; ?></label>
					<input type="tel" id="tel" name="tel" placeholder="Nouveau numéro de téléphone" />
					<label for="bio">Votre biographie</label>
					<textarea name="bio" id="bio" rows="8" cols="24" maxlength="1000"><?php echo $donnees["biographie"]; ?></textarea>
				</fieldset>
				<label for="image" id="envoyer">Envoyer les modifications :</label>
				<input type="image" id="image" name="image" src="design/lame.png" alt="Lame d'assassin d'Assassin's Creed" />
			</form>
      </section>
	</body>
</html>
