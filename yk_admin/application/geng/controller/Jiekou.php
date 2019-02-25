<?php
namespace app\geng\controller;
use think\Controller;

class Jiekou extends Controller{
	// 提现接口
	function bring($bank,$name,$num,$token,$pay_password){
		$uid = checkToken($token);
		$data=[
			'bank' => $bank,
			'name' => $name,
			'num'=> $num,
			'uid'=> $uid,
			'pay_password' => $pay_password,
			'time' => time()
		];
		$result = [];
		$add = model('BringMoney') ->get_money($data);
		// mp($add);
	 	if($add==1){
				$result = [
					'status' => true,
					'content'=>[
					'bank' => $bank,
					'name' => $name,
					'num' => $num,
					'uid'=> $uid,
					'pay_password' => $pay_password,
					'time' => time(),
					'status'=>0
					]
				];

				$result = json_encode($result);
				return $result;
			}else if($add==2){
				$result = [
					'status'=> false,
					'content'=>'提现密码不对'
				];
				$result = json_encode($result);
				return $result;
				// mp($result);
			}else{
				$result = [
					'status'=> false,
					'content'=>'余额不足'
				];
				$result = json_encode($result);
				return $result;
				// mp($result);
			}
	}
	// 用户剩余的余额
	function restprofit($token){
		$id = checkToken($token);
		$res = db("user")->field("profit")->where(["id"=>$id])->find();
		// mp($res);
		$res = json_encode($res);
		return $res;
	}
	// B1登录进来接口
	function login($tel,$password,$openid,$nickname,$headimg){
		$data=[
			'tel'=>$tel,
			'password'=>$password,
			'openid'=>$openid,
			'nickname'=>$nickname,
			'headimg'=>$headimg,
			'type'=> 1
		];
		// mp($data);
		$result = [];
		$check = model('user') -> checklogin($data);
		// mp($check);
		if($check){
			$token = makeToken($check);
			// mp($token);
			$result = [
					'status' => true,
					'content'=>[
					'openid' => $openid,
					'type'=> 1,
					'token' => $token
					]
			];
			$result = json_encode($result);
			echo $result;
			exit();
		}else{
			$result = [
					'status'=> false,
					'content'=>'登录失败'
				];
			$result = json_encode($result);
			echo $result;
			exit();
		}
	}
	// 轮播接口
	function lunbo(){
		$image = model('images') -> findimage();
		$image = json_encode($image);
		// mp($image);
		return $image;
	}
	 //遍历用户的所有产品接口
	function pro($token){
		// $i = makeToken($i);
		$id = checkToken($token);
		// mp($id);
		$products = model('goods') -> getpro($id);
		$products = json_encode($products);
		return $products;
		// mp($products);
	}
	// 点击商品显示详情
	function detail($gid,$uid){
		$res = model('goods')->prodetail($gid,$uid);
		// mp($res);

		$res[0]["detail"] = str_replace('src="/ueditor/php/upload', 'src="https://pxxy.90web.cn/ueditor/php/upload', $res[0]["detail"]);

		$res = json_encode($res);

		return $res;
	}
	// 点击商品显示厂家商品详情
	function cjdetail($gid){
		$res = db('goods')->where(["id"=>$gid])->select();
		$res[0]["detail"] = str_replace('src="/ueditor/php/upload', 'src="https://pxxy.90web.cn/ueditor/php/upload', $res[0]["detail"]);

		$res = json_encode($res);
		return $res;
	}
	// 注册接口
	function zhuce($tel,$password,$invit_code,$openid,$nickname,$headimg,$addr,$unit){
		if($invit_code==""){
			$data=[
				'tel'=>$tel,
				'password'=>$password,
				'openid'=>$openid,
				'nickname'=>$nickname,
				'headimg'=>$headimg,
				'addr'=>$addr,
				'unit'=>$unit,
				'type'=>5,
				'up_uid'=>0
			];

		}else{
			$type = model('user')->checktype($invit_code);
			// mp($type);
			$data=[
				'tel'=>$tel,
				'password'=>$password,
				'openid'=>$openid,
				'nickname'=>$nickname,
				'headimg'=>$headimg,
				'addr'=>$addr,
				'unit'=>$unit,
				'type'=>$type['type'],
				'up_uid'=>$type['id']
			];
		}
		// mp($data);
		$add = model('user')->newers($data);
		$token = makeToken($add);
		// mp($add);
		if($add!=0){
			$result = [
					'status' => true,
					'content'=>[
					'token'=>$token,
					'id'=>$add,
					'openid'=>$openid,
					'type'=>$data['type'],
					'up_uid'=>$data['up_uid']
					]
			];
			$result = json_encode($result);
			echo $result;
			exit();
		}else{
			$result = [
					'status'=> false,
					'content'=>'该账号已经被注册'
				];
			$result = json_encode($result);
			echo $result;
			exit();

		}
        
	}
	// b1的用户管理b1-2和b2-1, b1-2管理b2的接口
	function manage($type,$token){
		// mp($type);
		$id = checkToken($token);
		$item = model('user')->finduser($type,$id);
		// mp($item);
		$item = json_encode($item);
		return $item;
		

	}
	// 打折的接口
	function discount($tel,$discount){
		$add = model('user')->changes($tel,$discount);
		if($add){
			$result = [
					'status' => true,
					'content'=>'设置折扣成功'
			];

			$result = json_encode($result);
			return $result;
			// mp($result);
		}else{
			$result = [
					'status'=> false,
					'content'=>'设置折扣失败'
				];
				$result = json_encode($result);
				return $result;
			// mp($result);
		}
	}

