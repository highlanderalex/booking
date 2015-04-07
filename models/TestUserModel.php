<?php
    include 'UserModel.php';
    
    class TestUserModel extends PHPUnit_Framework_TestCase
    {
        public function testreturnEmail()
        {
            $user = new UserModel();
            $email = 'alex@mail.ru';
            $this->assertTrue(0==$user->returnEmail($email) 
                                            || 1==$user->returnEmail($email));
        }
        
        public function testreturnAuth()
        {
            $user = new UserModel();
            $data['email']= 'alex@mail.ru';
            $data['password']= md5('qwerty');
            $this->assertTrue(0==$user->returnAuth($data) 
                                            || 1==$user->returnAuth($data));
        }
        
        public function testreturnDataUser()
        {
            $user = new UserModel();
            $data['email']= 'alex@mail.ru';
            $data['password']= md5('abcd');
            $this->assertTrue(empty($user->returnDataUser($data))); 
                                            
        }
        
        public function testreturnDiscont()
        {
            $user = new UserModel();
            $id = 9;
            $this->assertTrue(empty($user->returnDiscont($id)) || is_array($user->returnDiscont($id)));
        } 
        
        public function testinsertDb()
        {
            $user = new UserModel();
            $data['name'] = 'qqq';
            $data['email'] = 'qqq@mail.ru';
            $data['password'] = md5('qqq');
            $this->assertTrue($user->insertDb($data) > 0);
        }          
    }

?>
