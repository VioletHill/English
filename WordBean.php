<?php
	class WordBean{
		private $wordID;
		private $name;
		private $trans;
		private $phoneticEn;
		private $phoneticUs;

		public function _construct()
		{
		}

		public function getWordID()
		{
			return $this->wordID;
		}
		
		public function getName()
		{
			return $this->name;
		}

		public function getTrans()
		{
			return $this->trans;
		}

		public function setWordID($wordID)
		{
			$this->wordID=$wordID;
		}
	
		public function setName($name)
		{
			$this->name=$name;
		}

		public function setTrans($trans)
		{
			$this->trans=$trans;
		}

		public function setPhoneticEn($phoneticEn)
		{
			$this->phoneticEn=$phoneticEn;
		}

		public function getPhoneticEn()
		{
			return $this->phoneticEn;
		}

		public function setPhoneticUs($phoneticUs)
		{
			$this->phoneticUs=$phoneticUs;
		}

		public function getPhoneticUs()
		{
			return $this->phoneticUs;
		}

		public function toJson()
		{
			return urldecode (json_encode( array("wordID"=>$this->wordID,"name"=>urlencode($this->name),"trans"=>urlencode($this->trans),"phoneticUs"=>urlencode($this->phoneticUs),"phoneticEn"=>urldecode($this->phoneticEn) ) ) );
		}

		public static function arrayJsonForCount($wordsArray,$count)
		{
			$result='[';
			$arrayCount=(count($wordsArray));
			if ($count<$arrayCount) $arrayCount=$count;
			for ($i=0; $i<$arrayCount; $i++)
    		{
    			$item=$wordsArray[$i];
        		$result=$result.$item->toJson();
        		if ($i<$arrayCount-1)
        		{
           		 	$result=$result.',';
        		}
    		}
    		$result=$result.']';
    		return $result;	
		}

		public static function arrayJson($wordsArray)
		{
			return WordBean::arrayJsonForCount($wordsArray,count($wordsArray));
		}
	}
?>