	function dopro(){	
		return $this->fetch();
	}
	// b1的打折的商品
	function prodiscount($token){
		$id = checkToken($token);
		// mp($id);
		$discount = model('b1_goods')->dispro($id);
		$discount = json_encode($discount);
		return $discount;
	}
	// 个别商品列表接口
	function proshow($token){
		$id = checkToken($token);
		$products = model('goods') -> except($id);
		$products = json_encode($products);
		return $products;
		// mp($products);
	}


	// 个别商品添加接口
	function add($data){
		$data = json_decode($data,true);
		$data['id'] = checkToken($data['token']);
		$pro = model('B1Goods')->adds($data);
		if($pro){
			$result = [
				'status' => true,
				'content'=>'添加成功'
			];
			return json_encode($result);
			
		}else{
			$result = [
					'status' => false,
					'content'=>'添加失败'
			];
			return json_encode($result);
			
		}
		
	}
	// 个别商品删除接口
	function delect($data){
		
		// mp($data);
		$data = json_decode($data,true);
		// mp($data);
		$data['id'] = checkToken($data['token']);
		// mp($data);
		$pro = model('B1Goods')->deletes($data);
		if($pro){
			$result = [
					'status' => true,
					'content'=>'删除成功'
			];
			return json_encode($result);
		}else{
			$result = [
					'status' => false,
					'content'=>'删除失败'
			];
			return json_encode($result);
		}

	}
	//  生成b1和b1-2的邀请码接口
	function makenum($type,$token){
		$id = checkToken($token);
	
		if($type==1){
			$whole = [];
			for($i=0;$i<2;$i++){
				$word = model('user')->getRandomString(3,1);
				$num = model('user')->getRandomString(4,0);
				$temp = $word.$num;
				$whole[$i] = $temp; 
			}	
			$res = model('user')->checksid($id,$type,$whole);
			$res = json_encode($res);
			return $res;
	
		}else if($type==2){
			$word = model('user')->getRandomString(3,1);
			$num = model('user')->getRandomString(4,0);
			$whole = $word.$num;
			$res = model('user')->checksid($id,$type,$whole);
			$res = json_encode($res);
			return $res;		
		}

	}
	function makeEwm($type,$token){
		$id = checkToken($token);
		if($type==1){
			$whole = [];
			$ewm = [];
			for($i=0;$i<2;$i++){
				$word = model('user')->getRandomString(3,1);
				$num = model('user')->getRandomString(4,0);
				$temp = $word.$num;
				$path="pages/set/set?id=".$id."&invnum=".$temp;
				$url= $this->createEwm($path);
				$whole[$i] = $temp; 
				$ewm[$i] = $url; 
			}
			$res1 = model('user')->checksid($id,$type,$whole);
			$res = model('user')->checkewm($id,$type,$ewm);
			$res = json_encode($res);
			return $res;
		}else if($type==2){
			$word = model('user')->getRandomString(3,1);
			$num = model('user')->getRandomString(4,0);
			$temp = $word.$num;
			$path="pages/set/set?id=".$id."&invnum=".$temp;
			$url= $this->createEwm($path);
			$whole = $temp;
			$ewm = $url;
			$res1 = model('user')->checksid($id,$type,$whole);
			$res = model('user')->checkewm($id,$type,$ewm);
			$res = json_encode($res);
			return $res;		
		}

	}
	function makeSellEwm($token){
		$id = checkToken($token);
		// $id = 131;
		$data = db("user")->field("sell_ewm")->where("id",$id)->find();
		if($data["sell_ewm"]){
			// mp(123123123);
			$res = json_encode($data["sell_ewm"]);
		}else{
			$path="pages/load/load?up_id=".$id;
			$url= $this->createEwm($path);
			//将url存入 user表里去
			db("user")->where("id",$id)->update(["sell_ewm"=>$url]);
			$res = json_encode($url);
		}
		return $res;
	}

