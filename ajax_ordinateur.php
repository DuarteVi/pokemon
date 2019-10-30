<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php

	$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
	$requete=mysqli_fetch_row($resultat);
	$listeEqPok=array(null,null,null,null,null,null);
	$compteur=0;
	$dernier=0;
	//On crée un table avec notre équipe pokémon
	//Utile pour par exemple les déplacer dans l'équipe vers le haut où le bas
	foreach ($requete as $poke) {
		if ($poke != null)
		{
			$listeEqPok[$compteur]=$poke;
			$dernier++;
		}
		else
		{
			$listeEqPok[$compteur]="null";
		}
		$compteur++;
	}
	$dernier--; //Utile de connaître le dernier pour ne pas avoir de trou dans son équipe

	for ($i=0; $i < 6 ; $i++) { 
		if ($requete[$i] == null)
		{
			$requete[$i]="'null'";
		}
	}
	
	//Partie qui sert afficher la boite ordinateur
	if (isset($_POST['affOrdi']))
	{
		$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
		$requete=mysqli_fetch_row($resultat);
		for ($i=0; $i <= 5 ; $i++) { 
			if (!$requete[$i])
			{
				$requete[$i]="'null'";
			}
		}

		$query = "SELECT numero FROM Ordinateur WHERE numC=".$_SESSION["numC"]."
											AND numero<>".$requete[0]." AND numero<>".$requete[1]." AND numero<>".$requete[2]." 
											AND numero<>".$requete[3]." AND numero<>".$requete[4]." AND numero<>".$requete[5]."
											AND numero<>'null';";
		
		$resultat=mysqli_query($link,$query);
			
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

		echo "<table>";
		echo "<tr><th> Transférer </th><th>Pokémon</th><th> Nom </th><th> Niveau </th><th> Libérer </th></tr>";
		foreach ($requete as $pokeEnr)
		{
			$resultatBis=mysqli_query($link,"SELECT numP,surnom,niveau  FROM PokemonSeul WHERE numero=".$pokeEnr['numero'].";");
			$requeteBis=mysqli_fetch_row($resultatBis);
			echo "<tr><td>";
			echo "<input type='button' name='<<' id='pokeSelect' value='<<' onclick='ordi_pokOrdiEquipe(".$pokeEnr['numero'].")'/>";
			echo "<input type='button' name='voir' id='pokeSelect' value='voir' onclick='ordi_info_pokemon(".$pokeEnr['numero'].")'/>";
			echo "</td><td><img id='pokemonimage' src='imagesPoke/".$requeteBis[0]."_pokemon_1.png'></td><td>".$requeteBis[1]."</td><td>".$requeteBis[2]."</td>";

			echo "<td>";
				/*echo "<form method='post' action='ordinateur.php'>
					<input type='hidden' name='libérer' value=".$pokeEnr['numero'].">
					<input type='submit' value='libérer'></form>";*/
				echo "<input type='button' name='libérer' id='pokeSelect' value='libérer' onclick='ordi_Liberer(".$pokeEnr['numero'].")'/>";
			echo "</td></tr>";
		}
		echo "</table>";
	}

	//Partie qui sert à afficher la boite Equipe
	if (isset($_POST['AffEquipe']))
	{

		$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
		$requete=mysqli_fetch_row($resultat);

		echo "<table>";
		echo "<tr><th> Voir </th><th> Pokémon </th><th> Nom </th><th> Niveau </th><th> Pv </th><th> Transférer </th></tr>";
		foreach ($requete as $eqPoke)
		{
			if ($eqPoke)
			{
				/*$resultatBis=mysqli_query($link,"SELECT numP,surnom,niveau,vie,vieMax  FROM PokemonSeul WHERE numero=".$eqPoke.";");
				$requeteBis=mysqli_fetch_row($resultatBis);*/
				echo "<tr>";
				echo "<td>";
					echo "<input type='button' name='voir' id='pokeSelect' value='voir' onclick='ordi_info_pokemon(".$eqPoke.");ordi_afficher_ordinateur()'/>";
				echo "</td>";
					
				/*echo "<td><img id='pokemonimage' src='imagesPoke/".$requeteBis[0]."_pokemon_1.png'></td><td>".$requeteBis[1]."</td><td>".$requeteBis[2]."</td><td>".$requeteBis[3]."/".$requeteBis[4]."</td><td>";*/
				echo "<td><img id='pokemonimage' src='imagesPoke/".GetNumpPokemonSeul($eqPoke)."_pokemon_1.png'></td><td>".GetSurnomPokemonSeul($eqPoke)."</td><td>".GetNiveauPokemonSeul($eqPoke)."</td><td>".GetViePokemonSeul($eqPoke)."/".GetVieMaxPokemonSeul($eqPoke)."</td><td>";
					echo "<table><tr>";
						echo "<td>";
							echo "<input type='button' name='monter' id='pokeSelect' value='↑' onclick='ordi_monter_pokemon(".$eqPoke.")'/>";
						echo "</td>";
						echo "<td>";
							echo "<input type='button' name='monter' id='pokeSelect' value='↓' onclick='ordi_descendre_pokemon(".$eqPoke.")'/>";
						echo "</td>";
						echo "<td>";
							echo "<input type='button' name='voir' id='pokeSelect' value='>>' onclick='ordi_pokEquipeOrdi(".$eqPoke.")'/>";
						echo "</td></tr></table>";
				echo "<td/></tr>";	
			}
			else
			{
				echo "<tr><td colspan='6' style='text-align: center;'>Vide</td></tr>";
			}
		}
		echo "</table>";
	}

