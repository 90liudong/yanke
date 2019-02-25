<?php 
namespace app\liudong\controller;
use think\Controller;

class Yanke extends Controller{
	function login($code){
		$data = file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=wx9e828b22c65f368b&secret=458dffee4c4c59038b0ae53800420d04&js_code=".$code."&grant_type=authorization_code");
		// return $data;
		$data = json_decode($data,true);
		//判断数据库有无这个openid 没有返回
		$result = db("user")->where(["openid"=>$data["openid"]])->find();

		if($result){

			$token = makeToken($result["id"]);
			$res=[
				"status"=>$result["frozen"],
				"sign"=>"2",
				"token"=>$token,
				"openid"=>$data["openid"],
				"type"=>$result["type"]
			];
			return json_encode($res);
		}else{
			//将此openid 返回
			$res=[
				"sign"=>"1",
				"openid"=>$data["openid"]
			];
			return json_encode($res);
		}
	}
	function updateHeadImg($token,$img){
		$id = checkToken($token);
		db("user")->where(["id"=>$id])->update(["headimg"=>$img]);
		return 1;
 	}
	function getOpenid($code){
		$data = file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=wx9e828b22c65f368b&secret=458dffee4c4c59038b0ae53800420d04&js_code=".$code."&grant_type=authorization_code");
		
		$data = json_decode($data,true);
		return $data["openid"];

	}
	function sendSMS($tel){
		$data['account'] = 'N153515_N2621621';
		$data['password'] = 'INbx5ptdRX99fd';
		$code = mt_rand(100000,999999);
		// session("codes",$code); 
		$data['phone'] = $tel;
		// session("ppp",$tel);
		$data['msg'] = "【图桑医疗科技】您的验证码是：".$code;
		$url = 'http://smsbj1.253.com/msg/send/json';//POST指向的链接      
	    $json_data = $this->postJsonData($url, $data);
	    $array = json_decode($json_data,true);
	    return $code;
	    // echo '<pre>';print_r($array);
	}     
	function postJsonData($url, $data){
	    $data = json_encode($data);      
	    $ch = curl_init();      
	    $timeout = 300;       
	    curl_setopt($ch, CURLOPT_URL, $url);     
	    curl_setopt($ch, CURLOPT_POST, true);      
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);      
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);      
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Content-Type: application/json',
	        'Content-Length: ' . strlen($data))
	    );     
	    $handles = curl_exec($ch);      
	    curl_close($ch);      
	    return $handles;      
	} 
	//将token转化为uid
	function getUid($token){
		$uid = checkToken($token);
		return $uid;

	}
	function getUserInfo($token){
		$uid = checkToken($token);
		$res = db("user")->field("headimg,nickname,tel,addr,unit")->where(["id"=>$uid])->find();
		// mp($res);
		echo json_encode($res);
	}

	function createEwm(){
		$appid = "wx9e828b22c65f368b";
		$secret = "458dffee4c4c59038b0ae53800420d04";
		$tokenUrl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		// mp($tokenUrl);
	    $getArr=array();
	    $tokenArr=json_decode($this->send_post($tokenUrl,$getArr,"GET"));
	    // mp($tokenArr);
	    $access_token=$tokenArr->access_token;
	    $path="pages/load/load";
		$width=430;
			$post_data='{"path":"'.$path.'","width":'.$width.'}';
		$url="https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=".$access_token;
		// mp($url);
		$result=$this->api_notice_increment($url,$post_data);
		$date = time();
		$fileName = "ewm".$date.rand(100,999).".png";
		$filepath = "./static/ewm/".$fileName;
		// mp($result);
		file_put_contents($filepath, $result);
		return "https://pxxy.90web.cn/static/ewm/".$fileName;
	}

	
	function send_post($url, $post_data,$method='POST') {
	    $postdata = http_build_query($post_data);
	    $options = array(
	      'http' => array(
	        'method' => $method, //or GET
	        'header' => 'Content-type:application/x-www-form-urlencoded',
	        'content' => $postdata,
	        'timeout' => 15 * 60 // 超时时间（单位:s）
	      )
	    );
	    $context = stream_context_create($options);
	    $result = file_get_contents($url, false, $context);
	    return $result;
	}
	function api_notice_increment($url, $data){
	    $ch = curl_init();
	    $header = "Accept-Charset: utf-8";
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    // curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $tmpInfo = curl_exec($ch);
	    //     var_dump($tmpInfo);
	    //    exit;
	    if (curl_errno($ch)) {
	      return false;
	    }else{
	      // var_dump($tmpInfo);
	      return $tmpInfo;
	    }
	}

}