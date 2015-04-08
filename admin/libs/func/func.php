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
