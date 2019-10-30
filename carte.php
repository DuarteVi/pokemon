<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	if (isset($_COOKIE['lieu']))
	{
		setcookie('lieu',null,-1);
	}
	/*if (isset($_COOKIE['pokemonApparu']))
	{
		setcookie('pokemonApparu',null,-1);
	}*/
	$_SESSION['pokemonApparu']=null;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Carte</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
</head>
<body>
	<style type="text/css">
		body { 
			background: url('imagesPoke/carte.jpg') no-repeat center fixed; 
			background-size:cover;
		}

		div.bouton#retour{
			background-color: #EDC14A;
			border:15px solid #D8A61D;
		}
		div.bouton#retour:active{
			border:15px solid white;
		}
		
		<?php 
		for ( $i = 1 ; $i < 12 ; $i++)
		{

			echo "div.bouton#lieu".$i."{
					background-color: #A4A4A4;
					border:15px solid #848484;
					vertical-align: middle;
				}";
			
			if ($i < GetNiveauDresseur($_SESSION['numC'])/10+1 )
			{
				$bgcolor = '#5882FA';
				$border = '15px solid #0040FF';
				$texte = 'test';
				if ($i == 1)
				{
					$texte = 'Bourg Palette';
					$bgcolor = '#5882FA';
					$border = '15px solid #0040FF';
					//$bgcolor = '#5FB404';
					//$border = '15px solid #4B8A08';
				}
				else if($i == 2)
				{
					$texte = 'Jadielle';
					$bgcolor = '#A26713';
					$border = '15px solid #784F15';
				}
				else if($i == 3)
				{
					$texte = 'Argenta';
					$bgcolor = '#6E6E6E';
					$border = '15px solid #585858';
				}
				else if($i == 4)
				{
					$texte = 'Azuria';
					$bgcolor = '#58D3F7';
					$border = '15px solid #00BFFF';
				}
				else if($i == 5)
				{
					$texte = 'Carmin-sur-Mer';	
					$bgcolor = '#FFFF00; color:#8D8F06';
					$border = '15px solid #AEB404';
				}
				else if($i == 6)
				{
					$texte = 'Lavanville';
					$bgcolor = '#4B088A';
					$border = '15px solid #240B3B';
				}
				else if($i == 7)
				{
					$texte = 'Céladopole';
					$bgcolor = '#088A29';
					$border = '15px solid #0B6121';
				}
				else if($i == 8)
				{
					$texte = 'Safrania';
					$bgcolor = '#DF01D7';
					$border = '15px solid #B404AE';
				}
				else if($i == 9)
				{
					$texte = 'Parmanie';
					$bgcolor = '#8000FF';
					$border = '15px solid #5F04B4';
				}
				else if($i == 10)
				{
					$texte = "Cramois\'Île";
					$bgcolor = '#FE642E';
					$border = '15px solid #DF3A01';
				}
				else if($i == 11)
				{
					$texte = 'Ligue Pokémon';
					$bgcolor = '#0002E1';
					$border = '15px solid #000163';
				}

				echo "div.bouton#lieu".$i."{
						background-color: ".$bgcolor.";
						border: ".$border.";
					}";

				echo "div.bouton#lieu".$i."::after{
						content: '".$texte."';

					}";
			}
			else
			{
				echo "div.bouton#lieu".$i.":hover{
						background-color: #FE2E2E;
						border:15px solid #B40404;
					}";
					echo "div.bouton#lieu".$i.":hover::after{
						content: 'fermée pour le moment';

					}";
			}
		} 
		?>

		div.bouton#eqMorte{
			background-color: #E6E6E6;
			border:15px solid #FAFAFA;
			color:black;
		}
		div.bouton#lieu:active{
			border:15px solid white;
		}
	</style>

	<!-- <img id="fond" src="imagesPoke/carte.jpg"> -->
	<div id="tout">
		<?php  
			$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon where numC=".$_SESSION['numC'].";");
			$requete =mysqli_fetch_row($resultat);
			$compteur=0;
			foreach ($requete as $pokemon) {
				if ($pokemon != NULL)
				{
					$resultatBis=mysqli_query($link,"SELECT vie FROM PokemonSeul WHERE numero=".$pokemon.";");
					$requeteBis=mysqli_fetch_row($resultatBis);
					if ($requeteBis[0] > 0 && $compteur==0)	// Le premier dont il reste de la vie
					{
						$pokemonChoisie = $pokemon;
						$compteur++;
					}
				}
			}
			if ($compteur == 0)
			{
				echo "<div class='bouton' id='eqMorte'> Vous n'avez aucun pokemon en état de combattre.</div>";
			}
			else
			{
				for ( $i = 1 ; $i < 12 ; $i++)
				{
					if ($i < GetNiveauDresseur($_SESSION['numC'])/10+1 )
					{
						echo "<div class='bouton' id='lieu".$i."' onclick='GoSafari(".$i.")'>Route ".$i."<br></div>";
					}
					else
					{
						echo "<div class='bouton' id='lieu".$i."' >Route ".$i."<br></div>";
					}
					
				}
			}
		?>
		<div class="bouton" id="retour" onclick="RetourMenu()">
			retour
		</div>
	</div>

	<script type="text/javascript">
		function RetourMenu(){
			location.href="menu.php";
		}
		function GoSafari(i){
			location.href="safari.php?lieu="+i;
		}
	</script>
	<script type="text/javascript" src="java_connecter.js"></script>
</body>
</html>