<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class PassReg{
		private $_db;
		private $_row;
		private $_regid;
		private $_gid;
		private $_id;
		private $_operator;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function pass(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$this->_gid=$_SESSION['gid'];
				$this->_regid = $_POST['nid'];
				// $this->_id = $_POST['id'];
				if (isset($this->_regid)) {
					//删除任务表中对应报修单的驳回状态
					// $delstate = "delete from task where regid = '$this->_regid' and state=4";
					// $del = $this->_db->otherHandleRow($delstate);
					//任务表插入新状态（改为待分配）
					$sqlstatus = "insert into task(regid,state,operator) values('$this->_regid',1,'$this->_gid')";
					$this->_row=$this->_db->otherHandleRow($sqlstatus);
					//修改登记表的状态
					$sqlupdate = "update regs set currentStatus = 1,isread = 1 where nid = '$this->_regid'";
					$this->_up=$this->_db->otherHandleRow($sqlupdate);
					if ($this->_row==1 && $this->_up==1) {
						return 1;
					}else{
						return 0;
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

?>