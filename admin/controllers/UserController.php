<?php
	require_once (dirname(__FILE__).'/../models/UserModel.php');
	
    class UserController  
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new UserModel();
		}
		
        public function checkEmail($email)
        {
            $res = $this->model->returnEmail($email);
            return $res;
        }
		
		public function checkAuth($data)
        {
            $res = $this->model->returnAuth($data);
            return $res;
        }
		
		public function dataUser($data)
        {
            $res = $this->model->returnDataUser($data);
            return $res;
        }
		
		public function insertDb($data)
        {
            $res = $this->model->insertDb($data);
            return $res;
        }
		
		public function getDiscont($iduser)
        {
            $res = $this->model->returnDiscont($iduser);
            return $res;
        }
		
		public function updDiscont($data)
        {
            $res = $this->model->updateDiscont($data);
            return $res;
        }
		
		public function getUsers()
        {
            $res = $this->model->returnUsers();
            return $res;
        }
		
	}