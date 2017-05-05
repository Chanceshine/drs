<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class UpdateRep{
		private $_db;
		private $_id;
		private $_row;
		private $_user;
		private $_rid;
		private $_compus;
		private $_tel;
		private $_cornet;
		private $_functions;
		public function __construct(){
			if(isset($_SESSION['admin'])){
				$this->_user = $_SESSION['admin'];
				$this->_db=new DB();
				$this->getDataForm();
			}
		}
		//获取表单数据
		public  function getDataForm(){
			$this->_rid = $_POST['rid'];
			$this->_tel= trimall($_POST['tel']);
			if (isset($_POST['cornet'])) {
				$this->_cornet= trimall($_POST['cornet']);
			}else{
				$this->_cornet = "暂无";
			}
			$this->_compus = $_POST['compus'];
			$this->_functions = trimall($_POST['functions']);
		}
		//更新维修员表
		public function update(){
			//获取当前管理员级别、ID
			$sqlid="select gid,level from admin where user='$this->_user'";
			$row=$this->_db->oneRow($sqlid);
			$level=$row["level"];
			$gid=$row["gid"];
			if (isset($this->_tel)&&isset($this->_functions)&&isset($this->_compus)) {
				if ($level == 2) {
					$sql="update repairman set tel='$this->_tel',cornet='$this->_cornet',rcompus='$this->_compus',functions='$this->_functions' where rid='$this->_rid'";
					$this->_row=$this->_db->otherHandleRow($sql);
					return $this->_row;
				}else{
					$sqlinput="select inputman from repairman where rid='$this->_rid'";
					$input=$this->_db->oneRow($sqlinput);
					$inputman = $input['inputman'];
					if ($gid == $inputman) {
						$sql="update repairman set tel='$this->_tel',cornet='$this->_cornet',rcompus='$this->_compus',functions='$this->_functions' where rid='$this->_rid'";
						$this->_row=$this->_db->otherHandleRow($sql);
						return $this->_row;
					}else{
						return 0;
					}
				}
			}
		}
	}
	$s=new UpdateRep();
	$row=$s->update();
	echo json_encode($row);
	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>