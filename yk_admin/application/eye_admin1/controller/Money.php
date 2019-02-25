<?php
namespace app\eye_admin1\controller;
use think\Controller;
class Money extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }
    
    //收入记录的页面
	function income($each=15,$page=1){
		$item = model("profit")->income();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'income?';
		$items =model("profit")->incomePage($each,$page);
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$uname=0.07;
		$a=5;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("uname",$uname);
		$this->assign("a",$a);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch();
	}

	//收入记录的搜索
	function income_search($a,$date1,$date2,$uname,$each=15,$page=1){
		//联合查询条件:a=>用户类型  date1 && date2 =>日期  uname=>昵称搜索
		$cond=[];
		if ($a!=5) {
			$cond['u.type']=$a;
		}
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$endtime=$endtime+59;
		$cond['p.time']=['between',[$strtime,$endtime]];
		if ($uname!=""){
			$cond['u.nickname']=['like','%'.$uname.'%'];
		}
		// mp($cond);
		$item = model("profit")->income_search($cond);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'income_search?';
		$items =model("profit")->income_searchPage($cond,$each,$page);
		for ($i=0;$i<count($items);$i++){ 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("uname",$uname);
		$this->assign("a",$a);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch('income');
	}

	//提现记录的页面
	function pickup($each=15,$page=1){
		$item = model("BringMoney")->getpickmoney();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup?';
		$items =model("BringMoney")->getpickmoneyPage($each,$page);
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$uname=0.07;
		$a=5;
		$b=5;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("uname",$uname);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch();
	}

	//提现记录的搜索
	function pickup_search($a,$b,$date1,$date2,$uname,$each=15,$page=1){
		// echo($a.",".$b.",".$date1.",".$date2.",".$uname);
		// exit();
		//联合查询条件:a=>用户类型 b=>申请状态 date1 && date2 =>日期  uname=>昵称搜索
		$cond=[];
		if ($a!=5) {
			$cond['u.type']=$a;
		}
		if($b!=5){
			$cond['b.status']=$b;
		}
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$endtime=$endtime+59;
		$cond['b.time']=['between',[$strtime,$endtime]];
		if ($uname!=""){
			$cond['u.nickname']=['like','%'.$uname.'%'];
		}
		// mp($cond);
		$item = model("BringMoney")->pickup_search($cond);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup_search?';
		$items =model("BringMoney")->pickup_searchPage($cond,$each,$page);
		for ($i=0;$i<count($items);$i++){ 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("uname",$uname);
		$this->assign("a",$a);
		$this->assign("b",$b);
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		return $this->fetch('pickup');
	}
	
	//点击通过
	function change_status_1($id,$each=15,$page=1){
		//更改状态
		$items = model("BringMoney");
		$items->save([
		    'status'  => 1
		],['id' => $id]);
		return $this->redirect('pickup');
	}

	//点击拒绝
	function change_status_2($id,$num,$uid,$each=15,$page=1){
		// mp($uid);
		//更改状态
		$items = model("BringMoney");
		$items->save([
		    'status'  => 2
		],['id' => $id]);
		//将提现的钱加回到余额里
		$res = db("user")->where('id',$uid)->find();
		$profit = $res["profit"];
		$newprofit=$profit+$num;
		$items = model("user");
		$items->save([
		    'profit'  => $newprofit
		],['id' => $uid]);
		return $this->redirect('pickup');
	}

}