<?php

	require_once ('DB.php');
    
    class PaymentModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
		public function returnPayment()
        {
            $res = $this->inst->Select('id, pay')
						      ->From('payment')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}