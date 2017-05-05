<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Level{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function lel(){
			$this->_user=$_SESSION['admin'];
			$sql_data="select level,gid,jurisdiction from admin where user = '$this->_user'";

			$this->_row=$this->_db->oneRow($sql_data);
			if ($this->_row['jurisdiction']==0) {
				$this->_row['jurisdiction'] = "松山湖校区";
			}else if ($this->_row['jurisdiction']==1){
				$this->_row['jurisdiction'] = "莞城校区";
			}
			return $this->_row;			
		}
	}
	$l=new Level();
	$row = $l->lel();
	echo json_encode($row);
?>