<?php
namespace app\geng\model;
use think\Model;

class User extends Model
{
	function checklogin($data){

		$item = db('user')->where(['tel'=>$data['tel'],'password'=>$data['password'],'type'=>1])->find();
		// mp($item);
		if($item){
			db('user')->where(['tel'=>$data['tel']])->update(['openid'=>$data['openid'],'headimg'=>$data['headimg'],'nickname'=>$data['nickname'],'type'=>1,'time'=>time()]);
			return $item['id'];		
		}else{
			return 0;
		}
		
	}
	function checktype($invit_code){
		// mp($invit_code);
		$item = db('user')->where(['invit_code1'=>$invit_code])->find();
		if($item){
			if($item['type']==1){
				$res= [];
				$res['type'] = 2;
				$res['id'] = $item['id'];
				return $res;
			}else{
				$res= [];
				$res['type'] = 4;
				$res['id'] = $item['id'];
				return $res;
			}
		}else{
			$result = db('user')->where(['invit_code2'=>$invit_code])->find();
			if($result){
				$res= [];
				$res['type'] = 3;
				$res['id'] = $result['id'];
				return $res;
			}else{
				$res= [];
				$res['type'] = 5;
				$res['id'] = 0;
				return $res;
				
			}
		}
	}
	function newers($data){
		// mp($data);
		$item = db('user')->where(['tel'=>$data['tel']])->find();
		if($item){
			return 0;
		}else{
			$res = db('user')->insertGetId(['tel'=>$data['tel'],'password'=>$data['password'],'openid'=>$data['openid'],'nickname'=>$data['nickname'],'headimg'=>$data['headimg'],'type'=>$data['type'],'addr'=>$data['addr'],'unit'=>$data['unit'],'time'=>time(),'up_uid'=>$data['up_uid']]);
			// mp($res);
			return $res;

		}
	}
	function finduser($type,$id){
		if($type==1){
			$item = [];
			$item['two'] = db('user')->alias('u')->field('u.headimg,u.nickname,u.tel,u.time,u.goods_price,u.discount,u.type,u.totalprofit')->where(['type'=>2,'up_uid'=>$id])->select();
			for ($i=0; $i <count($item['two']) ; $i++) { 
				$item["two"][$i]["time"] = date("Y-m-d H:i",$item["two"][$i]["time"]);
			}
			$item['three'] = db('user')->alias('u')->field('u.headimg,u.nickname,u.tel,u.time,u.goods_price,u.discount,u.type,u.totalprofit')->where(['type'=>3,'up_uid'=>$id])->select();
			for ($i=0; $i <count($item['three']) ; $i++) { 
				$item["three"][$i]["time"] = date("Y-m-d H:i",$item["three"][$i]["time"]);
			}
			return($item);
			// mp($item);
		}else if($type==2){
			$item = db('user')->alias('u')->field('u.headimg,u.nickname,u.tel,u.time,u.goods_price,u.discount,u.type,u.totalprofit')->where(['type'=>4,'up_uid'=>$id])->select();
			for ($i=0; $i <count($item) ; $i++) { 
				$item[$i]["time"] = date("Y-m-d H:i",$item[$i]["time"]);
			}
			return($item);
			// mp($item);
		}
		
	}
	function changes($tel,$discount){
		$res = db('user')->field('user.tel')->where(['tel'=>$tel])->find();
		if($res){
			$discount = db('user')->where(['tel'=>$tel])->update(["discount"=>$discount]);
			
			return true;
		}else{
			
			return false;
		}
		
	}
	

