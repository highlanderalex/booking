<?php
    include 'AuthorModel.php';
    
    class TestAuthorModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnAuthors()
        {
            $author = new AuthorModel();
            $this->assertTrue(is_array($author->returnAuthors()));
            $this->assertEmpty(array($author->returnAuthors()));
        }
    }

?>
