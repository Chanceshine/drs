<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AllReject{
		private $_db;
		private $_row;
		private $_user;
		private $_compus;
		public function __construct(){
			$this->_db=new DB();
		}
		public function reject(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select level,jurisdiction from admin where user = '$this->_user'";
				$row = $this->_db->oneRow($sql);

				if ($row['level'] ==2) {
					$query = "SELECT distinct a.id,nid,uid,regman,tel,compus,building,room,equipment,othertext,time,regtime,currentStatus,updateTime,operator,reason FROM regs a,task b where a.nid=b.regid and (a.currentStatus = 4 and b.state=4) or (a.currentStatus = 6 and b.state = 6)";
					$this->_row=$this->_db->moreRows($query);
					for ($i=0; $i < count($this->_row); $i++) { 
						if ($this->_row[$i]['currentStatus'] == 4) {
							$this->_row[$i]['currentStatus'] = "已驳回";
						}else {
							$this->_row[$i]['currentStatus'] = "申诉中";
						}
					}
					return $this->_row;
				}else{
					if ($row['jurisdiction']==0) {
						$this->_compus = "松山湖校区";
					}else{
						$this->_compus = "莞城校区";
					}
					$query = "SELECT a.id,nid,uid,regman,tel,compus,building,room,equipment,othertext,time,regtime,currentStatus,updateTime,operator,b.reason FROM regs a,task b where a.nid=b.regid and a.compus ='$this->_compus' and (a.currentStatus = 4 and b.state=4) or (a.currentStatus = 6 and b.state = 6)";
					$this->_row=$this->_db->moreRows($query);

					if (count($this->_row)!=0) {
						for ($i=0; $i < count($this->_row); $i++) { 
							if ($this->_row[$i]['currentStatus'] == 4) {
								$this->_row[$i]['currentStatus'] = "已驳回";
							}else if ($this->_row[$i]['currentStatus'] == 6){
								$this->_row[$i]['currentStatus'] = "最终驳回";
							}
						}
						return $this->_row;
					}else{
						return 0;
					}									
				}				
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$p=new AllReject();
	$rows=$p ->reject();
	echo json_encode($rows);
?>