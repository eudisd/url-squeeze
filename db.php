<?php
	class Database 
	{
		public $host = '';
		public $db = '';
		public $usr = '';
		public $pwd = '';
		public $r = '';
		/* All of the fields above where deleted.  You need to configure MySQL to work on your
 		   server. */

		public function __construct(){
			$this->r = mysql_connect($this->host, $this->usr, $this->pwd);
			if(!$this->r){
				die("Failed to connect to db");
			}

			mysql_select_db($this->db, $this->r);
		}

		public function open_db(){
			$this->r = mysql_connect($this->host, $this->usr, $this->pwd);
			if(!$this->r){
				die("Failed to connect to db");
			}

			mysql_select_db($this->db, $this->r);
		}
		public function close_db(){
			mysql_close($this->r);
		}
		
	}
?>
