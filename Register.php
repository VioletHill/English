<?php
	header("Content-Type: text/json; charset=utf8");	
	include_once ('UserDao.php');


	$account=$_POST['account'];
	$password=$_POST['password'];

	$userDao=UserDao::sharedUserDao();
	$isExistAccount=$userDao-> isExistAccount($account);
	if ($isExistAccount==true){
		echo urldecode (json_encode( array("success"=>false,"msg"=>"user name already exist") ) );
	}else{
		$user=new UserBean();
		$user->setAccount($account);
		$user->setPassword($password);
		$userDao->insertUser($user);
		echo urldecode (json_encode( array("success"=>true,"msg"=>"") ) );
	}
	
?>