<?php
	session_start();

	header("Content-Type: text/json; charset=utf8");

	include_once ('UserDao.php');
	include_once ('WordDao.php');

	$user=unserialize( $_SESSION['user'] );
	$word=WordDao::sharedWordDao()->getUserWord($user);

	$words=array();
	array_push($words, $word);
	
	$dictionaryWords=$user->getDictionary()->getWords();
	$dictionaryCount=count($dictionaryWords);

	$totalCount=4;
	if ($dictionaryCount<4) $totalCount=$dictionaryCount;

	$count=1;
	while ($count<$totalCount)
	{
		$rand=rand(0,count($dictionaryWords)-1);
		$newWord=$dictionaryWords[$rand];
		if (!isExistWord($words,$newWord)){
			$count++;
			array_push($words, $newWord);
		}		
	}

	echo WordBean::arrayJson($words);	
?>

<?php
	
	function isExistWord(& $words,& $word)
	{
		for ($i=0; $i<count($words); $i++)
		{
			if ($word->getWordID()==$words[$i]->getWordID()) return true;
		}
		return false;
	}
?>