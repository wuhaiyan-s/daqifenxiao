var base_url = '/weixin';
function login()
{
	var param = {};
	param.login    = $('#username').val();
	param.password = $('#password').val();
	var url = base_url+'/index.php?g=Api&m=Member&a=login';
	$.post(url,param,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			showMsg(res.errmsg);
			setTimeout(function(){
				window.location.href = base_url+'/index.php?g=App&m=Member&a=index';
			}, 1500);
		}else{
			showMsg(res.errmsg,'alert');
		}
	});
}