<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class SavePub{
		private $_db;
		private $_id;
		private $_row;
		private $_user;
		private $_olduser;
		private $_compus;
		public function __construct(){
			if(isset($_SESSION['admin'])){
				$this->_db=new DB();
				$this->_olduser=$_SESSION['admin'];			
				$this->getDataForm();
			}
		}
		public  function getDataForm(){
			$nowUser=str_replace(' ','',$_POST['user']);
			$this->_user=$nowUser;
			$this->_compus=$_POST['compus'];
			$_SESSION['admin']=$this->_user;
		}
		public function save(){
			$sqlid="select id from admin where user='$this->_olduser'";
			$row=$this->_db->oneRow($sqlid);
			$id=$row["id"];
			$sql="update admin set user='$this->_user',compus='$this->_compus' where id='$id'";
			$this->_error=$this->_db->otherHandleRow($sql);
			return $this->_error;
		}
	}
	$s=new SavePub();
	$rows=$s->save();
?>