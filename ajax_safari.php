<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php

	//Soigner un pokémon
	if(isset($_POST['SoignerQuelleQuantite']))
	{
		if ($_POST["SoignerQuelleQuantite"] == 1)
		{
			if (GetSoinSac($_SESSION['numC']) > 0)
			{
				$quantite = min(50,(GetVieMaxPokemonSeul($_SESSION['pokemonChoisie'])-GetViePokemonSeul($_SESSION['pokemonChoisie'])));
				SetViePokemonSeul($_SESSION['pokemonChoisie'],(GetViePokemonSeul($_SESSION['pokemonChoisie'])+$quantite));
				echo $quantite;
			}
			else
			{
				echo 0;
			}
		}
		else if ($_POST["SoignerQuelleQuantite"] == 2)
		{
			if (GetSoinSSac($_SESSION['numC']) > 0)
			{
				$quantite = min(100,(GetVieMaxPokemonSeul($_SESSION['pokemonChoisie'])-GetViePokemonSeul($_SESSION['pokemonChoisie'])));
				SetViePokemonSeul($_SESSION['pokemonChoisie'],(GetViePokemonSeul($_SESSION['pokemonChoisie'])+$quantite));
				echo $quantite;
			}
			else
			{
				echo 0;
			}
		}
		else if ($_POST["SoignerQuelleQuantite"] == 3)
		{
			if (GetSoinHSac($_SESSION['numC']) > 0)
			{
				$quantite = min(150,(GetVieMaxPokemonSeul($_SESSION['pokemonChoisie'])-GetViePokemonSeul($_SESSION['pokemonChoisie'])));
				SetViePokemonSeul($_SESSION['pokemonChoisie'],(GetViePokemonSeul($_SESSION['pokemonChoisie'])+$quantite));
				echo $quantite;
			}
			else
			{
				echo 0;
			}
		}
	}

	//Reecrire les div
	if (isset($_POST['SoignerReecrire']))
	{
		if ($_POST["SoignerReecrire"] == 1)
		{
			
			SetSoinSac($_SESSION['numC'],(GetSoinSac($_SESSION['numC'])-1));
			$soin = GetSoinSac($_SESSION['numC']);
			echo "<img src='imagesPoke/Potion.png'> Potion(s) [".$soin."]";
			//echo "<input type='hidden' name='potion1' id='potion1' value='".$soin."'>";
		}
		else if ($_POST["SoignerReecrire"] == 2)
		{
			SetSoinSSac($_SESSION['numC'],(GetSoinSSac($_SESSION['numC'])-1));
			$soin = GetSoinSSac($_SESSION['numC']);
			echo "<img src='imagesPoke/superpotion.png'> Super Potion(s) [".$soin."]";
			//echo "<input type='hidden' name='potion2' id='potion2' value='".$soin."'>";
		}
		else if ($_POST["SoignerReecrire"] == 3)
		{
			SetSoinHSac($_SESSION['numC'],(GetSoinHSac($_SESSION['numC'])-1));
			$soin = GetSoinHSac($_SESSION['numC']);
			echo "<img src='imagesPoke/hyperpotion.png'> Hyper Potion(s) [".$soin."]";
			//echo "<input type='hidden' name='potion3' id='potion3' value='".$soin."'>";
		}
	}
	//Reste-t-il des potions pour afficher le texte ?
	if (isset($_POST['ResteDesPotionsOuNon']))
	{
		if ($_POST['ResteDesPotionsOuNon'] == 1)
			echo GetSoinSac($_SESSION['numC']);
		else if ($_POST['ResteDesPotionsOuNon'] == 2)
			echo GetSoinSSac($_SESSION['numC']);
		else
			echo GetSoinHSac($_SESSION['numC']);
	}

	//Lancer une pokeball
	if (isset($_POST['LancerPokeball']) && isset($_POST['numBall']))
	{
		if ($_POST["numBall"] == 1)
		{
			$typeBall="pokeB";
		}
		else if ($_POST["numBall"] == 2)
		{
			$typeBall="superB";
		}
		else if ($_POST["numBall"] == 3)
		{
			$typeBall="hyperB";
		}

		$resultat=mysqli_query($link,'SELECT '.$typeBall.' FROM Sac WHERE numC = '.$_SESSION['numC'].';');
		$requete=mysqli_fetch_row($resultat);
		$ball = $requete[0];
		$ball = $ball-1;
		if ($ball<0){
			$ball=0;
		}

		$resultat=mysqli_query($link,'UPDATE Sac SET '.$typeBall.'='.$ball.' WHERE numC = '.$_SESSION['numC'].';');
		if ($_POST["numBall"] == 1)
		{
			echo "<img src='imagesPoke/pokeball.png'> Pokeball(s) [".$ball."]";
			echo "<input type='hidden' name='pokeball1' id='pokeball1' value='".$ball."'>";
		}
		else if ($_POST["numBall"] == 2)
		{
			echo "<img src='imagesPoke/super-ball.png'> SuperBall(s) [".$ball."]";
			echo "<input type='hidden' name='pokeball2' id='pokeball2' value='".$ball."'>";
		}
		else if ($_POST["numBall"] == 3)
		{
			echo "<img src='imagesPoke/hyperball.png'> HyperBall(s) [".$ball."]";
			echo "<input type='hidden' name='pokeball3' id='pokeball3' value='".$ball."'>";
		}
	}

	//Peut-on lancer une pokeball ?
	if (isset($_POST['PreLancerPokeball']))
	{
		if ($_POST["PreLancerPokeball"] == 1)
		{
			echo GetPokeBSac($_SESSION['numC']);
		}
		else if ($_POST["PreLancerPokeball"] == 2)
		{
			echo GetSuperBSac($_SESSION['numC']);
		}
		else if ($_POST["PreLancerPokeball"] == 3)
		{
			echo GetHyperBSac($_SESSION['numC']);
		}
	}

	//Lancer une attaque
	/*if (isset($_POST['LancerAtt']) && isset($_POST['pokemon']))
	{
		$numeroPP = $_POST['LancerAtt'] + 1; //On veut un intervalle de 1 à 4 et non de 0 à 3
		$resultat=mysqli_query($link,'SELECT pp'.$numeroPP.' FROM PokemonSeul WHERE numero='.$_POST['pokemon'].';');
		$requete=mysqli_fetch_row($resultat);
		if ($requete[0] > 0)
		{
			$pp = $requete[0]-1;
			$resultat=mysqli_query($link,'UPDATE PokemonSeul SET pp'.$numeroPP.'='.$pp.' WHERE numero = '.$_POST['pokemon'].';');
		}

		$resultat=mysqli_query($link,'SELECT Att'.$numeroPP.',pp'.$numeroPP.' FROM PokemonSeul WHERE numero='.$_POST['pokemon'].';');
		$requete=mysqli_fetch_row($resultat);
		$resultatTer=mysqli_query($link,"SELECT nom,pp,type FROM Attaque where numA=".$requete[0].";");
		$requeteTer=mysqli_fetch_row($resultatTer);

		$compteur = $_POST['LancerAtt'];
		echo $requeteTer[0]." (".GetNomType($requeteTer[2]).") PP:".$requete[1]."/".$requeteTer[1];
		echo "<input type='hidden' name='attaque' id='attaque".$compteur."' value='".$requete[1]."'>";
		echo "<input type='hidden' name='attaque' id='PokemonAttaque".$compteur."' value='".$_POST['pokemon']."'>";
	}*/
	if (isset($_POST['LancerAtt']))
	{

		$numeroPP = $_POST['LancerAtt'] + 1; //On veut un intervalle de 1 à 4 et non de 0 à 3
		$resultat=mysqli_query($link,'SELECT pp'.$numeroPP.' FROM PokemonSeul WHERE numero='.$_SESSION["pokemonChoisie"].';');
		$requete=mysqli_fetch_row($resultat);
		if ($requete[0] > 0)
		{
			$pp = $requete[0]-1;
			$resultat=mysqli_query($link,'UPDATE PokemonSeul SET pp'.$numeroPP.'='.$pp.' WHERE numero = '.$_SESSION["pokemonChoisie"].';');
		}

		$resultat=mysqli_query($link,'SELECT Att'.$numeroPP.',pp'.$numeroPP.' FROM PokemonSeul WHERE numero='.$_SESSION["pokemonChoisie"].';');
		$requete=mysqli_fetch_row($resultat);
		$resultatTer=mysqli_query($link,"SELECT nom,pp,type FROM Attaque where numA=".$requete[0].";");
		$requeteTer=mysqli_fetch_row($resultatTer);

		$compteur = $_POST['LancerAtt'];
		echo $requeteTer[0]." (".GetNomType($requeteTer[2]).") PP:".$requete[1]."/".$requeteTer[1];
		//echo "<input type='hidden' name='attaque' id='attaque".$compteur."' value='".$requete[1]."'>";
		//echo "<input type='hidden' name='attaque' id='PokemonAttaque".$compteur."' value='".$_SESSION["pokemonChoisie"]."'>";
	}
	//Combien de PP reste-t-il ?
	if (isset($_POST['LancerAttOuiOuNon']))
	{
		$numeroAtt = $_POST['LancerAttOuiOuNon'] + 1;
		$resultat=mysqli_query($link,'SELECT pp'.$numeroAtt.' FROM PokemonSeul WHERE numero='.$_SESSION["pokemonChoisie"].';');
		$requete=mysqli_fetch_row($resultat);
		if ( $requete[0] != null && $requete[0] != 'null' && $requete[0] != 0)
		{
			echo $requete[0];
		}
		else
		{
			echo 0;
		}
	}

	//Afficher les attaques du pokemon
	if (isset($_POST["afficherAttaques"]))
	{
		$pokemonChoisie = $_SESSION["pokemonChoisie"];

		$resultat=mysqli_query($link,"SELECT att1,att2,att3,att4 FROM PokemonSeul where numero=".$pokemonChoisie.";");
		$resultatBis=mysqli_query($link,"SELECT pp1,pp2,pp3,pp4 FROM PokemonSeul where numero=".$pokemonChoisie.";");
		$requete=mysqli_fetch_row($resultat);
		$requeteBis=mysqli_fetch_row($resultatBis);
		$compteur=0;
		foreach ($requete as $att) {
			if ( $att != NULL && $att != 0)
			{
				$resultatTer=mysqli_query($link,"SELECT nom,pp,type FROM Attaque where numA=".$att.";");
				$requeteTer=mysqli_fetch_row($resultatTer);

				/*echo "<div class='bouton' id='attaque".$compteur."' onclick='LancerAttaque(".$compteur.")'>".$requeteTer[0]." (".GetNomType($requeteTer[2]).") PP:".$requeteBis[$compteur]."/".$requeteTer[1];*/ 
				//Action(action,donnee)
				//
				echo "<div class='bouton' id='attaque".$compteur."' onclick='Action(3,".$compteur.")'>".$requeteTer[0]." (".GetNomType($requeteTer[2]).") PP:".$requeteBis[$compteur]."/".$requeteTer[1];
				/*echo "<input type='hidden' name='attaque' id='attaque".$compteur."' value='".$requeteBis[$compteur]."'>";
				echo "<input type='hidden' name='attaque' id='PokemonAttaque".$compteur."' value='".$pokemonChoisie."'>";*/
				echo "</div>";
			}
		$compteur++;
		}
		echo "<div class='bouton' id='attaqueRetour' onclick='AfficherMenu()'>retour</div>";
	}

	//Afficher les pokemons en réserve
	if (isset($_POST["afficherPokemonsRestant"]))
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
		echo "<div class='bouton' id='pokemonRetour' onclick='AfficherMenu()''>retour</div>";
	}

	//Changer de pokemon
	if (isset($_POST['PokemonChoisie']))
	{
		$pokemonChoisie = $_POST["PokemonChoisie"];
		$_SESSION["pokemonChoisie"] = $pokemonChoisie;

		$query = "SELECT numP,surnom,niveau,vie,vieMax FROM PokemonSeul where numero=".$pokemonChoisie.";";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
		echo "<table id='pokemonEquipeTable' class='pokemonCombat'>";
				echo "<tr><td>";
					echo "<img id='imgPokemonChoisi' class='imgpokemon' src='gifsPoke/".$requete[0]."_2.gif'>";
				/*echo "<img src='imagesPoke/sol_".$_COOKIE['lieu'].".png'>";*/
				echo "<img class='imgsol' src='imagesPoke/sol_1.png'>";		
					echo "</td><td>";
						echo "<div id='pokemonEquipeInfo' class='pokemonCombatInfo'>";
							echo "<div id='gauche'>".$requete[1]."</div><div id='droite'>Lv".$requete[2]."</div>";
							echo "<div id='contourVie'> <div id='vieEquipe'></div></div>";
								echo "<input type='hidden' id='pokevieEquipe' value=".$requete[3]."/>";
								echo "<input type='hidden' id='pokevieMaxEquipe' value=".$requete[4]."/>";
								echo "<input type='hidden' id='pokemonChoisie' value='".$pokemonChoisie."'/>";
						echo "</div>";
				echo "</td></tr>";
		echo "</table>";
	}

	//Attraper le pokemon

	if (isset($_POST['CaptureReussite'])) {
		if (isset($_SESSION['pokemonApparu']))
		{
			$pokemon = $_SESSION['pokemonApparu'];
			$query = "	INSERT INTO PokemonSeul (numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
						VALUES (".$pokemon['nump'].",'".$pokemon['surnom']."',".$pokemon['niveau'].",".$pokemon['vieMax'].",".$pokemon['vieMax'].",
								".$pokemon['xp'].",".$pokemon['statF'].",".$pokemon['statD'].",".$pokemon['statV'].",
								".$pokemon['attaque']['att1'].",".$pokemon['attaque']['att2'].",".$pokemon['attaque']['att3'].",".$pokemon['attaque']['att4'].",
								".$pokemon['pp']['pp1'].",".$pokemon['pp']['pp2'].",".$pokemon['pp']['pp3'].",".$pokemon['pp']['pp4'].");";
			$resultat=mysqli_query($link,$query);

			$query = "SELECT MAX(numero) FROM PokemonSeul;";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			$numero=$requete[0];

			$query = "INSERT INTO Ordinateur (numC,numero) VALUES (".$_SESSION["numC"].",".$numero.");";
			$resultat=mysqli_query($link,$query);

			RemplirPokedex(GetNumpPokemonSeul($numero));
			
			$resultatBis=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
			$requeteBis=mysqli_fetch_row($resultatBis);

			$emplacementVide = 0;
			$compteur  = 1;
			foreach ($requeteBis as $pokemon) {
				if ($pokemon != null && $pokemon != 'null' && $pokemon != 0)
				{
					$compteur++;
				}
				else if ( $emplacementVide == 0 )
				{
					$emplacementVide = $compteur;
				}
			}
			if ($emplacementVide != 0)
			{
				$query = "UPDATE EqPokemon SET pokemon".$emplacementVide."=".$numero." WHERE numC=".$_SESSION["numC"].";";
				//echo $query;
				$resultat=mysqli_query($link,$query);
			}

			//$_COOKIE["pokemonApparu"] = NULL;
			//setcookie('pokemonApparu',null,-1);
			//header('Location: carte.php');

		}
	}

	if (isset($_POST['EssayerAttraperPokemon']))
	{
		//$pokemonApparu = unserialize($_COOKIE['pokemonApparu']);
	/*	$difference = GetNiveauDresseur($_SESSION['numC']) - $_SESSION['pokemonApparu']['niveau'];
		$PV = (($_SESSION['pokemonApparu']['vie']*100)/$_SESSION['pokemonApparu']['vieMax'])-100;
		$TauxEchec = 100 -  25 * $_POST['EssayerAttraperPokemon'];*/


		$vie = ($_SESSION['pokemonApparu']['vie'])/$_SESSION['pokemonApparu']['vieMax'];
		$niveau = GetNiveauDresseur($_SESSION['numC'])/$_SESSION['pokemonApparu']['niveau'];
		$pokeball = (1*$_POST['EssayerAttraperPokemon'])/3;
		$lieu = $_COOKIE['lieu']/1;

		$resultat =  (1-$vie+$niveau*$pokeball)*100/$lieu ;

		$var=rand(0,100);


		if ( $resultat >= $var)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}


?>
