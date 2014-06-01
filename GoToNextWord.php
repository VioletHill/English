<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );
	$newWord=WordDao::sharedWordDao()->getNextWord($user);
	if ($newWord!=null)
	{
		echo $user->toJson();
	}else{
		echo json_encode( array("finish"=>"finish"));
	}
?>