<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php

/* -------------------------------------------------------------------------------------- */
//Partie ACHETER
if (isset($_POST['AcheterDesChoses']))
{
	echo "<h1 style='text-decoration: underline;'> Que voulez-vous acheter ?</h1>";
	echo "<br>";

	echo "<table>";

		//Pokeballs
		echo "<tr><td colspan='4'><h1>Pokeballs</h1></td></tr>";
		echo "<tr><td> <img src='imagesPoke/pokeball.png' id='objet' /></td><td> <input id='achatPB' type='number' value='1' min='1' max='".((int)(GetPokeDSac($_SESSION['numC'])/100))."'> </td><td> <input type='button' value='acheter' onclick='AcheterPB()'> </td><td>Prix: 100 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";
		echo "<tr><td> <img src='imagesPoke/super-ball.png' id='objet' /></td><td> <input id='achatSB' type='number' value='1' min='1' max='".((int)(GetPokeDSac($_SESSION['numC'])/300))."'> </td><td> <input type='button' value='acheter' onclick='AcheterSB()'> </td> <td>Prix: 300 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";
		echo "<tr><td> <img src='imagesPoke/hyperball.png' id='objet' /></td><td> <input id='achatHB' type='number' value='1' min='1' max='".((int)(GetPokeDSac($_SESSION['numC'])/500))."'> </td><td> <input type='button' value='acheter' onclick='AcheterHB()'> </td> <td>Prix: 500 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";

		//Potions
		echo "<tr><td colspan='4'><h1>Potions</h1></td></tr>";
		echo "<tr><td> <img src='imagesPoke/Potion.png' id='objet' /></td><td> <input id='achatP' type='number' value='1' min='1' max='".((int)(GetPokeDSac($_SESSION['numC'])/200))."'> </td><td> <input type='button' value='acheter' onclick='AcheterP()'> </td><td>Prix: 200 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";
		echo "<tr><td> <img src='imagesPoke/superpotion.png' id='objet' /></td><td> <input id='achatSP' type='number' value='1' min='1' max='".((int)(GetPokeDSac($_SESSION['numC'])/700))."'> </td><td> <input type='button' value='acheter' onclick='AcheterSP()'> </td> <td>Prix: 700 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";
		echo "<tr><td> <img src='imagesPoke/hyperpotion.png' id='objet' /></td><td> <input id='achatHP' type='number' value='1' min='1' max='".((int)(GetPokeDSac($_SESSION['numC'])/1500))."'> </td><td> <input type='button' value='acheter' onclick='AcheterHP()'> </td> <td>Prix: 1500 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";

		//VELO
	echo "<tr><td colspan='4'><h1>Bicyclette</h1></td></tr>";
	echo "<tr><td> <img src='imagesPoke/velo.jpg' id='objet' /> </td><td> <input type='button' value='acheter' onclick='Velo()'> </td><td colspan='2'> Prix : 1 000 000 000 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";

		//ATTAQUE
	echo "<tr><td colspan='4'><h1>Attaques</h1></td></tr>";
/*	echo "<tr><td> <img src='imagesPoke/CT.png' id='CT' /></td><td>Nom</td><td> <input type='button' value='acheter'> </td><td>Prix: 200 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";*/

	

	$query = "SELECT DISTINCT type FROM Attaque";
	$resultat=mysqli_query($link,$query);
	$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
	foreach ($requete as $type) {
		echo "<tr><td colspan='4'><br/><h3>".GetNomType($type['type'])."</h3></td></tr>";
		$query = "SELECT  numA FROM Attaque WHERE type=".$type['type']." AND numA NOT IN (SELECT attaque FROM AttaqueParDresseur WHERE numC=".$_SESSION['numC'].")";
		$resultatis=mysqli_query($link,$query);
		$requeteBis=mysqli_fetch_all($resultatis,MYSQLI_ASSOC);
		$compteur = 1;
		foreach ($requeteBis as $attaque) {
			echo "<tr><td> <img src='imagesPoke/CT.png' id='CT' /></td><td>".GetNomAttaque($attaque['numA'])."</td><td> <input type='button' value='acheter' onclick='AcheterCT(".$attaque['numA'].")'> </td><td>Prix: 2000 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";
		$compteur = 0;
		}
		if ($compteur == 1)
		{
			echo "<tr><td colspan='4'>vide</td></tr>";
		}
	}

	echo "</table>";
}

