<?php

    require_once (dirname(__FILE__).'/../models/AuthorModel.php');
	
    class AuthorController  {
        
		private $model;
		
		public function __construct()
		{
			$this->model = new AuthorModel();
		}
        public function getAuthors()
        {
            $res = $this->model->returnAuthors();
            return $res;
        }
		
	}