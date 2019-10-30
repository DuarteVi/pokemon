<?php
function genererPokemon()
	{
		global $link;
		$nump=rand(1,151);
	    $resultat=mysqli_query($link,"SELECT nom,PV,statF,statD,statV,type1,type2 FROM Pokedex  where nump=".$nump.";");
		$requete=mysqli_fetch_row($resultat);
		$surnom=$requete[0];
		$niveau=rand(1,100);
		$vieMax=$requete[1];
		$vieMax=$vieMax+($niveau*3);
		$vie=$vieMax;
		$xp=0;
		$statF=$requete[2];
		$statD=$requete[3];
		$statV=$requete[4];
		$statF=$statF+($niveau*3);
		$statD=$statD+($niveau*3);
		$statV=$statV+($niveau*3);

		$type1=$requete[5];
		$type2=$requete[6];
		if (empty($type2))
		{
			$type2="null";
		}
		

		$nombreAtt=rand(0,3);
		$listeAtt = array(0,0,0,0);
		$listePP = array(0,0,0,0);
		for ( $i=0 ; $i<=$nombreAtt ; $i++)
		{
			$query="SELECT COUNT(numA) FROM Attaque where (type=".$type1." OR type=".$type2.") 
											AND numA<>".$listeAtt[0]." AND numA<>".$listeAtt[2]."
											AND numA<>".$listeAtt[3]." AND numA<>".$listeAtt[1].";";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			$nombreTotal=$requete[0];
			$resultat=mysqli_query($link,"SELECT numA FROM Attaque where (type=".$type1." OR type=".$type2.") 
											AND numA<>".$listeAtt[1]." AND numA<>".$listeAtt[2]."
											AND numA<>".$listeAtt[3]." AND numA<>".$listeAtt[0].";");
			$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
			$numattaque=rand(0,$nombreTotal-1);

			$listeAtt[$i] = $requete[$numattaque]["numA"];

			$resultat = mysqli_query($link,"SELECT pp FROM Attaque where numA=".$listeAtt[$i].";");
			$requete=mysqli_fetch_row($resultat);
			$listePP[$i]=$requete[0];
			
		}

		$pokemon= array("nump"=>$nump,"surnom"=>$surnom,"niveau"=>$niveau,"vieMax"=>$vieMax,"xp"=>$xp,
					"statF"=>$statF,"statD"=>$statD,"statV"=>$statV,"type1"=>$type1,"type2"=>$type2,
					"attaque"=> array("att1"=>$listeAtt[0],"att2"=>$listeAtt[1],"att3"=>$listeAtt[2],"att4"=>$listeAtt[3]),
					"nombreAtt"=>$nombreAtt,
					"pp"=> array("pp1"=>$listePP[0],"pp2"=>$listePP[1],"pp3"=>$listePP[2],"pp4"=>$listePP[3])
					);

		return $pokemon;
	}

	function genererPokemonLieu($lieu)
	{
		global $link;

		$resultat=mysqli_query($link,"SELECT COUNT(nump) FROM Pokedex  where lieu=".$lieu.";");
		$requete=mysqli_fetch_row($resultat);
		$nombreTotal=$requete[0];



		if ($nombreTotal > 0)
		{
			$resultat=mysqli_query($link,"SELECT nump FROM Pokedex where lieu=".$lieu.";");
			$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
			$nump=$requete[rand(0,$nombreTotal-1)]['nump'];

			//echo "NUMP : ".$nump;

		    $resultat=mysqli_query($link,"SELECT nom,PV,statF,statD,statV,type1,type2 FROM Pokedex  where nump=".$nump.";");
			$requete=mysqli_fetch_row($resultat);
			$surnom=$requete[0];
			//$niveau=rand(1,9)+5*(min($lieu,10));
			$niveau =(5*($lieu-1))+rand(0,5);
			$niveau = max($niveau,1);

			$vieMax=$requete[1];
			$vieMax=$vieMax+($niveau*3);
			$vie=$vieMax;
			$xp=0;
			$statF=$requete[2];
			$statD=$requete[3];
			$statV=$requete[4];
			$statF=$statF+($niveau*3);
			$statD=$statD+($niveau*3);
			$statV=$statV+($niveau*3);

			$type1=$requete[5];
			$type2=$requete[6];
			if (empty($type2))
			{
				$type2="null";
			}
			

			$nombreAtt=rand(0,3);
			$listeAtt = array(0,0,0,0);
			$listePP = array(0,0,0,0);
			for ( $i=0 ; $i<=$nombreAtt ; $i++)
			{
				$resultat=mysqli_query($link,"SELECT COUNT(numA) FROM Attaque where (type=".$type1." OR type=".$type2.") 
												AND numA<>".$listeAtt[0]." AND numA<>".$listeAtt[2]."
												AND numA<>".$listeAtt[3]." AND numA<>".$listeAtt[1].";");
				$requete=mysqli_fetch_row($resultat);
				$nombreTotal=$requete[0];
				$resultat=mysqli_query($link,"SELECT numA FROM Attaque where (type=".$type1." OR type=".$type2.") 
												AND numA<>".$listeAtt[1]." AND numA<>".$listeAtt[2]."
												AND numA<>".$listeAtt[3]." AND numA<>".$listeAtt[0].";");
				$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
				$numattaque=rand(0,$nombreTotal-1);

				$listeAtt[$i] = $requete[$numattaque]["numA"];

				$resultat = mysqli_query($link,"SELECT pp FROM Attaque where numA=".$listeAtt[$i].";");
				$requete=mysqli_fetch_row($resultat);
				$listePP[$i]=$requete[0];
				
			}

			$pokemon= array("nump"=>$nump,"surnom"=>$surnom,"niveau"=>$niveau,"vie"=>$vieMax,"vieMax"=>$vieMax,"xp"=>$xp,
						"statF"=>$statF,"statD"=>$statD,"statV"=>$statV,"type1"=>$type1,"type2"=>$type2,
						"attaque"=> array("att1"=>$listeAtt[0],"att2"=>$listeAtt[1],"att3"=>$listeAtt[2],"att4"=>$listeAtt[3]),
						"nombreAtt"=>$nombreAtt,
						"pp"=> array("pp1"=>$listePP[0],"pp2"=>$listePP[1],"pp3"=>$listePP[2],"pp4"=>$listePP[3])
						);

			return $pokemon;
		}
		else
		{
			return null;
		}
	}

	function SupprimerPokemon($numero)
	{
		global $link;
		$resultat=mysqli_query($link,"DELETE FROM PokemonSeul where numero=".$numero." ;");
		$resultat=mysqli_query($link,"DELETE FROM Ordinateur where numero=".$numero." ;");
	}

/*-------------------------------------------------------------------------------------------------*/
/*	Type	*/
	function GetNomType($numero)
	{
		if ($numero!=null)
		{
			global $link;
			$query = "SELECT nomT  FROM Type WHERE numT=".$numero.";";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			if ($requete != NULL)
			{
				//echo $requete[0];
				return $requete[0];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return null;
		}
	}
	function GetCoeffType($type1,$type2)
	{
		if ($type2 == "null")
		{
			return 0;
		}
		else if ($type2 != null && $type2 != 0)
		{
			global $link;
			$query = "SELECT type".$type2." FROM Type WHERE numT=".$type1.";";
			//echo "<br>".$query."<br>";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			return $requete[0];
		}
		else
		{
			return 0;
		}

	}
/*-------------------------------------------------------------------------------------------------*/
/*	Attaque	*/
	function GetNomAttaque($numero)
	{
		global $link;
		$query = "SELECT nom FROM Attaque WHERE numA=".$numero.";";
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
	function GetPpAttaque($numero)
	{
		global $link;
		$query = "SELECT pp FROM Attaque WHERE numA=".$numero.";";
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
	function GetTypeAttaque($numero)
	{
		global $link;
		$query = "SELECT type FROM Attaque WHERE numA=".$numero.";";
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
	function GetDescriptionAttaque($numero)
	{
		global $link;
		$query = "SELECT description FROM Attaque WHERE numA=".$numero.";";
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
	function GetDegatAttaque($numero)
	{
		global $link;
		$query = "SELECT degat  FROM Attaque WHERE numA=".$numero.";";
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
/*-------------------------------------------------------------------------------------------------*/
/*	pokemonSeul	*/
	function GetNumpPokemonSeul($numero)
	{
		global $link;
		$query = "SELECT numP  FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetNumpPokemonSeul($numero,$num)
	{
		global $link;
		$query="UPDATE PokemonSeul SET nump=".$num." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetSurnomPokemonSeul($numero)
	{
		global $link;
		$query = "SELECT surnom  FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetSurnomPokemonSeul($numero,$nom)
	{
		global $link;							//Prendre les 30 premiers caractères
		$query="UPDATE PokemonSeul SET surnom='".substr($nom,0,30)."' WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetNiveauPokemonSeul($numero)
	{
		global $link;
		$query = "SELECT niveau  FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetNiveauPokemonSeul($numero,$niveau)
	{
		global $link;
		if ($niveau < 1)
		{
			$niveau = 1;
		}
		$query="UPDATE PokemonSeul SET niveau=".$niveau." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetViePokemonSeul($numero)
	{
		global $link;
		$query = "SELECT vie  FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetViePokemonSeul($numero,$pv)
	{
		global $link;
		if ($pv < 0)
		{
			$pv = 0;
		}
		if ($pv > GetVieMaxPokemonSeul($numero))
		{
			$pv = GetVieMaxPokemonSeul($numero);
		}
		$query="UPDATE PokemonSeul SET vie=".$pv." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetVieMaxPokemonSeul($numero)
	{
		global $link;
		$query = "SELECT vieMax  FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetVieMaxPokemonSeul($numero,$pv)
	{
		global $link;
		if ($pv > 999999999)
		{
			$pv = 999999999;
		}
		$query="UPDATE PokemonSeul SET vieMax=".$pv." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetXpPokemonSeul($numero)
	{
		global $link;
		$query = "SELECT xp  FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetXpPokemonSeul($numero,$xp)
	{
		global $link;
		if ($xp < 0)
		{
			$xp = 0;
		}
		$query="UPDATE PokemonSeul SET xp=".$xp." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetStatPokemonSeul($numero,$caractere)
	{
		global $link;
		$query = "SELECT stat".$caractere." FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetStatPokemonSeul($numero,$caractere,$valeur)
	{
		global $link;
		if ($valeur < 0)
		{
			$valeur = 0;
		}
		$query="UPDATE PokemonSeul SET stat".$caractere."=".$valeur." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
	}
	function GetAttPokemonSeul($numero,$num)
	{
		global $link;
		$query = "SELECT att".$num." FROM PokemonSeul WHERE numero=".$numero.";";
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
	function SetAttPokemonSeul($numero,$num,$valeur)
	{
		global $link;
		$query="UPDATE PokemonSeul SET att".$num."=".$valeur." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);


		SetPpPokemonSeul($numero,$num,GetPpAttaque($valeur));
	}	
	function GetPpPokemonSeul($numero,$num)
	{
		global $link;
		$query = "SELECT pp".$num." FROM PokemonSeul WHERE numero=".$numero.";";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete!=null || $requete==0)
		{
			return $requete[0];
		}
		else
		{
			return null;
		}
	}
	function SetPpPokemonSeul($numero,$num,$valeur)
	{
		global $link;
		if (!$valeur)
		{
			$valeur = 0;	
		}
		if ($valeur < 0)
		{
			$valeur = 0;
		}
		$query="UPDATE PokemonSeul SET pp".$num."=".$valeur." WHERE numero=".$numero;
		$resultat=mysqli_query($link,$query);		
		//echo $query;
	}
/*-------------------------------------------------------------------------------------------------*/
/*	Pokedex	*/
	function GetNomPokedex($numero)
	{
		global $link;
		$query = "SELECT nom FROM Pokedex WHERE numP=".$numero.";";
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
	function GetType1Pokedex($numero)
	{
		global $link;
		$query = "SELECT type1  FROM Pokedex WHERE numP=".$numero.";";
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
	function GetType2Pokedex($numero)
	{
		if ($numero!=null)
		{
			global $link;
			$query = "SELECT type2  FROM Pokedex WHERE numP=".$numero.";";
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
		else
		{
			return null;
		}
	}
	function GetEvolutionPokedex($numero)
	{
		global $link;
		$query = "SELECT evolution FROM Pokedex WHERE numP=".$numero.";";
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
	function GetPalierPokedex($numero)
	{
		global $link;
		$query = "SELECT palier  FROM Pokedex WHERE numP=".$numero.";";
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
	function GetpokemonSPokedex($numero)
	{
		global $link;
		$query = "SELECT pokemonS  FROM Pokedex WHERE numP=".$numero.";";
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
	function GetStatPokedex($numero,$lettre)
	{
		global $link;
		$query = "SELECT stat".$lettre." FROM Pokedex WHERE numP=".$numero.";";
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
	function GetPvPokedex($numero)
	{
		global $link;
		$query = "SELECT pv  FROM Pokedex WHERE numP=".$numero.";";
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
	function GetLieuPokedex($numero)
	{
		global $link;
		$query = "SELECT lieu FROM Pokedex WHERE numP=".$numero.";";
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

	function RemplirPokedex($nump)
	{
		global $link;
		$query = "SELECT pokemon FROM PokedexParDresseur WHERE numC=".$_SESSION["numC"]." AND pokemon=".$nump.";";
		//echo $query;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);

		if (!$requete)
		{
			$query = "INSERT INTO PokedexParDresseur (numC,pokemon) VALUES (".$_SESSION["numC"].",".$nump.");";
		//	echo $query;
			$resultat=mysqli_query($link,$query);
		}

		
	}

/*-------------------------------------------------------------------------------------------------*/
/*	FaireUneAttaque	*/
/*	function FaireUneAttaque($pokemon1,$attaque,$pokemon2)
	{

	}*/

	function GetAttaqueParNumero($numero,$pokemon)
	{
		global $link;
		$numero = $numero + 1;

		$query = "SELECT att".$numero."  FROM PokemonSeul WHERE numero=".$pokemon.";";
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