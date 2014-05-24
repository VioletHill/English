<?php
	header("Content-Type: text/json; charset=utf8");
	include_once ('WordDao.php');
	//include_once ('WordBean.php');

	$wordDao=WordDao::sharedWordDao();
	//$results=$wordDao->getWordByCompleteName("hello");
	//echo $results->toJson();

	$results=$wordDao->getWordsByBlurredName("he");
	echo WordBean::arrayJson($results);
	// for ($i=0; $i<count($results); $i++)
	// {
	// 	$item=$results[$i];
	// 	echo $item->toJson();
	// }	
	//echo $result;
?>