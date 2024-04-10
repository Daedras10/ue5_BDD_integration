<?php

include 'inc/functions.php';

if (!empty($_POST['Token']) || (!empty($_POST['username']) && !empty($_POST['password'])))
{
	$error = array();
	$connected = false;
	$usedToken = true;

	if (!empty($_POST['Token']))
	{
		$checkToken = CheckToken($_POST['Token']);

		if ($checkToken)
		{
			$connected = true;
		}
		else
		{
			$error[] = 0; // Token invalide
		};
	}
	else if (!empty($_POST['username']) && !empty($_POST['password']))
	{
		$usedToken = false;

		include 'inc/bdd.php';
		$sql = 'SELECT * FROM cyril_users WHERE username = :username';
		$req = $bdd->prepare($sql);
		$req->execute(array(
				'username' => $_POST['username']
		));
		$data = $req->fetch();

		if ($req->rowCount() == 1)
		{
			//if ($_POST['password'] == $data['password'])
			if (Password_verify($_POST['password'], $data['password']))
			{
				$connected = true;
			}
			else 
			{
				print 'err1';
				$error[] = 1; // Identifiants invalides
			}
		}
		else
		{
			print 'err2';
			$error[] = 1; // Identifiants invalides
		};
	};

	if ($connected)
	{
		if ($usedToken)
		{
			$ue5_answer = array(
				'IsConnected' => true,
				'NewToken' => CreateNewTokenWithExisting($_POST["Token"]),
			);
		}
		else {
			$ue5_answer = array(
				'IsConnected' => true,
				'NewToken' => CreateNewTokenWithUsername($_POST["username"]),
			);
		};
	}
	else
	{
		$ue5_answer = array(
			'IsConnected' => false,
			'Error' => $error[0],
		);
	};

	header('Content-Type: application/json; charset=utf-8');
	print json_encode($ue5_answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

?>