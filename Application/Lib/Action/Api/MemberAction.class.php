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
		if (!$_POST['login']) {
			showMsg(50201,$ERROR_LIST[50201]);
		}
		if (!$_POST['password']) {
			showMsg(50202,$ERROR_LIST[50202]);
		}
		
		$where = array(
				'login'    => $_POST['login'],
				'password' => md5($_POST['password'])
			);
		$thisUser = M("User")->where($where)->find();
		if (empty($thisUser)) {
			showMsg(50203,$ERROR_LIST[50203]);
		}else {
			$_SESSION['uid'] = $thisUser['id'];
			showMsg(200,'登录成功');
		}
	}
}