<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class UpdateAdmin{
		private $_db;
		private $_row;
		private $_user;
		private $_gid;
		private $_compus;
		private $_tel;
		private $_cornet;
		public function __construct(){
			if(isset($_SESSION['admin'])){
				$this->_user = $_SESSION['admin'];
				$this->_db=new DB();
				$this->getDataForm();
			}
		}
		//获取表单数据
		public  function getDataForm(){
			$this->_gid = $_POST['gid'];
			$this->_tel= trimall($_POST['tel']);
			$this->_cornet= trimall($_POST['cornet']);
			$this->_compus = $_POST['compus'];
		}
		//更新维修员表
		public function update(){
			if (isset($this->_tel)&&isset($this->_compus)) {
				$sql="update admin set tel='$this->_tel',cornet='$this->_cornet',compus='$this->_compus' where gid='$this->_gid'";
				$this->_row=$this->_db->otherHandleRow($sql);
				return $this->_row;				
			}else{
				return 0;
			}
		}
	}
	$s=new UpdateAdmin();
	$row=$s->update();
	echo json_encode($row);
	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>