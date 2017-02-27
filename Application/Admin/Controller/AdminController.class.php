<?php
namespace Admin\Controller;
use \Common\Lib\Controller;
class AdminController extends Controller{
	public function index(){
		//今日订单
		$starttime=strtotime(date("Y-m-d",time())." 0:0:0");
		$endtime=strtotime(date("Y-m-d",time())." 23:59:59");
		$todayorder=M("order")->where("createtime between '{$starttime}' and '{$endtime}' and status=1 and orderstatus>1")->count();
		//总订单
		$zongorder=M("order")->where("status = 1  and orderstatus>1")->count();
		//已处理订单
		$yclorder=M("order")->where("status = 1 and orderstatus >2")->count();
		//未处理订单
		$wclorder=M("order")->where("status = 1  and orderstatus = 2")->count();
		//自定义订单
		
		$ordercount['todayorder']=$todayorder;
		$ordercount['zongorder']=$zongorder;
		$ordercount['yclorder']=$yclorder;
		$ordercount['wclorder']=$wclorder;
		$this->assign("ordercount",$ordercount);
		$this->display();
	}
	public function listAll(){
		$items = M('admin') -> field('username,id,status') -> select();
		foreach ($items as $key => $value) {
			$role_id =  M('role_user') -> where(array('user_id' => $value['id'])) -> getField('role_id', true);
			$role_remark = array();
			foreach ($role_id as $k => $v) {
				$remark = M('role') -> where(array('id' => $v, 'status' => 1)) -> getField('remark');
				if(!is_null($remark)){
					$role_remark[] = $remark;
				}
			}
			$items[$key]['role'] = $role_remark;
		}
		$this -> assign(array(
			'items' => $items
			));
		$this->assign('items',$items);
		$this->display();
	}
	public function add()
	{
		$Role = M('role');
		$items = $Role -> field('id,name') -> select();
		if(empty($items)){
			$this -> error('请先添加一个角色！', 'Role/add');
		}
		$this -> assign(array(
			'items' => $items
			));
		$this -> display();
	}
	public function addHandler()
	{
		$username = I('post.username');
		$password = I('post.password');
		$confirmpassword = I('post.confirmpassword');
		$roles = I('post.role');
		$status = I('post.status');
		if(!$username){
			$this -> error('用户名为空！');
		}else{
			if(!$password){
				$this -> error('密码为空！');
			}else{
				if($password !== $confirmpassword){
					$this -> error('两次密码输入不同！');
				}else{
					$Admin = M('admin');
					if($Admin -> where(array('username' => $username)) -> getField('id')){
						$this -> error('该用户名已经存在！');
					}else{
						/*if(empty($roles)){
							$this -> error('未选择所属角色组！');
						}else{
							
						}*/
						$data = array(
								'username' => $username,
								'password' => md5($password),
								'status' => $status
								);
							if($uid = $Admin -> add($data)){
								foreach ($roles as $key => $value) {
									$role[] = array(
										'role_id' => $value,
										'user_id' => $uid,
									);
								}
								M('role_user')->addAll($role);
							}
						$this -> redirect('Admin/listAll');
					}
				}
			}
		}
	}

	public function edit()
	{
		$items = M('role') -> where(array('status' => 1)) -> field('id,name') -> select();
		$id = I('get.id');
		$roles = M('role_user') -> where(array('user_id' => $id)) -> getField('role_id', true);
		$item = M('admin') -> where(array('id' => $id)) -> find();
		$this -> assign(array(
			'id' => $id,
			'item' => $item,
			'items' => $items,
			'roles' => $roles
			));
		$this -> display();
	}

	public function editHandler()
	{
		$id = I('get.id', 0, 'intval');
		$username = I('username');
		$password = I('password');
		$confirmpassword = I('confirmpassword');
		$roles = I('post.role');
		$status = I('status');
		if(!$id){
			$this -> error('参数错误！', 'Admin/listAll');
		}else{
			$Admin = M('admin');
			if(!empty($username) && $Admin -> where(array('username' => $username)) -> getField('id')){
				$this -> error('用户名已存在！');
			}else{
				if($password !== $confirmpassword){
					$this -> error('两次密码输入不同！');
				}else{
					if(empty($roles)){
						$this -> error('未选择所属角色组！');
					}else{
						$data = array(
							'status' => $status
							);
						if($username){
							$data['username'] = $username;
						}
						if($password){
							$data['password'] = md5(C(AUTO_KEY).$password);
						}
						if (false !== $Admin -> where(array('id' => $id)) -> save($data)) {
							foreach ($roles as $key => $value) {
								$role[] = array(
									'role_id' => intval($value),
									'user_id' => $id,
								);
							}
							//var_dump($role);die;
							M('role_user') -> where(array('user_id' => $id))->delete();
							M('role_user') -> addAll($role);
						}
						$this -> redirect('Admin/listAll');
					}
				}
			}
		}
	}

	public function modifyPassword()
	{
		//session('uid', 1);
		$this -> display();
	}

	public function modifyPasswordHandler()
	{
		$oldpassword = md5(C(AUTO_KEY).I('oldpassword'));
		$password =  md5(C(AUTO_KEY).I('password'));
		$confirmpassword = md5(C(AUTO_KEY).I('confirmpassword'));
		$Admin = M('admin');
		$admin_user=session("admin_user");
		$truepassword = $Admin -> where(array('id' => $admin_user[0]['id'])) -> getField('password');
		if($oldpassword && $oldpassword === $truepassword){
			if(!$password){
				$this -> error('请输入新密码！');
			}else{
				if($password !== $confirmpassword){
					$this -> error('两次密码输入不正确！');
				}else{
					$Admin -> where(array('id' => session('uid'))) -> save(array('password' =>$password));
					$this -> redirect('Admin/listAll');
				}
			}
		}else{
			$this -> error('原始密码不正确！');
		}
	}

	public function detail()
	{
		$id = I('get.id');
		$type = 2;
		if(empty($id)){
			$id = session('uid');
		}
		$items = M('admin') -> where(array('id' => $id)) -> field('id,username,logintimes,logintime,loginip,status') -> find();
		$role_id =  M('role_user') -> where(array('user_id' => $items['id'])) -> getField('role_id', true);
		$role_remark = array();
		foreach ($role_id as $k => $v) {
			$remark = M('role') -> where(array('id' => $v, 'status' => 1)) -> getField('remark');
			if(!is_null($remark)){
				$role_remark[] = $remark;
			}
		}
		$items['role'] = $role_remark;
		$this -> assign(array(
			'items' => $items,
			'logs' => $logs,
			'id' => $id,
			));
		$this -> display();
	}

}
