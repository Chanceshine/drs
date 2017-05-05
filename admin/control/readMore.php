<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class ReadMore{
		private $_db;
		private $_row;
		private $_nid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function more(){
			if (isset($_SESSION['admin'])) {
				$this->_nid = $_GET['nid'];
				 // $this->_nid = 'N10031';
				if ($this->_nid) {
					$sql="select * from regs where nid ='$this->_nid'";
					$row1 = $this->_db->oneRow($sql);
					if ($row1['time']=="") {
						$row1['time'] = "您没有预约具体时间";
					}
					if ($row1['currentStatus']==0) {
						$row1['currentStatus'] = "未审核";
					}elseif ($row1['currentStatus']==1) {
						$row1['currentStatus'] = "审核通过";
					}elseif ($row1['currentStatus']==2) {
						$row1['currentStatus'] = "等待维修员上门";
					}elseif ($row1['currentStatus']==3) {
						$row1['currentStatus'] = "维修已完成";
					}elseif ($row1['currentStatus']==4) {
						$row1['currentStatus'] = "被驳回";
					}

					$sqltask="select * from task where regid ='$this->_nid'";
					$row2 = $this->_db->moreRows($sqltask);

					$rows = array($row1,$row2);
					return $rows;
				}
			}else{
				echo "<script>window.location.href(../index.html)</script>";
			}			
		}
	}
	$r=new ReadMore();
	$rows = $r->more();
?>