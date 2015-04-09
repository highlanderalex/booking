<?php

    require_once (dirname(__FILE__).'/../models/AuthorModel.php');
	
   /* Class AuthorController for AuthorModel.
       * *
       * *
       * * @method construct: Create object model
       * * @method getAuthors: The return assoc array of authors or empty array
       * */

    class AuthorController  
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new AuthorModel();
		}
        
        /* getAuthors method
            * *
            * *
            * * @param: no params
            * * @return: Retutn assoc array of authors or empty
            * */

        public function getAuthors()
        {
            $res = $this->model->returnAuthors();
            return $res;
        }
		
	}
