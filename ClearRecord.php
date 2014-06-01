<?php
	session_start();

	header("Content-Type: text/html; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );

	WordDao::sharedWordDao()->clearUserRecordInDictionary($user,$user->getDictionary());
	echo "clean successful";
?>