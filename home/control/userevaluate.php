<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class UserEvaluate{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		private $_rid;
		private $_nid;
		private $_rscore;
		private $_revaluate;
		private $_sscore;
		private $_sevaluate;
		private $_complain;
		public function __construct(){
			$this->_db=new DB();
		}
		public function evaluate(){
			if (isset($_SESSION['user'])) {
				$this->_uid = $_SESSION['uid'];		//用户ID
				$this->_nid = $_GET['nid'];			//报修单ID
				$sqlrid = "select repairman FROM regs where nid = '$this->_nid'";
				$rid = $this->_db->oneRow($sqlrid);
				$this->_rid = $rid['repairman'];			//维修员ID
				$this->_rscore = $_GET['rscore'];
				
				if ($this->_rscore) {
					$this->_revaluate = trimall($_GET['revaluate']);
					$this->_sscore = $_GET['sscore'];
					$this->_sevaluate = trimall($_GET['sevaluate']);

					$query = "insert into evaluate (nid,uid,rid,rscore,revaluate,sscore,sevaluate) values ('$this->_nid','$this->_uid','$this->_rid','$this->_rscore','$this->_revaluate','$this->_sscore','$this->_sevaluate')";

					$this->_row=$this->_db->otherHandleRow($query);
					return $this->_row;
				}else{
					$this->_complain = trimall($_GET['complain']);
					$query = "insert into evaluate (nid,uid,rid,complain) values ('$this->_nid','$this->_uid','$this->_rid','$this->_complain')";
					$this->_row=$this->_db->otherHandleRow($query);
					return $this->_row;
				}
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$r=new UserEvaluate();
	echo $r->evaluate();
	
	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>