<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php

		$resultat=mysqli_query($link,'SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC='.$_SESSION["numC"].';');
		//echo 'SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC='.$_SESSION["numC"].';';
		$requete=mysqli_fetch_row($resultat);
		foreach ($requete as $poke) {

			SetViePokemonSeul($poke,GetVieMaxPokemonSeul($poke));
		
			$resultatBis=mysqli_query($link,'SELECT att1,att2,att3,att4  FROM PokemonSeul WHERE numero='.$poke.';');
			$requeteBis=mysqli_fetch_row($resultatBis);

			$compteur = 1;
			foreach ($requeteBis as $att) {
				if ($att != null)
				{
					SetPpPokemonSeul($poke,$compteur,GetPpAttaque($att));
				}
				$compteur++;
			}
		}
?>