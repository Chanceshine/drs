$('[data-menu]').menu();	//个人中心下拉菜单

$('.VivaTimeline').vivaTimeline({
	carousel: false,
	carouselTime: 3000     //进度项轮播
});

$('#sure').on('click', function(event) {
    var index = $(this).data('index');
    _confirm1(index);       //确定完成报修单
});

function _confirm1(nid) {
    zeroModal.confirm("确定维修已完成吗？", function() {
        $.ajax({
            type:'post',
            url:'../control/sureRepaired.php',
            data:{
                nid:nid,
            },
            success:function (msg) {
                if (msg) {
                    _alert2();
                }                
            }
        });
    });
}
function _alert2() {
    zeroModal.alert({
        content: '操作成功!',
        contentDetail: '当前报修单已确定完成',
        okFn: function() {
            window.location.href='../page/schedule.php';
        }
    });
}