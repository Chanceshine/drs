<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class CheckSch{
		private $_db;
		private $_row;
		private $_uid;
		private $_regid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function check(){
			if (isset($_SESSION['uid'])) {
				$this->_uid = $_SESSION['uid'];
				//获取id，报修单id，报修设备，登记时间，预约时间
				$sql="select id,nid,equipment,regtime,time from regs where uid = '$this->_uid'  ORDER BY updateTime DESC";
				$row1 = $this->_db->oneRow($sql);

				date_default_timezone_set("PRC");
				$row1['regtime'] = date('Y-m-d',strtotime($row1['regtime']));
				
				if ($row1['time']==null) {
					$row1['time'] = "暂无";
				}
				if ($row1['nid']) {		//如果记录存在则查询进度表
					$this->_regid = $row1['nid'];
					//regid报修单id,operator,statetime,state
					$sqltask = "select * from task where regid = '$this->_regid'";
					$row2 =$this->_db->moreRows($sqltask);
					for ($i=0; $i <count($row2) ; $i++) {
						$time = $row2[$i]['statetime'];
						$row2[$i]['statetime'] = date('Y-m-d',strtotime($time));
					}
					$readed = "update regs set isread = 0 where uid = '$this->_uid'";
					$this->_db->otherHandleRow($readed);

					$rows = array($row1,$row2);
					return $rows;
				}			
			}				
		}
	}
	$s=new CheckSch();
	$rows = $s->check();
?>