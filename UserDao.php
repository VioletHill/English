<?php

	include_once ('Database.php');
	include_once ('UserBean.php');
	include_once ('DictionaryDao.php');

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
			$result=mysql_query($sql,$database->getCon());
			$database->closeDatabase();
			if ( mysql_fetch_array($result)==null ){
				return false;
			}
			else{
				return true;
			}
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

		public function insertUser($user)
		{
			$dictionary=DictionaryDao::sharedDictionaryDao()->getFirstDictionary()->getDictionaryID();

			$database=Database::sharedDatabase();
			$database->connectDatabase();
			$account=$user->getAccount();
			$password=$user->getPassword();
			$email=$user->getEmail();
			$order=0;
			$insert="insert into User (account, password, email,now_dictionary_id,now_order) values ('$account' , '$password', '$email',$dictionary,$order)";
			mysql_query($insert);
			$database->closeDatabase();
		}

		public function canLogin($account,$password)
		{
			$database=Database::sharedDatabase();
			$database->connectDatabase();
			$sql="select * from user where account='$account' and password='$password' ";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$database->closeDatabase();

			if ($row!=null){
				$user=self::setUserWithRow($row);
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

			if ($row!=null){
				$user=self::setUserWithRow($row);
				return $user;
			}
			else return null;

		}
	}


?>