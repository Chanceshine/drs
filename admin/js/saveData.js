$(function () {
	$('.revise').click(function () {
		$('.save').show();
		var sel='<select id="compus" name="compus"><option selected="selected">松山湖校区</option><option>莞城校区</option></select>';
		$("#user").removeAttr("disabled").focus().css({
			'background': '#fff',
			'border': '1px solid #77c5fe'
		});
		$('.compus').html("").html(sel);
	});

	$('#dataForm').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user: {
                validators: {
                    notEmpty: {
                        message: '昵称不能为空'
                    },
                    remote: {
                        type: 'POST',
                        url: '../control/reUser.php',
                        message: '该昵称已被使用',
                    },
                    stringLength: {
			    		max: 12,
			    		message: '昵称长度不得超过12个字符'
			    	},
                }	                
            },
            compus:{

            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();		// Prevent form submission
        var $form = $(e.target);	// Get the form instance
		var bv = $form.data('formValidation');		// Get the FormValidation instance
        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function(result) {
            console.log(result);
        },'json');
        var compus = $("#compus option:selected").text();
        $('.save').hide();
        $('.modal').hide();
        $('.form-group').removeClass('has-success');
        $('.form-control-feedback').hide();
		$('#newname').html($('#user').val());
		$('#user').val($('#user').val()).attr('disabled','"disabled"').css({
			'background': '#eee',
			'border': 0
		});
        $('.compus').html(compus);
    });
})