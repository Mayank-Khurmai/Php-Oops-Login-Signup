<?php

	class db{
		private $db;
		function database()
		{
			$this->db = new mysqli("localhost","root","","test");
			if(!$this->db->connect_error)
			{
				return $this->db;
			}
		}
	}
	
	class check_user{
		private $username;
		private $password;
		private $db;
		private $query;
		private $tmp_pwd;
		private $response;
		private $data;
		function __construct($username,$password){
			$this->username = $username;
			$this->password = $password;
			$this->db = new db();
			$this->db = $this->db->database();
			$this->query = "SELECT * FROM user WHERE username='$username'";
			$this->response = $this->db->query($this->query);
			if($this->response->num_rows != 0)
			{
				echo "success";
			}

			else{
				echo "failed";
			}

		}
	}

	class main{
		private $username;
		private $password;
		function __construct(){
			$this->username = $_POST['username'];
			$this->password = $_POST['password'];
			new check_user($this->username,$this->password);

		}
	}

	new main();


?>