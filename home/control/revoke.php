<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class RevokeTable{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function revoke(){
			if (isset($_SESSION['user'])) {
				$this->_user = $_SESSION['user'];
				$this->_uid = $_SESSION['uid'];
				//修改sql语句
				$query = "SELECT a.id,nid,uid,regman,tel,compus,area,building,room,equipment,othertext,time,regtime,currentStatus,updateTime,reason FROM regs a,task b where a.nid=b.regid and (a.uid = '$this->_uid' and a.currentStatus = 4 and b.state=4) or (a.uid = '$this->_uid' and a.currentStatus = 6 and b.state=6)";

				$this->_row=$this->_db->moreRows($query);

				for ($i=0; $i < count($this->_row); $i++) { 
					if ($this->_row[$i]['currentStatus'] == 4) {
						$this->_row[$i]['currentStatus'] = "被驳回";
					}else if ($this->_row[$i]['currentStatus'] == 6) {
						$this->_row[$i]['currentStatus'] = "最终驳回";
					}
				}
				if ($this->_row) {
					return $this->_row;
				}else{
					return 0;
				}
			}else{
				return 0;
			}
		}
	}
	$r=new RevokeTable();
	$rows=$r ->revoke();
	echo json_encode($rows);
?>