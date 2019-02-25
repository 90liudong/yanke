<?php
namespace app\eye_admin1\controller;
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
		$search=0.07;
		$a=5;
		$b=5;
		$uname=0.07;
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

	//搜索功能
	function ods_search($a,$b,$date1,$date2,$uname,$search,$each=15,$page=1){
		//联合查询条件:a=>用户类型 b=>申请状态 date1 && date2 =>日期  uname=>昵称搜索 search=>订单号
		// mp($uname);
		$cond=[];
		if ($a!=5) {
			$cond['u.type']=$a;
		}
		if($b!=5){
			$cond['o.status']=$b;
		}
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$endtime=$endtime+59;
		$cond['o.time']=['between',[$strtime,$endtime]];
		if ($uname!=""){
			$cond['u.nickname']=['like','%'.$uname.'%'];
		}
		if ($search!=""){
			$cond['o.code']=['like','%'.$search.'%'];
		}
		// mp($cond);
		$item = model("orders")->ods_search($cond);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'ods_search?';
		$items =model("orders")->ods_searchPage($cond,$each,$page);
		for ($i=0;$i<count($items);$i++){ 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
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
		//$id是订单的id
		$cond = model("orders");
		$cond->save([
		    'tracking'  => $tracking,
		    'tracking_number' => $tracking_number,
		    'status' => 1
		],['id' => $id]);
		$this->success("修改成功","eye_admin1/ods/ods","",2);
	}

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