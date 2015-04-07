<?php
    include 'BookModel.php';
    
    class TestBookModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnBooks()
        {
            $books = new BookModel();
            $this->assertTrue(is_array($books->returnBooks()) 
                                            || empty($books->returnBooks()));
        }
        
        public function testreturnBook()
        {
            $book = new BookModel();
            $id = 5;
            $this->assertTrue(is_array($book->returnBook($id)) 
                                        || empty($book->returnBook($id)));
        }
        
        public function testreturnBooksFromAuthor()
        {
            $books = new BookModel();
            $id = 3;
            $this->assertTrue(is_array($books->returnBooksFromAuthor($id)) 
                                    || empty($books->returnBooksFromAuthor($id)));
        }
        
        public function testreturnAuthorsFromBook()
        {
            $authors = new BookModel();
            $id = 4;
            $this->assertTrue(is_array($authors->returnAuthorsFromBook($id)) 
                                    || empty($authors->returnAuthorsFromAuthor($id)));
        }
        
        public function testreturnBooksFromGenre()
        {
            $books = new BookModel();
            $id = 2;
            $this->assertTrue(is_array($books->returnBooksFromGenre($id)) 
                                    || empty($books->returnBooksFromGenre($id)));
        }
        
        public function testreturnGenresFromBook()
        {
            $books = new BookModel();
            $id = 3;
            $this->assertTrue(is_array($books->returnGenresFromBook($id)) 
                                    || empty($books->returnGenresFromBook($id)));
        }
         
    }

?>
