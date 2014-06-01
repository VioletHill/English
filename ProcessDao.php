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
			$result=mysql_query($dicWordRelaIdSql);
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
			
			//update user
			$update="update user set now_dictionary_id=$dictionaryId,now_order=$order where id=$userId";
			mysql_query($update);

			//update process table
			$query="select DicWordRela.id from DicWordRela where DicWordRela.word_order=$order and DicWordRela.dictionary_id=$dictionaryId";
			$row=mysql_fetch_array(mysql_query($query));
			$relaId=$row['id'];
			
			//echo $query;

			$processSql="select distinct Process.id from Process,DicWordRela,Dictionary where Process.DicWordRela_id=DicWordRela.id and DicWordRela.dictionary_id=Dictionary.id and Dictionary.id=$dictionaryId and process.user_id=$userId";
	
			$result=mysql_query($processSql);
			$row=mysql_fetch_array($result);
			$processId=$row['id'];

			$updateProcess="update process set process.DicWordRela_id=$relaId where process.id=$processId";

			mysql_query($updateProcess);
			//here is important  remember to refresh session for user
			$_SESSION['user']=serialize($user);

			$database->closeDatabase();
		}

		//when you insert a user, you need to call this function to insert a default process
		function inserDefaultProecess(& $user)
		{
			//cause dictionary already insert to the user
			$this->changeProcess($user,$user->getDictionary()->getDictionaryID());
		}

		//$user      			 to change process user entity
		//now dictionaryID   	 to change the dictionary'ID
		public function changeProcess(& $user,$nowDictionaryID)
		{	
			$userId=$user->getUserID();

			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select distinct * from Process,User,DicWordRela,Dictionary where User.id=$userId and User.id=Process.user_id and Process.DicWordRela_Id=DicWordRela.id and DicWordRela.dictionary_id=Dictionary.id and Dictionary.id=$nowDictionaryID";	

			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);

			$nowDictionary=DictionaryDao::sharedDictionaryDao()->getDictionaryByID($nowDictionaryID);
			if ($row==null)						//row = null means need to create a new process 
			{
				$dicWordRela_id=$this->getFirstDicWordRelaInDictionary($nowDictionaryID);
				$this->insertProcess($user,$dicWordRela_id);	
				$nowOrder=1;
			}
			else
			{
				$nowOrder=$row['word_order'];
			}

			//update user dictionary and order

			$this->updateUserDictionaryAndOrder($user,$nowOrder,$nowDictionary);
			$database->closeDatabase();
		}
	}

?>