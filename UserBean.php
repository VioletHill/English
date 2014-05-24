<?php
	include_once ('DictionaryBean.php');
	
	class UserBean
	{
		private $userID;
		private $account;
		private $password;
		private $email;
		private $dicionary;
		private $order;

		function _construct()
		{
		}

		function setUserID($userID){
			$this->userID=$userID;
		}

		function getUserID(){
			return $this->userID;
		}

		function setAccount($account){
			$this->account=$account;
		}

		function getAccount(){
			return $this->account;
		}

		function setPassword($password){
			$this->password=$password;
		}

		function getPassword(){
			return $this->password;
		}


		function setEmail($email){
			$this->email=$email;
		}

		function getEmail(){
			return $this->email;
		}

		function setDictionary($dictionary){
			$this->dictionary=$dictionary;
		}

		function getDictionary(){
			return $this->dictionary;
		}

		function setOrder($order){
			$this->order=$order;
		}

		function getOrder(){
			return $this->order;
		}

		function toJson(){
			return urldecode (json_encode( array("userId"=>$this->userID,"account"=>urlencode($this->account),"email"=>urlencode($this->email),"dictionaryName"=>urlencode($this->dictionary->getName()),"order"=>$this->order,"dictionaryId"=>$this->dictionary->getDictionaryID() ) ) );
		}
	}
?>