<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (isset($_POST['afficherInfo']))
	{
		echo "<table><tr><td>";
				echo "<b>Nom de Dresseur :</b></td><td><b>".GetNomDresseur($_SESSION["numC"])."</b>";
		echo "</td></tr><tr><td>";
				echo "Changer de Nom : </td><td>";
					echo "<form><table><tr><td><input type='text' id='nvPseudo' placeholder='Nouveau Nom' maxlength='50' onKeyPress='if (event.keyCode == 13) confirmerPseudo()' required/></td></tr>";
					echo "<tr><td><input type='button' onclick='confirmerPseudo()' value='Confirmer'/></td></tr></table></form>";
		echo "</td></tr><tr><td>";
				echo "<b>Sexe du Dresseur :</b></td><td><b>".GetNomSexeDresseur($_SESSION["numC"])."</b>";
		echo "</td></tr><tr><td>";	
				echo "Changer de sexe : </td><td> <input type='button' value='devenir un";
													if (GetSexeDresseur($_SESSION["numC"])==2)
													{
														echo "e fille";
													}
													else
													{
														echo " garçon";
													}
													echo "' onclick='ChangerSexe()'/>";
		echo "</td></tr><tr><td>";	
			echo "<b>Niveau du Dresseur :</b></td><td><b>".GetNiveauDresseur($_SESSION["numC"])."</b>";
		echo "</td></tr><tr><td>";	
			echo "<b>Expérience :</b></td><td>";
				echo "<div id='barrexpMax'>";
					echo "<div id='barrexp'></div>";
				echo "</div>";
				echo "<input type='hidden' id='xpMax' value='".(GetNiveauDresseur($_SESSION["numC"])*10)."'/>";
				echo "<input type='hidden' id='xp' value='".GetXpDresseur($_SESSION["numC"])."'/>";
		echo "</td></tr><tr><td>";
			echo "<b>Adresse du Compte :</b></td><td><b>".GetPseudoUtilisateur($_SESSION["numC"])."</b>";
		echo "</td></tr><tr><td>";
			echo "Changer Mot de Passe:</td><td>"; 
				echo "<form><table><tr><td><input type='password' id='mdp' placeholder='Nouveau mot de passe'  maxlength='50' onKeyPress='if (event.keyCode == 13) focusMdp2()' required/></td></tr>";
				 echo "<tr><td><input type='password' id='mdp2' placeholder='confirmation mot de passe' maxlength='50' onKeyPress='if (event.keyCode == 13) confirmerMdp()' required/></td></tr>";
				 echo "<tr><td><input type='button' value='Confirmer' onclick='confirmerMdp()'/></td></tr></table></form>";
			//echo "</td><td><input type='button' value='Changer'/>";
		echo "</td></tr>";
		echo "<tr><td>Supprimer mon compte :</td><td></td></tr>";
		echo "<tr><td> <input type='button' value='Supprimer' onclick='SupprimerCompte()'/> </td><td></td></tr>";
		echo "</table>";
	}

	if(isset($_POST['afficherImage']))
	{
		echo "<img src='imagesPoke/sexe".GetSexeDresseur($_SESSION["numC"]).".png'>";
	}

	if (isset($_POST['changersexe']))
	{
		SetSexeDresseur($_SESSION["numC"]);
	}

	if (isset($_POST['changerpseudo']))
	{
		SetNomDresseur($_SESSION["numC"], $_POST['changerpseudo']);
	}

	if (isset($_POST['changermdp']) && isset($_POST['changermdp2']))
	{
		if ($_POST['changermdp'] == $_POST['changermdp2'])
		{
			SetMdpUtilisateur($_SESSION["numC"],md5($_POST['changermdp']));
		}
	}

	if (isset($_POST['supprimerCompte']))
	{
		if (md5($_POST['supprimerCompte']) == GetMdpUtilisateur($_SESSION['numC']))
		{
			//header('Location: deconnexion.php');
			SupprimerUnUtilisateur($_SESSION['numC']);
			echo 1;
			//echo SecuriserText($_POST['supprimerCompte'])."\n".addslashes(GetMdpUtilisateur($_SESSION['numC']));
		}
		else
		{
			//echo SecuriserText($_POST['supprimerCompte'])."\n".addslashes(GetMdpUtilisateur($_SESSION['numC']));
			echo 2;
		}
	}

	if(isset($_POST['AfficherAmiConfirmer']))
	{
		$query="SELECT lui FROM Ami WHERE moi=".$_SESSION['numC']." AND lui IN (SELECT moi FROM Ami WHERE lui=".$_SESSION['numC'].")";
		$resultat=mysqli_query($link,$query);
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

		foreach ($requete as $lui) {
			$numC=$lui['lui'];
			if (NomDresseurCommencePar($numC,$_POST['AfficherAmiConfirmer']))
			{
				echo "<div> ";
					echo "<table>";
						echo "<tr><th> Nom Dresseur: </th><th>".GetNomDresseur($numC)."</th></tr>";
						echo "<tr><td> Connecter </td><td>";
															if (GetConnecterUtilisateur($numC))
															{
																echo "<h5 style='color:green;'>Oui</h5>";
															}
															else
															{
																echo "<h5 style='color:red;'>Non</h5>";
															}
															echo "</td></tr>";
						echo "<tr><td colspan='2'> <input type='button' onclick='AfficherVoirProfil(".$numC.")' value='Voir Profil'/> </td></tr>";
					echo "</table>";
				echo "</div>";
			}	
		}
	}
	if (isset($_POST['AfficherVoirProfil']) && !empty($_POST['AfficherVoirProfil']))
	{
		$numC = $_POST['AfficherVoirProfil'];
		echo "<table>";
			echo "<tr><th> Nom : </th><th>".GetNomDresseur($numC)."</th></tr>";
			echo "<tr><td> Niveau: </td><td>".GetNiveauDresseur($numC)."</td></tr>";
			echo "<tr><td> Sexe: </td><td>".GetNomSexeDresseur($numC)."</td></tr>";
			echo "<tr><td> Connecter </td><td>";
												if (GetConnecterUtilisateur($numC))
												{
													echo "<h5 style='color:green;'>Oui</h5>";
												}
												else
												{
													echo "<h5 style='color:red;'>Non</h5>";
												}
												echo "</td></tr>";
			echo "<tr><td colspan='2'> <input type='button' onclick='SupprimerAmi(".$_SESSION['numC'].",".$numC.")' value='Supprimer cet(te) ami(e)'/> </td></tr>";							
		echo "</table>";
	}

	
	if(isset($_POST['AfficherNouveauAmi']))
	{
		if($_POST['AfficherNouveauAmi'])
		{
			echo "Rechercher de nouveaux amis:<br>";
			$query="SELECT numC FROM Utilisateur WHERE numC NOT IN (SELECT lui FROM Ami WHERE moi=".$_SESSION['numC'].")
												   AND numC NOT IN (SELECT moi FROM Ami WHERE lui=".$_SESSION['numC'].")
												   AND numC <> ".$_SESSION['numC'];
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

			foreach ($requete as $num) {
				$numC=$num['numC'];
				if (NomDresseurCommencePar($numC,$_POST['AfficherNouveauAmi']))
				{
					echo "<div>";
						echo "<table>";
							echo "<tr><th> Nom Dresseur: </th><th>".GetNomDresseur($numC)."</th></tr>";
							echo "<tr><td colspan='2'> <input type='button' value='Ajouter' onclick='AjouterAmi(".$_SESSION['numC'].",".$numC.")'/> </td></tr>";
						echo "</table>";
					echo "</div>";
				}
			}
		}
		else
		{
			echo "Demande(s) d'ami reçu:<br>";
			$query="SELECT moi FROM Ami WHERE lui=".$_SESSION['numC']." AND moi NOT IN (SELECT lui FROM Ami WHERE moi=".$_SESSION['numC'].")";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);

			foreach ($requete as $lui) {
				$numC=$lui['moi'];
				echo "<div>";
					echo "<table>";
						echo "<tr><th> Nom Dresseur: </th><th>".GetNomDresseur($numC)."</th></tr>";
						echo "<tr>";
							echo "<td> <input type='button' value='Accepter' onclick='AjouterAmi(".$_SESSION['numC'].",".$numC.")'/> </td>";
							echo "<td> <input type='button' value='Refuser' onclick='SupprimerAmi(".$_SESSION['numC'].",".$numC.")'/> </td>";
						echo "</tr>";
					echo "</table>";
				echo "</div>";
			}
		}
	}

	if (isset($_POST['AjouterAmiNum1']) && isset($_POST['AjouterAmiNum2']))
	{
		SetAmi($_POST['AjouterAmiNum1'],$_POST['AjouterAmiNum2']);
	}
	if (isset($_POST['SupprimerAmiNum1']) && isset($_POST['SupprimerAmiNum2']))
	{
		SupprimerAmitier($_POST['SupprimerAmiNum1'],$_POST['SupprimerAmiNum2']);
	}
?>