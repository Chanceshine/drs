var $table = $('#table'),   //获取表格id
    $remove = $('#remove'), //多选删除按钮
    selections = [];        //多选id集合
    level = 0;
    gid = "";
var admin = localStorage.getItem('admin');  //获取用户名
//获取当前管理员的级别及ID
$.ajax({
    type:'post',
    async: false,
    url:'../control/level.php',
    success:function (msg) {
        var json= eval('('+msg+')');
        level = json.level;
        gid = json.gid;
    }
})
//获取所有选中id
function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.id
    });
}
// 添加操作按钮
function operateFormatter(value, row, index) {
    return [
        '<a class="edit" href="javascript:void(0)" title="修改">修改',
        '<i class="glyphicon glyphicon-pencil"></i>',
        '</a>', 
        '<a class="remove" href="javascript:void(0)" title="删除">删除',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}
//操作按钮事件（编辑、删除）
window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        // alert('You click edit action, row: ' + JSON.stringify(row));
        if (row.inputman == gid || level ==2) {
            $('#rid').val(row.rid);
            $("#compus option").each(function(i,n){
                if($(n).text() == row.rcompus){
                    $(n).attr("selected",true);
                } 
            });
            $('#tel').val(row.tel);
            $('#cornet').val(row.cornet);
            $('#functions').val(row.functions);
            $('#edit').modal('show');

            editTable(row.id);
        }else{
            _error('您没有权限修改此项！');
        }
    },
    'click .remove': function (e, value, row, index) {
        if (row.inputman == gid || level ==2) {
            var text1 = '你确定要删除此项吗？';
            var text2 = '删除后将不能恢复。';
           _confirm2(text1,text2,row.id,1);
           
        }else{
           _error('您没有权限删除此项！');
        }
    }
};

//错误操作
function _error(text) {
    zeroModal.error(text);
}
//确认提示
function _confirm2(text1,text2,rowid,num) {
    zeroModal.confirm({
        content: text1,
        contentDetail: text2,
        okFn: function () {
            if (num == 1) {
                removeOne(rowid);
            } else {
                removeMore(rowid);
            }            
        },
        cancelFn: function() {  //取消操作
            // alert('cancel');
        }
    });
}
//成功提示
function _success(text) {
    zeroModal.success(text);
}

$(function () {
    $('#out').find('select').change(function () {       //导出下拉菜单
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });

    $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        	$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            // save your data, here just save the current page
            selections = getIdSelections();
            // push or splice the selections if you want to save all data selections
   	});
    //多选删除
    $remove.click(function () {
        var ids = getIdSelections();
        var txt1 = '你确定要删除所选项吗？';
        var txt2 = '删除后将不能恢复。';
        _confirm2(txt1,txt2, ids,2);

    });
});
//修改表单的验证及提交
function editTable (row) {        
    $('#changeDate')
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
                // console.log(result);
                if (result) {
                    if (!$('#tel').val()) {
                        $('#tel').val("暂无");
                    }
                    $table.bootstrapTable('updateRow', {
                        index: (row.id-1),
                        row: {
                            rcompus: $('#compus').val(),
                            tel: $('#tel').val(),
                            cornet:$('#cornet').val(),
                            functions: $('#functions').val()                    
                        }
                    });
                    $('#edit').modal('hide');
                    _success('修改成功!');
                }                
            }, 'json');
            $('.has-success .control-label').css('color','#333');
            $('.has-success .form-control').css('border-color','#ccc');
            $('.form-control-feedback').hide();//隐藏勾
        });
    
}
//删除单人操作
function removeOne (rowid) {
    $.ajax({
        type:'post',
        cache:false,
        url:'../control/delRepairmanone.php',
        data:{
            id:rowid
        },
        success:function (msg) {
            // alert(msg);
            if (parseInt(msg)) {
               _success('删除成功！'); 
            }else{
                _error('您无权删除所选项！');
            }
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [rowid]
            });    
        }
    });
}
//删除多人操作
function removeMore (rowids) {
    $.ajax({
        type:'post',
        cache:false,
        url:'../control/delRepairmanmore.php',
        data:{
            id:rowids
        },
        success:function (msg) {
            // alert(msg);
            if (parseInt(msg)) {
                _success('删除成功！');
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: rowids
                });
            }else{
                _error('所选项中包含无权删除项！');
            }
                
        }
    });
}
