<?php
namespace admin\model;
use framework\Model;
class User extends Model
{
	//分页总条数
	public function paging($where)
	{
		$res = $this->where($where)->select();
		return  $res;
	}
	//查询用户信息
	public function getInfo($where, $limit)
	{
		//$limitdss = $limit;
		 return $this->where($where)->limit($limit)->select();
	}
	//查找管理员名字
	public function findName($where)
	{
		return $this->where($where)->find();
	}
	//修改管理员密码
	public function uppass($data, $uid)
	{
		$result = $this->where("uid=$uid")->update($data);
		if ($result) {
			return true;
		} else {
			return false;
		}
	} 

	//登录时检查用户名
	public function check($data)
	{
		$name = $data;
		$result = $this->where("username='$name'")->select();
		if (empty($result)) {
				return null;
			} else {
			return $result;
		}
	}
	
	//批量删除（隐藏）/恢复
	public function delMul($id,$data)
	{
		$result = $this->where("uid=$id")->update($data);
		return $result;
	}














}