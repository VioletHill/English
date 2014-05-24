<?php
	
	include_once ('Database.php');
	include_once ('UserBean.php');
	include_once ('DictionaryDao.php');
	include_once ('WordBean.php');

	class ProcessDao
	{
		static private  $_sharedProcessDao=null;

		static public function sharedProcessDao()
		{
			if (self::$_sharedProcessDao==null){
				self::$_sharedProcessDao=new ProcessDao();
			}
			return self::$_sharedProcessDao;
		}

		public function insertProcess(& $user,$dicWordRela_id)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$userID=$user->getUserID();


			$insert="insert into Process (user_id, dicWordRela_id) values ($userID,$dicWordRela_id)";
			mysql_query($insert);

			$database->closeDatabase();
		}

		//this is private function , so it won't close database
		private function getFirstDicWordRelaInDictionary($dictionary_id)	
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$dicWordRelaIdSql="select distinct DicWordRela.id from DicWordRela,Dictionary where DicWordRela.word_order=1 and DicWordRela.dictionary_id=Dictionary.id and Dictionary.id=$dictionary_id";
			$result=mysql_query($dicWordRelaIdSql,$database->getCon());
			$row=mysql_fetch_array($result);
			return $row['id'];
		}

		public function updateUserDictionaryAndOrder(& $user, $order, & $dictionary)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$user->setOrder($order);
			$user->setDictionary($dictionary);
			$userId=$user->getUserID();
			$dictionaryId=$dictionary->getDictionaryID();

			$update="update user set now_dictionary_id=$dictionaryId,now_order=$order where id=$userId";
			mysql_query($update);

			$database->closeDatabase();
		}

		//$user      			 to change process user entity
		//now dictionaryID   	 to change the dictionary'ID
		public function changeProcess(& $user,$nowDictionaryID)
		{	
			$userId=$user->getUserID();

			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select distinct * from Process,User,DicWordRela,Dictionary where User.id=$userId and User.id=Process.user_id and Process.DicWordRela_Id=DicWordRela.id and DicWordRela.dictionary_id=Dictionary.id and Dictionary.id=$nowDictionaryID";	
			$result=mysql_query($sql,$database->getCon());

			$row=mysql_fetch_array($result);

			$nowOrder;
			$nowDictionary=DictionaryDao::sharedDictionaryDao()->getDictionaryByID($nowDictionaryID);

			if ($row==null)						//row = null means need to create a new process 
			{
				$dicWordRela_id=self::getFirstDicWordRelaInDictionary($nowDictionaryID);
				self::insertProcess($user,$dicWordRela_id);	
				$nowOrder=1;
			}
			else
			{
				$nowOrder=$row['word_order'];
			}

			//update user dictionary and order

			self::updateUserDictionaryAndOrder($user,$nowOrder,$nowDictionary);
			$database->closeDatabase();
		}
	}

?>