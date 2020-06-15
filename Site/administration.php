<?php
$bdd = new PDO('mysql:host=192.168.237.133;dbname=administration;charset=utf8', 'root', '')
			
if(isset($_GET['type']) AND !empty($_GET['type'] == 'membre') {
	if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
		$confirme = (int) $_GET['confirme'];

		$req = $bdd->prepare('UPDATE membre SET confirme = 1 WHERE id = ?');
		$req->execute(array($confirme));
	} 

	if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
		$supprime = (int) $_GET['confirme'];

		$req = $bdd->prepare('DELETE FROM membre WHERE id = ?');
		$req->execute(array($supprime)); 
	}
} elseif(if(isset($_GET['type']) AND !empty($_GET['type'] == 'commentaire') {) {
	if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
		$approuve = (int) $_GET['approuve'];

		$req = $bdd->prepare('UPDATE commentaires SET approuve = 1 WHERE id = ?');
		$req->execute(array($confirme));
	} 

	if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
		$supprime = (int) $_GET['confirme'];

		$req = $bdd->prepare('DELETE FROM commentaires WHERE id = ?');
		$req->execute(array($supprime)); 
	}
}

$membres = $bdd->query('SELECT * FROM membres ORDER BY id DESC');
$commentaires = $bdd->query('SELECT * FROM commentaires ORDER BY id DESC');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="header.css" />
		<link rel="stylesheet" href="administration.css" />
		<link rel="stylesheet" href="assassin/stylesheet.css" />
		<link rel="icon" sizes="144x144" href="design/icon.png" />
	</head>
	<body>
		<header>
			<img src="design/ac2logo.png" alt="Logo d'Assassin's Creed II" />
			<h1>Assassin's Creed II</h1>
			<nav>
				<ul>
					<li><a href="index.html" class= "menu">Accueil</a></li>
					<li><a href="gestion_compte.html" class="menu">Gestion du compte</a></li>
					<li><a href="administration.php" id="en_cour">Administration</a></li>
					<li id="a_propos"><a href="a_propos.html" class="menu">A propos</a></li>
					<li><a href="inscription.html" class="inscr_conn">Inscription</a></li>
					<li><a href="connexion.html" class="inscr_conn">Connexion</a></li>
				</ul>
			</nav>
		</header>
			<br />
			<h1>Administration</h1>
			<br />
		<section>
			<h2>Administration</h2>
			<ul>
				<?php while($m = $membres->fetch()) { ?>
				<li><?= $m['id'] ?> : <?= $m['pseudo'] ?><?php if($m['confirme'] == 0) { ?> - <a href="administration.php?type=membre&confirme=<?= $m['id'] ?>">Confirmer</a><?php} ?> - <a 					href="administration.php?type=membre&supprime=<?= $m['id'] ?>">Supprimer</a></li>
				<?php } ?>
			</ul>
			<br />
			<br />
			<ul>
				<?php while($c = $commentaires->fetch()) { ?>
				<li><?= $c['id'] ?> : <?= $c['pseudo'] ?> : <?= $c['contenu'] ?><?php if($c['approuve'] == 0) { ?> - <a href="administration.php?type=commentaire&approuve=<?=$c['id'] 					?>">Approuver</a><?php} ?> - <a href="administration.php?type=commentaire&supprime=<?= $c['id'] ?>">Supprimer</a></li>
				<?php } ?>

			</ul>
		</section>
	</body>
</html>
