<?php
	session_start();
	require_once("../common/db_connect.php");	
	class LOGIN{
		private $_user;
		private $_pwd;
		private $_gid;
		private $_btn;
		private $_db;
		private $_error;
		public function __construct(){
			$this->_db=new DB();
			//var_dump($this->_db);
		}
		/*作用：检测用户登录
		 *参数：用户名与密码
		 *返回值：登录成功1,失败0
		*/	
		public function checkLogin(){
			if (isset($_SESSION['admin'])) {
				return 2;
			} else {
				if(strlen($_POST['admin'])>0){
					$this->_user=$_POST['admin'];	//echo "input user";
				}
				if(strlen($_POST['pwd'])>0){
					$this->_pwd=$_POST['pwd'];	//echo "input pwd";
				}
				$sql="select id from admin where user='$this->_user' and password='$this->_pwd'";
				$this->_error=$this->_db->selectNums($sql);
				if($this->_error){
					$_SESSION['admin']=$this->_user;
					$_SESSION['pwd']=$this->_pwd;

					$sqlgid = "select gid from admin where user = '$this->_user'";
					$gid = $this->_db->oneRow($sqlgid);
					$_SESSION['gid'] = $gid['gid'];
				}
				return $this->_error;
			}
		}
	}

	$u=new LOGIN();
	$num=$u->checkLogin();	
	switch($num){
		case 0:echo 0;break;
		case 1:echo 1;break;
		case 2:echo 2;break;
	}
?>
<?php
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
?>