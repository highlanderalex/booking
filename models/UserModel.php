<?php

	require_once ('DB.php');
    
    class UserModel {
		
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
        
        public function returnEmail($email)
        {
            $sql = "SELECT COUNT(email) as val FROM users WHERE email='" . $email . "'";
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbCount($res);
            return $res;
        }
		
		public function returnAuth($data)
        {
			$pass = $data['password'];
			$email = $data['email'];
            $sql = "SELECT COUNT(id) FROM users WHERE email='{$email}' AND password='{$pass}'";
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbCount($res);
            return $res;
        }
		
		public function returnDataUser($data)
        {
			$pass = $data['password'];
			$email = $data['email'];
            $sql = "SELECT id, name FROM users WHERE email='{$email}' AND password='{$pass}'";
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbLineArray($res);
            return $res;
        }
		
		public function returnDiscont($iduser)
		{
			$sql = 'SELECT d.discont FROM users u JOIN discont d ON u.idDiscont=d.id WHERE u.id=' . $iduser;
            $res = $this->inst->sql($sql);
			$res = $this->inst->dbLineArray($res);
            return $res; 
		}
		
		public function insertDb($data)
        {
			$name = $data['name'];
			$email = $data['email'];
			$password = $data['password'];
            $sql = "INSERT INTO users (name, email, password) VALUES('{$name}', '{$email}', '{$password}')";
            $res = $this->inst->sql($sql);
            return $res;
        }
	}