<?php

	require_once ('DB.php');
    
    class CartModel {
	
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        public function returnProducts($id)
        {
            $sql = 'SELECT c.idProduct, b.name, c.qty, c.price FROM cart c JOIN books b ON c.idProduct = b.id WHERE c.idUser=' . $id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnCheckId($id)
        {
            $sql = 'SELECT COUNT(idProduct) FROM cart WHERE idProduct=' . $id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnPriceProduct($id)
        {
            $sql = 'SELECT price FROM books WHERE id=' . $id;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnTotalProduct($iduser)
        {
            $sql = 'SELECT SUM(qty) as totalcount FROM cart WHERE idUser=' . $iduser;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnTotalPrice($iduser)
        {
            $sql = 'SELECT SUM(price*qty) as totalprice FROM cart WHERE idUser=' . $iduser;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function insertProductCart($arr)
        {
			$idUser = $arr['idUser'];
			$idProduct = $arr['idProduct'];
			$qty = $arr['qty'];
			$price = $arr['price']; 
            $sql = "INSERT INTO cart (idUser, idProduct, qty, price) VALUES('{$idUser}', '{$idProduct}', '{$qty}', '{$price}')";
            $res = $this->inst->sql($sql);
            return $res; 
        }
		
		public function updateCountProduct($arr)
        {
			$iduser = $arr['idUser'];
			$idproduct = $arr['idProduct'];
            $sql = "UPDATE cart SET qty=qty+1 WHERE idUser=" . $iduser . " AND idProduct=" . $idproduct;
            $res = $this->inst->sql($sql);
            return $res; 
        }
		
		public function deleteProduct($iduser, $idproduct)
        {
            $sql = 'DELETE FROM cart WHERE idUser=' . $iduser . ' AND idProduct=' . $idproduct . ' LIMIT 1';
            $res = $this->inst->sql($sql);
            return $res; 
        }
		
		
		
    }