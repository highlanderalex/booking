<?php
    
	require_once (dirname(__FILE__).'/../models/PurchaseModel.php');
    
    /* Class PurchaseController for PurchaseModel
        * *
        * *
        * * @method construct: Create object model
        * * @method getPurchases: Return assoc array of purchases or empty
        * * @method addPurchases: Return count of change rows
        * */

    class PurchaseController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new PurchaseModel();
		}
		
    /* addPurchases method
        * *
        * *
        * * @params lastId, idProduct, qty, price: val lastId, idProduct, qty, price  
        * * @method insertPurchases: Return count of change rows
        * */

		public function addPurchases($lastId, $idProduct, $qty, $price)
        {
            $res = $this->model->insertPurchases($lastId, $idProduct, $qty, $price);
            return $res;
        }
		
    /* getPurchases method
        * *
        * *
        * * @params id: params of id order
        * * @return: Retutn assoc array of purchases or empty
        * */

		public function getPurchases($id)
        {
            $res = $this->model->returnPurchases($id);
            return $res;
        }
    }

