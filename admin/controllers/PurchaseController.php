<?php
    
	require_once (dirname(__FILE__).'/../models/PurchaseModel.php');
    
    class PurchaseController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new PurchaseModel();
		}
		
		public function addPurchases($lastId, $idProduct, $qty, $price)
        {
            $res = $this->model->insertPurchases($lastId, $idProduct, $qty, $price);
            return $res;
        }
		
		public function getPurchases($id)
        {
            $res = $this->model->returnPurchases($id);
            return $res;
        }
    }

