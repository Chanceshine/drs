var $table = $('#table'),   //获取表格id
    $details = $('#details'), //多选删除按钮
    selections = [];        //多选id集合

$(function () {
    $('#out').find('select').change(function () {       //导出下拉菜单
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });

    $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        	$details.prop('disabled', !$table.bootstrapTable('getSelections').length);
            // save your data, here just save the current page
            selections = getIdSelections();
            // push or splice the selections if you want to save all data selections
   	});
    $details.click(function () {
        var nids = getIdSelections();
        nid = nids[0];
        // alert(nid);
        _iframe(nid);
    });
});

/**
 * [getIdSelections 获取ID]
 * @return {[type]} [返回id]
 */
function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.nid
    });
}
function _iframe(nid) {
    zeroModal.show({
        title: '报修单详情',
        iframe: true,
        url: '../page/readMore.php?nid='+nid,
        width: '80%',
        height: '80%',
        cancel: true
    });
}