<?php session_start();

	header("Content-Type: text/json; charset=utf8");
	include_once ('DictionaryDao.php');
	include_once ('ProcessDao.php');
	
	$dictionaryName=$_GET["Dictionary"];
	$dictionaryDao=DictionaryDao::sharedDictionaryDao();

	$dictionary=$dictionaryDao->getDictionaryByName($dictionaryName);
	$user=unserialize( $_SESSION['user'] );

	$processDao=ProcessDao::sharedProcessDao();

	$processDao->changeProcess($user,$dictionary->getDictionaryID());

	echo $user->toJson();
?>