var $table = $('#repairing');

//tab选项卡
$(function () {
	var minHeight = $('#nav').height();
	$('#tab_content').css('minHeight',minHeight);

	var widget = $('.tabs-vertical');

    var tabs = widget.find('ul a'),
        content = widget.find('.tabs-content-placeholder > section');

    tabs.on('click', function (e) {
        e.preventDefault();
        var index = $(this).data('index');
        
        tabs.removeClass('tab-active');
        content.removeClass('tab-content-active');

        $(this).addClass('tab-active');
        content.eq(index).addClass('tab-content-active');
    });
});
$.ajaxSetup ({ 
    cache: false //关闭AJAX相应的缓存 
});
function operateFormatter(value, row, index) {
    return [
        '<a class="more" target="_blank" href="readMore.php?nid='+row.nid+'" title="查看详情">查看详情',
        '<i class="glyphicon glyphicon-chevron-right"></i>',
        '</a>'
    ].join('');
}
function operateFormatterMore(value, row, index) {
    return [
        '<a class="more" target="_blank" href="readMore.php?nid='+row.nid+'" title="查看详情">查看详情',
        '<i class="glyphicon glyphicon-chevron-right"></i>',
        '</a> ',
        '<a class="right sure" target="_blank" href="javascript:void(0)" title="确认完成">确认完成',
        '<i class="glyphicon glyphicon-ok"></i>',
        '</a>'
    ].join('');
}
function operateFormattereval(value, row, index) {
    return [
        '<a class="more" target="_blank" href="readMore.php?nid='+row.nid+'" title="查看详情">查看详情',
        '<i class="glyphicon glyphicon-chevron-right"></i>',
        '</a> '
    ].join('');
}
function appeal(value, row, index) {
    return [
        '<a class="more" target="_blank" href="readMore.php?nid='+row.nid+'" title="查看详情">查看详情',
        '<i class="glyphicon glyphicon-chevron-right"></i>',
        '</a> ',
        ' <a class="right appeal" href="javascript:void(0)" title="申诉"> 申诉',
        '<i class="glyphicon glyphicon-phone-alt"></i>',
        '</a>'
    ].join('');
}

//操作按钮事件
window.operateEvents = {
    'click .sure': function (e, value, row, index) {
        // alert('You click edit action, row: ' + JSON.stringify(row));
        _confirm2(row);
    },
    'click .appeal': function (e, value, row, index) {
        // alert('You click edit action, row: ' + JSON.stringify(row));
        if (row.currentStatus =='最终驳回') {
            _error('此报修单已为最终驳回状态，不可再申诉');
        }else{
            $('#appeal').modal('show');
            $('.modal-footer').on('click','#pass',function () {
                $.ajax({
                    url: '../control/appeal.php',
                    type: 'POST',
                    data: {
                        nid:row.nid,
                        reason: $('#reason').val()
                    },
                })
                .done(function() {
                    _success();
                    $('#appeal').modal('hide');
                    $('#myModal').on('hidden.bs.modal', function (e) {
                        window.location.href="../page/record.php";
                    })
                    console.log("success");
                })
                .fail(function() {
                    _error('操作发生错误!');
                    console.log("error");
                })
                .always(function() {                
                    $('#reason').val('');
                    console.log("complete");
                });
            })
        } 
    }
};
function _confirm2(row) {
    zeroModal.confirm({
        content: '确定当前报修单已完成吗？',
        contentDetail: '提交后将不能进行修改。',
        okFn: function() {
            $.ajax({
                type:'post',
                url:'../control/sureRepaired.php',
                data:{
                    nid : row.nid
                },
                success:function (msg) {                    
                    if (msg==1) {                        
                        _alert2();
                    }else{
                        _error();
                    }                    
                }
            });
        },
        cancelFn: function() {
            
        }
    });
}

function _error(text) {
    zeroModal.error(text);
}

function _success() {
    zeroModal.success('操作成功!');
}
function _alert2() {
    zeroModal.alert({
        content: '操作成功!',
        contentDetail: '所选报修单已确认完成，您可以进行评价啦~',
        okFn: function() {
            window.location.href="../page/record.php";
        }
    });
}