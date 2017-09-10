<?php
namespace index\controller;
use index\model\User as UserModer;
use index\model\Article;
use framework\Verify;
use framework\Upload;
use framework\Page;
use framework\Ucpaas;
//控制器user
class User extends controller
{
	protected $user;
	protected $article;
	protected $upload;
	protected $ucpaas;
	protected $uid;
	protected $page;
	protected $total;
	
	public function __construct()
	{
		parent::__construct();
		//ucpaas::__construct()
		$this->user = new UserModer;
		$this->article = new Article;
		$this->upload = new Upload;
		//$this->ucpass = new Ucpaas;
	}
	//收藏页
	public function collection()
	{
		if (!empty($_SESSION['type'])) {
			$type= $_SESSION['type'];
			$this->uid = $_SESSION['uid'] ;		
			$this->assign('type', $type);

		}
		if (!empty($_SESSION['uid'])) {
			$this->uid = $_SESSION['uid'] ;		
			$collected = $this->mycollection();
			if (!empty($collected)) {
				//分页操作，参数是$pageSize：每页显示条数
				$limit = $this->doPaging('article', $collected, 5);
				$collect = $this->article->myCollect($collected, $limit);
				foreach ($collect as $key => $value) {	
						$collect[$key]['addtime'] = date('Y-m-d', $value['addtime']);
				}
				$this->assign('collect', $collect);
			}
			
		}
		
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}
	//当前用户的收藏信息
	public function mycollection()
	{
		if (!empty($this->uid)) {
			$fields = 'collection';
			$where = "uid = $this->uid";
			$res2 = $this->user->getInfo($fields, $where);
			return $collection = $res2[0]['collection'];
		}
	}

	public function doPaging($str, $id, $pageSize)
	{
		$pageres = $this->$str->colpaging($id);//查询总条数
		$this->total = count($pageres);//数据总条数
		$this->page = new Page($this->total, $pageSize);
		$listpage = $this->page->listPage();
		$this->assign('listpage', $listpage);
		$limit = $this->page->getLimit();//获取偏移量
		return $limit;//返回偏移量
	}	

	//忘记密码
	public function forget()
	{
		if (!empty($_POST['name'])) {
				$reg = "/^1[345678]\d{9}$/";
			if(!preg_match($reg,$_POST['name'],$match)) {
				$this->notice('无效手机号码','index.php?m=index&c=user&a=phone');
				exit;	
			}
			$phone = trim($_POST['name']);
			$_SESSION['phone'] = $phone;
			$this->phoneVer($phone);
			$data = $this->assign('phone', $phone);
		}

		if (!empty($_POST['sub'])) {
			//检查用户名
			if (!empty($_POST['username'])) {
				$data['phone'] = $_SESSION['phone'];
				$name = trim($_POST['username']);
				$data['username'] = $this->findName($name);
			}	else {
				$this->notice('用户名不能为空','index.php?m=index&c=user&a=memberinfo');
				exit;
			}

			if (!empty($_POST['pcode'])) {
				if (!is_numeric($_POST['pcode']) || ($_SESSION['pcode'] != trim($_POST['pcode']))){
					$this->notice('您输入的手机动态密码不正确', 'index.php?m=index&c=user&a=forget');
					exit;	
				} 
			}
			//比较两次密码
			if (!empty($_POST['password']) && !empty($_POST['confirm'])) {
				$password = trim($_POST['password']);
				$confirm = trim($_POST['confirm']);
				if (is_numeric($password) || strlen($password)<6) {
					$this->notice('密码不允许纯数字且长度不少于6位','index.php?m=index&c=user&a=forget');exit;	
				}
				if ($password != $confirm){
					$this->notice('两次密码不一致','index.php?m=index&c=user&a=forget');exit;	
				}
				$data['password'] = md5($password);	
			}	else {
				$this->notice('密码不能为空','index.php?m=index&c=user&a=forget');
				exit;
			}

			//检查验证码
			if (!empty($_POST['code'])) {
				$yzm = trim($_POST['code']);
				if (!$this->checkYzm($yzm)) {
					$this->notice('图片验证码不正确','index.php?m=index&c=user&a=forget');
				exit;
				}
			} else {
				$this->notice('请输入验证码','index.php?m=index&c=user&a=forget');
				exit;
			}
			$username = $data['username'];
			$where = "username='$username'";
			$res = $this->user->upfind($data, $where);
			if ($res) {
				$this->notice('找回成功，前往登录','index.php?m=index&c=user&a=login');
				exit;
			} else {
				$this->notice('找回失败,请再次操作','index.php?m=index&c=user&a=forget');
				exit;
			}

		}
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}

