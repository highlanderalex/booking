<?php

	require_once ('DB.php');
    
    class GenreModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
		public function returnGenres()
        {
            $res = $this->inst->Select('DISTINCT book_genre.genre_id, genres.name')
						      ->From('book_genre')
							  ->InnerJoin('genres')
							  ->On('book_genre.genre_id=genres.id')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}