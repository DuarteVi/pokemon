<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (!(isset($_COOKIE["lieu"])))
	{
		if (!(isset($_GET["lieu"])) || $_GET["lieu"] < 0 || $_GET["lieu"] > 11)
		{
			header('Location: carte.php');
		}
		else
		{
			if ($_GET["lieu"] > GetNiveauDresseur($_SESSION['numC'])/10+1)
			{
				header('Location: carte.php');
			}
			else
			{
				setcookie('lieu', $_GET["lieu"]);
				header('Location: safari.php');
			}
		}
	}
	else
	{
		if(!isset($_SESSION["pokemonApparu"]) || empty($_SESSION["pokemonApparu"]))
		{
			$_SESSION['pokemonApparu'] = genererPokemonLieu($_COOKIE["lieu"]);
			//setcookie('pokemonApparu',serialize($pokemonApparu));
		}
		/*else
		{
			$pokemonApparu = unserialize($_COOKIE["pokemonApparu"]);
		}*/
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Safari</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="css_safari.css">
</head>
<body>

	
	
	<!-- <img src="imagesPoke/foret.png" id="fond"> -->
	<div id="tout">
	<div id="centrerLesPokemons">
	<!-- POKEMON ENNEMIE -->
	<div id='pokemonApparuDiv'>
	<?php
		//$pokemon = genererPokemon();

			echo "<table id='pokemonApparuTable' class='pokemonCombat'>";
					echo "<tr><td>";
						echo "<div id='pokemonApparuInfo' class='pokemonCombatInfo'>";
							echo "	<div id='gauche'>".$_SESSION['pokemonApparu']['surnom']."</div>
									<div id='droite'>Lv".$_SESSION['pokemonApparu']['niveau']."</div>";
							echo "<div id='contourVie'> <div id='vieEnnemie'></div></div>";
								echo "<input type='hidden' id='pokevieEnnemie' value='".$_SESSION['pokemonApparu']['vie']."'/>";
								echo "<input type='hidden' id='pokevieMaxEnnemie' value='".$_SESSION['pokemonApparu']['vieMax']."'/>";
								/*echo "<form action='safari.php' method='POST' id='capturer'>
										<input type='hidden' name='pokemon' value='".serialize($pokemonApparu)."'>
										</form>";		*/
						echo "</div>";
				echo "</td><td><img class='imgpokemon' id='imgPokemonApparu' src='gifsPoke/".$_SESSION['pokemonApparu']['nump']."_1.gif'>";
				/*echo "<img src='imagesPoke/sol_".$_COOKIE['lieu'].".png'>";*/
				echo "<img class='imgsol' src='imagesPoke/sol_1.png'>";
				echo "</td></tr>";
			echo "</table>";
	?>
</div>
	<!-- POKEMON DU DRESSEUR -->
	<?php

	//On prend le premier pokemon dont il reste de la vie
	$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon where numC=".$_SESSION['numC'].";");
	$requete =mysqli_fetch_row($resultat);
	$compteur=0;
	foreach ($requete as $pokemon) {
		if ($pokemon != NULL)
		{
			/*$resultatBis=mysqli_query($link,"SELECT vie FROM PokemonSeul WHERE numero=".$pokemon.";");
			$requeteBis=mysqli_fetch_row($resultatBis);*/
			if (GetViePokemonSeul($pokemon) > 0 && $compteur==0)	// Le premier dont il reste de la vie
			{
				$pokemonChoisie = $pokemon;
				$_SESSION["pokemonChoisie"] = $pokemon;
				$compteur++;
			}
		}
	}
	if ($compteur==0)
	{
		$pokemonChoisie = 0;
		header('Location: centrepokemon.php');
	}
	//$pokemonChoisie = 1;

	?>
<div id='pokemonEquipeDiv'>
	<?php
		$query = "SELECT numP,surnom,niveau,vie,vieMax FROM PokemonSeul where numero=".$pokemonChoisie.";";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
		echo "<table id='pokemonEquipeTable' class='pokemonCombat'>";
				echo "<tr><td>";
					echo "<img class='imgpokemon' id='imgPokemonChoisi' src='gifsPoke/".$requete[0]."_2.gif'>";
					/*echo "<img src='imagesPoke/sol_".$_COOKIE['lieu'].".png'>";*/
					echo "<img class='imgsol' src='imagesPoke/sol_1.png'>";
				echo "</td><td>";
						echo "<div id='pokemonEquipeInfo' class='pokemonCombatInfo'>";
							echo "<div id='gauche'>".$requete[1]."</div><div id='droite'>Lv".$requete[2]."</div>";
							echo "<div id='contourVie'><div id='vieEquipe'></div></div>";
								echo "<input type='hidden' id='pokevieEquipe' value='".$requete[3]."'/>";
								echo "<input type='hidden' id='pokevieMaxEquipe' value='".$requete[4]."'/>";
								//echo "<input type='hidden' id='pokemonChoisie' value='".$pokemonChoisie."'/>";
						echo "</div>";
				echo "</td></tr>";
		echo "</table>";
	?>
</div>
	</div>	<!-- FIN div#centrerLesPokemons-->


	
		<div class="partieBas" id="partieMenu">
			<div class="bouton" id="sacBouton" onclick="AfficherSac()">sac</div>
			<div class="bouton" id="attaqueBouton" onclick="AfficherAttaque()">attaque!</div>
			<div class="bouton" id="pokemonBouton" onclick="AfficherPokemon()">pokemon</div>
			<div class="bouton" id="fuiteBouton" onclick="Fuite()">fuite</div>
		</div>
		<!-- -------------------------------------------------------------------------------------- -->
		<div class="partieBas" id="partieSac">
			<div class="bouton" id="sacPotion" onclick="AfficherPotion()">
				Potions
			</div>
			<div class="bouton" id="sacPokeball" onclick="AfficherPokeball()">
				Pokeballs
			</div>
			<div class="bouton" id="sacRetour" onclick="AfficherMenu()">retour</div>
		</div>

		<div class="partieBas" id="partieSoin">
			<!-- <div class="bouton" id="normalSoin" onclick="Potion(1)"> -->
			<div class="bouton" id="normalSoin" onclick="Action(1,1)"> <!-- Action(action,donnee) -->
			<?php 
				/*$resultat=mysqli_query($link,'SELECT soin FROM sac WHERE numC = '.$_SESSION['numC'].';');
				$requete=mysqli_fetch_row($resultat);
				$soin = $requete[0];
				echo "Potion(s) [".$soin."]";
				echo "<input type='hidden' name='potion1' id='potion1' value='".$soin."'>";*/
				echo "<img src='imagesPoke/Potion.png'> Potion(s) [".GetSoinSac($_SESSION['numC'])."]";
				//echo "<input type='hidden' name='potion1' id='potion1' value='".GetSoinSac($_SESSION['numC'])."'>";
			?>
			</div>
			<!-- <div class="bouton" id="superSoin" onclick="Potion(2)"> -->
			<div class="bouton" id="superSoin" onclick="Action(1,2)"> <!-- Action(action,donnee) -->
			<?php 
				/*$resultat=mysqli_query($link,'SELECT soinS FROM sac WHERE numC = '.$_SESSION['numC'].';');
				$requete=mysqli_fetch_row($resultat);
				$soin = $requete[0];
				echo "Super Potion(s) [".$soin."]";
				echo "<input type='hidden' name='potion2' id='potion2' value='".$soin."'>";*/
				echo "<img src='imagesPoke/superpotion.png'> Super Potion(s) [".GetSoinSSac($_SESSION['numC'])."]";
				//echo "<input type='hidden' name='potion2' id='potion2' value='".GetSoinSSac($_SESSION['numC'])."'>";
			?>
			</div>
			<!-- <div class="bouton" id="hyperSoin" onclick="Potion(3)"> -->
			<div class="bouton" id="hyperSoin" onclick="Action(1,3)"> <!-- Action(action,donnee) -->
			<?php 
				/*$resultat=mysqli_query($link,'SELECT soinH FROM sac WHERE numC = '.$_SESSION['numC'].';');
				$requete=mysqli_fetch_row($resultat);
				$soin = $requete[0];
				echo "Hyper Potion(s) [".$soin."]";
				echo "<input type='hidden' name='potion3' id='potion3' value='".$soin."'>";*/
				echo "<img src='imagesPoke/hyperpotion.png'> Hyper Potion(s) [".GetSoinHSac($_SESSION['numC'])."]";
				//echo "<input type='hidden' name='potion3' id='potion3' value='".GetSoinHSac($_SESSION['numC'])."'>";
			?>
			</div>
			<div class="bouton" id="retourSac" onclick=" AfficherSac()">Retour</div>
		</div>

		<div class="partieBas" id="partiePokeball">
			<!-- <div class="bouton" id="normalBall" onclick="LancerPokeball(1)"> -->
			<div class="bouton" id="normalBall" onclick="Action(2,1)"> <!-- Action(action,donnee) -->
			<?php 
				/*$resultat=mysqli_query($link,'SELECT pokeB FROM sac WHERE numC = '.$_SESSION['numC'].';');
				$requete=mysqli_fetch_row($resultat);
				$ball = $requete[0];
				echo "Pokeball(s) [".$ball."]";
				echo "<input type='hidden' name='pokeball1' id='pokeball1' value='".$ball."'>";*/
				echo "<img src='imagesPoke/pokeball.png'> Pokeball(s) [".GetPokeBSac($_SESSION['numC'])."]";
				echo "<input type='hidden' name='pokeball1' id='pokeball1' value='".GetPokeBSac($_SESSION['numC'])."'>";
			?>
			</div>
			<!-- <div class="bouton" id="superBall" onclick="LancerPokeball(2)"> -->
			<div class="bouton" id="superBall" onclick="Action(2,2)"> <!-- Action(action,donnee) -->
			<?php 
				/*$resultat=mysqli_query($link,'SELECT SuperB FROM sac WHERE numC = '.$_SESSION['numC'].';');
				$requete=mysqli_fetch_row($resultat);
				$ball = $requete[0];
				echo "SuperBall(s) [".$ball."]";
				echo "<input type='hidden' name='pokeball2' id='pokeball2' value='".$ball."'>";*/
				echo "<img src='imagesPoke/super-ball.png'> SuperBall(s) [".GetSuperBSac($_SESSION['numC'])."]";
				echo "<input type='hidden' name='pokeball2' id='pokeball2' value='".GetSuperBSac($_SESSION['numC'])."'>";
			?>
			</div>
			<!-- <div class="bouton" id="hyperBall" onclick="LancerPokeball(3)"> -->
			<div class="bouton" id="hyperBall" onclick="Action(2,3)"> <!-- Action(action,donnee) -->
			<?php 
				/*$resultat=mysqli_query($link,'SELECT HyperB FROM sac WHERE numC = '.$_SESSION['numC'].';');
				$requete=mysqli_fetch_row($resultat);
				$ball = $requete[0];
				echo "HyperBall(s) [".$ball."]";
				echo "<input type='hidden' name='pokeball3' id='pokeball3' value='".$ball."'>";*/
				echo "<img src='imagesPoke/hyperball.png'> HyperBall(s) [".GetHyperBSac($_SESSION['numC'])."]";
				echo "<input type='hidden' name='pokeball3' id='pokeball3' value='".GetHyperBSac($_SESSION['numC'])."'>";
			?>
			</div>
			<div class="bouton" id="retourSac" onclick=" AfficherSac()">Retour</div>
		</div>

		<!-- -------------------------------------------------------------------------------------- -->
		<div class="partieBas" id="partieAttaque">
			
		</div>

		<!-- -------------------------------------------------------------------------------------- -->
		<div class="partieBas" id="partiePokemon">
			
		</div>

		<!-- -------------------------------------------------------------------------------------- -->
			<div class="partieBas" id="partieTexte">
				<br/>
			</div>
		<!-- -------------------------------------------------------------------------------------- -->

	<img src="imagesPoke/attraper.gif" id="fond2">
	</div>
	
	<script type="text/javascript" src="java_safariGestion.js"></script>
	<script type="text/javascript" src="java_safariCombat.js"></script>
	<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>