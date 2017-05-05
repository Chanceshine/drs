<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AddRepair{
		private $_db;
		private $_row;
		private $_user;
		private $_gid;
		private $_rid;
		private $_rname;
		private $_rsex;
		private $_compus;
		private $_tel;
		private $_cornet;
		private $_jurisdiction;
		public function __construct(){
			$this->_db=new DB();
			$this->getDataForm();
		}		
		public  function getDataForm(){
			$this->_adduser = trimall($_POST['user']);
			$this->_name = trimall($_POST['name']);
			$this->_tel= trimall($_POST['tel']);
			if (isset($_POST['cornet'])) {
				$this->_cornet= trimall($_POST['cornet']);
			}else{
				$this->_cornet = "暂无";
			}
			$this->_sex = $_POST['gender'];
			$this->_compus = $_POST['compus'];
			if ($this->_compus=="松山湖校区") {
				$this->_jurisdiction = 0;
			} else {
				$this->_jurisdiction = 1;
			}
			
		}
		public function add(){
			if (isset($_SESSION['admin'])) {
				
				//生成维修人员ID
				$sql = "select id from admin";
				$row = $this->_db->moreRows($sql);
				if ($row>0) {
					$num = count($row)-1;
					$id = $row[$num]['id'] + 101;		//最后的id加1
					$this->_gid = "G{$id}";
				}else{
					$this->_gid = "G101";
				}
				//添加维修人员
				if (isset($this->_adduser)&&isset($this->_name)&&isset($this->_tel)&&isset($this->_sex)&&isset($this->_compus)) {					
					$sqladd = "insert into admin(gid,user,realname,sex,compus,tel,cornet,jurisdiction) values('$this->_gid','$this->_adduser','$this->_name','$this->_sex','$this->_compus','$this->_tel','$this->_cornet','$this->_jurisdiction')";

					$this->_row=$this->_db->otherHandleRow($sqladd);
					echo $this->_row;
				}
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$p = new AddRepair();
	$p->add();
	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>