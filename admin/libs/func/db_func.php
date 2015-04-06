<?php

	require_once (dirname(__FILE__)) . '/../../config/config.php';
	
	$connection = new config();
	$connection->connect_db();
	
	//
	//Проверка результата запроса
	function check_error($result) {
	
		if(!$result) die("Error SQL query".mysql_error());
		
	}
	
	//
	//Выборка книг 
	function get_books() {
		
		$query = 'SELECT * FROM books';
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
	//
	//Информация о конкретной книге
	function get_book($id) {
		
		$query = 'SELECT * FROM books WHERE id='.$id;
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
	//
	//Выборка авторов 
	function authors() {
	
		$query = 'SELECT * FROM authors ORDER BY id ASC';
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
	//
	//Информация об авторе 
	function get_author($id) {
	
		$query = 'SELECT * FROM authors WHERE id='.$id;
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
	//
	//Выборка жанров
	function genres() {
	
		$query = 'SELECT * FROM genres ORDER BY id ASC';
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
	//
	//Информация о жанре
	function get_genre($id) {
	
		$query = 'SELECT * FROM genres WHERE id='.$id;
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
	//
	//Список авторов одной книги
	function get_book_authors($id) {
	
		$query = 'SELECT authors.id, authors.name FROM authors INNER JOIN book_author ON book_author.author_id=authors.id WHERE book_author.book_id='.$id.' ORDER BY authors.id ASC';
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}

	//
	//Список жанров одной книги
	function get_book_genres($id) {
	
		$query = 'SELECT genres.id, genres.name FROM genres INNER JOIN book_genre ON book_genre.genre_id=genres.id WHERE book_genre.book_id='.$id.' ORDER BY genres.id ASC';
		$result = mysql_query($query);
		check_error($result);
		return $result;
		
	}
	
				//Обновление
	
	//Обновить автора
	function update_author($name, $id) {
		
		$str = "UPDATE authors SET name='{$name}' WHERE id='{$id}'";
		$result = mysql_query($str);
		return $result;	
	}
	
	//Обновить жанр
	function update_genre($name, $id) {
		
		$str = "UPDATE genres SET name='{$name}' WHERE id='{$id}'";
		$result = mysql_query($str);
		return $result;	
	}
	
	//Обновить книгу
	function update_book($id, $author, $genre, $name, $price, $image, $description) {
		
		$str = 'START TRANSACTION';
		$flag = true;
		mysql_query($str);
		$str = 'DELETE FROM book_author WHERE book_id='.$id;
		$result = mysql_query($str);
		if (!$result) $flag = false;
		
		foreach ($author as $key => $val)
		{
			$str = "INSERT INTO book_author (book_id, author_id) VALUES ('{$id}', '{$author[$key]}')";
			$result = mysql_query($str);
			if (!$result) $flag = false;
		}
		
		$str = 'DELETE FROM book_genre WHERE book_id='.$id;
		$result = mysql_query($str);
		if (!$result) $flag = false;
		
		foreach ($genre as $key => $val)
		{
			$str = "INSERT INTO book_genre (book_id, genre_id) VALUES ('{$id}', '{$genre[$key]}')";
			$result = mysql_query($str);
			if (!$result) $flag = false;
		}
		
		$str = "UPDATE books SET name='{$name}', price='{$price}', image='{$image}', description='{$description}' WHERE id='{$id}'";
		$result = mysql_query($str);
		if (!$result) $flag = false;
		if (!$flag) {
			$str = 'ROLLBACK';
			mysql_query($str);
			exit ('Книга не была обновлена"');
		}	else {
			$str = 'COMMIT';
			mysql_query($str);
			echo "Книга была обновлена";
		}
		
	}
	
	
				//Удаление
	
	//Удалить книгу
	function del_book($id) {
		
		$str = 'START TRANSACTION';
		$flag = true;
		mysql_query($str);
		$str = 'DELETE FROM book_author WHERE book_id='.$id;
		$result = mysql_query($str);
		if (!$result) $flag = false;
		$str = 'DELETE FROM book_genre WHERE book_id='.$id;
		$result = mysql_query($str);
		if (!$result) $flag = false;
		$str = 'DELETE FROM books WHERE id='.$id;
		$result = mysql_query($str);
		if (!$result) $flag = false;
		if (!$flag) {
			$str = 'ROLLBACK';
			mysql_query($str);
			exit ('Книга не была удалена"');
		}	else {
			$str = 'COMMIT';
			mysql_query($str);
			echo "Книга была удалена";
		}
		
	}
	
	//Удалить автора
	function del_author($id) {
		
		$str = 'DELETE FROM authors WHERE id='.$id;
		$result = mysql_query($str);
		return $result;
	}
	
	//Удалить жанр
	function del_genre($id) {
		
		$str = 'DELETE FROM genres WHERE id='.$id;
		$result = mysql_query($str);
		return $result;
	}
	
		//Добавление данных
	
	//Добавление автора
	function add_author($name) {
	
		$str = "INSERT INTO authors (name) VALUES ('{$name}')";
		$result = mysql_query($str);
		return $result;
		
	}
	
	//Добавление жанра
	function add_genre($name) {
	
		$str = "INSERT INTO genres (name) VALUES ('{$name}')";
		$result = mysql_query($str);
		return $result;
		
	}
	
	//Добавить книгу
	function add_book($author, $genre, $name, $price, $image, $description) {
		
		$str = 'START TRANSACTION';
		$flag = true;
		mysql_query($str);
		$str = "INSERT INTO books (name, price, image, description) VALUES ('{$name}', '{$price}', '{$image}', '{$description}')";
		$result = mysql_query($str);
		if (!$result) $flag = false;
		$id = mysql_insert_id();
		
		foreach ($author as $key => $val)
		{
			$str = "INSERT INTO book_author (book_id, author_id) VALUES ('{$id}', '{$author[$key]}')";
			$result = mysql_query($str);
			if (!$result) $flag = false;
		}
		
		foreach ($genre as $key => $val)
		{
			$str = "INSERT INTO book_genre (book_id, genre_id) VALUES ('{$id}', '{$genre[$key]}')";
			$result = mysql_query($str);
			if (!$result) $flag = false;
		}
		
		if (!$flag) {
			$str = 'ROLLBACK';
			mysql_query($str);
			exit ('Книга не была добавлена"');
		}	else {
			$str = 'COMMIT';
			mysql_query($str);
			echo "Книга была добавлена";
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
