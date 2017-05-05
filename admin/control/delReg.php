<?php
	session_start();
	header('Content-type: application/json');
	require_once("../common/db_connect.php");

	class DelPub{
		private $_db;
		private $_row;
		private $_user;
		public function __construct(){
			$this->_db=new DB();
		}
		public function del(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$ids = $_POST['ids'];	//被选项Id
				$nids = $_POST['nids'];	//报修单Id
				$nid = array();
				for ($i=0; $i <count($nids) ; $i++) { 
					$nid[$i] = "'".$nids[$i]."'";
				}
				$tasknid = implode(",",$nid);	//获得报修单字符串
				$id = implode(",",$ids);

				$deltsk = "delete from task where regid in (".$tasknid.")";
				$this->_row1 = $this->_db->otherHandleRow($deltsk);

				$delregs = "delete from regs where id in (".$id.")";
				$this->_row2 = $this->_db->otherHandleRow($delregs);
				
				if ($this->_row1>0 && $this->_row2>0) {
					return 1;
				}				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$d = new DelPub();
	echo $d->del();
?>