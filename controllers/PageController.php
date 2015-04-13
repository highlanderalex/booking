<?php
    
    class PageController 
	{
		private $view;
		
		public function __construct()
		{
			$this->view = new View();
			sessionRun();
			$translate = new Language($_SESSION['lang']);
			foreach($translate->getTranslate() as $key=>$val)
			{
				$this->view->$key = $translate->getLang($key);
			}
		}
		
		public function index()
		{		
			$books = new BookController();
			$this->view->result = $books->getBooks();
			$this->view->render('index');
		}
		
		public function error()
		{		
			$this->view->render('404');
		}
		
		public function author()
		{
			$books = new BookController();
			$author = new AuthorController();
			$this->view->authors = $author->getAuthors();
				
			if (!isset($_GET['id'])) 
			{
				$this->view->result = $books->getBooks();	
			} 
			else 
			{
				$id = $_GET['id'];
				if(checkId($id))
				{
					$this->view->result = $books->getBooksAuthor($id);
					if(empty($this->view->result))
					{
						$this->view->render('404');
					}
				}
				else 
				{
					$this->view->render('404');
				}
					
			}
			$this->view->render('author');
		}
		
		public function genre()
		{
			$books = new BookController();
			$genre = new GenreController();
			$this->view->genres = $genre->getGenres();
				
			if (!isset($_GET['id'])) 
			{
				$this->view->result = $books->getBooks();
			} 
			else 
			{
				$id = $_GET['id'];
				if(checkId($_GET['id']))
				{
					$this->view->result = $books->getBooksGenre($id);
					if(empty($this->view->result))
					{
						$this->view->render('404');
					}
				}
				else 
				{
					$this->view->render('404');
				}
			}
			$this->view->render('genre');
		}
		
		public function book()
		{
			$books = new BookController();
				if (isset($_GET['id'])) 
				{
					$id = $_GET['id'];
					if(checkId($id))
					{
						$this->view->result = $books->getBook($id);
						if(empty($this->view->result))
						{
							$this->view->render('404');
						}
					}
					else 
					{
						$this->view->render('404');
					}
				}
				else
				{
					$this->view->render('404');
				}
				$this->view->res_author = $books->getAuthorsBook($id);
				$this->view->res_genre = $books->getGenresBook($id);
				$this->view->item = $books->getBook($id);
				$this->view->render('book');
		}
		
		public function login()
		{
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
						$this->view->error = "Неверно ввели имя или пароль<br />";
					}	
				}
				else
				{
					$this->view->error = $data;
				}
			}
			$this->view->render('login');
		}
		
		public function registration()
		{
			if (isset($_POST['registration']))
			{
                $form = new ValidForm($_POST);
				$data = $form->validData();
                if (is_array($data))
				{
					$newuser = new UserController();
					if($newuser->checkEmail($data['email']))
					{
						$this->view->error = "Такой email уже зарегистрирован в базе<br />";
					}
					else
					{
						if($newuser->insertDb($data))
						{
							redirect('successreg');
						}
						else
						{
							$this->view->error = "Ошибка добавления в базу<br />";
						}
					}
				}
				else
				{
					$this->view->error = $data;
				}
			}
			$this->view->render('registration');
		}
		public function successreg()
		{
			$this->view->msg = 'Вы упешно зарегистрированы';
			$this->view->render('successreg');
		}
		
		public function destroy()
		{
			session_destroy();
			//sessionDestroy();
			redirect('index');
		}
		
		public function cabinet()
		{
			if(!$_SESSION['id'])
			{
				redirect('login');
			}
			else
			{
				$msg = '';
				$order = new OrderController();
				$this->view->userorders = $order->getOrders($_SESSION['id']);
				if ( empty($this->view->userorders) )
				{
					$this->view->msg = 'У вас нет заказов';
				}
			}
			$this->view->render('cabinet');
		}
		
		public function buy()
		{
			if(!$_SESSION['id'])
			{
				redirect('login');
			}
			else
			{
				$this->view->msg = 'Спасибо за покупку!';
			}
			$this->view->render('buy');
		}
		
		public function order()
		{
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
					$this->view->discont = $data['discont'];
					$this->view->products = $cart->getProducts($_SESSION['id']);
					$this->view->payment = $pay->getPayment();
				}
			}
			$this->view->render('order');
		}
		
		public function cart()
		{
			if(!$_SESSION['id'])
			{
				redirect('login');
			}
			else
			{
				$cartproducts = new CartController();
				$this->view->products = $cartproducts->getProducts($_SESSION['id']);
			}
			$this->view->render('cart');
		}
		
		public function addToCart()
		{
			if(!$_SESSION['id'])
				{
					redirect('login');
				}
				else
				{
					if (!isset($_GET['id']) || !checkId($_GET['id'])) 
					{
						$this->view->render('404');
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
							$this->view->render('404');
						}
					}
				}
		}
		
		public function updateCart()
		{
			if ($_POST['updatecart'])
			{
                $data['idUser'] = $_SESSION['id'];
                $data['idProduct'] = $_POST['id'];
                $data['qty'] = $_POST['qty'];
                $cart = new CartController();
				$cart->updateCountCart($data);
				redirect('cart');
            }
		}
		
		public function delFromCart()
		{
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
		}
    }

