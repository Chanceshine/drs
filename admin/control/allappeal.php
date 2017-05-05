<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Allappeal{
		private $_db;
		private $_row;
		private $_user;
		private $_compus;
		public function __construct(){
			$this->_db=new DB();
		}
		public function all(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select level,jurisdiction from admin where user = '$this->_user'";
				$row = $this->_db->oneRow($sql);

				if ($row['level'] ==2) {
					$query = "SELECT a.id,nid,uid,regman,tel,compus,building,room,equipment,othertext,time,regtime,reason,statetime FROM regs a,task b where (a.currentStatus = 4 and b.state = 5) and a.nid=b.regid";
					$this->_row=$this->_db->moreRows($query);

					if (count($this->_row)!=0) {
						for ($i=0; $i < count($this->_row); $i++) { 
							if ($this->_row[$i]['currentStatus'] == 5) {
								$this->_row[$i]['currentStatus'] = "申诉中";
							}
						}
						return $this->_row;
					}else{
						return 0;
					}
				}else{
					if ($row['jurisdiction']==0) {
						$this->_compus = "松山湖校区";
					}else{
						$this->_compus = "莞城校区";
					}
					$query = "SELECT a.id,nid,uid,regman,tel,compus,building,room,equipment,othertext,time,regtime,reason,statetime FROM regs a,task b where compus ='$this->_compus' and (a.currentStatus = 4 and b.state = 5) and a.nid=b.regid";
					$this->_row=$this->_db->moreRows($query);

					if (count($this->_row)!=0) {
						for ($i=0; $i < count($this->_row); $i++) { 
							if ($this->_row[$i]['currentStatus'] == 5) {
								$this->_row[$i]['currentStatus'] = "申诉中";
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
	$a=new Allappeal();
	$rows=$a ->all();
	echo json_encode($rows);
?>