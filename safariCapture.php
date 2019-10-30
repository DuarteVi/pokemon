<?php include('bdd.php'); ?>
<?php include('security.php'); ?>
<?php include('pokemon.php'); ?>
<?php include('users.php'); ?>
<?php
	//setcookie('pokemonApparu',null,-1);
	$_SESSION['pokemonApparu']=null;
	header('Location: safari.php');
?>