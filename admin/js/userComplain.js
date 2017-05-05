$(function () {
	//获取数据后，分页
	function createDemo(name){
		var container = $('#pagination-' + name);
		var sources = function(done){
			$.ajax({
				type: 'GET',
				url: '../control/complain.php',
				success: function(msg){
					var json = eval('('+msg+')');
					done(json);
				}
			});
		};

		var options = {
			dataSource: sources,
			className: 'paginationjs-theme-blue',
			callback: function(json, pagination){
			window.console && console.log(json, pagination);

			var dataHtml = '';

			$.each(json, function(index, item){
				if (json[index].reply == null) {
					dataHtml += '<tr><td>'+ json[index].nid +'</td><td class="text">'+json[index].complain+'</td><td title="'+json[index].posttime+'" class="text">'+json[index].posttime+'</td><td>暂无</td><td><button data-index="'+json[index].nid+'" class="btn btn-success noreply">回复</button></td>';
				}else {
					dataHtml += '<tr><td>'+ json[index].nid +'</td><td class="text">'+json[index].complain+'</td><td title="'+json[index].posttime+'" class="text">'+json[index].posttime+'</td><td>'+json[index].replyer+'</td><td><button data-index="'+json[index].nid+'" class="btn btn-success reply" title="点击查看回复内容">已回复</button></td>';
				}
			});

			$('.table').append(dataHtml);
			}
		};

		container.addHook('beforeInit', function(){
			window.console && console.log('beforeInit...');
		});
		container.pagination(options);

		container.addHook('beforePageOnClick', function(){
			window.console && console.log('beforePageOnClick...');
		});

		return container;
	}
	createDemo('demo1');

	$.extend($.fn.pagination.defaults, {
		pageSize: 8
	});
//弹出留言框
	$('table').on('click', '.noreply', function(event) {
		var nid = $(this).data('index');	//获取当前点击的报修单号
		var btn = $(this);		//获取当前点击按钮
		$('#myModal').modal({
			backdrop: false
		});
		
		$('#send').on('click', function() {
			if ($.trim($('#msgtext').val())=='') {
				_error('请填写回复内容！');
			}else{
				$.ajax({
					url: '../control/reply.php',
					type: 'GET',
					data: {
						nid: nid,
						reply: $('#msgtext').val()
					},
				})
				.done(function(msg) {
					var json = eval('('+msg+')');

					if (json[0]>0) {
						_success();						//成功提示
						$('#msgtext').val('');			//清空文本框
						$('#myModal').modal('hide');	//关闭弹框
						btn.html('已回复');				//按钮文字改变
						btn.removeClass('noreply').addClass('reply');
						btn.parent().prev().html(json[1]);	//回复人
						btn.off();
						console.log("success");
					}else{
						_error('数据交互失败!');
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
			
		});		
	});
//点击已回复事件	
	$('table').on('click', '.reply', function(event) {
		var nid = $(this).data('index');
		var html = '';
		$.ajax({
			url: '../control/readReply.php',
			type: 'GET',
			data:{
				nid:nid
			}
		})
		.done(function(msg) {
			var json = eval('('+msg+')');
			html+= '<label>内容：</label><p>'+json.reply+'</p><label>回复时间：</label><p>'+json.replytime+'</p>';
			_params(html);
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
})
function _success() {
	zeroModal.success('操作成功!');
}
function _params(text) {
	zeroModal.show({
		title: '回复内容',
		ok: true,
		content: text
	});
}
function _error(text) {
	zeroModal.error(text);
}
	