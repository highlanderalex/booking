<?php
    
	require_once (dirname(__FILE__).'/../models/CartModel.php');
    
    class CartController {
	
		private $model;
		
		public function __construct()
		{
			$this->model = new CartModel();
		}
        
        public function checkIdProduct($id)
        {
            $res = $this->model->returnCheckId($id);
            return $res;
        }
		
		public function getPriceProduct($id)
        {
            $res = $this->model->returnPriceProduct($id);
            return $res;
        }
		
		public function getProducts($id)
        {
            $res = $this->model->returnProducts($id);
            return $res;
        }
		
		public function addProductCart($arr)
        {
            $res = $this->model->insertProductCart($arr);
            return $res;
        }
		
		public function updateCountProduct($arr)
        {
            $res = $this->model->updateCountProduct($arr);
            return $res;
        }
		
		public function removeProductCart($iduser, $idproduct)
        {
            $res = $this->model->deleteProduct($iduser, $idproduct);
            return $res;
        }
		
		public function getTotalProduct($iduser)
        {
            $res = $this->model->returnTotalProduct($iduser);
            return $res;
        }
		
		public function getTotalPrice($iduser)
        {
            $res = $this->model->returnTotalPrice($iduser);
            return $res;
        }
		
		
		
    }

