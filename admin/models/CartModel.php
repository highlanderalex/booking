<?php

	require_once ('DB.php');
    
    class CartModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
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
		
		public function insertProductCart($arr)
        {
			$res = $this->inst->Insert('cart')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
		
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
