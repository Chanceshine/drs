<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class History{
		private $_db;
		private $_row;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function show(){
			if (isset($_SESSION['admin'])) {
				$query = "SELECT * FROM notice ORDER BY time DESC";
				$this->_row=$this->_db->moreRows($query);
				return $this->_row;
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$h=new History();
	$rows=$h ->show();
	echo json_encode($rows);
?>