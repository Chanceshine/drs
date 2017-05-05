var $table = $('#table'),   //获取表格id
	$disMore = $('#disMore'), //多选删除按钮
    nselections = [];        //多选nid集合
	selections = [];        //多选id集合

$(function () {
    $('#out').find('select').change(function () {       //导出下拉菜单
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });

    $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
        $disMore.prop('disabled', !$table.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        selections = getIdSelections();
        nselections = getNidSelections();
        // push or splice the selections if you want to save all data selections
   	});
    $disMore.click(function () {
        var ids = getIdSelections();
        var nids = getNidSelections();
        $('#myModal').modal({
            keyboard: false,
            show: true,
            backdrop: 'static'
        });

        $('#page').on('click','button', function(e) {
            e.preventDefault();
            var rid = $(this).data('index');    //获取维修员ID  
            _confirm1(ids,nids,rid);
        });
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
        '<a class="distribute" href="javascript:void(0)" title="分配维修员">派员',
        '</a>'
    ].join('');
}
//操作按钮事件
window.operateEvents = {
    'click .distribute': function (e, value, row, index) {
        // alert('You click edit action, row: ' + JSON.stringify(row));
        $('#myModal').modal({
            keyboard: false,
            show: true,
            backdrop: 'static'
        });
        var nid = row.nid;      //获取报修单ID
        
        $('#page').on('click','button', function(e) {
            e.preventDefault();
            var rid = $(this).data('index');    //获取维修员ID  
            _confirm2(row,rid);
            $('#page').off('click', 'button');
        });
    }
};
//单条操作
function _confirm2(row,rid) {
    zeroModal.confirm({
        content: '确定选择该维修员吗？',
        contentDetail: '提交后将不能进行修改。',
        okFn: function() {
            $.ajax({
                type:'post',
                url:'../control/distribute.php',
                data:{
                    nid:row.nid,    //报修单ID
                    rid:rid         //维修员ID
                },
                success:function (msg) {
                    if (msg ==1) {
                        $('#myModal').removeClass('fade');
                        $('#myModal').modal('hide');
                        _success();                        
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        });
                    }
                }
            });
        },
        cancelFn: function() {
            
        }
    });
}
function _confirm1(ids,nids,rid) {
    zeroModal.confirm("确定批量分配给该维修员吗？", function() {
        $.ajax({
            type:'post',
            url:'../control/distributeMore.php',
            data:{
                ids:ids,            //id集
                nids:nids,        //报修单ID
                rid:rid         //维修员ID
            },
            success:function (msg) {
                if (parseInt(msg)>0) {
                    $('#myModal').removeClass('fade');
                    $('#myModal').modal('hide');
                    _success();                        
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: ids
                    });
                }
            }
        });
    });
}

function _success() {
    zeroModal.success('操作成功!');
}

