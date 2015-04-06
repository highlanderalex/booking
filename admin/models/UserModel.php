<?php

	require_once ('DB.php');
    
    class UserModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
		
		public function returnEmail($email)
        {
			$arr['where'] = $email;
            $res = $this->inst->Select('COUNT(email) as val')
						      ->From('users')
							  ->Where('email=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnAuth($data)
        {
			$arr['where'] = $data['email'];
			$arr['and'] = $data['password'];
            $res = $this->inst->Select('COUNT(id)')
						      ->From('users')
							  ->Where('email=')
							  ->I('password=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnDataUser($data)
        {
			$arr['where'] = $data['email'];
			$arr['and'] = $data['password'];
            $res = $this->inst->Select('id, name, email')
						      ->From('users')
							  ->Where('email=')
							  ->I('password=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnUsers()
        {
            $res = $this->inst->Select('id, name, email')
						      ->From('users')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnDiscont($iduser)
        {
			$arr['where'] = $iduser;
            $res = $this->inst->Select('d.discont')
						      ->From('users u')
							  ->Join('discont d')
							  ->On('u.idDiscont=d.id')
							  ->Where('u.id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function insertDb($data)
        {
			$arr['name'] = $data['name'];
			$arr['email'] = $data['email'];
			$arr['password'] = $data['password'];
			$res = $this->inst->Insert('users')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
	}