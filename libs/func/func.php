<?php
		function __autoload($class)
		{
			if (file_exists(dirname(__FILE__) . '/../../controllers/'.$class.'.php') ) 
			{
				require_once (dirname(__FILE__) . '/../../controllers/'.$class.'.php');
			}
			
			if (file_exists(dirname(__FILE__) . '/../class/'.$class.'.php') ) 
			{
				require_once (dirname(__FILE__) . '/../class/'.$class.'.php');
			}
			
			if (file_exists(dirname(__FILE__) . '/../../views/'.$class.'.php') ) 
			{
				require_once (dirname(__FILE__) . '/../../views/'.$class.'.php');
			}
		}
	
		function redirect($view)
		{
			header('Location: index.php?view=' . $view);
		}
		
		function checkId($id)
		{
			if( preg_match("/^[0-9]+$/",$id) && $id > 0 )
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
	
		function sessionRun()
		{
			if (!isset($_SESSION['id']))
			{
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
		
			$_SESSION['lang'] = ($_SESSION['lang']) ? $_SESSION['lang'] : 'ru';
			if (isset($_POST['change_lang']))
			{
				$_SESSION['lang'] = $_POST['lang'];
			}
		}
		
		function sessionDestroy()
		{
			unset($_SESSION['id']);
			unset($_SESSION['user']);
			unset($_SESSION['total_items']);
			unset($_SESSION['total_price']);
		}
	
	
	
	
	
