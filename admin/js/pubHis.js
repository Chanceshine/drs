/**
 * [detailFormatter 展开详情]
 * @param  {[type]} index [行下标]
 * @param  {[type]} row   [行数据]
 * @return {[type]}       [html.json]
 */
function detailFormatter(index, row) {
    var html = [];
    $.each(row, function (key, value) {
        html.push('<p><b>' + key + ':</b> ' + value + '</p>');
    });
    return html.join('');
}
// $.ajaxSetup ({ 
//     cache: false //关闭AJAX相应的缓存 
// });
var $table = $('#table'),   //获取表格id
    $remove = $('#remove'), //多选删除按钮
    selections = [];        //多选id集合

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
    $remove.click(function () {
        $('.danger-body').html('您确定要删除所选项？');        
        $('.sure').show();
        $('#myModal').modal('show');

        $('.sure').click(function () {
            var ids = getIdSelections();
            $.ajax({
                type:'post',
                url:'../control/delPub.php',
                data:{
                    id:ids
                },
                success:function (msg) {
                    if(parseInt(msg)==0){
                        $('.danger-body').html('<i class="glyphicon glyphicon-remove-sign"></i> 您所删除的项目中包含无删除权限项！');
                        $('.sure').hide();
                        $('#myModal').modal('show');
                    }else{
                        $('.danger-body').html('删除成功！');
                        $('.sure').hide();
                        $('#myModal').modal('show');
                        $table.bootstrapTable('remove', {       //删除处理
                            field: 'id',
                            values: ids
                        });
                        $remove.prop('disabled', true);
                    }
                }
            });   
        })
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
        '<a class="edit" href="javascript:void(0)" title="修改">修改',
        '<i class="glyphicon glyphicon-pencil"></i>',
        '</a>', 
        '<a class="remove" href="javascript:void(0)" title="删除">删除',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}
//操作按钮事件
window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        // alert('You click edit action, row: ' + JSON.stringify(row));
        var admin = localStorage.getItem('admin');
        $.ajax({
            type:'post',
            url:'../control/level.php',
            success:function (msg) {
                var json= eval('('+msg+')');
                if (row.author == admin || json.level ==2) {
                    $('#title_name').val(row.title);
                    $('#content_text').val(row.content);
                    $('#editModal').modal('show');
                }else{
                    $(".danger-body").html('您没有权限修改此项！');
                    $('#myModal').modal('show');
                }
            }
        })
    },
    'click .remove': function (e, value, row, index) {
        $table.bootstrapTable('remove', {
            field: 'id',
            values: [row.id]
        });
    }
};