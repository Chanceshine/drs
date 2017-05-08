<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AllEvaluate{
		private $_db;
		private $_row;
		public function __construct(){
			$this->_db=new DB();
		}
		public function evaluate(){
			if (isset($_SESSION['uid'])) {
				$this->uid = $_SESSION['uid'];

				$sql="select * from evaluate where uid = '$this->uid' and rscore IS NOT null";
				$this->_row =$this->_db->moreRows($sql);
				
				if ($this->_row ==null ) {
					return 0;
				} else {
					return $this->_row;
				}
			}else{
				return 0;
			}
		}

	}
	$r=new AllEvaluate();
	$rows = $r->evaluate();
	echo json_encode($rows);
?>