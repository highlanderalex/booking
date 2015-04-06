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
            $res = $this->inst->Select('id, name')
						      ->From('authors')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnCountAuthor($data)
        {
			$arr['where'] = $data['name'];
            $res = $this->inst->Select('COUNT(id)')
						      ->From('authors')
							  ->Where('name=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnCountAuthorId($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('COUNT(author_id)')
						      ->From('book_author')
							  ->Where('author_id=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnAuthor($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('id, name')
						      ->From('authors')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function insertAuthor($data)
        {
			$arr['name'] = $data['name'];
			$res = $this->inst->Insert('authors')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
		
		public function updateAuthor($data)
        {
			$arr['where'] = $data['id'];
			$res = $this->inst->Update('authors')
						      ->Set("name='" . $data['name'] . "'")
							  ->Where('id=')
							  ->Execute($arr);
            return $res;
        }
		
		public function deleteAuthor($id)
        {
			$arr['where'] = $id;
			$res = $this->inst->Delete()
						      ->From('authors')
							  ->Where('id=')
							  ->Limit(1)
							  ->Execute($arr);
            return $res;
        }
	}