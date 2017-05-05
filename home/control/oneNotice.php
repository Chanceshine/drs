<?php
session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class OneNotice{
		private $_db;
		private $_row;
		private $_id;
		public function __construct(){
			$this->_db=new DB();
		}
		public function notice(){
			$this->_id = $_GET['id'];
			if ($this->_id) {
				$sqlprev="select * from notice where id <'$this->_id' ORDER BY id DESC LIMIT 0,1";
				$row1 = $this->_db->oneRow($sqlprev);

				// print_r($row1);

				$sql="select * from notice where id ='$this->_id'";
				$row2 =$this->_db->oneRow($sql);

				$sqlnext="select * from notice where id >'$this->_id' ORDER BY id DESC LIMIT 0,1";
				$row3 =$this->_db->oneRow($sqlnext);

				$rows = array($row1,$row2,$row3);
				return $rows;
			}
		}
	}
	$s=new OneNotice();
	$rows = $s->notice();
	// print_r($row);
?>