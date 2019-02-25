<?php
namespace app\eye_admin\controller;
use think\Controller;
class Money extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }
    
    //收入记录的页面
	function income($each=15,$page=1){
		$item = model("profit")->getincome();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'income?';
		$items =model("profit")->getincomePage($each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$search=0;
		$a=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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


	//提现记录的页面
	function pickup($each=15,$page=1){
		$item = model("BringMoney")->getpickmoney();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup?';
		$items =model("BringMoney")->getpickmoneyPage($each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$search=0;
		$a=0;
		$b=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//筛选用户类型(收入记录页面)
	function type_income($a,$each=15,$page=1){
		if ($a!=5){
			$item = model("profit")->gettype($a);
			$amount = count($item);
			$maxPage =ceil($amount/$each);
			$page =getPage($maxPage,$page);
			$pages =getPages($maxPage,$page);
			$href = 'type_income?';
			$items =model("profit")->gettypePage($a,$each,$page);
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
		}else{
			$this->redirect('income');
		}
		$date1=0;
		$date2=0;
		$search=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//根据收入日期筛选用户(收入记录页面)
	function income_time($date1,$date2,$each=15,$page=1){
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$item =model("profit")->income_time($strtime,$endtime);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'income_time?';
		$items =model("profit")->income_timePage($strtime,$endtime,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$search=0;
		$a=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//根据用户昵称(收入记录页面)
	function income_name($search,$each=15,$page=1){
		$item =model("profit")->income_name($search);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'income_name?';
		$items =model("profit")->income_namePage($search,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$a=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//筛选用户类型(提现记录页面)
	function type_pickmoney($a,$each=15,$page=1){
		if ($a!=5){
			$item = model("bring_money")->gettype($a);
			$amount = count($item);
			$maxPage =ceil($amount/$each);
			$page =getPage($maxPage,$page);
			$pages =getPages($maxPage,$page);
			$href = 'type_pickmoney?';
			$items =model("bring_money")->gettypePage($a,$each,$page);
			foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		}else{
			$this->redirect('pickup');
		}
		$date1=0;
		$date2=0;
		$search=0;
		$b=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//根据提现时间筛选用户(提现记录页面)
	function pickup_time($date1,$date2,$each=15,$page=1){
		$strtime=strtotime($date1);
		$endtime=strtotime($date2);
		$item =model("BringMoney")->pickup_time($strtime,$endtime);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup_time?';
		$items =model("BringMoney")->pickup_timePage($strtime,$endtime,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$search=0;
		$a=0;
		$b=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//根据用户昵称(提现页面)
	function pickup_name($search,$each=15,$page=1){
		$item =model("BringMoney")->pickup_name($search);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup_name?';
		$items =model("BringMoney")->pickup_namePage($search,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$a=0;
		$b=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

		$item = model("BringMoney")->getpickmoney();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup?';
		$items =model("BringMoney")->getpickmoneyPage($each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$search=0;
		$a=0;
		$b=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

		$item = model("BringMoney")->getpickmoney();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'pickup?';
		$items =model("BringMoney")->getpickmoneyPage($each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
		}
		$date1=0;
		$date2=0;
		$search=0;
		$a=0;
		$b=0;
		$this->assign("date1",$date1);
		$this->assign("date2",$date2);
		$this->assign("search",$search);
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

	//筛选申请状态
	function apply_statu($b,$each=15,$page=1){
		if ($b==4) {
			$this->redirect("pickup");
		}else{
			$item = model("BringMoney")->apply_statu($b);
			$amount = count($item);
			$maxPage =ceil($amount/$each);
			$page =getPage($maxPage,$page);
			$pages =getPages($maxPage,$page);
			$href = 'apply_statu?';
			$items =model("BringMoney")->apply_statuPage($b,$each,$page);
			foreach ($items as $key => $value) {
				$items[$key]["i"] = $key+1; 
			}
			for ($i=0; $i <count($items) ; $i++) { 
				$items[$i]['time']=date("Y-m-d H:i:s",$items[$i]['time']);
			}
			$date1=0;
			$date2=0;
			$search=0;
			$a=0;
			$this->assign("date1",$date1);
			$this->assign("date2",$date2);
			$this->assign("search",$search);
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
	}


}