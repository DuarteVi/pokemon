<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	
	if (isset($_POST['JoueurMoi']))
	{
		echo $_SESSION['moi'];
	}

	if (isset($_POST['GetActionAdversaire']))
	{
		echo GetActionCombat($_SESSION['adversaire'],$_SESSION['numCombat']);
	}

	if(isset($_POST['Abandon']))
	{
		echo GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." abandonne le combat";
	}
	if(isset($_POST['EcrireRecompense']))
	{
		$argentMax = GetPokeDSac(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']));
		$argentMin = 500 * (GetNiveauDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))/GetNiveauDresseur($_SESSION['numC']));
		$argentMin = intval($argentMin);
		
		$argent = min($argentMax,$argentMin);

		SetPokeDSac(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']),GetPokeDSac(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))-$argent);
		SetPokeDSac($_SESSION['numC'],GetPokeDSac($_SESSION['numC'])+$argent);


		echo "Vous gagnez de l'argents";
	}

	if (isset($_POST['SetActionMoi']))
	{
		SetActionCombat($_SESSION['moi'],$_SESSION['numCombat'],$_POST['SetActionMoi']);
	}
	if (isset($_POST['SetActionAversaire']))
	{
		SetActionCombat($_SESSION['adversaire'],$_SESSION['numCombat'],$_POST['SetActionAversaire']);
	}
	if (isset($_POST['SetPokemonMoi']))
	{
		$_SESSION['pokemonMoi'] = $_POST['SetPokemonMoi'];
	}
	if (isset($_POST['SetPokemonAdversaire']))
	{
		$_SESSION['pokemonAdversaire'] = $_POST['SetPokemonAdversaire'];
	}
	
	if (isset($_POST['QuitterPage']))
	{

		$choixAdversaire = GetActionCombat($_SESSION['adversaire'],$_SESSION['numCombat']);
		$choixMoi = GetActionCombat($_SESSION['moi'],$_SESSION['numCombat']);

		if ($choixMoi != 18 ) //Rechargement de page voulu (après changement de pokémon mort)
		{
			SetActionCombat($_SESSION['moi'],$_SESSION['numCombat'],14);
			if ($choixAdversaire == 14)
			{
				SupprimerCombat($_SESSION['numCombat']);
			}
		}
		
		
	}

	if(isset($_POST['PasserSonTour']))
	{
		echo GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." passe son tour";
	}

	if(isset($_POST['GetViePokemonAdversaire']))
	{
		echo GetViePokemonSeul($_SESSION['pokemonAdversaire']);
	}
	if(isset($_POST['GetViePokemonMoi']))
	{
		echo GetViePokemonSeul($_SESSION['pokemonMoi']);
	}
	if(isset($_POST['GetVitesseMoi']))
	{
		echo GetStatPokemonSeul($_SESSION['pokemonMoi'],'V');
	}
	if(isset($_POST['GetVitesseAdversaire']))
	{
		echo GetStatPokemonSeul($_SESSION['pokemonAdversaire'],'V');
	}

	if (isset($_POST['GetpokemonAdversaire']))
	{
		$_SESSION['pokemonAdversaire'] = GetPokemonCombat($_SESSION['adversaire'],$_SESSION["numCombat"]);
		echo $_SESSION['pokemonAdversaire'];
	}

	/* ------------------------------------------------------------------------------------------------------------------------------------------------- */
	/* Affichage Ajax */
	/* ------------------------------------------------------------------------------------------------------------------------------------------------- */
	if (isset($_POST['PotionAffichageAjax']))
	{
		if(GetSoinSac($_SESSION['numC']) > 0)
		{
			echo "<div class='bouton' id='Potion' onclick='ActionMoi(1)'>Potion [".GetSoinSac($_SESSION['numC'])."]</div>";
		}
		else
		{
			echo "<div class='bouton' id='Potion'>Potion [".GetSoinSac($_SESSION['numC'])."]</div>"; // pas de onclick
		}
		if (GetSoinSSac($_SESSION['numC']) > 0)
		{
			echo "<div class='bouton' id='SuperPotion' onclick='ActionMoi(2)'>SuperPotion [".GetSoinSSac($_SESSION['numC'])."]</div>";
		}
		else
		{
			echo "<div class='bouton' id='SuperPotion'>SuperPotion [".GetSoinSSac($_SESSION['numC'])."]</div>";
		}
		if (GetSoinHSac($_SESSION['numC']) > 0)
		{
			echo "<div class='bouton' id='HyperPotion' onclick='ActionMoi(3)'>HyperPotion [".GetSoinHSac($_SESSION['numC'])."]</div>";
		}
		else
		{
			echo "<div class='bouton' id='HyperPotion'>HyperPotion [".GetSoinHSac($_SESSION['numC'])."]</div>";
		}
		echo "<div class='bouton' id='retourMenu' onclick='AfficherMenu()'>Retour</div>";
	}
	if (isset($_POST['AttaqueAffichageAjax']))
	{
		for ($i=1; $i < 5; $i++) { 
			if (GetAttPokemonSeul($_SESSION["pokemonMoi"],$i))
			{
				$attaque=GetAttPokemonSeul($_SESSION["pokemonMoi"],$i);
				if(GetPpPokemonSeul($_SESSION["pokemonMoi"],$i) > 0)
				{
					echo "<div class='bouton' id='att' onclick='ActionMoi(".($i+3).")'>".GetNomAttaque($attaque)." (".GetNomType(GetTypeAttaque($attaque)).") PP:".GetPpPokemonSeul($_SESSION["pokemonMoi"],$i)."/".GetPpAttaque($attaque)."</div>";
				}
				else
				{
					echo "<div class='bouton' id='att'>".GetNomAttaque($attaque)." (".GetNomType(GetTypeAttaque($attaque)).") PP:".GetPpPokemonSeul($_SESSION["pokemonMoi"],$i)."/".GetPpAttaque($attaque)."</div>";
				}
			}
		}
		echo "<div class='bouton' id='retourMenu' onclick='AfficherMenu()'>Retour</div>";
	}

	if (isset($_POST['PokemonAffichageAjax']))
	{
		$query  = "SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numc=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		$compteur = 7; 
		foreach ($requete as $pokemon) {
			$compteur++;
			if ($pokemon && $pokemon!=$_SESSION['pokemonMoi'] && GetViePokemonSeul($pokemon)>0)
			{
				echo "<div class='bouton' id='pokemonRemplacent' onclick='ActionMoi(".$compteur.")'>";
					echo "<img src='imagesPoke/".GetNumpPokemonSeul($pokemon)."_pokemon_1.png' > ".GetSurnomPokemonSeul($pokemon)." (Pv:".GetViePokemonSeul($pokemon)."/".GetVieMaxPokemonSeul($pokemon).") Lv:".GetNiveauPokemonSeul($pokemon);
				echo "</div>";
			}
		}
		echo "<div class='bouton' id='retourMenu' onclick='AfficherMenu()'>Retour</div>";
	}









	/* -------------------------------------------------------------------------------------------------------------------------- */
	/* UTILISER POTION */
	if (isset($_POST['UtiliserPotionMoi']))
	{
		if ($_POST['UtiliserPotionMoi'] == 1)
		{
			SetSoinSac($_SESSION['numC'],(GetSoinSac($_SESSION['numC'])-1));

			$soin = min (50,(GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])-GetViePokemonSeul($_SESSION['pokemonMoi'])));
			SetViePokemonSeul($_SESSION['pokemonMoi'],GetViePokemonSeul($_SESSION['pokemonMoi'])+$soin);

			echo "Vous utilisez Potion";
		}
		else if ($_POST['UtiliserPotionMoi'] == 2)
		{
			SetSoinSSac($_SESSION['numC'],(GetSoinSSac($_SESSION['numC'])-1));

			$soin = min (100,(GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])-GetViePokemonSeul($_SESSION['pokemonMoi'])));
			SetViePokemonSeul($_SESSION['pokemonMoi'],GetViePokemonSeul($_SESSION['pokemonMoi'])+$soin);

			echo "Vous utilisez Super Potion";
		}
		else
		{
			SetSoinHSac($_SESSION['numC'],(GetSoinHSac($_SESSION['numC'])-1));

			$soin = min (150,(GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])-GetViePokemonSeul($_SESSION['pokemonMoi'])));
			SetViePokemonSeul($_SESSION['pokemonMoi'],GetViePokemonSeul($_SESSION['pokemonMoi'])+$soin);

			echo "Vous utilisez Hyper Potion";
		}
	}
	/*if (isset($_POST['SoignerPokemonMoi']))
	{
		if ($_POST['SoignerPokemonMoi'] == 1)
		{
			$soin = min (50,(GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])-GetViePokemonSeul($_SESSION['pokemonMoi'])));
			SetViePokemonSeul($_SESSION['pokemonMoi'],$soin);
			echo $soin;
		}
		else if ($_POST['SoignerPokemonMoi'] == 2)
		{
			$soin = min (100,(GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])-GetViePokemonSeul($_SESSION['pokemonMoi'])));
			SetViePokemonSeul($_SESSION['pokemonMoi'],$soin);
			echo $soin;
		}
		else
		{
			$soin = min (150,(GetVieMaxPokemonSeul($_SESSION['pokemonMoi'])-GetViePokemonSeul($_SESSION['pokemonMoi'])));
			SetViePokemonSeul($_SESSION['pokemonMoi'],$soin);
			echo $soin;
		}
	}*/

	if (isset($_POST['UtiliserPotionAdversaire']))
	{
		if ($_POST['UtiliserPotionAdversaire'] == 1)
		{
			echo GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." utilise Potion";
		}
		else if ($_POST['UtiliserPotionAdversaire'] == 2)
		{
			echo GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." utilise Super Potion";
		}
		else
		{
			echo GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." utilise Hyper Potion";
		}
	}
	if (isset($_POST['SoignerPokemonAdversaire']))
	{
		if ($_POST['SoignerPokemonAdversaire'] == 1)
		{
			$soin = min (50,(GetVieMaxPokemonSeul($_SESSION['pokemonAdversaire'])-GetViePokemonSeul($_SESSION['pokemonAdversaire'])));
			echo $soin;
		}
		else if ($_POST['SoignerPokemonAdversaire'] == 2)
		{
			$soin = min (100,(GetVieMaxPokemonSeul($_SESSION['pokemonAdversaire'])-GetViePokemonSeul($_SESSION['pokemonAdversaire'])));
			echo $soin;
		}
		else
		{
			$soin = min (150,(GetVieMaxPokemonSeul($_SESSION['pokemonAdversaire'])-GetViePokemonSeul($_SESSION['pokemonAdversaire'])));
			echo $soin;
		}
	}








	/* -------------------------------------------------------------------------------------------------------------------------- */
	/* UTILISER ATTAQUE */
	if (isset($_POST['UtiliserAttaqueMoi']))
	{
		$att  = $_POST['UtiliserAttaqueMoi'] - 3; //Les actions des potions
		$attaque = GetAttPokemonSeul($_SESSION['pokemonMoi'],$att);
		$coef1 = GetCoeffType(GetTypeAttaque($attaque),GetType1Pokedex(GetNumpPokemonSeul($_SESSION['pokemonAdversaire'])));
		$coef2 = GetCoeffType(GetTypeAttaque($attaque),GetType2Pokedex(GetNumpPokemonSeul($_SESSION['pokemonAdversaire'])));
		if (($coef1 == 0.5 && $coef2 == 1 )||($coef2 == 0.5 && $coef1 == 1 ))
		{
			$coef=0.5;
		}
		else
		{
			$coef = max($coef1,$coef2);
		}
		$degat = (GetDegatAttaque($attaque) * GetStatPokemonSeul($_SESSION['pokemonMoi'],'F') * $coef) / (GetStatPokemonSeul($_SESSION['pokemonAdversaire'],'D')*2);
		if($degat < 1 ){
			$degat = 1;
		}
		SetViePokemonSeul($_SESSION['pokemonAdversaire'],(GetViePokemonSeul($_SESSION['pokemonAdversaire'])-$degat));

		echo GetSurnomPokemonSeul($_SESSION['pokemonMoi'])." lance ".GetNomAttaque($attaque)."<br>";
		if ($coef == 0.5 ) {
			echo "<br>Ce n`est pas très efficace ";

		}
		if ($coef == 2 ) {
			echo "<br>C'est super efficace ";

		}
		if ($coef == 1 ) {
			echo  "<br>".GetSurnomPokemonSeul($_SESSION['pokemonAdversaire'])." a subis des dégats ";
		}
	}

	if (isset($_POST['UtiliserAttaqueAdversaire']))
	{
		$att  = $_POST['UtiliserAttaqueAdversaire'] - 3; //Les actions des potions
		$attaque = GetAttPokemonSeul($_SESSION['pokemonAdversaire'],$att);
		$coef1 = GetCoeffType(GetTypeAttaque($attaque),GetType1Pokedex(GetNumpPokemonSeul($_SESSION['pokemonMoi'])));
		$coef2 = GetCoeffType(GetTypeAttaque($attaque),GetType2Pokedex(GetNumpPokemonSeul($_SESSION['pokemonMoi'])));
		if (($coef1 == 0.5 && $coef2 == 1 )||($coef2 == 0.5 && $coef1 == 1 ))
		{
			$coef=0.5;
		}
		else
		{
			$coef = max($coef1,$coef2);
		}
		$degat = (GetDegatAttaque($attaque) * GetStatPokemonSeul($_SESSION['pokemonAdversaire'],'F') * $coef) / (GetStatPokemonSeul($_SESSION['pokemonMoi'],'D')*2);
		if($degat < 1 ){
			$degat = 1;
		}
		SetViePokemonSeul($_SESSION['pokemonMoi'],(GetViePokemonSeul($_SESSION['pokemonMoi'])-$degat));

		echo GetSurnomPokemonSeul($_SESSION['pokemonAdversaire'])." lance ".GetNomAttaque($attaque)."<br>";
		if ($coef == 0.5 ) {
			echo "<br>Ce n`est pas très efficace ";

		}
		if ($coef == 2 ) {
			echo "<br>C'est super efficace ";

		}
		if ($coef == 1 ) {
			echo  "<br>".GetSurnomPokemonSeul($_SESSION['pokemonMoi'])." a subis des dégats ";
		}
	}








	/* -------------------------------------------------------------------------------------------------------------------------- */
	/* CHANGER POKEMON */
	if (isset($_POST['ChangerPokemonMoi']))
	{
		$poke = $_POST['ChangerPokemonMoi'] - 7; //Moins actions Potions Et Attaques
		$pokemon = GetPokemonEqPokemon($_SESSION['numC'],$poke);
		echo GetSurnomPokemonSeul($_SESSION['pokemonMoi'])." se retire <br>";
		$_SESSION['pokemonMoi'] = $pokemon;
		SetPokemonCombat($_SESSION['moi'],$_SESSION['numCombat'],$pokemon);
		echo "<br>".GetNomDresseur($_SESSION['numC'])." appelle ".GetSurnomPokemonSeul($pokemon);
	}
	if (isset($_POST['AfficherPokemonMoi']))
	{
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
	}

	if (isset($_POST['ChangerPokemonAdversaire']))
	{
		$poke = $_POST['ChangerPokemonAdversaire'] - 7; //Moins actions Potions Et Attaques
		
		//$nom = GetSurnomPokemonSeul($_SESSION['pokemonAdversaire']);
		//$pokemon = GetPokemonEqPokemon(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']),$poke);
		//$_SESSION['pokemonAdversaire'] = GetPokemonEqPokemon(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']),$poke);
		echo GetSurnomPokemonSeul($_SESSION['pokemonAdversaire'])." se retire <br>";
		//echo GetSurnomPokemonSeul($_SESSION['pokemonAdversaire'])." se retire <br>";
		//$_SESSION['pokemonAdversaire'] = GetPokemonCombat($_SESSION['adversaire'],$_SESSION["numCombat"]);
		$_SESSION['pokemonAdversaire'] = GetPokemonEqPokemon(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']),$poke);
		echo "<br>".GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." appelle ".GetSurnomPokemonSeul($_SESSION['pokemonAdversaire']);
		//echo "<br>".GetNomDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))." appelle ".$nom;
	}
	if (isset($_POST['AfficherPokemonAdversaire']))
	{
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
	}


	/* --------------------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------------------- */
	/* MORT ? */
	if (isset($_POST['NombrePokemonEncoreEnVieMoi']))
	{
		$query  = "SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numc=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		$compteur = 0; 
		foreach ($requete as $pokemon) {
			if ($pokemon && GetViePokemonSeul($pokemon)>0)
			{
				$compteur++;
			}
		}
		
		if ($compteur > 0)
		{
			SetActionCombat($_SESSION['moi'],$_SESSION['numCombat'],16);
		}
		else
		{
			SetActionCombat($_SESSION['moi'],$_SESSION['numCombat'],17);
		}

		echo $compteur;
	}
	if (isset($_POST['NombrePokemonEncoreEnVieAdversaire']))
	{
		$query  = "SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numc=".GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']);
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		$compteur = 0; 
		foreach ($requete as $pokemon) {
			if ($pokemon && GetViePokemonSeul($pokemon)>0)
			{
				$compteur++;
			}
		}
		
		echo $compteur;
	}

	/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	/* NOUVEAU POKEMON CAR ANCIEN MORT*/
	if (isset($_POST['ChoisirNouveauPokemon']))
	{
		$query  = "SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numc=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		$compteur = 7; 
		foreach ($requete as $pokemon) {
			$compteur++;
			if ($pokemon && $pokemon!=$_SESSION['pokemonMoi'] && GetViePokemonSeul($pokemon)>0)
			{
				echo "<div class='bouton' id='pokemonRemplacent' onclick='AppelerNouveauPokemon(".$compteur.")'>";
					echo "<img src='imagesPoke/".GetNumpPokemonSeul($pokemon)."_pokemon_1.png'> ".GetSurnomPokemonSeul($pokemon)." (Pv:".GetViePokemonSeul($pokemon)."/".GetVieMaxPokemonSeul($pokemon).") Lv:".GetNiveauPokemonSeul($pokemon);
				echo "</div>";
			}
		}
		echo "<div class='bouton' id='Abandonner' onclick='Abandonner()''>Abandonner</div>";
	}


	/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	/* PERDU OU GAGNER */
	if (isset($_POST['Perdu']))
	{

		$argentMax = GetPokeDSac($_SESSION['numC']);
		$argentMin = 500 * (GetNiveauDresseur($_SESSION['numC'])/GetNiveauDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat'])));
		$argentMin = intval($argentMin);
		
		$argent = min($argentMax,$argentMin);

		SetPokeDSac($_SESSION['numC'],GetPokeDSac($_SESSION['numC'])-$argent);

		echo "Vous avez perdu<br>";

		echo "<br>Vous perdez ".$argent." pokedollars";
	}

	if (isset($_POST['Gagner']))
	{
		$argentMax = GetPokeDSac(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']));
		$argentMin = 500 * (GetNiveauDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat']))/GetNiveauDresseur($_SESSION['numC']));

		$argentMin = intval($argentMin);
		
		$argent = min($argentMax,$argentMin);

		SetPokeDSac($_SESSION['numC'],GetPokeDSac($_SESSION['numC'])+$argent);


		$query = "SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		foreach ($requete as $pokemon) {
			if ($pokemon)
			{
				SetXpPokemonSeul($pokemon,(GetXpPokemonSeul($pokemon)+GetNiveauDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat'])*10)));
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
						SetNumpPokemonSeul($pokemon,GetpokemonSPokedex(GetNumpPokemonSeul($pokemon)));

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

		SetXpDresseur($_SESSION['numC'],(GetXpDresseur($_SESSION['numC'])+(10*GetNiveauDresseur(GetJoueurCombat($_SESSION['adversaire'],$_SESSION['numCombat'])))));


		echo "Vous avez gagné<br>";

		echo "<br>Vous gagnez ".$argent." pokedollars";
	}

?>
