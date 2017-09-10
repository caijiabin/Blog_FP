<?php
namespace admin\controller;
use admin\model\Article;
use admin\model\Reply;
use framework\Upload;
use framework\Page;
class Article extends Controller
{
	protected $article;
	protected $reply;
	protected $upload;
	protected $page;
	protected $total;
	public function __construct()
	{
		parent::__construct();
		$this->article = new Article;
		$this->reply = new Reply;
		$this->upload = new Upload;
	}

/************文章列表***********/
	public function list()
	{

		//批量删除 或  单条删除
		if (!empty($_POST['id']) || !empty($_GET['id'])) {
			empty($_POST['id'])?$id[0]=$_GET['id']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->article->listRecycle($value,['isdel'=>1]);
				if (!$res) {
					$this->notice('删除失败', 'index.php?m=admin&c=article&a=list');
					break;
				}
			}
		}

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('article', 'isdel=0', 4);
		//文章列表展示
		$list = $this->article->getList('isdel=0', $limit);
		if ($list) {
				foreach ($list as $key => $value) {	
					$list[$key]['addtime'] = date('Y-m-d', $value['addtime']);
			}
		}
		$this->assign('list', $list);

		$this->display();
	}

	/**************回收管理*************/
	public function recycle()
	{

		//批量恢复
		if (!empty($_POST['id']) || !empty($_GET['id'])) {
			//$id = $_POST['id'];
			empty($_POST['id'])?$id[0]=$_GET['id']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->article->listRecycle($value,['isdel'=>0]);
				if (!$res) {
					$this->notice('删除失败', 'index.php?m=admin&c=article&a=recycle');
					break;
				}
			}
		}

		
		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('article', 'isdel=1', 4);
		//回收列表展示
		$relist = $this->article->getList('isdel=1', $limit);
		if ($relist) {
				foreach ($relist as $key => $value) {	
					$relist[$key]['addtime'] = date('Y-m-d', $value['addtime']);
			}
		}
		$this->assign('relist', $relist);

		$this->display();
	}
/**************回复管理*************/
	public function replylist()
	{

		//批量删除 或  单条删除
		if (!empty($_POST['id']) || !empty($_GET['id'])) {
			empty($_POST['id'])?$id[0]=$_GET['id']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->reply->replyRecycle($value,['isdelete'=>1]);
				var_dump($res);
				if (!$res) {
					$this->notice('删除失败', 'index.php?m=admin&c=article&a=replylist');
					break;
				}
			}
		}

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('reply', 'isdelete=0', 5);
		//文章列表展示
		$reply = $this->reply->getReply('isdelete=0', $limit);
		//var_dump($reply);
		if ($reply) {
				foreach ($reply as $key => $value) {	
					$reply[$key]['comtime'] = date('Y-m-d', $value['comtime']);
			}
		}
		//var_dump($reply);
		$this->assign('reply', $reply);

		$this->display();
	}

	/**************回收管理*************/
	public function replyrecy()
	{

		//批量恢复
		if (!empty($_POST['id']) || !empty($_GET['id'])) {
			//$id = $_POST['id'];
			empty($_POST['id'])?$id[0]=$_GET['id']:$id=$_POST['id'];
			foreach ($id as $key => $value) {
				$res = $this->reply->replyRecycle($value,['isdelete'=>0]);
				if (!$res) {
					$this->notice('删除失败', 'index.php?m=admin&c=article&a=recycle');
					break;
				}
			}
		}

		
		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging('reply', 'isdelete=1', 5);
		//回收列表展示
		$replyrecy = $this->reply->getReply('isdelete=1', $limit);
		if ($replyrecy) {
				foreach ($replyrecy as $key => $value) {	
					$replyrecy[$key]['comtime'] = date('Y-m-d', $value['comtime']);
			}
		}
		$this->assign('replyrecy', $replyrecy);
		$this->display();
	}



	//添加文章
	public function add()
	{
		if (!empty($_POST['submit']) && !empty($_POST['test-editormd-markdown-doc'])) {
			$data['title'] = trim($_POST['title']);
			$data['content'] = addslashes($_POST['test-editormd-markdown-doc']);
			$data['keywords'] = trim($_POST['keywords']);
			$time =strtotime($_POST['addtime']);
			if ($time) {
				$data['addtime'] = $time;
			} else {
				$data['addtime'] = time();
 			}
 			$count = $_POST['likecount'];
 			if (is_numeric($count)) {
 				$data['likecount'] = (int)$count;
 			} else {
 				$data['likecount'] = 0;
 			}
 		
			if (!empty($_FILES['apic']['size'])) {
				if (!$this->upload->errorMessage) {
					$data['apic'] = $this->upload->uploadFile('apic');
				}
			} 
			$resid = $this->article->insertArticle($data);
			if ($resid>0) {
				$this->notice('发表成功','index.php?m=admin&c=article&a=add');
				exit;
			} else {
				$this->notice('发表失败','index.php?m=admin&c=article&a=add');
				exit;
			}
		}

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


		//文章列表 单条彻底删除
		// if (!empty($_GET['id'])) {
		// 	$id = $_GET['id'];
		// 	$res = $this->article->listDel($id);
		// 	var_dump($res);
		// 	if (!$res) {
		// 		$this->notice('删除失败', 'index.php?m=admin&c=article&a=recycle');
		// 		exit;
		// 	}
			
		// }