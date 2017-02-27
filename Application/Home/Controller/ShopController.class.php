<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class ShopController extends BaseController{
	public function _initialize(){
		//一级导航
		parent::_initialize();
		$shopCateOne=M("shop_cate")->where("pid=0 and status=1")->select();
		$this->assign("shopCateOne",$shopCateOne);
		//dump($shopCateOne);
	}
	public function goods(){
		$id=I('get.id');
		$goodsMess=M("shop_goods")->where("id={$id} and status=1")->select();
		if(!$goodsMess){
			$this->error("当前商品不存在!");
		}
		$goodsMess[0]['goodsimg']=explode(',', $goodsMess[0]['goodsimg']);
		$attr=explode(',',$goodsMess[0]['attrid']);
		//dump(empty($attr[0]));
		if($attr[0]){
			$shopAttr=M("shop_attr");
			$goodsAttr=M("goods_attr");
			$attrArr=array();
			foreach($attr as $k=>$v){
				$attrArr[$k]=$shopAttr->where("id={$v} and status=1")->select()[0];
			}
			foreach($attrArr as $k=>$v){
				$attrArr[$k]['sonattr']=$goodsAttr->where("attrpid={$v['id']} and status=1 and gid={$id} ")->field("id,attrname,price,color")->select();
			}
		}else{
			$attrArr=array();
		}
		$goodsMess[0]['attrArr']=$attrArr;
		//dump($goodsMess);	
		//获得栏目信息
		$cid=$goodsMess[0]['cid'];
		$cateMess=M("shop_cate")->where("id={$cid}")->select();
		//获得相似产品
		$similar=M("shop_goods")->where("cid={$cid} and status=1 and id != {$id}")->order("ctime desc")->limit("0,8")
				->field("id,picimg,name,pricenow")
				->select();
		$this->assign('cate',$cateMess[0]);
		$this->assign('goodsMess',$goodsMess[0]);
		$this->assign('similar',$similar);
		//$_SESSION['shopCart']=null;
		$this->display();
	}
	public function addShopCart(){
		if(IS_AJAX){
			//$_SESSION['shopCart']=null;exit;
			$data['gid']=I("post.gid");
			$data['attrid']=I("post.attrid");//1,2,3
			$data['attrname']=I("post.attrname");
			$data['number']=I("post.number");
			$data['amount']=I("post.gid");
			
			$goods=M("shop_goods")->where("id={$data['gid']} and status=1")->field("name,picimg,pricenow,sales,stocks,xiajia")->select();
			//检测存在
			if(!$goods){
				$this->ajaxReturn(array("status"=>0,"info"=>"此商品不存在!"));
			}
			$goods=$goods[0];
			//检测下架
			if(!$goods['xiajia']){
				$this->ajaxReturn(array("status"=>0,"info"=>"此商品已下架!"));
			}
			//检测库存
			if( ($goods['stocks']-$goods['sales']) <= 0){
				$this->ajaxReturn(array("status"=>0,"info"=>"此商品已售完,暂时无货!"));
			}

			$attrAllPrice=0;//属性价格
			$shopCartAttr='';//所有属性序列化字符串
			if($data['attrid']){
				$attrArr=explode(',',$data['attrid']);
				foreach($attrArr as $k=>$v){
					$shopCartAttr[$k]=M("goods_attr")->where("gid={$data['gid']} and id={$v} and status=1")
										->field("id,attrpid,attrid,attrname,price")
										->select()[0];
					$attrAllPrice+=$shopCartAttr[$k]['price'];					
				}
				$shopCartAttr=serialize($shopCartAttr);
			}
			$amount=($attrAllPrice+$goods['pricenow'])*$data['number'];
			$shopCartGoods['gid']=$data['gid'];
			$shopCartGoods['name']=$goods['name'];
			$shopCartGoods['picimg']=$goods['picimg'];
			$shopCartGoods['pricenow']=$goods['pricenow'];
			$shopCartGoods['attrid']=$data['attrid'];
			$shopCartGoods['attrprice']=$attrAllPrice;
			$shopCartGoods['attrall']=$shopCartAttr;
			$shopCartGoods['number']=$data['number'];
			$shopCartGoods['amount']=$amount;//总金额
			//dump($shopCartGoods);exit;
			//加入了购物车将库存减去
			//M("shop_goods")->where("id={$data['gid']}")->setInc("sales",$shopCartGoods['number']);
			if($_SESSION['user']){//用户登录则入库，未登录则记录session
				$uid=$_SESSION['user']['id'];
				$shopCartGoods['uid']=$uid;
				$shopCartGoods['ctime']=time();
				//入库 然后查库
				if(!M("shop_cart")->add($shopCartGoods)){$this->ajaxReturn(array("status"=>0,"info"=>"加入购物车失败，请重试!"));}
				$shopCart=M("shop_cart")->where("uid={$uid} and status=1")->select();
			}else{
				$shopCart=$_SESSION['shopCart'];
				if(!$shopCart){
					$shopCart=array();
					$shopCart[]=$shopCartGoods;
				}else{
					$shopCart[]=$shopCartGoods;
				}
				$_SESSION['shopCart']=$shopCart;
				//得到购物车所有数组
				$shopCart=$_SESSION['shopCart'];
			}
			$shopCartAmount=0;
			foreach($shopCart as $k=>$v){
				$shopCartAmount+=$v['amount'];
			}
			$this->ajaxReturn(array("status"=>1,"info"=>"加入购物车成功!","amount"=>$shopCartAmount,"shopCartCount"=>count($shopCart)));
		}
		
	}
	public function listShopCart(){
		//$_SESSION['shopCart']=null;
		//dump($_SESSION['shopCart']);
		$this->display();
	}
	public function saveNumber(){
		$shopcartid=I("get.shopcartid");
		$number=I("get.number");
		if($_SESSION['user']){//用户登录则更具id查库 未登录则找到session 最终获得要修改的这个数组的信息 判断数据库数量
			//修改购物车 id = $shopcartid 的number和amount 然后新价格-老价格 传递前端
			$old=M("shop_cart")->where("id={$shopcartid}")->select()[0];
			$newAmount=($old['attrprice']+$old['pricenow'])*$number;
			$amountChange=$newAmount-$old['amount'];
			M("shop_cart")->where("id={$shopcartid}")->save(array("number"=>$number,"amount"=>$newAmount));
			$this->ajaxReturn(array("status"=>1,"info"=>$newAmount,"amountChange"=>$amountChange));
		}else{
			$shopCart=$_SESSION['shopCart'];
			$changeArr=$shopCart[$shopcartid];	

			$oldAmount=$changeArr['amount'];
			$newAmount=($changeArr['attrprice']+$changeArr['pricenow'])*$number;

			$changeArr['number']=$number;
			$changeArr['amount']=$newAmount;
			$shopCart[$shopcartid]=$changeArr;
			$_SESSION['shopCart']=$shopCart; //修改完价格和数量之后 在存回session

			$amountChange=$newAmount-$oldAmount;
			$this->ajaxReturn(array("status"=>1,"info"=>$newAmount,"amountChange"=>$amountChange));

		}

	}
	public function delCartGoods(){
		$shopcartid=I("get.shopcartid");
		if($_SESSION['user']){//用户登录则更具id查库 未登录则找到session 最终获得要修改的这个数组的信息 判断数据库数量
			$old=M("shop_cart")->where("id={$shopcartid}")->select()[0];
			M("shop_cart")->where("id={$shopcartid}")->delete();
			$this->ajaxReturn(array("status"=>1,"amountChange"=>$old['amount']));
		}else{
			$shopCart=$_SESSION['shopCart'];
			$changeArr=$shopCart[$shopcartid];	
			$amountChange=$changeArr['amount'];
			unset($shopCart[$shopcartid]);
			$_SESSION['shopCart']=$shopCart;
			$this->ajaxReturn(array("status"=>1,"amountChange"=>$amountChange));
		}
	}
	public function addMessage(){
		//dump($_POST);
/*
		$data['orderid']=;
		$data['uid']=;
		$data['totalnum']=;//数量
		$data['totalprice']=;//商品总价
		$data['kdprice']=;//快递价格
		$data['yhprice']=;//优惠金额
		$data['cardid']=;//优惠券ID
		$data['ispay']=;//是否支付
		$data['payprice']=;//支付总金额
		$data['address']=;//地址
		$data['phone']=;//联系电话
		$data['username']=;//收货人姓名
		$data['note']=;//留言
		$data['giftnote']=;//贺卡内容
		$data['kdname']=;//快递公司
		$data['kdorder']=;//快递单号
		$data['isfh']=;//是否发货
		$data['fhtime']=;//发货时间
		$data['ctime']=;//订单创建时间
		$data['goodsmess']=;//订单商品信息
		$data['orderstatus']=;//订单状态 0=>未付款 1=>已付款 2=>已发货 3=>已签收（订单完成） 4=>退货 5=>订单关闭
		$data['status']=;//订单存在状态 1=>存在 0=>删除
*/
 		$this->display();
	}
	public function makeOrder(){
		$mtime=explode(' ',microtime());
		$startTime=$mtime[0].$mtime[1].rand(0,10000); 
		$data['orderid']=substr($startTime,2,18);
		if(M("shop_order")->where("orderid={$data['orderid']}")->select()){
			$this->ajaxReturn(array("status"=>0,"info"=>"订单生成失败!"));
		}

		if($_SESSION['user']){
			$data['uid']=$_SESSION['user']['id'];
			$shopCart=M('shop_cart')->where("uid={$_SESSION['user']['id']} and status=1")->select();
		}else{
			$data['uid']=0;
			$shopCart=$_SESSION['shopCart'];
 		}
			
			//检测库存
			foreach($shopCart as $k=>$v){
				$goodsMess=M("shop_goods")->where("id={$v['gid']}")->field('sales,stocks')->select()[0];
				if(($goodsMess['stocks']-$goodsMess['sales']) <= $v['number']){
					$info=$v['name']."库存不足，剩余".($goodsMess['stocks']-$goodsMess['sales'])."件！";
					$this->ajaxReturn(array("status=0","info"=>$info));
				}
			}
			
			$totalnum=0;
			$totalprice=0;
			foreach($shopCart as $k=>$v){
				$totalnum+=$v['number'];
				$totalprice+=$v['amount'];
				$shopCart[$k]['attrall']=unserialize($v['attrall']);
			}
			$data['totalnum']=$totalnum;
			$data['totalprice']=$totalprice;
			$data['kdprice']=$_SESSION['shopSet']['postage'];
			$data['yhprice']=0;
			$data['cardid']=0;
			$data['ispay']=0;
			$data['payprice']=$data['totalprice']+$data['kdprice']-$data['yhprice'];

			$data['payment']=I("post.payment");
			$data['address']=I("post.address");//地址
			$data['phone']=I("post.phone");//联系电话
			$data['username']=I("post.username");;//收货人姓名
			$data['note']=I("post.note");;//留言
			$data['giftnote']=I("post.giftnote");;//贺卡内容
			$data['ctime']=time();//订单创建时间
			$data['goodsmess']=serialize($shopCart);//订单商品信息 序列化$shopCart
			$data['orderstatus']=0;//订单状态 0=>未付款 1=>已付款 2=>已发货 3=>已签收（订单完成） 4=>退货 5=>订单关闭
			//入库返回orderid
			if(!M("shop_order")->add($data)){
				$this->ajaxReturn(array("status"=>0,"info"=>"订单生成失败!"));
			}
			foreach($shopCart as $k=>$v){
				M("shop_goods")->where("id={$v['gid']}")->setInc("sales",$v['number']);
				
			}
			//M("shop_goods")->where("id={$data['gid']}")->setInc("sales",$shopCartGoods['number']);
			$this->ajaxReturn(array("status"=>1,"info"=>"订单已生成,跳转支付!","orderid"=>$data['orderid']));


	}
	public function orderPay(){
		$orderid=I("get.orderid");
		$order=M("shop_order")->where("orderid=$orderid")->select();
		if(!$order){
			$this->error("此订单不存在!");
		}
		if($order[0]['payment'] == 1){
			$this->alipay($order);
		}
		if($order[0]['payment'] == 2){
			$this->wxpay($order);
		}
	}

}