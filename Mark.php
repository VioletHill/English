<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );

	$action=$_GET['action'];
 	$wordName=$_GET['word'];

	if ($action=="ask")
	{
		isExistMark($user,$wordName);	
		return ;
	}else if ($action=="insert")
	{
		insertMark($user,$wordName);
		return ;
	}else if ($action=="delete"){
		deleteMark($user,$wordName);
		return ;
	}


	function isExistMark($user,$wordName)
	{
		$isExist=WordDao::sharedWordDao()->isExistMarkWord($user,$wordName);
		echo json_encode(array("isExist"=>$isExist));
	}

	function insertMark($user,$wordName)
	{
		
		WordDao::sharedWordDao()->insertMarkWord($user,$wordName);;
		echo json_encode(array("finish"=>"finish"));
	}

	function deleteMark($user,$wordName)
	{
		WordDao::sharedWordDao()->deleteMarkWord($user,$wordName);
		echo json_encode(array("finish"=>"finish"));
	}
?>

