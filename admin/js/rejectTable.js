var $table = $('#table'),   //获取表格id
	$del = $('#del'), //多选删除按钮
    nselections = [];        //多选nid集合
	selections = [];        //多选id集合

$(function () {
    $('#out').find('select').change(function () {       //导出下拉菜单
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });

    $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        $del.prop('disabled', !$table.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        selections = getIdSelections();
        nselections = getNidSelections();
        // push or splice the selections if you want to save all data selections
   	});
    $del.click(function () {
        var ids = getIdSelections();
        var nids = getNidSelections();
        
        _confirm2(ids,nids);
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
// function operateFormatter(value, row, index) {
//     return [
//         '<a class="revoke" href="javascript:void(0)" title="撤销">',
//         '<i class="glyphicon glyphicon-share-alt"></i>撤销',
//         '</a>'
//     ].join('');
// }
//操作按钮事件
window.operateEvents = {
    'click .revoke': function (e, value, row, index) {
        _alert2(row);
    }
};
//撤回操作
// function _alert2(row) {
//     zeroModal.alert({
//         content: '撤回提示!',
//         contentDetail: '报修单撤回后将回到待派员列表',
//         okFn: function() {
//             $.ajax({
//                 type:'post',
//                 url:'../control/revoke.php',
//                 data:{
//                     id:row.id,
//                     nid:row.nid
//                 },
//                 success:function (msg) {
//                     if (parseInt(msg)==1) {
//                         _success();
//                         $table.bootstrapTable('remove', {
//                             field: 'id',
//                             values: ids
//                         });
//                     }
//                 }
//             });
//         }
//     });
// }
//批量删除
function _confirm2(ids,nids) {
    zeroModal.confirm({
        content: '确定删除所选报修单吗？',
        contentDetail: '删除后将不能撤回。',
        okFn: function() {
            $.ajax({
                type:'post',
                url:'../control/delReg.php',
                data:{
                    ids:ids,
                    nids:nids
                },
                success:function (msg) {
                    if(parseInt(msg)==1){
                        _success();
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: ids
                        });
                    }
                }
            });
        },
        cancelFn: function() {
            
        }
    });
}
function _success() {
    zeroModal.success('操作成功!');
}
/************等待提示************/
function _loading(type) {
    zeroModal.loading(type);
}
