<?php
	if(isset($_POST)){
		$i=$_POST['i'];
		$s2option=array();
		//此处可查询数据库组织数据
		switch ($i) {
			case 1:
				$s2option=array(
					array('key'=>'1','value'=>'学生宿舍区'),
					array('key'=>'2','value'=>'教师宿舍区'),
				);
				break;
			case 2:
				$s2option=array(
					array('key'=>'3','value'=>'学生宿舍区'),
					array('key'=>'4','value'=>'教师宿舍区'),
				);
				break;
			default:
				break;
		}
		echo json_encode($s2option);
	}
?>