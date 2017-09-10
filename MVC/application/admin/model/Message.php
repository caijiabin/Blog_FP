<?php
namespace admin\model;
use framework\Model;
class Message extends Model
{
	//批量删除（隐藏）/恢复
	public function delMess($id,$data)
	{
		$result = $this->where("sid=$id")->update($data);
		return $result;
	}

	//查询所有留言
	public function userMess($recycle, $limit)
	{
		$result = $this->where($recycle)->limit($limit)->select();
		if ($result) {
			return $result;
		} else {
			return false;
		}
		
	}
	//分页总条数
	public function paging($where)
	{
		$res = $this->where($where)->select();
		return  $res;
	}

}