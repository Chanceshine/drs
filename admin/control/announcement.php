<?php
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
	class Publish{
		private $_db;
		private $_row;
		private $_user;
		private $_title;
		private $_content;
		public function __construct(){
			$this->_db=new DB();
		}
		public function pub(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$this->_title=$_POST['title'];
				$this->_content=$_POST['content'];

				if ((mb_strlen($this->_title)) < 30 && (mb_strlen($this->_content) <500)) {
					$sql="insert into notice(title,content,author) values('$this->_title','$this->_content','$this->_user')";
					$this->_row=$this->_db->otherHandleRow($sql);
					echo $this->_row;
				}	
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$p = new Publish();
	$p->pub();
?>