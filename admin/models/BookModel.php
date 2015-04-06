<?php

	require_once ('DB.php');
    
    class BookModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
		public function returnBooks()
        {
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnBook($id)
        {
            $arr['where'] = $id;
			$res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnBooksFromAuthor($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->InnerJoin('book_author')
							  ->On('book_author.book_id=books.id')
							  ->Where('book_author.author_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnAuthorsFromBook($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('authors.id, authors.name')
						      ->From('authors')
							  ->InnerJoin('book_author')
							  ->On('book_author.author_id=authors.id')
							  ->Where('book_author.book_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnBooksFromGenre($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('id, name, description, image, price')
						      ->From('books')
							  ->InnerJoin('book_genre')
							  ->On('book_genre.book_id=books.id')
							  ->Where('book_genre.genre_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnGenresFromBook($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('genres.id, genres.name')
						      ->From('genres')
							  ->InnerJoin('book_genre')
							  ->On('book_genre.genre_id=genres.id')
							  ->Where('book_genre.book_id=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnCountBookId($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('COUNT(idProduct)')
						      ->From('purchases')
							  ->Where('idProduct=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function insertBook($data)
		{
			$arr['name'] = $data['name'];
			$arr['price'] = $data['price'];
			$arr['image'] = $data['image'];
			$arr['description'] = $data['description'];
			$author = $data['authors'];
			$genre = $data['genres'];
			try 
			{  
				$this->inst->StartTransaction();
				$res = $this->inst->Insert('books')
								  ->Fields($arr)
								  ->Values($arr)
								  ->Execute();
				$id = $this->inst->lastId();
				foreach ($author as $val)
				{
					$auth['book_id'] = $id;
					$auth['author_id'] = $val;
					$res = $this->inst->Insert('book_author')
									  ->Fields($auth)
								      ->Values($auth)
								      ->Execute();
				}
				foreach ($genre as $val)
				{
					$gen['book_id'] = $id;
					$gen['genre_id'] = $val;
					$res = $this->inst->Insert('book_genre')
									  ->Fields($gen)
								      ->Values($gen)
								      ->Execute();
				}
				$this->inst->Commit();
				return $res;
				  
			} 
			catch (Exception $e) 
			{
				$this->inst->RollBack();
				echo $e->getMessage();
			}
		}
		//DELETE FROM book_author WHERE book_id=
		//INSERT INTO book_author (book_id, author_id) VALUES ('{$id}', '{$author[$key]}')";
		//DELETE FROM book_genre WHERE book_id=
		//INSERT INTO book_genre (book_id, genre_id) VALUES ('{$id}', '{$genre[$key]}')
		//UPDATE books SET name='{$name}', price='{$price}', image='{$image}', description='{$description}' WHERE id='{$id}'
		public function updateBook($data)
		{
			$name = $data['name'];
			$price = $data['price'];
			$image = $data['image'];
			$description = $data['description'];
			$author = $data['authors'];
			$genre = $data['genres'];
			$arr['where'] = $data['id'];
			try 
			{  
				$this->inst->StartTransaction();
				$res = $this->inst->Delete()
								  ->From('book_author')
							      ->Where('book_id=')
								  ->Execute($arr);
				foreach ($author as $val)
				{
					$auth['book_id'] = $data['id'];
					$auth['author_id'] = $val;
					$res = $this->inst->Insert('book_author')
									  ->Fields($auth)
								      ->Values($auth)
								      ->Execute();
				}
				$res = $this->inst->Delete()
								  ->From('book_genre')
							      ->Where('book_id=')
								  ->Execute($arr);
				foreach ($genre as $val)
				{
					$gen['book_id'] = $data['id'];
					$gen['genre_id'] = $val;
					$res = $this->inst->Insert('book_genre')
									  ->Fields($gen)
								      ->Values($gen)
								      ->Execute();
				}
				$res = $this->inst->Update('books')
						      ->Set("name='" . $data['name'] . "', price=" . $data['price'] . ", image='" . $data['image'] . "', description='" . $data['description'] . "'")
							  ->Where('id=')
							  ->Execute($arr);
				$this->inst->Commit();
				return $res;
				  
			} 
			catch (Exception $e) 
			{
				$this->inst->RollBack();
				echo $e->getMessage();
			}
		}
		
		public function deleteBook($id)
		{
			$arr['where'] = $id;
			try 
			{  
				$this->inst->StartTransaction();
				$res = $this->inst->Delete()
								  ->From('book_author')
							      ->Where('book_id=')
								  ->Execute($arr);
				$res = $this->inst->Delete()
								  ->From('book_genre')
							      ->Where('book_id=')
								  ->Execute($arr);
				$res = $this->inst->Delete()
								  ->From('books')
							      ->Where('id=')
								  ->Execute($arr);
				$this->inst->Commit();
				return $res;
				  
			} 
			catch (Exception $e) 
			{
				$this->inst->RollBack();
				echo $e->getMessage();
			}
		}
    }