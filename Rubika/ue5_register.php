<?php

// Initialisation message d'erreur
$error = "";

// Si le formulaire est envoy�

//if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']))
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['password2']))
{
	// Connexion � la base de donn�es
	include 'Inc/bdd.php';

	// Iinit variable d'erreur
	$requestError = array();
	
	// Si les deux mots de passe sont identiques
	if ($_POST['password'] != $_POST['password2'])
	{
		$requestError[] = "Les mots de passe ne correspondent pas";
	};
		
	// Requ�te pour v�rifier si le nom d'utilisateur est d�j� utilis�
	$sql = 'SELECT * FROM cyril_users WHERE username = :username';
	$req = $bdd->prepare($sql);
	$req->execute(
		array('username' => $_POST['username']));

	$data = $req->fetch();

	if ($req->rowCount() > 0)
	{
		$requestError[] = "Nom d'utilisateur d�j� utilis�";
	};

	if (count($requestError) > 0)
	{
		$error = implode("<br />", $requestError);
	}
	else
	{
		$now = date_format(new DateTime('now', new DateTimeZone('Europe/Paris')), 'Y-m-d H:i:s');

		$hashed_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

		// Requ�te pour ins�rer le nouvel utilisateur
		$req = $bdd->prepare('INSERT INTO cyril_users(username, password, lastConnectionDate) VALUES(:username, :password, :lastConnectionDate)');
		$req->execute(array(
			'username' => $_POST['username'], 
			'password' => $hashed_pass, 
			'lastConnectionDate' => $now));

		$error= "Utilisateur enregistr�";
	};
};

if ($error != "")
{
	print $error;
};

?>