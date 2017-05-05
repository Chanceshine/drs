<?php
	session_start();
	header('Content-type: application/json');
	require_once("../common/db_connect.php");

	class DelRepairman{
		private $_db;
		private $_row;
		private $_user;
		private $_id;
		public function __construct(){
			$this->_db=new DB();
		}
		public function del(){
			if (isset($_SESSION['admin'])) {
				$this->_user=$_SESSION['admin'];
				$ids = $_POST['id'];	//被选项Id
				$sql = "select level,gid from admin where user= '$this->_user'";
				$this->_row = $this->_db->oneRow($sql);

				if ($this->_row['level'] == 2) {				
					$id = implode(",",$ids);
					$sql = "delete from repairman where id in ($id)";
					return $this->_db->otherHandleRow($sql);		
				}else{
					$id = implode(",",$ids);
					$sqlgid = "select inputman from repairman where id in ($id)";
					$gid = $this->_db->moreRows($sqlgid);
					$k = 0;
					for ($i=0; $i < count($gid); $i++) { 
						if ($this->_row['gid'] != $gid[$i]['inputman']) {
							$k = 1;
							break;
						} 							
					}
					if ($k == 1) {
						return 0;
					} else {
						$sql = "delete from repairman where id in ($id)";
						return $this->_db->otherHandleRow($sql);
					}
				}				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$d = new DelRepairman();
	$rows = $d->del();
	echo $rows;
?>