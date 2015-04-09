<?php

    require_once ('DB.php');

   /* Class AuthorModel for table of authors.
       * *
       * *
       * * @method construct: Create connection database
       * * @method returnAuthors: The return assoc array of authors or empty array
       * */

    class AuthorModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
        }

        /* returnAuthors method
            * *
            * *
            * * @param: no params
            * * @return: Retutn assoc array of authors or empty
            * */

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
