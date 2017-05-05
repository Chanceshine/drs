<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class Allregs{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function all(){
			if (isset($_SESSION['admin'])) {
				$this->_user = $_SESSION['admin'];
				$sql = "select level,compus from admin where user = '$this->_user'";
				$row = $this->_db->oneRow($sql);
				// echo $row['level'];
				if ($row['level'] ==2) {
					$query = "SELECT * FROM regs";
					$this->_row=$this->_db->moreRows($query);
					for ($i=0; $i < count($this->_row); $i++) { 
						if ($this->_row[$i]['currentStatus'] == 0) {
							$this->_row[$i]['currentStatus'] = "未审核";
						} elseif ($this->_row[$i]['currentStatus'] == 1) {
							$this->_row[$i]['currentStatus'] = "任务待分配";
						} elseif ($this->_row[$i]['currentStatus'] == 2) {
							$this->_row[$i]['currentStatus'] = "进行中";
						} elseif ($this->_row[$i]['currentStatus'] == 3) {
							$this->_row[$i]['currentStatus'] = "已完成";
						} elseif ($this->_row[$i]['currentStatus'] == 4) {
							$this->_row[$i]['currentStatus'] = "已驳回";
						}elseif ($this->_row[$i]['currentStatus'] == 5) {
							$this->_row[$i]['currentStatus'] = "申诉中";
						}elseif ($this->_row[$i]['currentStatus'] == 6) {
							$this->_row[$i]['currentStatus'] = "最终驳回";
						}						
					}
					return $this->_row;
				}else{
					$query = "SELECT * FROM regs where compus ='".$row['compus']."'";
					$this->_row=$this->_db->moreRows($query);
					for ($i=0; $i < count($this->_row); $i++) { 
						if ($this->_row[$i]['currentStatus'] == 0) {
							$this->_row[$i]['currentStatus'] = "未审核";
						} elseif ($this->_row[$i]['currentStatus'] == 1) {
							$this->_row[$i]['currentStatus'] = "任务待分配";
						} elseif ($this->_row[$i]['currentStatus'] == 2) {
							$this->_row[$i]['currentStatus'] = "进行中";
						} elseif ($this->_row[$i]['currentStatus'] == 3) {
							$this->_row[$i]['currentStatus'] = "已完成";
						} elseif ($this->_row[$i]['currentStatus'] == 4) {
							$this->_row[$i]['currentStatus'] = "已驳回";
						}elseif ($this->_row[$i]['currentStatus'] == 5) {
							$this->_row[$i]['currentStatus'] = "申诉中";
						}elseif ($this->_row[$i]['currentStatus'] == 6) {
							$this->_row[$i]['currentStatus'] = "最终驳回";
						}
					}
					return $this->_row;
				}				
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}
		}
	}

	$a=new Allregs();
	$rows=$a ->all();
	echo json_encode($rows);
?>