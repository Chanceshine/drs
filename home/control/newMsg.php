<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class NewMsg{
		private $_db;
		private $_row;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function msg(){
			if (isset($_SESSION['user'])) {
				$this->_uid = $_SESSION['uid'];
				$sql = "select * from regs where uid ='$this->_uid' and isread = 1";
				$this->_row = $this->_db->selectNums($sql);
				return $this->_row;
			}
		}
	}
	$s=new NewMsg();
	$msg = $s->msg();
	echo $msg;
?>