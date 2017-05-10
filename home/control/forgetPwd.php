<?php 
header('Content-type:text/html;charset=utf-8');
require_once("../common/db_connect.php");
//引入发送邮件类
require("smtp.php");
date_default_timezone_set("PRC");	//时区

class Forget{
	private $_db;
	private $_row;
	private $_uid;
	private $_email;
	private $_key;
	public function __construct(){
		$this->_db=new DB();
	}
	public function forgetPwd(){
		$this->_uid = $_POST['user'];
		$this->_email = $_POST['addr'];	//收件人地址

		//查邮箱、学号
		$user = "select * from user where uid = '$this->_uid' and email = '$this->_email'";
		$res = $this->_db->oneRow($user);

		if($res){
			$num = rand(100000,999999);
			$data['id'] = $res['id'];	//表id

			$this->_key = md5($user.$num);
			//将key存入那个id对应的key字段
			$key = "update user set userkey = '$this->_key' WHERE uid = '$this->_uid'";
			$this->_row=$this->_db->otherHandleRow($key);

			$nowtime = strtotime(date('Y-m-d H:i:s', time()));

			//使用163邮箱服务器
			$smtpserver = "smtp.163.com";
			//163邮箱服务器端口
			$smtpserverport = 25;
			//你的163服务器邮箱账号
			$smtpusermail = "chenyesheng21@163.com";
			//收件人邮箱
			$smtpemailto = $this->_email;
			//你的邮箱账号(去掉@163.com)
			$smtpuser = "chenyesheng21";//SMTP服务器的用户帐号
			//你的邮箱密码
			$smtppass = "chen61728201"; //SMTP服务器的用户密码
			//用户密码需要到邮箱里开启smtp后所设置的密码，和登陆密码不一样
			//邮件主题
			$mailsubject = "密码修改";
			//邮件内容
			$html = "尊敬的".$this->_uid."用户，您好：<br>您当前的操作为找回密码，请点击以下链接重新设置密码<br>
      <a href=http://127.0.0.1:8080/drs/home/page/newPwd.html?key='$this->_key'/nowtime=".$nowtime.">修改密码
      </a><br>如果点击链接不能直接跳转，请将链接复制到浏览器的地址栏中访问。";

			$mailbody = $html;
			//邮件格式（HTML/TXT）,TXT为文本邮件
			$mailtype = "HTML";
			//这里面的一个true是表示使用身份验证,否则不使用身份验证.
			$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
			//是否显示发送的调试信息 测试阶段改成true
			$smtp->debug = false;
			//发送邮件
			//$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $html, $mailtype);
			$a =$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
			if ($a) {
				echo 1;
			} else {
				echo 0;
			}
		}else{
			//填写正确的email
		}
	}
}

$f = new Forget();
$f->forgetPwd();
