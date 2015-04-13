<?php
	class View 
	{
		public function __construct() 
		{
		
		}
	   
	   public function render($name) 
	   {
			$view = $name;
			require_once ('resources/templates/shop.php');
	   }
	  
	}
?>