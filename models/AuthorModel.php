<?php

	require_once ('DB.php');
    
    class AuthorModel {
		
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        public function returnAuthors()
        {
            $sql = 'SELECT DISTINCT book_author.author_id, authors.name FROM book_author INNER JOIN authors ON book_author.author_id=authors.id';
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res;
        }
	}