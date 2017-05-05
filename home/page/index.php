<?php
	session_start();
	require_once("../control/showNotice.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">	
	<link rel="stylesheet" type="text/css" href="../css/notice.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/dotdotdot.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include 'header.php';?>
	<!-- 内容 -->
	<div class="content">
		<!-- 公告显示 -->
		<div class="notice">
			<div class="container">
	            <div class="row">
	                <div class="col-md-12" style="padding: 1em 0;">
						<div id ="news-slider" class="owl-carousel">
						<?php
							if(isset($rows)){
								foreach($rows as $row){
									echo"
	                        <div class='post-slide'>
	                            <div class='post-img'>
	                                <a href='#'><img src='../img/notice.jpg'></a>
	                            </div>
	                            <div class='post-content'>
	                                <h3 class='post-title' title=".$row['title'].">".$row['title']."</h3>
	                                <p class='post-description'>".$row['content']."</p>
	                                <ul class='post-bar'>
	                                    <li><i class='fa fa-calendar'></i> ".$row['time']."</li>
	                                </ul>
	                                <a href='notice.php?id=".$row['id']."' target='_blank' class='read-more'>查看详情</a>
	                            </div>
	                        </div>
		                 ";
	                        	}
	                        }
	                    ?>
	                    </div>
	                </div>
	            </div>
	            <div id="more" class="row">
	            	<a href="noticeList.php" target="_blank">查看更多公告>></a>
	            </div>
		    </div>
		</div>
		<div class="button">
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<div class="btn-group" role="group">
					<a href="register.php" type="button" class="btn btn-success" target="_blank">我要报修</a>
				</div>
				<div class="btn-group" role="group">
					<a href="schedule.php" type="button" class="schedule btn btn-primary" target="_blank">查看报修进度 </a>
				</div>
				<!-- <div class="btn-group" role="group">
			 		<a href="evaluate.php" type="button" class="btn btn-info" target="_blank">服务评价/投诉</a>
				</div> -->
				<div class="btn-group" role="group">
			 		<a href="javascript:void(0)" id="evaluate" type="button" class="btn btn-info">服务评价/投诉</a>
				</div>
			</div>
		</div>
	</div>

	<?php include "foot.html";?>	

	<script type="text/javascript">
        $(document).ready(function() {		//公告轮播
            $("#news-slider").owlCarousel({
                items:3,
                itemsDesktop:[1199,2],
                itemsDesktopSmall:[980,2],
                itemsMobile:[600,1],
                pagination:false,
                navigationText:false,
                autoPlay:true
            });
        });

        $('[data-menu]').menu();	//个人中心下拉菜单

        $(function() {
	    	$(".post-description").dotdotdot({
	    	});
    	});

    	$.ajax({
    		type:'post',
    		url:'../control/newMsg.php',
    		success:function (msg) {
    			if (parseInt(msg)>0) {
    				$('.schedule').append("<span class='badge'>新消息</span>");
    			}
    		}
    	});

    	$('#evaluate').on('click' , function(){
    		$.ajax({
    			url: '../control/isEvaluate.php',
    			type: 'GET',
    		})
    		.done(function(msg) {
    			if (msg == 0) {
    				window.location.href='login.html';
    			}else{
    				window.open('evaluate.php?nid='+msg);
    			}
    			console.log("success");
    		})
    		.fail(function() {
    			console.log("error");
    		})
    		.always(function() {
    			console.log("complete");
    		});    		
    	});

    </script>
</body>
</html>