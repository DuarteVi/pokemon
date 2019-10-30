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
		$resultat=mysqli_query($link,"DROP TABLE 'Attaque', 'Dresseur', 'Eqpokemon', 'Ordinateur', 'Pokedex', 'Pokemonseul', 'Sac', 'Utilisateur';");
		

		//UTILISATEUR
		$query = "CREATE TABLE IF NOT EXISTS Utilisateur (pseudo varchar(50) NOT NULL, mdp varchar(200) NOT NULL, numC int NOT NULL AUTO_INCREMENT, CONSTRAINT nomUnique UNIQUE(pseudo), connecter int not null default '0', primary key(numC));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Utilisateur créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Utilisateur.<br/>";
		}

		//DRESSEUR
		$query = "CREATE TABLE IF NOT EXISTS Dresseur (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE,pseudo varchar(50) NOT NULL, sexe int NOT NULL default '1', niveauD int not null default '1' , xp int default '0',primary key(numC));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Dresseur créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Dresseur.<br/>";
		}

		//SAC
		/*$query = "CREATE TABLE IF NOT EXISTS Sac (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, pokeD int default '50', pokeB int default '10', soin int default '0' ,primary key(numC));";*/
		$query = "CREATE TABLE IF NOT EXISTS Sac (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, pokeD int default '500', pokeB int default '10', superB int default '0', hyperB int default '0', soin int default '0', soinS int default '0', soinH int default '0', primary key(numC));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Sac créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Sac.<br/>";
		}

		//Types
		$query = "CREATE TABLE IF NOT EXISTS Type (numT int not null, nomT varchar(30), type1 float not null default '1' ,type2 float not null default '1' ,type3 float not null default '1' ,type4 float not null default '1' ,type5 float not null default '1' ,type6 float not null default '1' ,type7 float not null default '1' ,type8 float not null default '1' ,type9 float not null default '1' ,type10 float not null default '1' ,type11 float not null default '1' ,type12 float not null default '1' ,type13 float not null default '1' ,type14 float not null default '1' ,type15 float not null default '1' ,type16 float not null default '1' ,type17 float not null default '1' ,type18 float not null default '1' , primary key(numT));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Type créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Sac.<br/>";
		}

		//Pokedex
		/*$query = "CREATE TABLE IF NOT EXISTS Pokedex (numP int not null, nom varchar(30) NOT NULL, type1 varchar(30) NOT NULL, type2 varchar(30), evolution boolean not null, palier int, pokemonS int, statF int not null, statD int not null, statV int not null,pv int not null ,lieu int not null, primary key(numP));";*/
		$query = "CREATE TABLE IF NOT EXISTS Pokedex (numP int not null, nom varchar(30) NOT NULL, type1 int NOT NULL references Type(numT), type2 int references Type(numT), evolution boolean not null, palier int, pokemonS int, statF int not null, statD int not null, statV int not null,pv int not null ,lieu int not null, primary key(numP));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Pokedex créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Pokedex.<br/>";
		}

		//Attaque
		/*$query = "CREATE TABLE IF NOT EXISTS Attaque (numA int not null AUTO_INCREMENT, nom varchar(20) not null, degat int not null, pp int not null, type varchar(30) NOT NULL, description varchar(150), primary key(numA));";*/
		$query = "CREATE TABLE IF NOT EXISTS Attaque (numA int not null AUTO_INCREMENT, nom varchar(20) not null, degat int not null, pp int not null, type int NOT NULL references Type(numT), description varchar(150), primary key(numA));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Attaque créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Attaque.<br/>";
		}

		//PokemonSeul
		$query = "CREATE TABLE IF NOT EXISTS PokemonSeul (numero int not null AUTO_INCREMENT, numP int not null references Pokedex(numP) ON DELETE CASCADE, surnom varchar(30) not null, niveau int not null default '1', vie int, vieMax int not null, xp int default '0', statF int not null, statD int not null, statV int not null, att1 int references Attaque(numA), att2 int references Attaque(numA), att3 int references Attaque(numA), att4 int references Attaque(numA), pp1 int, pp2 int, pp3 int, pp4 int, primary key(numero));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table PokemonSeul créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table PokemonSeul.<br/>";
		}

		//Ordinateur
		$query = "CREATE TABLE IF NOT EXISTS Ordinateur (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, numero int not null references PokemonSeul(numero) ON DELETE CASCADE,primary key(numC,numero));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Ordinateur créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Ordinateur.<br/>";
		}

		//EqPokemon
		$query = "CREATE TABLE IF NOT EXISTS EqPokemon (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, pokemon1 int not null, pokemon2 int, pokemon3 int, pokemon4 int, pokemon5 int, pokemon6 int, primary key(numC), FOREIGN KEY (numC,pokemon1) REFERENCES Ordinateur(numC,numero) ON DELETE CASCADE, FOREIGN KEY (numC,pokemon2) REFERENCES Ordinateur(numC,numero) ON DELETE CASCADE, FOREIGN KEY (numC,pokemon3) REFERENCES Ordinateur(numC,numero) ON DELETE CASCADE, FOREIGN KEY (numC,pokemon4) REFERENCES Ordinateur(numC,numero) ON DELETE CASCADE, FOREIGN KEY (numC,pokemon5) REFERENCES Ordinateur(numC,numero) ON DELETE CASCADE, FOREIGN KEY (numC,pokemon6) REFERENCES Ordinateur(numC,numero) ON DELETE CASCADE);";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table EqPokemon créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table EqPokemon.<br/>";
		}

		//Ami
		$query = "CREATE TABLE IF NOT EXISTS Ami (moi int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, lui int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, primary key(moi,lui));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table Ami créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table Ami.<br/>";
		}

		//PokedexParDresseur
		$query = "CREATE TABLE IF NOT EXISTS PokedexParDresseur (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, pokemon int NOT NULL references Pokedex(numP) ON DELETE CASCADE, primary key(numC,pokemon));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table PokedexParDresseur créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table PokedexParDresseur.<br/>";
		}

		$query = "CREATE TABLE IF NOT EXISTS AttaqueParDresseur (numC int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, attaque int NOT NULL references Attaque(numA) ON DELETE CASCADE, primary key(numC,attaque));";
		$resultat=mysqli_query($link,$query);
		if ($resultat)
		{
			echo "table AttaqueParDresseur créée correctement.<br/>";
		}
		else
		{
		    echo "Erreur lors de la création de la table AttaqueParDresseur.<br/>";
		}
	}
	
	?>
	<br/>
	<a href="creation-des-types.php">Suite</a>
</body>
</html>