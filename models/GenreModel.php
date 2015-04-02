<?php

	require_once ('DB.php');
    
    class GenreModel {
		
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        public function returnGenres()
        {
            $sql = 'SELECT DISTINCT book_genre.genre_id, genres.name FROM book_genre INNER JOIN genres ON book_genre.genre_id=genres.id';
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}