<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class RepairingTable{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function repair(){
			if (isset($_SESSION['user'])) {
				$this->_user = $_SESSION['user'];
				$this->_uid = $_SESSION['uid'];
				/////修改sql语句
				$query = "SELECT * FROM regs where uid = '$this->_uid' and currentStatus=2";

				$this->_row=$this->_db->moreRows($query);

				for ($i=0; $i < count($this->_row); $i++) { 
					if ($this->_row[$i]['currentStatus'] == 2) {
						$this->_row[$i]['currentStatus'] = "进行中";
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

	$r=new RepairingTable();
	$rows=$r ->repair();
	echo json_encode($rows);
?>