<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class PassedTable{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function passed(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select level,jurisdiction from admin where user = '$this->_user'";
				$row = $this->_db->oneRow($sql);

				if ($row['level'] ==2) {
					$query = "SELECT * FROM regs where currentStatus = 1";
					$this->_row=$this->_db->moreRows($query);
					for ($i=0; $i < count($this->_row); $i++) { 
						if ($this->_row[$i]['currentStatus'] == 1) {
							$this->_row[$i]['currentStatus'] = "审核通过";
						} 					
					}
					if ($this->_row==null) {
						return 0;
					} else {
						return $this->_row;
					}
				}else{
					if ($row['jurisdiction']==0) {
						$compus = "松山湖校区";
					}else{
						$compus = "莞城校区";
					}
					$query = "SELECT * FROM regs where compus ='".$compus."' and currentStatus = 1";
					$this->_row=$this->_db->moreRows($query);

					if (count($this->_row)!=0) {
						for ($i=0; $i < count($this->_row); $i++) { 
							if ($this->_row[$i]['currentStatus'] == 1) {
								$this->_row[$i]['currentStatus'] = "审核通过";
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

	$p=new PassedTable();
	$rows=$p ->passed();
	echo json_encode($rows);
?>