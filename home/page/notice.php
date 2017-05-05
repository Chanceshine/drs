<?php
session_start();
require_once("../control/oneNotice.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>公告通知</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/oneNotice.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include 'header.php';?>
	<!-- 内容 -->
	<div id="content">
		<ol class="breadcrumb">
		您的位置是：
			<li><a href="index.php">首页</a></li>
			<li><a href="noticeList.php">公告通知</a></li>
			<li class="active">正文</li>
		</ol>	
		<div id="title">
			<img src="../img/noticeTitle.png " width="30px">[标题] <?php echo $rows[1]['title']?>
		</div>

		<article>
			<center><h2><?php echo $rows[1]['title']?></h2></center>
			<div class="info">
				<span>作者：<?php echo $rows[1]['author']?></span>
				<span>更新时间：<?php echo $rows[1]['time']?></span>
			</div>
			<div class="text">
				<?php echo $rows[1]['content']?>
			</div>
		</article>

		<div class="other row">
			<span class="prev">上一篇：<?php 
				if ($rows[0]['id']) {
					echo "<a href='notice.php?id=".$rows[0]['id']."'>".$rows[0]['title']."</a>";
				} else {
					echo "没有了";
				}?>
			</span>
			<span class="next">下一篇：<?php 
				if ($rows[2]['id']) {
					echo "<a href='notice.php?id=".$rows[2]['id']."'>".$rows[2]['title']."</a>";
				} else {
					echo "没有了";
				}?>
			</span>
		</div>
	</div>
	
	<!-- 尾部 -->
	<?php include 'foot.html';?>
	<script>
		$('[data-menu]').menu();	//个人中心下拉菜单
	</script>
</body>
</html>