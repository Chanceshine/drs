<?php
	session_start();
	if(!isset($_SESSION['admin'])){
    	echo "<script>window.location.href='../index.html';</script>";
    }
	require_once '../control/showInfo.php';
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<title>后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/sidebar-menu.css">
	<link rel="stylesheet" type="text/css" href="../css/formValidation.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/sidebar-menu.js"></script>
	<script type="text/javascript" src="../js/formValidation.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/home.js"></script>
	<script type="text/javascript" src="../js/textAreaNum.js"></script>
	<script type="text/javascript" src="../js/saveData.js"></script>
</head>
<body>
<div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" data-keyboard="false">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body">
	        <img src="../img/loading.gif"> 数据交互中...
			</div>
		</div>
	</div>
</div>
	<header id="header">
		<span class="title">宿舍报修系统-后台管理</span>
		<div class="user">
			<span class="name">当前用户：<span id="newname"><?php echo $rows['user'];?></span></span>
			<input type="hidden" id="level" value='<?php echo $rows['level'];?>'>
			<a href="../control/outHandle.php">安全退出</a>
		</div>		
	</header>

	<div id="main">
		<aside class="main-sidebar">
			<section  class="sidebar">
			    <ul class="sidebar-menu">
			      	<li class="header"><i class="glyphicon glyphicon-home"></i>管理模块</li>
			      	<li class="treeview">
				        <a href="javascript:void()">
				        	<i class="glyphicon glyphicon-list-alt"></i><span>报修列表</span>
				        </a>
				        <ul class="treeview-menu">
							<li><a class="allReg" href ="javascript:void(0)"> 全部报修单</a></li>
							<li><a class="unaudited" href ="javascript:void(0)"> 待审核报修单</a></li>
							<li><a class="passed" href ="javascript:void(0)"> 待派员报修单</a></li>
							<li><a class="repairing" href ="javascript:void(0)"> 进行中报修单</a></li>
							<li><a class="repaired" href ="javascript:void(0)"> 已完成报修单</a></li>
							<li><a class="reject" href ="javascript:void(0)"> 被驳回报修单</a></li>
							<li><a class="appeal" href ="javascript:void(0)"> 被申诉报修单</a></li>							
				        </ul>
			      	</li>
			      	<li class="treeview">
				        <a href="javascript:void()">
					    	<i class="glyphicon glyphicon-envelope"></i><span>维修反馈</span>
				        </a>
				        <ul class="treeview-menu">
							<li><a class ="evaluate" href="javascript:void(0)"> 用户评价</a></li>
							<li><a class ="complain" href="javascript:void(0)"> 用户投诉</a></li>
				        </ul>
			      	</li>	    
			      	<li class="treeview">
				        <a href="javascript:void()">
					        <i class="glyphicon glyphicon-user"></i><span>人员管理</span>
				        </a>
				        <ul class="treeview-menu">
				        	<li><a class="repairTable" href="javascript:void()"> 维修人员列表</a></li>
				        	<li><a class="addRepair" href="javascript:void()"> 添加维修人员</a></li>
				        	<?php
				        		if ($rows['level'] == 2 ) {
				        			echo "<li><a class='addAdmin' href='javascript:void()'> 添加管理员</a></li>
				        				<li><a class='adminTable' href='javascript:void()'>管理人员列表</a></li>";
				        		}				        	
				        	?>
				        </ul>
			      	</li>
			    	<li class="treeview">
				        <a href="javascript:void()">
				        	<i class="glyphicon glyphicon-volume-up"></i><span>公告管理</span>
				        </a>
				        <ul class="treeview-menu">
				        	<li><a class="announcement" href="javascript:void()"> 发布公告</a></li>
				        	<li><a class="pubHistory" href="javascript:void()"> 历史公告</a></li>
				        </ul>
			    	</li>
			    	<li class="header"><i class="glyphicon glyphicon-lock"></i>个人信息</li>
			    	<li><a class="changePwd" href="javascript:void(0)"><i class="glyphicon glyphicon-pencil"></i> <span>修改密码</span></a></li>
			    </ul>
			</section>
		</aside>
		<div id="box">
			<div class="welcome">
				<img src="../img/admin.png">
				<div class="right">
					<p>管理员</p>
					<p>欢迎进入宿舍报修系统后台管理系统!</p>
				</div>
			</div>
			<div class="info">
				<div class="bg">您的相关信息</div>
				<div class="msg">
					<form id="dataForm" class="form-inline" method="post" action="../control/saveInfo.php">
						<div class="form-group">
							<label for="user" class="control-label">昵称：</label>
							<input id="user" class="form-control" name="user" type="text" value="<?php echo $rows['user']?>" disabled required>
						</div>
						<p>姓名：<?php echo $rows['realname']?></p>
						<p>所在校区：<span class="compus"><?php echo $rows['compus']?></span></p>
						<button type="button" name="revise" class="btn btn-primary revise">修改信息</button>
						<button type="submit" name="refer" class="btn btn-success save" data-toggle="modal" data-target=".bs-example-modal-sm">保存</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<script>
	    $.sidebarMenu($('.sidebar-menu'));
	</script>
</body>
</html>