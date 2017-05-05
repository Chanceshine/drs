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
		private $_functions;
		public function __construct(){
			$this->_db=new DB();
			$this->getDataForm();
		}		
		public  function getDataForm(){
			$this->_name = trimall($_POST['name']);
			$this->_tel= trimall($_POST['tel']);
			if (isset($_POST['cornet'])) {
				$this->_cornet= trimall($_POST['cornet']);
			}else{
				$this->_cornet = "暂无";
			}
			$this->_rsex = $_POST['gender'];
			$this->_compus = $_POST['compus'];
			$this->_functions = trimall($_POST['functions']);
		}
		public function add(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$sqlgid = "select gid from admin where user = '$this->_user'";
				$gid = $this->_db->oneRow($sqlgid);
				$this->_gid = $gid['gid'];
				//生成维修人员ID
				$sql = "select id from repairman";
				$row = $this->_db->moreRows($sql);
				if ($row>0) {
					$num = count($row)-1;
					$id = $row[$num]['id'] + 1001;		//最后的id加1
					$this->_rid = "R{$id}";
				}else{
					$this->_rid = "R1001";
				}
				//添加维修人员
				if (isset($this->_name)&&isset($this->_tel)&&isset($this->_functions)&&isset($this->_rsex)&&isset($this->_compus)) {					
					$sqladd = "insert into repairman(rid,rname,rsex,rcompus,tel,cornet,functions,inputman) values('$this->_rid','$this->_name','$this->_rsex','$this->_compus','$this->_tel','$this->_cornet','$this->_functions','$this->_gid')";

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