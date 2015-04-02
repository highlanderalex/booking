<?php
	//error_reporting (E_ALL);
	require_once ('libs/func/func.php');
	require_once ('libs/class/ValidForm.php');
	session_start();
	if (!isset($_SESSION['id']))
	{
		//$_SESSION['cart'] = array();
		$_SESSION['total_items'] = 0;
		$_SESSION['total_price'] = '0.00';
	} 
	else
	{
		$cart = new CartController();
		$price = $cart->getTotalPrice($_SESSION['id']);
		$cnt = $cart->getTotalProduct($_SESSION['id']);
		$_SESSION['total_items'] = ($cnt['totalcount']) ? $cnt['totalcount'] : 0;
		$_SESSION['total_price'] = ($price['totalprice']) ? $price['totalprice'] : '0.00';
	}
	
	$view = empty($_GET['view']) ? 'index' : $_GET['view'];

	switch ($view)
	{
		case ('index') : 
				$books = new BookController();
				$result = $books->getBooks();
		break;
		
		case ('author') : 
				$books = new BookController();
				$author = new AuthorController();
				$authors = $author->getAuthors();
				
				if (!isset($_GET['id'])) {
					$result = $books->getBooks();	
				} 
				else 
				{
					$id = $_GET['id'];
					if(preg_match("/^[0-9]+$/",$id) && $id > 0)
					{
						$result = $books->getBooksAuthor($id);
						if(empty($result))
						{
							exit('404 PAGE NOT FOUND');
						}
					}
					else 
					{
						exit('404 PAGE NOT FOUND');
					}
					
				}
		break;
		
		case ('genre') : 
				$books = new BookController();
				$genre = new GenreController();
				$genres = $genre->getGenres();
				
				if (!isset($_GET['id'])) 
				{
					$result = $books->getBooks();
				} 
				else 
				{
					$id = $_GET['id'];
					if(preg_match("/^[0-9]+$/",$id) && $id > 0)
					{
						$result = $books->getBooksGenre($id);
						if(empty($result))
						{
							exit('404 PAGE NOT FOUND');
						}
					}
					else 
					{
						exit('404 PAGE NOT FOUND');
					}
				}
		break;
		
		case ('book') : 
				$books = new BookController();
				if (isset($_GET['id'])) 
				{
					$id = $_GET['id'];
					if(preg_match("/^[0-9]+$/",$id) && $id > 0)
					{
						$result = $books->getBook($id);
						if(empty($result))
						{
							exit('404 PAGE NOT FOUND');
						}
					}
					else 
					{
						exit('404 PAGE NOT FOUND');
					}
				}
				else
				{
					exit('404 PAGE NOT FOUND');
				}
				$res_author = $books->getAuthorsBook($id);
				$res_genre = $books->getGenresBook($id);
				$item = $books->getBook($id);		
		break;
		
		
		
		case ('cart') :
				if(!$_SESSION['id'])
				{
					header('Location: index.php?view=login');
				}
				else
				{
					$cartproducts = new CartController();
					$products = $cartproducts->getProducts($_SESSION['id']);
				}
		break;
		
		case ('addToCart') : 
				
				if(!$_SESSION['id'])
				{
					header('Location: index.php?view=login');
				}
				else
				{
					if (!isset($_GET['id']) || !preg_match("/^[0-9]+$/",$_GET['id']) || $_GET['id'] <= 0) 
					{
						exit('404 PAGE NOT FOUND');
					}
					else
					{
						$id = $_GET['id'];
						$books = new BookController();
						$result = $books->getBook($id);
						if(!empty($result))
						{
							$addcart = new CartController();
							$data['idUser'] = $_SESSION['id'];
							$data['idProduct'] = $id;
							if($addcart->checkIdProduct($id))
							{
								$addcart->updateCountProduct($data);
							}
							else
							{
								$item = $addcart->getPriceProduct($id);
								$data['price'] = $item['price'];
								$data['qty'] = 1;
								$addcart->addProductCart($data);
							}
							header('Location: index.php?view=book&id=' . $id);
						}
						else
						{
							exit('404 PAGE NOT FOUND');	
						}
					}
				}
		break;
		
		case ('updateCart') : 
				updateCart();
				//$books = new bookController();
				//$_SESSION['total_items'] = totalItems($_SESSION['cart']);
				//$_SESSION['total_price'] = totalPrice($_SESSION['cart'], $books);
				header('Location: index.php?view=cart');
		break;
		
		case ('delFromCart') : 
				if(!$_SESSION['id'])
				{
					header('Location: index.php?view=login');
				}
				else
				{
					if (!isset($_GET['id']) || !preg_match("/^[0-9]+$/",$_GET['id']) || $_GET['id'] <= 0) 
					{
						exit('404 PAGE NOT FOUND');
					}
					else
					{
						$id = $_GET['id'];
						$books = new BookController();
						$result = $books->getBook($id);
						if(!empty($result))
						{
							$delproduct = new CartController();
							$delproduct->removeProductCart($_SESSION['id'], $id);
							header('Location: index.php?view=cart');
						}
						else
						{
							exit('404 PAGE NOT FOUND');
						}
					}
				}
		break;
		
		case ('login') : 
			if ($_POST['login'])
            {
                $form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					//$data['password'] = hashPassword($data['password']);
					$user = new UserController();
					if($user->checkAuth($data))
					{
						$datauser = $user->dataUser($data);
						$_SESSION['id'] = $datauser['id'];
						$_SESSION['user'] = $datauser['name'];
						header('Location: index.php?view=index');
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
		
		case ('registration') : 
			if ($_POST['registration'])
			{
                $form = new ValidForm($_POST);
				$data = $form->validData();
				//$data = validRegistration($_POST);
				if (is_array($data))
				{
					$newuser = new UserController();
					if($newuser->checkEmail($data['email']))
					{
						$error = "Такой email уже зарегистрирован в базе<br />";
					}
					else
					{
						//$data['password'] = hashPassword($data['password']);
						if($newuser->insertDb($data))
						{
							header('Location: index.php?view=successreg');
						}
						else
						{
							$error = "Ошибка добавления в базу<br />";
						}
					}
				}
				else
				{
					$error = $data;
				}
			}
		break;
		
		case ('successreg') :
		
		break;
        
        case ('cabinet') :
		    $msg = "Orders";
		break;
		
		case ('order') :
		    if(!$_SESSION['id'])
			{
				header('Location: index.php?view=login');
			}
			else
			{
				$cart = new CartController();
				$pay = new PaymentController();
				$user = new UserController();
				$data = $user->getDiscont($_SESSION['id']);
				$discont = $data['discont'];
				$products = $cart->getProducts($_SESSION['id']);
				$payment = $pay->getPayment();
			}
		break;
		
		case ('destroy') :
			session_destroy();
			header('Location: index.php?view=index');
		break;
		
		default : exit('404 PAGE NOT FOUND');
	
	}
	
	require_once ('views/layouts/shop.php');

