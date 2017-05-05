<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class SureMore{
		private $_db;
		private $_row;
		private $_nid;
		private $_operator;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function sure(){
			if (isset($_SESSION['user'])) {
				$this->_nid = $_POST['nid'];

				$sql = "insert into task(regid,operator,state) values ('$this->_nid','学生本人',3)";
				
				//任务表插入新状态（已完成）				
				$this->_row=$this->_db->otherHandleRow($sql);

				if ($this->_row>0) {
					// 修改登记表的状态
					$sqlupdate = "update regs set currentStatus = 3,isread = 1 where nid='$this->_nid' ";
					$this->_up=$this->_db->otherHandleRow($sqlupdate);
					return $this->_up;					
				}				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$p = new SureMore();
	echo $p->sure();

?>