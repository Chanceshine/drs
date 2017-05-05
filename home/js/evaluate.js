$(function () {
	$('[data-menu]').menu();	//个人中心下拉菜单

	//评分
	var rscore = 0,
		sscore = 0,
		init = 3;
	$(".r-rating").starRating({
		totalStars: 5,
		starSize: 40,
		strokeWidth: 0,
		strokeColor: 'black',		
		useFullStars:true,
		initialRating: init,
		disableAfterRate:false,
		hoverColor:'#77c5fe',
		starGradient: {
			start: '#77c5fe',
			end: '#77c5fe'
		},
		callback: function(currentRating, $el){
			rscore = currentRating;
			// alert('rated ' + currentRating);
			console.log('DOM element ', $el);
		}
	});

	$(".s-rating").starRating({
		totalStars: 5,
		starSize: 40,
		strokeWidth: 0,
		strokeColor: 'black',		
		useFullStars:true,
		initialRating: init,
		disableAfterRate:false,
		hoverColor:'#77c5fe',
		starGradient: {
			start: '#77c5fe',
			end: '#77c5fe'
		},
		callback: function(currentRating, $el){
			sscore = currentRating;
			// alert('rated ' + currentRating);
			console.log('DOM element ', $el);
		}
	});

	$('#submit').on('click', function() {
		if (rscore==0) {
			rscore = init;
		}
		if (sscore==0) {
			sscore = init;
		}
		// alert($('#nid').html());
		$.ajax({
			url: '../control/userevaluate.php',
			type: 'get',
			data: {
				nid:$('#nid').html(),
				rscore: rscore,
				revaluate:$('#revaluate').val(),
				sscore: sscore,
				sevaluate:$('#sevaluate').val(),
			},
		})
		.done(function(msg) {
			if(msg > 0){
				_success();
				$('.zeromodal-btn').click(function () {
					window.location.href="../page/myEvaluate.php";
				});
			}
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});		
	});

	$('#btn').on('click', function() {
		$complain = Trim($('#complain').val());
		if($complain){
			$.ajax({
				url: '../control/userevaluate.php',
				type: 'GET',
				data: {
					nid:$('#nid').html(),
					complain:$complain
				},
			})
			.done(function(msg) {
				if(msg > 0){
					_success();
					$('.zeromodal-btn').click(function () {
						window.location.href="../page/mycomplain.php";
					});
				}
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}else{
			_error();
		}
	});
})

function _success() {
    zeroModal.success('操作成功!');
}
function _error() {
    zeroModal.error('请填写投诉理由后再进行提交!');
}
function Trim(str)
{ 
	return str.replace(/(^\s*)|(\s*$)/g, ""); 
}