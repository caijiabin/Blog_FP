<?php
namespace index\controller;
use index\model\Article;
use index\model\User;
use index\model\Reply;
use framework\Page;
use framework\Parser;
class Blog extends Controller
{
	protected $article;
	protected $user;
	protected $reply;
	protected $uid;
	protected $collected;
	protected $liked;
	protected $page;
	protected $total;
	public function __construct()
	{
		parent::__construct();
		$this->article = new Article;
		$this->user = new User;
		$this->reply = new Reply;
		$this->parser = new Parser;
		
	}

	//博客展示页
	public function blog()
	{
		$this->b_session();//获取当前在线用户信息

		//获取当前用户的收藏信息
		$this->collection();
		//获取用户是否点赞
		$this->liked();

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging(3);
		
		//从数据库读取文章内容
		$res1 = $this->article->selectArticle($limit);
		//处理文章时间和收藏信息
		foreach ($res1 as $key => $value) {	
			$res1[$key]['addtime'] = date('Y-m-d', $value['addtime']);
		//	$res1[$key]['content'] = $this->parser->makeHtml(htmlspecialchars_decode($value['content']));
			$contents = $this->parser->makeHtml(htmlspecialchars_decode(substr($value['content'], 0, 200)));
			$res1[$key]['content'] = $contents;
			//$res1[$key]['content'] = substr($contents, 0, 200);


				if ($this->reply->reCount($value['id'])){
					$res1[$key]['replycount'] = count($this->reply->reCount($value['id']));
				} else {
					$res1[$key]['replycount'] = 0;
				}

			}

			if (!empty($this->uid)) {
				if (in_array($value['id'], $this->collected)) {
					$res1[$key]['isred'] = 1;
				}

				if (in_array($value['id'], $this->liked)) {
					$res1[$key]['likered'] = 1;
				}	
		}
		$this->assign('data', $res1);

		//最新发表
		$newPost = $this->article->newArticle();
		foreach ($newPost as $key => $value) {	
			$newPost[$key]['addtime'] = date('dS. F . Y', $value['addtime']);
		}
		$this->assign('newPost', $newPost);

		//我的收藏
		
		if (!empty($this->collected)) {
			$myCollect = $this->article->collectArticle($this->collected);
			foreach ($myCollect as $key => $value) {	
			$myCollect[$key]['addtime'] = date('Y-m-d', $value['addtime']);
			}
			$this->assign('myCollect', $myCollect);

		}
		$arr = include('config/info.php');
		$datas = $this->assign('datas', $arr);
		$this->display();
	}


	/***************公共操作***********************/
	//分页功能
	public function doPaging($pageSize)
		{
			$pageres = $this->article->paging();//查询总条数
			$this->total = count($pageres);//数据总条数
			$this->page = new Page($this->total, $pageSize);
			$listpage = $this->page->listPage();
			$this->assign('listpage', $listpage);
			$limit = $this->page->getLimit();//获取偏移量
			return $limit;//返回偏移量
		}
		

	//点赞操作
	public function likedo()
	{	
		//获取在线用户信息
		$this->b_session();
		//$uid = null;
		//获取目前用户已点赞的文章id
		$this->liked();
		$id = $_GET['id'];
		//用户在线可以点赞
		if (!empty($this->uid) && !empty($_GET['id'])) {
			
			$res = $this->article->likeInc($id);				
			//点赞成功将id存入user表中
			if ($res) {
				//将id压入数组中
				array_push($this->liked, $id);
				$liked = implode(',', $this->liked);
				$data = ['liked'=>$liked];
				$result = $this->user->uplike($data, $this->uid);
				if ($result) {
					array_key_exists('do', $_GET)?exit(header("location:index.php?m=index&c=blog&a=blog_single&id=$id")):exit(header('location:index.php?m=index&c=blog&a=blog'));
				}
			}
		} else {
				if (array_key_exists('do', $_GET)) {
					$this->notice('请先登录哟', 'index.php?m=index&c=blog&a=blog_single&id='.$id);
					exit;
				} else {
					$this->notice('请先登录哟', 'index.php?m=index&c=blog&a=blog');
					exit;
				}	
		}		
	}

	//取消赞操作
	public function cancel()
	{	
		//获取在线用户信息
		$this->b_session();
		//获取目前用户已点赞的文章id
		$this->liked();
		//用户在线可以取消赞
		if (!empty($this->uid) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			//点赞数减1
			$res = $this->article->likeInc($id, 1);				
			//取消成功将user表中的该id删除
			if ($res) {
				//将id压入数组中
				$arr = $this->liked;
				$key = array_search($id, $this->liked);
				unset($arr[$key]);
				$this->liked = $arr;
				$liked = implode(',', $this->liked);
				$data = ['liked'=>$liked];
				$result = $this->user->uplike($data, $this->uid);
				if ($result) {
						array_key_exists('do', $_GET)?exit(header("location:index.php?m=index&c=blog&a=blog_single&id=$id")):exit(header('location:index.php?m=index&c=blog&a=blog'));
				}
			}
		} else {
			return false;
		}		
	}

