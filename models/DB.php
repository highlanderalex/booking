<?php
	require_once (dirname(__FILE__).'/../config/config.php');
	
        class DB {
			private static $host    = HOST;
			private static $db_name = DBNAME;
			private static $login   = LOGIN;
			private static $pass    = PASS;
			private static $driver    = DBDRIVER;
			private static $instance = null;
			private static $result;
			private static $res_array;
			private static $connection;
			
			private function __construct() {}
			private function __clone() {}
			private function __sleep() {}
			private function __wakeup() {}
                
            public static function run()
            {
                if (null === self::$instance)
				{
					self::$instance = new self();
					self::$instance->connect();
				}
				return self::$instance;
            }
                
			private function connect() 
			{	
				try
				{
					self::$connection = new PDO(self::$driver.':host='.self::$host.';dbname='.self::$db_name, self::$login, self::$pass, 
												array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
					self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				catch (PDOException $e)
				{
					echo $e->getMessage();
				}
			}	
				//mysql_connect(self::$host, self::$login, self::$pass) or die("Error connect DB".mysql_error());
				//mysql_select_db(self::$db_name, self::$connection);
				//mysql_query("SET NAMES utf8", self::$connection);
			
                
            public function sql($str)
            {
                self::$result = self::$connection->query($str);
                return self::$result;
            }
			
			public function dbResultToArray($result)
			{
				self::$res_array = array();
				$count = 0;
				self::$result->setFetchMode(PDO::FETCH_ASSOC);
				while ($row = self::$result->fetch()){
					self::$res_array[$count] = $row;
					$count++;
				}
				return self::$res_array;
			}
			
			public function dbLineArray($result)
			{
				self::$res_array = array();
				self::$result->setFetchMode(PDO::FETCH_ASSOC);
				self::$res_array = self::$result->fetch();
				return self::$res_array;
			}
			
			public function dbCount($result)
			{
				self::$res_array = self::$result->fetchColumn();
				return self::$res_array;
			}
			
			
			final public function __destruct()
			{
				self::$instance = null;
			}
		}
        
    