<?php

	require_once ('DB.php');
    
    /* Class UserModel for users table
        * *
        * *
        * * @method construct: Create database connection
        * * @method returnEmail: valid on exist email into database
        * * @method returnAuh: Retutn count 1 or 0 
        * * @method returnDataUser: Retutn assoc array of data user
        * * @method returnDiscont: Retutn val discont of data user
        * * @method insertDb: Insert database new user
        * */

    class UserModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
		
    /* returnEmail method
        * *
        * *
        * * @params email: val email
        * * @return: Retutn 0 or 1
        * */

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
		
    /* returnAuth method
        * *
        * *
        * * @params data: array data with key email, password
        * * @return: Retutn 0 or 1
        * */
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
		
    /* returnDataUser method
        * *
        * *   
        * * @params data: array data with key email, password
        * * @return: Retutn assoc array of user 
        * */
		public function returnDataUser($data)
        {
			$arr['where'] = $data['email'];
			$arr['and'] = $data['password'];
            $res = $this->inst->Select('id, name')
						      ->From('users')
							  ->Where('email=')
							  ->I('password=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
    /* returnDiscont method
        * *
        * *
        * * @params idUser: val idUser
        * * @return: Retutn assoc array of discont user
        * */
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
		
    /* insertDb method
        * *
        * *
        * * @params data: array data with key email, password
        * * @method insertDb:Return count of changes rows
        * */
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
