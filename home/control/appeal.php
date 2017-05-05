<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Appeal{
		private $_db;
		private $_row;
		private $_nid;
		private $_reason;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function app (){
			if (isset($_SESSION['user'])) {
				$this->_nid = $_POST['nid'];
				$this->_reason = $_POST['reason'];

				if (isset($this->_reason)) {
					$sql = "insert into task(regid,reason,state) values ('$this->_nid','$this->_reason',5)";
				
					//任务表插入新状态（申诉）				
					$this->_row=$this->_db->otherHandleRow($sql);

					// if ($this->_row>0) {
					// 	// 修改登记表的状态
					// 	$sqlupdate = "update regs set currentStatus = 5,isread = 1 where nid='$this->_nid' ";
					// 	$this->_up=$this->_db->otherHandleRow($sqlupdate);
					// 	return $this->_up;
					// }
				} else {
					return 0;
				}		
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$p = new Appeal();
	echo $p->app();
?>