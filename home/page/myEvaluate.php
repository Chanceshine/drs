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
	<title>我的评价</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/common.css">
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
						<li class="active nowitem">我的评价</li>
					</ol>
					<div id="box">
						<div class="data-container">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="2">报修单号</th>
										<th colspan="4">您做出的评价</th>
										<th rowspan="2">评价时间</th>
									</tr>
									<tr>										
										<th>维修员评分</th>
										<th>对维修员的评价</th>
										<th>服务评分</th>
										<th>对服务的评价</th>
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
				url: '../control/evaluate.php',
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
			dataHtml += '<tr><td>'+ json[index].nid +'</td><td>'+json[index].rscore+'</td><td>'+json[index].revaluate+'</td><td>'+json[index].sscore+'</td><td>'+json[index].sevaluate+'</td><td>'+json[index].posttime+'</td>';
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

	$.extend($.fn.pagination.defaults, {
		pageSize: 5
	}) 
});
</script>
</body>
</html>