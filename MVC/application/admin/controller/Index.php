<?php
namespace admin\controller;
use admin\model\User;
use framework\Verify;
class Index extends Controller
{
	
	protected $user;
	public function __construct()
	{
		parent::__construct();
		$this->user = new User;
	}


	//输出验证码，存入session
	public function verify()
	{
		$code = verify::ver();	
	}

	//后台登录
	public function adlogin()
	{
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$name = trim($_POST['username']);
			$password = trim($_POST['password']);
			$result = $this->user->check($name);
		
			//检查用户是否存在
			if (!$result) {

				$this->notice('请检查用户名', 'index.php?m=admin&c=index&a=adlogin');
				exit;
			} 
			if ($result[0]['type'] !=1) {
					$this->notice('你不是管理员', 'index.php?m=admin&c=index&a=adlogin');
						exit;
				} 
			if ($result[0]['password'] != md5($password)) {
					$this->notice('密码错误', 'index.php?m=admin&c=index&a=adlogin');
					exit;
				}  
			//检查验证码
			$yzm = trim($_POST['code']);
			if (strtolower($yzm) != strtolower($_SESSION['code'])) {
				$this->notice('验证码不正确','index.php?m=admin&c=index&a=adlogin');
				exit;	
			}
			$this->notice('登录成功', 'index.php?m=admin&c=index&a=index');
		}		
	$this->display();
	}

	//修改密码
	public function password()
	{
		$admin = $this->user->findName('type=1');
		if ($admin) {
				$this->assign('admin', $admin);
			if (!empty($_POST['mpass'])) {
				$mpass = md5(trim($_POST['mpass'])); 
				if ($mpass != $admin['password']) {
					$this->notice('原密码不正确','index.php?m=admin&c=index&a=password');
					exit;	
				} 
				$uid = $admin['uid'];
				$newpass = md5(trim($_POST['newpass']));
				$data = ['password'=>$newpass];
				$result = $this->user->uppass($data,$uid);
				if ($result) {
					$this->notice('修改成功','index.php?m=admin&c=index&a=password');
					exit;	
				}

			}
		}

		$this->display();
	}



	//网站信息
	public function siteinfo()
	{
		$sitepath = 'config/info.php';
		if (!empty($_POST)) {
			$info = [
					'stitle'		 => $_POST['stitle'],
					'surl'			 => $_POST['surl'],
					'sdescription'	 => $_POST['sdescription'],
					's_phone'	     => $_POST['s_phone'],
					's_contact'	     => $_POST['s_contact'],
					's_qq'	         => $_POST['s_qq'],
					's_qqu' 	     => $_POST['s_qqu'],
					's_email' 	     => $_POST['s_email'],
					's_address' 	 => $_POST['s_address'],
					'scopyright' 	 => $_POST['scopyright'],
			];
		$str = "<?php \n return " . var_export($info, true) . ';';
		$result = file_put_contents($sitepath, $str);
		if ($result) {
			$this->notice('修改成功','index.php?m=admin&c=index&a=siteinfo');
					exit;	
		} else {
			$this->notice('修改失败','index.php?m=admin&c=index&a=siteinfo');
					exit;	
		}
	}

		$arr = include('config/info.php');
		$data = $this->assign('data', $arr);
		$this->display();
	}

	//后台首页
	public function index()
	{
		$this->display();
	}
	//相册管理
	public function album()
	{
		$this->display();
	}



}