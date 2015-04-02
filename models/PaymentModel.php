<?php

	require_once ('DB.php');
    
    class PaymentModel {
		
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        public function returnPayment()
        {
            $sql = 'SELECT id, pay FROM payment';
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}