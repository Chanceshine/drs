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

				$sqlnid = "select nid FROM regs where uid = '$this->_uid' and currentStatus = 3 order by updateTime DESC";
				$this->_row=$this->_db->oneRow($sqlnid);

				$nid = $this->_row['nid'];

				if ($nid) {
					$sql = "select * from evaluate where nid = '".$nid."'";
					$row = $this->_db->selectNums($sql);
					if ($row>0) {
						return 1;
					}else{
						return $nid;
					}
				}							
			}else{
				return 0;		//未登录
			}	
		}
	}

	$r=new IsEvaluate();
	echo $nid = $r->noevaluate();
?>