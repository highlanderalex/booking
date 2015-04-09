<?php
    
	require_once (dirname(__FILE__).'/../models/OrderModel.php');
    
    /* Class OrderController for OrderModel
        * *
        * *
        * * @method construct: Create database connection
        * * @method getOrders: Return assoc array of user orders
        * * @method getLastId: Retutn val of last insert id
        * * @method addOrder: Insert new order into orders
        * */
    class OrderController 
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new OrderModel();
		}
		
    /* getOrders method
        * *
        * *
        * * @params id: val id user
        * * @return: Retutn assoc array of user orders
        * */
		public function getOrders($id)
        {
            $res = $this->model->returnOrders($id);
            return $res;
        }
		
    /* getLastId method
        * *
        * *
        * * @params: No params
        * * @return: Retutn last insert id
        * */
		public function getLastId()
        {
            $res = $this->model->returnLastId();
            return $res;
        }
		
    /* addOrder method
        * *
        * *
        * * @params $arr: val arr with key idUser id
        * * @return: Return count of changes rows
        * */
		public function addOrder($arr)
        {
            $res = $this->model->insertOrder($arr);
            return $res;
        }
		
    }

