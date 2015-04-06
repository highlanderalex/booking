<?php
	require_once (dirname(__FILE__).'/../config/config.php');
	
        class DB 
		{
			private static $host    = HOST;
			private static $db_name = DBNAME;
			private static $login   = LOGIN;
			private static $pass    = PASS;
			private static $driver    = DBDRIVER;
			private static $instance = null;
			private static $result;
			private static $str;
			private static $lastId;
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
			
            /*public function sql($str)
            {
                self::$result = self::$connection->query($str);
                return self::$result;
            }*/
			
			public static function Execute()
			{
				self::$result = self::$connection->prepare(self::$str);
				$count = func_num_args();
				if ( 0 == $count )
				{
					self::$result->execute();
				}
				else
				{
					$data = func_get_arg(0);
					self::$result->execute($data);
				}
				return self::$result;
			}
			public static function Select($fld)
			{
				self::$str = 'Select ' . $fld;
				return self::$instance;
			}
			
			public static function Delete()
			{
				self::$str = 'Delete ';
				return self::$instance;
			}
			
			public static function Insert($tbl)
			{
				self::$str = 'Insert Into ' . $tbl;
				return self::$instance;
			}
			
			public static function Update($tbl)
			{
				self::$str = 'Update ' . $tbl;
				return self::$instance;
			}
			
			public static function Set($exp)
			{
				self::$str .= ' Set ' . $exp;
				return self::$instance;
			}
			
			public static function Fields($arr)
			{
				$fields = '';
				foreach($arr as $key => $val)
				{
					$fields .= $key . ',';
				}
				$fields = substr($fields,0,-1);
				self::$str .= ' (' . $fields . ')';
				return self::$instance;
			}
			
			public static function Values($arr)
			{
				$values = '';
				foreach($arr as $val)
				{
					$values .= "'" . $val . "',";
				}
				$values = substr($values,0,-1);
				self::$str .= ' Values(' . $values . ')';
				return self::$instance;
			}
		
			public static function From($tbl)
			{
				self::$str .= ' From ' . $tbl;
				return self::$instance;
			}
			
			public static function InnerJoin($tbl)
			{
				self::$str .= ' INNER JOIN ' . $tbl;
				return self::$instance;
			}
			
			public static function On($exp)
			{
				self::$str .= ' ON ' . $exp;
				return self::$instance;
			}
			
			public static function Join($tbl)
			{
				self::$str .= ' JOIN ' . $tbl;
				return self::$instance;
			}
			
			public static function Where($exp)
			{
				self::$str .= ' Where ' . $exp . ':where';
				return self::$instance;
			}
			
			public static function I($exp)
			{
				self::$str .= ' AND ' . $exp . ':and';
				return self::$instance;
			}
			
			public static function Order($fld)
			{
				self::$str .= ' ORDER BY ' . $fld;
				return self::$instance;
			}
			
			public static function Desc()
			{
				self::$str .= ' DESC';
				return self::$instance;
			}
			
			public static function Limit($num)
			{
				self::$str .= ' Limit ' . $num;
				return self::$instance;
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
			
			public function lastId()
			{
				self::$lastId = self::$connection->lastInsertId();
				return self::$lastId;
			}
			
			
			final public function __destruct()
			{
				self::$instance = null;
			}
		}
        
    