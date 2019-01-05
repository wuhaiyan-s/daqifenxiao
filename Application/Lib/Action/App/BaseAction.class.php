<?php
class BaseAction extends Action {
	public $uid        = 0;
	public $openid     = '';
	public $ERROR_LIST = array();
	public $userinfo   = array();
	
	public function _initialize() {
		header("Content-type: text/html; charset=utf-8"); 
		$this->uid    = intval($_SESSION['uid']);//用户唯一id,user表的id
		$this->openid = $_SESSION['openid'] ? $_SESSION['openid'] : $_GET['openid'];
		$this->userAuth();//用户登录判断
		
		$this->ERROR_LIST = C('ERROR_LIST');
		$this->assign('StaticDir',__PUBLIC__.'/Static/');
		$this->assign('StaticCss',__PUBLIC__.'/Static/css/');
		$this->assign('StaticJs',__PUBLIC__.'/Static/js/');
		$this->assign('UploadDir',__PUBLIC__.'/Uploads/');
		$this->assign('GoodsImageDefault',__PUBLIC__.'/Uploads/goods_default.png');
	}
	
	public function userAuth()
	{
		$whiteArr = array('index.index','index.detail','index.cart','member.login');//免登录的方法名
		$action_name = strtolower( $this->getActionName() ).'.'.strtolower(ACTION_NAME);
		
		$ERROR_LIST = $this->ERROR_LIST;
		import ( 'Wechat', APP_PATH . 'Common/Wechat', '.class.php' );
	$config = M ( "Wxconfig" )->where ( array (
				"id" => "1" 
		) )->find ();
		
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
		if( $this->uid ){
			$this->userinfo = D('Member')->getOne($this->uid);
			if( empty($this->userinfo) ){
				showMsg(102,$ERROR_LIST[102],'','html');
			}
		}
		
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if( strpos($agent,"icroMessenger") ){//用微信浏览器打开
			//没有授权登录的 授权登录获取openid
			if( empty($this->openid) ){
				$info = $weObj->getOauthAccessToken();
				if( empty($info) )
				{
					$redirect = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$url = $weObj->getOauthRedirect($redirect,'','snsapi_base');
					header("Location: $url");
					exit();
				}
				else
				{
					$this->openid = $_SESSION['openid'] = $info['openid'];
				}
			}
			$wx_info = $weObj->getUserInfo($this->openid);
			if( $this->uid ){
				if( $wx_info['subscribe'] != 1 )
				{
					showMsg(101,$ERROR_LIST[101],'','html');
				}else
				{
					if( strlen($this->userinfo ['head_img']) < 10 ){
						$user['head_img'] = $wx_info['headimgurl'];
					}
					$user['id']      = $this->uid;
					$user['wx_info'] = json_encode($wx_info);
					M( "User" )->save ( $user );
				}
			}else{
				//根据微信信息新增用户
				$user             = array();
				$user['head_img'] = $wx_info['headimgurl'];
				$user['wx_info']  = json_encode($wx_info);
				$this->uid        = $_SESSION['uid'] = M ( "User" )->add ( $user );
			}
			
		}elseif( empty($this->uid) && !in_array($action_name,$whiteArr) ){//用普通网页浏览器打开
			$url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Member/login');
			header("Location: $url");
			exit();
		}
	}
}