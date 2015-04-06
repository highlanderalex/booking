<?php

    require_once (dirname(__FILE__).'/../models/AuthorModel.php');
	
    class AuthorController  
	{
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
		
		public function getAuthor($id)
        {
            $res = $this->model->returnAuthor($id);
            return $res;
        }
		
		public function checkAuthor($data)
        {
            $res = $this->model->returnCountAuthor($data);
            return $res;
        }
		
		public function checkAuthorId($id)
        {
            $res = $this->model->returnCountAuthorId($id);
            return $res;
        }
		
		public function addAuthor($data)
        {
            $res = $this->model->insertAuthor($data);
            return $res;
        }
		
		public function removeAuthor($id)
        {
            $res = $this->model->deleteAuthor($id);
            return $res;
        }
		
		public function updateAuthor($data)
        {
            $res = $this->model->updateAuthor($data);
            return $res;
        }
		
	}