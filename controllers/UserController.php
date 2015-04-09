<?php
	require_once (dirname(__FILE__).'/../models/UserModel.php');
	
    /* Class UserController for UserModel
        * *
        * *
        * * @method construct: Create object model
        * * @method checkEmail: valid on exist email into database
        * * @method checkAuth: Retutn count 1 or 0 
        * * @method dataUser: Retutn assoc array of data user
        * * @method getDiscont: Retutn val discont of data user
        * * @method insertDb: Insert database new user
        * */

    class UserController  
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new UserModel();
		}
		
    /* checkEmail method
        * *
        * *
        * * @params email: val email
        * * @return: Retutn 0 or 1
        * */

        public function checkEmail($email)
        {
            $res = $this->model->returnEmail($email);
            return $res;
        }
		
    /* checkAuth method
        * *
        * *
        * * @params data: array data with key email, password
        * * @return: Retutn 0 or 1
        * */

		public function checkAuth($data)
        {
            $res = $this->model->returnAuth($data);
            return $res;
        }
		
    /* dataUser method
        * *
        * *   
        * * @params data: array data with key email, password
        * * @return: Retutn assoc array of user 
        * */

		public function dataUser($data)
        {
            $res = $this->model->returnDataUser($data);
            return $res;
        }
		
    /* insertDb method
        * *
        * *
        * * @params data: array data with key email, password
        * * @method insertDb:Return count of changes rows
        * */

		public function insertDb($data)
        {
            $res = $this->model->insertDb($data);
            return $res;
        }
		
    /* getDiscont method
        * *
        * *
        * * @params idUser: val idUser
        * * @return: Retutn assoc array of discont user
        * */

		public function getDiscont($iduser)
        {
            $res = $this->model->returnDiscont($iduser);
            return $res;
        }
		
	}
