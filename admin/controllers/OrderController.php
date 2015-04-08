<?php
    
	require_once (dirname(__FILE__).'/../models/OrderModel.php');
    
    class OrderController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new OrderModel();
		}
		
		public function getOrders($id)
        {
            $res = $this->model->returnOrders($id);
            return $res;
        }
		
		public function getLastId()
        {
            $res = $this->model->returnLastId();
            return $res;
        }
		
		public function addOrder($arr)
        {
            $res = $this->model->insertOrder($arr);
            return $res;
        }
		
		public function updStatus($data)
        {
            $res = $this->model->updateStatus($data);
            return $res;
        }
		
    }

