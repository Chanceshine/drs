<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class PassReg{
		private $_db;
		private $_row;
		private $_regid;
		private $_uid;
		private $_gid;
		private $_operator;
		private $_othertext;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function pass(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$this->_regid = trimall($_POST['nid']);
				$this->_othertext = trimall($_POST['othertext']);
				$this->_gid=$_SESSION['gid'];

				if ((!empty($this->_regid))&&(!empty($this->_othertext))) {
					//任务表插入新状态（驳回）
					$sqlstatus = "insert into task(regid,operator,state,reason) values('$this->_regid','$this->gid',6,'$this->_othertext')";
					$this->_row=$this->_db->otherHandleRow($sqlstatus);
					if ($this->_row == 1) {
						//修改登记表的状态
						$sqlupdate = "update regs set currentStatus = 6,isread = 1 where nid = '$this->_regid'";
						$this->_up=$this->_db->otherHandleRow($sqlupdate);
						return $this->_up;
					}
				} else {
					return 0;
				}		
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