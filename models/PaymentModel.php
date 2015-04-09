<?php

	require_once ('DB.php');
    
    /* Class PaymentModel for payment table
        * *
        * *
        * * @method construct: Create database connection
        * * @method returnPayment: Retutn assoc array of payment or empty
        * */

    class PaymentModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
            
    /* returnPayment method
        * *
        * *
        * * @params: No params
        * * @return: Retutn assoc array of payment or empty
        * */

		public function returnPayment()
        {
            $res = $this->inst->Select('id, pay')
						      ->From('payment')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}
