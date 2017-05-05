<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class PassReg{
		private $_db;
		private $_row;
		private $_regid;
		private $_gid;
		private $_operator;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function pass(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$this->_gid=$_SESSION['gid'];
				$this->_regid = $_POST['nid'];
				
				//任务表插入新状态（审核通过）
				$sqlstatus = "insert into task(regid,operator,state) values('$this->_regid','$this->_user',1)";
				$this->_row=$this->_db->otherHandleRow($sqlstatus);
				//修改登记表的状态
				$sqlupdate = "update regs set currentStatus = 1,isread = 1 where nid = '$this->_regid'";
				$this->_up=$this->_db->otherHandleRow($sqlupdate);

				return $this->_row;
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$p = new PassReg();
	echo $p->pass();

	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>