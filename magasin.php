<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Magasin</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_magasin.css">
</head>
<body>

</body>
<!-- <img id="fond" src="imagesPoke/boutiquePokemon.jpg"> -->

<div id="tout">
		<div id="commercer">
			<div class="bouton" id="acheter" onclick="AcheterDesChoses()">
				Acheter
			</div>
			<div class="bouton" id="vendre" onclick="VendreDesChoses()">
				Vendre
			</div>
			<div id="argent">
			</div>
		</div>

		<div id="acheterVendre">
				<div id="innerAcheterVendre">
					<?php echo "<h1>Bienvenue</h1><h3><br/>Bonjour ".GetNomDresseur($_SESSION['numC'])." <br/><br/>Que puis-je faire pour vous aujourd'hui ?</h3>" ?>
				</div>
		</div>

		<div class="bouton" id="retour" onclick="RetourMenu()">
			retour
		</div>

</div>

<script type="text/javascript" src="java_magasin.js"></script>
<script type="text/javascript" src="java_connecter.js"></script>

</html>