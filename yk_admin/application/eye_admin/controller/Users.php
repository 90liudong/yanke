<?php
namespace app\eye_admin\controller;
use think\Controller;
class Users extends Base{
	//判断是否登录
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }

	//B1用户的页面
	function users_B1($page=1,$each=15){
		$item =model("user")->getB1();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_B1?';
		$items =model("user")->getB1Page($each,$page);
		if (!$items) {
			$u_type=0;
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$u_type=$items[0]["type"];
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
			}
	}

	//B1_2用户的页面
	function users_B1_2($page=1,$each=15){
		$item =model("user")->getB1_2();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_B1_2?';
		$items =model("user")->getB1_2Page($each,$page);
		if (!$items) {
			$u_type=0;
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$u_type=$items[0]["type"];
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
			}
	}

	//B2_1用户的页面
	function users_B2_1($page=1,$each=15){
		$item =model("user")->getB2_1();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_B2_1?';
		$items =model("user")->getB2_1Page($each,$page);
		if (!$items) {
			$u_type=0;
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$u_type=$items[0]["type"];
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
			}
	}

	//B2_2用户的页面
	function users_B2_2($page=1,$each=15){
		$item =model("user")->getB2_2();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_B2_2?';
		$items =model("user")->getB2_2Page($each,$page);
		if (!$items) {
			$u_type=0;
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$u_type=$items[0]["type"];
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
			}
	}

	//C1用户的页面
	function users_C1($page=1,$each=15){
		$item =model("user")->getC1();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_C1?';
		$items =model("user")->getC1Page($each,$page);
		if (!$items) {
			$u_type=0;
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$u_type=$items[0]["type"];
			$date1 =0;
			$date2 =0;
			$search=0;
			$this->assign("search",$search);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch();
			}
	}

	//根据注册时间来搜索用户
	function users_time_search($page=1,$each=15,$date1,$date2,$u_type){
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$item =model("user")->users_time_search($strtime,$endtime,$u_type);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_time_search?';
		$items =model("user")->users_time_searchPage($strtime,$endtime,$u_type,$each,$page);
		if (!$items) {
			switch ($u_type)
			{
			case "1":
			   $this->error("没有此用户","users_B1","",3);
			    break;
			case "2":
			    $this->error("没有此用户","users_B1_2","",3);
			    break;
			case "3":
			    $this->error("没有此用户","users_B2_1","",3);
			    break;
			case "4":
			   $this->error("没有此用户","users_B2_2","",3);
			    break;
			case "5":
			   $this->error("没有此用户","users_C1","",3);
			    break;
			default:
			   header('location: '.$_SERVER['HTTP_REFERER']);
			}
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$search=0;
			$this->assign("search",$search);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			if ($u_type==1) {
				return $this->fetch('users_B1');
			}elseif($u_type==2){
				return $this->fetch('users_B1_2');
			}elseif($u_type==3){
				return $this->fetch('users_B2_1');
			}elseif($u_type==4){
				return $this->fetch('users_B2_2');
			}else{
				return $this->fetch('users_C1');
			}	
		}
	}

	//根据用户昵称来搜索用户
	function users_name_search($each=15,$page=1,$search,$u_type){
		$item =model("user")->users_name_search($search,$u_type);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'users_name_search?';
		$items =model("user")->users_name_searchPage($search,$u_type,$each,$page);
		// mp($u_type);
		if (!$items){
			switch ($u_type)
			{
			case "1":
			   $this->error("没有此用户","users_B1","",3);
			    break;
			case "2":
			    $this->error("没有此用户","users_B1_2","",3);
			    break;
			case "3":
			    $this->error("没有此用户","users_B2_1","",3);
			    break;
			case "4":
			   $this->error("没有此用户","users_B2_2","",3);
			    break;
			case "5":
			   $this->error("没有此用户","users_C1","",3);
			    break;
			default:
			   header('location: '.$_SERVER['HTTP_REFERER']);
			}
		}else{
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$u_type=$items[0]["type"];
			$date1 =0;
			$date2 =0;
			$this->assign("u_type",$u_type);
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("search",$search);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			if ($u_type==1) {
				return $this->fetch('users_B1');
			}elseif($u_type==2){
				return $this->fetch('users_B1_2');
			}elseif($u_type==3){
				return $this->fetch('users_B2_1');
			}elseif($u_type==4){
				return $this->fetch('users_B2_2');
			}else{
				return $this->fetch('users_C1');
			}
		}
	}

	//新增BI用户页面
	function users_add(){
		return $this->fetch();
	}

	//B1用户的库存管理页面
	function prostock($id,$page=1,$each=15){
		//$id是B1用户的ID
		$item =model("b1_goods")->b1goods($id);
		// mp($item);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'prostock?';
		$items =model("b1_goods")->b1goodsPage($id,$each,$page);
		// mp($items);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$search=0;
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("id",$id);
		$this->assign("search",$search);
		$this->assign("items",$items);
		return $this->fetch();
	}

	//B1用户的密码修改页面
	function users_modify($id){
		$this->assign("id",$id);
		return $this->fetch();
	}

	//新增B1用户
	function add($telnumber,$password,$name,$confirm_password){
		$res1 = model("user")->get(['true_name' => $name]);
		$res2 =model("user")->get(['tel' => $telnumber]);
		if ($res1) {
			$this->error("此账号已存在","users_B1","",3);
		}else if($res2){
			$this->error("用户手机已存在","users_B1","",3);
		}else{
			if ($password!=$confirm_password) {
				$this->error("密码不一致","users_B1","",3);
			}else{
				$user = model('user');
				$user->data([
				'tel'  =>  $telnumber,
				'type'  => 1,
				'password' => $password,
				'true_name'=>$name,
				'time'=>time()
				]);
				$user->save();
				//需要给新添加的B1用户添加他的商品库存
				$id=db("user")->getLastInsID();
				$items=model("goods")->getall();
				for ($i=0; $i <count($items) ; $i++) { 
					db('b1_goods')->insert(['uid'=>$id,'gid'=>$items[$i]['id'],'num'=>0]);
				}
				$this->success("添加成功","users_B1","",1);
			}
		}
	}

	//修改B1用户的密码功能
	function modify($id,$old_password,$confirm_password,$new_password){
		$res =model("user")->get(['password'=>$old_password,'id'=>$id]);
		if ($res){
			if ($new_password==$confirm_password) {
				$cond = model("user");
				// save方法第二个参数为更新条件
				$cond->save([
				    'password'  => $new_password
				],['id' => $id]);
				$this->success("修改成功","users_B1","",1);
			}else{
				$this->error("密码不一致","users_B1","",3);
			}
		}else{
			$this->error("密码错误","users_B1","",3);
		}
	}

	//管理B1用户的库存的搜索功能
	function stock_search($search,$id,$each=15,$page=1){
		$item =model("b1_goods")->b1goods_search($search,$id);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'stock_search?';
		$items =model("b1_goods")->b1goods_searchPage($search,$id,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$this->assign("search",$search);
		$this->assign("id",$id);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch('prostock');	
	}


	//管理B1用户的库存增加功能
	function stock_add($id,$gid,$num1,$num2){
		//num1=本身库存量 num2=增加的库存量
		//记录进流水
		$cond = model("b1_goods_water");
		$cond->data([
			'uid'=> $id,
			'bgid'=>$gid,
			'num'=>$num2,
			'time'=>time()
		]);
		//给B1增加库存
		$cond->save();
		$num = $num1+$num2;
		$cond = model("b1_goods");
		$cond->save([
		  'num'=>$num
		],['uid'=> $id,'gid'=>$gid]);
		$cond->save();
	}

	//管理B1用户的库存减少功能
	function stock_decrease($id,$gid,$num1,$num3){
		//num1=本身库存量 num3=减少的库存量
		if($num1==0){
			
		}elseif($num1<=$num3){
			$cond = model("b1_goods_water");
			$cond->data([
			'uid'=> $id,
			'bgid'=>$gid,
			'num'=>-$num1,
			'time'=>time()
			]);
			$cond->save();
			db('b1_goods')->where(['gid'=>$gid,'uid'=>$id])->update(['num' => 0]);
		}else{
			$cond = model("b1_goods_water");
			$cond->data([
			'uid'=> $id,
			'bgid'=>$gid,
			'num'=>-$num3,
			'time'=>time()
			]);
			$cond->save();
			$num=$num1-$num3;
			db('b1_goods')->where(['gid'=>$gid,'uid'=>$id])->update(['num' => $num]);
		}
	}

	//用户查看交易记录的功能在ods控制器

}