//Partie pour afficher la boite info
	if (isset($_POST['infoPoke']))
	{
		/*$resultat=mysqli_query($link,"SELECT numP,surnom,niveau,xp,vie,vieMax,statF,statD,statV,att1,att2,att3,att4  FROM PokemonSeul WHERE numero=".$_POST['infoPoke'].";");
		$requete=mysqli_fetch_row($resultat);
		$resultatBis=mysqli_query($link,"SELECT type1,type2  FROM Pokedex WHERE numP=".$requete[0].";");
		$requeteBis=mysqli_fetch_row($resultatBis);*/
		echo "<table>";
		echo "<tr><th>Pokémon :</th><td colspan='5'><img id='pokemonimage' src='imagesPoke/".GetNumpPokemonSeul($_POST['infoPoke'])."_pokemon_1.png'></td></tr>";
		//echo "<tr><th>Nom :</th><td colspan='5'>".$requete[1]."</td></tr>";
		echo "<tr><th>Surnom :</th><td colspan='4'><input type='text' value='".GetSurnomPokemonSeul($_POST['infoPoke'])."' maxlength='30' id='changerSurnom' onKeyPress='if (event.keyCode == 13) ChangerSurnom(".$_POST['infoPoke'].")'></td><td><input type='button' value='changer de surnom' onclick='ChangerSurnom(".$_POST['infoPoke'].")'></td></tr>";
		echo "<tr><th>Nom :</th><td colspan='5'>".GetNomPokedex(GetNumpPokemonSeul($_POST['infoPoke']))."</td></tr>";
		echo "<tr><th>Type(s) :</th><td colspan='2'>".GetNomType(GetType1Pokedex(GetNumpPokemonSeul($_POST['infoPoke'])))."</td><td colspan='3'>".GetNomType(GetType2Pokedex(GetNumpPokemonSeul($_POST['infoPoke'])))."</td></tr>";
		echo "<tr><th>Niveau :</th><td colspan='5'>".GetNiveauPokemonSeul($_POST['infoPoke'])."</td><tr/>";
		echo "<tr><th>Xp :</th><td colspan='5'>".GetXpPokemonSeul($_POST['infoPoke'])."</td></tr>";
		echo "<tr><th>Vie :</th><td colspan='5'>".GetViePokemonSeul($_POST['infoPoke'])."/".GetVieMaxPokemonSeul($_POST['infoPoke'])."</td></tr>";
		echo "<tr><th>Force :</th><td>".GetStatPokemonSeul($_POST['infoPoke'],'F')."</td><th> Défense :</th><td>".GetStatPokemonSeul($_POST['infoPoke'],'D')."</td><th>Vitesse :</th><td>".GetStatPokemonSeul($_POST['infoPoke'],'V')."</td></tr>";
		echo "</table>";
		echo "<b>Attaque(s) :</b><br/>";
		echo "<table><tr><th>Nom</th><th>Type</th><th>Degats</th><th>Description</th></tr>";
		$ajouter = 1;
		for ( $i=1 ; $i<=4 ; $i++)
		{
			//if ($requete[(8+$i)] != null)
			//{
				/*$resultatBis=mysqli_query($link,"SELECT nom,type,degat,description  FROM Attaque WHERE numA=".$requete[(8+$i)].";");
				$requeteBis=mysqli_fetch_row($resultatBis);*/
				//echo "<tr><td>".$requeteBis[0]."</td><td>".GetNomType($requeteBis[1])."</td><td>".$requeteBis[2]."</td><td>".$requeteBis[3]."</td></tr>";
				$attaque=GetAttPokemonSeul($_POST['infoPoke'],$i);
				if ($attaque)
				{
					echo "<tr><td>".GetNomAttaque($attaque)."<br><input type='button' value='changer l`attaque' onclick='ChangerAttaque(".$_POST['infoPoke'].",".$i.")'></td><td>".GetNomType(GetTypeAttaque($attaque))."</td><td>".GetDegatAttaque($attaque)."</td><td>".GetDescriptionAttaque($attaque)."</td></tr>";
				}
				else
				{
					if ($ajouter == 1)
					{
						echo "<tr><td colspan='4'><input type='button' value='ajouter une attaque' onclick='ChangerAttaque(".$_POST['infoPoke'].",".$i.")'></td></tr>";
						$ajouter = 0;
					}
				}
				
			//}
		}
		echo "</table>";
	}

