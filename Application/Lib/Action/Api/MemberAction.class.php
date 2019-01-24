<?php
class MemberAction extends Action {
	public $uid = 0;
	public $ERROR_LIST = array();
	
	public function _initialize()
	{
		$this->uid = $_SESSION['uid'];
		$this->ERROR_LIST = C('ERROR_LIST');
	}
	
	//登录
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
	
	//注册
	public function reg()
	{
		$ERROR_LIST = $this->ERROR_LIST;
		if (!$_POST['phone']) {
			showMsg(50251,$ERROR_LIST[50251]);
		}
		$map = array();
		$map['login'] = $_POST['phone'];
		$map['phone'] = $_POST['phone'];
		$map['_logic'] = 'OR';
		$check = M("User")->where($map)->find();
		if (!empty($check)) {
			showMsg(50252,$ERROR_LIST[50252]);
		}
		if (!$_POST['password']) {
			showMsg(50253,$ERROR_LIST[50253]);
			
		}
		
		//推荐人
		$mid = 0;
		if( $_POST['mid'] > 0 ){
			$mid = intval($_POST['mid']);
			unset($_POST['mid']);
		}
		$_POST['uid']      = rand();
		$_POST['password'] = md5($_POST['password']);
		$_POST['username'] = $_POST['login'] = $_POST['phone'];
		$uid = M("User")->add($_POST);
		$this->uid = $_SESSION["uid"] = $uid;
		
		//推荐人相关信息保存
		$user = array();
		$user['uid'] = $uid;
		if( $mid ){
			$m = M ( "User" );
			include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
			$where = array();
			$where["id"] = $mid;
			$results = $m->where($where)->find();
			
			if(!empty($results['openid']))
			{
				import ( 'Wechat', APP_PATH . 'Common/Wechat', '.class.php' );
				$config = M ( "Wxconfig" )->where ( array ("id" => "1") )->find ();
		
				$options = array (
					'token' => $config ["token"], // 填写你设定的key
					'encodingaeskey' => $config ["encodingaeskey"], // 填写加密用的EncodingAESKey
					'appid' => $config ["appid"], // 填写高级调用功能的app id
					'appsecret' => $config ["appsecret"], // 填写高级调用功能的密钥
					'partnerid' => $config ["partnerid"], // 财付通商户身份标识
					'partnerkey' => $config ["partnerkey"], // 财付通商户权限密钥Key
					'paysignkey' => $config ["paysignkey"]  // 商户签名密钥Key
				);
				$weObj = new Wechat ( $options );
			
				$user ["l_id"] = $results['id'];
				
				//增加分销人
				$a_info = array();
				$a_info['id']    = $results['id'];
				$a_info['a_cnt'] = $results['a_cnt']+1;
				$user_id = M ( "User" )->save ( $a_info );
				
				if(strlen($results['openid'])>10)
				{
					$data = array();
					$data['touser'] = $results['openid'];
					$data['msgtype'] = 'text';
					$data['text']['content'] = '【'.$map['phone'].'】通过分享链接，成为您的'.$message_name.'团队成员！';
					$weObj->sendCustomMessage($data);
				}
				
				if($results['l_id'])//b jibie
				{
					$where = array();
					$where["id"] = $results['l_id'];
					$b_results = $m->where($where)->find ();
					
					if(!empty($b_results))
					{
						$b_info = array();
						$b_info['id'] = $b_results['id'];
						$b_info['b_cnt'] = $b_results['b_cnt']+1;
						$user_id = M ( "User" )->save ( $b_info );
						
						$user["l_b"] = $b_results['id'];
						
						if(strlen($b_results['openid'])>10)
						{
							$data = array();
							$data['touser'] = $b_results["openid"];
							$data['msgtype'] = 'text';
							$data['text']['content'] = '【'.$map['phone'].'】通过分享链接，成为您的'.$message_name.'团队成员！';
							$weObj->sendCustomMessage($data);
						}
						
						if($b_results['l_id'])//c jibie
						{
							$where = array();
							$where["id"] = $b_results['l_id'];
							$c_results = $m->where($where)->find ();
							
							if(!empty($c_results))
							{
								$c_info = array();
								$c_info['id'] = $c_results['id'];
								$c_info['c_cnt'] = $c_results['c_cnt']+1;
								$user_id = M ( "User" )->save ( $c_info );
								
								$user["l_c"] = $c_results['id'];
								
								if(strlen($c_results['openid'])>10)
								{
									$data = array();
									$data['touser'] = $c_results["openid"];
									$data['msgtype'] = 'text';
									$data['text']['content'] = '【'.$map['phone'].'】通过分享链接，成为您的'.$message_name.'团队成员！';
									$weObj->sendCustomMessage($data);
								}
							}
						}
					}
				}
			}
		}
		
		$user['id'] = $uid;
		M("User")->save($user);
		showMsg(200,'注册成功');
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
			if( $data['oldpassword'] != '' && md5($data['oldpassword']) != $user['password'] ){
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
	
	//微信登录后绑定手机号
	public function addmobile()
	{
		$uid = $this->uid;
		$phone = $_POST['phone'];
		if( empty($uid) ){
			showMsg(105,$ERROR_LIST[105]);
		}
		if( strlen($phone) < 11 ){
			showMsg(50254,$ERROR_LIST[50254]);
		}
		
		$user = M('User')->where("phone = '{$phone}'")->find();
		if( $user && $user['id'] != $uid ){
			showMsg(50252,$ERROR_LIST[50252]);
		}
		$data          = array();
		$data['id']    = $uid;
		$data['phone'] = $phone;
		M('User')->save($data);
		showMsg(200,'绑定成功');
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