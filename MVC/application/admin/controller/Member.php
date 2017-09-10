<?php
namespace admin\controller;
use admin\model\User;
use admin\model\Message;
use framework\Page;
class Member extends Controller
{
	protected $page;
	protected $total;
	public function __construct()
	{
		parent::__construct();
		$this->user = new User;
		$this->message = new Message;
	}

	/***************粉丝管理**************/
	public function member()
	{
		//批量删除 或  单条删除
		if (!empty($_POST['id']) || !empty($_GET['uid'])) {
			empty($_POST['id'])?$id[0]=$_GET['uid']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->user->delMul($value,['del'=>1]);
				if (!$res) {
					$this->notice('删除失败', 'index.php?m=admin&c=member&a=member');
					break;
				}
			}
		}


		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('user', 'del=0', 5);
		//粉丝名单展示
		$user = $this->user->getInfo('del=0', $limit);
		if ($user) {
				foreach ($user as $key => $value) {	
					$user[$key]['regtime'] = date('Y-m-d', $value['regtime']);
			}
		}
		$this->assign('user', $user);
		$this->display();
	}

	//黑名单管理
	public function blacklist()
	{
		//批量恢复 或 单条恢复
		if (!empty($_POST['id']) || !empty($_GET['uid'])) {
			empty($_POST['id'])?$id[0]=$_GET['uid']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->user->delMul($value,['del'=>0]);
				if (!$res) {
					$this->notice('恢复失败', 'index.php?m=admin&c=member&a=blacklist');
					break;
				}
			}
		}

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('user', 'del=1', 5);
		//黑名单 展示
		$user = $this->user->getInfo('del=1', $limit);
		if ($user) {
			foreach ($user as $key => $value) {	
				$user[$key]['regtime'] = date('Y-m-d', $value['regtime']);
			}
		}
		$this->assign('user', $user);
		$this->display();
	}

	/************留言管理*******************/
	public function message()
	{

		//批量删除 或  单条删除
		if (!empty($_POST['id']) || !empty($_GET['sid'])) {
			empty($_POST['id'])?$id[0]=$_GET['sid']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->message->delMess($value,['recycle'=>1]);
				if (!$res) {
					$this->notice('删除失败', 'index.php?m=admin&c=member&a=member');
					break;
				}
			}
		}

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('message', 'recycle=0', 5);
		//查询留言
		$message = $this->message->userMess('recycle=0', $limit);
		if ($message) {
			foreach ($message as $key => $value) {	
				$message[$key]['addtime'] = date('Y-m-d', $value['addtime']);
				$message[$key]['message'] = htmlspecialchars_decode(($value['message']));
			}
		}	
		$this->assign('message', $message);
		$this->display();
	}

	//回收留言展示
	public function messreycle()
	{

		//批量恢复 或 单条恢复
		if (!empty($_POST['id']) || !empty($_GET['sid'])) {
			empty($_POST['id'])?$id[0]=$_GET['sid']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->message->delMess($value,['recycle'=>0]);
				if (!$res) {
					$this->notice('恢复失败', 'index.php?m=admin&c=member&a=member');
					break;
				}
			}
		}

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('message', 'recycle=1', 5);
		//回收展示
		$message = $this->message->userMess('recycle=1', $limit);
		if ($message) {
			foreach ($message as $key => $value) {	
				$message[$key]['addtime'] = date('Y-m-d', $value['addtime']);
				$message[$key]['message'] = htmlspecialchars_decode(($value['message']));
			}
		}
		
		$this->assign('message', $message);
		$this->display();
	}

/***********公共操作--分页**********/
	public function doPaging($str, $where, $pageSize)
	{
		$pageres = $this->$str->paging($where);//查询总条数
		$this->total = count($pageres);//数据总条数
		$this->page = new Page($this->total, $pageSize);
		$listpage = $this->page->listPage();
		$this->assign('listpage', $listpage);
		$limit = $this->page->getLimit();//获取偏移量
		return $limit;//返回偏移量
	}

}
		
		