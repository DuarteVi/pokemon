<?php
	global $link;
	//$link=mysqli_connect("dwarves.iut-fbleau.fr","duartev","duartev","duartev");
	$link=mysqli_connect("localhost","root","","pokemon2");
	if (!$link)
	{
		die('Connexion impossible : ' . mysql_error());
	}

	/*
	CREATE TABLE IF NOT EXISTS DemanderCombat (moi int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, lui int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, primary key(moi,lui));


	CREATE TABLE IF NOT EXISTS Combat (numCombat int not null AUTO_INCREMENT,j1 int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, pokemonj1 int not null references PokemonSeul(numero) ON DELETE CASCADE, actionj1 int default '0',j2 int NOT NULL references Utilisateur(numC) ON DELETE CASCADE, pokemonj2 int not null references PokemonSeul(numero) ON DELETE CASCADE, actionj2 int default '0', primary key(numCombat));


	*/
?>

