<?php
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class AllNotice{
		private $_db;
		private $_row;
		public function __construct(){
			$this->_db=new DB();
		}
		public function notice(){
			$sql="select id,title,time from notice";
			$rows =$this->_db->moreRows($sql);

			date_default_timezone_set("PRC");
			for ($i=0; $i <count($rows) ; $i++) {
				$time = $rows[$i]['time'];
				$rows[$i]['time'] = date('Y-m-d',strtotime($time));
			}
			return $rows;
		}

	}
	$s=new AllNotice();
	$rows = $s->notice();
	echo json_encode($rows);
?>