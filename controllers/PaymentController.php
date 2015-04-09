<?php

    require_once (dirname(__FILE__).'/../models/PaymentModel.php');
	
    /* Class PaymenController for PaymentModel
        * *
        * *
        * * @method construct: Create object method
        * * @method getPayment: Retutn assoc array of payment or empty
        * */

    class PaymentController  
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new PaymentModel();
        }

    /* getPayment method
        * *
        * *
        * * @params: No params
        * * @return: Retutn assoc array of payment or empty
        * */

        public function getPayment()
        {
            $res = $this->model->returnPayment();
            return $res;
        }
	}
