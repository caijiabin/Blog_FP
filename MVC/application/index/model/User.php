<?php
namespace index\model;
use framework\Model;
//模板user
class User extends Model
{
	
	public function getInfo(
							$fields=null,
							$where=null,
							$order=null,
							$limit=null)
	{
		return  $this->field($fields)->where($where)->order($order)->limit($limit)->select();
	}

	//查询当前用户的个人信息
	public function findUser($uid)
	{
		return $this->where("uid=$uid")->find();
	}
	//修改当前用户个人信息
	public function updateInfo($uid,$data)
	{
	  $res = $this->where("uid=$uid")->update($data);
		 return  $res;
		// $xxx = $this->getLastsql();
		//  var_dump($xxx);
		
	}
	
	//注册和登录时检查用户名
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

	//注册信息插入数据库
	public function insertRegister($data)
	{
		if ($resid = $this->insert($data)){
			return $resid;
		} else {
			return false;
		}	
	}

	public function uplike($data, $uid)
	{
		$result = $this->where("uid=$uid")->update($data);
		if ($result) {
			return true;
		} else {
			return false;
		}
	} 
	//找回密码，使用更新
	public function upfind($data, $where)
	{
		$result = $this->where($where)->update($data);
		if ($result) {
			return true;
		} else {
			return false;
		}
	} 



	
}