	//手机验证
	public function phoneVer($phone)
	{
		$this->options['accountsid']='3b453442b8b12ac26581b87af7ebe973';
		$this->options['token']='41c61b639d733e3f55667064ca022427';
		$this->ucpaas = new Ucpaas($this->options);
		$this->start($phone);
	}
	/**
     * @param string $appId  APPid
     * @param string $phone; 手机号码  $num 随机验证码
     * @param string $templateId  模板id
     * @param array $_SESSION['pcode']  将手机验证吗放到session里面
     * 发送验证码操作
     */
	protected function start($phone)
	{
		$appId = "a96fd3d8f5044edb836a71e456b93ecb";  
		$to = $phone;                         
		$templateId = "101000";	
		$num = mt_rand(1000, 9999);	
		$_SESSION['pcode'] = $num; 
		$param= $num;
		$this->ucpaas->templateSMS($appId,$to,$templateId,$param);

	}

	public function phone()
	{			
		if (!empty($_POST['name'])) {
				$reg = "/^1[345678]\d{9}$/";
			if(!preg_match($reg,$_POST['name'],$match)) {
				$this->notice('无效手机号码','index.php?m=index&c=user&a=phone');
				exit;	
			}
			$phone = trim($_POST['name']);
			$_SESSION['phone'] = $phone;
			$this->phoneVer($phone);
		}
		
		if (!empty($_POST['pcode'])) {
			if (!is_numeric($_POST['pcode']) || ($_SESSION['pcode'] != trim($_POST['pcode']))) {
				$this->notice('您输入的验证码不正确', 'index.php?m=index&c=user&a=phone');
				exit;	
			} 
			$this->notice('验证成功，前往注册', 'index.php?m=index&c=user&a=register');
			exit;	
		}
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}


	
	//个人信息修改
	public function memberinfo()
	{
		//判断是否在线
		if (empty($_SESSION['uid'])) {
			$this->notice('你已掉线，请登录', 'index.php?m=index&c=user&a=login');
					exit;	
		}
		$uid = $_SESSION['uid'];
		$userInfo = $this->user->findUser($uid);
		if ($userInfo) {
			$this->assign('userInfo', $userInfo);
		}
		//判断是否提交表单
		if (!empty($_POST['mark'])) {
			//检查用户名
			if (!empty($_POST['username'])) {
				$name = trim($_POST['username']);
				$data['username'] = $this->checkUname($name, $update=true);
			}	else {
				$this->notice('用户名不能为空','index.php?m=index&c=user&a=memberinfo');
				exit;
			}
			//修改密码
			if (!empty($_POST['password'])) {

				$password = md5(trim($_POST['password'])); 
				if ($password != $userInfo['password']) {
					$this->notice('原密码不正确','index.php?m=index&c=user&a=memberinfo');
					exit;	
				} 
				//比较两次密码
				if (!empty($_POST['newpass']) && !empty($_POST['confirm'])) {
					$password = trim($_POST['newpass']);
					$confirm = trim($_POST['confirm']);
					$data['password'] = $this->checkPassword($password, $confirm, $update=true);
				}	
			}
			//检查手机号码
			if (!empty($_POST['phone'])) {
				$phone = trim($_POST['phone']);
				$data['phone'] = $this->checkPhone($phone, $update=true);
			} else {
				$this->notice('手机号码不能为空','index.php?m=index&c=user&a=memberinfo');
				exit;
			}
			//检查QQ号码
			if (!empty($_POST['qq'])) {
				$qq = trim($_POST['qq']);
				if (is_numeric($qq)) {
					$data['qq'] = $qq;
				} else {
					$this->notice('QQ号码只能是数字','index.php?m=index&c=user&a=memberinfo');
					exit;	
				}
			}
			//检查邮箱格式
			if (!empty($_POST['email'])) {
				$email = trim($_POST['email']);
				$data['email'] = $this->checkEmail($email, $update=true);
			}	else {
				$this->notice('邮箱不能为空','index.php?m=index&c=user&a=memberinfo');
				exit;
			}
			if (!empty($_POST['picture'])) {
				$data['picture'] = $_POST['picture'];
			} else {
				$data['picture'] = 'public/images/deficon.jpg';
			}
			if (!empty($_FILES['picture']['size'])) {
				if (!$this->upload->errorMessage) {
					$data['picture'] = $this->upload->uploadFile('picture');
				}
			} 
			$res = $this->user->updateInfo($uid, $data);
			if ($res) {
				$this->notice('修改成功','index.php?m=index&c=user&a=memberinfo');
				exit;
			} else {
				$this->notice('修改失败','index.php?m=index&c=user&a=memberinfo');
				exit;
			}
			
			//更新信息，去调用方法
	
		}
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}

	
	//登录
	public function login()
	{
		if (!empty($_POST['submit'])) {
			//判断用户名和密码是否为空
			if (!empty($_POST['username']) && !empty($_POST['password'])) {
				$name = trim($_POST['username']);
				$password = trim($_POST['password']);
				$result = $this->user->check($name);
				//检查用户是否存在
				if (!$result) {
					$this->notice('该用户不存在，请先注册', 'index.php?m=index&c=user&a=login');
					exit;
				} 
				if ($result[0]['del'] == 1) {
					$this->notice('你已被列入黑名单', 'index.php?m=index&c=user&a=login');
							exit;
				}
				if ($result[0]['password'] != md5($password)) {
							$this->notice('密码错误', 'index.php?m=index&c=user&a=login');
							exit;
						}
				//将登录信息存入session	
				$_SESSION['username'] = $result[0]['username'];
				$_SESSION['type'] = $result[0]['type'];
				$_SESSION['uid'] = $result[0]['uid'];
				$_SESSION['email'] = $result[0]['email'];
				$this->notice('登录成功', 'index.php?m=index&c=index&a=index');
			} else {
					$this->notice('用户名和密码不能为空', 'index.php?m=index&c=user&a=login');
					exit;
			}

		}
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
		
	}

