<?php
session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AllRepair{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function all(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select level,compus from admin where user = '$this->_user'";
				$row = $this->_db->oneRow($sql);
				// echo $row['level'];
				if ($row['level'] ==2) {
					$query = "SELECT * FROM repairman";
					$this->_row=$this->_db->moreRows($query);
					return $this->_row;
				}else{
					$query = "SELECT * FROM repairman where rcompus ='".$row['compus']."'";
					$this->_row=$this->_db->moreRows($query);
					return $this->_row;
				}				
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$a=new AllRepair();
	$rows=$a ->all();
	echo json_encode($rows);
?>