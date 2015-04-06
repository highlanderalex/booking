<?php

	require_once ('DB.php');
    
    class AuthorModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
		public function returnAuthors()
        {
            $res = $this->inst->Select('DISTINCT book_author.author_id, authors.name')
						      ->From('book_author')
							  ->InnerJoin('authors')
							  ->On('book_author.author_id=authors.id')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}