<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class DistributeMore{
		private $_db;
		private $_row;
		private $_user;
		private $_gid;
		private $_rid;
		private $_ids;
		private $_operator;
		public function __construct(){
			$this->_db=new DB();			
		}
		public function more(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$this->_gid = $_SESSION['gid'];
				$nids = $_POST['nids'];			//报修单ID
				$this->_rid = $_POST['rid'];			//维修员ID
				$ids = $_POST['ids'];			//ID

				for ($i=0; $i < count($nids); $i++) {
					if ($i==0) {
						$sql = "insert into task(regid,operator,state) values ('".$nids[$i]."','$this->_gid',2)";
					}else{
						$sql.=",('".$nids[$i]."','$this->_gid',2)"; 
					}
				}
				// 任务表插入新状态（分配维修员）
				$this->_row=$this->_db->otherHandleRow($sql);

				if ($this->_row>0) {
					// 修改登记表的状态
					$this->_ids = implode(",",$ids);
					$sqlupdate = "update regs set currentStatus = 2,isread = 1,repairman = '$this->_rid' where id in ($this->_ids)";
					$this->_up=$this->_db->otherHandleRow($sqlupdate);
					return $this->_up;
				}				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$d = new DistributeMore();
	echo $d->more();
?>