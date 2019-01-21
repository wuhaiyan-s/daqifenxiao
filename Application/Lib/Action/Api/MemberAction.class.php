<?php
class MemberAction extends Action {
	public $uid = 0;
	public $ERROR_LIST = array();
	
	public function _initialize()
	{
		$this->uid = $_SESSION['uid'];
		$this->ERROR_LIST = C('ERROR_LIST');
	}
	
	public function login()
	{
		$ERROR_LIST = $this->ERROR_LIST;
		if (!$_POST['username']) {
			showMsg(50201,$ERROR_LIST[50201]);
		}
		if (!$_POST['password']) {
			showMsg(50202,$ERROR_LIST[50202]);
		}
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$thisUser = M("User")->where( "(phone = '{$username}') AND password = '{$password}' " )->find();
		if (empty($thisUser)) {
			showMsg(50203,$ERROR_LIST[50203]);
		}else {
			$this->uid = $_SESSION['uid'] = $thisUser['id'];
			showMsg(200,'登录成功');
		}
	}
	
	//修改个人资料
	public function saveInfo()
	{
		$ERROR_LIST = $this->ERROR_LIST;
		
		$data = $_POST;
		$uid = $this->uid;
		$data['id'] = $uid;
		if( isset($_POST['password']) ){
			$user = M('User')->find($uid);
			if( md5($data['oldpassword']) != $user['password'] ){
				showMsg(50302,$ERROR_LIST[50302]);
			} 
			unset($data['oldpassword']);
			$data['password'] = md5($data['password']);
		}
		if( isset($_POST['phone']) ){
			$phone = $_POST['phone'];
			$hasPhone = M('User')->where("phone = '{$phone}'")->find();
			if( $hasPhone && $hasPhone['id'] != $uid ){
				showMsg(50303,$ERROR_LIST[50303]);
			}
		}
		M('User')->save($data);
		showMsg(200,'修改成功');
	}
	
	//修改个人资料
	public function saveUserInfo()
	{
		if (!$_POST['login']) {
			$this->error("请输入用户名");
			exit;
		}else {
			$map['login'] = $_POST['login'];
			$map['uid'] = array('neq',$_GET['uid']);
			$check = M("User")->where($map)->find();
			if (!empty($check)) {
				$this->error("该用户名已存在！请重新输入");
				exit;
			}
		}

		if (!$_POST['password']) {
			unset($_POST['password']);
		}else {
			$_POST['password'] = md5($_POST['password']);
		}

		import ( 'ORG.Net.UploadFile' );
		$upload = new UploadFile (); // 实例化上传类
		$upload->maxSize = 3145728; // 设置附件上传大小
		$upload->allowExts = array (
				'jpg',
				'png',
				'jpeg'
		); // 设置附件上传类型
		$upload->savePath = './Public/Uploads/';
		$wx_info = array();
		$wx_info = json_decode($users['wx_info'],true);
		if (! $upload->upload ()) { // 上传错误提示错误信息
			$wx_info['nickname'] = $_POST['login'];
			$_POST['wx_info'] = json_encode($wx_info);
		} else { 
			$info = $upload->getUploadFileInfo ();
			$path = $upload->savePath.$info[0]['savename'];
			$wx_info['nickname'] = $_POST['login'];
			$wx_info['headimgurl'] = $path;
			$_POST['wx_info'] = json_encode($wx_info);
		}
		M("User")->where($where)->save($_POST);
		$this->success("保存成功！",U('App/Index/member',array("uid"=>$users['uid'])) );
		exit;
	}
	
	//退出登录
	public function logout()
	{
		unset($_SESSION["uid"]);
		showMsg(200,'您已退出登录');
	}
}