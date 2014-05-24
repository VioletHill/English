<?php
	include_once ('WordBean.php');

	class DictionaryBean{
		private $dictionaryID;
		private $name;
		private $words;
		private $count;
	
		public function _construct()
		{
		}

		public function getDictionaryID()
		{
			return $this->dictionaryID;
		}
		
		public function getName()
		{
			return $this->name;
		}

		public function getWords()
		{
			return $this->words;
		}

		public function setDictionaryId($dictionaryID)
		{
			$this->dictionaryID=$dictionaryID;
		}

		public function setWords($words)
		{
			$this->words=$words;
		}
	
		public function setName($name)
		{
			$this->name=$name;
		}

		public function setCount($count)
		{
			$this->count=$count;
		}

		public function getCount($count)
		{
			return $this->count;
		}

		public function toJson()
		{
			$result=urldecode (json_encode( array("dictionaryID"=>$this->dictionaryID,"name"=>urlencode($this->name),"count"=>urlencode($this->count) ) ) );
			
			$result=substr($result,0,strlen($result)-1).',"Word":[';
	   		$jsonArray=array();
   
 			for ($i=0; $i<(count($this->words)); $i++)
    		{
    			$item=$this->words[$i];
        		$result=$result.$item->toJson();
        		if ($i<count($this->words)-1)
        		{
            		$result=$result.',';
        		}
    		}
    		$result=$result.']}';
    		return $result;
		}
	}
?>