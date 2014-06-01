<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('DictionaryDao.php');

	$user=unserialize( $_SESSION['user'] );
	$dictionaryId=$user->getDictionary()->getDictionaryID();

	echo json_encode(UserDao::sharedUserDao()->getUsersRank($dictionaryId));
?>