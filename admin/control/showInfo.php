<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
	class Display{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function dis(){
			$this->_user=$_SESSION['admin'];
			$sql_data="select * from admin where user = '$this->_user'";
			$this->_row=$this->_db->oneRow($sql_data);
			return $this->_row;			
		}
	}
	$s=new Display();
	$rows=$s->dis();
?>