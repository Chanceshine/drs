$(function () {
	//编辑事件
	$('.revise').on('click', function(event) {
		var gid = $(this).data('gid');
		$('#gid').val(gid);
		$('#edit').modal('show');
	});
	//删除事件
	$('.del').on('click', function(event) {
		var gid = $(this).data('gid');
		_confirm2(gid);
	});

	//修改表单的验证及提交  
	$('#update')
        .formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                compus: {
                    validators: {
                        notEmpty: {
                            message: '请选择对应校区'
                        }
                    }
                },
                tel: {
                    validators: {
                        notEmpty: {
                            message: '手机长号不能为空'
                        },
                        regexp: {
	                        regexp: /^(13\d|15[^4,\D]|17[13678]|18\d)\d{8}|170[^346,\D]\d{7}$/,
	                        message: '请输入正确的手机号码，仅支持中国大陆手机号码'
	                    }
                    }
                },
                cornet: {
                    validators: {
                        stringLength: {
                            max:6,
                            message: '短号长度必须在6个字符以内'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the FormValidation instance
            var bv = $form.data('formValidation');
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
                $('#edit').modal('hide');
                _success('修改成功!');
				$('#edit').on('hidden.bs.modal', function (e) {
					$('#box').load('../page/adminTable.php');
				});
            }, 'json');
        });
});
function _success(text) {
	zeroModal.success(text);
}
function _confirm2(gid) {
    zeroModal.confirm({
        content: '确定删除该维修员吗？',
        contentDetail: '删除后将不能回复。',
        okFn: function() {
            $.ajax({
            	url: '../control/delAdmin.php',
            	type: 'post',
            	data: {
            		gid: gid
            	},
            })
            .done(function() {
            	console.log("success");
            	 _success('删除成功!');
				$('#box').load('../page/adminTable.php');
            })
            .fail(function() {
            	console.log("error");
            })
            .always(function() {
            	console.log("complete");
            });            
        },
        cancelFn: function() {
           
        }
    });
}
function _error() {
    zeroModal.error('数据交互失败!');
}