<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php 
	if (isset($_SESSION['moi']) && isset($_SESSION['adversaire']) && isset($_SESSION['numCombat']))
	{
		$_SESSION['moi']=null;
		$_SESSION['adversaire']=null;
		$_SESSION['numCombat']=null;
		$_SESSION["pokemonMoi"]=null;
		$_SESSION["pokemonAdversaire"]=null;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Arène</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_choisiradversaire.css">
</head>
<body>
	<!-- <img id="fond" src="imagesPoke/areneDeFond.jpg"> -->
	<div id="tout">

		<div class="bouton" id="NonAmis">
			<h4>Rechercher un Adversaire :</h4>
			<div id="listeNonAmis">
			</div>
		</div>


		<div class="bouton" id="retour" onclick="RetourMenu()">
			retour
		</div>


		<div class="bouton" id="Amis">
			<h4>Rechercher parmi mes Amis :</h4>
			<div id="listeAmis">
			</div>
		</div>
	</div>

	<script type="text/javascript" src="java_choisiradversaire.js"></script>
	<script type="text/javascript" src="java_connecter.js"></script>

</body>
</html>