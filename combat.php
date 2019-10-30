<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (!(isset($_SESSION['moi']) && isset($_SESSION['adversaire']) && isset($_SESSION['numCombat']))
		|| (empty($_SESSION['moi'] && empty($_SESSION['adversaire']) && empty($_SESSION['numCombat']))))
	{
		$query = "SELECT numCombat,j1,j2,pokemonj1,pokemonj2 FROM Combat WHERE j1=".$_SESSION['numC']." OR j2=".$_SESSION['numC'];

		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete[1] != null && $requete[0] !=null)
		{
			if ($requete[1] == $_SESSION['numC'])
			{
				$_SESSION["moi"]=1;
				$_SESSION["pokemonMoi"]=$requete[3];
				$_SESSION["adversaire"]=2;
				$_SESSION["pokemonAdversaire"]=$requete[4];
				
			}
			else
			{
				$_SESSION["moi"]=2;
				$_SESSION["pokemonMoi"]=$requete[4];
				$_SESSION["adversaire"]=1;
				$_SESSION["pokemonAdversaire"]=$requete[3];
			}
			$_SESSION["numCombat"]=$requete[0];
		}
		else
		{
			header('Location: choisiradversaire.php');
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Combat</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">	
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_combat.css">
</head>
<body>
	<!-- <img id="fond" src="imagesPoke/terrain.png"> -->
	<div id="tout">

	<div id="centrerLesPokemons">
		<div id='pokemonAdversaire'>
			<?php
					echo "<table id='pokemonApparuTable' class='pokemonCombat'>";
							echo "<tr><td>";
								echo "<div id='pokemonApparuInfo' class='pokemonCombatInfo'>";
									echo "	<div id='gauche'>".GetSurnomPokemonSeul($_SESSION['pokemonAdversaire'])."</div>
											<div id='droite'>Lv".GetNiveauPokemonSeul($_SESSION['pokemonAdversaire'])."</div>";
									echo "<div id='contourVie'> <div id='vieEnnemie'></div></div>";
										echo "<input type='hidden' id='pokevieEnnemie' value='".GetViePokemonSeul($_SESSION['pokemonAdversaire'])."'/>";
										echo "<input type='hidden' id='pokevieMaxEnnemie' value='".GetVieMaxPokemonSeul($_SESSION['pokemonAdversaire'])."'/>";
								echo "</div>";
						echo "</td><td><img class='imgpokemon' id='imgPokemonApparu' src='gifsPoke/".GetNumpPokemonSeul($_SESSION['pokemonAdversaire'])."_1.gif'>";
						echo "<img class='imgsol' src='imagesPoke/sol_1.png'>";
						echo "</td></tr>";
					echo "</table>";
			?>
		</div>

		<div id='pokemonMoi'>
			<?php
				echo "<table id='pokemonEquipeTable' class='pokemonCombat'>";
					echo "<tr><td>";
						echo "<img class='imgpokemon' id='imgPokemonChoisi' src='gifsPoke/".GetNumpPokemonSeul($_SESSION['pokemonMoi'])."_2.gif'>";
						echo "<img class='imgsol' src='imagesPoke/sol_1.png'>";
					echo "</td><td>";
							echo "<div id='pokemonEquipeInfo' class='pokemonCombatInfo'>";
								echo "<div id='gauche'>".GetSurnomPokemonSeul($_SESSION['pokemonMoi'])."</div><div id='droite'>Lv".GetNiveauPokemonSeul($_SESSION['pokemonMoi'])."</div>";
								echo "<div id='contourVie'><div id='vieEquipe'></div></div>";
									echo "<input type='hidden' id='pokevieEquipe' value='".GetViePokemonSeul($_SESSION['pokemonMoi'])."'/>";
									echo "<input type='hidden' id='pokevieMaxEquipe' value='".GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])."'/>";
							echo "</div>";
					echo "</td></tr>";
				echo "</table>";
			?>
		</div>
	</div>




		<div id="tempsDeBase">
			<div id="temps"></div>
		</div>
		<div class="partieBas" id="PartieMenu">
			<div class="bouton" id="Soin" onclick="AfficherSoin()">Potion(s)</div>
			<div class="bouton" id="Attaque" onclick="AfficherAttaque()">Attaque(s)</div>
			<div class="bouton" id="Pokemon" onclick="AfficherPokemon()">Pokemon(s)</div>
			<div class="bouton" id="Abandonner" onclick="Abandonner()">Abandonner</div>
		</div>

		<div class="partieBas" id="PartieSoin">
		</div>

		<div class="partieBas" id="PartieAttaque">
		</div>

		<div class="partieBas" id="PartiePokemon">
		</div>

		<div class="partieBas" id="partieTexte">
				<br/>
			</div>

	</div>
		<script type="text/javascript" src="java_combat.js"></script>
		<script type="text/javascript" src="java_combatObjet.js"></script>
		<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>