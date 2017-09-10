<?php
namespace index\model;
use framework\Model;

class Article extends Model
{
	//分页总条数
	public function paging()
	{
		$res = $this->where('isdel=0')->select();
		return  $res;
	}
	//文章列表展示
	public function selectArticle($limit)
	{	
		$order = ['ishot', 'addtime desc'];
		$res = $this->where('isdel=0')->order($order)->limit($limit)->select();
		return  $res;
	}
	//最新发表展示
	public function newArticle()
	{	
		$res = $this->where('isdel=0')->order('addtime desc')->limit(3)->select();
		return  $res;
	}
	//我的收藏
	public function collectArticle($where)
	{	
		$str = implode(',', $where);
		$id =  "id in ( $str)";
		$arr['del'] = 'isdel=0';
		$arr['id'] = $id;
		$res = $this->where($arr)->order('addtime')->select();
		return  $res;
	}
	//我的收藏
	public function myCollect($str, $limit)
	{	
		$id =  "id in ($str) and isdel=0";
		$res = $this->where($id)->order('addtime')->limit($limit)->select();
		return  $res;
	}
	//我的收藏 分页总条数
	public function colpaging($id)
	{
		$where =  "id in ($id) and isdel=0";
		$res = $this->where($where)->select();
		return  $res;
	}
	
	//点赞数增加或键少
	public function likeInc($where,$do=0)
	{
		if ($do) {
			//减少
			$res = $this->where("id=$where")->setInc('likecount',-1);
		} else {
			//默认增加
			$res = $this->where("id=$where")->setInc('likecount',1);
		}
	 
	 if ($res) {
	 		return true;
	 	} 
	 	return false;
	}
	//

	//回复数增加
	public function replyInc($where)
	{
	 $res = $this->where("id=$where")->setInc('replycount',1);
	 if ($res) {
	 		return true;
	 	} 
	 	return false;
	}

	//文章详情，单条查询
	public function articleDetail($where)
	{
		 $res = $this->where("id=$where")->find();
		 if ($res) {
		 	return $res;
		 } 
		 return false;
	}

	
	//分页功能总条数查询
	// public function total()
	// {
	// 	$this->cal('count', '');
	// }


}