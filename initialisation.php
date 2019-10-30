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
		echo "Lien avec la base de données réussit, cliquer sur <a href='creation-des-tables.php'>Suite</a> pour initialiser les tables.";
	}
?>
</body>
</html>