<?php
	
	class db{
		private $db;
		private $response;
		private $name;
		private $dob;
		private $age;
		private $subject;
		private $salary;
		private $query;
		function database(){
			$this->db = new mysqli("localhost","root","","test");
			if($this->db->connect_error)
			{
				die("Failed");
			}
		}

		function insert_student($name,$dob,$age)
		{
			$this->database();
			$this->name = $name;
			$this->dob = $dob;
			$this->age = $age;
			$this->query = "INSERT INTO student(name,dob,age)
			VALUES('$this->name','$this->dob','$this->age')
			";
			$this->response = $this->db->query($this->query);

			if($this->response)
			{
				echo "student success";
			}

			else{
				echo "student failed";
			}
		}

		function insert_faculty($name,$dob,$age,$subject,$salary)
		{
			$this->database();
			$this->name = $name;
			$this->dob = $dob;
			$this->age = $age;
			$this->subject = $subject;
			$this->salary = $salary;
			$this->query = "INSERT INTO faculty(name,dob,age,subject,salary)
			VALUES('$this->name','$this->dob','$this->age','$this->subject','$this->salary')
			";
			$this->response = $this->db->query($this->query);

			if($this->response)
			{
				echo "faculty success";
			}

			else{
				echo "faculty failed";
			}
		}
	}


	class common_codes{
		private $common_data = [];
		function set(){
			$this->common_data[0] = $_POST['name'];
			$this->common_data[1] = $_POST['dob'];
			$this->common_data[2] = $_POST['age'];
			return $this->common_data;			
		}
	}

	class students extends common_codes{

	}

	class faculty extends common_codes{
		private $other_data = [];
		function setdata(){
			$this->other_data[0] = $_POST['subject'];
			$this->other_data[1] = $_POST['salary'];
			return $this->other_data;

		}
	}


	class main{
		function result()
		{
			if(isset($_POST['st-submit']))
			{
				$students = new students();
				$result = $students->set();
				$db = new db();
				$db->insert_student($result[0],$result[1],$result[2]);
			}

			else if(isset($_POST['fc-submit']))
			{
				$faculty = new faculty();
				$common_data = $faculty->set();// name,dob,age
				$other_data = $faculty->setdata();// salary,subject
				$db = new db();
				$db->insert_faculty($common_data[0],$common_data[1],$common_data[2],$other_data[0],$other_data[1]);
			}
		}
	}

	$main = new main();
	$main->result();






?>

