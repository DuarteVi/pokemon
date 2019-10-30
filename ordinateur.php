<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Ordinateur</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_ordinateur.css">
</head>
<body>
	
	<!-- <img id="fond" src="imagesPoke/pikachu.jpg"> -->
	<div id="tout">
<div class="boite"  id="partie1">
	<div class="sousboite"  id="eqPokemon">

</div>



	<div class="bouton" id="retour" onclick="RetourMenu()">
		retour
	</div>
</div>
<div class="boite" id="ordinateur">

</div>
<div class="boite" id="InfoPokemon">

</div>
</div>

	<script type="text/javascript" src="java_ordinateur.js"></script>
	<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>