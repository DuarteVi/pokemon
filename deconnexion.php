<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	SetConnecterUtilisateur($_SESSION["numC"],0);
	session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title> Déconnexion </title>
		<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
		<link rel="stylesheet"  href="css_general.css">
		<meta charset="utf-8">
	</head>
	<body>

			<img id="fond" src="imagesPoke/deconnexion.jpg">

		<div id="tout">
			<h1 style='text-align:center;'>Déconnexion</h1>
			<p>Veuillez attendre quelque instant le temps que votre session soit déconnecté</p>
		</div>
		
		<script type="text/javascript">
			setTimeout (function (){location.href = 'pokemonaccueil.php';},2000);
		</script>
	</body>