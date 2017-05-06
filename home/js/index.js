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
		}else if (msg == -1) {
            alert('您暂时没有待评价的报修单');
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
