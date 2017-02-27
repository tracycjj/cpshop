<?php
namespace Core\weixin;
/*
	获取值方法： return
	输出xml方法 echo 
 */
class Wx
{
	public $token="cailingxiaozhushou";
	public $appid="wxd37e16b92691185d";
	public $secret="f2598bc5ce83db54f8f49c0a8ea4ecbc";
	public $redirect_uri="www.91duofenxiang.com";
	public $openid;
	public $fromUser="kaifu_zhifu";//开发者微信号
	//接入验证
	/*public function __construct($wxConfig){
		$this->token=$token;
		$this->appid=$appid;
		$this->secret=$secret;
		$this->redirect_uri=$redirect_uri;
		$this->openid=$openid;
	}*/
	public function eventStart(){
		 $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		 $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		 $openId=$postObj->FromUserName;//openid
		 $this->openid=$openId;
		 $messageType=$postObj->MsgType;//事件 event click view
		 $createTime=$postObj->CreateTime;//时间

		 //file_put_contents(dirname(__FILE__)."/18.txt",var_export($postObj,TRUE));
		 if($postObj->Event == "subscribe" || $postObj->Event == "unsubscribe"){
			//关注推送消息
			$messArr=array(
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com"),
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com")
				);
			//$this->transmitNews($openId,$messArr);
		
		 }else{
			//消息回复（文本）
			if($messageType=="text"){
				$this->responseMsg();
			}
			//菜单触发
			if($messageType=="event" &&  $postObj->Event=="CLICK"){
				$EventKey=$postObj->EventKey;
				$this->muenMessage($EventKey, $this->openid);	
			}
		 }
		 return $openId;
	}
	public function index(){        
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$tmpArr = array($this->token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	//获取 access_token
	public function getAccessToken($grant_type="client_credential"){
		$file=dirname(__FILE__)."/accessToken.txt";
		if(file_exists($file)){
			$accessStr=file_get_contents($file);
			$accessArr=explode(",",$accessStr);
			if(($accessArr[1]+7200) < time()){
				$url="https://api.weixin.qq.com/cgi-bin/token?grant_type={$grant_type}&appid={$this->appid}&secret={$this->secret}";
				$curl = curl_init($url); 
				  curl_setopt($curl, CURLOPT_URL, $url); 
				  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
				  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
				  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
				  $get_return = curl_exec($curl); 
				$get_return = json_decode($get_return,true);
				//var_dump($get_return);exit;
				file_put_contents(dirname(__FILE__)."/accessToken.txt", $get_return['access_token'].",".time());
				
				$access_token=$get_return['access_token'];
				return $access_token;
			}else{
				return $access_token=$accessArr[0];
			}
		}else{
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type={$grant_type}&appid={$this->appid}&secret={$this->secret}";
			$curl = curl_init($url); 
			  curl_setopt($curl, CURLOPT_URL, $url); 
			  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
			  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
			  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
			  $get_return = curl_exec($curl); 
			$get_return = json_decode($get_return,true);
			//var_dump($get_return);exit;
			file_put_contents(dirname(__FILE__)."/accessToken.txt", $get_return['access_token'].",".time());
			$access_token=$get_return['access_token'];
			return $access_token;
		}
	}

	//获取openid
	public function getOpenid(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if(!empty($postStr)){
			 $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			 $openid=$postObj->FromUserName;
			 return $openid;
		}	
	}
	// 菜单创建
	public function meun($xjson){
		/*$jsonMenu = json_encode($xjson);
		$get_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->secret;
		$get_return = file_get_contents($get_url);
		$get_return = json_decode($get_return,true);
		if( !isset($get_return['access_token']) ){exit( '获取access_token失败！' );}*/
		$get_return=$this->getAccessToken();
		$post_url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$get_return;
		$ch = curl_init($post_url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$xjson);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($xjson))
		);
		$respose_data = curl_exec($ch);
		return $respose_data;
	}

