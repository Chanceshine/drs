<?php 
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
	class Fine{
		private $_db;
		private $_row;
		private $_uid;
		private $_key;
		private $_time;
		private $_pwd;
		public function __construct(){
			$this->_db=new DB();
		}
		public function findPwd(){
			date_default_timezone_set("PRC");	//时区
			$currentTime = strtotime(date('Y-m-d H:i:s', time()));
			echo $currentTime;
			$this->_key = $_GET['key'];
			$this->_time = $_GET['nowtime'];

			$diff = $currentTime - $this->_time;
			
			if ($diff>3000) {
				return 0;	//超时
			} else {
				$key = "select uid from user where userkey = '$this->_key'";
				$row = $this->_db->oneRow($key);
				$this->_uid = $row['uid'];
				
				$this->_pwd = $_POST['password'];

				if ($this->_pwd) {
					$sql="update user SET password = '$this->_pwd' WHERE uid = '$this->_uid'";
					$this->_row=$this->_db->otherHandleRow($sql);
					if ($this->_row) {
						return $this->_row;
					}			
				}
			}
		}
	}
	$r=new Fine();
	$row=$r->findPwd();
	echo $row;
?>