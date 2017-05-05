<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class ShowInfo{
		private $_db;
		private $_row;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function show(){
			if (isset($_SESSION['uid'])) {
				$this->_uid = $_SESSION['uid'];

				$sql="select * from user where uid = '$this->_uid'";
				$this->_row=$this->_db->oneRow($sql);
				return $this->_row;
			}
		}
	}
	$s=new ShowInfo();
	$rows=$s->show();
	echo json_encode($rows);
?>