<?php

include 'Inc/functions.php';

if (!empty($_POST['Token']))
{
	if (CheckToken($_POST['Token']))
	{
		include 'Inc/bdd.php';

		$sql = 'SELECT * FROM cyril_users WHERE token = :token';
		$req = $bdd->prepare($sql);
		$req->execute(array('token' => $_POST['Token']));
		$data = $req->fetch();

		$playerdata = array(
			'Id' => $data['username'],
			'Name' => $data['name'],
			'Firstname' => $data['firstname'],
			'Username' => $data['username'],
			'Level' => $data['level']
		);

		$ue5_answer = array(
			'IsConnected' => true,
			'PlayerData' => $playerdata
		);
	}
	else 
	{
		$ue5_answer = array(
			'IsConnected' => false
		);
	};
}

	
	header('Content-Type: application/json; charset=utf-8');
	print json_encode($ue5_answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>