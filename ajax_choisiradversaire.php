<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (isset($_POST['AfficherLesNonAmisConnecter']))
	{
		$query = "SELECT numC FROM Utilisateur WHERE numC!=".$_SESSION['numC']." AND connecter=1";
		//echo $query;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

		$compteur = 0;
		foreach ($requete as $utilisateur) {
			//echo "<div id='adversaire'>".$utilisateur['numC']."</div>";
			
			//DEMANDE D'AMI RECU
			$resultatBis=mysqli_query($link,"SELECT lui FROM Ami where lui=".$utilisateur['numC']." AND moi=".$_SESSION['numC']." AND lui NOT IN (SELECT moi FROM Ami WHERE moi=".$utilisateur['numC']." AND lui=".$_SESSION['numC'].")");
			$requeteBis=mysqli_fetch_row($resultatBis);
			if ($requeteBis[0])
			{
				echo "<div id='adversaire'>";
					echo "<table>";
						echo "<tr><td> Nom de Dresseur </td><td> ".GetNomDresseur($utilisateur['numC'])."</td></tr>";
						echo "<tr><td> Niveau de Dresseur </td><th> ".GetNiveauDresseur($utilisateur['numC'])."</th></tr>";
						echo "<tr><td colspan='2'> <input type='button' value='Envoyer une invitation au combat' onclick='EnvoyerInvitation(".$utilisateur['numC'].")'/> </td></tr>";
						echo "<tr><th colspan='2'> (demande d'ami envoyée) </th></tr>";
					echo "</table>";
				echo "</div>";
					//echo GetNomDresseur($utilisateur['numC'])." demande d'ami envoyée";
				$compteur = 1;
			}
			//DEMANDE D'AMI ENVOYEE
			$resultatBis=mysqli_query($link,"SELECT moi FROM Ami where moi=".$utilisateur['numC']." AND lui=".$_SESSION['numC']." AND moi NOT IN (SELECT lui FROM Ami WHERE lui=".$utilisateur['numC']." AND moi=".$_SESSION['numC'].")");
			$requeteBis=mysqli_fetch_row($resultatBis);
			if ($requeteBis[0])
			{
				echo "<div id='adversaire'>";
					echo "<table>";
						echo "<tr><td> Nom de Dresseur </td><td> ".GetNomDresseur($utilisateur['numC'])."</td></tr>";
						echo "<tr><td> Niveau de Dresseur </td><th> ".GetNiveauDresseur($utilisateur['numC'])."</th></tr>";
						echo "<tr><td colspan='2'> <input type='button' value='Envoyer une invitation au combat' onclick='EnvoyerInvitation(".$utilisateur['numC'].")'/> </td></tr>";
						echo "<tr><th colspan='2'> (demande d'ami reçue) </th></tr>";
					echo "</table>";
				echo "</div>";
					//echo GetNomDresseur($utilisateur['numC'])." demande d'ami reçu";
				$compteur = 1;
			}
			//UTILISATEUR QUELCONQUE
			$resultatBis=mysqli_query($link,"SELECT moi FROM Ami where (moi=".$utilisateur['numC']." AND lui=".$_SESSION['numC'].") OR (lui=".$utilisateur['numC']." AND moi=".$_SESSION['numC'].")");
			$requeteBis=mysqli_fetch_row($resultatBis);
			if (!$requeteBis[0])
			{
				echo "<div id='adversaire'>";
					echo "<table>";
						echo "<tr><td> Nom de Dresseur </td><td> ".GetNomDresseur($utilisateur['numC'])."</td></tr>";
						echo "<tr><td> Niveau de Dresseur </td><th> ".GetNiveauDresseur($utilisateur['numC'])."</th></tr>";
						echo "<tr><td colspan='2'> <input type='button' value='Envoyer une invitation au combat' onclick='EnvoyerInvitation(".$utilisateur['numC'].")'/> </td></tr>";
					echo "</table>";
				echo "</div>";
				$compteur = 1;
			}
			
		}

		if ($compteur == 0)
		{
			echo "Aucun utilisateur connecté.";
		}
	}


	if (isset($_POST['AfficherLesAmis']))
	{
		$query = "SELECT numC FROM Utilisateur WHERE numC!=".$_SESSION['numC']." AND connecter=1";
		//echo $query;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

		$compteur = 0;
		foreach ($requete as $utilisateur) {
			$query = "SELECT lui FROM Ami WHERE moi=".$_SESSION['numC']." AND lui=".$utilisateur['numC']." AND lui IN (SELECT moi FROM Ami WHERE lui=".$_SESSION['numC']." AND moi=".$utilisateur['numC'].")";
			$resultatBis=mysqli_query($link,$query);
			$requeteBis=mysqli_fetch_row($resultatBis);
			if ($requeteBis[0])
			{
				echo "<div id='adversaire'>";
					echo "<table>";
						echo "<tr><td> Nom de Dresseur </td><td> ".GetNomDresseur($utilisateur['numC'])."</td></tr>";
						echo "<tr><td> Niveau de Dresseur </td><th> ".GetNiveauDresseur($utilisateur['numC'])."</th></tr>";
						echo "<tr><td colspan='2'> <input type='button' value='Envoyer une invitation au combat' onclick='EnvoyerInvitation(".$utilisateur['numC'].")'/> </td></tr>";
					echo "</table>";
				echo "</div>";
				$compteur = 1;
			}
		}



		$query = "SELECT numC FROM Utilisateur WHERE numC!=".$_SESSION['numC']." AND connecter=0";
		//echo $query;
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

		foreach ($requete as $utilisateur) {
			$query = "SELECT lui FROM Ami WHERE moi=".$_SESSION['numC']." AND lui=".$utilisateur['numC']." AND lui IN (SELECT moi FROM Ami WHERE lui=".$_SESSION['numC']." AND moi=".$utilisateur['numC'].")";
			$resultatBis=mysqli_query($link,$query);
			$requeteBis=mysqli_fetch_row($resultatBis);
			if ($requeteBis[0])
			{
				echo "<div id='adversaire'>";
					echo "<table>";
						echo "<tr><td> Nom de Dresseur </td><td> ".GetNomDresseur($utilisateur['numC'])."</td></tr>";
						echo "<tr><td> Niveau de Dresseur </td><th> ".GetNiveauDresseur($utilisateur['numC'])."</th></tr>";
						echo "<tr><td colspan='2'> <h4 style='color:red;'> Non connecté(e) </h4> </td></tr>";
					echo "</table>";
				echo "</div>";
				$compteur = 1;
			}
		}

		if ($compteur == 0)
		{
			echo "Vous n'avez pas d'ami.";
		}
	}

	if (isset($_POST['AnnulerDemande']))
	{
		 AnnulerCombat($_SESSION['numC']);

		echo " <div class='bouton' id='NonAmis'>
				<h4>Rechercher un Adversaire :</h4>
				<div id='listeNonAmis'>
				</div>
			</div>


			<div class='bouton' id='retour' onclick='RetourMenu()'>
				retour
			</div>


			<div class='bouton' id='Amis'>
				<h4>Rechercher parmi mes Amis :</h4>
				<div id='listeAmis'>
				</div>
			</div>";
	}


	if(isset($_POST['EnvoyerInvitation']))
	{
		TousSupprimerCombatQq($_SESSION['numC']);
		DemanderCombat($_SESSION['numC'],$_POST['EnvoyerInvitation']);

		echo "<div id='demande'>";
			echo "<h1>Vous souhaitez affronter ".GetNomDresseur($_POST['EnvoyerInvitation'])."</h1>";
			echo "<br>";
			echo "<br>";
			echo "(Dans l'attente de sa réponse...)";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo"<input type='button' value='Annuler' onclick='AnnulerDemande()'/>";
		echo "</div>";
	}

	if(isset($_POST['VerifierDemandeAdversaire']))
	{
		$query = "SELECT j1 FROM Combat WHERE j1=".$_SESSION['numC']." AND j2=".$_POST['VerifierDemandeAdversaire'];
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_row($resultat);

		if ($requete[0])
		{
			echo 2;
		}
		else
		{
			$query = "SELECT lui FROM DemanderCombat WHERE moi=".$_SESSION['numC']." AND lui=".$_POST['VerifierDemandeAdversaire'];
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);

			if ($requete[0])
			{
				echo 0;
			}
			else
			{
				echo 1;
			}
		}
	}


?>
