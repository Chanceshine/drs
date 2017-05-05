var $table = $('#table'),   //获取表格id
	selections = [];        //多选id集合

$(function () {
    $('#out').find('select').change(function () {       //导出下拉菜单
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });

    $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        $pass.prop('disabled', !$table.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        selections = getIdSelections();
        nselections = getNidSelections();
        // push or splice the selections if you want to save all data selections
   	});
});
/**
 * [getIdSelections 获取ID]
 * @return {[type]} [返回id]
 */
function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.id
    });
}
// 添加操作按钮
function operateFormatter(value, row, index) {
    return [
        '<a class="pass" href="javascript:void(0)" title="通过申诉请求">通过',
        '<i class="glyphicon glyphicon-ok"></i>',
        '</a>', 
        '<a class="lastReject" href="javascript:void(0)" title="最终驳回">最终驳回',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}
//操作按钮事件
window.operateEvents = {
    'click .pass': function (e, value, row, index) {
        _confirm2(row);
    },
    'click .lastReject': function (e, value, row, index) {
        _confirm1(row);
    }
};
//通过审核
function _confirm2(row) {
    zeroModal.confirm({
        content: '确定通过申诉请求吗？',
        contentDetail: '申诉通过后报修单将回到待分配列表。',
        okFn: function() {
        	$.ajax({
        		type:'post',
        		url:'../control/revoke.php',         //将regs状态改为1
        		data:{
        			nid:row.nid,
        		},
        		success:function (msg) {
        			if (msg ==1) {
                        _success();
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        });
                    }else{
                        _error('操作错误');
                    }
        		}
        	});			
        },
        cancelFn: function() {

        }
    });
}
//驳回
function _confirm1(row) {
    zeroModal.confirm("确定最终驳回吗？", function() {
        $('#myModal').modal({
            keyboard: false,
            show: true,
            backdrop: 'static'
        });
        $('#send').click(function (e) {
            if ($('#message-text').val()=='') {
                $('#message-text').focus();
            } else {
                $.ajax({
                    type:'post',
                    url:'../control/lastReject.php',        //将regs状态改为6
                    data:{
                        nid:row.nid,
                        othertext:$('#message-text').val()
                    },
                    success:function (msg) {
                        if (msg == 1) {
                            $('#myModal').modal('hide');
                            _success();
                            $table.bootstrapTable('remove', {
                                field: 'id',
                                values: [row.id]
                            });
                        }
                    }
                });
            }            
        })
    });
}

function _error(text) {
    zeroModal.error(text);
}
function _success() {
    zeroModal.success('操作成功!');
}

