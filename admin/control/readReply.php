<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class ReadReply{
		private $_db;
		private $_row;
		private $_user;
		private $_reply;
		public function __construct(){
			$this->_db=new DB();
		}
		//回复
		public function read(){
			$this->_nid = $_GET['nid'];
			$sql="select reply,replytime from evaluate where nid='$this->_nid'";
			$this->_row=$this->_db->oneRow($sql);
			if ($this->_row==null) {
				return 0;
			} else {
				return $this->_row;
			}				
		}
	}
	$r = new ReadReply();
	$row = $r->read();
	echo json_encode($row);
?>