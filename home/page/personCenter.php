<?php
	session_start();
	if(!isset($_SESSION['user'])){
    	echo "<script>window.location.href='../page/login.html';</script>";
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/formValidation.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/rePwd.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<link rel="stylesheet" type="text/css" href="../css/person.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/materialMenu.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/person.js"></script>
</head>
<body>

<div id="wrapper" class="wrapper">
	<!-- 头部 -->
	<?php include "header.php";?>

	<main>
		<div class="container">
			<section>
				<div class="container">
					<ol class="breadcrumb">
						<li><a href="index.php">首页</a></li>
						<li><a href="personCenter.php">个人中心</a></li>
						<li class="active">个人信息</li>
					</ol>

					<div class="aside">
						<div class="col-md-12">
							<div id="box">
								<table id="info" class="table table-striped">
								 	<thead>
								 		<th colspan="2" valign="middle">个人信息</th>
								 	</thead>
								 	<tbody>
								 		<tr>
								 			<td>学工号</td>
								 			<td class="uid"></td>
								 		</tr>
								 		<tr>
								 			<td>姓名</td>
								 			<td class="uname"></td>
								 		</tr>
								 		<tr>
								 			<td>校区</td>
								 			<td class="compus"></td>
								 		</tr>
								 		<tr>
								 			<td>区域</td>
								 			<td class="area"></td>
								 		</tr>
								 		<tr>
								 			<td>详细地址</td>
								 			<td class="address"></td>
								 		</tr>
								 		<tr>
								 			<td>联系方式</td>
								 			<td class="tel"></td>
								 		</tr>
								 		<tr>
								 			<td>短号</td>
								 			<td class="cornet"></td>
								 		</tr>
								 	</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>			
			</section>
		</div>
	</main>
</div>	
	<!-- 导航按钮 -->
	<button id="mm-menu-toggle" class="mm-menu-toggle" title="导航菜单">Toggle Menu</button>
	<label id="navtip" for="mm-menu-toggle">菜单</label>
	<!-- 菜单 -->
	<nav id="mm-menu" class="mm-menu">
		<div class="mm-menu__header">
			<h2 class="mm-menu__title">用户自服务</h2>
		</div>
		<ul class="mm-menu__items">
			<li class="mm-menu__item">
				<a class="mm-menu__link li_header" href="personCenter.php">
					<span class="mm-menu__link-text"><i class="glyphicon glyphicon-user"></i>用户中心</span>
				</a>
			</li>
			<li class="mm-menu__item">
				<a class="mm-menu__link myEvaluate" href="myEvaluate.php">
					<span class="mm-menu__link-text"><i class="glyphicon glyphicon-heart"></i>我的评价</span>
				</a>
			</li>
			<li class="mm-menu__item">
				<a class="mm-menu__link mycomplain" href="mycomplain.php">
					<span class="mm-menu__link-text"><i class="glyphicon glyphicon-remove-sign"></i>我的投诉</span>
				</a>
			</li>
			<li class="mm-menu__item">
				<a class="mm-menu__link data" href="#">
					<span class="mm-menu__link-text"><i class="glyphicon glyphicon-pencil"></i>修改资料</span>
				</a>
			</li>
			<li class="mm-menu__item">
				<a class="mm-menu__link changePwd" href="#">
					<span class="mm-menu__link-text"><i class="glyphicon glyphicon-eye-close"></i>更改密码</span>
				</a>
			</li>
		</ul>
	</nav><!-- /nav -->
	

	<script>
		$('[data-menu]').menu();	//个人中心下拉菜单

		var menu = new Menu;
	</script>
</body>
</html>