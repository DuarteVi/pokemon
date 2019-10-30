<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (isset($_POST['fermerFenetre']))
	{
		SetConnecterUtilisateur($_SESSION["numC"],0);
	}
	if (isset($_POST['FenetreOuverte']))
	{
		SetConnecterUtilisateur($_SESSION["numC"],1);
	}






	if (isset($_POST['DemandeCombatRecu']))
	{
		$query = "SELECT moi FROM DemanderCombat WHERE lui=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

		if ($requete[0]['moi'])
		{
			echo $requete[0]['moi'];
		}
		else
		{
			echo 0;
		}
	}

	if (isset($_GET['demandeAdversaire']))
	{
		echo GetNomDresseur($_GET['demandeAdversaire'])." souhaite se battre contre vous \n (niveau ".GetNiveauDresseur($_GET['demandeAdversaire']).") \n Accepter ?";
	}

	if (isset($_POST['RefuserDemande']))
	{
		RefuserUnCombat($_POST['RefuserDemande'],$_SESSION['numC']);
	}

	if (isset($_POST['DemandeConfirmer']))
	{
		$query = "SELECT moi FROM DemanderCombat WHERE moi=".$_POST['DemandeConfirmer']." AND lui=".$_SESSION['numC'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);
		if ($requete[0])
		{
			TousSupprimerCombatQq($_SESSION['numC']);

			//Premier pokemon en vie j1
			$compteur= 1;
			$verifier = 0;
			$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_POST['DemandeConfirmer'].";");
			$requete=mysqli_fetch_row($resultat);
			$pokemon1=1;
			foreach ($requete as $pokemon) {
				if ($pokemon)
				{
					if (GetViePokemonSeul($pokemon) > 0 && $verifier == 0)
					{
						$verifier = 1;
						$pokemon1 = $pokemon;
					}
					$compteur++;
				}
			}
			if ($verifier == 0)
			{
				$pokemon1 = GetPokemonEqPokemon($_POST['DemandeConfirmer'],1);
			}


			//Premier pokemon en vie j2
			$compteur= 1;
			$verifier = 0;
			$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
			$requete=mysqli_fetch_row($resultat);
			$pokemon2=1;
			foreach ($requete as $pokemon) {
				if ($pokemon)
				{
					if (GetViePokemonSeul($pokemon) > 0 && $verifier == 0)
					{
						$verifier = 1;
						$pokemon2 = $pokemon;
					}
					$compteur++;
				}
			}
			if ($verifier == 0)
			{
				$pokemon2 = GetPokemonEqPokemon($_SESSION['numC'],1);
			}

			$query = "INSERT INTO Combat(j1, pokemonj1, j2, pokemonj2) VALUES (".$_POST['DemandeConfirmer'].",".$pokemon1.",".$_SESSION['numC'].",".$pokemon2.")";
			//echo $query;
			$resultat=mysqli_query($link,$query);
			echo 1;
		}
		else
		{
			echo 0;
		}
		
	}



	if (isset($_POST['BonusQuotidien'])){
		date_default_timezone_set('UTC');
		$time = time()+3600;
		$date = date("Ymd",$time);
		if ($date > GetDateCUtilisateur($_SESSION['numC']))
		{
			SetPokeDSac($_SESSION['numC'], GetPokeDSac($_SESSION['numC'])+50);
			SetPokeBSac($_SESSION['numC'], GetPokeBSac($_SESSION['numC'])+5);
			SetDateCUtilisateur($_SESSION['numC'],$date);
			$query = "SELECT numero FROM Ordinateur WHERE numC=".$_SESSION['numC'];
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
			foreach ($requete as $pokemon ) {
				SetViePokemonSeul($pokemon['numero'],GetVieMaxPokemonSeul($pokemon['numero']));
			}

			echo 1;
		}	
		else
		{
			echo 0;
		}
	}
	
?>