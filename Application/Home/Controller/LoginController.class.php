<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class LoginController extends BaseController{
	public function _initialize(){
		parent::_initialize();
	}
	public function index(){
		$this->display("login");

	}
	public function LoginHandler(){
		$data['email']=I("post.email");
		$data['password']=md5(I("post.password"));
		if(M("user")->where("status=0 and email={$data['email']} ")->select()){
			$this->ajaxReturn(array("status"=>0,"info"=>"该账号异常，暂时无法登陆"));
		}
		$usermess=M("user")->where("status=1 and email='{$data['email']}' and password= '{$data['password']}' ")->field("id,email,username")->select();
		//echo M("user")->getLastSql();exit;
		if(!$usermess){
			$this->error("账号或密码错误！!");
		}
		session("user",$usermess[0]);
		$this->redirect("/");
	}
	public function register(){
		
		$this->display();
	}
	public function registerHandler(){
		$data['username']=I("post.username");
		$data['email']=I("post.email");
		if(strlen(I("post.password"))<6){
			$this->error("密码长度过短!");
		}
		$data['password']=md5(I("post.password"));
		$data['ctime']=time();
		if(!$data['username'] || !$data['email']){
			$this->error("非法注册!");
		}
		if(M("user")->where("status=1 and email={$data['email']} ")->select()){
			$this->error("该邮箱已被注册，请直接登录！");
		}
		if(!$id=M("user")->add($data)){
			$this->error("注册失败，请重新注册！");
		}
		$user['id']=$id;
		$user['email']=$data['email'];
		$user['username']=$data['username'];
		session("user",$user);
		$this->redirect("User/index");
	}
	public function logout(){
		$_SESSION['user']=NULL;
		$this->redirect("Login/index");
	}
}
