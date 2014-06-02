<?php
	session_start();

	header("Content-Type:text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );
	$dictionary=$user->getDictionary();
	echo $dictionary->toJson();
?>