<?php session_start(); ?>
<?php include('bdd.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (!(isset($_COOKIE["pseudo"])))
	{
		if (isset($_POST['Ncompte']))
		{
			setcookie('pseudo',$_POST['Ncompte']);
		}
		if (isset($_POST['Email']))
		{
			setcookie('pseudo',$_POST['Email']);
		}	
	}
	else
	{
		if (isset($_POST['Ncompte']))
		{
			setcookie('pseudo',null,-1);
			setcookie('pseudo',$_POST['Ncompte']);
		}
		if (isset($_POST['Email']))
		{
			setcookie('pseudo',null,-1);
			setcookie('pseudo',$_POST['Email']);
		}	
	}
?>

<!DOCTYPE html>

<html>

<head>

	<title> Connexion </title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="PokemonAccueil.css">
</head>

<body >
	<img id="fond" src="imagesPoke/fondAccueil.jpg">
	<div id="tout">
	<?php
		if (isset($_POST['Ncompte']) && isset($_POST['motdepasse']))
		{
			$_POST['Ncompte'] = SecuriserText($_POST['Ncompte']);
			$_POST['motdepasse'] = md5($_POST['motdepasse']);
		}
		if (isset($_POST['Email']) && isset($_POST["motdepasse"]) && isset($_POST["confirmationmdp"]))
		{
			$_POST['Email'] = SecuriserText($_POST['Email']);
			$_POST['motdepasse'] = md5($_POST['motdepasse']);
			$_POST['confirmationmdp'] = md5($_POST['confirmationmdp']);
			//echo $_POST['Email']."<br>".password_hash($_POST['motdepasse'],PASSWORD_DEFAULT)."<br>".$_POST['confirmationmdp'];
			//echo md5("test")."<br>".md5("test");
		}
		if (isset($_SESSION["numC"]) && isset($_SESSION["pseudo"]) && !empty($_SESSION["numC"]) && !empty($_SESSION["pseudo"]))
		{
			header('Location: menu.php');
		}

		else if (isset($_POST['loagin']) && !empty($_POST['loagin']) && !empty($_POST['Ncompte']) && !empty($_POST['motdepasse']))
		{
			$query = "SELECT numC FROM Utilisateur WHERE pseudo = '".$_POST['Ncompte']."';";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			if ($requete[0])
			{
				$query = "SELECT mdp FROM Utilisateur WHERE pseudo = '".$_POST['Ncompte']."';";
				$resultatBis=mysqli_query($link,$query);
				$requeteBis=mysqli_fetch_row($resultatBis);

				if ($requeteBis[0] == /*password_hash(*/$_POST['motdepasse']/*,PASSWORD_DEFAULT)*/)
				{
					$_SESSION["numC"]=$requete[0];
					$_SESSION["pseudo"]=$requeteBis[0];

					SetConnecterUtilisateur($_SESSION["numC"],1);

					header('Location: menu.php');
				}
				else
				{
					echo "<script>alert('Compte inconnu')</script>";
				}

			}
			else
			{
				echo "<script>alert('Compte inconnu')</script>";
			}
		}
		else if (isset($_POST['new']) && !empty($_POST['new']) && !empty($_POST['Email']) && !empty($_POST["motdepasse"]) && !empty($_POST["confirmationmdp"]))
		{
			$query = "SELECT numC FROM Utilisateur WHERE pseudo = '".$_POST['Email']."';";
			$resultat=mysqli_query($link,$query);
			$requete=mysqli_fetch_row($resultat);
			if ($requete[0])
			{
				echo "<script>alert('Compte déjà existant')</script>";
			}
			else
			{
				if ($_POST["motdepasse"] != $_POST["confirmationmdp"])
				{
					echo "<script>alert('Veuillez entrer deux mots de passe identitiques')</script>";
				}
				else
				{
					$query = "INSERT INTO Utilisateur (pseudo,mdp,connecter) VALUES ('".$_POST['Email']."','"./*password_hash(*/$_POST['motdepasse']/*,PASSWORD_DEFAULT)*/."',1);";
					//echo $query."<br>";
					$resultat=mysqli_query($link,$query);
					if ($resultat)
					{
						$query = "SELECT numC,pseudo FROM Utilisateur WHERE pseudo = '".$_POST['Email']."';";
					//	echo $query."<br>";
						$resultat=mysqli_query($link,$query);
						$requete=mysqli_fetch_row($resultat);

						$_SESSION["numC"]=$requete[0];
						$_SESSION["pseudo"]=$requete[1];
						header('Location: scénario.php');
					}
				}
			}
		}
	?>



	<form method="post" action="pokemonaccueil.php">
		<div id="loagin" >
			<table>
			<tr><td>Nom de compte:</td><td><input type="email" name="Ncompte" placeholder="Name" 

					<?php 
						if (isset($_COOKIE['pseudo']) && !empty($_COOKIE['pseudo']))
						{ 
							echo "value='".$_COOKIE['pseudo']."'";
						}
				?>

				></td></tr>

			<tr><td>Mot de passe: </td><td><input type="Password" name="motdepasse" placeholder="Password" > </td></tr>
			</table>
			<input type="hidden" name="loagin" value="1"/>
			<center><input id="entrée" type="submit" name="soummetre" value="Envoyer"></center>

		</div>
		

	</form>

	<div id="bouton" >
		<button id="nouveau"> créer un compte </button> 
		<button id="existant"> compte deja existant </button> 
	</div>

	<form method="post" action="pokemonaccueil.php">

		<div id="new">
			<table>
			
			<tr><td> E-mail: </td><td> <input type="email" name="Email" placeholder="exemple@opérateur.fr" required=""></td></tr>

			<tr><td> Mot de passe: </td><td> <input type="Password" name="motdepasse" placeholder="Password" required=""> </td></tr>

			<tr><td> confirmation mot de passe: </td><td> <input type="Password" name="confirmationmdp" placeholder="Password" required=""> </td></tr>
			</table>
			<input type="hidden" name="new" value="1"/>
			<input  id="envoie" type="submit" name="soummetre" value="Envoyer">

		</div>
		

	</form>
</div>

	<script type="text/javascript">
		var existant =  document.querySelector("button#existant");
		var nouveau = document.querySelector("button#nouveau");
		var compteNvx = document.querySelector("div#new");
		var compteAcn = document.querySelector("div#loagin");
		 compteNvx.style.visibility = 'hidden' ;
		function afficher_nouveau(){
			compteNvx.style.visibility = 'visible' ;
			compteAcn.style.visibility = 'hidden' ;
		}
		function afficher_Ancien(){
			compteNvx.style.visibility = 'hidden' ;
			compteAcn.style.visibility = 'visible' ;
		}
		nouveau.onclick = afficher_nouveau ;
		existant.onclick = afficher_Ancien ; 
	</script>
</body>
</html>