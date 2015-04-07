<?php
    include 'GenreModel.php';
    
    class TestGenreModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnGenres()
        {
            $genre = new GenreModel();
            $this->assertTrue(is_array($genre->returnGenres()));
            $this->assertEmpty(array($genre->returnGenres()));
        }
    }

?>
