<?php
	header("content-type:text/html:charset=utf-8");
?>
<?php

class DB{
	private $_conn;
	private $_res;
	private $_row;
	private $_rows;
	public function __construct(){
		require_once("../config/db_config.php");
		//print_r($db);
		$this->_conn = mysql_connect($db['host'],$db['user'],$db['pwd']);	
		mysql_select_db($db['db']);
		mysql_query('set names utf8');
		//var_dump($this->_conn);
	}
	public function __destruct(){
		if($this->_conn){
			mysql_close($this->_conn);
		}
	}
	/*获取单条数据*/
	public function oneRow($sql){
		$this->_res=mysql_query($sql,$this->_conn);
		$this->_row=mysql_fetch_array($this->_res,MYSQL_ASSOC);
		return $this->_row;
	}
	/*获取多条数据*/
	public function moreRows($sql){
		$this->_res=mysql_query($sql,$this->_conn);
		//$this->_row=mysql_fetch_array($this->_res,MYSQL_ASSOC);
		while($this->_row=mysql_fetch_array($this->_res,MYSQL_ASSOC)){
			$this->_rows[]=$this->_row;
		}
		return $this->_rows;
	}
	public function delRow($sql){
		//$sql="delete from message where id=2";
		$this->_res=mysql_query($sql,$this->_conn);
		if(!mysql_affected_rows()){
			return 0;
		}
		return mysql_affected_rows();
	}
	//删除或更新或添加一条记录
	public function otherHandleRow($sql){
		//$sql="delete from message where id=2";
		$this->_res=mysql_query($sql,$this->_conn);
		if(!mysql_affected_rows()){
			return 0;
		}
		return mysql_affected_rows();
	}
	//统计记录条数
	public function selectNums($sql){
		$this->_res=mysql_query($sql,$this->_conn);
		//print_r($this->_res);
		//return $this->_res;
		if(!mysql_num_rows($this->_res)){
			return 0;
		}
		return mysql_num_rows($this->_res);
	}
	
}
//$db=new DB();
/*$sql="select * from message";
$row=$db->oneRow($sql);
$rows=$db->moreRows($sql);
print_r($rows);
*/
/*
$sql="delete from message where id=3";
echo $db->delRow($sql);*/
//$sql="update message set name='test' where id=4";
/*$sql="insert into message(name,introduce,old) values('qyt','beauty','22')";
echo $db->otherHandleRow($sql);*/
//$sql="select * from message";	//统计记录条数
//echo $db->selectNums($sql);

?>