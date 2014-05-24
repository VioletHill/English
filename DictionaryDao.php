<?php
	require_once ('Database.php');
	require_once ('DictionaryBean.php');
	require_once ('WordDao.php');

	class DictionaryDao
	{
		private static $_sharedDictionaryDao=null;

		public static function sharedDictionaryDao()
		{
			if (self::$_sharedDictionaryDao==null)
			{
				self::$_sharedDictionaryDao=new DictionaryDao();
			}
			return self::$_sharedDictionaryDao;	
		}

		private function setDictionaryWithRow($row)
		{
			$dictionary=new DictionaryBean();
			$dictionary->setDictionaryID($row['id']);
			$dictionary->setName($row['name']);

			$wordDao=WordDao::sharedWordDao();
			$words=$wordDao->getWordsByDictionaryID($dictionary->getDictionaryID());
			$dictionary->setWords($words);
			$dictionary->setCount(count($words));

			return $dictionary;
		}	

		public function getDictionaryByName($name)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from Dictionary where name='$name'";
			$result=mysql_query($sql,$database->getCon());

			$row=mysql_fetch_array($result);		
			$dictionary=$this->setDictionaryWithRow($row);

			$database->closeDatabase();
			return $dictionary;
		}

		public function getDictionaryByID($dictionaryID)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from Dictionary where id='$dictionaryID'";
			$result=mysql_query($sql,$database->getCon());

			$row=mysql_fetch_array($result);		
			$dictionary=$this->setDictionaryWithRow($row);

			$database->closeDatabase();
			return $dictionary;
		}

		public function getFirstDictionary()
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from Dictionary limit 1";
			$result=mysql_query($sql,$database->getCon());

			$row=mysql_fetch_array($result);		
			$dictionary=$this->setDictionaryWithRow($row);
				
			$database->closeDatabase();
			return $dictionary;	
		}

	}
?>