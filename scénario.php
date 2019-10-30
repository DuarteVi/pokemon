<?php include('bdd.php');?>

<?php
	session_start();
	//$_SESSION["numC"]=1; $_SESSION["pseudo"]='test@test.fr';

	if (!(isset($_SESSION["numC"]) && isset($_SESSION["pseudo"])))
	{
		header('Location: pokemonaccueil.php');
	}
	$resultat=mysqli_query($link,"SELECT * FROM Dresseur WHERE numC=".$_SESSION["numC"].";");
	$requete=mysqli_fetch_row($resultat);
	if(!empty($requete[0]))
	{
		header('Location: menu.php');
	}
?>
<?php include('pokemon.php');?>
<?php include('users.php');?>
<!DOCTYPE html>

<html>

<head>
	<title>Scénario</title>
	<link rel="icon" type="image/png" href="imagesPoke/pokeball.png">
	<link rel="stylesheet"  href="css_general.css">
	<link rel="stylesheet"  href="scénario.css">
</head>
<body>
	<img src="imagesPoke/profchen.png" id="chen">
	
	<?php 
		if (!isset($_POST['sexe'])) {
			echo "<div id='texte' class='debut'>
					Bien le bonjour ! bienvenue dans le monde de pokémon!
				</div>";
			echo "<form method='post' action='scénario.php' id='forsexe1'><img src='imagesPoke/sexe1.png' id='fille' onclick='sexe1()'>
				 <input type='hidden' name='sexe' value='1'></form>";
			echo "<form method='post' action='scénario.php' id='forsexe2'><img src='imagesPoke/sexe2.png' id='homme' onclick='sexe2()'>
				 <input type='hidden' name='sexe' value='2'></form>";
		}
		else if (!isset($_POST['pseudo'])) {
			echo "<div id='texte'>
					quel est votre nom ?";
			echo "</div>";
					echo "<form method='post' action='scénario.php' id='forpseudo'><input type='texte' name='pseudo' class='pseudo' required>
						  <input type='submit' name='soummetre' value='Envoyer' class='buton'>
						  <input type='hidden' name='sexe' value='".$_POST['sexe']."'>
						  </form>";
			
		}
		else if (!isset($_POST['pokemon'])) {
			
			$pseudo = $_POST['pseudo'];
			echo "<div id='texte' class='fin'>
					Il est temps de choisir votre tout premier pokemon ! ";
			echo "</div>";
			echo "<form method='post' action='scénario.php' id='forpoke1'><img src='imagesPoke/1_pokemon_1.png' id='bulbi' onclick='poke1()'>
			<input type='hidden' name='pokemon' value='1'>
			<input type='hidden' name='sexe' value='".$_POST['sexe']."'>
			<input type='hidden' name='pseudo' value='".($pseudo)."'>
			</form>";
			echo "<form method='post' action='scénario.php' id='forpoke2'><img src='imagesPoke/4_pokemon_1.png' id='salameche' onclick='poke2()'>
			<input type='hidden' name='pokemon' value='2'>
			<input type='hidden' name='sexe' value='".$_POST['sexe']."'>
			<input type='hidden' name='pseudo' value='".($pseudo)."'>
			</form>";
			echo "<form method='post' action='scénario.php' id='forpoke3'><img src='imagesPoke/7_pokemon_1.png' id='carapute' onclick='poke3()'> 
			<input type='hidden' name='pokemon' value='3'>
			<input type='hidden' name='sexe' value='".$_POST['sexe']."'>
			<input type='hidden' name='pseudo' value='".($pseudo)."'></form>";
		}
		else if (!isset($_POST['confirmer'])){
			echo "<div id='texte'>
					 Et bien ". SecuriserText($_POST['pseudo'])."... Vous êtes donc ";
			if ($_POST['sexe']==1 && $_POST['pokemon']==1)
			{
				echo "une femme ? <br> Avez vous bien choisi bulbizare ?";
			}
			if ($_POST['sexe']==1 && $_POST['pokemon']==2)
			{
				echo "une femme ?  <br> Avez vous bien choisi salameche ?";
			}
			if ($_POST['sexe']==1 && $_POST['pokemon']==3)
			{
				echo "une femme ?  <br> Avez vous bien choisi carapuce ?";
			}
			if ($_POST['sexe']==2 && $_POST['pokemon']==1)
			{
				echo "un homme ?  <br> Avez vous bien choisi bulbizare ?";
			}
			if ($_POST['sexe']==2 && $_POST['pokemon']==2)
			{
				echo "un homme ?  <br> Avez vous bien choisi salamèche ?";
			}
			if ($_POST['sexe']==2 && $_POST['pokemon']==3)
			{
				echo "un homme ?  <br> Avez vous bien choisi carapuce ?";
			}
			echo "</div>";
			echo "<form method='post' action='scénario.php'>
			<input type='hidden' name='pokemon' value=".$_POST['pokemon']."'>
			<input type='hidden' name='sexe' value='".$_POST['sexe']."'>
			<input type='hidden' name='pseudo' value='".$_POST['pseudo']."'>
			<input type='hidden' name='confirmer' value='1'>
			<input type='submit' name='soummetre' value='oui' class='non'></form>";
			echo "<input type='button' name='soummetre' value='non' class='oui' onclick='recharger()'>";
		}
		else
		{
			if ($_POST['sexe'] == 1)
			{
				$sexe = 1;
			}
			else
			{
				$sexe = 2;
			}
			$resultat=mysqli_query($link,"INSERT INTO Dresseur (numC,pseudo,sexe,niveauD,xp) VALUES (".$_SESSION['numC'].",'".SecuriserText($_POST['pseudo'])."',".$sexe.",1,0);");
			$resultat=mysqli_query($link,"INSERT INTO Sac (numC,pokeD,pokeB) VALUES (".$_SESSION['numC'].",500,10);");
			if ($_POST['pokemon'] == 1) //bulbizarre
			{
				$query = "INSERT INTO PokemonSeul (numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
					VALUES (1,'".GetNomPokedex(1)."',5,".(GetPvPokedex(1)+5*3).",".(GetPvPokedex(1)+5*3).",0,
					".(GetStatPokedex(1,'F')+5*3).",".(GetStatPokedex(1,'D')+5*3).",".(GetStatPokedex(1,'V')+5*3).",
					183,196,NULL,NULL,".GetPpAttaque(183).",".GetPpAttaque(196).",NULL,NULL);";
			}
			else if($_POST['pokemon'] == 2) //salamèche
			{
				$query = "INSERT INTO PokemonSeul (numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
					VALUES (4,'".GetNomPokedex(4)."',5,".(GetPvPokedex(4)+5*3).",".(GetPvPokedex(4)+5*3).",0,
					".(GetStatPokedex(4,'F')+5*3).",".(GetStatPokedex(4,'D')+5*3).",".(GetStatPokedex(4,'V')+5*3).",
					159,148,0,0,".GetPpAttaque(159).",".GetPpAttaque(148).",0,0);";
			}
			else if($_POST['pokemon'] == 3) //carapuce
			{
				$query = "INSERT INTO PokemonSeul (numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
					VALUES (7,'".GetNomPokedex(7)."',5,".(GetPvPokedex(7)+5*3).",".(GetPvPokedex(7)+5*3).",0,
					".(GetStatPokedex(7,'F')+5*3).",".(GetStatPokedex(7,'D')+5*3).",".(GetStatPokedex(7,'V')+5*3).",
					164,172,0,0,".GetPpAttaque(164).",".GetPpAttaque(172).",0,0);";
			}
			else //Easter egg PIKACHU
			{
				$query = "INSERT INTO PokemonSeul (numP,surnom,niveau,vie,vieMax,xp,statF,statD,statV,att1,att2,att3,att4,pp1,pp2,pp3,pp4) 
					VALUES (25,'".GetNomPokedex(25)."',5,".(GetPvPokedex(25)+5*3).",".(GetPvPokedex(25)+5*3).",0,
					".(GetStatPokedex(25,'F')+5*3).",".(GetStatPokedex(25,'D')+5*3).",".(GetStatPokedex(25,'V')+5*3).",
					211,203,0,0,".GetPpAttaque(211).",".GetPpAttaque(203).",0,0);";
			}
			$resultat=mysqli_query($link,$query);

			$resultat=mysqli_query($link,"SELECT MAX(numero) FROM PokemonSeul;");
			$requete=mysqli_fetch_row($resultat);
			$resultat=mysqli_query($link,"INSERT INTO Ordinateur (numC,numero) VALUES (".$_SESSION['numC'].",".$requete[0].");");
			RemplirPokedex(GetNumpPokemonSeul($requete[0]));
			$resultat=mysqli_query($link,"INSERT INTO EqPokemon (numC,pokemon1,pokemon2,pokemon3,pokemon4,pokemon5,pokemon6) VALUES (".$_SESSION['numC'].",".$requete[0].",null,null,null,null,null)");

			echo "<div id='texte'> Maintenant vous allez débuter dans le monde de Pokémon ! <br> Mais avant cela je vous offre ce petit cadeau pour bien démarrer votre aventure ! <br><br>
				<center>500 <img src='imagesPoke/pokedollar.png' id='argent'> et 10 x <img src='imagesPoke/pokeball.png' id='pokeball'>
				</center> ";
			echo "<input type='button' value='suivant' class='buton' onclick='GoMenu()' >";
		}
	 ?>

	<script type="text/javascript">
		var texte = document.querySelector("div#texte.debut");
		var texte2 = document.querySelector("div#texte.fin");
		var imghomme = document.querySelector("img#homme");
		var imgfille = document.querySelector("img#fille");
		var bulbi = document.querySelector("img#bulbi");
		var salameche = document.querySelector("img#salameche");
		var carapute = document.querySelector("img#carapute");
		var pseudo = document.querySelector("input.pseudo");
		var bouton = document.querySelector("input.buton");
		var forsexe1 = document.querySelector("form#forsexe1");
		var forsexe2 = document.querySelector("form#forsexe2");
	//	var forpseudo = document.querySelector("form#forpseudo");
		var forpoke1 = document.querySelector("form#forpoke1");
		var forpoke2 = document.querySelector("form#forpoke2");
		var forpoke3 = document.querySelector("form#forpoke3");
		function sexe1(){
			forsexe1.submit();
		}
		function sexe2(){
			forsexe2.submit();
		}
		function poke1(){
			forpoke1.submit();
		}
		function poke2(){
			forpoke2.submit();
		}
		function poke3(){
			forpoke3.submit();
		}
		
		function Tetx(){
			//if(compteur==1){
				texte.innerText = "quel est votre sexe ? ";
				imghomme.style.visibility = 'visible' ;
				imgfille.style.visibility = 'visible' ;
		}
		function invisible(){
				bulbi.style.visibility = 'hidden' ;
				salameche.style.visibility = 'hidden' ;
				carapute.style.visibility = 'hidden' ;
		}
		function Tetx2(){
				texte2.style.visibility = 'hidden' ;
				bulbi.style.visibility = 'visible' ;
				salameche.style.visibility = 'visible' ;
				carapute.style.visibility = 'visible' ;
		}
		function recharger(){
			location.href='scénario.php';
		}
		
		/*function pikachu(){
			texte.innerText = "Dommage vous avez pris trop de temps je n'ai plus de pokemon. Ah moins que ... Si il ne me reste plus que celui la !"
		}*/
		if (texte != null)
		{
			texte.onclick=Tetx;
		}
		if (texte2 != null)
		{
			invisible();
			texte2.onclick=Tetx2;
		}
		function GoMenu()
		{
			location.href="menu.php";
		}
	</script>
	<script type="text/javascript" src="java_connecter.js"></script>
</body>

</html>