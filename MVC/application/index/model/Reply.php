<?php
namespace index\model;
use framework\Model;

class Reply extends Model
{
	
	//$sql = $this->getLastSql();
	//var_dump($sql);
	
	//查询文章
	public function insertReply($data)
	{
		
		if ($resid = $this->insert($data)){
			return $resid;
		} else {
			return false;
		}

	}

	//只查询某条帖子回复条数
	public function reCount($where)
	{
		 $res = $this->where("pid=$where and isdelete=0")->select();
		 if ($res) {
		 	return $res;
		 } 
		 return false;
	}
	
	public function selectAll($id, $limit)
	{

		$sql = "select r.*, u.username, u.picture from blog_reply as r, blog_user as u where pid = $id and r.authorid=u.uid and r.isdelete=0 order by comtime desc limit $limit";  

		if ($result = $this->query($sql, MYSQLI_ASSOC)) {
			return $result;
		} else {

			return false;
		}
		
	}

}