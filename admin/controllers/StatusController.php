<?php
	require_once (dirname(__FILE__).'/../models/StatusModel.php');
	
    class StatusController  
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new StatusModel();
		}
		
		public function getStatus()
        {
            $res = $this->model->returnStatus();
            return $res;
        }
		
	}