	//生成二维码
	function createEwm($path){
		$appid = "wx9e828b22c65f368b";
		$secret = "458dffee4c4c59038b0ae53800420d04";
		$tokenUrl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		// mp($tokenUrl);
	    $getArr=array();
	    $tokenArr=json_decode($this->send_post($tokenUrl,$getArr,"GET"));
	    // mp($tokenArr);
	    $access_token=$tokenArr->access_token;
	    $path=$path;
		$width=375;
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
	// 登录密码修改接口
	function newnums($token,$password,$newpassword){
		$id = checkToken($token);
		$res = model('user')->updatenum($id,$password,$newpassword);
		// mp($res);
		if($res){
			$result = [
					'status' => true,
					'content'=>'修改成功'
			];
			$result = json_encode($result);
			return $result;
		}else{
			// mp(111);
			$result = [
					'status' => false,
					'content'=>'修改失败'
			];
			$result = json_encode($result);
			return $result;
		}
	}
	// 资金密码修改
	function moneynum($token,$pay_password,$newpay){
		$id = checkToken($token);
		$res = model('user')->updatemoney($id,$pay_password,$newpay);
		if($res){
			$result = [
					'status' => true,
					'content'=>'修改成功'
			];
			$result = json_encode($result);
			return $result;
		}else{
			// mp(111);
			$result = [
					'status' => false,
					'content'=>'修改失败'
			];
			$result = json_encode($result);
			return $result;
		}
	}
	// 判断资金密码有无
	function ispay($token){
		$id = checkToken($token);
		$res = model('user')->ispaypass($id);

		if($res){
			$result = [
					'status' => true,
					'content'=>'已设置资金密码'
			];
			$result = json_encode($result);
			return $result;
		}else{
			$result = [
					'status' => false,
					'content'=>'没设置资金密码'
			];
			$result = json_encode($result);
			return $result;
		}
		
	}

	// 插入资金密码
	function makepay($token,$pay_password){
		$id = checkToken($token);
		$res = model('user')->insertpay($id,$pay_password);
		if($res){
			$result = [
					'status' => true,
					'content'=>'已设置资金密码'
			];
			$result = json_encode($result);
			return $result;
		}else{
			$result = [
					'status' => false,
					'content'=>'没设置资金密码'
			];
			$result = json_encode($result);
			return $result;
		}	
	}

	// 用户修改所有绑定手机接口：
	function bphone($token,$newtel){
		$id = checkToken($token);
		$res = model('user')->tel($id,$newtel);
		if($res==1){
			$result = [
					'status' => true,
					'content'=>'修改成功'
			];
			$result = json_encode($result);
			return $result;
			// mp($result);
		}else if($res==0){
			$result = [
					'status' => false,
					'content'=>'修改的手机号与当前手机号重复'
			];
			$result = json_encode($result);
			return $result;
		}else{
			$result = [
					'status' => false,
					'content'=>'该手机号已经被注册'
			];
			$result = json_encode($result);
			return $result;
		}
	}
	// 除b1外其他用户修改地区单位接口：
	function addrunit($token,$addr,$unit){
		$id = checkToken($token);
		$res = model('user')->changeaddrs($id,$addr,$unit);
		if($res==1){
			$result = [
					'status' => true,
					'content'=>'修改成功'
			];
			$result = json_encode($result);
			return $result;
			// mp($result);
		}else{
			$result = [
					'status' => false,
					'content'=>'修改失败'
			];
			$result = json_encode($result);
			return $result;
			// mp($result);
		}
	}

	// 患者购买商品接口
	function buy($token,$up_uid,$name,$tel,$addr,$gid,$num,$unit_price){
		$id = checkToken($token);
		$total_price = $num * $unit_price;
		// mp($price);
		$data = [
			'c_uid'=>$id,
			'up_uid'=>$up_uid,
			'name'=>$name,
			'tel'=>$tel,
			'addr'=>$addr,
			'gid'=>$gid,
			'num'=>$num,
			'unit_price'=>$unit_price,
			'type'=>5,
			'code'=>time(),
			'time'=>time(),
			'price'=>$total_price
		];
		// mp($res);
		$item = model('addr')->address($data);
		$res = model('orders')->buypro($data);
		$res = json_encode($res);
		return $res;
		// mp($res);
	}
	//查找订单---------------？？？？？？？ 比较多问题
	function findOrders($type,$token){
		$id = checkToken($token);
		// mp($id);
		if ($type==5) {
			$res = $this->orderpro($id);
		}else if ($type==4){ 
			$res = $this->b2($id);
		}else if ($type==3||$type==2){ 
			$res = $this->bb($id);
		}else{ 
			$res = $this->bboss($id);
			// mp($res);
		}
		// mp($res);	
		$total = 0;
		if($res){
			for ($i=0; $i <count($res) ; $i++) { 
				$res[$i]["time"] = date("Y-m-d", $res[$i]["time"]);
				$res[$i]["image"] = "https://pxxy.90web.cn/static/uploads/product_pic/".str_replace("\\","/",$res[$i]["image"]);
				if ($type!=5) {
					$total+=$res[$i]["money"]; 
					$res[$i]["unit_profit"] =  $res[$i]["money"]/$res[$i]["num"];	
				}
			}
			$res = [
				"order"=>$res,
				"total"=>$total
			];
			// mp($res);
			$res = json_encode($res);
			return $res;
		}else{

			$res = json_encode($res);

			return $res;

		}

	}
	// 遍历患者订单列表
	function orderpro($id){
		$result = model('orders')->patient($id);
		// $result = json_encode($result);
		// 对数组按时间进行排序
		$flag=array();  
		foreach($result as $result2){  
		    $flag[]=$result2["time"];  
		    }  
		array_multisort($flag, SORT_DESC, $result);
		return $result;
		// mp($result);

	}
	// b2的订单列表：
	function b2($id){
		$result = model('orders')->b2_orders($id);
		// $result = json_encode($result);
		// 对数组按时间进行排序
		$flag=array();  
		foreach($result as $result2){  
		    $flag[]=$result2["time"];  
		}  
		array_multisort($flag, SORT_DESC, $result);
		return $result;
		// mp($result);
	}
	// b1-2或b2-1订单列表接口：
	function bb($id){
		// 患者到医生到分代
		$data = [];
		$result = model('user')->bb_orders($id);
		// mp($result);
		for($i=0;$i<count($result);$i++){
			// mp($result[$i]);
			$res = $this->b2($result[$i]);
			// mp($res);
			// $res = json_decode($res,true);
			for($j=0;$j<count($res);$j++){
				$data[] = $res[$j];
				$oid[$j] = $res[$j]["id"];
				$profit[$j] = subProfit($id,$oid[$j]);
				// mp($profit[$j]['money']);
				$data[$j]['money'] = $profit[$j]['money'];
			}
		}
		// mp($data);
		// 患者直接到分代
		$item = model('orders')->b2_orders($id);
		// mp($item);
		if(!empty($item)){
			for($j=0;$j<count($item);$j++){
				array_push($data,$item[$j]);
			}
			// mp($data);
			// 对数组按时间进行排序
			$flag=array();  
			foreach($data as $data2){  
			    $flag[]=$data2["time"];  
			}  
			array_multisort($flag, SORT_DESC, $data);
			return $data;

		}else{
			// mp($data);
			return $data;

		}
	}
	// 总代的订单列表接口：
	function bboss($id){
		$data = [];
		$result = model('user')->bossorders($id);
		// mp($result);
		for($i=0;$i<count($result);$i++){
			// mp($result[$i]);
			$res = $this->bb($result[$i]);
			// $res['money']=0;
			// mp($res);
			// $res = json_decode($res,true);
			
			for($j=0;$j<count($res);$j++){
				// $res[$j]['money']=0;
				$data[] = $res[$j];
		
			}

		}

		for ($i=0; $i <count($data) ; $i++) { 
				$oid = $data[$i]["id"];
				$profit = subProfit($id,$oid);
				// mp($profit[$j]['money']);
				$data[$i]['money'] = $profit["money"];
		}
		// mp($data);
		// 患者直接到总代
		$item = model('orders')->b2_orders($id);
		// mp($item);
		if(!empty($item)){
			for($j=0;$j<count($item);$j++){
				array_push($data,$item[$j]);
			}
			// mp($data);
			// 对数组按时间进行排序
			$flag=array();  
			foreach($data as $data2){  
			    $flag[]=$data2["time"];  
			}  
			array_multisort($flag, SORT_DESC, $data);
			return $data;

		}else{
			return $data;
		}
		// mp($data);
	}
	// 查找有无收货地址
	function isaddr($token){
		$id = checkToken($token);
		$res = model("addr")->isaddrs($id);
		// mp($res);
		if($res){
			$res = [
					'status' => true,
					'content'=> [
						'id'=>$res['id'],
						'uid'=>$res['uid'],
						'name'=>$res['name'],
						'tel'=>$res['tel'],
						'addr'=>$res['addr']
					]
			];
			$res = json_encode($res);
			return $res;
		}else{
			$res = [
				'status'=>false,
				'content'=>[]
			];
			$res = json_encode($res);
			return $res;
		}
	}
	// 流水接口
	function moneywater($token){
		$id = checkToken($token);
		$res = model('moneywater')->waterflow($id);
		$res = json_encode($res);
		return $res;

	}
	// 我的库存
	function kucun($token){
		$id = checkToken($token);
		$res = model('b1_goods')->kucuns($id);
		$res = json_encode($res);
		return $res;
	}
	// 收入管理
	function shouru($token,$dates){
		$id = checkToken($token);
		$res = [];
		// mp($dates);
		$times = explode('-',$dates);
		// mp($time); 
		for($i=0;$i<count($times);$i++){
			$year = $times[0];
			$month = $times[1];  
		}
		$item = $this->mFristAndLast($year,$month);
		$item = json_decode($item,true);
		// mp($item);
		$begin = $item['firstday'];
		$end = $item['lastday'];
		
		$type = model('user')->findtype($id);
		$data = $this->findOrders($type['type'],$token);
		$data = json_decode($data,true);
		// mp($data);
		$result =0;
		$data = $data["order"];
		for($i=0;$i<count($data);$i++){
			$data[$i]['time'] = strtotime($data[$i]['time']);
			// mp($data[$i]['time']);
			if($data[$i]['time']>=$begin&&$data[$i]['time']<=$end){
				$data[$i]['time'] =date("Y-m-d",$data[$i]['time']);
				$result+=$data[$i]['money'];
				$res[$i] = $data[$i];
			}
		}
		// $res["total"]=$result;
			$res = [
				"order"=>$res,
				"total"=>$result
			];
		// mp($res);
		// for($j=0;$j<count($res);$j++){
		// 	$res[$j]['totals'] = $result;
		// }
		$res = json_encode($res);
		return $res;
	}

	function mFristAndLast($y = "", $m = ""){
	    if ($y == "") $y = date("Y");
	    if ($m == "") $m = date("m");
	    $m = sprintf("%02d", intval($m));
	    $y = str_pad(intval($y), 4, "0", STR_PAD_RIGHT);
	    $m>12 || $m<1 ? $m=1 : $m=$m;
	    $firstday = strtotime($y . $m . "01000000");
	    $firstdaystr = date("Y-m-01", $firstday);
	    $lastday = strtotime(date('Y-m-d 23:59:59', strtotime("$firstdaystr +1 month -1 day")));
	    $during = ["firstday" => $firstday,
	        	  "lastday" => $lastday
	              ];
	              // mp($firstday);
	    $during = json_encode($during);
	    return $during;
    // mp($during);
	}
	// 这个是判断B1的库存
	function isnum($up_uid,$gid){
		$b1_id = digui($up_uid);
		// return $gid;
		// mp($b1_id);
		$nums = db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$gid])->find();
		// $nums = json_encode($nums);
		// return $nums;
		if(!$nums){
			$nums = 0;
		}else{
			$nums = $nums["num"];
		}
		// mp($nums);
		$nums = json_encode($nums);
		return $nums;
	}
}