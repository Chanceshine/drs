<?php
session_start();

class Out{
	public static function safeOut(){
		$_SESSION=array();
		if(isset($_COOKIE[session_name()])){
			unset($_SESSION['admin']);
		}
		if(session_destroy()){
			echo "<script>window.location.href='../index.html';</script>";
		}
	}
}
Out::safeOut();
?>