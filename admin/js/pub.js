$(function () {
	function createTable(name){
        var container = $('#pagination-' + name);
        var sources = function(done){
            $.ajax({
		        type: 'POST',
		        url: '../control/pub.php',
		        success: function(response){
		        	var json= eval('('+response+')');
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
                for(var i=0;i<json.length;i++){
	                dataHtml += '<tr>'+
	                '<td><input type="checkbox"></input></td>'+
	                '<td class="pubTitle" title="'+json[i].title+'">'+json[i].title+'</td>'+ 
	                '<td class="pubContent">'+json[i].content+'</td>'+
	                '<td>'+json[i].time+'</td>'+
	                '<td>'+json[i].author+'</td>'+
	                '<td><span class="option">查看</span>|<span class="option">修改</span>|<span class="option">删除</span></td>'
	                '</tr>';
	            };

                $('.data-container').html(dataHtml);
            }
        };

        container.addHook('beforeInit', function(){
            window.console && console.log('beforeInit...');
        });
        container.pagination(options);

        container.addHook('beforePageOnClick', function(){
            window.console && console.log('beforePageOnClick...');
            //return false
        });

        return container;
    };
    $.extend($.fn.pagination.defaults, {
	    pageSize: 8
	});

    createTable('table');
	
})