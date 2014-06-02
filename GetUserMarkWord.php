<?php
	session_start();

	header("Content-Type:text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );
	$words=WordDao::sharedWordDao()->getUserMarkWords($user);
	echo WordBean::arrayJson($words);
?>