<?php

	require_once ('DB.php');
    
   /* Class GenreModel for table of genres.
       * *
       * *
       * * @method construct: Create connection database
       * * @method returnGenres: The return assoc array of genres or empty array
       * */

    class GenreModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        /* returnGenres method
            * *
            * *
            * * @param: no params
            * * @return: Retutn assoc array of genres or empty
            * */

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
