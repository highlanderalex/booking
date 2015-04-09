<?php

	require_once ('DB.php');
    
    /* Class CartModel for cart table
        * *
        * *
        * * @method construct: Create database connection
        * * @method returnProducts: Return assoc array of user product into cart or empty
        * * @method returnCheckId: Return count 1 or 0 
        * * @method returnPriceProduct: Return assoc array of price product
        * * @method returnTotalProduct: Return sum of all products
        * * @method returnTotalPrice: Return sum of price all product
        * * @method insertProductCart: Insert product into cart
        * * @method updateCountProduct: Update count product
        * * @method updateCountCart: Update count product into cart
        * * @method deleteProduct: Delete product into cart
        * * @method deleteCart: Delete cart user
        * */

    class CartModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
    /* returnProduct method
        * *
        * *
        * * @params id: val id user
        * * @return: Retutn assoc array of products from cart or empty
        * */

		public function returnProducts($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('c.idProduct, b.name, c.qty, c.price')
						      ->From('cart c')
							  ->Join('books b')
							  ->On('c.idProduct = b.id')
							  ->Where('c.idUser=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
    /* returnCheckId method
        * *
        * *
        * * @params $id: val idProduct from books
        * * @return: Retutn 1 or 0
        * */

		public function returnCheckId($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('COUNT(idProduct)')
						      ->From('cart')
							  ->Where('idProduct=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
    /* returnPriceProduct method
        * *
        * *
        * * @params id: val id book
        * * @return: Retutn assoc array of price book or empty
        * */

		public function returnPriceProduct($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('price')
						      ->From('books')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
    /* returnTotalProduct method
        * *
        * *
        * * @params idUser: val idUser user
        * * @return: Retutn sum count of products into cart
        * */

		public function returnTotalProduct($iduser)
        {
			$arr['where'] = $iduser;
            $res = $this->inst->Select('SUM(qty) as totalcount')
						      ->From('cart')
							  ->Where('idUser=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
    /* returnTotalPrice method
        * *
        * *
        * * @params idUser: val idUser user
        * * @return: Retutn sum (price*count) all products into cart
        * */

		public function returnTotalPrice($iduser)
        {
			$arr['where'] = $iduser;
            $res = $this->inst->Select('SUM(price*qty) as totalprice')
						      ->From('cart')
							  ->Where('idUser=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
    /* insertProduct method
        * *
        * *
        * * @params arr: val assoc array with key idUser, idProduct, price, qty
        * * @return: Retutn count of changes rows 
        * */

		public function insertProductCart($arr)
        {
			$res = $this->inst->Insert('cart')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
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
			$data['where'] = $arr['idUser'];
			$data['and'] = $arr['idProduct'];
			$res = $this->inst->Update('cart')
						      ->Set('qty=qty+1')
							  ->Where('idUser=')
							  ->I('idProduct=')
							  ->Execute($data);
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
			$data['where'] = $arr['idUser'];
			$data['and'] = $arr['idProduct'];
			$res = $this->inst->Update('cart')
						      ->Set('qty=' . $arr['qty'])
							  ->Where('idUser=')
							  ->I('idProduct=')
							  ->Execute($data);
            return $res;
        }
		
    /* deleteProduct method
        * *
        * *
        * * @params idUser, idProduct: val idUser user, idProduct product
        * * @return: Return count of changes rows
        * */

		public function deleteProduct($iduser, $idproduct)
        {
			$arr['where'] = $iduser;
			$arr['and'] = $idproduct;
            $res = $this->inst->Delete()
						      ->From('cart')
							  ->Where('idUser=')
							  ->I('idProduct=')
							  ->Limit(1)
							  ->Execute($arr);
            return $res; 
        }
		
    /* deleteCart method
        * *
        * *
        * * @params idUser: val idUser user
        * * @return: Return count of changes rows
        * */

		public function deleteCart($iduser)
        {
			$arr['where'] = $iduser;
            $res = $this->inst->Delete()
						      ->From('cart')
							  ->Where('idUser=')
							  ->Execute($arr);
            return $res; 
        }
    }
