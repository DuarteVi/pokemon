<?php include('security.php'); ?>
<?php include('bdd.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
</head>
<body>
	<style type="text/css">
		<?php include('css.php'); ?>

	div.bouton#Sac{
		background-color: #EDC14A;
		border:15px solid #D8A61D;
	}
	div.bouton#Sac:active{
		border:15px solid white;
	}
	div.bouton#Safarie{
		background-color: #32C524;
		border:15px solid #3DAC33;
	}
	div.bouton#Safarie:active{
		border:15px solid white;
	}
	div.bouton#Ordinateur{
		background-color: #B5BEB4;
		border:15px solid #979C97;	
	}
	div.bouton#Ordinateur:active{
		border:15px solid white;
	}
	div.bouton#Magasin{
		background-color: #4078D9;
		border:15px solid #3763B0;
	}
	div.bouton#Magasin:active{
		border:15px solid white;
	}
	div.bouton#Pokecentre{
		background-color: #F11C27;
		border:15px solid #BE030D;
	}
	div.bouton#Pokecentre:active{
		border:15px solid white;
	}
	div.bouton#Combat{
		background-color: #CE9B5D;
		border:15px solid #AE7E43;
	}
	div.bouton#Combat:active{
		border:15px solid white;
	}
	div.bouton#Info{
		background-color: #81DAF5;
		border:15px solid #58D3F7;
	}
	div.bouton#Info:active{
		border:15px solid white;
	}
	div.bouton#Deconnexion{
		background-color: #E6E6E6;
		border:15px solid #D8D8D8;
	}
	div.bouton#Deconnexion:active{
		border:15px solid white;
	}
	input.button{
		display: inline-block;
		width: 15%;
		margin: 2%;
		padding: 10%;
		color: white;
		opacity: 0.7;
		inner
		border-radius: 50px 50px 50px 50px;
		vertical-align: center;
	}
	input.button:hover{
		opacity: 1;
	}
	input.button{
		background-color: #F11C27;
		border:15px solid #BE030D;
	}
	input.button:active{
		border:15px solid white;
	}
	</style>
		<video id="fond"  autoplay loop muted>
			<source  src="imagesPoke/fond2.mp4" type="video/mp4">
			Your browser does not support HTML5 video.
		</video>
		<div id="tout">
			<div class="bouton" id="Sac">
				Sac
			</div>
			<div class="bouton" id="Safarie" onclick="Safarie()">
				Safarie
			</div>
			<div class="bouton" id="Ordinateur" onclick="Ordinateur()">
				Ordinateur
			</div>
			<div class="bouton" id="Magasin">
				Magasin
			</div>
			<div class="bouton" id="Pokecentre" onclick="Pokecentre()">
				Centre Pokemon
			</div>
			<div class="bouton" id="Combat">
				Combat
			</div>
			<div class="bouton" id="Info">
				Info Dresseur
			</div>
			<div class="bouton" id="Deconnexion">
				Déconnexion
			</div>
		</div>

		<script type="text/javascript">
			function Ordinateur(){
				location.href="ordinateur.php";
			}
			function Pokecentre(){
				location.href="centrepokemon.php";
			}
			function Safarie(){
				location.href="safarie.php";
			}
		</script>
</body>
</html>