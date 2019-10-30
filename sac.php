<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>

<!DOCTYPE html>

<html>

<head>
	<title> Sac </title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="sac.css">
</head>
<body>

<table id='menu'>
			<tr><td id="pokedex" onclick="apparaitred()">pokedex</td></tr>
			<tr><td id="carte" onclick="apparaitrec()">carte</td></tr>
			<tr><td id="eqp" onclick="apparaitrea()">équipe</td></tr>
			<tr><td id="obj" onclick="apparaitreb()">objet</td></tr>
</table>


<table id='objet'>
		<tr><td><img src="imagesPoke/pokeball.png" id="pokeball" class="pokepoke" onclick="apparaitre1()"></td>
			<td><img src="imagesPoke/super-ball.png" id="pokeball" class="supersuper" onclick="apparaitre2()"></td>
			<td><img src="imagesPoke/hyperball.png" id="pokeball" class="hyperhyper" onclick="apparaitre3()"></td></tr>
		<tr><td><img src="imagesPoke/Potion.png" id="pokeball" class="potionpotion" onclick="apparaitre4()"></td>
			<td><img src="imagesPoke/superpotion.png" id="pokeball" class="supotion" onclick="apparaitre5()"></td>
			<td><img src="imagesPoke/hyperpotion.png" id="pokeball" class="hypotion" onclick="apparaitre6()"></td></tr>
</table>



<div id='pokebal'>
		<?php  
		echo "<table id='info'>
		<tr><td>Possède:</td>
			<td>".GetPokeBSac($_SESSION['numC'])."</td></tr>
		<tr><td>Taux de capture:</td>
			<td> faible</td></tr>
		<tr><td>Prix de vente:</td>
			<td>50P</td></tr>
	</table>
 "
		?>
</div>
<div id='superball'>
		<?php  
		echo "<table id='info1'>
		<tr><td>Possède:</td>
			<td>".GetSuperBSac($_SESSION['numC'])."</td></tr>
		<tr><td>Taux de capture: </td>
			<td> moyen</td></tr>
		<tr><td>Prix de vente:</td>
			<td>150P</td></tr>
	</table>
 "
		?>
</div>
<div id='Hyperball'>
		<?php  
		echo "<table id='info2'>
		<tr><td>Possède:</td>
			<td>".GetHyperBSac($_SESSION['numC'])."</td></tr>
		<tr><td>Taux de capture: </td>
			<td> élevé</td></tr>
		<tr><td>Prix de vente:</td>
			<td>250P</td>
			</tr>
	</table>
 "
		?>
</div>
<div id='popo'>
		<?php  
		echo "<table id='info3'>
		<tr><td>Possède:</td>
			<td>".GetSoinSac($_SESSION['numC'])."</td></tr>
		<tr><td>Soin:</td>
			<td>50hp</td></tr>
		<tr><td>Prix de vente:</td>
			<td>100p</td></tr>
		<tr><td><input type='button' name='utiliser' id='use' value='utiliser'";
		if(GetSoinSac($_SESSION['numC'])>0){
			echo "onclick='Usepotion(1)'";
		}
		echo "></td></tr>
		</table>";
		?>
</div>
<div id='superpo'>
		<?php  
		echo "<table id='info4'>
		<tr><td>Possède:</td>
			<td>".GetSoinSSac($_SESSION['numC'])."</td></tr>
		<tr><td> Soin:</td>
			<td>100hp</td></tr>
		<tr><td>Prix de vente:</td>
			<td>350p</td></tr>
		<tr><td><input type='button' name='utiliser' id='use' value='utiliser' ";
		if(GetSoinSSac($_SESSION['numC'])>0){
			echo "onclick='Usepotion(2)'";
		}
		echo "></td></tr>
	</table>";
	
		?>
</div>
<div id='Hyperpo'>
		<?php  
		echo "<table id='info5'>
		<tr><td>Possède:</td>
			<td>".GetSoinHSac($_SESSION['numC'])."</td></tr>
		<tr><td>Soin:</td>
			<td>150hp</td></tr>
		<tr><td>Prix de vente:</td>
			<td>750p</td><tr>
		<tr><td><input type='button' name='utiliser' id='use' value='utiliser'";
		if(GetSoinHSac($_SESSION['numC'])>0){
			echo "onclick='Usepotion(3)'";
		}
		echo "></td></tr>
	</table>";
		?>
</div>

<div id="divcarte">
<input type="button" name="croix" id="fermer" value="X">
<img src="imagesPoke/carteTROPbelle.jpg" id="cartemonde">
</div>

<div class="bouton" id="retour" onclick="RetourMenu()">
					retour
</div>

