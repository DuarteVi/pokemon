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
		//http://teamau.forumactif.org/t33-table-des-types
		$liste = array(	'ACIER'=>array(		1,'ACIER',		0.5,1,1,0.5,0.5,2,0.5,2,1,1,1,1,1,2,1,1,1,1),
						'COMBAT'=>array(	2,'COMBAT',		2,1,1,1,1,0.5,1,2,0.5,2,1,0.5,0.5,2,1,0,2,0.5),
						'DRAGON'=>array(	3,'DRAGON',		0.5,1,2,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1),
						'EAU'=>array(		4,'EAU',		1,1,0.5,0.5,1,1,2,1,1,1,0.5,1,1,2,2,1,1,1),
						'ELECTRIQUE'=>array(5,'ELECTRIQUE',	1,1,0.5,2,0.5,1,1,1,1,1,0.5,1,1,1,0,1,1,2),
						'FEE'=>array(		6,'FEE',		0.5,2,2,1,1,1,0.5,1,1,1,1,0.5,1,1,1,1,2,1),
						'FEU'=>array(		7,'FEU',		2,1,0.5,0.5,1,1,0.5,2,2,1,2,1,1,0.5,1,1,1,1),
						'GLACE'=>array(		8,'GLACE',		0.5,1,2,0.5,1,1,0.5,0.5,1,1,2,1,1,1,2,1,1,2),
						'INSECTE'=>array(	9,'INSECTE',	0.5,0.5,1,1,1,0.5,0.5,1,1,1,2,0.5,2,1,1,0.5,2,0.5),
						'NORMAL'=>array(	10,'NORMAL',	0.5,1,1,1,1,1,1,1,1,1,1,1,1,0.5,1,0,1,1),
						'PLANTE'=>array(	11,'PLANTE',	0.5,1,0.5,2,1,1,0.5,1,1,1,0.5,0.5,1,2,2,1,1,0.5),
						'POISON'=>array(	12,'POISON',	0,1,1,1,1,2,1,1,1,1,2,0.5,1,0.5,0.5,0.5,1,1),
						'PSY'=>array(		13,'PSY',		0.5,2,1,1,1,1,1,1,1,1,1,2,0.5,1,1,1,0,1),
						'ROCHE'=>array(		14,'ROCHE',		0.5,0.5,1,1,1,1,2,2,2,1,1,1,1,1,0.5,1,1,2),
						'SOL'=>array(		15,'SOL',		2,1,1,1,2,1,2,1,0.5,1,0.5,2,1,2,1,1,1,0),
						'SPECTRE'=>array(	16,'SPECTRE',	1,1,1,1,1,1,1,1,1,0,1,1,2,1,1,2,0.5,1),
						'TENEBRES'=>array(	17,'TENEBRES',	1,0.5,1,1,1,0.5,1,1,1,1,1,1,2,1,1,2,0.5,1),
						'VOL'=>array(		18,'VOL',		0.5,2,1,1,0.5,1,1,1,2,1,2,1,1,0.5,1,1,1,1));

		$nombre=0;
		$nombreTotal=0;
		foreach($liste as $type)
			{
				$query = "INSERT INTO Type (numT,nomT,type1,type2,type3,type4,type5,type6,type7,type8,type9,type10,type11,type12,type13,type14,type15,type16,type17,type18)VALUES (
				".$type['0'].",'".$type['1']."',".$type['2'].",".$type['3'].",".$type['4'].",".$type['5'].",".$type['6'].",".$type['7'].",".$type['8'].",".$type['9'].",".$type['10'].",".$type['11'].",".$type['12'].",".$type['13'].",".$type['14'].",".$type['15'].",".$type['16'].",".$type['17'].",".$type['18'].",".$type['19'].");";

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
			echo "<p>".$nombre." type(s) <font color='green'>OK</font> sur ".$nombreTotal."</p>";


		}

	?>
	<a href="creation-des-pokemons.php">Suite</a>
</body>
</hmtl>