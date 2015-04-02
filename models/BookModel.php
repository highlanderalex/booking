<?php

	require_once ('DB.php');
    
    class BookModel {
	
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        public function returnBooks()
        {
            $sql = 'SELECT id, name, description, image, price FROM books';
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnBook($id)
        {
            $sql = 'SELECT * FROM books WHERE id='.$id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnBooksFromAuthor($id)
        {
            $sql = 'SELECT id, name, description, image, price FROM books INNER JOIN book_author ON book_author.book_id=books.id WHERE book_author.author_id='.$id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res;
        }
		
		public function returnAuthorsFromBook($id)
        {
            $sql = 'SELECT authors.name FROM authors INNER JOIN book_author ON book_author.author_id=authors.id WHERE book_author.book_id='.$id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res;
        }
		
		public function returnBooksFromGenre($id)
        {
            $sql = 'SELECT id, name, description, image, price FROM books INNER JOIN book_genre ON book_genre.book_id=books.id WHERE book_genre.genre_id='.$id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res;
        }
		
		public function returnGenresFromBook($id)
        {
            $sql = 'SELECT genres.name FROM genres INNER JOIN book_genre ON book_genre.genre_id=genres.id WHERE book_genre.book_id='.$id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res;
        }
		
    }