<?php  
	$resultat=mysqli_query($link,"SELECT pokemon FROM PokedexParDresseur WHERE numC=".$_SESSION["numC"].";");
		$requete=mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		/*echo "<table id='equipe'>";
		echo "<tr><th> Pokémon </th><th> Nom </th><th> Niveau </th><th> Pv </th></tr>";*/
		
		echo "<ol id='pokedexInfo'>";
		$compteur = 1;
		foreach ($requete as $pokemon)
		{
			echo "<li onclick='AfficherInfoPokedex(".$pokemon['pokemon'].")'>";
			echo "<table class='tabpokdex' > <tr><td> <img src='imagesPoke/".$pokemon['pokemon']."_pokemon_1.png' id='pkdex'></td>";
			echo "<td>".GetNomPokedex($pokemon['pokemon'])." </td>";
			echo "<td>".$pokemon['pokemon']."</td></tr></table>";
			echo "</li>";
		}
		
		echo "</ol>";
		echo "<div id='infoPokedex'> <input type='button' name='fermerinfo' id='fermerinfo' value='X'> </div>";
	?>



<?php  
	$resultat=mysqli_query($link,"SELECT pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6 FROM EqPokemon WHERE numC=".$_SESSION["numC"].";");
		$requete=mysqli_fetch_row($resultat);
		/*echo "<table id='equipe'>";
		echo "<tr><th> Pokémon </th><th> Nom </th><th> Niveau </th><th> Pv </th></tr>";*/
		
		echo "<ol id='equipe'>";
		$compteur = 1;
		foreach ($requete as $eqPoke)
		{
			if ($eqPoke)
			{
				/*$resultatBis=mysqli_query($link,"SELECT numP,surnom,niveau,vie,vieMax  FROM PokemonSeul WHERE numero=".$eqPoke.";");
				$requeteBis=mysqli_fetch_row($resultatBis);*/
			
					
				/*echo "<td><img id='pokemonimage' src='imagesPoke/".$requeteBis[0]."_pokemon_1.png'></td><td>".$requeteBis[1]."</td><td>".$requeteBis[2]."</td><td>".$requeteBis[3]."/".$requeteBis[4]."</td><td>";*/
				
				/*echo "<tr><td><img id='pokemonimage' src='imagesPoke/".GetNumpPokemonSeul($eqPoke)."_pokemon_1.png'></td><td>".GetSurnomPokemonSeul($eqPoke)."</td><td>".GetNiveauPokemonSeul($eqPoke)."</td><td>".GetViePokemonSeul($eqPoke)."/".GetVieMaxPokemonSeul($eqPoke)."</td></tr>";	*/
				
					echo "<li>";
						echo "<table><tr><td>";
						echo "<img id='pokemonimage' src='imagesPoke/".GetNumpPokemonSeul($eqPoke)."_pokemon_1.png'></td><td>".GetSurnomPokemonSeul($eqPoke)."</td></tr></table>";
						echo "<div id='vieMax' class='vieMax".$compteur."'>";
						echo "<div id='vie".$compteur."'></div>";
					echo "</div>";
					echo "<input type='hidden' id='pokevie".$compteur."' value='".GetViePokemonSeul($eqPoke)."'/>";
					echo "<input type='hidden' id='pokevieMax".$compteur."' value='".GetVieMaxPokemonSeul($eqPoke)."'/>";
					$compteur++;
					echo "</li>";
					//echo "<div id=''>"..."</div>";
					
				
			}
		}
		echo "</ol>";
	?>













<script type="text/javascript">
		var poke = document.querySelector("div#pokebal");
		var pokeclass = document.querySelector("img.pokepoke");
		var superclass = document.querySelector("img.supersuper");
		var hyperclass = document.querySelector("img.hyperhyper");
		var supe = document.querySelector("div#superball");
		var hype = document.querySelector("div#Hyperball");
		var potion = document.querySelector("div#popo");
		var superpotion = document.querySelector("div#superpo");
		var hyperpotion = document.querySelector("div#Hyperpo");
		var potionclass = document.querySelector("img.potionpotion");
		var supoclass = document.querySelector("img.supotion");
		var hyperpoclass = document.querySelector("img.hypotion");
		var obj = document.querySelector("tr#obj");
		var eqp = document.querySelector("tr#eqp");
		var carte = document.querySelector("tr#carte");
		var pokedex = document.querySelector("tr#pokedex");
		var tabl = document.querySelector("table#objet");
		var ol = document.querySelector("ol#equipe");
		var bouton = document.querySelector("input#fermer");
		//var bouton2 = document.querySelector("input#fermerinfo");
		var cartemonde =  document.querySelector("div#divcarte");
		var info = document.querySelector("div#infoPokedex");
		var ol2 = document.querySelector("ol#pokedexInfo");
		var boutonRetour = document.querySelector("div#retour");
function RetourMenu(){
	location.href="menu.php";
}
function croix(){
		cartemonde.style.display = 'none';
		boutonRetour.style.display='';
}
function fermer(){
		cacher();
		ol2.style.display = "";
}
	//bouton2.onclick = fermer ;
	bouton.onclick = croix ;
	
function cacher(){
		ol.style.display = "none";
		ol2.style.display = "none";
		info.style.display = "none";
		tabl.style.display = "none";
		poke.style.display = "none" ;
		supe.style.display = "none" ;
		hype.style.display = "none" ;
		potion.style.display = "none" ;
		superpotion.style.display = "none" ;
		hyperpotion.style.display = "none" ;
		cartemonde.style.display='none';
	}
