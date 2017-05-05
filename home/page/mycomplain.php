<?
session_start();
	if(!isset($_SESSION['user'])){
    	echo "<script>window.location.href='../page/login.html';</script>";
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>我的投诉</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/common.css">
	<link rel="stylesheet" type="text/css" href="../css/complain.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/pagination.min.js"></script>
	<script type="text/javascript" src="../js/materialMenu.min.js"></script>
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
						<li class="active nowitem">我的投诉</li>
					</ol>
					<div id="box">
						<div class="data-container">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>报修单号</th>
										<th>投诉理由</th>
										<th>投诉时间</th>
										<th>后勤回复</th>
										<th>回复时间</th>
										<th>操作</th>
									</tr>
								</thead>
							</table>
						</div>
						<div id="pagination-demo1"></div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>
<? include 'nav.html';?>

<script type="text/javascript">
$(function(){

	$('.changePwd').on('click',function () {
		$('.nowitem').html('更改密码');
		$('#box').load('../page/rePassword.html');
	});
	$('.data').on('click',function () {
		$('.nowitem').html('修改资料');
		$('#box').load('../page/changeData.html');
	})
//获取数据后，分页
	function createDemo(name){
		var container = $('#pagination-' + name);
		var sources = function(done){
			$.ajax({
				type: 'GET',
				url: '../control/complain.php',
				success: function(msg){
					var json = eval('('+msg+')');
					done(json);
				}
			});
		};

		var options = {
			dataSource: sources,
			className: 'paginationjs-theme-blue',
			callback: function(json, pagination){
			window.console && console.log(json, pagination);

			var dataHtml = '';

			$.each(json, function(index, item){
			dataHtml += '<tr><td>'+ json[index].nid +'</td><td class="complainText">'+json[index].complain+'</td><td>'+json[index].posttime+'</td><td class="replyText">'+json[index].reply+'</td><td>'+json[index].replytime+'</td><td><a role="button" data-toggle="collapse" data-parent="#accordion" href="#'+json[index].nid+'" aria-expanded="true" aria-controls="'+json[index].nid+'">查看投诉详情</a></td></tr><tr><td colspan="6"><div id="'+json[index].nid+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"><div class="panel-body"><p><label>您的投诉情况： </label> '+json[index].complain+'</p><p><label>后勤回复： </label> '+json[index].reply+'</div></div></td></tr>';
			});

			$('.table').append(dataHtml);
			}
		};

		container.addHook('beforeInit', function(){
			window.console && console.log('beforeInit...');
		});
		container.pagination(options);

		container.addHook('beforePageOnClick', function(){
			window.console && console.log('beforePageOnClick...');
		});

		return container;
	}
	createDemo('demo1');
});
</script>
</body>
</html>