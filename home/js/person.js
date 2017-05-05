$(function () {
	$.ajax({
		url: '../control/showInfo.php',
		type: 'POST'
	})
	.done(function(msg) {
		console.log("success");
		var json = eval('('+msg+')');
		$('.uid').html(json.uid);
		$('.uname').html(json.name);
		$('.compus').html(json.compus);
		$('.area').html(json.area);
		$('.address').html(json.building + json.room);
		$('.tel').html(json.tel);
		$('.cornet').html(json.cornet);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	$.ajaxSetup ({ 
	    cache: false //关闭AJAX相应的缓存 
	});
	
	$('.changePwd').on('click',function () {
		$('.nowitem').html('更改密码');
		$('#box').load('../page/rePassword.html');
	});
	$('.data').on('click',function () {
		$('.nowitem').html('修改资料');
		$('#box').load('../page/changeData.html');
	})
})