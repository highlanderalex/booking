<?php

    require_once (dirname(__FILE__).'/../models/PaymentModel.php');
	
    class PaymentController  {
        
		private $model;
		
		public function __construct()
		{
			$this->model = new PaymentModel();
		}
        public function getPayment()
        {
            $res = $this->model->returnPayment();
            return $res;
        }
		
	}