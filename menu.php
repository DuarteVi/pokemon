<?php include('bdd.php'); ?>
<?php include('security.php'); ?>


<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_menu.css">
</head>
<body>
		<video id="fond"  autoplay loop muted>
			<source src="imagesPoke/fond2.mp4" type="video/mp4">
			Your browser does not support HTML5 video.
		</video>
		<div id="tout">
			<div class="bouton" id="Sac" onclick="Sac()">
				Sac
			</div>
			<div class="bouton" id="Safari" onclick="Carte()">
				Safari
			</div>
			<div class="bouton" id="Ordinateur" onclick="Ordinateur()">
				Ordinateur
			</div>
			<div class="bouton" id="Magasin" onclick="Magasin()">
				Magasin
			</div>
			<div class="bouton" id="Pokecentre" onclick="Pokecentre()">
				Centre Pokemon
			</div>
			<div class="bouton" id="Combat"  onclick="Combat()">
				Combat
			</div>
			<div class="bouton" id="Info" onclick="Infodresseur()">
				Info Dresseur
			</div>
			<div class="bouton" id="Deconnexion" onclick="Deconnexion()">
				Déconnexion
			</div>
		</div>

		<script type="text/javascript" src="java_menu.js"></script>
		<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>