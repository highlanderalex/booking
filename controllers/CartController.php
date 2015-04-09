<?php
    
	require_once (dirname(__FILE__).'/../models/CartModel.php');
    
    /* Class CartController for CartModel
        * *
        * *
        * * @method construct: Create object model
        * * @method getProducts: Return assoc array of user product into cart or empty
        * * @method checkIdProduct: Return count 1 or 0 
        * * @method getPriceProduct: Return assoc array of price product
        * * @method getTotalProduct: Return sum of all products
        * * @method getTotalPrice: Return sum of price all product
        * * @method addProductCart: Insert product into cart
        * * @method updateCountProduct: Update count product
        * * @method updateCountCart: Update count product into cart
        * * @method removeProduct: Delete product into cart
        * * @method removeCart: Delete cart user
        * */

    class CartController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new CartModel();
		}
        
    /* checkIdProduct method
        * *
        * *
        * * @params $id: val idProduct from books
        * * @return: Retutn 1 or 0
        * */

        public function checkIdProduct($id)
        {
            $res = $this->model->returnCheckId($id);
            return $res;
        }
		
    /* getPriceProduct method
        * *
        * *
        * * @params id: val id book
        * * @return: Retutn assoc array of price book or empty
        * */

		public function getPriceProduct($id)
        {
            $res = $this->model->returnPriceProduct($id);
            return $res;
        }
		
    /* getProducts method
        * *
        * *
        * * @params id: val id user
        * * @return: Retutn assoc array of products from cart or empty
        * */

		public function getProducts($id)
        {
            $res = $this->model->returnProducts($id);
            return $res;
        }
		
    /* addProductCart method
        * *
        * *
        * * @params arr: val assoc array with key idUser, idProduct, price, qty
        * * @return: Retutn count of changes rows 
        * */

		public function addProductCart($arr)
        {
            $res = $this->model->insertProductCart($arr);
            return $res;
        }
		
    /* updateCountProduct method
        * *
        * *
        * * @params arr:val arr with keys where(idUser), and(idProduct)
        * * @return: Return count of change rows
        * */

		public function updateCountProduct($arr)
        {
            $res = $this->model->updateCountProduct($arr);
            return $res;
        }
        
    /* updateCountCart method
        * *
        * *
        * * @params arr:val array with keys where(idUser), and(idProduct)
        * * @return: Return count of changes rows
        * */

        public function updateCountCart($arr)
        {
            $res = $this->model->updateCountCart($arr);
            return $res;
        }
		
    /* removeProductCart method
        * *
        * *
        * * @params idUser, idProduct: val idUser user, idProduct product
        * * @return: Return count of changes rows
        * */

		public function removeProductCart($iduser, $idproduct)
        {
            $res = $this->model->deleteProduct($iduser, $idproduct);
            return $res;
        }
		
    /* removeCart method
        * *
        * *
        * * @params idUser: val idUser user
        * * @return: Return count of changes rows
        * */

		public function removeCart($iduser)
        {
            $res = $this->model->deleteCart($iduser);
            return $res;
        }
		
    /* getTotalProduct method
        * *
        * *
        * * @params idUser: val idUser user
        * * @return: Retutn sum count of products into cart
        * */

		public function getTotalProduct($iduser)
        {
            $res = $this->model->returnTotalProduct($iduser);
            return $res;
        }
		
    /* getTotalPrice method
        * *
        * *
        * * @params idUser: val idUser user
        * * @return: Retutn sum (price*count) all products into cart
        * */

		public function getTotalPrice($iduser)
        {
            $res = $this->model->returnTotalPrice($iduser);
            return $res;
        }
		
		
		
    }

