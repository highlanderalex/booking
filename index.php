<?php
	//error_reporting (E_ALL);
	require_once ('libs/func/func.php');
	session_start();
	sessionRun();
	$translate = new Language($_SESSION['lang']);
	foreach($translate->getTranslate() as $key=>$val)
	{
		$$key = $translate->getLang($key);
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
					if(checkId($id))
					{
						$result = $books->getBooksAuthor($id);
						if(empty($result))
						{
							redirect('404');
						}
					}
					else 
					{
						redirect('404');
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
					if(checkId($_GET['id']))
					{
						$result = $books->getBooksGenre($id);
						if(empty($result))
						{
							redirect('404');
						}
					}
					else 
					{
						redirect('404');
					}
				}
		break;
		
		case ('book') : 
				$books = new BookController();
				if (isset($_GET['id'])) 
				{
					$id = $_GET['id'];
					if(checkId($id))
					{
						$result = $books->getBook($id);
						if(empty($result))
						{
							redirect('404');
						}
					}
					else 
					{
						redirect('404');
					}
				}
				else
				{
					redirect('404');
				}
				$res_author = $books->getAuthorsBook($id);
				$res_genre = $books->getGenresBook($id);
				$item = $books->getBook($id);		
		break;
		
		
		
		case ('cart') :
				if(!$_SESSION['id'])
				{
					redirect('login');
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
					redirect('login');
				}
				else
				{
					if (!isset($_GET['id']) || !checkId($_GET['id'])) 
					{
						redirect('404');
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
							redirect('book&id=' . $id);
						}
						else
						{
							redirect('404');
						}
					}
				}
		break;
		
        case ('updateCart') :
                if ($_POST['updatecart'])
                {
                    $data['idUser'] = $_SESSION['id'];
                    $data['idProduct'] = $_POST['id'];
                    $data['qty'] = $_POST['qty'];
                    $cart = new CartController();
					$cart->updateCountCart($data);
					redirect('cart');
                }
		break;
		
		case ('delFromCart') : 
				if(!$_SESSION['id'])
				{
					redirect('login');
				}
				else
				{
					if (!isset($_GET['id']) || !checkId($_GET['id'])) 
					{
						redirect('404');
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
							redirect('cart');
						}
						else
						{
							redirect('404');
						}
					}
				}
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
						$_SESSION['id'] = $datauser['id'];
						$_SESSION['user'] = $datauser['name'];
						redirect('index');
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
			if (isset($_POST['registration']))
			{
                $form = new ValidForm($_POST);
				$data = $form->validData();
                if (is_array($data))
				{
					$newuser = new UserController();
					if($newuser->checkEmail($data['email']))
					{
						$error = "Такой email уже зарегистрирован в базе<br />";
					}
					else
					{
						if($newuser->insertDb($data))
						{
							redirect('successreg');
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
		    $msg = 'Вы упешно зарегистрированы';
		break;
        
        case ('cabinet') :
		    if(!$_SESSION['id'])
			{
				redirect('login');
			}
			else
			{
				$msg = '';
				$order = new OrderController();
				$userorders = $order->getOrders($_SESSION['id']);
				if ( empty($userorders) )
				{
					$msg = 'У вас нет заказов';
				}
			}
		break;
		
		case ('buy') :
			if(!$_SESSION['id'])
			{
				redirect('login');
			}
			else
			{
				$msg = 'Спасибо за покупку!';
			}
		break;
		
		case ('order') :
		    if(!$_SESSION['id'])
			{
				redirect('login');
			}
			else
			{
				if ( isset($_POST['buy']) )
				{
					$data['idUser'] = $_SESSION['id'];
					$data['idPay'] = $_POST['pay'];
					//var_dump($data);
					$neworder = new OrderController();
					$neworder->addOrder($data);
					$lastId = $neworder->getLastId();
					$food = new PurchaseController();
					$cart = new CartController();
					$data = $cart->getProducts($_SESSION['id']);
					foreach( $data as $item )
					{
						$food->addPurchases($lastId, $item['idProduct'], $item['qty'], $item['price']);
					}
					$cart->removeCart($_SESSION['id']);
					redirect('buy');
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
			}
		break;
		
		case ('destroy') :
			session_destroy();
			//sessionDestroy();
			redirect('index');
		break;
		
		case ('404') :
			$msg = 'Вы наверное заблудились';
		break;
		
		default : 
			redirect('404');
	
	}
	
	require_once ('views/layouts/shop.php');

