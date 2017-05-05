<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>通知列表</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/noticeList.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/pagination.min.js"></script>
</head>
<body>
<!-- 头部 -->
<?php include 'header.php';?>
<!-- 内容 -->
	<div id="content">
		<ol class="breadcrumb">
		您的位置是：
			<li><a href="index.php">首页</a></li>
			<li><a href="noticeList.php" class="active">公告通知</a></li>
		</ol>	
		<div id="title">
			<img src="../img/noticeTitle.png " width="30px">通知列表
		</div>

		<div class="list">
			<section>
		        <div class="data-container"></div>
		        <div id="pagination-demo1"></div>
		    </section>
		</div>
	</div>
	<!-- 尾部 -->
<?php include 'foot.html';?>

	<script type="text/javascript">
		$(function(){
			//获取数据后，分页
	        function createDemo(name){
	            var container = $('#pagination-' + name);
	            var sources = function(done){
					$.ajax({
						type: 'GET',
						url: '../control/noticeList.php',
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
	                    var dataHtml = '<ul>';
	                    $.each(json, function(index, item){
	                        dataHtml += '<li><img src="../img/pointLeft.jpg" width="15px"><a href="notice.php?id='+json[index].id+'">'+ json[index].title +'<span class="time">'+json[index].time+'</span></li>';
	                    });
	                    dataHtml += '</ul>';
	                    container.prev().html(dataHtml);
	                    $('.data-container li:odd').css('background','#eee');
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