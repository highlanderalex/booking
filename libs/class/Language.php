<?php

    /* Class Language for translate
        * *
        * *
        * * @method construct: Load data from xml file
        * * @method loadData: Record array data from xml file
        * * @method getLang: Return element of data with key 
        * * @method getTranslate: Return array data
        * */

	class Language
	{
		private $file;
		private $data;
		
		public function __construct($lang)
		{
			$this->file = simplexml_load_file(dirname(__FILE__) . '/../../resources/lang/' . $lang . '.strings');
			$this->loadData();
        }

    /* loadData method
        * *
        * *
        * * @params: no param
        * * @return: nothing
        * */

		private function loadData()
		{
			foreach($this->file->ISTRING as $str)
			{
				$key = $str->KEY;
				$val = $str->VALUE;
				$this->data["$key"] = $val;
			}
		}
		
    /* getLang method
        * *
        * *
        * * @params key: val key
        * * @return: Return value from data with key
        * */

		public function getLang($key)
		{
			return $this->data[$key];
		}
		
    /* getTranslate method
        * *
        * *
        * * @params:nothing
        * * @return: Retutn assoc array of data
        * */

		public function getTranslate()
		{
			return $this->data;
		}
	}
