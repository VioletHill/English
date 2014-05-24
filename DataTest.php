<?php
	include_once('UserDao.php');
	include_once('ProcessDao.php');

	$process=ProcessDao::sharedProcessDao();

	$user=UserDao::sharedUserDao()->getUserById(10);

	$process->changeProcess($user,1);

	echo $user->toJson();
?>