<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class ReplyUser{
		private $_db;
		private $_gid;
		private $_row;
		private $_user;
		private $_nid;
		private $_reply;
		public function __construct(){
			if(isset($_SESSION['admin'])){
				$this->_user = $_SESSION['admin'];
				$this->_gid = $_SESSION['gid'];
				$this->_db=new DB();
			}
		}
		//回复
		public function reply(){
			$this->_nid = $_GET['nid'];
			$this->_reply = trimall($_GET['reply']);
			if ($this->_reply) {
				$sql="update evaluate set reply='$this->_reply',replyer='$this->_gid' where nid='$this->_nid'";
				$this->_row = $this->_db->otherHandleRow($sql);

				if ($this->_row>0) {
					$row = array(1,$this->_gid);
					return $row;
				} else {
					return 0;
				}
			} else {
				return 0;
			}
		}
	}
	$s = new ReplyUser();
	$rows = $s->reply();
	echo json_encode($rows);

	//去掉所有空格
	function trimall($str){
	    $qian=array(" ","　","\t","\n","\r");
	    return str_replace($qian, '', $str);   
	}
?>