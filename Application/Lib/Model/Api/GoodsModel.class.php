<?php
class GoodsModel extends Model {
	
	public function getGoods($where = array(),$fields = '*',$order='sort asc,id desc')
	{
		$goods = M("good")->where($where)->order($order)->field($fields)->select();
		return  $goods;
	}
	
	/**
	*根据id获取条件获取商品信息
	*@param max $map
	*return array $goods
	*/
	public function getOne($map,$fields = '*')
	{
		if( is_numeric($map) ){
			$goods = M("good")->field($fields)->find($map);
		}else{
			$goods = M("good")->where($map)->field($fields)->find();
		}
		return  $goods;
	}
}