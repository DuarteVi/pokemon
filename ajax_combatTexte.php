<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php

	if (isset($_POST['messageDebut1']))
	{
		echo "Un ".$_SESSION['pokemonApparu']['surnom']." sauvage apparaît";
	}

	if (isset($_POST['messageDebut2']))
	{
		echo "Que doit faire ".GetSurnomPokemonSeul($_SESSION['pokemonChoisie'])." ?";
	}

	if (isset($_POST['EcrireUtiliserPotion']))
	{
		if ($_POST['EcrireUtiliserPotion'] == 1)
		{
			echo GetNomDresseur($_SESSION['numC'])." utilise Potion";
		}
		else if ($_POST['EcrireUtiliserPotion'] == 2)
		{
			echo GetNomDresseur($_SESSION['numC'])." utilise Super Potion";
		}
		else
		{
			echo GetNomDresseur($_SESSION['numC'])." utilise Hyper Potion";
		}
	}

	if (isset($_POST['EcrireUtilisationPokeball']))
	{
		if ($_POST['EcrireUtilisationPokeball'] == 1)
		{
			echo GetNomDresseur($_SESSION['numC'])." lance Pokeball";
		}
		else if ($_POST['EcrireUtilisationPokeball'] == 2)
		{
			echo GetNomDresseur($_SESSION['numC'])." lance Superball";
		}
		else
		{
			echo GetNomDresseur($_SESSION['numC'])." lance Hyperball";
		}
	}

	if (isset($_POST['EcrirePokemonSeRetire']))
	{
		echo GetSurnomPokemonSeul($_SESSION['pokemonChoisie'])." se retire";
	}

	if (isset($_POST['EcrirePokemonRentreAuCombat']))
	{
		echo GetNomDresseur($_SESSION['numC'])." appelle ".GetSurnomPokemonSeul($_SESSION['pokemonChoisie']);
	}

	if (isset($_POST['EcrireAttaqueUtilise']))
	{
		echo GetSurnomPokemonSeul($_SESSION['pokemonChoisie'])." lance ".GetNomAttaque(GetAttaqueParNumero($_POST['EcrireAttaqueUtilise'],$_SESSION['pokemonChoisie']));
	}

	if (isset($_POST['EcrirePokemonSortDeLaPokeball']))
	{
		echo $_SESSION['pokemonApparu']['surnom']." s`est échappé";
	}






	if (isset($_POST['CombatDegatCvA'])){

		$attaque = GetAttPokemonSeul($_SESSION['pokemonChoisie'],($_POST['CombatDegatCvA']+1));

		$coef1 = GetCoeffType(GetTypeAttaque($attaque),$_SESSION['pokemonApparu']['type1']);
		//echo "<br>coef1=".$coef1;
		$coef2 = GetCoeffType(GetTypeAttaque($attaque),$_SESSION['pokemonApparu']['type2']);
		//echo "<br>coef2=".$coef2."<br>";
		if (($coef1 == 0.5 && $coef2 == 1 )||($coef2 == 0.5 && $coef1 == 1 ))
		{
			$coef=0.5;
		}
		else
		{
			$coef = max($coef1,$coef2);
			//echo "<br>coef=".$coef."<br>";
		}
		
		$degat = (GetDegatAttaque($attaque) * GetStatPokemonSeul($_SESSION['pokemonChoisie'],'F') * $coef) / ($_SESSION['pokemonApparu']['statD']*2);
		if($degat < 1 ){
			$degat = 1;
		}
	
		$_SESSION['pokemonApparu']['vie'] = $_SESSION['pokemonApparu']['vie'] - $degat ; 
		if($_SESSION['pokemonApparu']['vie'] < 0 ){

			$_SESSION['pokemonApparu']['vie'] = 0 ;
		}
		if ($coef == 0.5 ) {
			echo "Ce n`est pas très efficace ";

		}
		if ($coef == 2 ) {
			echo "C'est super efficace ";

		}
		if ($coef == 1 ) {
			echo  $_SESSION['pokemonApparu']['surnom']." a subis des dégats ";

		}
		//echo "<br>coef=".$coef."<br>";

	}

	if (isset($_POST['GetViePA']))
	{
		echo $_SESSION['pokemonApparu']['vie'];
	}

	if (isset($_POST['PokemonApparuVaincu']))
	{
		$query = "SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		foreach ($requete as $pokemon) {
			if ($pokemon)
			{
				SetXpPokemonSeul($pokemon,(GetXpPokemonSeul($pokemon)+($_SESSION['pokemonApparu']['niveau']+$_COOKIE["lieu"])*10));
				while (GetXpPokemonSeul($pokemon) >= GetNiveauPokemonSeul($pokemon)*10)
				{
					SetXpPokemonSeul($pokemon,(GetXpPokemonSeul($pokemon)-GetNiveauPokemonSeul($pokemon)*10));
					SetNiveauPokemonSeul($pokemon,GetNiveauPokemonSeul($pokemon)+1);

					SetStatPokemonSeul($pokemon,'F',(GetStatPokemonSeul($pokemon,'F')+3));
					SetStatPokemonSeul($pokemon,'D',(GetStatPokemonSeul($pokemon,'D')+3));
					SetStatPokemonSeul($pokemon,'V',(GetStatPokemonSeul($pokemon,'V')+3));

					SetVieMaxPokemonSeul($pokemon,(GetVieMaxPokemonSeul($pokemon)+3));

					SetViePokemonSeul($pokemon,(GetViePokemonSeul($pokemon)+3));
				}

				if (GetEvolutionPokedex(GetNumpPokemonSeul($pokemon)))
				{
					if (GetNiveauPokemonSeul($pokemon) > GetPalierPokedex(GetNumpPokemonSeul($pokemon)))
					{
						$pokeS = GetpokemonSPokedex(GetNumpPokemonSeul($pokemon));
						if ($pokeS == 134)
						{
							$pokeS = $pokeS + rand(0,2);
						}
						SetNumpPokemonSeul($pokemon,$pokeS);

						$niveau = GetNiveauPokemonSeul($pokemon);

						SetStatPokemonSeul($pokemon,'F',(GetStatPokedex(GetNumpPokemonSeul($pokemon),'F')+$niveau*3));
						SetStatPokemonSeul($pokemon,'D',(GetStatPokedex(GetNumpPokemonSeul($pokemon),'D')+$niveau*3));
						SetStatPokemonSeul($pokemon,'V',(GetStatPokedex(GetNumpPokemonSeul($pokemon),'V')+$niveau*3));

						SetVieMaxPokemonSeul($pokemon,(GetPvPokedex(GetNumpPokemonSeul($pokemon))+$niveau*3));

						SetSurnomPokemonSeul($pokemon,GetNomPokedex(GetNumpPokemonSeul($pokemon)));

						RemplirPokedex(GetNumpPokemonSeul($pokemon));
					}
				}
			}
		}

		SetPokeDSac($_SESSION['numC'],(GetPokeDSac($_SESSION['numC'])+50*$_COOKIE["lieu"]));

		SetXpDresseur($_SESSION['numC'],(GetXpDresseur($_SESSION['numC'])+(10*($_COOKIE["lieu"])*$_SESSION['pokemonApparu']['niveau'])));

		while (GetXpDresseur($_SESSION['numC']) >= GetNiveauDresseur($_SESSION['numC'])*10)
		{
			SetXpDresseur($_SESSION['numC'],(GetXpDresseur($_SESSION['numC'])-GetNiveauDresseur($_SESSION['numC'])*10));
			SetNiveauDresseur($_SESSION['numC'],(GetNiveauDresseur($_SESSION['numC'])+1));
		}

		echo "Vous pokemons ont gagné ".(($_SESSION['pokemonApparu']['niveau']+$_COOKIE["lieu"])*10)." xp <br> Vous gagnez ".(50*$_COOKIE["lieu"])."<img src='imagesPoke/pokedollar.png' id='dollar' style='width:10px;height:10px;'/><br>
			Vous gagnez ".(10*($_COOKIE["lieu"])*$_SESSION['pokemonApparu']['niveau'])."xp. Vous êtes donc de niveau : ".GetNiveauDresseur($_SESSION['numC']);
	}



	if (isset($_POST['CombatDegatAvC']))
	{
		$att=rand(0,$_SESSION['pokemonApparu']['nombreAtt'])+1;

		echo $att;
	}



	if (isset($_POST['CombatDegatAvCBis']))
	{
		echo $_SESSION['pokemonApparu']['surnom']." lance ".GetNomAttaque($_SESSION['pokemonApparu']['attaque']['att'.$_POST['CombatDegatAvCBis']]) ;
	}



	if (isset($_POST['CombatDegatAvCTer']))
	{

		$attaque = $_SESSION['pokemonApparu']['attaque']['att'.$_POST['CombatDegatAvCTer']];


		$coef1 = GetCoeffType(GetTypeAttaque($attaque),GetType1Pokedex(GetNumpPokemonSeul($_SESSION['pokemonChoisie'])));
		//echo "<br>coef1=".$coef1;
		$coef2 = GetCoeffType(GetTypeAttaque($attaque),GetType2Pokedex(GetNumpPokemonSeul($_SESSION['pokemonChoisie'])));
		//echo "<br>coef2=".$coef2."<br>";
		if (($coef1 == 0.5 && $coef2 == 1 )||($coef2 == 0.5 && $coef1 == 1 ))
		{
			$coef=0.5;
		}
		else
		{
			$coef = max($coef1,$coef2);
			//echo "<br>coef=".$coef."<br>";
		}
		
		$degat = (GetDegatAttaque($attaque) * $_SESSION['pokemonApparu']['statF'] * $coef) / (GetStatPokemonSeul($_SESSION['pokemonChoisie'],'D')*2);
		if($degat < 1 ){
			$degat = 1;
		}

		SetViePokemonSeul($_SESSION['pokemonChoisie'],(GetViePokemonSeul($_SESSION['pokemonChoisie'])-$degat));

		if ($coef == 0.5 ) {
			echo "Ce n`est pas très efficace ";

		}
		if ($coef == 2 ) {
			echo "C'est super efficace ";

		}
		if ($coef == 1 ) {
			echo GetSurnomPokemonSeul($_SESSION['pokemonChoisie'])." a subis des dégats ";

		}

	}

	if (isset($_POST['GetViePC']))
	{
		echo GetViePokemonSeul($_SESSION['pokemonChoisie']);
	}


	if (isset($_POST['GetAttaquePremier']))
	{
		if ( GetStatPokemonSeul($_SESSION['pokemonChoisie'],"V") >= $_SESSION['pokemonApparu']['statV'])
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	if (isset($_POST['GetViePokemonChoisie']))
	{
		echo GetViePokemonSeul($_SESSION['pokemonChoisie']);
	}



	if (isset($_POST['NbPokemonEnVie']))
	{
		$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon where numC=".$_SESSION['numC'].";");
		$requete =mysqli_fetch_row($resultat);
		$compteur=0;
		foreach ($requete as $pokemon) {
			if ($pokemon != NULL)
			{
				if (GetViePokemonSeul($pokemon) > 0)	// Le premier dont il reste de la vie
				{
					$compteur++;
				}
			}
		}

		echo $compteur;
	}

	if (isset($_POST['ChoisirPokemonSurvivantBis']))
	{
		$pokemonChoisie = $_SESSION["pokemonChoisie"];

		$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon where numC=".$_SESSION['numC'].";");
		$requete=mysqli_fetch_row($resultat);
		$compteur=0;
		foreach ($requete as $pokemon) {
			if ( $pokemon != NULL && $pokemon != 0 && $pokemon != $pokemonChoisie)
			{
				$resultatBis=mysqli_query($link,"SELECT nump,surnom,niveau,vie,vieMax FROM PokemonSeul where numero=".$pokemon.";");
				$requeteBis=mysqli_fetch_row($resultatBis);
				if ($requeteBis[3] > 0)
				{
					/*echo "<div class='bouton' id='pokemon".$compteur."' onclick='PokemonChoisie(".$pokemon.")'>";*/
					//Action(action,donnee)
					echo "<div class='bouton' id='pokemon".$compteur."' onclick='Action(4,".$pokemon.")'>";
					echo "<img id='pokemonImage".$compteur."' src='imagesPoke/".$requeteBis[0]."_pokemon_1.png'> ".$requeteBis[1]." (Pv:".$requeteBis[3]."/".$requeteBis[4].") Lv:".$requeteBis[2];
				echo "</div>";
				}
			}
		$compteur++;
		}
		echo "<div class='bouton' id='pokemonRetour' onclick='Fuite()''>Fuite</div>";
	}




?>
