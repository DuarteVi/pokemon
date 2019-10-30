<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Info Dresseur</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_infodresseur.css">
</head>
<body>
	
	<!-- <img id="fond" src="imagesPoke/test4.jpg"> -->
	<div id="tout">
		<div class="bouton" id="divfinfo">
			<div id="image">
				<?php echo "<img src='imagesPoke/sexe".GetSexeDresseur($_SESSION["numC"]).".png'>"; ?>
			</div>
			<div id="boiteInfoDresseur">
				
			</div>
			<div id="amis">
				<div id="nouveauxAmi">
					<table>
						<tr><td>Rechercher</td></tr>
						<tr><td><input type="search" id="rechercherNouveauAmi" placeholder="Saisir Un Nom" style="width: 100%;" onkeyup="AfficherNouveauAmi()"/></td></tr>
					</table>
					<div class='rechercherAmi' id='newAmi'>
					</div>
				</div>
				<div id="voirProfil">
				</div>
				<div id="amiConfirmer">
					<table>
						<tr><td>Rechercher Dans Mes Amis</td></tr>
						<tr><td><input type="search" id="rechercherAmiConfirmer" placeholder="Saisir Un Nom" style="width: 100%;" onkeyup="AfficherAmiConfirmer()"/></td></tr>
					</table>
					<div class='rechercherAmi' id='oldAmi'>
					</div>
				</div>
			</div>

			<div class="bouton" id="retour" onclick="RetourMenu()">
					retour
			</div>
		</div>
	</div>

	
	<script type="text/javascript" src="java_infodresseur.js"></script>
	<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>
