<?php
    
	require_once (dirname(__FILE__).'/../models/BookModel.php');
    
    /* Class BookController for BookModel
        * *
        * *
        * * @method construct: Create object model
        * * @method getBooks: Return assoc array all books
        * * @method getBook: Retutn assoc array select book
        * * @method getBooksAuthor: Retutn assoc array of books select author
        * * @method getBooksGenre: Retutn assoc array of books select genre
        * * @method getAuthorsBook: Retutn assoc array of authors select book
        * * @method getGenresBook: Retutn assoc array of genres select book
        * */

    class BookController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new BookModel();
		}
        
    /* getBooks method
        * *
        * *
        * * @params: No params
        * * @return: Retutn assoc array of all books or empty
        * */

        public function getBooks()
        {
            $res = $this->model->returnBooks();
            return $res;
        }
		
    /* getBooksAuthor method
        * *
        * *
        * * @params id:val id author
        * * @return: Retutn assoc array of books or empty
        * */

		public function getBooksAuthor($id)
        {
            $res = $this->model->returnBooksFromAuthor($id);
            return $res;
        }
		
    /* getAuthorsBook method
        * *
        * *
        * * @params $id: val id book
        * * @return: Retutn assoc array of authors select book or empty
        * */

		public function getAuthorsBook($id)
        {
            $res = $this->model->returnAuthorsFromBook($id);
            return $res;
        }
		
    /* getBooksGenre method
        * *
        * *
        * * @params id:val id genre
        * * @return: Retutn assoc array of books select genre or empty
        * */

		public function getBooksGenre($id)
        {
            $res = $this->model->returnBooksFromGenre($id);
            return $res;
        }
		
    /* getGenresBook method
        * *
        * *
        * * @params id:val id book
        * * @return: Retutn assoc array of genres select book
        * */

		public function getGenresBook($id)
        {
            $res = $this->model->returnGenresFromBook($id);
            return $res;
        }
		
    /* getBook method
        * *
        * *
        * * @params id:val id book
        * * @return: Retutn assoc array of select book or empty
        * */

		public function getBook($id)
        {
            $res = $this->model->returnBook($id);
            return $res;
        }       
    }

