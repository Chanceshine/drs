<?php
session_start();

class Out{
	public static function safeOut(){
		$_SESSION=array();
		if(isset($_COOKIE[session_name()])){
			unset($_SESSION['user']);// setcookie(session_name(),'',time()-1,'/');
		}
		if(session_destroy()){
			echo "<script>window.location.href='../page/index.php';</script>";
		}
	}
}
Out::safeOut();
?>