//Partie pour monter un pokemon de 1 cran
	if (isset($_POST['pokmonter']))
	{
		$compteur=0;
		foreach ($requete as $poke) {
			if ($_POST['pokmonter']==$poke && $compteur>0)
				{
					$poketemp=$listeEqPok[$compteur-1];
					$listeEqPok[($compteur-1)]=$_POST['pokmonter'];
					$listeEqPok[$compteur]=$poketemp;
				}
			$compteur++;
		}
		$query = "UPDATE EqPokemon SET pokemon1=".$listeEqPok[0].",pokemon2=".$listeEqPok[1].",pokemon3=".$listeEqPok[2].",pokemon4=".$listeEqPok[3].",pokemon5=".$listeEqPok[4].",pokemon6=".$listeEqPok[5]." WHERE numC=".$_SESSION["numC"].";";
		$resultat=mysqli_query($link,$query);
	}

//Partie pour descendre un pokemon de 1 cran
	if (isset($_POST['pokdescendre']))
	{
		$compteur=0;
		foreach ($requete as $poke) {
			if ($_POST['pokdescendre']==$poke && $compteur<$dernier)
				{
					$poketemp=$listeEqPok[$compteur+1];
					$listeEqPok[($compteur+1)]=$_POST['pokdescendre'];
					$listeEqPok[$compteur]=$poketemp;
				}
			$compteur++;
		}
		$query = "UPDATE EqPokemon SET pokemon1=".$listeEqPok[0].",pokemon2=".$listeEqPok[1].",pokemon3=".$listeEqPok[2].",pokemon4=".$listeEqPok[3].",pokemon5=".$listeEqPok[4].",pokemon6=".$listeEqPok[5]." WHERE numC=".$_SESSION["numC"].";";
		$resultat=mysqli_query($link,$query);
	}

	//Partie pour déplacer un pokemon de l'ordi vers l'équipe
	if(isset($_POST['pokOrdiEquipe']))
	{
		$sortie=1;
		for ( $i=2 ; $i<=6 && $sortie==1 ; $i++ )
		{
			$query="SELECT pokemon".$i." FROM EqPokemon WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			if ($requete[0]==NULL)
			{
				$query = "UPDATE EqPokemon SET pokemon".$i."=".$_POST['pokOrdiEquipe']." WHERE numC=".$_SESSION["numC"]."";
				$resultat=mysqli_query($link,$query);
				$sortie=0;
			}
		}
	}

	//Partie pour Déplacer un pokemon de l'equipe vers l'ordi
	if (isset($_POST['pokEquipeOrdi']))
	{
		if ($_POST['pokEquipeOrdi']==$requete[0])
		{
			$query = "UPDATE EqPokemon SET pokemon1=".$listeEqPok[1].",pokemon2=".$listeEqPok[2].",pokemon3=".$listeEqPok[3].",pokemon4=".$listeEqPok[4].",pokemon5=".$listeEqPok[5].",pokemon6=null WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
			//echo $query."<br/>";
		}
		else if ($_POST['pokEquipeOrdi']==$requete[1])
		{
			$query = "UPDATE EqPokemon SET pokemon2=".$listeEqPok[2].",pokemon3=".$listeEqPok[3].",pokemon4=".$listeEqPok[4].",pokemon5=".$listeEqPok[5].",pokemon6=null WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
		}
		else if ($_POST['pokEquipeOrdi']==$requete[2])
		{
			$query = "UPDATE EqPokemon SET pokemon3=".$listeEqPok[3].",pokemon4=".$listeEqPok[4].",pokemon5=".$listeEqPok[5].",pokemon6=null WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
		}
		else if ($_POST['pokEquipeOrdi']==$requete[3])
		{
			$query = "UPDATE EqPokemon SET pokemon4=".$listeEqPok[4].",pokemon5=".$listeEqPok[5].",pokemon6=null WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
		}
		else if ($_POST['pokEquipeOrdi']==$requete[4])
		{
			$query = "UPDATE EqPokemon SET pokemon5=".$listeEqPok[5].",pokemon6=null WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
		}
		else if ($_POST['pokEquipeOrdi']==$requete[5])
		{
			$query = "UPDATE EqPokemon SET pokemon6=null WHERE numC=".$_SESSION["numC"].";";
			$resultat=mysqli_query($link,$query);
		}
	}	


	//Afficher les attaques
	if (isset($_POST['ChangerAttaque']) && isset($_POST['ChangerAttaquePokemon']))
	{
		$query = "SELECT attaque FROM AttaqueParDresseur WHERE numC=".$_SESSION['numC']." AND attaque IN (SELECT numA FROM Attaque WHERE type=".GetType1Pokedex(GetNumpPokemonSeul($_POST['ChangerAttaquePokemon']));
		if (GetType2Pokedex(GetNumpPokemonSeul($_POST['ChangerAttaquePokemon'])))
		{
			$query = $query." OR type=".GetType2Pokedex(GetNumpPokemonSeul($_POST['ChangerAttaquePokemon'])).");";
		}
		else
		{
			$query = $query.");";
		}
		//echo $query;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		
		echo "<table><tr><th>Nom</th><th>Type</th><th>Degats</th><th>PP</th><th>Description</th><th>Bouton</th></tr>";
		foreach ($requete as $attaqueSelectionnee) {
			$query = "SELECT numA,nom,degat,pp,type,description FROM Attaque WHERE numA=".$attaqueSelectionnee['attaque'];
			$resultat=mysqli_query($link,$query);
			$attaque=mysqli_fetch_row($resultat);
			echo "<tr>";
				echo "<td>".$attaque[1]."</td>";
				echo "<td>".GetNomType($attaque[4])."</td>";
				echo "<td>".$attaque[2]."</td>";
				echo "<td>".$attaque[3]."</td>";
				echo "<td>".$attaque[5]."</td>";
				echo "<td> <input type='button' value='choisir' onclick='ChangerAttaquePreciser(".$_POST['ChangerAttaquePokemon'].",".$_POST['ChangerAttaque'].",".$attaque[0].")'> </td>";
			echo "</tr>";
		}

		$resultat=mysqli_query($link,"SELECT att2 FROM PokemonSeul WHERE numero=".$_POST['ChangerAttaquePokemon']);
		$requete=mysqli_fetch_row($resultat);
		$resultatBis=mysqli_query($link,"SELECT att".$_POST['ChangerAttaque']." FROM PokemonSeul WHERE numero=".$_POST['ChangerAttaquePokemon']);
		$requeteBis=mysqli_fetch_row($resultatBis);


		if ($requete[0] && $requeteBis[0]!=0 && $requeteBis[0]!=null)
		{
			echo "<tr><td colspan='6'> <input type='button' value='supprimer l`attaque' style='color:blue;margin-top:20px;margin-bottom:20px;width:80%;height:100%;' onclick='ChangerAttaqueSuppression(".$_POST['ChangerAttaquePokemon'].",".$_POST['ChangerAttaque'].")'> </td></tr>";
		}

		echo "<tr><td colspan='6'> <input type='button' value='annuler' style='color:red;margin-top:20px;margin-bottom:20px;width:80%;height:100%;' onclick='ordi_afficher_ordinateur()'> </td></tr></table>";
		echo "<h5>Attention, si votre pokemon connait une attaque que vous ne possédez pas, pour la récupérer après changement il faudra la racheter au magasin</h5>";
	}



	//Libérer un pokémon
	if (isset($_POST['libérer']))
	{
		SupprimerPokemon($_POST['libérer']);
	}

	//Changer Surnom
	if (isset($_POST['ChangerSurnom']) && isset($_POST['ChangerSurnomPokemon']))
	{
		SetSurnomPokemonSeul($_POST['ChangerSurnomPokemon'],SecuriserText($_POST['ChangerSurnom']));
	}

	//changer attaque
	if (isset($_POST['ChangerAttaquePreciser']) && isset($_POST['ChangerAttaquePreciserPokemon']) && isset($_POST['ChangerAttaquePreciserNvAttaque']))
	{
		SetAttPokemonSeul($_POST['ChangerAttaquePreciserPokemon'],$_POST['ChangerAttaquePreciser'],$_POST['ChangerAttaquePreciserNvAttaque']);
	}

	//Supprimer Attaque
	if (isset($_POST['ChangerAttaqueSuppression']) && isset($_POST['ChangerAttaqueSuppressionPokemon']))
	{
		$listeAtt=array(0,0,0,0);
		$query  = "SELECT att1,att2,att3,att4 FROM PokemonSeul WHERE numero=".$_POST['ChangerAttaqueSuppressionPokemon'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);

		$compteur=0;
		$compteur2=1;
		foreach ($requete as $attaque) {
			if (($compteur2) != $_POST['ChangerAttaqueSuppression'] && $attaque!=null && $attaque !=0)
			{
				$listeAtt[$compteur] = $attaque;
				$compteur++;
			}
			$compteur2++;
		}
		for ($i=0; $i < 4; $i++) { 
			$j=$i+1;
			SetAttPokemonSeul($_POST['ChangerAttaqueSuppressionPokemon'],$j,$listeAtt[$i]);
			//echo $listeAtt[$i]."<br>";
		}

	}

?>