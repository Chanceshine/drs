<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class RepairingTable{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function repair(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select level,jurisdiction from admin where user = '$this->_user'";
				$row = $this->_db->oneRow($sql);

				if ($row['level'] ==2) {
					$query = "SELECT a.id,nid,uid,regman,tel,compus,building,room,equipment,othertext,time,regtime,currentStatus,updateTime,operator,repairman FROM regs a,task b regs,task where a.nid=b.regid and b.state =a.currentStatus and b.state=2";
					$this->_row=$this->_db->moreRows($query);
					for ($i=0; $i < count($this->_row); $i++) { 
						if ($this->_row[$i]['currentStatus'] == 2) {
							$this->_row[$i]['currentStatus'] = "进行中";
						}
					}
					return $this->_row;
				}else{
					if ($row['jurisdiction']==0) {
						$compus = "松山湖校区";
					}else{
						$compus = "莞城校区";
					}
					$query = "SELECT a.id,nid,uid,regman,tel,compus,building,room,equipment,othertext,time,regtime,currentStatus,updateTime,operator,repairman FROM regs a,task b where a.compus ='".$compus."' and a.nid=b.regid and b.state =a.currentStatus and b.state=2";
					$this->_row=$this->_db->moreRows($query);
					// echo $query;

					if (count($this->_row)!=0) {
						for ($i=0; $i < count($this->_row); $i++) { 
							if ($this->_row[$i]['currentStatus'] == 2) {
								$this->_row[$i]['currentStatus'] = "进行中";
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

	$r=new RepairingTable();
	$rows=$r ->repair();
	echo json_encode($rows);
?>