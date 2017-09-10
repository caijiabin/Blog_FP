<?php
namespace admin\model;
use framework\Model;
class Reply extends Model
{
	//分页总条数
	public function paging($where)
	{
		$res = $this->where($where)->select();
		return  $res;
	}

	//查询文章列表
	public function getReply($where, $limit)
	{
		 
		$sql = "select r.*, u.uid, u.username, a.id, a.title from blog_reply as r,blog_article as a, blog_user as u where $where and  r.pid=a.id and r.authorid=u.uid limit $limit";  

			//order by addtime desc
		if ($result = $this->query($sql, MYSQLI_ASSOC)) {
			return $result;
		} else {
			return false;
		}
	}

	//批量隐藏/恢复
	public function replyRecycle($id, $data)
	{
		$result = $this->where("rid=$id")->update($data);
		return $result;
	}

}