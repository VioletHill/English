<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );
	$newWord=WordDao::sharedWordDao()->getNextWord($user);
	if ($newWord!=null)
	{
		//$_SESSION['user']=serialize($user);
		echo $user->toJson();
	}
?>