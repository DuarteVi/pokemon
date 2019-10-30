<?php 
	include('bdd.php'); 
?>
<!DOCTYPE html>
<head>
	<title>base de données</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	if ($link)
	{
		$resultat=mysqli_query($link,'DELETE FROM PokemonSeul WHERE numero<5;'); //vide initialement la table type au cas où elle serait déjà rempli pour des tuples
		$nombre = 0;
		$nombreTotal = 0;

		$liste = array(	'Bulbizarre'=>array('numero'=>1,'nump'=>1, 'att1'=>183,'att2'=>196),
						'Salamèche'	=>array('numero'=>2,'nump'=>4, 'att1'=>159,'att2'=>148),
						'Carapuce'	=>array('numero'=>3,'nump'=>7, 'att1'=>167,'att2'=>172),
						'Pikachu'	=>array('numero'=>4,'nump'=>25,'att1'=>211,'att2'=>203)
						);

		foreach($liste as $starter)
		{
			$numero=$starter['numero'];
			$nump=$starter['nump'];
			$requete=mysqli_query($link,"SELECT nom,PV,statF,statD,statV FROM Pokedex  where nump=".$nump.";");
			$requete=mysqli_fetch_row($requete);
			$surnom=$requete[0];
			$niveau=5;
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
			$att1=$starter['att1'];
			$requete=mysqli_query($link,"SELECT pp FROM Attaque  where numA=".$att1.";");
			$requete=mysqli_fetch_row($requete);
			$pp1=$requete[0];
			$att2=$starter['att2'];
			$requete=mysqli_query($link,"SELECT pp FROM Attaque  where numA=".$att2.";");
			$requete=mysqli_fetch_row($requete);
			$pp2=$requete[0];
			//numP references Pokedex(numP),surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1 references type(numA), att2 references type(numA), att3 references type(numA), att4 references type(numA),pp1,pp2,pp3,pp4
			$query=	"INSERT INTO PokemonSeul (numero,numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
					VALUES (".$numero.",".$nump.",'".$surnom."',".$niveau.",".$vie.",".$vieMax.",".$xp.",".$statF.",".$statD.",".$statV.",".$att1.",".$att2.",NULL,NULL,".$pp1.",".$pp2.",NULL,NULL);";
			$resultat=mysqli_query($link,$query);
			if($resultat)
			{
				$nombre = $nombre + 1;
			}
			else
			{
				echo "<p><font color='red'>ERREUR</font> : ".$query."</p><br/>";
			}
			$nombreTotal = $nombreTotal + 1;
		}

		if ( $nombre == $nombreTotal )
		{
			echo "<p><font color='green'>OK</font> : tous les pokémons starters ont été créés. <br/>";
		}
		else
		{
			echo "<p><font color='red'>ERREUR</font> : Il manque un ou des pokémons starters. (voir ci dessus).<br/>";
		}
		
	}
	?>
	<br/>
	<a href="creation-de-un-dresseur.php">Suite</a>

</body>
</html>