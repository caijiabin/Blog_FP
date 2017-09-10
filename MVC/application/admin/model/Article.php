<?php
namespace admin\model;
use framework\Model;
class Article extends Model
{
	//分页总条数
	public function paging($where)
	{
		$res = $this->where($where)->select();
		return  $res;
	}
	//查询文章列表
	public function getList($where, $limit)
	{
		 return $this->where($where)->order('addtime desc')->limit($limit)->select();
	}

	//批量隐藏/恢复
	public function listRecycle($id,$data)
	{
		$result = $this->where("id=$id")->update($data);
		return $result;
	}

	//单条彻底删除
	// public function listDel($id)
	// {
	// 	$result = $this->where("id=$id")->delete();
	// 	$xxx = $this->getLastSql();
	// 	var_dump($xxx);
	// 	return $result;
	// }

	public function insertArticle($data)
	{
		if ($resid = $this->insert($data)){
			return $resid;
		} else {
			return false;
		}
	}





}