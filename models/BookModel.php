<?php

	require_once ('DB.php');
    
    /* Class BookModel for books table
        * *
        * *
        * * @method construct: Create database connection
        * * @method returnBooks: Return assoc array all books
        * * @method returnBook: Retutn assoc array select book
        * * @method returnBooksFromAuthor: Retutn assoc array of books select author
        * * @method returnBooksFromGenre: Retutn assoc array of books select genre
        * * @method returnAuthorsFromBook: Retutn assoc array of authors select book
        * * @method returnGenresFromBooks: Retutn assoc array of genres select book
        * */

    class BookModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
    /* returnBooks method
        * *
        * *
        * * @params: No params
        * * @return: Retutn assoc array of all books or empty
        * */

		public function returnBooks()
        {
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
    /* returnBook method
        * *
        * *
        * * @params id:val id book
        * * @return: Retutn assoc array of select book or empty
        * */

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
		
    /* returnBooksFromAuthor method
        * *
        * *
        * * @params id:val id author
        * * @return: Retutn assoc array of books or empty
        * */

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
		
    /* returnAuthorsFromBooks method
        * *
        * *
        * * @params $id: val id book
        * * @return: Retutn assoc array of authors select book or empty
        * */

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
		
    /* returnBooksFromGenre method
        * *
        * *
        * * @params id:val id genre
        * * @return: Retutn assoc array of books select genre or empty
        * */

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
		
    /* returnGenresFromBook method
        * *
        * *
        * * @params id:val id book
        * * @return: Retutn assoc array of genres select book
        * */

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
