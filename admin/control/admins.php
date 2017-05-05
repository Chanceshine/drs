<?php
session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AllAdmin{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function all(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select * from admin where user != '$this->_user'";
				$this->_row = $this->_db->moreRows($sql);
				return $this->_row;
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}
	$a=new AllAdmin();
	$rows=$a ->all();
	// echo json_encode($rows);
?>