<?php
    include 'CartModel.php';
    
    class TestCartModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnProducts()
        {
            $products = new CartModel();
            $id = 2;
            $this->assertTrue(is_array($products->returnProducts($id)));
            $this->assertFalse(empty($products->returnProducts($id)));
        }
        
        public function testreturnCheckId()
        {
            $product = new CartModel();
            $id = 5;
            $this->assertTrue( $product->returnCheckId($id) == 1 );
            $this->assertFalse( $product->returnCheckId($id) == 0 );

        }
        
        public function testreturnPriceProduct()
        {
            $product = new CartModel();
            $id = 3;
            $this->assertTrue(is_array($product->returnPriceProduct($id)) || empty($product->returnPriceProduct($id)));
        }
        
        public function testreturnTotalProduct()
        {
            $products = new CartModel();
            $id = 4;
            $this->assertTrue(is_array($products->returnTotalProduct($id)));
            $this->assertFalse(empty($products->returnTotalProduct($id)));
        }
		
		public function testreturnTotalPrice()
        {
            $products = new CartModel();
            $id = 4;
            $this->assertTrue(is_array($products->returnTotalPrice($id)));
        }
        
        public function testinsertProductCart()
        {
            $product = new CartModel();
            $arr['idProduct'] = 2;
            $arr['qty'] = 2;
            $arr['idUser'] = 2;
            $this->assertTrue( $product->insertProductCart($arr) > 0 );
        }
        
        public function testupdateCountProduct()
        {
            $product = new CartModel();
            $arr['idProduct'] = 2;
            $arr['idUser'] = 2;
            $this->assertTrue( $product->updateCountProduct($arr) > 0 );
        }
		
		public function testupdateCountCart()
        {
            $product = new CartModel();
            $arr['idProduct'] = 2;
            $arr['idUser'] = 2;
            $arr['qty'] = 10;
            $this->assertTrue( $product->updateCountCart($arr) > 0 );
        }
		
		public function testdeleteProduct()
        {
            $product = new CartModel();
            $idUser = 2;
            $idProduct = 2;
            $this->assertTrue( $product->deleteProduct($idUser, $idProduct) > 0 );
        }

		public function testdeleteCart()
        {
            $product = new CartModel();
            $idUser = 2;
            $this->assertTrue( $product->deleteCart($idUser) > 0 );
        }
         
    }

?>
