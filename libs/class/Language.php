<?php
	class Language
	{
		private $file;
		private $data;
		
		public function __construct($lang)
		{
			$this->file = simplexml_load_file(dirname(__FILE__) . '/../../resources/lang/' . $lang . '.strings');
			$this->loadData();
		}
		private function loadData()
		{
			foreach($this->file->ISTRING as $str)
			{
				$key = $str->KEY;
				$val = $str->VALUE;
				$this->data["$key"] = $val;
			}
		}
		
		public function getLang($key)
		{
			return $this->data[$key];
		}
		
		public function getTranslate()
		{
			return $this->data;
		}
	}