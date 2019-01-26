<?php
class AdAction extends PublicAction {
	public $m = '';
	function _initialize() {
		$this->m = M('Ad');
		parent::_initialize ();
	}
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = $this->m;
		
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
        $Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		
		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "result", $result );
		$this->display ();
	}
	
	public function add()
	{
		$id = intval($_GET['id']);
		if( $id > 0 ){
			$ad = $this->m->find($id);
			$this->assign('ad',$ad);
		}
		$this->display();
	}
	
	public function edit()
	{
		$data = $_POST;
		if( empty($data['title']) ){
			$this->error ( "广告标题不能为空！" );
		}
		
		$img = $_POST['image'];
		if( empty($img['imageContent']) ){
			$this->error ( "广告图片不能为空！" );
		}
		if( strlen($img['imageContent']) > 5 && strlen($img['imageContent']) <= 100 ){
			$data['image'] = $img['imageContent'];
		}elseif( strlen($img['imageContent']) > 100 ){
			$type = explode("/", $img['imageType']);
			$type = $type[1];
			$file_content = explode(",", $img['imageContent']);
			$file_content = base64_decode($file_content[1]);
			
			$filename = 'g'.time().'_'.rand(1000,9999).'.'.$type;
			$path = __UPLOADS__.$filename;
			file_put_contents($path,$file_content );
			$data['image'] = $filename;
		}
		$data['sort'] = intval($data['sort']);
		if( $data['id'] > 0 ){
			$this->m->save($data);
			$this->success ( "修改广告成功",U('Ad/index') );
		}else{
			$this->m->add($data);
			$this->success ( "添加广告成功",U('Ad/index') );
		}
	}
	
	public function del() {
		$id = intval($_GET['id']);
		if( $id > 0 ){
			$this->m->delete($id);
		}
		$this->success ( "删除商品成功！" );
	}
}