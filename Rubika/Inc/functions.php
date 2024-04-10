<?php

function RadnomStr($length)
{
	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$str = substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
	return $str;
}

function CheckToken($Token) {
	include 'Inc/bdd.php';
	$sql = 'SELECT * FROM cyril_users WHERE token = :token';
	$req = $bdd->prepare($sql);
	$req->execute(array('token' => $Token));
	$data = $req->fetch();

	if ($req->rowCount() == 1)
	{
		//TODO : check token lifetime according to lastConnectionDate
		return true;
	}
	else
	{
		return false;
	};
}

function CreateNewTokenWithExisting($old_token)
{
	$new_token = RadnomStr(60);
	include 'Inc/bdd.php';

	$sql = 'UPDATE cyril_users SET token = :new_token WHERE token = :old_token';
	$req = $bdd->prepare($sql);
	$req->execute(array(
		'new_token' => $new_token,
		'old_token' => $old_token
	));

	return $new_token;
}

function CreateNewTokenWithUsername($username12)
{
	$token = RadnomStr(60);

	include 'Inc/bdd.php';
	$sql = 'UPDATE cyril_users SET token = :token WHERE username = :username';
	$req = $bdd->prepare($sql);
	$req->execute(array(
		'token' => $token,
		'username' => $username12
	));

	return $token;
}

?>