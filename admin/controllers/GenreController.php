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
		
		public function getGenre($id)
        {
            $res = $this->model->returnGenre($id);
            return $res;
        }
		
		public function checkGenre($data)
        {
            $res = $this->model->returnCountGenre($data);
            return $res;
        }
		
		public function checkGenreId($id)
        {
            $res = $this->model->returnCountGenreId($id);
            return $res;
        }
		
		public function addGenre($data)
        {
            $res = $this->model->insertGenre($data);
            return $res;
        }
		
		public function updateGenre($data)
        {
            $res = $this->model->updateGenre($data);
            return $res;
        }
		
		public function removeGenre($id)
        {
            $res = $this->model->deleteGenre($id);
            return $res;
        }
	}