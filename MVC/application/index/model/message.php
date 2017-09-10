<?php
namespace index\model;
use framework\Model;

class Message extends Model
{
	
	public function addMessage($data)
	{
		 $resid = $this->insert($data);
		 if ($resid) {
		 	return $resid;
		 } 
		 return false;
	}
	
}