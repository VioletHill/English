<?php
	include_once ('Database.php');
	include_once ('WordBean.php');
	include_once ('ProcessDao.php');

	class WordDao
	{

		private static $_sharedWordDao=null;
	
		public static function sharedWordDao()
		{
			if (self::$_sharedWordDao==null)
			{
				self::$_sharedWordDao=new WordDao();
			}
			return self::$_sharedWordDao;	
		}

		private function setWordWithRow($row)
		{
			$word=new WordBean();

			$word->setWordID($row['id']);
			$word->setName($row['word']);
			$word->setTrans($row['trans']);
			return $word;
		}

		public function getAllData()
		{
			$wordsArray = array();

			$database=Database::sharedDatabase();

			$database->connectDatabase();

			$sql="select * from Word";
			$result = mysql_query ($sql);
			
			while ( $row = mysql_fetch_array ( $result) ) 
			{
				$word=$this->setWordWithRow($row);
				array_push($wordsArray, $word);
			}
	
			$database->closeDatabase();
			return $wordsArray;
		}

		public function getWordsByDictionaryID($dicID)
		{		
			$wordsArray=array();
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from Word,DicWordRela where DicWordRela.dictionary_id=$dicID and DicWordRela.word_id=Word.id order by Word.id";
			$result=mysql_query($sql);
			while ($row=mysql_fetch_array($result))
			{
				$word=$this->setWordWithRow($row);
				array_push($wordsArray, $word);
			}
			
			$database->closeDatabase();
			return $wordsArray;
		}

		public function getWordByCompleteName($name)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from Word where word='$name'";

			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$word=$this->setWordWithRow($row);
			$database->closeDatabase();

			return $word;
		}

		static $blurredName;
		function cmpWithBlurredName(& $a,& $b)
		{
			$indexA=stripos($a->getName(), self::$blurredName);
			$indexB=stripos($b->getName(), self::$blurredName);
			if ($indexA==$indexB) return 0;
			else return ($indexA>$indexB) ? 1 : -1;

		}

		private function sortWords(& $wordsArray)	//pass by reference
		{
			usort($wordsArray,"WordDao::cmpWithBlurredName");
		}

		public function getWordsByBlurredName($name)
		{
			$wordsArray=array();
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$name=strtolower($name);
			self::$blurredName=$name;

			$sql="select * from Word where lower(word) like'%".$name."%'";
			$result=mysql_query($sql);
			while ($row=mysql_fetch_array($result))
			{
				$word=$this->setWordWithRow($row);
				array_push($wordsArray, $word);
			}
			$database->closeDatabase();
			$this->sortWords($wordsArray);
			return $wordsArray;
		}

		//get to next word 
		//user entity won't do anything
		//return next word
		//if don't have next word return null
		public function getNextWord(& $user)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$order=$user->getOrder();
			$dictionaryID=$user->getDictionary()->getDictionaryID();
			$nextOrder=$order+1;
			$sql="select Word.id,Word.word,Word.trans from Word,DicWordRela,Dictionary where DicWordReal.word_order==$nextOrder and DicWordReal.dicitionary_id=$dictionaryID";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);

			$database->closeDatabase();

			if ($row==null)
			{
				return null;
			}
			else
			{
				$word=$this->setWordWithRow($row);

				ProcessDao::sharedProcessDao()->updateUserDictionaryAndOrder($user, $nextOrder,$user->getDictionary());
				return $word;
			}
		}
	}
?>