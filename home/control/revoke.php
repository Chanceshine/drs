<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class RevokeTable{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function revoke(){
			if (isset($_SESSION['user'])) {
				$this->_user = $_SESSION['user'];
				$this->_uid = $_SESSION['uid'];
				//修改sql语句
				$query = "SELECT * FROM regs where (uid = '$this->_uid' and currentStatus=4) or uid = '$this->_uid' and currentStatus=6";

				$this->_row=$this->_db->moreRows($query);

				for ($i=0; $i < count($this->_row); $i++) { 
					if ($this->_row[$i]['currentStatus'] == 4) {
						$this->_row[$i]['currentStatus'] = "被驳回";
					}else if ($this->_row[$i]['currentStatus'] == 6) {
						$this->_row[$i]['currentStatus'] = "最终驳回";
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

	$r=new RevokeTable();
	$rows=$r ->revoke();
	echo json_encode($rows);
?>