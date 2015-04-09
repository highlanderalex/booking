<?php
    
	require_once (dirname(__FILE__).'/../models/GenreModel.php');
    
   /* Class GenreModel for table of genres.
       * *
       * *
       * * @method construct: Create object model
       * * @method getGenres: The return assoc array of genres or empty array
       * */

    class GenreController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new GenreModel();
		}
        
        /* getGenres method
            * *
            * *
            * * @param: no params
            * * @return: Retutn assoc array of genres or empty
            * */

        public function getGenres()
        {
            $res = $this->model->returnGenres();
            return $res;
        }
	}
