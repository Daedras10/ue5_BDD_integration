<?php

//Connexion à la base de données local
$bd_server = "localhost";
$bd_username = "root";
$bd_password = "";
$bd_dbname = "cyril";

try
{
	$bdd = new PDO('mysql:host='.$bd_server.';dbname='.$bd_dbname.';charset=utf8', $bd_username, $bd_password);
}
catch (PDOException $e)
{
	echo 'Erreur : ' . $e->getMessage();
}

