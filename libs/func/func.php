<?php

	function __autoload($class)
    {
        if (file_exists(dirname(__FILE__) . '/../../controllers/'.$class.'.php') ) 
        {
			require_once (dirname(__FILE__) . '/../../controllers/'.$class.'.php');
		}
    }
	
	
	function addToCart($id) 
	{
		if (isset($_SESSION['cart'][$id])) 
		{
			$_SESSION['cart'][$id]++;
			return true;
		}
		else 
		{
			$_SESSION['cart'][$id] = 1;
			return true;
		}
		return false;
	}
	
	function updateCart() 
	{
		foreach($_SESSION['cart'] as $id => $qty)
		{
			if ('0' == $_POST[$id]) 
			{
				unset($_SESSION['cart'][$id]);
			}
			else 
			{
				$_SESSION['cart'][$id] = $_POST[$id];
			}
		}
	}
	
	function delFromCart($id) 
	{
		unset($_SESSION['cart'][$id]);	
	}
	
	function totalItems($cart) 
	{
		$cnt = 0;
		if (is_array($cart))
		{
			foreach($cart as $id => $qty)
			{
				$cnt += $qty;
			}
		}
		return $cnt;
	}
	
	function totalPrice($cart, $books) 
	{
		$total = 0.0;
		if (is_array($cart))
		{
			foreach($cart as $id => $qty)
			{
				$item = $books->getBook($id);
				$total += $item['price']*$qty;
			}
		}
		return number_format($total, 2);
	}
	
	
	
