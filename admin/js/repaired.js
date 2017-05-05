var $table = $('#table'),   //获取表格id
	$del = $('#delMore'), //多选删除按钮
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
function operateFormatter(value, row, index) {
    return [
        '<a class="pass" href="javascript:void(0)" title="通过审核">通过审核',
        '<i class="glyphicon glyphicon-ok"></i>',
        '</a>', 
        '<a class="remove" href="javascript:void(0)" title="驳回">驳回',
        '<i class="glyphicon glyphicon-remove"></i>',
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
    },
    'click .remove': function (e, value, row, index) {
        _confirm1(row);
        
    }
};

//批量删除
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
function _error(text) {
    zeroModal.error('请选择操作数据！');
}
