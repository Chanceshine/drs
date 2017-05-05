<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	$valid = true;
	$nowUser=str_replace(' ','',$_POST['user']);
	class ReUser{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function dis(){
			if ($nowUser==$_SESSION['admin']) {
				// $valid=true;
				return 1;
			}else{
				$this->_user=$_POST['user'];
				$sql="select * from admin where user = '$this->_user'";
				$this->_row=$this->_db->selectNums($sql);
				if ($this->_row>0) {
					// $valid=false;
					return 0;
				}else{
					return 1;
				}
			}						
		}
	}
	$r=new ReUser();
	$row=$r->dis();
	if ($row == 1) {
		$valid=true;
	} else {
		$valid=false;
	}
	
	echo json_encode(array(
    	'valid' => $valid,
	));
?>