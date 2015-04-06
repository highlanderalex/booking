<?php
	
	class config {
	
		private $host    = "localhost";
		private $db_name = "booking";
		private $login   = "root";
		private $pass    = "";
		public $email   = "highlanderalex@rambler.ru";
		
		function connect_db() {
			
			$link = mysql_connect($this->host, $this->login, $this->pass) or die("Error connect DB".mysql_error());
			mysql_select_db($this->db_name, $link);
			mysql_query("SET NAMES utf8", $link);
		}
		
	}
