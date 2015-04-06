<?php

	require_once ('DB.php');
    
    class OrderModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
      
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
		
		public function returnLastId()
        {
			$res = $this->inst->lastId();
            return $res; 
        }
		
		public function insertOrder($arr)
        {
			$res = $this->inst->Insert('orders')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
    }