	// 生成前三位是数字，后四位是小写字母的随机码
	function getRandomString($len,$i,$chars=null){
		if($i==0){
			if (is_null($chars)){
        		$chars = "abcdefghijklmnopqrstuvwxyz";
    		}  
    			mt_srand(10000000*(double)microtime());
    		for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        		$str .= $chars[mt_rand(0, $lc)];  
    		}
    			return $str;
		}else {
			if (is_null($chars)){
        		$chars = "0123456789";
    		}  
    			mt_srand(10000000*(double)microtime());
    		for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        		$str .= $chars[mt_rand(0, $lc)];  
    		}
    			return $str;

		}
    	
	}
	function checksid($id,$type,$whole){
		// mp($id);
		// mp($whole[0]);
		if($type==1){
			$item = db('user')->field('invit_code1,invit_code2')->where(['id'=>$id,'type'=>$type])->find();
			// mp($item);
			if($item['invit_code1']==null||$item['invit_code2']==null){
				db('user')->where(['id'=>$id,'type'=>$type])->update(['invit_code1'=>$whole[0],'invit_code2'=>$whole[1]]);
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('invit_code1,invit_code2')->select();
				return $res;
			}else{
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('invit_code1,invit_code2')->select();
				return $res;
			}	
		}else if($type==2){
			// mp(11);
			$item = db('user')->field('invit_code1')->where(['id'=>$id,'type'=>$type])->find();

			if($item['invit_code1']==null){
				db('user')->where(['id'=>$id,'type'=>$type])->update(['invit_code1'=>$whole]);
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('invit_code1')->select();
				return $res;
			}else{
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('invit_code1')->select();
				return $res;
			}
			
		}
	}
	function checkewm($id,$type,$whole){
		if($type==1){
			$item = db('user')->field('ewm1,ewm2')->where(['id'=>$id,'type'=>$type])->find();
			// mp($item);
			if($item['ewm1']==null||$item['ewm2']==null){
				db('user')->where(['id'=>$id,'type'=>$type])->update(['ewm1'=>$whole[0],'ewm2'=>$whole[1]]);
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('ewm1,ewm2')->select();
				return $res;
			}else{
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('ewm1,ewm2')->select();
				return $res;
			}	
		}else if($type==2){
			$item = db('user')->field('ewm1')->where(['id'=>$id,'type'=>$type])->find();
			if($item['ewm1']==null){
				db('user')->where(['id'=>$id,'type'=>$type])->update(['ewm1'=>$whole]);
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('ewm1')->select();
				return $res;
			}else{
				$res = db('user')->where(['id'=>$id,'type'=>$type])->field('ewm1')->select();
				return $res;
			}
			
		}
	}
	function updatenum($id,$password,$newpassword){
		$item = db('user')->where(['id'=>$id,'password'=>$password])->find();
		// mp($item);
		if($item){
			$res = db('user')->where(['id'=>$id,'password'=>$password])->update(['password'=>$newpassword]);
			return true;
		}else{
			return false;
		}
		
	}
	function updatemoney($id,$pay_password,$newpay){
		$item = db('user')->where(['id'=>$id,'pay_password'=>$pay_password])->find();
		// mp($item);
		if($item){
			$res = db('user')->where(['id'=>$id,'pay_password'=>$pay_password])->update(['pay_password'=>$newpay]);
			return true;
		}else{
			return false;
		}
		
	}
	// b1修改绑定手机函数：
	function tel($id,$newtel){
		$res = db('user')->where(['id'=>$id,"tel"=>$newtel])->find();
		if ($res) {
			return 0;
		}else{
			$res1 = db('user')->where(["tel"=>$newtel])->find();
			if ($res1) {
				return 2;
			}
		}
		$item = db('user')->where(['id'=>$id])->update(['tel'=>$newtel]);
		// mp($item);
		if($item){
			return 1;
		}else{
			return 0;
		}
		
	}
	// 除b1外其他用户修改地区单位函数：
	function changeaddrs($id,$addr,$unit){
		$res = db('user')->where(['id'=>$id])->find();
		if($res){
			$item = db('user')->where(['id'=>$id])->update(['addr'=>$addr,'unit'=>$unit]);
			return 1;
		}else{
			return 0;
		}
	}
	
	// type==4找两个discount
	function finddiscount($id){

		$res = db('user')->field('up_uid,discount')->where(['id'=>$id])->find();
		// mp($res);	
		$discount[2] = $res['discount'];
		$up_uid0 = $res['up_uid'];

		$item = db('user')->field('discount')->where(['id'=>$up_uid0])->find();
		$discount[1] = $item['discount'];
		return $discount;
		
		
	}
	// type==3或2找一个discount
	function findone($id){

		$res = db('user')->field('discount')->where(['id'=>$id])->find();

		$discount = $res['discount'];
		// mp($discount);
		return $discount;
	}
	// 判断是否有资金密码函数
	function ispaypass($id){
		$res = db('user')->field('pay_password')->where(['id'=>$id])->find();
		// mp($res);
		if($res['pay_password']==0){
			return false;
		}else{
			return true;
		}
	}
	// 插入资金密码函数
	function insertpay($id,$pay_password){
		$res = db('user')->where(['id'=>$id])->find();
		if($res){
			$item = db('user')->where(['id'=>$id])->update(['pay_password'=>$pay_password]);
			return true;
		}else{
			return flase;
		}
	}
	function bb_orders($id){
		$data = [];
		$res = db('user')->field('id')->where(['up_uid'=>$id,'type'=>4])->select();
		// mp($res);
		for($i=0;$i<count($res);$i++){
			$data[$i] = $res[$i]['id'];
		}
		return $data;
	}
	function bossorders($id){
		$data =[];
		$res = db('user')->field('id')->where(['up_uid'=>$id,'type'=>["in",[2,3]]])->select();
		// mp($res);
		for($i=0;$i<count($res);$i++){
			$data[$i] = $res[$i]['id'];
		}
		return $data;
	}
	function findtype($id){
		$res = db('user')->field('type')->where(['id'=>$id])->find();
		return $res;
	}

	

	
	
}