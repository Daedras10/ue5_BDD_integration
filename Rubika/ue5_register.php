<?php

// Initialisation message d'erreur
$error = "";

// Si le formulaire est envoyé

//if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']))
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['password2']))
{
	// Connexion à la base de données
	include 'Inc/bdd.php';

	// Iinit variable d'erreur
	$requestError = array();
	
	// Si les deux mots de passe sont identiques
	if ($_POST['password'] != $_POST['password2'])
	{
		$requestError[] = "Les mots de passe ne correspondent pas";
	};
		
	// Requête pour vérifier si le nom d'utilisateur est déjà utilisé
	$sql = 'SELECT * FROM cyril_users WHERE username = :username';
	$req = $bdd->prepare($sql);
	$req->execute(
		array('username' => $_POST['username']));

	$data = $req->fetch();

	if ($req->rowCount() > 0)
	{
		$requestError[] = "Nom d'utilisateur déjà utilisé";
	};

	if (count($requestError) > 0)
	{
		$error = implode("<br />", $requestError);
	}
	else
	{
		$now = date_format(new DateTime('now', new DateTimeZone('Europe/Paris')), 'Y-m-d H:i:s');

		$hashed_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

		// Requête pour insérer le nouvel utilisateur
		$req = $bdd->prepare('INSERT INTO cyril_users(username, password, lastConnectionDate) VALUES(:username, :password, :lastConnectionDate)');
		$req->execute(array(
			'username' => $_POST['username'], 
			'password' => $hashed_pass, 
			'lastConnectionDate' => $now));

		$error= "Utilisateur enregistré";
	};
};

if ($error != "")
{
	print $error;
};

?>