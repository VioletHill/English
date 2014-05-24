<?php
	header("Content-Type: text/html; charset=utf8");
	include_once ('DictionaryDao.php');

	
	$dictionaryName=$_GET["Dictionary"];
	$_POST[]
	$dictionaryDao=DictionaryDao::sharedDictionaryDao();
	//$results=$dictionaryDao->getDictionaryByID(1);
	$results=$dictionaryDao->getDictionaryByName($dictionaryName);
	echo $results->toJson();
	// for ($i=0; $i<count($results); $i++)
	// {
	// 	$item=$results[$i];
	// 	echo $item->toJson();
	// }	
	//echo $result;
?>