<?php
	session_start();
	header('Content-type: application/json');
	require_once("../common/db_connect.php");

	class DelPub{
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

				$sql = "select level from admin where user= '$this->_user'";
				$this->_row = $this->_db->oneRow($sql);
				// echo $this->_row['level'];
				if ($this->_row['level'] == 2) {
					$id = implode(",",$ids);
					$sql = "delete from notice where id in ($id)";
					echo $this->_db->otherHandleRow($sql);
				}else{
					$sqlId = "select id from notice where author != '$this->_user'";
					$row = $this->_db->moreRows($sqlId);	//当前作者所有文章ID
					$this->_row = 0;
					for ($i=0; $i < count($ids) ; $i++) {
						for ($r=0; $r < count($row); $r++) { 
							if ($ids[$i]==$row[$r]['id']) {
								$this->_row = 1;
								break;
							}
						}
					}
					if ($this->_row) {
						echo 0;
					}else{
						$id = implode(",",$ids);
						$sql = "delete from notice where id in ($id)";
						echo $this->_db->otherHandleRow($sql);
					}
				}				
			}else{
				echo "<script>window.location.href='../index.html';</script>";
			}
		}
	}
	$d = new DelPub();
	$rows = $d->del();

?>