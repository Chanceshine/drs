<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class CompleteTable{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function complete(){
			if (isset($_SESSION['user'])) {
				$this->_user = $_SESSION['user'];
				$this->_uid = $_SESSION['uid'];
				/////修改sql语句
				$query = "SELECT * FROM regs where uid = '$this->_uid' and currentStatus=3";

				$this->_row=$this->_db->moreRows($query);

				for ($i=0; $i < count($this->_row); $i++) { 
					if ($this->_row[$i]['currentStatus'] == 3) {
						$this->_row[$i]['currentStatus'] = "已完成";
					}
				}
				if ($this->_row) {
					return $this->_row;
				}else{
					return 0;
				}return $this->_row;
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$r=new CompleteTable();
	$rows=$r ->complete();
	echo json_encode($rows);
?>