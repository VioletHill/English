<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );

	//clear record;
	$dictionary=$user->getDictionary();
	//WordDao::sharedWordDao()->clearUserRecordInDictionary($user,$dictionary);

	$word=WordDao::sharedWordDao()->getUserWord($user);
		//$_SESSION['user']=serialize($user);
	echo $word->toJson();
	
?>