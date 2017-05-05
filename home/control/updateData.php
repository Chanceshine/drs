<?php 
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
	class ChangeData{
		private $_db;
		private $_row;
		private $_user;
		private $_compus;
		private $_area;
		private $_building;
		private $_roomnum;
		private $_tel;
		private $_cornet;
		public function __construct(){
			$this->_db=new DB();
			$this->_uid=$_SESSION['uid'];
			$this->getDataForm();
		}
		//取从表单中传递过来的数据
		public  function getDataForm(){			
			if(isset($_POST['s1'])&&isset($_POST['s2'])&&isset($_POST['s3'])){
				if ($_POST['s1']==1) {
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
				$this->_cornet = trimall($_POST['cornet']);

				if (isset($this->_roomnum) && (mb_strlen($_POST['roomnum'],'UTF8')<4)) {
					$this->_roomnum = $_POST['roomnum'];
				}
				if (isset($this->_tel)) {
					$this->_tel = $_POST['tel'];
				}
				$this->_cornet = trimall($_POST['cornet']);
			}
		}
		public function change(){
			if (isset($this->_uid)) {
				$sql="update user SET compus = '$this->_compus',area = '$this->_area',building = '$this->_building',room = '$this->_roomnum',tel = '$this->_tel',cornet = '$this->_cornet' WHERE uid = '$this->_uid'";
				$this->_row=$this->_db->otherHandleRow($sql);
				if ($this->_row == 1) {
					return 1;
				}				
			}
		}
	}
	$r=new ChangeData();
	$row=$r->change();
	echo $row;

	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian,'', $str);
	}
?>