<?php
	header("Content-Type: text/json; charset=utf8");
	include_once ('../WordDao.php');
	
	$input = strtolower($_GET["input"]);
	$wordDao=WordDao::sharedWordDao();
	$results=$wordDao->getWordsByBlurredName($input);
	//echo WordBean::arrayJsonForCount($results,1);
	echo WordBean::arrayJson($results);
?>
