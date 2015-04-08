<?php
	require_once (dirname(__FILE__).'/../models/DiscontModel.php');
	
    class DiscontController  
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new DiscontModel();
		}
		
		public function getDisconts()
        {
            $res = $this->model->returnDisconts();
            return $res;
        }
		
	}