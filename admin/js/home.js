$(function () {
	// $(window).width()浏览器视口宽度
	// $(window).width()-$('.main-sidebar').width()
	var box=$(window).width()-$('.main-sidebar').width();//#box的宽度
	$('#box').css('width',box);
	$.ajaxSetup ({ 
	    cache: false //关闭AJAX相应的缓存 
	});
/************ajax交互*************/
	$(document).ajaxStart(function () {
		$('.loading').show();
	}).ajaxStop(function () {
		$('.loading').hide();
	});
/************报修单*************/
	// $('.allReg').on('click',function () {
	// 	$('#box').load('../page/regsTable.php?r='+Math.random());
	// });
	/*******全部报修单********/
	$('.allReg').click(function () {
		$('#box').load('../page/regsTable.php');
	});
	/******未审核报修单*******/
	$('.unaudited').on('click',function () {
		$('#box').load('../page/unaudited.html');
	});
	/******待派员报修单*******/
	$('.passed').on('click',function () {
		$('#box').load('../page/distribute.html');
	});
	/******进行中报修单*******/
	$('.repairing').on('click',function () {
		$('#box').load('../page/repairing.html');
	});
	/******已完成报修单*******/
	$('.repaired').on('click',function () {
		$('#box').load('../page/repaired.html');
	});
	/******被驳回报修单*******/
	$('.reject').on('click',function () {
		$('#box').load('../page/rejectTable.html');
	});
	/******被申诉报修单*******/
	$('.appeal').on('click',function () {
		$('#box').load('../page/appealTable.html');
	});
/************评价*************/
/******学生评价*******/
$('.evaluate').on('click',function () {
	$('#box').load('../page/userEavluate.html');
});
/******学生投诉*******/
$('.complain').on('click',function () {
	$('#box').load('../page/userComplain.html');
});

/***************维修员*****************/
	/*******维修员列表*********/
	$('.repairTable').on('click',function () {
		$('#box').load('../page/repairmanTable.html');
	});
	/*******添加维修员********/
	$('.addRepair').on('click',function () {
		$('#box').load('../page/addRepair.html');
	});
	/*******添加维修员********/
	$('.addAdmin').on('click',function () {
		$('#box').load('../page/addAdmin.html');
	});
	/*******管理员列表*********/
	$('.adminTable').on('click',function () {
		$('#box').load('../page/adminTable.php');
	});

/************公告*************/
	/*******发布公告*******/
	$('.announcement').on('click',function () {
		$('#box').load('../page/announcement.html');
	});
	/*******历史公告*******/
	$(document).on('click','.pubHistory',function () {
		$('#box').load('../page/pubHistory.html');
	});

/************修改密码*************/
	$('.changePwd').on('click',function () {
		$('#box').load('../page/rePassword.html');
	});

})