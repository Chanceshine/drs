<?php
	session_start();
	if(!isset($_SESSION['user'])){
    	echo "<script>window.location.href='../page/login.html'</script>";
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>报修登记</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/zeroModal.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<link rel="stylesheet" type="text/css" href="../css/reg.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/zeroModal.min.js"></script>
	<script type="text/javascript" src="../js/textAreaNum.js"></script>
	<script type="text/javascript" src="../js/cascade.js"></script>
</head>
<body>
	<!-- 引入头文件 -->
	<?php include 'header.php';?>	
	<div id="reg">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#home" aria-controls="home" role="tab" data-toggle="tab">填写新报修单</a>
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				<div class="form">
					<h2>宿舍报修系统 <span>报修单</span></h2>
					<hr>
					<form id="repair">
						<div>
							<div class="col">
								<label for="s1"><i>*</i> 选择校区（必选）</label>
								<select id="s1" name="s1" class="form-control" required="required">
								<option value="0">== 请选择校区 ==</option>
								</select>
							</div>
							<div class="col">
								<label for="s2"><i>*</i> 选择区域（必选）</label>
								<select id="s2" name="s2" class="form-control" required="required">
									<option>== 请先选择校区 ==</option>
								</select>
							</div>						
							<div class="col">
								<label for="s3"><i>*</i> 选择楼栋（必选）</label>
								<select id="s3" name="s3" class="form-control" required="required">
									<!-- <option>== 请先选择区域 ==</option> -->
								</select>
							</div>
							<div class="col">
								<label for="roomnum"><i>*</i> 请填写所在楼层房间号（必填，4个字符以内）</label>
								<input id="roomnum" type="text" name="roomnum" placeholder="例：第3层33号房，则填“333”即可" class="form-control" required="required" maxlength="4">
							</div>
							<div class="col">
								<label for="tel"><i>*</i> 联系电话（必填，20个字符以内）</label>
								<input id="tel" type="text" name="tel" class="form-control" required="required" maxlength="20">
							</div>
							<div class="col">
								<label for="equipment"><i>*</i> 报修设备（必选）</label>
								<select id="equipment" name="equipment" class="form-control">
									<option>电风扇</option>
									<option>水龙头</option>
									<option>空调</option>
									<option>电脑桌</option>
									<option>厕所</option>
									<option>其他</option>
								</select>
							</div>
							<div class="text">
								<label for="othertext"><i>*</i> 故障描述（必填,200个字符以内）</label>
								<textarea id="othertext" name="othertext" placeholder="例：电风扇开关损坏" class="form-control" required="required" maxlength="200"></textarea>
								<span class="wordwrap"><var class="word">200</var>/200</span>	
							</div>
							<div class="time">
								<label for="time"> 预约上门维修时间（选填,100个字符以内）</label>
								<textarea id="time" name="time" placeholder="例：每天下午5点到六点" class="form-control"></textarea>
								<span class="wordwrap"><var class="word">100</var>/100</span>	
							</div>
							<button id="submit" type="button" name="submit" class="form-control btn btn-primary">提交报修单</button>
						</div>						
					</form>
				</div>				
			</div>
		</div>
	</div>
<?php include "foot.html";?>

<script>
	$('[data-menu]').menu();	//个人中心下拉菜单
/************验证提示*************/
	function _alert1(option,text) {
		zeroModal.alert('请'+option+'您的 '+text+' 后再进行操作!');
	}
/************成功提示*************/
	function _success() {
		zeroModal.success('报修成功!等待审核');
	}
/************等待提示************/
	function _loading(type) {
        zeroModal.loading(type);
    }
/**********验证操作***********/
	$(function(){
		$('#submit').click(function () {
			if ($('#s1').val()== 0 ) {
				_alert1('选择','校区');
			}else if ($('#s2').val().length==0) {
				_alert1('选择','所在校区区域');
			}else if ($('#s3').val().length==0) {
				_alert1('选择','所在校区楼栋');
			}else if (Trim($('#roomnum').val(),'g').length==0) {
				_alert1('填写','所在楼栋房间号');
			}else if ($('#tel').val().length==0) {
				_alert1('填写','联系方式');
			}else if ($('#othertext').val().length==0) {
				_alert1('填写','报修补充说明');
			}else {
				_confirm2();	//确认提示
			}			
		});
	})
/**********提交操作***********/
	function _confirm2() {
		zeroModal.confirm({
			content: '确定提交审核吗？',
			contentDetail: '提交后将不能进行修改。',
			okFn: function() {
				$.ajax({
					type:"post",
					url:"../control/repair.php",
					data:$('form').serialize(),
					success:function (msg) {
						if (msg) {
							_success();
						} else {
							window.location.href="../page/login.html";
						}
					},
					beforeSend:function () {
						_loading(3);
					},
					complete:function () {
						$('.pacman').hide();
						$('.zeromodal-overlay').hide();
					}
				});
			},
			cancelFn: function() {
			}
		});
	}

function Trim(str,is_global){
	var result;
	result = str.replace(/(^\s+)|(\s+$)/g,"");
	if(is_global.toLowerCase()=="g"){
		result = result.replace(/\s/g,"");
	}
	return result;
}
</script>
</body>
</html>