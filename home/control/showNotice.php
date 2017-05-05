<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Display{
		// private $_title;
		// private $_content;
		// private $_time;
		private $_db;
		private $_row;
		public function __construct(){
			$this->_db=new DB();
		}
		public function dis(){
			$sql_data="select * from notice order by time DESC limit 4";
			$this->_row=$this->_db->moreRows($sql_data);
			return $this->_row;			
		}
	}

	$s=new Display();
	$rows=$s->dis();
?>