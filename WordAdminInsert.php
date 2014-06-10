<?php
	session_start();

	header("Content-Type:text/html; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');
	include_once ('DictionaryDao.php');


	$name=$_POST['word'];
	$trans=$_POST['trans'];
	$phonetic=$_POST['phonetic'];

	if ($name==null) $name="";
	if ($trans==null) $trans="";
	if ($phonetic==null) $phonetic="";

	$word=new WordBean();
	$word->setName($name);
	$word->setTrans($trans);
	$word->setPhoneticEn($phonetic);
	$word->setPhoneticUs($phonetic);
	
	$dictionaryName=array("cet4","cet6","kaoyan","ielts","toefl");
	for ($i=0; $i<5; $i++)
	{
		
		$dName=$_POST[$dictionaryName[$i]];

		if ($dName=="true")
		{
			$dictionary=DictionaryDao::sharedDictionaryDao()->getDictionaryByName($dictionaryName[$i]);
			WordDao::sharedWordDao()->insertWordWithWordAndDictionary($word,$dictionary);
		}
	}

	echo "done";
	
?>