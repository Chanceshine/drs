<?php
	session_start();
	require_once("../common/db_connect.php");
	
	class LOGIN{
		private $_user;
		private $_uid;
		private $_pwd;
		private $_btn;
		private $_db;
		private $_row;
		public function __construct(){
			$this->_db=new DB();
		}
		/*作用：检测用户登录
		 *参数：用户名与密码
		 *返回值：登录成功1,失败0
		*/	
		public function checkLogin(){
			if(isset($_POST['btn'])){
				if (isset($_SESSION['user'])) {
					return 2;	//不允许重复登录
				} else {
					if(strlen($_POST['uid'])>0){
						$this->_uid=$_POST['uid'];
					}
					if(strlen($_POST['pwd'])>0){
						$this->_pwd=$_POST['pwd'];
					}
					$sql="select id from user where uid='$this->_uid' and password='$this->_pwd'";
					$this->_row=$this->_db->selectNums($sql);
					if($this->_row>0){
						$_SESSION['uid']=$this->_uid;
						$sql_user="select name from user where uid='$this->_uid'";
						$row = $this->_db->oneRow($sql_user);
						$_SESSION['user']=$row['name'];
						$_SESSION['pwd']=$this->_pwd;
					}
					return $this->_row;
				}
			}
		}
	}
	
	$u=new LOGIN();
	$num=$u->checkLogin();
	
	switch($num){
		case 0:echo "<script>alert('账号或密码错误');window.history.go(-1);</script>";break;
		case 1:echo "<script>window.location.href='../page/index.php'</script>";break;
		case 2:echo "<script>alert('您已登录，请勿重复登录');window.history.go(-1);</script>";break;
		default:
			#code;
			break;
	}
?>
<?php
	header('Content-type:text/html;charset=utf-8');
	require_once("../common/db_connect.php");
?>