<?php
	session_start();
	header('Content-type: application/json');
	require_once("../common/db_connect.php");

	class DelAdmin{
		private $_db;
		private $_row;
		private $_user;
		private $_gid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function del(){
			if (isset($_SESSION['admin'])) {

				$this->_gid = $_POST['gid'];	//被选项Id				
				$sql = "delete from admin where gid = '$this->_gid'";
				return $this->_db->otherHandleRow($sql);				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$d = new DelAdmin();
	$row = $d->del();
	echo $row;
?>