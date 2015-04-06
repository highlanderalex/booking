<?php

	require_once ('DB.php');
    
    class BookModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
		public function returnBooks()
        {
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnBook($id)
        {
            $arr['where'] = $id;
			$res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnBooksFromAuthor($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->InnerJoin('book_author')
							  ->On('book_author.book_id=books.id')
							  ->Where('book_author.author_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnAuthorsFromBook($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('authors.name')
						      ->From('authors')
							  ->InnerJoin('book_author')
							  ->On('book_author.author_id=authors.id')
							  ->Where('book_author.book_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnBooksFromGenre($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->InnerJoin('book_genre')
							  ->On('book_genre.book_id=books.id')
							  ->Where('book_genre.genre_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnGenresFromBook($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('genres.name')
						      ->From('genres')
							  ->InnerJoin('book_genre')
							  ->On('book_genre.genre_id=genres.id')
							  ->Where('book_genre.book_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
    }