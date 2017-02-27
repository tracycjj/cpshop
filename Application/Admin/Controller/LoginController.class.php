<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
	public function index(){
		$this->display("login");
	}
	public function loginHandler(){
		$code=I("post.verify");
		$data['username']=I("post.username");
		$data['password']=md5(C(AUTO_KEY).I("post.password"));
		//dump($data);exit;
		$data['actiontime']=time();
		$relus=array(
				array('username','require','用户名为空','0','1'),
				array('password','require','密码为空','0','1'),
				);
		$admin=M("admin");
		$verify= new \Think\Verify();
		/*if(!$verify->check($code,1)){
			$this->error("验证码错误");	
		}*/
		if(!$admin->validate($relus)->create($data,1)){
			$this->error($admin->getError());
		}
		$user=$admin->where("username='{$data['username']}'")->select();
		if(empty($user)){
			$this->error("用户名不存在");
		}
		if($user[0]['password'] !== $data['password']){
			$this->error('密码错误');
		}				
		session('admin_user',$user);
		$data['sessionid']=session_id();
		
		//var_dump(session('admin_user'));
		if($admin->where("id= '{$user[0]['id']}' ")->save($data)){
			$this->redirect('Admin/index');
		}
	}
	public function logout(){
		$_SESSION['admin_user']=null;
		$this->redirect("admin/index");
	}
	public function verify(){
		$verifyConfig =array(
				    'fontSize'=>20,	//验证码字体大小（像素） 默认为25
					'useCurve'=>false,	//是否使用混淆曲线 默认为true
					'useNoise'=>false,	//是否添加杂点 默认为true
					'imageW'=>0,		//验证码宽度 设置为0为自动计算
					'imageH'=>0,		//验证码高度 设置为0为自动计算
					'length'=>4,		//验证码位数
					//'zhSet' => '们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这', //中文
					'useZh'=>false,		//是否使用中文验证码
				);
		$verify= new \Think\Verify($verifyConfig);
		$verify->entry(1);
	}
	/*public function verify(){
		$verify=new  \Common\Lib\Verify(136,40);
        $verify->imageout(1);
   	
	}*/
}  