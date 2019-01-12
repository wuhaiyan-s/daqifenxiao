var base_url = '';
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

function logout()
{
	var url = base_url+'/index.php?g=Api&m=Member&a=logout';
	$.post(url,param,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			showMsg(res.errmsg);
			setTimeout(function(){
				window.location.href = base_url+'/index.php?g=App&m=Member&a=login';
			}, 1000);
		}else{
			showMsg(res.errmsg,'alert');
		}
	});
}

//修改密码
function savePwd()
{
	if( $('#oldpassword').val().length < 1 ){
		showMsg('旧密码不能为空','alert');
		return;
	}
	if( $('#password').val().length < 6 ){
		showMsg('新密码长度不得少于6位','alert');
		return;
	}
	var info = $('#infoAuth').serialize();
	var url = base_url + '/index.php?g=Api&m=Member&a=saveInfo';
	$.post(url,info,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			showMsg(res.errmsg);
		}else{
			showMsg(res.errmsg,'alert');
		}

	});
}