<?php

	require_once ('DB.php');
    
    /* Class PurchaseModel for purchase table
        * *
        * *
        * * @method construct: Create database connection
        * * @method returnPurchases: Return assoc array of purchases or empty
        * * @method insertPurchases: Return count of change rows
        * */

    class PurchaseModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
    /* returnPurchases method
        * *
        * *
        * * @params id: params of id order
        * * @return: Retutn assoc array of purchases or empty
        * */

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
		
    /* insertPurchases method
        * *
        * *
        * * @params lastId, idProduct, qty, price: val lastId, idProduct, qty, price  
        * * @method insertPurchases: Return count of change rows
        * */

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
