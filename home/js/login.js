$(function () {
	var strName = localStorage.getItem('uid');
	var strPass = localStorage.getItem('pass');
	if(strName){
		$('#uid').val(strName);
	}
	if(strPass){
		$('#pass').val(strPass);
	}
	$('#btn').click(function () {
		var uid = $('#uid').val();
		var pass = $('#pass').val();
		localStorage.setItem('uid',uid);
		if ($('#checkbox').prop('checked')) {
			localStorage.setItem('pass',pass);
		}else{
			localStorage.removeItem('pass');
		}
	});
	
})