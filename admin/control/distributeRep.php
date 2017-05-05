<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class DistributeRep{
		private $_db;
		private $_row;
		private $_user;
		private $_compus;
		public function __construct(){
			$this->_db=new DB();
		}
		public function rep(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sqlcompus = "select compus from admin where user = '$this->_user'";
				$compus = $this->_db->oneRow($sqlcompus);
				$this->_compus = $compus['compus'];
				//查询维修员信息
				$query = "SELECT id,rid,rname,rsex,rcompus,functions FROM repairman where rcompus = '$this->_compus'";
				$this->_row=$this->_db->moreRows($query);
				if ($this->_row==null) {
					return 0;
				} else {
					return $this->_row;
				}
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$r=new DistributeRep();
	$rows=$r ->rep();
	echo json_encode($rows);
?>