<?php
namespace index\controller;
use index\model\User;
use index\model\Article;
use index\model\Message;
class Index extends Controller
{
	protected $message;
	public function __construct()
	{
		parent::__construct();
		$this->message = new Message;
	}
	//首页展示
	public function index()
	{
		
		$this->assign('title', 123);

		if (!empty($_SESSION['username'])) {
				$username = $_SESSION['username']; 
				$this->assign('username', $username);
		}
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}
	//关于作者 留言界面
	public function contact()
	{
		if (!empty($_SESSION['username'])) {
				$username = $_SESSION['username']; 
				$this->assign('username', $username);
			}

		if (!empty($_POST['message'])) {
			//留言内容不能为空
			$data['message'] = htmlspecialchars($_POST['message']);
			//给名字设默认值
			$data['name'] = '匿名用户';//匿名用户userid默认为0
			
			//检查email格式
			if (!empty($_POST['email']) || !($_POST['email'] =='email' )) {
				$data['email'] = $this->email($_POST['email']);
			}
			//如果当前用户在线 自动获取其信息
			if (!empty($_SESSION['username'])) {
				$data['name'] = $_SESSION['username']; 
				$data['userid'] = $_SESSION['uid']; 
				if (empty($data['email']) || $data['email'] == 'NULL') {
					$data['email'] = $_SESSION['email']; 
				}	
			}
			$data['addtime'] = time();
			$sid = $this->message->addMessage($data);
			if ($sid) {
				$this->notice('留言成功', 'index.php?m=index&c=index&a=contact');
				exit;
			}
		}
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}





	/*****检查方法*******/

	//检查邮箱格式
	public function email($email)
	{
		$reg = "/^\w+@(\w+\.)+(com|cn|net)$/";
		if(preg_match($reg, $email, $match)) {
				return $email;
		}  else {
			return 'NULL';
		}
	}


	// 检查用户名
	// public function checkname($name,$update=false,$min=2,$max=30)
	// {
	// 	//用户名是否合法 
	// 	$reg = "/^([\x{4e00}-\x{9fa5}]|\w){" . $min . "," . $max . "}$/u";
	// 	if(preg_match($reg,$name,$match)) {	
	// 		return 
	// 	}  else {
	// 			$this->notice('用户名不合法','index.php?m=index&c=user&a=register');
	// 			exit;
	// 		}
	// }

	//退出登录处理
	public function loginout()
	{
		$_SESSION = array();//销毁session
		$this->notice('退出成功', 'index.php?m=index&c=index&a=index');
		exit;
		$this->display();
	}






}