	//注册
	public function register()
	{
		
		if (!empty($_POST['submit'])) {
			//检查用户名
			if (!empty($_POST['username'])) {
				$name = trim($_POST['username']);
				$data['username'] = $this->checkUname($name);
			}	else {
				$this->notice('用户名不能为空','index.php?m=index&c=user&a=register');
				exit;
			}

			//检查手机号码
			// if (!empty($_POST['phone'])) {
			// 	$phone = trim($_POST['phone']);
			// 	$data['phone'] = $this->checkPhone($phone);
			// }	else {
			// 	$this->notice('手机号码不能为空','index.php?m=index&c=user&a=register');
			// 	exit;
			// }
			$data['phone'] = $_SESSION['phone'];
			//检查邮箱格式
			if (!empty($_POST['email'])) {
				$email = trim($_POST['email']);
				$data['email'] = $this->checkEmail($email);
			}	else {
				$this->notice('邮箱不能为空','index.php?m=index&c=user&a=register');
				exit;
			}
			//比较两次密码
			if (!empty($_POST['password']) && !empty($_POST['confirm'])) {
				$password = trim($_POST['password']);
				$confirm = trim($_POST['confirm']);
				$data['password'] = $this->checkPassword($password, $confirm);
			}	else {
				$this->notice('密码不能为空','index.php?m=index&c=user&a=register');
				exit;
			}
			//检查验证码
			if (!empty($_POST['yzm'])) {
				$yzm = trim($_POST['yzm']);
				if (!$this->checkYzm($yzm)) {
					$this->notice('验证码不正确','index.php?m=index&c=user&a=register');
					exit;
				}
			}	else {
				$this->notice('请输入验证码','index.php?m=index&c=user&a=register');
				exit;
			}
			//获取主机名
			$data['regip'] = $this->getIp();
			//获取注册时间
			$data['regtime'] =$_SERVER['REQUEST_TIME'];
			//为用户设置默认头像
			$data['picture'] = 'public/images/1iconn.png';
			//调用方法存入数据库
			$resid = $this->user->insertRegister($data);
			if ($resid) {
				$this->notice('注册成功请登录','index.php?m=index&c=user&a=login');
				exit;
			} else {
				$this->notice('注册失败','index.php?m=index&c=user&a=register');
				exit;
			}
		}	
		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}


/*******************注册检查方法****************************/
	//检查用户名
	public function checkUname($name,$update=false,$min=2,$max=30)
	{
		//用户名是否合法 
		$reg = "/^([\x{4e00}-\x{9fa5}]|\w){" . $min . "," . $max . "}$/u";
		if(preg_match($reg,$name,$match)) {	
			$result = $this->user->check($name);
			//用户名是否已存在
			if ($result && !$update) {
				$this->notice('用户名已存在','index.php?m=index&c=user&a=register');
				exit;
			} 
			return $name;
		} else if($update) {
				$this->notice('用户名不合法','index.php?m=index&c=user&a=memberinfo');
				exit;
			} else {
				$this->notice('用户名不合法','index.php?m=index&c=user&a=register');
				exit;
			}
	}

