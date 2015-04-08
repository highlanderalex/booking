<?php
    include 'CartModel.php';
    
    class TestCartModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnProducts()
        {
            $products = new CartModel();
            $this->assertTrue(is_array());
        }
        
        public function testreturnCheckId()
        {
            $product = new CartModel();
            $id = 5;
            $this->assertTrue();
        }
        
        public function testreturnPriceProduct()
        {
            $product = new CartModel();
            $id = 3;
            $this->assertTrue();
        }
        
        public function testreturnTotalProduct()
        {
            $products = new CartModel();
            $id = 4;
            $this->assertTrue();
        }
		
		public function testreturnTotalPrice()
        {
            $products = new CartModel();
            $id = 4;
            $this->assertTrue();
        }
        
        public function testinsertProductCart()
        {
            $product = new CartModel();
            $id = 2;
            $this->assertTrue();
        }
        
        public function testupdateCountProduct()
        {
            $product = new CartModel();
            $id = 3;
            $this->assertTrue();
        }
		
		public function testupdateCountCart()
        {
            $product = new CartModel();
            $id = 3;
            $this->assertTrue();
        }
		
		public function testdeleteProduct()
        {
            $product = new CartModel();
            $id = 3;
            $this->assertTrue();
        }
         
    }

?>
