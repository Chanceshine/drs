<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class SureMore{
		private $_db;
		private $_row;
		private $_ids;
		private $_gid;
		private $_nids;
		private $_operator;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function sure(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$this->_gid = $_SESSION['gid'];
				$nids = $_POST['nids'];
				$ids = $_POST['ids'];

				for ($i=0; $i < count($nids); $i++) {
					if ($i==0) {
						$sql = "insert into task(regid,operator,state) values ('".$nids[$i]."','$this->_gid',3)";
					}else{
						$sql.=",('".$nids[$i]."','$this->_gid',3)"; 
					}
				}
				//任务表插入新状态（已完成）				
				$this->_row=$this->_db->otherHandleRow($sql);

				if ($this->_row>0) {
					// 修改登记表的状态
					$this->_ids = implode(",",$ids);
					$sqlupdate = "update regs set currentStatus = 3,isread = 1 where id in ($this->_ids)";
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