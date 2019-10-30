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
		$resultat=mysqli_query($link,'TRUNCATE Pokedex;'); //vide initialement la table type au cas où elle serait déjà rempli pour des tuples

		//numéro,'nom','TYPE1','TYPE2',évolution?,palier,pokémonSuivant,statF,statD,statV,PV,lieu d'apparition)
		$liste = array(	'Bulbizarre'=>array(1,'Bulbizarre',11,12,1,16,2,49,49,45,45,1),
						'Herbizarre'=>array(2,'Herbizarre',11,12,1,32,3,62,63,60,60,1),
						'Florizarre'=>array(3,'Florizarre',11,12,0,NULL,NULL,82,83,80,80,1),
						'Salamèche'=>array(4,'Salamèche',7,NULL,1,16,5,52,43,65,39,1),
						'Reptincel'=>array(5,'Reptincel',7,NULL,1,36,6,64,58,80,58,1),
						'Dracaufeu'=>array(6,'Dracaufeu',7,18,0,NULL,NULL,84,78,100,78,1),
						'Carapuce'=>array(7,'Carapuce',4,NULL,1,16,8,48,65,43,44,1),
						'Carabaffe'=>array(8,'Carabaffe',4,NULL,1,36,9,63,80,58,59,1),
						'Tortank'=>array(9,'Tortank',4,NULL,0,NULL,NULL,83,100,78,79,1),
						'Chenipan'=>array(10,'Chenipan',9,NULL,1,7,11,30,35,45,45,1),
						'Chrysacier'=>array(11,'Chrysacier',9,NULL,1,10,12,20,55,30,50,1),
						'Papilusion'=>array(12,'Papilusion',9,18,0,NULL,NULL,45,50,70,60,1),
						'Aspicot'=>array(13,'Aspicot',9,12,1,7,14,35,30,50,40,1),
						'Coconfort'=>array(14,'Coconfort',9,12,1,10,15,25,50,35,45,1),
						'Dardargnan'=>array(15,'Dardargnan',9,12,0,NULL,NULL,90,40,75,65,1),
						'Roucool'=>array(16,'Roucool',10,18,1,18,17,45,40,56,40,1),
						'Roucoups'=>array(17,'Roucoups',10,18,1,36,18,60,55,71,63,1),
						'Roucarnage'=>array(18,'Roucarnage',10,18,0,NULL,NULL,80,75,101,83,1),
						'Rattata'=>array(19,'Rattata',10,NULL,1,20,20,56,35,72,30,1),
						'Rattatac'=>array(20,'Rattatac',10,NULL,0,NULL,NULL,81,60,97,55,1),
						'Piafabec'=>array(21,'Piafabec',10,18,1,20,22,60,30,70,40,1),
						'Rapasdepic'=>array(22,'Rapasdepic',10,18,0,NULL,NULL,90,65,100,65,1),
						'Abo'=>array(23,'Abo',12,NULL,1,22,24,60,44,55,35,1),
						'Arbok'=>array(24,'Arbok',12,NULL,0,NULL,NULL,85,69,80,60,1),
/*----*/				'Pikachu'=>array(25,'Pikachu',5,NULL,1,25,26,55,40,90,35,1),
						'Raichu'=>array(26,'Raichu',5,NULL,0,NULL,NULL,90,55,110,60,1),
						'Sabelette'=>array(27,'Sabelette',15,NULL,1,22,28,75,85,40,50,1),
						'Sablaireau'=>array(28,'Sablaireau',15,NULL,0,NULL,NULL,100,110,65,75,1),
						'Nidoran(femelle)'=>array(29,'Nidoran(femelle)',12,NULL,1,16,30,47,52,41,55,1),
/*-----*/				'Nidorina'=>array(30,'Nidorina',12,NULL,1,32,31,62,67,56,70,1),
						'Nidoqueen'=>array(31,'Nidoqueen',12,15,0,NULL,NULL,92,87,76,90,1),
						'Nidoran(mâle)'=>array(32,'Nidoran(mâle)',12,NULL,1,16,33,57,40,50,46,1),
/*-----*/				'Nidorino'=>array(33,'Nidorino',12,NULL,1,32,34,72,57,65,61,1),
						'Nidoking'=>array(34,'Nidoking',12,15,0,NULL,NULL,102,77,85,81,1),
/*-----*/				'Mélofée'=>array(35,'Mélofée',6,NULL,1,30,36,45,48,35,70,1),
						'Mélodelfe'=>array(36,'Mélodelfe',6,NULL,0,NULL,NULL,70,73,60,95,1),
/*-----*/				'Goupix'=>array(37,'Goupix',7,NULL,1,30,38,41,40,65,38,1),
						'Feunard'=>array(38,'Feunard',7,NULL,0,NULL,NULL,76,75,100,73,1),
/*-----*/				'Rondoudou'=>array(39,'Rondoudou',10,6,1,30,40,45,20,20,115,1),
						'Grodoudou'=>array(40,'Grodoudou',10,6,0,NULL,NULL,70,45,45,140,1),
						'Nosferapti'=>array(41,'Nosferapti',12,18,1,22,42,45,35,55,40,1),
						'Nosferalto'=>array(42,'Nosferalto',12,18,0,NULL,NULL,80,70,90,75,1),
						'Mystherbe'=>array(43,'Mystherbe',11,12,1,21,44,50,55,30,45,1),
/*------*/				'Ortide'=>array(44,'Ortide',11,12,1,35,45,65,70,40,60,1),
						'Rafflesia'=>array(45,'Rafflesia',11,12,0,NULL,NULL,80,85,50,75,1),
						'Paras'=>array(46,'Paras',9,11,1,24,47,70,55,25,35,1),
						'Parasect'=>array(47,'Parasect',9,11,0,NULL,NULL,95,80,30,60,1),
						'Mimitoss'=>array(48,'Mimitoss',9,12,1,31,49,55,50,45,60,1),
						'Aéromite'=>array(49,'Aéromite',9,12,0,NULL,NULL,65,60,90,70,1),
						'Taupiqueur'=>array(50,'Taupiqueur',15,NULL,1,26,51,55,25,95,10,1),
						'Triopikeur'=>array(51,'Triopikeur',15,NULL,0,NULL,NULL,80,50,120,35,1),
						'Miaouss'=>array(52,'Miaouss',10,NULL,1,28,53,45,35,90,40,1),
						'Persian'=>array(53,'Persian',10,NULL,0,NULL,NULL,70,60,115,65,1),
						'Psykokwak'=>array(54,'Psykokwak',4,NULL,1,33,55,52,48,55,50,1),
						'Akwakwak'=>array(55,'Akwakwak',4,NULL,0,NULL,NULL,82,78,85,80,1),
						'Férosinge'=>array(56,'Férosinge',2,NULL,1,28,57,80,35,70,40,1),
						'Colossinge'=>array(57,'Colossinge',2,NULL,0,NULL,NULL,105,60,95,65,1),
/*-----*/				'Caninos'=>array(58,'Caninos',7,NULL,1,25,59,70,45,60,55,1),
						'Arcanin'=>array(59,'Arcanin',7,NULL,0,NULL,NULL,110,80,95,90,1),
						'Ptitard'=>array(60,'Ptitard',4,NULL,1,25,61,50,40,90,40,1),
/*-----*/				'Têtarte'=>array(61,'Têtarte',4,NULL,1,40,62,65,65,90,65,1),
						'Tartard'=>array(62,'Tartard',4,2,0,NULL,NULL,95,95,70,90,1),
						'Abra'=>array(63,'Abra',13,NULL,1,16,64,20,15,90,25,1),
/*-----*/				'Kadabra'=>array(64,'Kadabra',13,NULL,1,32,65,35,30,105,40,1),
						'Alakazam'=>array(65,'Alakazam',13,NULL,0,NULL,NULL,50,45,120,55,1),
						'Machoc'=>array(66,'Machoc',2,NULL,1,28,67,80,50,35,70,1),
/*-----*/				'Machopeur'=>array(67,'Machopeur',2,NULL,1,40,68,100,70,45,80,1),
						'Mackogneur'=>array(68,'Mackogneur',2,NULL,0,NULL,NULL,130,80,55,90,1),
						'Chétiflor'=>array(69,'Chétiflor',11,12,1,21,70,75,35,40,50,1),
/*-----*/				'Boustiflor'=>array(70,'Boustiflor',11,12,1,35,71,90,50,55,65,1),
						'Empiflor'=>array(71,'Empiflor',11,12,0,NULL,NULL,105,65,70,80,1),
						'Tentacool'=>array(72,'Tentacool',4,12,1,30,73,40,35,70,40,1),
						'Tentacruel'=>array(73,'Tentacruel',4,12,0,NULL,NULL,70,65,100,80,1),
						'Racaillou'=>array(74,'Racaillou',14,15,1,25,75,80,100,20,40,1),
/*-----*/				'Gravalanch'=>array(75,'Gravalanch',14,15,1,40,76,95,115,35,55,1),
						'Grolem'=>array(76,'Grolem',14,15,0,NULL,NULL,120,130,45,80,1),
						'Ponyta'=>array(77,'Ponyta',7,NULL,1,40,78,85,55,90,50,1),
						'Galopa'=>array(78,'Galopa',7,NULL,0,NULL,NULL,100,70,105,65,1),
						'Ramoloss'=>array(79,'Ramoloss',4,13,1,37,80,65,65,15,90,1),
						'Flagadoss'=>array(80,'Flagadoss',4,13,0,NULL,NULL,75,110,30,95,1),
						'Magnéti'=>array(81,'Magnéti',5,1,1,30,82,35,70,45,25,1),
						'Magnéton'=>array(82,'Magnéton',5,1,0,NULL,NULL,60,95,70,50,1),
						'Canarticho'=>array(83,'Canarticho',10,18,0,NULL,NULL,65,55,60,52,1),
						'Doduo'=>array(84,'Doduo',10,18,1,31,85,85,45,75,35,1),
						'Dodrio'=>array(85,'Dodrio',10,18,0,NULL,NULL,110,70,100,60,1),
						'Otaria'=>array(86,'Otaria',4,NULL,1,'palier',87,45,55,45,65,1),
						'Lamantine'=>array(87,'Lamantine',4,8,0,NULL,NULL,70,80,70,90,1),
						'Tadmorv'=>array(88,'Tadmorv',12,NULL,1,38,89,80,50,25,80,1),
						'Grotadmorv'=>array(89,'Grotadmorv',12,NULL,0,NULL,NULL,105,75,50,105,1),
/*-----*/				'Kokiyas'=>array(90,'Kokiyas',4,NULL,1,25,91,65,100,40,30,1),
						'Crustabri'=>array(91,'Crustabri',4,8,0,NULL,NULL,95,180,70,50,1),
						'Fantominus'=>array(92,'Fantominus',16,12,1,25,93,35,20,80,30,1),
/*-----*/				'Spectrum'=>array(93,'Spectrum',16,12,1,40,94,50,45,95,45,1),
						'Ectoplasma'=>array(94,'Ectoplasma',16,12,0,NULL,NULL,65,60,110,60,1),
						'Onix'=>array(95,'Onix',14,15,0,NULL,NULL,45,160,70,35,1),
						'Soporifik'=>array(96,'Soporifik',13,NULL,1,26,97,48,45,42,60,1),
						'Hypnomade'=>array(97,'Hypnomade',13,NULL,0,NULL,NULL,73,70,67,85,1),
						'Krabby'=>array(98,'Krabby',4,NULL,1,28,99,105,90,50,30,1),
						'Krabboss'=>array(99,'Krabboss',4,NULL,0,NULL,NULL,130,115,75,55,1),
						'Voltorbe'=>array(100,'Voltorbe',5,NULL,1,30,101,30,50,100,40,1),
						'Électrode'=>array(101,'Électrode',5,NULL,0,NULL,NULL,50,70,140,60,1),
/*-----*/				'Noeunoeuf'=>array(102,'Noeunoeuf',11,13,1,30,103,40,80,40,60,1),
						'Noadkoko'=>array(103,'Noadkoko',11,13,0,NULL,NULL,95,85,55,95,1),
						'Osselait'=>array(104,'Osselait',15,NULL,1,28,105,50,95,35,50,1),
						'Ossatueur'=>array(105,'Ossatueur',15,NULL,0,NULL,NULL,80,110,45,60,1),
						'Kicklee'=>array(106,'Kicklee',2,NULL,0,NULL,NULL,120,53,87,50,1),
						'Tygnon'=>array(107,'Tygnon',2,NULL,0,NULL,NULL,50,105,76,50,1),
						'Excelangue'=>array(108,'Excelangue',10,NULL,0,NULL,NULL,55,75,30,90,1),
						'Smogo'=>array(109,'Smogo',12,NULL,1,35,110,65,95,35,40,1),
						'Smogogo'=>array(110,'Smogogo',12,NULL,0,NULL,NULL,90,120,60,65,1),
						'Rhinocorne'=>array(111,'Rhinocorne',15,14,1,42,112,85,95,25,80,1),
						'Rhinoféros'=>array(112,'Rhinoféros',15,14,0,NULL,NULL,105,130,40,105,1),
						'Leveinard'=>array(113,'Leveinard',10,NULL,0,NULL,NULL,5,5,50,205,1),
						'Saquedeneu'=>array(114,'Saquedeneu',11,NULL,0,NULL,NULL,55,115,60,65,1),
						'Kangourex'=>array(115,'Kangourex',10,NULL,0,NULL,NULL,95,80,90,105,1),						
						'Hypotrempe'=>array(116,'Hypotrempe',4,NULL,1,32,117,40,70,60,30,1),
						'Hypocéan'=>array(117,'Hypocéan',4,NULL,0,NULL,NULL,65,95,85,55,1),
						'Poissirène'=>array(118,'Poissirène',4,NULL,1,32,119,67,60,63,45,1),
						'Poissoroy'=>array(119,'Poissoroy',4,NULL,0,NULL,NULL,92,65,68,80,1),
/*----*/				'Stari'=>array(120,'Stari',4,NULL,1,30,121,45,55,85,30,1),
						'Staross'=>array(121,'Staross',4,13,0,NULL,NULL,75,85,115,60,1),
						'M. Mime'=>array(122,'M. Mime',13,6,0,NULL,NULL,45,65,90,40,1),
						'Insécateur'=>array(123,'Insécateur',9,18,0,NULL,NULL,110,80,105,70,1),
						'Lippoutou'=>array(124,'Lippoutou',8,13,0,NULL,NULL,50,35,115,65,1),
						'Élektek'=>array(125,'Élektek',5,NULL,0,NULL,NULL,83,57,105,65,1),
						'Magmar'=>array(126,'Magmar',7,NULL,0,NULL,NULL,95,57,93,65,1),
						'Scarabrute'=>array(127,'Scarabrute',9,NULL,0,NULL,NULL,125,100,85,65,1),
						'Tauros'=>array(128,'Tauros',10,NULL,0,NULL,NULL,100,95,110,75,1),
						'Magicarpe'=>array(129,'Magicarpe',4,NULL,1,20,130,10,55,80,20,1),
						'Léviator'=>array(130,'Léviator',4,18,0,NULL,NULL,125,79,81,95,1),
						'Lokhlass'=>array(131,'Lokhlass',4,8,0,NULL,NULL,85,80,60,130,1),
						'Métamorph'=>array(132,'Métamorph',10,NULL,0,NULL,NULL,48,48,48,48,1),
/*-----*/				'Évoli'=>array(133,'Évoli',10,NULL,1,25,0,55,50,55,55,1),
						'Aquali'=>array(134,'Aquali',4,NULL,0,NULL,NULL,65,60,65,130,1),
						'Voltali'=>array(135,'Voltali',5,NULL,0,NULL,NULL,65,60,130,65,1),
						'Pyroli'=>array(136,'Pyroli',7,NULL,0,NULL,NULL,130,60,65,65,1),
						'Porygon'=>array(137,'Porygon',10,NULL,0,NULL,NULL,60,70,40,65,1),
						'Amonita'=>array(138,'Amonita',14,4,1,40,139,40,100,35,35,1),
						'Amonistar'=>array(139,'Amonistar',14,4,0,NULL,NULL,60,125,55,70,1),
						'Kabuto'=>array(140,'Kabuto',14,4,1,40,141,80,90,55,30,1),
						'Kabutops'=>array(141,'Kabutops',14,4,0,NULL,NULL,115,105,80,60,1),
						'Ptéra'=>array(142,'Ptéra',14,18,0,NULL,NULL,105,65,130,80,1),
						'Ronflex'=>array(143,'Ronflex',10,NULL,0,NULL,NULL,110,65,30,160,1),
						'Artikodin'=>array(144,'Artikodin',8,18,0,NULL,NULL,85,90,85,90,1),
						'Électhor'=>array(145,'Électhor',5,18,0,NULL,NULL,90,85,100,90,1),
						'Sulfura'=>array(146,'Sulfura',7,18,0,NULL,NULL,100,90,90,90,1),
						'Minidraco'=>array(147,'Minidraco',3,NULL,1,30,148,64,45,50,41,1),
						'Draco'=>array(148,'Draco',3,NULL,1,55,149,84,65,70,61,1),
						'Dracolosse'=>array(149,'Dracolosse',3,18,0,NULL,NULL,134,95,80,91,1),
						'Mewtwo'=>array(150,'Mewtwo',13,NULL,0,NULL,NULL,110,90,130,106,1),
						'Mew'=>array(151,'Mew',13,NULL,0,NULL,NULL,100,100,100,100,1)
					);

 		echo "<table><tr><th> Nom </th><th> Résultat </th><th> Commande (si ERREUR) </th></tr>";
		foreach($liste as $pokemon)
		{
			$query = "INSERT INTO Pokedex (numP,nom,type1,type2,evolution,palier,pokemonS,statF,statD,statV,pv,lieu)
				VALUES (".$pokemon['0'].",'".$pokemon['1']."','".$pokemon['2']."',";

						if ($pokemon['3'] != NULL)
						{	$query = $query."'".$pokemon['3']."',";}
						else
						{	$query = $query."NULL,";		}


						$query = $query."".$pokemon['4'].",";


						if ($pokemon['5'] != NULL)
						{	$query = $query."".$pokemon['5'].",";}
						else
						{	$query = $query."NULL,";		}


						if ($pokemon['6'] != NULL)
						{	$query = $query."".$pokemon['6'].",";}
						else
						{	$query = $query."NULL,";		}


						$query = $query."".$pokemon['7'].",".$pokemon['8'].",".$pokemon['9'].",
						".$pokemon['10'].",".$pokemon['11'].");";
			$resultat=mysqli_query($link,$query);
			echo "<tr><td>".$pokemon['1']."</td>";
			if($resultat)
			{
				echo "<td style='color:green;'>OK</td><td></td>";
			}
			else
			{
				echo "<td style='color:red;'>ERREUR</td><td>".$query."</td>";
			}
		}
		echo "</table>";
	}
	
	?>

	<br/>
	<a href="creation-des-attaques.php">Suite</a>
</body>
</html>