<?php

	require_once ('DB.php');
    
    class StatusModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
		
		public function returnStatus()
        {
            $res = $this->inst->Select('id, status')
						      ->From('status')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
	}