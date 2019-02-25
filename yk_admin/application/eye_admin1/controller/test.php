<?php
namespace app\eye_admin\controller;
use think\Controller;
class Ods extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }

    //订单管理的页面显示
	function ods($each=15,$page=1){
		$item = model("orders")->getall();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'ods?';
		$items =model("orders")->getallPage($each,$page);
		// mp($items);
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$date1=0;
		$date2=0;
		$search=0;
		$a=0;
		$b=7;
		$uname=0.001;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("uname",$uname);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch();
	}

	//筛选用户类型
	function ods_type($a,$each=15,$page=1,$date1=0,$date2=0){
		if ($a!=5) {
			//联合查询条件:a=>用户类型 b=>发货状态  date1 && date2 =>日期 uname =>昵称
			$cond=[];
			$cond["u.type"]=$a;
			session("ods_a",$cond["u.type"]);
			if ($date1!=0 && $date2!=0) {
				$strtime=strtotime($date1);
				$endtime=strtotime($date2);
				$cond["o.time"]=['between',[$strtime,$endtime]];
				session("ods_time",$cond["o.time"]);
			}
			//session是否存在
			if(session("?ods_a")){
				$cond["u.type"]=session("ods_a");
			}
			if(session("?ods_time")){
				$cond["o.time"]=session("ods_time");
			}
			//清空session 防止其他搜索出错
			session('ods_a', null);
			session('ods_time',null);
			$item = model("orders")->gettype($a,$cond);
			$amount = count($item);
			$maxPage =ceil($amount/$each);
			$page =getPage($maxPage,$page);
			$pages =getPages($maxPage,$page);
			$href = 'ods_type?';
			$items =model("orders")->gettypePage($a,$cond,$each,$page);
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		}else{
			$this->redirect("ods");
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		$search=0;
		$uname=0.001;
		$b=7;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("uname",$uname);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch("ods");
	}

	//筛选发货状态
	function goods_statu($b,$each=15,$page=1,$a=0,$date1=0,$date2=0,$uname){
		// mp($a);
		if($b==3) {
			$this->redirect("ods");
		}else{
			//联合查询条件:a=>用户类型 b=>发货状态  date1 && date2 =>日期 uname =>昵称
			$cond=[];
			if ($a!=0) {
				$cond["u.type"]=$a;
				session("ods_a",$cond["u.type"]);
			}
			if ($date1!=0 && $date2!=0) {
				$strtime=strtotime($date1);
				$endtime=strtotime($date2);
				$cond["o.time"]=['between',[$strtime,$endtime]];
				session("ods_time",$cond["o.time"]);
			}
			if ($uname!=0.001) {
				$cond['u.nickname']=['like','%'.$uname.'%'];
				session('ods_uname',$cond['u.nickname']);
			}
			//session是否存在
			if(session("?ods_a")){
				$cond["u.type"]=session("ods_a");
			}
			if(session("?ods_time")){
				$cond["o.time"]=session("ods_time");
			}
			if (session("?ods_uname")) {
				$cond["u.nickname"]=session("ods_uname");
			}
			//清空session 防止其他搜索出错
			session('ods_a', null);
			session('ods_time',null);
			session("ods_uname",null);
			// mp($cond);
			$item = model("orders")->goods_statu($b,$cond);
			$amount = count($item);
			$maxPage =ceil($amount/$each);
			$page =getPage($maxPage,$page);
			$pages =getPages($maxPage,$page);
			$href = 'goods_statu?';
			$items =model("orders")->goods_statuPage($b,$each,$page,$cond);
			for ($i=0; $i <count($items) ; $i++) { 
				$res = $items[$i]['tracking'];
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
				if($res==''){
					$items[$i]['tk'] = 0;
				}else{
					$items[$i]['tk'] = 1;
				}
			}
			foreach ($items as $key => $value) {
				$items[$key]["i"] = $key+1; 
			}
			$search=0;
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("search",$search);
			$this->assign("a",$a);
			$this->assign("b",$b);
			$this->assign("uname",$uname);
			$this->assign("each",$each);
			$this->assign("maxPage",$maxPage);
			$this->assign("page",$page);
			$this->assign("pages",$pages);
			$this->assign("href",$href);
			$this->assign("amount",$amount);
			$this->assign("items",$items);
			return $this->fetch('ods');
		}
	}

	//搜索上级用户昵称的功能
	function ods_user($uname,$each=15,$page=1,$odate1=0,$odate2=0){
		$date1=$odate1;
		$date2=$odate2;
		//联合查询条件:a=>用户类型 b=>发货状态  date1 && date2 =>日期 uname =>昵称
		$cond=[];
		$cond["u.nickname"]=['like','%'.$uname.'%'];
		session("ods_uname",$cond["u.nickname"]);
		if ($date1!=0 && $date2!=0) {
			$strtime=strtotime($date1);
			$endtime=strtotime($date2);
			$cond["o.time"]=['between',[$strtime,$endtime]];
			session("ods_time",$cond["o.time"]);
		}
		//session是否存在
		if(session("?ods_uname")){
			$cond["u.nickname"]=session("ods_uname");
		}
		if(session("?ods_time")){
			$cond["o.time"]=session("ods_time");
		}
		//清空session 防止其他搜索出错
		session('ods_time',null);
		session("ods_uname",null);
		// mp($cond);
		$item = model("orders")->getuser($uname,$cond);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'ods_user?';
		$items =model("orders")->getuserPage($uname,$cond,$each,$page);
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$search=0;
		$a=0;
		$b=7;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("uname",$uname);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch('ods');
	}

	//根据订单时间搜索用户
	function ods_time_search($date1,$date2,$each=15,$page=1){
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$item =model("orders")->ods_time($strtime,$endtime);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'ods_time_search?';
		$items =model("orders")->ods_timePage($strtime,$endtime,$each,$page);
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$search=0;
		$a=0;
		$b=7;
		$uname=0.001;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("uname",$uname);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch('ods');
	}

	//根据订单号搜索用户
	function code_search($search,$each=15,$page=1){
		$item =model("orders")->code_search($search);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'code_search?';
		$items =model("orders")->code_searchPage($search,$each,$page);
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$date1=0;
		$date2=0;
		$a=0;
		$b=7;
		$uname=0.001;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("uname",$uname);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch('ods');
	}

	//更改快递公司以及订单号的功能
	function ods_deal($tracking,$tracking_number,$code,$id){
		//$id是患者的id
		$cond = model("orders");
		$cond->save([
		    'tracking'  => $tracking,
		    'tracking_number' => $tracking_number
		],['code' => $code]);
		// $cond = model("addr");
		// $cond->save([
		//     'addr'  => $address
		// ],['uid' => $id]);
		// $items = model("orders")->getall();
		// for ($i=0; $i <count($items) ; $i++) { 
		// 	$res = $items[$i]['tracking'];
		// 	if($res==''){
		// 		$items[$i]['tk'] = 0;
		// 	}else{
		// 		$items[$i]['tk'] = 1;
		// 	}
		// }
		$this->success("修改成功","eye_admin1/ods/ods","",2);
		// return $this->redirect('ods');
	}

	// function updatecode(){
	// 	$items = model("orders")->getall();
	// 	for ($i=0;$i<count($items);$i++){ 
	// 		$cond = model("orders");
	// 		$cond->save([
	// 		    'code'  => $i
	// 		],['id' => $i]);
	// 	}
	// 	echo "更新成功";
	// }

	//代理B1查看交易记录的功能
	function b1_orders($id,$each=15,$page=1){
		//接收的$id是代理的id(来自users_B1页面)
		$item = model("user")->getbOds($id);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'b1_orders?';
		$items =model("user")->getbOdsPage($id,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		$this->assign("id",$id);
		return $this->fetch("ods_b1");
	}

	//代理B1-2查看交易记录的功能
	function b1_2_orders($id,$each=15,$page=1){
		//接收的$id是代理的id(来自users_B1页面)
		$item = model("user")->getbOds($id);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'b1_2_orders?';
		$items =model("user")->getbOdsPage($id,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		$this->assign("id",$id);
		return $this->fetch("ods_b1_2");
	}

	//代理B2查看交易记录的功能
	function b2_orders($id,$each=15,$page=1){
		//接收的$id是代理的id(来自users_B1页面)
		$item = model("user")->getbOds($id);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'b2_orders?';
		$items =model("user")->getbOdsPage($id,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		$this->assign("id",$id);
		return $this->fetch("ods_b2");
	}

	//患者查看交易记录的功能
	function c_orders($id,$each=15,$page=1){
		$item =model("user")->getcOds($id);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'c_orders?';
		$items =model("user")->getcOdsPage($id,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		$this->assign("id",$id);
		return $this->fetch("ods_c");
	}	
}