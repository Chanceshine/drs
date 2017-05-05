<?php 
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
	class RePwd{
		private $_db;
		private $_row;
		private $_user;
		private $_pwd;
		public function __construct(){
			$this->_db=new DB();
		}
		public function change(){
			if (isset($_SESSION['user'])) {
				$this->_user=$_SESSION['user'];
				$this->_pwd=$_POST['password'];
				$sql="update user SET password = '$this->_pwd' WHERE name = '$this->_user'";
				$this->_row=$this->_db->otherHandleRow($sql);
				if ($this->_row) {
					$_SESSION['pwd']=$this->_pwd;
					echo $this->_row;
				}				
			}
		}
	}
	$r=new RePwd();
	$row=$r->change();
?>