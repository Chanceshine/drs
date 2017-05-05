$(function () {
    $('.alert').hide();

	$('#addadmin')
        .formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                user: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: '管理员昵称不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 12,
                            message: '昵称长度必须在2~12个字符之间'
                        },
                        remote: {
                            type: 'POST',
                            url: '../control/reUser.php',
                            message: '该昵称已存在，换一个吧',
                            //delay: 1000
                        }
                    }
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: '维修员姓名不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 6,
                            message: '姓名长度必须在2~6个字符以内'
                        }
                    }
                },
                gender: {
	                validators: {
	                    notEmpty: {
                            message: '请选择性别'
                        }
	                }
	            },
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
                },
                functions: {
                    validators: {
                        notEmpty: {
                            message: '维修员职能不能为空'
                        },
                        stringLength: {
                            max:50,
                            message: '内容长度必须在50个字符以内'
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
                $('.alert').show();
                setTimeout(function () {
                    $('.alert').hide();
                    $('#box').load('../page/addAdmin.html');
                },2000);
            }, 'json');
        });
})