cacher();
function apparaitrea(){
cacher();
ol.style.display ='';
}
function apparaitreb(){
cacher();
tabl.style.display ='';
}
function apparaitrec(){
cacher();
boutonRetour.style.display='none';
cartemonde.style.display='';
}
function apparaitred(){
cacher();
ol2.style.display = '';
}
function apparaitre1(){
cacher();
poke.style.display ='';
tabl.style.display ='';
}
function apparaitre2(){
cacher();
supe.style.display ='';
tabl.style.display ='';
}
function apparaitre3(){
cacher();
hype.style.display ='';
tabl.style.display ='';
}
function apparaitre4(){
cacher();
potion.style.display ='';
tabl.style.display ='';
}
function apparaitre5(){
cacher();
superpotion.style.display ='';
tabl.style.display ='';
}
function apparaitre6(){
cacher();
hyperpotion.style.display ='';
tabl.style.display ='';
}
/* ---------------------------------------------------------------------------------------- */
/* ---------------------------------------------------------------------------------------- */
/* ---------------------------------------------------------------------------------------- */
function BarreDeVie(vie,pokevie,pokevieMax){
	sante = (parseInt(pokevie.value)*100)/parseInt(pokevieMax.value);
	vie.style.width= sante + "%";
	if (sante < 30)
	{
		vie.style.backgroundColor = "red";
	}
	else if ( sante < 60)
	{
		vie.style.backgroundColor = "orange";
	}
	else
	{
		vie.style.backgroundColor = "green";
	}
	vie.innerText=pokevie.value+"/"+pokevieMax.value;
}

function AfficherVie(){
	vie1 = document.querySelector('div#vie1');
	pokevie1 = document.querySelector('input#pokevie1');
	pokevieMax1 = document.querySelector('input#pokevieMax1');
	vie2 = document.querySelector('div#vie2');
	pokevie2 = document.querySelector('input#pokevie2');
	pokevieMax2 = document.querySelector('input#pokevieMax2');
	vie3 = document.querySelector('div#vie3');
	pokevie3 = document.querySelector('input#pokevie3');
	pokevieMax3 = document.querySelector('input#pokevieMax3');
	//text = document.querySelector('div.');
	vie4 = document.querySelector('div#vie4');
	pokevie4 = document.querySelector('input#pokevie4');
	pokevieMax4 = document.querySelector('input#pokevieMax4');
	vie5 = document.querySelector('div#vie5');
	pokevie5 = document.querySelector('input#pokevie5');
	pokevieMax5 = document.querySelector('input#pokevieMax5');
	vie6 = document.querySelector('div#vie6');
	pokevie6 = document.querySelector('input#pokevie6');
	pokevieMax6 = document.querySelector('input#pokevieMax6');
	BarreDeVie(vie1,pokevie1,pokevieMax1);
	if (vie2!=null){BarreDeVie(vie2,pokevie2,pokevieMax2);}
	if (vie3!=null){BarreDeVie(vie3,pokevie3,pokevieMax3);}
	if (vie4!=null){BarreDeVie(vie4,pokevie4,pokevieMax4);}
	if (vie5!=null){BarreDeVie(vie5,pokevie5,pokevieMax5);}
	if (vie6!=null){BarreDeVie(vie6,pokevie6,pokevieMax6);}
	}
AfficherVie();
/* ---------------------------------------------------------------------------------------------------------- */
var divinfpokdex = document.querySelector('div#infoPokedex');
function AfficherInfoPokedex(valeur){
	//divinfpokdex.innerHTML = valeur ;
	info.style.display = "";
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_sac.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				divinfpokdex.innerHTML = xhr.responseText;
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("InfoPoke="+valeur);
	
}


function Usepotion(soin){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_sac.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

				info.innerHTML = xhr.responseText;
				info.style.display = "";
				AfficherVie();
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SoignerEquipe="+soin);
}

function SoignerUnPokemon(soin,pokemon){
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_sac.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				console.log("pokemon soigné");
				location.href="sac.php";
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("SoignerUnPokemonSoin="+soin+"&SoignerUnPokemonPokemon="+pokemon);	
}
/*
function AfficherEquiperApresSoin()
{
	let xhr = new XMLHttpRequest();
	xhr.open('POST','ajax_sac.php', true);
	xhr.addEventListener('readystatechange',
		function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				ol.innerHTML = xhr.responseText;
				AfficherVie();
				BarreDeVie(vie1,pokevie1,pokevieMax1);
				if (vie2!=null){BarreDeVie(vie2,pokevie2,pokevieMax2);}
				if (vie3!=null){BarreDeVie(vie3,pokevie3,pokevieMax3);}
				if (vie4!=null){BarreDeVie(vie4,pokevie4,pokevieMax4);}
				if (vie5!=null){BarreDeVie(vie5,pokevie5,pokevieMax5);}
				if (vie6!=null){BarreDeVie(vie6,pokevie6,pokevieMax6);}
	
			}
		}
	);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("AfficherEquiperApresSoin="+1);	
}*/
</script>
<script type="text/javascript" src="java_connecter.js"></script>

</body>
</html>