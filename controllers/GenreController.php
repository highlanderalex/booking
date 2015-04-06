<?php
    
	require_once (dirname(__FILE__).'/../models/GenreModel.php');
    
    class GenreController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new GenreModel();
		}
        
        public function getGenres()
        {
            $res = $this->model->returnGenres();
            return $res;
        }
	}