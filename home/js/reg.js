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
				_alert1('填写','设备故障描述');
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
							setTimeout("window.location.href='../page/schedule.php'", 2000);
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
/**
 * [Trim 字符串去空格]
 * @param {[type]}  str       [原字符串]
 * @param {Boolean} is_global [是否匹配全部]
 */
function Trim(str,is_global){
	var result;
	result = str.replace(/(^\s+)|(\s+$)/g,"");
	if(is_global.toLowerCase()=="g"){
		result = result.replace(/\s/g,"");
	}
	return result;
}