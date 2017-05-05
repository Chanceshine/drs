<?php
	session_start();
	require_once("../control/readMore.php");
	if(!isset($_SESSION['user'])){
    	echo "<script>window.location.href='../page/login.html';</script>";
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>服务评价/投诉</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/star-rating-svg.css">
	<link rel="stylesheet" type="text/css" href="../css/zeroModal.css">
	<link rel="stylesheet" type="text/css" href="../css/readMore.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<link rel="stylesheet" type="text/css" href="../css/evaluate.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/zeroModal.min.js"></script>
	<script type="text/javascript" src="../js/jquery.star-rating-svg.min.js"></script>
	<script type="text/javascript" src="../js/evaluate.js"></script>
</head>
<body>
<!-- 头部 -->
<?php include 'header.php';?>

<div class="container">

<?php if (isset($_GET['nid']) && $_GET['nid'] != 1): ?>

	<label>当前报修单编号为：<span id="nid"><? echo $_GET['nid'];?></span> </label>
	<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#more" aria-expanded="false" aria-controls="more">
	查看报修详情
	</button>
	<div class="collapse" id="more">
		<div class="well">
			<? include 'more.php';?>
		</div>
	</div>

<!-- Nav tabs -->
	<ul class ="nav nav-tabs" role="tablist">
		<li role  ="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">服务评价</a></li>
		<li role  ="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">投诉</a></li>
	</ul>

	<div class="tab-content">
		<!-- 服务评价 -->
		<div role="tabpanel" class="tab-pane fade in active" id="home">
			<div class="box">
				<div class="row">
					<div class="col-md-6 block">
						<label class="col-xs-3">维修员评分</label>
						<div class="col-xs-9 r-rating"></div>	<!-- 星星 -->
						<div class="clearfix visible-xs-block"></div>
						<label class="col-xs-3 text">维修员评价：</label>
						<textarea id="revaluate" name="revaluate" class="col-xs-9 text" placeholder="在这里评价维修员" maxlength="100"></textarea>
					</div>
					<div class="clearfix visible-xs-block"></div>
					<div class="col-md-6 block">
						<label class="col-xs-3">报修服务评分</label>
						<div class="col-xs-9 s-rating"></div>
						<label class="col-xs-3 text">报修服务评价：</label>
						<textarea id="sevaluate" name="sevaluate"  class="col-xs-9 text" placeholder="在这里评价报修服务" maxlength="100"></textarea>
					</div>				
				</div>
				
				<div class="row">
					<button id="submit" class="btn btn-success btn-lg">提交</button>
				</div>
			</div>
		</div>

		<!-- 投诉 -->
		<div role="tabpanel" class="tab-pane fade" id="profile">
			<div class="box">
				<label for="complain">投诉理由（200字以内）</label>
				<textarea id="complain" class="form-control" aria-describedby="helpBlock" placeholder="为方便我们为您解答，请在此输入投诉详情"></textarea>
				<span id="helpBlock" class="help-block">收到投诉后，我们将在7个工作日内给您回复.</span>
				<div class="row">
					<button id="btn" class="btn btn-success btn-lg">提交</button>
				</div>
			</div>			
		</div>
	</div>
	
<?php else: ?>
	<div class='remind center-block'>
        <div class='row'>
            <img src='../img/text.jpg' width='100px'>
            您暂时没有已完成的报修单哦，查看 <strong><a href='record.php'>我的报修记录</a></strong>
        </div>
    </div>
<?php endif ?>	
</div>

</body>
</html>