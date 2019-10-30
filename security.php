<?php
	session_start();


	if (!(isset($_SESSION["numC"]) && isset($_SESSION["pseudo"])))
	{
		header('Location: pokemonaccueil.php');
	}
	else
	{
		$resultat=mysqli_query($link,"SELECT * FROM Dresseur WHERE numC=".$_SESSION["numC"].";");
		$requete=mysqli_fetch_row($resultat);
		if(empty($requete[0]))
		{
			header('Location: scénario.php');
		}
	}
?>
