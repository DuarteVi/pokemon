<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php

if(isset($_POST['InfoPoke']))
{
	$resultat=mysqli_query($link,"SELECT pokemon FROM PokedexParDresseur WHERE numC=".$_SESSION["numC"].";");
	$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
	echo "<div id='block1'><div  id='nom'>".GetNomPokedex($_POST['InfoPoke'])."</div> <div><img src='imagesPoke/".$_POST['InfoPoke']."_pokemon_1.png' id='impok' > </div> </div>";
	echo "<div id='block2'><div class ='colonne' id='ligne'>Type </div><div class ='colonne' id='type".GetType1Pokedex($_POST['InfoPoke'])."'>".GetNomType(GetType1Pokedex($_POST['InfoPoke']))."</div><div class ='colonne' id='type".GetType2Pokedex($_POST['InfoPoke'])."'> ";
	echo GetNomType(GetType2Pokedex($_POST['InfoPoke']))."</div>";
	 if (GetEvolutionPokedex($_POST['InfoPoke'])){
	 	echo  "<br><div class ='colonne' id='ligne'>Evolution:</div><div class ='colonne'>".GetNomPokedex(GetpokemonSPokedex($_POST['InfoPoke']))."</div>";
	 }
	 echo "<br><div class ='colonne' id='ligne'>Lieu d'apparition:</div><div class ='colonne'>".GetLieuPokedex($_POST['InfoPoke'])."</div></div>";
	 echo "<p id= 'ecrit'> statistique </p>";
	echo "<div id='block4'><div class ='colonne' id='ligne'> Stat Force </div><div class ='colonne'>".GetStatPokedex($_POST['InfoPoke'],'F')."</div>";
	echo "<div class ='colonne' id='ligne'> Stat Defence </div><div class ='colonne'>".GetStatPokedex($_POST['InfoPoke'],'D')."</div>";
	echo "<div class ='colonne' id='ligne'> Stat Vitesse </div><div class ='colonne'>".GetStatPokedex($_POST['InfoPoke'],'V')."</div>";
	echo "<div class ='colonne' id='ligne'> Vie </div><div class ='colonne'>".GetPvPokedex($_POST['InfoPoke'])."</div></div>";
	echo "<p id= 'ecrit2'> Information Générale </p>";
	echo "<input type='button' name='fermerinfo' id='fermerinfo' value='X' onclick='fermer()'>";
}

if (isset($_POST['SoignerEquipe']))
{
	
	$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
	$requete=mysqli_fetch_row($resultat);

	echo "<ol id='equipe'>";
		$compteur = 1;
		foreach ($requete as $eqPoke)
		{
			if ($eqPoke)
			{				
					echo "<li onclick='SoignerUnPokemon(".$_POST['SoignerEquipe'].",".$compteur.")'>";
						echo "<table><tr><td>";
						echo "<img id='pokemonimage' src='imagesPoke/".GetNumpPokemonSeul($eqPoke)."_pokemon_1.png'></td><td>".GetSurnomPokemonSeul($eqPoke)."</td></tr></table>";
						echo "<div id='vieMax' class='vieMax".$compteur."'>";
						echo "<div id='vie".$compteur."'></div>";
					echo "</div>";
					echo "<input type='hidden' id='pokevie".$compteur."' value='".GetViePokemonSeul($eqPoke)."'/>";
					echo "<input type='hidden' id='pokevieMax".$compteur."' value='".GetVieMaxPokemonSeul($eqPoke)."'/>";
					$compteur++;
					echo "</li>";
					//echo "<div id=''>"..."</div>";
					
				
			}
		}
		echo "</ol>";
		echo "<input type='button' value='fermer' onclick='apparaitreb()'>";
}

if (isset($_POST['SoignerUnPokemonSoin']) && isset($_POST['SoignerUnPokemonPokemon']))
{
	$pokemon = GetPokemonEqPokemon($_SESSION['numC'],$_POST['SoignerUnPokemonPokemon']);
	if ($_POST['SoignerUnPokemonSoin'] == 1) // Potion
	{
		SetSoinSac($_SESSION['numC'],GetSoinSac($_SESSION['numC'])-1);
		SetViePokemonSeul($pokemon,GetViePokemonSeul($pokemon)+50);
	}
	if ($_POST['SoignerUnPokemonSoin'] == 2) // Super Potion
	{
		SetSoinSSac($_SESSION['numC'],GetSoinSSac($_SESSION['numC'])-1);
		SetViePokemonSeul($pokemon,GetViePokemonSeul($pokemon)+100);
	}
	if ($_POST['SoignerUnPokemonSoin'] == 3) // Hyper Potion
	{
		SetSoinHSac($_SESSION['numC'],GetSoinHSac($_SESSION['numC'])-1);
		SetViePokemonSeul($pokemon,GetViePokemonSeul($pokemon)+150);
	}

}


?>