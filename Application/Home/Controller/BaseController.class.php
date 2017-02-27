<?php
namespace Home\Controller;
use \Think\Controller;
class BaseController extends Controller{
	protected $user;
	protected $shopCart;
	public $_shopCart;
	public function _initialize(){
		//用户登录
		session_set_cookie_params(24*3600*7);
		$this->user=$_SESSION['user'];
		//记录商城设置
		$shopSet=M("shop_set")->where("id=1")->select();
		if(!$shopSet[0]['isyou']){
			$shopSet[0]['postage']=0;
		}
		$_SESSION['shopSet']=$shopSet[0];
		
		//购物车
		if($_SESSION['user']){//用户登录则入库，未登录则记录session
			$user=$_SESSION['user'];
			//用户存在 则检测session是否存在购物车  存在将购物车内容加入到数据库 之后的购物车程序 自动切换到数据库模式
			if($_SESSION['shopCart']){
				$shopCart=$_SESSION['shopCart'];
				foreach($shopCart as $k=>$v){
					$shopCart=$v;
					$shopCart['uid']=$user['id'];
					$shopCart['ctime']=time();
					M("shop_cart")->add($shopCart);
				}
				$_SESSION['shopCart']=null;
			}
			//读取数据库购物车内容
			$shopCart=M('shop_cart')->where("uid={$_SESSION['user']['id']} and status=1")->select();
			$this->assign("user",$user);
		}else{
			$shopCart=$_SESSION['shopCart'];
		}

		$shopCartAmount=0;
		if($shopCart){
			foreach($shopCart as $k=>$v){
				$shopCartAmount+=$v['amount'];
				if($v['attrall']){
					$attrall=unserialize($v['attrall']);
					$shopCart[$k]['attrall']=$attrall;
				}
			}
		}

		$this->_shopCart=$shopCart;
		$this->assign("allAmount",$shopCartAmount);
		$this->assign("shopCartAmount",$shopCartAmount);
		$this->assign("shopCartCount",count($shopCart));
		$this->assign("shopCartList",$shopCart);
		$this->assign("shopSet",$shopSet[0]);
		//dump($shopCartAmount);

	}
}