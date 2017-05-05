<?php
	session_start();
	header('Content-type: application/json');
	require_once("../common/db_connect.php");

	class DelRepairman{
		private $_db;
		private $_row;
		private $_user;
		private $_id;
		public function __construct(){
			$this->_db=new DB();
		}
		public function del(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$id = $_POST['id'];	//被选项Id
				$sql = "select level,gid from admin where user= '$this->_user'";
				$this->_row = $this->_db->oneRow($sql);

				if ($this->_row['level'] == 2) {
					$sql = "delete from repairman where id = $id";
					return $this->_db->otherHandleRow($sql);
				}else{
					$sqlgid = "select inputman from repairman where id = $id";
					$gid = $this->_db->oneRow($sqlgid);	
					// echo $gid['inputman'];
					if ($this->_row['gid'] == $gid['inputman']) {
						$sql = "delete from repairman where id = $id";
						return $this->_db->otherHandleRow($sql);
					} else {
						return 0;
					}
				}
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$d = new DelRepairman();
	$rows = $d->del();
	echo $rows;
?>