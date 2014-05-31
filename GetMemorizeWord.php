<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );

	$dictionary=$user->getDictionary();
	$nowOrder=$user->getOrder();
	$words=$dictionary->getWords();
	
	echo WordBean::arrayJson($words);
?>