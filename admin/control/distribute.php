<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Distribute{
		private $_db;
		private $_row;
		private $_regid;
		private $_gid;
		private $_operator;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function dis(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$this->_gid = $_SESSION['gid'];		//管理员ID
				$this->_regid = $_POST['nid'];		//报修单ID
				$this->_rid = $_POST['rid'];		//维修员ID
				
				//任务表插入新状态（审核通过）
				$sqlstatus = "insert into task(regid,operator,state) values('$this->_regid','$this->_gid',2)";
				$this->_row=$this->_db->otherHandleRow($sqlstatus);
				//修改登记表的状态
				$sqlupdate = "update regs set currentStatus = 2,isread = 1,repairman = '$this->_rid' where nid = '$this->_regid'";
				$this->_up=$this->_db->otherHandleRow($sqlupdate);

				if ($this->_row ==1 && $this->_up ==1) {
					return 1;
				}				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$p = new Distribute();
	echo $p->dis();

?>