	//添加收藏操作
	public function collect()
	{
		//获取在线用户信息
		$this->b_session();
		//获取目前用户已收藏的文章id
		$this->collection();
		$id = $_GET['id'];
		//用户在线可以添加
		if (!empty($this->uid) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			//将id压入收藏数组中
			array_push($this->collected, $id);
			$collection = implode(',', $this->collected);
			$data = ['collection'=>$collection];
			$result = $this->user->uplike($data, $this->uid);
			if ($result) {
				array_key_exists('do', $_GET)?exit(header("location:index.php?m=index&c=blog&a=blog_single&id=$id")):exit(header('location:index.php?m=index&c=blog&a=blog'));
			}
			
		} else {
				if (array_key_exists('do', $_GET)) {
					$this->notice('请先登录哟', 'index.php?m=index&c=blog&a=blog_single&id='.$id);
					exit;
				} else {
					$this->notice('请先登录哟', 'index.php?m=index&c=blog&a=blog');
					exit;
				}	
		}		
	}

	//取消收藏操作
	public function nocollect()
	{	
		//获取在线用户信息
		$this->b_session();
		//获取目前用户已收藏的文章id
		$this->collection();
		//用户在线可以取消收藏
		if (!empty($this->uid) && !empty($_GET['id'])) {
			$id = $_GET['id'];

			$key = array_search($id, $this->collected);
			$arr = $this->collected;
			unset($arr[$key]);
			$this->collected = $arr;
			$collection = implode(',', $this->collected);
			$data = ['collection'=>$collection];
			$result = $this->user->uplike($data, $this->uid);
			if ($result) {
					array_key_exists('do', $_GET)?exit(header("location:index.php?m=index&c=blog&a=blog_single&id=$id")):exit(header('location:index.php?m=index&c=blog&a=blog'));
			}
		
		} else {
			return false;
		}		
	}


	//当前用户的收藏信息
	public function collection()
	{
		if (!empty($this->uid)) {
			$fields = 'collection';
			$where = "uid = $this->uid";
			$res2 = $this->user->getInfo($fields, $where);
			$collection = $res2[0]['collection'];
			if (empty($collection)) {
				$this->collected = [];
			} else {
				$this->collected = explode(',', $collection);
			}
		}
	}

	//当前用户的点赞信息
	public function liked()
	{
		if (!empty($this->uid)) {
			$fields = 'liked';
			$where = "uid = $this->uid";
			$res3 = $this->user->getInfo($fields, $where);
			$like = $res3[0]['liked'];
			if (empty($like)) {
				$this->liked = [];
			} else {
				$this->liked = explode(',', $like);
			}
		}
	}

	//通过session获取在线用户信息
	public function b_session()
	{
		if (!empty($_SESSION['username'])) {
			 $username = $_SESSION['username']; 
			 $this->uid = $_SESSION['uid']; 
			$this->assign('username', $username);
		} else {
			 $uid = null; 
			return false;
		}
	}


/***************上面是公共操作***********************/

	//博客详情页
	public function blog_single()
	{
		$this->b_session();
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			//根据id查询文章详情
			$article = $this->article->articleDetail($id);	
			//回复条数
			if ($this->reply->reCount($id)){
					$recount = count($this->reply->reCount($id));
				} else {
					$recount = 0;
				}

			$this->assign('recount', $recount);	
			//如果已收藏，显示红色
			$this->collection();
			//如果已点赞显示红色
			$this->liked();
			if (!empty($this->uid)) {
				if (in_array($id, $this->collected)) {
					$article['isred'] = 1;
				}
				if (in_array($id, $this->liked)) {
					$article['likered'] = 1;
				}
			}
 			
			$article['addtime'] =  date('F d,Y', $article['addtime']);
			//$article['content'] =  htmlspecialchars_decode($article['content']);
			$article['content'] =  $this->parser->makeHtml(htmlspecialchars_decode($article['content']));
			$this->assign('article', $article);
		}

		if (!empty($_POST['rcontent'])) {
			
			if (empty($this->uid)) {
				$this->notice('请先登录再评论', 'index.php?m=index&c=blog&a=blog_single&id='.$id);
					exit;
			}
			//$data['rcontent']= htmlspecialchars(trim($_POST['rcontent']));
			$data['rcontent']= stripslashes(trim($_POST['rcontent']));
			$data['pid'] = $id;
			$data['authorid'] = $this->uid;
			$data['comtime'] = time();
			//回复内容存入数据库
			$resid = $this->reply->insertReply($data);
			if ($resid) {
				if ($this->article->replyInc($id)) {
					$this->notice('回复成功', 'index.php?m=index&c=blog&a=blog_single&id='.$id);
				exit;
				}
				
			} else {
				$this->notice('回复失败', 'index.php?m=index&c=blog&a=blog_single&id='.$id);
				exit;
			}
		}
		

		//分页操作，参数是$pageSize：每页显示条数
		$limit = $this->doPaging(3);
		//查询回复内容和条数
		$reply = $this->reply->selectAll($id, $limit);
		if ($reply) {
			foreach ($reply as $key => $value) {	
				$reply[$key]['comtime'] = date('d F Y, H:i', $value['comtime']);
				$reply[$key]['rcontent'] = stripslashes($value['rcontent']);
			}
			$this->assign('reply', $reply);
		}
	$arr = include('config/info.php');
	$data = $this->assign('data', $arr);	
	$this->display();
	}


}