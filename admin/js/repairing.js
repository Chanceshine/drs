var $table = $('#table'),   //获取表格id
	$sure = $('#sureMore'), //多选删除按钮
    nselections = [];        //多选nid集合
	selections = [];        //多选id集合

$(function () {
    $('#out').find('select').change(function () {       //导出下拉菜单
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });

    $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        $sure.prop('disabled', !$table.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        selections = getIdSelections();
        nselections = getNidSelections();
        // push or splice the selections if you want to save all data selections
   	});
    $sure.click(function () {
        var ids = getIdSelections();
        var nids = getNidSelections();
        _alert2(ids,nids);
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
function getNidSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.nid
    });
}
// 添加操作按钮
function operateFormatter(value, row, index) {
    return [
        '<a class="pass" href="javascript:void(0)" title="通过审核">通过审核',
        '<i class="glyphicon glyphicon-ok"></i>',
        '</a>'
    ].join('');
}
//操作按钮事件
window.operateEvents = {
    'click .pass': function (e, value, row, index) {
        // alert('You click edit action, row: ' + JSON.stringify(row));
        var admin = localStorage.getItem('admin');
        $.ajax({
            type:'post',
            url:'../control/level.php',
            success:function (msg) {
                var json= eval('('+msg+')');
                if (row.compus == json.jurisdiction || json.level ==2) {
                    _confirm2(row);
                }else{
                    _error('您没有权限操作此项！');
                }
            }
        })
    }
};
//批量通过审核
function _alert2(ids,nids) {
    zeroModal.alert({
        content: '批量操作提示!',
        contentDetail: '确定批量将报修单标记为已完成状态？',
        okFn: function() {
            $.ajax({
                type:'post',
                url:'../control/sureRepaired.php',
                data:{
                    ids:ids,
                    nids:nids
                },
                success:function (msg) {
                    if (parseInt(msg)) {
                        _success();
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: ids
                        });
                    }
                }
            });
        }
    });
}
function _error(text) {
    zeroModal.error('请选择操作数据！');
}
function _success() {
    zeroModal.success('操作成功!');
}

