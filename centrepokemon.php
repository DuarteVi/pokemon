<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Centre Pokemon</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_centrepokemon.css">
</head>
<body>


	<!-- <img src="imagesPoke/centrepokemon.png" id="fond">-->
	<div id="tout">
		<?php
			$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
			$requete=mysqli_fetch_row($resultat);
			$compteur=1;
			foreach ($requete as $poke) {
				$resultatBis=mysqli_query($link,"SELECT numP,vie,vieMax  FROM PokemonSeul WHERE numero=".$poke.";");
				echo "<div id='case'>";
				if ($resultatBis)
				{
					$requeteBis=mysqli_fetch_row($resultatBis);
					echo "<div id='unite'><img id='pokemon' src='imagesPoke/".$requeteBis[0]."_pokemon_1.png'></div>";
					echo "<div id='unite2' class='unite2_".$compteur."'>";
						echo "<div id='vie".$compteur."'></div>";
					echo "</div>";
					echo "<input type='hidden' id='pokevie".$compteur."' value='".$requeteBis[1]."'/>";
					echo "<input type='hidden' id='pokevieMax".$compteur."' value='".$requeteBis[2]."'/>";
					$compteur++;
				}
				echo "</div>";
			}
		?>

		<div class="bouton" id="soigner" onclick="Soigner()">
			soigner
		</div>

		<div class="bouton" id="retour" onclick="RetourCentrePokemon()">
			retour
		</div>
		
	</div>
	<script type="text/javascript" src="java_centrepokemon.js"></script>
	<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>