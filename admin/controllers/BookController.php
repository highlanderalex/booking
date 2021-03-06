<?php
    
	require_once (dirname(__FILE__).'/../models/BookModel.php');
    
    class BookController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new BookModel();
		}
        
        public function getBooks()
        {
            $res = $this->model->returnBooks();
            return $res;
        }
		
		public function getBooksAuthor($id)
        {
            $res = $this->model->returnBooksFromAuthor($id);
            return $res;
        }
		
		public function getAuthorsBook($id)
        {
            $res = $this->model->returnAuthorsFromBook($id);
            return $res;
        }
		
		public function getBooksGenre($id)
        {
            $res = $this->model->returnBooksFromGenre($id);
            return $res;
        }
		
		public function getGenresBook($id)
        {
            $res = $this->model->returnGenresFromBook($id);
            return $res;
        }
		
		public function getBook($id)
        {
            $res = $this->model->returnBook($id);
            return $res;
        }
		
		public function checkBookId($id)
        {
            $res = $this->model->returnCountBookId($id);
            return $res;
        }
		
		public function addBook($data)
		{
			$res = $this->model->insertBook($data);
            return $res;
		}
		
		public function updateBook($data)
		{
			$res = $this->model->updateBook($data);
            return $res;
		}
		
		public function removeBook($id)
        {
            $res = $this->model->deleteBook($id);
            return $res;
        }
    }

