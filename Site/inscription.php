<?php
	try
	{
		$bdd = new PDO("mysql:host=localhost;dbname=PPE;charset=utf8", "phpmyadmin", "phpmyadmin*1");
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}

	if (isset($_POST["pseudo"]))
	{
		$mdp_hashe=password_hash($_POST["mdp"], PASSWORD_DEFAULT);
		if (empty($_POST["nom"])) {
			$nom="Non renseigner";
		} else {
			$nom=$_POST["nom"];
		}
		if (empty($_POST["prenom"])) {
			$prenom="Non renseigner";
		} else {
			$prenom=$_POST["prenom"];
		}
		if (empty($_POST["sexe"])) {
			$sexe="Non renseigner";
		} else {
			$sexe=$_POST["sexe"];
		}
		if (empty($_POST["adresse"])) {
			$adresse="Non renseigner";
		} else {
			$adresse=$_POST["adresse"];
		}
		if (empty($_POST["ville"])) {
			$ville="Non renseigner";
		} else {
			$ville=$_POST["ville"];
		}
		if (empty($_POST["bio"])) {
			$bio="Non renseigner";
		} else {
			$bio=$_POST["bio"];
		}

		$requete1 = $bdd->prepare("INSERT INTO membres(pseudo, pass, email, nom, prenom, sexe, adresse, CP, ville, telephone, biographie) VALUES(:pseudo, :pass, :email, :nom, :prenom, :sexe, :adresse, :CP, :ville, :telephone, :biographie)");
		$requete1->execute(array(
		   "pseudo" => $_POST["pseudo"],
		   "pass" => $mdp_hashe,
		   "email" => $_POST["mail"],
			"nom" => $nom,
			"prenom" => $prenom,
			"sexe" => $sexe,
			"adresse" => $adresse,
			"CP" => $_POST["cp"],
			"ville" => $ville,
			"telephone" => $_POST["tel"],
			"biographie" => $bio));
		$requete1->closeCursor();

		$requete2 = $bdd->prepare("SELECT id, pseudo FROM membres WHERE pseudo = :pseudo");
		$requete2->execute(array(
			"pseudo" => $_POST["pseudo"]));
		$resultat = $requete2->fetch();
		$requete2->closeCursor();

		session_start();
		$_SESSION["id"] = $resultat["id"];
		$_SESSION["pseudo"] = $resultat["pseudo"];
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Inscription</title>
		<link rel="stylesheet" href="header.css" />
		<link rel="stylesheet" href="inscription.css" />
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
					<li id="gestion_compte"><a href="gestion_compte.php" class="menu">Gestion du compte</a></li>
					<li id="administration"><a href="administration.php" class="menu">Administration</a></li>
					<li id="a_propos"><a href="a_propos.php" class="menu">A propos</a></li>
					<li><a href="inscription.php" class="inscr_conn">Inscription</a></li>
					<li><a href="connexion.php" class="inscr_conn">Connexion</a></li>
				</ul>
			</nav>
		</header>
      <section>
         <h2>Inscription</h2>
         <form action="inscription.php" method="post">
				<fieldset>
					<legend>Informations de connexion</legend>
	            <label for="pseudo">Pseudo <span id="requis">*</span></label>
	            <input type ="text" id="pseudo" name="pseudo" required />
	            <label for="mdp">Mot de passe <span id="requis">*</span></label>
	            <input type="password" id="mdp" name="mdp" required />
	            <label for="mail">Adresse mail <span id="requis">*</span></label>
	            <input type="email" id="mail" name="mail" required />
					<span id="requis">* Champ requis</span>
				</fieldset>
				<fieldset>
					<legend>Informations personnelles</legend>
					<label for="nom">Nom <span id="optionnel">*</span></label>
	            <input type="text" id="nom" name="nom" />
	            <label for="prenom">Prénom <span id="optionnel">*</span></label>
	            <input type="text" id="prenom" name="prenom" />
					<p>Sexe : <span id="optionnel">*</span></p>
					<p>
						<input type="radio" value="homme" id="homme" name="sexe" />
						<label for="homme"><span></span>Homme</label>
					</p>
					<p id="r_femme">
						<input type="radio" value="femme" id="femme" name="sexe" />
						<label for="femme"><span></span>Femme</label>
					</p>
					<p id="r_autre">
						<input type="radio" value="autres" id="autre" name="sexe" />
						<label for="autre"><span></span>Autre</label>
					</p>
					<label for="adresse">Adresse <span id="optionnel">*</span></label>
					<input type="text" id="adresse" name="adresse" />
					<label for="cp">Code postale <span id="optionnel">*</span></label>
					<input type="text" id="cp" name="cp" />
					<label for="ville">Ville <span id="optionnel">*</span></label>
					<input type="text" id="ville" name="ville" />
					<label for="tel">Numéro de téléphone <span id="optionnel">*</span></label>
					<input type="tel" id="tel" name="tel" />
					<label for="bio">Votre biographie <span id="optionnel">*</span></label>
					<textarea name="bio" id="bio" rows="8" cols="24" maxlength="1000"></textarea>
					<span id="optionnel">* Champ optionnels</span>
				</fieldset>
				<label for="image" id="envoyer">Envoyer :</label>
				<input type="image" id="image" name="image" src="design/lame.png" alt="Lame d'assassin d'Assassin's Creed" />
        	</form>
    	</section>
	</body>
</html>
