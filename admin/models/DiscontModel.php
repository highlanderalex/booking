<?php

	require_once ('DB.php');
    
    class DiscontModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
		
		public function returnDisconts()
        {
            $res = $this->inst->Select('id, discont')
						      ->From('discont')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
	}