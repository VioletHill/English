<?php session_start();
	header("Content-Type:application/json; charset=utf8");	
	include_once ('UserDao.php');

	$account=$_POST['account'];
	$password=$_POST['password'];
	$userDao=UserDao::sharedUserDao();
	$user=$userDao-> canLogin($account,$password);
	if ($user==null){
		echo urldecode (json_encode( array("success"=>false) ) );
	}else{
		$_SESSION['user']=serialize($user);
		echo urldecode (json_encode( array("success"=>true) ) );
	}

?>