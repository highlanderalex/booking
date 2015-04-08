<?php
	//error_reporting (E_ALL);
	//require_once ('libs/func/db_func.php');
	require_once ('libs/func/func.php');
	session_start();
	$view = empty($_GET['view']) ? 'login' : $_GET['view'];
	if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 'admin@mail.ru')
	{
		$view = 'login';
	}
	switch ($view)
	{
		case ('index') : 
				
		break;
		
		case ('login') : 
			if (isset($_POST['login']))
            {
                $form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					$user = new UserController();
					if($user->checkAuth($data))
					{
						$datauser = $user->dataUser($data);
						//$_SESSION['id'] = $datauser['id'];
						$_SESSION['admin'] = $datauser['email'];
						if($_SESSION['admin'] == 'admin@mail.ru')
						{
							redirect('index');
						}
						else
						{
							redirect('login');
						}
					}
					else
					{
						$error = "Неверно ввели имя или пароль<br />";
					}	
				}
				else
				{
					$error = $data;
				}
			}
		break;
		
		case ('logout') : 
			session_destroy();
			//unset($_SESSION['admin']);
			redirect('login');
		break;
		
		case ('author') : 
			$author = new AuthorController();
			$authors = $author->getAuthors();
		break;
		
		case ('book') : 
			$book = new BookController();
			$books = $book->getBooks();
		break;
		
		case ('genre') : 
			$genre = new GenreController();
			$genres = $genre->getGenres();
		break;
		
		case ('user') : 
			if(isset($_POST['updDiscont']))
			{
				$data['idUser'] = $_POST['id'];
				$data['idDiscont'] = $_POST['discont'];
				$user = new UserController();
				$user->updDiscont($data);
				redirect('user');
			}
			
			$user = new UserController();
			$users = $user->getUsers();
			$discont = new DiscontController();
			$alldiscont = $discont->getDisconts();
		break;
		
		case ('order') :
				if (isset($_GET['id']))
				{
					$msg = '';
					$id = $_GET['id'];
					$order = new OrderController();
					$userorders = $order->getOrders($id);
					$status = new StatusController();
					$allstatus = $status->getStatus();
					if ( empty($userorders) )
					{
						$msg = 'Hет заказов';
					}
				}
				
				if(isset($_POST['updStatus']))
				{
					$data['idOrder'] = $_POST['idOrder'];
					$data['idStatus'] = $_POST['status'];
					$order = new OrderController();
					$order->updStatus($data);
					redirect('order&id=' . $_POST['idUser']);
				}
				
		break;
		
		
		
		case ('add') : 
				
		break;
		
		case ('add_obj') : 
			if ( isset($_GET['obj']) )
			{
				$obj = $_GET['obj'];
			}
			else
			{
				redirect('404');
			}
			$author = new AuthorController();
			$authors = $author->getAuthors();
			$genre = new GenreController();
			$genres = $genre->getGenres();			
		break;
		
		case ('ins_obj') : 
			if (isset($_POST['add_genre']))
			{
				$form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					$newgenre = new GenreController();
					if(!$newgenre->checkGenre($data))
					{
						$newgenre->addGenre($data);
						$msg = 'Жанр успешно добавлен';
					}
					else
					{
						$error = 'Жанр не был добавлен';
					}
				} 
				else 
				{
					$error = $data;
				}
			}
			
			if (isset($_POST['add_author']))
			{
				$form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					$newauthor = new AuthorController();
					if(!$newauthor->checkAuthor($data))
					{
						$newauthor->addAuthor($data);
						$msg = 'Автор успешно добавлен';
					}
					else
					{
						$error = 'Автор не был добавлен';
					}
				} 
				else 
				{
					$error = $data;
				}
			}
			if (isset($_POST['add_book']))
			{
				$data['name'] = $_POST['name'];
				$data['price'] = $_POST['price'];
				$data['image'] = $_POST['image'];
				$data['description'] = $_POST['description'];
				$form = new ValidForm($data);
				$data = $form->validData();
				if (is_array($data))
				{
					$data['authors'] = $_POST['authors'];
					$data['genres'] = $_POST['genres'];
					$newbook = new BookController();
					if( $newbook->addBook($data) )
					{
						$error = 'Книга успешно добавлена';
					}
				}
				else
				{
					$error = $data;
				}
			}
		break;
		
		case ('del_obj') :
			if (isset($_GET['id']) && isset($_GET['obj'])) 
			{
				$id = $_GET['id'];
				$obj = $_GET['obj'];
				if( 'author' == $obj )
				{
					$author = new AuthorController();
					if($author->checkAuthorId($id))
					{
						$error = 'Нельзя удалить этого автора';
					}
					else
					{
						$author->removeAuthor($id);
						redirect('author');
					}
				}
				
				if( 'genre' == $obj )
				{
					$genre = new GenreController();
					if($genre->checkGenreId($id))
					{
						$error = 'Нельзя удалить этот жанр';
					}
					else
					{
						$genre->removeGenre($id);
						redirect('genre');
					}
				}
				
				if( 'book' == $obj )
				{
					$book = new BookController();
					if($book->checkBookId($id))
					{
						$error = 'Нельзя удалить эту книгу';
					}
					else
					{
						$book->removeBook($id);
						redirect('book');
					}
				}
			} 
			else
			{
				redirect('404');
			}
		break;
		
		case ('edit') :
			if ( isset($_GET['id']) && $_GET['obj'] == 'book' )
			{
				$id = $_GET['id'];
				$book = new BookController();
				$item = $book->getBook($id);
				$authorsbook = $book->getAuthorsBook($id);
				$genresbook = $book->getGenresBook($id);
				$authors = new AuthorController();
				$allauthors = $authors->getAuthors();
				$genres = new GenreController();
				$allgenres = $genres->getGenres();
			}
			
			if ( isset($_GET['id']) && $_GET['obj'] == 'author' )
			{
				$id = $_GET['id'];
				$author = new AuthorController();
				$item = $author->getAuthor($id);
			}
			
			if ( isset($_GET['id']) && $_GET['obj'] == 'genre' )
			{
				$id = $_GET['id'];
				$genre = new GenreController();
				$item = $genre->getGenre($id);
			}
			
		break;
		
		
		case ('edit_obj') :
			if (isset($_POST['edit_book']))
			{
				
				$data['name'] = $_POST['name'];
				$data['price'] = $_POST['price'];
				$data['image'] = $_POST['image'];
				$data['description'] = $_POST['description'];
				$form = new ValidForm($data);
				$data = $form->validData();
				if (is_array($data))
				{
					$data['id'] = $_POST['id'];
					$data['authors'] = $_POST['authors'];
					$data['genres'] = $_POST['genres'];
					$updbook = new BookController();
					if( $updbook->updateBook($data) )
					{
						$error = 'Книга успешно добавлена';
					}
				}
				else
				{
					$error = $data;
				}
			}
			
			if (isset($_POST['edit_author']))
			{
				$form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					$updauthor = new AuthorController();
					if(!$updauthor->checkAuthor($data))
					{
						$updauthor->updateAuthor($data);
						$error = 'Автор успешно обновлен';
					}
					else
					{
						$error = 'Автор не был обновлен';
					}
				} 
				else 
				{
					$error = $data;
				}
			}
			
			if (isset($_POST['edit_genre']))
			{
				$form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					$updgenre = new GenreController();
					if(!$updgenre->checkGenre($data))
					{
						$updgenre->updateGenre($data);
						$error = 'Жанр успешно обновлен';
					}
					else
					{
						$error = 'Жанр не был обновлен';
					}
				} 
				else 
				{
					$error = $data;
				}
			}
		break;
		
		
		default : 
			redirect('404');
	
	}
	
	require_once 'views/layouts/shop.php';


