<?php
	session_start();
	require_once("../common/db_connect.php");
	class Repair{
		private $_nid;
		private $_uid;
		private $_user;
		private $_compus;
		private $_area;
		private $_building;
		private $_roomnum;
		private $_tel;
		private $_equipment;
		private $_othertext;
		private $_time;
		private $_row;
		public function __construct(){
			$this->_db=new DB();
			$this->_user=$_SESSION['user'];
			$this->_uid=$_SESSION['uid'];
			$this->getDataForm();
		}
		//取从表单中传递过来的数据
		public  function getDataForm(){			
			if(isset($_POST['s1'])&&isset($_POST['s2'])&&isset($_POST['s3'])){
				if ($_POST['s1']=='1') {
					$this->_compus = "松山湖校区";
				} else {
					$this->_compus = "莞城校区";
				}
				if ($_POST['s2']==1||$_POST['s2']==3) {
					$this->_area = "学生宿舍区";
				} else {
					$this->_area = "教师宿舍区";
				}
				$this->_building = 	$_POST['s3'];
				$this->_roomnum = trimall($_POST['roomnum']);
				$this->_tel = trimall($_POST['tel']);

				if (isset($this->_roomnum) && (mb_strlen($_POST['roomnum'],'UTF8')<4)) {
					$this->_roomnum = $_POST['roomnum'];
				}
				if (isset($this->_tel) && (mb_strlen($_POST['tel'],'UTF8')<20)) {
					$this->_tel = $_POST['tel'];
				}
				$this->_equipment = $_POST['equipment'];
				$this->_othertext = $_POST['othertext'];
				$this->_time = $_POST['time'];
			}
		}
		
		public function rep(){
			if (isset($this->_user)) {
				//生成报修单ID
				$sql = "select id from regs";
				$row = $this->_db->moreRows($sql);
				if ($row>0) {
					$num = count($row)-1;
					$id = $row[$num]['id'] + 10001;		//最后的id加1
					$this->_nid = "N{$id}";
				}else{
					$this->_nid = "N10001";
				}
				$sql = "insert into regs (nid,uid,regman,tel,compus,area,building,room,equipment,othertext,time) values ('$this->_nid','$this->_uid','$this->_user','$this->_tel','$this->_compus','$this->_area','$this->_building','$this->_roomnum','$this->_equipment','$this->_othertext','$this->_time')";
				$this->_row=$this->_db->otherHandleRow($sql);

				$sqltask = "insert into task (regid,state) values ('$this->_nid',0)";
				$task = $this->_db->otherHandleRow($sqltask);
				if ($this->_row ==1 && $task ==1) {
					return 1;
				}
			}else{
				return 0;
			}
			
		}
	}

	$r=new Repair();
	echo $r->rep();
	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>