	//curl方法
	public function https_request($url,$data = null){
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	//获取用户详细信息
	public function getUserMessage($openid){
		$access_token=$this->getAccessToken();
		$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";
		$get_return=file_get_contents($url);
		$getMessage=json_decode($get_return,true);
		return $getMessage;
	}
	//消息回复（文本）
	 public function responseMsg(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;//openid
			$this->openid=$fromUsername;//返回给wx class
			$toUsername = $postObj->ToUserName;
			$keyword = trim($postObj->Content);
			$time = time();
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
			$msgType = "text";
					 
			if($keyword == "?" || $keyword == "？"){
				//file_put_contents(dirname(__FILE__)."/11qq.txt", var_export($postObj,TRUE)) ; 
				//file_put_contents(dirname(__FILE__)."/11qq.txt", $keyword) ; 
				
				$contentStr ="现在时间是：". date("Y-m-d H:i:s",time());
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
			}elseif($keyword =="哈哈" || $keyword=="haha"){
				$contentStr ="哈哈哈哈哈哈";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
			}elseif($keyword =="列表" || $keyword=="liebiao"){
				
				$messArr=array(
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com"),
				);
				$this->transmitNews($this->openid,$messArr);//列表图文消息方法
			}elseif($keyword =="图片"){
				$this->transmitImage("./images/11.png",$this->fromUser,$this->openid);
			}else{
				 $contentStr ="欢迎加入彩铃小助手!";
				 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
			}
		}else{
			echo "";
			exit;
		}
	}
		
	//回复图文消息()
	public function transmitNews($toUser,$newsArray){
		if(!is_array($newsArray)){
			return;
		}
		$itemTpl = "<item>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
					<PicUrl><![CDATA[%s]]></PicUrl>
					<Url><![CDATA[%s]]></Url>
					</item>";
		$item_str = "";
		foreach ($newsArray as $item){
			$item_str .= sprintf($itemTpl, $item['title'], $item['description'], $item['picUrl'], $item['url']);
		}
		$xmlTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>
						$item_str
					</Articles>
					</xml>";
		$MsgType="news";
		$result = sprintf($xmlTpl, $toUser,$this->fromUser ,time(),count($newsArray));
		file_put_contents(dirname(__FILE__)."/0.txt", $result);
		echo $result;
	}

	public function muenMessage($EventKey,$toUsername){
			$time = time();
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
			$msgType = "text";
		
		if($EventKey=="001"){
			$contentStr ="您好，欢迎加入微天下。";
			$resultStr = sprintf($textTpl,$toUsername, $this->fromUser,$time, $msgType, $contentStr);
			echo $resultStr;
		}elseif($EventKey=="002"){
			$contentStr ="你发送的是0002";
			$resultStr = sprintf($textTpl,$toUsername, $this->fromUser,$time, $msgType, $contentStr);
			echo $resultStr;
		}elseif($EventKey =="列表"){
				$messArr=array(
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com"),
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com")
				);
				$this->transmitNews($toUsername,$messArr);//列表图文消息方法
		}elseif($EventKey =="我的二维码"){
				$this->transmitImg();
		}    	
	}

	//素材上传
	function uploadMaterial($filePath) {
		$real_path = realpath($filePath);
		file_put_contents(dirname(__FILE__)."/real_path.txt",$filePath);
        $file_info = array('filename' => $real_path, //国片相对于网站根目录的路径
        'content-type' => 'image/jpg', //文件类型
        'filelength' => '' //图文大小
        );
        $accessToken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$accessToken}&type=image";
        $ch1 = curl_init();
        $timeout = 5;
        $data = array("media" => "@{$real_path}", 'form-data' => $file_info);
        curl_setopt($ch1, CURLOPT_URL, $url);
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch1);
        curl_close($ch1);
        $imageArray = json_decode($result,true);//media_id
        file_put_contents(dirname(__FILE__)."/imageArray.txt",var_export($imageArray,true));
        return $imageArray;
    }
	//回复图片消息
   public function transmitImage($filePath,$fromUser,$toUser){
		$itemTpl = "<Image>
					 <MediaId><![CDATA[%s]]></MediaId>
					</Image>";
		$imageArray=$this->uploadMaterial($filePath);
		$item_str = sprintf($itemTpl, $imageArray['media_id']);
		$xmlTpl = "<xml>
					 <ToUserName><![CDATA[%s]]></ToUserName>
					 <FromUserName><![CDATA[%s]]></FromUserName>
					 <CreateTime>%s</CreateTime>
					 <MsgType><![CDATA[image]]></MsgType>
					 $item_str
				   </xml>";
 
		$result = sprintf($xmlTpl,$toUser,$fromUser,time());
		file_put_contents(dirname(__FILE__)."/1qaxxxxxx.txt",$result);
		echo $result;
	 }
	
	

}