/* -------------------------------------------------------------------------------------- */
//Partie VENDRE
if (isset($_POST['VendreDesChoses']))
{
	echo "<h1 style='text-decoration: underline;'> Que voulez-vous vendre ?</h1>";
	echo "<br>";
	echo "<table>";

		//Pokeballs
		echo "<tr><td colspan='4'><h1>Pokeballs</h1></td></tr>";
		echo "<tr><td> <img src='imagesPoke/pokeball.png' id='objet' /></td><td> <input id='vendrePB' type='number' value='0' min='0' max='".GetPokeBSac($_SESSION['numC'])."'> </td><td> <input type='button' value='vendre' onclick='VendrePB()'> </td><td>Prix: 50 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";
		echo "<tr><td> <img src='imagesPoke/super-ball.png' id='objet' /></td><td> <input id='vendreSB' type='number' value='0' min='0' max='".GetSuperBSac($_SESSION['numC'])."'> </td><td> <input type='button' value='vendre' onclick='VendreSB()'> </td> <td>Prix: 150 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";
		echo "<tr><td> <img src='imagesPoke/hyperball.png' id='objet' /></td><td> <input id='vendreHB' type='number' value='0' min='0' max='".GetHyperBSac($_SESSION['numC'])."'> </td><td> <input type='button' value='vendre' onclick='VendreHB()'> </td> <td>Prix: 250 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";

		//Potions
		echo "<tr><td colspan='4'><h1>Potions</h1></td></tr>";
		echo "<tr><td> <img src='imagesPoke/Potion.png' id='objet' /></td><td> <input id='vendreP' type='number' value='0' min='0' max='".GetSoinSac($_SESSION['numC'])."'> </td><td> <input type='button' value='vendre' onclick='VendreP()'> </td><td>Prix: 100 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";
		echo "<tr><td> <img src='imagesPoke/superpotion.png' id='objet' /></td><td> <input id='vendreSP' type='number' value='0' min='0' max='".GetSoinSSac($_SESSION['numC'])."'> </td><td> <input type='button' value='vendre' onclick='VendreSP()'> </td> <td>Prix: 350 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";
		echo "<tr><td> <img src='imagesPoke/hyperpotion.png' id='objet' /></td><td> <input id='vendreHP' type='number' value='0' min='0' max='".GetSoinHSac($_SESSION['numC'])."'> </td><td> <input type='button' value='vendre' onclick='VendreHP()'> </td> <td>Prix: 750 <img src='imagesPoke/pokedollar.png' id='dollar' /></td> </tr>";

		//VELO
		echo "<tr><td colspan='4'><h1>Bicyclette</h1></td></tr>";
		echo "<tr><td colspan='4'>vide<br><br></td></tr>";		

		//ATTAQUE
	echo "<tr><td colspan='4'><h1>Attaques</h1></td></tr>";
/*	echo "<tr><td> <img src='imagesPoke/CT.png' id='CT' /></td><td>Nom</td><td> <input type='button' value='acheter'> </td><td>Prix: 200 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";*/

	


	$query = "SELECT DISTINCT type FROM Attaque";
	$resultat=mysqli_query($link,$query);
	$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
	foreach ($requete as $type) {
		echo "<tr><td colspan='4'><br/><h3>".GetNomType($type['type'])."</h3></td></tr>";
		$query = "SELECT  numA FROM Attaque WHERE type=".$type['type']." AND numA IN (SELECT attaque FROM AttaqueParDresseur WHERE numC=".$_SESSION['numC'].")";
		$resultatis=mysqli_query($link,$query);
		$requeteBis=mysqli_fetch_all($resultatis,MYSQLI_ASSOC);
		$compteur = 1;
		foreach ($requeteBis as $attaque) {
			echo "<tr><td> <img src='imagesPoke/CT.png' id='CT' /></td><td>".GetNomAttaque($attaque['numA'])."</td><td> <input type='button' value='vendre' onclick='VendreCT(".$attaque['numA'].")'> </td><td>Prix: 1000 <img src='imagesPoke/pokedollar.png' id='dollar' /></td></tr>";
			$compteur = 0;
		}
		if ($compteur == 1)
		{
			echo "<tr><td colspan='4'>vide</td></tr>";
		}
	}

	echo "</table>";
}

