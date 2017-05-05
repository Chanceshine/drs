$(document).ready(function() {
	$.ajax({
		type:"post",
		url:"../control/s1.php",
		success:function(msg){
			var json= eval('('+msg+')');
			for(var i=0;i<json.length;i++){
				$('#s1').append(new Option(json[i].value,json[i].key));
			}
		}
	});
	$('#s1').change(function(){
		$('#s2').empty();
		$('#s2').append(new Option('== 请选择 ==',''));
		$.ajax({
			type:"post",
			url:"../control/s2.php",
			data:'i='+$('#s1').val(),
			success:function(msg){
				var json= eval('('+msg+')');
				for(var i=0;i<json.length;i++){
					$('#s2').append(new Option(json[i].value,json[i].key));
				}
			}
		});
	});
	$('#s2').change(function(){
		$('#s3').empty();
		$('#s3').append(new Option('== 请选择 ==',''));
		$.ajax({
			type:"post",
			url:"../control/s3.php",
			data:'i='+$('#s2').val(),
			success:function(msg){
				var json= eval('('+msg+')');
				for(var i=0;i<json.length;i++){
					$('#s3').append('<option>'+json[i].value+'</option>');
				}
			}
		});
	});

    $('#defaultForm').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            s1: {
                validators: {
                    notEmpty: {
                        message: '请选择校区'
                    }
                }
            },
            s2: {
                validators: {
                    notEmpty: {
                        message: '请选择区域'
                    }
                }
            },
            s3: {
                validators: {
                    notEmpty: {
                        message: '请选择楼栋'
                    }
                }
            },
            roomnum: {
                validators: {
                    notEmpty: {
                        message: '房间号不能为空'
                    },
                    stringLength: {
			    		min: 1,
			    		max: 4,
			    		message: '请输入不超过4位数的房间号'
			    	},
                }
            },
            tel: {
                validators: {
                    notEmpty: {
                        message: '手机号不能为空'
                    },
                    regexp: {
                        regexp: /^(13\d|15[^4,\D]|17[13678]|18\d)\d{8}|170[^346,\D]\d{7}$/,
                        message: '请输入正确的手机号码，仅支持中国大陆手机号码'
                    }
                }
            },
        }
    }).on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();
        // Get the form instance
        var $form = $(e.target);
        // Get the FormValidation instance
        var bv = $form.data('formValidation');
        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function(result) {
            console.log(result);
            _success();
        },'json');
        setTimeout(function () {
        	window.location.href="../page/personCenter.php";
        },3000);
    });
});
function _success() {
    zeroModal.success('操作成功!');
}