<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Passregs{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function pass(){
			if (isset($_SESSION['user'])) {
				$this->_user = $_SESSION['user'];
				$this->_uid = $_SESSION['uid'];
				$query = "SELECT * FROM regs where currentStatus = 1 and uid = '$this->_uid'";
				$this->_row=$this->_db->moreRows($query);
				for ($i=0; $i < count($this->_row); $i++) { 
					if ($this->_row[$i]['currentStatus'] == 1) {
						$this->_row[$i]['currentStatus'] = "审核通过";
					} 					
				}
				if ($this->_row) {
					return $this->_row;
				}else{
					return 0;
				}
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$p=new Passregs();
	$rows=$p ->pass();
	echo json_encode($rows);
?>