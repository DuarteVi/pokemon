<?php
/*-------------------------------------------------------------------------------------------------*/
/*	Dresseur	*/
	function GetNomDresseur($numero)
	{
		global $link;
		$query="SELECT pseudo from Dresseur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}

	}
	function SetNomDresseur($numero,$nom)
	{
		global $link;
		//$nom2 = htmlentities($nom);
		//$nom2 = preg_replace('/"/', '\"', $nom2);
		//$nom2 = preg_replace("/'/", "\'", $nom2);
		//echo "<br>".$nom2."<br>";
		$nom2 = SecuriserText($nom);
		$nom3 = substr($nom2,0,50); //prendre les 50 premiers caractères
		$query="UPDATE Dresseur SET pseudo='".$nom3."' WHERE numC=".$numero;
		echo $query;

		$resultat=mysqli_query($link,$query);		
	}

	function GetSexeDresseur($numero)
	{
		global $link;
		$query="SELECT sexe from Dresseur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}

	function GetNomSexeDresseur($numero)
	{
		if (GetSexeDresseur($numero)==1)
		{
			return "fille";
		}
		else
		{
			return "garçon";
		}
	}

	function SetSexeDresseur($numero)
	{
		global $link;
		$sexe = 2;
		if (GetSexeDresseur($numero)==2)
		{
			$sexe = 1;
		}
		$query="UPDATE Dresseur SET sexe=".$sexe." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}

	function GetNiveauDresseur($numero)
	{
		global $link;
		$query="SELECT niveauD from Dresseur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}

	function SetNiveauDresseur($numero,$valeur)
	{
		global $link;
		global $link;
		if ($valeur < 0)
		{
			$valeur = 0;
		}
		if ($valeur > 999999999)
		{
			$valeur = 999999999;
		}
		$query="UPDATE Dresseur SET niveauD='".$valeur."' WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);
	}


	function GetXpDresseur($numero)
	{
		global $link;
		$query="SELECT xp from Dresseur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);

		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}

	function SetXpDresseur($numero,$valeur)
	{
		global $link;
		if ($valeur < 0)
		{
			$valeur = 0;
		}
		if ($valeur > 999999999)
		{
			$valeur = 999999999;
		}
		$query="UPDATE Dresseur SET xp='".$valeur."' WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);	
	}
/*-------------------------------------------------------------------------------------------------*/
/*	Utilisateur	*/
	function GetPseudoUtilisateur($numero)
	{
		global $link;
		$query="SELECT pseudo from Utilisateur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function GetMdpUtilisateur($numero)
	{
		global $link;
		$query="SELECT mdp from Utilisateur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetMdpUtilisateur($numero,$mdp)
	{
		global $link;
		$query="UPDATE Utilisateur SET mdp='".$mdp."' WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);	
	}
	function GetConnecterUtilisateur($numero)
	{
		global $link;
		$query="SELECT connecter from Utilisateur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);	
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetConnecterUtilisateur($numero,$statut)
	{
		global $link;
		if ($statut == 0 )
		{
			$query="UPDATE Utilisateur SET connecter=0 WHERE numC=".$numero;
			$resultat=mysqli_query($link,$query);	
		}
		else
		{
			$query="UPDATE Utilisateur SET connecter=1 WHERE numC=".$numero;
			$resultat=mysqli_query($link,$query);	
		}
	}

	function GetDateCUtilisateur($numero)
	{
		global $link;
		$query="SELECT dateC from Utilisateur where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);	
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetDateCUtilisateur($compte,$valeur)
	{
		global $link;
		$query="UPDATE Utilisateur SET dateC=".$valeur." WHERE numC=".$compte;
		$resultat=mysqli_query($link,$query);
	}
/*-------------------------------------------------------------------------------------------------*/
/* Eqpokemon */
	function GetPokemonEqPokemon($compte,$valeur)
	{
		global $link;
		if ($valeur > 6 || $valeur < 1)
		{
			$valeur = 1;
		}
		$query="SELECT pokemon".$valeur." from EqPokemon where numC=".$compte.";";
		$resultat=mysqli_query($link,$query);	
		$requete=mysqli_fetch_row($resultat);
		if ($requete[0])
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}

/*-------------------------------------------------------------------------------------------------*/
/*	Sac	*/
	function GetPokeDSac($numero)
	{
		global $link;
		$query="SELECT pokeD from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetPokeDSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET pokeD=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetPokeBSac($numero)
	{
		global $link;
		$query="SELECT pokeB from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetPokeBSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET pokeB=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetSuperBSac($numero)
	{
		global $link;
		$query="SELECT superB from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetSuperBSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET superB=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetHyperBSac($numero)
	{
		global $link;
		$query="SELECT hyperB from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetHyperBSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET hyperB=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetSoinSac($numero)
	{
		global $link;
		$query="SELECT soin from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetSoinSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET soin=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetSoinSSac($numero)
	{
		global $link;
		$query="SELECT soinS from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetSoinSSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET soinS=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetSoinHSac($numero)
	{
		global $link;
		$query="SELECT soinH from Sac where numC=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetSoinHSac($numero,$nombre)
	{
		global $link;
		if ($nombre < 0)
		{
			$nombre = 0;
		}
		if ($nombre > 999999999)
		{
			$nombre = 999999999;
		}
		$query="UPDATE Sac SET soinH=".$nombre." WHERE numC=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	/*-------------------------------------------------------------------------------------------------*/
/*	Ami	*/
function SetAmi($num1,$num2)
{
	global $link;
	$query = "INSERT INTO Ami(moi,lui) VALUES ($num1,$num2)";
	$resultat=mysqli_query($link,$query);
}
function SupprimerAmitier($num1,$num2)
{
	global $link;
	$query="DELETE FROM Ami WHERE moi=".$num1." AND lui=".$num2.";";
	//echo $query;
	$resultat=mysqli_query($link,$query);
	$query="DELETE FROM Ami WHERE moi=".$num2." AND lui=".$num1.";";
	//echo $query;
	$resultat=mysqli_query($link,$query);
	
}

/*-------------------------------------------------------------------------------------------------*/
/*	Supprimer un utilisateur	*/
	function SupprimerUnUtilisateur($numC)
	{
		global $link;
		$resultat=mysqli_query($link,'DELETE FROM Sac WHERE numC='.$numC.';');
		$resultat=mysqli_query($link,'DELETE FROM Dresseur WHERE numC='.$numC.';');
		$resultat=mysqli_query($link,'DELETE FROM Utilisateur WHERE numC='.$numC.';');

		$resultat=mysqli_query($link,'SELECT numero FROM Ordinateur WHERE numC='.$numC.';');
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		foreach ($requete as $pokemon)
		{
			$resultat=mysqli_query($link,'DELETE FROM PokemonSeul WHERE numero='.$pokemon['numero'].';');
		}

		$resultat=mysqli_query($link,'DELETE FROM Ordinateur WHERE numC='.$numC.';');
		$resultat=mysqli_query($link,'DELETE FROM EqPokemon WHERE numC='.$numC.';');
		$resultat=mysqli_query($link,'DELETE FROM Ami WHERE moi='.$numC.' OR lui='.$numC.';');

		$resultat=mysqli_query($link,'DELETE FROM AttaqueParDresseur WHERE numC='.$numC.';');

		$resultat=mysqli_query($link,'DELETE FROM PokedexParDresseur WHERE numC='.$numC.';');

	}

	function SecuriserText($text)
	{
		global $link;
		$text = htmlentities($text);
		//$nom2 = preg_replace('/"/', '\"', $nom2);
		//$text = preg_replace("/'/", "\'", $text);
		$text = addslashes($text);
		//echo "<br>".$nom2."<br>";
		
		return $text;		
	}

	function NomDresseurCommencePar($numC,$text)
	{
		global $link;
		$text = SecuriserText($text);
		$query = "SELECT pseudo FROM Dresseur WHERE numC=".$numC." AND pseudo LIKE '".$text."%';";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}






	/*---------------------------------------------------------------------------------------------------------------------------------*/
						/*--------------------------------------------------------------------------------------- */
	/*---------------------------------------------------------------------------------------------------------------------------------*/
	/* COMBAT EN LIGNE */

	function AnnulerCombat($moi)
	{
		global $link;
		$query="DELETE FROM DemanderCombat WHERE moi=".$moi.";";
		$resultat=mysqli_query($link,$query);
	}

	function RefuserUnCombat($moi,$lui)
	{
		global $link;
		$query="DELETE FROM DemanderCombat WHERE moi=".$moi." AND lui=".$lui.";";
		$resultat=mysqli_query($link,$query);
	}

	function TousSupprimerCombatQq($qq)
	{
		global $link;
		$query="DELETE FROM DemanderCombat WHERE moi=".$qq." OR lui=".$qq.";";
		$resultat=mysqli_query($link,$query);
		$query="DELETE FROM Combat WHERE j1=".$qq." OR j2=".$qq.";";
		$resultat=mysqli_query($link,$query);
	}

	function RefuserTousCombat($lui)
	{
		global $link;
		$query="DELETE FROM DemanderCombat WHERE lui=".$lui.";";
		$resultat=mysqli_query($link,$query);
	}

	function DemanderCombat($moi,$lui)
	{
		global $link;
		RefuserTousCombat($moi);
		$query="INSERT INTO DemanderCombat(moi,lui) VALUES (".$moi.",".$lui.")";
		$resultat=mysqli_query($link,$query);
	}

	function SupprimerCombat($numCombat)
	{
		global $link;
		$query="DELETE FROM Combat WHERE numCombat=".$numCombat.";";
		$resultat=mysqli_query($link,$query);
	}

	function GetActionCombat($joueur,$numCombat)
	{
		global $link;
		$query = "SELECT actionj".$joueur." FROM Combat WHERE numCombat=".$numCombat;
		//echo $query;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return 0;
		}
	}

	function SetActionCombat($joueur,$numCombat,$action)
	{
		global $link;
		$query = "UPDATE Combat SET actionj".$joueur."=".$action." WHERE numCombat=".$numCombat;
		//echo $query;
		$resultat=mysqli_query($link,$query);
	}

	function GetPokemonCombat($joueur,$numCombat)
	{
		global $link;
		$query = "SELECT pokemonj".$joueur." FROM Combat WHERE numCombat=".$numCombat;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}


	function SetPokemonCombat($joueur,$numCombat,$numero)
	{
		global $link;
		$query = "UPDATE Combat SET pokemonj".$joueur."=".$numero." WHERE numCombat=".$numCombat;
		//echo $query;
		$resultat=mysqli_query($link,$query);
	}


	function GetJoueurCombat($joueur,$numCombat)
	{
		global $link;
		$query = "SELECT j".$joueur." FROM Combat WHERE numCombat=".$numCombat;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}


?>