<?
	session_start();
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");

	class IsEvaluate{
		private $_db;
		private $_row;
		private $_user;
		private $_uid;
		private $_nid;
		public function __construct(){
			$this->_db=new DB();
		}
		public function noevaluate(){
			if (isset($_SESSION['user'])) {
				$this->_uid = $_SESSION['uid'];		//用户ID
				$this->_nid = $_GET['nid'];

				if ($this->_nid) {
					$sql = "select * from evaluate where nid = '$this->_nid'";
					$row = $this->_db->selectNums($sql);
					if ($row>0) {
						return 1;
					}else{
						return 0;
					}
				}							
			}
		}
	}

	$r=new IsEvaluate();
	echo $nid = $r->noevaluate();
?>