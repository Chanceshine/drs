$(function () {
	$.extend($.fn.pagination.defaults, {
	    pageSize: 5
	})
	function createDemo(name){
	    var container = $('#pagination-' + name);
	    var sources = function(done){
			$.ajax({
				type: 'GET',
				url: '../control/distributeRep.php',
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
	                dataHtml += '<tr><td>'+json[index].id+'</td><td>'+json[index].rid+'</td><td>'+json[index].rname+'</td><td>'+json[index].rsex+'</td><td>'+json[index].rcompus+'</td><td class="functions" title="'+json[index].functions+'">'+json[index].functions+'</td><td><button class="btn btn-primary" data-index="'+json[index].rid+'">选择</button></td></tr>';
	            });

	            container.prev('.data-container').find('tbody').html(dataHtml);
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
	
})