	//找回密码，检查用户名
	public function findName($name,$min=2,$max=30)
	{
		//用户名是否合法 
		$reg = "/^([\x{4e00}-\x{9fa5}]|\w){" . $min . "," . $max . "}$/u";
		if(preg_match($reg,$name,$match)) {	
			$result = $this->user->check($name);
			//用户名是否已存在
			if (!$result) {
				//用户名不存在
				$this->notice('用户名不存在','index.php?m=index&c=user&a=forget');
				exit;
			}
			 //用户名存在
			return $name;
		}  else {
				$this->notice('用户名不合法','index.php?m=index&c=user&a=forget');
				exit;
			}
	}





	//检查手机号码
	public function checkPhone($phone, $update=false)
	{
		$reg = "/^1[345678]\d{9}$/";
		if(preg_match($reg,$phone,$match)) {
			return $phone;
		} else if ($update) {
			$this->notice('手机号码不合法','index.php?m=index&c=user&a=memberinfo');
			exit;
		} else {
			$this->notice('手机号码不合法','index.php?m=index&c=user&a=register');
			exit;
		}
	}	
	//检查邮箱格式
	public function checkEmail($email, $update=false)
	{
		$reg = "/^\w+@(\w+\.)+(com|cn|net)$/";
		if(preg_match($reg,$email,$match)) {
				return $email;
		} else if ($update) {
			$this->notice('邮箱格式不合法','index.php?m=index&c=user&a=memberinfo');
			exit;
		} else {
			$this->notice('邮箱格式不合法','index.php?m=index&c=user&a=register');
			exit;
		}
	}
	//检查两次密码
	public function checkPassword($password, $confirm, $update=false)
	{
		//检查密码是否合法//比较两次密码是否一致
		if (is_numeric($password) || strlen($password)<6) {
			if ($update) {
				$this->notice('密码不允许纯数字且长度不少于6位','index.php?m=index&c=user&a=memberinfo');exit;	
			} else {
				$this->notice('密码不允许纯数字且长度不少于6位','index.php?m=index&c=user&a=register');exit;	
			}		
		} else if ($password != $confirm){
			if ($update) {
				$this->notice('两次密码不一致','index.php?m=index&c=user&a=memberinfo');
			exit;
			} else {
				$this->notice('两次密码不一致','index.php?m=index&c=user&a=register');
			exit;
			}
			
		}
		//加密密码
		$password = md5($password);
		unset($_POST['confirm']);//销毁用于确认的密码
		return $password;
	}

	//检查验证码
	public function checkYzm($yzm)
	{
	
		if (strtolower($yzm) != strtolower($_SESSION['code'])) {
			return false;
		}
		unset($_POST['yzm']);//销毁验证码
		return true;
	}
	//获取主机名
	public function getIp()
	{
		$regip = $_SERVER['REMOTE_ADDR'];
		if ($regip == '::1') {//本地ip需要转换格式
			$regip= '127.0.0.1';
		}
		return $regip;
	}
	//输出验证码，存入session
	public function verify()
	{
		$code = verify::ver();
	}

}