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
			$word->setPhoneticEn($row['phoneticEn']);
			$word->setPhoneticUs($row['phoneticUs']);
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

			$sql="select Word.id,word.trans,word.word,word.phoneticEn,word.phoneticUs from Word,DicWordRela where DicWordRela.dictionary_id=$dicID and DicWordRela.word_id=Word.id order by DicWordRela.word_order";
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

		public function getWordByDictionaryAndOrder(& $dictionary,$order)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();
			$dictionaryID=$dictionary->getDictionaryID();

			$sql="select distinct Word.id,Word.word,Word.trans,word.phoneticEn,word.phoneticUs  from Word,DicWordRela,Dictionary where DicWordRela.word_order=$order and DicWordRela.dictionary_id=$dictionaryID and DicWordRela.word_id=Word.id";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);

			$database->closeDatabase();

			if ($row==null)	return null;
			else
			{
				$word=$this->setWordWithRow($row);
				return $word;
			}
		}

		//get to next word 
		//user entity won't do anything
		//return next word
		//if don't have next word return null
		public function getNextWord(& $user)
		{
			$order=$user->getOrder();
			$dictionary=$user->getDictionary();

			$word=$this->getWordByDictionaryAndOrder($dictionary,$order+1);
			if ($word!=null)
			{
				ProcessDao::sharedProcessDao()->updateUserDictionaryAndOrder($user, $order+1,$user->getDictionary());
			}
			return $word;
		}

		public function getUserWord(& $user)
		{
			$order=$user->getOrder();
			$dictionary=$user->getDictionary();

			$word=$this->getWordByDictionaryAndOrder($dictionary,$order);
			ProcessDao::sharedProcessDao()->updateUserDictionaryAndOrder($user, $order,$user->getDictionary());	
			return $word;	
		}

		public function clearUserRecordInDictionary(& $user,$dictionary)
		{
			$word=$this->getWordByDictionaryAndOrder($dictionary,1);
			if ($word!=null)
			{
				ProcessDao::sharedProcessDao()->updateUserDictionaryAndOrder($user, 1,$user->getDictionary());
			}
		}

		public function getUserMarkWords($user)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$userId=$user->getUserID();
			$sql="select Word.id,word.trans,word.word,word.phoneticEn,word.phoneticUs from Word,Mark where user_id=$userId and word.id=mark.word_id";
		
			$result=mysql_query($sql);

			$words=array();
			while ($row=mysql_fetch_array($result))
			{
				$word=$this->setWordWithRow($row);
				array_push($words,$word);
			}
			$database->closeDatabase();
			return $words;
		}

		public function isExistMarkWord($user,$wordName)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$userId=$user->getUserID();
			$sql="select word.id from word,mark,user where user.id=$userId and mark.user_id=user.id and mark.word_id=word.id and word.word='$wordName'";	
			$result=mysql_query($sql);
			$database->closeDatabase();
			if (mysql_num_rows($result)==0) return false;
			else return true;
		}

		public function insertMarkWord($user,$wordName)
		{
			if ($this->isExistMarkWord($user,$wordName))
			{
				return ;
			}
			else{
				$userId=$user->getUserID();

				$wordId=$this->getWordByCompleteName($wordName)->getWordID();

				$database=Database::sharedDatabase();
				$database->connectDatabase();
				
				$sql="insert into mark(user_id,word_id) values ($userId,$wordId)";
				mysql_query($sql);
				$database->closeDatabase();
			}
		}

		public function deleteMarkWord($user,$wordName)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$userId=$user->getUserID();
			$sql="select mark.id from word,mark,user where user.id=$userId and mark.user_id=user.id and mark.word_id=word.id and word.word='$wordName'";	
			$markId=mysql_fetch_array(mysql_query($sql))['id'];

			$deleteSql="delete from mark where id=$markId";
	
			mysql_query($deleteSql);
			$database->closeDatabase();
		}
	}
?>