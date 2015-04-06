<?php

	require_once ('DB.php');
    
    class PurchaseModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
		public function returnPurchases($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('b.name, p.qty, p.price')
						      ->From('purchases p')
							  ->Join('books b')
							  ->On('p.idProduct = b.id')
							  ->Where('p.idOrders=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function insertPurchases($lastId, $idProduct, $qty, $price)
        {
			$arr['idOrders'] = $lastId;
			$arr['idProduct'] = $idProduct;
			$arr['qty'] = $qty;
			$arr['price'] = $price;
			$res = $this->inst->Insert('purchases')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
    }
