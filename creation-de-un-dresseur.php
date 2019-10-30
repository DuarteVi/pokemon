<?php 
	include('bdd.php'); 
?>
<!DOCTYPE html>
<head>
	<title>base de données</title>
	<meta charset="utf-8">
</head>
<body>
	<?php include('pokemon.php'); ?>
	<?php
	if ($link)
	{
		$resultat=mysqli_query($link,'DELETE FROM Sac WHERE numC=1;');
		$resultat=mysqli_query($link,'DELETE FROM Dresseur WHERE numC=1;');
		$resultat=mysqli_query($link,'DELETE FROM Utilisateur WHERE numC=1;');
		$resultat=mysqli_query($link,'DELETE FROM PokemonSeul WHERE numero BETWEEN 0 AND 20;');
		$resultat=mysqli_query($link,'DELETE FROM Ordinateur WHERE numC=1;');
		$resultat=mysqli_query($link,'DELETE FROM EqPokemon WHERE numC=1;');

		$query = "INSERT INTO Utilisateur (pseudo,mdp,numC) VALUES ('test@test.fr','test',1);";
		$resultat=mysqli_query($link,$query);
		if (!$resultat)
		{
			echo "<p><font color='red'>Erreur</font> lors de la création de l'Utilisateur.</p>";
		}
		else
		{
		    echo "<p>création de l'Utilisateur <font color='green'>OK</font></p>";

		    $resultat=mysqli_query($link,"INSERT INTO Dresseur (numC,pseudo,sexe,niveauD,xp) VALUES (1,'test',1,50,15);");
		    if (!$resultat)
			{
				echo "<p><font color='red'>Erreur</font> lors de la création du dresseur.</p>";
			}
			else
			{
				echo "<p>création du Dresseur <font color='green'>OK</font></p>";
			}

			$resultat=mysqli_query($link,"INSERT INTO Sac (numC,soin) VALUES (1,50);");
		    if (!$resultat)
			{
				echo "<p><font color='red'>Erreur</font> lors de la création du sac.</p>";
			}
			else
			{
				echo "<p>création du sac <font color='green'>OK</font></p>";
			}

			$compteur = 0;
			for ( $i = 0 ; $i < 20 ; $i++)
			{
				$pokemon = genererPokemon();
				$query = "	INSERT INTO PokemonSeul (numero,numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
							VALUES (".$i.",".$pokemon['nump'].",'".$pokemon['surnom']."',".$pokemon['niveau'].",".$pokemon['vieMax'].",".$pokemon['vieMax'].",
									".$pokemon['xp'].",".$pokemon['statF'].",".$pokemon['statD'].",".$pokemon['statV'].",
									".$pokemon['attaque']['att1'].",".$pokemon['attaque']['att2'].",".$pokemon['attaque']['att3'].",".$pokemon['attaque']['att4'].",
									".$pokemon['pp']['pp1'].",".$pokemon['pp']['pp2'].",".$pokemon['pp']['pp3'].",".$pokemon['pp']['pp4'].");";
				$resultat=mysqli_query($link,$query);
				if ($resultat)
				{
					$compteur++;
				}
			}
			echo "<p>".$compteur." pokémon(s) <font color='green'>OK</font> sur 20</p>";


			$compteur = 0;
			for ( $i = 0 ; $i < 20 ; $i++)
			{
				$query = "	INSERT INTO Ordinateur (numC,numero) VALUES (1,".$i.");";
				$resultat=mysqli_query($link,$query);
				if ($resultat)
				{
					$compteur++;
				}
			}
			echo "<p>".$compteur." engistrement <font color='green'>OK</font> sur 20 (pokémon enregistré dans l'ordinateur du dresseur)</p>";


			$query = "	INSERT INTO EqPokemon (numC,pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6)
						VALUES (1,5,6,7,8,null,null)";
			$resultat=mysqli_query($link,$query);
			if ($resultat)
			{
				echo "<p>Equipe pokémon <font color='green'>OK</font></p>";
			}
			else
			{
				echo "<p>Equipe pokémons <font color='red'>ERREUR</font></p>";
			}

			echo "<br/><h4>Compte Créée ;</h4>Idendidiant : test@test<br/>Mot de passe : test</br><br/>Nom Dresseur : test<br/>Sexe : masculin<br/>Equipe de 4 pokémons<br/>20 pokémons enregistrés dans l'ordinateur.<br/>";

		}
	}
	?>
</body>
</hmtl>