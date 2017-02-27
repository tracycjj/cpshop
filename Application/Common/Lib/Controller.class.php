<?php
namespace Common\Lib;
class Controller extends \Think\Controller{
	public function _initialize(){

		if(!session("admin_user")){
			define('IS_LOGIN', false);
			define('IS_DEVELOPER', false);

			$this -> error('您未登陆或身份信息已失效，请重新登陆！', U('Admin/Login/index'));
		}else{
			$admin_user=session('admin_user');
			$sid = M('admin') -> where(array('username' =>$admin_user[0]['username'])) -> getField('sessionid');

			if($sid !== session_id()){

				define('IS_LOGIN', false);
				define('IS_DEVELOPER', false);
				/*session_unset();
				session_destroy();*/
				$_SESSION['username']=''; 
       			$_SESSION['uid']=''; 
       			$_SESSION['fanc']=''; 
				$this -> error('您的账号已在其他地方登陆，即将退出登陆！', U('Admin/Login/logout'));
			}else{
				define('IS_LOGIN', true);
				if(empty($_SESSION[C('ADMIN_AUTH_KEY')])){
					define('IS_DEVELOPER', 'false');
				}else{
					define('IS_DEVELOPER', 'true');
				}
				if(!\Common\Lib\Rbac::AccessDecision()){
					$this -> error('抱歉，您没有相关权限！');
				}
				
				//获取当前管理员权限列表
				if(method_exists($this,'_init'))

            	$this->_init();
			}
		}
	}	


}
