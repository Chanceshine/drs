<?php
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AllComplain{
		private $_db;
		private $_row;
		public function __construct(){
			$this->_db=new DB();
		}
		public function complain(){
			if (isset($_SESSION['uid'])) {
				$this->uid = $_SESSION['uid'];

				$sql="select * from evaluate where uid='$this->uid' and complain IS NOT null";
				$this->_row =$this->_db->moreRows($sql);
				for ($i=0; $i < count($this->_row); $i++) { 
					if ($this->_row[$i]['reply'] == null) {
						$this->_row[$i]['reply'] ="暂未收到回复";
					}
					if ($this->_row[$i]['replytime'] == null) {
						$this->_row[$i]['replytime'] ="暂无";
					}
				}

				if ($this->_row ==null ) {
					return 0;
				} else {
					return $this->_row;
				}			
			} else {
				return 0;
			}
		}
	}
	$r=new AllComplain();
	$rows = $r->complain();
	echo json_encode($rows);
?>