/* -------------------------------------------------------------------------------------- */
//Partie ARGENT
if (isset($_POST['AfficherArgent']))
{
	echo "<h3>argent en poche:<br/>".number_format(GetPokeDSac($_SESSION['numC']),0,'',' ')."<img src='imagesPoke/pokedollar.png' id='dollar' /></h3>";
}
/* -------------------------------------------------------------------------------------- */
//Assez d'argent ?
if (isset($_POST['AssezDArgent']))
{
	echo (GetPokeDSac($_SESSION['numC'])-$_POST['AssezDArgent']);
}

//Assez achat pokeball
if (isset($_POST['AcheterPB']))
{
	if ( $_POST['AcheterPB'] > 0 && $_POST['AcheterPB'] <= ((int)(GetPokeDSac($_SESSION['numC'])/100)))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez achat superball
if (isset($_POST['AcheterSB']))
{
	if ( $_POST['AcheterSB'] > 0 && $_POST['AcheterSB'] <= ((int)(GetPokeDSac($_SESSION['numC'])/300)))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez achat hyperball
if (isset($_POST['AcheterHB']))
{
	if ( $_POST['AcheterHB'] > 0 && $_POST['AcheterHB'] <= ((int)(GetPokeDSac($_SESSION['numC'])/500)))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez achat potion
if (isset($_POST['AcheterP']))
{
	if ( $_POST['AcheterP'] > 0 && $_POST['AcheterP'] <= ((int)(GetPokeDSac($_SESSION['numC'])/200)))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez achat superpotion
if (isset($_POST['AcheterSP']))
{
	if ( $_POST['AcheterSP'] > 0 && $_POST['AcheterSP'] <= ((int)(GetPokeDSac($_SESSION['numC'])/700)))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez achat hyperpotion
if (isset($_POST['AcheterHP']))
{
	if ( $_POST['AcheterHP'] > 0 && $_POST['AcheterHP'] <= ((int)(GetPokeDSac($_SESSION['numC'])/1500)))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}

/* -------------------------------------------------------------------------------------- */
//Assez pokeball pour vendre
if (isset($_POST['VendrePB']))
{
	if ( $_POST['VendrePB'] > 0 && $_POST['VendrePB'] <= GetPokeBSac($_SESSION['numC']))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez superball pour vendre
if (isset($_POST['VendreSB']))
{
	if ( $_POST['VendreSB'] > 0 && $_POST['VendreSB'] <= GetSuperBSac($_SESSION['numC']))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez hyperball pour vendre
if (isset($_POST['VendreHB']))
{
	if ( $_POST['VendreHB'] > 0 && $_POST['VendreHB'] <= GetHyperBSac($_SESSION['numC']))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez potion pour vendre
if (isset($_POST['VendreP']))
{
	if ( $_POST['VendreP'] > 0 && $_POST['VendreP'] <= GetSoinSac($_SESSION['numC']))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez superpotion pour vendre
if (isset($_POST['VendreSP']))
{
	if ( $_POST['VendreSP'] > 0 && $_POST['VendreSP'] <= GetSoinSSac($_SESSION['numC']))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}
//Assez hyperpotion pour vendre
if (isset($_POST['VendreHP']))
{
	if ( $_POST['VendreHP'] > 0 && $_POST['VendreHP'] <= GetSoinHSac($_SESSION['numC']))
	{
		echo 1;
	}
	else 
	{
		echo 0;
	}
}

/* -------------------------------------------------------------------------------------- */
//Partie ACHAT EFFECTUEE
//Acheter CT
if (isset($_POST['AcheterCT']))
{
	SetPokeDSac($_SESSION['numC'],(GetPokeDSac($_SESSION['numC'])-2000));
	$query = "INSERT INTO AttaqueParDresseur(numC,attaque) VALUES (".$_SESSION['numC'].",".$_POST['AcheterCT'].")";
	$resultat=mysqli_query($link,$query);
}

//Reste
if (isset($_POST['AcheterInitiales']) && isset($_POST['AcheterValeur']))
{
	$argent = GetPokeDSac($_SESSION['numC']);
	if (strcmp($_POST['AcheterInitiales'],'PB') == 0 ) 	//Pokeball
	{
		SetPokeBSac($_SESSION['numC'],(GetPokeBSac($_SESSION['numC'])+$_POST['AcheterValeur']));
		$argent = $argent - ( $_POST['AcheterValeur'] * 100 );
	}
	if (strcmp($_POST['AcheterInitiales'],'SB') == 0 ) 	//SuperBall
	{
		SetSuperBSac($_SESSION['numC'],(GetSuperBSac($_SESSION['numC'])+$_POST['AcheterValeur']));
		$argent = $argent - ( $_POST['AcheterValeur'] * 300 );
	}
	if (strcmp($_POST['AcheterInitiales'],'HB') == 0 ) 	//HyperBall
	{
		SetHyperBSac($_SESSION['numC'],(GetHyperBSac($_SESSION['numC'])+$_POST['AcheterValeur']));
		$argent = $argent - ( $_POST['AcheterValeur'] * 500 );
	}
	if (strcmp($_POST['AcheterInitiales'],'P') == 0 ) 	//Potion
	{
		SetSoinSac($_SESSION['numC'],(GetSoinSac($_SESSION['numC'])+$_POST['AcheterValeur']));
		$argent = $argent - ( $_POST['AcheterValeur'] * 200 );
	}
	if (strcmp($_POST['AcheterInitiales'],'SP') == 0 ) 	//SuperPotion
	{
		SetSoinSSac($_SESSION['numC'],(GetSoinSSac($_SESSION['numC'])+$_POST['AcheterValeur']));
		$argent = $argent - ( $_POST['AcheterValeur'] * 700 );
	}
	if (strcmp($_POST['AcheterInitiales'],'HP') == 0 ) 	//HyperPotion
	{
		SetSoinHSac($_SESSION['numC'],(GetSoinHSac($_SESSION['numC'])+$_POST['AcheterValeur']));
		$argent = $argent - ( $_POST['AcheterValeur'] * 1500 );
	}
	SetPokeDSac($_SESSION['numC'],$argent);
}


/* -------------------------------------------------------------------------------------- */
//Partie VENTE EFFECTUEE
if (isset($_POST['VendreCT']))
{
	SetPokeDSac($_SESSION['numC'],(GetPokeDSac($_SESSION['numC'])+1000));
	$query = "DELETE FROM AttaqueParDresseur WHERE numC=".$_SESSION['numC']." AND attaque=".$_POST['VendreCT'];
	$resultat=mysqli_query($link,$query);
}

//Reste
if (isset($_POST['VendreInitiales']) && isset($_POST['VendreValeur']))
{
	$argent = GetPokeDSac($_SESSION['numC']);
	if (strcmp($_POST['VendreInitiales'],'PB') == 0 ) 	//Pokeball
	{
		SetPokeBSac($_SESSION['numC'],(GetPokeBSac($_SESSION['numC'])-$_POST['VendreValeur']));
		$argent = $argent + ( $_POST['VendreValeur'] * 50 );
	}
	if (strcmp($_POST['VendreInitiales'],'SB') == 0 ) 	//SuperBall
	{
		SetSuperBSac($_SESSION['numC'],(GetSuperBSac($_SESSION['numC'])-$_POST['VendreValeur']));
		$argent = $argent + ( $_POST['VendreValeur'] * 150 );
	}
	if (strcmp($_POST['VendreInitiales'],'HB') == 0 ) 	//HyperBall
	{
		SetHyperBSac($_SESSION['numC'],(GetHyperBSac($_SESSION['numC'])-$_POST['VendreValeur']));
		$argent = $argent + ( $_POST['VendreValeur'] * 250 );
	}
	if (strcmp($_POST['VendreInitiales'],'P') == 0 ) 	//Potion
	{
		SetSoinSac($_SESSION['numC'],(GetSoinSac($_SESSION['numC'])-$_POST['VendreValeur']));
		$argent = $argent + ( $_POST['VendreValeur'] * 100 );
	}
	if (strcmp($_POST['VendreInitiales'],'SP') == 0 ) 	//SuperPotion
	{
		SetSoinSSac($_SESSION['numC'],(GetSoinSSac($_SESSION['numC'])-$_POST['VendreValeur']));
		$argent = $argent + ( $_POST['VendreValeur'] * 350 );
	}
	if (strcmp($_POST['VendreInitiales'],'HP') == 0 ) 	//HyperPotion
	{
		SetSoinHSac($_SESSION['numC'],(GetSoinHSac($_SESSION['numC'])-$_POST['VendreValeur']));
		$argent = $argent + ( $_POST['VendreValeur'] * 750 );
	}
	SetPokeDSac($_SESSION['numC'],$argent);
}


?>