<?php
namespace app\eye_admin1\model;
use think\Model;
class BringMoney extends Model{
	//提现记录
	function getpickmoney(){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		// ->order(['order','id'=>'desc','status'=>'asc'])
		// ->order('id desc,status asc')
		// ->order('status')
		->order('b.id desc')
		->select();
		foreach($items as $key=>$value){
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}
	

	function getpickmoneyPage($each,$page){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->limit(($page-1)*$each,$each)
		// ->order('status')
		->order('b.id desc')
		->select();
		foreach($items as $key=>$value){
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}

	//提现记录的搜索
	function pickup_search($cond){
		$items =db("bring_money")->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where($cond)
		->order('status')
		->select();
		return $items;
	}

	function pickup_searchPage($cond,$each,$page){
		$items =db("bring_money")->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where($cond)
		->order('b.id desc')
		->limit(($page-1)*$each,$each)
		->select();
		foreach($items as $key=>$value){
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}

}
