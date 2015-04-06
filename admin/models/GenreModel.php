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
            $res = $this->inst->Select('id, name')
						      ->From('genres')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnGenre($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('id, name')
						      ->From('genres')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnCountGenre($data)
        {
			$arr['where'] = $data['name'];
            $res = $this->inst->Select('COUNT(id)')
						      ->From('genres')
							  ->Where('name=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnCountGenreId($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('COUNT(genre_id)')
						      ->From('book_genre')
							  ->Where('genre_id=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function insertGenre($data)
        {
			$arr['name'] = $data['name'];
			$res = $this->inst->Insert('genres')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
		
		public function updateGenre($data)
        {
			$arr['where'] = $data['id'];
			$res = $this->inst->Update('genres')
						      ->Set("name='" . $data['name'] . "'")
							  ->Where('id=')
							  ->Execute($arr);
            return $res;
        }
		
		public function deleteGenre($id)
        {
			$arr['where'] = $id;
			$res = $this->inst->Delete()
						      ->From('genres')
							  ->Where('id=')
							  ->Limit(1)
							  ->Execute($arr);
            return $res;
        }
	}