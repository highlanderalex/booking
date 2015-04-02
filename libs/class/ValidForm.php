<?php
    class ValidForm {
        private $error;
        private $arr;

        public function __construct($form)
        {
            $this->error = '';
            $this->arr = $form;
        }
        
        public function validData()
	    {	
		
		    foreach($this->arr as $key => $val)
            {
                if ( 'name' == $key )
                {
                    $val = trim(htmlspecialchars($val));
                    if (empty($val))
                    {
			            $this->error .= "Вы не заполнили имя<br />"; 
                    }
                    else
                    {
	            	    if ( !preg_match("/^\s*[а-яА-Яa-zA-Z-.'\s]+\s*$/u",$val) || strlen($val) < 2 ) 
		                {
			                $this->error .= "Вы ввели не верно имя<br />";
		                } 
                    }  
                }
                if ( 'email' == $key )
                {
                    $val = trim($val);
                    if (empty($val))
                    {
			            $this->error .= "Вы не заполнили email<br />"; 
                    }
                    else
                    {
		                if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/",$val)) 
	            	    {
			                $this->error .= "Вы ввели не верно email<br />";
		                }
                    }  
                }
                if ( 'password' == $key )
                {
                    $val = trim(($val));
                    if (empty($val))
                    {
			            $this->error .= "Вы не заполнили пароль<br />"; 
                    }
                    else
                    {
	            	    if (  strlen($val) < 3 ) 
		                {
			                $this->error .= "Пароль должен иметь 3-15 символов<br />";
		                } 
                    }
                }  
            }
            
            if ($this->error == '')
		    {
			   $this->arr['password'] = md5($this->arr['password']);
			    return $this->arr;
		    }
		    else
	    	{
			    return $this->error;
	    	}

        }
    }

