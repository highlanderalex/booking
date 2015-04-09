<?php

	require_once ('DB.php');
    
    /* Class OrderModel for orders table
        * *
        * *
        * * @method construct: Create database connection
        * * @method returnOrders: Return assoc array of user orders
        * * @method returnLastId: Retutn val of last insert id
        * * @method returninsertOrder: Insert new order into orders
        * */

    class OrderModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
      
    /* returnOrders method
        * *
        * *
        * * @params id: val id user
        * * @return: Retutn assoc array of user orders
        * */

		public function returnOrders($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('o.id, o.datetime, p.pay, s.status')
						      ->From('orders o')
							  ->Join('payment p')
							  ->On('o.idPay = p.id')
							  ->Join('status s')
							  ->On('o.idStatus = s.id')
							  ->Where('idUser=')
							  ->Order('o.datetime')
							  ->Desc()
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
    /* returnLastId method
        * *
        * *
        * * @params: No params
        * * @return: Retutn last insert id
        * */

		public function returnLastId()
        {
			$res = $this->inst->lastId();
            return $res; 
        }
		
    /* insertOrder method
        * *
        * *
        * * @params $arr: val arr with key idUser id
        * * @return: Return count of changes rows
        * */

		public function insertOrder($arr)
        {
			$res = $this->inst->Insert('orders')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
    }
