<?php

	include_once ('Database.php');
	include_once ('UserBean.php');
	include_once ('DictionaryDao.php');
	include_once ('ProcessDao.php');

	class UserDao
	{

		private static $_sharedUserDao=null;
	
		public static function sharedUserDao()
		{
			if (self::$_sharedUserDao==null)
			{
				self::$_sharedUserDao=new UserDao();
			}

			return self::$_sharedUserDao;	
		}

		public function isExistAccount($account)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from User where account='$account'";
			$result=mysql_query($sql);
			$database->closeDatabase();
			$row=mysql_fetch_array($result);
			if ($row==null ) return false;
			else return true;

		}

		public function setUserWithRow($row)
		{
			$user=new UserBean();
			$user->setUserID($row['id']);
			$user->setAccount($row['account']);
			$user->setPassword($row['password']);
			$user->setEmail($row['email']);		
	
			$dictionary=DictionaryDao::sharedDictionaryDao()->getDictionaryByID($row['now_dictionary_id']);
			$user->setDictionary($dictionary);
			$user->setOrder($row['now_order']);

			return $user;
		}

		public function insertUser($account,$password,$email)
		{

			$dictionary=DictionaryDao::sharedDictionaryDao()->getFirstDictionary();

			$user=new UserBean();
			$user->setAccount($account);
			$user->setPassword($password);
			$user->setEmail($email);
			$user->setDictionary($dictionary);

			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$dictionaryId=$dictionary->getDictionaryID();

			$insert="insert into User (account, password, email,now_dictionary_id,now_order) values ('$account' , '$password', '$email',$dictionaryId,1)";
			mysql_query($insert);

			//to set user id
			$user=UserDao::sharedUserDao()->getUserByAccount($account);

			ProcessDao::sharedProcessDao()->inserDefaultProecess($user);

			$database->closeDatabase();

			return $user;
		}

		public function canLogin($account,$password)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();
			$sql="select * from user where account='$account' and password='$password' ";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$database->closeDatabase();

			if ($row!=null)
			{
				$user=$this->setUserWithRow($row);
				return $user;
			}
			else return null;
		}

		public function getUserByID($userID)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();
			$sql="select * from user where id=$userID ";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$database->closeDatabase();

			if ($row!=null)
			{
				$user=$this->setUserWithRow($row);
				return $user;
			}
			else return null;
		}

		public function getUserByAccount($account)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();

			$sql="select * from User where account='$account'";
			$result=mysql_query($sql);
			$database->closeDatabase();
			$row=mysql_fetch_array($result);
			if ($row!=null )
			{
				$user=$this->setUserWithRow($row);
				return $user;
			}
			else return null;
		}
	}


?>